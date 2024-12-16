<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;


class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->singleton('twilio', function () {
            return new Client(
                config('twilio.sid'),
                config('twilio.auth_token')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        // View::share('permissions', getAdminPermissions());
    }
}
