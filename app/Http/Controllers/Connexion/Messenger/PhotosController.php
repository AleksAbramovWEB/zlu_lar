<?php

namespace App\Http\Controllers\Connexion\Messenger;


use App\Http\Requests\Connexion\Messenger\PhotoDeleteMessengerRequest;
use App\Http\Requests\Connexion\Messenger\PhotoSaveMessengerRequest;
use App\Http\Requests\Connexion\Messenger\PhotoAttachMessengerRequest;
use App\Models\Connexion\Messenger\Photos;
use App\Repositories\Connexion\Messenger\MessengerPhotosRepository;
use App\Traits\S3FileWork;
use Illuminate\Http\Request;

class PhotosController extends MessengerBaseController
{

    use S3FileWork;

    /**
     * показ для прикрепления фото к определенному контакту
     * @param MessengerPhotosRepository $photosRepository
     * @param                           $contact_id
     * @return \Illuminate\Http\Response
     */
    public function show(MessengerPhotosRepository $photosRepository, $contact_id)
    {
        $photos = $photosRepository->getAuthUserPhotos();
        return view('connexion.messenger.photos', compact('photos', 'contact_id'));
    }


    /**
     * Store a newly created resource in storage.
     * @param PhotoSaveMessengerRequest $request
     * @param Photos                   $photos
     * @return void
     */
    public function store(PhotoSaveMessengerRequest $request, Photos $photos)
    {
        $path = $this->S3putImgFile($request, 'photo', 'connexion/messenger');
        $photos->create([
            'user_id' => \Auth::id(),
            'path' => $path
        ])->save();

        return back();
    }


    /**
     * непосредственно прикреление фото к сообщениям
     * @param PhotoAttachMessengerRequest $request
     * @param                             $contact_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach(PhotoAttachMessengerRequest $request, $contact_id)
    {
       $photos_id =  $request->input();

       unset($photos_id['_method']);unset($photos_id['_token']);

       if (empty($photos_id))
           return redirect()->route('connexion.messenger.show_contact', ['id' => $contact_id]);
       else
           return redirect()->route('connexion.messenger.show_contact', ['id' => $contact_id])
                            ->with('attach_photos', array_values($photos_id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param PhotoDeleteMessengerRequest            $request
     * @param \App\Models\Connexion\Messenger\Photos $photos
     *
     * @return void
     */
    public function destroy(PhotoDeleteMessengerRequest $request, Photos $photos)
    {
        $id = $request->remove_photo;
        $photos::where('id', $id)->delete();
        return back();
    }
}
