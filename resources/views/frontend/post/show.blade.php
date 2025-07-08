@extends('frontend.layout.main')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', $post->excerpt)
@section('meta_keywords', $post->meta_keywords)
@section('meta_author', $post->author_name)

@if($post->featured_image)
@section('meta_image', Storage::url($post->featured_image))
@endif

@section('content')
<!-- Reading Progress Bar -->
<div class="fixed top-0 left-0 w-full h-1 bg-gray-200">
    <div class="h-full bg-gradient-to-r from-purple-600 to-blue-600 transition-all duration-300" id="reading-progress"></div>
</div>

<!-- Post Header -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('category.show', $post->category->slug) }}"
               class="inline-flex items-center px-4 py-2 bg-white/20 rounded-lg text-sm font-medium hover:bg-white/30 transition-colors">
                <i class="fas fa-folder mr-2"></i>
                {{ $post->category->name }}
            </a>
        </div>

        <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">{{ $post->title }}</h1>

        <p class="text-xl text-gray-300 mb-8 leading-relaxed">{{ $post->excerpt }}</p>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                @if($post->isAdminPost())
                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-user-shield text-purple-600 text-xl"></i>
                    </div>
                @else
                    <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                         alt="{{ $post->user->name ?? 'User' }}"
                         class="w-12 h-12 rounded-full">
                @endif
                <div>
                    <div class="flex items-center space-x-2">
                        <p class="font-semibold">{{ $post->author_name }}</p>
                        @if($post->isAdminPost())
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                <i class="fas fa-user-shield mr-1"></i>
                                Admin
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-user mr-1"></i>
                                User
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-300">{{ $post->published_at->format('F j, Y') }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-6 text-sm">
                <span class="flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    {{ number_format($post->views_count) }} views
                </span>
                <span class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    {{ $post->reading_time }} min read
                </span>
                @if($post->is_featured)
                <span class="flex items-center px-3 py-1 bg-yellow-500 text-yellow-900 rounded-full text-xs font-medium">
                    <i class="fas fa-star mr-1"></i>
                    Featured
                </span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Post Content -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if($post->featured_image)
                <div class="mb-8">
                    <img src="{{ Storage::url($post->featured_image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-96 object-cover rounded-xl">
                </div>
                @endif

                <article class="prose prose-lg max-w-none">
                    {!! $post->content !!}
                </article>

                <!-- Tags -->
                @if($post->tags)
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $post->tags) as $tag)
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                            {{ trim($tag) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Social Sharing -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this post</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                           target="_blank"
                           class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook mr-2"></i>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                           target="_blank"
                           class="flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter mr-2"></i>
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                           target="_blank"
                           class="flex items-center px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                            <i class="fab fa-linkedin mr-2"></i>
                            LinkedIn
                        </a>
                        <button onclick="copyToClipboard('{{ request()->url() }}')"
                                class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-link mr-2"></i>
                            Copy Link
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Author Info -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">About the Author</h3>
                    <div class="flex items-center mb-4">
                        @if($post->isAdminPost())
                            <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                <i class="fas fa-user-shield text-purple-600 text-2xl"></i>
                            </div>
                        @else
                            <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                 alt="{{ $post->user->name ?? 'User' }}"
                                 class="w-16 h-16 rounded-full mr-4">
                        @endif
                        <div>
                            <div class="flex items-center space-x-2 mb-1">
                                <h4 class="font-semibold text-gray-900">{{ $post->author_name }}</h4>
                                @if($post->isAdminPost())
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-user-shield mr-1"></i>
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user mr-1"></i>
                                        User
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">
                                @if($post->isAdminPost())
                                    Site Administrator
                                @else
                                    {{ $post->user->bio ?: 'Blog writer' }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @if(!$post->isAdminPost())
                        <a href="{{ route('author.show', $post->user->id) }}"
                           class="block w-full text-center bg-purple-600 text-white py-2 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                            View Profile
                        </a>
                    @endif
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Related Posts</h3>
                    <div class="space-y-4">
                        @foreach($relatedPosts as $relatedPost)
                        <article class="flex gap-3">
                            @if($relatedPost->featured_image)
                            <div class="w-16 h-16 flex-shrink-0">
                                <img src="{{ Storage::url($relatedPost->featured_image) }}"
                                     alt="{{ $relatedPost->title }}"
                                     class="w-full h-full object-cover rounded-lg">
                            </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2">
                                    <a href="{{ route('post.show', $relatedPost->slug) }}" class="hover:text-purple-600 transition-colors">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h4>
                                <div class="flex items-center text-xs text-gray-500">
                                    <span>{{ $relatedPost->published_at->diffForHumans() }}</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ number_format($relatedPost->views_count) }} views</span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Sidebar Advertisement -->
                @if(isset($sidebarAd) && $sidebarAd)
                <div class="ad-sidebar rounded-xl p-6 text-center">
                    <a href="{{ $sidebarAd->link }}" target="_blank"
                       onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')"
                       class="block hover:opacity-90 transition-opacity">
                        @if($sidebarAd->image)
                        <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="mx-auto mb-4 max-h-32">
                        @endif
                        <h3 class="font-bold text-lg mb-2">{{ $sidebarAd->title }}</h3>
                        <p class="text-sm mb-4">{{ $sidebarAd->description }}</p>
                        <span class="inline-block bg-white/20 px-4 py-2 rounded-lg text-sm font-medium">
                            Learn More →
                        </span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
// Reading Progress Bar
window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;
    document.getElementById('reading-progress').style.width = scrollPercent + '%';
});

// Copy to Clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}

// Track ad impressions
document.addEventListener('DOMContentLoaded', function() {
    const adElements = document.querySelectorAll('[onclick*="trackAdClick"]');
    adElements.forEach(function(element) {
        const adId = element.getAttribute('onclick').match(/trackAdClick\((\d+)/)[1];
        const position = element.getAttribute('onclick').match(/,\s*'([^']+)'/)[1];

        // Track impression
        fetch('/api/ads/impression', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ ad_id: adId, position: position })
        });
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

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h1 { font-size: 2.25rem; }
.prose h2 { font-size: 1.875rem; }
.prose h3 { font-size: 1.5rem; }
.prose h4 { font-size: 1.25rem; }

.prose p {
    margin-bottom: 1.5rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid #8b5cf6;
    padding-left: 1rem;
    margin: 2rem 0;
    font-style: italic;
    color: #6b7280;
}

.prose code {
    background-color: #f3f4f6;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
}

.prose pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 2rem 0;
}

.prose img {
    border-radius: 0.5rem;
    margin: 2rem 0;
}
</style>
@endpush
@endsection
