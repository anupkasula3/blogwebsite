@extends('frontend.layout.main')

@section('title', 'Categories - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('meta_description', 'Explore all categories and find content that interests you on our blog platform.')

@section('content')
    <!-- Minimal Hero Section -->


    <section class="bg-gradient-to-r from-[#ff2953] to-[#c51f42] text-white py-12">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="text-sm font-semibold tracking-wide text-white uppercase mb-2">Browse</div>

            <h1 class="text-4xl md:text-5xl font-bold mb-6">Explore Categories</h1>
            <p class="text-xl text-white leading-relaxed">
                Discover topics that match your interests and
                explore new perspectives.
            </p>
        </div>

    </section>

    <!-- Categories Grid with Improved Cards -->
    <section id="categories-grid" class="py-16 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb + Toolbar -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-700 font-medium">Categories</li>
                    </ol>
                </nav>
                <form action="{{ url()->current() }}" method="GET" class="w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <div class="relative w-full md:w-72">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Search categories..."
                                class="w-full pl-10 pr-3 py-2.5 rounded-xl border border-gray-300 bg-white text-sm outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-[var(--primary)] transition-colors" />
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i
                                    class="fas fa-search"></i></span>
                        </div>
                        <select name="sort"
                            class="px-3 py-2.5 rounded-xl border border-gray-300 bg-white text-sm outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-[var(--primary)] transition-colors">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                            <option value="posts" {{ request('sort') == 'posts' ? 'selected' : '' }}>Most Posts</option>
                        </select>
                        <button
                            class="px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:brightness-110 btn-professional"
                            type="submit">Apply</button>
                        <a href="{{ route('contact') }}"
                            class="hidden md:inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300">
                            <i class="fas fa-envelope text-xs"></i>
                            Contact
                        </a>
                    </div>
                </form>
            </div>
            <!-- Section header with count -->
            @php
                $catTotal =
                    is_object($categories) && method_exists($categories, 'total')
                        ? $categories->total()
                        : (is_countable($categories)
                            ? count($categories)
                            : 0);
            @endphp
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900">All Categories</h2>
                <span class="text-sm text-gray-500">{{ $catTotal }} found</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">

                @forelse($categories as $category)
                    <div
                        class=" bg-white rounded-xl overflow-hidden transition-all duration-300 border border-gray-200 hover:border-primary/50 hover:shadow-sm">
                        <div>
                            @if ($category->image)
                                <div class="aspect-[16/9] bg-gray-100 overflow-hidden">
                                    <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                                </div>
                            @else
                                <div class="aspect-[16/9] flex items-center justify-center bg-gray-50">
                                    <div class="flex items-center gap-3 text-gray-400">
                                        <i class="{{ $category->icon ?? 'fas fa-folder' }} text-primary text-2xl"></i>
                                        <span class="text-sm">No Image</span>
                                    </div>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors">
                                        {{ $category->name }}
                                    </h3>
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-semibold flex items-center border border-primary/20 bg-primary/5 text-primary">
                                        <i class="fas fa-file-alt mr-1"></i> {{ $category->posts_count }}
                                    </span>
                                </div>
                                <p class="text-gray-600 line-clamp-3">{{ $category->description }}</p>
                                <div class="border-t  border-gray-100 mt-5 pt-5 flex items-center justify-between ">
                                    <a href="{{ route('category.show', $category->slug) }}"
                                        class="inline-flex group hover:text-white items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold border border-primary text-primary hover:bg-primary  transition-all duration-300">
                                        <i class="fas fa-folder-open text-xs group-hover:text-white"></i>
                                        <span class="group-hover:text-white">View Posts</span>
                                    </a>
                                    @if ($category->is_featured)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-star mr-1"></i> Featured
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-200">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Categories Found</h3>
                        <p class="text-gray-600 max-w-md mx-auto mb-6">Categories will appear here once they are
                            created.
                        </p>
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:brightness-110 transition duration-300">
                            <i class="fas fa-home mr-2"></i> Return to Home
                        </a>
                    </div>
                @endforelse

            </div>

            <!-- Pagination with Improved Styling -->
            @if ($categories->hasPages())
                <div class="mt-12">
                    <div class="pagination-wrapper bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                        {{ $categories->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Sidebar Advertisement with Improved Design -->
    @if (isset($sidebarAd) && $sidebarAd)
        <section class="py-12 bg-gray-50">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="ad-sidebar rounded-2xl p-8 text-center overflow-hidden relative shadow-lg">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute inset-0 bg-grid-white/[0.2] bg-[length:20px_20px]"></div>
                    </div>
                    <a href="{{ $sidebarAd->link }}" target="_blank"
                        onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')"
                        class="block hover:opacity-95 transition-opacity relative z-10">
                        @if ($sidebarAd->image)
                            <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}"
                                class="mx-auto mb-6 max-h-40 rounded-lg shadow-md">
                        @endif
                        <h3 class="text-2xl font-bold mb-3 text-white">{{ $sidebarAd->title }}</h3>
                        <p class="text-lg mb-6 text-white/90">{{ $sidebarAd->description }}</p>
                        <span
                            class="inline-block bg-white/20 backdrop-blur-sm px-6 py-3 rounded-lg font-semibold text-white hover:bg-white/30 transition duration-300">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Marketing block removed for a focused, professional categories page -->

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
                background-color: var(--primary);
                color: #ffffff;
                border: 1px solid var(--primary);
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
