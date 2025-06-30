@extends('user.layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">Edit Post</h2>
                <a href="{{ route('user.posts.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>
        <form method="POST" action="{{ route('user.posts.update', $post) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="Enter post title" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                            placeholder="Brief description of the post">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                        <textarea name="content" id="content" rows="15"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Write your post content here..." required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured
                            Image</label>
                        @if($post->featured_image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($post->featured_image) }}"
                                 alt="Current featured image"
                                 class="w-full h-32 object-cover rounded-lg">
                        </div>
                        @endif
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Recommended size: 1200x630px</p>
                        @error('featured_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('category_id') border-red-500 @enderror"
                            required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
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
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-purple-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror"
                                    placeholder="keyword1, keyword2, keyword3">
                                @error('meta_keywords')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" name="action" value="draft" class="px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-300">
                                Save as Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="px-6 py-2 ml-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300">
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

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush

@push('styles')
<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
@endpush
