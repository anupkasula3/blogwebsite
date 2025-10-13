{{--
 <section class="relative ">
    <div class="absolute inset-0 "></div>
    <img src="{{ asset('uploads/' . $banners->image) }}" alt="{{ $banners->title }}"
        class="w-full h-auto sm:h-80 md:h-[28rem] lg:h-[32rem] object-cover">

</section> --}}



@php
    $featuredMain = $featuredPosts->first();
    $smallPosts = $featuredPosts->slice(1, 2);
@endphp


<div class="max-w-screen-2xl mx-auto px-4 my-4 grid md:grid-cols-3 gap-3">


    <!-- Featured large post -->
    @if($featuredMain)
    <a href="{{ route('post.show', $featuredMain->slug) }}" class="relative md:col-span-2 aspect-video overflow-hidden group">
        <img src="{{ asset('uploads/' . $featuredMain->featured_image) }}"
             alt="{{ $featuredMain->title }}"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="absolute bottom-6 left-6 text-white">
            <span class="bg-blue-600 text-[11px] uppercase tracking-wide px-2 py-1 rounded-md">
                {{ $featuredMain->category->name ?? 'Uncategorized' }}
            </span>
            <h2 class="text-3xl md:text-4xl font-bold leading-tight mt-3 max-w-xl">
                {{ $featuredMain->title }}
            </h2>
            <p class="text-sm text-gray-200 mt-2">
                {{ $featuredMain->user->name ?? $featuredMain->admin->name ?? 'Unknown' }} —
                {{ $featuredMain->published_at->format('M d') }}
            </p>
        </div>
    </a>
    @endif

    <!-- Right column - two posts dynamically -->
    <div class="flex flex-col gap-3 h-full">
        @foreach($smallPosts as $post)
        <a href="{{ route('post.show', $post->slug) }}" class="relative flex-1 aspect-video overflow-hidden group">
            <img src="{{ asset('uploads/' . $post->featured_image) }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-4 left-4 text-white">
                <span class="bg-purple-600 text-[11px] uppercase tracking-wide px-2 py-1 rounded-md">
                    {{ $post->category->name ?? 'Uncategorized' }}
                </span>
                <h3 class="text-lg font-semibold leading-snug mt-2 max-w-xs">
                    {{ $post->title }}
                </h3>
            </div>
        </a>
        @endforeach
    </div>
</div>






