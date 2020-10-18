<?php

namespace App\Content;

use App\CanHaveNullRelationships;
use App\People\Profile;
use App\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Article extends Model implements HasMedia
{
    use Sluggable, HasTranslations, SoftDeletes, InteractsWithMedia, HasTags, CanHaveNullRelationships;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'description',
        'body',
        'published_on',
    ];

    protected $dates = ['published_on', 'deleted_at'];

    protected $casts = ['published' => 'boolean', 'is_featured' => 'boolean'];

    public $translatable = ['title', 'description', 'body'];

    protected $defaultTitleImages = [
        '/images/pizza.jpg'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source'   => 'title',
                'onUpdate' => !$this->hasBeenPublished()
            ]
        ];
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 250, 200)
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('web')
            ->fit(Manipulations::FIT_MAX, 800, 600)
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('large')
            ->fit(Manipulations::FIT_CROP, 1400, 560)
            ->keepOriginalImageFormat()
            ->optimize();
    }

    public function shouldDeletePreservingMedia(): bool
    {
        return true;
    }

    public function author()
    {
        return $this->belongsToOrNull(Profile::class, 'profile_id');
    }

    public function setAuthor(Profile $author)
    {
        $this->profile_id = $author->id;
        $this->save();

        return $this->author;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function setCategories($category_ids)
    {
        if (!is_array($category_ids)) {
            $category_ids = [intval($category_ids)];
        }

        return $this->categories()->sync($category_ids);
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function hasBeenPublished()
    {
        return !is_null($this->published_on);
    }

    public function publish()
    {
        if (!$this->hasBeenPublished()) {
            $this->published_on = Carbon::now();
        }
        $this->published = true;
        $this->save();

        return $this->published;
    }

    public function retract()
    {
        $this->published = false;
        $this->save();

        return $this->published;
    }

    public function setBody($content, $locale = 'en')
    {
        $this->setTranslation('body', $locale, $content);
        $this->save();

        return $this->getTranslation('body', $locale);
    }

    public function addImage($file)
    {
        return $this->addMedia($file)->preservingOriginal()->toMediaCollection();
    }

    public function setFeaturedImage(Media $image)
    {
        if ($this->doesNotOwnImage($image)) {
            throw new \Exception('Image must belong to post to be set as featured.');
        }
        $this->resetPreviousFeaturedToFalse();
        $image->setCustomProperty('is_feature', true);
        $image->save();
    }

    protected function doesNotOwnImage($image)
    {
        return ($image->model_type !== static::class) || (intval($image->model_id) !== $this->id);
    }

    protected function resetPreviousFeaturedToFalse()
    {
        $this->getMedia()->filter(function ($media) {
            return $media->getCustomProperty('is_feature');
        })->each(function ($media) {
            $media->setCustomProperty('is_feature', false);
            $media->save();
        });
    }

    public function featuredImage()
    {
        return $this->getMedia()->first(function ($media) {
            return $media->getCustomProperty('is_feature');
        });
    }

    public function titleImg($conversion = '')
    {
        $featured = $this->featuredImage();
        $titleImg = $featured ? $featured->getUrl($conversion) : $this->getFirstMediaUrl('default', $conversion);

        return $titleImg ?: collect($this->defaultTitleImages)->random();
    }


    public function updateMeta($data)
    {
        $this->update([
            'title'       => [
                'en' => $data['title'],
                'zh' => $data['zh_title']
            ],
            'description' => [
                'en' => $data['description'],
                'zh' => $data['zh_description']
            ]
        ]);
    }

    public function feature()
    {
        $this->clearAllFeaturedArticles();
        $this->is_featured = true;
        $this->save();

        return $this->is_featured;
    }

    protected function clearAllFeaturedArticles()
    {
        static::where('is_featured', 1)->get()->each(function($article) {
            $article->unfeature();
        });
    }

    public function unfeature()
    {
        $this->is_featured = false;
        $this->save();

        return $this->is_featured;
    }

    public function slideshows()
    {
        return $this->hasMany(Slideshow::class);
    }


    public function addSlideshow($title)
    {
        return $this->slideshows()->create(['title' => $title]);
    }

    public function parseBody($lang)
    {
        $exp = '/\[\*\* sl:([0-9]+):([a-z\-]+ \*\*\])/';
        $unparsed = $this->getTranslation('body', $lang);

        $parsed = preg_replace_callback($exp, function($matches) {
            $slideshow = Slideshow::find(intval($matches[1]));
            if(!$slideshow) {
                return "";
            }

            return $slideshow->html();

        }, $unparsed);

        return $parsed;


    }




}
