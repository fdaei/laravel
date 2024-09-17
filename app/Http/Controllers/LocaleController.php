<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocate($lang)
    {
        $availableLocales = ['en', 'es', 'fa'];
        if (in_array($lang, $availableLocales)) {
            Session::put('locale', $lang);
            App::setLocale($lang);
        }

        return redirect()->back();
    }
}
