<?php

namespace App\Http\Controllers\Pages\Order;

use App\Providers\JTIService;
use App\Enums\OrderStatusCode;
use App\Models\Order\OrderLog;
use App\Models\Pickup\OrderPickup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\ImportOrder\ImportOrder;
use App\Models\Warehouse\WarehouseStock;
use App\Repositories\Orders\WarehouseStockRepo;
use App\Http\Controllers\Pages\Shipment\TrackingController;
use App\Http\Controllers\Pages\Administration\MailTrackingController;

class AutomationController extends Controller
{
    protected $modelName = 'Automation';
    protected $isDestroyingAllowed;
    protected $model;

    public function ImportOrderByCron()
    {
        try {
            $startTime = microtime(true);
            ini_set('max_execution_time', 400); // 6 minutes
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

                $orders = json_decode(json_encode($objectData));
                $newOrderArr = DB::transaction(function () use ($orders, $confirmedOrders) {
                    $numberOfNewOrder = 0;
                    $newOrderArr = [];
                    foreach ($orders as $order) {
                        $orderId = $order->info->order_id;

                        //  ===================
                        // if ($orderId != 1000000064) {
                        //     Log::info('continue  ' . $orderId);
                        //     continue;
                        // }
                        // Log::info('found  ' . $orderId);
                        //  ===================

                        $createdNewOrder = app(ImportController::class)->processOrder($order);

                        if (!in_array($createdNewOrder->order_id, $confirmedOrders)) {
                            $numberOfNewOrder = $numberOfNewOrder + 1;
                            $newOrderArr[] = $createdNewOrder->order_id;
                            (new JTIService)->updateOrderStatus(['order_id' => $createdNewOrder->order_id, 'status_code' => 'confirmed']); //update status to JTI
                            $createdNewOrder->update(['confirmed_date' => now()]);
                            generateTaxInvoiceNumber($createdNewOrder->order_date, $createdNewOrder->order_id);
                            app(MailTrackingController::class)->sendMailToCustomer($createdNewOrder->order_id);
                            OrderLog::updateOrCreate(
                                ['order_id' => $createdNewOrder->order_id, 'status' => OrderStatusCode::Delivered->value ?? ''],
                                ['order_id' => $createdNewOrder->order_id, 'status_name' => 'Confirmed', 'status' => OrderStatusCode::Confirmed->value ?? '', 'status_date' => now()]
                            );
                        }
                    }
                    return $newOrderArr;
                });

                // End time
                $endTime = microtime(true);

                return [
                    'numberOfNewOrder' => count($newOrderArr),
                    'newOrderArr' => $newOrderArr,
                    'executionTime' => round($endTime - $startTime),
                ];
            } else {
                Log::channel("cron")->error('Cron: ImportOrder: Unable to fetch orders: ' . $response->status());
                return response()->json(['error' => 'Unable to fetch orders'], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Order Import Error: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function exportBySingleOrderByCron()
    {
        $model = ImportOrder::query();
        try {
            ini_set('max_execution_time', 400); // 6 minutes
            ini_set('memory_limit', '512M');

            $startTime = microtime(true);
            $pendingOrders = $model
                ->where('is_shipped', ImportOrder::PENDING_ORDER)
                ->pluck('order_id')->toArray();

            $chunks = array_chunk($pendingOrders, 50);

            $createdShipmentOrdersArr = [];
            foreach ($chunks as $chunk) {
                foreach ($chunk as $orderId) {
                    $createdShipmentOrders = app(ShipmentController::class)->exportBySingleOrderByCron($orderId);
                    $createdShipmentOrdersArr[] = $createdShipmentOrders;
                }

                // Sleep for a short time to prevent overwhelming the server
                sleep(2); // Adjust sleep duration based on needs
            }

            $endTime = microtime(true);

            return [
                'createdShipmentOrdersArr' => $createdShipmentOrdersArr,
                'executionTime' => round($endTime - $startTime),
            ];
        } catch (\Exception $e) {
            Log::error('Order Export Error: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function getTrackingShipmentByTrackingIdByCron()
    {
        try {

            ini_set('max_execution_time', 400); // 6 minutes
            ini_set('memory_limit', '512M');
            $startTime = microtime(true);

            // Fetch tracking data
            $trackingOrdersReferenceNo = DB::table('import_orders')
                ->where('is_shipped', ImportOrder::SHIPPED_ORDER)
                ->where('is_delivered', 0)
                ->where('is_active', 1)
                ->join('shipments', 'shipments.order_id', '=', 'import_orders.order_id')
                ->select('import_orders.order_id', 'shipments.shiping_reference_number')
                ->pluck('shipments.shiping_reference_number', 'import_orders.order_id')
                ->toArray();

            // Chunk the array into smaller arrays while preserving the keys
            $chunks = array_chunk($trackingOrdersReferenceNo, 50, true);

            // Array to store the results
            $createdTrackingOrdersArr = [];
            $found = [];
            $notFound = [];
            // Process each chunk
            foreach ($chunks as $chunk) {
                foreach ($chunk as $orderId => $orderRefeNo) {

                    // if ($orderId === 1000000060) {
                    $createdShipmentOrders = app(TrackingController::class)
                        ->getTrackingShipmentByTrackingIdForCron($orderId, $orderRefeNo);

                    if (strpos($createdShipmentOrders, 'not found') !== false) {
                        $notFound[] = $createdShipmentOrders;
                    } else {
                        $found[] = $createdShipmentOrders;
                    }
                    // }
                }
            }

            $endTime = microtime(true);
            // Return final result
            return [
                'createdTrackingOrdersArr' => ['found' => $found, 'notFound' => $notFound],
                'executionTime' => round($endTime - $startTime, 2),
            ];
        } catch (\Throwable $th) {
            Log::error('Error processing tracking orders: ' . $th->getMessage());
            throw $th;
        }
    }

    public function getReturnTrackingShipmentByTrackingIdByCron()
    {
        try {

            ini_set('max_execution_time', 400); // 6 minutes
            ini_set('memory_limit', '512M');
            $startTime = microtime(true);

            $returnTrackingOrdersReferenceNo = OrderPickup::with('pickupedShipment:order_id,pickup_shiping_reference_number')
                ->whereHas('pickupedShipment', function ($q) {
                    $q->where('pickup_shiping_reference_number', '!=', '');
                })->where('is_return_delivered', 0)
                ->get(['is_return_delivered', 'order_id'])
                ->pluck('pickupedShipment')
                ->toArray();

            // ->get();

            $returnTrackingOrdersReferenceNo;
            // Chunk the array into smaller arrays while preserving the keys
            $chunks = array_chunk($returnTrackingOrdersReferenceNo, 50, true);

            // Array to store the results
            $createdTrackingOrdersArr = [];
            $found = [];
            $notFound = [];
            // Process each chunk
            foreach ($chunks as $chunk) {

                foreach ($chunk as $key => $data) {
                    $orderId = $data['order_id'];
                    $orderRefeNo = $data['pickup_shiping_reference_number'];
                    $createdShipmentOrders = app(TrackingController::class)
                        ->getReturnTrackingShipmentByTrackingIdForCron($orderId, $orderRefeNo);

                    $temp_arr[] = $createdShipmentOrders;
                    continue;
                    if (strpos($createdShipmentOrders, 'not found') !== false) {
                        $notFound[] = $createdShipmentOrders;
                    } else {
                        $found[] = $createdShipmentOrders;
                    }
                }
            }

            return  $temp_arr;

            $endTime = microtime(true);
            // Return final result
            return [
                'createdTrackingOrdersArr' => ['found' => $found, 'notFound' => $notFound],
                'executionTime' => round($endTime - $startTime, 2),
            ];
        } catch (\Throwable $th) {
            Log::error('Error processing tracking orders: ' . $th->getMessage());
            throw $th;
        }
    }

    public function uploadWarehouseStockData()
    {
        $stkArr = [];

        $stocks = app(WarehouseStockRepo::class)->getAllStocksForUploadToJTI()->get();

        foreach ($stocks as $key => $item) {
            $stkArr[] = [
                'item_name' => $item->item,
                'sku' => $item->item_code,
                'qty' => $item->qty,
                'unit' => $item->unit,
                'product_type' => 'regular',
            ];
        }

        return (new JTIService)->uploadWarehouseStock($stkArr);
    }

    public function importStockFromRoutePro()
    {
        $response = Http::custom()
            ->get('https://routepro.aloufouk.com:81/routepro/tobacco/integration/exportdata/getwarehoursestock');

        if ($response->successful()) {

            $stocks = $response->json();
            $newRecordsCount = 0; // Counter for new records
            $newItemCodes = [];   // Array to store the item codes of newly created items

            $arr = [];
            foreach ($stocks as $key => $item) {
                // Use updateOrCreate to update existing or create new
                $stock = WarehouseStock::updateOrCreate(
                    ['item_code' => $item['item_code']], // Match by item_code
                    [
                        'item' => $item['item'],
                        'qty' => $item['qty'],
                        'unit' => $item['unit'],
                        'barcode' => $item['barcode'],
                        'item_type' => $item['item_type'],
                        'description' => $item['description'] ?? null, // Handle null descriptions
                        // 'updated_at' => now()
                    ]
                );

                $stock->touch();

                DB::table('warehouse_stocks_backup')->updateOrInsert(
                    ['item_code' => $item['item_code']], // Match by item_code
                    $stock->replicate()->toArray()
                );

                // Check if it's a new record (created)
                if ($stock->wasRecentlyCreated) {
                    $newRecordsCount++;           // Increment counter for new records
                    $newItemCodes[] = $item['item_code']; // Add the item_code to the array of new items
                }

                $arr[] = $stock;
            }

            // Return the count of new records, updated/created records, and new item codes
            return [
                'updated_or_created_records' => $arr,
                'new_records_count' => $newRecordsCount,
                'new_item_codes' => $newItemCodes // Return the new item codes as well
            ];
        }

        return ['error' => 'Failed to fetch stocks'];
    }

    public function getTrackingShipmentByTrackingIdByCronBK()
    {
        try {
            ini_set('max_execution_time', 400); // 6 minutes
            ini_set('memory_limit', '512M');

            $startTime = microtime(true);

            $trackingOrdersReferenceNo = DB::table('import_orders')
                ->where('is_shipped', ImportOrder::SHIPPED_ORDER)
                ->join('shipments', 'shipments.order_id', '=', 'import_orders.order_id')
                ->select('import_orders.order_id', 'shipments.shiping_reference_number')
                ->pluck('shiping_reference_number', 'order_id')
                ->toArray();

            $trackingOrdersReferenceNo;

            return  $chunks = array_chunk($trackingOrdersReferenceNo, 50);


            foreach ($trackingOrdersReferenceNo as $orderId => $refNumber) {
                Log::info("Order ID: $orderId, Reference Number: $refNumber\n");
            }

            // return $trackingOrdersReferenceNo;

            $createdTrackingOrdersArr = [];
            foreach ($chunks as $key => $chunk) {

                foreach ($chunk as $orderId => $orderRefeNo) {
                    Log::info("Processing Order ID: $orderId, Reference Number: $orderRefeNo");


                    // $createdShipmentOrders = app(TrackingController::class)
                    //     ->getTrackingShipmentByTrackingIdForCron($orderRefeNo);
                    // $createdTrackingOrdersArr[] = $createdShipmentOrders;
                }

                // Sleep for a short time to prevent overwhelming the server
                // sleep(2); // Adjust sleep duration based on needs
            }

            $endTime = microtime(true);

            return [
                'createdTrackingOrdersArr' => $createdTrackingOrdersArr,
                'executionTime' => round($endTime - $startTime),
            ];
        }
        // catch (\Exception $e) {
        //     Log::error('Order Tracking Error: ' . $e->getMessage());
        //     return $e->getMessage();
        // }

        catch (\Throwable $th) {
            throw $th;
        }
    }
}
