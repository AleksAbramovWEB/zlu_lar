<?php

namespace App\Http\Controllers\Connexion\Messenger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Connexion\Messenger\NewMessageRequest;
use App\Models\Connexion\Messenger\Messages;
use App\Models\Connexion\Messenger\PhotoSend;
use App\Repositories\Connexion\Messenger\MessengerContactsRepository;
use App\Repositories\Connexion\Messenger\MessengerMessagesRepository;
use App\Repositories\Connexion\Messenger\MessengerPhotosRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class MessagesController extends MessengerBaseController
{


    /**
     * показать контакт с сообщениями.
     *
     * @param integer                     $id
     * @param MessengerContactsRepository $contactsRepository
     * @param MessengerMessagesRepository $messagesRepository
     * @param MessengerPhotosRepository   $photosRepository
     *
     * @return void
     */
    public function show_contact_with_massages(
        $id,
        MessengerContactsRepository $contactsRepository,
        MessengerMessagesRepository $messagesRepository,
        MessengerPhotosRepository   $photosRepository
    )
    {
        $messages = [];
        $attach_photos = [];

        $contact = $contactsRepository->getContactByIdForContactView($id);
        if (empty($contact)) abort(404);

        $contact2 = $contactsRepository->getContactStdByUserId($contact->user_contact);

        if (!empty($contact2))
            $messages = $messagesRepository->GetIdContactByUserId($contact->id, $contact2->id);

        if (\Session::has('attach_photos')) // наличие прикрепленных фото
            $attach_photos = $photosRepository->getAuthUserPhotoByArrayId(\Session::get('attach_photos'));

        if (\Auth::user()->getProperty('new_messages') > 0) // перепроверяем колличество новых сообщений
            \Auth::user()->setProperty('new_messages', $messagesRepository->countNewMessages());


        return view('connexion.messenger.show_contact',
            compact('contact', 'messages', 'attach_photos'));
    }

    /**
     * Создаем новое сообщение.
     *
     * @param NewMessageRequest $request
     * @param Messages          $messages
     * @param PhotoSend         $photoSend
     * @param                   $id
     *
     * @return void
     */
    public function new_message(
        NewMessageRequest $request,
        Messages $messages,
        PhotoSend $photoSend,
        $id)
    {
        $contact_to = $request->session()->get('contact_to');
        $data = [
            'contact_from' => $id,
            'contact_to' => $contact_to,
            'message' => $request->message,
        ];
        $massage = $messages::create($data);
        $massage->save();
        $this->photoAttachToMessage($photoSend, $request->toArray(), $massage->id);

        return back();
    }

    /**
     * прикрепляем фото к сообщению записью в bd
     * @param PhotoSend $photoSend
     * @param array  $photos_id
     * @param int    $message_id
     */
    private function photoAttachToMessage(PhotoSend $photoSend, array $photos_id, int $message_id)
    {
        unset($photos_id['_token']); unset($photos_id['_method']); unset($photos_id['message']);
        if (empty($photos_id)) return;

        foreach ($photos_id as $photo_id){
            $data = ['message_id' => $message_id, 'photo_id' => $photo_id];
            $attach = $photoSend::create($data);
            $attach->save();
        }
    }


}
