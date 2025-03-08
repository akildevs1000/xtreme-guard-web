<?php

namespace App\Http\Controllers\Pages\Order;

use App\Providers\JTIService;
use App\Enums\OrderStatusCode;
use App\Models\Order\OrderLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ImportOrder\OrderTax;
use Illuminate\Support\Facades\Http;
use App\Models\ImportOrder\ImportOrder;
use App\Models\ImportOrder\OrderCoupon;
use App\Models\ImportOrder\OrderPayment;
use App\Models\ImportOrder\OrderProduct;
use App\Models\ImportOrder\OrderCustomer;
use App\Models\ImportOrder\OrderGiftCard;
use App\Models\ImportOrder\OrderShipping;
use App\Models\ImportOrder\OrderAdjustment;
use App\Models\ImportOrder\OrderAppliedTax;
use App\Models\ImportOrder\OrderProductItem;
use App\Models\ImportOrder\OrderAdjustmentItem;
use App\Models\ImportOrder\OrderBillingAddress;
use App\Models\ImportOrder\OrderGiftCardDetail;
use App\Models\ImportOrder\OrderItemAppliedTax;
use App\Models\ImportOrder\OrderLoyaltyCampaign;
use App\Models\ImportOrder\OrderAdjustmentDetail;
use App\Models\ImportOrder\OrderItemAppliedTaxDetail;

class ImportController extends Controller
{
    protected $modelName = 'Import Order';
    protected $routeName = 'import.index';
    protected $isDestroyingAllowed;
    protected $model;

    public function __construct(ImportOrder $model)
    {
        $this->model = $model;
        $this->isDestroyingAllowed = true;
    }

    public function index()
    {
        // return $this->ImportOrderByCron();
        try {

            ini_set('max_execution_time', 300); // 5 minutes
            ini_set('memory_limit', '512M');

            $confirmedOrders = ImportOrder::whereIsConfirmed(1)->pluck('order_id')->toArray();

            $orderPram = [
                'limit' => 500,
                'page' => 1,
                // 'start_date' => '2024-05-24',  // Use the relevant start date
                // 'end_date' => '2024-07-16',    // Use the relevant end date

                // 'start_date' => date('Y-m-d', strtotime('-1 day')),  // Yesterday's date
                // 'end_date' => date('Y-m-d', strtotime('+1 day')),    // Tomorrow's date
                'status' => 'payment_completed'
            ];

            $response = Http::custom()
                ->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                ])->get('https://api.qa-jtides.com/MMDESUAE/EES-IN/OMS/V1/orders', $orderPram);

            if ($response->successful()) {
                $objectData = $response->json('items');

                logActivity('Import Order', 'Import Order', 'Create');

                $orders = json_decode(json_encode($objectData));

                DB::transaction(function () use ($orders, $confirmedOrders) {
                    foreach ($orders as $order) {
                        // if ($order->info->order_id == 16) { //debugging purpose
                        $createdNewOrder = $this->processOrder($order);
                        if (!in_array($createdNewOrder->order_id, $confirmedOrders)) {

                            (new JTIService)->updateOrderStatus(['order_id' => $createdNewOrder->order_id, 'status_code' => 'confirmed']); //update status to JTI

                            $createdNewOrder->update(['confirmed_date' => now()]);
                            Log::info("Imported Order by Manual: " . $createdNewOrder->order_id);
                            generateTaxInvoiceNumber($createdNewOrder->order_date, $createdNewOrder->order_id);

                            OrderLog::updateOrCreate(
                                ['order_id' => $createdNewOrder->order_id, 'status' => OrderStatusCode::Delivered->value ?? ''],
                                ['order_id' => $createdNewOrder->order_id, 'status_name' => 'Confirmed', 'status' => OrderStatusCode::Confirmed->value ?? '', 'status_date' => now()]
                            );
                        }
                        // }
                    }
                });

                return redirect()->back()->with('success',  'New order successfully rendered.');
            } else {
                return response()->json(['error' => 'Unable to fetch orders'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Order Import Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function gerOrders($param = []) // this for export/shipment order
    {
        try {

            ini_set('max_execution_time', 300); // 5 minutes
            ini_set('memory_limit', '512M');

            $response = Http::custom()
                ->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                ])->get('https://api.qa-jtides.com/MMDESUAE/EES-IN/OMS/V1/orders/' . $param['order_id'],  $param);
            if ($response->successful()) {
                $objectData = $response->json();

                $ordersSingle = json_decode(json_encode($objectData));

                $orders = [$ordersSingle];

                return  DB::transaction(function () use ($orders) {
                    foreach ($orders as $order) {
                        $this->processOrder($order);
                    }
                });
                return true;
            } else {
                return response()->json(['error' => 'Unable to fetch orders'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Order Import Error: ' . $e->getMessage());
            throw $e;
            // return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    public function ImportOrderByCron()
    {
        try {
            $startTime = microtime(true);
            ini_set('max_execution_time', 300); // 5 minutes
            ini_set('memory_limit', '512M');

            $confirmedOrders = ImportOrder::whereIsConfirmed(1)->pluck('order_id')->toArray();

            $response = Http::custom()
                ->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                ])->get('https://api.qa-jtides.com/MMDESUAE/EES-IN/OMS/V1/orders');

            if ($response->successful()) {
                $objectData = $response->json('items');

                $orders = json_decode(json_encode($objectData));
                $output = DB::transaction(function () use ($orders, $confirmedOrders) {
                    $numberOfNewOrder = 0;
                    foreach ($orders as $order) {

                        $createdNewOrder = $this->processOrder($order);
                        if (!in_array($createdNewOrder->order_id, $confirmedOrders)) {
                            $numberOfNewOrder = $numberOfNewOrder + 1;
                            (new JTIService)->updateOrderStatus(['order_id' => $createdNewOrder->order_id, 'status_code' => 'confirmed']); //update status to JTI
                            $createdNewOrder->update(['confirmed_date' => now()]);

                            OrderLog::updateOrCreate(
                                ['order_id' => $createdNewOrder->order_id, 'status' => OrderStatusCode::Delivered->value ?? ''],
                                ['order_id' => $createdNewOrder->order_id, 'status_name' => 'Confirmed', 'status' => OrderStatusCode::Confirmed->value ?? '', 'status_date' => now()]
                            );
                        }
                    }
                    return $numberOfNewOrder;
                });

                // End time
                $endTime = microtime(true);

                return [
                    'numberOfNewOrder' => $output,
                    'executionTime' => round($endTime - $startTime),
                ];
            } else {
                return response()->json(['error' => 'Unable to fetch orders'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Order Import Error: ' . $e->getMessage());
            return $e->getMessage();
            // throw $e;
            // return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }

    public function processOrder($order)
    {
        $orderId = $order->info->order_id;

        return  DB::transaction(function () use ($order, $orderId) {
            // $this->model->firstOrCreate(['order_id' => $orderId], (array) $order->info);
            $createdNewOrder = $this->model->updateOrCreate(['order_id' => $orderId], (array) $order->info);

            OrderLoyaltyCampaign::firstOrCreate(['import_order_id' => $orderId], (array) $order->info->loyalty_campaign);
            OrderCustomer::firstOrCreate(['import_order_id' => $orderId], (array) $order->customer);
            OrderBillingAddress::firstOrCreate(['import_order_id' => $orderId], (array) $order->billing_address);
            OrderPayment::firstOrCreate(['import_order_id' => $orderId], (array) $order->payment);
            OrderShipping::firstOrCreate(['import_order_id' => $orderId], (array) $order->shipping);

            if (count($order->info->coupons) > 0) {
                // dd($order->info->coupons);
                foreach ($order->info->coupons as $key => $coupon) {
                    OrderCoupon::firstOrCreate([
                        'import_order_id' => $orderId,
                        'coupon' => $coupon->coupon,
                    ], [
                        'coupon' => $coupon->coupon,
                        'category' => $coupon->category,
                    ]);
                }
            }

            $createdGift = OrderGiftCard::firstOrCreate(['import_order_id' => $orderId], (array) $order->gift_card);

            foreach ($order->gift_card->gift_cards as $giftCardDetail) {
                OrderGiftCardDetail::firstOrCreate([
                    'order_gift_card_id' => $createdGift->id,
                    'code' => $giftCardDetail->code ?? '',
                ], [
                    'import_order_id' => $orderId,
                    'amount' => $giftCardDetail->amount ?? '',
                    'base_amount' => $giftCardDetail->base_amount ?? ''
                ]);
            }

            $createdTaxes = OrderTax::firstOrCreate(['import_order_id' => $orderId], (array) $order->taxes);

            //added applied taxes data
            foreach ($order->taxes->applied_taxes as $appliedTax) {
                OrderAppliedTax::updateOrCreate([
                    'order_tax_id' => $createdTaxes->id,
                ], [
                    'order_tax_id' => $createdTaxes->id,
                    'amount' => $appliedTax->amount ?? '',
                    'base_amount' => $appliedTax->base_amount ?? ''
                ]);
            }

            // return $order->taxes->item_applied_taxes;
            //added applied item applied taxes data
            foreach ($order->taxes->item_applied_taxes as $appliedItemTax) {

                $createdItemAppliedTax =  OrderItemAppliedTax::updateOrCreate(
                    [
                        'order_tax_id' => $createdTaxes->id,
                        'item_id' => $appliedItemTax->item_id ?? '',
                    ],
                    [
                        'type' => $appliedItemTax->type,
                        'order_tax_id' => $createdTaxes->id,
                        'item_id' => $appliedItemTax->item_id ?? '',
                        'associated_item_id' => $appliedItemTax->item_id ?? ''
                    ]
                );
                // return $appliedItemTax->applied_taxes;
                //added applied item applied taxes details data
                if ($createdItemAppliedTax && $order->taxes->item_applied_taxes) {
                    foreach ($appliedItemTax->applied_taxes as $key => $appliedItemTaxDetails) {
                        OrderItemAppliedTaxDetail::updateOrCreate(
                            [
                                'order_item_applied_tax_id' => $createdItemAppliedTax->id,
                            ],
                            [
                                'order_item_applied_tax_id' => $createdItemAppliedTax->id ?? '',
                                'base_amount' => $appliedItemTaxDetails->base_amount ?? '',
                                'amount' => $appliedItemTaxDetails->amount ?? '',
                            ]
                        );
                    }
                }
            }

            foreach ($order->products as $key => $product) {
                $createdOrderProducts = OrderProduct::firstOrCreate(['import_order_id' => $orderId, 'product_id' => $product->product_id], (array)$product);

                //added production items
                if ($order->products && $product->items) {
                    foreach ($product->items as $key => $item) {
                        OrderProductItem::updateOrCreate(
                            [
                                'import_order_id' => $orderId,
                                'order_product_id' => $createdOrderProducts->id,
                                'sku' => $item->sku,
                                'name' => $item->name ?? '',
                                'qty' => $item->qty ?? '',
                            ],
                            [
                                'import_order_id' => $orderId,
                                'order_product_id' => $createdOrderProducts->id,
                                'sku' => $item->sku,
                                'name' => $item->name ?? '',
                                'qty' => $item->qty ?? '',
                                'original_price' => $item->original_price ?? '',
                                'original_price_incl_tax' => $item->original_price_incl_tax ?? '',
                                'special_promo_bundle_campaign_1' => $item->special_promo_bundle_campaign_1 ?? '',
                            ]
                        );
                    } //end foreach
                }

                //added adjustments
                if ($order && $order->adjustments) {
                    foreach ($order->adjustments as $key => $adjustment) {

                        $orderAdjustment =  OrderAdjustment::firstOrCreate(
                            [
                                'import_order_id' => $orderId,
                                'type' => $adjustment->type,
                                'status' => $adjustment->status,
                                'inform_warehouse' => $adjustment->inform_warehouse ?? '',
                                'open_date' => $adjustment->open_date ?? '',
                            ],
                            [
                                'import_order_id' => $orderId,
                                'type' => $adjustment->type,
                                'status' => $adjustment->status ?? '',
                                'inform_warehouse' => $adjustment->inform_warehouse ?? '',
                                'open_date' => $adjustment->open_date ?? '',
                            ]
                        );


                        if ($adjustment && $adjustment->data) {
                            $adjustmentDetail = $adjustment->data->order_adjustment;
                            $adjustmentItems = $adjustment->data->items;
                            // Log::info((array)$adjustmentDetail);

                            if ($adjustmentDetail) {
                                OrderAdjustmentDetail::firstOrCreate(
                                    [
                                        'order_adjustment_id' => $orderAdjustment->id,
                                        'order_adjustment' => '',
                                        'refund_request_id' => $adjustmentDetail->refund_request_id ?? '',
                                        'amount' => $adjustmentDetail->amount ?? '',
                                        'currency' => $adjustmentDetail->currency ?? '',
                                    ],
                                    [
                                        'order_adjustment_id' => $orderAdjustment->id,
                                        'order_adjustment' => '',
                                        'refund_request_id' => $adjustmentDetail->refund_request_id ?? '',
                                        'amount' => $adjustmentDetail->amount ?? '',
                                        'currency' => $adjustmentDetail->currency ?? '',
                                    ]
                                );
                            }

                            if ($adjustmentItems) {

                                foreach ($adjustmentItems as $key => $item) {
                                    OrderAdjustmentItem::firstOrCreate(
                                        [
                                            'order_adjustment_id' => $orderAdjustment->id,
                                            'sku' => $item->sku,
                                            'qty' => $item->qty ?? '',
                                            'amount' => $item->amount ?? '',
                                            'currency' => $item->currency ?? '',
                                            'requires_return' => $item->requires_return ?? '',
                                            'parent_sku' => $item->parent_sku ?? '',
                                        ],
                                        [
                                            'order_adjustment_id' => $orderAdjustment->id,
                                            'sku' => $item->sku,
                                            'qty' => $item->qty ?? '',
                                            'amount' => $item->amount ?? '',
                                            'currency' => $item->currency ?? '',
                                            'requires_return' => $item->requires_return ?? '',
                                            'parent_sku' => $item->parent_sku ?? '',
                                        ]
                                    );
                                }
                            }
                        }
                    } //end foreach
                }
            }

            return $createdNewOrder;
        });
    }

    private function clearImportOrderTables()
    {
        // // List of tables to truncate
        // $tables = [
        //     'import_orders',           // Replace with actual table names
        //     'order_coupons',
        //     'order_loyalty_campaigns',
        //     'order_customers',
        //     'order_billing_addresses',
        //     'order_payments',
        //     'order_shippings',
        //     'order_gift_cards',
        //     'order_gift_card_details',
        //     'order_applied_taxes',
        //     'order_taxes',
        //     'order_product_items',
        //     'order_products',
        // ];

        // foreach ($tables as $table) {
        //     // DB::table($table)->truncate();
        // }
    }
}
