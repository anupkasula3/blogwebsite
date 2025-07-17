@extends('frontend.layout.main')
@section('title', 'Terms & Conditions - ' . \App\Models\Setting::get('site_name', 'MyBlogSite'))
@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Terms & Conditions</h1>
    <div class="prose prose-lg">
        {!! \App\Models\Setting::getTermsAndCondition() ?: '<p>Terms & Conditions content will appear here soon.</p>' !!}
    </div>
</div>
@endsection
