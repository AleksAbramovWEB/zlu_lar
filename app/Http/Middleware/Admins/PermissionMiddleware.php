<?php

namespace App\Http\Middleware\Admins;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param                          $permission
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!\Auth::check())
            abort(404);

        if($permission !== null && !\Auth::user()->can($permission))
            abort(403);

        return $next($request);
    }
}
