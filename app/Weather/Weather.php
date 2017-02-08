<?php


namespace App\Weather;


class Weather
{
    public static function for($location)
    {
        $weather = (object) cache('weather:' . strtolower($location));
        $weather->name = $location;

        return $weather;
    }

    public static function availableLocations()
    {
        return collect(config('weather.locations'))->filter(function($location) {
            return cache()->has('weather:' . strtolower($location));
        })->map(function($location) {
            return static::for($location);
        });
    }
}