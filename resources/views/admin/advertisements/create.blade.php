@extends('admin.layouts.app')

@section('title', 'Create Advertisement - Admin')
@section('page-title', 'Create Advertisement')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Create New Advertisement</h2>
            <a href="{{ route('admin.advertisements.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Advertisements
            </a>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.advertisements.store') }}" enctype="multipart/form-data" class="p-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 @enderror"
                        placeholder="Enter advertisement title" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-lightbulb mr-1"></i>Use a short, catchy title for your ad.</p>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="Brief description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-align-left mr-1"></i>Describe the ad content or offer (optional).</p>
                </div>
                <div>
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Link *</label>
                    <input type="url" name="link" id="link" value="{{ old('link') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('link') border-red-500 @enderror"
                        placeholder="https://example.com" required>
                    @error('link')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-link mr-1"></i>Where users will go when they click the ad.</p>
                </div>
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position *</label>
                    <select name="position" id="position"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('position') border-red-500 @enderror"
                        required>
                        <option value="">Select position</option>
                        <option value="header" {{ old('position') == 'header' ? 'selected' : '' }}>Header</option>
                        <option value="sidebar" {{ old('position') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                        <option value="footer" {{ old('position') == 'footer' ? 'selected' : '' }}>Footer</option>
                        <option value="content" {{ old('position') == 'content' ? 'selected' : '' }}>Content</option>
                    </select>
                    @error('position')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-map-marker-alt mr-1"></i>Choose where the ad will appear on the site.</p>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active') ? 'checked' : '' }}
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Active
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-toggle-on mr-1"></i>Only active ads are shown to users.</p>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-calendar mr-1"></i>Set when the ad should start showing (optional).</p>
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-calendar-alt mr-1"></i>Set when the ad should stop showing (optional).</p>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Advertisement Image</label>
                    <input type="file" name="image" onchange="loadFile(event)" id="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('image') border-red-500 @enderror">
                    <img id="output" style="width: 70px; margin-bottom: 2px;" />
                    <p class="text-xs text-gray-500 mt-1"><i class="fas fa-image mr-1"></i>Recommended size: 800x400px. Use a clear, attractive image.</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex space-x-3">
                    <button type="submit"
                        class="flex-1 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Create Advertisement
                    </button>
                    <a href="{{ route('admin.advertisements.index') }}"
                        class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors text-center">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
