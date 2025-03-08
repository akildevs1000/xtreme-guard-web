@props([
    'PickupTitle' => 'Pickup Information',
    'PickupTrackingTitle' => 'Pickup Tracking Information',
    'order' => $order,
    'returnOrderTrackingHistory' => $returnOrderTrackingHistory,
])

@php
    $returnInfo = $order->orderReturn;
    $pickupTracking = $order->orderReturn->pickupTracking;
    $pickupShipment = $order->orderReturn->pickupShipment;

    $pickupInfo = [
        'Order ID' => $order->order_id ?? '---',
        'Pickup ID' => $returnInfo['pickup_id'] ?? '---',
        'GUID' => $returnInfo['guid'] ?? '---',
        'Reference 1' => $returnInfo['reference1'] ?? '---',
    ];

    // $pickupTrackingInfo = [
    //     // 'Order ID' => $pickupTracking['import_order_id'] ?? '---',
    //     // 'Order ID' => $pickupTracking['import_order_id'] ?? '---',
    //     'Entity' => $pickupTracking['entity'] ?? '---',
    //     'Reference' => $pickupTracking['reference'] ?? '---',
    //     'Collection Date' => $pickupTracking['collection_date'] ?? '---',
    //     'Pickup Date' => $pickupTracking['pickup_date'] ?? '---',
    //     'Last Status' => $pickupTracking['last_status'] ?? '---',
    //     'Last Status Description' => $pickupTracking['last_status_description'] ?? '---',
    //     // 'Collected Waybills' => $pickupTracking['collected_waybills'] ?? '---',
    //     // 'Has Errors' => $pickupTracking['has_errors'] ? 'Yes' : 'No',
    //     // 'Original Collection Date' => $pickupTracking['org_collection_date'] ?? '---',
    //     // 'Original Pickup Date' => $pickupTracking['org_pickup_date'] ?? '---',
    //     'Reference 1' => $pickupTracking['reference1'] ?? '---',
    //     'Reference 2' => $pickupTracking['reference2'] ?? '---',
    //     'Reference 3' => $pickupTracking['reference3'] ?? '---',
    //     'Reference 4' => $pickupTracking['reference4'] ?? '---',
    //     'Reference 5' => $pickupTracking['reference5'] ?? '---',
    //     'Created At' => $pickupTracking['created_at'] ?? '---',
    //     'Updated At' => $pickupTracking['updated_at'] ?? '---',
    // ];

    $pickupTrackingInfo = [
        'Entity' => ['value' => $pickupTracking['entity'] ?? '---', 'icon' => 'ri-building-line'],
        'Reference' => ['value' => $pickupTracking['reference'] ?? '---', 'icon' => 'ri-hashtag'],
        'Collection Date' => ['value' => $pickupTracking['collection_date'] ?? '---', 'icon' => 'ri-calendar-line'],
        'Pickup Date' => ['value' => $pickupTracking['pickup_date'] ?? '---', 'icon' => 'ri-truck-line'],
        'Last Status' => ['value' => $pickupTracking['last_status'] ?? '---', 'icon' => 'ri-information-line'],
        'Last Status Description' => [
            'value' => $pickupTracking['last_status_description'] ?? '---',
            'icon' => 'ri-file-text-line',
        ],
        'Reference 1' => ['value' => $pickupTracking['reference1'] ?? '---', 'icon' => 'ri-hashtag'],
        'Reference 2' => ['value' => $pickupTracking['reference2'] ?? '---', 'icon' => 'ri-hashtag'],
        'Reference 3' => ['value' => $pickupTracking['reference3'] ?? '---', 'icon' => 'ri-hashtag'],
        'Reference 4' => ['value' => $pickupTracking['reference4'] ?? '', 'icon' => 'ri-hashtag'],
        // 'Reference 5' => ['value' => $pickupTracking['reference5'] ?? '---', 'icon' => 'ri-hashtag'],
        'Created At' => ['value' => $pickupTracking['created_at'] ?? '---', 'icon' => 'ri-calendar-line'],
        'Updated At' => ['value' => $pickupTracking['updated_at'] ?? '---', 'icon' => 'ri-calendar-check-line'],
    ];

    $pickupShipmentInfo = [
        'Order ID' => $pickupShipment['order_id'] ?? '---',
        'Reference' => $pickupShipment['pickup_shiping_reference_number'] ?? '---',
        'Reference 1' => $pickupShipment['reference1'] ?? '---',
        'Reference 2' => $pickupShipment['reference2'] ?? '---',
        'Reference 3' => $pickupShipment['reference3'] ?? '---',
        'Reference 4' => $pickupShipment['reference4'] ?? '---',
        'Reference 5' => $pickupShipment['reference5'] ?? '---',
        'Created At' => $pickupShipment['created_at'] ?? '---',
        'Updated At' => $pickupShipment['updated_at'] ?? '---',
    ];

@endphp

<div class="row mb-3">
    <div class="col-xl-6 col-md-6 col-lg-6">

        <x-card.grid-card titleName="" class="h-100">

            <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#nav-return-history" role="tab"
                        aria-selected="false">
                        Pickup Shipment History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-profile" role="tab"
                        aria-selected="false">
                        Pickup Shipment Details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#nav-border-top-home" role="tab"
                        aria-selected="false">
                        Pickup Details
                    </a>
                </li>
            </ul>

            <div class="tab-content text-muted">
                <div class="tab-pane active" id="nav-return-history" role="tabpanel">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-2">
                            <div class="vstack gap-1">
                                <x-order.show.return-tracking-history :returnOrderTrackingHistory="$returnOrderTrackingHistory" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="nav-border-top-profile" role="tabpanel">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-2">
                            <div class="vstack gap-1">
                                @foreach ($pickupShipmentInfo as $label => $value)
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
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="nav-border-top-home" role="tabpanel">
                    <div class="d-flex">
                        <div class="flex-grow-1 ms-2">
                            <div class="vstack gap-1">
                                @foreach ($pickupInfo as $label => $value)
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
                        </div>
                    </div>
                </div>
            </div>

        </x-card.grid-card>
    </div>

    <div class="col-xl-6 col-md-6 col-lg-6">
        <x-card.grid-card titleName="{{ $PickupTrackingTitle }}" class="h-100">
            <div class="vstack gap-1">
                {{-- @foreach ($pickupTrackingInfo as $label => $value)
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
                                    @if ($label == 'Last Status')
                                        <span class="badge bg-success-subtle text-success">
                                            {{ $value }}
                                        </span>
                                    @else
                                        <label class="mb-1 fw-normal">{{ $value }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach --}}
                <div class="row" style="font-family: system-ui;">
                    @foreach ($pickupTrackingInfo as $label => $data)
                        @if (!is_null($data))
                            <div class="col-3 col-md-4 col-sm-6 col-xl-3" style="border-bottom: 1px solid #e5e5e5">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <span class="bg-primary-subtles rounded-1 p-2 my-4" style="font-size:30px">
                                                <i class="{{ $data['icon'] }} text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="ms-2 flex-grow-1">
                                            <p class="mb-1 fs-12 fw-medium">{{ $label }}</p>
                                            <p class="text-muted1 fw-bold mb-0 fs-12 text-responsive"
                                                style="color:#dc291e">
                                                {{ isset($data['value']) ? $data['value'] : '---' }}
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
