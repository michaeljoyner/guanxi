<?php

namespace App\Testimonials;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Testimonial extends Model implements HasMedia
{
    use HasMediaTrait;

    const AVATARS = 'avatars';
    const DEFAULT_AVATAR = '/public/images/default_testimonial_avatar.jpg';

    protected $fillable = ['name', 'language', 'content'];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function scopePublic($query)
    {
        $query->where('is_published', true);
    }

    public function scopeEnglish($query)
    {
        $query->where('language', 'en');
    }

    public function scopeChinese($query)
    {
        $query->where('language', 'zh');
    }

    public function publish()
    {
        $this->is_published = true;
        $this->save();
    }

    public function retract()
    {
        $this->is_published = false;
        $this->save();
    }

    public function setAvatar(UploadedFile $file)
    {
        $this->clearAvatar();

        return $this->addMedia($file)
                    ->preservingOriginal()
                    ->toMediaCollection(static::AVATARS);
    }

    public function clearAvatar()
    {
        $this->clearMediaCollection(self::AVATARS);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CROP, 300, 300)
             ->optimize()
             ->performOnCollections(self::AVATARS);
    }

    public function getAvatar()
    {
        $avatar = $this->getFirstMedia(self::AVATARS);

        return $avatar ? $avatar->getUrl('thumb') : self::DEFAULT_AVATAR;
    }

    public function toArray()
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'content'      => $this->content,
            'language'     => $this->language,
            'avatar'       => $this->getAvatar(),
            'is_published' => $this->is_published,
        ];
    }
}
