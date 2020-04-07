<?php

namespace App\Content;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Slideshow extends Model implements HasMedia
{
    use HasMediaTrait;

    const SLIDES = 'slides';

    protected $fillable = ['title'];

    public function addImage(UploadedFile $file)
    {
        return $this->addMedia($file)
            ->usingFileName(Str::random(10))
                    ->preservingOriginal()
                    ->toMediaCollection(self::SLIDES);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('web')
             ->fit(Manipulations::FIT_MAX, 800, 1800)
             ->optimize()
             ->performOnCollections(self::SLIDES);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function html()
    {
        $images = $this->getMedia(self::SLIDES)->map(fn ($image) => $image->getUrl('web'));
        $html = Str::of('<div class="guanxi-article-slideshow">' . "\n");

        $images->each(function($src) use (&$html) {
            $html = $html->append("    <img src=\"{$src}\">\n");
        });

//        $images->each(fn ($src) => $html = $html->append("\t<img src=\"{$src}\">"));

        $html = $html->append('</div>');

        return (string) $html;
    }

    public function canBeEditedBy(User $user)
    {
        if($user->isSuperAdmin()) {
            return true;
        }

        if($user->profile->id === $this->article->author->id) {
            return true;
        }

        return false;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'thumb' => $this->getFirstMediaUrl(self::SLIDES, 'web'),
            'count' => $this->getMedia(self::SLIDES)->count(),
        ];
    }
}
