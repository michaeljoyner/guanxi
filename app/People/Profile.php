<?php

namespace App\People;

use App\Content\Article;
use App\HasModelImage;
use App\IsPublishable;
use App\Media\Artwork;
use App\Media\Photo;
use App\Media\Video;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Profile extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, HasModelImage, Sluggable, IsPublishable;

    const DEFAULT_AVATAR_SRC = '/images/defaults/default_500x500.jpg';

    protected $table = 'profiles';

    protected $fillable = ['bio', 'intro', 'name', 'title'];

    public $translatable = ['title', 'bio', 'intro'];

    protected $casts = ['published' => 'boolean'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 400, 400)
            ->keepOriginalImageFormat()
            ->optimize();
    }

    public static function createWithTranslations($data)
    {
        return static::create([
            'name' => $data['name'],
            'title' => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'intro' => ['en' => $data['intro'], 'zh' => $data['zh_intro']],
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignTo(User $user)
    {
        $this->user_id = $user->id;
        $this->save();
    }

    public function hasUser()
    {
        return ! is_null($this->user_id);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function updateWithTranslations($data)
    {
        return $this->update([
            'name' => $data['name'],
            'title' => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'intro' => ['en' => $data['intro'], 'zh' => $data['zh_intro']],
        ]);
    }

    public function setAvatar($file)
    {
        return $this->setImage($file);
    }

    public function avatar($conversion = '')
    {
        $src = $this->modelImage($conversion);

        return $src ? $src : static::DEFAULT_AVATAR_SRC;
    }
}
