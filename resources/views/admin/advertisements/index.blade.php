@extends('admin.layouts.app')

@section('title', 'Manage Advertisements - Admin')
@section('page-title', 'Manage Advertisements')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-8">
    <div class="flex items-center justify-between mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-900">All Advertisements</h2>
        <a href="{{ route('admin.advertisements.create') }}"
           class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg shadow hover:shadow-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
            <i class="fas fa-plus mr-2"></i>
            Create Advertisement
        </a>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Advertisement</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Position</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Performance</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($advertisements as $ad)
                <tr class="hover:bg-purple-50 even:bg-gray-50 transition-all">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                        @if($ad->image)
                        <img class="h-10 w-10 rounded-lg object-cover border" src="{{ asset('uploads/' . $ad->image) }}" alt="{{ $ad->title }}">
                        @else
                        <div class="h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-ad text-gray-400"></i>
                        </div>
                        @endif
                        <div>
                            <div class="text-base font-semibold text-gray-900">{{ $ad->title }}</div>
                            <div class="text-xs text-gray-500">{{ Str::limit($ad->description, 40) }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($ad->position) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($ad->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i> Active
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-1"></i> Inactive
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mr-1">
                            {{ number_format($ad->impressions_count) }} views
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ number_format($ad->clicks_count) }} clicks
                        </span>
                        @if($ad->impressions_count > 0)
                        <div class="text-xs text-gray-500 mt-1">
                            CTR: {{ number_format(($ad->clicks_count / $ad->impressions_count) * 100, 2) }}%
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $ad->created_at->format('M j, Y') }}</td>
                    <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                        <a href="{{ route('admin.advertisements.show', $ad) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 rounded p-2 transition" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.advertisements.edit', $ad) }}" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 rounded p-2 transition" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.advertisements.destroy', $ad) }}" class="inline delete-ad-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-600 hover:text-red-800 bg-red-50 rounded p-2 transition delete-ad-btn" title="Delete" data-ad-title="{{ $ad->title }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-white">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-ad text-4xl mb-4 text-gray-300"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No advertisements found</h3>
                            <p class="text-gray-600">Get started by creating your first advertisement.</p>
                            <a href="{{ route('admin.advertisements.create') }}"
                               class="mt-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                                Create Advertisement
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($advertisements->hasPages())
    <div class="pt-6">
        {{ $advertisements->links() }}
    </div>
    @endif
</div>

<!-- Statistics Summary -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-ad text-purple-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Ads</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $advertisements->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-play text-green-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Active Ads</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $advertisements->where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-blue-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Impressions</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($advertisements->sum('impressions_count')) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-mouse-pointer text-yellow-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Clicks</p>
                <p class="text-2xl font-semibold text-gray-900">{{ number_format($advertisements->sum('clicks_count')) }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div x-data="{ open: false, form: null, ad: '' }" x-init="
    document.querySelectorAll('.delete-ad-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = btn.closest('form');
            $data.ad = btn.getAttribute('data-ad-title');
        });
    });
" x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Advertisement</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete the advertisement <span class="font-semibold text-red-600" x-text="ad"></span>? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button @click="open = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
            <button @click="form.submit(); open = false" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection
