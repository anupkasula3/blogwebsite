<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;

class TestPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a category
        $category = Category::firstOrCreate([
            'name' => 'Technology',
            'slug' => 'technology'
        ], [
            'description' => 'Latest technology news and insights',
            'is_active' => true
        ]);

        // Get or create a user
        $user = User::firstOrCreate([
            'email' => 'user@example.com'
        ], [
            'name' => 'John Doe',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        // Get or create an admin
        $admin = Admin::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password')
        ]);

        // Create an admin post
        Post::create([
            'title' => 'Welcome to Our Blog Platform',
            'slug' => 'welcome-to-our-blog-platform',
            'content' => '<p>Welcome to our new blog platform! This is an official post from the administration team.</p><p>We are excited to bring you a platform where both administrators and users can share their thoughts and insights.</p>',
            'excerpt' => 'Welcome to our new blog platform! This is an official post from the administration team.',
            'category_id' => $category->id,
            'author_type' => 'admin',
            'admin_id' => $admin->id,
            'user_id' => null,
            'status' => 'published',
            'published_at' => now(),
            'is_featured' => true,
            'is_approved' => true,
            'meta_title' => 'Welcome to Our Blog Platform',
            'meta_description' => 'Welcome to our new blog platform! This is an official post from the administration team.',
            'meta_keywords' => 'blog, platform, welcome, admin'
        ]);

        // Create a user post
        Post::create([
            'title' => 'My First Blog Post',
            'slug' => 'my-first-blog-post',
            'content' => '<p>Hello everyone! This is my first blog post as a regular user.</p><p>I am excited to share my thoughts and experiences with the community.</p>',
            'excerpt' => 'Hello everyone! This is my first blog post as a regular user.',
            'category_id' => $category->id,
            'author_type' => 'user',
            'admin_id' => null,
            'user_id' => $user->id,
            'status' => 'published',
            'published_at' => now(),
            'is_featured' => false,
            'is_approved' => true,
            'meta_title' => 'My First Blog Post',
            'meta_description' => 'Hello everyone! This is my first blog post as a regular user.',
            'meta_keywords' => 'first post, user, blog'
        ]);

        $this->command->info('Test posts created successfully!');
        $this->command->info('Admin post: Welcome to Our Blog Platform');
        $this->command->info('User post: My First Blog Post');
    }
}
