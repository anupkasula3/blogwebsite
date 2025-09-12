<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdClick;
use App\Models\AdImpression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startStr = $request->input('start');
        $endStr = $request->input('end');

        $startAt = $this->parseDateOrDefault($startStr, now()->subDays(7))->startOfDay();
        $endAt = $this->parseDateOrDefault($endStr, now())->endOfDay();

        // Aggregate impressions and clicks per ad in range
        $impr = AdImpression::select('ad_id', DB::raw('COUNT(*) as impressions'))
            ->whereBetween('occurred_at', [$startAt, $endAt])
            ->groupBy('ad_id');

        $clk = AdClick::select('ad_id', DB::raw('COUNT(*) as clicks'))
            ->whereBetween('occurred_at', [$startAt, $endAt])
            ->groupBy('ad_id');

        $data = Ad::query()
            ->leftJoinSub($impr, 'impr', 'impr.ad_id', '=', 'ads.id')
            ->leftJoinSub($clk, 'clk', 'clk.ad_id', '=', 'ads.id')
            ->select('ads.*', DB::raw('COALESCE(impr.impressions,0) as impressions'), DB::raw('COALESCE(clk.clicks,0) as clicks'))
            ->orderByDesc(DB::raw('COALESCE(impr.impressions,0) + COALESCE(clk.clicks,0)'))
            ->paginate(20)
            ->withQueryString();

        return view('admin.reports.index', [
            'data' => $data,
            'start' => $startAt->toDateString(),
            'end' => $endAt->toDateString(),
        ]);
    }

    public function ad(Request $request, Ad $ad)
    {
        $startStr = $request->input('start');
        $endStr = $request->input('end');

        $startAt = $this->parseDateOrDefault($startStr, now()->subDays(7))->startOfDay();
        $endAt = $this->parseDateOrDefault($endStr, now())->endOfDay();

        $impressions = AdImpression::where('ad_id', $ad->id)
            ->whereBetween('occurred_at', [$startAt, $endAt])
            ->count();
        $clicks = AdClick::where('ad_id', $ad->id)
            ->whereBetween('occurred_at', [$startAt, $endAt])
            ->count();
        $ctr = $impressions ? round(($clicks / max(1, $impressions)) * 100, 2) : 0;

        $byPlacement = AdImpression::select('ad_placement_id', DB::raw('COUNT(*) as impressions'))
            ->where('ad_id', $ad->id)
            ->whereBetween('occurred_at', [$startAt, $endAt])
            ->groupBy('ad_placement_id')
            ->pluck('impressions', 'ad_placement_id');

        $clicksByPlacement = AdClick::select('ad_placement_id', DB::raw('COUNT(*) as clicks'))
            ->where('ad_id', $ad->id)
            ->whereBetween('occurred_at', [$startAt, $endAt])
            ->groupBy('ad_placement_id')
            ->pluck('clicks', 'ad_placement_id');

        $placements = [];
        foreach ($byPlacement as $pid => $imp) {
            $clk = (int) ($clicksByPlacement[$pid] ?? 0);
            $placements[] = [
                'id' => $pid,
                'name' => optional(\App\Models\AdPlacement::find($pid))->name ?? 'Manual/Unknown',
                'impressions' => (int) $imp,
                'clicks' => $clk,
                'ctr' => $imp ? round(($clk / max(1,$imp))*100, 2) : 0,
            ];
        }

        // If PDF requested
        if ($request->boolean('pdf')) {
            if (class_exists('Barryvdh\\DomPDF\\Facade\\Pdf')) {
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.ad_pdf', [
                    'ad' => $ad,
                    'start' => $startAt,
                    'end' => $endAt,
                    'impressions' => $impressions,
                    'clicks' => $clicks,
                    'ctr' => $ctr,
                    'placements' => $placements,
                ])->setPaper('a4', 'portrait');
                $filename = 'ad_'.$ad->id.'_report_'.$startAt->toDateString().'_to_'.$endAt->toDateString().'.pdf';
                return $pdf->download($filename);
            }
            // Fallback: show HTML with install hint
            return view('admin.reports.ad_pdf', [
                'ad' => $ad,
                'start' => $startAt,
                'end' => $endAt,
                'impressions' => $impressions,
                'clicks' => $clicks,
                'ctr' => $ctr,
                'placements' => $placements,
                'missingPdf' => true,
            ]);
        }

        return view('admin.reports.ad', [
            'ad' => $ad,
            'start' => $startAt->toDateString(),
            'end' => $endAt->toDateString(),
            'impressions' => $impressions,
            'clicks' => $clicks,
            'ctr' => $ctr,
            'placements' => $placements,
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        $startStr = $request->input('start');
        $endStr = $request->input('end');

        $startAt = $this->parseDateOrDefault($startStr, now()->subDays(7))->startOfDay();
        $endAt = $this->parseDateOrDefault($endStr, now())->endOfDay();

        $rows = Ad::query()
            ->leftJoinSub(
                AdImpression::select('ad_id', DB::raw('COUNT(*) as impressions'))
                    ->whereBetween('occurred_at', [$startAt, $endAt])
                    ->groupBy('ad_id'),
                'impr', 'impr.ad_id', '=', 'ads.id'
            )
            ->leftJoinSub(
                AdClick::select('ad_id', DB::raw('COUNT(*) as clicks'))
                    ->whereBetween('occurred_at', [$startAt, $endAt])
                    ->groupBy('ad_id'),
                'clk', 'clk.ad_id', '=', 'ads.id'
            )
            ->select('ads.id','ads.title','ads.type','ads.status', DB::raw('COALESCE(impr.impressions,0) as impressions'), DB::raw('COALESCE(clk.clicks,0) as clicks'))
            ->orderBy('ads.id')
            ->get();

        $filename = 'ad_report_'.$startAt->toDateString().'_to_'.$endAt->toDateString().'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        return response()->stream(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Ad ID','Title','Type','Status','Impressions','Clicks','CTR %']);
            foreach ($rows as $r) {
                $ctr = $r->impressions ? round(($r->clicks / max(1,$r->impressions))*100, 2) : 0;
                fputcsv($out, [$r->id, $r->title, $r->type, $r->status, $r->impressions, $r->clicks, $ctr]);
            }
            fclose($out);
        }, 200, $headers);
    }

    private function parseDateOrDefault($value, \Carbon\Carbon $default): \Carbon\Carbon
    {
        if (!$value) {
            return $default->copy();
        }
        $formats = ['Y-m-d', 'm/d/Y', 'd/m/Y'];
        foreach ($formats as $fmt) {
            try {
                return \Carbon\Carbon::createFromFormat($fmt, $value);
            } catch (\Throwable $e) {
                // try next
            }
        }
        // Final fallback
        try {
            return \Carbon\Carbon::parse($value);
        } catch (\Throwable $e) {
            return $default->copy();
        }
    }
}
