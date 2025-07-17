@extends('admin.layouts.app')

@section('title', 'Site Settings - Admin')
@section('page-title', 'Site Settings')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">General Settings</h2>
        <p class="text-gray-600 mt-1">Manage your website's general configuration and appearance.</p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Site Information -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Site Information</h3>

                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name *</label>
                    <input type="text" name="site_name" id="site_name"
                           value="{{ old('site_name', $settings->get('site_name', 'MyBlogSite')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           required>
                </div>

                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                    <textarea name="site_description" id="site_description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Brief description of your website">{{ old('site_description', $settings->get('site_description')) }}</textarea>
                </div>

                <div>
                    <label for="site_keywords" class="block text-sm font-medium text-gray-700 mb-2">Site Keywords</label>
                    <input type="text" name="site_keywords" id="site_keywords"
                           value="{{ old('site_keywords', $settings->get('site_keywords')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="keyword1, keyword2, keyword3">
                    <p class="text-sm text-gray-500 mt-1">Separate keywords with commas</p>
                </div>

                <div>
                    <label for="site_url" class="block text-sm font-medium text-gray-700 mb-2">Site URL</label>
                    <input type="url" name="site_url" id="site_url"
                           value="{{ old('site_url', $settings->get('site_url', config('app.url'))) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://example.com">
                </div>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Contact Information</h3>

                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                    <input type="email" name="contact_email" id="contact_email"
                           value="{{ old('contact_email', $settings->get('contact_email')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="contact@example.com">
                </div>

                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                    <input type="text" name="contact_phone" id="contact_phone"
                           value="{{ old('contact_phone', $settings->get('contact_phone')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="+1 (555) 123-4567">
                </div>

                <div>
                    <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-2">Contact Address</label>
                    <textarea name="contact_address" id="contact_address" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Your business address">{{ old('contact_address', $settings->get('contact_address')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="mt-8 space-y-6">
            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Social Media</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                    <input type="url" name="social_facebook" id="social_facebook"
                           value="{{ old('social_facebook', $settings->get('social_facebook')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://facebook.com/yourpage">
                </div>

                <div>
                    <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                    <input type="url" name="social_twitter" id="social_twitter"
                           value="{{ old('social_twitter', $settings->get('social_twitter')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://twitter.com/yourhandle">
                </div>

                <div>
                    <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" name="social_instagram" id="social_instagram"
                           value="{{ old('social_instagram', $settings->get('social_instagram')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://instagram.com/yourprofile">
                </div>

                <div>
                    <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                    <input type="url" name="social_linkedin" id="social_linkedin"
                           value="{{ old('social_linkedin', $settings->get('social_linkedin')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://linkedin.com/company/yourcompany">
                </div>

                <div>
                    <label for="social_youtube" class="block text-sm font-medium text-gray-700 mb-2">YouTube URL</label>
                    <input type="url" name="social_youtube" id="social_youtube"
                           value="{{ old('social_youtube', $settings->get('social_youtube')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://youtube.com/yourchannel">
                </div>

                <div>
                    <label for="social_github" class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
                    <input type="url" name="social_github" id="social_github"
                           value="{{ old('social_github', $settings->get('social_github')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://github.com/yourusername">
                </div>
            </div>
        </div>

        <!-- Analytics & SEO -->
        <div class="mt-8 space-y-6">
            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Analytics & SEO</h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="google_analytics" class="block text-sm font-medium text-gray-700 mb-2">Google Analytics ID</label>
                    <input type="text" name="google_analytics" id="google_analytics"
                           value="{{ old('google_analytics', $settings->get('google_analytics')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="G-XXXXXXXXXX">
                    <p class="text-sm text-gray-500 mt-1">Enter your Google Analytics tracking ID</p>
                </div>

                <div>
                    <label for="google_search_console" class="block text-sm font-medium text-gray-700 mb-2">Google Search Console</label>
                    <input type="text" name="google_search_console" id="google_search_console"
                           value="{{ old('google_search_console', $settings->get('google_search_console')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Meta tag content">
                    <p class="text-sm text-gray-500 mt-1">Enter the meta tag content from Google Search Console</p>
                </div>
            </div>
        </div>

        <!-- Content Settings -->
        <div class="mt-8 space-y-6">
            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Content Settings</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="posts_per_page" class="block text-sm font-medium text-gray-700 mb-2">Posts per Page</label>
                    <input type="number" name="posts_per_page" id="posts_per_page"
                           value="{{ old('posts_per_page', $settings->get('posts_per_page', 12)) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           min="1" max="50">
                </div>

                <div>
                    <label for="featured_posts_count" class="block text-sm font-medium text-gray-700 mb-2">Featured Posts Count</label>
                    <input type="number" name="featured_posts_count" id="featured_posts_count"
                           value="{{ old('featured_posts_count', $settings->get('featured_posts_count', 6)) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           min="1" max="20">
                </div>

                <div>
                    <label for="latest_posts_count" class="block text-sm font-medium text-gray-700 mb-2">Latest Posts Count</label>
                    <input type="number" name="latest_posts_count" id="latest_posts_count"
                           value="{{ old('latest_posts_count', $settings->get('latest_posts_count', 8)) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           min="1" max="20">
                </div>
            </div>
        </div>

        <!-- Legal Pages -->
        <div class="mt-8 space-y-6">
            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Legal Pages</h3>
            <div>
                <label for="termsandcondition" class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions Content</label>
                <textarea  name="termsandcondition" id="termsandcondition" rows="8" class="w-full tinymce px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter Terms & Conditions content here...">{{ old('termsandcondition', \App\Models\Setting::getTermsAndCondition()) }}</textarea>
            </div>
            <div>
                <label for="privacypolicy" class="block text-sm font-medium text-gray-700 mb-2">Privacy Policy Content</label>
                <textarea name="privacypolicy" id="privacypolicy" rows="8" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter Privacy Policy content here...">{{ old('privacypolicy', \App\Models\Setting::getPrivacyPolicy()) }}</textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="window.location.reload()"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Reset
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
