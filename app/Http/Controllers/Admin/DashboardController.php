<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Advertisement;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get dashboard statistics
        $stats = $this->getDashboardStats();

        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        // Get pending posts
        $pendingPosts = Post::where('status', 'pending')
            ->with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Get recent user registrations
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Get popular posts
        $popularPosts = Post::published()
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentActivities',
            'pendingPosts',
            'recentUsers',
            'popularPosts'
        ));
    }

    /**
     * Get dashboard statistics.
     *
     * @return array
     */
    private function getDashboardStats()
    {
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $pendingPosts = Post::where('status', 'pending')->count();
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalAdvertisements = Advertisement::count();
        $activeAdvertisements = Advertisement::where('is_active', true)->count();

        // Posts by author type
        $adminPosts = Post::where('author_type', 'admin')->count();
        $userPosts = Post::where('author_type', 'user')->count();

        // Recent posts (last 30 days)
        $recentPosts = Post::where('created_at', '>=', now()->subDays(30))->count();

        // Recent users (last 30 days)
        $recentUsers = User::where('created_at', '>=', now()->subDays(30))->count();

        return [
            'total_posts' => $totalPosts,
            'published_posts' => $publishedPosts,
            'pending_posts' => $pendingPosts,
            'total_users' => $totalUsers,
            'total_categories' => $totalCategories,
            'total_advertisements' => $totalAdvertisements,
            'active_advertisements' => $activeAdvertisements,
            'admin_posts' => $adminPosts,
            'user_posts' => $userPosts,
            'recent_posts' => $recentPosts,
            'recent_users' => $recentUsers,
        ];
    }

    /**
     * Get recent activities for the dashboard.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getRecentActivities()
    {
        // Get recent posts
        $recentPosts = Post::with(['user', 'category'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($post) {
                return [
                    'type' => 'post',
                    'action' => $post->status === 'published' ? 'published' : 'created',
                    'title' => $post->title,
                    'author' => $post->author_name,
                    'time' => $post->created_at,
                    'url' => route('admin.posts.show', $post->id)
                ];
            });

        // Get recent user registrations
        $recentUsers = User::latest()
            ->take(10)
            ->get()
            ->map(function ($user) {
                return [
                    'type' => 'user',
                    'action' => 'registered',
                    'title' => $user->name,
                    'author' => $user->email,
                    'time' => $user->created_at,
                    'url' => route('admin.users.show', $user->id)
                ];
            });

        // Combine and sort by time
        $activities = $recentPosts->concat($recentUsers)
            ->sortByDesc('time')
            ->take(10);

        return $activities;
    }

    /**
     * Get analytics data for charts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function analytics()
    {
        // Posts per month for the last 12 months
        $postsPerMonth = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Users per month for the last 12 months
        $usersPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Posts by category
        $postsByCategory = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'posts_per_month' => $postsPerMonth,
            'users_per_month' => $usersPerMonth,
            'posts_by_category' => $postsByCategory,
        ]);
    }
}
