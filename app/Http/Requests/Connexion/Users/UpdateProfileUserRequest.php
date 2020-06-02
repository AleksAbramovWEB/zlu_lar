<?php

namespace App\Http\Requests\Connexion\Users;

use App\Rules\ExistUserVipRole;
use App\Rules\GenderRole;
use App\Rules\PositionRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:29'],
            'country' => ['required', 'integer', 'exists:geo_countries,id'],
            'region' => ['required', 'integer','exists:geo_regions,id'],
            'city' => ['required','integer', 'exists:geo_cities,id'],
            'day' => ['integer', 'between:0,32', new ExistUserVipRole,],
            'month' => ['integer', 'between:0,13', new ExistUserVipRole,],
            'year' => ['integer', "between:".(date("Y") - 91).",".(date("Y") - 18), new ExistUserVipRole,],
            'position' => ['string', new PositionRule, new ExistUserVipRole,],
            'gender' => ['string', new GenderRole, new ExistUserVipRole,],
            'about' => ['max:3000'],
            'interests' => ['max:3000'],
            'taboo' => ['max:3000'],
        ];
    }
}
