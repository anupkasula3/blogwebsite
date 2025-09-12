<div>
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Tech Reviews</h2>
    <a href="#" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
      <span>View all</span>
      <i class="fa-solid fa-arrow-right text-sm"></i>
    </a>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($techReviews ?? [] as $post)
      @if(empty($post))
        @continue
      @endif
      @php
        $title = data_get($post, 'title');
        $slug = data_get($post, 'slug');
        $featured = data_get($post, 'featured_image');
        $excerpt = data_get($post, 'excerpt');
        $imageUrl = $featured ? Storage::url($featured) : asset('images/default.jpg');
        $postUrl = $slug ? route('post.show', $slug) : '#';
      @endphp
      <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition p-4 flex flex-col">
        <img src="{{ $imageUrl }}" class="w-full aspect-[16/9] object-cover rounded-lg mb-3 transition-transform duration-300 group-hover:scale-[1.02]" alt="{{ $title ?? 'Post image' }}">
        <h3 class="font-semibold text-lg mb-1 line-clamp-2 text-gray-900">
          <a href="{{ $postUrl }}" class="hover:text-blue-600 transition-colors">{{ $title ?? 'Untitled' }}</a>
        </h3>
        <p class="text-sm text-gray-600 line-clamp-2">{{ $excerpt ?? '' }}</p>
      </div>
    @endforeach
  </div>
</div>
