<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
            if (Auth::user()->role == 'admin')
            {
                return $next($request);
            }
            else
            {
                // Return a custom error response instead of redirecting
                // return response()->view('home.front');
                // return response()->redirect('');
                return redirect('/home')->with('status', 'Access Denied! As you are not an Admin');
            }
        }
        else
        {
            // Return a custom error response instead of redirecting
            // return response()->view('auth.login',);
            return redirect('/login')->with('status', 'Please Login First');
        }
    }
}
