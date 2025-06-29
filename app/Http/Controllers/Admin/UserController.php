<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['posts', 'approvedPosts', 'pendingPosts'])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['posts' => function($query) {
            $query->with(['category'])->latest();
        }]);

        $stats = [
            'total_posts' => $user->total_posts_count,
            'approved_posts' => $user->approved_posts_count,
            'pending_posts' => $user->pending_posts_count,
            'total_views' => $user->total_views,
            'average_views' => $user->average_views,
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url',
            'is_verified' => 'boolean',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['is_verified'] = $request->has('is_verified');
        $data['email_verified_at'] = $request->has('is_verified') ? now() : null;

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url',
            'is_verified' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_verified'] = $request->has('is_verified');

        if ($request->has('is_verified') && !$user->email_verified_at) {
            $data['email_verified_at'] = now();
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Delete user's posts and associated files
        foreach ($user->posts as $post) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            if ($post->og_image) {
                Storage::disk('public')->delete($post->og_image);
            }
            if ($post->twitter_image) {
                Storage::disk('public')->delete($post->twitter_image);
            }
        }

        $user->posts()->delete();
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    public function approvePost(Post $post)
    {
        $post->update([
            'is_approved' => true,
            'status' => 'published',
            'published_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'Post approved successfully!');
    }

    public function rejectPost(Post $post)
    {
        $post->update([
            'is_approved' => false,
            'status' => 'draft'
        ]);

        return redirect()->back()
            ->with('success', 'Post rejected successfully!');
    }

    public function userPosts()
    {
        $posts = Post::with(['user', 'category'])
            ->where('user_id', '!=', auth()->id())
            ->latest()
            ->paginate(15);

        return view('admin.users.posts', compact('posts'));
    }

    public function pendingPosts()
    {
        $posts = Post::with(['user', 'category'])
            ->where('user_id', '!=', auth()->id())
            ->pending()
            ->latest()
            ->paginate(15);

        return view('admin.users.pending-posts', compact('posts'));
    }

    public function verify(User $user)
    {
        $user->update([
            'is_verified' => true,
            'email_verified_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'User verified successfully!');
    }

    public function unverify(User $user)
    {
        $user->update([
            'is_verified' => false,
            'email_verified_at' => null
        ]);

        return redirect()->back()
            ->with('success', 'User verification removed successfully!');
    }
}
