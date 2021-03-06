<?php

namespace App\Http\Requests\Admin\Video;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditVideoRequest extends FormRequest
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
     * @param Request $request
     * @return void
     */
    public function rules(Request $request)
    {
        $rules = [
            'title_ru' => 'required|min:3|max:30',
            'title_en' => 'required|min:3|max:30',
            'description_ru' => 'required|min:20|max:3000',
            'description_en' => 'required|min:20|max:3000',
            'published' => 'required|boolean'
        ];

        $array = $request->input();
        foreach ($array as $key => $val){
            if(!preg_match("~category_([0-9]+)~", $key)) continue;
            $rules[$key] = 'required|boolean';
        }

        return $rules;


    }
}
