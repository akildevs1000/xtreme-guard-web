<?php

namespace App\Traits;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Orders\ImportOrderRepo;

trait PDFGenerate
{
    public function generateLowStockNotifyPDF($lowStockData)
    {
        $lowStockData;

        $fileNmae = date('Y-m-d');
        $location = 'lowstock';

        $this->generatePDFPath($location);

        $pdf = Pdf::setPaper('a4', 'landscape')->loadView('pages.orders.warehouse.lowstock-notify', ['lowStockData' => $lowStockData]);
        $pdf->save(storage_path("app/public/$location") . "/low-stock-$fileNmae.pdf");

        return $pdf;
        // return  $pdf->stream();
    }


    private function generatePDFPath($path = "")
    {
        $directory = "public/$path";

        // Check if the directory exists and create it if necessary
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true); // The third argument is recursive
        }

        return;

        // Define the path
        $path = storage_path('app/public/invoices');

        // Check if the directory exists
        if (!file_exists($path)) {
            // Create the directory if it doesn't exist
            mkdir($path, 0777, true);
        }
    }
}
