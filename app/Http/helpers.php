<?php

function localUrl($url) {
    return Localization::getLocalizedURL(Localization::getCurrentLocale(), $url);
}

function trunc($text, $chars) {
    if (strlen($text) > $chars)
    {
        $lastPos = ($chars - 3) - strlen($text);
        $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '...';
    }

    return $text;
}