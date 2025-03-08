<?php

namespace App\Http\Controllers\Pages\Order;

use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Mail\OrderInvoiceMail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Shipment\OrderTracking;
use App\Models\ImportOrder\ImportOrder;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Orders\ShipmentRepo;
use App\Repositories\Orders\ImportOrderRepo;
use App\Models\Pickup\PickupShipmentTracking;
use App\Http\Controllers\Pages\Application\MailController;
use App\Http\Controllers\Pages\Shipment\TrackingController;

class OrderController extends Controller
{
    protected $modelName = 'Orders';
    protected $routeName = 'order.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(ImportOrder $model, ImportOrderRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;

        $this->middleware('userpermission:orders-pending-orders-view')->only('index');
        $this->middleware('userpermission:orders-confirmed-orders-view')->only('confirmedOrder');
        $this->middleware('userpermission:orders-delivered-orders-view')->only('deliveredOrder');
        $this->middleware('userpermission:orders-pickup-orders-view')->only('pickupedOrder');
        $this->middleware('userpermission:orders-pending-orders-view')->only('show');
    }

    public function index(Request $request)
    {
        // return  $orders = $this->repo->getAllOrdes($request);
        $orders = $this->repo->getAllOrdes($request);
        $permissions = $this->repo->getAccessPermission();

        if ($request->ajax()) {
            return Datatables::of($orders)->addIndexColumn()
                ->addColumn('action', function ($orders) use ($permissions) {
                    return actionBtns(
                        $orders->order_id,
                        'order.edit',
                        'order/order',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        logActivity('Pending Order', 'Pending Order', 'View');
        return view('pages/orders/order/index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function confirmedOrder(Request $request)
    {
        // return $orders = $this->repo->getConfirmedAllOrdes($request)->get();
        $orders = $this->repo->getConfirmedAllOrdes($request);
        $permissions = $this->repo->getAccessPermission();

        if ($request->ajax()) {
            return Datatables::of($orders)->addIndexColumn()
                ->addColumn('action', function ($orders) use ($permissions) {
                    return actionBtns(
                        $orders->order_id,
                        'order.edit',
                        'order/order',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        logActivity('confirmed Order', 'confirmed Order', 'View');
        return view('pages/orders/order/confirmed-order', [
            'title' =>   'Confirmed Order',
        ]);
    }

    public function deliveredOrder(Request $request)
    {
        // $orders = $this->repo->getDeliveredAllOrdes($request)->get();
        $orders = $this->repo->getDeliveredAllOrdes($request);
        $permissions = $this->repo->getAccessPermission();

        if ($request->ajax()) {
            return Datatables::of($orders)->addIndexColumn()
                ->addColumn('action', function ($orders) use ($permissions) {
                    return actionBtns(
                        $orders->order_id,
                        'order.edit',
                        'order/order',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        logActivity('Delivered Order', 'Delivered Order', 'View');
        return view('pages/orders/order/delivered-order', [
            'title' =>   'Delivered Order',
        ]);
    }

    public function pickupedOrder(Request $request)
    {
        // $pickup = $this->repo->getAllPickupOrdes($request)->get();

        $pickup = $this->repo->getAllPickupOrdes($request);
        $permissions = $this->repo->getPickupAccessPermission();

        if ($request->ajax()) {
            return Datatables::of($pickup)->addIndexColumn()
                ->addColumn('action', function ($pickup) use ($permissions) {
                    return actionBtns(
                        $pickup->order_id,
                        'order.edit',
                        'order/order',
                        $pickup->pickup_id,
                        $permissions


                        // $orders->order_id,
                        // 'order.edit',
                        // 'order/order',
                        // $orders->tracking->shiping_reference_number ?? '',
                        // $permissions

                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        logActivity('Pickup Order', 'Pickup Order', 'View');
        return view('pages/orders/order/pickup-order', [
            'title' =>   'Pickup Order',
        ]);
    }

    public function show($id)
    {

        $singleOrder = $this->repo->getOrdeById($id);

        if (!$singleOrder) {
            abort(440, 'Report type not supported.');
        }

        $orderPram = [
            'limit' => 500,
            'page' => 1,
            'order_id' => $id,
            // 'start_date' => '2024-05-24',  // Use the relevant start date
            // 'end_date' => '2024-07-16',    // Use the relevant end date

            'start_date' => date('Y-m-d', strtotime('-1 day')),  // Yesterday's date
            'end_date' => date('Y-m-d', strtotime('+1 day')),    // Tomorrow's date
            // 'status' => 'payment_completed'
        ];

        $controller = app(ImportController::class);
        $controller->gerOrders($orderPram);

        // return $this->repo->getOrdeById($id);


        $pickupShipmentTrackingId = $singleOrder?->orderReturn?->pickupShipment?->pickup_shiping_reference_number;

        generateTaxInvoiceNumber($singleOrder->order_date, $id);

        $trackingId = $singleOrder?->tracking?->shiping_reference_number;

        if ($trackingId) {
            app(TrackingController::class)->getTrackingShipmentByTrackingIdForBulkInsert($trackingId);
        }

        if ($pickupShipmentTrackingId) {
            app(TrackingController::class)->getReturnTrackingShipmentByTrackingIdForBulkInsert($pickupShipmentTrackingId);
        }

        $OrderTrackingHistory = OrderTracking::whereOrderId($id)->orderBy('update_date_time_converted', 'desc')->get();
        $returnOrderTrackingHistory = PickupShipmentTracking::whereOrderId($id)->orderBy('update_date_time_converted', 'desc')
            ->get();

        logActivity('View Order', $id, 'View');
        return  view('pages/orders/order/show', [
            'order' => $singleOrder->fresh(),
            'title' => 'View Order',
            'orderTrackingHistory' => $OrderTrackingHistory,
            'returnOrderTrackingHistory' => $returnOrderTrackingHistory
        ]);
    }

    private function generatePDF($id)
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
        return $this->generatePDF($id)->download("invoice-order-$id.pdf");
    }

    public function previewInvoicePDF($id)
    {
        // $order = $this->repo->getOrdeById($id);

        // return view('pages.orders.order.invoice-pdf', ['order' => $order]);

        // $pdf = PDF::loadView(
        //     'pages.orders.order.invoice-pdf',
        //     ['order' => $order],
        //     [],
        //     [
        //         'margin_left'  => 5,
        //         'margin_right' => 5,
        //         'display_mode' => 'fullpage',
        //         'default_font_size' => '10',
        //         'format' => 'A4',
        //         'orientation' => 'P',


        //         // 'display_mode' => 'fullpage' // Options: 'fullwidth', 'real', 'default', 'none', 'two', 'twoleft', 'tworight'

        //     ]
        // );

        // return    $pdf;

        $pdf = $this->generatePDF($id);

        return $pdf->stream();
    }

    private function generatePDFPath()
    {
        $directory = 'public/invoices';

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0777, true); // The third argument is recursive
        }

        // sudo chown -R www-data:www-data /var/www/oms/storage after deployee generate pdf its some error so we can use command to solve
        //nohup php artisan queue:work > /dev/null 2>&1 &

        return;
        $path = storage_path('app/public/invoices');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public function sendMailToCustomerBK($orderId)
    {
        // return  $order = $this->repo->getOrdeById($orderId);

        $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);

        if ($order) {

            // $this->generatePDF($orderId);
            // $this->generatePDF($orderId)->stream();

            // MailController::toSendMail('fahath.mirnah@gmail.com', new OrderInvoiceMail(), $order, true);
            MailController::toSendMail('m.fahath@mirnah.com', new OrderInvoiceMail(), $order, true);

            $out = ['customer' => $order->customer->first_name, 'order_id' => $order->order_id];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));
            return redirect()->back()->with('success',  'Invoice successfully sent to the customer email');
        }
    }
}
