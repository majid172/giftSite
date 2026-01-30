<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\RateLimiter::for('user-limit', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(10)->by($request->user()?->id ?: $request->ip());
        });

        // Load dynamic settings into config
        try {
            $maxSize = get_setting('media_max_size', 2048);
            config(['settings.media_max_size' => $maxSize]);
        } catch (\Exception $e) {
            // Failsafe if DB not ready or helpers not loaded
        }
    }
}
