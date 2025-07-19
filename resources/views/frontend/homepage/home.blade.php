@php
    $quotes = [
        'Success is not final, failure is not fatal: It is the courage to continue that counts. – Winston Churchill',
        'The only way to do great work is to love what you do. – Steve Jobs',
        'Believe you can and you’re halfway there. – Theodore Roosevelt',
        'Opportunities don’t happen, you create them. – Chris Grosser',
        'Don’t watch the clock; do what it does. Keep going. – Sam Levenson',
        'The future depends on what you do today. – Mahatma Gandhi',
        'Dream big and dare to fail. – Norman Vaughan',
        'Start where you are. Use what you have. Do what you can. – Arthur Ashe',
        'Your limitation—it’s only your imagination.',
        'Push yourself, because no one else is going to do it for you.',
        'Great things never come from comfort zones.',
        'Success doesn’t just find you. You have to go out and get it.',
        'The harder you work for something, the greater you’ll feel when you achieve it.',
        'Don’t stop when you’re tired. Stop when you’re done.',
        'Wake up with determination. Go to bed with satisfaction.',
        'Do something today that your future self will thank you for.',
        'Little things make big days.',
        'It’s going to be hard, but hard does not mean impossible.',
        'Don’t wait for opportunity. Create it.',
        'Sometimes we’re tested not to show our weaknesses, but to discover our strengths.',
        'The key to success is to focus on goals, not obstacles.',
        'Dream it. Wish it. Do it.',
        'Stay positive. Work hard. Make it happen.',
        'Doubt kills more dreams than failure ever will. – Suzy Kassem',
        'Act as if what you do makes a difference. It does. – William James',
        'Quality is not an act, it is a habit. – Aristotle',
        'With the new day comes new strength and new thoughts. – Eleanor Roosevelt',
        'The only limit to our realization of tomorrow will be our doubts of today. – Franklin D. Roosevelt',
        'It always seems impossible until it’s done. – Nelson Mandela',
        'You are never too old to set another goal or to dream a new dream. – C.S. Lewis',
        'If you can dream it, you can do it. – Walt Disney',
        'Keep your face always toward the sunshine—and shadows will fall behind you. – Walt Whitman',
        'What you get by achieving your goals is not as important as what you become by achieving your goals. – Zig Ziglar',
        'Perseverance is not a long race; it is many short races one after the other. – Walter Elliot',
        'The best way to get started is to quit talking and begin doing. – Walt Disney',
        'Don’t let yesterday take up too much of today. – Will Rogers',
        'You don’t have to be great to start, but you have to start to be great. – Zig Ziglar',
        'The only place where success comes before work is in the dictionary. – Vidal Sassoon',
        'Hardships often prepare ordinary people for an extraordinary destiny. – C.S. Lewis',
        'Success is walking from failure to failure with no loss of enthusiasm. – Winston Churchill',
        'The secret of getting ahead is getting started. – Mark Twain',
        'It does not matter how slowly you go as long as you do not stop. – Confucius',
        'Everything you’ve ever wanted is on the other side of fear. – George Addair',
        'Opportunities are usually disguised as hard work, so most people don’t recognize them. – Ann Landers',
        'Don’t be pushed around by the fears in your mind. Be led by the dreams in your heart. – Roy T. Bennett',
        'If you want to achieve greatness stop asking for permission. – Anonymous',
        'Go the extra mile. It’s never crowded there. – Dr. Wayne D. Dyer',
        'You are braver than you believe, stronger than you seem, and smarter than you think. – A.A. Milne',
        'Difficult roads often lead to beautiful destinations.',
        'Believe in yourself and all that you are. Know that there is something inside you that is greater than any obstacle. – Christian D. Larson',
        'The only way to achieve the impossible is to believe it is possible. – Charles Kingsleigh',
        'Success is not how high you have climbed, but how you make a positive difference to the world. – Roy T. Bennett',
        'You miss 100% of the shots you don’t take. – Wayne Gretzky',
        'The journey of a thousand miles begins with one step. – Lao Tzu',
        'Don’t limit your challenges. Challenge your limits.',
        'Doubt whom you will, but never yourself. – Christian Nestell Bovee',
        'You are capable of amazing things.',
        'The best view comes after the hardest climb.',
        'If you’re going through hell, keep going. – Winston Churchill',
        'The difference between ordinary and extraordinary is that little extra.',
        'You don’t have to see the whole staircase, just take the first step. – Martin Luther King Jr.',
        'Strive not to be a success, but rather to be of value. – Albert Einstein',
        'Don’t be afraid to give up the good to go for the great. – John D. Rockefeller',
        'The harder the battle, the sweeter the victory.',
        'Success is the sum of small efforts, repeated day in and day out. – Robert Collier',
        'You can if you think you can. – George Reeves',
        'The only person you are destined to become is the person you decide to be. – Ralph Waldo Emerson',
        'Don’t count the days, make the days count. – Muhammad Ali',
        'If you want to lift yourself up, lift up someone else. – Booker T. Washington',
        'The mind is everything. What you think you become. – Buddha',
        'The best revenge is massive success. – Frank Sinatra',
        'Difficulties in life are intended to make us better, not bitter. – Dan Reeves',
        'You are the artist of your own life. Don’t hand the paintbrush to anyone else.',
        'If you want something you’ve never had, you must be willing to do something you’ve never done.',
        'Don’t quit. Suffer now and live the rest of your life as a champion. – Muhammad Ali',
        'The only thing standing between you and your goal is the story you keep telling yourself as to why you can’t achieve it. – Jordan Belfort',
        'You don’t need to see the whole path. Just take the first step.',
        'Success is not for the chosen few, but for the few who choose it.',
        'You are stronger than you think.',
        'The pain you feel today will be the strength you feel tomorrow.',
        'Don’t be afraid to start over. It’s a chance to build something better this time.',
        'If you believe it will work out, you’ll see opportunities. If you believe it won’t, you will see obstacles. – Wayne Dyer',
        'The only limits in our life are those we impose on ourselves. – Bob Proctor',
        'You can’t cross the sea merely by standing and staring at the water. – Rabindranath Tagore',
        'Success is not measured by money or power, but by the positive difference you make in people’s lives.',
        'The best preparation for tomorrow is doing your best today. – H. Jackson Brown Jr.',
        'Don’t let what you cannot do interfere with what you can do. – John Wooden',
        'You are your only limit.',
        'The struggle you’re in today is developing the strength you need for tomorrow.',
        'Don’t be discouraged. It’s often the last key in the bunch that opens the lock.',
        'You have within you right now, everything you need to deal with whatever the world can throw at you. – Brian Tracy',
        'The only way to do great work is to love what you do. – Steve Jobs',
        'Push yourself, because no one else is going to do it for you.'
    ];
    $randomQuote = $quotes[array_rand($quotes)];
    do {
        $randomQuote2 = $quotes[array_rand($quotes)];
    } while ($randomQuote2 === $randomQuote && count($quotes) > 1);
@endphp
@extends('frontend.layout.main')

@section('title', \App\Models\Setting::get('site_name', 'MyBlogSite') . ' - ' .
    \App\Models\Setting::get('site_description', 'Your Ultimate Blog Destination'))
@section('meta_description',
    'Discover amazing stories, insights, and knowledge on our blog platform. Read the latest
    articles from top categories.')

@section('content')
    <div class="max-w-screen-2xl mx-auto px-2 sm:px-4 lg:px-8 py-6">

        <style>
            .gradient-text {
                background-image: linear-gradient(90deg, #2563eb, #7c3aed);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .article-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            }

            .article-gradient {
                background-image: linear-gradient(to bottom, rgba(248, 250, 252, 0), rgba(30, 41, 59, 1));
            }
        </style>





        <div class="bg-light">

            <!-- Hero Section -->
            <section class="relative">
                <div class="absolute inset-0 bg-black/30"></div>
                <img src="https://placehold.co/1920x1080"
                    alt="Aerial view of a modern workspace with laptop, notebooks, and coffee cup on a wooden desk"
                    class="w-full h-96 object-cover">
                <div class="px-4 absolute inset-0 flex items-center">
                    <div class="max-w-2xl">
                        <span class=" text-primary px-3 py-1 rounded-full text-sm font-semibold mb-2 inline-block">Featured
                            Post</span>
                        <h2 class="text-4xl font-bold text-white mb-4">The Ultimate Guide to Professional Blogging Success
                        </h2>
                        <p class="text-white mb-6">Learn how to create compelling content that engages your audience and
                            grows your brand. Discover proven strategies used by industry leaders.</p>
                        <div class="flex gap-4">
                            <button class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition">Read
                                Article</button>
                            <button
                                class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg hover: hover:text-dark transition flex items-center gap-2">
                                <i class="fas fa-bookmark"></i> Save for later
                            </button>
                        </div>
                    </div>
                </div>
            </section>



            <!-- Latest Articles -->
            <section class="py-5 ">
                <div class="">
                    <div class="flex justify-between items-center mb-12">
                        <h2 class="text-3xl font-bold text-dark">Latest Posts</h2>
                        <a href="{{ route('all-posts') }}" class="text-primary font-medium flex items-center gap-2 hover:underline">
                            View all Posts
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="md:flex">
                        <!-- Articles Section (75%) -->
                        <div class="md:w-3/4 w-full pr-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-2">
                                @foreach ($latestPosts as $key => $post)
                                    @include('frontend.component.postcomponent')
                                    {{-- @include('frontend.component.postcomponent') --}}
                                @endforeach
                            </div>
                        </div>

                        <!-- Sidebar Section (25%) -->
                        <div class="md:w-1/4">
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                {{-- <h3 class="text-lg font-bold mb-4">Ads Section</h3> --}}
                                <img class="object-contain" alt=""
                                    src="https://cdn.easyfrontend.com/pictures/discount1-bg.png" />
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md mt-4">
                                <h3 class="text-lg font-bold mb-4 text-indigo-700 flex items-center gap-2"><i class="fas fa-quote-left text-indigo-400"></i>Inspiration</h3>
                                <blockquote class="italic text-gray-700 text-base leading-relaxed border-l-4 border-indigo-400 pl-4">{{ $randomQuote }}</blockquote>
                            </div>
                            <div class="bg-gray-100 mt-4 p-4 rounded-lg shadow-md">
                                {{-- <h3 class="text-lg font-bold mb-4">Ads Section</h3> --}}
                                <img class="object-contain" alt=""
                                    src="https://cdn.easyfrontend.com/pictures/discount1-bg.png" />
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg shadow-md mt-4">
                                <h3 class="text-lg font-bold mb-4 text-indigo-700 flex items-center gap-2"><i class="fas fa-quote-left text-indigo-400"></i>Inspiration</h3>
                                <blockquote class="italic text-gray-700 text-base leading-relaxed border-l-4 border-indigo-400 pl-4">{{ $randomQuote2 }}</blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="py-4 ">
                <div class="">
                    <h2 class="font-manrope text-4xl font-bold text-gray-900 text-center mb-6">Our popular blogs</h2>
                    <div
                        class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-center mb-14 gap-y-2  gap-x-2">
                        @foreach ($latestPosts as $key => $post)
                            <div
                                class="group cursor-pointer  border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                                <div class="flex items-center mb-6">
                                    <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="rounded-lg h-48 w-full object-contain">
                                </div>
                                <div class="block">
                                    <h4 class="text-gray-900 font-medium leading-1 mb-9">{{ $post->title }}</h4>

                                    <div class="flex items-center justify-between  font-medium">
                                        <h6 class="text-sm text-gray-500">{{ $post->author_name }}</h6>
                                        <span class="text-sm text-indigo-600">
                                            {{ $post->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{-- <a href="javascript:;"
                        class="cursor-pointer border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">View
                        All</a> --}}
                </div>
            </section>




            <section class="  text-black relative overflow-hidden ">
                <div class="">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full lg:w-1/2">
                            <div class="flex flex-col items-center justify-end bg-no-repeat bg-cover bg-center min-h-[400px] rounded-2xl"
                                style=" background-image: url(https://cdn.easyfrontend.com/pictures/discount1-bg.png);">
                                <h1 class="text-3xl md:text-[40px] font-bold leading-tight text-pink-600">
                                    Accesssories
                                </h1>
                                <p class="text-2xl md:text-3xl leading-none font-medium mt-2 mb-6">
                                    Up to 60% off
                                </p>
                                <button class="py-3.5 px-9 leading-none  text-pink-600 rounded-lg font-bold mb-12">
                                    Shop Now
                                </button>
                            </div>
                        </div>

                        <div class="w-full lg:w-1/2">
                            <div class="flex flex-col justify-end bg-no-repeat bg-cover bg-center min-h-[400px] rounded-2xl p-6 md:p-12"
                                style=" background-image: url(https://cdn.easyfrontend.com/pictures/discount2-bg.png); ">
                                <div class="w-full lg:w-1/2 text-center">
                                    <div class="text-yellow-500  rounded-lg p-6">
                                        <h2 class="text-3xl font-bold">
                                            Spring into <br />
                                            Action
                                        </h2>
                                    </div>
                                    <button
                                        class="py-3.5 px-9 leading-none bg-pink-600 text-white rounded-lg font-bold mt-6">
                                        Shop Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="py-8 sm:py-12 md:py-16 lg:py-20 xl:py-24 text-zinc-900 relative overflow-hidden">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Featured Articles</h2>
                        <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto">Discover our most engaging and informative content curated just for you</p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- LEFT: Featured Posts (Mobile: Full width, Desktop: 2/3) -->
                        <div class="w-full lg:w-2/3 xl:w-3/5 space-y-4">
                            @foreach ($featuredPosts as $key => $post2)
                                <!-- Article Card -->
                                <article class="group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                                    <div class="flex flex-col sm:flex-row">
                                        <!-- Image Container -->
                                        <div class="relative shrink-0 w-full sm:w-2/5 lg:w-1/3 xl:w-2/5">
                                            <div class="aspect-video sm:aspect-square lg:aspect-video">
                                                <img src="{{ asset('uploads/' . $post2->featured_image) }}"
                                                     alt="{{ $post2->title }}"
                                                     class="w-full h-[100%] object-cover group-hover:scale-105 transition-transform duration-300" />
                                            </div>
                                            <!-- Category Badge -->
                                            <span class="absolute top-3 right-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-lg">
                                                {{ $post2->category->name }}
                                            </span>
                                        </div>

                                        <!-- Content Container -->
                                        <div class="flex-1 p-4 sm:p-6 lg:p-8">
                                            <div class="flex flex-col h-full justify-between">
                                                <div>
                                                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-3 line-clamp-2">
                                                        {{ $post2->title }}
                                                    </h3>
                                                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed line-clamp-3 mb-4">
                                                        {{ Str::limit(strip_tags($post2->content), 200) }}
                                                    </p>
                                                </div>

                                                <!-- Meta Information -->
                                                <div class="flex items-center justify-between text-sm text-gray-500">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user text-xs"></i>
                                                        </div>
                                                        <span>{{ $post2->author_name }}</span>
                                                    </div>
                                                    <span class="flex items-center gap-1">
                                                        <i class="fas fa-clock text-xs"></i>
                                                        {{ $post2->published_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                                                <!-- RIGHT: Sidebar (Mobile: Full width, Desktop: 1/3) -->
                        <div class="w-full lg:w-1/3 xl:w-2/5 space-y-4">
                            <!-- Advertisement Cards -->
                            <div class="flex w-full gap-4">
                                <div class="w-1/2 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-4 sm:p-6 border border-blue-200">
                                    <img src="{{ asset('images/adddds.jpg') }}"
                                         alt="Advertisement"
                                         class="w-full h-32 sm:h-40 object-cover rounded-lg mb-3" />
                                    <div class="text-center">
                                        <h4 class="font-semibold text-gray-900 mb-2">Special Offer</h4>
                                        <p class="text-sm text-gray-600">Discover amazing deals</p>
                                    </div>
                                </div>

                                <div class="w-1/2 bg-gradient-to-br from-purple-50 to-pink-100 rounded-xl p-4 sm:p-6 border border-purple-200">
                                    <img src="{{ asset('images/adddds.jpg') }}"
                                         alt="Advertisement"
                                         class="w-full h-32 sm:h-40 object-cover rounded-lg mb-3" />
                                    <div class="text-center">
                                        <h4 class="font-semibold text-gray-900 mb-2">Premium Content</h4>
                                        <p class="text-sm text-gray-600">Exclusive articles</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Newsletter Signup -->
                            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl p-6 sm:p-8 text-white">
                                <div class="text-center">
                                    <i class="fas fa-envelope text-3xl mb-4"></i>
                                    <h4 class="text-lg sm:text-xl font-bold mb-2">Stay Updated</h4>
                                    <p class="text-orange-100 text-sm sm:text-base mb-4">Get the latest articles delivered to your inbox</p>
                                    <div class="flex flex-col gap-2">
                                        <input type="email"
                                               placeholder="Enter your email"
                                               class="w-full px-4 py-2 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                                        <button class="w-full bg-white text-orange-500 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Popular Tags -->
                            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                                <img src="{{ asset('images/adddds.jpg') }}"
                                alt="Advertisement"
                                class="w-full h-32 sm:h-52 object-cover rounded-lg" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>









            <!-- Popular Categories -->
            <section class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-dark mb-12 text-center">Popular Categories</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-primary group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-code text-2xl text-primary group-hover:text-primary"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Technology</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">56 Articles</p>
                        </a>

                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-yellow-500 group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-chart-line text-2xl text-yellow-500 group-hover:text-yellow-500"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Business</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">42 Articles</p>
                        </a>

                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-green-500 group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-heartbeat text-2xl text-green-500 group-hover:text-green-500"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Health</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">38 Articles</p>
                        </a>

                        <a href="#"
                            class=" p-6 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:bg-purple-500 group transition">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover: mb-4">
                                <i class="fas fa-lightbulb text-2xl text-purple-500 group-hover:text-purple-500"></i>
                            </div>
                            <h3 class="font-bold text-dark group-hover:text-white">Productivity</h3>
                            <p class="text-sm text-gray-500 group-hover:text-white/80">34 Articles</p>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Attractive Read More Section -->
            <section class="py-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-blue-100 relative overflow-hidden">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-10">
                        <h2 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 mb-4">Discover More Stories</h2>
                        <p class="text-lg text-gray-700 max-w-2xl mx-auto">Dive into a world of inspiring articles, trending topics, and expert insights. Find your next favorite read and stay ahead with our handpicked recommendations!</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
                        @foreach(\App\Models\Post::published()->inRandomOrder()->take(4)->get() as $post)
                            @include('frontend.component.postcomponent')
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <a href="{{ route('all-posts') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-lg font-semibold rounded-full shadow-lg hover:from-purple-600 hover:to-indigo-600 transition-all duration-200">
                            Explore All Posts
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Banner Advertisement Section -->
            <section class="py-8">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 rounded-3xl shadow-xl flex flex-col md:flex-row items-center gap-6 p-6 md:p-10 border border-blue-200 relative overflow-hidden">
                        <div class="flex-shrink-0 w-full md:w-1/3 flex justify-center">
                            <img src="{{ asset('images/adddds.jpg') }}" alt="Special Offer Banner" class="h-32 md:h-40 w-auto object-contain rounded-2xl shadow-lg">
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-2xl md:text-3xl font-extrabold text-blue-900 mb-2">Unlock Exclusive Content!</h3>
                            <p class="text-gray-700 mb-4">Subscribe now and get access to premium articles, expert insights, and special offers. Don’t miss out on the latest trends and stories!</p>
                            <a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-base font-semibold rounded-full shadow hover:from-purple-600 hover:to-indigo-600 transition-all duration-200">
                                Get Started
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

        </div>





    </div>



@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
