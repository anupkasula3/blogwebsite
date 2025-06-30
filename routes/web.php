<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes (Laravel Breeze/Jetstream)
require __DIR__.'/auth.php';

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/post/{post:slug}', [HomeController::class, 'post'])->name('post.show');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories.index');
Route::get('/latest', [HomeController::class, 'latest'])->name('latest');
Route::get('/popular', [HomeController::class, 'popular'])->name('popular');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/author/{user:name}', [HomeController::class, 'author'])->name('author.show');

// Static Pages
Route::get('/about', function () {
    return view('frontend.pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('frontend.pages.contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/privacy', function () {
    return view('frontend.pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('frontend.pages.terms');
})->name('terms');

Route::get('/cookies', function () {
    return view('frontend.pages.cookies');
})->name('cookies');

Route::get('/sitemap', function () {
    return view('frontend.pages.sitemap');
})->name('sitemap');

Route::get('/404', function () {
    return view('frontend.pages.404');
})->name('404');

// Newsletter
Route::post('/newsletter/subscribe', [HomeController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

// Advertisement Tracking
Route::post('/track-ad-click', [HomeController::class, 'trackAdClick'])->name('track.ad.click');
Route::post('/track-ad-impression', [HomeController::class, 'trackAdImpression'])->name('track.ad.impression');

// User Profile (Frontend)
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('frontend.profile');
    })->name('profile');
});

// User Dashboard Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/posts', [UserDashboardController::class, 'posts'])->name('posts.index');
    Route::get('/posts/create', [UserDashboardController::class, 'createPost'])->name('posts.create');
    Route::post('/posts', [UserDashboardController::class, 'storePost'])->name('posts.store');
    Route::get('/posts/{post}/edit', [UserDashboardController::class, 'editPost'])->name('posts.edit');
    Route::put('/posts/{post}', [UserDashboardController::class, 'updatePost'])->name('posts.update');
    Route::delete('/posts/{post}', [UserDashboardController::class, 'deletePost'])->name('posts.destroy');
    Route::get('/posts/{post}', [UserDashboardController::class, 'showPost'])->name('posts.show');
    Route::post('/posts/{post}/publish', [UserDashboardController::class, 'publishPost'])->name('posts.publish');
    Route::post('/posts/{post}/draft', [UserDashboardController::class, 'draftPost'])->name('posts.draft');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [UserDashboardController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::put('/password', [UserDashboardController::class, 'changePassword'])->name('password.change');
    Route::get('/analytics', [UserDashboardController::class, 'analytics'])->name('analytics');

    // User Notifications
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/notifications/{notification}/redirect', [\App\Http\Controllers\NotificationController::class, 'redirectToAction'])->name('notifications.redirect');
});

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');

    // Categories
    Route::resource('categories', CategoryController::class);

    // User Posts (separate controller, no create/store)
    Route::resource('userposts', \App\Http\Controllers\Admin\UserPostController::class)->parameters(['userposts' => 'post']);
    Route::post('/userposts/{post}/publish', [\App\Http\Controllers\Admin\UserPostController::class, 'publish'])->name('userposts.publish');
    Route::post('/userposts/{post}/unpublish', [\App\Http\Controllers\Admin\UserPostController::class, 'unpublish'])->name('userposts.unpublish');
    Route::post('/userposts/{post}/feature', [\App\Http\Controllers\Admin\UserPostController::class, 'feature'])->name('userposts.feature');
    Route::post('/userposts/{post}/unfeature', [\App\Http\Controllers\Admin\UserPostController::class, 'unfeature'])->name('userposts.unfeature');
    Route::post('/userposts/{post}/approve', [\App\Http\Controllers\Admin\UserPostController::class, 'approve'])->name('userposts.approve');
    Route::post('/userposts/{post}/reject', [\App\Http\Controllers\Admin\UserPostController::class, 'reject'])->name('userposts.reject');

    // Posts (admin-created)
    Route::resource('posts', PostController::class);
    Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
    Route::post('/posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
    Route::post('/posts/{post}/feature', [PostController::class, 'feature'])->name('posts.feature');
    Route::post('/posts/{post}/unfeature', [PostController::class, 'unfeature'])->name('posts.unfeature');
    Route::post('/posts/{post}/approve', [PostController::class, 'approve'])->name('posts.approve');
    Route::post('/posts/{post}/reject', [PostController::class, 'reject'])->name('posts.reject');

    // Advertisements
    Route::resource('advertisements', AdvertisementController::class);
    Route::post('/advertisements/{advertisement}/activate', [AdvertisementController::class, 'activate'])->name('advertisements.activate');
    Route::post('/advertisements/{advertisement}/deactivate', [AdvertisementController::class, 'deactivate'])->name('advertisements.deactivate');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/clear-cache', [SettingController::class, 'clearCache'])->name('settings.clear-cache');
    Route::post('/settings/backup', [SettingController::class, 'backup'])->name('settings.backup');

    // User Management
    Route::resource('users', UserController::class);
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/pending-posts', [UserController::class, 'pendingPosts'])->name('users.pending-posts');
    Route::post('/users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
    Route::post('/users/{user}/unverify', [UserController::class, 'unverify'])->name('users.unverify');

    // Admin Notifications
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/notifications/{notification}/redirect', [\App\Http\Controllers\NotificationController::class, 'redirectToAction'])->name('notifications.redirect');

    // Dashboard Stats
    Route::get('/stats', function () {
        return view('admin.stats');
    })->name('stats');
});

// API Routes for AJAX requests
Route::prefix('api')->group(function () {
    Route::get('/categories', function () {
        return App\Models\Category::where('is_active', true)->get();
    });

    Route::get('/posts/recent', function () {
        return App\Models\Post::with(['category', 'user'])
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();
    });

    Route::get('/posts/popular', function () {
        return App\Models\Post::with(['category', 'user'])
            ->published()
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();
    });

    Route::get('/settings', function () {
        return App\Models\Setting::all()->pluck('value', 'key');
    });

    Route::get('/search', function (Request $request) {
        $query = $request->get('q');
        return App\Models\Post::with(['category', 'user'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->published()
            ->latest('published_at')
            ->take(10)
            ->get();
    });

    // Notification API routes
    Route::get('/notifications/unread-count', [\App\Http\Controllers\NotificationController::class, 'getUnreadCount']);
    Route::get('/notifications/latest', [\App\Http\Controllers\NotificationController::class, 'getLatestNotifications']);
});

// RSS Feed
Route::get('/feed', [HomeController::class, 'feed'])->name('feed');

// Sitemap
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap.xml');

// Fallback route for 404
Route::fallback(function () {
    return view('frontend.pages.404');
});
