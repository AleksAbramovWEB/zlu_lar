<?php


    namespace App\Components\News\FactoriesNews;


    abstract class NewsAbstract implements FactoryNews
    {
        protected $model = NULL;

        protected  $nameModel = NULL;


        protected function get_model(){
            if (is_null($this->model)) $this->model =  new $this->nameModel;
            return  $this->model;
        }

        public function updateViews(array $data)
        {
            $this->get_model()::whereIn('id',  $data)->update(['views' => 1]);
        }




    }
