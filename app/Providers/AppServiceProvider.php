<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Remove data from json obj
        Resource::withoutWrapping();

        view()->composer('*', function ($view) {
            $current_route_name = \Request::route()->getName();
            $view->with('current_route_name', $current_route_name);
        });
    
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
