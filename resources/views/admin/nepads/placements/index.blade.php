@extends('admin.layouts.app')

@section('title', 'Placements')
@section('header', 'Placements')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.placements.create') }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">New Placement</a>
</div>
<div class="bg-white border rounded overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Key</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Auto</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($placements as $pl)
                <tr>
                    <td class="px-4 py-2">{{ $pl->name }}</td>
                    <td class="px-4 py-2">{{ $pl->key }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $pl->width ?? 'auto' }} x {{ $pl->height ?? 'auto' }}</td>
                    <td class="px-4 py-2">@if($pl->is_auto)<span class="px-2 py-1 text-xs bg-green-50 text-green-700 rounded">Auto</span>@else<span class="px-2 py-1 text-xs bg-gray-50 text-gray-700 rounded">Manual</span>@endif</td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('admin.placements.edit', $pl) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.placements.destroy', $pl) }}" method="POST" class="inline" onsubmit="return confirm('Delete placement?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">No placements yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $placements->links() }}</div>
@endsection
