<?php

namespace App\Http\Middleware\Connexion\Photos;

use App\Repositories\Connexion\Photos\PhotosRepository;
use Closure;

class OwnerPhoto
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('photo');
        $bool = (new PhotosRepository())->existOwnerPhotoById($id);

        if(!$bool) abort(404);

        return $next($request);
    }
}
