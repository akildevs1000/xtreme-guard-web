<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse\WarehouseStock;
use App\Http\Controllers\Pages\Order\ImportController;
use App\Http\Controllers\Pages\Order\AutomationController;
use App\Http\Controllers\Pages\Order\WarehouseStockController;

class CreateShipmentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-shipment-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = date("Y-m-d H:i:s");

        try {
            $resp =  (new AutomationController)->exportBySingleOrderByCron();

            $numberOfNewExportOrders = count($resp['createdShipmentOrdersArr']);
            $orderIds = implode(", ", $resp['createdShipmentOrdersArr'] ?? []);

            echo "[" . $date . "] Cron: ExportOrder. " . $numberOfNewExportOrders . " new orders has been uploaded. executed in " . $resp['executionTime'] . " seconds.. order ids are " . $orderIds . " \n";
        } catch (\Throwable $th) {
            Log::channel("cron")->error('Cron: ExportOrder: Error Details: ' . $th, $resp);
        }
    }
}
