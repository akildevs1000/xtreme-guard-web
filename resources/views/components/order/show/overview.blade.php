@props([
    'title' => 'Summary',
    'order' => $order,
])

@php
    $billingAddressArr = orderBillingInfo($order);
    $shippingAddressArr = orderShippingInfo($order);

    $icons = [
        'firstname' => 'ri-user-line',
        'lastname' => 'ri-user-line',
        'email' => 'ri-mail-line',
        'telephone' => 'ri-phone-line',
        'country_id' => 'ri-earth-line',
        'city' => 'ri-building-line',
        'postcode' => 'ri-map-pin-line',
        'street' => 'ri-road-map-line',
        'address_type' => 'ri-home-smile-line',
        'company' => 'ri-building-4-line',
        'store_name' => 'ri-store-line',
        'administrative_area_level_2' => 'ri-map-pin-user-line',
        'sublocality_level_2' => 'ri-map-pin-2-line',
        'method' => 'ri-money-dollar-box-line', // Default payment icon
    ];

@endphp

<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card mb-2">
                    <div class="card-body py-0">
                        <div class="row gy-3 py-3 mt-0 overflow-auto text-center" styles=" border: 1px solid #eaeaed;">
                            <div class="col-lg-12 col-sm-12 mt-0">
                                <x-order.show.order-timeline-line :order="$order" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-md-12 col-sm-12 mb-2">
                <x-card.grid-card titleName="Billing Address" class="h-100" bodyClass="pb-0">
                    <div class="vstack gap-1">
                        <div class="row" style="font-family: system-ui;">
                            @foreach ($billingAddressArr as $label => $value)
                                @if (!is_null($value))
                                    @php

                                        if ($loop->last) {
                                            $layout = 'col-12 col-md-6 col-sm-12 col-xl-6 py-0 py-0';
                                        } else {
                                            $layout = 'col-12 col-md-4 col-sm-6 col-xl-3 py-0 py-0';
                                        }

                                    @endphp

                                    <div class="{{ $layout }}" style="border-bottom: 1px solid #e5e5e5">
                                        <div class="card-body py-1">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <span class="bg-primary-subtles rounded-1 p-2 my-4"
                                                        style="font-size:25px">
                                                        <i
                                                            class="{{ $icons[$label] ?? 'ri-information-line' }} text-primary"></i>
                                                    </span>
                                                </div>
                                                <div class="ms-2 flex-grow-1">
                                                    <p class="mb-1 fs-12 fw-medium">
                                                        {{ ucfirst(str_replace('_', ' ', $label)) }}
                                                    </p>
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
            <div class="col-xl-12 col-md-12 col-sm-12">
                <x-card.grid-card titleName="Shipping Address" class="h-100">
                    <div class="vstack gap-1">
                        <div class="row" style="font-family: system-ui;">
                            @foreach ($shippingAddressArr as $label => $value)
                                @if (!is_null($value))
                                    <div @class([
                                        'col-12 py-0' => $loop->last,
                                        'col-12 col-md-4 col-sm-6 col-xl-3 py-0' => !$loop->last,
                                    ]) style="border-bottom: 1px solid #e5e5e5">
                                        <div class="card-body py-1">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <span class="bg-primary-subtles rounded-1 p-2 my-4"
                                                        style="font-size: 25px;">
                                                        <i
                                                            class="{{ $icons[$label] ?? 'ri-information-line' }} text-primary"></i>
                                                    </span>
                                                </div>
                                                <div class="ms-2 flex-grow-1">
                                                    <p class="mb-1 fs-12 fw-medium">
                                                        {{ ucfirst(str_replace('_', ' ', $label)) }}
                                                    </p>
                                                    <p class="fw-bold mb-0 fs-12 text-responsive"
                                                        style="color: #dc291e;">
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

        <div class="card mt-2">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-semibold text-uppercase">{{ $title ?? '' }}</h6>
                    <div class="pt-3 border-top border-top-dashed mt-4">
                        <h6 class="mb-3 fw-semibold text-uppercase">Info</h6>
                        <div class="row mt-0">
                            @php
                                $orderBasicInfo = orderBasicInfo($order);
                            @endphp
                            @foreach ($orderBasicInfo as $label => $details)
                                @if (!is_null($details['value']) && $details['value'] !== '---')
                                    <div class="col-lg-3 col-sm-6 mt-2">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="{{ $details['icon'] }}"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">
                                                        {{ ucfirst(str_replace('_', ' ', $label)) }}:</p>
                                                    <h5 class="mb-0">{{ $details['value'] }}</h5>
                                                </div>
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

    </div>

    <div class="col-xl-3 col-lg-4">

        <x-card.grid-card titleName="Coupons" height="300px" style="height:200px" class="mb-2">
            <div class="vstack gap-3">
                @forelse ($order->coupons as $key => $coup)
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="fs-13 mb-0">
                                <a href="#" class="text-body d-block">Coupons</a>
                            </h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center gap-1">
                                <label>{{ $coup->coupon ?? '---' }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="fs-13 mb-0">
                                <a href="#" class="text-body d-block">Category</a>
                            </h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center gap-1">
                                <label>{{ $coup->category ?? '---' }}</label>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex flex-wrap gap-2 fs-16 d-flex justify-content-center">
                        <x-notification.not-found msg="No coupon applied" />
                    </div>
                @endforelse
            </div>
        </x-card.grid-card>

        <x-card.grid-card titleName="Tax" class="mb-2">
            <div class="vstack gap-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="fs-13 mb-0">
                            <a href="#" class="text-body d-block">Tax Amount</a>
                        </h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center gap-1">
                            <label>{{ $order->tax->tax_amount ?? '' }}</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="fs-13 mb-0">
                            <a href="#" class="text-body d-block">Base Tax Amount</a>
                        </h5>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center gap-1">
                            <label>{{ $order->tax->base_tax_amount ?? '' }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </x-card.grid-card>

        @php
            $itemAppliedTaxes = $order->tax->itemAppliedTaxes;
        @endphp

        <x-card.grid-card titleName="Applied Taxes" class="mb-2">

            <div class="accordion" id="default-accordion-example">
                @if (!empty($itemAppliedTaxes->toArray()))
                    @foreach ($itemAppliedTaxes as $key => $itemTax)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne{{ $key }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne{{ $key }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Type : {{ $itemTax->type ?? '' }}
                                </button>
                            </h2>
                            <div id="collapseOne{{ $key }}"
                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                aria-labelledby="headingOne{{ $key }}"
                                data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                    <table class="table table-sm">
                                        <thead>
                                            <th>Amount</th>
                                            <th>BaseAmount</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($itemTax['itemAppliedTaxeDetails'] as $detail)
                                                <td>{{ $detail['amount'] }}</td>
                                                <td>{{ $detail['base_amount'] }}</td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <x-notification.not-found msg="No tax applied" />
                @endif
            </div>
        </x-card.grid-card>

        @php
            $fields = getAdjustmentInfo($order);
            $adjItems = $order?->adjustments?->adjItems ?? [];
        @endphp

        <x-card.grid-card titleName="Adjustments" height="300px" style="min-height:200px" class="mb-2">
            <div class="vstack gap-3">
                @foreach ($fields as $label => $value)
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="fs-13 mb-0">
                                <a href="#" class="text-body d-block">{{ $label }}</a>
                            </h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center gap-1">
                                @if (is_array($value))
                                    <span class="badge bg-{{ $value['badgeClass'] }}">
                                        {{ $value['value'] }}
                                    </span>
                                @else
                                    <label>{{ $value }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-card.grid-card>

        <x-card.grid-card titleName="Adjustment Items" height="300px" style="min-height:200px" class="mb-2">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>SKU</th>
                        <th>QTY</th>
                        <th class="text-end">Amount</th>
                        <th>Currency</th>
                    </tr>
                </thead>
                @forelse ($adjItems as $key => $item)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration ?? '' }}</td>
                            <td>{{ $item->sku ?? '' }}</td>
                            <td>{{ $item->qty ?? '' }}</td>
                            <td class="text-end">{{ $item->amount ?? '' }}</td>
                            <td>{{ $item->currency ?? '' }}</td>
                        </tr>
                    </tbody>
                @empty
                @endforelse
            </table>
        </x-card.grid-card>
    </div>
</div>

<style>
    .timeline-arrow {
        /* position: relative;
        left: -65px;
        right: 0px;
        width: 0%;
         font-size: 35px; */

        position: relative;
        left: -26px;
        right: 0px;
        width: 0;
        background: red;
        font-size: 3rem;
        padding: 0px;
        margin: 0px;
        height: 1px;
        top: -36px;
    }
</style>
