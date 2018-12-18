<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login');
        }

        if (Auth::user()->role == "admin") {
//            return 'hihii';
            return $next($request);
//
        } else
            return redirect()->route('index');
//            return redirect()->route('admin.home');

    }
}
