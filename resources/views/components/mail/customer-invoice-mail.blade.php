@php
    $products = $order->products;
    $customer = $order->customer;
    $billingAddress = $order->billingAddress;
    $shippingAddress = (object) $order->shipping->address;
    $customerEMail = $billingAddress->email ?? '';

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

                    @php
                        $url = "administration/mail-open/1/$order->order_id";
                    @endphp

                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                            <td
                                style="background-color: #000000; padding: 10px 20px; border-radius: 3px; text-align: center;">
                                <a href="{{ url($url) }}"
                                    style="display: inline-block; font-family: Arial, sans-serif; font-size: 16px; color: #ffffff;
                                          text-decoration: none; background-color: #000000; border-radius: 3px;">
                                    View Your Order
                                </a>
                            </td>
                        </tr>
                    </table>

                    <div
                        style="margin-top:40px;margin-bottom:0px; padding-left: 0px; font-family: 'Roboto', sans-serif;">
                        <p>
                            <span
                                style="display: inline-block; font-family: Arial, sans-serif; font-size: 11px;
                                    color: #000000;text-align:center">
                                This product is harmful and contains nicotine which is a highly addictive substance.
                                This is for use only by adults and is not recommended for use by nonsmokers.
                            </span>


                        <div style="margin-top:40px">
                            <span
                                style="display: inline-block; font-family: Arial, sans-serif; font-size: 11px;
                                        color: #000000;text-align:center;">
                                All rights reserved.
                                <span style="text-decoration:underline">
                                    Terms of Use | Privacy Policy <br>
                                </span>
                            </span>

                            <span style="display: block; margin-top: 5px;font-size: 11px;">
                                This email was sent to
                                <span style="text-decoration:underline">
                                    {{ $customerEMail }}
                                </span>
                            </span>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
