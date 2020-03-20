<?php

use Illuminate\Support\Str;

function localUrl($url) {
    return sprintf("/%s/%s", app()->getLocale(), ltrim($url, '/'));
}

function transUrl($url) {
    $url = Str::start($url, '/');

    if($url === '/en-US' || $url === '/zh') {
        $url = $url . '/';
    }
    if(Str::startsWith($url, '/en-US/')) {
        $url = Str::replaceFirst('/en-US/', '/', $url);
    }

    if(Str::startsWith($url, '/zh/')) {
        $url = Str::replaceFirst('/zh/', '/', $url);
    }


    if(app()->getLocale() === 'en-US') {
        return '/zh/' . ltrim($url, '/');
    }

    return '/en-US/' . ltrim($url, '/');
}

function trunc($text, $chars) {
    if (strlen($text) > $chars)
    {
        $lastPos = ($chars - 3) - strlen($text);
        $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '...';
    }

    return $text;
}