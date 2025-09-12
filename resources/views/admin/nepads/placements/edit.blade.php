@extends('admin.layouts.app')

@section('title', 'Edit Placement')
@section('header', 'Edit Placement')

@section('content')
<form action="{{ route('admin.placements.update', $placement) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="bg-white p-6 border border-gray-100 rounded-2xl shadow-sm space-y-4 max-w-xl">
        <h3 class="text-sm font-semibold text-gray-900">Placement Details</h3>
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input name="name" value="{{ old('name', $placement->name) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" required />
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Key (identifier)</label>
            <input name="key" value="{{ old('key', $placement->key) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" required />
            @error('key')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Width</label>
                <input type="number" name="width" value="{{ old('width', $placement->width) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Height</label>
                <input type="number" name="height" value="{{ old('height', $placement->height) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
            </div>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_auto" value="1" class="mr-2 rounded border-gray-300" @checked(old('is_auto', $placement->is_auto)) />
                <span class="text-sm text-gray-700">Automatic rendering</span>
            </label>
        </div>
    </div>

    <div class="flex ">
        <a href="{{ route('admin.placements.index') }}" class="px-3 py-2 border border-gray-200 rounded-lg mr-2 hover:bg-gray-50">Cancel</a>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm">Save Changes</button>
    </div>
</form>
@endsection
