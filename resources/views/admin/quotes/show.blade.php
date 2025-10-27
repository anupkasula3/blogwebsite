@extends('admin.layouts.app')

@section('title', 'Quote Details - Admin')
@section('page-title', 'Quote Details')

@section('content')
<div class="flex items-center gap-x-4 mb-4">
    <a href="{{ route('admin.quotes.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 12l14 0"></path>
            <path d="M5 12l6 6"></path>
            <path d="M5 12l6 -6"></path>
        </svg>
    </a>
    <div class="text-xl font-semibold">Quote Details</div>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-3xl">
    <div class="mb-6">
        <blockquote class="border-l-4 border-gray-200 pl-4 italic text-lg text-gray-700">
            {{ $quote->quote }}
        </blockquote>
    </div>
    <a href="{{ route('admin.quotes.index') }}" class="inline-flex items-center px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 12l14 0"></path>
            <path d="M5 12l6 6"></path>
            <path d="M5 12l6 -6"></path>
        </svg>
        Back to List
    </a>
</div>
@endsection
