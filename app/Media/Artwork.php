<?php

namespace App\Media;

use App\HasModelImage;
use App\IsPublishable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Artwork extends Model implements HasMediaConversions
{
    use HasTranslations, HasContributor, HasMainImage, HasModelImage, HasMediaTrait, HasGalleryImages, IsPublishable;

    const DEFAULT_IMG_SRC = '/images/defaults/default_500x400.jpg';

    protected $table = 'artworks';

    protected $fillable = ['title', 'description'];

    public $translatable = ['title', 'description'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 250, 'h' => 200, 'fit' => 'crop', 'fm' => 'src', 'q' => 80])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 1200, 'h' => 800, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($photo) {
            $photo->getGallery()->delete();
        });
    }

    public static function createWithTranslations($data, $profile = null)
    {
        $artwork = static::create([
            'title'       => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'description' => ['en' => $data['description'], 'zh' => $data['zh_description']]
        ]);

        if ($profile) {
            $artwork->profile_id = $profile->id;
            $artwork->save();
        }

        return $artwork;
    }

    public function updateWithTranslations($data)
    {
        return $this->update([
            'title'       => [
                'en' => $data['title'] ?? $this->getTranslation('title', 'en'),
                'zh' => $data['zh_title'] ?? $this->getTranslation('title', 'zh')
            ],
            'description' => [
                'en' => $data['description'] ?? $this->getTranslation('description', 'en'),
                'zh' => $data['zh_description'] ?? $this->getTranslation('description', 'zh'),
            ]
        ]);
    }
}
