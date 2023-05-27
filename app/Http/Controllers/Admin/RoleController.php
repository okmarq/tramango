<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    public function index(): AnonymousResourceCollection
    {
        return RoleResource::collection(Role::all());
    }

    public function store(StoreRoleRequest $request): RoleResource
    {
        $role = Role::create($request->all());
        return new RoleResource($role);
    }

    public function show(Role $role): RoleResource
    {
        return new RoleResource($role);
    }

    public function update(UpdateRoleRequest $request, Role $role): RoleResource
    {
        $role->update($request->all());
        return new RoleResource($role);
    }

    public function destroy(Role $role): Response
    {
        $role->delete();
        return response(null, 204);
    }
}
