@extends('admin.layouts.app')

@section('title', 'New Placement')
@section('header', 'New Placement')

@section('content')
<form action="{{ route('admin.placements.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="bg-white p-4 border rounded space-y-4 max-w-xl">
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input name="name" value="{{ old('name') }}" class="mt-1 w-full border rounded px-3 py-2" required />
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Key (identifier)</label>
            <input name="key" value="{{ old('key') }}" class="mt-1 w-full border rounded px-3 py-2" required />
            @error('key')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Width</label>
                <input type="number" name="width" value="{{ old('width') }}" class="mt-1 w-full border rounded px-3 py-2" />
            </div>
            <div>
                <label class="block text-sm font-medium">Height</label>
                <input type="number" name="height" value="{{ old('height') }}" class="mt-1 w-full border rounded px-3 py-2" />
            </div>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_auto" value="1" class="mr-2" @checked(old('is_auto', true)) />
                Automatic rendering
            </label>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.placements.index') }}" class="px-3 py-2 border rounded mr-2">Cancel</a>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded">Create Placement</button>
    </div>
</form>
@endsection
