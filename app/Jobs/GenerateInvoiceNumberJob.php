<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class GenerateInvoiceNumberJob implements ShouldQueue
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
        $this->queueProgress(0);
        sleep(3);
        Log::info('from GenerateInvoiceNumberJob 0', $this->data);

        $this->queueProgress(50);
        sleep(3);

        Log::info('from GenerateInvoiceNumberJob 50', $this->data);
        sleep(3);

        $this->queueProgress(100);
        Log::info('from GenerateInvoiceNumberJob 100', $this->data);
    }
}
