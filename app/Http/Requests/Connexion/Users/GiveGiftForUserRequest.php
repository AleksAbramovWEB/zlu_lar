<?php

namespace App\Http\Requests\Connexion\Users;

use App\Rules\GiftBayRole;
use Illuminate\Foundation\Http\FormRequest;

class GiveGiftForUserRequest extends FormRequest
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
            'gift_id' => ['required', 'integer', 'exists:gifts,id'],
            'whom_user_id' => ['required', 'integer', 'exists:users,id'],
            'not_visible' => ['boolean'],
            'comment' => ['max:200']
        ];
    }
}
