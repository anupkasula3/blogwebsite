@extends('admin.layouts.app')

@section('title', 'Create Post - Admin')
@section('page-title', 'Create Post')

@section('content')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Create New Post</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>

        {{-- @if ($errors->any())
            <div class="p-6 bg-red-50 border-b border-red-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            There were errors with your submission:
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}

        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="p-6"
            id="postForm">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="Enter post title" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                            placeholder="Brief description of the post">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                        <textarea name="content" id="content" rows="15"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Featured Image -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured
                            Image</label>
                        <input type="file" name="featured_image" onchange="loadFile(event)" id="featured_image"
                            accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                        <img id="output" style="width: 70px; margin-bottom: 2px;" />
                        <p class="text-sm text-gray-500 mt-1">Recommended size: 1200x630px</p>
                        @error('featured_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('category_id') border-red-500 @enderror"
                            required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="is_published" value="1"
                                    {{ old('is_published', '1') == '1' ? 'checked' : '' }}
                                    class="text-purple-600 focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-700">Published</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="is_published" value="0"
                                    {{ old('is_published') == '0' ? 'checked' : '' }}
                                    class="text-purple-600 focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-700">Draft</span>
                            </label>
                        </div>
                        @error('is_published')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }}
                                class="text-purple-600 focus:ring-purple-500 rounded">
                            <span class="ml-2 text-sm font-medium text-gray-700">Featured Post</span>
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Featured posts appear on the homepage</p>
                        @error('is_featured')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Fields -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">SEO Settings</h3>

                        <div class="space-y-3">
                            <div>
                                <label for="meta_title" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                    Title</label>
                                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-transparent @error('meta_title') border-red-500 @enderror"
                                    placeholder="SEO title">
                                @error('meta_title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="meta_description" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                    Description</label>
                                <textarea name="meta_description" id="meta_description" rows="2"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-transparent @error('meta_description') border-red-500 @enderror"
                                    placeholder="SEO description">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="meta_keywords" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                    Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                    value="{{ old('meta_keywords') }}"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror"
                                    placeholder="keyword1, keyword2, keyword3">
                                @error('meta_keywords')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex space-x-3">
                            <button type="submit" id="submitBtn"
                                class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Create Post
                            </button>
                            <a href="{{ route('admin.posts.index') }}"
                                class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors text-center">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection
