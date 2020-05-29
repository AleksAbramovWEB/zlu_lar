<?php

namespace App\Http\Middleware\Connexion\Messenger;

use Closure;

class AttachPhoto
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
        if (!\Auth::user()->hasVip() AND config('bz.attach_photo_vip') === true)
            return redirect()->route("connexion.messenger.notice", ['code' => 3])->with('notice', true);

        return $next($request);
    }
}
