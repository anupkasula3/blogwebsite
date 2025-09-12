<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdClick;
use App\Models\AdImpression;
use App\Models\AdPlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class AdServeController extends Controller
{
    public function renderPlacement(Request $request, string $placementKey)
    {
        $placement = AdPlacement::where('key', $placementKey)->firstOrFail();

        $candidates = $placement->ads()->wherePivot('is_active', true)->get()->filter(function (Ad $ad) {
            return $ad->isCurrentlyActive();
        });

        if ($candidates->isEmpty()) {
            return response('<div class="ad-empty">No ad available</div>', 200)->header('Content-Type', 'text/html');
        }

        // Weighted random selection
        $pool = [];
        foreach ($candidates as $ad) {
            $weight = (int)($ad->pivot->weight ?? 1);
            for ($i = 0; $i < max(1, $weight); $i++) {
                $pool[] = $ad;
            }
        }
        $ad = $pool[array_rand($pool)];

        $html = $this->adHtml($ad, $placement);

        // Record impression
        $this->recordImpression($request, $ad, $placement);

        return response($html, 200)->header('Content-Type', 'text/html');
    }

    public function embedPlacementScript(Request $request, string $placementKey)
    {
        // Allow width/height overrides via query (defaults reasonable)
        $width = $request->query('w', '100%');
        $height = $request->query('h', '160');
        if (is_numeric($width)) { $width = $width.'px'; }
        if (is_numeric($height)) { $height = $height.'px'; }

        $src = route('ads.render', ['placementKey' => $placementKey]);
        $html = '<iframe src="'.e($src).'" style="width:'.e($width).';height:'.e($height).';border:0;overflow:hidden;" loading="lazy" referrerpolicy="no-referrer-when-downgrade" sandbox="allow-scripts allow-forms allow-same-origin allow-popups"></iframe>';
        $js = 'document.write(' . json_encode($html) . ');';
        return response($js, 200)->header('Content-Type', 'application/javascript');
    }

    public function embedByToken(Request $request, string $token)
    {
        $ad = Ad::where('manual_embed_token', $token)->firstOrFail();
        if (!$ad->isCurrentlyActive()) {
            return Response::make('', 204)->header('Content-Type', 'application/javascript');
        }

        // If width/height provided, output an iframe pointing to renderByToken for consistent sizing
        $w = $request->query('w');
        $h = $request->query('h');
        if ($w || $h) {
            $width = $w ?? '100%';
            $height = $h ?? '160';
            if (is_numeric($width)) { $width = $width.'px'; }
            if (is_numeric($height)) { $height = $height.'px'; }
            $src = route('ads.render.token', ['token' => $token]);
            $html = '<iframe src="'.e($src).'" style="width:'.e($width).';height:'.e($height).';border:0;overflow:hidden;" loading="lazy" referrerpolicy="no-referrer-when-downgrade" sandbox="allow-scripts allow-forms allow-same-origin allow-popups"></iframe>';
            $js = 'document.write(' . json_encode($html) . ');';
            return Response::make($js, 200)->header('Content-Type', 'application/javascript');
        }

        // Build HTML and wrap as JS document.write for simple embed (no fixed size)
        $html = $this->adHtml($ad, null);
        $js = 'document.write(' . json_encode($html) . ');';

        // Impression for manual embed (no placement)
        $this->recordImpression($request, $ad, null);

        return Response::make($js, 200)->header('Content-Type', 'application/javascript');
    }

    public function renderByToken(Request $request, string $token)
    {
        $ad = Ad::where('manual_embed_token', $token)->firstOrFail();
        if (!$ad->isCurrentlyActive()) {
            return response('<div class="ad-empty">No ad available</div>', 200)->header('Content-Type', 'text/html');
        }
        $html = $this->adHtml($ad, null);
        $this->recordImpression($request, $ad, null);
        return response($html, 200)->header('Content-Type', 'text/html');
    }

    public function click(Request $request, Ad $ad)
    {
        // Record click
        AdClick::create([
            'ad_id' => $ad->id,
            'ad_placement_id' => $request->integer('placement_id') ?: null,
            'ip' => $request->ip(),
            'user_agent' => substr((string)$request->userAgent(), 0, 1024),
            'referer' => substr((string)$request->headers->get('referer'), 0, 1024),
            'session_id' => substr((string)($request->session()->getId() ?? Str::uuid()->toString()), 0, 100),
            'occurred_at' => now(),
        ]);

        $url = $ad->destination_url ?: url('/');
        return redirect()->away($url);
    }

    public function pixel(Request $request)
    {
        // Transparent 1x1 GIF
        $gif = base64_decode('R0lGODlhAQABAIABAP///wAAACwAAAAAAQABAAACAkQBADs=');
        return response($gif, 200)->header('Content-Type', 'image/gif');
    }

    private function adHtml(Ad $ad, ?AdPlacement $placement): string
    {
        $clickUrl = route('ads.click', ['ad' => $ad->id]) . ($placement ? ('?placement_id=' . $placement->id) : '');
        if ($ad->type === 'image' && $ad->image_path) {
            $img = '<img src="' . e(asset('uploads/' . $ad->image_path)) . '" alt="' . e($ad->title) . '" style="max-width:100%;height:auto;" />';
            if ($ad->destination_url) {
                return '<a href="' . e($clickUrl) . '" target="_blank" rel="noopener nofollow">' . $img . '</a>';
            }
            return $img;
        }
        // HTML ad
        return $ad->html_code ?? '';
    }

    private function recordImpression(Request $request, Ad $ad, ?AdPlacement $placement): void
    {
        AdImpression::create([
            'ad_id' => $ad->id,
            'ad_placement_id' => $placement?->id,
            'ip' => $request->ip(),
            'user_agent' => substr((string)$request->userAgent(), 0, 1024),
            'referer' => substr((string)$request->headers->get('referer'), 0, 1024),
            'session_id' => substr((string)($request->session()->getId() ?? Str::uuid()->toString()), 0, 100),
            'occurred_at' => now(),
        ]);
    }
}
