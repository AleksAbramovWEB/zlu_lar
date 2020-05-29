<?php

namespace App\Rules;

use App\Repositories\Connexion\Messenger\MessengerPhotosRepository;
use Illuminate\Contracts\Validation\Rule;

class ExistUserPhotoMessenger implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value )
    {
       $photosRepository = new MessengerPhotosRepository;
        return $photosRepository->existAuthUserPhotoById($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'нет такого фото у данного пользователя';
    }
}
