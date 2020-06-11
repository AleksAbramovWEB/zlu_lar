<?php

namespace App\Http\Controllers\Connexion\Users;

use App\Http\Controllers\Connexion\ConnexionBaseController;
use App\Http\Requests\Connexion\Users\GiveGiftForUserRequest;
use App\Http\Requests\Connexion\Users\GiveVipForUserRequest;
use App\Models\Connexion\Gifts\GiftsGiven;
use App\Models\User;
use App\Repositories\Connexion\Gifts\GiftsRepository;
use Carbon\Carbon;


class GiftsForUserController extends ConnexionBaseController
{
    public function give_gifts
    (
        GiveGiftForUserRequest $request,
        GiftsGiven $giftsGiven,
        GiftsRepository $giftsRepository
    ){
        $price = $giftsRepository->getPriceById($request->gift_id);

        $user = \Auth::user();
        $user->coins = $user->coins - $price;
        $user->save();

        $gift = $request->input();
        $gift['from_user_id'] = $user->id;
        $giftsGiven::create($gift);
        return back();
    }

    public function give_vip(User $userModel, GiveVipForUserRequest $request)
    {

        $vip_day = config('bz.bay_vip')[$request->vip];

        $user_whom = $userModel->find($request->user_id);

        if ($user_whom->vip < Carbon::now())
                 $user_whom->vip = Carbon::now()->addDays($vip_day);
        else     $user_whom->vip = $user_whom->vip->addDays($vip_day);
        $user_whom->save();

        $user_from = \Auth::user();
        $user_from->coins = $user_from->coins - $request->vip;
        $user_from->save();

        return back();
    }


}
