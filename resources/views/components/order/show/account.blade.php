@props([
    'CusTitle' => 'Customer Information',
    'PayTitle' => 'Payment Information',
    'gifTitle' => 'Gift Information',
    'order' => $order,
])

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card mt-0 mb-2">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-0 fw-semibold text-uppercase">{{ $CusTitle ?? '' }}</h6>
                    <div class="pt-3 border-top border-top-dashed mt-3">
                        <div class="row gy-3 text-center">
                            <div class="col-lg-2 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">First Name</p>
                                    <label class="fw-medium mb-0 text-black">
                                        {{ $order->customer->first_name }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Last Name</p>
                                    <label class="fw-medium mb-0 text-black">
                                        {{ $order->customer->last_name }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Contact</p>
                                    <label class="fw-medium mb-0 text-black">
                                        {{ $order->customer->phone }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">DOB</p>
                                    <label class="fw-medium mb-0 text-black">
                                        {{ $order->customer->dob }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Email</p>
                                    <label class="fw-medium mb-0 text-black">
                                        {{ $order->customer->email }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Age Verified</p>
                                    <span
                                        class="badge bg-{{ isAgeVerified($order->customer, 'col') }}-subtle text-danger">
                                        {{ isAgeVerified($order->customer, 'val') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-xl-6 col-md-4 col-lg-6">

        @php
            $billingInfo = [
                'Amount' => $order->payment->amount ?? '---',
                'Payment Method' => $order->payment->payment_method ?? '---',
                'Currency' => $order->payment->currency ?? '---',
                'Method' => $order->payment->method_code ?? '---',
                'Method Title' => $order->payment->method_title ?? '---',
            ];

            $giftCardInfo = [
                'Gift Card Amount' => $order->gift->gift_cards_amount ?? '---',
                'Base Gift Card Amount' => $order->gift->base_gift_cards_amount ?? '---',
            ];
        @endphp

        <x-card.grid-card titleName="{{ $PayTitle }}" class="h-100">
            <div class="vstack gap-1">
                @foreach ($billingInfo as $label => $value)
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
    </div>

    <div class="col-xl-6 col-md-4 col-lg-6">
        <x-card.grid-card titleName="Gift Card Information" class="h-100">
            <div class="vstack gap-1">
                @foreach ($giftCardInfo as $label => $value)
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
    </div>
</div>
