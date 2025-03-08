<?php

namespace App\Console;

use App\Models\User;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel_bk_26_12_2024 extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $warehouseStockUploadTime = $this->getSetting('warehouse_stock_upload');
        $importOrderSchedule = $this->getSetting('import_order_schedule');
        $exportOrderSchedule = $this->getSetting('export_order_schedule');
        $LowQtyNotificationSchedule = $this->getSetting('low_qty_notification_schedule');
        $TrackingOrderSchedule = $this->getSetting('tracking_order_schedule');

        if ($this->isValidScheduleTime($warehouseStockUploadTime)) {
            $schedule->command('app:post-stocks-command')
                ->$warehouseStockUploadTime()
                ->appendOutputTo($this->logPath('warehouseUpload.log'))->monitorName('warehouseUpload');
        }

        if ($this->isValidScheduleTime($importOrderSchedule)) {
            $schedule->command('app:import-order-command')
                ->$importOrderSchedule()
                ->appendOutputTo($this->logPath('importOrder.log'))->monitorName('importOrder');
        }

        if ($this->isValidScheduleTime($exportOrderSchedule)) {
            $schedule->command('app:create-shipment-command')
                ->$exportOrderSchedule()
                ->appendOutputTo($this->logPath('ExportOrder.log'))->monitorName('ExportOrder');
        }

        if ($this->isValidScheduleTime($LowQtyNotificationSchedule)) {
            $schedule->command('app:low-stock-notification-command')
                ->$LowQtyNotificationSchedule()
                ->appendOutputTo($this->logPath('LowQtyNotificationSentMail.log'))->monitorName('LowQtyNotification');
        }

        if ($this->isValidScheduleTime($TrackingOrderSchedule)) {
            $schedule->command('app:tracking-order-from-aramex-command')
                ->$TrackingOrderSchedule()
                ->appendOutputTo($this->logPath('TrackingOrderFromAramex.log'))->monitorName('TrackingOrder');
        }

        $schedule->command('app:db-backup-command')
            ->dailyAt('3:00')
            ->appendOutputTo($this->logPath('DatabaseBackup.log'))->monitorName('DatabaseBackup');
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
