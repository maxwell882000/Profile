<?php

namespace App\Console;

use App\Domain\Installment\CustomInstallment\Schedule\CustomInstallmentDailyCheck;
use App\Domain\Installment\CustomInstallment\Schedule\CustomInstallmentPennyCheck;
use App\Domain\Installment\Schedule\InstallmentCheckForPenny;
use App\Domain\Installment\Schedule\InstallmentDailyCheck;
use App\Domain\Telegrams\Schedule\TelegramSchedule;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     * write tests on every single
     */
    protected function schedule(Schedule $schedule)
    {
        InstallmentDailyCheck::schedule($schedule); // check this one required !!!
//        // Month Paid Jobs
////        AvailableCitiesSchedule::schedule($schedule);
        TelegramSchedule::schedule($schedule);
        CustomInstallmentDailyCheck::schedule($schedule);
        InstallmentCheckForPenny::schedule($schedule);
        CustomInstallmentPennyCheck::schedule($schedule);
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run --only-db')->daily()->at('01:30');
    }
    /*
curl -k -d "grant_type=client_credentials" \
-H "Authorization: Basic SVpSbE1SZGxYUHJSd0hmeWVMdFA0TEduX1RnYTpQcXdGVG9IOE5xT0duUEo4enAwNUdSQ1hUNWNh" \
https://api.paymo.uz/token
    */
    /**
     * Register the commands for the application.
     *
     * @return void
     *
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
