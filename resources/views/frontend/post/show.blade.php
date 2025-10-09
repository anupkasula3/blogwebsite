@extends('frontend.layout.main')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('meta_description', $post->excerpt)
@section('meta_keywords', $post->meta_keywords)
@section('meta_author', $post->author_name)

@if ($post->featured_image)
    @section('meta_image', asset('uploads/' . $post->featured_image))
@endif

@section('content')
    <div class="  mb-10">

        <!-- Reading Progress Bar -->
        <div class="fixed top-0 left-0 w-full h-1 bg-gray-200">
            <div class="h-full bg-gradient-to-r from-[#ff2953] to-[#ff6883] transition-all duration-300"
                id="reading-progress">
            </div>
        </div>

        <!-- Post Header -->
        <section
            class="relative  overflow-hidden bg-gradient-to-r from-[#ff2953] to-[#c51f42] py-5 sm:py-7   shadow-lg mb-3">

            <div class="relative z-10 flex flex-col items-center justify-center px-3 sm:px-6 md:px-10">
                <div class="flex items-center gap-2 text-xs text-white/80 mb-3">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                    <span>/</span>
                    <a href="{{ route('category.show', $post->category->slug) }}"
                        class="hover:text-white transition-colors">{{ $post->category->name }}</a>
                </div>
                <h1 
    class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 text-white text-center leading-tight drop-shadow">
    {{ $post->title }}
</h1>
<p 
    class="text-sm sm:text-base md:text-lg text-white mb-4 leading-relaxed font-medium text-center max-w-screen-2xl mx-auto">
    {{ $post->excerpt }}
</p>

                <div class="flex flex-wrap justify-center gap-2 text-xs sm:text-sm font-medium w-full">
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/90 rounded-full shadow meta-chip">
                        @if ($post->isAdminPost())
                            <span class="w-6 h-6 rounded-full bg-rose-100 flex items-center justify-center"><i
                                    class="fas fa-user-shield text-rose-600 text-sm"></i></span>
                        @else
                            <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}"
                                alt="{{ $post->user->name ?? 'User' }}" class="w-6 h-6 rounded-full object-cover">
                        @endif
                        <span class="font-semibold text-gray-800">{{ $post->author_name }}</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/90 rounded-full shadow meta-chip">
                        <i class="fas fa-calendar-alt text-rose-500"></i>
                        <span>{{ $post->published_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/90 rounded-full shadow meta-chip">
                        <i class="fas fa-eye text-rose-500"></i>
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>
                    @php
                        $wordCount = str_word_count(strip_tags($post->content));
                        $readingTime = max(1, (int) ceil($wordCount / 200));
                    @endphp
                    <div class="flex items-center gap-2 px-3 py-1 bg-white/90 rounded-full shadow meta-chip">
                        <i class="fas fa-clock text-rose-500"></i>
                        <span>{{ $readingTime }} min read</span>
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


        <!-- Post Content -->
        <section class=" mx-auto max-w-screen-2xl">
            <div class=" px-4">
                <div class="grid  grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <div class="  mb-6">
                            @if ($post->featured_image)
                                <div class="mb-6">
                                    <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-full rounded-xl border-4 border-white ">
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

                                {!! $restContent !!}
                            </article>



                            <!-- Tags -->
                            @if ($post->tags)
                                <div class="mt-8 pt-8 border-t border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach (explode(',', $post->tags) as $tag)
                                            <span
                                                class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-rose-50 hover:text-rose-700 transition">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Social Sharing -->
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this post</h3>
                                <div class="flex flex-wrap gap-3">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank" rel="noopener" class="share-btn bg-[#1877F2]"
                                        aria-label="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i><span>Facebook</span>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                                        target="_blank" rel="noopener" class="share-btn bg-[#1DA1F2]"
                                        aria-label="Share on Twitter/X">
                                        <i class="fab fa-x-twitter"></i><span>Twitter/X</span>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                        target="_blank" rel="noopener" class="share-btn bg-[#0A66C2]"
                                        aria-label="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in"></i><span>LinkedIn</span>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}"
                                        target="_blank" rel="noopener" class="share-btn bg-[#25D366]"
                                        aria-label="Share on WhatsApp">
                                        <i class="fab fa-whatsapp"></i><span>WhatsApp</span>
                                    </a>
                                    <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                                        target="_blank" rel="noopener" class="share-btn bg-[#229ED9]"
                                        aria-label="Share on Telegram">
                                        <i class="fab fa-telegram-plane"></i><span>Telegram</span>
                                    </a>
                                    <a href="https://reddit.com/submit?url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}"
                                        target="_blank" rel="noopener" class="share-btn bg-[#FF4500]"
                                        aria-label="Share on Reddit">
                                        <i class="fab fa-reddit-alien"></i><span>Reddit</span>
                                    </a>
                                    <a href="mailto:?subject={{ rawurlencode($post->title) }}&body={{ rawurlencode(request()->url()) }}"
                                        class="share-btn bg-gray-700">
                                        <i class="fas fa-envelope"></i><span>Email</span>
                                    </a>
                                    <button type="button" onclick="copyToClipboard('{{ request()->url() }}')"
                                        class="share-btn bg-[#ff2953]">
                                        <i class="fas fa-link"></i><span>Copy Link</span>
                                    </button>
                                </div>
                                <div id="copy-toast" class="copy-toast hidden">Link copied to clipboard</div>
                            </div>

                            <!-- Related Posts Grid (Main Content) -->
                            @if ($relatedPosts->count() > 0)


                                <div class="mt-8">
                                    <div class="flex items-center justify-between mb-4 border-t border-t-gray-200">
                                        <h3 class="text-xl font-extrabold text-gray-900 flex items-center gap-2 pt-5">
                                            <span class="inline-block w-1.5 h-5 rounded-full bg-gradient-to-b from-[#ff2953] to-[#c51f42]"></span>
                                            Related Posts
                                        </h3>
                                        <a href="{{ route('category.show', $post->category->slug) }}"
                                            class="inline-flex mt-5 items-center gap-2 text-sm font-semibold text-white bg-[#ff2953] hover:bg-[#e02448] px-3 py-1.5 rounded-lg shadow-sm">
                                            <span>More in {{ $post->category->name }}</span>
                                            <i class="fas fa-arrow-right text-xs"></i>
                                        </a>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach ($relatedPosts as $relatedPost)
                                            @include('frontend.component.postcomponent',['post'=>$relatedPost])
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Prev / Next Navigation -->
                            @if (isset($prevPost) || isset($nextPost))
                                <nav class="mt-10 p-4 sm:p-6 bg-white rounded-xl border border-gray-100 shadow-sm">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            @if (isset($prevPost))
                                                <a href="{{ route('post.show', $prevPost->slug) }}"
                                                    class="group flex items-center gap-3">
                                                    <span
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-rose-50 text-rose-600">
                                                        <i class="fas fa-arrow-left"></i>
                                                    </span>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Previous</p>
                                                        <p
                                                            class="text-sm font-medium text-gray-900 group-hover:text-[#ff2953] line-clamp-2">
                                                            {{ $prevPost->title }}</p>
                                                    </div>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            @if (isset($nextPost))
                                                <a href="{{ route('post.show', $nextPost->slug) }}"
                                                    class="group flex items-center justify-end gap-3">
                                                    <div>
                                                        <p class="text-xs text-gray-500">Next</p>
                                                        <p
                                                            class="text-sm font-medium text-gray-900 group-hover:text-[#ff2953] line-clamp-2">
                                                            {{ $nextPost->title }}</p>
                                                    </div>
                                                    <span
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-rose-50 text-rose-600">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </nav>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-28">
                            <!-- Author Info -->
                            <div class="bg-white rounded-xl p-6 mb-8 shadow hover:shadow-lg transition-shadow">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">About the Author</h3>
                                <div class="flex items-center mb-4">
                                    @if ($post->isAdminPost())
                                        <div
                                            class="w-16 h-16 rounded-full bg-rose-100 flex items-center justify-center mr-4">
                                            <i class="fas fa-user-shield text-rose-600 text-2xl"></i>
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
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800">
                                                    <i class="fas fa-user-shield mr-1"></i>
                                                    Admin
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
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
                                {{-- @if (!$post->isAdminPost())
                                    <a href="{{ route('author.show', $post->user->id) }}"
                                        class="block w-full text-center bg-[#ff2953] text-white py-2 rounded-lg font-medium hover:bg-[#e02448] transition-colors">
                                        View Profile
                                    </a>
                                @endif --}}
                            </div>


                            <!-- Related Posts moved to main content grid -->
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
                                }, 1800);
                            }
                        }, function(err) {
                            console.error('Could not copy text: ', err);
                        });
                    }
                </script>
            @endpush

            @push('styles')
                <style>
                    
                    /* Meta chips */
                    .meta-chip {
                        border: 1px solid rgba(255, 41, 83, 0.12);
                        box-shadow: 0 2px 10px rgba(255, 41, 83, 0.07);
                    }
                    

                    /* Share buttons */
                    .share-btn {
                        display: inline-flex;
                        align-items: center;
                        gap: 8px;
                        color: #fff;
                        padding: 8px 12px;
                        border-radius: 10px;
                        font-weight: 600;
                        font-size: 14px;
                        transition: transform 0.15s ease, filter 0.15s ease;
                    }

                    .share-btn:hover {
                        filter: brightness(1.05);
                        transform: translateY(-1px);
                    }

                    .share-btn i {
                        font-size: 16px;
                    }



                    /* Copy toast */
                    .copy-toast {
                        position: fixed;
                        bottom: 24px;
                        right: 24px;
                        background: rgba(17, 24, 39, 0.95);
                        color: #fff;
                        padding: 10px 14px;
                        border-radius: 10px;
                        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                        z-index: 60;
                        opacity: 0;
                        transform: translateY(10px);
                        transition: opacity .2s ease, transform .2s ease;
                    }

                    .copy-toast.show {
                        opacity: 1;
                        transform: translateY(0);
                    }

                    /* Restore line clamp */
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
                        border-left: 4px solid #ff2953;
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
        </section>
    </div>
@endsection
