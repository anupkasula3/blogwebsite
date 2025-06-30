@extends('user.layouts.app')

@section('title', $post->title)

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div>
            <a href="{{ route('user.posts.index') }}" class="text-gray-500 hover:text-purple-600 font-medium mb-2 inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Posts
            </a>
            <h1 class="text-3xl font-bold text-gray-800 line-clamp-2" title="{{ $post->title }}">{{ $post->title }}</h1>
        </div>
        <div class="flex items-center space-x-4 mt-4 sm:mt-0">
             <a href="{{ route('post.show', $post->slug) }}" target="_blank" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium inline-flex items-center">
                <i class="fas fa-external-link-alt mr-2"></i>
                View Live
            </a>
            <a href="{{ route('user.posts.edit', $post) }}" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2.5 rounded-lg shadow-lg hover:opacity-90 transition-opacity font-semibold inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Edit Post
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Main Content -->
        <div class="col-span-12 xl:col-span-8">
            <div class="space-y-6">
                @if($post->featured_image)
                <div class="bg-white rounded-2xl shadow-lg">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="Featured image" class="w-full h-auto object-cover rounded-t-2xl">
                </div>
                @endif
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg">
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! $post->content_html !!}
                    </div>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">SEO Details</h3>
                    <div class="space-y-4 text-sm">
                        <div>
                            <dt class="font-medium text-gray-600">Meta Title</dt>
                            <dd class="text-gray-800 mt-1">{{ $post->meta_title ?? 'Not set' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-600">Meta Description</dt>
                            <dd class="text-gray-800 mt-1">{{ $post->meta_description ?? 'Not set' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-600">Meta Keywords</dt>
                            <dd class="text-gray-800 mt-1">{{ $post->meta_keywords ?? 'Not set' }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-12 xl:col-span-4">
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Post Details</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Status</span>
                             <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $post->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $post->is_approved ? 'Approved' : 'Pending Review' }}
                            </span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Category</span>
                            <span class="text-gray-800">{{ $post->category->name ?? '-' }}</span>
                        </li>
                         <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Author</span>
                            <span class="text-gray-800">{{ $post->author_name }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Created</span>
                            <span class="text-gray-800">{{ $post->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Last Updated</span>
                            <span class="text-gray-800">{{ $post->updated_at->format('M d, Y') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistics</h3>
                    <ul class="space-y-3 text-sm">
                         <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium flex items-center"><i class="fas fa-eye mr-2 text-gray-400"></i>Views</span>
                            <span class="font-bold text-gray-800">{{ number_format($post->views_count) }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium flex items-center"><i class="fas fa-clock mr-2 text-gray-400"></i>Reading Time</span>
                            <span class="font-bold text-gray-800">{{ $post->reading_time }} min</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-red-50 p-6 rounded-2xl shadow-lg border border-red-200">
                    <h3 class="text-lg font-semibold text-red-800 mb-4">Danger Zone</h3>
                     <button type="button" class="w-full bg-red-600 text-white px-4 py-2.5 rounded-lg hover:bg-red-700 transition-colors font-semibold"
                        onclick="document.getElementById('delete-post-modal').classList.remove('hidden')">
                        <i class="fas fa-trash mr-2"></i>
                        Delete This Post
                    </button>
                    <p class="text-xs text-red-600 mt-2">This action is permanent and cannot be undone.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-post-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 max-w-sm w-full mx-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Confirm Deletion</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete this post? This action is permanent.</p>
        <form action="{{ route('user.posts.destroy', $post) }}" method="POST" class="flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="document.getElementById('delete-post-modal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 font-medium">Delete Forever</button>
        </form>
    </div>
</div>
@endsection
