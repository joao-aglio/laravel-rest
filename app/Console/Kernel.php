<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\ReserveBook;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            $reserves = ReserveBook::where('active', 1)->get();

            foreach ($reserves as $reserve){

                $data = Carbon::create($reserve->reserve_until);

                if ($data->lt(now())){
                    
                    $reserve->active = 0;
                    $reserve->update();

                }
            };

        })->everySecond();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
