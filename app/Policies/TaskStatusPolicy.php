<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskStatusPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(User $user, TaskStatus $taskStatus): bool
    {
        return $user->exists();
    }

    public function create(User $user): bool
    {
        return $user->exists();
    }

    public function update(User $user, TaskStatus $taskStatus): bool
    {
        return $user->exists();
    }

    public function delete(User $user, TaskStatus $taskStatus): bool
    {
        return $user->exists();
    }

    public function restore(User $user, TaskStatus $taskStatus): bool
    {
        return $user->exists();
    }

    public function forceDelete(User $user, TaskStatus $taskStatus): bool
    {
        return $user->exists();
    }
}
