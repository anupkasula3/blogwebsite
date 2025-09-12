@extends('admin.layouts.app')

@section('title', 'New Ad')
@section('header', 'New Ad')

@section('content')
<form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-4 border rounded space-y-4">
            <div>
                <label class="block text-sm font-medium">Title</label>
                <input name="title" value="{{ old('title') }}" class="mt-1 w-full border rounded px-3 py-2" required />
                @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Type</label>
                <select name="type" class="mt-1 w-full border rounded px-3 py-2">
                    <option value="image" @selected(old('type')==='image')>Image</option>
                    <option value="html" @selected(old('type')==='html')>HTML/Script</option>
                </select>
                @error('type')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="mt-1 w-full border rounded px-3 py-2">
                    <option value="draft" @selected(old('status')==='draft')>Draft</option>
                    <option value="active" @selected(old('status')==='active')>Active</option>
                    <option value="paused" @selected(old('status')==='paused')>Paused</option>
                    <option value="archived" @selected(old('status')==='archived')>Archived</option>
                </select>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" class="mr-2" @checked(old('is_active')) />
                    Active Now
                </label>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Start At</label>
                    <input type="datetime-local" name="start_at" value="{{ old('start_at') }}" class="mt-1 w-full border rounded px-3 py-2" />
                </div>
                <div>
                    <label class="block text-sm font-medium">End At</label>
                    <input type="datetime-local" name="end_at" value="{{ old('end_at') }}" class="mt-1 w-full border rounded px-3 py-2" />
                </div>
            </div>
        </div>
        <div class="bg-white p-4 border rounded space-y-4">
            <div data-type="image">
                <label class="block text-sm font-medium">Image</label>
                <input type="file" name="image" accept="image/*" class="mt-1 w-full border rounded px-3 py-2" />
                @error('image')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Destination URL (for image ad)</label>
                <input name="destination_url" value="{{ old('destination_url') }}" class="mt-1 w-full border rounded px-3 py-2" />
                @error('destination_url')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div data-type="html">
                <label class="block text-sm font-medium">HTML/Script</label>
                <textarea name="html_code" rows="8" class="mt-1 w-full border rounded px-3 py-2">{{ old('html_code') }}</textarea>
                @error('html_code')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="bg-white p-4 border rounded">
        <div class="font-medium mb-2">Placements & Weights</div>
        <div class="space-y-2">
            @foreach(\App\Models\AdPlacement::orderBy('name')->get() as $pl)
                <div class="flex items-center space-x-3">
                    <label class="inline-flex items-center w-64">
                        <input type="checkbox" name="placements[{{ $pl->id }}][id]" value="{{ $pl->id }}" class="mr-2">
                        <span>{{ $pl->name }} ({{ $pl->key }})</span>
                    </label>
                    <input type="number" min="1" name="placements[{{ $pl->id }}][weight]" value="1" class="w-24 border rounded px-2 py-1" />
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('admin.ads.index') }}" class="px-3 py-2 border rounded mr-2">Cancel</a>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded">Create Ad</button>
    </div>
</form>
@endsection
