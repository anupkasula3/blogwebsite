@extends('frontend.layout.main')
@section('title', 'Privacy Policy - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('content')
<div class="max-w-screen-2xl mx-auto px-4 py-12 bg-gray-50">
    <div class="bg-white shadow-lg rounded-xl p-8 md:p-12">
        <!-- Page Title -->
        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2 text-center md:text-left">
            Privacy Policy
        </h1>

        <!-- Divider -->
        <div class="w-24 h-1 bg-[#ff2953] rounded mb-8 mx-auto md:mx-0"></div>

        <!-- Content -->
        <div class="prose prose-lg prose-gray max-w-none">
            {!! \App\Models\Setting::getPrivacyPolicy() ?: '<p>Privacy Policy content will appear here soon.</p>' !!}
        </div>
    </div>
</div>
@endsection
