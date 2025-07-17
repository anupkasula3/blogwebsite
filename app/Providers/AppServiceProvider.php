<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Make categories available in all frontend layout views
        View::composer(['frontend.layout.header', 'frontend.layout.footer'], function ($view) {
            $view->with('categories', Category::where('is_active', true)->orderBy('name')->get());
        });
    }
}
