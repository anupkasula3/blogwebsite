@extends('frontend.layout.main')

@section('title', 'About Us - MyBlogSite')
@section('meta_description', 'Learn more about MyBlogSite, your ultimate destination for amazing stories, insights, and knowledge.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-20">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">About MyBlogSite</h1>
        <p class="text-xl text-gray-300 leading-relaxed">
            Your ultimate destination for inspiring content, expert insights, and captivating stories that will expand your horizons.
        </p>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-pen-fancy text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality Content</h3>
                    <p class="text-gray-600">
                        Carefully curated articles from expert writers and industry professionals.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community</h3>
                    <p class="text-gray-600">
                        A vibrant community of readers and writers sharing knowledge and experiences.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-mobile-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Responsive Design</h3>
                    <p class="text-gray-600">
                        Optimized for all devices, ensuring a great reading experience anywhere.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center mb-4">
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
                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
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
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
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
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
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
                   class="inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Us
                </a>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition-colors">
                    <i class="fas fa-home mr-2"></i>
                    Explore Our Blog
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
