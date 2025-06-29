@extends('frontend.layout.main')

@section('title', 'Search Results for "' . $query . '" - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Search results for "' . $query . '" on our blog platform.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Search Results</h1>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
            Showing results for "<span class="font-semibold">{{ $query }}</span>"
        </p>

        <!-- Search Form -->
        <div class="mt-8 max-w-2xl mx-auto">
            <form action="{{ route('search') }}" method="GET" class="flex gap-4">
                <input type="text" name="q" value="{{ $query }}" placeholder="Search articles..."
                       class="flex-1 px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 text-lg">
                <button type="submit" class="bg-white text-purple-900 px-8 py-4 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($posts->count() > 0)
        <div class="mb-8">
            <p class="text-lg text-gray-600">
                Found <span class="font-semibold text-purple-600">{{ $posts->total() }}</span> result(s) for "<span class="font-semibold">{{ $query }}</span>"
            </p>
        </div>

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
                            {!! str_ireplace($query, '<mark class="bg-yellow-200">' . $query . '</mark>', $post->title) !!}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {!! str_ireplace($query, '<mark class="bg-yellow-200">' . $query . '</mark>', $post->excerpt) !!}
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($post->isAdminPost())
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-user-shield text-purple-600 text-sm"></i>
                                </div>
                            @else
                                <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                     alt="{{ $post->author_name }}"
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
            {{ $posts->appends(['q' => $query])->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Results Found</h3>
            <p class="text-gray-600 mb-6">
                We couldn't find any posts matching "<span class="font-semibold">{{ $query }}</span>"
            </p>
            <div class="space-y-4">
                <p class="text-sm text-gray-500">Try these suggestions:</p>
                <ul class="text-sm text-gray-500 space-y-2">
                    <li>• Check your spelling</li>
                    <li>• Try different keywords</li>
                    <li>• Use more general terms</li>
                    <li>• Browse our <a href="{{ route('categories.index') }}" class="text-purple-600 hover:text-purple-700">categories</a></li>
                </ul>
            </div>
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
                <img src="{{ Storage::url($sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="mx-auto mb-4 max-h-32">
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

mark {
    padding: 0 2px;
    border-radius: 2px;
}
</style>
@endpush
@endsection
