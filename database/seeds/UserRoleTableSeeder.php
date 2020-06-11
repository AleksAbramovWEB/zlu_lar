<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Models\Admins\Access\Roles::where('slug', 'master_manager')->first();
        $permissions = \App\Models\Admins\Access\Permissions::where('slug','create_gift')->first();

        $user = (new \App\Models\User())->find(2029);
        $user->roles()->attach($role);
        $user->permissions()->attach($permissions);
    }
}
