<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use App\Moderator;
use Illuminate\Support\Facades\Auth;

class CheckModerator
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
        $postUser = null;
        if ($request->post != null) {
            $postUser = $request->post->user;
        }

        if (Auth::user()->profile->profileable_type == Moderator::class) {
            return $next($request);
        } else if (Auth::user()->profile->profileable_type == Admin::class) {
            return $next($request);
        // Allow next if the user owns the post
        } else if ($postUser != null) {
            if ($postUser->id == Auth::user()->id) {
                return $next($request);
            } else {
                return redirect('/posts')->with('warning', 'You cannot perform this action! You are not a moderator.');
            }
        } else {
            return redirect('/posts')->with('warning', 'You cannot perform this action! You are not a moderator.');
        }
    }
}
