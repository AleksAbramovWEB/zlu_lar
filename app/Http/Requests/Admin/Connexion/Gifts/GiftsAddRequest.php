<?php

namespace App\Http\Requests\Admin\Connexion\Gifts;

use Illuminate\Foundation\Http\FormRequest;

class GiftsAddRequest extends FormRequest
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
            'picture' => 'required|image|mimes:png|max:500',
            'title_ru' => 'required|min:3|max:20',
            'title_en' => 'required|min:3|max:20',
            'price' => 'required|integer|between:1,50'
        ];
    }
}
