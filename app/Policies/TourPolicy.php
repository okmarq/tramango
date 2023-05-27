<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TourPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Tour $tour): bool
    {
        return $user->isAdmin() || $user->id === $tour->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Tour $tour): bool
    {
        return $user->id === $tour->user_id;
    }

    public function delete(User $user, Tour $tour): bool
    {
        return $user->id === $tour->user_id;
    }

    public function restore(User $user, Tour $tour): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Tour $tour): bool
    {
        return $user->isAdmin();
    }
}
