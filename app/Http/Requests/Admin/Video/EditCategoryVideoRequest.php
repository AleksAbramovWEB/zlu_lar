<?php

namespace App\Http\Requests\Admin\Video;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryVideoRequest extends FormRequest
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
        $category_id = $this->route('category');
        return [
            'slug'     => "required|min:3|max:30|unique:video_categories,id,{$category_id}",
            'title_ru' => 'required|min:3|max:30',
            'title_en' => 'required|min:3|max:30',
            'published' => 'required|boolean'
        ];
    }
}
