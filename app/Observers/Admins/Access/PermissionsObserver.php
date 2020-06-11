<?php

namespace App\Observers\Admins\Access;

use App\Models\Admins\Access\Permissions;
use App\Models\Admins\Access\RolesPermissions;

class PermissionsObserver
{
    /**
     * Handle the permissions "created" event.
     *
     * @param  \App\Models\Admins\Access\Permissions  $permissions
     * @return void
     */
    public function created(Permissions $permissions)
    {
        $hookup = new RolesPermissions();
        $hookup::insert([
            'roles_id' => 1,
            'permissions_id' => $permissions->id
        ]);
    }

    /**
     * Handle the permissions "updated" event.
     *
     * @param  \App\Models\Admins\Access\Permissions  $permissions
     * @return void
     */
    public function updated(Permissions $permissions)
    {
        //
    }

    /**
     * Handle the permissions "deleted" event.
     *
     * @param  \App\Models\Admins\Access\Permissions  $permissions
     * @return void
     */
    public function deleted(Permissions $permissions)
    {
        //
    }

    /**
     * Handle the permissions "restored" event.
     *
     * @param  \App\Models\Admins\Access\Permissions  $permissions
     * @return void
     */
    public function restored(Permissions $permissions)
    {
        //
    }

    /**
     * Handle the permissions "force deleted" event.
     *
     * @param  \App\Models\Admins\Access\Permissions  $permissions
     * @return void
     */
    public function forceDeleted(Permissions $permissions)
    {
        //
    }
}
