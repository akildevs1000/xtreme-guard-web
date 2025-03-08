<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice | {{ $order->order_id ?? '' }}</title>
    <link rel="shortcut icon" href="{{ getcwd() . '/public/assets/images/favicon.ico' }}" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css2?family=FontName&display=swap" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
    @php
        $products = $order->products;
        $customer = $order->customer;
        $billingAddress = $order->billingAddress;
        $shippingAddress = (object) $order->shipping->address;

        $billingInfo = [
            'Amount' => $order->payment->amount ?? '---',
            'Payment Method' => $order->payment->payment_method ?? '---',
            'Currency' => $order->payment->currency ?? '---',
            'Method' => $order->payment->method_code ?? '---',
            'Method Title' => $order->payment->method_title ?? '---',
        ];

    @endphp

    {{-- <div class="row dot" stylse="background-color: red;heigsht:10px">
        <div class="col-12" style="text-align:center">
            <span style="text-align:center">
                @php
                    $imgUrl = getcwd() . '/public/assets/images/allogo.png';
                @endphp
                <img src="{{ $imgUrl }}" alt="sdsd" height="25">
            </span>
        </div>
    </div> --}}

    <div class="row dot mt-0">
        <div class="col-4">
            @php
                $imgUrl = getcwd() . '/public/assets/images/allogo.png';
            @endphp
            <img src="{{ $imgUrl }}" alt="logo" style="width:140px;">
        </div>
        <div class="col-2" stylse="background-color:red">
            <h3 style="font-weight:600">Tax Invoice</h3>
            {{-- <h4>Tax Invoice</h4> --}}
        </div>
        <div class="col-5" style="background-color: resd;text-align:left; width: 45%">
            {{-- <div style="margin-right:15px;align-items:right"> --}}
            <div class="summary-box flex-shrink-0 mt-sm-0 mt-3 border py-2 bg-info-subtle shadow-none bg-opacity-10"
                style="height:9%; padding:10px; align-items:left">
                <h6 class="mb-1">
                    <span style="font-weight: 400 !important">Tax Invoice No:</span>
                    <span id="email"> {{ $order->invoice_no }} </span>
                </h6>

                <h6 class="mt-0 mb-1">
                    <span class="text-muted fw-normal">Sold By:</span>
                    <span> AL OUFOUK GENERAL TRADING CO LLC </span>
                </h6>
                <h6 class="mt-0">
                    <span class="text-muted fw-normal">Total Payable:</span>
                    <span> {{ $billingInfo['Amount'] }} </span>
                </h6>

            </div>
        </div>
    </div>

    <div class="row mt-3 dot dot-top sum-headerd" style="padding:20px 0px">

        <div class="col-3">
            <p class="text-muted mb-1 text-uppercase fw-semibold">Order Number</p>
            <p class="fs-12 mt-1 mb-0">#<b id="invoice-no">{{ $order->order_id }}</b></p>
        </div>
        <div class="col-3">
            <p class="text-muted mb-1 text-uppercase fw-semibold">Order Date</p>
            <p class="fs-12 mt-0 mb-0">
                <b id="invoice-date">
                    {{ date('d M Y', strtotime($order->order_date)) ?? '' }}
                </b>
            </p>
        </div>
        <div class="col-3">
            <p class="text-muted mb-1 text-uppercase fw-semibold">Tax Invoice Issue Date</p>
            <p class="fs-12 mt-0 mb-0">
                <b id="invoice-date">
                    {{ date('d M Y') ?? '' }}
                </b>
            </p>
        </div>
        <div class="col-2">
            <p class="text-muted mb-1 text-uppercase fw-semibold">Total Payable</p>
            <p class="fs-12 mt-1 mb-0"><b id="total-amount">{{ $billingInfo['Amount'] }}</b></p>
        </div>
    </div>

    <div class="rsow mt-3 dot" style="width:102%">

        <div class="col-4">
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                <strong>Billing Address</strong>
            </p>
            <p class="text-muted mb-0 text-uppercase fw-semibold">
                {{ ($billingAddress->firstname ?? '') . ' ' . ($billingAddress->lastname ?? '') }}
            </p>
            <p class="fs-11 mt-0 mb-0">
                <span id="invoice-no">
                    {{ implode(',', $billingAddress->street ?? []) . ' ' . ($billingAddress->city ?? '') }}
                </span>
            </p>
            <p class="text-muted mb-0 fs-11">
                <span>Phone: </span>
                <span id="billing-phone-no">
                    {{ $billingAddress->telephone }}
                </span>
            </p>
        </div>

        <div class="col-4">
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                <strong>Delivery Address</strong>
            </p>
            <p class="text-muted mb-0 text-uppercase fw-semibold">
                {{ ($shippingAddress->firstname ?? '') . ' ' . ($shippingAddress->lastname ?? '') }}
            </p>
            <p class="fs-11 mt-0 mb-0">
                <span id="invoice-no">
                    {{ implode(',', $shippingAddress->street ?? []) . ' ' . ($shippingAddress->city ?? '') }}
                </span>
            </p>
            <p class="text-muted mb-0 fs-11">
                <span>Phone: </span>
                <span id="billing-phone-no">
                    {{ $shippingAddress->telephone }}
                </span>
            </p>
        </div>

        <div class="col-4">
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                <strong>Sold By</strong>
            </p>
            <p class="text-muted mb-0 text-uppercase fw-semibold">
                Al Oufouk General Trading Co Llc
            </p>
            <p class="fs-11 mt-0 mb-0">
                <span id="invoice-no">
                    Industrial Area 17 Opp. Falcon Packaging Maliha Road Sharjah. United Arab Emirats
                </span>
            </p>
        </div>
    </div>


    <div class="row">
        <div class="col-12" style="margin-top: 5%">
            <table id="invoice-table" class="">
                <thead>
                    <tr class="table-active">
                        <th class="" style="width: 50px;">#</th>
                        <th class="">Product Details</th>
                        <th class="">QTY</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Tax Amount</th>
                        <th class="text-end">Price (inc Tax)</th>
                        <th class="text-end">Discount</th>
                        <th class="text-start">Discount(%)</th>
                        <th class="text-end">Total Amount</th>
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
                                    <li style="margin-left:20px">
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
                            <td class="text-end" style="text-align:right">

                                @php
                                    $totalAmount = (float) $product->qty_ordered * (float) $product->price_incl_tax;

                                    $totalAmountWithoutTax = (float) $product->qty_ordered * (float) $product->price;
                                @endphp

                                {{ number_format($totalAmount) ?? '' }}

                                {{-- {{ number_format((float) $product->qty_ordered * (float) $product->price_incl_tax, 2) ?? '' }} --}}
                            </td>
                        </tr>
                        @php
                            // $subTotal += (float) $product->price;
                            // $subTotalWithTax += (float) $product->price_incl_tax;
                            // $discount += (float) $product->discount_amount;

                            $subTotal += (float) $totalAmount;
                            $subTotalWithTax += (float) $totalAmountWithoutTax;
                            // $subTotalWithTax += (float) $product->price_incl_tax;
                            $discount += (float) $product->discount_amount;
                        @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="sum-table mt-3">
                <table style="width: 250px;">
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
                        <tr class="border-top border-top-dashed fs-15">
                            <th scope="row">Total Amount</th>
                            <th class="text-end">{{ $billingInfo['Amount'] }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3 dot-top">
                <h6 class="mb-1">Payment Details:</h6>
                <p class="text-muted mt-1">Payment Method:
                    <span class="fw-medium" id="payment-method">{{ $billingInfo['Method Title'] }}</span>
                </p>
                <p class="text-muted mb-0">Paid By:
                    <span class="fw-medium" id="card-holder-name">
                        {{ ($billingAddress->firstname ?? '') . ' ' . ($billingAddress->lastname ?? '') }}
                    </span>
                </p>
                <p class="text-muted mb-0">Currency:
                    <span class="fw-medium" id="card-number">
                        {{ $billingInfo['Currency'] }}
                    </span>
                </p>
                <p class="text-muted">Total Amount:
                    <span id="card-total-amount">{{ $billingInfo['Amount'] }}</span>
                </p>
            </div>


            <htmlpagefooter name="page-footer">
                <p class="support-label">For consumer support, please visit
                    <a href="https://www.ploom.ae/en/help---support/contact-us" target="_blank"
                        class="link-secondary link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                        Contact Us</a>
                </p>
            </htmlpagefooter>
        </div>
    </div>

    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }

        /* * {
            font-family: DejaVuSansCondensed, sans-serif;
        }

        body {
            font-size: 12px !important;
            width: 100%;
        } */

        .bg-info-subtle {
            background-color: #dff0fa !important;
        }

        .support-label {
            font-size: 11px !important;
            position: fixed !important;
            bottom: 0 !important;
        }

        * {
            box-sizing: border-box;
        }

        .dot {
            /* border-bottom: 0.1px dashed #040404; */
            border-bottom: 0.5px dotted #000000;
        }

        .dot-top {
            border-top: 0.5px dotted #040404;
        }

        #invoice-table tbody tr td {
            vertical-align: baseline
        }

        .fw-normal {
            font-weight: 400 !important;
        }


        .mb-0 {
            margin-bottom: 0px;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: 0.50rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .m-1 {
            margin-top: 0.25rem;
        }

        .m-2 {
            margin-top: 0.5rem;
        }

        .m-3 {
            margin-top: 1rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mt-4 {
            margin-top: 1.50rem;
        }

        .mr-1 {
            margin-right: 0.25rem;
        }

        .ml-3 {
            margin-left: 1rem;
        }

        .mx-4 {
            margin-right: 1.5rem;
            margin-left: 1.5rem;
        }

        .my-5 {
            margin-top: 2.5rem;
            margin-bottom: 2.5rem;
        }

        .pr-1 {
            padding-right: 0.25rem;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .pl-3 {
            padding-left: 1rem;
        }

        .px-4 {
            padding-right: 1.5rem;
            padding-left: 1.5rem;
        }

        .py-5 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col {
            width: 5%;
            float: left;
            padding: 5px;
        }


        .col-1 {
            width: 8.33%;
            float: left;
            padding: 5px;
        }

        .col-2 {
            width: 16.66%;
            float: left;
            padding: 5px;
        }

        .col-3 {
            width: 24.99%;
            float: left;
            padding: 5px;
        }

        .col-4 {
            width: 32%;
            float: left;
            padding: 5px;
        }

        .col-5 {
            width: 41.65%;
            float: left;
            padding: 5px;
        }

        .col-6 {
            width: 49.98%;
            float: left;
            padding: 5px;
        }

        .col-7 {
            width: 58.31%;
            float: left;
            padding: 5px;
        }

        .col-8 {
            width: 66.64%;
            float: left;
            padding: 5px;
        }

        .col-9 {
            width: 74.97%;
            float: left;
            padding: 5px;
        }

        .col-10 {
            width: 83.3%;
            float: left;
            padding: 5px;
        }

        .col-11 {
            width: 91.63%;
            float: left;
            padding: 5px;
        }

        .col-12 {
            width: 100%;
            float: left;
            padding: 5px;
        }

        .form-input {
            width: 100%;
            padding: 2px 5px;
            border-radius: 0px;
            resize: vertical;
            outline: 0;
        }

        .label-txt {
            font-size: 14px
        }

        ,
        input {
            /* border: none; */
            /* border-bottom: 1px solid black; */
            padding: 5px 10px;
            outline: none;
            font-size: 13px
        }

        hr {
            position: relative;
            border: none;
            height: 1px;
            background: rgb(167, 164, 164);
        }

        .terms {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif
        }

        .header-txt {
            font-size: 20px;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header-txt-span {
            font-size: 12px;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .header-txt-address {
            font-size: 12px;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0px;
            padding: 0px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border: 0px solid #e9e9e9;
            /* width: 50%; */
            margin: auto;
        }

        #invoice-table td,
        th {
            font-size: 10px;
            text-align: left;
            padding: 2px 2px;
            border-top: 1px solid #e9e9e9;
            border-bottom: 1px solid #e9e9e9;
        }

        #invoice-table .text-end {
            text-align: right !important;
        }

        .sum-table td,
        th {
            font-size: 10px;
            padding: 2px 2px;
            border-top: 1px solid #e9e9e9;
            border-bottom: 1px solid #e9e9e9;
        }

        .sum-table td:first-child,
        .sum-table th:first-child {
            text-align: left;
        }

        .sum-table td:not(:first-child),
        .sum-table th:not(:first-child) {
            text-align: right;
        }


        /* ------------------------ */
        .justify-content-center {
            -webkit-box-pack: center !important;
            justify-content: center !important;
        }

        .text-center {
            text-align: center !important
        }

        .text-end {
            text-align: right !important
        }

        .text-start {
            text-align: left !important
        }


        .sum-table {
            text-align: right;
            /* Aligns the text in the div to the right */
        }

        .sum-table table {
            margin-left: auto;
            margin-right: 0;
        }

        .sum-header {
            margin-left: auto;
            margin-right: 0;
            text-align: center;
        }

        .fs-1 {
            font-size: 1px;
        }

        .fs-2 {
            font-size: 2px;
        }

        .fs-3 {
            font-size: 3px;
        }

        .fs-4 {
            font-size: 4px;
        }

        .fs-5 {
            font-size: 5px;
        }

        .fs-6 {
            font-size: 6px;
        }

        .fs-7 {
            font-size: 7px;
        }

        .fs-8 {
            font-size: 8px;
        }

        .fs-9 {
            font-size: 9px;
        }

        .fs-10 {
            font-size: 10px;
        }

        .fs-11 {
            font-size: 11px;
        }

        .fs-12 {
            font-size: 12px;
        }

        .fs-13 {
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .fs-15 {
            font-size: 15px;
        }

        .fs-16 {
            font-size: 16px;
        }

        .fs-17 {
            font-size: 17px;
        }

        .fs-18 {
            font-size: 18px;
        }

        .fs-19 {
            font-size: 19px;
        }

        .fs-20 {
            font-size: 20px;
        }

        p {
            font-size: 12px;
            padding: 0px;
            margin: 0px;

            font-family: "Poppins", sans-serif;
        }

        body {
            font-family: "Poppins", sans-serif;
        }

        /* ------------------------ */
    </style>

</body>

</html>
