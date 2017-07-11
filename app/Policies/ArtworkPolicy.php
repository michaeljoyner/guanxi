<?php

namespace App\Policies;

use App\Media\Artwork;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtworkPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isSuperAdmin()) {
            return true;
        }
    }

    public function act(User $user, Artwork $artwork)
    {
        return $user->profile->id === $artwork->profile_id;
    }
}
