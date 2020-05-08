<?php


    namespace App\Repositories;


    use Illuminate\Database\Eloquent\Model;

    abstract class CoreRepository
    {
        /**
         * @var Model
         */
        protected $model;
        protected $local;

        public function __construct()
        {
//            $this->model = app($this->getModelClass());
            $class = $this->getModelClass();
            $this->model = new $class();
            $this->local = \App::getLocale();

        }

        abstract protected function getModelClass();

        /**
         * @return \Illuminate\Contracts\Foundation\Application|Model|mixed
         */
        protected function startCondition()
        {
            return clone $this->model;
        }

    }
