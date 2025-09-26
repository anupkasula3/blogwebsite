@extends('frontend.layout.main')

@section('title', \App\Models\Setting::get('site_name', 'NepBlog') . ' - ' .
    \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination'))
@section('meta_description',
    'Discover amazing stories, insights, and knowledge on our blog platform. Read the latest
    articles from top categories.')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>

        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center">
                <div class="mb-8">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-4">
                        <i class="fas fa-star mr-2"></i>
                        Welcome to {{ \App\Models\Setting::get('site_name', 'NepBlog') }}
                    </span>
                </div>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Discover Amazing
                    <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                        Stories
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Explore insightful articles, expert opinions, and trending topics from our community of passionate writers
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('all-posts') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200">
                        <i class="fas fa-book-open mr-2"></i>
                        Start Reading
                    </a>
                    <a href="#latest-posts"
                       class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-full border border-white/20 hover:bg-white/20 transition-all duration-200">
                        <i class="fas fa-arrow-down mr-2"></i>
                        Explore Content
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ \App\Models\Post::published()->count() }}+</div>
                    <div class="text-gray-600 font-medium">Articles Published</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ \App\Models\Category::count() }}+</div>
                    <div class="text-gray-600 font-medium">Categories</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">10K+</div>
                    <div class="text-gray-600 font-medium">Monthly Readers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">5★</div>
                    <div class="text-gray-600 font-medium">Reader Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts Section -->
    <section id="latest-posts" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest Articles</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Stay updated with our newest content and trending topics</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($latestPosts->take(6) as $post)
                    <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <a href="{{ route('post.show', $post->slug) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('uploads/' . $post->featured_image) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $post->category->name }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                    {{ $post->title }}
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        <span class="font-medium">{{ $post->author_name }}</span>
                                    </div>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock"></i>
                                        {{ $post->published_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('all-posts') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200">
                    View All Articles
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Posts Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Articles</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Handpicked content that our readers love most</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach ($featuredPosts->take(4) as $post)
                    <article class="group bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                        <a href="{{ route('post.show', $post->slug) }}" class="block">
                            <div class="flex flex-col sm:flex-row">
                                <div class="relative sm:w-2/5 flex-shrink-0">
                                    <img src="{{ asset('uploads/' . $post->featured_image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-48 sm:h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-1 p-6 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-3 line-clamp-2">
                                            {{ $post->title }}
                                        </h3>
                                        <p class="text-gray-600 mb-4 line-clamp-3">
                                            {{ Str::limit(strip_tags($post->content), 150) }}
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-xs"></i>
                                            </div>
                                            <span class="font-medium">{{ $post->author_name }}</span>
                                        </div>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-clock"></i>
                                            {{ $post->published_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Explore Categories</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover content tailored to your interests</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $categories = [
                        ['name' => 'Technology', 'icon' => 'fas fa-laptop-code', 'color' => 'from-blue-500 to-cyan-500', 'count' => '45'],
                        ['name' => 'Business', 'icon' => 'fas fa-chart-line', 'color' => 'from-green-500 to-emerald-500', 'count' => '32'],
                        ['name' => 'Lifestyle', 'icon' => 'fas fa-heart', 'color' => 'from-pink-500 to-rose-500', 'count' => '28'],
                        ['name' => 'Travel', 'icon' => 'fas fa-plane', 'color' => 'from-purple-500 to-indigo-500', 'count' => '21'],
                    ];
                @endphp

                @foreach($categories as $category)
                    <div class="group cursor-pointer">
                        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 text-center group-hover:scale-105">
                            <div class="w-16 h-16 bg-gradient-to-r {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="{{ $category['icon'] }} text-2xl text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $category['name'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $category['count'] }} Articles</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <i class="fas fa-envelope text-5xl text-white mb-6"></i>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Stay in the Loop</h2>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Get the latest articles, insights, and updates delivered straight to your inbox. Join our community of readers!
                </p>
            </div>

            <div class="max-w-md mx-auto">
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email"
                           placeholder="Enter your email address"
                           class="flex-1 px-6 py-4 rounded-full text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-lg">
                    <button type="submit"
                            class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-full shadow-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-200">
                        Subscribe
                    </button>
                </form>
                <p class="text-blue-100 text-sm mt-4">No spam, unsubscribe at any time</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What Our Readers Say</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Join thousands of satisfied readers who trust our content</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        [
                            'quote' => 'The quality of articles here is exceptional. I always find valuable insights that help me in my professional journey.',
                            'author' => 'Sarah Johnson',
                            'role' => 'Marketing Director'
                        ],
                        [
                            'quote' => 'This blog has become my go-to source for staying updated with the latest trends and technologies.',
                            'author' => 'Michael Chen',
                            'role' => 'Software Engineer'
                        ],
                        [
                            'quote' => 'Well-researched content with practical advice. The writing style is engaging and easy to understand.',
                            'author' => 'Emily Davis',
                            'role' => 'Business Consultant'
                        ]
                    ];
                @endphp

                @foreach($testimonials as $testimonial)
                    <div class="bg-gray-50 rounded-2xl p-8 relative">
                        <div class="absolute top-6 left-6 text-4xl text-blue-200">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="pt-8">
                            <p class="text-gray-700 mb-6 italic leading-relaxed">{{ $testimonial['quote'] }}</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $testimonial['author'] }}</div>
                                    <div class="text-sm text-gray-600">{{ $testimonial['role'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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

        /* Smooth scrolling for anchor links */
        html {
            scroll-behavior: smooth;
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endpush
