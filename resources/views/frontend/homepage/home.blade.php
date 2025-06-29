@extends('frontend.layout.main')

@section('title', \App\Models\Setting::get('site_name', 'MyBlogSite') . ' - ' . \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination'))
@section('meta_description', 'Discover amazing stories, insights, and knowledge on our blog platform. Read the latest articles from top categories.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Welcome to <span class="text-gradient">MyBlogSite</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto">
                Discover amazing stories, insights, and knowledge from our community of writers and thinkers.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('latest') }}" class="bg-white text-purple-900 px-8 py-4 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity">
                    <i class="fas fa-newspaper mr-2"></i>
                    Read Latest Posts
                </a>
                <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-purple-900 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Join Our Community
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Posts Section -->
@if($featuredPosts->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Posts</h2>
            <p class="text-xl text-gray-600">Handpicked articles you don't want to miss</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
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
    </div>
</section>
@endif

<!-- Content Advertisement -->
@if(isset($contentAd) && $contentAd)
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="ad-content rounded-xl p-6 text-center">
            <a href="{{ $contentAd->link }}" target="_blank"
               onclick="trackAdClick({{ $contentAd->id }}, 'content')"
               class="block hover:opacity-90 transition-opacity">
                @if($contentAd->image)
                <img src="{{ Storage::url($contentAd->image) }}" alt="{{ $contentAd->title }}" class="mx-auto mb-4 max-h-32">
                @endif
                <h3 class="text-xl font-bold mb-2">{{ $contentAd->title }}</h3>
                <p class="text-lg">{{ $contentAd->description }}</p>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Latest Posts Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Latest Posts</h2>
                <p class="text-xl text-gray-600">Fresh content from our writers</p>
            </div>
            <a href="{{ route('latest') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                View All
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestPosts as $post)
            <article class="bg-white rounded-lg shadow-md overflow-hidden card-hover">
                @if($post->featured_image)
                <div class="h-40 bg-gray-200">
                    <img src="{{ Storage::url($post->featured_image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $post->category->name }}
                        </span>
                        <span class="ml-auto text-xs text-gray-500">
                            {{ $post->published_at->diffForHumans() }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('post.show', $post->slug) }}" class="hover:text-purple-600 transition-colors">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $post->excerpt }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <div class="flex items-center space-x-2">
                            @if($post->isAdminPost())
                                <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-user-shield text-purple-600 text-xs"></i>
                                </div>
                            @else
                                <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                     alt="{{ $post->user->name ?? 'User' }}"
                                     class="w-6 h-6 rounded-full">
                            @endif
                            <div class="flex items-center space-x-1">
                                <span>{{ $post->author_name }}</span>
                                @if($post->isAdminPost())
                                    <span class="inline-flex items-center px-1 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-user-shield mr-1"></i>
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-1 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user mr-1"></i>
                                        User
                                    </span>
                                @endif
                            </div>
                        </div>
                        <span><i class="fas fa-eye mr-1"></i>{{ number_format($post->views_count) }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Explore Categories</h2>
            <p class="text-xl text-gray-600">Find content that interests you</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}"
               class="group bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl p-6 text-center hover:shadow-lg transition-all duration-300">
                @if($category->image)
                <img src="{{ Storage::url($category->image) }}"
                     alt="{{ $category->name }}"
                     class="w-16 h-16 mx-auto mb-4 rounded-lg object-cover">
                @else
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder text-white text-2xl"></i>
                </div>
                @endif
                <h3 class="font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                    {{ $category->name }}
                </h3>
                <p class="text-sm text-gray-600 mb-3">{{ $category->posts_count }} posts</p>
                <p class="text-xs text-gray-500 line-clamp-2">{{ $category->description }}</p>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-6 py-3 border border-purple-600 text-purple-600 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition-colors">
                View All Categories
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-gradient-to-r from-purple-900 to-blue-900 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Stay Updated</h2>
        <p class="text-xl text-gray-300 mb-8">
            Subscribe to our newsletter and never miss our latest posts and updates.
        </p>
        <form class="max-w-md mx-auto flex gap-4" id="newsletter-form">
            <input type="email" name="email" placeholder="Enter your email"
                   class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500">
            <button type="submit" class="bg-white text-purple-900 px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                Subscribe
            </button>
        </form>
        <p class="text-sm text-gray-400 mt-4">We respect your privacy. Unsubscribe at any time.</p>
    </div>
</section>

@push('scripts')
<script>
document.getElementById('newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[name="email"]').value;

    fetch('/newsletter/subscribe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Thank you for subscribing!');
            this.reset();
        } else {
            alert('Something went wrong. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
});
</script>
@endpush

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
