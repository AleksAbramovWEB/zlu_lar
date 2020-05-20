<?php

namespace App\Http\Controllers\Connexion;


use App\Http\Requests\Connexion\ChangeUserAvatarRequest;
use App\Http\Requests\Connexion\ChangeUserGreetingRequest;
use App\Models\User;
use App\Repositories\Connexion\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends ConnexionBaseController
{
    private $user_auth;



    /**
     * Вывод анкеты зарегестрированного пользователя.
     *
     * @return Response
     */
    public function my_profile(Request $request)
    {
        $user = \Auth::user();
        return view('connexion.my_profile', compact('user'));
    }

    /**
     * сохранение аватара
     * @param ChangeUserAvatarRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_avatar(ChangeUserAvatarRequest $request){
        $path_save = 'connexion/avatars/'.date("Y-m-d");
        $path = $request->file('avatar')->store($path_save , 's3');
        \Auth::user()->update(['avatar' => $path]);
        return back()->with('success_avatar', true);
    }

    /**
     * удалить аватар
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_avatar(){
        \Storage::disk('s3')->delete(\Auth::user()->avatar);
        \Auth::user()->update(['avatar' => NULL]);
        return back()->with('delete_avatar', true);
    }

    /**
     * добавить или изменить приветствие пользователя
     * @param ChangeUserGreetingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change_greeting(ChangeUserGreetingRequest $request){
        \Auth::user()->update(['greeting' => $request->greeting]);
        return back()->with('success_greeting', true);
    }

    /**
     * удалить приветствие
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_greeting(){
        \Auth::user()->update(['greeting' => null]);
        return back()->with('delete_greeting', true);
    }

    /**
     * показ анкеты по id
     * @param UserRepository $userRepository
     * @param                $id
     * @return Response
     */
    public function profile(UserRepository $userRepository, $id){
        $user = $userRepository->getUserElById($id);

        if ($user->isEmpty()) abort(404);

        if ($user[0]->id == \Auth::id()) return redirect()->route('connexion.my_profile');

        return view('connexion.profile', ['user' => $user[0]]);
    }

    /**
     * выдача результатов поиска
     * @param Request        $request
     * @param UserRepository $userRepository
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profiles(Request $request, UserRepository $userRepository){
        $users = $userRepository->getUsersElForSearch($request);
        $users->appends($request->toArray())->links();
        return view('connexion.profiles', compact('users'));
    }





    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User  $user
     *
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     *
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
