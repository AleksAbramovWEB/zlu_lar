<?php

namespace App\Observers\Admins\Access;

use App\Models\Admins\Access\Roles;
use App\Models\Admins\Access\RolesPermissions;

class RolesObserver
{


    /**
     * Handle the roles "created" event.
     *
     * @param  \App\Models\Admins\Access\Roles  $roles
     * @return void
     */
    public function created(Roles $roles)
    {
        // доступ к админке по умалчанию добовление прав
        $hookup = new RolesPermissions();
        $hookup::insert([
            'roles_id' => $roles->id,
            'permissions_id' => 1
        ]);
    }

    /**
     * Handle the roles "updated" event.
     *
     * @param  \App\Models\Admins\Access\Roles  $roles
     * @return void
     */
    public function updated(Roles $roles)
    {

    }

    /**
     * Handle the roles "deleted" event.
     *
     * @param  \App\Models\Admins\Access\Roles  $roles
     * @return void
     */
    public function deleted(Roles $roles)
    {

    }

    /**
     * Handle the roles "restored" event.
     *
     * @param  \App\Models\Admins\Access\Roles  $roles
     * @return void
     */
    public function restored(Roles $roles)
    {

    }

    /**
     * Handle the roles "force deleted" event.
     *
     * @param  \App\Models\Admins\Access\Roles  $roles
     * @return void
     */
    public function forceDeleted(Roles $roles)
    {

    }
}
