<?php

namespace App\Affiliates;

use App\HasModelImage;
use App\IsPublishable;
use App\Social\HasSocialLinks;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Spatie\Translatable\HasTranslations;

class Affiliate extends Model implements HasMediaConversions
{
    use Sluggable, HasTranslations, HasSocialLinks, HasMediaTrait, HasModelImage, IsPublishable;

    const DEFAULT_IMAGE_SRC = '/images/defaults/default_1400x560.jpg';

    protected $table = 'affiliates';

    protected $fillable = [
        'name',
        'location',
        'writeup',
        'website',
        'phone'
    ];

    protected $casts = ['published' => 'boolean'];

    public $translatable = ['location', 'writeup'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 160)
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('web')
            ->fit(Manipulations::FIT_CROP, 500, 400)
            ->keepOriginalImageFormat()
            ->optimize();
        $this->addMediaConversion('large')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->keepOriginalImageFormat()
            ->optimize();

    }

    public static function createWithTranslations($data)
    {
        return static::create([
            'name' => $data['name'],
            'location' => ['en' => $data['location'], 'zh' => $data['zh_location']],
            'writeup' => ['en' => $data['writeup'], 'zh' => $data['zh_writeup']],
            'website' => $data['website'] ?? null,
            'phone' => $data['phone'] ?? null
        ]);
    }

    public function updateWithTranslations($data)
    {
        return $this->update([
            'name' => $data['name'] ?? $this->name,
            'location' => ['en' => $data['location'], 'zh' => $data['zh_location']],
            'writeup' => ['en' => $data['writeup'], 'zh' => $data['zh_writeup']],
            'website' => $data['website'] ?? $this->website,
            'phone' => $data['phone'] ?? $this->phone
        ]);
    }

    public function imageSrc($conversion = '')
    {
        $src = $this->modelImage($conversion);

        return $src ? $src : static::DEFAULT_IMAGE_SRC;
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
