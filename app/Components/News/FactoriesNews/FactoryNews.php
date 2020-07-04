<?php


    namespace App\Components\News\FactoriesNews;


    interface FactoryNews
    {

        // добавление новости
        public function addNews($data);

        // указание о просмотре
        public function updateViews(array $data);


    }
