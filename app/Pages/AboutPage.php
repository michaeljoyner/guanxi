<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutPage extends Model
{
    use HasTranslations;

    protected $table = 'about_pages';

    protected $fillable = [];

    protected $translatable = ['marketing', 'events_text', 'story', 'contribute', 'contact'];

    public static function setStory($story)
    {
        return static::setSectionContent('story', $story);
    }

    public static function story($allTranslations = false)
    {
        return static::getTranslatedSectionContent('story', $allTranslations);
    }

    public static function setMarketing($content)
    {
        return static::setSectionContent('marketing', $content);
    }

    public static function marketing($allTranslations = false)
    {
        return static::getTranslatedSectionContent('marketing', $allTranslations);
    }

    public static function setEvents($content)
    {
        return static::setSectionContent('events_text', $content);
    }

    public static function events($allTranslations = false)
    {
        return static::getTranslatedSectionContent('events_text', $allTranslations);
    }

    public static function setContribute($content)
    {
        return static::setSectionContent('contribute', $content);
    }

    public static function contribute($allTranslations = false)
    {
        return static::getTranslatedSectionContent('contribute', $allTranslations);
    }

    public static function setContact($content)
    {
        return static::setSectionContent('contact', $content);
    }

    public static function contact($allTranslations = false)
    {
        return static::getTranslatedSectionContent('contact', $allTranslations);
    }

    public static function getContent()
    {
        return ['page' => static::firstOrCreate([])];
    }

    protected static function setSectionContent($section, $content)
    {
        $page = static::firstOrCreate([]);
        $page->{$section} = $content;
        return $page->save();
    }

    protected static function getTranslatedSectionContent($section, $allTranslations = false)
    {
        $page = static::firstOrCreate([]);
        if(! $allTranslations) {
            return $page->{$section};
        }
        return $page->getTranslations($section);
    }
}
