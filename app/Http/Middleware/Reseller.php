<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;

class Reseller
{
    
    public function handle($request, Closure $next, $guard = 'reseller')
    {
        if (Session::has('reseller')){
             return $next($request);
        }
        if (Auth::guard($guard)->guest()) {

          
            return redirect()->route('reseller.login.view');

            
        }
        return $next($request);
    }

}
