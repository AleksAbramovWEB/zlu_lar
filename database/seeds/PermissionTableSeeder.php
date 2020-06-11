<?php

use Illuminate\Database\Seeder;
use App\Models\Admins\Access\Permissions;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permissions();
        $manageUser->name = 'Create Gift';
        $manageUser->slug = 'create_gift';
        $manageUser->save();

        $createTasks = new Permissions();
        $createTasks->name = 'Delete Gift';
        $createTasks->slug = 'delete_gift';
        $createTasks->save();
    }
}
