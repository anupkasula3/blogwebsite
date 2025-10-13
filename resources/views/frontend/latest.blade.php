@extends('frontend.layout.main')

@section('title', 'Latest Posts - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('meta_description', 'Read the latest articles and blog posts from our community of writers.')

@section('content')
    <!-- Hero Section -->
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
            Latest News
          </li>
        </ol>
      </nav>

      <!-- Title -->
      <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-[#ff2953] mb-2 leading-[1.1]">
        Latest News
      </h1>

      <p class="text-xl text-gray-600 leading-relaxed">
        Stay updated with the latest happenings around the world. From business updates to global events, we bring you timely news to keep you informed and ahead.
      </p>
    </div>
  </div>
</section>



    <!-- Posts Grid -->
    <section class="py-6 ">
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
