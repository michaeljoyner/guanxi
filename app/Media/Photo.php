<?php

namespace App\Media;

use App\HasModelImage;
use App\IsPublishable;
use App\People\Profile;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Photo extends Model implements HasMediaConversions
{
    use HasTranslations, HasMediaTrait, HasModelImage, IsPublishable;

    const DEFAULT_IMG_SRC = '/images/photo_default.jpeg';

    protected $table = 'photos';

    protected $fillable = ['title', 'description'];

    public $translatable = ['title', 'description'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
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
        $photo = static::create([
            'title'       => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'description' => ['en' => $data['description'], 'zh' => $data['zh_description']]
        ]);

        if ($profile) {
            $photo->profile_id = $profile->id;
            $photo->save();
        }

        return $photo;
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

    public function contributor()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function mainImageSrc($conversion = '')
    {
        return $this->modelImage($conversion) ?: static::DEFAULT_IMG_SRC;
    }

    public function setMainImage($file)
    {
        return $this->setImage($file);
    }

    public function gallery()
    {
        return $this->morphOne(Gallery::class, 'galleryable');
    }

    public function getGallery()
    {
        return $this->gallery()->firstOrCreate([]);
    }

    public function addGalleryImage($file)
    {
        return $this->getGallery()->addImage($file);
    }

    public function galleryImages($withMainImage = true)
    {
        if($withMainImage) {
            return $this->getMedia()->merge($this->getGallery()->getMedia());
        }

        return $this->getGallery()->getMedia();
    }
}
