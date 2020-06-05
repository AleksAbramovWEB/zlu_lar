<?php

namespace App\Http\Requests\Kassa;

use App\Rules\CoinsExistRole;
use App\Rules\KassaExistRole;
use Illuminate\Foundation\Http\FormRequest;

class SendToKassaRequest extends FormRequest
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
            'coins' => ['required', new CoinsExistRole()],
            'name_kassa' => ['required', new KassaExistRole()]
        ];
    }
}
