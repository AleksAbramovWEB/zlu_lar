<?php

namespace App\Http\Middleware\Admins;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param                          $role
     * @param null                     $permission
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (!\Auth::check())
            abort(404);

        if(!\Auth::user()->hasRole($role))
            abort(403);

        if($permission !== null && !\Auth::user()->can($permission))
            abort(403);

        return $next($request);
    }
}
