@extends('user.layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Create New Post</h2>
                <a href="{{ route('user.posts.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('user.posts.store') }}" enctype="multipart/form-data" class="p-6">
            @csrf

            @if($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                    <div class="flex items-start">
                        <span class="text-red-600 mr-3">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                        <div>
                            <p class="font-medium text-red-700">Please fix the following issues:</p>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" maxlength="120"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('title') border-red-500 @enderror"
                            placeholder="Enter post title" required>
                        <div class="mt-1 flex items-center justify-between">
                            <p class="text-xs text-gray-500">Aim for a clear, concise title.</p>
                            <span class="text-xs text-gray-400" id="titleCounter">0/120</span>
                        </div>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" maxlength="250"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('excerpt') border-red-500 @enderror"
                            placeholder="Brief description of the post">{{ old('excerpt') }}</textarea>
                        <div class="mt-1 flex items-center justify-between">
                            <p class="text-xs text-gray-500">A short summary shown in listings and SEO.</p>
                            <span class="text-xs text-gray-400" id="excerptCounter">0/250</span>
                        </div>
                        @error('excerpt')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                        <textarea name="content" id="content" rows="15"
                            class="w-full tinymce px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('content') border-red-500 @enderror"
                            placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6 lg:sticky lg:top-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                        <input type="file" name="featured_image" id="featured_image" accept="image/*" class="hidden">
                        <div id="dropzone" class="flex flex-col items-center justify-center w-full p-6 text-center border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-400 transition-colors cursor-pointer bg-white">
                            <div class="text-3xl text-gray-400 mb-2">
                                <i class="fa-regular fa-image"></i>
                            </div>
                            <p class="text-sm text-gray-700"><span class="font-medium text-purple-600">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG up to 5MB</p>
                        </div>
                        <div id="preview" class="mt-3 hidden">
                            <img id="output" class="w-full h-40 object-cover rounded-lg border border-gray-200" />
                            <p id="filename" class="mt-2 text-xs text-gray-500"></p>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Recommended size: 1200x630px</p>
                        @error('featured_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('category_id') border-red-500 @enderror"
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

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">SEO Settings</h3>

                        <div class="space-y-3">
                            <div>
                                <label for="meta_title" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                    Title</label>
                                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" maxlength="60"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('meta_title') border-red-500 @enderror"
                                    placeholder="SEO title">
                                <div class="mt-1 flex items-center justify-between">
                                    <p class="text-[11px] text-gray-500">Keep under 60 characters for best SERP display.</p>
                                    <span class="text-[11px] text-gray-400" id="metaTitleCounter">0/60</span>
                                </div>
                                @error('meta_title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="meta_description" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                    Description</label>
                                <textarea name="meta_description" id="meta_description" rows="2" maxlength="160"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('meta_description') border-red-500 @enderror"
                                    placeholder="SEO description">{{ old('meta_description') }}</textarea>
                                <div class="mt-1 flex items-center justify-between">
                                    <p class="text-[11px] text-gray-500">Ideal length 50-160 characters.</p>
                                    <span class="text-[11px] text-gray-400" id="metaDescriptionCounter">0/160</span>
                                </div>
                                @error('meta_description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="meta_keywords" class="block text-xs font-medium text-gray-600 mb-1">Meta
                                    Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" maxlength="255"
                                    value="{{ old('meta_keywords') }}"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('meta_keywords') border-red-500 @enderror"
                                    placeholder="keyword1, keyword2, keyword3">
                                <p class="mt-1 text-[11px] text-gray-500">Separate with commas.
                                </p>
                                @error('meta_keywords')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" name="action" value="draft" class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-300">
                                Save Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="px-6 py-2 ml-4 text-sm font-medium text-white bg-[#ff3131] rounded-lg hover:opacity-90 focus:outline-none focus:ring-4 focus:ring-[#ff3131]/40">
                                Submit for Review
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
<style>
    /* Light hover/active states for dropzone beyond Tailwind utilities */
    #dropzone.dragover {
        border-color: rgb(147 51 234); /* purple-600 */
        background-color: rgb(250 245 255); /* purple-50 */
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Character counters
        function attachCounter(el, counterEl, max) {
            if (!el || !counterEl) return;
            const update = () => {
                const len = el.value?.length || 0;
                counterEl.textContent = `${len}/${max}`;
            };
            el.addEventListener('input', update);
            update();
        }

        attachCounter(document.getElementById('title'), document.getElementById('titleCounter'), 120);
        attachCounter(document.getElementById('excerpt'), document.getElementById('excerptCounter'), 250);
        attachCounter(document.getElementById('meta_title'), document.getElementById('metaTitleCounter'), 60);
        attachCounter(document.getElementById('meta_description'), document.getElementById('metaDescriptionCounter'), 160);

        // Featured image uploader (click + drag/drop)
        const fileInput = document.getElementById('featured_image');
        const dropzone = document.getElementById('dropzone');
        const previewWrap = document.getElementById('preview');
        const outputImg = document.getElementById('output');
        const filenameText = document.getElementById('filename');

        function handleFiles(files) {
            if (!files || !files.length) return;
            const file = files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (!validTypes.includes(file.type)) {
                alert('Please upload a valid image file (JPG, PNG, WEBP).');
                return;
            }
            if (file.size > maxSize) {
                alert('Image size should be 5MB or less.');
                return;
            }

            const url = URL.createObjectURL(file);
            outputImg.src = url;
            filenameText.textContent = file.name;
            previewWrap.classList.remove('hidden');
        }

        if (dropzone && fileInput) {
            dropzone.addEventListener('click', () => fileInput.click());
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
            dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
                if (e.dataTransfer && e.dataTransfer.files) {
                    fileInput.files = e.dataTransfer.files;
                    handleFiles(e.dataTransfer.files);
                }
            });
            fileInput.addEventListener('change', (e) => handleFiles(e.target.files));
        }
    });
</script>
@endpush
