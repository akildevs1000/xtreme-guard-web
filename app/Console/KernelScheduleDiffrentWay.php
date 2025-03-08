<?php

namespace App\Console;

use App\Models\User;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class KernelScheduleDiffrentWay extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Define an array of commands and their schedules
        $commands = [
            'warehouse_stock_upload' => 'app:post-stocks-command',
            'import_order_schedule' => 'app:import-order-command',
            'export_order_schedule' => 'app:create-shipment-command',
            'low_qty_notification_schedule' => 'app:low-stock-notification-command',
            'tracking_order_schedule' => 'app:tracking-order-from-aramex-command',
        ];

        // Iterate through each command and schedule it if valid
        foreach ($commands as $settingKey => $command) {
            $scheduleTime = $this->getSetting($settingKey);

            if ($this->isValidScheduleTime($scheduleTime)) {
                $schedule->command($command)
                    ->$scheduleTime() // Dynamically call the schedule time method
                    ->appendOutputTo($this->logPath($this->generateLogFileName($command)))
                    ->monitorName($this->generateMonitorName($command));
            }
        }

        $schedule->command('app:db-backup-command')
            ->dailyAt('3:00')
            ->appendOutputTo($this->logPath('DatabaseBackup.log'))->monitorName('DatabaseBackup');
    }

    protected function generateLogFileName(string $command): string
    {
        // Remove 'app:' prefix and convert command name to lowercase for log file name
        $commandName = strtolower(str_replace('app:', '', $command));
        return "{$commandName}.log";
    }

    protected function generateMonitorName(string $command): string
    {
        // Remove 'app:' prefix and convert command name to camel case for monitor name
        $str = str_replace('-', ' ', str_replace('-command', '', ucfirst(str_replace('app:', '', $command))));
        return ucwords($str);
    }

    protected function getSetting($key)
    {
        return Setting::where('key', $key)->whereIsActive(1)->value('value');
    }

    protected function isValidScheduleTime($scheduleTime)
    {
        // List of valid scheduling methods supported by Laravel
        $validMethods = [
            'everyMinute',
            'everyTwoMinutes',
            'everyFiveMinutes',
            'everyTenMinutes',
            'everyThirtyMinutes',
            'hourly',
            'daily',
            'weekly',
            'monthly',
        ];

        // Validate if the method exists in Laravel's schedule class
        return in_array($scheduleTime, $validMethods);
    }

    protected function logPath($filename)
    {
        $logDirectory = storage_path("logs/kernal_logs");

        // Ensure the log directory exists
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0755, true);
        }

        return $logDirectory . '/' . $filename;
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
