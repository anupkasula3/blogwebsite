
<!-- Main Footer -->
<footer class="bg-black text-white">
    <div class="max-w-screen-2xl mx-auto px-4  py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="logo  d-flex align-items-center me-auto me-xl-0">
                    <img src="{{ \App\Models\Setting::get('site_logo') ? asset('storage/' . \App\Models\Setting::get('site_logo')) : asset('images/NepBlog_white.png') }}" style="width: 200px; height: auto; max-height: 80px;padding-bottom: 2rem;"
                        alt="{{ \App\Models\Setting::get('site_name', 'NepBlog') }} Logo">
                </a>
                <p class="text-white mb-6 leading-relaxed">
                    {{ \App\Models\Setting::get('site_description', 'Your ultimate destination for amazing stories, insights, and knowledge. Discover content that inspires, educates, and entertains.') }}
                </p>
                <div class="flex space-x-4">
                    @php
                        $fb = \App\Models\Setting::get('social_facebook') ?: \App\Models\Setting::get('facebook_url');
                        $tw = \App\Models\Setting::get('social_twitter') ?: \App\Models\Setting::get('twitter_url');
                        $ig = \App\Models\Setting::get('social_instagram') ?: \App\Models\Setting::get('instagram_url');
                        $li = \App\Models\Setting::get('social_linkedin') ?: \App\Models\Setting::get('linkedin_url');
                        $yt = \App\Models\Setting::get('social_youtube') ?: \App\Models\Setting::get('youtube_url');
                    @endphp
                    @if($fb)
                        <a href="{{ $fb }}" target="_blank" rel="noopener" class="text-white hover:text-white transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                    @endif
                    @if($tw)
                        <a href="{{ $tw }}" target="_blank" rel="noopener" class="text-white hover:text-white transition-colors" aria-label="Twitter">
                            <i class="fab fa-tiktok text-xl"></i>
                        </a>
                    @endif
                    @if($ig)
                        <a href="{{ $ig }}" target="_blank" rel="noopener" class="text-white hover:text-white transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    @endif
                    @if($li)
                        <a href="{{ $li }}" target="_blank" rel="noopener" class="text-white hover:text-white transition-colors" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    @endif
                    @if($yt)
                        <a href="{{ $yt }}" target="_blank" rel="noopener" class="text-white hover:text-white transition-colors" aria-label="YouTube">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-white hover:text-white transition-colors">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-white hover:text-white transition-colors">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-white hover:text-white transition-colors">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}" class="text-white hover:text-white transition-colors">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" class="text-white hover:text-white transition-colors">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sitemap') }}" class="text-white hover:text-white transition-colors">
                            Sitemap
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Categories</h3>
                <ul class="space-y-3">
                    @foreach ($categories ?? [] as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}"
                                class="text-white hover:text-white transition-colors">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                    <!-- <li>
                        <a href="{{ route('categories.index') }}" class="text-primary transition-colors font-medium">
                            View All Categories →
                        </a>
                    </li> -->
                </ul>
            </div>

            <!-- Newsletter Signup -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Stay Updated</h3>
                <p class="text-white mb-4">
                    Subscribe to our newsletter for the latest articles and updates.
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <input type="email" name="email" placeholder="Enter your email"
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none text-white placeholder-gray-400"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:opacity-90 transition-opacity">
                        Subscribe
                    </button>
                </form>

                <!-- Contact Info -->
                <div class="mt-6 space-y-2">
                    <div class="flex items-center space-x-3 text-white">
                        <i class="fas fa-envelope"></i>
                        <span>{{ \App\Models\Setting::get('contact_email', 'contact@NepBlog.com') }}</span>
                    </div>
                    <div class="flex items-center space-x-3 text-white">
                        <i class="fas fa-phone"></i>
                        <span>{{ \App\Models\Setting::get('contact_phone', '+1 (555) 123-4567') }}</span>
                    </div>
                    <div class="flex items-center space-x-3 text-white">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ \App\Models\Setting::get('contact_address', '123 Blog Street, Content City') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-white text-sm">
                    © {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'NepBlog') }}. All rights reserved.
                </div>
                <div class="flex items-center space-x-6 text-sm">
                    <a href="{{ route('privacy') }}" class="text-white hover:text-white transition-colors">
                        Privacy Policy
                    </a>
                    <a href="{{ route('terms') }}" class="text-white hover:text-white transition-colors">
                        Terms and Conditions
                    </a>

                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop"
    class="fixed bottom-8 right-8 bg-primary text-white p-3 rounded-full shadow-lg hover:opacity-90 transition-opacity opacity-0 invisible">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Back to Top functionality
    const backToTopButton = document.getElementById('backToTop');

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible');
            backToTopButton.classList.remove('opacity-100', 'visible');
        }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
