@if (config('services.ga4.measurement_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga4.measurement_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ config('services.ga4.measurement_id') }}');
    </script>
@endif
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
    /* Prevent x-show content from flashing before Alpine initializes */
    [x-cloak] {
        display: none !important;
    }

    /* Optional: improve mobile sidebar performance */
    @media (max-width: 1024px) {
        aside[role="dialog"] {
            will-change: transform, opacity;
        }
    }
</style>
@php
    $fb = \App\Models\Setting::get('social_facebook') ?: \App\Models\Setting::get('facebook_url');
    $tw = \App\Models\Setting::get('social_twitter') ?: \App\Models\Setting::get('twitter_url');
    $ig = \App\Models\Setting::get('social_instagram') ?: \App\Models\Setting::get('instagram_url');
    $li = \App\Models\Setting::get('social_linkedin') ?: \App\Models\Setting::get('linkedin_url');
    $yt = \App\Models\Setting::get('social_youtube') ?: \App\Models\Setting::get('youtube_url');
@endphp

<div class="bg-black text-white py-3 max-md:hidden">
    <div class="max-w-screen-2xl mx-auto px-4">
        <div class="flex items-center justify-between">

            <!-- Left Side: Location and Phone -->
            <div class="flex items-center space-x-4 text-sm">
                <div class="flex items-center space-x-1">
                    <i class="fa-solid fa-location-dot text-primary"></i>
                    <span>{{ \App\Models\Setting::get('contact_address', '123 Blog Street, Content City') }}</span>
                </div>
                <div class="flex items-center space-x-1">
                    <i class="fa-solid fa-phone text-primary"></i>
                    <span>{{ \App\Models\Setting::get('contact_phone', '+1 (555) 123-4567') }}</span>
                </div>
            </div>

            <!-- Right Side: Social Icons -->
            <div class="flex items-center space-x-4">
                <a href="{{ $fb }}" target="_blank" class="hover:text-primary transition"><i
                        class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ $ig }}" target="_blank" class="hover:text-primary transition"><i
                        class="fa-brands fa-instagram"></i></a>
                <a href="{{ $tw }}" target="_blank" class="hover:text-primary transition"><i
                        class="fa-brands fa-tiktok"></i></a>
                <a href="{{ $li }}" target="_blank" class="hover:text-primary transition"><i
                        class="fa-brands fa-linkedin-in"></i></a>
            </div>

        </div>
    </div>
</div>

<header x-data="{ open: false, scrolled: false, showSearch: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-lg' : 'bg-white/90 backdrop-blur-md shadow-md'"
    class="sticky top-0 z-[9999] transition-all duration-300 border-b border-gray-100">

    <div class=" max-w-screen-2xl mx-auto px-6 lg:px-8 ">
        <!-- Top Row: Logo + Banner Ad (ad on top for mobile) -->
        <div class="grid grid-cols-12 gap-6 items-center py-3" x-show="!scrolled"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">

            <div class="col-span-12 order-2 lg:order-2 lg:col-span-8 overflow-hidden">
                <script src="https://adnebyte.nepbyte.com/ads/embed/6e189765-3196-4da1-a542-5bc5d4708658.js?count=1"></script>
            </div>


            <!-- Logo Section -->
            <div class="col-span-12 lg:block hidden order-2 lg:order-1 lg:col-span-4">


                <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">

                    <img src="{{ asset('images/logos.png') }}" style="width: 200px; height: auto; max-height: 80px;"
                        alt="NepBlog Logo">
                </a>

            </div>


        </div>

        <!-- Bottom Row: Navigation + Search/Auth -->
        <div class="flex items-center justify-between py-2 lg:py-0 border-t border-gray-100">
            <a href="/" class="logo block lg:hidden d-flex align-items-center me-auto me-xl-0">

                <img src="{{ asset('images/logos.png') }}" style="width: 150px; height: auto; max-height: 80px;"
                    alt="NepByte Logo">
            </a>

            @php
                $navLink =
                    'relative inline-flex items-center h-12 text-[15px] font-semibold tracking-wide text-gray-700 hover:text-primary transition-colors border-b-2 border-transparent hover:border-primary';
            @endphp
            <nav class="hidden lg:flex items-center gap-6">
                <a href="{{ url('/') }}"
                    class="{{ request()->is('/') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('/') ? 'page' : false }}">NepTalk</a>
                <!-- <div class="relative" x-data="{ catOpen: false }" @mouseenter="catOpen=true" @mouseleave="catOpen=false">
                    <a href="{{ route('categories.index') }}"
                        class="{{ request()->routeIs('categories.*') ? 'text-primary border-primary' : '' }} {{ $navLink }} flex items-center gap-2">
                        Category
                        <i class="fas fa-chevron-down text-[11px] mt-0.5"></i>
                    </a>
                    <div x-show="catOpen" x-transition
                        class="absolute left-0 mt-2 w-[450px] bg-white shadow-xl border border-gray-100 rounded-xl p-4 grid grid-cols-2 gap-2 z-[10000]">
                        @foreach ($categories as $category)
<a href="{{ route('category.show', $category->slug) }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-primary transition">
                                {{ $category->name }}
                            </a>
@endforeach
                        {{-- <a href="{{ route('categories.index') }}"
                            class="col-span-2 mt-1 px-3 py-2 rounded-lg text-sm font-semibold text-primary transition text-center">View
                            all categories</a> --}}
                    </div>
                </div> -->

                @foreach ($categories as $category)
                    @if ($category->isParent())
                        <div class="relative group">
                            <a href="{{ route('category.show', $category->slug) }}"
                                class="{{ request()->is('category/' . $category->slug) ? 'text-primary border-primary' : '' }} {{ $navLink }} flex items-center gap-1.5">
                                {{ $category->name }}
                                @if ($category->children && $category->children->count())
                                    <i class="fas fa-chevron-down text-[10px] mt-0.5 transition-transform duration-200 group-hover:rotate-180"></i>
                                @endif
                            </a>
                            @if ($category->children && $category->children->count())
                                <div class="absolute left-0 top-full mt-0 min-w-[320px] w-[480px] bg-white shadow-xl border border-gray-100 rounded-xl p-3 z-[10000] grid grid-cols-2 gap-1.5 invisible opacity-0 group-hover:visible group-hover:opacity-100 transform -translate-y-1 group-hover:translate-y-0 transition duration-150 before:content-[''] before:absolute before:-top-2 before:left-0 before:w-full before:h-2">
                                    @foreach ($category->children as $sub)
                                        <a href="{{ route('category.show', $sub->slug) }}"
                                            class="w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-primary hover:bg-gray-50 transition">
                                            {{ $sub->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach

                <!-- <a href="{{ url('/latest') }}"
                    class="{{ request()->is('latest') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('latest') ? 'page' : false }}">Latest News</a>
                <a href="{{ url('/contact') }}"
                    class="{{ request()->is('contact') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('contact') ? 'page' : false }}">Contact</a> -->
                <!-- <a href="{{ url('/pages') }}"
                    class="{{ request()->is('pages*') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('pages*') ? 'page' : false }}">Pages</a> -->
            </nav>

            <!-- Right Side: Search & Auth -->
            <div class="flex items-center gap-4">

                <!-- Search Bar -->
                <div class="relative hidden md:block" @click.outside="showSearch=false">
                    <button @click="showSearch=!showSearch"
                        class="p-2.5 rounded-full text-gray-600 hover:text-primary transition"
                        aria-label="Toggle search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fas fa-search"></i>
                    </button>
                    <form x-show="showSearch" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0" action="{{ route('search') }}"
                        method="GET" class="absolute bottom-0 right-0 mt-2 w-80">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Search articles..."
                                class="w-full pl-10 pr-4 py-2.5 text-sm rounded-full bg-white border border-gray-200 shadow-lg focus:outline-none">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search text-sm"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Authentication Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <div class="flex items-center gap-3">
                            <a href="{{ route('user.dashboard') }}"
                                class="flex max-sm:hidden items-center gap-2 px-4 py-2 text-primary font-semibold text-sm rounded-lg transition-all duration-300">
                                <i class="fas fa-tachometer-alt text-xs"></i>
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-red-600 font-medium text-sm hover:bg-red-50 rounded-lg transition-all duration-300">
                                    <i class="fas fa-sign-out-alt text-xs"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 max-sm:py-1 max-sm:px-3 py-2.5 border border-primary text-primary font-semibold text-sm rounded-full
          hover:text-white transition-all duration-300 hover:shadow-lg
          sm:px-4 sm:py-2 sm:text-xs">
                            Sign In
                        </a>

                        <a href="{{ route('register') }}"
                            class="px-5  py-2.5 bg-primary max-sm:hidden text-white font-semibold text-sm rounded-full
          transition-all duration-300 hover:shadow-lg transform hover:scale-105
          sm:px-4 sm:py-2 sm:text-xs">
                            SignUp
                        </a>

                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 text-gray-700 hover:text-primary rounded-lg transition-all duration-300"
                    @click="open = true" aria-label="Open menu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Navigation -->
    <div class="lg:hidden">
        <!-- Overlay -->
        <div x-cloak x-show="open" @click="open = false"
            class="fixed inset-0 w-screen h-screen bg-black/50 backdrop-blur-sm z-[9998] transition-all duration-300"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Sidebar -->
        <aside x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 h-[100vh] w-full max-w-sm bg-white z-[9999] shadow-2xl flex flex-col overflow-hidden"
            role="dialog" aria-modal="true">

            <!-- Header -->
            <div class="bg-white p-4 text-primary">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex justify-center items-center gap-2.5">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-56 object-contain">

                    </div>
                    <button @click="open = false" aria-label="Close menu"
                        class="p-1.5 hover:bg-white/20 rounded-lg transition-colors duration-300">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>


            </div>

            <!-- Quick Actions (Top) -->
            @auth
                <div class="px-3 py-2 border-b border-gray-100 bg-white/80 backdrop-blur">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('user.dashboard') }}"
                            class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:brightness-110 transition">
                            <i class="fas fa-tachometer-alt text-xs"></i>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold border border-primary text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                <i class="fas fa-sign-out-alt text-xs"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            <!-- Search -->
            <div class="p-3 border-b border-gray-100">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Search articles..."
                        class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none transition-all duration-300">
                    <div class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search text-sm"></i>
                    </div>
                    <button type="submit"
                        class="absolute right-2.5 top-1/2 transform -translate-y-1/2 text-primary transition-colors duration-300">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>
            </div>

            <!-- Navigation -->
            <div class="flex-1 p-3 overflow-y-auto">
                <div class="space-y-1.5">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Categories</h3>
                    @foreach ($categories as $category)
                        @if ($category->isParent())
                            <div class="rounded-xl">
                                <div x-data="{ open: false }" class="">
                                    <div class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-gray-50">
                                        <a href="{{ route('category.show', $category->slug) }}"
                                           class="text-[13px] font-medium text-gray-700 hover:text-[#ff2953] transition">
                                            {{ $category->name }}
                                        </a>
                                        @if ($category->children && $category->children->count())
                                            <button type="button" @click.stop="open = !open" aria-label="Toggle subcategories"
                                                class="shrink-0 p-1.5 text-gray-500 hover:text-[#ff2953] transition">
                                                <i class="fas fa-chevron-down text-[11px]" :class="open ? 'rotate-180' : ''"></i>
                                            </button>
                                        @endif
                                    </div>

                                    @if ($category->children && $category->children->count())
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-150"
                                             x-transition:enter-start="opacity-0 -translate-y-1"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 -translate-y-1"
                                             class="mt-1 pl-4 ml-3 border-l-2 border-[#ff2953]/30 space-y-1.5">
                                            @foreach ($category->children as $sub)
                                                <a href="{{ route('category.show', $sub->slug) }}"
                                                   class="block px-3 py-2 rounded-lg text-[13px] font-medium text-gray-700 hover:text-[#ff2953] hover:bg-gray-50 transition">
                                                    {{ $sub->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{-- <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-2.5 px-3 py-2 rounded-xl font-semibold text-primary transition-all duration-300 mt-2">
                        <i class="fas fa-th-large text-xs"></i>
                        View All Categories
                    </a> --}}
                </div>

                <!-- Auth Section -->
                <div class="mt-6 pt-4 border-t border-gray-100">
                    @auth
                        <!-- Actions moved to the top below user details -->
                    @else
                        <div class="space-y-2.5">
                            <a href="{{ route('login') }}"
                                class="block w-full px-3 py-2 text-center text-sm border border-primary text-primary font-semibold rounded-xl hover:bg-primary hover:text-[#ffffff] transition-all duration-300">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}"
                                class="block w-full px-3 py-2 text-center text-sm bg-primary text-white font-semibold rounded-xl transition-all duration-300 shadow-sm">
                                Get Started
                            </a>
                        </div>
                    @endauth
                </div>

            </div>

            <!-- Fixed Sidebar Footer -->
            <div class="mt-auto shrink-0 bg-white/95 backdrop-blur border-t border-gray-100 p-3 text-center">
                <p class="text-[12px] text-gray-500">© {{ date('Y') }} NepBlog — All rights reserved.</p>
            </div>
        </aside>

        <script>
            // Wait for Alpine to be ready
            document.addEventListener('alpine:init', () => {
                // Initialize sidebar store
                if (typeof Alpine !== 'undefined') {
                    Alpine.store('openSidebar', false);

                    // Handle body overflow when sidebar is open
                    Alpine.effect(() => {
                        const isOpen = Alpine.store('openSidebar');
                        if (isOpen) {
                            document.body.classList.add('overflow-hidden');
                        } else {
                            document.body.classList.remove('overflow-hidden');
                        }
                    });
                }
            });
        </script>
    </div>
</header>
