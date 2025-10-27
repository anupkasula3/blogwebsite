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




            <div class="text-sm py-6 w-full ">
                <div
                    class="max-w-screen-lg w-11/12 mx-auto flex items-center overflow-hidden border border-gray-200 bg-white rounded-xl shadow-lg">

                    <!-- Label -->
                    <span
                        class="font-bold uppercase mr-5 px-3 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg shadow-sm">
                        Trending Now
                    </span>

                    <!-- Ticker -->
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
            </style>

            @include('frontend.homepage.sections.banner')
            @include('frontend.homepage.sections.stories')
            <!-- Latest News Section -->
            <section class="py-8 sm:py-10 md:py-12 bg-white">
                <div class="max-w-screen-2xl mx-auto px-4 ">
                    <!-- Section Header with News Portal Style -->
                    <div class="border-b-2 border-primary mb-8">
                        <div class="flex justify-between items-center gap-3 pb-2">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center text-xl gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                    <i class="fas fa-newspaper"></i>
                                    Latest News
                                </span>

                            </div>
                            <a href="{{ route('latest') }}"
                                class="inline-flex items-center gap-2 bg-primary text-white px-4 sm:px-5 py-2 rounded-md hover:bg-primary/90 transition-colors text-sm font-semibold">
                                <span>View All</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>



                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                        <!-- Main News Content (3/4) -->
                        <div class="lg:col-span-3">


                            <div class="mb-5">

                                <script src="https://adnebyte.nepbyte.com/ads/embed/dc780e7a-2551-4c5a-8268-1c69982382ec.js?count=1"></script>
                            </div>

                            <!-- Featured Story -->
                            @if ($latestPosts->isNotEmpty())
                                @foreach ($latestPosts->take(2) as $key => $latestPost)
                                    <div class="mb-3">
                                        <a href="{{ route('post.show', $latestPost->url_slug ?? $latestPost->slug) }}"
                                            class="block group">
                                            <div
                                                class="relative bg-white rounded-lg shadow-lg overflow-hidden news-card transition-all duration-300">
                                                <div class="md:flex">
                                                    <div class="md:w-1/3">
                                                        <img src="{{ asset('uploads/' . $latestPost->featured_image) }}"
                                                            alt="{{ $latestPost->title }}"
                                                            class="w-full h-full object-cover">
                                                        <!-- reduced height -->
                                                        <div class="absolute top-4 left-4">
                                                            <span
                                                                class="category-badge text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                                                {{ $latestPost->category->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="md:w-2/3 p-6">
                                                        <div class="flex items-center gap-2 mb-3">
                                                            <span
                                                                class="bg-primary text-white px-2 py-1 text-xs font-bold rounded">BREAKING</span>
                                                            <span
                                                                class="text-xs text-gray-500">{{ $latestPost->published_at->diffForHumans() }}</span>
                                                        </div>
                                                        <h3
                                                            class="text-2xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-primary transition-colors">
                                                            {{ $latestPost->title }}
                                                        </h3>
                                                        <p class="text-gray-600 mb-4 leading-relaxed">
                                                            {{ Str::limit(strip_tags($latestPost->excerpt), 150) }}
                                                        </p>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-2">
                                                                <div
                                                                    class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                                                    <i class="fas fa-user text-xs text-gray-600"></i>
                                                                </div>
                                                                <span
                                                                    class="text-sm font-medium text-gray-700">{{ $latestPost->author_name }}</span>
                                                            </div>
                                                            <span
                                                                class="text-primary font-semibold text-sm group-hover:underline">Read
                                                                More →</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            <!-- News Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ($latestPosts->skip(2)->take(6) as $key => $post)
                                    @include('frontend.component.postcomponent')


                                    <!-- Inline Ad after every 3rd article -->
                                    @if (($key + 2) % 3 == 0)
                                        <div class="lg:col-span-3 md:col-span-2">
                                            <div class="text-center">

                                                <div class="mt-2">

                                                    <script src="https://adnebyte.nepbyte.com/ads/embed/34be3c90-b979-48a9-ac96-3debea832472.js?count=1"></script>

                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Sidebar (1/4) -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Trending News -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                                <div class="bg-primary text-white p-4 rounded-t-lg">
                                    <h3 class="font-bold uppercase tracking-wide flex items-center gap-2">
                                        <i class="fas fa-fire"></i>
                                        Trending Now
                                    </h3>
                                </div>
                                <div class="p-4 space-y-4">
                                    @foreach ($popularPosts->take(5) as $index => $trendingPost)
                                        <div class="flex items-start gap-3 pb-3 border-b border-gray-100 last:border-b-0">
                                            <span c
                                                lass="bg-primary text-white text-xs font-bold px-2 py-1 rounded">{{ $index + 1 }}</span>
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-sm text-gray-900 leading-tight mb-1">
                                                    <a href="{{ route('post.show', $trendingPost->slug) }}"
                                                        class="hover:text-primary transition-colors">
                                                        {{ Str::limit($trendingPost->title, 60) }}
                                                    </a>
                                                </h5>
                                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                                    <span>{{ $trendingPost->published_at->format('M j') }}</span>
                                                    <span>•</span>
                                                    <span>{{ $trendingPost->views_count ?? 0 }} views</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sidebar Ad -->
                            <div class="">

                                <a href="https://aryanmiyamansoor.com.np/" target="_blank" rel="noopener noreferrer">
                                    <div class="mt-2">
                                        <img src="{{ asset('images/aryan.gif') }}" alt="Ads Nepbyte"
                                            class="w-full h-60 sm:h-60 md:h-60 object-cover rounded">
                                    </div>
                                </a>

                            </div>

                            <!-- Calender -->
                            <!-- Newsletter Signup -->
                            <div class="bg-primary  rounded-lg p-6 text-white">
                                <div class="text-center">
                                    <i class="fas fa-newspaper text-3xl mb-3"></i>
                                    <h4 class="font-bold text-lg mb-2">Daily Newsletter</h4>
                                    <p class="text-red-100 text-sm mb-4">Get breaking news delivered to your inbox</p>
                                    <div class="space-y-2">
                                        <input type="email" placeholder="Your email address"
                                            class="w-full border border-white px-3 py-2 rounded text-white text-sm">
                                        <button
                                            class="w-full bg-white text-primary py-2 rounded font-semibold text-sm hover:bg-gray-100 transition-colors">
                                            Subscribe Now
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <!-- Quote of the Day -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                    <i class="fas fa-quote-left text-blue-500"></i>
                                    Quote of the Day
                                </h4>
                                <blockquote
                                    class="italic text-gray-700 text-sm leading-relaxed border-l-4 border-blue-500 pl-3">
                                    "{{ $randomQuote }}"
                                </blockquote>
                            </div>
                            <!-- Sidebar Ad -->
                            <div class="">

                                <a href="https://nepbyte.com/contact" target="_blank" rel="noopener noreferrer">
                                    <div class="mt-2">
                                        <img src="{{ asset('images/ads.gif') }}" alt="TIhar"
                                            class="w-full h-60 sm:h-60 md:h-60 object-cover rounded">
                                    </div>
                                </a>

                            </div>
                            <!-- Quote of the Day -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                    <i class="fas fa-quote-left text-blue-500"></i>
                                    Quote of the Day
                                </h4>
                                <blockquote
                                    class="italic text-gray-700 text-sm leading-relaxed border-l-4 border-blue-500 pl-3">
                                    "{{ $randomQuote2 }}"
                                </blockquote>
                            </div>

                        </div>
                    </div>
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
