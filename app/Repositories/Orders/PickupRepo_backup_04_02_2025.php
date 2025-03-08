<?php

namespace App\Repositories\Orders;

use DateTime;
use DateTimeZone;
use App\Models\Order\OrderLog;
use App\Models\Pickup\OrderPickup;
use App\Repositories\BaseRepository;
use App\Models\Pickup\PickupTracking;
use App\Models\ImportOrder\ImportOrder;

class PickupRepo_backup_04_02_2025 extends BaseRepository
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

    public function getAllOrdes($request)
    {
        try {

            $model = OrderPickup::query();

            return $model->get();

            // return $model->with([
            //     'coupons',
            //     'customer',
            //     'billingAddress',
            //     'payment',
            //     'shipping',
            //     'gift.giftItems',
            //     'products',
            //     'tax' => ['appliedTaxes', 'itemAppliedTaxes'],
            //     'products' => ['items']
            // ])->get();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getPickupDateAndTime()
    {
        // Set the default timezone to GMT
        date_default_timezone_set('GMT');

        // Get the current timestamp and set the current date
        $current_time = time(); // Current time as a timestamp
        $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

        // Create a DateTime object for the current time in GMT
        $current_date = new DateTime('now', new DateTimeZone('GMT'));
        $current_day = $current_date->format('l'); // Get the current day (e.g., Sunday)

        // Set the ready time to 8 AM
        $ready_time = $current_date->setTime(8, 0)->getTimestamp() * 1000; // Start with 8 AM in milliseconds

        // If current day is Sunday, set to next Monday
        if ($current_day === 'Sunday') {
            $current_date->modify('next Monday');
        }

        // Check if the current time is within the specified range (8 AM to 6 PM)
        if ($current_time >= $ready_time && $current_time < $ready_time + (10 * 3600)) {
            // Current time is between 8 AM and 6 PM, use current time as ready_time
            $ready_time = $current_time * 1000; // Set ready time to current time in milliseconds
        } else {
            // If the current time is outside the 8 AM to 6 PM range, adjust to 8:30 AM
            $ready_time = $current_date->setTime(8, 30)->getTimestamp() * 1000; // Set to 8:30 AM in milliseconds
        }

        // Set the next day timestamp
        $next_day_timestamp = $current_date->modify('+1 day')->getTimestamp() * 1000; // Next day timestamp in milliseconds
        $last_pickup_time = $ready_time + (1 * 3600 * 1000); // Last pickup time is 1 hour after ready time
        $closing_time = $last_pickup_time + (1 * 3600 * 1000); // Closing time is 1 hour after last pickup

        return [
            'next_day_timestamp' => $next_day_timestamp,
            'ready_time' => $ready_time,
            'last_pickup_time' => $last_pickup_time,
            'closing_time' => $closing_time,
            'date' => date('Y-m-d H:i:s', $ready_time / 1000), // Convert milliseconds to seconds
        ];

        // return strtotime("+$days days", $date) * 1000;
    }

    public function preparePickupForReturnOrder($param, $orderId)
    {
        $shipperLocation = $param['shipper_location'];
        $orderId = $orderId;
        $orderIds = $orderId;

        $shipper = $this->pickupInfo($shipperLocation);

        $partyAddress = $shipper['partyAddress'];
        $contactDetails = $shipper['contactDetails'];

        // =======================
        // Get the current timestamp and set the current date
        $pickupDateAndTime = $this->getPickupDateAndTime();

        return  [
            "Pickup" => [
                "PickupAddress" => [
                    "Line1"               => $partyAddress['Line1'],
                    "Line2"               => $partyAddress['Line2'],
                    "Line3"               => $partyAddress['Line3'],
                    "City"                => $partyAddress['City'],
                    "StateOrProvinceCode" => $partyAddress['StateOrProvinceCode'],
                    "PostCode"            => $partyAddress['PostCode'],
                    "CountryCode"         => $partyAddress['CountryCode'],
                    "Longitude"           => $partyAddress['Longitude'],
                    "Latitude"            => $partyAddress['Latitude'],
                    "BuildingNumber"      => $partyAddress['BuildingNumber'],
                    "BuildingName"        => $partyAddress['BuildingName'],
                    "Floor"               => $partyAddress['Floor'],
                    "Apartment"           => $partyAddress['Apartment'],
                    "POBox"               => $partyAddress['POBox'],
                    "Description"         => $partyAddress['Description'],
                ],
                "PickupContact" => [
                    "Department"      => $contactDetails['Department'],
                    "PersonName"      => $contactDetails['PersonName'],
                    "Title"           => $contactDetails['Title'],
                    "CompanyName"     => $contactDetails['CompanyName'],
                    "PhoneNumber1"    => $contactDetails['PhoneNumber1'],
                    "PhoneNumber1Ext" => $contactDetails['PhoneNumber1Ext'],
                    "PhoneNumber2"    => $contactDetails['PhoneNumber2'],
                    "PhoneNumber2Ext" => $contactDetails['PhoneNumber2Ext'],
                    "FaxNumber"       => $contactDetails['FaxNumber'],
                    "CellPhone"       => $contactDetails['CellPhone'],
                    "EmailAddress"    => $contactDetails['EmailAddress'],
                    "Type"    => "",
                ],
                "PickupLocation" => "Reception",
                "PickupDate"     => "/Date(" . $pickupDateAndTime['next_day_timestamp'] . ")/",  // "/Date({{next_day_timestamp}})/",
                "ReadyTime"      => "/Date(" . $pickupDateAndTime['ready_time'] . ")/", //"/Date({{ready_time}})/",
                "LastPickupTime" => "/Date(" . $pickupDateAndTime['last_pickup_time'] . ")/", //"/Date({{last_pickup_time}})/",
                "ClosingTime"    => "/Date(" . $pickupDateAndTime['closing_time'] . ")/", // "/Date({{closing_time}})/",
                "Comments"       => "",
                "Reference1"     => "$orderId",
                "Reference2"     => "$orderIds",
                "Vehicle"        => "Car",
                "Shipments"      => null,
                "PickupItems" => [
                    [
                        "ProductGroup" => "DOM",
                        "ProductType" => "ONP",
                        "NumberOfShipments" => 1,
                        "PackageType" => "Box",
                        "Payment" => "P",
                        "ShipmentWeight" => [
                            "Unit" => "KG",
                            "Value" => 0.5,
                        ],
                        "ShipmentVolume" => null,
                        "NumberOfPieces" => 1,
                        "CashAmount" => null,
                        "ExtraCharges" => null,
                        "ShipmentDimensions" => [
                            "Length" => 0,
                            "Width" => 0,
                            "Height" => 0,
                            "Unit" => "",
                        ],
                        "Comments" => "Airway Bill Number:44097846262",
                    ],
                ],
                "Status" => "Ready",
                "ExistingShipments" => null,
                "Branch" => "",
                "RouteCode" => "",
            ],
            "Transaction" => [
                "Reference1" => "",
                "Reference2" => "",
                "Reference3" => "",
                "Reference4" => "",
                "Reference5" => "",
            ],
            "ClientInfo" => [
                "UserName" =>  config('cpanel.clientInfo.UserName'),
                "Password" => config('cpanel.clientInfo.Password'),
                'PreferredLanguageCode' => null,
                "Version" => "v1.0",
                "AccountNumber" => config('cpanel.clientInfo.AccountNumber'),
                "AccountPin" => config('cpanel.clientInfo.AccountPin'),
                "AccountEntity" => "DXB",
                "AccountCountryCode" => "AE",
                "Source" => 0
            ],
        ];
    }

    public function preparePickupData($req)
    {
        // return $req;
        $shipperLocation = $req->shipper_location;
        $orderId = $req->order_id[0];
        $orderIds = implode(',', $req->order_id);

        $shipper = $this->pickupInfo($shipperLocation);

        $partyAddress = $shipper['partyAddress'];
        $contactDetails = $shipper['contactDetails'];

        // =======================
        // Get the current timestamp and set the current date
        $pickupDateAndTime = $this->getPickupDateAndTime();

        return  [
            "Pickup" => [
                "PickupAddress" => [
                    "Line1"               => $partyAddress['Line1'],
                    "Line2"               => $partyAddress['Line2'],
                    "Line3"               => $partyAddress['Line3'],
                    "City"                => $partyAddress['City'],
                    "StateOrProvinceCode" => $partyAddress['StateOrProvinceCode'],
                    "PostCode"            => $partyAddress['PostCode'],
                    "CountryCode"         => $partyAddress['CountryCode'],
                    "Longitude"           => $partyAddress['Longitude'],
                    "Latitude"            => $partyAddress['Latitude'],
                    "BuildingNumber"      => $partyAddress['BuildingNumber'],
                    "BuildingName"        => $partyAddress['BuildingName'],
                    "Floor"               => $partyAddress['Floor'],
                    "Apartment"           => $partyAddress['Apartment'],
                    "POBox"               => $partyAddress['POBox'],
                    "Description"         => $partyAddress['Description'],
                ],
                "PickupContact" => [
                    "Department"      => $contactDetails['Department'],
                    "PersonName"      => $contactDetails['PersonName'],
                    "Title"           => $contactDetails['Title'],
                    "CompanyName"     => $contactDetails['CompanyName'],
                    "PhoneNumber1"    => $contactDetails['PhoneNumber1'],
                    "PhoneNumber1Ext" => $contactDetails['PhoneNumber1Ext'],
                    "PhoneNumber2"    => $contactDetails['PhoneNumber2'],
                    "PhoneNumber2Ext" => $contactDetails['PhoneNumber2Ext'],
                    "FaxNumber"       => $contactDetails['FaxNumber'],
                    "CellPhone"       => $contactDetails['CellPhone'],
                    "EmailAddress"    => $contactDetails['EmailAddress'],
                    "Type"    => "",
                ],
                "PickupLocation" => "Reception",
                "PickupDate"     => "/Date(" . $pickupDateAndTime['next_day_timestamp'] . ")/",  // "/Date({{next_day_timestamp}})/",
                "ReadyTime"      => "/Date(" . $pickupDateAndTime['ready_time'] . ")/", //"/Date({{ready_time}})/",
                "LastPickupTime" => "/Date(" . $pickupDateAndTime['last_pickup_time'] . ")/", //"/Date({{last_pickup_time}})/",
                "ClosingTime"    => "/Date(" . $pickupDateAndTime['closing_time'] . ")/", // "/Date({{closing_time}})/",
                "Comments"       => "",
                "Reference1"     => "$orderId",
                "Reference2"     => "$orderIds",
                "Vehicle"        => "Car",
                "Shipments"      => null,
                "PickupItems" => [
                    [
                        "ProductGroup" => "DOM",
                        "ProductType" => "ONP",
                        "NumberOfShipments" => 1,
                        "PackageType" => "Box",
                        "Payment" => "P",
                        "ShipmentWeight" => [
                            "Unit" => "KG",
                            "Value" => 0.5,
                        ],
                        "ShipmentVolume" => null,
                        "NumberOfPieces" => 1,
                        "CashAmount" => null,
                        "ExtraCharges" => null,
                        "ShipmentDimensions" => [
                            "Length" => 0,
                            "Width" => 0,
                            "Height" => 0,
                            "Unit" => "",
                        ],
                        "Comments" => "Airway Bill Number:44097846262",
                    ],
                ],
                "Status" => "Ready",
                "ExistingShipments" => null,
                "Branch" => "",
                "RouteCode" => "",
            ],
            "Transaction" => [
                "Reference1" => "",
                "Reference2" => "",
                "Reference3" => "",
                "Reference4" => "",
                "Reference5" => "",
            ],
            "ClientInfo" => [
                "UserName" =>  config('cpanel.clientInfo.UserName'),
                "Password" => config('cpanel.clientInfo.Password'),
                'PreferredLanguageCode' => null,
                "Version" => "v1.0",
                "AccountNumber" => config('cpanel.clientInfo.AccountNumber'),
                "AccountPin" => config('cpanel.clientInfo.AccountPin'),
                "AccountEntity" => "DXB",
                "AccountCountryCode" => "AE",
                "Source" => 0
            ],
        ];
    }

    public function storePickupResponse($resp)
    {
        $pickup = $resp['ProcessedPickup'];
        try {
            $createdPickup = OrderPickup::updateOrCreate(
                [
                    'order_id'            => $pickup['Reference1'] ?? '',
                    // 'pickup_id'           => $pickup['ID'] ?? '',
                    // 'guid'                => $pickup['GUID'] ?? '',
                ],
                [
                    'order_id'            => $pickup['Reference1'] ?? '',
                    'pickup_id'           => $pickup['ID'] ?? '',
                    'guid'                => $pickup['GUID'] ?? '',
                    'reference1'          => $pickup['Reference1'] ?? '',
                    'reference2'          => $pickup['Reference2'] ?? '',
                    'processed_shipments' => $pickup['Reference1'] ?? '',
                    'notifications'       => $resp['Notifications'] ?? '',
                    'transaction'         => $resp['Transaction'] ?? '',
                ]
            );

            return $createdPickup;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateOrCreatePickupTracking($trackingId, $arr, $trackingResults)
    {
        $pickupInfo = OrderPickup::wherePickupId($trackingId)->first();

        $pickupTrackingCreated = PickupTracking::updateOrCreate(
            [
                'order_pickup_id' => $pickupInfo->id,
                'import_order_id' => $pickupInfo->order_id,
                // 'reference' => $arr['Reference'] ?? '',
            ],
            [
                'order_pickup_id' => $pickupInfo->id,
                'import_order_id' => $pickupInfo->order_id,
                'entity' => $arr['Entity'] ?? '',
                'reference' => $arr['Reference'] ?? '',
                'collection_date' => $arr['CollectionDate'] ?? '',
                'pickup_date' => $arr['PickupDate'] ?? '',
                'last_status' => $arr['LastStatus'] ?? '',
                'last_status_description' => $arr['LastStatusDescription'] ?? '',
                'collected_waybills' => json_encode($trackingResults['CollectedWaybills']) ?? [],
                'has_errors' => $trackingResults['HasErrors'] ?? false,
                'org_collection_date' => $trackingResults['CollectionDate'],
                'org_pickup_date' => $trackingResults['PickupDate'],
                'reference1' => $trackingResults['Transaction']['Reference1'] ?? '',
                'reference2' => $trackingResults['Transaction']['Reference2'] ?? '',
                'reference3' => $trackingResults['Transaction']['Reference3'] ?? '',
                'reference4' => $trackingResults['Transaction']['Reference4'] ?? '',
                'reference5' => $trackingResults['Transaction']['Reference5'] ?? '',
            ]
        );

        OrderLog::updateOrCreate(
            ['order_id' => $pickupInfo->order_id, 'status' => 'return' ?? ''],
            ['order_id' => $pickupInfo->order_id, 'status_name' => 'return', 'status' => 'return' ?? '', 'comment' => $arr['LastStatus'] ?? '', 'status_date' => now()]
        );
    }

    public function pickupInfo($type = 'sharjah')
    {
        $arr = [
            'sharjah' => [
                'partyAddress' => [
                    'Line1' => 'Industrial Area no. 17',
                    'Line2' => 'Maliha St',
                    'Line3' => '',
                    'City' => 'Sharjah',
                    'StateOrProvinceCode' => 'Sharjah',
                    'PostCode' => '00000',
                    'CountryCode' => 'AE',
                    'Longitude' => '55.4458',
                    'Latitude' => '25.2867',
                    'BuildingNumber' => '.8/2640',
                    'BuildingName' => 'Al Oufouk Building',
                    'Floor' => 'Ground Floor',
                    'Apartment' => 'Warehouse no. 4',
                    'POBox' => '2097',
                    'Description' => 'Central Warehouse',
                    // 'Type' => ''
                ],
                'contactDetails' => [
                    'Department' => 'Logistic Department',
                    'PersonName' => 'Syed Azam',
                    'CompanyName' => 'AL Oufouk Co.L.L.C.',
                    'Title' => 'Assistant Storekeeper',
                    "PhoneNumber1" => "97165341785",
                    "PhoneNumber1Ext" => "", // "163",
                    "PhoneNumber2" => "97165341222",
                    "PhoneNumber2Ext" => null,
                    'FaxNumber' => 'N/A',
                    'CellPhone' => '971502918689', //971 55 6115754,
                    'EmailAddress' => 'azam@aloufouk.com'
                ]
            ],

            'abudhabi' => [
                'partyAddress' => [
                    'Line1' => 'ICAD 1',
                    'Line2' => 'TAM PERFUME FACTORY, COMPOUND',
                    'Line3' => 'W/H NO-2',
                    'City' => 'ABUDHABI',
                    'StateOrProvinceCode' => 'ABUDHABI',
                    'PostCode' => '4936- ABUDHABI',
                    'CountryCode' => 'AE',
                    'Longitude' => '24.322633',
                    'Latitude' => '54.506784',
                    'BuildingNumber' => '',
                    'BuildingName' => 'TAM PERFUME FACTORY, COMPOUND W/H NO-2',
                    'Floor' => 'GROUND',
                    'Apartment' => '',
                    'POBox' => '4936',
                    'Description' => '',
                    'Type' => ''
                ],

                'contactDetails' => [
                    'Contact' => '026731551',
                    'Department' => 'Logistic Department',
                    'PersonName' => 'Vinod Pai',
                    'CompanyName' => 'AL OUFOUK INTERNATIONAL COMPANY',
                    'Title' => 'STORE KEEPER',
                    "PhoneNumber1" => "026731551",
                    "PhoneNumber1Ext" => "",
                    "PhoneNumber2" => "",
                    "PhoneNumber2Ext" => null,
                    'FaxNumber' => 'N/A',
                    'FaxNumber' => '',
                    'CellPhone' => '0556118009',
                    'EmailAddress' => 'VINOD.PAI@ALOUFOUK.COM'
                ]
            ]
        ];

        return $arr[$type];
    }

    public function getAccessPermission(): array
    {
        return [
            'isView' => false,
            'isEdit' => false,
            'isDelete' =>  false,
            'isPrint' => false,
            'isTracking' => true
        ];
    }

    public function test()
    {
        // return $req;

        // =======================
        // Get the current timestamp and set the current date
        $current_time = time(); // Current time as a timestamp
        $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

        // Set environment variables (for example, in Laravel, you can use config or env)
        $next_day_timestamp = $this->addDays($current_timestamp / 1000, 1); // Next day timestamp in milliseconds

        $ready_time = $next_day_timestamp + (1 * 3600 * 1000); // Add 1 hour in milliseconds
        $last_pickup_time = $next_day_timestamp + (2 * 3600 * 1000); // Add 2 hours in milliseconds
        $closing_time = $next_day_timestamp + (3 * 3600 * 1000); // Add 3 hours in milliseconds

        /*-----------------------------------------------------------------------------------\
               | Note:                                                                       |
               |    Aramex Working Hours:        08 AM - 6 PM                                |
               |    Aramex Working Days:         Mon - Sat                                   |
               |                                                                             |
               | Aramex pickup data and time should be in the following format:              |
               |                                                                             |
               |    "PickupDate":              "/Date({{next_day_timestamp}})/",             |
               |    "ReadyTime":              "/Date({{ready_time}})/", // 4 PM              |
               |    "LastPickupTime":         "/Date({{last_pickup_time}})/", // 6 PM        |
               |    "ClosingTime":            "/Date({{closing_time}})/", // 6 PM            |
               \------------------------------------------------------------------------------*/

        // =======================
        // return [
        //     'next_day_timestamp' => $next_day_timestamp,
        //     'ready_time' => $ready_time,
        //     'last_pickup_time' => $last_pickup_time,
        //     'closing_time' => $closing_time,
        // ];

    }
}
