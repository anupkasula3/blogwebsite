<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\Admin;
use App\Models\User;
use App\Models\Post;

class NotificationTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::first();
        $user = User::first();
        $post = Post::where('author_type', 'user')->first();

        if (!$admin || !$user || !$post) {
            $this->command->info('Required models not found. Please run other seeders first.');
            return;
        }

        // Create sample notifications for admin
        Notification::create([
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
            'action_url' => route('admin.userposts.show', $post),
            'is_read' => false
        ]);

        // Create sample notifications for user
        Notification::create([
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
            'recipient_id' => $user->id,
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
            'action_url' => route('post.show', $post->slug),
            'is_read' => false
        ]);

        Notification::create([
            'type' => 'post_rejected',
            'title' => 'Post Rejected',
            'message' => "Your post '{$post->title}' has been rejected: Content does not meet our guidelines",
            'data' => [
                'post_id' => $post->id,
                'post_title' => $post->title,
                'post_slug' => $post->slug,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'reason' => 'Content does not meet our guidelines'
            ],
            'recipient_type' => 'user',
            'recipient_id' => $user->id,
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
            'action_url' => route('user.posts.edit', $post),
            'is_read' => true
        ]);

        $this->command->info('Sample notifications created successfully!');
    }
}
