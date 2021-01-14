<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $base_tahfidz_url = 'http://tahfidz.sditwahdahbtg.com/';
        $mentor_updae = 'http://tahfidz.sditwahdahbtg.com/';
        View::share('base_tahfidz_url', '');

        config(['base_tahfidz_url' => $base_tahfidz_url]);
    }
}
