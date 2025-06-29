@extends('admin.layouts.app')

@section('title', 'Admin Notifications')
@section('page-title', 'Notifications')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Admin Notifications</h2>
                <p class="text-sm text-gray-600 mt-1">Manage notifications from user activities</p>
            </div>
            @if($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('admin.notifications.read-all') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-check-double mr-2"></i>
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="divide-y divide-gray-200">
        @forelse($notifications as $notification)
            <div class="p-6 hover:bg-gray-50 transition-colors {{ $notification->is_read ? 'opacity-75' : 'bg-blue-50' }}">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4 flex-1">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="{{ $notification->icon }} text-blue-600"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2">
                                <h3 class="text-lg font-semibold text-gray-900 {{ $notification->is_read ? '' : 'font-bold' }}">
                                    {{ $notification->title }}
                                </h3>
                                @if(!$notification->is_read)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-circle mr-1"></i>New
                                    </span>
                                @endif
                            </div>
                            <p class="mt-1 text-gray-600">{{ $notification->message }}</p>
                            <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                <span><i class="fas fa-clock mr-1"></i>{{ $notification->time_ago }}</span>
                                @if($notification->sender)
                                    <span><i class="fas fa-user mr-1"></i>by {{ $notification->sender->name }}</span>
                                @endif
                                @if($notification->data && isset($notification->data['post_title']))
                                    <span><i class="fas fa-file-alt mr-1"></i>{{ $notification->data['post_title'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($notification->action_url)
                            <a href="{{ $notification->action_url }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                        @endif
                        @if(!$notification->is_read)
                            <form action="{{ route('admin.notifications.read', $notification) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-check mr-1"></i>Mark as read
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="mx-auto h-16 w-16 text-gray-400 mb-4">
                    <i class="fas fa-bell text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No notifications</h3>
                <p class="text-gray-600">You're all caught up! No new user activities to review.</p>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $notifications->links() }}
        </div>
    @endif
</div>

<!-- Notification Stats -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bell text-blue-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Notifications</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $notifications->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-circle text-red-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Unread</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $notifications->where('is_read', false)->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-green-600"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">User Posts</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $notifications->where('type', 'user_post')->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
