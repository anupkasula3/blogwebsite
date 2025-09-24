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

<header x-data="{ open: false, scrolled: false, showSearch: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-lg' : 'bg-white/90 backdrop-blur-md shadow-md'"
    class="sticky top-0 z-[9999] transition-all duration-300 border-b border-gray-100">

    <div class="container mx-auto px-4 lg:px-8">
        <!-- Top Row: Logo + Banner Ad (ad on top for mobile) -->
        <div class="grid grid-cols-12 gap-4 items-center py-2">

            <div class="col-span-12 order-1 lg:order-2 lg:col-span-8  overflow-hidden">
            <script src="https://adnebyte.nepbyte.com/ads/embed/6e189765-3196-4da1-a542-5bc5d4708658.js?count=1"></script>
            </div>


            <!-- Logo Section -->
            <div class="col-span-12 order-2 lg:order-1 lg:col-span-4">
                <!-- <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo"
                            class="h-10 w-10 object-contain transition-transform duration-300 group-hover:scale-110">
                        <div
                            class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-primary/20">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="text-2xl font-bold text-primary tracking-tight">Blog</span>
                        <span class="text-xs text-gray-500 font-medium -mt-1">Professional Blog</span>
                    </div>
                </a> -->

                <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="{{ asset('images/logos.png') }}" style="width: 200px; height: auto; max-height: 80px;"
                alt="NepByte Logo">
        </a>

            </div>


        </div>

        <!-- Bottom Row: Navigation + Search/Auth -->
        <div class="flex items-center justify-between py-3 border-t border-gray-100">
            @php
                $navLink =
                    'relative pb-3 text-[15px] font-semibold tracking-wide text-gray-700 hover:text-primary transition-colors border-b-2 border-transparent hover:border-primary';
            @endphp
            <nav class="hidden lg:flex items-center gap-8">
                <a href="{{ url('/') }}"
                    class="{{ request()->is('/') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('/') ? 'page' : false }}">Home</a>
                <div class="relative" x-data="{ catOpen: false }" @mouseenter="catOpen=true" @mouseleave="catOpen=false">
                    <a href="{{ route('categories.index') }}"
                        class="{{ request()->routeIs('categories.*') ? 'text-primary border-primary' : '' }} {{ $navLink }} flex items-center gap-2">
                        Category
                        <i class="fas fa-chevron-down text-[11px] mt-0.5"></i>
                    </a>
                    <div x-show="catOpen" x-transition
                        class="absolute left-0 mt-2 w-[560px] bg-white shadow-xl border border-gray-100 rounded-xl p-4 grid grid-cols-2 gap-2 z-[10000]">
                        @foreach (($categories ?? collect())->take(8) as $category)
                            <a href="{{ route('category.show', $category->slug) }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-primary transition">
                                {{ $category->name }}
                            </a>
                        @endforeach
                        <a href="{{ route('categories.index') }}"
                            class="col-span-2 mt-1 px-3 py-2 rounded-lg text-sm font-semibold text-primary transition text-center">View
                            all categories</a>
                    </div>
                </div>
                <a href="{{ url('/about') }}"
                    class="{{ request()->is('about') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('about') ? 'page' : false }}">About</a>
                <a href="{{ url('/latest-news') }}"
                    class="{{ request()->is('latest-news') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('latest-news') ? 'page' : false }}">Latest News</a>
                <a href="{{ url('/contact') }}"
                    class="{{ request()->is('contact') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('contact') ? 'page' : false }}">Contact</a>
                <a href="{{ url('/pages') }}"
                    class="{{ request()->is('pages*') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('pages*') ? 'page' : false }}">Pages</a>
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
                                class="flex items-center gap-2 px-4 py-2 text-primary font-semibold text-sm rounded-lg transition-all duration-300">
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
                            class="px-5 py-2.5 border border-primary text-primary font-semibold text-sm rounded-full hover:bg-primary hover:text-white transition-all duration-300 hover:shadow-lg">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 bg-primary text-white font-semibold text-sm rounded-full transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                            Get Started
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button
                    class="lg:hidden p-2 text-gray-700 hover:text-primary rounded-lg transition-all duration-300"
                    @click="open = true" aria-label="Open menu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Navigation -->
    <div class="lg:hidden">
        <!-- Overlay -->
        <div x-show="open" @click="open = false"
            class="fixed inset-0 w-screen h-screen bg-black/50 backdrop-blur-sm z-[9998] transition-all duration-300"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Sidebar -->
        <aside x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 h-screen w-full max-w-sm bg-white z-[9999] shadow-2xl flex flex-col overflow-y-auto">

            <!-- Header -->
            <div class="bg-primary p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        <div>
                            <span class="text-xl font-bold">NEVDO</span>
                            <p class="text-xs text-white/80">Professional Blog</p>
                        </div>
                    </div>
                    <button @click="open = false" aria-label="Close menu"
                        class="p-2 hover:bg-white/20 rounded-lg transition-colors duration-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                @auth
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-white/20 backdrop-blur-sm">
                        <div
                            class="w-12 h-12 rounded-full bg-white/30 flex items-center justify-center font-bold text-white text-lg uppercase">
                            {{ auth()->user()->name[0] ?? '?' }}
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-blue-100 truncate">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Search -->
            <div class="p-4 border-b border-gray-100">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Search articles..."
                        class="w-full pl-10 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none transition-all duration-300">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-primary transition-colors duration-300">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>

            <!-- Navigation -->
            <div class="flex-1 p-4">
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Categories</h3>
                    @foreach (($categories ?? collect())->take(6) as $category)
                        <a href="{{ route('category.show', $category->slug) }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                            <div
                                class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-primary transition-colors duration-300">
                            </div>
                            {{ $category->name }}
                        </a>
                    @endforeach
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-primary transition-all duration-300 mt-3">
                        <i class="fas fa-th-large text-sm"></i>
                        View All Categories
                    </a>
                </div>

                <!-- Auth Section -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    @auth
                        <div class="space-y-2">
                            <a href="{{ route('user.dashboard') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-primary transition-all duration-300">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-3 rounded-xl font-medium text-red-600 hover:bg-red-50 transition-all duration-300">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="space-y-3">
                            <a href="{{ route('login') }}"
                                class="block w-full px-4 py-3 text-center border border-primary text-primary font-semibold rounded-xl hover:bg-primary hover:text-white transition-all duration-300">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}"
                                class="block w-full px-4 py-3 text-center bg-primary text-white font-semibold rounded-xl transition-all duration-300 shadow-lg">
                                Get Started
                            </a>
                        </div>
                    @endauth
                </div>
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

<!-- Below Navbar Banner Ad -->
@if (isset($belowHeaderAd) && $belowHeaderAd)
    <div class="w-full bg-white flex justify-center items-center py-2 border-b">
        <a href="{{ $belowHeaderAd->link }}" target="_blank" class="block">
            <img src="{{ asset('/uploads/' . $belowHeaderAd->image) }}" alt="{{ $belowHeaderAd->title }}"
                class="h-12 object-contain mx-auto">
        </a>
    </div>
@endif
