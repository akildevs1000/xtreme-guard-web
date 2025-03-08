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

    // dl($shippingAddress->firstname);

    $billingInfo = [
        'Amount' => $order->payment->amount ?? '---',
        'Payment Method' => $order->payment->payment_method ?? '---',
        'Currency' => $order->payment->currency ?? '---',
        'Method' => $order->payment->method_code ?? '---',
        'Method Title' => $order->payment->method_title ?? '---',
    ];

    // dl($billingInfo);

@endphp

<div class="row justify-content-center">
    <div class="col-xxl-7 col-md-10">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom-dashed p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <img src="{{ URL::asset('assets/images/oms-logo.png') }}"
                                    class="card-logo card-logo-dark" alt="logo dark" height="17">
                                <img src="{{ URL::asset('assets/images/oms-logo.png') }}"
                                    class="card-logo card-logo-light" alt="logo light" height="17">
                                <div class="mt-sm-5 mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                    <p class="text-muted mb-1" id="address-details">Al Oufouk , UAE</p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Post-code:</span>4936</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                <h6><span class="text-muted fw-normal">Legal
                                        Registration No:</span>
                                    <span id="legal-register-no">987654</span>
                                </h6>
                                <h6><span class="text-muted fw-normal">Email:</span>
                                    <span id="email">aloufouk@test.com</span>
                                </h6>
                                <h6><span class="text-muted fw-normal">Website:</span> <a href="#"
                                        class="link-primary" target="_blank" id="website">www.website.com</a></h6>
                                <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span
                                        id="contact-no">+971 6 5341222</span></h6>
                            </div>
                        </div>
                    </div>
                    <!--end card-header-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                <h5 class="fs-14 mb-0">#VL<span id="invoice-no">25000355</span></h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ date('d-m-Y') }}</span>
                                    {{-- <small class="text-muted" id="invoice-time">02:36PM</small> --}}
                                </h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                <span class="badge bg-success-subtle text-success fs-11" id="payment-status">Paid</span>
                            </div>
                            <!--end col-->
                            <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                <h5 class="fs-14 mb-0"><span id="total-amount">{{ $billingInfo['Amount'] }}</span></h5>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top-dashed">
                        <div class="row g-3">
                            <div class="col-6">
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
                                {{-- <p class="text-muted mb-0"><span>Tax: </span><span id="billing-tax-no">12-3456789</span></p> --}}
                            </div>
                            <!--end col-->
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Shipping Address</h6>
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
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
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
                                            <td class="text-end">{{ $product->price_incl_tax ?? '' }}</td>
                                        </tr>
                                        @php
                                            $subTotal += (float) $product->price;
                                            $subTotalWithTax += (float) $product->price_incl_tax;
                                            $discount += (float) $product->discount_amount;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        <div class="border-top border-top-dashed mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                style="width:250px">
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
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Total Amount</th>
                                        <th class="text-end">{{ $subTotalWithTax - $discount }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            </table>
                            <!--end table-->
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
                            <p class="text-muted">Total Amount:
                                <span id="card-total-amount">{{ $subTotalWithTax - $discount }}</span>
                            </p>
                        </div>
                        {{-- <div class="mt-4">
                            <div class="alert alert-info">
                                <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                    <span id="note">All accounts are to be paid within 7 days from receipt of
                                        invoice. To be paid by cheque or
                                        credit card or direct payment online. If account is not paid within 7
                                        days the credits details supplied as confirmation of work undertaken
                                        will be charged the agreed quoted fee noted above.
                                    </span>
                                </p>
                            </div>
                        </div> --}}
                        {{-- <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <a href="{{ url('order/order-invoice-pdf', ['order_id' => $order->order_id]) }}"
                                targsdet="_blank" class="btn btn-success" onclick="LoaderBtn(this);">
                                <i class="ri-printer-line align-bottom me-1 my-1"></i>
                                Print
                            </a>
                            <a href="{{ url('order/order-invoice-pdf-download', ['order_id' => $order->order_id]) }}"
                                class="btn btn-primary" onclick="LoaderBtn(this);">
                                <i class="ri-download-2-line align-bottom me-1 my-1"> </i>
                                Download
                            </a>
                            <a href="{{ url('order/order-invoice-pdf-email', ['order_id' => $order->order_id]) }}}}"
                                class="btn btn-danger"><i class="ri-send-plane-fill align-bottom me-1"
                                    onclick="LoaderBtn(this);"></i>
                                Send Email
                            </a>
                        </div> --}}


                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <a href="{{ url('order/order-invoice-pdf', ['order_id' => $order->order_id]) }}"
                                target="_blank" class="btn btn-success"
                                onclick="LoaderBtn(this, 'ri-printer-line');">
                                <i class="ri-printer-line align-bottom me-1 my-1"></i>
                                Print
                            </a>
                            <a href="{{ url('order/order-invoice-pdf-download', ['order_id' => $order->order_id]) }}"
                                class="btn btn-primary" onclick="LoaderBtn(this, 'ri-download-2-line');">
                                <i class="ri-download-2-line align-bottom me-1 my-1"></i>
                                Download
                            </a>
                            <a href="{{ url('order/order-invoice-pdf-email', ['order_id' => $order->order_id]) }}"
                                class="btn btn-danger" onclick="LoaderBtn(this, 'ri-send-plane-fill',5000);">
                                <i class="ri-send-plane-fill align-bottom me-1 my-1"></i>
                                Send Email
                            </a>
                        </div>


                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>

@push('scripts')
    <script>
        // function LoaderBtn(button, delay = 1000) {
        //     const icon = button.querySelector('i');

        //     // Toggle icon to spinner
        //     icon.classList.toggle('fa');
        //     icon.classList.toggle('fa-spinner');
        //     icon.classList.toggle('fa-spin');
        //     icon.classList.toggle('ri-printer-line');

        //     // Set timeout to reset the icon after the specified delay
        //     setTimeout(() => {
        //         icon.classList.toggle('fa');
        //         icon.classList.toggle('fa-spinner');
        //         icon.classList.toggle('fa-spin');
        //         icon.classList.toggle('ri-printer-line');
        //     }, delay);
        // }

        function LoaderBtn(button, iconClass, delay = 1000) {
            const icon = button.querySelector('i');

            // Remove the original icon and add the spinner
            icon.classList.remove(iconClass);
            icon.classList.add('fa', 'fa-spinner', 'fa-spin');

            // Set timeout to reset the icon after the specified delay
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
</style>
