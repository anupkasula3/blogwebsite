@extends('frontend.layout.main')

@section('title', 'Categories - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Explore all categories and find content that interests you on our blog platform.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">All Categories</h1>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
            Discover content across our diverse categories. Find topics that match your interests and explore new perspectives.
        </p>
    </div>
</section>

<!-- Categories Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}"
               class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                @if($category->image)
                <div class="h-48 bg-gray-200">
                    <img src="{{ asset('uploads/' . $category->image) }}"
                         alt="{{ $category->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                @else
                <div class="h-48 flex items-center justify-center" style="background: {{ $category->color ?? 'linear-gradient(to bottom right, #a78bfa, #60a5fa)' }};">
                    <i class="{{ $category->icon ?? 'fas fa-folder' }} text-white text-6xl"></i>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors">
                            {{ $category->name }}
                        </h3>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $category->posts_count }} posts
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $category->description }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
                        <span>Explore category</span>
                        @if($category->is_featured)
                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-folder text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Categories Found</h3>
                <p class="text-gray-600">Categories will appear here once they are created.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
        <div class="mt-12">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Sidebar Advertisement -->
@if(isset($sidebarAd) && $sidebarAd)
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="ad-sidebar rounded-xl p-8 text-center">
            <a href="{{ $sidebarAd->link }}" target="_blank"
               onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')"
               class="block hover:opacity-90 transition-opacity">
                @if($sidebarAd->image)
                <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="mx-auto mb-4 max-h-32">
                @endif
                <h3 class="text-2xl font-bold mb-3">{{ $sidebarAd->title }}</h3>
                <p class="text-lg mb-4">{{ $sidebarAd->description }}</p>
                <span class="inline-block bg-white/20 px-6 py-3 rounded-lg font-semibold">
                    Learn More →
                </span>
            </a>
        </div>
    </div>
</section>
@endif

@push('styles')
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection
