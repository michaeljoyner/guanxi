<?php

namespace App\Console\Commands;

use App\Weather\WeatherService;
use Illuminate\Console\Command;

class CacheWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches current weather and caches it';
    /**
     * @var WeatherService
     */
    private $weatherService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WeatherService $weatherService)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->weatherService->getCurrent();
    }
}
