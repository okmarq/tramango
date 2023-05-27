<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class FlightPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Flight $flight): bool
    {
        return $user->isAdmin() || $user->id === $flight->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Flight $flight): bool
    {
        return $user->id === $flight->user_id;
    }

    public function delete(User $user, Flight $flight): bool
    {
        return $user->id === $flight->user_id;
    }

    public function restore(User $user, Flight $flight): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Flight $flight): bool
    {
        return $user->isAdmin();
    }
}
