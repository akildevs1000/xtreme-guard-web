<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Pages\Order\AutomationController;

class ImportOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-order-command';

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
            $resp =  (new AutomationController)->ImportOrderByCron();

            $orderIds = implode(", ", $resp['newOrderArr'] ?? []);

            echo "[" . $date . "] Cron: ImportOrder. " . $resp['numberOfNewOrder'] . " new orders has been uploaded. executed in " . $resp['executionTime'] . " seconds.. order ids are " . $orderIds . " \n";
        } catch (\Throwable $th) {
            Log::channel("cron")->error('Cron: ImportOrder: Error Details: ' . $th);
        }
    }
}
