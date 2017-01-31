<?php

namespace App\Affiliates;

use App\HasModelImage;
use App\IsPublishable;
use App\Social\HasSocialLinks;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Affiliate extends Model implements HasMediaConversions
{
    use Sluggable, HasTranslations, HasSocialLinks, HasMediaTrait, HasModelImage, IsPublishable;

    const DEFAULT_IMAGE_SRC = '/images/default_category.jpg';

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

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('large')
            ->setManipulations(['w' => 1400, 'h' => 600, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
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


}
