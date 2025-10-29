<div class="max-w-screen-2xl mx-auto px-4 pb-8 bg-white">
    <div class="space-y-12">
        @foreach ($categoriesWithPosts as $category)
            @if ($category->latest_posts->count() > 0)
                <div>
                    <!-- Category Header -->
                    <div class=" mb-6 ">
                        <div class="flex items-center justify-between">

                            <div>
                                <h2 class="text-3xl max-sm:text-xl font-bold text-gray-900 flex items-center gap-3">
                                    <i class="fas fa-bolt text-primary"></i>
                                    {{ $category->name }}
                                    {{-- <span class="text-primary">Updates</span> --}}
                                </h2>
                            </div>

                            <div class="text-white bg-primary rounded px-2 py-2 my-2">
                                <a href="{{ route('category.show', $category->slug) }}" target="_blank"
                                    class="flex items-center gap-3">
                                    <!-- Text -->
                                    <div class=" ">View All</div>

                                    <div class="">
                                        <!-- Arrow -->
                                        <svg width="20" height="20" viewBox="0 0 66 43"
                                            xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                            <g stroke="none" fill="none" fill-rule="evenodd">
                                                <!-- Make sure these paths are copied exactly from your original code -->
                                                <path class="one"
                                                    d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 Z"
                                                    fill="#FFFFFF"></path>
                                                <path class="two"
                                                    d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 Z"
                                                    fill="#FFFFFF"></path>
                                                <path class="three"
                                                    d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 Z"
                                                    fill="#FFFFFF"></path>
                                            </g>
                                        </svg>
                                    </div>

                                </a>
                            </div>

                            <style>
                                /* Animate arrow colors */
                                path.one {
                                    animation: color_anim 1s infinite 0.6s;
                                }

                                path.two {
                                    animation: color_anim 1s infinite 0.4s;
                                }

                                path.three {
                                    animation: color_anim 1s infinite 0.2s;
                                }

                                @keyframes color_anim {
                                    0% {
                                        fill: white;
                                    }

                                    50% {
                                        fill: #ff2953;
                                    }

                                    100% {
                                        fill: white;
                                    }
                                }

                                /* Slide arrow on hover */
                                a:hover .arrow-icon {
                                    transform: translateX(5px);
                                    transition: transform 0.3s;
                                }
                            </style>
                        </div>
                        @if (!empty($category->description))
                            <p class="text-gray-600 mt-2 text-sm leading-relaxed max-w-2xl">
                                {{ $category->description }}
                            </p>
                        @endif
                    </div>


                    {{-- <a href="{{ route('category.show', $category->slug) }}"
                            class="group inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-white bg-white hover:bg-primary border-2 border-primary px-6 py-3 rounded-lg transition-all duration-300 shadow-sm hover:shadow-lg whitespace-nowrap">
                            <span>View All</span>
                            <i
                                class="fas fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                        </a> --}}


                    <!-- Posts Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                        @forelse($category->latest_posts as $post)
                            <a href="{{ route('post.show', $post->slug) }}"
                                class="group block bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                                <!-- Image Container -->
                                <div class="relative w-full h-48 overflow-hidden bg-gray-100">
                                    <img src="{{ $post->featured_image ? asset('uploads/' . $post->featured_image) : asset('images/default.jpg') }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                    <!-- Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <!-- Category Badge -->
                                    <div class="absolute top-3 left-3">
                                        @if ($post->category_id !== $category->id)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary text-white text-xs font-semibold rounded-full shadow-lg">
                                                <i class="fas fa-tag"></i>
                                                {{ $category->name }} : {{ $post->category->name }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary text-white text-xs font-semibold rounded-full shadow-lg">
                                                <i class="fas fa-tag"></i>
                                                {{ $category->name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Container -->
                                <div class="p-5">
                                    <!-- Title -->
                                    <h4
                                        class="text-lg font-bold text-gray-900 leading-tight line-clamp-2  group-hover:text-primary transition-colors duration-300 mb-2">
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

                                    </div>
                                </div>
                            </a>
                        @empty
                            <div
                                class="col-span-full py-16 text-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white text-gray-400 mb-4 shadow-sm">
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
