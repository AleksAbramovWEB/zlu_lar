<?php


    namespace App\Traits;


    trait PropertyContainer
    {
        private $propertyContainer = [];

        /**
         * взять по ключу
         * @param $val
         * @return mixed
         */
        public function getProperty($val)
        {
            return $this->propertyContainer[$val] ?? NULL;
        }

        /**
         * добавить или перепизаписать свойство
         * @param $key
         * @param $val
         */
        public function setProperty($key, $val)
        {
            $this->propertyContainer[$key] = $val;
        }

        /**
         * установить несколько свойств
         * @param array|object $array
         */
        public function setFewProperty($array)
        {
            foreach ($array as $key => $val)
                $this->propertyContainer[$key] = $val;
        }

        /**
         * удалить свойство
         * @param $key
         */
        public function removeProperty($key)
        {
            unset($this->propertyContainer[$key]);
        }

    }
