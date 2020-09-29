<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->username == 'Author')
        {
            return $next($request);
        }
        else {
            return redirect('/home')->with('status', 'You Are Not Allowed To Access The Author About Page');
        }
        //return $next($request);
    }
}
