<?php

namespace App\Policies;

use App\People\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isSuperAdmin()) {
            return true;
        }
    }

    public function act(User $user, Profile $profile)
    {
        return $user->id === $profile->user->id;
    }
}
