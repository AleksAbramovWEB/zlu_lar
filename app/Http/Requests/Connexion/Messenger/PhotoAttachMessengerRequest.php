<?php

namespace App\Http\Requests\Connexion\Messenger;


use App\Rules\ExistUserPhotoMessenger;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PhotoAttachMessengerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $photos = $request->input();
        unset($photos['_token']); unset($photos['_method']);
        if (empty($photos)) return [];

        $roles = [];
        foreach ($photos as $key => $val)
            $roles[$key] = ['required', new ExistUserPhotoMessenger()];


        return $roles;
    }
}
