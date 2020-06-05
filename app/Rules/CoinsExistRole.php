<?php

namespace App\Rules;

use App\Components\Kassa\PriseCoins;
use Illuminate\Contracts\Validation\Rule;

class CoinsExistRole implements Rule
{
    protected $prise;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->prise  = new PriseCoins();
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
        return $this->prise->exists_bay_coins($value);
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
