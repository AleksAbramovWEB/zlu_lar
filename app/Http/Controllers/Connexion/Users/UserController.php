<?php

namespace App\Http\Controllers\Connexion\Users;


use App\Http\Controllers\Connexion\ConnexionBaseController;
use App\Http\Requests\Connexion\Users\ChangeUserAvatarRequest;
use App\Http\Requests\Connexion\Users\ChangeUserGreetingRequest;
use App\Http\Requests\Connexion\Users\UpdatePasswordUserRequest;
use App\Http\Requests\Connexion\Users\UpdateProfileUserRequest;
use App\Http\Requests\Connexion\Users\UpdateVipUserRequest;
use App\Models\User;
use App\Models\Video\VideoLikes;
use App\Repositories\Connexion\Gifts\GiftsGivenRepository;
use App\Repositories\Connexion\Gifts\GiftsRepository;
use App\Repositories\Connexion\Photos\PhotosRepository;
use App\Repositories\Connexion\UserRepository;
use App\Repositories\Geo\GeoCitiesRepository;
use App\Repositories\Geo\GeoCountriesRepository;
use App\Repositories\Geo\GeoRegionsRepository;
use App\Repositories\Video\VideoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends ConnexionBaseController
{


    /**
     * Вывод анкеты зарегестрированного пользователя.
     *
     * @param GiftsGivenRepository $giftsGivenRepository
     * @param PhotosRepository     $photosRepository
     * @param VideoRepository      $videoRepository
     * @return Response
     */
    public function my_profile(
        GiftsGivenRepository $giftsGivenRepository,
        PhotosRepository $photosRepository,
        VideoRepository $videoRepository
    )
    {
        $user = \Auth::user();
        $giftsGiven = $giftsGivenRepository->getAllGiftsForUser($user->id);
        $photos = $photosRepository->getPhotoByUserId($user->id);
        $videos = $videoRepository->getLikesVideoForProfile($user->id);
        return view('connexion.users.my_profile', compact('user', 'giftsGiven', 'photos', 'videos'));
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
     *
     * @param UserRepository       $userRepository
     * @param                      $id
     * @param GiftsRepository      $giftsRepository
     * @param GiftsGivenRepository $giftsGivenRepository
     * @param PhotosRepository     $photosRepository
     * @param VideoRepository      $videoRepository
     * @return Response
     */
    public function profile
    (
        UserRepository $userRepository, $id,
        GiftsRepository $giftsRepository,
        GiftsGivenRepository $giftsGivenRepository,
        PhotosRepository $photosRepository,
        VideoRepository $videoRepository
    ){
        $user = $userRepository->getUserElById($id);
        if (empty($user)) abort(404);
        if ($user->id == \Auth::id()) return redirect()->route('connexion.my_profile');

        \News::addNews('profile_views', $id);

        $gifts = $giftsRepository->getAllGifts();
        $giftsGiven = $giftsGivenRepository->getAllGiftsForUser($id);
        $photos = $photosRepository->getPhotoByUserId($id);
        $videos = $videoRepository->getLikesVideoForProfile($id);

        return view('connexion.users.profile', compact('user', 'gifts', 'giftsGiven', 'photos', 'videos'));
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
        return view('connexion.users.profiles', compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param GeoCountriesRepository $geoCountriesRepository
     * @param GeoRegionsRepository   $geoRegionsRepository
     * @param GeoCitiesRepository    $geoCitiesRepository
     *
     * @return Response
     */
    public function my_profile_edit(
        GeoCountriesRepository $geoCountriesRepository,
        GeoRegionsRepository $geoRegionsRepository,
        GeoCitiesRepository $geoCitiesRepository
    )
    {
        $user = \Auth::user();
        $countries = $geoCountriesRepository->getAllCountries();
        $regions = $geoRegionsRepository->getAllRegionsByCountryId( (old('country'))? old('country') : $user->country);
        $cities = $geoCitiesRepository->getAllCitiesByRegionId( (old('region')) ? old('region') : $user->region);
        return view('connexion.users.settings.my_profile_edit',
            compact('user', 'countries', 'regions', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function my_profile_update(UpdateProfileUserRequest $request)
    {
        $data = $request->input();

        if (\Auth::user()->hasVip())
            $data['birthday'] = "{$data['year']}-{$data['month']}-{$data['day']} 00:00:00";

        \Auth::user()->update($data);
        return back()->with('success', true);
    }

    public function my_profile_edit_password()
    {
        return view('connexion.users.settings.my_profile_edit_password');
    }

    /**
     * Изменение пароля
     * @param UpdatePasswordUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function my_profile_update_password(UpdatePasswordUserRequest $request)
    {
        $user = \Auth::user();
        $user->password = \Hash::make($request->password);
        $user->save();
        return back()->with('success', true);
    }

    /**
     * форма для покупки vip
     * @return \Illuminate\View\View
     */
    public function my_profile_edit_vip(){
        return view('connexion.users.settings.vip');
    }

    public function my_profile_update_vip(UpdateVipUserRequest $request){
        $vip_day = config('bz.bay_vip')[$request->vip];
        $user = \Auth::user();
        if ($user->vip < Carbon::now())
                 $user->vip = Carbon::now()->addDays($vip_day);
        else     $user->vip = $user->vip->addDays($vip_day);

        $user->coins = $user->coins - $request->vip;
        $user->save();

        return back()->with('success', $vip_day);
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
