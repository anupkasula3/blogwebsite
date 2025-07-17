@extends('frontend.layout.main')
@section('title', 'Privacy Policy - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('content')
<div class=" py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Privacy Policy</h1>
    <div class="prose prose-lg">
        {!! \App\Models\Setting::getPrivacyPolicy() ?: '<p>Privacy Policy content will appear here soon.</p>' !!}
    </div>
</div>
@endsection
