<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if (Auth::user()->profile->profileable_type == App\Admin::class) {
            return $next($request);
        } else {
            return redirect('/posts')->with('warning', 'You cannot perform this action! You are not an admin.');
        }
    }
}
