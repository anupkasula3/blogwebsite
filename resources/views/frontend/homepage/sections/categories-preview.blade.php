<div class=" max-w-screen-2xl mx-auto px-4 pb-4 bg-white border-gray-100 ">
    <div class="space-y-4">
        @foreach ($categoriesWithPosts as $category)
            @if ($category->latest_posts->count() > 0)
                <div>
                    <!-- Category Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-2">
                        <h2 class="text-2xl font-bold text-gray-800 mt-5">{{ $category->name }} <span
                                class="text-primary">Updates</span></h2>
                        <a href="{{ route('category.show', $category->slug) }}"
                            class="group inline-flex items-center gap-2 text-sm font-medium  hover:text-white bg-white hover:bg-primary border border-primary/20 hover:border-primary px-4 py-2.5 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md ring-1 ring-transparent hover:ring-primary/30">
                            <span>View All {{ $category->name }}</span>
                            <i
                                class="fas fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>

                    <!-- Category Description -->
                    @if (!empty($category->description))
                        <p class="text-gray-600 leading-relaxed ">
                            {{ $category->description }}
                        </p>
                    @endif

                    <!-- Posts Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 mt-8">
                        @forelse($category->latest_posts as $post)
                            <a href="{{ route('post.show', $post->slug) }}"
                                class="group block bg-white p-5 rounded-lg border border-gray-200 shadow-sm ring-1 ring-transparent hover:ring-primary/20 hover:border-primary/40 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="relative flex-shrink-0 w-24 h-16 overflow-hidden rounded-lg border border-gray-100 shadow-sm">
                                        <img src="{{ $post->featured_image ? asset('uploads/' . $post->featured_image) : asset('images/default.jpg') }}"
                                            alt="{{ $post->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4
                                            class="text-sm font-semibold text-gray-800 leading-snug line-clamp-2 group-hover:text-primary transition-colors">
                                            {{ $post->title }}
                                        </h4>
                                        <div class="mt-2 text-xs text-gray-500 flex items-center gap-2">
                                            <i class="far fa-clock text-gray-400"></i>
                                            <span
                                                class="text-gray-500">{{ optional($post->published_at)->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div
                                class="col-span-full py-10 text-center border border-gray-100 rounded-lg bg-gray-50/50">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-gray-400 mb-3 border border-gray-100 shadow-sm">
                                    <i class="fas fa-newspaper text-2xl"></i>
                                </div>
                                <p class="text-gray-500">No posts yet in this category.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
