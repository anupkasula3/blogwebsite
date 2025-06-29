<!-- Header Advertisement Banner -->
@if(isset($headerAd) && $headerAd)
<div class="ad-banner py-2 px-4 text-center text-sm font-medium">
    <a href="{{ $headerAd->link }}" target="_blank"
       onclick="trackAdClick({{ $headerAd->id }}, 'header')"
       class="flex items-center justify-center space-x-2 hover:opacity-90 transition-opacity">
        <span>{{ $headerAd->title }}</span>
        <i class="fas fa-external-link-alt text-xs"></i>
    </a>
</div>
@endif

<!-- Main Header -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-blog text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-gradient">MyBlogSite</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">
                    Home
                </a>
                <div class="relative group">
                    <button class="text-gray-700 hover:text-purple-600 font-medium transition-colors flex items-center space-x-1">
                        <span>Categories</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            @foreach($categories ?? [] as $category)
                            <a href="{{ route('category.show', $category->slug) }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $category->posts_count }}</span>
                                </div>
                            </a>
                            @endforeach
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-purple-600 hover:bg-purple-50 font-medium">
                                    View All Categories
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">
                    About
                </a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">
                    Contact
                </a>
            </nav>

            <!-- Search Bar -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center">
                        <input type="text" name="q" placeholder="Search articles..."
                               class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <button type="submit" class="absolute left-3 text-gray-400 hover:text-purple-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- User Menu / Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                @auth
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-purple-600">
                        <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-8 h-8 rounded-full">
                        <span class="hidden lg:block">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-2">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50">
                                <i class="fas fa-user mr-2"></i>Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-purple-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
                    Sign Up
                </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700 hover:text-purple-600" x-data="{ open: false }" @click="open = !open">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden" x-data="{ open: false }" x-show="open" x-transition>
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">
                    Home
                </a>
                <div x-data="{ categoriesOpen: false }">
                    <button @click="categoriesOpen = !categoriesOpen" class="w-full text-left px-3 py-2 text-gray-700 hover:text-purple-600 font-medium flex items-center justify-between">
                        <span>Categories</span>
                        <i class="fas fa-chevron-down text-xs" :class="{ 'rotate-180': categoriesOpen }"></i>
                    </button>
                    <div x-show="categoriesOpen" x-transition class="pl-4">
                        @foreach($categories ?? [] as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="block px-3 py-2 text-gray-600 hover:text-purple-600">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">
                    About
                </a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-purple-600 font-medium">
                    Contact
                </a>

                <!-- Mobile Search -->
                <div class="px-3 py-2">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center">
                        <input type="text" name="q" placeholder="Search articles..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <button type="submit" class="absolute left-3 text-gray-400 hover:text-purple-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
