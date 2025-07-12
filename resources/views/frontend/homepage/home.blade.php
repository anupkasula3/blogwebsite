@extends('frontend.layout.main')

@section('title', \App\Models\Setting::get('site_name', 'MyBlogSite') . ' - ' .
    \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination'))
@section('meta_description',
    'Discover amazing stories, insights, and knowledge on our blog platform. Read the latest
    articles from top categories.')

@section('content')
    <div class="max-w-screen-2xl mx-auto px-2 sm:px-4 lg:px-8 py-6">

        <style>
            .gradient-text {
                background-image: linear-gradient(90deg, #2563eb, #7c3aed);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .article-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            }

            .article-gradient {
                background-image: linear-gradient(to bottom, rgba(248, 250, 252, 0), rgba(30, 41, 59, 1));
            }
        </style>





        <div class="bg-light">

            <!-- Hero Section -->
            <section class="relative">
                <div class="absolute inset-0 bg-black/30"></div>
                <img src="https://placehold.co/1920x1080"
                    alt="Aerial view of a modern workspace with laptop, notebooks, and coffee cup on a wooden desk"
                    class="w-full h-96 object-cover">
                <div class="px-4 absolute inset-0 flex items-center">
                    <div class="max-w-2xl">
                        <span class=" text-primary px-3 py-1 rounded-full text-sm font-semibold mb-2 inline-block">Featured
                            Post</span>
                        <h2 class="text-4xl font-bold text-white mb-4">The Ultimate Guide to Professional Blogging Success
                        </h2>
                        <p class="text-white mb-6">Learn how to create compelling content that engages your audience and
                            grows your brand. Discover proven strategies used by industry leaders.</p>
                        <div class="flex gap-4">
                            <button class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition">Read
                                Article</button>
                            <button
                                class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg hover: hover:text-dark transition flex items-center gap-2">
                                <i class="fas fa-bookmark"></i> Save for later
                            </button>
                        </div>
                    </div>
                </div>
            </section>



            <!-- Latest Articles -->
            <section class="py-5 ">
                <div class="">
                    <div class="flex justify-between items-center mb-12">
                        <h2 class="text-3xl font-bold text-dark">Latest Posts</h2>
                        <a href="#" class="text-primary font-medium flex items-center gap-2 hover:underline">
                            View all Posts
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="md:flex">
                        <!-- Articles Section (75%) -->
                        <div class="md:w-3/4 w-full pr-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-2">
                                @foreach ($latestPosts as $key => $post)
                                    @include('frontend.component.postcomponent')
                                    {{-- @include('frontend.component.postcomponent') --}}
                                @endforeach
                            </div>
                        </div>

                        <!-- Sidebar Section (25%) -->
                        <div class="md:w-1/4">
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                {{-- <h3 class="text-lg font-bold mb-4">Ads Section</h3> --}}
                                <img class="object-contain" alt=""
                                    src="https://cdn.easyfrontend.com/pictures/discount1-bg.png" />
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md mt-4">
                                <h3 class="text-lg font-bold mb-4">Popular Blogs</h3>

                            </div>
                            <div class="bg-gray-100 mt-4 p-4 rounded-lg shadow-md">
                                {{-- <h3 class="text-lg font-bold mb-4">Ads Section</h3> --}}
                                <img class="object-contain" alt=""
                                    src="https://cdn.easyfrontend.com/pictures/discount1-bg.png" />
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md mt-4">
                                <h3 class="text-lg font-bold mb-4">Popular Blogs</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="py-4 ">
                <div class="">
                    <h2 class="font-manrope text-4xl font-bold text-gray-900 text-center mb-6">Our popular blogs</h2>
                    <div
                        class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-center mb-14 gap-y-2  gap-x-2">
                        @foreach ($latestPosts as $key => $post)
                            <div
                                class="group cursor-pointer  border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                                <div class="flex items-center mb-6">
                                    <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="rounded-lg h-48 w-full object-contain">
                                </div>
                                <div class="block">
                                    <h4 class="text-gray-900 font-medium leading-1 mb-9">{{ $post->title }}</h4>

                                    <div class="flex items-center justify-between  font-medium">
                                        <h6 class="text-sm text-gray-500">{{ $post->author_name }}</h6>
                                        <span class="text-sm text-indigo-600">
                                            {{ $post->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{-- <a href="javascript:;"
                        class="cursor-pointer border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">View
                        All</a> --}}
                </div>
            </section>




            <section class="  text-black relative overflow-hidden ">
                <div class="">
                    <div class="flex flex-col md:flex-row gap-6">
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
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Featured Articles</h2>
                        <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto">Discover our most engaging and informative content curated just for you</p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-6 lg:gap-2">
                        <!-- LEFT: Featured Posts (Mobile: Full width, Desktop: 2/3) -->
                        <div class="w-full lg:w-2/3 xl:w-3/5 space-y-4 sm:space-y-4">
                            @foreach ($featuredPosts as $key => $post2)
                                <!-- Article Card -->
                                <article class="group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                                    <div class="flex flex-col sm:flex-row">
                                        <!-- Image Container -->
                                        <div class="relative shrink-0 w-full sm:w-2/5 lg:w-1/3 xl:w-2/5">
                                            <div class="aspect-video sm:aspect-square lg:aspect-video">
                                                <img src="{{ asset('uploads/' . $post2->featured_image) }}"
                                                     alt="{{ $post2->title }}"
                                                     class="w-full h-[100%] object-cover group-hover:scale-105 transition-transform duration-300" />
                                            </div>
                                            <!-- Category Badge -->
                                            <span class="absolute top-3 right-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-lg">
                                                {{ $post2->category->name }}
                                            </span>
                                        </div>

                                        <!-- Content Container -->
                                        <div class="flex-1 p-4 sm:p-6 lg:p-8">
                                            <div class="flex flex-col h-full justify-between">
                                                <div>
                                                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-3 line-clamp-2">
                                                        {{ $post2->title }}
                                                    </h3>
                                                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed line-clamp-3 mb-4">
                                                        {{ Str::limit(strip_tags($post2->content), 200) }}
                                                    </p>
                                                </div>

                                                <!-- Meta Information -->
                                                <div class="flex items-center justify-between text-sm text-gray-500">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
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
                        <div class="w-full lg:w-1/3 xl:w-2/5 space-y-4 sm:space-y-3">
                                                        <!-- Advertisement Cards -->
                            <div class=" gap-x-2 flex w-full">
                                <div class="w-[48%] bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-4 sm:p-6 border border-blue-200">
                                    <img src="{{ asset('images/adddds.jpg') }}"
                                         alt="Advertisement"
                                         class="w-full h-32 sm:h-40 object-cover rounded-lg mb-3" />
                                    <div class="text-center">
                                        <h4 class="font-semibold text-gray-900 mb-2">Special Offer</h4>
                                        <p class="text-sm text-gray-600">Discover amazing deals</p>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br w-[48%] from-purple-50 to-pink-100 rounded-xl p-4 sm:p-6 border border-purple-200">
                                    <img src="{{ asset('images/adddds.jpg') }}"
                                         alt="Advertisement"
                                         class="w-full h-32 sm:h-40 object-cover rounded-lg mb-3" />
                                    <div class="text-center">
                                        <h4 class="font-semibold text-gray-900 mb-2">Premium Content</h4>
                                        <p class="text-sm text-gray-600">Exclusive articles</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Newsletter Signup -->
                            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl p-6 sm:p-8 text-white">
                                <div class="text-center">
                                    <i class="fas fa-envelope text-3xl mb-4"></i>
                                    <h4 class="text-lg sm:text-xl font-bold mb-2">Stay Updated</h4>
                                    <p class="text-orange-100 text-sm sm:text-base mb-4">Get the latest articles delivered to your inbox</p>
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <input type="email"
                                               placeholder="Enter your email"
                                               class="flex-1 px-4 py-2 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                                        <button class="bg-white text-orange-500 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Popular Tags -->
                            <div class="bg-white rounded-xl  border border-gray-200 shadow-sm">
                                <img src="{{ asset('images/adddds.jpg') }}"
                                alt="Advertisement"
                                class="w-full h-32 sm:h-52 object-cover rounded-lg " />
                            </div>
                        </div>
                    </div>
                </div>
            </section>









            <!-- Popular Categories -->
            <section class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-dark mb-12 text-center">Popular Categories</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-primary group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-code text-2xl text-primary group-hover:text-primary"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Technology</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">56 Articles</p>
                        </a>

                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-yellow-500 group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-chart-line text-2xl text-yellow-500 group-hover:text-yellow-500"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Business</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">42 Articles</p>
                        </a>

                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-green-500 group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-heartbeat text-2xl text-green-500 group-hover:text-green-500"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Health</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">38 Articles</p>
                        </a>

                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-purple-500 group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-lightbulb text-2xl text-purple-500 group-hover:text-purple-500"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Productivity</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">34 Articles</p>
                        </a>
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
