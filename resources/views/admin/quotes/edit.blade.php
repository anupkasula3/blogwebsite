@extends('admin.layouts.app')

@section('content')
<div class="container py-4 max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-edit mr-2 text-yellow-500"></i> Edit Quote</h2>
        <form action="{{ route('admin.quotes.update', $quote) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="quote" class="block text-sm font-semibold text-gray-700 mb-2">Quote</label>
                <textarea name="quote" id="quote" class="form-control w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('quote') border-red-500 @enderror" rows="4" placeholder="Edit the motivational quote...">{{ old('quote', $quote->quote) }}</textarea>
                @error('quote')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="inline-flex items-center px-5 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition"><i class="fas fa-save mr-2"></i> Update Quote</button>
                <a href="{{ route('admin.quotes.index') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"><i class="fas fa-arrow-left mr-2"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
