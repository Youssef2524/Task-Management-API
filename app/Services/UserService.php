<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserService
{
    use AuthorizesRequests;

    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        try {
            $this->authorize('viewAny', User::class);
        return User::all();
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to retrieve users'], 500);
    }
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data)
{
    try {
        $this->authorize('create', User::class);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => $data['role'] ?? 'user',
    ]);

    return $user;
} catch (Exception $e) {
    return response()->json(['error' => "$e"], 500);
}
}
    /**
     * Update an existing user.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        try {
            $this->authorize('update', User::class);

        $user->update($data);
        return $user;
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to update user'], 500);
    }
    }

    /**
     * Delete a user.
     *
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user): bool
    {   try {
        $this->authorize('delete', $user);
        return $user->delete();
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to delete user'], 500);
    }
    }
}
