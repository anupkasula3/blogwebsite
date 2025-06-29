@extends('admin.layouts.app')

@section('title', 'Edit Category - Admin')
@section('page-title', 'Edit Category')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Edit Category: {{ $category->name }}</h2>
            <a href="{{ route('admin.categories.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Categories
            </a>
        </div>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Main Content -->
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Enter category name">
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-lightbulb mr-1"></i>
                        Choose a clear, descriptive name that helps organize your content
                    </p>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        URL Slug
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="category-url-slug">
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-link mr-1"></i>
                        URL-friendly version of the name. Leave empty to auto-generate from name
                    </p>
                    @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Brief description of this category">{{ old('description', $category->description) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-align-left mr-1"></i>
                        Explain what type of content belongs in this category (helps with SEO)
                    </p>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                        Category Color
                    </label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="color" id="color" value="{{ old('color', $category->color) }}"
                               class="w-16 h-10 border border-gray-300 rounded-lg cursor-pointer">
                        <input type="text" name="color_hex" id="color_hex" value="{{ old('color', $category->color) }}"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                               placeholder="#6B7280">
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-palette mr-1"></i>
                        Choose a color to visually distinguish this category (used in UI elements)
                    </p>
                    @error('color')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Settings -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Category Settings</h3>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                   {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Active Category
                            </label>
                        </div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-toggle-on mr-1"></i>
                            Active categories are visible to users and can contain posts
                        </p>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                   {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                Featured Category
                            </label>
                        </div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-star mr-1"></i>
                            Featured categories appear prominently on the homepage
                        </p>

                        <div class="flex items-center">
                            <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1"
                                   {{ old('show_in_menu', $category->show_in_menu) ? 'checked' : '' }}
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="show_in_menu" class="ml-2 block text-sm text-gray-700">
                                Show in Navigation Menu
                            </label>
                        </div>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-bars mr-1"></i>
                            Display this category in the main navigation menu
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
                                   value="{{ old('meta_title', $category->meta_title) }}"
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
                                      placeholder="Brief description for search engines">{{ old('meta_description', $category->meta_description) }}</textarea>
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
                                   value="{{ old('meta_keywords', $category->meta_keywords) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   placeholder="keyword1, keyword2, keyword3">
                            <p class="mt-1 text-sm text-gray-500">
                                <i class="fas fa-key mr-1"></i>
                                Comma-separated keywords for search engine optimization
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Icon Selection -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Category Icon</h3>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            Icon Class
                        </label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $category->icon) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                               placeholder="fas fa-folder">
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-icons mr-1"></i>
                            FontAwesome icon class (e.g., fas fa-folder, fas fa-code, fas fa-camera)
                        </p>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Popular Icons</h4>
                        <div class="grid grid-cols-4 gap-2">
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-folder'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-folder text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-code'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-code text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-camera'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-camera text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-book'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-book text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-gamepad'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-gamepad text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-music'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-music text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-heart'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-heart text-lg"></i>
                            </button>
                            <button type="button" onclick="document.getElementById('icon').value='fas fa-star'"
                                    class="p-2 text-center hover:bg-gray-200 rounded">
                                <i class="fas fa-star text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category Stats -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-blue-900 mb-4">Category Statistics</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-blue-700">Total Posts</span>
                            <span class="text-sm font-medium text-blue-900">{{ $category->posts_count ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-blue-700">Published Posts</span>
                            <span class="text-sm font-medium text-blue-900">{{ $category->published_posts_count ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-blue-700">Total Views</span>
                            <span class="text-sm font-medium text-blue-900">{{ number_format($category->total_views ?? 0) }}</span>
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
                    Update Category
                </button>
                <button type="submit" name="action" value="update_and_view"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    Update & View
                </button>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.categories.show', $category) }}"
                   class="text-blue-600 hover:text-blue-700 font-medium">
                    <i class="fas fa-eye mr-1"></i>
                    View Category
                </a>
                <button type="button" class="text-red-600 hover:text-red-700 font-medium delete-category-btn">
                    <i class="fas fa-trash mr-1"></i>
                    Delete
                </button>
            </div>
        </div>
    </form>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: false, form: null }" x-init="
        document.querySelector('.delete-category-btn')?.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = document.getElementById('delete-form');
        });
    " x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Category</h2>
            <p class="mb-6 text-gray-700">Are you sure you want to delete this category? This will also delete all posts in this category.</p>
            <div class="flex justify-end gap-3">
                <button @click="open = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
                <button @click="form.submit(); open = false" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});

// Sync color picker with text input
document.getElementById('color').addEventListener('input', function() {
    document.getElementById('color_hex').value = this.value;
});

document.getElementById('color_hex').addEventListener('input', function() {
    document.getElementById('color').value = this.value;
});

// Character counter for description
document.getElementById('description').addEventListener('input', function() {
    const maxLength = 500;
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
