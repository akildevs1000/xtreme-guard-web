@props([
    'CusTitle' => 'Customer Information',
    'PayTitle' => 'Payment Information',
    'gifTitle' => 'Gift Information',
    'order' => $order,
])

@php
    $products = $order->products;
    $customer = $order->customer;
    $billingAddress = $order->billingAddress;
    $shippingAddress = (object) $order->shipping->address;

    // dl($products);

    $billingInfo = [
        'Amount' => $order->payment->amount ?? '---',
        'Payment Method' => $order->payment->payment_method ?? '---',
        'Currency' => $order->payment->currency ?? '---',
        'Method' => $order->payment->method_code ?? '---',
        'Method Title' => $order->payment->method_title ?? '---',
    ];

@endphp

<div class="row justify-content-center">
    <div class="col-xxl-8 col-md-10">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom p-4 d-none d-md-block">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <img src="{{ URL::asset('assets/images/allogo.png') }}" class="card-logo card-logo-dark"
                                    alt="logo dark" style="width:140px;">
                                {{-- <div class="mt-sm-5 mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                    <p class="text-muted mb-1" id="address-details">Al Oufouk , UAE</p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Post-code:</span>4936</p>
                                </div> --}}
                            </div>
                            <h4>Tax Invoice</h4>
                            <div class=" mt-sm-0 mt-3 border p-2 bg-info-subtle shadow-none bg-opacity-10">
                                {{-- <h4>Tax Invoice</h4> --}}
                                <h6><span class="text-muted fw-normal">Tax Invoice No:</span>
                                    <span id="email">
                                        {{ $order->invoice_no ?? '' }}
                                    </span>
                                </h6>
                                <h6><span class="text-muted fw-normal">Sold By:</span>
                                    <span href="#">
                                        AL OUFOUK GENERAL TRADING CO LLC
                                    </span>
                                </h6>
                                <hr style="border-color:#6b8391;">
                                <h6><span class="text-muted fw-normal">Total Payable:</span>
                                    <span href="#">
                                        {{ $billingInfo['Amount'] }}
                                    </span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-body py-4">
                        <div class="row g-3 d-flex justify-content-evenly">

                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Order Number</p>
                                <h5 class="fs-14 mb-0">#<span id="invoice-no">{{ $order->order_id ?? '' }}</span></h5>
                            </div>

                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Order Date</p>
                                <h5 class="fs-14 mb-0">
                                    <span id="invoice-date">
                                        {{ date('d M Y', strtotime($order->order_date)) ?? '' }}
                                    </span>
                                    {{-- <small class="text-muted" id="invoice-time">02:36PM</small> --}}
                                </h5>
                            </div>

                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Tax Invoice Issue Date</p>
                                <span id="invoice-date">
                                    {{ date('d M Y') ?? '' }}
                                </span>
                            </div>

                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Payable</p>
                                <h5 class="fs-14 mb-0"><span id="total-amount">{{ $billingInfo['Amount'] }}</span></h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top">
                        <div class="row g-3 d-flex justify-content-center">

                            {{-- <div class="col-lg-2 col-1">
                            </div> --}}

                            <div class="col-lg-4 col-12">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                <p class="fw-medium mb-2" id="billing-name">
                                    {{ ($billingAddress->firstname ?? '') . ' ' . ($billingAddress->lastname ?? '') }}
                                </p>
                                <p class="text-muted mb-1" id="billing-address-line-1">
                                    {{ implode(',', $billingAddress->street ?? []) . ' ' . ($billingAddress->city ?? '') }}
                                </p>
                                <p class="text-muted mb-1">
                                    <span>Phone: </span>
                                    <span id="billing-phone-no">
                                        {{ $billingAddress->telephone }}
                                    </span>
                                </p>
                            </div>

                            <div class="col-lg-4 col-12">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Delivery Address</h6>
                                <p class="fw-medium mb-2" id="shipping-name">
                                    {{ ($shippingAddress->firstname ?? '') . ' ' . ($shippingAddress->lastname ?? '') }}
                                </p>
                                <p class="text-muted mb-1" id="shipping-address-line-1">
                                    {{ implode(',', $shippingAddress->street ?? []) . ' ' . ($shippingAddress->city ?? '') }}
                                </p>
                                <p class="text-muted mb-1">
                                    <span>Phone: </span>
                                    <span id="billing-phone-no">
                                        {{ $shippingAddress->telephone }}
                                    </span>
                                </p>
                            </div>

                            <div class="col-lg-4 col-12">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Sold By</h6>
                                <p class="fw-medium mb-2" id="shipping-name">
                                    Al Oufouk General Trading Co Llc
                                </p>
                                <p class="text-muted mb-1" id="shipping-address-line-1">
                                    Industrial Area 17 Opp. Falcon Packaging Maliha Road Sharjah. United Arab Emirats
                                </p>
                                {{-- <p class="text-muted mb-1">
                                    <span>VAT: </span>
                                    <span id="billing-phone-no">
                                        {{ $shippingAddress->telephone }}
                                    </span>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="invoice-table"
                                class="table table-borderless text-center table-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col" class="text-end">Price</th>
                                        <th scope="col" class="text-end">Tax Amount</th>
                                        <th scope="col" class="text-end">Price (inc Tax)</th>
                                        <th scope="col" class="text-end">Discount</th>
                                        <th scope="col">Discount(%)</th>
                                        <th scope="col" class="text-end">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    @php
                                        $subTotal = 0;
                                        $subTotalWithTax = 0;
                                        $discount = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td scope="row"><b>{{ $loop->iteration }}</b></td>
                                            <td class="text-start">
                                                <span class="fw-medium">{{ $product->name ?? '' }}</span>
                                                @foreach ($product->items as $item)
                                                    <li class="text-muted mb-0 ps-3">
                                                        {{ $item->sku . ' - ' . $item->name }}
                                                    </li>
                                                @endforeach
                                            </td>
                                            <td>{{ $product->qty_ordered ?? '' }}</td>
                                            <td class="text-end">{{ $product->price ?? '' }}</td>
                                            <td class="text-end">{{ $product->tax_amount ?? '' }}</td>
                                            <td class="text-end">{{ $product->price_incl_tax ?? '' }}</td>
                                            <td class="text-end">{{ $product->discount_amount ?? '' }}</td>
                                            <td>{{ $product->discount_percent ?? '' }}</td>
                                            <td class="text-end">

                                                @php
                                                    $totalAmount =
                                                        (float) $product->qty_ordered *
                                                        (float) $product->price_incl_tax;

                                                    $totalAmountWithoutTax =
                                                        (float) $product->qty_ordered * (float) $product->price;
                                                @endphp

                                                {{ number_format($totalAmount) ?? '' }}

                                                {{-- {{ number_format((float) $product->qty_ordered * (float) $product->price_incl_tax, 2) ?? '' }} --}}

                                            </td>
                                        </tr>
                                        @php
                                            $subTotal += (float) $totalAmount;
                                            $subTotalWithTax += (float) $totalAmountWithoutTax;
                                            // $subTotalWithTax += (float) $product->price_incl_tax;
                                            $discount += (float) $product->discount_amount;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top border-top mt-2">
                            <table class="table table-sm table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-end">{{ $subTotal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total With Tax</td>
                                        <td class="text-end">{{ $subTotalWithTax }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="text-end">{{ $discount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Amount</td>
                                        <td class="text-end">{{ $order->shipping_amount }}</td>
                                    </tr>
                                    <tr class="border-top border-top fs-15">
                                        <th scope="row">Total Amount</th>
                                        <th class="text-end">{{ $billingInfo['Amount'] }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            </table>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                            <p class="text-muted mb-1">Payment Method:
                                <span class="fw-medium" id="payment-method">{{ $billingInfo['Method Title'] }}</span>
                            </p>
                            <p class="text-muted mb-1">Paid By:
                                <span class="fw-medium" id="card-holder-name">
                                    {{ ($billingAddress->firstname ?? '') . ' ' . ($billingAddress->lastname ?? '') }}
                                </span>
                            </p>
                            <p class="text-muted mb-1">Currency:
                                <span class="fw-medium" id="card-number">
                                    {{ $billingInfo['Currency'] }}
                                </span>
                            </p>
                            <p class="text-muted">
                                Total Amount:
                                <span id="card-total-amount">{{ $billingInfo['Amount'] }}</span>
                                {{-- <span id="card-total-amount">{{ $subTotalWithTax - $discount }}</span> --}}
                            </p>
                        </div>

                        <label style="position: absolute; bottom: 0;">For consumer support, please visit
                            <a href="https://www.ploom.ae/en/help---support/contact-us" target="_blank"
                                class="link-secondary link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                                <span>Contact Us</span>
                            </a>
                        </label>

                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <a href="{{ url('order/order-invoice-pdf', ['order_id' => $order->order_id]) }}"
                                target="_blank" class="btn btn-success align-self-center"
                                onclick="LoaderBtn(this, 'sbtBtnPrint');">
                                <div class="d-flex">
                                    <i class="ri-printer-line align-bottom me-1"></i>
                                    <span class="d-none d-md-block">
                                        Print
                                    </span>
                                </div>
                            </a>
                            <a href="{{ url('order/order-invoice-pdf-download', ['order_id' => $order->order_id]) }}"
                                class="btn btn-primary align-self-center"
                                onclick="LoaderBtn(this, 'sbtBtnDownload');">
                                <div class="d-flex">
                                    <i class="ri-download-2-line align-bottom me-1"></i>
                                    <span class="d-none d-md-block">
                                        Download
                                    </span>
                                </div>
                            </a>
                            <a href="{{ url('order/order-invoice-pdf-email', ['order_id' => $order->order_id]) }}"
                                class="btn btn-danger align-self-center"
                                onclick="LoaderBtn(this, 'sbtBtnEmail',10000);">
                                <div class="d-flex">
                                    <i class="ri-send-plane-fill align-bottom me-1"></i>
                                    <span class="d-none d-md-block">
                                        Email
                                    </span>
                                </div>
                            </a>

                            {{-- Debuging purpose --}}
                            @if (CurrentUser()->username == 'fahath')
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Sent Mail By Manual
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ setMailUrl($order->order_id, 1) }}">
                                                    Confirm
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ setMailUrl($order->order_id, 2) }}">
                                                    Shipped
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ setMailUrl($order->order_id, 3) }}">
                                                    Out For Delivery
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ setMailUrl($order->order_id, 4) }}">
                                                    Delivered
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php

    function setMailUrl($orderId, $type)
    {
        return url('order/send-email-by-manual', ['orderid' => $orderId, 'type' => $type]);
    }

@endphp

@push('scripts')
    <script>
        function LoaderBtn(button, idName, delay = 1000) {
            button.setAttribute('id', idName)
            const span = button.querySelector('div');
            sLoading(idName)
            setTimeout(() => {
                eLoading(idName, span)
            }, delay);
        }

        function LoaderBtnBK(button, iconClass, delay = 1000) {

            //  onclick="LoaderBtn(this, 'ri-send-plane-fill',10000);" //from html

            const icon = button.querySelector('i');

            icon.classList.remove(iconClass);
            icon.classList.add('fa', 'fa-spinner', 'fa-spin');

            setTimeout(() => {
                icon.classList.remove('fa', 'fa-spinner', 'fa-spin');
                icon.classList.add(iconClass);
            }, delay);
        }
    </script>
@endpush

<style>
    #invoice-table tbody tr td {
        vertical-align: baseline
    }

    #invoice-table tbody tr {
        border-top: 1px solid #e7e7eb !important;
    }
</style>
