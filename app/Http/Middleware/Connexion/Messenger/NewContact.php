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
        $contactId = $contactsRepository->GetIdContactByUserId($request->user_id);
        if (!empty($contactId))
            return redirect()->route('connexion.messenger.show_contact', ['id' => $contactId]);

        return $next($request);
    }
}
