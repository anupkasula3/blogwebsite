@extends('admin.layouts.app')

@section('title', 'Ads')
@section('header', 'Ads')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <div>
        <a href="{{ route('admin.ads.create') }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">New Ad</a>
    </div>
</div>
<div class="bg-white border rounded overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($ads as $ad)
                <tr>
                    <td class="px-4 py-2">{{ $ad->title }}</td>
                    <td class="px-4 py-2">{{ ucfirst($ad->type) }}</td>
                    <td class="px-4 py-2">{{ ucfirst($ad->status) }}</td>
                    <td class="px-4 py-2">
                        @if($ad->isCurrentlyActive())
                            <span class="inline-block px-2 py-1 text-xs bg-green-50 text-green-700 rounded">Active</span>
                        @else
                            <span class="inline-block px-2 py-1 text-xs bg-gray-50 text-gray-700 rounded">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-gray-500 text-sm">{{ $ad->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('admin.ads.edit', $ad) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <a href="{{ route('admin.ads.embed', $ad) }}" class="text-teal-600 hover:underline">Embed</a>
                        <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="inline" onsubmit="return confirm('Delete this ad?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No ads yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $ads->links() }}</div>
@endsection
