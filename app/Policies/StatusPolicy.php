<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class StatusPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Status $status): bool
    {
        return $user->isAdmin() || $user->id === $status->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Status $status): bool
    {
        return $user->id === $status->user_id;
    }

    public function delete(User $user, Status $status): bool
    {
        return $user->id === $status->user_id;
    }

    public function restore(User $user, Status $status): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Status $status): bool
    {
        return $user->isAdmin();
    }
}
