<?php


namespace App\Media;


use App\People\Profile;

trait HasContributor
{
    public function contributor()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function contributedBy(Profile $profile)
    {
        $this->profile_id = $profile->id;
        $this->save();

        return $this->contributor;
    }
}