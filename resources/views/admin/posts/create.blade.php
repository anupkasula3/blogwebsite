@extends('admin.layouts.app')

@section('title', 'Create Post - Admin')
@section('page-title', 'Create Post')

@section('content')
    <div class="flex items-center gap-x-4 mb-6">
        <a href="{{ route('admin.posts.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
        </a>
        <div class="text-xl font-semibold ">Create Post</div>
    </div>

    <div class="bg-white rounded-lg shadow-lg row text-slate-600">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" id="postForm">
            @csrf

            <div class="p-6 mt-3">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-4">
                        <!-- Title -->
                        <div>
                            <label class="w-full text-sm font-semibold" htmlFor="title">Title *</label>
                            <div>
                                <input
                                    class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                    name="title" placeholder="Enter Title Here" type="text" value="{{ old('title') }}"
                                    required />
                                @error('title')
                                    <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label class="w-full text-sm font-semibold" htmlFor="excerpt">Excerpt</label>
                            <div>
                                <textarea
                                    class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                    name="excerpt" rows="3" placeholder="Brief description of the post">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Content -->
                        <div>
                            <label class="w-full text-sm font-semibold" htmlFor="content">Content *</label>
                            <div>
                                <textarea name="content" id="content" rows="15"
                                    class="w-full tinymce p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                    placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-4">
                        <!-- Featured Image -->
                        <div>
                            <label class='text-sm font-semibold'>Featured Image</label>
                            <div
                                class='w-full p-2 mt-2 mb-1 text-sm border rounded-md shadow-sm form-control border-grey-400'>
                                <input type="file" name="featured_image" id="featured_image"
                                    class="image hover:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 "
                                    onchange="loadFile(event)" accept="image/*" />
                            </div>
                            <img id="output" style="width: 70px; margin-bottom: 2px;" />
                            @error('featured_image')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @php
                            $parentcat = getParent();
                        @endphp
                        <!-- Category -->
                        <div>
                            <label class="w-full text-sm font-semibold" htmlFor="category_id">Category *</label>
                            <div>
                                {{-- Render main categories as optgroup labels and only allow selecting subcategories --}}
                                <select name="category_id" id="category_id"
                                    class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                    required>
                                    <option value="" disabled selected>Select a category</option>



                                    @foreach ($parentcat as $parent)
                                        @php
                                            $children = getchildren($parent->id);

                                        @endphp

                                        @if ($children->isNotEmpty())
                                            <optgroup label="{{ $parent->name }}">
                                                @foreach ($children as $child)
                                                    <option value="{{ $child->id }}"
                                                        {{ old('category_id') == $child->id ? 'selected' : '' }}>
                                                        • {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            {{-- Parent with no subcategories: allow selecting the parent itself --}}
                                            <option value="{{ $parent->id }}"
                                                {{ old('category_id') == $parent->id ? 'selected' : '' }}>
                                                • {{ $parent->name }}
                                            </option>
                                        @endif
                                    @endforeach

                                    {{-- Also include any orphaned subcategories whose parent is missing from parents list --}}

                                </select>
                                @error('category_id')
                                    <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Selected preview: shows "Parent › Subcategory" so it's easy to see what is selected --}}
                            <div class="mt-2">
                                <style>
                                    .cat-preview {
                                        font-size: 0.85rem;
                                        color: #374151;
                                    }

                                    .cat-badge {
                                        display: inline-block;
                                        padding: 4px 8px;
                                        border-radius: 9999px;
                                        background: #f3f4f6;
                                        color: #374151;
                                        font-weight: 600;
                                    }

                                    .cat-parent {
                                        background: #eef2ff;
                                        color: #1f2937;
                                        margin-right: 6px;
                                    }

                                    .cat-dot {
                                        display: inline-block;
                                        width: 8px;
                                        height: 8px;
                                        border-radius: 9999px;
                                        margin-right: 6px;
                                        vertical-align: middle;
                                        background: #9ca3af;
                                        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
                                    }
                                </style>

                                <div id="selectedCategoryPreview" class="cat-preview">
                                    <span class="text-xs text-gray-500">Selected:</span>
                                    <span id="catBadge" class="cat-badge">None</span>
                                </div>
                            </div>

                        </div>
                        <script>
                            (function () {
                                var select = document.getElementById('category_id');
                                var badge = document.getElementById('catBadge');
                                if (!select || !badge) return;
                                function updateCategoryPreview() {
                                    var opt = select.options[select.selectedIndex];
                                    if (!opt || !opt.value) {
                                        badge.textContent = 'None';
                                        return;
                                    }
                                    var parentLabel = '';
                                    var labelEl = opt.parentElement;
                                    if (labelEl && labelEl.tagName === 'OPTGROUP') {
                                        parentLabel = labelEl.getAttribute('label') || '';
                                    }
                                    var childText = (opt.textContent || '').trim().replace(/^•\s*/, '');
                                    if (parentLabel) {
                                        badge.innerHTML = '<span class="cat-badge cat-parent">' + parentLabel + '</span>' +
                                            '<span class="cat-dot"></span>' +
                                            '<span class="cat-badge">' + childText + '</span>';
                                    } else {
                                        badge.textContent = childText || 'None';
                                    }
                                }
                                select.addEventListener('change', updateCategoryPreview);
                                if (document.readyState === 'loading') {
                                    document.addEventListener('DOMContentLoaded', updateCategoryPreview);
                                } else {
                                    updateCategoryPreview();
                                }
                            })();
                        </script>

                        <!-- Status -->
                        <div>
                            <label class="w-full text-sm font-semibold">Status</label>
                            <div class="space-y-2 mt-3">
                                <label class="flex items-center">
                                    <input type="radio" name="is_published" value="1"
                                        {{ old('is_published', '1') == '1' ? 'checked' : '' }}
                                        class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Published</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="is_published" value="0"
                                        {{ old('is_published') == '0' ? 'checked' : '' }}
                                        class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Draft</span>
                                </label>
                            </div>
                            @error('is_published')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Featured -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured') ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500 rounded">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Breaking News</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1 ml-6">Featured posts appear on the homepage</p>
                            @error('is_featured')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- SEO Fields -->
                        <div>
                            <label class="w-full text-sm font-semibold">SEO Settings</label>
                            <div class="space-y-3 mt-3">
                                <div>
                                    <label class="text-xs font-semibold text-gray-600">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        value="{{ old('meta_title') }}"
                                        class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                        placeholder="SEO title" />
                                    @error('meta_title')
                                        <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                            * {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-xs font-semibold text-gray-600">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" rows="2"
                                        class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                        placeholder="SEO description">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                            * {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-xs font-semibold text-gray-600">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords"
                                        value="{{ old('meta_keywords') }}"
                                        class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                        placeholder="keyword1, keyword2, keyword3" />
                                    @error('meta_keywords')
                                        <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                            * {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-xs font-semibold text-gray-600">Url : Slug</label>
                                    <input type="text" name="url_slug" id="url_slug" value="{{ old('url_slug') }}"
                                        class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                        placeholder="url-slug" />
                                    @error('url_slug')
                                        <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                            * {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div>
                        <button type="submit"
                            class="px-4 py-1 mt-3 mr-2 text-white bg-[#ff3131] rounded-md hover:bg-[#ff3135] hover:text-white">
                            Create Post
                        </button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>

@endsection
