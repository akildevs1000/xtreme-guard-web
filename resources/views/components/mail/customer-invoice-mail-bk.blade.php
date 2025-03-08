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

<table class="body-wrap"
    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; widths:100%; background-color: transparent; margin: 0;">
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
            valign="top"></td>
        <td class="container" width="600"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
            valign="top">
            <div class="content"
                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope
                    itemtype="http://schema.org/ConfirmAction"
                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;">
                    <tr style="font-family: 'Roboto', sans-serif; font-size: 14px; margin: 0;">
                        <td class="content-wrap"
                            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; color: #495057; font-size: 14px; vertical-align: top; margin: 0;padding: 30px; box-shadow: 0 3px 15px rgba(30,32,37,.06); ;border-radius: 7px; background-color: #fff;"
                            valign="top">
                            <meta itemprop="name" content="Confirm Email"
                                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <tr
                                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                        valign="top">
                                    </td>
                                </tr>
                                <tr
                                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; line-height: 1.5; font-size: 24px; vertical-align: top; margin: 0; padding: 0 0 10px;text-align: center; font-weight: 500;"
                                        valign="top">
                                        Ploom order confirmation
                                    </td>
                                </tr>
                                <tr
                                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="font-family: 'Roboto', sans-serif; color: #000000; line-height: 1.5; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 24px; text-align: center;"
                                        valign="top">
                                        Thank you for your order!<br>
                                        Your order has been placed successfully and we are processing it now.
                                        You can find all your order details below.
                                        <br><br>
                                        <strong>Order Number</strong>: {{ $order->order_id }}
                                        <hr style="border-color: #a4abaf;">
                                    </td>
                                </tr>

                                @php
                                    $fontSize = '13px ';
                                    $rowBorder = 'border-top: 1px solid #e7e7eb !important';
                                    $rowFooterBorder = 'border-top: 1px solid #242424 !important;text-align: left';
                                @endphp

                                <tr
                                    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="color: #878a99; text-align: center;font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0"
                                        valign="top">
                                        {{-- ======================== --}}
                                        <table id="invoice-table"
                                            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; background-color: transparent; margin: 0;border:1px solid #e7e7eb
                                            /* width:600px; */
                                            ">
                                            <thead>
                                                <tr class="table-active">
                                                    <th
                                                        style="width: 100px;text-align: left; font-size: {{ $fontSize }};">
                                                        #
                                                    </th>
                                                    <th
                                                        style="width: 2500px;text-align: left; font-size: {{ $fontSize }};">
                                                        Product Details
                                                    </th>
                                                    <th style="font-size: {{ $fontSize }};width: 200px">
                                                        QTY
                                                    </th>
                                                    <th
                                                        style="font-size: {{ $fontSize }};width: 300px; text-align: right;">
                                                        Price
                                                    </th>
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
                                                    <tr style="">
                                                        <td style="font-size: {{ $fontSize }};{{ $rowBorder }}">
                                                            <b>{{ $loop->iteration }}</b>
                                                        </td>
                                                        <td
                                                            style="font-size: {{ $fontSize }};{{ $rowBorder }};text-align: left">
                                                            <span class="fw-medium">{{ $product->name ?? '' }}</span>
                                                            @foreach ($product->items as $item)
                                                                <li>
                                                                    {{ $item->sku . ' - ' . $item->name }}
                                                                </li>
                                                            @endforeach
                                                        </td>
                                                        <th
                                                            style="font-size: {{ $fontSize }};{{ $rowBorder }};width: 200px;">
                                                            {{ $product->qty_ordered ?? '' }}
                                                        </th>
                                                        <td
                                                            style="font-size: {{ $fontSize }};{{ $rowBorder }};text-align: right;">
                                                            {{ number_format((float) $product->qty_ordered * (float) $product->price_incl_tax, 2) ?? '' }}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $subTotal += (float) $product->price;
                                                        $subTotalWithTax += (float) $product->price_incl_tax;
                                                        $discount += (float) $product->discount_amount;
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td style="font-size: {{ $fontSize }};{{ $rowFooterBorder }}">
                                                        Delivery Fee
                                                    </td>
                                                    <td style="font-size: {{ $fontSize }};{{ $rowFooterBorder }};text-align:right"
                                                        colspan="3">
                                                        {{ $order->shipping_amount }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: {{ $fontSize }};text-align: left">
                                                        Discount
                                                    </td>
                                                    <td style="font-size: {{ $fontSize }};text-align:right"
                                                        colspan="3">
                                                        {{ $discount }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: {{ $fontSize }};text-align: left">
                                                        Subtotal
                                                    </td>
                                                    <td style="font-size: {{ $fontSize }};text-align:right"
                                                        colspan="3">
                                                        {{ $billingInfo['Amount'] }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div style="margin-top:7px">
                                                            <span
                                                                style=" margin: 4px 0 0 0;font-size:10px;font-style: italic;">
                                                                Disclaimer: Discount calculation is done on the total
                                                                price, excluding VAT
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: {{ $fontSize }};{{ $rowFooterBorder }}"
                                                        colspan="4">
                                                        <div>
                                                            <strong style="margin:5px auto">Delivery address</strong>
                                                            <br>
                                                            <label style=" margin: 4px 0 0 0;">
                                                                {{ ($shippingAddress->firstname ?? '') . ' ' . ($shippingAddress->lastname ?? '') }}
                                                            </label><br>
                                                            <label style=" margin: 4px 0 0 0;">
                                                                {{ implode(',', $shippingAddress->street ?? []) . ' ' . ($shippingAddress->city ?? '') }}
                                                            </label>
                                                        </div>

                                                        <div style="margin-top:7px">
                                                            <strong style="margin:5px auto">Billing address</strong>
                                                            <br>
                                                            <label style=" margin: 4px 0 0 0;">
                                                                {{ ($billingAddress->firstname ?? '') . ' ' . ($billingAddress->lastname ?? '') }}
                                                            </label><br>
                                                            <label style=" margin: 4px 0 0 0;">
                                                                {{ implode(',', $billingAddress->street ?? []) . ' ' . ($billingAddress->city ?? '') }}
                                                            </label>
                                                        </div>

                                                        {{-- <div style="margin-top:7px">
                                                            <span
                                                                style=" margin: 4px 0 0 0;font-size:10px;font-style: italic;">
                                                                Disclaimer: Discount calculation is done on the total
                                                                price, excluding VAT
                                                            </span>
                                                        </div> --}}

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: {{ $fontSize }};{{ $rowFooterBorder }};white-space: nowrap;">
                                                        Payment method
                                                    </td>
                                                    <td style="font-size: {{ $fontSize }};{{ $rowFooterBorder }};text-align:right"
                                                        colspan="3">
                                                        {{ $billingInfo['Method Title'] }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: {{ $fontSize }};{{ $rowFooterBorder }};white-space: nowrap;">
                                                        Delivery method
                                                    </td>
                                                    <td style="font-size: {{ $fontSize }};{{ $rowFooterBorder }};text-align:right"
                                                        colspan="3">
                                                        JTI Standard Shipping
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td style="font-size: 13px;border-top: 1px solid #e7e7eb  !important;text-align:right"
                                                        colspan="4"></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div style="text-align: center; margin: 0px auto;">
                    <div
                        style="padding-top:5px;margin-bottom:0px; padding-left: 0px; font-family: 'Roboto', sans-serif;">
                        {{-- style="display: flex; justify-content: space-evenly; padding-top:5px;margin-bottom:0px; padding-left: 0px; font-family: 'Roboto', sans-serif;"> --}}
                        <p>
                            <a style="color: #000000;">Thank you for choosing Ploom</a>
                        </p>
                    </div>

                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                            <td
                                style="background-color: #000000; padding: 10px 20px; border-radius: 3px; text-align: center;">
                                <a href="https://www.ploom.ph/en/profile#/orders/"
                                    style="display: inline-block; font-family: Arial, sans-serif; font-size: 16px; color: #ffffff;
                                          text-decoration: none; background-color: #000000; border-radius: 3px;">
                                    View Your Order
                                </a>
                            </td>
                        </tr>
                    </table>


                    {{-- <p style="font-family: 'Roboto', sans-serif; font-size: 14px;color: #98a6ad; margin: 0px;">2022
                        Velzon. Design &amp; Develop by Themesbrand</p> --}}
                </div>
            </div>
        </td>
    </tr>
</table>

{{-- <style>
    #invoice-table td,
    th {
        font-size: 10px;
        padding: 2px 2px;
        border: 1px solid #e9e9e9;
    }

    #invoice-table tbody tr td {
        vertical-align: baseline
    }
</style> --}}

{{-- <style>
    .bg-info-subtle {
        background-color: #dff0fa !important;
    }

    .support-label {
        font-size: 11px;
        position: fixed;
        bottom: 0;
    }

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
</style> --}}
