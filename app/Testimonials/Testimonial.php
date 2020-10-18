<?php

namespace App\Testimonials;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    const AVATARS = 'avatars';
    const DEFAULT_AVATARS = [
        '/images/testimonials/star-avatar.jpg',
        '/images/testimonials/heart-avatar.jpg'
    ];

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

    public function scopeForLocale($query)
    {
        $query->where('language', $this->normalizedLocale());
    }

    private function normalizedLocale()
    {
        $locale = app()->getLocale();
        if($locale === 'en' || $locale === 'en-US') {
            return 'en';
        }

        return 'zh';
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CROP, 300, 300)
             ->optimize()
             ->performOnCollections(self::AVATARS);
    }

    public function getAvatar()
    {
        $avatar = $this->getFirstMedia(self::AVATARS);

        return $avatar ? $avatar->getUrl('thumb') : Arr::random(self::DEFAULT_AVATARS);
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
