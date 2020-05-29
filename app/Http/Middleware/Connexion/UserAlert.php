<?php

namespace App\Http\Middleware\Connexion;

use Carbon\Carbon;
use Closure;

class UserAlert
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
        if (\Auth::check()){
            $user = \Auth::user();
            // пометка онлайн
            $user->timestamps = false;
            $user->update(['last_time' => Carbon::now()->toDateTimeString()]);

            // записывем в контейнер свойств оповещения
            $alerts = $this->getUserAlerts();
            $user->setFewProperty($alerts);
            \Auth::setUser($user);

        }
        return $next($request);
    }

    private function getUserAlerts(){
        $id = \Auth::id();

        $newMessages = \DB::table('messenger_messages')
            ->select(\DB::raw('COUNT(*) AS new_messages'))
            ->join('messenger_contacts', 'messenger_contacts.id', '=', 'messenger_messages.contact_to')
            ->where([
                 ['messenger_contacts.user_id', $id],
                 ['messenger_messages.viewed', '0'],
            ])
            ->where(function ($query){
                $query->where( 'messenger_contacts.category', 'list_of_favorites')
                      ->orWhere('messenger_contacts.category', 'main_list');
            })
            ->first();



        return $newMessages;
    }


}
