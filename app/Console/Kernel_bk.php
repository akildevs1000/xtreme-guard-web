<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Controllers\Pages\Order\ImportController;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel_bk extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            try {
                $this->getAnyUser();
                Log::info("Kernel task schedule is running");
                // $controller = app(ImportController::class)->index();
                $this->logoutUser();
            } catch (\Exception $e) {
                Log::error('Error in scheduled task: ' . $e->getMessage());
            }
        })->everyMinute()->appendOutputTo(storage_path('logs/output.log'));

        $schedule->command('app:post-stocks-command')->everyMinute()
            ->appendOutputTo(storage_path("logs/kernal_logs/cron.log"));



        $schedule->call(function () {
            try {
                Log::info("Kernel task schedule is running");
            } catch (\Exception $e) {
                Log::error('Error in scheduled task: ' . $e->getMessage());
            }
        })->everyTwentySeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    private function getAnyUser()
    {
        $user = User::where('username', 'fahath')->first();
        Auth::login($user);
    }

    private function logoutUser()
    {
        Auth::logout();
    }
}
