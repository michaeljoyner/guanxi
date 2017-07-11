<?php

namespace App\Policies;

use App\Media\Video;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isSuperAdmin()) {
            return true;
        }
    }

    public function act(User $user, Video $video)
    {
        return $user->profile->id === $video->profile_id;
    }
}
