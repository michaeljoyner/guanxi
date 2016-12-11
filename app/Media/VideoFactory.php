<?php


namespace App\Media;


use App\Media\EmbeddedVideo\VimeoVideo;
use App\Media\EmbeddedVideo\YoutubeVideo;
use App\Services\JsonPayload;

class VideoFactory
{
    const PLATFORM_YOUTUBE = 'youtube';
    const PLATFORM_VIMEO = 'vimeo';
    const PLATFORM_UNKNOWN = 'unknown';

    public static function createEmbeddedVideo($url)
    {
        if(static::platform($url) === static::PLATFORM_YOUTUBE) {
            return new YoutubeVideo($url, new JsonPayload());
        }

        if(static::platform($url) === static::PLATFORM_VIMEO) {
            return new VimeoVideo($url, new JsonPayload());
        }

        throw new UnknownPlatformException('The provided video link does not seem to be from an accepted platform');
    }

    protected static function platform($video_url)
    {
        $domain = static::getDomain(parse_url($video_url, PHP_URL_HOST));

        if (in_array($domain, ['youtube.com', 'youtu.be'])) {
            return static::PLATFORM_YOUTUBE;
        }

        if (in_array($domain, ['vimeo.com'])) {
            return static::PLATFORM_VIMEO;
        }

        return static::PLATFORM_UNKNOWN;
    }

    protected static function getDomain($host)
    {
        $parts = explode('.', $host);
        $length = count($parts);
        if (count($parts) > 2) {
            return $parts[$length - 2] . '.' . $parts[$length - 1];
        }

        return $host;
    }
}