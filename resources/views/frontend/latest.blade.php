@extends('frontend.layout.main')

@section('title', 'Latest Posts - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Read the latest articles and blog posts from our community of writers.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Latest Posts</h1>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
            Stay up to date with the freshest content from our community of writers and thinkers.
        </p>
    </div>
</section>

<!-- Posts Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                @if($post->featured_image)
                <div class="h-48 bg-gray-200">
                    <img src="{{ Storage::url($post->featured_image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            {{ $post->category->name }}
                        </span>
                        <span class="ml-auto text-sm text-gray-500">
                            {{ $post->published_at->diffForHumans() }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                        <a href="{{ route('post.show', $post->slug) }}" class="hover:text-purple-600 transition-colors">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($post->isAdminPost())
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-user-shield text-purple-600 text-sm"></i>
                                </div>
                            @else
                                <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                     alt="{{ $post->user->name ?? 'User' }}"
                                     class="w-8 h-8 rounded-full">
                            @endif
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-700">{{ $post->author_name }}</span>
                                @if($post->isAdminPost())
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-user-shield mr-1"></i>
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user mr-1"></i>
                                        User
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span><i class="fas fa-eye mr-1"></i>{{ number_format($post->views_count) }}</span>
                            <span><i class="fas fa-clock mr-1"></i>{{ $post->reading_time }} min read</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Posts Found</h3>
            <p class="text-gray-600">Posts will appear here once they are published.</p>
        </div>
        @endif
    </div>
</section>

<!-- Sidebar Advertisement -->
@if(isset($sidebarAd) && $sidebarAd)
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="ad-sidebar rounded-xl p-8 text-center">
            <a href="{{ $sidebarAd->link }}" target="_blank"
               onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')"
               class="block hover:opacity-90 transition-opacity">
                @if($sidebarAd->image)
                <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="mx-auto mb-4 max-h-32">
                @endif
                <h3 class="text-2xl font-bold mb-3">{{ $sidebarAd->title }}</h3>
                <p class="text-lg mb-4">{{ $sidebarAd->description }}</p>
                <span class="inline-block bg-white/20 px-6 py-3 rounded-lg font-semibold">
                    Learn More →
                </span>
            </a>
        </div>
    </div>
</section>
@endif

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection
