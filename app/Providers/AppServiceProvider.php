<?php

namespace App\Providers;

use App\Models\Juragan;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['user.partials.navbar', 'user.partials.footer', 'layouts.sidebar'], function ($view) {
            $dataWebsite = Juragan::latest()->first();
            $view->with('dataWebsite', $dataWebsite);
        });
    }
}
