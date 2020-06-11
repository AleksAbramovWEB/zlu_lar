<?php

namespace App\Http\Requests\Admin\Master;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionsRequest extends FormRequest
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
        $permission_id = $this->route('permission');

        $roles['name'] = ['required', 'min:3', 'max:30', "unique:admins_permissions,name,{$permission_id}"];
        $roles['slug'] = ['required', 'min:3', 'max:30', "unique:admins_permissions,slug,{$permission_id}"];

        return $roles;
    }
}
