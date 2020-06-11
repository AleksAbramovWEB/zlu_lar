<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\AddPermissionsRequest;
use App\Http\Requests\Admin\Master\UpdatePermissionsRequest;
use App\Models\Admins\Access\Permissions;
use App\Repositories\Admins\Access\PermissionsRepository;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PermissionsRepository $permissionsRepository
     *
     * @return void
     */
    public function index(PermissionsRepository $permissionsRepository)
    {
        $permissions = $permissionsRepository->getAllPermissions();
        return view("admin.master.permissions.permissions_index", compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.master.permissions.permissions_create");
    }

    /**
     * Store a newly created resource in storage.
     * @param AddPermissionsRequest $request
     * @param Permissions           $permissions
     * @return void
     */
    public function store(AddPermissionsRequest $request, Permissions $permissions)
    {
        $permissions::create($request->input());
        return redirect()->route("admin.master.permissions.index");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param PermissionsRepository                 $permissionsRepository
     * @param                                       $id
     *
     * @return void
     */
    public function edit(PermissionsRepository $permissionsRepository, $id)
    {
        $permission = $permissionsRepository->getPermissionById($id);
        return view("admin.master.permissions.permissions_edit", compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionsRequest $request
     * @param Permissions              $permissions
     * @param                          $id
     *
     * @return void
     */
    public function update(UpdatePermissionsRequest $request, Permissions $permissions, $id)
    {
        $permission = $permissions->find($id);
        $permission->update($request->input());
        return back()->with('success', true);
    }


}
