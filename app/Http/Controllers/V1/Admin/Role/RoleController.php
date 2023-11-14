<?php

namespace App\Http\Controllers\V1\Admin\Role;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Resources\V1\Admin\Role\RoleResource;
use App\Http\Resources\V1\Admin\Role\RoleCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated('name'));

        optional($request->validated('permissions'))->each(function ($permissions) use ($role) {
            $role->permissions()->attach($permissions);
        });

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update(array($request->validated('name')));

        // if ($request->has('permissions')) {
        //     $role->permissions()->sync($request->validated('permissions'));
        // }

        optional($request->validated('permissions'))->each(function ($permissions) use ($role) {
            $role->permissions()->sync($permissions);
        });


        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        return response()->noContent();
    }
}
