@extends('admin.layouts.app')

@section('title', 'Edit Post - Admin')
@section('page-title', 'Edit Post')

@section('content')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Edit Post: {{ $post->title }}</h2>
                <a href="{{ route('admin.posts.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Post Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Enter post title">
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-lightbulb mr-1"></i>
                            Use a compelling title that includes your target keyword for better SEO
                        </p>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            URL Slug
                        </label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="post-url-slug">
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-link mr-1"></i>
                            URL-friendly version of the title. Leave empty to auto-generate from title
                        </p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                            Excerpt
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Brief summary of the post">{{ old('excerpt', $post->excerpt) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-align-left mr-1"></i>
                            Short description that appears in post previews and search results (150-160 characters
                            recommended)
                        </p>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="15" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Write your post content here...">{{ old('content', $post->content) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-edit mr-1"></i>
                            Use clear headings, bullet points, and images to make your content engaging and scannable
                        </p>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                            Tags
                        </label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags', $post->tags) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="tag1, tag2, tag3">
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-tags mr-1"></i>
                            Comma-separated keywords that help categorize and find your post
                        </p>
                        @error('tags')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Publish Settings</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    <option value="draft"
                                        {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published"
                                        {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published
                                    </option>
                                    <option value="archived"
                                        {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archived
                                    </option>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-eye mr-1"></i>
                                    Draft: Only you can see it. Published: Visible to everyone
                                </p>
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" id="category_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-folder mr-1"></i>
                                    Choose the most relevant category for better organization
                                </p>
                            </div>

                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                    Publish Date
                                </label>
                                <input type="datetime-local" name="published_at" id="published_at"
                                    value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i>
                                    Schedule when this post should be published (leave empty for immediate)
                                </p>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                    {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                    Featured Post
                                </label>
                            </div>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-star mr-1"></i>
                                Featured posts appear prominently on the homepage
                            </p>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h3>

                        @if ($post->featured_image)
                            <div class="mb-4">
                                <img src="{{ asset('/uploads/' . $post->featured_image) }}" alt="Current featured image"
                                    class="oldimage w-24 object-cover rounded-lg">
                            </div>
                            <img id="output" style="width: 70px; margin-bottom: 2px;" />
                        @endif

                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload New Image
                            </label>
                            <input type="file" name="featured_image" id="featured_image" onchange="loadFile(event)"
                                accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">


                            <p class="mt-1 text-sm text-gray-500">
                                <i class="fas fa-image mr-1"></i>
                                Recommended size: 1200x630px for optimal display across all devices
                            </p>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Meta Title
                                </label>
                                <input type="text" name="meta_title" id="meta_title"
                                    value="{{ old('meta_title', $post->meta_title) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="SEO title for search engines">
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-search mr-1"></i>
                                    Title shown in search results (50-60 characters recommended)
                                </p>
                            </div>

                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Meta Description
                                </label>
                                <textarea name="meta_description" id="meta_description" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Brief description for search engines">{{ old('meta_description', $post->meta_description) }}</textarea>
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Description shown in search results (150-160 characters recommended)
                                </p>
                            </div>

                            <div>
                                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                                    Meta Keywords
                                </label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                    value="{{ old('meta_keywords', $post->meta_keywords) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="keyword1, keyword2, keyword3">
                                <p class="mt-1 text-sm text-gray-500">
                                    <i class="fas fa-key mr-1"></i>
                                    Comma-separated keywords for search engine optimization
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <button type="submit" name="action" value="update"
                        class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Update Post
                    </button>
                    <button type="submit" name="action" value="update_and_publish"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-check mr-2"></i>
                        Update & Publish
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.posts.show', $post) }}"
                        class="text-blue-600 hover:text-blue-700 font-medium">
                        <i class="fas fa-eye mr-1"></i>
                        Preview
                    </a>
                    <button type="button" class="text-red-600 hover:text-red-700 font-medium delete-post-btn">
                        <i class="fas fa-trash mr-1"></i>
                        Delete
                    </button>
                </div>
            </div>
        </form>

        <!-- Delete Confirmation Modal -->
        <div x-data="{ open: false, form: null }" x-init="document.querySelector('.delete-post-btn')?.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = document.getElementById('delete-form');
        });" x-show="open" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Post</h2>
                <p class="mb-6 text-gray-700">Are you sure you want to delete this post? This action cannot be undone.</p>
                <div class="flex justify-end gap-3">
                    <button @click="open = false"
                        class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
                    <button @click="form.submit(); open = false"
                        class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
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
