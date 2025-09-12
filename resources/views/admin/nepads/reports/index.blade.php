@extends('admin.layouts.app')

@section('title', 'Reports')
@section('header', 'Reports')

@section('content')
<form method="GET" action="{{ route('admin.reports.index') }}" class="bg-white border rounded p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
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
        <a href="{{ route('admin.reports.export', ['start' => request('start', $start), 'end' => request('end', $end)]) }}" class="px-3 py-2 border rounded">Export CSV</a>
    </div>
</form>

<div class="bg-white rounded border overflow-hidden">
    <div class="p-4 border-b font-semibold">Ad Performance ({{ $start }} → {{ $end }})</div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ad</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Impressions</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Clicks</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">CTR</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($data as $row)
                    @php($ctr = $row->impressions ? round(($row->clicks / max(1,$row->impressions))*100,2) : 0)
                    <tr>
                        <td class="px-4 py-2">
                            <div class="font-medium">{{ $row->title }}</div>
                        </td>
                        <td class="px-4 py-2">{{ ucfirst($row->type) }}</td>
                        <td class="px-4 py-2">{{ ucfirst($row->status) }}</td>
                        <td class="px-4 py-2">{{ number_format($row->impressions) }}</td>
                        <td class="px-4 py-2">{{ number_format($row->clicks) }}</td>
                        <td class="px-4 py-2">{{ $ctr }}%</td>
                        <td class="px-4 py-2 text-right space-x-3">
                            <a href="{{ route('admin.reports.ad', ['ad' => $row->id, 'start' => request('start', $start), 'end' => request('end', $end)]) }}" class="text-slate-700 hover:underline">Report</a>
                            <a href="{{ route('admin.reports.ad.pdf', ['ad' => $row->id, 'start' => request('start', $start), 'end' => request('end', $end)]) }}" class="text-teal-700 hover:underline">PDF</a>
                            <a href="{{ route('admin.ads.edit', $row->id) }}" class="text-indigo-600 hover:underline">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">No data in this range.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $data->links() }}</div>
</div>
@endsection
