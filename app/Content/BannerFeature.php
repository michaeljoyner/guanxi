<?php

namespace App\Content;

use App\Media\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BannerFeature extends Model implements HasMedia
{

    use InteractsWithMedia;

    const IMAGES = 'images';

    protected $fillable = ['feature_id', 'feature_type'];

    public function feature()
    {
        return $this->morphTo();
    }

    public static function fromArticle(Article $article): self
    {
        return static::create([
            'feature_id'   => $article->id,
            'feature_type' => Article::class,
        ]);
    }

    public static function fromVideo(Video $video): self
    {
        return static::create([
            'feature_id'   => $video->id,
            'feature_type' => Video::class,
        ]);
    }

    public static function current(): self
    {
        $banners = static::latest()->limit(50)->get();

        if ($banners->count() === 0) {
            return new static;
        }

        return $banners->first(fn(BannerFeature $b) => $b->usable()) ?? new static;
    }

    public function title($locale)
    {
        if(!$this->feature) {
            return '';
        }

        return $this->feature->bannerTitle($locale);
    }

    public function image(): string
    {
        if(!$this->feature) {
            return '';
        }

        $image = $this->getFirstMediaUrl(static::IMAGES, 'web');

        return $image ? $image : $this->feature->featureImage();
    }

    public function linksTo(): string
    {
        if(!$this->feature) {
            return '';
        }
        return $this->feature->fullSlug();
    }

    public function presentForLang($locale)
    {
        $type = $this->feature_type === Article::class ? 'article' : 'video';
        return [
            'id'    => $this->id,
            'title' => $this->title($locale),
            'link'  => $this->linksTo(),
            'button_text' => trans("homepage.banner.{$type}"),
            'image' => $this->image(),
            'type'  => $type,
        ];
    }

    public function usable()
    {
        return $this->feature && $this->feature->viewable();
    }

    public function setImage(UploadedFile $upload): Media
    {
        $this->clearImage();
        return $this->addMedia($upload)
                    ->usingFileName($upload->hashName())
                    ->toMediaCollection(static::IMAGES);
    }

    public function clearImage()
    {
        $this->clearMediaCollection(static::IMAGES);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('web')
             ->fit(Manipulations::FIT_CROP, 1600, 900)
             ->keepOriginalImageFormat()
             ->optimize()
             ->performOnCollections(static::IMAGES);
    }


}
