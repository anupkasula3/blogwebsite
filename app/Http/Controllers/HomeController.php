<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function __construct()
    {
        // Share categories with all views
        $categories = Category::withCount('posts')
            ->where('is_active', true)
            ->orderBy('posts_count', 'desc')
            ->take(8)
            ->get();

        view()->share('categories', $categories);
    }

    public function index()
    {
        $featuredPosts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        $editorsPick = Post::with(['category', 'user', 'admin'])
            ->published()
            ->where('is_editors_pick', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $techReviews = Post::with(['category', 'user', 'admin'])
            ->published()
            ->whereHas('category', function($q) {
                $q->where('name', 'like', '%review%');
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        $mustRead = Post::with(['category', 'user', 'admin'])
            ->published()
            ->orderBy('views_count', 'desc')
            ->take(3)
            ->get();

        $latestPosts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->latest('published_at')
            ->take(8)
            ->get();

        $popularPosts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $categories = Category::withCount('posts')
            ->where('is_active', true)
            ->orderBy('posts_count', 'desc')
            ->take(8)
            ->get();

        $categoriesWithPosts = Category::where('is_active', true)
            ->with(['posts' => function($q) {
                $q->published()->latest('published_at')->take(3);
            }])
            ->get()
            ->sortByDesc(function($category) {
                return $category->posts->sum('views_count');
            });

        // Advertisements for different positions
        $headerAd = Advertisement::active()->byPosition('header')->first();

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();
        $footerAd = Advertisement::active()->byPosition('footer')->first();
        $contentAd = Advertisement::active()->byPosition('content')->first();

        return view('frontend.homepage.home', compact(
            'featuredPosts',
            'editorsPick',
            'techReviews',
            'mustRead',
            'latestPosts',
            'popularPosts',
            'categories',
            'categoriesWithPosts',
            'headerAd',
            'sidebarAd',
            'footerAd',
            'contentAd'
        ));
    }

    public function category(Category $category)
    {
        $posts = Post::with(['category', 'user', 'admin'])
            ->where('category_id', $category->id)
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.category.show', compact('category', 'posts', 'sidebarAd'));
    }

    public function post(Post $post)
    {
        // Check if the post is published and approved
        if ($post->status !== 'published' || !$post->is_approved || $post->published_at > now()) {
            abort(404);
        }

        // Load the post with relationships
        $post->load(['category', 'user', 'admin']);

        // Increment view count
        $post->increment('views_count');

        $relatedPosts = Post::with(['category', 'user', 'admin'])
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest('published_at')
            ->take(4)
            ->get();

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.post.show', compact('post', 'relatedPosts', 'sidebarAd'));
    }

    public function categories()
    {
        $categories = Category::withCount('posts')
            ->where('is_active', true)
            ->orderBy('posts_count', 'desc')
            ->paginate(20);

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.categories.index', compact('categories', 'sidebarAd'));
    }

    public function latest()
    {
        $posts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.latest', compact('posts', 'sidebarAd'));
    }

    public function popular()
    {
        $posts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->orderBy('views_count', 'desc')
            ->paginate(12);

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.popular', compact('posts', 'sidebarAd'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('home');
        }

        $posts = Post::with(['category', 'user', 'admin'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orWhere('excerpt', 'like', "%{$query}%")
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.search', compact('posts', 'query', 'sidebarAd'));
    }

    public function author(User $user)
    {
        $posts = Post::with(['category'])
            ->where('user_id', $user->id)
            ->published()
            ->latest('published_at')
            ->paginate(12);

        $sidebarAd = Advertisement::active()->byPosition('sidebar')->first();

        return view('frontend.author.show', compact('user', 'posts', 'sidebarAd'));
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ]);

        // You can create a NewsletterSubscriber model and table if needed
        // For now, we'll just return a success message
        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!'
        ]);
    }

    public function trackAdClick(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:advertisements,id',
            'position' => 'required|string'
        ]);

        $ad = Advertisement::find($request->ad_id);
        $ad->increment('clicks_count');

        return response()->json(['success' => true]);
    }

    public function trackAdImpression(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:advertisements,id',
            'position' => 'required|string'
        ]);

        $ad = Advertisement::find($request->ad_id);
        $ad->increment('impressions_count');

        return response()->json(['success' => true]);
    }

    public function feed()
    {
        $posts = Post::with(['category', 'user'])
            ->published()
            ->latest('published_at')
            ->take(20)
            ->get();

        $content = view('frontend.feed', compact('posts'))->render();

        return Response::make($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8'
        ]);
    }

    public function sitemap()
    {
        $posts = Post::published()->get();
        $categories = Category::where('is_active', true)->get();

        $content = view('frontend.sitemap', compact('posts', 'categories'))->render();

        return Response::make($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8'
        ]);
    }
}
