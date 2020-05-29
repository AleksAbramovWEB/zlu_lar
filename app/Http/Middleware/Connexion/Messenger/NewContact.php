<?php

namespace App\Http\Middleware\Connexion\Messenger;

use App\Http\Requests\Connexion\Messenger\NewContactRequest;
use App\Repositories\Connexion\Messenger\MessengerContactsRepository;
use Closure;

class NewContact
{


    /**
     * Handle an incoming request.
     *
     * @param NewContactRequest           $request
     * @param \Closure                    $next
     * @param MessengerContactsRepository $contactsRepository
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // проверка на наличие контакта
        $contactsRepository = new MessengerContactsRepository;
        // контакт зарегестрированного  пользователя
        $contactId = $contactsRepository->GetIdContactByUserId($request->user_id);
        // контакт кому пишут
        $herContactId = $contactsRepository->getContactStdByUserId($request->user_id);

        // если контакт создан у обоих пользователей делаем редирект на существующий контакт
        if (!empty($contactId) AND !empty($herContactId))
            return redirect()->route('connexion.messenger.show_contact', ['id' => $contactId]);

        // eсли нет проверяем на количесво созданных контактов за сутки
        $countNewContacts = $contactsRepository->getCountNewContactsForDay();

        // при наличии вип статуса и количество разрешенных контактов для vip
        if (\Auth::user()->hasVip() === true AND  $countNewContacts >= config("bz.max_contacts_with_vip")){
            return redirect()->route("connexion.messenger.notice", ['code' => 2])->with('notice', true);
        // проверка колличество разрешенных контактов без vip
        }elseif ($countNewContacts >= config("bz.max_contacts_without_vip")){
            return redirect()->route("connexion.messenger.notice", ['code' => 1])->with('notice', true);
        }
        return $next($request);
    }
}
