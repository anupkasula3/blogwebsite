<div class="max-w-screen-2xl mx-auto px-4 pb-8 bg-white">
    <div class="space-y-12">
        @foreach ($categoriesWithPosts as $category)
            @if ($category->latest_posts->count() > 0)
                <div>
                    <!-- Category Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                                <i class="fas fa-bolt text-primary"></i>
                                {{ $category->name }}
                                <span class="text-primary">Updates</span>
                            </h2>
                            @if (!empty($category->description))
                                <p class="text-gray-600 mt-2 text-sm leading-relaxed max-w-2xl">
                                    {{ $category->description }}
                                </p>
                            @endif
                        </div>
                        <a href="{{ route('category.show', $category->slug) }}"
                           class="group inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-white bg-white hover:bg-primary border-2 border-primary px-6 py-3 rounded-lg transition-all duration-300 shadow-sm hover:shadow-lg whitespace-nowrap">
                            <span>View All</span>
                            <i class="fas fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    <!-- Posts Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($category->latest_posts as $post)
                            <a href="{{ route('post.show', $post->slug) }}"
                               class="group block bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                                <!-- Image Container -->
                                <div class="relative w-full h-48 overflow-hidden bg-gray-100">
                                    <img src="{{ $post->featured_image ? asset('uploads/' . $post->featured_image) : asset('images/default.jpg') }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <!-- Category Badge -->
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary text-white text-xs font-semibold rounded-full shadow-lg">
                                            <i class="fas fa-tag"></i>
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content Container -->
                                <div class="p-5">
                                    <!-- Title -->
                                    <h4 class="text-lg font-bold text-gray-900 leading-tight line-clamp-2 mb-3 group-hover:text-primary transition-colors duration-300 min-h-[3.5rem]">
                                        {{ $post->title }}
                                    </h4>

                                    <!-- Excerpt -->
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                                        {{ \Illuminate\Support\Str::words(strip_tags($post->excerpt), 20, '...') }}
                                    </p>

                                    <!-- Footer Meta -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <i class="far fa-calendar-alt text-primary"></i>
                                            <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-primary text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span>Read More</span>
                                            <i class="fas fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full py-16 text-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white text-gray-400 mb-4 shadow-sm">
                                    <i class="fas fa-newspaper text-3xl"></i>
                                </div>
                                <p class="text-gray-600 font-medium text-lg">No posts available yet</p>
                                <p class="text-gray-500 text-sm mt-1">Check back later for updates in this category</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
