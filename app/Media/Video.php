<?php

namespace App\Media;

use App\IsPublishable;
use App\People\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
    use HasTranslations, IsPublishable;

    const PLATFORM_YOUTUBE = 'youtube';
    const PLATFORM_VIMEO = 'vimeo';
    const PLATFORM_UNKNOWN = 'unknown';

    protected $table = 'videos';

    protected $fillable = ['title', 'description', 'video_url', 'embed_url'];

    protected $casts = ['published' => 'boolean'];

    public $translatable = ['title', 'description'];

    public function contributor()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public static function createWithTranslations($data, $contributor = null)
    {
        $video = static::create([
            'title'       => ['en' => $data['title'], 'zh' => $data['zh_title']],
            'description' => ['en' => $data['description'], 'zh' => $data['zh_description']],
            'video_url'   => $data['video_url'],
            'embed_url' => $data['embed_url']
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
        return sprintf('<iframe src="%s" width="500" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', $this->embed_url);
    }
}
