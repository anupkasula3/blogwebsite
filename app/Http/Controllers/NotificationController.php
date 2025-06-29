<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $admin = auth()->guard('admin')->user();

        $recipientType = $admin ? 'admin' : 'user';
        $recipientId = $admin ? $admin->id : $user->id;

        $query = Notification::forRecipient($recipientType, $recipientId);

        // For admin, only show notifications from users (not admin replies)
        if ($admin) {
            $query->where('sender_type', 'user');
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(20);

        if ($request->ajax()) {
            return response()->json([
                'notifications' => $notifications,
                'unread_count' => $admin ? $admin->unread_notifications_count : $user->unread_notifications_count
            ]);
        }

        if ($admin) {
            return view('admin.notifications.index', compact('notifications'));
        } else {
            return view('user.notifications.index', compact('notifications'));
        }
    }

    public function markAsRead(Notification $notification)
    {
        $user = auth()->user();
        $admin = auth()->guard('admin')->user();

        $recipientType = $admin ? 'admin' : 'user';
        $recipientId = $admin ? $admin->id : $user->id;

        // Check if notification belongs to the authenticated user
        if ($notification->recipient_type !== $recipientType || $notification->recipient_id !== $recipientId) {
            abort(403);
        }

        $notification->markAsRead();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'unread_count' => $admin ? $admin->unread_notifications_count : $user->unread_notifications_count
            ]);
        }

        return redirect()->back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead()
    {
        $user = auth()->user();
        $admin = auth()->guard('admin')->user();

        if ($admin) {
            $admin->markAllNotificationsAsRead();
        } else {
            $user->markAllNotificationsAsRead();
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'unread_count' => 0
            ]);
        }

        return redirect()->back()->with('success', 'All notifications marked as read');
    }

    public function getUnreadCount()
    {
        $user = auth()->user();
        $admin = auth()->guard('admin')->user();

        $count = $admin ? $admin->unread_notifications_count : $user->unread_notifications_count;

        return response()->json(['count' => $count]);
    }

    public function getLatestNotifications()
    {
        $user = auth()->user();
        $admin = auth()->guard('admin')->user();

        $recipientType = $admin ? 'admin' : 'user';
        $recipientId = $admin ? $admin->id : $user->id;

        $query = Notification::forRecipient($recipientType, $recipientId)->unread();

        // For admin, only show notifications from users (not admin replies)
        if ($admin) {
            $query->where('sender_type', 'user');
        }

        $notifications = $query->orderBy('created_at', 'desc')->take(5)->get();

        return response()->json(['notifications' => $notifications]);
    }

    public function redirectToAction(Notification $notification)
    {
        $user = auth()->user();
        $admin = auth()->guard('admin')->user();

        $recipientType = $admin ? 'admin' : 'user';
        $recipientId = $admin ? $admin->id : $user->id;

        // Check if notification belongs to the authenticated user
        if ($notification->recipient_type !== $recipientType || $notification->recipient_id !== $recipientId) {
            abort(403);
        }

        // Mark as read
        $notification->markAsRead();

        // Redirect to action URL
        if ($notification->action_url) {
            return redirect($notification->action_url);
        }

        return redirect()->back();
    }
}
