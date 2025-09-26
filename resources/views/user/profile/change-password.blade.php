@extends('user.layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Change Password</h1>
                <p class="mt-1 text-sm text-gray-500">Keep your account secure by using a strong, unique password.</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 max-w-xl mx-auto">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Enter your new password</h2>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 text-green-800 p-4" role="alert">
                <div class="flex items-start">
                    <i class="fas fa-check-circle mt-0.5 mr-3"></i>
                    <div>
                        <p class="font-semibold">Success</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('user.password.change') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-input p-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" required>
                @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password" id="password" class="form-input p-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input p-2 w-full rounded-lg border border-gray-300 shadow-sm focus:border-[#ff2953] focus:ring-[#ff2953]" required>
                </div>
            </div>

            <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 rounded-lg font-semibold text-white bg-gradient-to-r from-[#ff2953] to-[#ff5475] shadow hover:opacity-95 transition">
                    <i class="fas fa-key mr-2"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
