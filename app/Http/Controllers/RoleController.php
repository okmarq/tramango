<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    public function index()
    {
        $cacheKey = 'roles';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => RoleResource::collection(Role::all()));
    }

    public function store(StoreRoleRequest $request): RoleResource
    {
        $role = Role::create($request->all());
        return new RoleResource($role);
    }

    public function show(Role $role)
    {
        $cacheKey = 'role_' . $role->id;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($role) {
            return new RoleResource($role);
        });
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
