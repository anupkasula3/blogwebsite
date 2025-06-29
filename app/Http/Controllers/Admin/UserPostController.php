<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])
            ->where('author_type', 'user')
            ->latest()
            ->paginate(15);
        return view('admin.posts.userpost', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        return view('admin.posts.user-show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'excerpt' => 'nullable|string|max:255',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        $oldStatus = $post->status;
        $oldApproved = $post->is_approved;
        $oldFeatured = $post->is_featured;

        $post->update($data);

        $admin = auth()->guard('admin')->user();

        // Send notifications for status changes
        if ($oldStatus !== $post->status) {
            if ($post->status === 'published') {
                Notification::notifyPostPublished($post, $admin);
            } else {
                Notification::notifyPostUnpublished($post, $admin);
            }
        }

        if ($oldApproved !== $post->is_approved) {
            if ($post->is_approved) {
                Notification::notifyPostApproved($post, $admin);
            }
        }

        if ($oldFeatured !== $post->is_featured) {
            if ($post->is_featured) {
                Notification::notifyPostFeatured($post, $admin);
            } else {
                Notification::notifyPostUnfeatured($post, $admin);
            }
        }

        return redirect()->route('admin.userposts.index')->with('success', 'User post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $post->delete();
        return redirect()->route('admin.userposts.index')->with('success', 'User post deleted successfully!');
    }

    public function approve(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $post->update(['is_approved' => true]);

        $admin = auth()->guard('admin')->user();
        Notification::notifyPostApproved($post, $admin);

        return redirect()->back()->with('success', 'User post approved successfully!');
    }

    public function reject(Request $request, Post $post)
    {
        if ($post->author_type !== 'user') abort(404);

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $post->update(['is_approved' => false]);

        $admin = auth()->guard('admin')->user();
        Notification::notifyPostRejected($post, $admin, $request->rejection_reason);

        return redirect()->back()->with('success', 'User post rejected successfully!');
    }

    public function publish(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $post->update(['status' => 'published']);

        $admin = auth()->guard('admin')->user();
        Notification::notifyPostPublished($post, $admin);

        return redirect()->back()->with('success', 'User post published successfully!');
    }

    public function unpublish(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $post->update(['status' => 'draft']);

        $admin = auth()->guard('admin')->user();
        Notification::notifyPostUnpublished($post, $admin);

        return redirect()->back()->with('success', 'User post unpublished successfully!');
    }

    public function feature(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $post->update(['is_featured' => true]);

        $admin = auth()->guard('admin')->user();
        Notification::notifyPostFeatured($post, $admin);

        return redirect()->back()->with('success', 'User post featured successfully!');
    }

    public function unfeature(Post $post)
    {
        if ($post->author_type !== 'user') abort(404);
        $post->update(['is_featured' => false]);

        $admin = auth()->guard('admin')->user();
        Notification::notifyPostUnfeatured($post, $admin);

        return redirect()->back()->with('success', 'User post unfeatured successfully!');
    }
}
