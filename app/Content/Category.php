<?php

namespace App\Content;

use App\HasModelImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMediaConversions
{
    use HasTranslations, SoftDeletes, HasMediaTrait, HasModelImage, Sluggable;

    const DEFAULT_IMAGE_SRC = '/images/default_category.jpg';

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

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 400, 'h' => 320, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('large')
            ->setManipulations(['w' => 1400, 'h' => 420, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
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
