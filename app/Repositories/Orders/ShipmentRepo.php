<?php

namespace App\Repositories\Orders;

use App\Providers\JTIService;
use App\Models\Order\OrderLog;
use App\Models\Shipment\Shipment;
use App\Repositories\BaseRepository;
use App\Models\Shipment\OrderTracking;
use App\Models\ImportOrder\ImportOrder;
use App\Models\Shipment\ShipmentDetail;

class ShipmentRepo extends BaseRepository
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
            $model = ImportOrder::query();
            if ($request->has('order_status_filter') && $request->order_status_filter != -1) {
                $model = $model->where('order_status', $request->order_status_filter);
            }

            return $model->with([
                'coupons',
                'customer',
                'billingAddress',
                'payment',
                'shipping',
                'gift.giftItems',
                'products',
                'tax' => ['appliedTaxes', 'itemAppliedTaxes'],
                'products' => ['items']
            ])->get();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function prepareShipmentData($order)
    {
        // return $current_timestamp =  time();
        // $current_timestamp = 1722340617373;
        $current_timestamp =  round(microtime(true) * 1000);

        $shipper = $this->pickupInfo('sharjah');
        $partyAddress = $shipper['partyAddress'];
        $contactDetails = $shipper['contactDetails'];

        $aramexValidCities = config('cpanel.aramexValidCities');

        $customerCity = in_array($order->shipping->address['city'], $aramexValidCities) ? $order->shipping->address['city'] : 'dubai';

        $aramexItemsArr = $this->addOrderItemsToCreateShipment($order);

        return [
            "Shipments" => [
                [
                    "Reference1" => $order->order_id ?? "",
                    "Reference2" => null,
                    "Reference3" => null,
                    "Shipper" => [
                        "Reference1" => $order->order_id ?? "",
                        "Reference2" => null,
                        "AccountNumber" => config('cpanel.clientInfo.AccountNumber'),
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
                    "Consignee" => [
                        "Reference1" => $order->order_id ?? "",
                        "Reference2" => null,
                        "AccountNumber" => null,
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
                            "PersonName" => $order->customer->first_name,
                            "Title" => null,
                            "CompanyName" => $order->customer->last_name,
                            "PhoneNumber1" => "048707766", // should be correct format phone number, so we have keep actual static number until get from api
                            "PhoneNumber1Ext" =>  '',
                            "PhoneNumber2" => "",
                            "PhoneNumber2Ext" => "",
                            "FaxNumber" => null,
                            "CellPhone" => $order->shipping->address['telephone'] ?? '',
                            "EmailAddress" => $order->shipping->address['email'] ?? '',
                            "Type" => ""
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
                        // [
                        //     [
                        //         "PackageType" => "item",
                        //         "Quantity" => 1,
                        //         "Weight" => [
                        //             "Unit" => "CM",
                        //             "Value" => 0
                        //         ],
                        //         "Comments" => "no description",
                        //         "Reference" => "no barcode",
                        //         "PiecesDimensions" => null,
                        //         "CommodityCode" => null,
                        //         "GoodsDescription" => null,
                        //         "CountryOfOrigin" => null,
                        //         "CustomsValue" => null,
                        //         "ContainerNumber" => null
                        //     ]
                        // ]


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
            ],
            "LabelInfo" => [
                "ReportID" => 9729,
                "ReportType" => "URL"
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
            "Transaction" => null
        ];
    }

    public function createShimpentResponse($response)
    {
        $shipmentInfo = $response['Shipments'][0];
        $shipmentDetails = $response['Shipments'][0]['ShipmentDetails'];

        $ShipmentCreated = Shipment::updateOrCreate(
            [
                'order_id' => $shipmentInfo['Reference1'],
            ],
            [
                'order_id'                 => $shipmentInfo['Reference1'],
                'shiping_reference_number' => $shipmentInfo['ID'],
                'reference1'               => $shipmentInfo['Reference1'],
                'reference2'               => $shipmentInfo['Reference2'],
                'reference3'               => $shipmentInfo['Reference3'],
                'foreign_hawb'             => $shipmentInfo['ForeignHAWB'],
                'has_errors'               => $shipmentInfo['HasErrors'],
                'notifications'            => json_encode($shipmentInfo['Notifications']),
                'shipment_label_url'       => $shipmentInfo['ShipmentLabel']['LabelURL'],
                'label_file_contents'      => json_encode($shipmentInfo['ShipmentLabel']['LabelFileContents']),
            ]
        );
        if ($ShipmentCreated) {
            ShipmentDetail::firstOrCreate(
                [
                    'shipment_id'                    => $ShipmentCreated->id,
                    'shiping_reference_number'       => $ShipmentCreated->shiping_reference_number,
                ],
                [
                    'shipment_id'                    => $ShipmentCreated->id,
                    'shiping_reference_number'       => $ShipmentCreated->shiping_reference_number,
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
                    'customs_value_amount'           => $shipmentDetails['CustomsValueAmount']['Value'] ?? null,
                    'cash_on_delivery_currency_code' => $shipmentDetails['CashOnDeliveryAmount']['CurrencyCode'] ?? null,
                    'cash_on_delivery_amount'        => $shipmentDetails['CashOnDeliveryAmount']['Value'] ?? null,
                    'insurance_currency_code'        => $shipmentDetails['InsuranceAmount']['CurrencyCode'] ?? null,
                    'insurance_amount'               => $shipmentDetails['InsuranceAmount']['Value'] ?? null,
                    'cash_additional_currency_code'  => $shipmentDetails['CashAdditionalAmount']['CurrencyCode'] ?? null,
                    'cash_additional_amount'         => $shipmentDetails['CashAdditionalAmount']['Value'] ?? null,
                    'collect_currency_code'          => $shipmentDetails['CollectAmount']['CurrencyCode'] ?? null,
                    'collect_amount'                 => $shipmentDetails['CollectAmount']['Value'] ?? null,
                    'services'                       => $shipmentDetails['Services'] ?? null,
                    'origin_city'                    => $shipmentDetails['OriginCity'] ?? null,
                    'destination_city'               => $shipmentDetails['DestinationCity'] ?? null,
                    'ship_attachment'                => json_encode($response['Shipments'][0]['ShipmentAttachments']) ?? null,
                ]
            );

            return $ShipmentCreated;
        }

        return false;
    }

    public function createOrderTracking($trackingResults, $order_id)
    {
        try {

            if (empty($trackingResults['TrackingResults'])) {
                return;
            }

            $orderId = $order_id;

            $trackInfo = $trackingResults['TrackingResults'][0];
            $trackingValueInfo = $trackInfo['Value'][0];

            $orderTracking = OrderTracking::updateOrCreate(
                [
                    'tracking_id'    => $trackInfo['Key'],
                    'waybill_number' => $trackingValueInfo['WaybillNumber'],
                    'update_code'    => $trackingValueInfo['UpdateCode'],
                ],
                [
                    'order_id'           => $orderId,
                    'tracking_id'        => $trackInfo['Key'],
                    'waybill_number'     => $trackingValueInfo['WaybillNumber'],
                    'update_code'        => $trackingValueInfo['UpdateCode'] ?? null,
                    'update_description' => $trackingValueInfo['UpdateDescription'] ?? null,
                    'update_date_time'   => $trackingValueInfo['UpdateDateTime'] ?? null,
                    'update_location'    => $trackingValueInfo['UpdateLocation'] ?? null,
                    'comments'           => $trackingValueInfo['Comments'] ?? null,
                    'problem_code'       => $trackingValueInfo['ProblemCode'] ?? null,
                    'gross_weight'       => $trackingValueInfo['GrossWeight'] ?? null,
                    'chargeable_weight'  => $waybtrackingValueInfollData['ChargeableWeight'] ?? null,
                    'weight_unit'        => $trackingValueInfo['WeightUnit'] ?? null,
                ]
            );

            if ($trackingResults) {

                $comment = "";
                $status_code = "";
                $status_name = "";

                if ($trackingValueInfo['UpdateCode'] == 'SH003') { //SH003 =  Out for Delivery"
                    $comment = !empty($trackingValueInfo['Comments']) ? $trackingValueInfo['UpdateDescription'] : "Out for Delivery ";
                    $status_code = "shipped";
                    $status_name = "Shipped";
                } else if ($trackingValueInfo['UpdateCode'] == 'SH005') { //SH005 =  Delivered"
                    $comment = !empty($trackingValueInfo['UpdateDescription']) ? $trackingValueInfo['UpdateDescription'] : "Delivered ";
                    $status_code = "delivered";
                    $status_name = "Delivered";
                    ImportOrder::where('order_id', $orderId)->update(['is_delivered' => 1, 'delivered_date' => now()]);
                } else {
                    $comment = !empty($trackingValueInfo['UpdateDescription']) ? $trackingValueInfo['UpdateDescription'] : "Out for Delivery ";
                    $status_code = "shipped";
                    $status_name = "Shipped";
                }

                (new JTIService)->updateOrderStatus(['order_id' => $orderId, 'status_code' => $status_code]);

                OrderLog::updateOrCreate(
                    ['order_id' => $orderId, 'status' => $status_code ?? ''],
                    ['order_id' => $orderId, 'status_name' => $status_name, 'status' => $status_code ?? '', 'comment' => $comment . $trackingValueInfo['UpdateCode'] ?? '', 'status_date' => now()]
                );

                $sendTrackingInfoPayload =  [
                    "carrier" => 'Aramex',
                    "title" => 'Aramex Carrier',
                    "trackNumber" => $trackInfo['Key'] ?? '',
                    "trackUrl" => "https://jti.routepro.cloud/oms/shipment/tracking/get-tracking-info-by-trackId/" . $trackInfo['Key'],
                ];

                (new JTIService)->SendToTrackingDetails($sendTrackingInfoPayload, $orderId);
            }

            return $orderTracking;
        } catch (\Throwable $th) {
            throw $th;
        }
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

    public function getOrdeByIdForExport($id)
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
                'tax' => ['appliedTaxes', 'itemAppliedTaxes'],
                'products' => ['items']
            ])->whereOrderId($id)->first();
        } catch (\Throwable $th) {
            return $th;
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

    public function addOrderItemsToCreateShipmentOld($order)
    {
        $all_items = array_merge(...array_column($order->products->toArray(), 'items'));
        $aramexItemsArr = [];

        foreach ($all_items as $item) {
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

        // if (count($all_items) == 0) {
        return $order->products->toArray();
        // }

        return $aramexItemsArr;
    }
}
