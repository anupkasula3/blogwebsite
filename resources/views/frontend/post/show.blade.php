@extends('frontend.layout.main')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', $post->excerpt)
@section('meta_keywords', $post->meta_keywords)
@section('meta_author', $post->author_name)

@if ($post->featured_image)
    @section('meta_image', Storage::url($post->featured_image))
@endif

@section('content')
    <div class=" mx-auto max-w-screen-2xl">

        <!-- Reading Progress Bar -->
        <div class="fixed top-0 left-0 w-full h-1 bg-gray-200">
            <div class="h-full bg-gradient-to-r from-purple-600 to-blue-600 transition-all duration-300"
                id="reading-progress">
            </div>
        </div>

        <!-- Post Header -->
        <section
            class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 py-6 sm:py-10 rounded-b-3xl shadow-lg mb-6">
            <div class="absolute bottom-0 left-0 w-full pointer-events-none z-0">
                <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-full h-8 sm:h-16 md:h-24">
                    <path fill="url(#wave-gradient)" fill-opacity="0.3"
                        d="M0,80 C480,120 960,40 1440,80 L1440,100 L0,100 Z"></path>
                    <defs>
                        <linearGradient id="wave-gradient" x1="0" y1="0" x2="1440" y2="0"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#6366f1" />
                            <stop offset="1" stop-color="#a21caf" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div class="relative z-10 flex flex-col items-center justify-center px-2 sm:px-4 md:px-8">
                <a href="{{ route('category.show', $post->category->slug) }}"
                    class="mb-3 inline-flex items-center px-4 py-1.5 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full text-sm font-bold shadow hover:from-blue-600 hover:to-purple-600 transition">
                    <i class="fas fa-folder mr-2"></i> {{ $post->category->name }}
                </a>
                <h1
                    class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold mb-2 text-white text-center leading-tight drop-shadow-lg">
                    {{ $post->title }}
                </h1>
                <p
                    class="text-base sm:text-lg md:text-xl text-slate-200 mb-4 sm:mb-6 leading-relaxed font-medium text-center max-w-2xl">
                    {{ $post->excerpt }}
                </p>
                <div class="flex flex-wrap justify-center gap-2 text-xs sm:text-sm font-medium w-full">
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/80 rounded-full shadow">
                        @if ($post->isAdminPost())
                            <span class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center"><i
                                    class="fas fa-user-shield text-purple-600 text-sm"></i></span>
                        @else
                            <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                alt="{{ $post->user->name ?? 'User' }}" class="w-6 h-6 rounded-full object-cover">
                        @endif
                        <span class="font-semibold text-gray-800">{{ $post->author_name }}</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/80 rounded-full shadow">
                        <i class="fas fa-calendar-alt text-blue-500"></i>
                        <span>{{ $post->published_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/80 rounded-full shadow">
                        <i class="fas fa-eye text-blue-500"></i>
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>
                    @if ($post->is_featured)
                        <div class="flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full shadow">
                            <i class="fas fa-star"></i>
                            <span>Featured</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Ad Banner Below Top Section -->
        <div class="flex justify-center py-2 sm:py-4">
            @if (isset($belowTitleAd) && $belowTitleAd)
                <a href="{{ $belowTitleAd->link }}" target="_blank"
                    class="block w-full max-w-xs sm:max-w-md md:max-w-xl lg:max-w-2xl">
                    <img src="{{ asset('uploads/' . $belowTitleAd->image) }}" alt="{{ $belowTitleAd->title }}"
                        class="rounded-xl w-full object-contain max-h-20 sm:max-h-32 mx-auto">
                </a>
            @else
                <img src="https://placehold.co/728x90?text=Advertisement" alt="Ad Banner"
                    class="rounded-xl w-full object-contain max-h-20 sm:max-h-32 mx-auto">
            @endif
        </div>

        <!-- Post Content -->
        <section class=" bg-white">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10 mb-8">
                            @if ($post->featured_image)
                                <div class="mb-8">
                                    <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-full h-96 object-contain rounded-xl border-4 border-white shadow-md">
                                </div>
                            @endif

                            <article class="prose prose-lg max-w-none">
                                @php
                                    $content = $post->content;
                                    $firstParagraph = '';
                                    $restContent = $content;
                                    if (preg_match('/<p>(.*?)<\/p>/is', $content, $matches)) {
                                        $firstParagraph = $matches[0];
                                        $restContent = str_replace($firstParagraph, '', $content);
                                    }
                                @endphp
                                {!! $firstParagraph !!}
                                <!-- Inline Advertisement -->
                                <div class="my-8 flex justify-center">
                                    <img src="https://placehold.co/468x60?text=Inline+Ad" alt="Inline Ad"
                                        class="rounded-lg shadow w-full max-w-md object-contain">
                                </div>
                                {!! $restContent !!}
                            </article>

                            <!-- Tags -->
                            @if ($post->tags)
                                <div class="mt-8 pt-8 border-t border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach (explode(',', $post->tags) as $tag)
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
                                <div class="flex flex-wrap space-x-4">
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
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24">
                            <!-- Author Info -->
                            <div class="bg-white rounded-xl p-6 mb-8 shadow hover:shadow-lg transition-shadow">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">About the Author</h3>
                                <div class="flex items-center mb-4">
                                    @if ($post->isAdminPost())
                                        <div
                                            class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                            <i class="fas fa-user-shield text-purple-600 text-2xl"></i>
                                        </div>
                                    @else
                                        <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                            alt="{{ $post->user->name ?? 'User' }}" class="w-16 h-16 rounded-full mr-4">
                                    @endif
                                    <div>
                                        <div class="flex items-center space-x-2 mb-1">
                                            <h4 class="font-semibold text-gray-900">{{ $post->author_name }}</h4>
                                            @if ($post->isAdminPost())
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                                    <i class="fas fa-user-shield mr-1"></i>
                                                    Admin
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-user mr-1"></i>
                                                    User
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            @if ($post->isAdminPost())
                                                Site Administrator
                                            @else
                                                {{ $post->user->bio ?: 'Blog writer' }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if (!$post->isAdminPost())
                                    <a href="{{ route('author.show', $post->user->id) }}"
                                        class="block w-full text-center bg-purple-600 text-white py-2 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                                        View Profile
                                    </a>
                                @endif
                            </div>

                            <!-- Related Posts -->
                            @if ($relatedPosts->count() > 0)
                                <!-- Ad Banner Above Related Posts -->
                                <div class="flex justify-center py-2 sm:py-4">
                                    <img src="https://placehold.co/728x90?text=Advertisement" alt="Ad Banner"
                                        class="rounded-xl w-full object-contain max-h-20 sm:max-h-32 mx-auto">
                                </div>
                                <div class="bg-white rounded-xl p-3 sm:p-6 mb-8 shadow hover:shadow-lg transition-shadow">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Related Posts
                                    </h3>
                                    <div class="space-y-2 sm:space-y-4">
                                        @foreach ($relatedPosts as $relatedPost)
                                            <article
                                                class="flex gap-2 sm:gap-3 hover:bg-blue-50 rounded-lg p-1 sm:p-2 transition">
                                                @if ($relatedPost->featured_image)
                                                    <div class="w-12 h-12 sm:w-16 sm:h-16 flex-shrink-0">
                                                        <img src="{{ asset('uploads/' . $relatedPost->featured_image) }}"
                                                            alt="{{ $relatedPost->title }}"
                                                            class="w-full h-full object-cover rounded-lg">
                                                    </div>
                                                @endif
                                                <div class="flex-1 min-w-0">
                                                    <h4
                                                        class="font-semibold text-gray-900 mb-1 line-clamp-2 text-sm sm:text-base">
                                                        <a href="{{ route('post.show', $relatedPost->slug) }}"
                                                            class="hover:text-purple-600 transition-colors">
                                                            {{ $relatedPost->title }}
                                                        </a>
                                                    </h4>
                                                    <div class="flex items-center text-xs text-gray-500 flex-wrap gap-1">
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
                            @if (isset($sidebarAd) && $sidebarAd)
                                <div
                                    class="ad-sidebar rounded-xl p-6 text-center border border-blue-200 shadow-lg hover:shadow-xl transition-shadow sticky top-32 bg-gradient-to-br from-blue-50 to-blue-100">
                                    <a href="{{ $sidebarAd->link }}" target="_blank"
                                        onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')"
                                        class="block hover:opacity-90 transition-opacity">
                                        @if ($sidebarAd->image)
                                            <img src="{{ asset('uploads/' . $sidebarAd->image) }}"
                                                alt="{{ $sidebarAd->title }}"
                                                class="mx-auto mb-4 max-h-32 rounded-lg shadow">
                                        @endif
                                        <h3 class="font-bold text-lg mb-2 text-blue-900">{{ $sidebarAd->title }}</h3>
                                        <p class="text-sm mb-4 text-blue-800">{{ $sidebarAd->description }}</p>
                                        <span
                                            class="inline-block bg-white/40 px-4 py-2 rounded-lg text-sm font-medium text-blue-900">
                                            Learn More →
                                        </span>
                                    </a>
                                </div>
                            @else
                                <div
                                    class="rounded-xl p-6 text-center border border-blue-100 shadow sticky top-32 bg-gradient-to-br from-blue-50 to-blue-100">
                                    <img src="https://placehold.co/300x250?text=Sidebar+Ad" alt="Sidebar Ad"
                                        class="mx-auto mb-4 max-h-32 rounded-lg shadow">
                                    <h3 class="font-bold text-lg mb-2 text-blue-900">Advertisement</h3>
                                    <p class="text-sm mb-4 text-blue-800">Your ad could be here!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            ad_id: adId,
                            position: position
                        })
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

            .prose h1,
            .prose h2,
            .prose h3,
            .prose h4,
            .prose h5,
            .prose h6 {
                color: #111827;
                font-weight: 700;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .prose h1 {
                font-size: 2.25rem;
            }

            .prose h2 {
                font-size: 1.875rem;
            }

            .prose h3 {
                font-size: 1.5rem;
            }

            .prose h4 {
                font-size: 1.25rem;
            }

            .prose p {
                margin-bottom: 1.5rem;
            }

            .prose ul,
            .prose ol {
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
