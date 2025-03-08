<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Providers\ShippingService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ExportBySingleOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $shipmentData;
    protected  $id;

    /**
     * Create a new job instance.
     *
     * @param int $id
     */
    public function __construct($shipmentData, $id)
    {
        $this->shipmentData = $shipmentData;
        $this->id =  $id;
    }

    /**
     * Execute the job.
     */
    public function handle(ShippingService $shippingService): void
    {
        // $response = $shippingService->createShipment($this->shipmentData);

        // if (!$response['HasErrors']) {
        //     ImportOrder::where('order_id', $this->id)->update(['is_shipped' => 1]);
        // }

        // Log::channel('creteShipLog')->info($response);

        // Log::emergency('emergency message');
        // Log::alert('alert message');
        // Log::critical('critical message');
        // Log::error('error message');
        // Log::warning('warning message');
        // Log::notice('notice message');
        // Log::info('info message');
        // Log::debug('debug message');
        // Log::info($response->joson());
        // Log::info('hello this is from handle with id: ' . $this->id);
        // Your export logic here
    }
}
