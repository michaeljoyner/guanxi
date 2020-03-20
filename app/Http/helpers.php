<?php

function localUrl($url) {
    return Localization::getLocalizedURL(Localization::getCurrentLocale(), $url);
}

