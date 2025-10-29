@extends('frontend.layout.main')
@section('title', 'Privacy Policy - ' . \App\Models\Setting::get('site_name', 'NepBlog'))
@section('content')
    <div id="" class="px-4  max-w-screen-2xl mx-auto bg-white ">

        <div class="py-6 mt-5  shadow">
            <h1 class="text-3xl  max-sm:text-xl sm:px-4  font-bold mb-6 px-2">Privacy Policy</h1>
            <div class="prose prose-lg px-4 sm:px-6   ">
                {!! \App\Models\Setting::getPrivacyPolicy() ?: '<p>Privacy Policy content will appear here soon.</p>' !!}
            </div>
        </div>
    </div>
@endsection
