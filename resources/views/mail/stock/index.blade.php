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
                            Low Stock Notification</h5>
                    </td>
                </tr>
                <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block"
                        style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 15px; vertical-align: top; margin: 0; padding: 0 0 12px;"
                        valign="top">
                        <h5 style="font-family: 'Roboto', sans-serif; margin-bottom: 3px;">Hello,
                            {{ 'Team' }}</h5>
                        <p style="font-family: 'Roboto', sans-serif; margin-bottom: 8px; color: #878a99;">
                            Please be informed that stock levels have reached a low threshold. Further details can be
                            found in the attached PDF.</p>
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
                                            Company
                                        </p>
                                        <span>Al Oufouk</span>
                                    </th>
                                    <th style="padding:5px;">
                                        <p
                                            style="color: #878a99; font-size: 13px; margin-bottom: 2px; font-weight: 400;">
                                            Report Generate On
                                        </p>
                                        <span>
                                            {{ date('d M Y') }}
                                        </span>
                                    </th>
                                    {{-- <th style="padding: 5px;">
                                        <p
                                            style="color: #878a99; font-size: 13px; margin-bottom: 2px; font-weight: 400;">
                                            Invoice Date</p>
                                        <span>
                                            {{ $InvoiceDate ?? 'InvoiceDate' }}
                                        </span>
                                    </th> --}}
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
                            Attached: Please find the invoice for your order.</h6>

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
                            Thank you!</h6>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
