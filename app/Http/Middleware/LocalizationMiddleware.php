<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', 'en');
        Session::put('locate',$locale);
        App::setLocale($locale);

        return $next($request);
    }
}
