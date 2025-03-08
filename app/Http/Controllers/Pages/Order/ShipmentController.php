<?php

namespace App\Http\Controllers\Pages\Order;

use Illuminate\Http\Request;
use App\Providers\JTIService;
use App\Enums\OrderStatusCode;
use App\Models\Order\OrderLog;
use App\Jobs\TrackingOrderByJob;
use App\Providers\ShippingService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ImportOrder\ImportOrder;
use App\Repositories\Orders\ShipmentRepo;
use App\Mail\sendInvoiceToCustomerByMaill;
use App\Http\Controllers\Pages\Order\InvoiceController;
use App\Http\Controllers\Pages\Application\MailController;
use App\Http\Controllers\Pages\Shipment\TrackingController;
use App\Http\Controllers\Pages\Administration\MailTrackingController;

class ShipmentController extends Controller
{
    protected $modelName = 'Shipping';
    protected $routeName = 'role.index';
    protected $isDestroyingAllowed;
    protected $shippingService;
    protected $repo;

    public function __construct(ShippingService $shippingService, ShipmentRepo $repo)
    {
        $this->repo = $repo;
        $this->shippingService = $shippingService;
    }

    public function index(Request $request)
    {
        $orders = $this->repo->getAllOrdes($request);

        foreach ($orders as $key => $order) {
            $shipmentData = $this->repo->prepareShipmentData($order);
        }

        return $shipmentData;

        $response = $this->shippingService->createShipment($shipmentData);

        return response()->json($response);
    }

    public function exportBySingleOrder($id)
    {
        $order = $this->repo->getOrdeByIdForExport($id);
        $shipmentData = $this->repo->prepareShipmentData($order);

        $response = $this->shippingService->createShipment($shipmentData);

        if (!$response['HasErrors']) {
            Log::channel('creteShipLog')->info(json_encode(['inputPayload' => $shipmentData, 'response' => $response->json()], JSON_PRETTY_PRINT));

            ImportOrder::where('order_id', $id)->update(['is_shipped' => 1, 'shipped_date' => now()]);

            OrderLog::create(['order_id' => $id, 'status_name' => 'Shipped to Warehouse', 'status' => OrderStatusCode::CreatedShipment->value ?? '', 'status_date' => now()]);

            (new JTIService)->updateOrderStatus(['order_id' => $id, 'status_code' => 'shipped_to_warehouse']);

            $ShipmentCreated = $this->repo->createShimpentResponse($response->json());

            $trackingResults = $this->shippingService->getTrackingInfo($ShipmentCreated);

            if (count($trackingResults['NonExistingWaybills']) == 0) {  //if exisist tracking it will store to DB
                $trackingCreated = $this->repo->createOrderTracking($trackingResults, $id);
            }

            app(InvoiceController::class)->generatePDF($id);

            (new JTIService)->uploadOrderInvoicePDF(['order_id' => $id]); //update status to JTI

            // $this->sendInvoiceToCustomerByMail($id);

            app(MailTrackingController::class)->sendInvoiceToCustomerByMail($id);

            logActivity('Export Order', 'Export Order - ' . $id, 'Create');

            return redirect()->back()->with('success',  'Order successfully exported.');
        } else {
            Log::channel('creteShipLogError')->error(json_encode(['inputPayload' => $shipmentData, 'response' => $response->json()], JSON_PRETTY_PRINT));
            return redirect()->back()->with('error',  'something went wrong.');
        }
    }

    public function exportBySingleOrderByCron($id)
    {
        $order = $this->repo->getOrdeByIdForExport($id);
        $shipmentData = $this->repo->prepareShipmentData($order);

        $response = $this->shippingService->createShipment($shipmentData);

        if (!$response['HasErrors']) {
            Log::channel('creteShipLog')->info(json_encode(['inputPayload' => $shipmentData, 'response' => $response->json()], JSON_PRETTY_PRINT));

            ImportOrder::where('order_id', $id)->update(['is_shipped' => 1, 'shipped_date' => now()]);

            OrderLog::create(['order_id' => $id, 'status_name' => 'Shipped to Warehouse', 'status' => OrderStatusCode::CreatedShipment->value ?? '', 'status_date' => now()]);

            (new JTIService)->updateOrderStatus(['order_id' => $id, 'status_code' => 'shipped_to_warehouse']);

            $ShipmentCreated = $this->repo->createShimpentResponse($response->json());

            if ($ShipmentCreated) {
                Log::info('shipmentcontroller >' . $ShipmentCreated['shiping_reference_number'] . '  ' . $id);
                // TrackingOrderByJob::dispatch($ShipmentCreated['shiping_reference_number']);

                TrackingOrderByJob::dispatch($ShipmentCreated['shiping_reference_number'])->delay(now()->addMinutes(2));
            }

            // $trackingResults = $this->shippingService->getTrackingInfo($ShipmentCreated);
            // if (count($trackingResults['NonExistingWaybills']) == 0) {  //if exisist tracking it will store to DB
            //     $trackingCreated = $this->repo->createOrderTracking($trackingResults, $id);
            // }

            app(InvoiceController::class)->generatePDF($id);

            (new JTIService)->uploadOrderInvoicePDF(['order_id' => $id]); //update status to JTI

            app(MailTrackingController::class)->sendInvoiceToCustomerByMail($id);

            return $id;
        } else {
            Log::channel('creteShipLogError')
                ->error(json_encode(['inputPayload' => $shipmentData, 'response' => $response->json()], JSON_PRETTY_PRINT));

            return $response->json();
        }
    }

    public function sendInvoiceToCustomerByMail($orderId)
    {
        $order = $this->repo->getOrdeByIdForExport($orderId);

        if ($order) {

            MailController::toSendMail('m.fahath@mirnah.com', new sendInvoiceToCustomerByMaill(), $order, true);

            $out = ['mail_type' => '2 - Shipment Mail', 'customer' => $order->customer->first_name, 'order_id' => $order->order_id];
            Log::channel('invoiceMail')->info(json_encode($out, JSON_PRETTY_PRINT));

            return redirect()->back()->with('success',  'Invoice successfully sent to the customer email');
        }
    }
}
