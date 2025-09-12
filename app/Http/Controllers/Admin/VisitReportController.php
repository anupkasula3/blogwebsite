<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->query('start_date');
        $end = $request->query('end_date');
        $channel = $request->query('channel');

        // Defaults: last 14 days
        $startDate = $start ? Carbon::parse($start)->startOfDay() : now()->subDays(13)->startOfDay();
        $endDate = $end ? Carbon::parse($end)->endOfDay() : now()->endOfDay();

        $baseQuery = Visit::query()
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($channel && $channel !== 'all') {
            $baseQuery->where('channel', $channel);
        }

        // Totals
        $totalVisits = (clone $baseQuery)->count();
        $uniqueVisitors = (clone $baseQuery)->distinct('visitor_id')->count('visitor_id');
        $paidVisits = (clone $baseQuery)->where('is_paid', true)->count();
        $organicVisits = (clone $baseQuery)->where('channel', 'organic_search')->count();

        // By channel breakdown
        $byChannel = (clone $baseQuery)
            ->select('channel', DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT visitor_id) as unique_visitors'))
            ->groupBy('channel')
            ->orderByDesc('visits')
            ->get();

        // Daily series
        $daily = (clone $baseQuery)
            ->select(DB::raw("DATE(created_at) as d"), DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT visitor_id) as unique_visitors'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('d')
            ->get();

        // Top campaigns
        $campaigns = (clone $baseQuery)
            ->select('source', 'medium', 'campaign', DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT visitor_id) as unique_visitors'))
            ->groupBy('source', 'medium', 'campaign')
            ->orderByDesc('visits')
            ->limit(10)
            ->get();

        $channelsList = [
            'all' => 'All',
            'paid' => 'Paid (any)',
            'paid_social' => 'Paid Social',
            'organic_search' => 'Organic Search',
            'social' => 'Social',
            'referral' => 'Referral',
            'direct' => 'Direct',
            'other' => 'Other',
        ];

        return view('admin.visits.index', compact(
            'startDate', 'endDate', 'channel', 'totalVisits', 'uniqueVisitors', 'paidVisits', 'organicVisits', 'byChannel', 'daily', 'campaigns', 'channelsList'
        ));
    }
}
