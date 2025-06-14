<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Label $label): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->exists();
    }

    public function update(User $user, Label $label): bool
    {
        return $user->exists();
    }

    public function delete(User $user, Label $label): bool
    {
        return $user->exists();
    }

    public function restore(User $user, Label $label): bool
    {
        return $user->exists();
    }

    public function forceDelete(User $user, Label $label): bool
    {
        return $user->exists();
    }
}
