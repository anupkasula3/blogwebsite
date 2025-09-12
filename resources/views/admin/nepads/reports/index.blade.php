@extends('admin.layouts.app')

@section('title', 'Reports')
@section('header', 'Reports')

@section('content')
<form method="GET" action="{{ route('admin.reports.index') }}" class="bg-white border border-gray-100 rounded-2xl shadow-sm p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
    <div>
        <label class="block text-sm font-medium text-gray-700">Start date</label>
        <input type="date" name="start" value="{{ request('start', $start) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">End date</label>
        <input type="date" name="end" value="{{ request('end', $end) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
    </div>
    <div class="md:col-span-2 flex gap-2">
        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm">Apply</button>
        <a href="{{ route('admin.reports.export', ['start' => request('start', $start), 'end' => request('end', $end)]) }}" class="px-3 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">Export CSV</a>
    </div>
</form>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-4 border-b font-semibold text-gray-900">Ad Performance ({{ $start }} → {{ $end }})</div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Ad</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Impressions</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Clicks</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">CTR</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($data as $row)
                    @php($ctr = $row->impressions ? round(($row->clicks / max(1,$row->impressions))*100,2) : 0)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $row->title }}</div>
                        </td>
                        <td class="px-4 py-3"><span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 text-xs"><i class="fa-regular fa-file text-gray-400"></i> {{ ucfirst($row->type) }}</span></td>
                        <td class="px-4 py-3"><span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs {{ $row->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}"><i class="fa-regular fa-circle-dot"></i> {{ ucfirst($row->status) }}</span></td>
                        <td class="px-4 py-3">{{ number_format($row->impressions) }}</td>
                        <td class="px-4 py-3">{{ number_format($row->clicks) }}</td>
                        <td class="px-4 py-3">{{ $ctr }}%</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.reports.ad', ['ad' => $row->id, 'start' => request('start', $start), 'end' => request('end', $end)]) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-gray-50"><i class="fa-regular fa-chart-bar"></i> Report</a>
                            <a href="{{ route('admin.reports.ad.pdf', ['ad' => $row->id, 'start' => request('start', $start), 'end' => request('end', $end)]) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-teal-200 text-teal-700 hover:bg-teal-50"><i class="fa-regular fa-file-pdf"></i> PDF</a>
                            <a href="{{ route('admin.ads.edit', $row->id) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-indigo-200 text-indigo-600 hover:bg-indigo-50"><i class="fa-solid fa-pen"></i> Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fa-regular fa-chart-bar text-2xl"></i>
                                <span>No data in this range.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $data->links() }}</div>
</div>
@endsection
