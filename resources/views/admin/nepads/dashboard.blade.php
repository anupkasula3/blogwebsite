@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">Total Ads</div>
        <div class="text-3xl font-bold">{{ \App\Models\Ad::count() }}</div>
    </div>
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">Placements</div>
        <div class="text-3xl font-bold">{{ \App\Models\AdPlacement::count() }}</div>
    </div>
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">Impressions (24h)</div>
        <div class="text-3xl font-bold">{{ \App\Models\AdImpression::where('occurred_at', '>=', now()->subDay())->count() }}</div>
    </div>
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">Clicks (24h)</div>
        <div class="text-3xl font-bold">{{ \App\Models\AdClick::where('occurred_at', '>=', now()->subDay())->count() }}</div>
    </div>
</div>

@php
    $ads = \App\Models\Ad::latest()->take(10)->get();
@endphp

<div class="mt-8 bg-white rounded border overflow-hidden">
    <div class="p-4 border-b font-semibold">Ad Performance (Top 10 Recent)</div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ad</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Impr</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Clicks</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">CTR</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Impr (24h)</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Clicks (24h)</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">CTR (24h)</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($ads as $ad)
                    @php
                        $impr = \App\Models\AdImpression::where('ad_id', $ad->id)->count();
                        $clk = \App\Models\AdClick::where('ad_id', $ad->id)->count();
                        $impr24 = \App\Models\AdImpression::where('ad_id', $ad->id)->where('occurred_at', '>=', now()->subDay())->count();
                        $clk24 = \App\Models\AdClick::where('ad_id', $ad->id)->where('occurred_at', '>=', now()->subDay())->count();
                        $ctr = $impr ? round(($clk / max(1,$impr)) * 100, 2) : 0;
                        $ctr24 = $impr24 ? round(($clk24 / max(1,$impr24)) * 100, 2) : 0;
                    @endphp
                    <tr>
                        <td class="px-4 py-2">
                            <div class="font-medium">{{ $ad->title }}</div>
                            <div class="text-xs text-gray-500">Type: {{ $ad->type }}, Status: {{ $ad->status }}</div>
                        </td>
                        <td class="px-4 py-2">{{ $impr }}</td>
                        <td class="px-4 py-2">{{ $clk }}</td>
                        <td class="px-4 py-2">{{ $ctr }}%</td>
                        <td class="px-4 py-2">{{ $impr24 }}</td>
                        <td class="px-4 py-2">{{ $clk24 }}</td>
                        <td class="px-4 py-2">{{ $ctr24 }}%</td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('admin.ads.edit', $ad) }}" class="text-indigo-600 hover:underline">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">No ads to display.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
