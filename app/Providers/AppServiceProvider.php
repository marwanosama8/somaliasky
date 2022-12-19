<?php

namespace App\Providers;


use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // \App\Models\ContactReply::observe(\App\Observers\ContactReplyObserver::class);
        // \App\Models\Contact::observe(\App\Observers\ContactObserver::class);
        // request()->ip();
\Illuminate\Support\Facades\URL::forceScheme('https');

        Paginator::useBootstrapFive();
        Schema::defaultStringLength(191);
        if (Schema::hasTable('settings')) {
            $settings = \App\Models\Setting::count();
            if ($settings == 0)
                \App\Models\Setting::create([
                    'website_name' => "اسم الموقع هنا",
                    'website_bio' => "نبذة عن الموقع",
                    'main_color' => "#722f37",
                    'hover_color' => "#383838",
                ]);
            $settings = \App\Models\Setting::first();
            View::share('settings', $settings);
        }
        \Spatie\Flash\Flash::levels([
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);
    }
}
