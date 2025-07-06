<div class="py-8">
  <div class="flex items-center mb-6 gap-2">
    <i class="fas fa-fire text-red-500 text-xl"></i>
    <h2 class="text-2xl font-bold">Must Read</h2>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($mustRead ?? [] as $post)
      <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-5 flex flex-col group">
        <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : asset('images/default.jpg') }}" class="w-full h-44 object-cover rounded mb-3 group-hover:scale-105 transition-transform">
        <div class="flex items-center mb-2">
          <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}" class="w-8 h-8 rounded-full mr-2">
          <span class="text-sm text-gray-700">{{ $post->author_name }}</span>
          <span class="ml-auto text-xs text-gray-500">{{ $post->published_at->diffForHumans() }}</span>
        </div>
        <h3 class="font-semibold text-lg mb-1 line-clamp-2"><a href="{{ route('post.show', $post->slug) }}" class="hover:text-blue-600">{{ $post->title }}</a></h3>
        <p class="text-sm text-gray-500 line-clamp-2 mb-2">{{ $post->excerpt }}</p>
        <a href="{{ route('post.show', $post->slug) }}" class="text-blue-600 hover:underline mt-auto">Read More &rarr;</a>
      </div>
    @endforeach
  </div>
</div>
