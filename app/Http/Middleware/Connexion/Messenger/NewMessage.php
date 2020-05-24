<?php

namespace App\Http\Middleware\Connexion\Messenger;

use App\Models\Connexion\Messenger\Contacts;
use App\Repositories\Connexion\Messenger\MessengerContactsRepository;
use Carbon\Carbon;
use Closure;

class NewMessage
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
        $contactsRepository = new MessengerContactsRepository;

        // получаем контакт зарегестрированного пользователя
        $contactId = $request->route('id');
        $contact_from = $contactsRepository->getContactStdById($contactId);
        if (empty($contact_from)) abort(404);
        // проверяем если контакт у получателя
        $contact_to = $contactsRepository->getContactStdByUserId($contact_from->user_contact);
        if (!empty($contact_to)) $contactToId = $contact_to->id;
        else $contactToId = $this->contact_to_new($contact_from->user_contact);


        $request->session()->flash('contact_to' , $contactToId);


        return $next($request);
    }

    private function contact_to_new($user_contact){
        $time = Carbon::now()->toDateTimeString();
        $contact = new Contacts();
        $data = [
            'user_id' => $user_contact,
            'user_contact' => \Auth::id(),
            'user_creator' => \Auth::id(),
            'category' => 'main_list',
            'created_at' => $time,
            'updated_at' => $time,
        ];
        return $contact->insertGetId($data);
    }


}
