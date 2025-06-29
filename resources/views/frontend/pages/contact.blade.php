@extends('frontend.layout.main')

@section('title', 'Contact Us - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Get in touch with us. We\'d love to hear from you! Contact us for any questions, suggestions, or collaborations.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-900 to-blue-900 text-white py-20">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Get in Touch</h1>
        <p class="text-xl text-gray-300 leading-relaxed">
            We'd love to hear from you! Whether you have a question, suggestion, or just want to say hello, we're here to help.
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Send us a Message</h2>

                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   placeholder="Your full name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   placeholder="your.email@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <select id="subject" name="subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="support">Technical Support</option>
                            <option value="partnership">Partnership</option>
                            <option value="advertising">Advertising</option>
                            <option value="feedback">Feedback</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                  placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                            Subscribe to our newsletter for updates and insights
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-4 px-6 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Contact Information</h2>

                <div class="space-y-8">
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                            <p class="text-gray-600 mb-2">{{ \App\Models\Setting::get('contact_email', 'contact@myblogsite.com') }}</p>
                            <p class="text-sm text-gray-500">We typically respond within 24 hours</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Phone</h3>
                            <p class="text-gray-600 mb-2">{{ \App\Models\Setting::get('contact_phone', '+1 (555) 123-4567') }}</p>
                            <p class="text-sm text-gray-500">{{ \App\Models\Setting::get('contact_working_hours', 'Monday - Friday: 9:00 AM - 6:00 PM') }}</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Address</h3>
                            <p class="text-gray-600">{{ \App\Models\Setting::get('contact_address', '123 Blog Street, Content City') }}</p>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-share-alt text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                @if(\App\Models\Setting::get('facebook_url'))
                                <a href="{{ \App\Models\Setting::get('facebook_url') }}" target="_blank"
                                   class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('twitter_url'))
                                <a href="{{ \App\Models\Setting::get('twitter_url') }}" target="_blank"
                                   class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('instagram_url'))
                                <a href="{{ \App\Models\Setting::get('instagram_url') }}" target="_blank"
                                   class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('linkedin_url'))
                                <a href="{{ \App\Models\Setting::get('linkedin_url') }}" target="_blank"
                                   class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('youtube_url'))
                                <a href="{{ \App\Models\Setting::get('youtube_url') }}" target="_blank"
                                   class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="mt-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Frequently Asked Questions</h3>
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">How can I contribute to the blog?</h4>
                            <p class="text-gray-600 text-sm">You can register for an account and submit your articles. All submissions are reviewed by our editorial team before publication.</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">How long does it take to get a response?</h4>
                            <p class="text-gray-600 text-sm">We typically respond to all inquiries within 24 hours during business days.</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Can I advertise on your platform?</h4>
                            <p class="text-gray-600 text-sm">Yes! We offer various advertising opportunities. Please contact us for more information about our advertising packages.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Find Us</h2>
            <p class="text-xl text-gray-600">Visit our office or connect with us online</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="h-96 bg-gray-200 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-6xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Interactive map would be embedded here</p>
                    <p class="text-sm text-gray-500 mt-2">{{ \App\Models\Setting::get('contact_address', '123 Blog Street, Content City') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-purple-900 to-blue-900 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl text-gray-300 mb-8">
            Join our community of writers and readers. Start sharing your stories today!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}"
               class="bg-white text-purple-900 px-8 py-4 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity">
                <i class="fas fa-user-plus mr-2"></i>
                Join Our Community
            </a>
            <a href="{{ route('home') }}"
               class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-purple-900 transition-colors">
                <i class="fas fa-home mr-2"></i>
                Explore Our Blog
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
    .contact-form input:focus,
    .contact-form textarea:focus,
    .contact-form select:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
</style>
@endpush
@endsection
