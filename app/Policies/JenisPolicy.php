<?php

namespace App\Policies;

use App\Models\Jenis;
use App\Models\User;

class JenisPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }

    public function view(User $user, Jenis $jenis): bool
    {
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }

    public function create(User $user): bool
    {
        return $user->role->name === 'Admin';
    }

    public function update(User $user, Jenis $jenis): bool
    {
        return $user->role->name === 'Admin';
    }

    public function delete(User $user, Jenis $jenis): bool
    {
        return $user->role->name === 'Admin';
    }
}
