<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Website Settings
            ['key' => 'site_name', 'value' => 'MyBlogSite', 'type' => 'string', 'group' => 'website'],
            ['key' => 'site_description', 'value' => 'Your Ultimate Blog Destination', 'type' => 'text', 'group' => 'website'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'website'],
            ['key' => 'site_favicon', 'value' => null, 'type' => 'image', 'group' => 'website'],
            ['key' => 'site_theme', 'value' => 'purple-blue', 'type' => 'string', 'group' => 'website'],
            ['key' => 'posts_per_page', 'value' => 12, 'type' => 'integer', 'group' => 'website'],
            ['key' => 'enable_comments', 'value' => true, 'type' => 'boolean', 'group' => 'website'],
            ['key' => 'enable_newsletter', 'value' => true, 'type' => 'boolean', 'group' => 'website'],
            ['key' => 'enable_social_sharing', 'value' => true, 'type' => 'boolean', 'group' => 'website'],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'contact@myblogsite.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+1 (555) 123-4567', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => '123 Blog Street, Content City', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_working_hours', 'value' => 'Monday - Friday: 9:00 AM - 6:00 PM', 'type' => 'text', 'group' => 'contact'],

            // Social Media Settings
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/myblogsite', 'type' => 'url', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/myblogsite', 'type' => 'url', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/myblogsite', 'type' => 'url', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/myblogsite', 'type' => 'url', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/myblogsite', 'type' => 'url', 'group' => 'social'],

            // SEO Settings
            ['key' => 'default_meta_title', 'value' => 'MyBlogSite - Your Ultimate Blog Destination', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'default_meta_description', 'value' => 'Discover amazing stories, insights, and knowledge on our blog platform.', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'default_meta_keywords', 'value' => 'blog, articles, stories, insights, knowledge', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => null, 'type' => 'string', 'group' => 'seo'],
            ['key' => 'google_search_console', 'value' => null, 'type' => 'text', 'group' => 'seo'],
            ['key' => 'bing_webmaster_tools', 'value' => null, 'type' => 'text', 'group' => 'seo'],
            ['key' => 'enable_schema_markup', 'value' => true, 'type' => 'boolean', 'group' => 'seo'],
            ['key' => 'enable_sitemap', 'value' => true, 'type' => 'boolean', 'group' => 'seo'],

            // Advertisement Settings
            ['key' => 'enable_ads', 'value' => true, 'type' => 'boolean', 'group' => 'ads'],
            ['key' => 'ad_header_enabled', 'value' => true, 'type' => 'boolean', 'group' => 'ads'],
            ['key' => 'ad_sidebar_enabled', 'value' => true, 'type' => 'boolean', 'group' => 'ads'],
            ['key' => 'ad_footer_enabled', 'value' => true, 'type' => 'boolean', 'group' => 'ads'],
            ['key' => 'ad_content_enabled', 'value' => true, 'type' => 'boolean', 'group' => 'ads'],

            // User Settings
            ['key' => 'user_registration_enabled', 'value' => true, 'type' => 'boolean', 'group' => 'user'],
            ['key' => 'user_verification_required', 'value' => false, 'type' => 'boolean', 'group' => 'user'],
            ['key' => 'user_blog_approval_required', 'value' => true, 'type' => 'boolean', 'group' => 'user'],
            ['key' => 'max_posts_per_user', 'value' => 100, 'type' => 'integer', 'group' => 'user'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
