<?php

namespace App\Http\Controllers\Connexion\Photos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Connexion\Photos\LikePhotoRequest;
use App\Models\Connexion\Photos\PhotosLikes;
use App\Repositories\Connexion\Photos\PhotoLikesRepository;
use Illuminate\Http\Request;

class PhotosLikesController extends Controller
{

    public function like(
        LikePhotoRequest $request,
        PhotoLikesRepository $likesRepository,
        PhotosLikes $likes)
    {
        $this->middleware('auth');

        $photo_id = $request->photo_id;
        $like = $likesRepository->getUserLikeForPhoto($photo_id);

        if (empty($like))  $likes::create([
            'user_id' => \Auth::id(),
            'photo_id' => $photo_id
        ]);
        else $like->delete();

        $countLikes['count'] = $likesRepository->getCountLikesForPhoto($photo_id);

        return response()->json($countLikes);

    }
}
