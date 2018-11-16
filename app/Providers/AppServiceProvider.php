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
            $route = \Request::route();

            if($route) {
                $current_route_name = $route;
                $view->with('current_route_name', $current_route_name);
            }  
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
