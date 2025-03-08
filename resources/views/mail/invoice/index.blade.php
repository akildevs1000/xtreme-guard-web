@php
    $customerName = $order['customer']['first_name'] . ' ' . ($order['customer']['last_name'] ?? '');
    $OrderDate = date('d-m-Y', strtotime($order['order_date']));
    $InvoiceDate = date('d-m-Y');
    $orderNo = $order->order_id ?? '';
    $customerEMail = $order->billingAddress->email ?? '';
    // $openUrl = url("administration/mail-open/2/$order->order_id");
    // Log::info($openUrl);
@endphp

<table width="100%" cellpadding="0" cellspacing="0"
    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; width:600px;min-width:600px;max-width:600px">
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
            valign="top">
        </td>
    </tr>
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; line-height: 1.5; font-size: 24px; vertical-align: top; margin: 0; padding: 0 0 10px;text-align: center; font-weight: 500;"
            valign="top">
            Ploom order confirmation
        </td>
    </tr>
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; color: #000000; line-height: 1.5; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 24px; text-align: center;"
            valign="top">
            Thank you for your order!<br>
            Your order has been confirmed, and we are now starting to assemble it.
            {{-- You can find all your order details below. --}}
            <br><br>
            <strong>Order Number</strong>: {{ $orderNo }}
            {{-- <hr style="border-color: #a4abaf;"> --}}
        </td>
    </tr>
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="color: #878a99; text-align: center;font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0"
            valign="top">
            {{-- ======================== --}}
            <table id="invoice-table"
                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; background-color: transparent; margin: 0;border:1px solid #e7e7eb /* width:600px; */ ">
                <thead>
                </thead>
                <tbody id="products-list">
                </tbody>
            </table>
        </td>
    </tr>
</table>

<table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope
    itemtype="http://schema.org/ConfirmAction"
    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: 1px solid #e5e1e1;width:600px;min-width:600px;max-width:600px">
    <tr style="font-family: 'Roboto', sans-serif; font-size: 14px; margin: 0;">
        <td class="content-wrap"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; color: #495057; font-size: 14px; vertical-align: top; margin: 0;padding: 30px; box-shadow: 0 3px 15px rgba(30,32,37,.06); ;border-radius: 7px; background-color: #fff;"
            valign="top">
            <meta itemprop="name" content="Confirm Email"
                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
            <table width="100%" cellpadding="0" cellspacing="0"
                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 24px; vertical-align: top; margin: 0; padding: 0 0 10px; text-align: center;"
                        valign="top">
                        <h4 style="font-family: 'Roboto', sans-serif; margin-bottom: 10px; font-weight: 600;">
                            Your order has been placed
                        </h4>
                    </td>
                </tr>
                <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 12px;"
                        valign="top">
                        <h5 style="font-family: 'Roboto', sans-serif; margin-bottom: 3px;">Hey,
                            {{ $customerName }}</h5>
                        <p style="font-family: 'Roboto', sans-serif; margin-bottom: 8px; color: #878a99;">
                            Your order has been confirmed and will be shipping soon.</p>
                    </td>
                </tr>
                <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 18px;"
                        valign="top">
                        <table style="width:100%;">
                            <tbody>
                                <tr style="text-align: left;">
                                    <th style="padding: 5px;">
                                        <p
                                            style="color: #878a99; font-size: 13px; margin-bottom: 2px; font-weight: 400;">
                                            Order Number
                                        </p>
                                        <span>{{ $orderNo }}</span>
                                    </th>
                                    <th style="padding: 5px;">
                                        <p
                                            style="color: #878a99; font-size: 13px; margin-bottom: 2px; font-weight: 400;">
                                            Order Date
                                        </p>
                                        <span>
                                            {{ $OrderDate }}
                                        </span>
                                    </th>
                                    <th style="padding:5px;">
                                        <p
                                            style="color:#878a99; font-size: 13px; margin-bottom: 2px; font-weight: 400;">
                                            Invoice Date</p>
                                        <span>
                                            {{ $InvoiceDate }}
                                        </span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 12px;"
                        valign="top">
                        <h6
                            style="font-family: 'Roboto', sans-serif; font-size: 15px; text-decoration-line: underline;margin-bottom: 15px;">
                            Attached: Please find the invoice for your order.
                        </h6>
                    </td>
                </tr>
                <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 0px;"
                        valign="top">
                        <p style="font-family: 'Roboto', sans-serif; margin-bottom: 8px; color: #878a99;">
                            Wl'll send you shipping confirmation when your item(s) are on the
                            way! We appreciate your business, and hope you enjoy your purchase.
                        </p>
                        <h6
                            style="font-family: 'Roboto', sans-serif; font-size: 14px; margin-bottom: 0px; text-align: end;">
                            Thank you!
                        </h6>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0"
    style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; width:600px;min-width:600px;max-width:600px">
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
            valign="top">
        </td>
    </tr>
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; line-height: 1.5; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;text-align: center; font-weight: 500;"
            valign="top">
            Thank you for choosing Ploom
        </td>
    </tr>
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; color: #000000; line-height: 1.5; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 24px; text-align: center;"
            valign="top">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                <tr>
                    {{-- $openUrl = url("administration/mail-open/2/$order->order_id"); --}}

                    <td style="background-color: #000000; padding: 10px 20px; border-radius: 3px; text-align: center;">
                        <a href="{{ 'https://www.ploom.ph/en/profile#/orders/' }}"
                            style="display: inline-block; font-family: Arial, sans-serif; font-size: 16px; color: #ffffff;
                                  text-decoration: none; background-color: #000000; border-radius: 3px;">
                            View Your Order
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-block"
            style="font-family: 'Roboto', sans-serif; box-sizing: border-box; line-height: 1.5; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;text-align: center; font-weight: 500;"
            valign="top">
            <div style="margin-top:40px;margin-bottom:0px; padding-left: 0px; font-family: 'Roboto', sans-serif;">
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
        </td>
    </tr>
</table>
