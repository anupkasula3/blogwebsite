<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_posts' => $user->total_posts_count,
            'approved_posts' => $user->approved_posts_count,
            'pending_posts' => $user->pending_posts_count,
            'total_views' => $user->total_views,
            'average_views' => $user->average_views,
        ];

        $recentPosts = $user->recentPosts;
        $popularPosts = $user->popularPosts;

        return view('user.dashboard.index', compact('stats', 'recentPosts', 'popularPosts'));
    }

    public function posts()
    {
        $posts = auth()->user()->posts()
            ->with(['category'])
            ->latest()
            ->paginate(10);

        return view('user.posts.index', compact('posts'));
    }

    public function createPost()
    {
        $categories = Category::where('is_active', true)->get();
        return view('user.posts.create', compact('categories'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:100',
            'excerpt' => 'nullable|string|max:300',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:300',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string|max:300',
            'twitter_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url',
            'schema_markup' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['author_type'] = 'user';
        $data['admin_id'] = null;
        $data['slug'] = \Str::slug($request->title);
        $data['status'] = 'draft';
        $data['is_approved'] = false;

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // Handle OG image
        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('posts/og', 'public');
        }

        // Handle Twitter image
        if ($request->hasFile('twitter_image')) {
            $data['twitter_image'] = $request->file('twitter_image')->store('posts/twitter', 'public');
        }

        $post = Post::create($data);

        // Notify admins about new user post
        $user = auth()->user();
        Notification::notifyUserPost($user, $post);

        return redirect()->route('user.posts.index')
            ->with('success', 'Post created successfully! It will be reviewed by admin before publishing.');
    }

    public function editPost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::where('is_active', true)->get();
        return view('user.posts.edit', compact('post', 'categories'));
    }

    public function updatePost(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:100',
            'excerpt' => 'nullable|string|max:300',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:300',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string|max:300',
            'twitter_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url',
            'schema_markup' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = \Str::slug($request->title);

        // Reset approval status when post is updated
        if ($post->is_approved) {
            $data['is_approved'] = false;
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // Handle OG image
        if ($request->hasFile('og_image')) {
            if ($post->og_image) {
                Storage::disk('public')->delete($post->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('posts/og', 'public');
        }

        // Handle Twitter image
        if ($request->hasFile('twitter_image')) {
            if ($post->twitter_image) {
                Storage::disk('public')->delete($post->twitter_image);
            }
            $data['twitter_image'] = $request->file('twitter_image')->store('posts/twitter', 'public');
        }

        $post->update($data);

        return redirect()->route('user.posts.index')
            ->with('success', 'Post updated successfully! It will be reviewed by admin before publishing.');
    }

    public function deletePost(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete associated images
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        if ($post->og_image) {
            Storage::disk('public')->delete($post->og_image);
        }
        if ($post->twitter_image) {
            Storage::disk('public')->delete($post->twitter_image);
        }

        $post->delete();

        return redirect()->route('user.posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    public function profile()
    {
        return view('user.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'bio', 'website']);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('user.profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.profile')
            ->with('success', 'Password changed successfully!');
    }

    public function analytics()
    {
        $user = auth()->user();

        $analytics = [
            'total_posts' => $user->total_posts_count,
            'approved_posts' => $user->approved_posts_count,
            'pending_posts' => $user->pending_posts_count,
            'total_views' => $user->total_views,
            'average_views' => $user->average_views,
            'popular_posts' => $user->popularPosts,
            'recent_posts' => $user->recentPosts,
        ];

        return view('user.analytics.index', compact('analytics'));
    }
}
