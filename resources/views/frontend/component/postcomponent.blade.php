<a href="{{ route('post.show', $post->url_slug ?? $post->slug) }}"
    class="block group bg-white rounded-lg shadow-md overflow-hidden news-card transition-all duration-300 border border-gray-200 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary/30">
    <article>
        <!-- Ranking Badge -->
        <div class="relative">
            <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">



            <!-- Category Badge -->
            <div class="absolute top-3 right-3">
                <span class="bg-[#ff2953] text-white px-2 py-1 text-xs font-semibold rounded">
                    {{ $post->category->name }}
                </span>
            </div>

            <!-- Views Badge -->
            {{-- <div
                class="absolute bottom-3 right-3 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-xs flex items-center gap-1">
                <i class="fas fa-eye"></i>
                <span>{{ number_format($post->views_count ?? 0) }}</span>
            </div> --}}
        </div>

        <div class="p-4">
            <!-- Publication Info -->
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xs text-[#ff2953] font-semibold">{{ $post->published_at->format('M j, Y') }}</span>
                <span class="text-xs text-gray-400">•</span>
                <span class="text-xs text-gray-500">{{ $post->published_at->diffForHumans() }}</span>
            </div>

            <!-- Title -->
            <h4 class="font-bold text-gray-900 mb-3 leading-tight group-hover:text-[#ff2953] transition-colors">
                {{ Str::limit($post->title, 70) }}
            </h4>

            <!-- Excerpt -->
            <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                {{ Str::limit(strip_tags($post->excerpt), 80) }}
            </p>

            <!-- Author and Stats -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-xs text-gray-600"></i>
                    </div>
                    <span class="text-xs text-gray-500">{{ Str::limit($post->author_name, 15) }}</span>
                </div>

                <!-- Reading Time -->
                <div class="flex items-center gap-1 text-xs text-gray-400">
                    <i class="fas fa-clock"></i>
                    <span>{{ $post->reading_time ?? 5 }}m read</span>
                </div>
            </div>


        </div>
    </article>
</a>
