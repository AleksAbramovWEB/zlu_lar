<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KassaExistRole implements Rule
{
    private $kasses;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->kasses = config('kasses');
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
        return key_exists($value, $this->kasses);
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
