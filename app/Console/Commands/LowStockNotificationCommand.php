<?php

namespace App\Console\Commands;

use App\Traits\PDFGenerate;
use App\Models\Setting\Setting;
use Illuminate\Console\Command;
use App\Mail\LowStockNotifyMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Pages\Application\MailController;
use App\Http\Controllers\Pages\Administration\SettingController;

class LowStockNotificationCommand extends Command
{
    use PDFGenerate;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:low-stock-notification-command';

    protected $description = 'Command description';

    public function handle()
    {
        $date = date("Y-m-d H:i:s");

        try {
            $lowStockData = (new SettingController)->LowQtyNotify() ?? [];

            if ($lowStockData) {

                $this->generateLowStockNotifyPDF($lowStockData);

                $email = Setting::where('key', 'low_qty_notification_email')->first()->value;

                if (env('APP_ENV') == 'production') {
                    MailController::toSendMail($email, new LowStockNotifyMail(), $lowStockData);
                }

                MailController::toSendMail('m.fahath@mirnah.com', new LowStockNotifyMail(), $lowStockData);
            }

            echo "[" . $date . "] Cron: LowStockNotify. " . count($lowStockData) . " stocks has been send..\n";
        } catch (\Throwable $th) {
            Log::channel("cron")->error('Cron: LowStockNotify: Error Details: ' . $th);
        }
    }
}
