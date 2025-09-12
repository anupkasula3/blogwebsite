@extends('admin.layouts.app')

    @section('title', 'Ads')
    @section('header', 'Ads')

    @section('content')
<div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div class="text-sm text-gray-600">Manage all your ads. Create, edit, embed, and track performance.</div>
    <div>
        <a href="{{ route('admin.ads.create') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm">
            <i class="fa-solid fa-plus"></i> New Ad
        </a>
    </div>
</div>
<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Title</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Type</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Active</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Created</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($ads as $ad)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $ad->title }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 text-xs">
                            <i class="fa-regular fa-file text-gray-400"></i> {{ ucfirst($ad->type) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs {{ $ad->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            <i class="fa-regular fa-circle-dot"></i> {{ ucfirst($ad->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($ad->isCurrentlyActive())
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs bg-green-50 text-green-700 rounded-full"><i class="fa-solid fa-circle text-[8px]"></i> Active</span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs bg-gray-50 text-gray-700 rounded-full"><i class="fa-regular fa-circle text-[8px]"></i> Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-sm">{{ $ad->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.ads.edit', $ad) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-indigo-200 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="{{ route('admin.ads.embed', $ad) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-teal-200 text-teal-600 hover:bg-teal-50 hover:border-teal-300 transition"><i class="fa-solid fa-code"></i> Embed</a>
                        <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="inline" onsubmit="return confirm('Delete this ad?')">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition"><i class="fa-regular fa-trash-can"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center gap-2">
                            <i class="fa-regular fa-rectangle-ad text-2xl"></i>
                            <span>No ads yet.</span>
                            <a href="{{ route('admin.ads.create') }}" class="inline-flex items-center gap-2 px-3 py-2 mt-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"><i class="fa-solid fa-plus"></i> Create your first ad</a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $ads->links() }}</div>
    @endsection
