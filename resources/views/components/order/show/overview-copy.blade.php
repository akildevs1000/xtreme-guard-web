@props([
    'title' => 'Summary',
    'order' => $order,
])


<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-semibold text-uppercase">{{ $title ?? '' }}</h6>
                    {{-- <p>On <strong>{{ displayDateFormat($order->order_date) ?? '' }}</strong>,
                        an order was placed with the ID <strong>{{ $order->order_id ?? '' }}</strong>,
                        The order, which falls under the <strong>{{ $order->order_type ?? '' }}</strong>
                        type and is currently marked as <strong>{{ $order->order_status ?? '' }}</strong>,
                        has a total of <strong>{{ $order->total ?? '' }}</strong>.
                        There were no discounts applied, and the total amount due matches the subtotal.
                        The order includes <strong>{{ count($order->products) ?? '' }}</strong>
                        products, with no shipping charges or taxes incurred. The entry was created and updated on
                        <strong> {{ displayDateFormat($order->update_date) ?? '' }}</strong>.
                        There are no cancellation details associated with this order.
                    </p> --}}

                    <div class="pt-3 border-top border-top-dashed mt-4">
                        <div class="row gy-3 text-center">
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Order Date :</p>
                                    <h5 class="fs-15 mb-0">{{ date('d M, Y', strtotime($order->order_date)) ?? '' }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Update Date :</p>
                                    <h5 class="fs-15 mb-0">{{ date('d M, Y', strtotime($order->update_date)) ?? '' }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Order Type :</p>
                                    <div class="badge bg-secondary-subtle text-secondary fs-12">
                                        {{ $order->order_type ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <p class="mb-2 text-uppercase fw-medium">Status :</p>
                                    <div class="badge bg-secondary-subtle text-success fs-12">
                                        {{ $order->order_status ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

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

        @php
            $billingAddressArr = orderBillingInfo($order);
            $shippingAddressArr = orderShippingInfo($order);
        @endphp

        <div class="row">
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
    </div>

    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header align-items-center d-flex border-bottom-dashed">
                <h4 class="card-title mb-0 flex-grow-1">Coupons</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2 fs-16">
                    <x-notification.not-found />
                </div>
            </div>
            <!-- end card body -->
        </div>

        <x-card.grid-card titleName="Tax">
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

        <x-card.grid-card titleName="Applied Taxes">
            <x-notification.not-found />
        </x-card.grid-card>

        <div class="card">
            <div class="card-header align-items-center d-flex border-bottom-dashed">
                <h4 class="card-title mb-0 flex-grow-1">Attachments</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-info btn-sm"><i
                            class="ri-upload-2-fill me-1 align-bottom"></i> Upload</button>
                </div>
            </div>

            <div class="card-body">

                <div class="vstack gap-2">
                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-folder-zip-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#"
                                        class="text-body text-truncate d-block">App-pages.zip</a>
                                </h5>
                                <div>2.2MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-file-ppt-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#"
                                        class="text-body text-truncate d-block">Velzon-admin.ppt</a>
                                </h5>
                                <div>2.4MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-folder-zip-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#"
                                        class="text-body text-truncate d-block">Images.zip</a>
                                </h5>
                                <div>1.2MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded border-dashed p-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light text-secondary rounded fs-24">
                                        <i class="ri-image-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="fs-13 mb-1"><a href="#"
                                        class="text-body text-truncate d-block">bg-pattern.png</a>
                                </h5>
                                <div>1.1MB</div>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18"><i
                                            class="ri-download-2-line"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-icon text-muted btn-sm fs-18 dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Rename</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 text-center">
                        <button type="button" class="btn btn-success">View more</button>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
    </div>
</div>
