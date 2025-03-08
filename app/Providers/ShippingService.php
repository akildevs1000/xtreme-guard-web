<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use App\Models\Shipment\OrderTracking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class ShippingService extends ServiceProvider
{
    protected $baseUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->baseUrl = config('cpanel.aramex.base_url');
        $this->username = config('cpanel.api.username');
        $this->password = config('cpanel.api.password');
    }

    public function createShipment(array $shipmentData)
    {
        try {
            $createUrl = $this->baseUrl . 'ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments';

            $response = Http::withOptions(
                // ['verify' => base_path('public/assets/cacert.pem')]
                ['verify' => false]
            )->post($createUrl, $shipmentData);

            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getTrackingInfo($payload) // this for after create shipment getting tracking information
    {
        try {
            $TrackingPayload = [
                "Shipments" => [
                    $payload['shiping_reference_number']
                    // 44262358066
                ],
                "GetLastTrackingUpdateOnly" => true,
                "ClientInfo" => [
                    "UserName"              => config('cpanel.clientInfo.UserName'),
                    "Password"              => config('cpanel.clientInfo.Password'),
                    'PreferredLanguageCode' => null,
                    "Version"               => "v1.0",
                    "AccountNumber"         => config('cpanel.clientInfo.AccountNumber'),
                    "AccountPin"            => config('cpanel.clientInfo.AccountPin'),
                    "AccountEntity"         => "DXB",
                    "AccountCountryCode"    => "AE",
                    "Source"                => 0
                ],
                "Transaction" => [
                    "Reference1" => null,
                    "Reference2" => null,
                    "Reference3" => null,
                    "Reference4" => null,
                    "Reference5" => null
                ]
            ];

            $createUrl = $this->baseUrl . 'ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackShipments';

            $response = Http::withOptions(
                // ['verify' => base_path('public/assets/cacert.pem')]
                ['verify' => false]
            )->post($createUrl, $TrackingPayload);

            return $response->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getTrackingInfoByTrackingId($trackingId, $GetLastTrackingUpdateOnly = true)
    {
        try {
            $TrackingPayload = [
                "Shipments" => [
                    $trackingId
                ],
                "GetLastTrackingUpdateOnly" => $GetLastTrackingUpdateOnly,
                "ClientInfo" => [
                    "UserName"              => config('cpanel.clientInfo.UserName'),
                    "Password"              => config('cpanel.clientInfo.Password'),
                    'PreferredLanguageCode' => null,
                    "Version"               => "v1.0",
                    "AccountNumber"         => config('cpanel.clientInfo.AccountNumber'),
                    "AccountPin"            => config('cpanel.clientInfo.AccountPin'),
                    "AccountEntity"         => "DXB",
                    "AccountCountryCode"    => "AE",
                    "Source"                => 0
                ],
                "Transaction" => [
                    "Reference1" => null,
                    "Reference2" => null,
                    "Reference3" => null,
                    "Reference4" => null,
                    "Reference5" => null
                ]
            ];

            $createUrl = $this->baseUrl . 'ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackShipments';

            $response = Http::withOptions(
                // ['verify' => base_path('public/assets/cacert.pem')]
                ['verify' => false]
            )->post($createUrl, $TrackingPayload);

            if ($response->json('HasErrors')) {
                Log::channel('ShipmentTrackingFromAramex')
                    ->error(json_encode(['payload' => $TrackingPayload, 'response' => $response->json()], JSON_PRETTY_PRINT));
            } else {
                Log::channel('ShipmentTrackingFromAramex')
                    ->info(json_encode(['payload' => $TrackingPayload, 'response' => $response->json()], JSON_PRETTY_PRINT));
            }

            return $response->json();
        } catch (\Throwable $th) {
            throw $th;
            Log::error('Exception occurred during Tracking Shipment', [
                'Payload' => $TrackingPayload,
                'Error' => $th->getMessage()
            ]);
        }
    }

    public function createPickup($payload)
    {
        try {
            $createUrl = $this->baseUrl . 'ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreatePickup';

            $response = Http::withOptions(
                // ['verify' => base_path('public/assets/cacert.pem')]
                ['verify' => false]
            )->post($createUrl, $payload);

            return $response->json();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $payload;
    }

    public function getPickupTrackingInfoByTrackingId($trackingId)
    {
        try {
            $TrackingPayload = [
                'Reference' => $trackingId,
                "GetLastTrackingUpdateOnly" => true,
                "ClientInfo" => [
                    "UserName"              => config('cpanel.clientInfo.UserName'),
                    "Password"              => config('cpanel.clientInfo.Password'),
                    'PreferredLanguageCode' => null,
                    "Version"               => "v1.0",
                    "AccountNumber"         => config('cpanel.clientInfo.AccountNumber'),
                    "AccountPin"            => config('cpanel.clientInfo.AccountPin'),
                    "AccountEntity"         => "DXB",
                    "AccountCountryCode"    => "AE",
                    "Source"                => 0
                ],
                "Transaction" => [
                    "Reference1" => null,
                    "Reference2" => null,
                    "Reference3" => null,
                    "Reference4" => null,
                    "Reference5" => null
                ]
            ];

            $createUrl = $this->baseUrl . 'ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackPickup';
            Log::info(json_encode($TrackingPayload));
            $response = Http::withOptions(
                // ['verify' => base_path('public/assets/cacert.pem')]
                ['verify' => false]
            )->post($createUrl, $TrackingPayload);


            if ($response->json('HasErrors')) {
                Log::channel('PickupTrackingFromAramex')
                    ->error(json_encode(['payload' => $TrackingPayload, 'response' => $response->json()], JSON_PRETTY_PRINT));
            } else {
                Log::channel('PickupTrackingFromAramex')
                    ->info(json_encode(['payload' => $TrackingPayload, 'response' => $response->json()], JSON_PRETTY_PRINT));
            }

            return $response->json();
        } catch (\Throwable $th) {
            Log::error('Exception occurred during Tracking Pickup', [
                'Payload' => $TrackingPayload,
                'Error' => $th->getMessage()
            ]);
            throw $th;
        }
    }
}
