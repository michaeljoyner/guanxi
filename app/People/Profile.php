<?php

namespace App\People;

use App\Content\Article;
use App\HasModelImage;
use App\Social\HasSocialLinks;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Profile extends Model implements HasMediaConversions
{
    use HasTranslations, HasMediaTrait, HasModelImage, HasSocialLinks;

    const DEFAULT_AVATAR_SRC = '/images/default_avatar.png';

    protected $table = 'profiles';

    protected $fillable = ['bio', 'intro', 'name', 'title'];

    public $translatable = ['title', 'bio', 'intro'];

    protected $casts = ['published' => 'boolean'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300, 'h' => 300, 'fit' => 'crop', 'fm' => 'src'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 600, 'h' => 600, 'fit' => 'max', 'fm' => 'src'])
            ->performOnCollections('default');
    }

    public static function createWithTranslations($data)
    {
        return static::create([
            'name' => $data['name'],
            'title' => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'intro' => ['en' => $data['intro'], 'zh' => $data['zh_intro']],
            'bio' => ['en' => $data['bio'], 'zh' => $data['zh_bio']]
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function updateWithTranslations($data)
    {
        return $this->update([
            'name' => $data['name'],
            'title' => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'intro' => ['en' => $data['intro'], 'zh' => $data['zh_intro']],
            'bio' => ['en' => $data['bio'], 'zh' => $data['zh_bio']]
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

    public function publish()
    {
        return $this->setPublishedStatus(true);
    }

    public function retract()
    {
        return $this->setPublishedStatus(false);
    }

    protected function setPublishedStatus($isPublished)
    {
        $this->published = $isPublished;
        $this->save();

        return $this->published;
    }


}
