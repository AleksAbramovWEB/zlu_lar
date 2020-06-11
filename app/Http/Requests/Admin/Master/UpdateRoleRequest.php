<?php

namespace App\Http\Requests\Admin\Master;

use App\Rules\ExistUserPhotoMessenger;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRoleRequest extends FormRequest
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
     * @param Request $request
     *
     * @return array
     */
    public function rules(Request $request )
    {

        $role_id = $this->route('role');

        $array = $request->input();
        unset($array['_token']); unset($array['_method']);unset($array['name']);unset($array['slug']);

        foreach ($array as $key => $val)
             $roles[$key] = ['boolean'];



        $roles['name'] = ['required', 'min:3', 'max:30', "unique:admins_roles,name,{$role_id}"];
        $roles['slug'] = ['required', 'min:3', 'max:30', "unique:admins_roles,slug,{$role_id}"];

        return $roles;
    }
}
