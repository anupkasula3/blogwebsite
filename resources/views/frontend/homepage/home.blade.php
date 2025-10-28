@extends('frontend.layout.main')
@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Breaking News Ticker -->
        {{-- <div class="bg-black text-white py-2 overflow-hidden">
            <div class=" ">
                <div class="flex items-center">
                    <span class="bg-white z-[999] text-primary  py-1 text-sm font-bold mr-4 p-2 rounded">BREAKING</span>
                    <div class="marquee">
                        <span
                            class="text-sm">{{ $featuredPosts->first()->title ?? 'Latest news and updates from our platform' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .marquee {
                white-space: nowrap;
                overflow: hidden;
                animation: marquee 30s linear infinite;
            }

            @keyframes marquee {
                0% {
                    transform: translateX(100%);
                }

                100% {
                    transform: translateX(-100%);
                }
            }

            .news-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            }

            .category-badge {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
        </style> --}}





        <div class="bg-white">

            {{-- <div class="bg-black text-white py-2 overflow-hidden">
            <div class=" ">
                <div class="flex items-center">
                    <span class="bg-white z-[999] text-primary  py-1 text-sm font-bold mr-4 p-2 rounded">BREAKING</span>
                    <div class="marquee">
                        <span
                            class="text-sm">{{ $featuredPosts->first()->title ?? 'Latest news and updates from our platform' }}</span>
                    </div>
                </div>
            </div>
        </div> --}}

            <!-- Trending Now Ticker -->

            <!-- Trending Now Section -->




            {{-- <div class="text-sm py-6 w-full ">
                <div
                    class="max-w-screen-lg w-11/12 mx-auto flex items-center overflow-hidden border border-gray-200 bg-white rounded-xl shadow-lg">


                    <span
                        class="font-bold uppercase mr-5 px-3 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg shadow-sm">
                        Trending Now
                    </span>


                    <div x-data="{
                        index: 0,
                        posts: [
                            { title: 'Breaking: AI Revolutionizes Tech Industry', url: '#' },
                            { title: 'Stock Markets Hit Record Highs Today', url: '#' },
                            { title: 'New Study Reveals Health Benefits of Meditation', url: '#' },
                            { title: 'Top 10 Travel Destinations for 2025', url: '#' }
                        ],
                        next() { this.index = (this.index + 1) % this.posts.length; }
                    }" x-init="setInterval(() => next(), 3500)" class="relative flex-1 h-10 overflow-hidden">
                        <template x-for="(post, i) in posts" :key="i">
                            <a :href="post.url" x-show="index === i"
                                x-transition:enter="transition transform ease-out duration-700"
                                x-transition:enter-start="translate-y-full opacity-0"
                                x-transition:enter-end="translate-y-0 opacity-100"
                                x-transition:leave="transition transform ease-in duration-700"
                                x-transition:leave-start="translate-y-0 opacity-100"
                                x-transition:leave-end="-translate-y-full opacity-0"
                                class="absolute left-0 pt-2.5 top-0 w-full text-gray-900 font-semibold truncate hover:text-pink-500 hover:underline"
                                x-text="post.title"></a>
                        </template>
                    </div>

                    <!-- Optional Arrow -->
                    <div class="ml-4 text-pink-400">
                        <svg class="w-5 h-5 animate-bounce-slow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                </div>
            </div>

            <style>
                @keyframes bounce-slow {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-6px);
                    }
                }

                .animate-bounce-slow {
                    animation: bounce-slow 1.2s infinite;
                }
            </style> --}}

            @include('frontend.homepage.sections.banner')
            @include('frontend.homepage.sections.stories')
            <!-- Latest News Section -->



            <section class="bg-white py-14">
                <div class="max-w-screen-2xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-10">

                    <!-- Left Column -->
                    <div class="lg:col-span-2 space-y-10">

                        <!-- Header -->
                        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Latest News</h2>
                            <a href="{{ route('latest') }}"
                                class="text-sm font-medium text-[#ff2953] hover:underline hover:text-[#e02548] transition">
                                View All
                            </a>
                        </div>



                        <!-- Featured & Secondary Posts -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Featured -->
                            @foreach ($latestPosts->take(1) as $post)
                                <a href="{{ route('post.show', $post->url_slug ?? $post->slug) }}"
                                    class="text-[#ff2953] text-sm font-medium">

                                    <div
                                        class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full border border-gray-100">
                                        <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                            class="w-full h-56 object-cover">
                                        <div class="p-6 flex flex-col flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 hover:text-[#ff2953] transition">
                                                {{ $post->title }}</h3>
                                            <p class="text-gray-400 text-xs mt-2 mb-3">
                                                By {{ $post->author_name }} · {{ $post->published_at->format('M j, Y') }}
                                            </p>
                                            <p class="text-gray-600 text-sm leading-relaxed flex-1">
                                                {{ Str::limit(strip_tags($post->content), 90) }}
                                            </p>

                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            <!-- Secondary -->
                            <div class="flex flex-col gap-4">
                                @foreach ($latestPosts->skip(1)->take(3) as $post)
                                    <a href="{{ route('post.show', $post->url_slug ?? $post->slug) }}"
                                        class="text-[#ff2953] text-xs font-medium">

                                        <div
                                            class="flex gap-3 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 p-3">
                                            <img src="{{ asset('uploads/' . $post->featured_image) }}"
                                                alt="{{ $post->title }}" class="w-28 h-24 object-cover rounded-lg">
                                            <div class="flex flex-col justify-between">
                                                <h4
                                                    class="text-sm font-semibold text-gray-800 hover:text-[#ff2953] transition-colors">
                                                    {{ Str::limit($post->title, 60) }}
                                                </h4>
                                                <p class="text-gray-400 text-xs mt-1">
                                                    {{ $post->published_at->format('M j, Y') }}</p>
                                                <p class="text-gray-600 text-sm leading-relaxed flex-1">
                                                    {{ Str::limit(strip_tags($post->content), 90) }}
                                                </p>


                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                           <!-- Advertisement -->
                        <div class="w-full rounded-2xl overflow-hidden border border-gray-100 shadow-sm ">
                            <script src="https://adnebyte.nepbyte.com/ads/embed/dc780e7a-2551-4c5a-8268-1c69982382ec.js?count=1"></script>
                        </div>

                        <!-- List Posts -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach ($latestPosts->skip(4)->take(2) as $post)
                                <a href="{{ route('post.show', $post->url_slug ?? $post->slug) }}">

                                    <div
                                        class="flex gap-4 bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300 p-4">
                                        <img src="{{ asset('uploads/' . $post->featured_image) }}"
                                            alt="{{ $post->title }}" class="w-28 h-24 object-cover rounded-lg">
                                        <div>
                                            <span class="text-[#ff2953] text-xs font-semibold uppercase tracking-wide">
                                                {{ $post->category->name ?? 'General' }}
                                            </span>
                                            <h4
                                                class="text-sm font-semibold text-gray-800 mt-1 hover:text-[#ff2953] transition-colors">
                                                {{ Str::limit($post->title, 60) }}
                                            </h4>
                                            <p class="text-gray-400 text-xs mt-1">
                                                {{ $post->published_at->diffForHumans() }}
                                            </p>
                                            <p class="text-gray-600 text-sm leading-relaxed flex-1">
                                                {{ Str::limit(html_entity_decode(strip_tags($post->content)), 90) }}
                                            </p>

                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <aside class="space-y-8">

                        <div
                            class="overflow-hidden rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                            <a href="https://nepbyte.com/contact" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('images/ads.gif') }}" alt="Tihar"
                                    class="w-full h-64 object-cover rounded">
                            </a>
                        </div>
                        <!-- Trending -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                            <div class="bg-[#ff2953] text-white px-5 py-3 flex items-center justify-between">
                                <h3 class="text-sm font-semibold flex items-center gap-2 uppercase tracking-wide">
                                    <i class="fas fa-fire"></i> Trending
                                </h3>
                            </div>
                            <div class="p-5 space-y-4">
                                @foreach ($popularPosts->take(5) as $index => $post)
                                    <div class="flex gap-3 items-start border-b border-gray-100 last:border-0 pb-3">
                                        <span
                                            class="bg-[#ff2953] text-white text-xs font-bold px-2 py-1 rounded">{{ $index + 1 }}</span>
                                        <div class="flex-1">
                                            <a href="{{ route('post.show', $post->slug) }}"
                                                class="text-sm font-medium text-gray-800 hover:text-[#ff2953] transition-colors">
                                                {{ Str::limit($post->title, 100) }}
                                            </a>
                                            <p class="text-xs text-gray-400 mt-1">{{ $post->published_at->format('M j') }}
                                                • {{ $post->views_count ?? 0 }} views</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Advertisement -->
                        <div class="overflow-hidden ">
                            <a href="https://aryanmiyamansoor.com.np/" target="_blank" rel="noopener noreferrer">
                                <div class="mt-2">
                                    <img src="{{ asset('images/aryan.gif') }}" alt="Ads Nepbyte"
                                        class="w-full h-72 sm:h-72 md:h-72 object-cover rounded-2xl">
                                </div>
                            </a>
                        </div>
                    </aside>
                </div>
            </section>












            @include('frontend.homepage.sections.categories-preview')




            <!-- Most Read Stories Section -->
            <section class="py-8 mt-8 ">
                <div class="max-w-screen-2xl mx-auto px-4">
                    <!-- Section Header -->
                    <!-- <div class="border-b-4 border-blue-600 mb-8">
                                                                        <div class="flex justify-between items-center pb-4">
                                                                            <div class="flex items-center gap-4">
                                                                                <h2 class="text-3xl max-sm:text-sm font-bold text-gray-900 uppercase tracking-wide">Most
                                                                                    Read Stories</h2>
                                                                                <div class="h-8 w-1 max-sm:hidden bg-blue-600"></div>
                                                                                <span class="text-sm text-gray-500 font-medium max-sm:hidden">This Week</span>
                                                                            </div>
                                                                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                                                                <i class="fas fa-chart-line text-blue-600"></i>
                                                                                <span>Trending</span>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->

                    <div class="border-b-2 border-primary mb-8">
                        <div class="flex justify-between items-center gap-3 pb-2">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center text-xl gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                    <i class="fas fa-newspaper"></i>
                                    Most
                                    Read Stories
                                </span>
                                <div class="h-8 w-1 max-sm:hidden bg-blue-600"></div>
                                <span class="text-sm text-gray-500 font-medium max-sm:hidden">This Week</span>

                            </div>
                            <a href="{{ route('popular') }}"
                                class="inline-flex items-center gap-2 bg-primary text-white px-4 sm:px-5 py-2 rounded-md hover:bg-primary/90 transition-colors text-sm font-semibold">
                                <span>View All</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Banner Ad Space -->
                    <div class="mb-8">
                        <div class="text-center">
                            <script src="https://adnebyte.nepbyte.com/ads/embed/7437e08b-5068-40be-a27d-412acdf1ee6d.js?count=1"></script>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                        @foreach ($popularPosts->take(8) as $key => $post)
                            @include('frontend.component.postcomponent')

                            <!-- Inline Ad after 4th article -->
                            @if ($key == 3)
                                <div
                                    class="bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg p-6 border-2 border-dashed border-purple-300 flex flex-col justify-center items-center">
                                    <span class="text-xs text-gray-500 uppercase tracking-wide mb-2">Advertisement</span>

                                    <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center mb-2">
                                        <span class="text-gray-500 text-sm">Ad Space</span>
                                    </div>

                                    <h4 class="font-semibold text-gray-900 text-center text-sm">Premium Content</h4>
                                    <p class="text-xs text-gray-600 text-center">Discover exclusive stories</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- View More Button -->
                    <!-- <div class="text-center mt-8">
                                                                        <a href="{{ route('popular') }}"
                                                                            class="inline-flex items-center bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                                                            <i class="fas fa-chart-line mr-2"></i>
                                                                            View All Popular Stories
                                                                            <i class="fas fa-arrow-right ml-2"></i>
                                                                        </a>
                                                                    </div> -->
                </div>
            </section>




            <section class=" mx-auto max-w-screen-2xl mt-10 px-4 text-black relative overflow-hidden ">
                <div class="">
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="w-full lg:w-1/2">
                            <div class="flex flex-col items-center justify-end bg-no-repeat bg-cover bg-center min-h-[400px] rounded-2xl"
                                style=" background-image: url(https://cdn.easyfrontend.com/pictures/discount1-bg.png);">
                                <h1 class="text-3xl md:text-[40px] font-bold leading-tight text-pink-600">
                                    Accesssories
                                </h1>
                                <p class="text-2xl md:text-3xl leading-none font-medium mt-2 mb-6">
                                    Up to 60% off
                                </p>
                                <button class="py-3.5 px-9 leading-none  text-pink-600 rounded-lg font-bold mb-12">
                                    Shop Now
                                </button>
                            </div>
                        </div>

                        <div class="w-full lg:w-1/2">
                            <div class="flex flex-col justify-end bg-no-repeat bg-cover bg-center min-h-[400px] rounded-2xl p-6 md:p-12"
                                style=" background-image: url(https://cdn.easyfrontend.com/pictures/discount2-bg.png); ">
                                <div class="w-full lg:w-1/2 text-center">
                                    <div class="text-yellow-500  rounded-lg p-6">
                                        <h2 class="text-3xl font-bold">
                                            Spring into <br />
                                            Action
                                        </h2>
                                    </div>
                                    <button
                                        class="py-3.5 px-9 leading-none bg-pink-600 text-white rounded-lg font-bold mt-6">
                                        Shop Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <section class="py-8 relative overflow-hidden">
                <div class="max-w-screen-2xl mx-auto px-4">

                    <div class="border-b-2 border-primary mb-8">
                        <div class="flex justify-between items-center gap-3 pb-2">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center text-xl gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                    <i class="fas fa-newspaper"></i>
                                    Discover More Stories
                                </span>
                                <div class="h-8 w-1 max-sm:hidden bg-blue-600"></div>
                                <span class="text-sm text-gray-500 font-medium max-sm:hidden">Dive into a world of
                                    inspiring articles,
                                    trending topics, and expert insights. Find your next favorite read and stay ahead with
                                    our
                                    handpicked recommendations!</span>

                            </div>

                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mb-10">
                        @foreach (\App\Models\Post::published()->where('is_featured', 0)->inRandomOrder(12)->get() as $post)
                            @include('frontend.component.postcomponent')
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <a href="{{ route('all-posts') }}"
                            class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white text-lg font-semibold rounded-full shadow-lg hover:bg-primary/90 transition-colors duration-200">
                            Explore All Posts
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Banner Advertisement Section -->
            <!-- <section class="py-8">
                                                            <div class="max-w-screen-2xl mx-auto px-4">
                                                                <div
                                                                    class="max-w-4xl mx-auto bg-gradient-to-r from-primary/10 to-primary/5 rounded-3xl shadow-xl flex flex-col md:flex-row items-center gap-6 p-6 md:p-10 border border-primary relative overflow-hidden">
                                                                    <div class="flex-shrink-0 w-full md:w-1/3 flex justify-center">
                                                                        <img src="{{ asset('images/adddds.jpg') }}" alt="Special Offer Banner"
                                                                            class="h-40 md:h-48 w-full object-cover shadow-lg">
                                                                    </div>
                                                                    <div class="flex-1 text-center md:text-left">
                                                                        <h3 class="text-2xl md:text-3xl font-extrabold text-primary mb-2">Unlock Exclusive Content!
                                                                        </h3>
                                                                        <p class="text-gray-700 mb-4">Subscribe now and get access to premium articles, expert
                                                                            insights, and special offers. Don’t miss out on the latest trends and stories!</p>
                                                                        <a href="{{ route('register') }}"
                                                                            class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white text-base font-semibold rounded-full shadow-md hover:bg-primary/90 transition-colors duration-200 ring-1 ring-primary/20">
                                                                            Get Started
                                                                            <i class="fas fa-arrow-right ml-2"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section> -->

        </div>





    </div>
@endsection

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
