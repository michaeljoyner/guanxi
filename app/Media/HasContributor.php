<?php


namespace App\Media;


use App\People\Profile;

trait HasContributor
{
    public function contributor()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}