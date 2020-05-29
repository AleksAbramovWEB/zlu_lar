<?php

namespace App\Http\Requests\Connexion\Messenger;

use App\Rules\ExistUserPhotoMessenger;
use Illuminate\Foundation\Http\FormRequest;

class PhotoDeleteMessengerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'remove_photo' => ['required', new ExistUserPhotoMessenger()]
        ];
    }
}
