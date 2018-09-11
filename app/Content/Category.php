<?php

namespace App\Content;

use App\HasModelImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasTranslations, SoftDeletes, HasMediaTrait, HasModelImage, Sluggable;

    const DEFAULT_IMAGE_SRC = '/images/defaults/default_1400x420.jpg';

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'writeup'
    ];

    protected $dates = ['deleted_at'];

    public $translatable = ['name', 'description', 'writeup'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaConversions(?Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 400, 320)
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('large')
            ->fit(Manipulations::FIT_CROP, 1400, 420)
            ->keepOriginalImageFormat()
            ->optimize();
    }

    public static function createWithTranslations($data)
    {
        return static::create([
            'name'        => ['en' => $data['name'], 'zh' => $data['zh_name']],
            'description' => ['en' => $data['description'], 'zh' => $data['zh_description']],
            'writeup'     => ['en' => $data['writeup'], 'zh' => $data['zh_writeup']]
        ]);
    }

    public function updateWithTranslations($data)
    {
        return $this->update([
            'name'        => ['en' => $data['name'], 'zh' => $data['zh_name']],
            'description' => ['en' => $data['description'], 'zh' => $data['zh_description']],
            'writeup'     => ['en' => $data['writeup'], 'zh' => $data['zh_writeup']]
        ]);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function imageSrc($conversion = '')
    {
        $src = $this->modelImage($conversion);

        return $src ? $src : static::DEFAULT_IMAGE_SRC;
    }
}
