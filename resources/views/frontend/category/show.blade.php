@extends('frontend.layout.main')

@section('title', $category->meta_title ?: $category->name . ' - ' . \App\Models\Setting::get('site_name',
    'NepBlog'))
@section('meta_description',
    $category->meta_description ?:
    ($category->description ?:
    'Explore ' .
    $category->name .
    '
    articles and posts on our blog platform.'))
@section('meta_keywords', $category->meta_keywords)

@section('content')
    <div class="">


        <!-- Hero Section (smaller height) -->
        <section class="bg-white py-8 border-b border-gray-100">
    <div class="max-w-screen-2xl mx-auto px-4">
        <!-- Breadcrumbs -->
        <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
            <ol class="flex items-center flex-wrap space-x-1">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-gray-700">Home</a>
                </li>
                <li>/</li>
                <li>
                    <a href="{{ route('categories.index') }}" class="hover:text-gray-700">Categories</a>
                </li>
                <li>/</li>
                <li class="text-gray-800 font-semibold">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Image + Info -->
        <div class="flex items-center gap-5 mb-6">
            @if ($category->image)
                <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}"
                    class="w-20 h-20 rounded-xl object-cover border border-gray-200 shadow-sm">
            @else
                <div
                    class="w-20 h-20 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-200">
                    <i class="{{ $category->icon ?? 'fas fa-folder' }} text-gray-400 text-2xl"></i>
                </div>
            @endif

            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                    {{ $category->name }}
                    @if ($category->is_featured)
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                    @endif
                </h1>
                <p class="text-gray-600 text-base leading-relaxed ">
                    {{ $category->description }}
                </p>
            </div>
        </div>

        <!-- Stats -->
        <div class="flex items-center gap-3 text-sm text-gray-700">
            <span class="flex items-center bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200">
                <i class="fas fa-newspaper mr-2 text-gray-500"></i> {{ $category->posts_count }} posts
            </span>
            <span class="flex items-center bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200">
                <i class="fas fa-eye mr-2 text-gray-500"></i>
                {{ number_format($category->posts->sum('views_count')) }} total views
            </span>
        </div>
    </div>
</section>




        <!-- Posts Grid & Sidebar -->
        <section class="py-5 mx-auto max-w-screen-2xl ">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-3 px-4 ">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if ($posts->count() > 0)
                        <!-- <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">Latest {{ $category->name }} Posts</h2>
                            <p class="text-gray-600">Discover the latest articles in this category</p>
                        </div> -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
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
                                    class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Browse All Categories
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-52">
                        <!-- Multiple Sidebar Advertisements -->
                        @if (isset($sidebarAds) && $sidebarAds->count())
                            @foreach ($sidebarAds as $sidebarAd)
                                <div class="mb-6">
                                    <div
                                        class="rounded-2xl border border-gray-200 overflow-hidden shadow hover:shadow-md transition-shadow bg-white">
                                        <div class="flex items-center justify-between p-3">
                                            <span
                                                class="bg-primary-50 text-primary-700 text-[11px] font-medium px-2 py-0.5 rounded-full">Sponsored</span>
                                            @if (!empty($sidebarAd->brand))
                                                <span class="text-xs text-gray-500">{{ $sidebarAd->brand }}</span>
                                            @endif
                                        </div>
                                        @if ($sidebarAd->image)
                                            @php($sidebarLink = $sidebarAd->link ?? '#')
                                            <a href="{{ $sidebarLink }}" target="_blank" rel="sponsored nofollow noopener"
                                                class="block">
                                                <div class="ad-frame rect-300x250">
                                                    <img src="{{ asset('uploads/' . $sidebarAd->image) }}"
                                                        alt="{{ $sidebarAd->title }}" loading="lazy"
                                                        class="w-full h-full object-contain">
                                                </div>
                                            </a>
                                        @endif
                                        <div class="p-4">
                                            <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-2">
                                                {{ $sidebarAd->title }}</h3>
                                            @if (!empty($sidebarAd->description))
                                                <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                                    {{ $sidebarAd->description }}</p>
                                            @endif
                                            @if ($sidebarAd->link)
                                                <a href="{{ $sidebarAd->link }}" target="_blank"
                                                    rel="sponsored nofollow noopener"
                                                    class="inline-flex items-center w-full justify-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                                                    Learn More
                                                    <i class="fas fa-external-link-alt ml-2"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- Second Sidebar Advertisement (if available) -->
                        @if (isset($contentAd) && $contentAd)
                            <div
                                class="rounded-2xl border border-gray-200 overflow-hidden shadow hover:shadow-md transition-shadow bg-white">
                                <div class="flex items-center justify-between p-3">
                                    <span
                                        class="bg-primary-50 text-primary-700 text-[11px] font-medium px-2 py-0.5 rounded-full">Sponsored</span>
                                </div>
                                @php($contentLink = $contentAd->link ?? '#')
                                @if ($contentAd->image)
                                    <a href="{{ $contentLink }}" target="_blank" rel="sponsored nofollow noopener"
                                        class="block">
                                        <div class="ad-frame rect-300x250">
                                            <img src="{{ asset('uploads/' . $contentAd->image) }}"
                                                alt="{{ $contentAd->title }}" loading="lazy"
                                                class="w-full h-full object-contain">
                                        </div>
                                    </a>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-2">
                                        {{ $contentAd->title }}
                                    </h3>
                                    @if (!empty($contentAd->description))
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">{{ $contentAd->description }}
                                        </p>
                                    @endif
                                    @if ($contentAd->link)
                                        <a href="{{ $contentAd->link }}" target="_blank" rel="sponsored nofollow noopener"
                                            class="inline-flex items-center w-full justify-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
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
    </div>

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

            /* Ad frames to enforce consistent sizes and reduce CLS */
            .ad-frame {
                width: 100%;
                background: #fff;
                display: block;
            }

            .ad-frame.leaderboard {
                /* 728x90 on desktop, taller on small screens */
                height: 90px;
            }

            @media (max-width: 640px) {
                .ad-frame.leaderboard {
                    height: 100px;
                    /* 320x100 / 300x100 */
                }
            }

            .ad-frame.rect-300x250 {
                height: 250px;
                max-width: 100%;
            }
        </style>
    @endpush
@endsection
