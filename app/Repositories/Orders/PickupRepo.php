<?php

namespace App\Repositories\Orders;

use DateTime;
use DateTimeZone;
use App\Models\Order\OrderLog;
use App\Models\Pickup\OrderPickup;
use App\Repositories\BaseRepository;
use App\Models\Pickup\PickupTracking;
use App\Models\ImportOrder\ImportOrder;
use App\Models\Pickup\PickupShipment;
use App\Models\Pickup\PickupShipmentDetail;

class PickupRepo extends BaseRepository
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
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getPickupDateAndTime($param = [])
    {
        // -----------------

        if (isset($param['is_enable_pickup_date']) && $param['is_enable_pickup_date']) {
            $input_date = $param['pickupDate']; // Example input date and time
            $current_time = strtotime($param['pickupTime']);  // Convert to Unix timestamp
            $currency_hour = date('H', $current_time);
            $currency_minit = date('i', $current_time);
        } else {
            $input_date = "now"; // Example input date and time
            $current_time = time();  // Convert to Unix timestamp
            $currency_hour = '08';
            $currency_minit = '30';
        }

        // $input_date = "2024-08-05 14:30:00"; // Example input date and time
        // $timestamp = strtotime($input_date);  // Convert to Unix timestamp

        // echo $timestamp; // Output: 1722868200 (example)

        // return [
        //     $currency_hour,
        //     $currency_minit
        // ];

        // -----------------

        // Set the default timezone to GMT
        date_default_timezone_set('GMT');

        // Get the current timestamp and set the current date
        $current_time = time(); // Current time as a timestamp
        $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

        // Create a DateTime object for the current time in GMT
        $current_date = new DateTime($input_date, new DateTimeZone('GMT'));
        $current_day = $current_date->format('l'); // Get the current day (e.g., Sunday)

        // Set the ready time to 8 AM
        $ready_time = $current_date->setTime($currency_hour, $currency_minit)->getTimestamp() * 1000; // Start with 8 AM in milliseconds

        // $ready_time = $current_date->setTime(8, 0)->getTimestamp() * 1000; // Start with 8 AM in milliseconds

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
            $ready_time = $current_date->setTime($currency_hour, $currency_minit)->getTimestamp() * 1000; // Set to 8:30 AM in milliseconds
            // $ready_time = $current_date->setTime(8, 30)->getTimestamp() * 1000; // Set to 8:30 AM in milliseconds
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
            'next_day_timestamp_date' => date('Y-m-d H:i:s', $next_day_timestamp / 1000),
        ];

        // return strtotime("+$days days", $date) * 1000;
    }

    public function preparePickupForReturnOrder($param, $orderId)
    {
        $shipperLocation = $param['shipper_location'];
        $customerCity = $param['customer_city'];
        $mobileNumber = $param['customer_mobile'];
        $orderId = $orderId;
        $orderIds = $orderId;

        $order = app(ShipmentRepo::class)->getOrdeByIdForExport($orderId);
        // return $order;

        $shipper = $this->pickupInfo($shipperLocation);

        $partyAddress = $shipper['partyAddress'];
        $contactDetails = $shipper['contactDetails'];

        // $customerCity = $this->getCity($order->shipping->address['city']);

        // =======================
        // Get the current timestamp and set the current date
        $pickupDateAndTime = $this->getPickupDateAndTime($param);

        return  [
            "Pickup" => [
                "PickupAddress" => [
                    "Line1"               => implode(',', $order->shipping->address['street']),
                    "Line2"               => implode(',', $order->shipping->address['street']),
                    "Line3"               => $order->shipping->address['city'] ?? '',
                    "City"                => $customerCity ?? '',
                    "StateOrProvinceCode" => "",
                    "PostCode"            => $order->shipping->address['postcode'] ?? '',
                    "CountryCode"         => "AE",
                    "Longitude"           => 0,
                    "Latitude"            => 0,
                    "BuildingNumber"      => null,
                    "BuildingName"        => null,
                    "Floor"               => null,
                    "Apartment"           => null,
                    "POBox"               => null,
                    "Description"         => null
                ],

                "PickupContact" => [
                    "Department" => null,
                    "PersonName"      => $order->customer->first_name,
                    "Title"           => null,
                    "CompanyName"     => $order->customer->last_name,
                    "PhoneNumber1"    => $mobileNumber, // should be correct format phone number,
                    // "PhoneNumber1"    => $order->customer->phone, // should be correct format phone number,
                    // "PhoneNumber1"    => "048707766",
                    "PhoneNumber1Ext" => '',
                    "PhoneNumber2"    => "",
                    "PhoneNumber2Ext" => "",
                    "FaxNumber"       => null,
                    "CellPhone"       => $mobileNumber ?? '',
                    // "CellPhone"       => $order->shipping->address['telephone'] ?? '',
                    "EmailAddress"    => $order->shipping->address['email'] ?? '',
                    "Type"            => ""
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

                // ---------------------
                "Shipments"      => $this->prepareShipmentForPickup($order, $param),

                // ---------------------

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

    private function getCity($city)
    {
        $aramexValidCities = config('cpanel.aramexValidCities');

        return in_array($city, $aramexValidCities) ? $city : 'dubai';
    }

    public function prepareShipmentForPickup($order, $param)
    {
        // return $current_timestamp =  time(); // round(microtime(true) * 1000);
        // $current_timestamp = 1722340617373;  // round(microtime(true) * 1000);
        $current_timestamp = round(microtime(true) * 1000);

        $shipper = $this->pickupInfo('sharjah');
        $partyAddress = $shipper['partyAddress'];
        $contactDetails = $shipper['contactDetails'];

        // $customerCity = $this->getCity($order->shipping->address['city']);
        $customerCity = $param['customer_city'];
        $mobileNumber = $param['customer_mobile'];

        $aramexItemsArr = $this->addOrderItemsToCreateShipment($order);

        return [
            [
                "Reference1" => $order->order_id ?? "",
                "Reference2" => null,
                "Reference3" => null,
                "Shipper" => [
                    "Reference1" => $order->order_id ?? "",
                    "Reference2" => null,
                    "AccountNumber" => config('cpanel.clientInfo.AccountNumber'),
                    "PartyAddress" => [
                        "Line1" => implode(',', $order->shipping->address['street']),
                        "Line2" => "",
                        "Line3" => $order->shipping->address['city'] ?? '',
                        "City" => $customerCity ?? '',
                        "StateOrProvinceCode" => "",
                        "PostCode" => $order->shipping->address['postcode'] ?? '',
                        "CountryCode" => "AE",
                        "Longitude" => 0,
                        "Latitude" => 0,
                        "BuildingNumber" => null,
                        "BuildingName" => null,
                        "Floor" => null,
                        "Apartment" => null,
                        "POBox" => null,
                        "Description" => null
                    ],
                    "Contact" => [
                        "Department" => null,
                        "PersonName"      => $order->customer->first_name,
                        "Title"           => null,
                        "CompanyName"     => $order->customer->last_name,
                        "PhoneNumber1"    => $mobileNumber,
                        // "PhoneNumber1"    => "048707766", // should be correct format phone number,
                        "PhoneNumber1Ext" => '',
                        "PhoneNumber2"    => "",
                        "PhoneNumber2Ext" => "",
                        "FaxNumber"       => null,
                        "CellPhone"       => $mobileNumber ?? '',
                        // "CellPhone"       => $order->shipping->address['telephone'] ?? '',
                        "EmailAddress"    => $order->shipping->address['email'] ?? '',
                        "Type"            => ""
                    ]
                ],
                "Consignee" => [
                    "Reference1" => $order->order_id ?? "",
                    "Reference2" => null,
                    "AccountNumber" => null,
                    "PartyAddress" => [
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
                    "Contact" => [

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
                    ]
                ],
                "ThirdParty" => null,
                "ShippingDateTime" => "/Date($current_timestamp)/",
                "DueDate" => "/Date($current_timestamp)/",
                "Comments" => null,
                "PickupLocation" => "office",
                "OperationsInstructions" => null,
                "AccountingInstrcutions" => null,
                "Details" => [
                    "Dimensions" => [
                        "Length" => 0,
                        "Width" => 0,
                        "Height" => 0,
                        "Unit" => "CM"
                    ],
                    "ActualWeight" => [
                        "Unit" => "KG",
                        "Value" => 0.1
                    ],
                    "ChargeableWeight" => [
                        "Unit" => "KG",
                        "Value" => 0
                    ],
                    "DescriptionOfGoods" => "Items",
                    "GoodsOriginCountry" => "AE",
                    "NumberOfPieces" => 1,
                    "ProductGroup" => "DOM",
                    "ProductType" => "ONP",
                    "PaymentType" => "P",
                    "PaymentOptions" => "ACCT",
                    "CustomsValueAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "InsuranceAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "CashOnDeliveryAmount" =>  $this->getPaymentInfo($order->payment, 'CashOnDeliveryAmount'),
                    "CashAdditionalAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "CashAdditionalAmountDescription" => null,
                    "CollectAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "Services" => $order->payment->payment_method == 'cashondelivery'  ? 'CODS' : '',
                    "Items" => $aramexItemsArr['Items'] ?? [],

                    "DeliveryInstructions" => null,
                    "AdditionalProperties" => null,
                    "ContainsDangerousGoods" => false
                ],
                "Attachments" => null,
                "ForeignHAWB" => null,
                "TransportType " => 0,
                "PickupGUID" => null,
                "Number" => null,
                "ScheduledDelivery" => null
            ]
        ];
    }

    public function addOrderItemsToCreateShipment($order)
    {
        $order->products->toArray();

        $aramexItemsArr = [];

        foreach ($order->products->toArray() as $key => $product) {

            $hasItems = count($product['items']);

            if ($hasItems > 0) {


                foreach ($product['items'] as $item) {
                    // return   $item;

                    $aramexItemsArr["Items"][] = [
                        "PackageType" => "item",
                        "Quantity" => $item['qty'],
                        "Weight" => [
                            "Unit" => "CM",
                            "Value" => 0
                        ],
                        "Comments" => $item['name'] . " - " . $item['sku'],
                        "Reference" => $item['sku'],
                        "PiecesDimensions" => null,
                        "CommodityCode" => null,
                        "GoodsDescription" => null,
                        "CountryOfOrigin" => null,
                        "CustomsValue" => null,
                        "ContainerNumber" => null
                    ];
                }
            } else {
                $aramexItemsArr["Items"][] = [
                    "PackageType" => "item",
                    "Quantity" => $product['qty_ordered'],
                    "Weight" => [
                        "Unit" => "CM",
                        "Value" => 0
                    ],
                    "Comments" => $product['name'] . " - " . $product['sku'],
                    "Reference" => $product['sku'],
                    "PiecesDimensions" => null,
                    "CommodityCode" => null,
                    "GoodsDescription" => null,
                    "CountryOfOrigin" => null,
                    "CustomsValue" => null,
                    "ContainerNumber" => null
                ];
            }
        }

        return $aramexItemsArr;
    }

    private function getPaymentInfo($payment, $payMode)
    {
        // return $payment->payment_method;
        $amount = 0;
        $currency = 'AED';
        if ($payment->payment_method == 'cashondelivery' && $payMode == 'CashOnDeliveryAmount') {
            $amount = $payment->amount;
            $currency = $payment->currency ?? 'AED';
        }

        if ($payMode == 'InsuranceAmount') {
            $amount = 0;
            $currency = 'AED';
        }

        if ($payMode == 'CashAdditionalAmount') {
            $amount = 0;
            $currency = 'AED';
        }
        // return $amount;

        return [
            'Value' => $amount ?? 0,
            'CurrencyCode' => $currency ?? 'AED',
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
        // return   $ProcessedShipments = $resp;
        $ProcessedShipments = $resp['ProcessedPickup']['ProcessedShipments'][0];
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
            // return $ProcessedShipments;
            $ShipmentCreated = PickupShipment::updateOrCreate(
                [
                    'order_id' => $ProcessedShipments['Reference1'],
                ],
                [
                    'pickup_id'                 => $createdPickup->id,
                    'order_id'                 => $ProcessedShipments['Reference1'],
                    'pickup_shiping_reference_number' => $ProcessedShipments['ID'],
                    'reference1'               => $ProcessedShipments['Reference1'],
                    'reference2'               => $ProcessedShipments['Reference2'],
                    'reference3'               => $ProcessedShipments['Reference3'],
                    'foreign_hawb'             => $ProcessedShipments['ForeignHAWB'],
                    'has_errors'               => $ProcessedShipments['HasErrors'],
                    'notifications'            => json_encode($ProcessedShipments['Notifications']),
                ]
            );

            if ($ShipmentCreated) {
                PickupShipmentDetail::firstOrCreate(
                    [
                        'pickup_shipment_id'                    => $ShipmentCreated->id,
                        'pickup_shiping_reference_number'       => $ShipmentCreated->pickup_shiping_reference_number,
                    ],
                    [
                        'pickup_shipment_id'                    => $ShipmentCreated->id,
                        'pickup_shiping_reference_number'       => $ShipmentCreated->pickup_shiping_reference_number,
                        'origin'                         => $shipmentDetails['Origin'] ?? null,
                        'destination'                    => $shipmentDetails['Destination'] ?? null,
                        'chargeable_weight_unit'         => $shipmentDetails['ChargeableWeight']['Unit'] ?? null,
                        'chargeable_weight_value'        => $shipmentDetails['ChargeableWeight']['Value'] ?? null,
                        'description_of_goods'           => $shipmentDetails['DescriptionOfGoods'] ?? null,
                        'goods_origin_country'           => $shipmentDetails['GoodsOriginCountry'] ?? null,
                        'number_of_pieces'               => $shipmentDetails['NumberOfPieces'] ?? null,
                        'product_group'                  => $shipmentDetails['ProductGroup'] ?? null,
                        'product_type'                   => $shipmentDetails['ProductType'] ?? null,
                        'payment_type'                   => $shipmentDetails['PaymentType'] ?? null,
                        'payment_options'                => $shipmentDetails['PaymentOptions'] ?? null,
                        'customs_value_currency_code'    => $shipmentDetails['CustomsValueAmount']['CurrencyCode'] ?? null,
                        'customs_value_amount'           => $shipmentDetails['CustomsValueAmount']['Value'] ?? 0,
                        'cash_on_delivery_currency_code' => $shipmentDetails['CashOnDeliveryAmount']['CurrencyCode'] ?? null,
                        'cash_on_delivery_amount'        => $shipmentDetails['CashOnDeliveryAmount']['Value'] ?? 0,
                        'insurance_currency_code'        => $shipmentDetails['InsuranceAmount']['CurrencyCode'] ?? null,
                        'insurance_amount'               => $shipmentDetails['InsuranceAmount']['Value'] ?? 0,
                        'cash_additional_currency_code'  => $shipmentDetails['CashAdditionalAmount']['CurrencyCode'] ?? null,
                        'cash_additional_amount'         => $shipmentDetails['CashAdditionalAmount']['Value'] ?? 0,
                        'collect_currency_code'          => $shipmentDetails['CollectAmount']['CurrencyCode'] ?? null,
                        'collect_amount'                 => $shipmentDetails['CollectAmount']['Value'] ?? 0,
                        'services'                       => $shipmentDetails['Services'] ?? null,
                        'origin_city'                    => $shipmentDetails['OriginCity'] ?? null,
                        'destination_city'               => $shipmentDetails['DestinationCity'] ?? null,
                    ]
                );

                return $ShipmentCreated;
            }

            return $createdPickup;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateOrCreatePickupTracking($trackingId, $arr, $trackingResults, $orderId = null)
    {
        try {

            if ($orderId) {
                $pickupInfo = OrderPickup::wherePickupId($trackingId)->whereOrderId($orderId)->first();
            } else {
                $pickupInfo = OrderPickup::wherePickupId($trackingId)->first();
            }


            $pickupTrackingCreated = PickupTracking::updateOrCreate(
                [
                    'order_pickup_id' => $pickupInfo->id,
                    'import_order_id' => $pickupInfo->order_id,
                    'reference' => $arr['Reference'] ?? '',
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

            // OrderLog::updateOrCreate(
            //     ['order_id' => $pickupInfo->order_id, 'status' => 'return' ?? ''],
            //     ['order_id' => $pickupInfo->order_id, 'status_name' => 'return', 'status' => 'return' ?? '', 'comment' => $arr['LastStatus'] ?? '', 'status_date' => now()]
            // );

            $pickupTrackingCreated;
        } catch (\Throwable $th) {
            throw $th;
        }
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
            'isView' => true,
            'isEdit' => false,
            'isDelete' =>  false,
            'isPrint' => false,
            'isTracking' => true
        ];
    }

    public function preparePickupForReturnOrder_backup($param, $orderId)
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

    public function getPickupDateAndTime_backup()
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
}
