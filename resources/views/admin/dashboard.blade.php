@extends('admin.layouts.app')

@section('title', 'Admin Dashboard - ' . \App\Models\Setting::get('site_name', 'NepBlog'))

@section('content')
<div class="min-h-screen">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-[#ff2953] rounded-xl flex items-center justify-center shadow-lg ring-2 ring-[#ff2953]/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                        <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your blog.</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Total Posts</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_posts'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-file-alt text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Categories</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_categories'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-folder text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Additional Stats -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Pending Posts</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_posts'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Published Posts</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['published_posts'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Admin Posts</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['admin_posts'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-crown text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">User Posts</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['user_posts'] ?? 0 }}</p>
                            </div>
                            <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-user-edit text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <a href="{{ route('admin.posts.create') }}"
                       class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all group">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-plus text-blue-600 text-2xl group-hover:scale-110 transition-transform"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-bold text-gray-900">Create New Post</h3>
                                <p class="text-sm text-gray-600 mt-1">Add a new blog post</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.userposts.index') }}"
                       class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 hover:shadow-lg transition-all group">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-orange-600 text-2xl group-hover:scale-110 transition-transform"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-bold text-gray-900">Manage User Posts</h3>
                                <p class="text-sm text-gray-600 mt-1">Review and approve</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.categories.create') }}"
                       class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all group">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-folder-plus text-green-600 text-2xl group-hover:scale-110 transition-transform"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-bold text-gray-900">Add Category</h3>
                                <p class="text-sm text-gray-600 mt-1">Create a new category</p>
                            </div>
                        </div>
                    </a>



                    {{-- <a href="{{ route('admin.users.pending-posts') }}"
                       class="bg-gradient-to-br from-[#ff2953]/5 to-[#ff2953]/10 p-6 rounded-xl border border-[#ff2953]/20 hover:shadow-lg transition-all group">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-[#ff2953] text-2xl group-hover:scale-110 transition-transform"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-bold text-gray-900">Review Posts</h3>
                                <p class="text-sm text-gray-600 mt-1">Approve pending posts</p>
                            </div>
                        </div>
                    </a> --}}
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Posts -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-file-alt text-[#ff2953]"></i>
                                Recent Posts
                            </h3>
                            <a href="{{ route('admin.posts.index') }}" class="text-[#ff2953] hover:text-[#ff2953]/80 font-medium text-sm flex items-center gap-1">
                                View All <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                        <div class="space-y-3">
                            @forelse($popularPosts ?? [] as $post)
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-100 hover:border-[#ff2953]/20 hover:shadow-md transition-all">
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 truncate mb-1">
                                        {{ $post->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 flex items-center gap-2">
                                        <i class="fas fa-folder text-[#ff2953]"></i>
                                        {{ $post->category->name ?? 'Uncategorized' }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-user"></i>
                                        {{ $post->author_name }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-clock"></i>
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-end gap-2 ml-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium
                                        {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                    @if($post->author_type === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-purple-100 text-purple-700">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-700">
                                            User
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-8">
                                <i class="fas fa-file-alt text-4xl mb-3 text-gray-300"></i>
                                <p class="text-sm">No posts found.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-users text-[#ff2953]"></i>
                                Recent Users
                            </h3>
                            <a href="{{ route('admin.users.index') }}" class="text-[#ff2953] hover:text-[#ff2953]/80 font-medium text-sm flex items-center gap-1">
                                View All <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                        <div class="space-y-3">
                            @forelse($recentUsers ?? [] as $user)
                            <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-100 hover:border-[#ff2953]/20 hover:shadow-md transition-all">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#ff2953] to-[#ff2953]/80 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 truncate">
                                        {{ $user->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500 flex items-center gap-2 mt-1">
                                        <i class="fas fa-envelope text-[#ff2953]"></i>
                                        {{ $user->email }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-clock"></i>
                                        {{ $user->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                @if($user->is_verified)
                                <div class="flex flex-col items-end">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-green-100 text-green-700">
                                        <i class="fas fa-check-circle mr-1"></i>Verified
                                    </span>
                                </div>
                                @endif
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-8">
                                <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                                <p class="text-sm">No users found.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Posts -->
            @if(count($pendingPosts ?? []) > 0)
            <div class="mb-8">
                <div class="bg-gradient-to-br from-yellow-50 to-white shadow-lg rounded-xl border border-yellow-100">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-yellow-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-exclamation-circle text-yellow-600"></i>
                                Pending Posts
                            </h3>
                            <a href="{{ route('admin.userposts.index') }}" class="text-[#ff2953] hover:text-[#ff2953]/80 font-medium text-sm flex items-center gap-1">
                                View All <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                        <div class="space-y-3">
                            @foreach($pendingPosts as $post)
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-yellow-50 to-white border border-yellow-200 rounded-lg hover:border-[#ff2953]/40 hover:shadow-md transition-all">
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 truncate mb-1">
                                        {{ $post->title }}
                                    </h4>
                                    <p class="text-xs text-gray-600 flex items-center gap-2">
                                        <i class="fas fa-folder text-yellow-600"></i>
                                        {{ $post->category->name ?? 'Uncategorized' }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-user"></i>
                                        {{ $post->author_name }}
                                        <span class="mx-1">•</span>
                                        <i class="fas fa-clock"></i>
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 ml-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-yellow-100 text-yellow-700">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                    @if($post->author_type === 'user')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-700">
                                            User Post
                                        </span>
                                    @endif
                                    <a href="{{ route('admin.userposts.show', $post) }}"
                                       class="text-[#ff2953] hover:text-[#ff2953]/80 p-2 hover:bg-[#ff2953]/10 rounded-lg transition-colors">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- System Status -->
            <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-xl border border-gray-100">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="w-10 h-10 bg-[#ff2953] rounded-lg flex items-center justify-center shadow-lg">
                            <i class="fas fa-server text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">System Status</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="w-4 h-4 bg-green-500 rounded-full shadow-lg animate-pulse"></div>
                            <span class="text-sm font-medium text-gray-900">Website Online</span>
                        </div>
                        <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="w-4 h-4 bg-green-500 rounded-full shadow-lg animate-pulse"></div>
                            <span class="text-sm font-medium text-gray-900">Database Connected</span>
                        </div>
                        <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="w-4 h-4 bg-green-500 rounded-full shadow-lg animate-pulse"></div>
                            <span class="text-sm font-medium text-gray-900">Storage Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Add any dashboard-specific JavaScript here
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh stats every 5 minutes
    setInterval(function() {
        // You can add AJAX calls here to refresh stats
    }, 300000);
});
</script>
@endpush
@endsection
