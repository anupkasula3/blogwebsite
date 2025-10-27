@extends('user.layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg ring-1 ring-gray-100">
            <div class="p-6 border-b border-gray-100 rounded-t-2xl bg-gradient-to-r from-[#ff2953]/5 to-[#ff5f7b]/5">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">Edit Post</h2>
                    <a href="{{ route('user.posts.index') }}" class="text-[#ff2953] hover:text-[#e02449] font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Posts
                    </a>
                </div>
            </div>
            <form method="POST" action="{{ route('user.posts.update', $post) }}" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('title') border-red-500 @enderror"
                                placeholder="Enter post title" required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('excerpt') border-red-500 @enderror"
                                placeholder="Brief description of the post">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                            <textarea name="content" id="content" rows="15"
                                class="w-full px-3 tinymce py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('content') border-red-500 @enderror"
                                placeholder="Write your post content here..." required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-xl p-4 shadow-sm ring-1 ring-gray-100">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured
                                Image</label>
                            @if ($post->featured_image)
                                <div class="mb-4">
                                    <img src="{{ asset('/uploads/' . $post->featured_image) }}" alt="Current featured image"
                                        class="oldimage w-24 object-cover rounded-lg">
                                </div>
                            @endif
                            <input type="file" name="featured_image" onchange="loadFile(event)" id="featured_image"
                                accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('featured_image') border-red-500 @enderror">
                            <img id="output" style="width: 70px; margin-bottom: 2px;" />
                            <p class="text-sm text-gray-500 mt-1">Recommended size: 1200x630px</p>
                            @error('featured_image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 shadow-sm ring-1 ring-gray-100">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            {{-- Group by parents; allow selecting parent if it has no children --}}
                            <select name="category_id" id="category_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('category_id') border-red-500 @enderror"
                                required>
                                <option value="">Select a category</option>

                                @php
                                    $allCategories = collect($categories);
                                    $parents = $allCategories->filter(function ($c) {
                                        return $c->parent_id === 0 || $c->parent_id === null;
                                    });
                                @endphp

                                @php
                                    // Minimalist dropdown: no per-category colors
                                @endphp

                                @foreach ($parents as $parent)
                                    @php
                                        $children = $allCategories->where('parent_id', $parent->id);
                                    @endphp
                                    @if ($children->isNotEmpty())
                                        <optgroup label="{{ $parent->name }}">
                                            @foreach ($children as $child)
                                                <option value="{{ $child->id }}" {{ old('category_id', $post->category_id) == $child->id ? 'selected' : '' }}>
                                                    • {{ $child->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <option value="{{ $parent->id }}" {{ old('category_id', $post->category_id) == $parent->id ? 'selected' : '' }}>
                                            • {{ $parent->name }}
                                        </option>
                                    @endif
                                @endforeach

                                @php
                                    $orphaned = $allCategories->filter(function ($c) use ($parents) {
                                        return $c->parent_id && !$parents->pluck('id')->contains($c->parent_id);
                                    });
                                @endphp
                                @foreach ($orphaned as $child)
                                    <option value="{{ $child->id }}" {{ old('category_id', $post->category_id) == $child->id ? 'selected' : '' }}>
                                        • {{ $child->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mt-2">
                                <style>
                                    .cat-preview { font-size: 0.85rem; color: #374151; }
                                    .cat-badge { display: inline-block; padding: 4px 8px; border-radius: 9999px; background:#f3f4f6; color:#374151; font-weight:600; }
                                    .cat-parent { background:#eef2ff; color:#1f2937; margin-right:6px; }
                                    .cat-dot { display:inline-block; width:8px; height:8px; border-radius:9999px; margin-right:6px; vertical-align:middle; background:#9ca3af; box-shadow:0 0 0 1px rgba(0,0,0,0.05); }
                                </style>
                                <div id="selectedCategoryPreview" class="cat-preview">
                                    <span class="text-xs text-gray-500">Selected:</span>
                                    <span id="catBadge" class="cat-badge">None</span>
                                </div>
                            </div>

                            @php
                                $jsCategories = $allCategories->mapWithKeys(function ($c) use ($allCategories) {
                                    return [
                                        $c->id => [
                                            'id' => $c->id,
                                            'name' => $c->name,
                                            'parent_id' => $c->parent_id,
                                            'parent_name' => $allCategories->firstWhere('id', $c->parent_id)->name ?? null,
                                        ],
                                    ];
                                });
                            @endphp

                            <script>
                                const categories = @json($jsCategories);
                                function renderPreview(selectedId) {
                                    const badge = document.getElementById('catBadge');
                                    if (!selectedId || selectedId === '') { badge.textContent = 'None'; return; }
                                    const cat = categories[selectedId];
                                    if (!cat) { badge.textContent = 'Unknown'; return; }
                                    if (cat.parent_name && cat.parent_id) {
                                        badge.innerHTML = `
                                            <span class="cat-badge cat-parent"><span class="cat-dot"></span>${cat.parent_name}</span>
                                            <span class="cat-badge"><span class="cat-dot"></span>${cat.name}</span>
                                        `;
                                    } else {
                                        badge.innerHTML = `<span class="cat-dot"></span>${cat.name}`;
                                    }
                                }
                                document.addEventListener('DOMContentLoaded', function() {
                                    const sel = document.getElementById('category_id');
                                    if (!sel) return;
                                    renderPreview(sel.value || '{{ old('category_id', $post->category_id) }}');
                                    sel.addEventListener('change', function(e){ renderPreview(e.target.value); });
                                });
                            </script>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 shadow-sm ring-1 ring-gray-100">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">SEO Settings</h3>
                            <div class="space-y-3">
                                <div>
                                    <label for="meta_title" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        value="{{ old('meta_title', $post->meta_title) }}"
                                        class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('meta_title') border-red-500 @enderror"
                                        placeholder="SEO title">
                                    @error('meta_title')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="meta_description" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="meta_description" rows="2"
                                        class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('meta_description') border-red-500 @enderror"
                                        placeholder="SEO description">{{ old('meta_description', $post->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="meta_keywords" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                        Keywords</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords"
                                        value="{{ old('meta_keywords', $post->meta_keywords) }}"
                                        class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('meta_keywords') border-red-500 @enderror"
                                        placeholder="keyword1, keyword2, keyword3">
                                    @error('meta_keywords')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="url_slug" class="block text-xs font-medium text-gray-600 mb-1">Url : Slug
                                    </label>
                                    <input type="text" name="url_slug" id="url_slug"
                                        value="{{ old('url_slug', $post->url_slug) }}"
                                        class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('url_slug') border-red-500 @enderror"
                                        placeholder="url-slug">
                                </div>
                                @error('url_slug')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 shadow-sm ring-1 ring-gray-100">
                            <div class="flex items-center justify-end mt-6">
                                <button type="submit" name="action" value="draft"
                                    class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-300">
                                    Save as Draft
                                </button>
                                <button type="submit" name="action" value="publish"
                                    class="px-6 py-2 ml-4 text-sm font-medium text-white bg-[#ff3131] rounded-lg hover:opacity-90 focus:outline-none focus:ring-4 focus:ring-[#ff3131]/40 shadow">
                                    Update & Submit for Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



@push('styles')
@endpush
