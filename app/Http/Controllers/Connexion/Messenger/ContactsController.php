<?php

namespace App\Http\Controllers\Connexion\Messenger;

use App\Exceptions\Connexion\Messenger\CategoryNotFoundException;
use App\Http\Requests\Connexion\Messenger\NewContactRequest;
use App\Models\Connexion\Messenger\Contacts;
use App\Repositories\Connexion\Messenger\MessengerContactsRepository;
use Carbon\Carbon;


class ContactsController extends MessengerBaseController
{

    public function  all_lists(MessengerContactsRepository $repository){
        if ($repository->existMessageFromFavorites())
            return redirect()->route('connexion.messenger.list_of_favorites');

        return redirect()->route('connexion.messenger.main_list');
    }

    // готовим данные взависимоти от категории
    private function get_list($category){
        $contactsRepository = new MessengerContactsRepository;
        $contacts = $contactsRepository->getListContacts($category);
        $count = $contactsRepository->countContactsForAllLists();
        return view('connexion.messenger.contacts_list',
            compact('contacts', 'count', 'category'));
    }

    // основной список контактов
    public function main_list(){
        return $this->get_list('main_list');
    }
    // фавориты
    public function list_of_favorites(){
        return $this->get_list('list_of_favorites');
    }
    // игнорируемые
    public function black_list(){
        return $this->get_list('black_list');
    }

    /**
     * Создание нового диалога.
     * @param NewContactRequest      $request
     * @param Contacts               $contacts
     * @return void
     */
    public function new_contact(NewContactRequest $request, Contacts $contacts)
    {
        $time = Carbon::now()->toDateTimeString();

        $data = [
            'user_id' => \Auth::id(),
            'user_contact' => $request->user_id,
            'user_creator' => \Auth::id(),
            'category' => 'main_list',
            'created_at' => $time,
            'updated_at' => $time,
        ];
        $contacts_id =  $contacts->insertGetId($data);

       return redirect()->route('connexion.messenger.show_contact', ['id' => $contacts_id]);
    }

    /**
     * изменить категорию контакта
     * @param $param
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws CategoryNotFoundException
     */
    private function update_category($param, $id){
        $lists = ['main_list', 'list_of_favorites', 'black_list'];
        if (!in_array($param, $lists)) throw new CategoryNotFoundException();
        $contact = new Contacts();
        $contact->where([['user_id', \Auth::id()], ['id' , $id]])
                ->update(['category' => $param]);
        return back();
    }

    // перенести в основной лист
    public function update_to_main_list($id)
    {
       return $this->update_category('main_list', $id);
    }
    // перенести в избранные
    public function update_to_list_of_favorites($id)
    {
        return $this->update_category('list_of_favorites', $id);
    }
    // перенести в черный список
    public function update_to_black_list($id)
    {
        return $this->update_category('black_list', $id);
    }


    /**
     * удалить кактегорию
     * @param \App\Models\Connexion\Messenger\Contacts $contacts
     * @param                                          $id
     * @return void
     */
    public function destroy(Contacts $contacts, $id)
    {
        $contacts->where([['user_id', \Auth::id()], ['id' , $id]])
                 ->delete();

        return back();
    }

    public function notice($code){
        if (!\Session::has('notice')) abort(404);
        return view('connexion.messenger.notice', ['code' => $code]);
    }
}
