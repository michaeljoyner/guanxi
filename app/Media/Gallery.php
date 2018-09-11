<?php

namespace App\Media;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Gallery extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'galleries';

    public function registerMediaConversions(?Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('web')
            ->fit(Manipulations::FIT_MAX, 1200, 800)
            ->keepOriginalImageFormat()
            ->optimize();

    }

    public function galleryable()
    {
        return $this->morphTo();
    }

    public function addImage($file)
    {
        return $this->addMedia($file)->preservingOriginal()->toMediaCollection();
    }
}
