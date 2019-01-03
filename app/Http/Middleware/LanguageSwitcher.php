<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Config;

class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {

        // Make sure current locale exists.
        if (Session::has('locale')) :
            //Get locale from session driver
            $locale = $request->session()->get('locale');
        else :
            //Default locale from config 
            $locale = Config::get('app.locale');
        endif;

        \App::setLocale( $locale );

        return $next($request);
    }

  
}
