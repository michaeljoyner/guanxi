<?php

namespace App\Content;

use App\People\Profile;
use App\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

class Article extends Model implements HasMediaConversions
{
    use Sluggable, HasTranslations, SoftDeletes, HasMediaTrait;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'description',
        'body',
        'published_on',
    ];

    protected $dates = ['published_on', 'deleted_at'];

    protected $casts = ['published' => 'boolean'];

    public $translatable = ['title', 'description', 'body'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => ! $this->hasBeenPublished()
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
    }

    public function shouldDeletePreservingMedia()
    {
        return true;
    }

    public function author()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
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
        if(! is_array($category_ids)) {
            $category_ids = [intval($category_ids)];
        }
        return $this->categories()->sync($category_ids);
    }

    public function hasBeenPublished()
    {
        return ! is_null($this->published_on);
    }

    public function publish()
    {
        if(!$this->hasBeenPublished()) {
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
        return $this->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }

    public function updateMeta($data)
    {
        $this->update([
            'title' => [
                'en' => $data['title'],
                'zh' => $data['zh_title']
            ],
            'description' => [
                'en' => $data['description'],
                'zh' => $data['zh_description']
            ]
        ]);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function addTag(Tag $tag)
    {
        $this->tags()->attach($tag->id);
    }

    public function removeTag(Tag $tag)
    {
        $this->tags()->detach($tag->id);
    }

    public function syncTags($tags)
    {
        $this->tags()->sync($tags);
    }

    public function createAndAttachTag($tagName)
    {
        $tag = Tag::firstOrCreate(['name' => $tagName]);

        if(!$this->tags->contains($tag)) {
            $this->addTag($tag);
        }

        return $tag;
    }


}
