<?php


    namespace App\Components;




    class MainHelper
    {

        /**
         * Для валидии форм bootstrap
         *
         * Illuminate\Contracts\Support\MessageBag $errors
         * @param string $field
         * @return null|string
         */
         public function is_valid_form($field)
         {
            if(is_null(session('errors'))) return NULL;
            $errors = session()->get('errors')->getBags()['default']->getMessages();
            if (empty($errors[$field])) return 'is-valid';
            else return 'is-invalid';
        }

    }
