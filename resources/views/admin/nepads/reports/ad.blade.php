@extends('admin.layouts.app')

@section('title', 'Ad Report')
@section('header', 'Ad Report: '.$ad->title)

@section('content')
<form method="GET" action="{{ route('admin.reports.ad', $ad->id) }}" class="bg-white border rounded p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
    <input type="hidden" name="ad" value="{{ $ad->id }}">
    <div>
        <label class="block text-sm font-medium">Start date</label>
        <input type="date" name="start" value="{{ request('start', $start) }}" class="mt-1 w-full border rounded px-3 py-2" />
    </div>
    <div>
        <label class="block text-sm font-medium">End date</label>
        <input type="date" name="end" value="{{ request('end', $end) }}" class="mt-1 w-full border rounded px-3 py-2" />
    </div>
    <div class="md:col-span-2 flex gap-2">
        <button class="px-3 py-2 bg-indigo-600 text-white rounded">Apply</button>
        <a href="{{ route('admin.reports.ad.pdf', ['ad' => $ad->id, 'start' => request('start', $start), 'end' => request('end', $end)]) }}" class="px-3 py-2 border rounded">Download PDF</a>
    </div>
</form>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">Impressions</div>
        <div class="text-3xl font-bold">{{ number_format($impressions) }}</div>
    </div>
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">Clicks</div>
        <div class="text-3xl font-bold">{{ number_format($clicks) }}</div>
    </div>
    <div class="bg-white p-4 rounded border">
        <div class="text-sm text-gray-500">CTR</div>
        <div class="text-3xl font-bold">{{ number_format($ctr, 2) }}%</div>
    </div>
</div>

<div class="bg-white rounded border overflow-hidden">
    <div class="p-4 border-b font-semibold">Breakdown by Placement ({{ $start }} → {{ $end }})</div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Placement</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Impressions</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Clicks</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">CTR</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($placements as $p)
                    <tr>
                        <td class="px-4 py-2">{{ $p['name'] }}</td>
                        <td class="px-4 py-2">{{ number_format($p['impressions']) }}</td>
                        <td class="px-4 py-2">{{ number_format($p['clicks']) }}</td>
                        <td class="px-4 py-2">{{ number_format($p['ctr'], 2) }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">No data for this range.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
