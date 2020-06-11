<?php

use Illuminate\Database\Seeder;
    use App\Models\Admins\Access\Roles;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Roles();
        $manager->name = 'MasterManager';
        $manager->slug = 'master_manager';
        $manager->save();

        $developer = new Roles();
        $developer->name = 'VideoManager';
        $developer->slug = 'video_manager';
        $developer->save();
    }
}
