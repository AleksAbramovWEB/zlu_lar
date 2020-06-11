<?php


    namespace App\Repositories\Admins\Access;



    use App\Models\Admins\Access\Permissions;
    use App\Repositories\CoreRepository;


    class PermissionsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Permissions::class;
        }


        /**
         * дать по id
         * @param $id
         * @return Permissions
         */
        public function getPermissionById($id){

            $permission =  $this->startCondition()
                                ->where('id','=', $id)
                                ->first();

            return $permission;
        }

        public function getAllPermissions(){

            $permissions = $this->startCondition()
                          ->orderByRaw("id DESC")
                          ->get();

            return $permissions;
        }

        public function getAllPermissionsAndRoleActively($role_id){

            $query = "
                        SELECT COUNT(*) FROM `admins_roles_permissions`
                        WHERE `admins_roles_permissions`.`roles_id` = '$role_id'
                        AND `admins_roles_permissions`.`permissions_id` = `admins_permissions`.`id`";

            $select = [\DB::raw("admins_permissions.*, ($query) AS actively")];

            $permissions = $this->startCondition()
                                ->select($select)
                                ->orderByRaw("id ASC")
                                ->get();

            return $permissions;
        }

        public function getPermissionIdBySlug($slug){
            $permission = $this->startCondition()
                                ->where('slug','=', $slug)
                                ->first();
            return $permission->id;
        }











    }
