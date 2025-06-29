<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Automatically hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Notification relationships
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'recipient_id')
                    ->where('recipient_type', 'admin')
                    ->where('sender_type', 'user'); // Only show notifications from users
    }

    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }

    public function readNotifications()
    {
        return $this->notifications()->read();
    }

    public function getUnreadNotificationsCountAttribute()
    {
        return $this->unreadNotifications()->count();
    }

    public function markAllNotificationsAsRead()
    {
        $this->unreadNotifications()->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }
}
