@props([
    'TrackTitle' => 'Tracking Information',
    'DetailTitle' => 'Tracking Details',
    'orderTrackingHistory' => $orderTrackingHistory,
    'order' => $order,
])

@php
    $trackingInfo = $order->tracking;
    $details = $trackingInfo['details'] ?? [];
    $trackingResult = $trackingInfo['trackingResult'] ?? [];

    $trackInfo = [
        'Order ID' => $trackingInfo['order_id'] ?? '---',
        'Tracking ID' => $trackingInfo['shiping_reference_number'] ?? '---',
        'Reference 1' => $trackingInfo['reference1'] ?? '---',
        'Reference 2' => $trackingInfo['reference2'] ?? '---',
        'Reference 3' => $trackingInfo['reference3'] ?? '---',
        'Foreign HAWB' => $trackingInfo['foreign_hawb'] ?? '---',
        'Shipment Label URL' => $trackingInfo['shipment_label_url'] ?? '---',

        'Waybill Number' => $trackingResult['waybill_number'] ?? '---',
        'Update Code' => $trackingResult['update_code'] ?? '---',
        'Update Description' => $trackingResult['update_description'] ?? '---',
        // 'Update Date&Time' => $trackingResult['update_date_time'] ?? '---',
        'Update Date&Time' => getDateAndTime($trackingResult['update_date_time'] ?? '---'),
        'Update Location' => $trackingResult['update_location'] ?? '---',
        'Comments' => $trackingResult['comments'] ?? '---',
        'Problem Code' => $trackingResult['problem_code'] ?? '---',
        'Gross Weight' => $trackingResult['gross_weight'] ?? '---',
        'Chargeable Weight' => $trackingResult['chargeable_weight'] ?? '---',
        'Weight Unit' => $trackingResult['weight_unit'] ?? '---',
        // Directly extract details without a second index
    ];

    $detailInfo = [
        'Shipment ID' => $details['shipment_id'] ?? '---',
        'Shipping Reference' => $details['shiping_reference_number'] ?? '---',
        'Origin' => $details['origin'] ?? '---',
        'Destination' => $details['destination'] ?? '---',
        'Chargeable Weight' => $details['chargeable_weight_value'],
        'Chargeable Unit' => $details['chargeable_weight_unit'],
        'Description of Goods' => $details['description_of_goods'] ?? '---',
        'Goods Origin Country' => $details['goods_origin_country'] ?? '---',
        'Number of Pieces' => $details['number_of_pieces'] ?? '---',
        'Product Group' => $details['product_group'] ?? '---',
        'Product Type' => $details['product_type'] ?? '---',
        'Payment Type' => $details['payment_type'] ?? '---',
        'Payment Options' => $details['payment_options'] ?? '---',
        'Customs Value Currency Code' => $details['customs_value_currency_code'] ?? '---',
        'Customs Value Amount' => $details['customs_value_amount'] ?? '---',
        'Cash on Delivery Currency Code' => $details['cash_on_delivery_currency_code'] ?? '---',
        'Cash on Delivery Amount' => $details['cash_on_delivery_amount'] ?? '---',
        'Insurance Currency Code' => $details['insurance_currency_code'] ?? '---',
        'Insurance Amount' => $details['insurance_amount'] ?? '---',
        'Cash Additional Currency Code' => $details['cash_additional_currency_code'] ?? '---',
        'Cash Additional Amount' => $details['cash_additional_amount'] ?? '---',
        'Collect Currency Code' => $details['collect_currency_code'] ?? '---',
        'Collect Amount' => $details['collect_amount'] ?? '---',
        'Services' => $details['services'] ?? '---',
        'Origin City' => $details['origin_city'] ?? '---',
        'Destination City' => $details['destination_city'] ?? '---',
    ];

    $icons = [
        'Shipment ID' => 'ri-truck-line',
        'Shipping Reference' => 'ri-file-list-3-line',
        'Origin' => 'ri-map-pin-line',
        'Destination' => 'ri-map-pin-add-line',
        'Chargeable Weight' => 'ri-weight-line',
        'Chargeable Unit' => 'ri-ruler-line',
        'Description of Goods' => 'ri-archive-line',
        'Goods Origin Country' => 'ri-flag-line',
        'Number of Pieces' => 'ri-numbers-line',
        'Product Group' => 'ri-shopping-bag-line',
        'Product Type' => 'ri-price-tag-3-line',
        'Payment Type' => 'ri-bank-card-line',
        'Payment Options' => 'ri-wallet-3-line',
        'Customs Value Currency Code' => 'ri-money-dollar-circle-line',
        'Customs Value Amount' => 'ri-coins-line',
        'Cash on Delivery Currency Code' => 'ri-cash-line',
        'Cash on Delivery Amount' => 'ri-currency-line',
        'Insurance Currency Code' => 'ri-shield-line',
        'Insurance Amount' => 'ri-shield-check-line',
        'Cash Additional Currency Code' => 'ri-wallet-line',
        'Cash Additional Amount' => 'ri-currency-fill',
        'Collect Currency Code' => 'ri-coin-line',
        'Collect Amount' => 'ri-money-euro-circle-line',
        'Services' => 'ri-service-line',
        'Origin City' => 'ri-building-line',
        'Destination City' => 'ri-road-map-line',
    ];

@endphp



<div class="row mb-3">

    <div class="col-xl-5 col-md-6 col-lg-6">

        <x-card.grid-card titleName="" class="h-100">
            {{-- <x-card.grid-card titleName="{{ $TrackTitle ?? '' }}" class="h-100"> --}}

            <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#nav-shipment-history" role="tab"
                        aria-selected="false">
                        Shipment History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#nav-shipment-summary" role="tab"
                        aria-selected="false">
                        Tracking Summary
                    </a>
                </li>
            </ul>

            <div class="tab-content text-muted">
                <div class="tab-pane active" id="nav-shipment-history" role="tabpanel">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-2">
                            <div class="vstack gap-1">
                                <x-order.show.tracking-history :orderTrackingHistory="$orderTrackingHistory" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="nav-shipment-summary" role="tabpanel">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-2">
                            <div class="vstack gap-1">
                                @foreach ($trackInfo as $label => $value)
                                    @if (!is_null($value))
                                        <div class="d-flex align-items-center border-bottom">
                                            <div class="flex-grow-1 w-50">
                                                <h5 class="fs-13 mb-0">
                                                    <label class="text-body d-block mb-1">
                                                        {{ $label }}
                                                    </label>
                                                </h5>
                                            </div>
                                            <div class="flex-shrink-0 text-start">
                                                <div class="d-flex align-items-center gap-1">
                                                    @if ($label == 'Shipment Label URL')
                                                        <a href="{{ $value }}" target="_blank">
                                                            <i
                                                                class=" ri-file-pdf-2-fill align-bottom me-1 fs-18 text-danger">
                                                            </i>
                                                        </a>
                                                    @else
                                                        <label class="mb-1 fw-normal">{{ $value }}</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-card.grid-card>
    </div>

    {{-- -------backup--------- --}}
    {{-- <div class="col-xl-6 col-md-6 col-lg-6">
    <x-card.grid-card titleName="{{ $DetailTitle }}" class="h-100">
        <div class="vstack gap-1">
            @foreach ($detailInfo as $label => $value)
                @if (!is_null($value))
                    <div class="d-flex align-items-center border-bottom">
                        <div class="flex-grow-1 w-50">
                            <h5 class="fs-13 mb-0">
                                <label class="text-body d-block mb-1">
                                    {{ $label }}
                                </label>
                            </h5>
                        </div>
                        <div class="flex-shrink-0 text-start">
                            <div class="d-flex align-items-center gap-1">
                                <label class="mb-1 fw-normal">{{ $value }}</label>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </x-card.grid-card>
</div> --}}
    {{-- -------backup--------- --}}

    <div class="col-xl-7 col-md-6 col-lg-6">
        <x-card.grid-card titleName="{{ $DetailTitle }}" class="h-100">
            <div class="vstack gap-1">

                <div class="row" style="font-family: system-ui;">
                    @foreach ($detailInfo as $label => $value)
                        @if (!is_null($value))
                            <div class="col-3 col-md-3 col-sm-6 col-xl-3" style="border-bottom: 1px solid #e5e5e5">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <span class="bg-primary-subtles rounded-1 p-2 my-4" style="font-size:30px">
                                                <i
                                                    class="{{ $icons[$label] ?? 'ri-information-line' }} text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="ms-2 flex-grow-1">
                                            <p class="mb-1 fs-12 fw-medium">{{ $label }}</p>
                                            <p class="text-muted1 fw-bold mb-0 fs-12 text-responsive"
                                                style="color:#dc291e">
                                                {{ $value }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </x-card.grid-card>
    </div>
</div>
