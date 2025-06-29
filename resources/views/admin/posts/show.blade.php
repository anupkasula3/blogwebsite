@extends('admin.layouts.app')

@section('title', 'View Post - Admin')
@section('page-title', 'View Post')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Post Details</h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.posts.edit', $post) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Post
                </a>
                <a href="{{ route('admin.posts.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </a>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Post Header -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $post->author_name }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-folder mr-1"></i>
                                    {{ $post->category->name }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $post->created_at->format('M j, Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($post->is_featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i>
                                Featured
                            </span>
                            @endif
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $post->status === 'published' ? 'bg-green-100 text-green-800' :
                                   ($post->status === 'draft' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') }}">
                                <i class="fas fa-circle mr-1"></i>
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                    </div>

                    @if($post->featured_image)
                    <div class="mb-4">
                        <img src="{{ Storage::url($post->featured_image) }}"
                             alt="Featured image"
                             class="w-full h-48 object-cover rounded-lg">
                    </div>
                    @endif

                    @if($post->excerpt)
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Excerpt</h3>
                        <p class="text-gray-600">{{ $post->excerpt }}</p>
                    </div>
                    @endif

                    @if($post->tags)
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $post->tags) as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ trim($tag) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Post Content -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Content</h3>
                    <div class="prose max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>

                <!-- SEO Information -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-blue-900 mb-4">SEO Information</h3>
                    <div class="space-y-4">
                        @if($post->meta_title)
                        <div>
                            <h4 class="text-sm font-medium text-blue-700 mb-1">Meta Title</h4>
                            <p class="text-blue-600">{{ $post->meta_title }}</p>
                        </div>
                        @endif

                        @if($post->meta_description)
                        <div>
                            <h4 class="text-sm font-medium text-blue-700 mb-1">Meta Description</h4>
                            <p class="text-blue-600">{{ $post->meta_description }}</p>
                        </div>
                        @endif

                        @if($post->meta_keywords)
                        <div>
                            <h4 class="text-sm font-medium text-blue-700 mb-1">Meta Keywords</h4>
                            <p class="text-blue-600">{{ $post->meta_keywords }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Stats</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Views</span>
                            <span class="text-sm font-medium text-gray-900">{{ number_format($post->views_count) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Comments</span>
                            <span class="text-sm font-medium text-gray-900">{{ $post->comments_count ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Shares</span>
                            <span class="text-sm font-medium text-gray-900">{{ $post->shares_count ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Reading Time</span>
                            <span class="text-sm font-medium text-gray-900">{{ ceil(str_word_count($post->content) / 200) }} min</span>
                        </div>
                    </div>
                </div>

                <!-- Post Actions -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        @if($post->status === 'draft')
                        <form method="POST" action="{{ route('admin.posts.publish', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-check mr-2"></i>
                                Publish Post
                            </button>
                        </form>
                        @elseif($post->status === 'published')
                        <form method="POST" action="{{ route('admin.posts.unpublish', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                                <i class="fas fa-pause mr-2"></i>
                                Unpublish Post
                            </button>
                        </form>
                        @endif

                        @if(!$post->is_featured)
                        <form method="POST" action="{{ route('admin.posts.feature', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                <i class="fas fa-star mr-2"></i>
                                Feature Post
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.posts.unfeature', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-star mr-2"></i>
                                Unfeature Post
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('post.show', $post->slug) }}" target="_blank"
                           class="block w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-center">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            View on Site
                        </a>

                        <button type="button" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors delete-post-btn">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Post
                        </button>
                    </div>
                </div>

                <!-- Post Details -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Post Details</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-600">Created</span>
                            <p class="text-sm font-medium text-gray-900">{{ $post->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                        @if($post->published_at)
                        <div>
                            <span class="text-sm text-gray-600">Published</span>
                            <p class="text-sm font-medium text-gray-900">{{ $post->published_at->format('M j, Y g:i A') }}</p>
                        </div>
                        @endif
                        @if($post->updated_at && $post->updated_at != $post->created_at)
                        <div>
                            <span class="text-sm text-gray-600">Last Updated</span>
                            <p class="text-sm font-medium text-gray-900">{{ $post->updated_at->format('M j, Y g:i A') }}</p>
                        </div>
                        @endif
                        <div>
                            <span class="text-sm text-gray-600">URL Slug</span>
                            <p class="text-sm font-medium text-gray-900">{{ $post->slug }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Confirmation Modal -->
<div x-data="{ open: false, form: null }" x-init="
    document.querySelector('.delete-post-btn')?.addEventListener('click', (e) => {
        $data.open = true;
        $data.form = document.getElementById('delete-form');
    });
" x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Post</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete this post? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button @click="open = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
            <button @click="form.submit(); open = false" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection
