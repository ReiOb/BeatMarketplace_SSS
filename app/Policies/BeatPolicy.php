<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Beat;

class BeatPolicy
{
    public function update(User $user, Beat $beat): bool
    {
        return $user->id === $beat->user_id;
    }

    public function delete(User $user, Beat $beat): bool
    {
        return $user->id === $beat->user_id;
    }
}
