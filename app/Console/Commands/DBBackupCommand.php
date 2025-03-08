<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class DBBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:db-backup-command';

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
            exec("php artisan backup:run --only-db");

            // $this->deleteOldBackupFiles();

            $path = collect(glob(storage_path("app/OMS/*.zip")))->last();

            $filename =   basename($path);

            echo "[" . $date . "] Cron: DatabaseBackup: " . $filename . " database have been backed up..\n";
        } catch (\Throwable $th) {
            Log::channel("cron")->error('Cron: DatabaseBackup: Error Details: ' . $th);
        }
    }

    private function deleteOldBackupFiles()
    {
        $storagePath = storage_path('app/OMS');
        $thresholdDate = Carbon::now()->subDays(7);

        $filesToCollect = File::glob($storagePath . '/*.zip');

        $filteredFiles = array_filter($filesToCollect, function ($file) use ($thresholdDate) {
            return filemtime($file) <= $thresholdDate->timestamp;
        });

        // Now you can work with the $filteredFiles array
        foreach ($filteredFiles as $file) {
            echo $file . "\n";

            File::delete($file);
            Log::channel("cron")->info("Cron: DB Backup - OLD File is deleted.  : $file");
        }
    }
}
