<?php


use App\Services\JsonPayload;

class WeatherServiceTest extends TestCase
{
    /**
     *@test
     */
    public function it_gets_the_weather_for_a_location()
    {
        $json = $this->createMock(JsonPayload::class);
        $json->method('fetch')->willReturn(json_decode(file_get_contents('tests/resources/currentweather.json')));

        $this->app->bind(JsonPayload::class, function($app) use ($json) {
            return $json;
        });

        config(['weather.locations' => ['London']]);

        $this->app->make(\App\Weather\WeatherService::class)->getCurrent();

        $this->assertTrue(cache()->has('weather:london'));
        $this->assertEquals(cache('weather:london'), json_decode(file_get_contents('tests/resources/currentweather.json'), true)['current']);
    }

    /**
     *@test
     */
    public function if_an_error_is_returned_the_weather_location_will_not_be_in_cache()
    {
        cache()->put('weather:london', ['current' => []], 60);
        $json = $this->createMock(JsonPayload::class);
        $json->method('fetch')->willReturn(json_decode(file_get_contents('tests/resources/weathererror.json')));

        $this->app->bind(JsonPayload::class, function($app) use ($json) {
            return $json;
        });
        config(['weather.locations' => ['London']]);

        $this->app->make(\App\Weather\WeatherService::class)->getCurrent();

        $this->assertFalse(cache()->has('weather:london'));
    }
}