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
    [x-cloak] {
        display: none !important;
    }

    @media (max-width: 1024px) {
        aside[role="dialog"] {
            will-change: transform, opacity;
        }
    }

    /* Smooth gradient animation */
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .gradient-animate {
        background-size: 200% 200%;
        animation: gradientShift 8s ease infinite;
    }

    /* Glass morphism effect */
    .glass-effect {
        backdrop-filter: blur(16px) saturate(180%);
        -webkit-backdrop-filter: blur(16px) saturate(180%);
        background-color: rgba(255, 255, 255, 0.95);
    }

    /* Smooth underline animation */
    .nav-link-underline {
        position: relative;
    }

    .nav-link-underline::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #ff2953, #ff5c7c);
        transform: translateX(-50%);
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 2px;
    }

    .nav-link-underline:hover::after,
    .nav-link-underline.active::after {
        width: 100%;
    }

    /* Enhanced dropdown shadow */
    .dropdown-shadow {
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.12),
                    0 10px 20px -5px rgba(0, 0, 0, 0.08);
    }

    /* Mobile sidebar smooth entrance */
    .sidebar-enter {
        animation: slideInLeft 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
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

<!-- Top Bar with Gradient -->
<div class="bg-gradient-to-r from-gray-900 via-black to-gray-900 text-white py-3 max-md:hidden gradient-animate">
    <div class="max-w-screen-2xl mx-auto px-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6 text-sm">
                <div class="flex items-center space-x-2 hover:text-primary transition-colors duration-300">
                    <i class="fa-solid fa-location-dot text-primary"></i>
                    <span class="font-medium">{{ \App\Models\Setting::get('contact_address', '123 Blog Street, Content City') }}</span>
                </div>
                <div class="flex items-center space-x-2 hover:text-primary transition-colors duration-300">
                    <i class="fa-solid fa-phone text-primary"></i>
                    <span class="font-medium">{{ \App\Models\Setting::get('contact_phone', '+1 (555) 123-4567') }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                @if($fb)
                    <a href="{{ $fb }}" target="_blank"
                       class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-primary hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-facebook-f text-sm"></i>
                    </a>
                @endif
                @if($ig)
                    <a href="{{ $ig }}" target="_blank"
                       class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-primary hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-instagram text-sm"></i>
                    </a>
                @endif
                @if($tw)
                    <a href="{{ $tw }}" target="_blank"
                       class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-primary hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-tiktok text-sm"></i>
                    </a>
                @endif
                @if($li)
                    <a href="{{ $li }}" target="_blank"
                       class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-primary hover:scale-110 transition-all duration-300">
                        <i class="fa-brands fa-linkedin-in text-sm"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header x-data="{ open: false, scrolled: false, showSearch: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="scrolled ? 'glass-effect shadow-2xl py-2' : 'bg-white/95 backdrop-blur-md shadow-lg py-3'"
        class="sticky top-0 z-[9999] transition-all duration-500 border-b border-gray-100 ">

    <div class="max-w-screen-2xl mx-auto px-6 lg:px-8 ">
        <!-- Top Row: Logo + Banner Ad -->
        <div class="grid grid-cols-12 gap-6 items-center"
             x-show="!scrolled"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-3">

            <div class="col-span-12 order-2 lg:order-2 lg:col-span-8 overflow-hidden rounded">
                <script src="https://adnebyte.nepbyte.com/ads/embed/6e189765-3196-4da1-a542-5bc5d4708658.js?count=1"></script>
            </div>

            <div class="col-span-12 lg:block hidden order-2 lg:order-1 lg:col-span-4">
                <a href="{{ route('home') }}" class="inline-block ">
                    <img src="{{ asset('images/logos.png') }}"
                         style="width: 200px; height: auto; max-height: 80px;"
                         alt="NepBlog Logo"
                         class="drop-shadow-lg">
                </a>
            </div>
        </div>

        <!-- Navigation Row -->
        <div class="flex items-center justify-between " :class="scrolled ? 'py-3' : 'py-4 border-t border-gray-100 mt-4'">
            <!-- Mobile Logo -->
            <a href="/" class="logo block lg:hidden ">
                <img src="{{ asset('images/logos.png') }}"
                     style="width: 150px; height: auto; max-height: 80px;"
                     alt="NepByte Logo">
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-8 ">
                <a href="{{ url('/') }}"
                   class="nav-link-underline inline-flex items-center h-10 text-[15px] font-bold tracking-wide transition-all duration-300 {{ request()->is('/') ? 'text-primary active' : 'text-gray-700 hover:text-primary' }}"
                   aria-current="{{ request()->is('/') ? 'page' : false }}">
                    NepTalk
                </a>

                @foreach ($categories as $category)
                    @if ($category->isParent())
                        <div class="relative group">
                            <a href="{{ route('category.show', $category->slug) }}"
                               class="nav-link-underline inline-flex items-center gap-2 h-10 text-[15px] font-bold tracking-wide transition-all duration-300 {{ request()->is('category/' . $category->slug) ? 'text-primary active' : 'text-gray-700 hover:text-primary' }}">
                                {{ $category->name }}
                                @if ($category->children && $category->children->count())
                                    <i class="fas fa-chevron-down text-[10px] mt-0.5 transition-transform duration-300 group-hover:rotate-180"></i>
                                @endif
                            </a>

                            @if ($category->children && $category->children->count())
                                <div class="absolute left-0 top-full mt-2 min-w-[340px] w-[500px] glass-effect dropdown-shadow border border-gray-100 rounded-2xl p-4 z-[10000] grid grid-cols-2 gap-2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transform -translate-y-2 group-hover:translate-y-0 transition-all duration-300 before:content-[''] before:absolute before:-top-2 before:left-0 before:w-full before:h-2">
                                    @foreach ($category->children as $sub)
                                        <a href="{{ route('category.show', $sub->slug) }}"
                                           class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-primary hover:to-pink-500 transition-all duration-300 transform hover:scale-105">
                                            {{ $sub->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </nav>

            <!-- Right Side: Search & Auth -->
            <div class="flex items-center gap-4">
                <!-- Enhanced Search -->
                <div class="relative hidden md:block" @click.outside="showSearch=false">
                    <button @click="showSearch=!showSearch"
                            class="w-10 h-10 flex items-center justify-center cursor-pointer rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all duration-300 hover:scale-110"
                            aria-label="Toggle search">
                        <i class="fas fa-search"></i>
                    </button>

                    <form x-show="showSearch"
                          x-transition:enter="transition ease-out duration-200"
                          x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                          x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                          action="{{ route('search') }}"
                          method="GET"
                          class="absolute top-full right-0 mt-3 w-96">
                        <div class="relative glass-effect border border-gray-200 rounded-2xl shadow-2xl p-1">
                            <input type="text"
                                   name="q"
                                   placeholder="Search for articles, topics..."
                                   class="w-full pl-12 pr-4  py-3.5 text-sm rounded-xl bg-transparent border-none focus:outline-none focus:ring-2 focus:ring-primary/20"
                                   autofocus>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                            <button type="submit"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-2 bg-primary cursor-pointer text-white rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105">
                                <i class="fas fa-arrow-right text-sm"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('user.dashboard') }}"
                           class="hidden sm:flex items-center gap-2 px-5 py-2.5 text-primary font-bold text-sm rounded-full border-2 border-primary hover:bg-primary hover:text-white transition-all duration-300 hover:scale-105">
                            <i class="fas fa-tachometer-alt text-xs"></i>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-2 px-5 py-2.5 text-gray-700 hover:text-red-600 font-bold text-sm hover:bg-red-50 rounded-full transition-all duration-300">
                                <i class="fas fa-sign-out-alt text-xs"></i>
                                Logout
                            </button>
                        </form>
                    @else
                      <a href="{{ route('login') }}"
   class="px-6 py-2.5 max-sm:px-4 max-sm:py-2 border-2 border-[#ff2953] text-[#ff2953] font-semibold text-sm rounded-full hover:bg-[#ff2953] hover:text-white transition-all duration-300 hover:scale-105 hover:shadow-lg">
   Sign In
</a>

<a href="{{ route('register') }}"
   class="hidden sm:inline-block px-6 py-2.5 bg-gradient-to-r bg-[#ff2953]  text-white font-semibold text-sm rounded-full transition-all duration-300 hover:shadow-xl hover:scale-105">
   Sign Up
</a>

                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary hover:text-white transition-all duration-300"
                        @click="open = true"
                        aria-label="Open menu">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced Mobile Sidebar -->
    <div class="lg:hidden">
        <div x-cloak x-show="open" @click="open = false"
             class="fixed inset-0 w-screen h-screen bg-black/60 backdrop-blur-sm z-[9998]"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <aside x-cloak x-show="open"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed top-0 left-0 h-[100vh] w-full max-w-sm bg-white z-[9999] shadow-2xl flex flex-col overflow-hidden"
               role="dialog"
               aria-modal="true">

            <!-- Sidebar Header with Gradient -->
            <div class="bg-white p-5 text-black gradient-animate">
                <div class="flex items-center justify-between mb-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-48 object-contain ">
                    <button @click="open = false"
                            aria-label="Close menu"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:rotate-90">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            @auth
                <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('user.dashboard') }}"
                           class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-primary to-pink-500 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <i class="fas fa-tachometer-alt text-xs"></i>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold border-2 border-primary text-primary rounded-xl hover:bg-primary hover:text-white transition-all duration-300">
                                <i class="fas fa-sign-out-alt text-xs"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            <!-- Enhanced Search -->
            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text"
                           name="q"
                           placeholder="Search articles..."
                           class="w-full pl-11 pr-12 py-3 text-sm border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:border-primary transition-all duration-300 focus:shadow-md">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 flex items-center justify-center bg-primary text-white rounded-lg hover:scale-110 transition-all duration-300">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </form>
            </div>

            <!-- Navigation -->
            <div class="flex-1 p-4 overflow-y-auto">
                <div class="space-y-2">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3 px-2">Navigation</h3>

                    @foreach ($categories as $category)
                        @if ($category->isParent())
                            <div x-data="{ open: false }" class="rounded-xl overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-primary/5 hover:to-pink-500/5 transition-all duration-300">
                                    <a href="{{ route('category.show', $category->slug) }}"
                                       class="flex-1 text-[14px] font-bold text-gray-700 hover:text-primary transition-colors duration-300">
                                        {{ $category->name }}
                                    </a>
                                    @if ($category->children && $category->children->count())
                                        <button type="button"
                                                @click.stop="open = !open"
                                                aria-label="Toggle subcategories"
                                                class="shrink-0 w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:text-primary hover:bg-primary/10 transition-all duration-300">
                                            <i class="fas fa-chevron-down text-[11px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                                        </button>
                                    @endif
                                </div>

                                @if ($category->children && $category->children->count())
                                    <div x-show="open"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 -translate-y-2"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 -translate-y-2"
                                         class="mt-1 pl-6 ml-4 border-l-3 border-primary/30 space-y-1.5 pb-2">
                                        @foreach ($category->children as $sub)
                                            <a href="{{ route('category.show', $sub->slug) }}"
                                               class="block px-4 py-2.5 rounded-lg text-[13px] font-semibold text-gray-600 hover:text-white hover:bg-gradient-to-r hover:from-primary hover:to-pink-500 transition-all duration-300 transform hover:translate-x-1">
                                                {{ $sub->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Auth Section -->
                @guest
                    <div class="mt-6 pt-4 border-t border-gray-200 space-y-3">
                        <a href="{{ route('login') }}"
                           class="block w-full px-4 py-3 text-center text-sm border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all duration-300 hover:scale-105">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                           class="block w-full px-4 py-3 text-center text-sm bg-primary text-white font-bold rounded-xl transition-all duration-300 shadow-md hover:shadow-xl hover:scale-105">
                            Get Started
                        </a>
                    </div>
                @endguest
            </div>

            <!-- Enhanced Footer -->
            <div class="mt-auto shrink-0 bg-gradient-to-r from-gray-50 to-white backdrop-blur border-t border-gray-200 p-4 text-center">
                <p class="text-[12px] text-gray-600 font-semibold">© {{ date('Y') }} NepBlog — All rights reserved.</p>
            </div>
        </aside>
    </div>
</header>

<script>
    document.addEventListener('alpine:init', () => {
        if (typeof Alpine !== 'undefined') {
            Alpine.store('openSidebar', false);
            Alpine.effect(() => {
                const isOpen = Alpine.store('openSidebar');
                document.body.classList.toggle('overflow-hidden', isOpen);
            });
        }
    });
</script>
