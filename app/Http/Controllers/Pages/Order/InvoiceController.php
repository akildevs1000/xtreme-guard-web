<?php

namespace App\Http\Controllers\Pages\Order;

// use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\ImportOrder\ImportOrder;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Orders\ImportOrderRepo;
use PDF;

class InvoiceController extends Controller
{
    protected $modelName = 'invoice';
    protected $routeName = 'order.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(ImportOrder $model, ImportOrderRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    // public function generatePDF($id)
    // {
    //     // $this->generatePDFPath();

    //     // $order = $this->repo->getOrdeById($id);
    //     // $pdf = Pdf::loadView('pages.orders.order.invoice-pdf', ['order' => $order]);
    //     // $pdf->save(storage_path('app/public/invoices') . "/order-$id.pdf");

    //     // return $pdf;

    //     $this->generatePDFPath();

    //     $order = $this->repo->getOrdeById($id);
    //     $filePath = storage_path("app/public/invoices/order-$id.pdf");

    //     $pdf = Pdf::loadView('pages.orders.order.invoice-pdf', ['order' => $order]);
    //     $pdf->save($filePath);

    //     // Set full access permissions (e.g., 0777)
    //     chmod($filePath, 0777);

    //     return $pdf;

    //     // return  $pdf->stream();
    // }

    public function generatePDF($id)
    {
        $this->generatePDFPath();

        $order = $this->repo->getOrdeById($id);

        // ----------dompdf----------
        // $pdf = PDF::loadView('pages.orders.order.invoice-pdf', ['order' => $order]);
        // $pdf->save(storage_path('app/public/invoices') . "/order-$id.pdf");
        // ----------end dompdf----------

        // ----------mpdf----------
        $pdf = PDF::loadView(
            'pages.orders.order.invoice-pdf',
            ['order' => $order],
            [],
            [
                'margin_left'  => 5,
                'margin_right' => 5,
                'display_mode' => 'fullpage',
                'default_font_size' => '10',
                'format' => 'A4',
                'orientation' => 'P',
            ]
        );
        // ----------mpdf----------

        $pdf->save(storage_path('app/public/invoices') . "/order-$id.pdf");

        return $pdf;
    }

    public function downloadInvoicePDF($id)
    {
        return $this->generatePDF($id)->download();
    }

    public function previewInvoicePDF($id)
    {
        $pdf = $this->generatePDF($id);

        return $pdf->stream();
    }

    private function generatePDFPath()
    {
        $directory = 'public/invoices';

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true); // The third argument is recursive
        }

        return;

        $path = storage_path('app/public/invoices');

        // Check if the directory exists
        if (!file_exists($path)) {
            // Create the directory if it doesn't exist
            mkdir($path, 0777, true);
        }
    }

    public function test()
    {
        // MailController::toSendMail('fahathammex90@gmail.com', new OrderInvoiceMail(), $order);
        // return (new OrderInvoiceMail($order))->render();
    }
}
