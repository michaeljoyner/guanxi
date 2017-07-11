<?php

namespace App\Policies;

use App\Media\Photo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isSuperAdmin()) {
            return true;
        }
    }

    public function act(User $user, Photo $photo)
    {
        return $user->profile->id === $photo->profile_id;
    }
}
