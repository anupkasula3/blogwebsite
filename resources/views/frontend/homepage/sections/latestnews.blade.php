  <section class="py-8 sm:py-10 md:py-12 bg-white">
                <div class="max-w-screen-2xl mx-auto px-4 ">
                    <!-- Section Header with News Portal Style -->
                    <div class="border-b-2 border-primary mb-8">
                        <div class="flex justify-between items-center gap-3 pb-2">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center text-xl gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary font-semibold text-sm">
                                    <i class="fas fa-newspaper"></i>
                                    Latest News
                                </span>

                            </div>
                            <a href="{{ route('latest') }}"
                                class="inline-flex items-center gap-2 bg-primary text-white px-4 sm:px-5 py-2 rounded-md hover:bg-primary/90 transition-colors text-sm font-semibold">
                                <span>View All</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>



                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                        <!-- Main News Content (3/4) -->
                        <div class="lg:col-span-3">


                            <div class="mb-5">

                                <script src="https://adnebyte.nepbyte.com/ads/embed/dc780e7a-2551-4c5a-8268-1c69982382ec.js?count=1"></script>
                            </div>

                            <!-- Featured Story -->
                            @if ($latestPosts->isNotEmpty())
                                @foreach ($latestPosts->take(2) as $key => $latestPost)
                                    <div class="mb-3">
                                        <a href="{{ route('post.show', $latestPost->url_slug ?? $latestPost->slug) }}"
                                            class="block group">
                                            <div
                                                class="relative bg-white rounded-lg shadow-lg overflow-hidden news-card transition-all duration-300">
                                                <div class="md:flex">
                                                    <div class="md:w-1/3">
                                                        <img src="{{ asset('uploads/' . $latestPost->featured_image) }}"
                                                            alt="{{ $latestPost->title }}"
                                                            class="w-full h-full object-cover">
                                                        <!-- reduced height -->
                                                        <div class="absolute top-4 left-4">
                                                            <span
                                                                class="category-badge text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                                                {{ $latestPost->category->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="md:w-2/3 p-6">
                                                        <div class="flex items-center gap-2 mb-3">
                                                            <span
                                                                class="bg-primary text-white px-2 py-1 text-xs font-bold rounded">BREAKING</span>
                                                            <span
                                                                class="text-xs text-gray-500">{{ $latestPost->published_at->diffForHumans() }}</span>
                                                        </div>
                                                        <h3
                                                            class="text-2xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-primary transition-colors">
                                                            {{ $latestPost->title }}
                                                        </h3>
                                                        <p class="text-gray-600 mb-4 leading-relaxed">
                                                            {{ Str::limit(strip_tags($latestPost->content), 150) }}
                                                        </p>
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-2">
                                                                <div
                                                                    class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                                                    <i class="fas fa-user text-xs text-gray-600"></i>
                                                                </div>
                                                                <span
                                                                    class="text-sm font-medium text-gray-700">{{ $latestPost->author_name }}</span>
                                                            </div>
                                                            <span
                                                                class="text-primary font-semibold text-sm group-hover:underline">Read
                                                                More →</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            <!-- News Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ($latestPosts->skip(2)->take(6) as $key => $post)
                                    @include('frontend.component.postcomponent')


                                    <!-- Inline Ad after every 3rd article -->
                                    @if (($key + 2) % 3 == 0)
                                        <div class="lg:col-span-3 md:col-span-2">
                                            <div class="text-center">

                                                <div class="mt-2">

                                                    <script src="https://adnebyte.nepbyte.com/ads/embed/34be3c90-b979-48a9-ac96-3debea832472.js?count=1"></script>

                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Sidebar (1/4) -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Trending News -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200">
                                <div class="bg-primary text-white p-4 rounded-t-lg">
                                    <h3 class="font-bold uppercase tracking-wide flex items-center gap-2">
                                        <i class="fas fa-fire"></i>
                                        Trending Now
                                    </h3>
                                </div>
                                <div class="p-4 space-y-4">
                                    @foreach ($popularPosts->take(5) as $index => $trendingPost)
                                        <div class="flex items-start gap-3 pb-3 border-b border-gray-100 last:border-b-0">
                                            <span c
                                                lass="bg-primary text-white text-xs font-bold px-2 py-1 rounded">{{ $index + 1 }}</span>
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-sm text-gray-900 leading-tight mb-1">
                                                    <a href="{{ route('post.show', $trendingPost->slug) }}"
                                                        class="hover:text-primary transition-colors">
                                                        {{ Str::limit($trendingPost->title, 60) }}
                                                    </a>
                                                </h5>
                                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                                    <span>{{ $trendingPost->published_at->format('M j') }}</span>
                                                    <span>•</span>
                                                    <span>{{ $trendingPost->views_count ?? 0 }} views</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sidebar Ad -->
                            <div class="">

                                <a href="https://aryanmiyamansoor.com.np/" target="_blank" rel="noopener noreferrer">
                                    <div class="mt-2">
                                        <img src="{{ asset('images/aryan.gif') }}" alt="Ads Nepbyte"
                                            class="w-full h-60 sm:h-60 md:h-60 object-cover rounded">
                                    </div>
                                </a>

                            </div>

                            <!-- Calender -->
                            <!-- Newsletter Signup -->
                            <div class="bg-primary  rounded-lg p-6 text-white">
                                <div class="text-center">
                                    <i class="fas fa-newspaper text-3xl mb-3"></i>
                                    <h4 class="font-bold text-lg mb-2">Daily Newsletter</h4>
                                    <p class="text-red-100 text-sm mb-4">Get breaking news delivered to your inbox</p>
                                    <div class="space-y-2">
                                        <input type="email" placeholder="Your email address"
                                            class="w-full border border-white px-3 py-2 rounded text-white text-sm">
                                        <button
                                            class="w-full bg-white text-primary py-2 rounded font-semibold text-sm hover:bg-gray-100 transition-colors">
                                            Subscribe Now
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <!-- Quote of the Day -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                    <i class="fas fa-quote-left text-blue-500"></i>
                                    Quote of the Day
                                </h4>
                                <blockquote
                                    class="italic text-gray-700 text-sm leading-relaxed border-l-4 border-blue-500 pl-3">
                                    "{{ $randomQuote }}"
                                </blockquote>
                            </div>
                            <!-- Sidebar Ad -->
                            <div class="">

                                <a href="https://nepbyte.com/contact" target="_blank" rel="noopener noreferrer">
                                    <div class="mt-2">
                                        <img src="{{ asset('images/ads.gif') }}" alt="TIhar"
                                            class="w-full h-60 sm:h-60 md:h-60 object-cover rounded">
                                    </div>
                                </a>

                            </div>
                            <!-- Quote of the Day -->
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                    <i class="fas fa-quote-left text-blue-500"></i>
                                    Quote of the Day
                                </h4>
                                <blockquote
                                    class="italic text-gray-700 text-sm leading-relaxed border-l-4 border-blue-500 pl-3">
                                    "{{ $randomQuote2 }}"
                                </blockquote>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
