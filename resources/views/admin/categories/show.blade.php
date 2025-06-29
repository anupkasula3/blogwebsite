@extends('admin.layouts.app')

@section('title', 'View Category - Admin')
@section('page-title', 'View Category')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-10 max-w-3xl mx-auto mt-8">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-20 h-20 flex items-center justify-center rounded-lg shadow" style="background: {{ $category->color ?? '#f3f4f6' }};">
            <i class="{{ $category->icon ?? 'fas fa-folder' }} text-3xl text-white"></i>
        </div>
        <div>
            <h2 class="text-3xl font-bold flex items-center gap-2 mb-2">
                {{ $category->name }}
                @if($category->is_featured)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">
                        <i class="fas fa-star mr-1"></i> Featured
                    </span>
                @endif
                @if(!$category->is_active)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-200 text-gray-600 ml-2">
                        Inactive
                    </span>
                @endif
            </h2>
            <div class="flex items-center gap-4 text-sm text-gray-500">
                <span><strong>Slug:</strong> {{ $category->slug }}</span>
                <span><strong>Show in Menu:</strong> {{ $category->show_in_menu ? 'Yes' : 'No' }}</span>
                <span><strong>Created:</strong> {{ $category->created_at->format('Y-m-d') }}</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Description</h4>
            <p class="text-gray-800">{{ $category->description ?: '—' }}</p>
        </div>
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Color</h4>
            <div class="flex items-center gap-2">
                <span class="inline-block w-8 h-8 rounded-full border border-gray-200" style="background: {{ $category->color }};"></span>
                <span class="text-gray-700">{{ $category->color ?: '—' }}</span>
            </div>
        </div>
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Meta Title</h4>
            <p class="text-gray-800">{{ $category->meta_title ?: '—' }}</p>
        </div>
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Meta Description</h4>
            <p class="text-gray-800">{{ $category->meta_description ?: '—' }}</p>
        </div>
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Meta Keywords</h4>
            <p class="text-gray-800">{{ $category->meta_keywords ?: '—' }}</p>
        </div>
    </div>
    <div class="flex gap-4 mt-8">
        <a href="{{ route('admin.categories.edit', $category) }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition-colors flex items-center gap-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-600 text-white px-5 py-2 rounded hover:bg-gray-700 transition-colors flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>
@endsection
