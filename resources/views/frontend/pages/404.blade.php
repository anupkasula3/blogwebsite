@extends('frontend.layout.main')

@section('title', 'Page Not Found - MyBlogSite')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <div class="w-32 h-32 mx-auto bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-exclamation-triangle text-white text-4xl"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Page Not Found</h2>
            <p class="text-gray-600 mb-8">
                The page you're looking for doesn't exist or has been moved.
            </p>
        </div>

        <div class="space-y-4">
            <a href="{{ route('home') }}"
               class="inline-block bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                Go Home
            </a>
            <div class="text-sm text-gray-500">
                <a href="{{ route('categories.index') }}" class="hover:text-purple-600">Browse Categories</a>
                <span class="mx-2">•</span>
                <a href="{{ route('latest') }}" class="hover:text-purple-600">Latest Posts</a>
            </div>
        </div>
    </div>
</div>
@endsection
