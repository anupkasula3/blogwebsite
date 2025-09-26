@extends('user.layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Profile Settings</h1>
                <p class="mt-1 text-sm text-gray-500">Manage your personal information and account preferences.</p>
            </div>
            <a href="{{ route('user.password.change.form') }}" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-[#ff2953] to-[#ff5475] shadow hover:opacity-95 transition">
                <i class="fas fa-key mr-2"></i> Change Password
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left: Profile Card -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="h-20 bg-gradient-to-r from-[#ff2953] to-[#ff5475]"></div>
                <div class="p-6 -mt-12">
                    <div class="flex flex-col items-center text-center">
                        <div class="relative">
                            <img class="w-28 h-28 rounded-full ring-4 ring-white shadow-md object-cover" src="{{ auth()->user()->avatar_url }}" alt="User avatar">
                            <span class="absolute -bottom-1 -right-1 inline-flex items-center justify-center w-7 h-7 rounded-full bg-white shadow">
                                <i class="fas fa-camera text-[#ff2953]"></i>
                            </span>
                        </div>
                        <h2 class="mt-4 text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        <p class="text-xs text-gray-400 mt-1">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8" x-data="{ preview: '{{ auth()->user()->avatar_url }}' }">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Update Your Profile</h3>

                @if (session('success'))
                    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 text-green-800 p-4">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle mt-0.5 mr-3"></i>
                            <div>
                                <p class="font-semibold">Success</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 p-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" placeholder="Your full name">
                            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 w-full rounded-lg p-2 border border-gray-300 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" placeholder="you@example.com">
                            @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                        <textarea name="bio" id="bio" rows="4" class="mt-1 w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" placeholder="A short bio about you...">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website', auth()->user()->website) }}" class="mt-1 w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" placeholder="https://example.com">
                        <p class="text-xs text-gray-500 mt-1">Include the full URL starting with https://</p>
                        @error('website') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                        <div class="mt-2 flex items-start sm:items-center gap-4">
                            <img :src="preview" alt="Avatar preview" class="w-16 h-16 rounded-full object-cover ring-2 ring-gray-100">
                            <div>
                                <input @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview" type="file" name="avatar" id="avatar" accept="image/*" class="block w-full text-sm text-gray-700 rounded-lg border border-gray-300 shadow-sm
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-lg file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-[#ff2953]/10 file:text-[#ff2953]
                                       hover:file:bg-[#ff2953]/20">
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 2MB.</p>
                                @error('avatar') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 rounded-lg font-semibold text-white bg-gradient-to-r from-[#ff2953] to-[#ff5475] shadow hover:opacity-95 transition">
                            <i class="fas fa-save mr-2"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
