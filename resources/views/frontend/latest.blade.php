@extends('frontend.layout.main')

@section('title', 'Latest Posts - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Read the latest articles and blog posts from our community of writers.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#ff2953] to-[#c51f42] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Latest Posts</h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Stay up to date with the freshest content from our community of writers and thinkers.
            </p>
        </div>
    </section>

    <!-- Posts Grid -->
    <section class="py-6 bg-white">
        <div class="max-w-screen-2xl mx-auto px-4 ">
            @if ($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                    @foreach ($posts as $post)
                        @include('frontend.component.postcomponent')
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($posts->hasPages())
                    <div class="mt-12">
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
