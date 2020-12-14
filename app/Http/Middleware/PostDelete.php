<?php

namespace App\Http\Middleware;

use Closure;

class PostDelete
{
    /**
     * Checks if the current signed in user should be able to delete a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
