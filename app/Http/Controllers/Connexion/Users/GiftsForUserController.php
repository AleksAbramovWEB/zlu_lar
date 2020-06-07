<?php

namespace App\Http\Controllers\Connexion\Users;

use App\Http\Controllers\Connexion\ConnexionBaseController;
use App\Http\Requests\Connexion\Users\GiveGiftForUserRequest;
use App\Models\Connexion\Gifts\GiftsGiven;
use App\Repositories\Connexion\Gifts\GiftsRepository;


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

}
