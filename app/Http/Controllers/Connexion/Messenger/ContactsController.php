<?php

namespace App\Http\Controllers\Connexion\Messenger;

use App\Http\Requests\Connexion\Messenger\NewContactRequest as NewContactRequestAlias;
use App\Models\Connexion\Messenger\Contacts;
use App\Repositories\Connexion\Messenger\MessengerContactsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactsController extends MessengerBaseController
{




    /**
     * Создание нового диалога.
     * @param NewContactRequestAlias $request
     * @param Contacts               $contacts
     * @return void
     */
    public function new_contact(NewContactRequestAlias $request, Contacts $contacts)
    {
        $data = [
            'user_id' => \Auth::id(),
            'user_contact' => $request->user_id,
            'user_creator' => \Auth::id(),
            'category' => 'main_list',
            'created_at' => Carbon::now()->toDateTimeString()
        ];
        $contacts_id =  $contacts->insertGetId($data);

       return redirect()->route('connexion.messenger.show_contact', ['id' => $contacts_id]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Connexion\Messenger\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Connexion\Messenger\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Connexion\Messenger\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contacts)
    {
        //
    }
}
