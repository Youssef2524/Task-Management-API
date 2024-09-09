<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;


    public function view(User $user): bool
    {
        return $user->role==='admin' || $user->role==='manager';
    }

    public function create(User $user): bool
    {
        return $user->role==='admin' || $user->role==='manager';
    }
    public function softdelete(User $user): bool
    {
        return $user->role==='admin' || $user->role==='manager';
    }

    public function update(User $user,Task $task): bool
    {
         return $user->id === $task->assigned_to || $user->role==='admin';
    }

    public function delete(User $user): bool
    {
        return $user->role==='admin';
    }

    public function assign(User $user): bool
    {
        return $user->role==='admin' || $user->role==='manager';
    }
}
