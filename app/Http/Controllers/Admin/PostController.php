<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\FileService\ImageService;

class PostController extends Controller
{
    public function __construct(
        protected ImageService $imageService

    ) {}
    public function index()
    {
        $posts = Post::with(['category', 'user', 'admin'])
            ->where('author_type', 'admin') // Only show admin posts
            ->latest()
            ->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255|unique:posts,title',
                'content' => 'required|string',
                'excerpt' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_published' => 'required|in:0,1',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string|max:255',
                'is_featured' => 'boolean',
            ]);

            $data = $request->all();
            $data['slug'] = Str::slug($request->title);

            // Set admin as author since this is admin panel
            $data['author_type'] = 'admin';
            $data['admin_id'] = auth('admin')->id(); // Use admin guard
            $data['user_id'] = null; // Admin posts don't have user_id

            $data['status'] = $request->is_published ? 'published' : 'draft';
            $data['published_at'] = $request->is_published ? now() : null;
            $data['is_featured'] = $request->has('is_featured');
            $data['is_approved'] = true; // Admin posts are auto-approved

            // Handle featured image
            if ($request->hasFile('featured_image')) {
                $imagePath = $this->imageService->fileUpload($request->featured_image, "post");
                // $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
                $data['featured_image'] = $imagePath;
            }

            $post = Post::create($data);

            return redirect()->route('admin.posts.index')
                ->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            \Log::error('Post creation error: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create post. Please try again.',$e->getMessage()  ]);
        }
    }

    public function show(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);
        $post->load(['category', 'user', 'admin']);
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);
        $categories = Category::where('is_active', true)->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'status' => 'required|in:draft,published',
          'is_published' => 'required|in:0,1',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url',
            'schema_markup' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_approved'] = $request->has('is_approved');

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                $this->imageService->imageDelete($post->featured_image);
            }
            $imagePath = $this->imageService->fileUpload($request->featured_image, "post");
            $data['featured_image'] = $imagePath;
        }

        // Handle OG image
        if ($request->hasFile('og_image')) {
            if ($post->og_image) {
                $this->imageService->imageDelete($post->og_image);
            }
            $ogimagepath = $this->imageService->fileUpload($request->og_image, "ogimage");
            $data['og_image'] = $ogimagepath;
        }

        // Handle Twitter image
        if ($request->hasFile('twitter_image')) {
            if ($post->twitter_image) {
                $this->imageService->imageDelete($post->twitter_image);
            }
            $twitterimagepath = $this->imageService->fileUpload($request->twitter_image, "twitterimage");
            $data['twitter_image'] = $twitterimagepath;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        // Delete associated images
        if ($post->featured_image) {
            $this->imageService->imageDelete($post->featured_image);
        }
        if ($post->og_image) {
            $this->imageService->imageDelete($post->og_image);
        }
        if ($post->twitter_image) {
            $this->imageService->imageDelete($post->twitter_image);
        }

        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    public function publish(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $post->update([
            'status' => 'published',
            'published_at' => now(),
            'is_approved' => true
        ]);

        return redirect()->back()
            ->with('success', 'Post published successfully!');
    }

    public function unpublish(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $post->update([
            'status' => 'draft',
            'published_at' => null
        ]);

        return redirect()->back()
            ->with('success', 'Post unpublished successfully!');
    }

    public function feature(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $post->update(['is_featured' => true]);

        return redirect()->back()
            ->with('success', 'Post featured successfully!');
    }

    public function unfeature(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $post->update(['is_featured' => false]);

        return redirect()->back()
            ->with('success', 'Post unfeatured successfully!');
    }

    public function approve(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $post->update(['is_approved' => true]);

        return redirect()->back()
            ->with('success', 'Post approved successfully!');
    }

    public function reject(Post $post)
    {
        if ($post->author_type !== 'admin') abort(404);

        $post->update(['is_approved' => false]);

        return redirect()->back()
            ->with('success', 'Post rejected successfully!');
    }
}
