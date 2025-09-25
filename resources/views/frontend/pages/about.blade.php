@extends('frontend.layout.main')

@section('title', 'About Us - MyBlogSite')
@section('meta_description', 'Learn more about MyBlogSite, your ultimate destination for amazing stories, insights, and
    knowledge.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#ff2953] to-[#b81c3b] text-white py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">About MyBlogSite</h1>
            <p class="text-xl text-gray-300 leading-relaxed">
                Your ultimate destination for inspiring content, expert insights, and captivating stories that will expand
                your horizons.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Story</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    MyBlogSite was born from a simple idea: to create a platform where knowledge meets inspiration.
                    We believe that everyone has a story worth sharing, and every reader deserves access to quality content
                    that educates, entertains, and empowers.
                </p>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    Founded in 2024, our platform has grown into a vibrant community of writers, readers, and thinkers.
                    We curate content across multiple categories, ensuring that there's something for everyone - from
                    technology enthusiasts to lifestyle seekers, from business professionals to creative minds.
                </p>

                <h2 class="text-3xl font-bold text-gray-900 mb-8 mt-12">Our Mission</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Our mission is to provide a platform that:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-8 space-y-2">
                    <li>Connects readers with high-quality, engaging content</li>
                    <li>Empowers writers to share their knowledge and experiences</li>
                    <li>Fosters a community of learning and growth</li>
                    <li>Delivers value through diverse perspectives and insights</li>
                </ul>

                <h2 class="text-3xl font-bold text-gray-900 mb-8 mt-12">What We Offer</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-[#ff2953]/90 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-pen-fancy text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality Content</h3>
                        <p class="text-gray-600">
                            Carefully curated articles from expert writers and industry professionals.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-[#ff2953]/90 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Community</h3>
                        <p class="text-gray-600">
                            A vibrant community of readers and writers sharing knowledge and experiences.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-[#ff2953]/90 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-mobile-alt text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Responsive Design</h3>
                        <p class="text-gray-600">
                            Optimized for all devices, ensuring a great reading experience anywhere.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-[#ff2953]/90 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-search text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Discovery</h3>
                        <p class="text-gray-600">
                            Advanced search and categorization to help you find exactly what you need.
                        </p>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-8 mt-12">Our Values</h2>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-8 h-8 bg-[#ff2953]/90 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-heart text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Passion for Quality</h3>
                            <p class="text-gray-600">
                                We're passionate about delivering the highest quality content to our readers.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-8 h-8 bg-[#ff2953]/90 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-handshake text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Integrity</h3>
                            <p class="text-gray-600">
                                We maintain the highest standards of integrity in everything we publish.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-8 h-8 bg-[#ff2953]/90 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-lightbulb text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Innovation</h3>
                            <p class="text-gray-600">
                                We continuously innovate to provide the best possible user experience.
                            </p>
                        </div>
                    </div>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-8 mt-12">Get in Touch</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    We'd love to hear from you! Whether you have a question, suggestion, or just want to say hello,
                    we're here to help. Reach out to us through our contact page or connect with us on social media.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mt-8">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center bg-gradient-to-r from-[#ff2953] to-[#b81c3b] text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Us
                    </a>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center justify-center border-2 border-[#ff2953] text-[#ff2953] px-8 py-3 rounded-lg font-semibold hover:bg-[#ff2953] hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Explore Our Blog
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl border border-gray-100 p-6 text-center shadow-sm">
                    <div class="text-3xl font-extrabold text-gray-900">1M+</div>
                    <div class="mt-1 text-sm text-gray-500">Monthly Readers</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 p-6 text-center shadow-sm">
                    <div class="text-3xl font-extrabold text-gray-900">5k+</div>
                    <div class="mt-1 text-sm text-gray-500">Published Articles</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 p-6 text-center shadow-sm">
                    <div class="text-3xl font-extrabold text-gray-900">800+</div>
                    <div class="mt-1 text-sm text-gray-500">Contributing Writers</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 p-6 text-center shadow-sm">
                    <div class="text-3xl font-extrabold text-gray-900">100+</div>
                    <div class="mt-1 text-sm text-gray-500">Countries Reached</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Journey</h2>
            <div class="relative border-s-2 border-gray-100 ps-6 space-y-10">
                <div class="relative">
                    <span class="absolute -start-3 top-1 w-6 h-6 rounded-full bg-[#ff2953]"></span>
                    <h3 class="text-xl font-semibold text-gray-900">2024 — Launch</h3>
                    <p class="text-gray-600 mt-1">We launched MyBlogSite with a mission to blend knowledge and inspiration.
                    </p>
                </div>
                <div class="relative">
                    <span class="absolute -start-3 top-1 w-6 h-6 rounded-full bg-[#ff2953]"></span>
                    <h3 class="text-xl font-semibold text-gray-900">2024 Q3 — Community</h3>
                    <p class="text-gray-600 mt-1">Reached our first 100 contributing writers and 100k monthly readers.</p>
                </div>
                <div class="relative">
                    <span class="absolute -start-3 top-1 w-6 h-6 rounded-full bg-[#ff2953]"></span>
                    <h3 class="text-xl font-semibold text-gray-900">2025 — Growth</h3>
                    <p class="text-gray-600 mt-1">Expanded categories, improved UX, and refined editorial standards.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Meet the Team</h2>
                <a href="#" class="text-[#ff2953] font-semibold hover:underline">Join us →</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([['name' => 'Alex Kim', 'role' => 'Editor-in-Chief'], ['name' => 'Priya Sharma', 'role' => 'Product Designer'], ['name' => 'Liam O\'Brien', 'role' => 'Lead Engineer'], ['name' => 'Sara Chen', 'role' => 'Community Manager']] as $member)
                    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm text-center">
                        <div
                            class="mx-auto w-20 h-20 rounded-full bg-[rgba(255,41,83,0.1)] flex items-center justify-center mb-3">
                            <span
                                class="text-[#ff2953] font-extrabold text-xl">{{ Str::substr($member['name'], 0, 1) }}</span>
                        </div>
                        <div class="font-semibold text-gray-900">{{ $member['name'] }}</div>
                        <div class="text-sm text-gray-500">{{ $member['role'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">What Readers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ([['text' => 'MyBlogSite has transformed the way I learn and stay inspired.', 'author' => 'Aarav, Entrepreneur'], ['text' => 'Top-notch articles with real insights. Highly recommended!', 'author' => 'Maya, Marketer'], ['text' => 'Clean design, great UX, and valuable content.', 'author' => 'Daniel, Developer']] as $t)
                    <div class="rounded-xl border border-gray-100 p-6 shadow-sm">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-quote-left text-[#ff2953] mt-1"></i>
                            <p class="text-gray-700">{{ $t['text'] }}</p>
                        </div>
                        <div class="mt-4 text-sm font-semibold text-gray-900">{{ $t['author'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Frequently Asked Questions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ([['q' => 'Is MyBlogSite free to read?', 'a' => 'Yes, the majority of our content is free. We may offer optional premium features in the future.'], ['q' => 'How can I become a contributor?', 'a' => 'Visit our contact page to pitch topics. Our editorial team will get back to you.'], ['q' => 'Do you accept sponsored content?', 'a' => 'We work with select partners who share our values. Get in touch for guidelines.'], ['q' => 'How do you ensure content quality?', 'a' => 'We follow strict editorial standards and fact-check critical information.']] as $item)
                    <details class="group bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                        <summary class="flex items-center justify-between cursor-pointer list-none">
                            <span class="font-semibold text-gray-900">{{ $item['q'] }}</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform group-open:rotate-180"></i>
                        </summary>
                        <p class="mt-3 text-gray-600">{{ $item['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('structured-data')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About MyBlogSite",
  "description": "Learn about MyBlogSite — our mission, values, team, and journey.",
  "publisher": {
    "@type": "Organization",
    "name": "MyBlogSite",
    "url": "{{ url('/') }}"
  }
}
</script>
@endsection
