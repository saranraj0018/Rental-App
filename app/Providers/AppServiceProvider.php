<?php

namespace App\Providers;

use App\Models\Frontend;
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

        $setting = Frontend::where('data_keys', 'general-setting')->orderBy('created_at', 'desc')->first();
        $timing = !empty($setting['data_values']) ? json_decode($setting['data_values'], true) : [];

        View::share('timing_setting', $timing);
    }
}
