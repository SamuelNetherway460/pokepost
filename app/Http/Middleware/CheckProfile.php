<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfile
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
        if (Auth::user()->profile != null)
        {
            return $next($request);
        }
        else
        {
            // TODO - Redirect to the create profile view instead
            return response("You must make a profile first!");
        }
    }
}
