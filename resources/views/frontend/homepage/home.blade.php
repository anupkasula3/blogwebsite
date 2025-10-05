@extends('frontend.layout.main')

@section('title', \App\Models\Setting::get('site_name', 'NepBlog') . ' - ' .
    \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination'))
@section('meta_description',
    'Discover amazing stories, insights, and knowledge on our blog platform. Read the latest
    articles from top categories.')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Breaking News Ticker -->
        <div class="bg-black text-white py-2 overflow-hidden">
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
        </style>





        <div class="bg-white">



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
                            <a href="{{ route('all-posts') }}"
                                class="inline-flex items-center gap-2 bg-primary text-white px-4 sm:px-5 py-2 rounded-md hover:bg-primary/90 transition-colors text-sm font-semibold">
                                <span>View All</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>



                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                        <!-- Main News Content (3/4) -->
                        <div class="lg:col-span-3">


                            <script src="https://adnebyte.nepbyte.com/ads/embed/34be3c90-b979-48a9-ac96-3debea832472.js?count=1"></script>


                            <!-- Featured Story -->
                            @if ($latestPosts->isNotEmpty())
                                @foreach ($latestPosts->take(2) as $key => $latestPost)
                                    <div class="mb-3">
                                        <div
                                            class="relative bg-white rounded-lg shadow-lg overflow-hidden news-card transition-all duration-300">
                                            <div class="md:flex">
                                                <div class="md:w-1/2">
                                                    <img src="{{ asset('uploads/' . $latestPost->featured_image) }}"
                                                        alt="{{ $latestPost->title }}"
                                                        class="w-full h-56 sm:h-64 md:h-72  object-cover">
                                                    <div class="absolute top-4 left-4">
                                                        <span
                                                            class="category-badge text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                                            {{ $latestPost->category->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="md:w-1/2 p-6">
                                                    <div class="flex items-center gap-2 mb-3">
                                                        <span
                                                            class="bg-primary text-white px-2 py-1 text-xs font-bold rounded">BREAKING</span>
                                                        <span
                                                            class="text-xs text-gray-500">{{ $latestPost->published_at->diffForHumans() }}</span>
                                                    </div>
                                                    <h3 class="text-2xl font-bold text-gray-900 mb-3 leading-tight">
                                                        <a href="{{ route('post.show', $latestPost->slug) }}"
                                                            class="hover:text-primary transition-colors">
                                                            {{ $latestPost->title }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-gray-600 mb-4 leading-relaxed">
                                                        {{ Str::limit(strip_tags($latestPost->content), 150) }}
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
                                                        <a href="{{ route('post.show', $latestPost->slug) }}"
                                                            class="text-primary font-semibold text-sm hover:underline">
                                                            Read More →
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- News Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ($latestPosts->skip(2)->take(6) as $key => $post)
                                    @include('frontend.component.postcomponent')


                                    <!-- Inline Ad after every 3rd article -->
                                    @if (($key + 2) % 3 == 0)
                                        <div
                                            class="lg:col-span-3 md:col-span-2 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-lg p-4 border-2 border-dashed border-orange-300">
                                            <div class="text-center">
                                                <span class="text-xs text-gray-500 uppercase tracking-wide">Sponsored
                                                    Content</span>
                                                @if ($contentAd)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('uploads/' . $contentAd->image) }}"
                                                            alt="{{ $contentAd->title }}"
                                                            class="w-full h-20 object-cover rounded">
                                                    </div>
                                                @else
                                                    <div
                                                        class="mt-2 bg-gray-200 h-20 rounded flex items-center justify-center">
                                                        <span class="text-gray-500">Inline Advertisement Space</span>
                                                    </div>
                                                @endif
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
                            <div
                                class="">

                                <div class="mt-2">
                                            <img src="{{ asset('images/ads.gif') }}"
                                                alt="Ads Nepbyte"
                                                class="w-full h-44 sm:h-20 md:h-60 object-cover rounded">
                                        </div>
                                {{-- <div class="text-center">
                                    <span class="text-xs text-gray-500 uppercase tracking-wide">Advertisement</span>
                                    @if ($sidebarAd)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/' . $sidebarAd->image) }}"
                                                alt="{{ $sidebarAd->title }}"
                                                class="w-full h-40 sm:h-48 md:h-56 object-cover rounded">
                                        </div>
                                    @else
                                        <div class="mt-2 bg-gray-200 h-48 rounded flex items-center justify-center">
                                            <span class="text-gray-500 text-sm">300x250 Sidebar Ad</span>
                                        </div>
                                    @endif
                                </div> --}}
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
                            <div
                                class="">

                                   <div class="mt-2">
                                            <img src="{{ asset('images/tihar.gif') }}"
                                                alt="TIhar"
                                                class="w-full h-44 sm:h-20 md:h-72  object-cover rounded">
                                        </div>
                                {{-- <div class="text-center">
                                    <span class="text-xs text-gray-500 uppercase tracking-wide">Advertisement</span>
                                    @if ($sidebarAd)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/' . $sidebarAd->image) }}"
                                                alt="{{ $sidebarAd->title }}"
                                                class="w-full h-40 sm:h-48 md:h-56 object-cover rounded">
                                        </div>
                                    @else
                                        <div class="mt-2 bg-gray-200 h-48 rounded flex items-center justify-center">
                                            <span class="text-gray-500 text-sm">300x250 Sidebar Ad</span>
                                        </div>
                                    @endif
                                </div> --}}
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
            <section class="py-8 bg-gray-100">
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
                                    Read Storie
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
                    <div
                        class="mb-8 bg-gradient-to-r from-green-100 to-teal-100 rounded-lg p-4 border-2 border-dashed border-green-300">
                        <div class="text-center">
                            <span class="text-xs text-gray-500 uppercase tracking-wide">Sponsored Content</span>
                            @if ($contentAd)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/' . $contentAd->image) }}" alt="{{ $contentAd->title }}"
                                        class="w-full h-20 object-cover rounded">
                                </div>
                            @else
                                <div class="mt-2 bg-gray-200 h-20 rounded flex items-center justify-center">
                                    <span class="text-gray-500">728x90 Sponsored Content Banner</span>
                                </div>
                            @endif
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
                                    @if ($sidebarAd)
                                        <img src="{{ asset('uploads/' . $sidebarAd->image) }}"
                                            alt="{{ $sidebarAd->title }}" class="w-full h-32 object-cover rounded mb-2">
                                    @else
                                        <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center mb-2">
                                            <span class="text-gray-500 text-sm">Ad Space</span>
                                        </div>
                                    @endif
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


            <section class="py-8 sm:py-12 md:py-16 lg:py-20 xl:py-24 text-zinc-900 relative overflow-hidden">
                <div class="max-w-screen-2xl mx-auto px-4 ">
                    <!-- Section Header -->
                    <!-- <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Featured
                                Articles</h2>
                            <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto">Discover our most
                                engaging and informative content curated just for you</p>
                        </div> -->

                    <div class="border-b-2 border-primary mb-8">
                        <div class="flex justify-between items-center gap-3 pb-2">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center text-xl gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                    <i class="fas fa-newspaper"></i>
                                    Featured
                                    Articles
                                </span>
                                <div class="h-8 w-1 max-sm:hidden bg-blue-600"></div>
                                <span class="text-sm text-gray-500 font-medium max-sm:hidden">Discover our most
                                    engaging and informative content curated just for you .</span>

                            </div>

                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-3">
                        <!-- LEFT: Featured Posts (Mobile: Full width, Desktop: 2/3) -->
                        <div class="w-full lg:w-2/3 xl:w-3/5 space-y-3">
                            @foreach ($featuredPosts as $key => $post2)
                                <!-- Article Card -->
                                <article
                                    class="group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                                    <div class="flex flex-col sm:flex-row">
                                        <!-- Image max-w-screen-2xl -->
                                        <div class="relative shrink-0 w-full sm:w-2/5 lg:w-1/3 xl:w-2/5">
                                            <div class="aspect-video sm:aspect-square lg:aspect-video">
                                                <img src="{{ asset('uploads/' . $post2->featured_image) }}"
                                                    alt="{{ $post2->title }}"
                                                    class="w-full h-[100%] object-cover group-hover:scale-105 transition-transform duration-300" />
                                            </div>
                                            <!-- Category Badge -->
                                            <span
                                                class="absolute top-3 right-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-lg">
                                                {{ $post2->category->name }}
                                            </span>
                                        </div>

                                        <!-- Content max-w-screen-2xl -->
                                        <div class="flex-1 p-4 sm:p-6 lg:p-8">
                                            <div class="flex flex-col h-full justify-between">
                                                <div>
                                                    <h3
                                                        class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-3 line-clamp-2">
                                                        {{ $post2->title }}
                                                    </h3>
                                                    <p
                                                        class="text-gray-600 text-sm sm:text-base leading-relaxed line-clamp-3 mb-4">
                                                        {{ Str::limit(strip_tags($post2->content), 200) }}
                                                    </p>
                                                </div>

                                                <!-- Meta Information -->
                                                <div class="flex items-center justify-between text-sm text-gray-500">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user text-xs"></i>
                                                        </div>
                                                        <span>{{ $post2->author_name }}</span>
                                                    </div>
                                                    <span class="flex items-center gap-1">
                                                        <i class="fas fa-clock text-xs"></i>
                                                        {{ $post2->published_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- RIGHT: Sidebar (Mobile: Full width, Desktop: 1/3) -->
                        <div class="w-full lg:w-1/3 xl:w-2/5 space-y-3">
                            <!-- Advertisement Cards -->
                            <div class="flex w-full gap-3">
                                <div
                                    class="w-1/2 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-4 sm:p-6 border border-blue-200">
                                    <img src="{{ asset('images/adddds.jpg') }}" alt="Advertisement"
                                        class="w-full h-32 sm:h-40 object-cover rounded-lg mb-3" />
                                    <div class="text-center">
                                        <h4 class="font-semibold text-gray-900 mb-2">Special Offer</h4>
                                        <p class="text-sm text-gray-600">Discover amazing deals</p>
                                    </div>
                                </div>

                                <div
                                    class="w-1/2 bg-gradient-to-br from-purple-50 to-pink-100 rounded-xl p-4 sm:p-6 border border-purple-200">
                                    <img src="{{ asset('images/adddds.jpg') }}" alt="Advertisement"
                                        class="w-full h-32 sm:h-40 object-cover rounded-lg mb-3" />
                                    <div class="text-center">
                                        <h4 class="font-semibold text-gray-900 mb-2">Premium Content</h4>
                                        <p class="text-sm text-gray-600">Exclusive articles</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col lg:flex-row gap-3">

                                <!-- Newsletter Signup -->
                                <div class="bg-primary w-1/2 max-sm:w-full rounded-lg p-6 text-white">
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
                                <div
                                    class="bg-gradient-to-b max-sm:w-full  w-1/2 from-purple-100 to-blue-100 rounded-lg p-4 border-2 border-dashed border-purple-300">
                                    <div class="text-center">
                                        <span class="text-xs text-gray-500 uppercase tracking-wide">Advertisement</span>
                                        @if ($sidebarAd)
                                            <div class="mt-2">
                                                <img src="{{ asset('uploads/' . $sidebarAd->image) }}"
                                                    alt="{{ $sidebarAd->title }}"
                                                    class="w-full h-40 sm:h-48 md:h-56 object-cover rounded">
                                            </div>
                                        @else
                                            <div class="mt-2 bg-gray-200 h-48 rounded flex items-center justify-center">
                                                <span class="text-gray-500 text-sm">300x250 Sidebar Ad</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <!-- Popular Tags -->
                            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                                <img src="{{ asset('images/adddds.jpg') }}" alt="Advertisement"
                                    class="w-full h-32 sm:h-52 object-cover rounded-lg" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>






            <!-- Attractive Read More Section -->
            <section class="py-8 relative overflow-hidden">
                <div class="max-w-screen-2xl mx-auto px-4">
                    <!-- <div class="text-center mb-10">
                            <h2
                                class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 mb-4">
                                Discover More Stories</h2>
                            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Dive into a world of inspiring articles,
                                trending topics, and expert insights. Find your next favorite read and stay ahead with our
                                handpicked recommendations!</p>
                        </div> -->

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
                        @foreach (\App\Models\Post::published()->inRandomOrder(12)->get() as $post)
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
            <section class="py-8">
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
            </section>

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
