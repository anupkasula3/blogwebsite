@extends('admin.layouts.app')

@section('title', 'Visits Report')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Visits Report</h1>
    </div>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-xs text-gray-600 mb-1">Start date</label>
            <input type="date" name="start_date" value="{{ optional($startDate)->format('Y-m-d') }}" class="w-full px-3 py-2 border rounded" />
        </div>
        <div>
            <label class="block text-xs text-gray-600 mb-1">End date</label>
            <input type="date" name="end_date" value="{{ optional($endDate)->format('Y-m-d') }}" class="w-full px-3 py-2 border rounded" />
        </div>
        <div>
            <label class="block text-xs text-gray-600 mb-1">Channel</label>
            <select name="channel" class="w-full px-3 py-2 border rounded">
                @foreach($channelsList as $key => $label)
                    <option value="{{ $key }}" {{ ($channel ?? 'all') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded shadow p-4">
            <div class="text-xs text-gray-500">Total Visits</div>
            <div class="text-2xl font-bold">{{ number_format($totalVisits) }}</div>
        </div>
        <div class="bg-white rounded shadow p-4">
            <div class="text-xs text-gray-500">Unique Visitors</div>
            <div class="text-2xl font-bold">{{ number_format($uniqueVisitors) }}</div>
        </div>
        <div class="bg-white rounded shadow p-4">
            <div class="text-xs text-gray-500">Paid Visits</div>
            <div class="text-2xl font-bold">{{ number_format($paidVisits) }}</div>
        </div>
        <div class="bg-white rounded shadow p-4">
            <div class="text-xs text-gray-500">Organic Visits</div>
            <div class="text-2xl font-bold">{{ number_format($organicVisits) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded shadow p-4">
            <h2 class="font-semibold mb-3">By Channel</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="py-2 pr-4">Channel</th>
                            <th class="py-2 pr-4">Visits</th>
                            <th class="py-2 pr-4">Unique Visitors</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($byChannel as $row)
                            <tr class="border-b">
                                <td class="py-2 pr-4">{{ $row->channel ?? 'unknown' }}</td>
                                <td class="py-2 pr-4">{{ number_format($row->visits) }}</td>
                                <td class="py-2 pr-4">{{ number_format($row->unique_visitors) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-3 text-gray-500">No data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded shadow p-4">
            <h2 class="font-semibold mb-3">Daily</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="py-2 pr-4">Date</th>
                            <th class="py-2 pr-4">Visits</th>
                            <th class="py-2 pr-4">Unique Visitors</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daily as $row)
                            <tr class="border-b">
                                <td class="py-2 pr-4">{{ $row->d }}</td>
                                <td class="py-2 pr-4">{{ number_format($row->visits) }}</td>
                                <td class="py-2 pr-4">{{ number_format($row->unique_visitors) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-3 text-gray-500">No data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow p-4">
        <h2 class="font-semibold mb-3">Top Campaigns</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-600 border-b">
                        <th class="py-2 pr-4">Source</th>
                        <th class="py-2 pr-4">Medium</th>
                        <th class="py-2 pr-4">Campaign</th>
                        <th class="py-2 pr-4">Visits</th>
                        <th class="py-2 pr-4">Unique Visitors</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $row)
                        <tr class="border-b">
                            <td class="py-2 pr-4">{{ $row->source ?? '-' }}</td>
                            <td class="py-2 pr-4">{{ $row->medium ?? '-' }}</td>
                            <td class="py-2 pr-4">{{ $row->campaign ?? '-' }}</td>
                            <td class="py-2 pr-4">{{ number_format($row->visits) }}</td>
                            <td class="py-2 pr-4">{{ number_format($row->unique_visitors) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-3 text-gray-500">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
