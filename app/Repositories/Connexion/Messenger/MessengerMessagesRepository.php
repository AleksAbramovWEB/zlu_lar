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
                         ->orderBy('id', 'DESC')
                         ->paginate(20);
            return $result;
        }










    }
