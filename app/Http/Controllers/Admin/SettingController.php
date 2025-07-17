<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'site_url' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'social_github' => 'nullable|url',
            'google_analytics' => 'nullable|string',
            'google_search_console' => 'nullable|string',
            'posts_per_page' => 'nullable|integer|min:1|max:50',
            'featured_posts_count' => 'nullable|integer|min:1|max:20',
            'latest_posts_count' => 'nullable|integer|min:1|max:20',
            'terms_content' => 'nullable|string',
            'privacy_content' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
            \App\Models\Setting::set('site_logo', $logoPath, 'image', 'website');
        }
        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('settings', 'public');
            \App\Models\Setting::set('site_favicon', $faviconPath, 'image', 'website');
        }

        // Update each setting individually
        $fields = [
            'site_name', 'site_description', 'site_keywords', 'site_url',
            'contact_email', 'contact_phone', 'contact_address',
            'social_facebook', 'social_twitter', 'social_instagram', 'social_linkedin', 'social_youtube', 'social_github',
            'google_analytics', 'google_search_console',
            'posts_per_page', 'featured_posts_count', 'latest_posts_count',
        ];
        foreach ($fields as $field) {
            \App\Models\Setting::set($field, $request->input($field, null));
        }
        // Save legal pages to new columns
        if ($request->has('termsandcondition')) {
            \App\Models\Setting::setTermsAndCondition($request->input('termsandcondition'));
        }
        if ($request->has('privacypolicy')) {
            \App\Models\Setting::setPrivacyPolicy($request->input('privacypolicy'));
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Cache cleared successfully!');
    }

    public function backup()
    {
        \Artisan::call('backup:run');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Backup created successfully!');
    }
}
