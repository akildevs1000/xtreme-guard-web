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

class TrackingOrderFromAramexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tracking-order-from-aramex-command';

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
            $resp = (new AutomationController)->getTrackingShipmentByTrackingIdByCron();

            $numberOfFoundTrackingOrders = count($resp['createdTrackingOrdersArr']['found']);
            $numberOfNotFoundTrackingOrders = count($resp['createdTrackingOrdersArr']['notFound']);

            echo "[" . $date . "] Cron: TrackingOrder. "
                . "Found Orders Count: " . $numberOfFoundTrackingOrders . ", "
                . "Not Found Orders Count: " . $numberOfNotFoundTrackingOrders . ", "
                . "Response: " . $this->formatResponse($resp) . "\n";
        } catch (\Exception $th) {
            Log::channel("cron")->error('Cron: TrackingOrder: Error Details: ' . $th);
        }
    }

    public function formatResponse($resp)
    {
        return json_encode([
            'executionTime' => $resp['executionTime'],
            'found' => $resp['createdTrackingOrdersArr']['found'],
            'not found' => $resp['createdTrackingOrdersArr']['notFound'],
        ], JSON_PRETTY_PRINT);
    }
}
