<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class LocationPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Location $location): bool
    {
        return $user->isAdmin() || $user->id === $location->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Location $location): bool
    {
        return $user->id === $location->user_id;
    }

    public function delete(User $user, Location $location): bool
    {
        return $user->id === $location->user_id;
    }

    public function restore(User $user, Location $location): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Location $location): bool
    {
        return $user->isAdmin();
    }
}
