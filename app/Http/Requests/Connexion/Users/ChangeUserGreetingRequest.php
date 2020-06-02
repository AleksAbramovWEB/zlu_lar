<?php

namespace App\Http\Requests\Connexion\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string greeting
 */

class ChangeUserGreetingRequest extends FormRequest
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
           'greeting' => 'min:3|max:255'
        ];
    }
}
