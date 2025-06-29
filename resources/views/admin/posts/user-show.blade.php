@extends('admin.layouts.app')

@section('title', 'View User Post - Admin')
@section('page-title', 'View User Post')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">User Post Details</h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.userposts.edit', $post) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Post
                </a>
                <a href="{{ route('admin.userposts.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to User Posts
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
                                    <span class="ml-1 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        User
                                    </span>
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-folder mr-1"></i>
                                    {{ $post->category->name ?? 'Uncategorized' }}
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
                            @if($post->is_approved)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Approved
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-clock mr-1"></i>
                                Pending Approval
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
                </div>

                <!-- Post Content -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Content</h3>
                    <div class="prose max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>

                <!-- SEO Information -->
                @if($post->meta_title || $post->meta_description || $post->meta_keywords)
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
                @endif
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
                            <span class="text-sm text-gray-600">Reading Time</span>
                            <span class="text-sm font-medium text-gray-900">{{ ceil(str_word_count($post->content) / 200) }} min</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Word Count</span>
                            <span class="text-sm font-medium text-gray-900">{{ str_word_count($post->content) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">SEO Score</span>
                            <span class="text-sm font-medium text-gray-900">{{ $post->seo_score ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- User Post Actions -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">User Post Actions</h3>
                    <div class="space-y-3">
                        @if(!$post->is_approved)
                        <form method="POST" action="{{ route('admin.userposts.approve', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-check mr-2"></i>
                                Approve Post
                            </button>
                        </form>

                        <button type="button" onclick="openRejectModal()" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-2"></i>
                            Reject Post
                        </button>
                        @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-green-800 font-medium">Post Approved</span>
                            </div>
                            <p class="text-green-600 text-sm mt-1">This post has been approved and can be published.</p>
                        </div>
                        @endif

                        @if($post->status === 'draft')
                        <form method="POST" action="{{ route('admin.userposts.publish', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-upload mr-2"></i>
                                Publish Post
                            </button>
                        </form>
                        @elseif($post->status === 'published')
                        <form method="POST" action="{{ route('admin.userposts.unpublish', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                                <i class="fas fa-pause mr-2"></i>
                                Unpublish Post
                            </button>
                        </form>
                        @endif

                        @if(!$post->is_featured)
                        <form method="POST" action="{{ route('admin.userposts.feature', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                                <i class="fas fa-star mr-2"></i>
                                Feature Post
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.userposts.unfeature', $post) }}" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas fa-star mr-2"></i>
                                Unfeature Post
                            </button>
                        </form>
                        @endif

                        @if($post->status === 'published')
                        <a href="{{ route('post.show', $post->slug) }}" target="_blank"
                           class="block w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-center">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            View on Site
                        </a>
                        @endif

                        <button type="button" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors delete-userpost-btn">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Post
                        </button>
                    </div>
                </div>

                <!-- User Information -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-blue-900 mb-4">User Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-blue-700">Author Name</span>
                            <p class="text-sm font-medium text-blue-900">{{ $post->user->name ?? 'Unknown User' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-blue-700">Email</span>
                            <p class="text-sm font-medium text-blue-900">{{ $post->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-blue-700">Member Since</span>
                            <p class="text-sm font-medium text-blue-900">{{ $post->user->created_at->format('M j, Y') ?? 'N/A' }}</p>
                        </div>
                        @if($post->user && $post->user->is_verified)
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Verified User
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Verification Status -->
                <div class="bg-{{ $post->is_approved ? 'green' : 'yellow' }}-50 p-4 rounded-lg border border-{{ $post->is_approved ? 'green' : 'yellow' }}-200">
                    <h3 class="text-lg font-medium text-{{ $post->is_approved ? 'green' : 'yellow' }}-900 mb-4">Verification Status</h3>
                    <div class="space-y-3">
                        @if($post->is_approved)
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-green-800 font-medium">Approved</span>
                        </div>
                        <p class="text-green-700 text-sm">This post has been reviewed and approved by an admin.</p>
                        <div class="text-green-600 text-sm">
                            <span class="font-medium">Approved on:</span><br>
                            {{ $post->updated_at->format('M j, Y g:i A') }}
                        </div>
                        @else
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-500 mr-2"></i>
                            <span class="text-yellow-800 font-medium">Pending Approval</span>
                        </div>
                        <p class="text-yellow-700 text-sm">This post is waiting for admin review and approval.</p>
                        <div class="text-yellow-600 text-sm">
                            <span class="font-medium">Submitted on:</span><br>
                            {{ $post->created_at->format('M j, Y g:i A') }}
                        </div>
                        @endif
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
<form id="delete-form" action="{{ route('admin.userposts.destroy', $post) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

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
                <p class="text-sm text-gray-600 mb-2">Post: <span class="font-medium">{{ $post->title }}</span></p>
                <p class="text-sm text-gray-600">Please provide a reason for rejection:</p>
            </div>

            <form method="POST" action="{{ route('admin.userposts.reject', $post) }}">
                @csrf
                <div class="mb-4">
                    <textarea
                        name="rejection_reason"
                        id="rejection_reason"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
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

<!-- Delete Confirmation Modal -->
<div x-data="{ open: false, form: null }" x-init="
    document.querySelector('.delete-userpost-btn')?.addEventListener('click', (e) => {
        $data.open = true;
        $data.form = document.getElementById('delete-form');
    });
" x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Delete User Post</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete this user post? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button @click="open = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
            <button @click="form.submit(); open = false" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openRejectModal() {
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejection_reason').focus();
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejection_reason').value = '';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRejectModal();
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection
