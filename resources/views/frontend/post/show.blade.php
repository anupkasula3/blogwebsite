@extends('frontend.layout.main')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('meta_description', $post->excerpt)
@section('meta_keywords', $post->meta_keywords)
@section('meta_author', $post->author_name)

@if ($post->featured_image)
    @section('meta_image', asset('uploads/' . $post->featured_image))
@endif

@section('content')
    <div class="bg-white">

        <!-- Reading Progress Bar -->
        <div class="fixed top-0 left-0 w-full h-1 bg-gray-100 z-50">
            <div class="h-full bg-red-600 transition-all duration-300" id="reading-progress"></div>
        </div>

        <!-- Main Container -->
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-5 lg:px-5 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left Sidebar - Social Share -->
                <div class="hidden lg:block lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="flex flex-col items-center gap-3">
                            <!-- Comments Count -->
                            <div class="text-center mb-4">
                               
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($post->views_count) }} </div>
                                <div class="text-xs text-gray-500 uppercase">views</div>
                            </div>

                            <!-- Shares Count -->
                            @php
                        $wordCount = str_word_count(strip_tags($post->content));
                        $readingTime = max(1, (int) ceil($wordCount / 200));
                    @endphp
                            <div class="text-center mb-4">
                                <div class="text-2xl font-bold text-gray-900"><span>{{ $readingTime }} </span>
                                </div>
                                <div class="text-xs text-gray-500 uppercase">min read</div>
                            </div>

                            <!-- Social Share Buttons -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
            target="_blank" rel="noopener"
            class="w-12 h-12 bg-[#1877F2] hover:bg-blue-700 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share on Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>

        <!-- Twitter/X -->
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
            target="_blank" rel="noopener"
            class="w-12 h-12 bg-[#1DA1F2] hover:bg-blue-400 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share on Twitter/X">

<svg
  xmlns="http://www.w3.org/2000/svg"
  width="24"
  height="24"
  viewBox="0 0 24 24"
  fill="none"
  stroke="#ffffff"
  stroke-width="1.25"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
  <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
</svg>

        </a>

        <!-- LinkedIn -->
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
            target="_blank" rel="noopener"
            class="w-12 h-12 bg-[#0A66C2] hover:bg-blue-800 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share on LinkedIn">
            <i class="fab fa-linkedin-in"></i>
        </a>

        <!-- WhatsApp -->
        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}"
            target="_blank" rel="noopener"
            class="w-12 h-12 bg-[#25D366] hover:bg-green-600 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
            target="_blank" rel="noopener"
            class="w-12 h-12 bg-[#229ED9] hover:bg-blue-500 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share on Telegram">
            <i class="fab fa-telegram-plane"></i>
        </a>

        <!-- Reddit -->
        <a href="https://reddit.com/submit?url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}"
            target="_blank" rel="noopener"
            class="w-12 h-12 bg-[#FF4500] hover:bg-orange-600 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share on Reddit">
            <i class="fab fa-reddit-alien"></i>
        </a>

        <!-- Email -->
        <a href="mailto:?subject={{ rawurlencode($post->title) }}&body={{ rawurlencode(request()->url()) }}"
            class="w-12 h-12 bg-gray-700 hover:bg-gray-800 rounded-lg flex items-center justify-center text-white transition-colors"
            aria-label="Share via Email">
            <i class="fas fa-envelope"></i>
        </a>

        <!-- Copy Link -->
        <button type="button" onclick="copyToClipboard('{{ request()->url() }}')"
            class="w-12 h-12 bg-[#ff2953] hover:bg-pink-600 rounded-lg flex items-center justify-center text-white transition-colors cursor-pointer "
            aria-label="Copy Link">
            <i class="fas fa-link"></i>
        </button>
        <div id="copy-toast"
    class="hidden fixed bottom-5 left-5 bg-[#ff2953] text-white px-4 py-2 w-64 rounded-lg shadow-lg transition-opacity duration-300">
    Link copied to clipboard
</div>

<script>
function copyToClipboard(url) {
    navigator.clipboard.writeText(url).then(function() {
        const toast = document.getElementById('copy-toast');
        toast.classList.remove('hidden');      // Show toast
        toast.classList.add('opacity-100');    // Fade in
        toast.style.opacity = '1';             // Ensure visible

        setTimeout(() => {
            toast.style.opacity = '0';         // Fade out
            setTimeout(() => {
                toast.classList.add('hidden'); // Hide completely
            }, 300); // Match fade duration
        }, 2000); // Show for 2 seconds
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}
</script>

                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-8">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                        <a href="{{ url('/') }}" class="hover:text-red-600 transition-colors">Home</a>
                        <span>/</span>
                        <a href="{{ route('category.show', $post->category->slug) }}"
                            class="hover:text-red-600 transition-colors">{{ $post->category->name }}</a>
                    </nav>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-gray-900 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Featured Image -->
                    @if ($post->featured_image)
                        <div class="mb-8">
                            <img src="{{ asset('uploads/' . $post->featured_image) }}" 
                                alt="{{ $post->title }}"
                                class="w-full h-auto rounded-lg">
                        </div>
                    @endif

                    <!-- Excerpt/Lead Paragraph -->
                    <div class="text-lg text-gray-700 mb-6 leading-relaxed font-medium border-l-4 border-red-600 pl-4 bg-gray-50 py-4">
                        {{ $post->excerpt }}
                    </div>

                    <!-- Article Content -->
                    <article class="prose prose-lg max-w-none mb-8">
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
                        {!! $restContent !!}
                    </article>

                    <!-- Tags -->
                    @if ($post->tags)
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                @foreach (explode(',', $post->tags) as $tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-red-50 hover:text-red-600 transition-colors cursor-pointer">
                                        {{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Social Sharing (Mobile) -->
                    <div class="lg:hidden mb-8 pb-8 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h3>
                        <div class="flex flex-wrap gap-3">

<!-- Facebook -->
<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
    target="_blank" rel="noopener" class="share-btn-mobile bg-blue-600">
    <i class="fab fa-facebook-f"></i>
    <span>Facebook</span>
</a>

<!-- Twitter/X -->
<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
    target="_blank" rel="noopener" class="share-btn-mobile bg-gray-900">
    <i class="fab fa-x-twitter"></i>
    <span>Twitter</span>
</a>

<!-- LinkedIn -->
<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
    target="_blank" rel="noopener" class="share-btn-mobile bg-blue-700">
    <i class="fab fa-linkedin-in"></i>
    <span>LinkedIn</span>
</a>

<!-- WhatsApp -->
<a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}"
    target="_blank" rel="noopener" class="share-btn-mobile bg-green-500">
    <i class="fab fa-whatsapp"></i>
    <span>WhatsApp</span>
</a>

<!-- Telegram -->
<a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
    target="_blank" rel="noopener" class="share-btn-mobile bg-blue-400">
    <i class="fab fa-telegram-plane"></i>
    <span>Telegram</span>
</a>

<!-- Reddit -->
<a href="https://reddit.com/submit?url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}"
    target="_blank" rel="noopener" class="share-btn-mobile bg-orange-500">
    <i class="fab fa-reddit-alien"></i>
    <span>Reddit</span>
</a>

<!-- Email -->
<a href="mailto:?subject={{ rawurlencode($post->title) }}&body={{ rawurlencode(request()->url()) }}"
    class="share-btn-mobile bg-gray-700">
    <i class="fas fa-envelope"></i>
    <span>Email</span>
</a>

<!-- Copy Link -->
<button type="button" onclick="copyToClipboard('{{ request()->url() }}')"
    class="share-btn-mobile bg-pink-600">
    <i class="fas fa-link"></i>
    <span>Copy Link</span>
</button>

</div>

                        <div id="copy-toast" class="copy-toast hidden">
                            <i class="fas fa-check-circle mr-2"></i>
                            Link copied!
                        </div>
                    </div>

                    <!-- Author Info -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <div class="flex items-center gap-4">
                            @if ($post->isAdminPost())
                                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user-shield text-red-600 text-2xl"></i>
                                </div>
                            @else
                                <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                    alt="{{ $post->user->name ?? 'User' }}" 
                                    class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                            @endif
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-semibold text-gray-900">{{ $post->author_name }}</h4>
                                    @if ($post->isAdminPost())
                                        <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs font-medium">
                                            Admin
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    @if ($post->isAdminPost())
                                        Site Administrator
                                    @else
                                        {{ $post->user->bio ?: 'Contributing Writer' }}
                                    @endif
                                </p>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span><i class="far fa-calendar mr-1"></i>{{ $post->published_at->format('M j, Y') }}</span>
                                    <span><i class="far fa-clock mr-1"></i>  @php
                        $wordCount = str_word_count(strip_tags($post->content));
                        $readingTime = max(1, (int) ceil($wordCount / 200));
                    @endphp
                                    
                                    {{ $readingTime }} min read</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    @if (isset($prevPost) || isset($nextPost))
                        <nav class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                            @if (isset($prevPost))
                                <a href="{{ route('post.show', $prevPost->slug) }}"
                                    class="group border border-gray-200 rounded-lg p-4 hover:border-red-600 transition-colors">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-arrow-left text-gray-400 group-hover:text-red-600 mt-1"></i>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase mb-1">Previous</p>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-red-600 line-clamp-2">
                                                {{ $prevPost->title }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endif

                            @if (isset($nextPost))
                                <a href="{{ route('post.show', $nextPost->slug) }}"
                                    class="group border border-gray-200 rounded-lg p-4 hover:border-red-600 transition-colors text-right">
                                    <div class="flex items-start gap-3 justify-end">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase mb-1">Next</p>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-red-600 line-clamp-2">
                                                {{ $nextPost->title }}
                                            </p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-red-600 mt-1"></i>
                                    </div>
                                </a>
                            @endif
                        </nav>
                    @endif

                    <!-- Related Posts -->
                    @if ($relatedPosts->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                @foreach ($relatedPosts as $relatedPost)
                                    @include('frontend.component.postcomponent',['post'=>$relatedPost])
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar -->
                <div class="lg:col-span-3">
                    <div class="sticky top-24 space-y-6">




                       <!-- Meta Info Widget -->
                       <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3">Post Information</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600"><i class="far fa-eye mr-2"></i>Views</span>
                                    <span class="font-semibold">{{ number_format($post->views_count) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600"><i class="far fa-calendar mr-2"></i>Published</span>
                                    <span class="font-semibold">{{ $post->published_at->format('M j, Y') }}</span>
                                </div>
                                @if ($post->is_featured)
                                    <div class="flex items-center gap-2 px-3 py-2 bg-yellow-50 text-yellow-700 rounded-lg border border-yellow-200">
                                        <i class="fas fa-star"></i>
                                        <span class="font-medium">Featured Post</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        
                        <!-- Category Widget -->
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3">Category</h3>
                            <a href="{{ route('category.show', $post->category->slug) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-red-50 hover:text-red-600 rounded-lg text-gray-900 font-medium transition-colors">
                                <i class="fas fa-folder"></i>
                                <span>{{ $post->category->name }}</span>
                            </a>
                        </div>
                        
                        <!-- Upcoming Events Widget -->

                        <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-tags mr-2 text-blue-500"></i>
                        Categories
                    </h3>
                    <div class="space-y-2">
                        @foreach ($categories as $category)
                            <a href="{{ route('category.show', $category->slug) }}"
                                class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <span class="text-gray-700 font-medium">{{ $category->name }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                        
                      

                        <!-- Ad Space -->
                        <div class="bg-gray-100 rounded-lg p-6 text-center">
                            <p class="text-sm text-gray-500">Advertisement</p>
                            <div class="h-64 flex items-center justify-center">
                                <span class="text-gray-400">Ad Space 300x250</span>
                            </div>
                        </div>


                     
                    </div>
                </div>
            </div>
        </div>
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
                    const toast = document.getElementById('copy-toast');
                    if (toast) {
                        toast.classList.remove('hidden');
                        toast.classList.add('show');
                        setTimeout(() => {
                            toast.classList.remove('show');
                            toast.classList.add('hidden');
                        }, 2000);
                    }
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            }
        </script>
    @endpush

    @push('styles')
        <style>
            /* Mobile share buttons */
            .share-btn-mobile {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                border-radius: 8px;
                color: #fff;
                font-weight: 500;
                font-size: 14px;
                transition: all 0.2s ease;
            }

            .share-btn-mobile:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            /* Copy toast */
            .copy-toast {
                position: fixed;
                bottom: 24px;
                right: 24px;
                background: #ffffff;
                color: #111827;
                padding: 12px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                border: 1px solid #e5e7eb;
                z-index: 60;
                opacity: 0;
                transform: translateY(10px);
                transition: opacity 0.2s ease, transform 0.2s ease;
                font-weight: 500;
                display: flex;
                align-items: center;
            }

            .copy-toast.show {
                opacity: 1;
                transform: translateY(0);
            }

            .copy-toast i {
                color: #10b981;
            }

            /* Line clamp */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Prose styles */
            .prose {
                color: #374151;
                line-height: 1.8;
            }

            .prose h1,
            .prose h2,
            .prose h3,
            .prose h4,
            .prose h5,
            .prose h6 {
                color: #111827;
                font-weight: 700;
                margin-top: 2em;
                margin-bottom: 0.75em;
            }

            .prose h2 {
                font-size: 1.875em;
            }

            .prose h3 {
                font-size: 1.5em;
            }

            .prose p {
                margin-bottom: 1.25em;
            }

            .prose a {
                color: #dc2626;
                text-decoration: none;
            }

            .prose a:hover {
                text-decoration: underline;
            }

            .prose ul,
            .prose ol {
                margin-bottom: 1.5em;
                padding-left: 1.75em;
            }

            .prose li {
                margin-bottom: 0.5em;
            }

            .prose blockquote {
                border-left: 4px solid #dc2626;
                padding-left: 1.5em;
                margin: 2em 0;
                font-style: italic;
                color: #6b7280;
            }

            .prose code {
                background-color: #f3f4f6;
                color: #1f2937;
                padding: 0.25em 0.5em;
                border-radius: 0.375rem;
                font-size: 0.875em;
            }

            .prose pre {
                background-color: #1f2937;
                color: #f9fafb;
                padding: 1.5em;
                border-radius: 0.5rem;
                overflow-x: auto;
                margin: 2em 0;
            }

            .prose pre code {
                background: none;
                color: inherit;
                padding: 0;
            }

            .prose img {
                border-radius: 0.5rem;
                margin: 2em 0;
            }

            .prose strong {
                color: #111827;
                font-weight: 600;
            }
        </style>
    @endpush
@endsection