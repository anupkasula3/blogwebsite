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
                    <div class="flex">
                        <!-- Articles Section (75%) -->
                        <div class="w-3/4 pr-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-2">
                                @foreach ($latestPosts as $key => $post)
                                    @include('frontend.component.postcomponent')
                                    {{-- @include('frontend.component.postcomponent') --}}
                                @endforeach
                            </div>
                        </div>

                        <!-- Sidebar Section (25%) -->
                        <div class="w-1/4">
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
                        class="flex justify-center mb-14 gap-y-8 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between gap-x-2">
                        <div
                            class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                            <div class="flex items-center mb-6">
                                <img src="https://pagedone.io/asset/uploads/1696244553.png" alt="Harsh image"
                                    class="rounded-lg w-full object-cover">
                            </div>
                            <div class="block">
                                <h4 class="text-gray-900 font-medium leading-8 mb-9">Fintech 101: Exploring the Basics of
                                    Electronic Payments</h4>
                                <div class="flex items-center justify-between  font-medium">
                                    <h6 class="text-sm text-gray-500">By Harsh C.</h6>
                                    <span class="text-sm text-indigo-600">2 year ago</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                            <div class="flex items-center mb-6">
                                <img src="https://pagedone.io/asset/uploads/1696244579.png" alt="John image"
                                    class="rounded-lg w-full object-cover">
                            </div>
                            <div class="block">
                                <h4 class="text-gray-900 font-medium leading-8 mb-9">From Classroom to Cyberspace: The
                                    Growing Influence of EdTech in Fintech</h4>
                                <div class="flex items-center justify-between  font-medium">
                                    <h6 class="text-sm text-gray-500">By John D.</h6>
                                    <span class="text-sm text-indigo-600">2 year ago</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                            <div class="flex items-center mb-6">
                                <img src="https://pagedone.io/asset/uploads/1696244619.png" alt="Alexa image"
                                    class="rounded-lg w-full object-cover">
                            </div>
                            <div class="block">
                                <h4 class="text-gray-900 font-medium leading-8 mb-9">Fintech Solutions for Student Loans:
                                    Easing the Burden of Education Debt</h4>
                                <div class="flex items-center justify-between  font-medium">
                                    <h6 class="text-sm text-gray-500">By Alexa H.</h6>
                                    <span class="text-sm text-indigo-600">2 year ago</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group cursor-pointer w-full max-lg:max-w-xl lg:w-1/3 border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                            <div class="flex items-center mb-6">
                                <img src="https://pagedone.io/asset/uploads/1696244619.png" alt="Alexa image"
                                    class="rounded-lg w-full object-cover">
                            </div>
                            <div class="block">
                                <h4 class="text-gray-900 font-medium leading-8 mb-9">Fintech Solutions for Student Loans:
                                    Easing the Burden of Education Debt</h4>
                                <div class="flex items-center justify-between  font-medium">
                                    <h6 class="text-sm text-gray-500">By Alexa H.</h6>
                                    <span class="text-sm text-indigo-600">2 year ago</span>
                                </div>
                            </div>
                        </div>
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


            <section class="py-14 md:py-24  text-zinc-900 relative overflow-hidden">
                <div class="  ">
                    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-4 gap-y-5 items-start">

                        <!-- LEFT: Product List (8 cols) -->
                        <div class="xl:col-span-8 space-y-3 ">
                            <!-- Product Item -->
                            <div class="flex gap-6 shadow">
                                <div class="relative  shrink-0">
                                    <span
                                        class="absolute top-2 right-2 bg-green-500 text-white text-xs px-3 py-1 rounded-full">New</span>
                                    <img src="https://cdn.easyfrontend.com/pictures/blog/blog_11_2.png" alt="..."
                                        class="rounded-lg max-w-full h-auto w-full max-h-full" />
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-lg md:text-xl font-semibold hover:underline">
                                        2021 Apple iMac (24-inch, M1, 8GB RAM, 256GB)
                                    </h2>
                                    <h4 class="text-sm text-gray-500 mt-1">Computer & Accessories</h4>
                                    <ul class="list-disc list-inside text-sm text-gray-600 mt-4 space-y-1">
                                        <li>16GB RAM</li>
                                        <li>1TB SSD Hard Drive</li>
                                        <li>10-core Intel Xeon</li>
                                        <li>Mac OS</li>
                                        <li>Secured</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- More products can be repeated like this... -->
                            <div class="flex shadow gap-6">
                                <div class="relative  shrink-0">
                                    <span
                                        class="absolute top-2 right-2 bg-green-500 text-white text-xs px-3 py-1 rounded-full">New</span>
                                    <img src="https://cdn.easyfrontend.com/pictures/blog/blog_11_1.png" alt="Product"
                                        class="rounded-lg w-full h-auto shadow-md object-cover transition hover:scale-105 duration-300">
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-lg md:text-xl font-semibold hover:underline">
                                        Mac Studio 2023 – M2 Max Chip, 32GB RAM
                                    </h2>
                                    <h4 class="text-sm text-gray-500 mt-1">Pro Desktops</h4>
                                    <ul class="list-disc list-inside text-sm text-gray-600 mt-4 space-y-1">
                                        <li>32GB RAM</li>
                                        <li>2TB NVMe SSD</li>
                                        <li>M2 Max 12-Core</li>
                                        <li>Ventilated Case</li>
                                        <li>Preinstalled macOS Sonoma</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT: Common Panel (4 cols) -->
                        <div class="xl:col-span-4  space-y-6 sticky  self-start">
                            <div class="flex gap-x-2">

                                <img src="{{ asset('images/adddds.jpg') }}" alt="..."
                                    class="rounded-lg   object-contain w-[48%] max-h-full" />
                                <img src="{{ asset('images/adddds.jpg') }}" alt="..."
                                    class="rounded-lg   object-contain w-[48%] max-h-full" />
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
