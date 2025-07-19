@extends('frontend.layout.main')

@section('title', $category->meta_title ?: $category->name . ' - ' . \App\Models\Setting::get('site_name',
    'MyBlogSite'))
@section('meta_description', $category->meta_description ?: ($category->description ?: 'Explore ' . $category->name . '
    articles and posts on our blog platform.'))
@section('meta_keywords', $category->meta_keywords)

@section('content')
    <!-- Hero Section (smaller height) -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 py-4 sm:py-6 rounded-b-3xl shadow-lg mb-4">
        <div class="absolute bottom-0 left-0 w-full pointer-events-none z-0">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-6 sm:h-10 md:h-14">
                <path fill="url(#wave-gradient)" fill-opacity="0.3" d="M0,80 C480,120 960,40 1440,80 L1440,100 L0,100 Z">
                </path>
                <defs>
                    <linearGradient id="wave-gradient" x1="0" y1="0" x2="1440" y2="0"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#6366f1" />
                        <stop offset="1" stop-color="#a21caf" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <div class="mb-4">
                @if ($category->image)
                    <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}"
                        class="w-20 h-20 mx-auto rounded-lg object-cover mb-2 border-4 border-white shadow">
                @else
                    <div class="w-20 h-20 mx-auto rounded-lg flex items-center justify-center mb-2 bg-white/10">
                        <i class="{{ $category->icon ?? 'fas fa-folder' }} text-white text-2xl"></i>
                    </div>
                @endif
            </div>
            <h1
                class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-2 text-white flex items-center justify-center gap-2 drop-shadow-lg">
                {{ $category->name }}
                @if ($category->is_featured)
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">
                        <i class="fas fa-star mr-1"></i> Featured
                    </span>
                @endif
            </h1>
            <p class="text-base sm:text-lg text-slate-200 max-w-2xl mx-auto mb-2">{{ $category->description }}</p>
            <div class="flex flex-wrap items-center justify-center gap-3 text-xs font-medium w-full">
                <span class="flex items-center bg-white/80 px-3 py-1 rounded-full shadow text-gray-800">
                    <i class="fas fa-newspaper mr-2 text-blue-500"></i> {{ $category->posts_count }} posts
                </span>
                <span class="flex items-center bg-white/80 px-3 py-1 rounded-full shadow text-gray-800">
                    <i class="fas fa-eye mr-2 text-blue-500"></i> {{ number_format($category->posts->sum('views_count')) }}
                    total views
                </span>
            </div>
        </div>
    </section>

    <!-- Ad Banner Below Hero -->
    <div class="flex justify-center py-3">
        @if (isset($belowTitleAd) && $belowTitleAd)
            <a href="{{ $belowTitleAd->link }}" target="_blank" class="block w-full max-w-2xl">
                <img src="{{ asset('uploads/' . $belowTitleAd->image) }}" alt="{{ $belowTitleAd->title }}"
                    class="rounded-xl w-full object-contain max-h-16 mx-auto border shadow">
            </a>
        @else
            <img src="https://placehold.co/728x90?text=Advertisement" alt="Ad Banner"
                class="rounded-xl w-full object-contain max-h-16 mx-auto border shadow">
        @endif
    </div>

    <!-- Posts Grid & Sidebar -->
    <section class="py-8 sm:py-10 bg-white rounded-3xl shadow-xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-5 px-2 sm:px-4 md:px-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                @if ($posts->count() > 0)
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Latest {{ $category->name }} Posts</h2>
                        <p class="text-gray-600">Discover the latest articles in this category</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                        @foreach ($posts as $post)
                            @include('frontend.component.postcomponent')
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    @if ($posts->hasPages())
                        <div class="mt-10">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-folder text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Posts in This Category</h3>
                        <p class="text-gray-600 mb-6">
                            There are no posts published in the "{{ $category->name }}" category yet.
                        </p>
                        <div class="space-y-4">
                            <a href="{{ route('categories.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Browse All Categories
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-24">
                    <!-- Multiple Sidebar Advertisements -->
                    @if(isset($sidebarAds) && $sidebarAds->count())
                        @foreach($sidebarAds as $sidebarAd)
                        <div class="bg-gradient-to-b from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6 mb-6 overflow-hidden relative shadow-lg hover:shadow-xl transition-shadow">
                            <div class="absolute top-2 right-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">Sponsored</span>
                            </div>
                            <div class="text-center">
                                @if ($sidebarAd->image)
                                <div class="mb-4">
                                    <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="h-32 w-full rounded-lg object-cover mx-auto">
                                </div>
                                @endif
                                <h3 class="text-lg font-semibold text-blue-900 mb-2">{{ $sidebarAd->title }}</h3>
                                <p class="text-blue-800 text-sm mb-4">{{ $sidebarAd->description }}</p>
                                @if($sidebarAd->link)
                                <a href="{{ $sidebarAd->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 w-full justify-center">
                                    Learn More
                                    <i class="fas fa-external-link-alt ml-2"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <!-- Second Sidebar Advertisement (if available) -->
                    @if (isset($contentAd) && $contentAd)
                        <div class="bg-gradient-to-b from-teal-50 to-cyan-50 border border-teal-200 rounded-2xl p-6 overflow-hidden relative shadow-lg hover:shadow-xl transition-shadow">
                            <div class="absolute top-2 right-2">
                                <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2 py-1 rounded-full">Sponsored</span>
                            </div>
                            <div class="text-center">
                                @if($contentAd->image)
                                <div class="mb-4">
                                    <img src="{{ asset('uploads/' . $contentAd->image) }}" alt="{{ $contentAd->title }}" class="h-32 w-full rounded-lg object-cover mx-auto">
                                </div>
                                @endif
                                <h3 class="text-lg font-semibold text-teal-900 mb-2">{{ $contentAd->title }}</h3>
                                <p class="text-teal-800 text-sm mb-4">{{ $contentAd->description }}</p>
                                @if($contentAd->link)
                                <a href="{{ $contentAd->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg hover:bg-teal-700 transition-colors duration-200 w-full justify-center">
                                    Learn More
                                    <i class="fas fa-external-link-alt ml-2"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

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
@endsection
