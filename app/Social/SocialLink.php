<?php

namespace App\Social;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links';

    protected $fillable = ['platform', 'link'];

    public function sociable()
    {
        return $this->morphTo();
    }

}
