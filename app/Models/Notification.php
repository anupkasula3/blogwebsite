<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'message',
        'data',
        'recipient_type',
        'recipient_id',
        'sender_type',
        'sender_id',
        'action_url',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    // Relationships
    public function recipient()
    {
        if ($this->recipient_type === 'admin') {
            return $this->belongsTo(Admin::class, 'recipient_id');
        }
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function sender()
    {
        if ($this->sender_type === 'admin') {
            return $this->belongsTo(Admin::class, 'sender_id');
        }
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeForRecipient($query, $type, $id)
    {
        return $query->where('recipient_type', $type)->where('recipient_id', $id);
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getIconAttribute()
    {
        return match($this->type) {
            'user_post' => 'fas fa-plus-circle text-blue-500',
            'post_approved' => 'fas fa-check-circle text-green-500',
            'post_rejected' => 'fas fa-times-circle text-red-500',
            'post_published' => 'fas fa-globe text-green-500',
            'post_unpublished' => 'fas fa-eye-slash text-yellow-500',
            'post_featured' => 'fas fa-star text-yellow-500',
            'post_unfeatured' => 'fas fa-star text-gray-500',
            'post_edited' => 'fas fa-edit text-blue-500',
            'post_deleted' => 'fas fa-trash text-red-500',
            default => 'fas fa-bell text-gray-500'
        };
    }

    // Static methods for creating notifications
    public static function notifyUserPost($user, $post)
    {
        // Notify all admins about new user post
        $admins = Admin::all();

        foreach ($admins as $admin) {
            self::create([
                'type' => 'user_post',
                'title' => 'New User Post',
                'message' => "User {$user->name} has created a new post: '{$post->title}'",
                'data' => [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug
                ],
                'recipient_type' => 'admin',
                'recipient_id' => $admin->id,
                'sender_type' => 'user',
                'sender_id' => $user->id,
                'action_url' => route('admin.userposts.show', $post)
            ]);
        }
    }

    public static function notifyPostApproved($post, $admin)
    {
        if ($post->author_type === 'user' && $post->user) {
            self::create([
                'type' => 'post_approved',
                'title' => 'Post Approved',
                'message' => "Your post '{$post->title}' has been approved by admin",
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name
                ],
                'recipient_type' => 'user',
                'recipient_id' => $post->user_id,
                'sender_type' => 'admin',
                'sender_id' => $admin->id,
                'action_url' => route('post.show', $post->slug)
            ]);
        }
    }

    public static function notifyPostRejected($post, $admin, $reason = null)
    {
        if ($post->author_type === 'user' && $post->user) {
            self::create([
                'type' => 'post_rejected',
                'title' => 'Post Rejected',
                'message' => "Your post '{$post->title}' has been rejected" . ($reason ? ": {$reason}" : ''),
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name,
                    'reason' => $reason
                ],
                'recipient_type' => 'user',
                'recipient_id' => $post->user_id,
                'sender_type' => 'admin',
                'sender_id' => $admin->id,
                'action_url' => route('user.posts.edit', $post)
            ]);
        }
    }

    public static function notifyPostPublished($post, $admin)
    {
        if ($post->author_type === 'user' && $post->user) {
            self::create([
                'type' => 'post_published',
                'title' => 'Post Published',
                'message' => "Your post '{$post->title}' has been published",
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name
                ],
                'recipient_type' => 'user',
                'recipient_id' => $post->user_id,
                'sender_type' => 'admin',
                'sender_id' => $admin->id,
                'action_url' => route('post.show', $post->slug)
            ]);
        }
    }

    public static function notifyPostUnpublished($post, $admin)
    {
        if ($post->author_type === 'user' && $post->user) {
            self::create([
                'type' => 'post_unpublished',
                'title' => 'Post Unpublished',
                'message' => "Your post '{$post->title}' has been unpublished",
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name
                ],
                'recipient_type' => 'user',
                'recipient_id' => $post->user_id,
                'sender_type' => 'admin',
                'sender_id' => $admin->id,
                'action_url' => route('user.posts.edit', $post)
            ]);
        }
    }

    public static function notifyPostFeatured($post, $admin)
    {
        if ($post->author_type === 'user' && $post->user) {
            self::create([
                'type' => 'post_featured',
                'title' => 'Post Featured',
                'message' => "Your post '{$post->title}' has been featured",
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name
                ],
                'recipient_type' => 'user',
                'recipient_id' => $post->user_id,
                'sender_type' => 'admin',
                'sender_id' => $admin->id,
                'action_url' => route('post.show', $post->slug)
            ]);
        }
    }

    public static function notifyPostUnfeatured($post, $admin)
    {
        if ($post->author_type === 'user' && $post->user) {
            self::create([
                'type' => 'post_unfeatured',
                'title' => 'Post Unfeatured',
                'message' => "Your post '{$post->title}' has been unfeatured",
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'post_slug' => $post->slug,
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name
                ],
                'recipient_type' => 'user',
                'recipient_id' => $post->user_id,
                'sender_type' => 'admin',
                'sender_id' => $admin->id,
                'action_url' => route('post.show', $post->slug)
            ]);
        }
    }
}
