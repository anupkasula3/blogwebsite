@extends('admin.layouts.app')

    @section('title', 'Placements')
    @section('header', 'Placements')

    @section('content')
<div class="mb-4">
    <a href="{{ route('admin.placements.create') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm"><i class="fa-solid fa-plus"></i> New Placement</a>
</div>
<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Name</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Key</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Size</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Auto</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($placements as $pl)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-900">{{ $pl->name }}</td>
                    <td class="px-4 py-2">{{ $pl->key }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $pl->width ?? 'auto' }} x {{ $pl->height ?? 'auto' }}</td>
                    <td class="px-4 py-2">
                        @if($pl->is_auto)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs bg-green-50 text-green-700 rounded-full"><i class="fa-solid fa-circle text-[8px]"></i> Auto</span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs bg-gray-50 text-gray-700 rounded-full"><i class="fa-regular fa-circle text-[8px]"></i> Manual</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('admin.placements.edit', $pl) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-indigo-200 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition"><i class="fa-solid fa-pen"></i> Edit</a>
                        <form action="{{ route('admin.placements.destroy', $pl) }}" method="POST" class="inline" onsubmit="return confirm('Delete placement?')">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 transition"><i class="fa-regular fa-trash-can"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center gap-2">
                            <i class="fa-solid fa-layer-group text-2xl"></i>
                            <span>No placements yet.</span>
                            <a href="{{ route('admin.placements.create') }}" class="inline-flex items-center gap-2 px-3 py-2 mt-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"><i class="fa-solid fa-plus"></i> Create your first placement</a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $placements->links() }}</div>
@endsection
