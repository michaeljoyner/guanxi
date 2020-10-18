<?php

namespace App\Media;

use App\HasModelImage;
use App\IsPublishable;
use App\People\Profile;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Photo extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, HasModelImage, IsPublishable, HasContributor, HasMainImage, HasGalleryImages;

    const DEFAULT_IMG_SRC = '/images/defaults/default_500x400.jpg';

    protected $table = 'photos';

    protected $fillable = ['title', 'description'];

    public $translatable = ['title', 'description'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CROP, 250, 200)
             ->keepOriginalImageFormat()
             ->optimize();

        $this->addMediaConversion('web')
             ->fit(Manipulations::FIT_MAX, 1200, 800)
             ->keepOriginalImageFormat()
             ->optimize();
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
}
