<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App;

class DetectLang
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->has('lang') && in_array(trim($request->get('lang')), ['en','ka'])) {
            Session::put('lang', trim($request->get('lang')));
            App::setLocale(trim($request->get('lang')));
        }
        else{
            $setLang = !Session::has('lang') ? 'en' : Session::get('lang');
            App::setLocale($setLang);
        }

        return $next($request);
    }
}
