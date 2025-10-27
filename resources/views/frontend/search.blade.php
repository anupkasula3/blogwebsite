@extends('frontend.layout.main')
@section('content')
    <!-- Hero Section (Match Categories Banner) -->
    <section class="bg-gradient-to-r from-[#ff2953] to-[#c51f42] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Search Results</h1>
            <p class="text-xl text-white leading-relaxed max-w-3xl mx-auto">
                Showing results for "<span class="font-semibold text-white">{{ $query }}</span>"
            </p>

            <!-- Search Form -->
            <div class="mt-8 max-w-2xl mx-auto">
                <div class="bg-white/95 backdrop-blur rounded-xl border border-white/20 shadow-2xl">
                    <form action="{{ route('search') }}" method="GET" class="p-2 sm:p-3 flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <span
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="q" value="{{ $query }}"
                                placeholder="Search articles..."
                                class="w-full h-12 pl-11 pr-4 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#ff2953]/40 focus:border-[#ff2953] transition" />
                        </div>
                        <button type="submit"
                            class="h-12 px-6 rounded-lg bg-[#ff2953] text-white font-semibold shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#ff2953]/40 active:scale-[0.99] transition">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($posts->count() > 0)
                <div class="mb-8">
                    <p class="text-lg text-gray-600">
                        Found <span class="font-semibold text-[#ff2953]">{{ $posts->total() }}</span> result(s) for "<span
                            class="font-semibold">{{ $query }}</span>"
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                    @foreach ($posts as $post)
                        @include('frontend.component.postcomponent')
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->appends(['q' => $query])->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Results Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any posts matching "<span class="font-semibold">{{ $query }}</span>"
                    </p>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">Try these suggestions:</p>
                        <ul class="text-sm text-gray-500 space-y-2">
                            <li>• Check your spelling</li>
                            <li>• Try different keywords</li>
                            <li>• Use more general terms</li>
                            <li>• Browse our <a href="{{ route('categories.index') }}"
                                    class="text-[#ff2953] hover:text-[#ff2953]/80">categories</a></li>
                        </ul>
                    </div>
                </div>
            @endif
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

            mark {
                padding: 0 2px;
                border-radius: 2px;
            }
        </style>
    @endpush
@endsection
