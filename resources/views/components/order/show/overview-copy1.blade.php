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
                        <div class="row gy-3 py-3 mt-0  text-center" styles=" border: 1px solid #eaeaed; ">
                            <div class="col-lg-12 col-sm-12 mt-0">
                                <div>
                                    @php
                                        $orderStatuses = [
                                            // 'new' => 'New',
                                            'payment_completed' => 'Payment Completed',
                                            'confirmed' => 'Confirmed',
                                            'shipped' => 'Shipped',
                                            'delivered' => 'Delivered',
                                            'returned' => 'Returned',
                                        ];

                                        // Get the keys of the order statuses for easy access
                                        $statusKeys = array_keys($orderStatuses);
                                        // Get the index of the current order status
                                        $currentStatusIndex = array_search($order->order_status, $statusKeys);
                                    @endphp

                                    <div class="vertical-navs-step">
                                        <div class="nav d-flex justify-content-center custom-nav nav-pills"
                                            role="tablist" aria-orientation="vertical" style="align-items: center;">
                                            @foreach ($orderStatuses as $key => $status)
                                                <span style="z-index:10"
                                                    class="nav-link {{ $currentStatusIndex !== false && array_search($key, $statusKeys) <= $currentStatusIndex ? 'done bg-success-subtle text-success' : 'bg-white' }}">
                                                    <span class="step-title me-2">
                                                        <i class="ri-circle-fill step-icon me-2"></i>
                                                    </span>
                                                    <span class="fs-12">
                                                        {{ ucwords(str_replace('_', ' ', $status)) }}
                                                    </span>
                                                </span>

                                                @if ($currentStatusIndex !== false && array_search($key, $statusKeys) < $currentStatusIndex)
                                                    <i class="ri-arrow-right-s-fill timeline-arrow text-success"></i>
                                                @elseif ($currentStatusIndex !== false && array_search($key, $statusKeys) === $currentStatusIndex)
                                                    <i
                                                        class="ri-arrow-right-s-fill timeline-arrow text-success current-status"></i>
                                                @else
                                                    <i class="ri-arrow-right-s-fill timeline-arrow text-muted"></i>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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
                                    <div class="flex-shrink-0 text-start">
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
                                    <div class="flex-shrink-0 text-start">
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

                    <!--   <div class="pt-3 border-top border-top-dashed mt-4">
                        <div class="row gy-3 text-center">
                            {{--     <div class="col-lg-4 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Order Date :</p>
                                    <h5 class="fs-15 mb-0">{{ date('d M, Y', strtotime($order->order_date)) ?? '' }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Update Date :</p>
                                    <h5 class="fs-15 mb-0">{{ date('d M, Y', strtotime($order->update_date)) ?? '' }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Order Type :</p>
                                    <div class="badge bg-secondary-subtle text-secondary fs-12">
                                        {{ $order->order_type ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Status :</p>
                                    @php
                                        $orderStatuses = [
                                            'payment_completed' => 'Payment Completed',
                                            'confirmed' => 'Confirmed',
                                            'shipped' => 'Shipped',
                                            'delivered' => 'Delivered',
                                            // 'pending_cancellation' => 'Pending Cancellation',
                                            // 'canceled' => 'Canceled',
                                            // 'returned' => 'Returned',
                                        ];
                                    @endphp

                                    <div class="vertical-navs-step">
                                        <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                            aria-orientation="vertical">
                                            @foreach ($orderStatuses as $key => $status)
                                                <button
                                                    class="nav-link {{ $order->order_status === $key ? 'done' : '' }}">
                                                    <span class="step-title me-2">
                                                        <i class="ri-circle-fill step-icon me-2"></i>
                                                    </span>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>


                        {{-- <div class="row gy-3 py-3 mt-4 mx-5 text-center" style=" border: 1px solid #eaeaed; ">
                            <div class="col-lg-12 col-sm-12 mt-0">
                                <div>
                                    @php
                                        $orderStatuses = [
                                            'payment_completed' => 'Payment Completed',
                                            'confirmed' => 'Confirmed',
                                            'shipped' => 'Shipped',
                                            'delivered' => 'Delivered',
                                            'returned' => 'Returned',
                                        ];

                                        // Get the keys of the order statuses for easy access
                                        $statusKeys = array_keys($orderStatuses);
                                        // Get the index of the current order status
                                        $currentStatusIndex = array_search($order->order_status, $statusKeys);
                                    @endphp

                                    <div class="vertical-navs-step">
                                        <div class="nav d-flex justify-content-evenly custom-nav nav-pills"
                                            role="tablist" aria-orientation="vertical" style="align-items: center;">
                                            @foreach ($orderStatuses as $key => $status)
                                                <span
                                                    class="nav-link {{ $currentStatusIndex !== false && array_search($key, $statusKeys) <= $currentStatusIndex ? 'done' : '' }}">
                                                    <span class="step-title me-2">
                                                        <i class="ri-circle-fill step-icon me-2"></i>
                                                    </span>
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>

                                                @if ($currentStatusIndex !== false && array_search($key, $statusKeys) < $currentStatusIndex)
                                                    <i class="ri-arrow-right-s-fill timeline-arrow text-success"></i>
                                                @elseif ($currentStatusIndex !== false && array_search($key, $statusKeys) === $currentStatusIndex)
                                                    <i
                                                        class="ri-arrow-right-s-fill timeline-arrow text-success current-status"></i>
                                                @else
                                                    <i class="ri-arrow-right-s-fill timeline-arrow"></i>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div> -->

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

        <x-card.grid-card titleName="Applied Taxes" class="mb-2">
            <x-notification.not-found msg="No tax applied" />
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
