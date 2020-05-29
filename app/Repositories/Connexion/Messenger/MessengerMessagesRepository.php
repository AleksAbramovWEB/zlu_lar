<?php


    namespace App\Repositories\Connexion\Messenger;


    use App\Models\Connexion\Messenger\Messages;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class MessengerMessagesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Messages::class;
        }


        /**
         * Получаем сообщенния по id диалогов
         *
         * @param $contact1
         * @param $contact2
         *
         * @return Collection
         */
        public function GetIdContactByUserId($contact1, $contact2){

            $result =    $this->startCondition()
                         ->where([['contact_from', $contact1], ['contact_to', $contact2]])
                         ->orWhere([['contact_from', $contact2], ['contact_to', $contact1]])
                         ->with([
                             'attach_photos' => function ($query){
                                 $query->with([
                                     'photo' => function ($query){
                                         $query->withTrashed();
                                     }
                                 ]);
                             }
                         ])
                         ->orderBy('id', 'DESC')
                         ->paginate(20);

                        // cтавим пометку  о прочтении
                        $this->startCondition()
                        ->where([['contact_from', $contact2], ['contact_to', $contact1], ['viewed', 0]])
                        ->update(['viewed'=> 1]);

            return $result;
        }


        public function countNewMessages($id = null){
            if (is_null($id)) $id = \Auth::id();

            $newMessages = $this->startCondition()
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
                                ->toBase()
                                ->first();

            return $newMessages->new_messages;
        }












    }
