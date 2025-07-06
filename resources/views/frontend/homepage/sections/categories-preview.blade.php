<div class="py-12">
  <div class="mb-8 text-center">
    <h2 class="text-3xl font-bold">Explore Categories</h2>
    <p class="text-gray-600">Browse the latest posts from each category</p>
  </div>
  <div class="space-y-12">
    @foreach($categoriesWithPosts as $category)
      <div>
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-2xl font-semibold flex items-center gap-2">
            {{ $category->name }}
            @if($category->is_featured)
              <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">
                <i class="fas fa-star mr-1"></i> Featured
              </span>
            @endif
          </h3>
          <a href="{{ route('category.show', $category->slug) }}" class="text-blue-600 hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($category->posts as $post)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
              <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : asset('images/default.jpg') }}" class="w-full h-32 object-cover rounded mb-2">
              <h4 class="font-semibold text-lg mb-1 line-clamp-2"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h4>
              <p class="text-sm text-gray-500 line-clamp-2">{{ $post->excerpt }}</p>
            </div>
          @empty
            <div class="col-span-full text-gray-400 italic">No posts yet in this category.</div>
          @endforelse
        </div>
      </div>
    @endforeach
  </div>
</div>
