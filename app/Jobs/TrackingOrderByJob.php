<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use App\Http\Controllers\Pages\Shipment\TrackingController;

class TrackingOrderByJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @param int $id
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $this->queueProgress(0);
        // ini_set('max_execution_time', 400); // 6 minutes
        // ini_set('memory_limit', '512M');

        // sleep(20);
        // Log::info('from TrackingOrderByJob ', [$this->data]);
        // $res =  app(TrackingController::class)->getTrackingShipmentByTrackingId($this->data);
        // Log::info($res);

        $this->queueProgress(10);

        $maxRetries = env('MAX_RETRIES', 3);

        try {
            $res = app(TrackingController::class)->getTrackingShipmentByTrackingIdByJob($this->data, 0, $maxRetries);
            Log::info('Tracking response', [$res]);
            $this->queueProgress(100);
        } catch (\Exception $e) {
            Log::error('Tracking Error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }
    }
}
