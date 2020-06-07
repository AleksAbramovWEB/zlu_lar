<?php

namespace App\Http\Requests\Connexion\Users;

use App\Rules\VipBayRole;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVipUserRequest extends FormRequest
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
            'vip' => ['required', new VipBayRole()]
        ];
    }
}
