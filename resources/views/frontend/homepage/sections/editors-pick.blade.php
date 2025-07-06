<div>
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Editor's Pick</h2>
    <a href="#" class="text-blue-600 hover:underline">View All</a>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($editorsPick as $post)
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
        <img src="{{ Storage::url($post->featured_image) }}" class="w-full h-32 object-cover rounded mb-2">
        <h3 class="font-semibold text-lg mb-1 line-clamp-2"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
        <p class="text-sm text-gray-500 line-clamp-2">{{ $post->excerpt }}</p>
      </div>
    @endforeach
  </div>
</div>
