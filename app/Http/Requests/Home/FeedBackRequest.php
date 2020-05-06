<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string email
 * @property string subject
 * @property string  message
 */
class FeedBackRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'   => 'required|email',
            'subject' => 'required|min:5|max:100',
            'message' => 'required|min:10|max:1000'
        ];
    }
}
