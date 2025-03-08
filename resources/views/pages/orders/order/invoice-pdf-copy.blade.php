<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice | {{ $order->order_id ?? '' }}</title>
    <link rel="shortcut icon" href="{{ getcwd() . '/public/assets/images/favicon.ico' }}" />
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

    <div class="row dot" stylse="background-color: red;heigsht:10px">
        <div class="col-12" style="text-align:center">
            <span style="text-align:center">
                @php
                    $imgUrl = getcwd() . '/public/assets/images/oms-logo.png';
                @endphp
                <img src="{{ $imgUrl }}" alt="sdsd" height="25">
            </span>
        </div>
    </div>

    <div class="row dot mt-4" style="">
        <div class="col-6">
            <p style="margin: 0;">Address</p>
            <p style="margin: 0;">Al Oufouk, UAE</p>
            <p style="margin: 0;">
                <span>Post-code:</span> 4936
            </p>
        </div>
        <div class="col-6" style="background-color: resd;text-align:right">
            <div style="margin-right:15px;align-items:right">
                <p style="margin: 0;"><span style="">Legal Registration No:</span>
                    <span>987654</span>
                </p>
                <p style="margin: 0;"><span style="">Email:</span>
                    <span>aloufouk@test.com</span>
                </p>
                <p style="margin: 0;"><span style="">Website:</span> <a href="#">www.website.com</a></p>
                <p style="margin: 0;"><span style="">Contact No:</span> <span>+971 6
                        5341222</span></p>
            </div>
        </div>
    </div>

    <div class="row mt-3 dot sum-headerd" style="">
        <div class="col-2">
        </div>
        <div class="col-5">
            <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
            <p class="fs-12 mt-1 mb-0">#<span id="invoice-no">{{ $order->order_id }}</span></p>
        </div>
        <div class="col-4">
            <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
            <p class="fs-12 mt-1 mb-0"><span id="invoice-date">{{ date('d-m-Y') }}</span>
                {{-- <small class="text-muted" id="invoice-time">02:36PM</small> --}}
            </p>
        </div>
        {{-- <div class="col-3">
            <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
            <p class="mt-1 fs-11" id="payment-status">Paid</p>
        </div>
        <div class="col-3">
            <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
            <p class="fs-12 mt-1 mb-0"><span id="total-amount">{{ $billingInfo['Amount'] }}</span></p>
        </div> --}}
    </div>

    <div class="row mt-3 dot" style="">
        <div class="col-2">
        </div>

        <div class="col-5">
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                <strong>Billing Address</strong>
            </p>
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                {{ ($billingAddress->firstname ?? '') . ' ' . ($billingAddress->lastname ?? '') }}
            </p>
            <p class="fs-12 mt-1 mb-0">
                <span id="invoice-no">
                    {{ implode(',', $billingAddress->street ?? []) . ' ' . ($billingAddress->city ?? '') }}
                </span>
            </p>
            <p class="text-muted mb-1">
                <span>Phone: </span>
                <span id="billing-phone-no">
                    {{ $billingAddress->telephone }}
                </span>
            </p>
        </div>
        <div class="col-4">
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                <strong>Shipping Address</strong>
            </p>
            <p class="text-muted mb-2 text-uppercase fw-semibold">
                {{ ($shippingAddress->firstname ?? '') . ' ' . ($shippingAddress->lastname ?? '') }}
            </p>
            <p class="fs-12 mt-1 mb-0">
                <span id="invoice-no">
                    {{ implode(',', $shippingAddress->street ?? []) . ' ' . ($shippingAddress->city ?? '') }}
                </span>
            </p>
            <p class="text-muted mb-1">
                <span>Phone: </span>
                <span id="billing-phone-no">
                    {{ $shippingAddress->telephone }}
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
                        <th>Discount(%)</th>
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
                            <td class="text-end">
                                {{ number_format((float) $product->qty_ordered * (float) $product->price_incl_tax, 2) ?? '' }}
                            </td>
                        </tr>
                        @php
                            $subTotal += (float) $product->price;
                            $subTotalWithTax += (float) $product->price_incl_tax;
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
                <h6 class="mb-1" style="margin-bottom: 5px">Payment Details:</h6>
                <p class="text-muted mt-1">Payment Method:
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
                <p class="text-muted">Total Amount:
                    <span id="card-total-amount">{{ $billingInfo['Amount'] }}</span>
                </p>
            </div>
        </div>
    </div>


    <style>
        * {
            box-sizing: border-box;
        }

        .dot {
            border-bottom: 0.5px dashed #040404;
        }

        .dot-top {
            border-top: 0.5px dashed #040404;
        }

        #invoice-table tbody tr td {
            vertical-align: baseline
        }

        .m-1 {
            margin: 0.25rem;
        }

        .m-2 {
            margin: 0.5rem;
        }

        .m-3 {
            margin: 1rem;
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
            width: 33.32%;
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

        .sum-table td,
        th {
            font-size: 10px;
            text-align: left;
            padding: 2px 2px;
            border-top: 1px solid #e9e9e9;
            border-bottom: 1px solid #e9e9e9;
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
