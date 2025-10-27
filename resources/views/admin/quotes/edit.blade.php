@extends('admin.layouts.app')

@section('title', 'Edit Quote - Admin')
@section('page-title', 'Edit Quote')

@section('content')
<div class="flex gap-4">
    <a href="{{ route('admin.quotes.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 12l14 0"></path>
            <path d="M5 12l6 6"></path>
            <path d="M5 12l6 -6"></path>
        </svg>
    </a>
    <div class="text-xl font-bold">Edit Quote</div>
</div>
<div class="bg-white rounded-lg shadow-md ">
    <form action="{{ route('admin.quotes.update', $quote) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="p-6 mt-3">
            <div class="flex flex-col">
                <div>
                    <label for="quote" class="w-full text-sm font-semibold">Quote</label>
                    <div>
                        <textarea name="quote" id="quote" rows="4" placeholder="Edit the motivational quote..." class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500 @error('quote') border-red-500 @enderror">{{ old('quote', $quote->quote) }}</textarea>
                        @error('quote')
                            <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="px-4 py-1 mt-3 mr-2 text-white bg-[#ff3131] rounded-md hover:bg-[#ff3135]">
                        Update
                    </button>
                    <a href="{{ route('admin.quotes.index') }}" class="px-4 py-1 mt-3 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

