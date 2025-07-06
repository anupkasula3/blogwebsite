<div class="space-y-8 sticky top-24">
  <div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-2 flex items-center gap-2"><i class="fas fa-envelope text-blue-500"></i>Subscribe to Our Newsletter</h3>
    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
      @csrf
      <input type="email" name="email" placeholder="Your email" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Subscribe</button>
    </form>
  </div>
  <div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-2 flex items-center gap-2"><i class="fas fa-bolt text-yellow-500"></i>Trending Posts</h3>
    <ul class="space-y-3">
      @foreach($popularPosts ?? [] as $post)
        <li>
          <a href="{{ route('post.show', $post->slug) }}" class="flex items-center gap-2 hover:text-blue-600">
            <span class="truncate">{{ $post->title }}</span>
            <span class="ml-auto text-xs text-gray-400">{{ $post->views_count }} views</span>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
  <div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-2 flex items-center gap-2"><i class="fas fa-share-alt text-green-500"></i>Stay Connected</h3>
    <div class="flex space-x-4">
      <a href="#" class="text-blue-600"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-blue-400"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-pink-600"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-blue-700"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </div>
  @if(isset($sidebarAd) && $sidebarAd)
  <div class="ad-sidebar rounded-xl p-6 text-center">
    <a href="{{ $sidebarAd->link }}" target="_blank" onclick="trackAdClick({{ $sidebarAd->id }}, 'sidebar')">
      @if($sidebarAd->image)
        <img src="{{ asset('uploads/' . $sidebarAd->image) }}" alt="{{ $sidebarAd->title }}" class="mx-auto mb-4 max-h-32">
      @endif
      <h3 class="text-lg font-bold mb-2">{{ $sidebarAd->title }}</h3>
      <p>{{ $sidebarAd->description }}</p>
    </a>
  </div>
  @endif
</div>
