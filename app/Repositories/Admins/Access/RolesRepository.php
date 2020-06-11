<?php


    namespace App\Repositories\Admins\Access;



    use App\Models\Admins\Access\Roles;
    use App\Repositories\CoreRepository;


    class RolesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Roles::class;
        }


        /**
         * дать все
         * @return Illuminate\Database\Eloquent\Collection
         */
        public function getAllRoles(){

            $roles = $this->startCondition()
                          ->orderByRaw("id DESC")
                          ->get();

            return $roles;
        }

        public function getRoleById($id){
            $roles =   $this->startCondition()
                            ->where("id", $id)
                            ->first();

            return $roles;
        }








    }
