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


        // Load dynamic settings into config
        try {
            $maxSize = get_setting('media_max_size', 2048);
            config(['settings.media_max_size' => $maxSize]);
        } catch (\Exception $e) {
            // Failsafe if DB not ready or helpers not loaded
        }
    }
}
