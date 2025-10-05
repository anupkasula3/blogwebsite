<div class="py-10">
  <!-- Section header -->
  <div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
      <span class="inline-flex items-center justify-center h-9 w-9 rounded-lg bg-red-500/10 text-red-600">
        <i class="fas fa-fire"></i>
      </span>
      <div>
        <h2 class="text-2xl font-bold text-gray-900">Must Read</h2>
        <p class="text-sm text-gray-500">Handpicked posts you shouldn't miss</p>
      </div>
    </div>
    <a href="{{ route('all-posts') }}" class="hidden md:inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300">
      <i class="fas fa-newspaper text-xs"></i>
      View All
    </a>
  </div>

  <!-- Cards grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach(($mustRead ?? []) as $post)
      <div class="group bg-white rounded-xl overflow-hidden transition-all duration-300 border border-gray-200 hover:border-primary/40 hover:shadow-sm">
        <a href="{{ route('post.show', $post->slug) }}" class="block">
          <div class="aspect-[16/9] bg-gray-100 overflow-hidden">
            <img src="{{ $post->featured_image ? asset('uploads/' . $post->featured_image) : asset('images/default.jpg') }}" alt="{{ $post->title ?? 'Post image' }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
          </div>
        </a>
        <div class="p-5">
          <div class="flex items-center gap-3 mb-3">
            <img src="{{ optional($post->user)->avatar_url ?? asset('images/default-avatar.png') }}" class="w-8 h-8 rounded-full" alt="{{ $post->author_name ?? optional($post->user)->name ?? 'Author' }}">
            <div class="text-sm text-gray-600">{{ $post->author_name ?? optional($post->user)->name ?? 'Unknown' }}</div>
            <span class="ml-auto text-xs text-gray-400">{{ optional($post->published_at)->diffForHumans() }}</span>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
            <a href="{{ route('post.show', $post->slug) }}" class="group-hover:text-primary transition-colors">{{ $post->title ?? 'Untitled' }}</a>
          </h3>
          <p class="text-sm text-gray-600 line-clamp-3 mb-4">{{ $post->excerpt ?? '' }}</p>
          <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <a href="{{ route('post.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline">
              Read More <i class="fas fa-arrow-right text-xs"></i>
            </a>
            @if(optional($post->category)->slug)
              <a href="{{ route('category.show', optional($post->category)->slug) }}" class="text-xs px-2.5 py-1 rounded-full border border-primary/20 bg-primary/5 text-primary">
                <i class="fas fa-folder-open mr-1"></i>{{ optional($post->category)->name }}
              </a>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
