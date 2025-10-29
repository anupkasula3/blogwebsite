<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Post;
use App\Models\Category;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Quote;

class HomeController extends Controller
{
    private function getSubcategoryIds(Category $category, &$categoryIds)
    {
        foreach ($category->children as $child) {
            $categoryIds->push($child->id);
            $this->getSubcategoryIds($child, $categoryIds);
        }
    }

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
        $mainblog = Post::with(['category', 'user', 'admin'])
            ->published()
            ->featured()
            ->latest('published_at');

        $featuredPosts = $mainblog->take(3)->get();

        $editorsPick = Post::with(['category', 'user', 'admin'])
            ->published()
            ->where('is_editors_pick', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $techReviews = Post::with(['category', 'user', 'admin'])
            ->published()
            ->whereHas('category', function ($q) {
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
            ->featured()
            ->latest('published_at')
            ->take(8)
            ->get();

        $popularPosts = Post::with(['category', 'user', 'admin'])
            ->where('is_featured', 0)
            ->published()
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $categories = Category::withCount('posts')
            ->where('is_active', true)
            ->orderBy('posts_count', 'desc')
            ->take(8)
            ->get();

        // Get categories ordered by post count
        $categoriesWithPosts = Category::where('is_active', true)
            ->withCount([
                'posts' => function ($q) {
                    $q->published();
                }
            ])
            // ->load(['parent', 'children'])
            ->orderBy('posts_count', 'desc')
            ->get();

        // Load the latest posts for each category and its subcategories
        $categoriesWithPosts->each(function ($category) {
            // Get all subcategory IDs
            $categoryIds = collect([$category->id]);
            $subcategories = Category::where('parent_id', $category->id)->get();
            $categoryIds = $categoryIds->merge($subcategories->pluck('id'));

            // Get posts from both main category and subcategories
            $category->latest_posts = Post::whereIn('category_id', $categoryIds)
                ->where('is_featured', 0)
                ->published()
                ->latest('published_at')
                ->take(8)
                ->get();
        });



        // Fetch two random quotes from the database
        $quotes = Quote::inRandomOrder()->take(2)->pluck('quote');
        $randomQuote = $quotes->get(0) ?? null;
        $randomQuote2 = $quotes->get(1) ?? null;

        $banners = Banner::first();

        // Stories: group latest posts into chunks of 3
        $storyPosts = Post::with(['category'])
            ->published()
            ->where('story', true)
            ->latest('updated_at')
            ->take(24)
            ->get();
        $storyGroups = $storyPosts->chunk(3);

        return view('frontend.homepage.home', compact(
            'featuredPosts',
            'editorsPick',
            'techReviews',
            'mustRead',
            'latestPosts',
            'popularPosts',
            'categories',
            'categoriesWithPosts',
            'randomQuote',
            'randomQuote2',
            'banners',
            'storyGroups'
        ));
    }

    public function category(Category $category)
    {
        // Eager-load parent for breadcrumb and children for subcategory handling
        $category->load(['parent', 'children']);
        // Load published posts count for stats
        $category->loadCount([
            'posts' => function ($q) {
                $q->published();
            }
        ]);

        // Get all category IDs based on whether this is a parent or child category
        if (!$category->parent_id) {
            // For main category, get all subcategory IDs recursively
            $categoryIds = collect([$category->id]);
            $this->getSubcategoryIds($category, $categoryIds);

            $posts = Post::with(['category', 'user', 'admin'])
                ->whereIn('category_id', $categoryIds)
                ->published()
                ->latest('published_at')
                ->paginate(12);
        } else {
            // For subcategory, only show its own posts
            $posts = Post::with(['category', 'user', 'admin'])
                ->where('category_id', $category->id)
                ->published()
                ->latest('published_at')
                ->paginate(12);
        }

        // Load active child categories with published posts count for the UI
        $childCategories = $category->children()
            ->where('is_active', true)
            ->withCount([
                'posts' => function ($q) {
                    $q->published();
                }
            ])
            ->orderBy('posts_count', 'desc')
            ->get();

        // Aggregate total views for all published posts in this category
        $totalViews = Post::where('category_id', $category->id)
            ->published()
            ->sum('views_count');

        return view('frontend.category.show', compact('category', 'posts', 'childCategories', 'totalViews'));
    }

    public function post($post)
    {
        $posts = Post::where('url_slug', $post)->first();
        if (!$posts) {
            $posts = Post::where('slug', $post)->first();
        }
        if (!$posts) {
            abort(404);
        }
        // Check if the post is published and approved
        if ($posts->status !== 'published' || !$posts->is_approved || $posts->published_at > now()) {
            abort(404);
        }

        // Load the post with relationships
        $posts->load(['category', 'user', 'admin']);

        // Increment view count
        $posts->increment('views_count');

        $relatedPosts = Post::with(['category', 'user', 'admin'])
            ->where('category_id', $posts->category_id)
            ->where('id', '!=', $posts->id)
            ->published()
            ->latest('published_at')
            ->take(4)
            ->get();


        $post = $posts;
        // dd($posts);

        return view('frontend.post.show', compact('post', 'relatedPosts'));
    }

    public function categories()
    {
        $categories = Category::withCount('posts')
            ->where('is_active', true)
            ->orderBy('posts_count', 'desc')
            ->paginate(20);



        return view('frontend.categories.index', compact('categories'));
    }

    public function latest()
    {
        $posts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->paginate(12);



        return view('frontend.latest', compact('posts'));
    }

    public function popular()
    {
        $posts = Post::with(['category', 'user', 'admin'])
            ->published()
            ->orderBy('views_count', 'desc')
            ->paginate(12);



        return view('frontend.popular', compact('posts'));
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



        return view('frontend.search', compact('posts', 'query'));
    }

    public function author(User $user)
    {
        $posts = Post::with(['category'])
            ->where('user_id', $user->id)
            ->published()
            ->latest('published_at')
            ->paginate(12);



        return view('frontend.author.show', compact('user', 'posts'));
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

    public function allPosts()
    {
        $posts = Post::with(['category', 'user'])
            ->published()
            ->latest('published_at')
            ->paginate(25);



        return view('frontend.all-posts', compact('posts'));
    }
}
