<?php


namespace App;


use Illuminate\Support\Str;

class FormattedUrl
{
    public static function from($url, $secure = false)
    {
        if(Str::contains($url, '://')) {
            return $url;
        }
        return ($secure ? 'https://' : 'http://') . $url;
    }
}