<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check())
        {
            if (Auth::user()->role == 'user')
            {
                return $next($request);
            }
            else
            {
                // Return a custom error response instead of redirecting
                return response()->view('home.front');
            }
        }
        else
        {
            // Return a custom error response instead of redirecting
            return response()->view('auth.login',);
        }
    }
}
