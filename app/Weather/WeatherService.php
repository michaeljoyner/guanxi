<?php


namespace App\Weather;


class WeatherService
{
    private $api_key;
    private $locations;
    private $json;

    public function __construct($api_key, $locations, $json)
    {
        $this->api_key = $api_key;
        $this->locations = $locations;
        $this->json = $json;
    }

    public function getCurrent()
    {
        collect($this->locations)->each(function($location) {
           $this->cacheWeatherFor($location);
        });
    }

    protected function cacheWeatherFor($location)
    {
        try {
            $response = $this->json->fetch($this->locationUrl($location));
        } catch(\Exception $e) {
            return $this->clearLocationFromCache($location);
        }

        if($this->hasErrorResponse($response)) {
            return $this->clearLocationFromCache($location);
        }

        cache()->put('weather:' . strtolower($location), (array) $this->covertToArray($response->current), 245);
    }

    protected function hasErrorResponse($response)
    {
        return array_key_exists('error', $this->covertToArray($response));
    }

    protected function clearLocationFromCache($location)
    {
        cache()->forget('weather:' . strtolower($location));
    }

    protected function locationUrl($location)
    {
        return sprintf('http://api.apixu.com/v1/current.json?key=%s&q=%s', $this->api_key, $location);
    }

    protected function covertToArray($object)
    {
        return json_decode(json_encode($object), true);
    }
}