<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VipBayRole implements Rule
{
    private $vip;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->vip = config('bz.bay_vip');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(\Auth::user()->coins >= $value AND key_exists($value, $this->vip)) return true;
        else return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
