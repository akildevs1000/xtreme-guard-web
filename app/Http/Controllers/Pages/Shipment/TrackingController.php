<?php

namespace App\Http\Controllers\Pages\Shipment;

use Illuminate\Http\Request;
use App\Providers\ShippingService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Shipment\TrackingRepo;

class TrackingController extends Controller
{
    protected $modelName = 'Shipping';
    protected $routeName = 'role.index';
    protected $isDestroyingAllowed;
    protected $shippingService;
    protected $repo;

    public function __construct(ShippingService $shippingService, TrackingRepo $repo)
    {
        $this->repo = $repo;
        $this->shippingService = $shippingService;

        // $this->middleware('userpermission:orders-tracking-shipment')->only('index');
    }

    public function index(Request $request)
    {
        // return $orders = $this->repo->getConfirmedAllOrdesForTracking($request)->get();
        $orders = $this->repo->getConfirmedAllOrdesForTracking($request);
        $permissions = $this->repo->getAccessPermission();

        if ($request->ajax()) {
            return datatables()->of($orders)->addIndexColumn()
                ->addColumn('action', function ($orders) use ($permissions) {
                    // Log::info(json_encode(['shiping_reference_number' => $orders->tracking->shiping_reference_number]));
                    return actionBtns(
                        $orders->order_id,
                        'order.edit',
                        'order/order',
                        $orders->tracking->shiping_reference_number ?? '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/shipment/tracking/index', [
            'title' =>   'Tracking Order',
        ]);
    }

    public function getTrackingShipmentByTrackingId($trackingId) //tracking shipment
    {
        try {
            $trackingResults = $this->shippingService->getTrackingInfoByTrackingId($trackingId);

            if (empty($trackingResults['TrackingResults'])) {
                return  $this->response('Tracking not found', 'Not found', false);
            }

            $trackingResult = $trackingResults['TrackingResults'][0]['Value'][0];

            $selectedObj = ['WaybillNumber', 'UpdateCode', 'UpdateDescription', 'UpdateDateTime', 'UpdateLocation', 'Comments'];

            $arr = [];
            foreach ($trackingResult as $key => $value) {

                if (in_array($key, $selectedObj)) {

                    if ($key == 'UpdateDateTime') {
                        $arr[$key] = getDateAndTime($value ?? '---');
                    } else {
                        $arr[$key] = $value;
                    }
                }
            }

            $this->repo->createOrderTracking($trackingResults);

            return $arr;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getTrackingShipmentByTrackingIdForBulkInsert($trackingId) //tracking shipment
    {
        try {
            $trackingResults = $this->shippingService->getTrackingInfoByTrackingId($trackingId, false);

            if (empty($trackingResults['TrackingResults'])) {
                return $this->response('Tracking not found', 'Not found', false);
            }

            return  $this->repo->createBulkOrderTracking($trackingResults);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getReturnTrackingShipmentByTrackingIdForBulkInsert($trackingId) //tracking shipment
    {
        try {
            $trackingResults = $this->shippingService->getTrackingInfoByTrackingId($trackingId, false);

            if (empty($trackingResults['TrackingResults'])) {
                return $this->response('Tracking not found', 'Not found', false);
            }

            return  $this->repo->createBulkReturnOrderTracking($trackingResults);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getTrackingShipmentByTrackingIdByJob($trackingId, $retryCount = 0, $maxRetries = 3) //tracking shipment
    {
        try {
            ini_set('max_execution_time', 400); // 6 minutes
            ini_set('memory_limit', '512M');

            sleep(40);

            $trackingResults = $this->shippingService->getTrackingInfoByTrackingId($trackingId);

            Log::info("trackingResults", $trackingResults);

            if ($trackingResults['HasErrors']) {
                Log::info("trackingResults : HasErrors: " . $trackingResults['HasErrors']);
                return 'Tracking shipment HasErrors';
            }

            if (empty($trackingResults['TrackingResults'])) {
                if ($retryCount < $maxRetries) {
                    Log::warning("Retrying tracking for ID {$trackingId}. Attempt: " . ($retryCount + 1));
                    Log::info("maxRetries for No {$maxRetries}. Attempt: " . ($retryCount + 1));
                    $this->getTrackingShipmentByTrackingIdByJob($trackingId, $retryCount + 1, $maxRetries);
                } else {
                    Log::error("Tracking not found for ID {$trackingId} after {$maxRetries} attempts.");
                    return 'Tracking not found tracking id: ' . $trackingId;
                }
            } else {
                $this->repo->createOrderTracking($trackingResults);
                return 'Tracking found tracking id: ' . $trackingId;
            }
        } catch (\Throwable $th) {
            Log::error("Error in tracking shipment: {$th->getMessage()}");
            throw $th;
        }
    }

    public function getTrackingShipmentByTrackingIdForCron($orderId, $trackingId) //tracking shipment by automation
    {
        try {
            $trackingResults = $this->shippingService->getTrackingInfoByTrackingId($trackingId);

            if (empty($trackingResults['TrackingResults'])) {
                $out = "Order No $orderId : Tracking No $trackingId not found";
                return $out;
            }

            $this->repo->createOrderTracking($trackingResults);
            $statusCode = $trackingResults['TrackingResults'][0]['Value'][0]['UpdateCode'] ?? '-';
            $UpdateDescription = $trackingResults['TrackingResults'][0]['Value'][0]['UpdateDescription'] ?? '-';
            $out = "Order No $orderId : Tracking No $trackingId found with status code $statusCode status desc $UpdateDescription";
            return $out;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getReturnTrackingShipmentByTrackingIdForCron($orderId, $trackingId) //tracking shipment by automation
    {
        try {
            $trackingResults = $this->shippingService->getTrackingInfoByTrackingId($trackingId);

            if (empty($trackingResults['TrackingResults'])) {
                return $out = "Return Order No $orderId : Return Tracking No $trackingId not found";
            }

            $this->repo->createReturnOrderTracking($trackingResults);
            $statusCode = $trackingResults['TrackingResults'][0]['Value'][0]['UpdateCode'] ?? '-';
            $UpdateDescription = $trackingResults['TrackingResults'][0]['Value'][0]['UpdateDescription'] ?? '-';
            $out = "Return Order No $orderId : Return Tracking No $trackingId found with status code $statusCode status desc $UpdateDescription";
            return $out;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
