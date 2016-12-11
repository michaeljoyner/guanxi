<?php

namespace App\Media;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Gallery extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected $table = 'galleries';

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public function galleryable()
    {
        return $this->morphTo();
    }

    public function addImage($file)
    {
        return $this->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }
}
