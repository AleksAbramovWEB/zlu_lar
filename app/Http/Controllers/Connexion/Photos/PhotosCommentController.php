<?php

namespace App\Http\Controllers\Connexion\Photos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Connexion\Photos\NewCommentPhotoRequest;
use App\Models\Connexion\Photos\PhotosComment;
use Illuminate\Http\Request;

class PhotosCommentController extends Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('photos.comment_from_photo')->only('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PhotosComment            $photosComment
     *
     * @return void
     */
    public function store(NewCommentPhotoRequest $request, PhotosComment $photosComment)
    {
        $comment = $photosComment::create([
           'user_id' => \Auth::id(),
           'photo_id' => $request->photo_id,
           'comment' => $request->comment
        ]);
        $comment->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param                                            $id
     * @param \App\Models\Connexion\Photos\PhotosComment $photosComment
     *
     * @return void
     */
    public function destroy($id ,PhotosComment $photosComment)
    {
        $comment = $photosComment->find($id);
        if ($comment->to_user_id->id == \Auth::id() OR $comment->to_photo_id->user_id == \Auth::id())
            $comment->delete();

        return back();
    }
}
