<?php

namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


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
        
        Blade::if('anycan', function (...$permissions) {
            $user = Auth::guard('admin')->user();
            foreach ($permissions as $permission) {
                if ($user && $user->can($permission)) {
                    return true;
                }
            }
            return false;
        });

        view()->composer('*', function ($view) {
            $wishlistCount = 0;
            if (Auth::guard('web')->check()) {
                $wishlistCount = Wishlist::where('user_id', Auth::guard('web')->id())->count();
            }
            $view->with('wishlistCount', $wishlistCount);
        });


    }
}
