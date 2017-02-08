<?php


use App\Weather\Weather;

class WeatherTest extends TestCase
{
    /**
     *@test
     */
    public function it_gets_the_correct_weather_info_for_a_location_if_in_cache()
    {
        $weather = \GuzzleHttp\json_decode(file_get_contents('tests/resources/currentweather.json'), true);
        cache()->put('weather:london', $weather['current'], 10);

        $londonWeather = Weather::for('London');

        $this->assertEquals(5.0, $londonWeather->temp_c);
        $this->assertEquals('Light rain', $londonWeather->condition['text']);
        $this->assertEquals('//cdn.apixu.com/weather/64x64/night/296.png', Weather::for('London')->condition['icon']);
    }

    /**
     *@test
     */
    public function it_returns_a_collection_of_available_weather_locations()
    {
        $weather = \GuzzleHttp\json_decode(file_get_contents('tests/resources/currentweather.json'), true);
        cache()->put('weather:taichung', $weather, 10);
        cache()->put('weather:hualien', $weather, 10);

        $result = Weather::availableLocations();

        $this->assertCount(2, $result);
    }
}