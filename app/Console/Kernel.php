<?php

namespace App\Console;

use App\Console\Commands\AssignDesignationToExistingArticles;
use App\Console\Commands\CacheWeather;
use App\Console\Commands\GenerateSiteMap;
use App\Console\Commands\MergeLifestyleIntoCulture;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CacheWeather::class,
        GenerateSiteMap::class,
        MergeLifestyleIntoCulture::class,
        AssignDesignationToExistingArticles::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('weather:cache')->cron('0 */12 * * *');
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('02:00');
        $schedule->command('sitemap:generate')->daily()->at('03:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
