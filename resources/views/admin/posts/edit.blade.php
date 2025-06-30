@extends('admin.layouts.app')

@section('title', 'Edit Post - Admin')
@section('page-title', 'Edit Post')

@section('content')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Edit Post: {{ $post->title }}</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="p-6" id="postForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-lightbulb mr-1"></i>Use a compelling title that includes your target keyword for better SEO</p>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="Enter post title" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-align-left mr-1"></i>Short description for post previews and search results (150-160 characters recommended)</p>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                            placeholder="Brief description of the post">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-edit mr-1"></i>Use clear headings, bullet points, and images to make your content engaging and scannable</p>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                        <textarea name="content" id="content" rows="15" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Write your post content here...">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Featured Image -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-image mr-1"></i>Recommended size: 1200x630px for optimal display across all devices</p>
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                        @if ($post->featured_image)
                            <div class="mb-4">
                                <img src="{{ asset('/uploads/' . $post->featured_image) }}" alt="Current featured image"
                                    class="oldimage w-24 object-cover rounded-lg">
                            </div>
                        @endif
                        <input type="file" name="featured_image" onchange="loadFile(event)" id="featured_image"
                            accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                        <img id="output" style="width: 70px; margin-bottom: 2px;" />
                        @error('featured_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-folder mr-1"></i>Choose the most relevant category for better organization</p>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" id="category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('category_id') border-red-500 @enderror">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-eye mr-1"></i>Draft: Only you can see it. Published: Visible to everyone</p>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="is_published" value="1"
                                    {{ old('is_published', $post->status === 'published' ? '1' : '0') == '1' ? 'checked' : '' }}
                                    class="text-purple-600 focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-700">Published</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="is_published" value="0"
                                    {{ old('is_published', $post->status === 'draft' ? '0' : '') == '0' ? 'checked' : '' }}
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
                                {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
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
                        <p class="mb-1 text-xs text-gray-500 flex items-center"><i class="fas fa-search mr-1"></i>Fill these fields for better search engine visibility</p>
                        <div class="space-y-3">
                            <div>
                                <label for="meta_title" class="block text-xs font-medium text-gray-600 mb-1">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-transparent @error('meta_title') border-red-500 @enderror"
                                    placeholder="SEO title">
                                @error('meta_title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="meta_description" class="block text-xs font-medium text-gray-600 mb-1">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="2"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-transparent @error('meta_description') border-red-500 @enderror"
                                    placeholder="SEO description">{{ old('meta_description', $post->meta_description) }}</textarea>
                                @error('meta_description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="meta_keywords" class="block text-xs font-medium text-gray-600 mb-1">Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}"
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
                            <button type="submit" name="action" value="update"
                                class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update Post
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

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            // Auto-generate slug from title
            document.getElementById('title').addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                document.getElementById('slug').value = slug;
            });

            // Character counter for excerpt
            document.getElementById('excerpt').addEventListener('input', function() {
                const maxLength = 160;
                const currentLength = this.value.length;
                const remaining = maxLength - currentLength;

                if (remaining < 0) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#d1d5db';
                }
            });
        </script>
    @endpush
@endsection
