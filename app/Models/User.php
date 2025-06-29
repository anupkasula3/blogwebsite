<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'website',
        'is_verified',
        'email_verified_at',
        'last_login_at',
        'preferences'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'last_login_at' => 'datetime',
            'preferences' => 'array',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function approvedPosts()
    {
        return $this->hasMany(Post::class)->approved();
    }

    public function pendingPosts()
    {
        return $this->hasMany(Post::class)->pending();
    }

    public function isVerified()
    {
        return $this->is_verified;
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return Storage::url($this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7C3AED&background=EBF4FF';
    }

    public function getTotalPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    public function getApprovedPostsCountAttribute()
    {
        return $this->posts()->approved()->count();
    }

    public function getTotalViewsAttribute()
    {
        return $this->posts()->sum('views_count');
    }

    public function getAverageViewsAttribute()
    {
        $postsCount = $this->posts()->count();
        if ($postsCount === 0) return 0;
        return round($this->posts()->sum('views_count') / $postsCount, 2);
    }

    public function getPopularPostsAttribute()
    {
        return $this->posts()->orderBy('views_count', 'desc')->take(5)->get();
    }

    public function getRecentPostsAttribute()
    {
        return $this->posts()->latest()->take(5)->get();
    }

    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }

    // Notification relationships
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'recipient_id')
                    ->where('recipient_type', 'user');
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
