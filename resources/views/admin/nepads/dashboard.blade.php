@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                <i class="fa-solid fa-rectangle-ad"></i>
            </span>
            <div>
                <div class="text-xs uppercase tracking-wide text-gray-500">Total Ads</div>
                <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ \App\Models\Ad::count() }}</div>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                <i class="fa-solid fa-layer-group"></i>
            </span>
            <div>
                <div class="text-xs uppercase tracking-wide text-gray-500">Placements</div>
                <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ \App\Models\AdPlacement::count() }}</div>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                <i class="fa-regular fa-eye"></i>
            </span>
            <div>
                <div class="text-xs uppercase tracking-wide text-gray-500">Impressions (24h)</div>
                <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ \App\Models\AdImpression::where('occurred_at', '>=', now()->subDay())->count() }}</div>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                <i class="fa-regular fa-hand-pointer"></i>
            </span>
            <div>
                <div class="text-xs uppercase tracking-wide text-gray-500">Clicks (24h)</div>
                <div class="mt-1 text-3xl font-extrabold text-gray-900">{{ \App\Models\AdClick::where('occurred_at', '>=', now()->subDay())->count() }}</div>
            </div>
        </div>
    </div>
</div>

@php
    $ads = \App\Models\Ad::latest()->take(10)->get();
@endphp

<div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-4 border-b flex items-center justify-between">
        <span class="font-semibold text-gray-900">Ad Performance (Top 10 Recent)</span>
        <a href="{{ route('admin.ads.index') }}" class="text-sm inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700">
            <i class="fa-solid fa-arrow-right"></i> View all
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Ad</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Impr</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Clicks</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">CTR</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Impr (24h)</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Clicks (24h)</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">CTR (24h)</th>
                    <th class="px-4 py-3"></th>
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
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $ad->title }}</div>
                            <div class="text-xs text-gray-500 flex items-center gap-2 mt-0.5">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-100 text-gray-700">
                                    <i class="fa-regular fa-file text-gray-400"></i> {{ ucfirst($ad->type) }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full {{ $ad->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    <i class="fa-regular fa-circle-dot"></i> {{ ucfirst($ad->status) }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-900">{{ $impr }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $clk }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $ctr }}%</td>
                        <td class="px-4 py-3 text-gray-900">{{ $impr24 }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $clk24 }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $ctr24 }}%</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.ads.edit', $ad) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-indigo-200 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition">
                                <i class="fa-solid fa-pen"></i> Manage
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fa-regular fa-face-meh text-2xl"></i>
                                <span>No ads to display.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
