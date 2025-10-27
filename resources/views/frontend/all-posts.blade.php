@extends('frontend.layout.main')

@section('title', 'All Posts - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('meta_description', 'Browse all articles and blog posts from our community of writers.')

@section('content')
    <!-- Hero Banner Section (aligned with /categories) -->
    {{-- <section class="bg-gradient-to-r from-[#ff2953] to-[#c51f42] text-white py-12">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="text-sm font-semibold tracking-wide text-white uppercase mb-2">Browse</div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6">All Posts</h1>
            <p class="text-xl text-white leading-relaxed">
                Discover all articles from our community of writers.
            </p>
        </div>
    </section> --}}

    <section class="relative bg-white py-16 border-b border-gray-200">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-8">
            <div class="">
                <!-- Breadcrumb -->
                <nav class="text-sm mb-3" aria-label="Breadcrumb">
                    <ol class="list-reset flex text-gray-500">
                        <li>
                            <a href="/" class="hover:text-gray-900">Home</a>
                        </li>
                        <li>
                            <span class="mx-2">/</span>
                        </li>
                        <li class="text-gray-900 font-semibold">
                            All Posts
                        </li>
                    </ol>
                </nav>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-[#ff2953] mb-2 leading-[1.1]">
                    All Posts
                </h1>

                <p class="text-xl text-gray-600 leading-relaxed">
                    Discover all articles from our community of writers.
                </p>
            </div>
        </div>
    </section>

    <!-- Toolbar: breadcrumb + search (consistent with /categories) -->
    <div class="bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-700 font-medium">All Posts</li>
                    </ol>
                </nav>
                <form action="{{ route('search') }}" method="GET" class="w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <div class="relative w-full md:w-80">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search posts..."
                                class="w-full pl-10 pr-3 py-2.5 rounded-xl border border-gray-300 bg-white text-sm outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-[var(--primary)] transition-colors" />
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i
                                    class="fas fa-search"></i></span>
                        </div>
                        <button
                            class="px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:brightness-110 btn-professional"
                            type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Top Banner Advertisement -->
    @if (isset($headerAd) && $headerAd)
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div
                class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-4 sm:p-6 overflow-hidden relative">
                <div class="absolute top-2 right-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">Advertisement</span>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @if ($headerAd->image)
                        <div class="flex-shrink-0">
                            <img src="{{ asset('uploads/' . $headerAd->image) }}" alt="{{ $headerAd->title }}"
                                class="h-16 w-auto rounded-lg object-contain">
                        </div>
                    @endif
                    <div class="text-center sm:text-left flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $headerAd->title }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $headerAd->description }}</p>
                        @if ($headerAd->link)
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
    <div class="px-4 sm:px-6 lg:px-8 py-8 max-w-screen-2xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Posts Grid -->
            <div class="flex-1">
                @if ($posts->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-2  mb-12">
                        @foreach ($posts as $index => $post)
                            @include('frontend.component.postcomponent')

                            <!-- Content Advertisement after every 8 posts -->
                            @if (($index + 1) % 8 == 0)
                                <div class="col-span-full my-8">
                                    <div
                                        class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-4 sm:p-6 overflow-hidden relative">
                                        <div class="absolute top-2 right-2">
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">Sponsored</span>
                                        </div>
                                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">

                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('images/adddds.jpg') }}" alt="ads"
                                                    class="h-20 w-auto rounded-lg object-contain">
                                            </div>

                                            <div class="text-center sm:text-left flex-1">
                                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                   Test
                                                </h3>
                                                <p class="text-gray-600 text-sm mb-3">Test</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Bottom Banner Advertisement -->
                    @if (isset($footerAd) && $footerAd)
                        <div class="mb-8">
                            <div
                                class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-2xl p-4 sm:p-6 overflow-hidden relative">
                                <div class="absolute top-2 right-2">
                                    <span
                                        class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">Advertisement</span>
                                </div>
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                                    @if ($footerAd->image)
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('uploads/' . $footerAd->image) }}"
                                                alt="{{ $footerAd->title }}" class="h-16 w-auto rounded-lg object-contain">
                                        </div>
                                    @endif
                                    <div class="text-center sm:text-left flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $footerAd->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3">{{ $footerAd->description }}</p>
                                        @if ($footerAd->link)
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
               

                <!-- Categories Widget -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-tags mr-2 text-blue-500"></i>
                        Categories
                    </h3>
                    <div class="space-y-2">
                        @foreach ($categories as $category)
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
