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

    <div class=" max-w-screen-2xl mx-auto px-4 ">
        <!-- Top Row: Logo + Banner Ad (ad on top for mobile) -->
        <div class="grid grid-cols-12 gap-4 items-center py-2" x-show="!scrolled" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">

            <div class="col-span-12 order-1 lg:order-2 lg:col-span-8  overflow-hidden">
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
        <div class="flex items-center justify-between py-3 border-t border-gray-100">
                <a href="/" class="logo block lg:hidden d-flex align-items-center me-auto me-xl-0">

                <img src="{{ asset('images/logos.png') }}" style="width: 150px; height: auto; max-height: 80px;"
                    alt="NepByte Logo">
            </a>

            @php
                $navLink =
                    'relative pb-3 text-[15px] font-semibold tracking-wide text-gray-700 hover:text-primary transition-colors border-b-2 border-transparent hover:border-primary';
            @endphp
            <nav class="hidden lg:flex items-center gap-8">
                <a href="{{ url('/') }}"
                    class="{{ request()->is('/') ? 'text-primary border-primary' : '' }} {{ $navLink }}"
                    aria-current="{{ request()->is('/') ? 'page' : false }}">News</a>
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

                @foreach($categories as $category)
    <a href="{{ route('category.show', $category->slug) }}"
       class="{{ request()->is('category/'.$category->slug) ? 'text-primary border-primary' : '' }} {{ $navLink }}"
       aria-current="{{ request()->is('category/'.$category->slug) ? 'page' : false }}">
       {{ $category->name }}
    </a>
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
   class="px-5 py-2.5 border border-primary text-primary font-semibold text-sm rounded-full 
          hover:text-white transition-all duration-300 hover:shadow-lg 
          sm:px-4 sm:py-2 sm:text-xs">
   Sign In
</a>

<a href="{{ route('register') }}"
   class="px-5 py-2.5 bg-primary text-white font-semibold text-sm rounded-full 
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
            class="fixed top-0 left-0 h-[100vh] w-full max-w-sm bg-white z-[9999] shadow-2xl flex flex-col overflow-hidden">

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

                @auth
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-white/20 backdrop-blur-sm">
                        <div
                            class="w-10 h-10 rounded-full bg-white/30 flex items-center justify-center font-bold text-white text-base uppercase">
                            {{ auth()->user()->name[0] ?? '?' }}
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-white text-sm">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-blue-100 truncate">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                @endauth
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
                        <a href="{{ route('category.show', $category->slug) }}"
                            class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-[13px] font-medium text-gray-700 hover:text-primary transition-all duration-300 group">
                            <div
                                class="w-1.5 h-1.5 rounded-full bg-gray-300 group-hover:bg-primary transition-colors duration-300">
                            </div>
                            {{ $category->name }}
                        </a>
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
