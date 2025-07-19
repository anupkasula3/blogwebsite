@extends('admin.layouts.app')

@section('content')
<div class="container py-4 max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-quote-left mr-2 text-indigo-600"></i> Quote Details</h2>
        <div class="mb-8">
            <blockquote class="border-l-4 border-indigo-400 pl-4 italic text-lg text-gray-700">
                <i class="fas fa-quote-left text-indigo-400 mr-2"></i>{{ $quote->quote }}
            </blockquote>
        </div>
        <a href="{{ route('admin.quotes.index') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"><i class="fas fa-arrow-left mr-2"></i> Back to List</a>
    </div>
</div>
@endsection
