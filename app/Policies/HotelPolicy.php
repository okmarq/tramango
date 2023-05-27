<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class HotelPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Hotel $hotel): bool
    {
        return $user->isAdmin() || $user->id === $hotel->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Hotel $hotel): bool
    {
        return $user->id === $hotel->user_id;
    }

    public function delete(User $user, Hotel $hotel): bool
    {
        return $user->id === $hotel->user_id;
    }

    public function restore(User $user, Hotel $hotel): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Hotel $hotel): bool
    {
        return $user->isAdmin();
    }
}
