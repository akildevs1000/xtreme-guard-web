<?php

namespace App\Http\Controllers\Pages\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Providers\ShippingService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ImportOrder\ImportOrder;
use App\Repositories\Orders\PickupRepo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\Pages\Administration\MailTrackingController;

class PickupController extends Controller
{
    protected $modelName = 'Pickup';
    protected $routeName = 'pickup.index';
    protected $isDestroyingAllowed;
    protected $shippingService;
    protected $repo;

    public function __construct(ShippingService $shippingService, PickupRepo $repo)
    {
        $this->repo = $repo;
        $this->shippingService = $shippingService;
    }

    public function index(Request $request)
    {
        // return  $orders = $this->repo->getAllOrdes($request);
        $pickup = $this->repo->getAllOrdes($request);
        $permissions = $this->repo->getAccessPermission();

        if ($request->ajax()) {
            return datatables()->of($pickup)->addIndexColumn()
                ->addColumn('action', function ($pickup) use ($permissions) {
                    return actionBtns(
                        $pickup->id,
                        'pickup.edit',
                        'order/pickup',
                        $pickup->pickup_id,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/orders/pickup/index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function returnOrder(Request $request, $orderId)
    {
        try {

            $data = $request->all();

            if ($request->has('is_enable_pickup_date')) {

                $date = Carbon::createFromFormat('d M, Y H:i', $data['pickupDate']);
                $data['pickupDate'] = $date->format('Y-m-d H:i:s');
                $data['pickupTime'] = $date->format('H:i');

                $data['is_enable_pickup_date'] = 1;
            } else {
                $data['is_enable_pickup_date'] = 0;
            }

            $validator = Validator::make($data, [
                'customer_city' => 'required',
                'customer_mobile' => 'required',
                'pickupDate'       => $data['is_enable_pickup_date'] ? 'required' : 'nullable',
            ]);

            $data['customer_mobile'] = "971" . $data['customer_mobile'];

            Log::info(json_encode(['inputPayload' => 'Return Form Payload', 'response' => $data], JSON_PRETTY_PRINT));

            if ($validator->fails()) {
                throw new HttpResponseException(
                    response()->json([
                        'status' => false,
                        'isAramexError' => false,
                        'errors' => $validator->errors()
                    ], 200)
                );
            }

            $data['shipper_location'] = 'sharjah';

            logActivity('Order Return Create', "Return Order ID " . $orderId, 'Create');

            $pickupData = $this->repo->preparePickupForReturnOrder($data, $orderId);

            $response = $this->shippingService->createPickup($pickupData);

            if (!$response['HasErrors']) {

                date_default_timezone_set(config('app.timezone'));

                ImportOrder::where('order_id', $orderId)->update(['is_pickuped' => 1]);

                $createdPickupResponse = $this->repo->storePickupResponse($response);

                app(MailTrackingController::class)->sendReturnCreatedNotifyToCustomerByMail($orderId);

                Log::channel('createPickup')
                    ->info(json_encode(['inputPayload' => $pickupData, 'response' => $response], JSON_PRETTY_PRINT));

                $this->getPickupTrackingByPickupTrackingId($response['ProcessedPickup']['ID'], $orderId);

                return $this->response('Order return successfully created', ['data' => $createdPickupResponse], true);
            } else {

                date_default_timezone_set(config('app.timezone'));

                Log::channel('createPickupError')
                    ->error(json_encode(['inputPayload' => $pickupData, 'response' => $response], JSON_PRETTY_PRINT));

                throw new HttpResponseException(
                    response()->json([
                        'status' => false,
                        'isAramexError' => true,
                        'errors' => $response['Notifications'][0]
                    ], 200)
                );
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        $orders = ImportOrder::whereIsConfirmed(1)->whereIsPickuped(0)->get(['id', 'order_id', 'is_confirmed', 'is_pickuped', 'is_shipped']);

        return view('pages/orders/pickup/create', [
            'orders' => $orders,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $pickupData = $this->repo->preparePickupData($request);
            $response = $this->shippingService->createPickup($pickupData);

            if (!$response['HasErrors']) {
                $orderIds =  explode(',', $response['ProcessedPickup']['Reference2']);
                ImportOrder::whereIn('order_id', $orderIds)->update(['is_pickuped' => 1]);
                $createdPickupResponse = $this->repo->storePickupResponse($response);

                $this->getPickupTrackingByPickupTrackingId($response['ProcessedPickup']['ID']);

                Log::channel('createPickup')->info(json_encode(['inputPayload' => $pickupData, 'response' => $response->json()], JSON_PRETTY_PRINT));
                return redirect(route('pickup.index'))->with('success',  'Order pickup successfully created.');
            } else {
                Log::channel('createPickupError')->error(json_encode(['inputPayload' => $pickupData, 'response' => $response->json()], JSON_PRETTY_PRINT));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPickupTrackingByPickupTrackingId($trackingId, $orderId = null)
    {
        try {

            $trackingResults = $this->shippingService->getPickupTrackingInfoByTrackingId($trackingId);

            if (empty($trackingResults)) {
                return  $this->response('tracking not found', 'not found', false);
            }

            if ($trackingResults['HasErrors']) {
                return  $this->response('tracking not found', 'not found', false);
            }

            if (count($trackingResults) == 0) {
                return  $this->response('tracking not found', 'not found', false);
            }

            $arr = [];
            $selectedObj = ['CollectionDate', 'Entity', 'LastStatus', 'LastStatusDescription', 'PickupDate', 'Reference'];
            foreach ($trackingResults as $key => $value) {

                if (in_array($key, $selectedObj)) {
                    if ($key == 'PickupDate' || $key == 'CollectionDate') {
                        $arr[$key] = getDateAndTime($value ?? false);
                    } else {
                        $arr[$key] = $value;
                    }
                }
            }

            $createdPickupResponse = $this->repo->updateOrCreatePickupTracking($trackingId, $arr, $trackingResults, $orderId);

            return $arr;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
