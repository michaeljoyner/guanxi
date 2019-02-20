<?php


namespace App\Media;


use App\People\Profile;

trait HasContributor
{
    public function contributor()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function getContributorAttribute()
    {
        if (!$this->relationLoaded('contributor')) {
            $this->load('contributor');
        }

        return $this->getRelation('contributor') ?: $this->defaultContributor();
    }

    public function contributedBy(Profile $profile)
    {
        $this->profile_id = $profile->id;
        $this->save();

        return $this->contributor;
    }

    public function defaultContributor()
    {
        return Profile::make([]);
    }
}