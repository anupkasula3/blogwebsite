@extends('admin.layouts.app')

@section('title', 'User Posts - Admin')
@section('page-title', 'User Posts')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">User Posts</h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.posts.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-newspaper mr-2"></i>
                    Admin Posts
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($post->featured_image)
                            <div class="flex-shrink-0 h-12 w-12">
                                <img class="h-12 w-12 rounded-lg object-cover" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                            </div>
                            @else
                            <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('post.show', $post->slug) }}" target="_blank" class="hover:text-purple-600">{{ $post->title }}</a>
                                </div>
                                <div class="text-sm text-gray-500">{{ Str::limit($post->excerpt, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">{{ $post->category->name }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}" alt="{{ $post->user->name ?? 'User' }}">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $post->user->name ?? 'Unknown User' }}</div>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user mr-1"></i>User
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($post->status === 'published')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>Published
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i>Draft
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($post->views_count) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->published_at ? $post->published_at->format('M j, Y') : 'Not published' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            @if(!$post->is_approved)
                            <form method="POST" action="{{ route('admin.userposts.approve', $post) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900" title="Approve">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                            @else
                            <button type="button" onclick="openRejectModal({{ $post->id }}, '{{ $post->title }}')" class="text-red-600 hover:text-red-900" title="Reject">
                                <i class="fas fa-times-circle"></i>
                            </button>
                            @endif

                            @if($post->status === 'draft' && $post->is_approved)
                            <form method="POST" action="{{ route('admin.userposts.publish', $post) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900" title="Publish">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @elseif($post->status === 'published')
                            <form method="POST" action="{{ route('admin.userposts.unpublish', $post) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900" title="Unpublish">
                                    <i class="fas fa-pause"></i>
                                </button>
                            </form>
                            @endif

                            @if(!$post->is_featured)
                            <form method="POST" action="{{ route('admin.userposts.feature', $post) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-900" title="Feature">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.userposts.unfeature', $post) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-gray-900" title="Unfeature">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('admin.userposts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="{{ route('admin.userposts.show', $post) }}" class="text-blue-600 hover:text-blue-900" title="View Full Post">
                                <i class="fas fa-eye"></i>
                            </a>

                            <form method="POST" action="{{ route('admin.userposts.destroy', $post) }}" class="inline delete-userpost-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:text-red-900 delete-userpost-btn" title="Delete" data-post-title="{{ $post->title }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No user posts found</h3>
                            <p class="text-gray-600">Users haven't created any posts yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($posts->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $posts->links() }}
    </div>
    @endif
</div>

<!-- Rejection Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Reject Post</h3>
                <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Post: <span id="rejectPostTitle" class="font-medium"></span></p>
                <p class="text-sm text-gray-600">Please provide a reason for rejection:</p>
            </div>

            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <textarea
                        name="rejection_reason"
                        id="rejection_reason"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter rejection reason..."
                        required
                    ></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button
                        type="button"
                        onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
                    >
                        Reject Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div x-data="{ open: false, form: null, post: '' }" x-init="
    document.querySelectorAll('.delete-userpost-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = btn.closest('form');
            $data.post = btn.getAttribute('data-post-title');
        });
    });
" x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Delete User Post</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete the post <span class="font-semibold text-red-600" x-text="post"></span>? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button @click="open = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
            <button @click="form.submit(); open = false" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openRejectModal(postId, postTitle) {
    document.getElementById('rejectPostTitle').textContent = postTitle;
    document.getElementById('rejectForm').action = `/admin/userposts/${postId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejection_reason').value = '';
}
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
