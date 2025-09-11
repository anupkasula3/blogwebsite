@extends('frontend.layout.main')

@section('title', 'Categories - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Explore all categories and find content that interests you on our blog platform.')

@section('content')
<!-- Hero Section with Animation -->
<section class="relative overflow-hidden bg-gradient-to-r from-purple-900 via-indigo-800 to-blue-900 text-white py-20">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute left-0 top-0 w-full h-full opacity-10">
            <div class="absolute inset-0 bg-grid-white/[0.2] bg-[length:20px_20px] [mask-image:radial-gradient(white,transparent_70%)]">
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 animate-fade-in-up">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-purple-200">Explore Categories</span>
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-8 animate-fade-in-up animation-delay-200">
            Discover content across our diverse categories. Find topics that match your interests and explore new perspectives.
        </p>
        <div class="flex justify-center space-x-4 animate-fade-in-up animation-delay-300">
            <a href="#categories-grid" class="px-6 py-3 bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-lg font-medium transition duration-300 flex items-center">
                <i class="fas fa-th-large mr-2"></i> Browse All
            </a>
            <a href="{{ route('home') }}" class="px-6 py-3 bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-lg font-medium transition duration-300 flex items-center">
                <i class="fas fa-home mr-2"></i> Back to Home
            </a>
        </div>
    </div>
</section>

<!-- Categories Grid with Improved Cards -->
<section id="categories-grid" class="py-16 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}"
               class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                @if($category->image)
                <div class="h-52 bg-gray-200 overflow-hidden">
                    <img src="{{ asset('uploads/' . $category->image) }}"
                         alt="{{ $category->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="h-52 flex items-center justify-center relative overflow-hidden"
                     style="background: {{ $category->color ?? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' }};">
                    <div class="absolute inset-0 opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                        <div class="absolute inset-0 bg-grid-white/[0.2] bg-[length:30px_30px]"></div>
                    </div>
                    <i class="{{ $category->icon ?? 'fas fa-folder' }} text-white text-6xl relative z-10 transform group-hover:scale-110 transition-transform duration-300"></i>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors">
                            {{ $category->name }}
                        </h3>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium flex items-center">
                            <i class="fas fa-file-alt mr-1"></i> {{ $category->posts_count }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $category->description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-purple-600 font-medium">
                            <span>Explore category</span>
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                        @if($category->is_featured)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Categories Found</h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">Categories will appear here once they are created.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-300">
                    <i class="fas fa-home mr-2"></i> Return to Home
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination with Improved Styling -->
        @if($categories->hasPages())
        <div class="mt-12">
            <div class="pagination-wrapper bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                {{ $categories->links() }}
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Sidebar Advertisement with Improved Design -->
@if(isset($sidebarAd) && $sidebarAd)
<section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="ad-sidebar rounded-2xl p-8 text-center overflow-hidden relative shadow-lg">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute inset-0 bg-grid-white/[0.2] bg-[length:20px_20px]"></div>
            </div>
            <a href="{{ $sidebarAd->link }}" target="_blank"
               onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')"
               class="block hover:opacity-95 transition-opacity relative z-10">
                @if($sidebarAd->image)
                <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="mx-auto mb-6 max-h-40 rounded-lg shadow-md">
                @endif
                <h3 class="text-2xl font-bold mb-3 text-white">{{ $sidebarAd->title }}</h3>
                <p class="text-lg mb-6 text-white/90">{{ $sidebarAd->description }}</p>
                <span class="inline-block bg-white/20 backdrop-blur-sm px-6 py-3 rounded-lg font-semibold text-white hover:bg-white/30 transition duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </span>
            </a>
        </div>
    </div>
</section>
@endif

<!-- NEW: Digital Marketing Tools Advertisement Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Digital Marketing Tools</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Boost your online presence with these powerful digital marketing solutions</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tool Card 1 -->
            <div class="bg-gradient-to-br from-blue-500 to-cyan-400 rounded-2xl overflow-hidden shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="p-8 text-white text-center relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="bg-white/20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-chart-line text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">SEO Analytics</h3>
                        <p class="mb-6 opacity-90">Powerful tools to analyze and improve your website's search engine rankings</p>
                        <a href="#" class="inline-block bg-white/20 backdrop-blur-sm px-6 py-3 rounded-lg font-semibold hover:bg-white/30 transition duration-300">
                            Explore Tools <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tool Card 2 -->
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl overflow-hidden shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="p-8 text-white text-center relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="bg-white/20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-bullhorn text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Social Media Suite</h3>
                        <p class="mb-6 opacity-90">Manage all your social media accounts from one powerful dashboard</p>
                        <a href="#" class="inline-block bg-white/20 backdrop-blur-sm px-6 py-3 rounded-lg font-semibold hover:bg-white/30 transition duration-300">
                            Try Now <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tool Card 3 -->
            <div class="bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl overflow-hidden shadow-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="p-8 text-white text-center relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <div class="bg-white/20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-envelope-open-text text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Email Marketing</h3>
                        <p class="mb-6 opacity-90">Create stunning email campaigns that convert and drive engagement</p>
                        <a href="#" class="inline-block bg-white/20 backdrop-blur-sm px-6 py-3 rounded-lg font-semibold hover:bg-white/30 transition duration-300">
                            Get Started <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="#" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition duration-300 shadow-md">
                <i class="fas fa-tools mr-2"></i> View All Marketing Tools
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-300 {
    animation-delay: 0.3s;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-grid-white {
    background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 0V20M0 1H20' stroke='white' stroke-opacity='0.1' stroke-width='1'/%3E%3C/svg%3E%0A");
}

/* Improve pagination styling */
.pagination-wrapper nav {
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    display: flex;
    list-style-type: none;
    gap: 0.5rem;
}

.pagination-wrapper .pagination li .page-link,
.pagination-wrapper .pagination li.page-item span {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 2.5rem;
    min-width: 2.5rem;
    padding: 0 0.75rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.2s;
}

.pagination-wrapper .pagination li .page-link {
    background-color: white;
    color: #4B5563;
    border: 1px solid #E5E7EB;
}

.pagination-wrapper .pagination li .page-link:hover {
    background-color: #F3F4F6;
    color: #1F2937;
}

.pagination-wrapper .pagination li.active span {
    background-color: #8B5CF6;
    color: white;
    border: 1px solid #8B5CF6;
}

.pagination-wrapper .pagination li.disabled span {
    background-color: #F3F4F6;
    color: #9CA3AF;
    border: 1px solid #E5E7EB;
    cursor: not-allowed;
}
</style>
@endpush
@endsection
