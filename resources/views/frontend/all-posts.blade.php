@extends('frontend.layout.main')

@section('title', 'All Posts - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Browse all articles and blog posts from our community of writers.')

@section('content')
<!-- Hero Banner Section -->
<section
    class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 py-6 sm:py-8 rounded-b-3xl shadow-lg mb-6">
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
            <div class="w-20 h-20 mx-auto rounded-lg flex items-center justify-center mb-2 bg-white/10">
                <i class="fas fa-newspaper text-white text-2xl"></i>
            </div>
        </div>
        <h1
            class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-2 text-white flex items-center justify-center gap-2 drop-shadow-lg">
            All Posts
        </h1>
        <p class="text-base sm:text-lg text-slate-200 max-w-2xl mx-auto mb-2">Discover all articles from our community
            of writers</p>
        <div class="flex flex-wrap items-center justify-center gap-3 text-xs font-medium w-full">
            <span class="flex items-center bg-white/80 px-3 py-1 rounded-full shadow text-gray-800">
                <i class="fas fa-newspaper mr-2 text-blue-500"></i> {{ $posts->total() }} posts
            </span>
            <span class="flex items-center bg-white/80 px-3 py-1 rounded-full shadow text-gray-800">
                <i class="fas fa-eye mr-2 text-blue-500"></i> {{ number_format($posts->sum('views_count')) }} total
                views
            </span>
        </div>
    </div>
</section>

<!-- Top Banner Advertisement -->
@if(isset($headerAd) && $headerAd)
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-4 sm:p-6 overflow-hidden relative">
        <div class="absolute top-2 right-2">
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">Advertisement</span>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            @if($headerAd->image)
            <div class="flex-shrink-0">
                <img src="{{ asset('uploads/' . $headerAd->image) }}" alt="{{ $headerAd->title }}"
                     class="h-16 w-auto rounded-lg object-contain">
            </div>
            @endif
            <div class="text-center sm:text-left flex-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $headerAd->title }}</h3>
                <p class="text-gray-600 text-sm mb-3">{{ $headerAd->description }}</p>
                @if($headerAd->link)
                <a href="{{ $headerAd->link }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Learn More
                    <i class="fas fa-external-link-alt ml-2"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<!-- Main Content with Sidebar -->
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-4">
        <!-- Posts Grid -->
        <div class="flex-1">
            @if ($posts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-2  mb-12">
                    @foreach ($posts as $index => $post)
                        @include('frontend.component.postcomponent')

                        <!-- Content Advertisement after every 8 posts -->
                        @if(($index + 1) % 8 == 0 && isset($contentAd) && $contentAd)
                        <div class="col-span-full my-8">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-4 sm:p-6 overflow-hidden relative">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">Sponsored</span>
                                </div>
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                                    @if($contentAd->image)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('uploads/' . $contentAd->image) }}" alt="{{ $contentAd->title }}"
                                             class="h-20 w-auto rounded-lg object-contain">
                                    </div>
                                    @endif
                                    <div class="text-center sm:text-left flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $contentAd->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3">{{ $contentAd->description }}</p>
                                        @if($contentAd->link)
                                        <a href="{{ $contentAd->link }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            Learn More
                                            <i class="fas fa-external-link-alt ml-2"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <!-- Bottom Banner Advertisement -->
                @if(isset($footerAd) && $footerAd)
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-2xl p-4 sm:p-6 overflow-hidden relative">
                        <div class="absolute top-2 right-2">
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">Advertisement</span>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            @if($footerAd->image)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('uploads/' . $footerAd->image) }}" alt="{{ $footerAd->title }}"
                                     class="h-16 w-auto rounded-lg object-contain">
                            </div>
                            @endif
                            <div class="text-center sm:text-left flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $footerAd->title }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $footerAd->description }}</p>
                                @if($footerAd->link)
                                <a href="{{ $footerAd->link }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors duration-200">
                                    Learn More
                                    <i class="fas fa-external-link-alt ml-2"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Pagination -->
                @if ($posts->hasPages())
                    <div class="flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Posts Found</h3>
                    <p class="text-gray-600">Posts will appear here once they are published.</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-80 flex-shrink-0">
            <!-- Sidebar Advertisement -->
            @if(isset($sidebarAd) && $sidebarAd)
            <div class="bg-gradient-to-b from-orange-50 to-red-50 border border-orange-200 rounded-2xl p-4 mb-6 overflow-hidden relative">
                <div class="absolute top-2 right-2">
                    <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-1 rounded-full">Sponsored</span>
                </div>
                <div class="text-center">
                    @if($sidebarAd->image)
                    <div class="mb-4">
                        <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}"
                             class="h-32 w-full rounded-lg object-cover mx-auto">
                    </div>
                    @endif
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $sidebarAd->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $sidebarAd->description }}</p>
                    @if($sidebarAd->link)
                    <a href="{{ $sidebarAd->link }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition-colors duration-200 w-full justify-center">
                        Learn More
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            <!-- Categories Widget -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tags mr-2 text-blue-500"></i>
                    Categories
                </h3>
                <div class="space-y-2">
                    @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                       class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-gray-700 font-medium">{{ $category->name }}</span>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                            {{ $category->posts_count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

                        <!-- Second Sidebar Advertisement -->
            @if(isset($contentAd) && $contentAd)
            <div class="bg-gradient-to-b from-teal-50 to-cyan-50 border border-teal-200 rounded-2xl p-4 overflow-hidden relative">
                <div class="absolute top-2 right-2">
                    <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2 py-1 rounded-full">Sponsored</span>
                </div>
                <div class="text-center">
                    @if($contentAd->image)
                    <div class="mb-4">
                        <img src="{{ asset('uploads/' . $contentAd->image) }}" alt="{{ $contentAd->title }}"
                             class="h-32 w-full rounded-lg object-cover mx-auto">
                    </div>
                    @endif
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $contentAd->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $contentAd->description }}</p>
                    @if($contentAd->link)
                    <a href="{{ $contentAd->link }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg hover:bg-teal-700 transition-colors duration-200 w-full justify-center">
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
