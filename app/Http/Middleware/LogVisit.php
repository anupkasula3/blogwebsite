<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogVisit
{
    public function handle(Request $request, Closure $next)
    {
        // Proceed with the request first to ensure session/user are available
        $response = $next($request);

        // Skip logging for admin routes to avoid polluting analytics
        if ($request->is('admin*')) {
            return $response;
        }

        // Basic bot filter by user-agent (lightweight; for stronger protection, use Cloudflare/WAF)
        $ua = (string) $request->userAgent();
        $isBot = $this->isBot($ua);
        if ($isBot) {
            return $response; // skip logging bots
        }

        // Long-lived first-party visitor cookie (2 years)
        $cookieName = 'visitor_id';
        $visitorId = $request->cookies->get($cookieName);
        if (!$visitorId) {
            $visitorId = (string) Str::uuid();
            // 730 days in minutes
            $minutes = 60 * 24 * 730;
            $response->headers->setCookie(cookie($cookieName, $visitorId, $minutes, null, null, false, false));
        }

        // Session ID from Laravel session
        $sessionId = $request->session()->getId();

        // UTM and GCLID capture
        $utm_source = $request->query('utm_source');
        $utm_medium = $request->query('utm_medium');
        $utm_campaign = $request->query('utm_campaign');
        $utm_term = $request->query('utm_term');
        $utm_content = $request->query('utm_content');
        $gclid = $request->query('gclid');

        $referer = $request->headers->get('referer');
        $landing = $request->fullUrl();
        $ip = $request->ip();
        $userId = optional($request->user())->id;

        // Classify channel with safe defaults
        $classification = array_merge([
            'is_paid' => false,
            'channel' => 'direct',
        ], $this->classifyChannel($utm_source, $utm_medium, $gclid, $referer));

        // Persist visit (avoid duplicate immediate logs by using minimal uniqueness - optional)
        Visit::create([
            'visitor_id' => $visitorId,
            'session_id' => $sessionId,
            'user_id' => $userId,
            'ip_address' => $ip,
            'user_agent' => $ua,
            'referer' => $referer,
            'landing_page' => $landing,
            'source' => $utm_source,
            'medium' => $utm_medium,
            'campaign' => $utm_campaign,
            'term' => $utm_term,
            'content' => $utm_content,
            'gclid' => $gclid,
            'is_paid' => $classification['is_paid'],
            'channel' => $classification['channel'],
        ]);

        return $response;
    }

    private function isBot(string $ua): bool
    {
        if ($ua === '') {
            return true; // empty UA is suspicious
        }
        $patterns = [
            'bot', 'crawl', 'spider', 'slurp', 'mediapartners-google', 'bingpreview', 'facebookexternalhit', 'validator', 'phantomjs', 'selenium', 'headless'
        ];
        $lower = strtolower($ua);
        foreach ($patterns as $p) {
            if (str_contains($lower, $p)) {
                return true;
            }
        }
        return false;
    }

    private function classifyChannel(?string $source, ?string $medium, ?string $gclid, ?string $referer): array
    {
        $isPaid = false;
        $channel = 'direct';

        $m = strtolower((string) $medium);
        $s = strtolower((string) $source);
        $ref = strtolower((string) $referer);

        // Paid indicators
        $paidMediums = ['cpc', 'ppc', 'paid', 'paid_social', 'display', 'ads', 'sem'];
        if ($gclid || in_array($m, $paidMediums, true)) {
            $isPaid = true;
            $channel = str_contains($m, 'social') ? 'paid_social' : 'paid';
            return ['is_paid' => $isPaid, 'channel' => $channel];
        }

        // Organic search
        $searchEngines = ['google.', 'bing.', 'yahoo.', 'duckduckgo.', 'yandex.', 'baidu.'];
        foreach ($searchEngines as $se) {
            if ($ref && str_contains($ref, $se)) {
                $channel = 'organic_search';
                return ['is_paid' => $isPaid, 'channel' => $channel];
            }
        }

        // Social (non-paid)
        $socialDomains = ['facebook.', 'instagram.', 't.co', 'twitter.', 'linkedin.', 'pinterest.', 'reddit.', 'youtube.'];
        foreach ($socialDomains as $sd) {
            if ($ref && str_contains($ref, $sd)) {
                $channel = 'social';
                return ['is_paid' => $isPaid, 'channel' => $channel];
            }
        }

        // Referral
        if ($ref && !$source && !$medium) {
            $channel = 'referral';
            return ['is_paid' => $isPaid, 'channel' => $channel];
        }

        // Direct or UTM-defined
        if ($source || $medium) {
            $channel = $medium ?: 'other';
        } else {
            $channel = 'direct';
        }

        return ['is_paid' => $isPaid, 'channel' => $channel];
    }
}
