<?php

namespace App\Http\Controllers\Connexion\Messenger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Connexion\Messenger\NewMessageRequest;
use App\Models\Connexion\Messenger\Messages;
use App\Repositories\Connexion\Messenger\MessengerContactsRepository;
use App\Repositories\Connexion\Messenger\MessengerMessagesRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessagesController extends MessengerBaseController
{


    /**
     * показать контакт с сообщениями.
     *
     * @param integer                     $id
     * @param MessengerContactsRepository $contactsRepository
     * @param MessengerMessagesRepository $messagesRepository
     *
     * @return void
     */
    public function show_contact_with_massages($id,
        MessengerContactsRepository $contactsRepository,
        MessengerMessagesRepository $messagesRepository
    )
    {
        $messages = [];
        $contact = $contactsRepository->getContactByIdForContactView($id);
        if (empty($contact)) abort(404);

        $contact2 = $contactsRepository->getContactStdByUserId($contact->user_contact);
        if (!empty($contact2))
        $messages = $messagesRepository->GetIdContactByUserId($contact->id, $contact2->id);

        return view('connexion.messenger.show_contact', compact('contact', 'messages'));
    }

    /**
     * Создаем новое сообщение.
     *
     * @param NewMessageRequest $request
     * @param Messages          $messages
     * @param                   $id
     *
     * @return void
     */
    public function new_message(NewMessageRequest $request, Messages $messages, $id)
    {
        $contact_to = $request->session()->get('contact_to');
        $data = [
            'contact_from' => $id,
            'contact_to' => $contact_to,
            'message' => $request->message,
            'created_at' => Carbon::now()->toDateTimeString()
        ];
        $messages->insert($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Connexion\Messenger\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Connexion\Messenger\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Connexion\Messenger\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Connexion\Messenger\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
