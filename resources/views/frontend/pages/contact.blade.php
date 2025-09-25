@extends('frontend.layout.main')

@section('title', 'Contact Us - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('meta_description', 'Get in touch with us. We\'d love to hear from you! Contact us for any questions, suggestions, or collaborations.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-[#ff2953] to-[#c51f42] text-white py-12">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Get in Touch</h1>
        <p class="text-xl text-gray-300 leading-relaxed">
            We'd love to hear from you! Whether you have a question, suggestion, or just want to say hello, we're here to help.
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-lg p-6 transition hover:shadow-xl">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Send us a Message</h2>
                <div class="w-16 h-1 bg-[#ff2953] rounded mb-4"></div>

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

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 contact-form">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ff2953] focus:border-transparent"
                                   placeholder="Your full name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ff2953] focus:border-transparent"
                                   placeholder="your.email@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                        <select id="subject" name="subject" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ff2953] focus:border-transparent">
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
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#ff2953] focus:border-transparent"
                                  placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-[#ff2953] focus:ring-[#ff2953] border-gray-300 rounded">
                        <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                            Subscribe to our newsletter for updates and insights
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-[#ff2953] to-[#c51f42] text-white py-3.5 px-5 rounded-lg font-semibold text-lg shadow-md hover:shadow-lg transition">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-lg p-8 transition hover:shadow-xl">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Contact Information</h2>
                <div class="w-16 h-1 bg-[#ff2953] rounded mb-4"></div>

                <div class="space-y-8">
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[rgba(255,41,83,0.12)] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-[#ff2953] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600 mb-2">{{ \App\Models\Setting::get('contact_email', 'contact@myblogsite.com') }}</p>
                            <p class="text-sm text-gray-500">We typically respond within 24 hours</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[rgba(255,41,83,0.12)] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-[#ff2953] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Phone</h3>
                            <p class="text-gray-600 mb-2">{{ \App\Models\Setting::get('contact_phone', '+1 (555) 123-4567') }}</p>
                            <p class="text-sm text-gray-500">{{ \App\Models\Setting::get('contact_working_hours', 'Monday - Friday: 9:00 AM - 6:00 PM') }}</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[rgba(255,41,83,0.12)] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-[#ff2953] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Address</h3>
                            <p class="text-gray-600">{{ \App\Models\Setting::get('contact_address', '123 Blog Street, Content City') }}</p>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[rgba(255,41,83,0.12)] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-share-alt text-[#ff2953] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Follow Us</h3>
                            <div class="flex space-x-3">
                                @if(\App\Models\Setting::get('facebook_url'))
                                <a href="{{ \App\Models\Setting::get('facebook_url') }}" target="_blank" aria-label="Facebook"
                                   class="social-btn w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('twitter_url'))
                                <a href="{{ \App\Models\Setting::get('twitter_url') }}" target="_blank" aria-label="Twitter"
                                   class="social-btn w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-white">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('instagram_url'))
                                <a href="{{ \App\Models\Setting::get('instagram_url') }}" target="_blank" aria-label="Instagram"
                                   class="social-btn w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('linkedin_url'))
                                <a href="{{ \App\Models\Setting::get('linkedin_url') }}" target="_blank" aria-label="LinkedIn"
                                   class="social-btn w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center text-white">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif

                                @if(\App\Models\Setting::get('youtube_url'))
                                <a href="{{ \App\Models\Setting::get('youtube_url') }}" target="_blank" aria-label="YouTube"
                                   class="social-btn w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                
            </div>
        </div>
    </div>
</section>



@push('styles')
<style>
    .contact-form input:focus,
    .contact-form textarea:focus,
    .contact-form select:focus {
        outline: none;
        border-color: #ff2953;
        box-shadow: 0 0 0 3px rgba(255, 41, 83, 0.15);
    }

    /* Social buttons */
    .social-btn { transition: transform 150ms ease, box-shadow 150ms ease, opacity 150ms ease; }
    .social-btn:hover { opacity: 0.92; transform: translateY(-1px); box-shadow: 0 6px 12px rgba(0,0,0,0.12); }
    .social-btn:focus { outline: none; box-shadow: 0 0 0 3px rgba(255,41,83,0.2); }

    /* FAQ */
    .faq-item summary { list-style: none; }
    .faq-item summary::-webkit-details-marker { display: none; }
    .faq-item[open] .chev { transform: rotate(180deg); }
    .faq-item { overflow: hidden; }
    .faq-item:hover { box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
</style>
@endpush
@endsection
