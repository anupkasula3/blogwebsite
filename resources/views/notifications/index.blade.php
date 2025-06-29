@if(auth()->guard('admin')->check())
    @extends('admin.layouts.app')
@else
    @extends('user.layouts.app')
@endif

@section('title', 'Notifications')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
        @if($notifications->where('is_read', false)->count() > 0)
            <form action="{{ auth()->guard('admin')->check() ? route('admin.notifications.read-all') : route('user.notifications.read-all') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Mark All as Read
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($notifications->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($notifications as $notification)
                    <div class="p-6 hover:bg-gray-50 transition-colors {{ $notification->is_read ? 'opacity-75' : 'bg-blue-50' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                <div class="flex-shrink-0">
                                    <i class="{{ $notification->icon }} text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2">
                                        <h3 class="text-lg font-semibold text-gray-900 {{ $notification->is_read ? '' : 'font-bold' }}">
                                            {{ $notification->title }}
                                        </h3>
                                        @if(!$notification->is_read)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                New
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mt-1 text-gray-600">{{ $notification->message }}</p>
                                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                        <span>{{ $notification->time_ago }}</span>
                                        @if($notification->sender)
                                            <span>by {{ $notification->sender->name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($notification->action_url)
                                    <a href="{{ $notification->action_url }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View
                                    </a>
                                @endif
                                @if(!$notification->is_read)
                                    <form action="{{ auth()->guard('admin')->check() ? route('admin.notifications.read', $notification) : route('user.notifications.read', $notification) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-gray-600 text-sm">
                                            Mark as read
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <div class="mx-auto h-12 w-12 text-gray-400">
                    <i class="fas fa-bell text-4xl"></i>
                </div>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                <p class="mt-1 text-sm text-gray-500">You're all caught up!</p>
            </div>
        @endif
    </div>
</div>
@endsection
