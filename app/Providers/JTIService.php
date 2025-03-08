<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Http;
use App\Models\ImportOrder\ImportOrder;
use Illuminate\Support\ServiceProvider;
use App\Models\Warehouse\StockSyncHistory;

class JTIService extends ServiceProvider
{
    protected $baseUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->baseUrl = config('cpanel.jti.base_url');
        // $this->username = config('cpanel.jti.username');
        // $this->password = config('cpanel.jti.password');
    }

    public function updateOrderStatus(array $payload = [])
    {
        try {

            if ($payload) {

                $orderId = $payload['order_id'];
                $url = $this->baseUrl . "orders/$orderId/status";

                $response = Http::withOptions(
                    ['verify' => false]
                )->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                ])->post($url, $payload);

                $payload['datetime'] = date('Y-m-d H:i');

                if ($response) {

                    if ($payload['status_code'] == 'confirmed') {
                        Log::channel('ConfimedStatus')->info(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                        // Log::channel('ConfimedStatus')->info('success', ['payload' => $payload, 'response' => $response->json()]);
                        ImportOrder::where('order_id', $orderId)->update(['is_confirmed' => 1]);
                    }

                    if ($payload['status_code'] == 'shipped_to_warehouse') {
                        Log::channel('ShippedToWarehouse')->info(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                    }

                    if ($payload['status_code'] == 'shipped') { //out for delivery
                        // Log::channel('ShippedStatus')->info('success', ['payload' => $payload, 'response' => $response->json()]);
                        Log::channel('ShippedStatus')->info(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                    }

                    if ($payload['status_code'] == 'delivered') {
                        // Log::channel('DeliveredStatus')->info('success', ['payload' => $payload, 'response' => $response->json()]);
                        Log::channel('DeliveredStatus')->info(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                    }
                } else {
                    if ($payload['status_code'] == 'confirmed') {
                        Log::channel('ConfimedStatus')->error('error', ['payload' => $payload, 'response' => $response->json()]);
                    }
                    if ($payload['status_code'] == 'shipped_to_warehouse') {
                        Log::channel('ShippedToWarehouse')->error('error', ['payload' => $payload, 'response' => $response->json()]);
                    }
                    if ($payload['status_code'] == 'shipped') {
                        Log::channel('ShippedStatus')->error('error', ['payload' => $payload, 'response' => $response->json()]);
                    }
                    if ($payload['status_code'] == 'delivered') {
                        Log::channel('DeliveredStatus')->error('error', ['payload' => $payload, 'response' => $response->json()]);
                    }
                }
                return $response;
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadOrderInvoicePDF(array $payload = [])
    {
        try {

            if ($payload) {

                $orderId = $payload['order_id'];
                $url = $this->baseUrl . "orders/$orderId/invoice";

                $pdfPath = asset("storage/invoices/order-$orderId.pdf");

                if ($pdfPath) {

                    $file  = pdfToBase64($pdfPath);

                    $payload = ['file' => $file];

                    $response = Http::withOptions(
                        ['verify' => false]
                    )->withHeaders([
                        'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                    ])->post($url, $payload);


                    if ($response) {
                        $payload['order_id'] = $orderId;
                        $payload['datetime'] = date('Y-m-d H:i');
                        Log::channel('uploadedInvoice')->info('success', ['payload' => $payload, 'response' => $response->json()]);
                    } else {

                        Log::channel('uploadedInvoice')->error('error', ['payload' => $payload, 'response' => $response->json()]);
                    }

                    return $response;
                }
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateOrderStatusOld(array $payload = [])
    {
        try {

            if ($payload) {

                $orderId = $payload['order_id'];
                $url = $this->baseUrl . "orders/$orderId/status";

                $response = Http::withOptions(
                    ['verify' => false]
                )->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                ])->post($url, $payload);


                if ($response) {
                    $payload['datetime'] = date('Y-m-d H:i');

                    Log::channel('ConfimedStatus')->info('success', ['payload' => $payload, 'response' => $response->json()]);
                    // Log::channel('ConfimedStatus')->info("success\n" . json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                } else {
                    // Log::channel('ConfimedStatus')->error(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                    Log::channel('ConfimedStatus')->info('success', ['payload' => $payload, 'response' => $response->json()]);
                }

                return $response;
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadWarehouseStock(array $payload = [])
    {
        try {

            if ($payload) {

                $url = "https://api.qa-jtides.com/MMDESUAE/MPI-IN/OMS/V1/stockbulk";

                $response = Http::withOptions(
                    ['verify' => false]
                )->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => 'f0639ee023c84584b9c37f80695d1e87'
                ])->put($url, $payload);

                if ($response) {
                    Log::channel('warehouseStockUpload')
                        ->info(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));

                    StockSyncHistory::create([
                        'sync_time' => now(),
                        'payload' => $payload,
                        'response' => $response->json(),
                        'desc' => 'Stock sync completed successfully',
                    ]);
                } else {
                    Log::channel('warehouseStockUpload')
                        ->error('success', ['payload' => $payload, 'response' => $response->json()]);
                }

                return $response;
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function SendToTrackingDetails(array $payload = [], $orderId = "")
    {
        try {

            if ($payload) {

                $url = $this->baseUrl . "orders/$orderId/shipping";

                $response = Http::withOptions(
                    ['verify' => false]
                )->withHeaders([
                    'X-DES-EXT-SERVICE-AK' => '101b62e158cf4b81bfd6c49e14332380'
                ])->post($url, $payload);

                $payload['order_id'] = $orderId;

                if (isset($response['errors'])) {
                    Log::channel('sendToTrackingInfo')
                        ->error(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                } else {
                    Log::channel('sendToTrackingInfo')
                        ->info(json_encode(['payload' => $payload, 'response' => $response->json()], JSON_PRETTY_PRINT));
                }

                return $response;
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
