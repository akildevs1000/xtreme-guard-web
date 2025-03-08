<?php

namespace App\Repositories\Shipment;

use App\Providers\JTIService;
use App\Enums\OrderStatusCode;
use App\Models\Order\OrderLog;
use App\Models\Shipment\Shipment;
use App\Traits\DatabaseOperations;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use App\Models\Pickup\PickupShipment;
use App\Models\Shipment\OrderTracking;
use App\Models\ImportOrder\ImportOrder;
use App\Models\Shipment\ShipmentDetail;
use App\Models\Pickup\PickupShipmentTracking;
use App\Http\Controllers\Pages\Administration\MailTrackingController;

class TrackingRepo extends BaseRepository
{
    use DatabaseOperations;

    protected $model;

    public function __construct(ImportOrder $model)
    {
        $this->model = $model;
    }

    public function __call($method, $parameters)
    {
        // Forward calls to the model instance
        $isExisit = $this->model->$method(...$parameters);

        if ($isExisit) {
            return $isExisit;
        }

        throw new \BadMethodCallException("Method {$method} does not exist on the model.");
    }

    public function getConfirmedAllOrdesForTracking($request)
    {
        try {
            $model = ImportOrder::query();
            $model = $model->where('is_shipped', ImportOrder::SHIPPED_ORDER);
            if ($request->has('order_status_filter') && $request->order_status_filter != -1) {
                $model = $model->where('order_status', $request->order_status_filter);
            }
            return $model->with(
                'customer:import_order_id,first_name,last_name',
                'shipping',
                'tracking:order_id,shiping_reference_number,shipment_label_url',
            )->select([
                'import_orders.id',
                'order_id',
                'subtotal',
                'shipping_amount',
                'total_discount',
                'total',
                'discount',
                'tax_total',
                'order_type',
                'order_status',
                'order_date',
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createOrderTracking($trackingResults)
    {
        try {

            $trackInfo = $trackingResults['TrackingResults'][0];
            $trackingValueInfo = $trackInfo['Value'][0];
            $orderId = Shipment::where('shiping_reference_number', $trackInfo['Key'])->first()->order_id;
            $orderTracking = OrderTracking::updateOrCreate(
                [
                    'tracking_id' => $trackInfo['Key'],
                    'waybill_number' => $trackingValueInfo['WaybillNumber'],
                    'update_code' => $trackingValueInfo['UpdateCode'],
                ],
                [
                    'order_id' => $orderId,
                    'tracking_id' => $trackInfo['Key'],
                    'waybill_number' => $trackingValueInfo['WaybillNumber'],
                    'update_code' => $trackingValueInfo['UpdateCode'] ?? null,
                    'update_description' => $trackingValueInfo['UpdateDescription'] ?? null,
                    'update_date_time' => $trackingValueInfo['UpdateDateTime'] ?? null,
                    'update_date_time_converted' => getDateAndTime($trackingValueInfo['UpdateDateTime']) ?? null,
                    'update_location' => $trackingValueInfo['UpdateLocation'] ?? null,
                    'comments' => $trackingValueInfo['Comments'] ?? null,
                    'problem_code' => $trackingValueInfo['ProblemCode'] ?? null,
                    'gross_weight' => $trackingValueInfo['GrossWeight'] ?? null,
                    'chargeable_weight' => $trackingValueInfo['ChargeableWeight'] ?? null,
                    'weight_unit' => $trackingValueInfo['WeightUnit'] ?? null,
                ]
            );

            if ($trackingResults) {

                $comment = "";
                $status_code = "";
                $status_name = "";

                if ($trackingValueInfo['UpdateCode'] == 'SH003') { //SH003 =  Out for Delivery"
                    $comment = !empty($trackingValueInfo['UpdateDescription']) ? $trackingValueInfo['UpdateDescription'] : "Out for Delivery ";
                    $status_code = "shipped";
                    $status_name = "Shipped";
                    app(MailTrackingController::class)->sendOutForDeliveryNotifyToCustomerByMail($orderId);
                } else if ($trackingValueInfo['UpdateCode'] == 'SH005') { //SH005 =  Delivered"
                    $comment = !empty($trackingValueInfo['UpdateDescription']) ? $trackingValueInfo['UpdateDescription'] : "Delivered ";
                    $status_code = "delivered";
                    $status_name = "Delivered";
                    ImportOrder::where('order_id', $orderId)->update(['is_delivered' => 1, 'delivered_date' => now()]);
                    app(MailTrackingController::class)->sendDeliveredNotifyToCustomerByMail($orderId);
                } else {
                    $comment = !empty($trackingValueInfo['UpdateDescription']) ? $trackingValueInfo['UpdateDescription'] : "Create Shipment by Aramex";
                    $status_code = "shipped_to_warehouse_created_shipment_by_aramex";
                    $status_name = "CreatedShipment";
                }

                $orderLog = OrderLog::updateOrCreate(
                    ['order_id' => $orderId, 'status' => $status_code ?? ''],
                    ['order_id' => $orderId, 'status_name' => $status_name, 'status' => $status_code ?? '', 'comment' => $comment . ' - ' . $trackingValueInfo['UpdateCode'] ?? '', 'status_date' => now()]
                );

                if ($orderLog->wasRecentlyCreated || $orderLog->isDirty()) {

                    if (in_array($status_code, ['delivered', 'shipped'])) {
                        (new JTIService)->updateOrderStatus(['order_id' => $orderId, 'status_code' => $status_code]);
                    }

                    $sendTrackingInfoPayload = [
                        "carrier" => 'Aramex',
                        "title" => 'Aramex Carrier',
                        "trackNumber" => $trackInfo['Key'] ?? '',
                        "trackUrl" => "https://jti.routepro.cloud/oms/shipment/tracking/get-tracking-info-by-trackId/" . $trackInfo['Key'],
                    ];

                    (new JTIService)->SendToTrackingDetails($sendTrackingInfoPayload, $orderId);

                    $result = $this->updateOrInsertDublicateForBackup('order_trackings_backup',  ['tracking_id' => $trackInfo['Key'], 'waybill_number' => $trackingValueInfo['WaybillNumber'], 'update_code' => $trackingValueInfo['UpdateCode'],], $orderTracking->toArray());
                }
            }

            return $orderTracking;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createReturnOrderTracking($trackingResults)
    {
        try {

            $trackInfo = $trackingResults['TrackingResults'][0];
            $trackingValueInfo = $trackInfo['Value'][0];
            $pickupShipment = PickupShipment::where('pickup_shiping_reference_number', $trackInfo['Key'])->first();


            $orderTracking = PickupShipmentTracking::updateOrCreate(
                [
                    'pickup_shipment_tracking_id' => $trackInfo['Key'],
                    'waybill_number' => $trackingValueInfo['WaybillNumber'],
                    'update_code' => $trackingValueInfo['UpdateCode'],
                    'update_date_time' => $trackingValueInfo['UpdateDateTime'],
                ],
                [
                    'order_id' => $pickupShipment->order_id,
                    'pickup_shipment_id' => $pickupShipment->pickup_id,
                    'pickup_shipment_tracking_id' => $trackInfo['Key'],
                    'waybill_number' => $trackingValueInfo['WaybillNumber'],
                    'update_code' => $trackingValueInfo['UpdateCode'] ?? null,
                    'update_description' => $trackingValueInfo['UpdateDescription'] ?? null,
                    'update_date_time' => $trackingValueInfo['UpdateDateTime'] ?? null,
                    'update_date_time_converted' => getDateAndTime($trackingValueInfo['UpdateDateTime']) ?? null,
                    'update_location' => $trackingValueInfo['UpdateLocation'] ?? null,
                    'comments' => $trackingValueInfo['Comments'] ?? null,
                    'problem_code' => $trackingValueInfo['ProblemCode'] ?? null,
                    'gross_weight' => $trackingValueInfo['GrossWeight'] ?? null,
                    'chargeable_weight' => $trackingValueInfo['ChargeableWeight'] ?? null,
                    'weight_unit' => $trackingValueInfo['WeightUnit'] ?? null,
                ]
            );

            // dd($orderTracking);

            if ($trackingResults) {

                $comment = "";
                $status_code = "";

                $orderId = $pickupShipment->order_id;

                if ($trackingValueInfo['UpdateCode'] == 'SH003') { //SH003 =  Out for Delivery"
                    // app(MailTrackingController::class)->sendReturnOFDMail($orderId);
                } else if ($trackingValueInfo['UpdateCode'] == 'SH005') { //SH005 =  Delivered"

                    $comment = !empty($trackingValueInfo['UpdateDescription']) ? $trackingValueInfo['UpdateDescription'] : "Delivered ";
                    $status_code = "delivered";
                    $status_name = "Delivered";
                    ImportOrder::where('order_id', $orderId)->update(['is_delivered' => 1, 'delivered_date' => now()]);
                    // app(MailTrackingController::class)->sendDeliveredNotifyToCustomerByMail($orderId);

                    // app(MailTrackingController::class)->sendReturnOFDMail($orderId);
                }

                Log::info($trackingValueInfo['UpdateCode']);

                if (in_array($status_code, ['delivered'])) {

                    OrderLog::updateOrCreate(
                        ['order_id' => $orderId, 'status' => 'return'],
                        [
                            'order_id' => $orderId,
                            'status_name' => 'return',
                            'status' => 'return',
                            'comment' => 'return ' . $comment . ' - ' . $trackingValueInfo['UpdateCode'] ?? '',
                            'status_date' => now()
                        ]
                    );
                }
            }

            return $orderTracking;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createBulkOrderTracking($trackingResults)
    {
        try {

            // return $trackingResults;
            $trackInfo = $trackingResults['TrackingResults'][0];
            $trackingValueInfo = $trackInfo['Value'];
            $orderId = Shipment::where('shiping_reference_number', $trackInfo['Key'])->first()->order_id;

            foreach ($trackingValueInfo as $key => $value) {

                // return $value['WaybillNumber'];
                // return $value;

                $orderTracking = OrderTracking::updateOrCreate(
                    [
                        'tracking_id' => $trackInfo['Key'],
                        'waybill_number' => $value['WaybillNumber'],
                        'update_code' => $value['UpdateCode'],
                    ],

                    [
                        'order_id' => $orderId,
                        'tracking_id' => $trackInfo['Key'],
                        'waybill_number' => $value['WaybillNumber'],
                        'update_code' => $value['UpdateCode'] ?? null,
                        'update_description' => $value['UpdateDescription'] ?? null,
                        'update_date_time' => $value['UpdateDateTime'] ?? null,
                        'update_date_time_converted' => getDateAndTime($value['UpdateDateTime']) ?? null,
                        'update_location' => $value['UpdateLocation'] ?? null,
                        'comments' => $value['Comments'] ?? null,
                        'problem_code' => $value['ProblemCode'] ?? null,
                        'gross_weight' => $value['GrossWeight'] ?? null,
                        'chargeable_weight' => $value['ChargeableWeight'] ?? null,
                        'weight_unit' => $value['WeightUnit'] ?? null,
                    ]
                );
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createBulkReturnOrderTracking($trackingResults)
    {
        try {

            $trackInfo = $trackingResults['TrackingResults'][0];
            $trackingValueInfo = $trackInfo['Value'];
            $pickupShipment = PickupShipment::where('pickup_shiping_reference_number', $trackInfo['Key'])->first();

            foreach ($trackingValueInfo as $key => $value) {

                $orderTracking = PickupShipmentTracking::updateOrCreate(
                    [
                        'pickup_shipment_tracking_id' => $trackInfo['Key'],
                        'waybill_number' => $value['WaybillNumber'],
                        'update_code' => $value['UpdateCode'],
                        'update_date_time' => $value['UpdateDateTime'] ?? null,
                    ],

                    [
                        'order_id' => $pickupShipment->order_id,
                        'pickup_shipment_id' => $pickupShipment->pickup_id,
                        'pickup_shipment_tracking_id' => $trackInfo['Key'],
                        'waybill_number' => $value['WaybillNumber'],
                        'update_code' => $value['UpdateCode'] ?? null,
                        'update_description' => $value['UpdateDescription'] ?? null,
                        'update_date_time' => $value['UpdateDateTime'] ?? null,
                        'update_date_time_converted' => getDateAndTime($value['UpdateDateTime']) ?? null,
                        'update_location' => $value['UpdateLocation'] ?? null,
                        'comments' => $value['Comments'] ?? null,
                        'problem_code' => $value['ProblemCode'] ?? null,
                        'gross_weight' => $value['GrossWeight'] ?? null,
                        'chargeable_weight' => $value['ChargeableWeight'] ?? null,
                        'weight_unit' => $value['WeightUnit'] ?? null,
                    ]
                );
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAccessPermission(): array
    {
        return [
            'isView' => true,
            'isEdit' => false,
            'isDelete' =>  false,
            'isPrint' => false,
            'isTracking' => true
        ];
    }
}
