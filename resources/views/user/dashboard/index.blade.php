@extends('user.layouts.app')

@section('title', 'Dashboard - ' . auth()->user()->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600 text-lg">Here's an overview of your blog activity and performance.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100">
                    <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Total Posts</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_posts'] }}</div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-green-100">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Approved Posts</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['approved_posts'] }}</div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-100">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Pending Posts</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['pending_posts'] }}</div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-purple-100">
                    <i class="fas fa-eye text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-semibold uppercase">Total Views</div>
                    <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_views']) }}</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-10">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('user.posts.create') }}" class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 hover:shadow-xl transition group">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 group-hover:bg-blue-200">
                        <i class="fas fa-plus text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900">Create New Post</div>
                        <div class="text-gray-500">Write and submit a new article</div>
                    </div>
                </a>
                <a href="{{ route('user.posts.index') }}" class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 hover:shadow-xl transition group">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-green-100 group-hover:bg-green-200">
                        <i class="fas fa-list text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900">Manage Posts</div>
                        <div class="text-gray-500">View and edit your articles</div>
                    </div>
                </a>
                <a href="{{ route('user.analytics') }}" class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 hover:shadow-xl transition group">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-purple-100 group-hover:bg-purple-200">
                        <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-gray-900">View Analytics</div>
                        <div class="text-gray-500">Check your post performance</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
                <h2 class="text-lg font-semibold text-gray-900">Recent Posts</h2>
                <a href="{{ route('user.posts.index') }}" class="text-blue-600 hover:text-blue-700 text-sm">View All</a>
            </div>
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                @if($recentPosts->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($recentPosts as $post)
                    <li>
                        <div class="px-4 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 truncate">
                                    <a href="{{ route('post.show', $post->slug) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                                </h3>
                                <div class="text-xs text-gray-500 mt-1">{{ $post->category->name }} • {{ $post->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="flex items-center space-x-2 mt-2 md:mt-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $post->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $post->is_approved ? 'Approved' : 'Pending' }}
                                </span>
                                <span class="text-xs text-gray-500">{{ number_format($post->views_count) }} views</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="px-4 py-8 text-center text-gray-500">
                    <i class="fas fa-file-alt text-4xl mb-4 text-gray-300"></i>
                    <p>No posts yet. <a href="{{ route('user.posts.create') }}" class="text-blue-600 hover:text-blue-700">Create your first post</a></p>
                </div>
                @endif
            </div>
        </div>

        <!-- Popular Posts -->
        @if($popularPosts->count() > 0)
        <div class="mb-10">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Your Most Popular Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularPosts as $post)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full">
                    @if($post->featured_image)
                    <div class="h-36 bg-gray-200 overflow-hidden">
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                            <a href="{{ route('post.show', $post->slug) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                        </h3>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                            <span>{{ $post->category->name }}</span>
                            <span>{{ $post->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="mt-auto flex items-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $post->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $post->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                            <span class="text-xs text-gray-500">{{ number_format($post->views_count) }} views</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection
