@extends('user.layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Page header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Change Your Password</h1>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 max-w-xl mx-auto">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Enter your new password</h2>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('user.password.change') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-input w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500" required>
                @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" id="password" class="form-input w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500" required>
                </div>
            </div>

            <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                    <i class="fas fa-key mr-2"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
