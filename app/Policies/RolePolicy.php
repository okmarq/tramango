<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RolePolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Role $role): bool
    {
        return $user->isAdmin() || $user->id === $role->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Role $role): bool
    {
        return $user->id === $role->user_id;
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->id === $role->user_id;
    }

    public function restore(User $user, Role $role): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return $user->isAdmin();
    }
}
