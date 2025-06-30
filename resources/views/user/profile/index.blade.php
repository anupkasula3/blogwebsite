@extends('user.layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Page header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Profile Settings</h1>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8">
        <div class="grid grid-cols-12 gap-6">

            <!-- Left side -->
            <div class="col-span-12 lg:col-span-4">
                <div class="text-center lg:text-left">
                    <div class="relative inline-flex mb-4">
                        <img class="w-32 h-32 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="User avatar">
                        <div class="absolute bottom-0 right-0 bg-white p-1 rounded-full shadow-md">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    <p class="text-sm text-gray-500 mt-2">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            <!-- Right side -->
            <div class="col-span-12 lg:col-span-8">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Update Your Profile</h3>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-input w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-input w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                             @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" id="bio" rows="3" class="form-textarea w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                     <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website', auth()->user()->website) }}" class="form-input w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500" placeholder="https://example.com">
                        @error('website') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" class="w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-purple-50 file:text-purple-700
                            hover:file:bg-purple-100">
                        @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                            <i class="fas fa-save mr-2"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
