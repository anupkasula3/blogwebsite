<!-- Footer Advertisement Banner -->
@if(isset($footerAd) && $footerAd)
<div class="ad-banner py-4 px-4 text-center">
    <a href="{{ $footerAd->link }}" target="_blank"
       onclick="trackAdClick({{ $footerAd->id }}, 'footer')"
       class="flex items-center justify-center space-x-3 hover:opacity-90 transition-opacity">
        <div class="flex-1 max-w-md">
            <h3 class="font-bold text-lg">{{ $footerAd->title }}</h3>
            <p class="text-sm opacity-90">{{ $footerAd->description }}</p>
        </div>
        <i class="fas fa-external-link-alt text-xl"></i>
    </a>
</div>
@endif

<!-- Main Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="lg:col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-blog text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-gradient">MyBlogSite</span>
                </div>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Your ultimate destination for amazing stories, insights, and knowledge. Discover content that inspires, educates, and entertains.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition-colors">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition-colors">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition-colors">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sitemap') }}" class="text-gray-400 hover:text-white transition-colors">
                            Sitemap
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Categories</h3>
                <ul class="space-y-3">
                    @foreach($categories ?? [] as $category)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}" class="text-gray-400 hover:text-white transition-colors">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{ route('categories.index') }}" class="text-purple-400 hover:text-purple-300 transition-colors font-medium">
                            View All Categories →
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter Signup -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Stay Updated</h3>
                <p class="text-gray-400 mb-4">
                    Subscribe to our newsletter for the latest articles and updates.
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <input type="email" name="email" placeholder="Enter your email"
                               class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400"
                               required>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:opacity-90 transition-opacity">
                        Subscribe
                    </button>
                </form>

                <!-- Contact Info -->
                <div class="mt-6 space-y-2">
                    <div class="flex items-center space-x-3 text-gray-400">
                        <i class="fas fa-envelope"></i>
                        <span>contact@myblogsite.com</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-400">
                        <i class="fas fa-phone"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Blog Street, Content City</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-gray-400 text-sm">
                    © {{ date('Y') }} MyBlogSite. All rights reserved.
                </div>
                <div class="flex items-center space-x-6 text-sm">
                    <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition-colors">
                        Privacy Policy
                    </a>
                    <a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition-colors">
                        Terms of Service
                    </a>
                    <a href="{{ route('cookies') }}" class="text-gray-400 hover:text-white transition-colors">
                        Cookie Policy
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="fixed bottom-8 right-8 bg-gradient-to-r from-purple-600 to-blue-600 text-white p-3 rounded-full shadow-lg hover:opacity-90 transition-opacity opacity-0 invisible">
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
