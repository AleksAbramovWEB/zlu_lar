<?php


    namespace App\Components;

    /**
     * Class BackgroundPicture
     * для создания фоновых изображений views
     * @package App\Components
     */

    class BackgroundPicture
    {
        /**
         * @var string путь в проекте к фоновым
         */
        private $folder = "\public\img\background\\";

        /**
         * @var string путь url к фоновым
         */
        private $url = '/img/background/';

        /**
         * @var array все изображения
         */
        private $allBg = [];

        /**
         * @var string путь url к выбраному изображению
         */
        private $bg;


        /**
         * BackgroundPicture constructor.
         */
        public function __construct()
        {

            $handle = opendir(base_path().$this->folder);

            while(false !== ($file = readdir($handle))) {
                if($file == "." OR $file == "..") continue;
                $this->allBg[] = $this->url.$file;
            }

            $this->choiceBg();


        }


        /**
         * выбираем изображение
         */
        private function choiceBg(){
            $count = count($this->allBg) - 1;
            $int = random_int(0,  $count);
            $this->bg = $this->allBg[$int];

        }

        /**
         * возращает url фонового изображения
         * @return string
         */
        public function getBg()
        {
            if ($this->bg) return $this->bg;
            else return false;
        }



    }
