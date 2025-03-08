<?php

namespace App\Repositories\Orders;

use App\Models\Pickup\OrderPickup;
use App\Repositories\BaseRepository;
use App\Models\ImportOrder\ImportOrder;

class ImportOrderRepo extends BaseRepository
{
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

        //   throw new BadMethodCallException(sprintf( 'Method %s::%s does not exist.', static::class, $method ));
    }

    public function getAllOrdes($request)
    {
        try {
            $model = ImportOrder::query();
            $model = $model->where('is_shipped', ImportOrder::PENDING_ORDER);
            if ($request->has('order_status_filter') && $request->order_status_filter != -1) {
                $model = $model->where('order_status', $request->order_status_filter);
            }
            return $model->with(
                // 'customer',
                'customer:import_order_id,first_name,last_name',
                'shipping'
            )
                // ->whereJsonContains('order_shippings.address', ['city' => 'Dubai'])
                ->select([
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
                    'is_confirmed',
                    'is_shipped',
                ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getConfirmedAllOrdes($request)
    {
        try {
            $model = ImportOrder::query();
            $model = $model->where('is_shipped', ImportOrder::SHIPPED_ORDER);
            $model = $model->where('is_delivered', 0);
            if ($request->has('order_status_filter') && $request->order_status_filter != -1) {
                $model = $model->where('order_status', $request->order_status_filter);
            }
            return $model->with(
                // 'customer',
                'customer:import_order_id,first_name,last_name',
                'shipping',
                'tracking:order_id,shiping_reference_number',
            )
                // ->whereJsonContains('order_shippings.address', ['city' => 'Dubai'])
                ->select([
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
                    'import_orders.created_at',
                ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getDeliveredAllOrdes($request)
    {
        try {
            $model = ImportOrder::query();
            $model = $model->where('is_delivered', ImportOrder::DELIVERED_ORDER);
            if ($request->has('order_status_filter') && $request->order_status_filter != -1) {
                $model = $model->where('order_status', $request->order_status_filter);
            }
            return $model->with(
                // 'customer',
                'customer:import_order_id,first_name,last_name',
                'shipping',
                'tracking:order_id,shiping_reference_number',
            )
                // ->whereJsonContains('order_shippings.address', ['city' => 'Dubai'])
                ->select([
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

    public function getAllPickupOrdes($request)
    {
        try {

            $model = OrderPickup::query();

            // return $model->get();

            $model->with([
                'order'
                // 'coupons',
                // 'customer',
                // 'billingAddress',
                // 'payment',
                // 'shipping',
                // 'gift.giftItems',
                // 'products',
                // 'tax' => ['appliedTaxes', 'itemAppliedTaxes'],
                // 'products' => ['items']
            ]);


            return $model;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getOrdeById($id)
    {
        try {
            $model = ImportOrder::query();
            return $model->with([
                'coupons',
                'customer',
                'billingAddress',
                'payment',
                'shipping',
                'gift.giftItems',
                'products',
                'orderReturn' => ['pickupTracking', 'pickupShipment'],
                'tracking',
                'adjustments' => ['adjDetail', 'adjItems'],
                'tax' => ['appliedTaxes', 'itemAppliedTaxes' => ['itemAppliedTaxeDetails']],
                'products' => ['items']
            ])->whereOrderId($id)->first();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getAccessPermission(): array
    {
        return [
            'isView' => can('orders-pending-orders-view'),
            'isEdit' => false,
            'isDelete' =>  false,
            'isPrint' => false,
            'isTracking' => false
        ];
    }
    public function getPickupAccessPermission(): array
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
