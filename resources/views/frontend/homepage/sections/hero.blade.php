@php $hero = $featuredPosts->first(); @endphp
@if ($hero)
    <div class="relative rounded-2xl overflow-hidden shadow-lg mb-8">
        <img src="{{ Storage::url($hero->featured_image) }}" alt="{{ $hero->title }}"
            class="w-full h-[28rem] object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-10 text-white max-w-2xl">
            <span
                class="inline-block bg-blue-600 px-3 py-1 rounded-full text-xs font-semibold mb-4">{{ $hero->category->name }}</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg">{{ $hero->title }}</h1>
            <p class="text-lg text-gray-200 mb-6 line-clamp-3">{{ $hero->excerpt }}</p>
            <a href="{{ route('post.show', $hero->slug) }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-lg font-semibold text-lg shadow-lg transition">Read
                More</a>
        </div>
    </div>
@endif
