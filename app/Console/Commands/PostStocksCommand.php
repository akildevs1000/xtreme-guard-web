<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Warehouse\WarehouseStock;
use Illuminate\Support\Facades\Notification;
use App\Notifications\schedulerFailedNotification;
use App\Http\Controllers\Pages\Order\AutomationController;

class PostStocksCommand extends Command
{

    protected $signature = 'app:post-stocks-command';

    protected $description = 'Command description';

    public function handle()
    {
        $count = WarehouseStock::count();
        $date = date("Y-m-d H:i:s");

        try {
            $importStock = (new AutomationController)->importStockFromRoutePro();
            $itemCodes = implode(", ", $importStock['new_item_codes']);

            echo "[" . $date . "] Cron: importStockFromRoutePro: " . $importStock['new_records_count'] . " new warehouse stock has been imported item codes are
            " . $itemCodes . ".\n";

            (new AutomationController)->uploadWarehouseStockData();
            echo "[" . $date . "] Cron: UploadWarehouse: " . $count . "  warehouse stock has been uploaded.\n";
        } catch (\Throwable $th) {

            $data = [
                'job_name' => 'Upload Stock to Magento',
                'data' => $th,
            ];

            Notification::route('mail', 'm.fahath@mirnah.com')
                ->notify(new schedulerFailedNotification($data));

            Log::channel("cron")->error('Cron: importStockFromRoutePro/UploadWarehouse: Error Details: ' . $th);
        }
    }
}
