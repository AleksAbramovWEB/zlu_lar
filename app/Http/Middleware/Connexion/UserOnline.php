<?php

namespace App\Http\Middleware\Connexion;

use Carbon\Carbon;
use Closure;

class UserOnline
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
        if (\Auth::check()){
            $user = \Auth::user();
            $user->timestamps = false;
            $user->update(['last_time' => Carbon::now()->toDateTimeString()]);
        }
        return $next($request);
    }
}
