<?php

namespace App\Http\Requests\Connexion;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserAvatarRequest extends FormRequest
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
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000'
        ];
    }
}
