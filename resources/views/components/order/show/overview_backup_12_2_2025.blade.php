@props([
    'title' => 'Summary',
    'order' => $order,
])

@php
    $billingAddressArr = orderBillingInfo($order);
    $shippingAddressArr = orderShippingInfo($order);
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

            <div class="col-xl-6 col-md-6 col-sm-12">
                <x-card.grid-card titleName="Billing Address" class="h-100">
                    <div class="vstack gap-1">
                        @foreach ($billingAddressArr as $key => $bill)
                            @if (!is_null($bill))
                                <div class="d-flex align-items-center border-bottom">
                                    <div class="flex-grow-1s w-50">
                                        <h5 class="fs-13 mb-0">
                                            <label class="text-body d-block mb-1">
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                                            </label>
                                        </h5>
                                    </div>
                                    <div class="flex-shrink-01 text-start"
                                        style="{{ $key == 'street' ? 'flex-shrink: 70 !important' : '' }}">
                                        <div class="d-flex align-items-center gap-1">
                                            <label class="mb-1 fw-normal">{{ $bill }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </x-card.grid-card>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12">
                <x-card.grid-card titleName="Shipping Address" class="h-100">
                    <div class="vstack gap-1">
                        @foreach ($shippingAddressArr as $key => $bill)
                            @if (!is_null($bill))
                                <div class="d-flex align-items-center border-bottom">
                                    <div class="flex-grow-1s w-50">
                                        <h5 class="fs-13 mb-0">
                                            <label class="text-body d-block mb-1">
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                                            </label>
                                        </h5>
                                    </div>
                                    <div class="flex-shrink-0 text-start"
                                        style="{{ $key == 'street' ? 'flex-shrink: 70 !important' : '' }}">
                                        <div class="d-flex align-items-center gap-1">
                                            <label class="mb-1 fw-normal">{{ $bill }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
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
            // dd(empty($itemAppliedTaxes->toArray()));
            // dd($itemAppliedTaxes);
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
