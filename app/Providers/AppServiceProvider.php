<?php

namespace App\Providers;

use App\Services\JsonPayload;
use App\Weather\WeatherService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('activenav', function($path) {
            return "<?php if(starts_with(substr(request()->path(), 3), $path)) { echo 'active'; }; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherService::class, function($app) {
            return new WeatherService(env('WEATHER_API_KEY'), config('weather.locations'), $app->make(JsonPayload::class));
        });
    }
}
