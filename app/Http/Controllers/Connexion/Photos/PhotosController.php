<?php

namespace App\Http\Controllers\Connexion\Photos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Connexion\Photos\EditPhotoRequest;
use App\Http\Requests\Connexion\Photos\StorePhotoRequest;
use App\Models\Connexion\Photos\Photos;
use App\Repositories\Connexion\Photos\PhotoCommentsRepository;
use App\Repositories\Connexion\Photos\PhotoLikesRepository;
use App\Repositories\Connexion\Photos\PhotosRepository;
use App\Traits\S3FileWork;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    use S3FileWork;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth')->except('show');
        $this->middleware('photos.owner')->only(['edit', 'update', 'destroy']);

    }

    /**
     * Display a listing of the resource.
     * @param PhotosRepository     $photosRepository
     * @param PhotoLikesRepository $likesRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index( PhotosRepository $photosRepository)
    {
        $photos = $photosRepository->getAuthUserPhotos();
        return view('connexion.photos.photos_index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('connexion.photos.photos_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhotoRequest $request
     * @param Photos            $photos
     *
     * @return void
     */
    public function store(StorePhotoRequest $request, Photos $photos)
    {
        $path = $this->S3putImgFile($request, 'photo', 'connexion/photos');
        $photos->create([
            'user_id' => \Auth::id(),
            'path' => $path,
            'description' => $request->description
        ])->save();
        return redirect()->route('connexion.photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param                         $id
     * @param PhotosRepository        $photosRepository
     * @param PhotoLikesRepository    $likesRepository
     * @param PhotoCommentsRepository $commentsRepository
     *
     * @return void
     */
    public function show($id,
                         PhotosRepository $photosRepository,
                         PhotoLikesRepository $likesRepository,
                         PhotoCommentsRepository $commentsRepository)
    {
        $photo = $photosRepository->getPhotoById($id);
        if (empty($photo)) abort(404);

        $likes_count = $likesRepository->getCountLikesForPhoto($id);
        $my_like = $likesRepository->existsMyLikeForPhoto($id);
        $comments = $commentsRepository->getCommentsForPhoto($id);

        return view('connexion.photos.photos_show', compact('photo', 'likes_count', 'my_like', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param                  $id
     * @param PhotosRepository $photosRepository
     * @return void
     */
    public function edit($id, PhotosRepository $photosRepository)
    {
        $photo = $photosRepository->getPhotoById($id);
        return view('connexion.photos.photos_edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditPhotoRequest                    $request
     * @param \App\Models\Connexion\Photos\Photos $photos
     * @param                                     $id
     *
     * @return void
     */
    public function update(EditPhotoRequest $request, Photos $photos, $id)
    {
        $photo = $photos->find($id);
        $photo->description = $request->description;
        if($photo->isDirty()) $photo->save();
        return redirect()->route('connexion.photos.show', $photo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Connexion\Photos\Photos $photos
     * @param                                     $id
     *
     * @return void
     */
    public function destroy(Photos $photos, $id)
    {
        $photo = $photos->find($id);
        $this->S3removeFile($photo->path);
        $photo->delete();
        return redirect()->route('connexion.photos.index', $photo);
    }
}
