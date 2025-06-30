@extends('user.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Welcome banner -->
    <div class="relative bg-gradient-to-r from-purple-600 to-blue-600 p-6 sm:p-8 rounded-2xl overflow-hidden mb-8 shadow-lg">
        <!-- Background illustration -->
        <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
            <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                    <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                    <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                        <stop stop-color="#818CF8" offset="0%" />
                        <stop stop-color="#6366F1" offset="100%" />
                    </linearGradient>
                    <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                        <stop stop-color="#4F46E5" offset="0%" />
                        <stop stop-color="#4338CA" stop-opacity="0" offset="100%" />
                    </linearGradient>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <g transform="rotate(64 36.592 105.604)">
                        <mask id="welcome-d" fill="#fff">
                            <use xlink:href="#welcome-a" />
                        </mask>
                        <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                        <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                    </g>
                    <g transform="rotate(-51 91.324 -105.372)">
                        <mask id="welcome-f" fill="#fff">
                            <use xlink:href="#welcome-e" />
                        </mask>
                        <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                        <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                    </g>
                    <g transform="rotate(44 61.546 392.623)">
                        <mask id="welcome-h" fill="#fff">
                            <use xlink:href="#welcome-g" />
                        </mask>
                        <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                        <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                    </g>
                </g>
            </svg>
        </div>
        <!-- Content -->
        <div class="relative">
            <h1 class="text-2xl md:text-3xl text-white font-bold mb-1">Welcome back, {{ auth()->user()->name }} 👋</h1>
            <p class="text-indigo-200">Here's a snapshot of your content's performance. Keep up the great work!</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100">
                <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Posts</div>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['total_posts'] }}</div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-green-100">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Approved</div>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['approved_posts'] }}</div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-100">
                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Pending</div>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['pending_posts'] }}</div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-purple-100">
                <i class="fas fa-eye text-purple-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Views</div>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_views']) }}</div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Recent Posts -->
        <div class="col-span-12 xl:col-span-8 bg-white shadow-lg rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Recent Posts</h2>
                <a href="{{ route('user.posts.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">View All</a>
            </div>
            <div class="overflow-x-auto">
                @if($recentPosts->count() > 0)
                <table class="w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50 rounded-sm">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Post Title</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Views</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Status</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-right">Date</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @foreach($recentPosts as $post)
                        <tr>
                            <td class="p-2">
                                <a href="{{ route('user.posts.show', $post) }}" class="font-medium text-gray-800 hover:text-purple-600">{{ $post->title }}</a>
                            </td>
                            <td class="p-2 text-center text-gray-600">{{ number_format($post->views_count) }}</td>
                            <td class="p-2 text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $post->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $post->is_approved ? 'Approved' : 'Pending' }}
                                </span>
                            </td>
                            <td class="p-2 text-right text-gray-600">{{ $post->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center py-8">
                    <i class="fas fa-file-alt text-4xl mb-4 text-gray-300"></i>
                    <p class="text-gray-500">No posts yet. <a href="{{ route('user.posts.create') }}" class="text-purple-600 hover:text-purple-800 font-medium">Create your first post</a></p>
                </div>
                @endif
            </div>
        </div>

        <!-- Popular Posts -->
        <div class="col-span-12 xl:col-span-4 bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Popular Posts</h2>
            @if($popularPosts->count() > 0)
            <ul class="space-y-4">
                @foreach($popularPosts as $post)
                <li class="flex items-start space-x-3">
                    <div class="w-16 h-16 rounded-lg bg-gray-200 overflow-hidden flex-shrink-0">
                        @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                            <i class="fas fa-image text-2xl text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('user.posts.show', $post) }}" class="font-semibold text-gray-800 hover:text-purple-600 text-sm leading-tight line-clamp-2">{{ $post->title }}</a>
                        <div class="text-xs text-gray-500 mt-1">{{ number_format($post->views_count) }} views</div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center py-8">
                <i class="fas fa-chart-bar text-4xl mb-4 text-gray-300"></i>
                <p class="text-gray-500">No popular posts to show yet.</p>
            </div>
            @endif
        </div>
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
