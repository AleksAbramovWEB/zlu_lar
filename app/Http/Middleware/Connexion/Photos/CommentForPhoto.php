<?php

namespace App\Http\Middleware\Connexion\Photos;

use Closure;

class CommentForPhoto
{
    /**
     * проверяем откуда прищел запрос и соотвествет он фото id
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $url =  explode('/', url()->previous());
        $photoFrom = array_pop ($url);
        if ($request->photo_id != $photoFrom) return abort(404);

        return $next($request);
    }
}
