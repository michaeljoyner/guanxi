<?php


namespace App;


class FormattedUrl
{
    public static function from($url, $secure = false)
    {
        if(str_contains($url, '://')) {
            return $url;
        }
        return ($secure ? 'https://' : 'http://') . $url;
    }
}