<?php


    namespace App\Repositories\Admins\Access;



    use App\Models\Admins\Access\RolesPermissions;
    use App\Repositories\CoreRepository;


    class RolesPermissionsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return RolesPermissions::class;
        }


        /**
         *
         * @param $role_id
         * @param $permissions_id
         *
         * @return boolean
         */
        public function getExists($role_id, $permissions_id){

            $boolean =   $this->startCondition()
                              ->where([
                                  ['roles_id', $role_id],
                                  ['permissions_id', $permissions_id]
                              ])
                              ->exists();

            return $boolean;
        }

        public function getByRoleIdAndPermissionsId($role_id, $permissions_id){
            $model    =    $this->startCondition()
                                ->where([
                                    ['roles_id', $role_id],
                                    ['permissions_id', $permissions_id]
                                ])
                                ->first();

            return $model;
        }













    }
