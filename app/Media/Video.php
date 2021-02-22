<?php

namespace App\Media;

use App\Content\BannerFeature;
use App\Content\CanBeFeatured;
use App\IsPublishable;
use App\People\Profile;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements CanBeFeatured
{
    use Sluggable, HasTranslations, IsPublishable, HasContributor;

    const PLATFORM_YOUTUBE = 'youtube';
    const PLATFORM_VIMEO = 'vimeo';
    const PLATFORM_UNKNOWN = 'unknown';

    protected $table = 'videos';

    protected $fillable = ['title', 'description', 'video_url', 'embed_url', 'thumbnail'];

    protected $casts = ['published' => 'boolean'];

    public $translatable = ['title', 'description'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }


    public static function createWithTranslations($data, $contributor = null)
    {
        $video = static::create([
            'title'       => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'description' => ['en' => $data['description'], 'zh' => $data['zh_description']],
            'video_url'   => $data['video_url'],
            'embed_url' => $data['embed_url'],
            'thumbnail' => $data['thumbnail'] ?? null
        ]);

        if($contributor) {
            $video->profile_id = $contributor->id;
            $video->save();
        }

        return $video;
    }

    public function updateWithTranslations($data)
    {
        return $this->update([
            'title'       => [
                'en' => $data['title'] ?? $this->title,
                'zh' => $data['zh_title'] ?? $this->getTranslation('title', 'zh')
            ],
            'description' => [
                'en' => $data['description'] ?? $this->description,
                'zh' => $data['zh_description'] ?? $this->getTranslation('description', 'zh')
            ]
        ]);
    }

    public function embedHtml()
    {
        return sprintf('<iframe class="absolute inset w-full h-full" src="%s" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', $this->embed_url);
    }

    public function feature(): BannerFeature
    {
        return BannerFeature::fromVideo($this);
    }

    public function bannerTitle($locale): string
    {
        return $this->getTranslation('title', 'en');
    }

    public function fullSLug(): string
    {
        return sprintf("videos/%s", $this->slug);
    }

    public function featureImage(): string
    {
        return $this->thumbnail;
    }

    public function viewable(): bool
    {
        return true;
    }
}
