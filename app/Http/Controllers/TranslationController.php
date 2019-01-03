<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;

class TranslationController extends Controller
{
    /**
         * Locale switcher
         *
         * @param Request $request
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
    // public function switchLocale(Request $request) {

    //     if (!empty($request->language)) {
    //         Session::put('locale', $request->language);
    //     }
    //     return redirect($request->header("referer"));
    //     return redirect::back();
    // }

    public function index() {

        $input = Input::get('locale');

        $currentLocale = session('locale');

        session(['locale' => $input ]);

        // if(! $currentLocale ) {

        //     //session(['locale' => $input ]);
        //     session('locale', Config::get('app.locale'));

        // } else {

        //     //Session::put('locale', Input::get('locale'));

        //     session(['locale' => $input ]);

        // }

        return Redirect::back();
    }

}

// if(!Session::has('locale')) {

//     Session::put('locale', Input::get('locale'));

// } else {

//     //Session::put('locale', Input::get('locale'));

//     session(['locale' => Input::get('locale')]);

// }