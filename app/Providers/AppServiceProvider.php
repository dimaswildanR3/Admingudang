<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <- tambahkan ini
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
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
    public function boot()
    {
        // Notifikasi untuk semua view
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = Notification::where('user_id', Auth::id())
                                             ->latest()
                                             ->take(5) // ambil 5 notifikasi terbaru
                                             ->get();
                $unreadCount = $notifications->where('is_read', false)->count();
    
                $view->with('notifications', $notifications)
                     ->with('unreadCount', $unreadCount);
            }
        });
    }
}
