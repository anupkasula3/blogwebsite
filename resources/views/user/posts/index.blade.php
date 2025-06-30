@extends('user.layouts.app')

@section('title', 'My Posts')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">My Posts</h1>
        </div>
        <div>
            <a href="{{ route('user.posts.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2.5 rounded-lg shadow-lg hover:opacity-90 transition-opacity font-semibold">
                <i class="fas fa-plus mr-2"></i>
                Create New Post
            </a>
        </div>
    </div>

    <!-- Table / Cards -->
    <div class="bg-white shadow-lg rounded-2xl">
        <div class="hidden sm:block">
            <table class="w-full whitespace-nowrap">
                <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="p-4 text-left">Post</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Views</th>
                        <th class="p-4 text-left">Date</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-200">
                    @forelse($posts as $post)
                    <tr>
                        <td class="p-4">
                            <div class="flex items-center">
                                @if($post->featured_image)
                                <img class="w-10 h-10 rounded-lg object-cover mr-3" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                                @else
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center mr-3">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                                @endif
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $post->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $post->category->name }} &bull; {{ $post->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <span class="p-1.5 text-xs font-medium uppercase tracking-wider
                                @switch($post->status)
                                    @case('draft')
                                        text-gray-800 bg-gray-200
                                        @break
                                    @case('pending')
                                        text-yellow-800 bg-yellow-200
                                        @break
                                    @case('published')
                                        text-green-800 bg-green-200
                                        @break
                                    @default
                                        text-gray-800 bg-gray-200
                                @endswitch
                                rounded-lg bg-opacity-50">{{ $post->status }}</span>
                        </td>
                        <td class="p-4 text-center text-gray-600">{{ number_format($post->views_count) }}</td>
                        <td class="p-4 text-gray-600">{{ $post->created_at->format('M d, Y') }}</td>
                        <td class="p-4 text-right">
                            <div class="inline-flex items-center space-x-2">
                                @if($post->status == 'draft')
                                    <form action="{{ route('user.posts.publish', $post) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-green-600" title="Submit for Review">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                    </form>
                                @elseif($post->status == 'published' || $post->status == 'pending')
                                    <form action="{{ route('user.posts.draft', $post) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-yellow-600" title="Move to Drafts">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('user.posts.show', $post) }}" class="text-gray-400 hover:text-blue-600" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('user.posts.edit', $post) }}" class="text-gray-400 hover:text-indigo-600" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="text-gray-400 hover:text-red-600 delete-post-btn" title="Delete" data-post-title="{{ $post->title }}" data-action="{{ route('user.posts.destroy', $post) }}"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            <i class="fas fa-file-alt text-4xl mb-4 text-gray-300"></i>
                            <p class="font-medium">No posts found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Cards for mobile -->
        <div class="sm:hidden grid grid-cols-1 gap-4 p-4">
            @forelse($posts as $post)
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-center mb-3">
                    @if($post->featured_image)
                    <img class="w-10 h-10 rounded-lg object-cover mr-3" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                    @else
                    <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center mr-3">
                        <i class="fas fa-image text-gray-400"></i>
                    </div>
                    @endif
                    <div>
                        <a href="{{ route('user.posts.show', $post) }}" class="font-semibold text-gray-800 hover:text-purple-600">{{ $post->title }}</a>
                        <div class="text-xs text-gray-500">{{ $post->category->name }} &bull; {{ $post->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
                <div class="flex justify-between items-center text-sm mb-3">
                    <span class="p-1.5 text-xs font-medium uppercase tracking-wider
                        @switch($post->status)
                            @case('draft')
                                text-gray-800 bg-gray-200
                                @break
                            @case('pending')
                                text-yellow-800 bg-yellow-200
                                @break
                            @case('published')
                                text-green-800 bg-green-200
                                @break
                            @default
                                text-gray-800 bg-gray-200
                        @endswitch
                        rounded-lg bg-opacity-50">{{ $post->status }}</span>
                    <div class="text-gray-600">
                        <i class="fas fa-eye mr-1"></i> {{ number_format($post->views_count) }}
                    </div>
                </div>
                <div class="text-xs text-gray-500 mb-4">{{ $post->created_at->format('M d, Y') }}</div>
                <div class="flex justify-end space-x-4">
                    @if($post->status == 'draft')
                        <form action="{{ route('user.posts.publish', $post) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-green-600" title="Submit for Review">
                                <i class="fas fa-upload"></i>
                            </button>
                        </form>
                    @elseif($post->status == 'published' || $post->status == 'pending')
                        <form action="{{ route('user.posts.draft', $post) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-yellow-600" title="Move to Drafts">
                                <i class="fas fa-download"></i>
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('user.posts.show', $post) }}" class="text-gray-500 hover:text-blue-600" title="View"><i class="fas fa-eye"></i> View</a>
                    <a href="{{ route('user.posts.edit', $post) }}" class="text-gray-500 hover:text-indigo-600" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                    <button class="text-gray-500 hover:text-red-600 delete-post-btn" title="Delete" data-post-title="{{ $post->title }}" data-action="{{ route('user.posts.destroy', $post) }}"><i class="fas fa-trash"></i> Delete</button>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-file-alt text-4xl mb-4 text-gray-300"></i>
                <p class="font-medium">No posts found.</p>
            </div>
            @endforelse
        </div>
    </div>

    @if($posts->hasPages())
    <div class="p-4">
        {{ $posts->links() }}
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div x-data="{ open: false, action: '', title: '' }"
     @delete-post.window="open = true; action = $event.detail.action; title = $event.detail.title"
     x-show="open" style="display: none;"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div @click.away="open = false" class="bg-white rounded-lg shadow-lg p-6 sm:p-8 max-w-sm w-full mx-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Confirm Deletion</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete the post <strong x-text="title"></strong>? This action cannot be undone.</p>
        <form :action="action" method="POST" class="flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <button type="button" @click="open = false" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 font-medium">Delete</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-post-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const detail = {
                    action: e.currentTarget.dataset.action,
                    title: e.currentTarget.dataset.postTitle
                };
                window.dispatchEvent(new CustomEvent('delete-post', { detail }));
            });
        });
    });
</script>
@endpush
@endsection
