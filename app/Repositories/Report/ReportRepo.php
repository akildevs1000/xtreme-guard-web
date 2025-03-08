<?php

namespace App\Repositories\Report;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\ImportOrder\ImportOrder;
use App\Models\Warehouse\WarehouseStock;
use Illuminate\Database\Eloquent\Builder;

class ReportRepo extends BaseRepository
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
    }

    public function getAllWarehouseStocks($request)
    {
        try {
            $model = WarehouseStock::query();

            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));

            $model->whereBetween('created_at', [$from, $to]);

            $model->select([
                'id',
                'item',
                'item_code',
                'qty',
                'unit',
                'barcode',
                'item_type',
                'description',
            ]);

            // $model->orderBy('order_date', 'asc');

            $selectedCols = [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'item', 'name' => 'item', 'title' => 'Item'],
                ['data' => 'qty', 'name' => 'qty', 'title' => 'QTY'],
                ['data' => 'unit', 'name' => 'unit', 'title' => 'Unit'],
                ['data' => 'barcode', 'name' => 'barcode', 'title' => 'Barcode'],
            ];


            return [
                'model' => $model,
                'selectedCols' => $selectedCols,
                'orderBy' => [0, 'desc'],
            ];
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getAllOrdes($request)
    {
        try {
            $model = ImportOrder::query();

            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));

            $model->whereBetween('order_date', [$from, $to]);

            $model->with(
                'customer:import_order_id,first_name,last_name',
                'shipping',
                'couponsForReport',
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
                'is_confirmed',
                'confirmed_date',
                'is_shipped',
                'shipped_date',
                'created_at',
                'is_delivered',
                'delivered_date',
            ]);

            $model->orderBy('order_date', 'asc');


            $selectedCols = [
                ['data' => 'order_id', 'name' => 'order_id', 'title' => 'OrderID'],
                ['data' => 'subtotal', 'name' => 'subtotal', 'title' => 'Subtotal', 'className' => 'text-end'],
                ['data' => 'shipping_amount', 'name' => 'shipping_amount', 'title' => 'ShippingAmount', 'className' => 'text-end'],
                ['data' => 'total', 'name' => 'total', 'title' => 'Total', 'className' => 'text-end'],
                ['data' => 'order_aramex_status.updated_at', 'name' => 'order_aramex_status.updated_at', 'title' => 'AramexCommentOn'],
                ['data' => 'order_aramex_status.comment', 'name' => 'order_aramex_status.comment', 'title' => 'AramexComment'],
                ['data' => 'customer.full_name', 'name' => 'customer.first_name', 'title' => 'CustomerName'],
                ['data' => 'couponsForReport.coupon', 'name' => 'couponsForReport.coupon', 'title' => 'Coupons'],
                ['data' => 'order_location', 'name' => 'order_location', 'title' => 'Location'],
                ['data' => 'order_type', 'name' => 'order_type', 'title' => 'OrderType'],
                ['data' => 'order_date', 'name' => 'order_date', 'title' => 'OrderDate', 'style' => 'width: 140px',],
                ['data' => 'order_status_title', 'name' => 'order_status_title', 'title' => 'OrderStatus', 'style' => 'width: 154px'],
                ['data' => 'confirmed_date', 'name' => 'confirmed_date', 'title' => 'ConfirmedOn', 'style' => 'width: 154px'],
                ['data' => 'shipped_date', 'name' => 'shipped_date', 'title' => 'CreateShipmentOn', 'style' => 'width: 100px',],
                ['data' => 'out_for_delivery.updated_at', 'name' => 'out_for_delivery.updated_at', 'title' => 'OutForDeliveryOn'],
                ['data' => 'delivered_date', 'name' => 'delivered_date', 'title' => 'DeliveredOn'],
            ];

            return [
                'model' => $model,
                'selectedCols' => $selectedCols,
                'orderBy' => [7, 'desc'],
            ];
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getProductByOrder($request)
    {
        try {
            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));

            $model = ImportOrder::query();

            $model = DB::table('import_orders as io')
                ->join('order_products as op', 'op.import_order_id', '=', 'io.order_id')

                ->Join('order_product_items as opi', 'opi.order_product_id', '=', 'op.id')

                ->Join('warehouse_stocks as ws1', 'ws1.item_code', '=', 'opi.sku')  // Changed alias to ws1

                // ->Join('warehouse_stocks as ws2', 'ws2.item_code', '=', 'op.sku')   // Changed alias to ws2

                ->join('warehouse_stocks as ws2', function ($join) {
                    $join->on('ws2.item_code', '=', 'op.sku')
                        ->on('op.product_type', '=', 'ws2.item_type');
                })

                ->select(
                    'io.order_id as io_order_id',  // Prefix io for import orders
                    'op.sku as op_product_sku',    // Prefix op for order products
                    'op.name as op_product_name',
                    'op.product_type as op_product_type',
                    'op.price as op_amount',
                    'op.tax_amount as op_tax_amount',
                    'op.discount_amount as op_discount_amount',
                    'op.price_incl_tax as op_price_with_amount',

                    'opi.sku as opi_item_sku',     // Prefix opi for order product items

                    // Columns from warehouse_stocks for ws1 (item-level warehouse stock)
                    'ws1.id as ws1_id',
                    'ws1.item as ws1_item',
                    'ws1.item_code as ws1_item_code',
                    'ws1.qty as ws1_qty',
                    'ws1.unit as ws1_unit',
                    'ws1.barcode as ws1_barcode',
                    'ws1.item_type as ws1_item_type',
                    'ws1.description as ws1_description',

                    // Columns from warehouse_stocks for ws2 (product-level warehouse stock)
                    'ws2.id as ws2_id',
                    'ws2.item as ws2_item',
                    'ws2.item_code as ws2_item_code',
                    'ws2.qty as ws2_qty',
                    'ws2.unit as ws2_unit',
                    'ws2.barcode as ws2_barcode',
                    'ws2.item_type as ws2_item_type',
                    'ws2.description as ws2_description',

                    DB::raw("'" . currentUser()->email . "' as user")  // Keep the user info as is
                )
                ->whereBetween('io.order_date', [$from, $to])
                ->orderBy('io.order_date', 'asc')
                // ->where('op.import_order_id', 2000000011)->get();
                ->get();

            $data = $model->toArray();
            // return $data = $model->toArray();

            $finalArray = [];

            foreach ($data as $product) {
                $product = (array)$product;
                $finalArray[] = [
                    'OrderID' => $product['io_order_id'],
                    'ItemDescription' => $product['ws1_item'] ?? $product['ws2_item'],
                    'Barcode' => $product['ws1_barcode'] ?? $product['ws2_barcode'],
                    'ItemCode' => $product['ws1_item_code'] ?? $product['ws2_item_code'],
                    'SKUCode' => $product['op_product_sku'],
                    'Amount' => $product['op_amount'],
                    'Unit' => $product['ws1_unit'] ?? $product['ws2_unit'],
                    'TaxAmount' => $product['op_tax_amount'],
                    'DiscountAmount' => $product['op_discount_amount'],
                    'PriceWithVat' => $product['op_price_with_amount'],
                    'User' => $product['user']
                ];
            }

            $selectedCols = [
                ['data' => 'OrderID', 'name' => 'OrderID', 'title' => 'OrderID'],
                ['data' => 'ItemDescription', 'name' => 'ItemDescription', 'title' => 'ItemDescription'],
                ['data' => 'Barcode', 'name' => 'Barcode', 'title' => 'Barcode'],
                ['data' => 'ItemCode', 'name' => 'ItemCode', 'title' => 'SKUCode'],
                // ['data' => 'SKUCode', 'name' => 'SKUCode', 'title' => 'SKUCode'],
                ['data' => 'Amount', 'name' => 'Amount', 'title' => 'Amount', 'className' => 'text-end'],
                ['data' => 'Unit', 'name' => 'Unit', 'title' => 'Unit'],
                ['data' => 'TaxAmount', 'name' => 'TaxAmount', 'title' => 'TaxAmount', 'className' => 'text-end'],
                ['data' => 'DiscountAmount', 'name' => 'DiscountAmount', 'title' => 'DiscountAmount', 'className' => 'text-end'],
                ['data' => 'PriceWithVat', 'name' => 'PriceWithVat', 'title' => 'Price(with VAT)', 'className' => 'text-end'],
                ['data' => 'User', 'name' => 'User', 'title' => 'User', 'className' => 'text-secondary-emphasis'],
            ];

            // return $data;

            return [
                'model' => $finalArray,
                'selectedCols' => $selectedCols,
                'orderBy' => [0, 'desc'],
            ];
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getProductByOrderBK($request)
    {
        try {

            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));


            $model = DB::table('import_orders as io')
                ->join('order_products as op', 'op.import_order_id', '=', 'io.order_id')
                // ->join('warehouse_stocks as ws', 'op.import_order_id', '=', 'io.order_id')
                ->select(
                    'io.order_id as order_id',
                    'op.sku as Bought_sku',
                    'op.name as product_name',
                    'op.product_type as product_type',
                    'op.price as amount',
                    'op.tax_amount as tax_amount',
                    'op.discount_amount as discount_amount',
                    'op.price_incl_tax as price_with_amount',
                    DB::raw("'" . currentUser()->email . "' as user")
                )
                ->whereBetween('io.order_date', [$from, $to])
                ->orderBy('io.order_date', 'asc');
            // ->where('io.order_id', 20);

            $selectedCols = [
                ['data' => 'order_id', 'name' => 'order_id', 'title' => 'OrderID'],
                ['data' => 'product_name', 'name' => 'product_name', 'title' => 'ItemDescription'],
                ['data' => 'Bought_sku', 'name' => 'Bought_sku', 'title' => 'SKUID'],
                ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount', 'className' => 'text-end'],
                ['data' => 'product_type', 'name' => 'product_type', 'title' => 'Packs/Cases'],
                ['data' => 'tax_amount', 'name' => 'tax_amount', 'title' => 'Tax Amount', 'className' => 'text-end'],
                ['data' => 'discount_amount', 'name' => 'discount_amount', 'title' => 'DiscountAmount', 'className' => 'text-end'],
                ['data' => 'price_with_amount', 'name' => 'price_with_amount', 'title' => 'Price(with VAT)', 'className' => 'text-end'],
                ['data' => 'user', 'name' => 'user', 'title' => 'User', 'className' => 'text-secondary-emphasis'],
            ];

            return [
                'model' => $model,
                'selectedCols' => $selectedCols,
                'orderBy' => [0, 'desc'],
            ];
        } catch (\Throwable $th) {
            return $th;
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

    public function getReportTitle($currentTitle = '')
    {
        $titleArr = [
            'received-order' => 'By Orders',
            'warehouse-stock' => 'Warehouse Stock',
            'product-by-order' => 'By Products',
        ];

        return $titleArr[$currentTitle] ?? 'Report';
    }

    public function getItems(array $items)
    {
        return isset($items['model'])
            ? ($items['model'] instanceof Builder ? $items['model']->get() : $items['model'])
            : null;
    }

    public function checkUserPermissionByReport($reportType)
    {
        $reportPermissions = [
            'warehouse-stock' => 'reports-warehouse-stock-view',
            'received-order' => 'reports-by-orders-view',
            'product-by-order' => 'reports-by-products-view',
        ];

        // Check if report type exists in the mapping and validate permissions
        if (isset($reportPermissions[$reportType])) {
            abort_if(!can($reportPermissions[$reportType]), 401);
        } else {
            // Optionally handle unsupported report types
            abort(404, 'Report type not supported.');
        }
    }

    public function getAllOrdesOld($request)
    {
        try {
            $model = ImportOrder::query();
            // $model = $model->where('is_shipped', ImportOrder::PENDING_ORDER);


            // if ($searchValue = $request->input('search.value')) {
            //     $model->where(function ($query) use ($searchValue) {
            //         $query->where('order_id', 'like', "%{$searchValue}%")
            //             ->orWhere('order_status', 'like', "%{$searchValue}%");
            //         // Add more columns as needed
            //     });
            // }

            // https://github.com/yajra/laravel-datatables/issues/2648

            $from = date('Y-m-d', strtotime($request->start_date));
            $to = date('Y-m-d', strtotime($request->end_date));

            $model->whereBetween('order_date', [$from, $to]);

            $model->with(
                // 'customer',
                'customer:import_order_id,first_name,last_name',
                'shipping'
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
                'is_confirmed',
                'is_shipped',
            ]);

            $selectedCols = [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'order_id', 'name' => 'order_id', 'title' => 'Order ID'],
                ['data' => 'subtotal', 'name' => 'subtotal', 'title' => 'Subtotal', 'className' => 'text-end'],
                ['data' => 'shipping_amount', 'name' => 'shipping_amount', 'title' => 'Shipping Amount', 'className' => 'text-end'],
                ['data' => 'total', 'name' => 'total', 'title' => 'Total', 'className' => 'text-end'],

                ['data' => 'customer.full_name', 'name' => 'customer.first_name', 'title' => 'CustomerName'],
                ['data' => 'order_location', 'name' => 'order_location', 'title' => 'Location'],
                ['data' => 'order_type', 'name' => 'order_type', 'title' => 'Order Type'],

                // ['data' => 'order_status', 'name' => 'order_status', 'title' => 'Order Status'],
                // ['data' => 'order_date', 'name' => 'order_date', 'title' => 'Order Date'],
                // ['data' => 'report_customer_name', 'name' => 'report_customer_name', 'title' => 'Customer Name'],
                // ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ];


            return [
                'model' => $model,
                'selectedCols' => $selectedCols
            ];
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
