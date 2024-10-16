<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ModeratorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isModerator()) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
