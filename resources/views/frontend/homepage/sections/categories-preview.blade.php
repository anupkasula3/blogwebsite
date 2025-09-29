<div class="py-12 max-w-screen-2xl mx-auto">
  <div class="space-y-20">
    @foreach($categoriesWithPosts as $category)
      <div>
        <!-- Category Header -->
        <div class="flex items-center justify-between mb-3">
          <a href="{{ route('category.show', $category->slug) }}" 
             class="inline-block bg-primary text-white font-semibold text-sm px-4 py-2 rounded">
            Explore {{ $category->name }} Updates
          </a>
          <a href="{{ route('category.show', $category->slug) }}" 
             class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-white border border-primary px-3 py-1.5 rounded-md hover:bg-primary transition-colors">
            <span>View all</span>
            <i class="fas fa-arrow-right text-xs"></i>
          </a>
        </div>

        <!-- Category Description -->
        @if(!empty($category->description))
          <p class="text-sm text-gray-600 leading-relaxed mt-2">
            {{ Str::limit(strip_tags($category->description), 220) }}
          </p>
        @endif

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-10">
          @forelse($category->latest_posts as $post)
            <a href="{{ route('post.show', $post->slug) }}" 
               class="group block bg-white p-2 rounded-lg border border-gray-100 hover:shadow transition">
              <div class="flex items-start gap-3">
                <img src="{{ $post->featured_image ? asset('uploads/' . $post->featured_image) : asset('images/default.jpg') }}" 
                     alt="{{ $post->title }}" 
                     class="w-24 h-16 sm:w-28 sm:h-18 rounded object-cover">
                <div class="flex-1">
                  <h4 class="text-sm font-semibold leading-snug line-clamp-2 group-hover:text-primary">
                    {{ $post->title }}
                  </h4>
                  <div class="mt-2 text-[12px] text-gray-500 flex items-center gap-2">
                    <i class="far fa-clock"></i>
                    <span>{{ optional($post->published_at)->format('F j, Y') }}</span>
                  </div>
                </div>
              </div>
            </a>
          @empty
            <div class="col-span-full text-gray-400 italic">
              No posts yet in this category.
            </div>
          @endforelse
        </div>
      </div>
    @endforeach
  </div>
</div>
