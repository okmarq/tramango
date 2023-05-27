<?php

namespace App\Policies;

use App\Models\TravelOption;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TravelOptionPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, TravelOption $travelOption): bool
    {
        return $user->isAdmin() || $user->id === $travelOption->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, TravelOption $travelOption): bool
    {
        return $user->id === $travelOption->user_id;
    }

    public function delete(User $user, TravelOption $travelOption): bool
    {
        return $user->id === $travelOption->user_id;
    }

    public function restore(User $user, TravelOption $travelOption): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, TravelOption $travelOption): bool
    {
        return $user->isAdmin();
    }
}
