<?php

namespace App\Rules;

use App\Repositories\Connexion\Gifts\GiftsRepository;
use Illuminate\Contracts\Validation\Rule;

class GiftBayRole implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param        $gift_id
     *
     * @return bool
     */
    public function passes($attribute, $gift_id)
    {
        $prise = (new GiftsRepository())->getPriceById($gift_id);

        if(\Auth::user()->coins >= $prise) return true;
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
