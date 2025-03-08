@props([
    'title' => 'Order Information',
    'order' => $order,
])
<div class="card mt-n4 mx-n4 mb-3">
    <div class="bg-warning-subtle">
        <div class="card-body pb-0 px-4">
            <div class="row mb-1">
                <div class="col-md">
                    <div class="row align-items-center g-3">
                        <div class="col-2 col-md-1">
                            <div class="profile-user position-relative d-inline-block mt-1 mb-0">
                                @php
                                    $headerImg =
                                        'https://img.freepik.com/free-vector/messenger-concept-illustration_114360-1394.jpg?t=st=1721822981~exp=1721826581~hmac=e63fb6f1ff38c21740ca325d5625c71764a82d2bde33a4088f9f2ce78f771845&w=740';

                                    $headerImg1 =
                                        'https://img.freepik.com/free-vector/delivery-service-with-masks-concept_23-2148498491.jpg?t=st=1721822171~exp=1721825771~hmac=f94d2443bf60ea318a77dff0733f6a9faf9dd5a87e0e4b2387cd337b39d6830b&w=1060';
                                @endphp
                                <img src="{{ $headerImg }}" class="rounded-circle avatar-md  user-profile-image"
                                    alt="user-profile-image">
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div>
                                <h4 class="fw-bold mb-0">{{ $title }}</h4>
                                <div class="hstack gap-3 flex-wrap">
                                    <div><i class=" ri-shopping-bag-3-fill align-bottom me-1"></i>
                                        <b> #{{ $order->order_id ?? '' }}</b>
                                    </div>
                                    <div class="vr"></div>

                                    <div>Order Date :
                                        <span class="fw-medium">{{ displayDateFormat($order->order_date) ?? '' }}</span>
                                    </div>
                                    <div class="vr"></div>

                                    <div>Update Date :
                                        <span class="fw-medium">{{ displayDateFormat($order->update_date) ?? '' }}
                                        </span>
                                    </div>
                                    <div class="vr"></div>

                                    <div class="badge bg-info py-2 fs-12">
                                        {{ ucfirst($order->order_type) ?? '' }}
                                    </div>

                                    <div class="badge bg-success py-2 fs-12">
                                        {{ confirmedOrderStatus($order->is_shipped) }}
                                    </div>

                                    @php
                                        $orderIsPickuped = $order->is_pickuped;
                                    @endphp
                                    @if ($order->is_delivered)
                                        <div
                                            class="py-0 mx-0 ps-0 fs-12 badge  {{ $orderIsPickuped ? 'disabled' : 'bg-warning' }}">
                                            <a href="{{ $orderIsPickuped ? '#' : url('order/return-order', ['orderid' => $order->order_id]) }}"
                                                title="Shipment Label"
                                                class="cusa {{ $orderIsPickuped ? 'disabled' : '' }}"
                                                onclick="
                                                    {{ $orderIsPickuped ? 'event.preventDefault();' : '' }}
                                                    console.log('Button clicked');
                                                    document.querySelector('#pickup-loader').classList.remove('d-none');"
                                                style="display: flex; align-items: center;">
                                                <i class="ri-arrow-go-back-fill align-bottom mx-0 px-0 ps-1 text-white"
                                                    style="font-size: 15px;"></i>
                                                <label class="text-white align-bottom pt-1"
                                                    style="cursor:pointer;margin-left: 5px;margin-top: 5px;">
                                                    {{ $orderIsPickuped ? 'Already Return Requested' : 'Create Return Request' }}
                                                </label>
                                            </a>
                                        </div>
                                    @endif

                                    {{-- <a href="{{ $orderIsShipped ? '#' : url('order/shipping/export-single-order', $order->order_id) }}"
                                            id="btn-export"
                                            class="btn btn-success custom-toggle btn-label {{ $orderIsShipped ? 'disabled' : '' }}"
                                            data-bs-toggle="submit"
                                            onclick="
                                            {{ $orderIsShipped ? 'event.preventDefault();' : '' }}
                                            console.log('Button clicked');
                                            const button = this;
                                            button.querySelector('i').classList.add('fa-spin');
                                            document.querySelector('#render-loader').classList.remove('d-none');
                                            // setTimeout(() => { window.location.href = '{{ url('order/shipping/export-single-order', $order->order_id) }}'; }, 500);">
                                            <span class="icon-on">
                                                <i class="fas fa-upload align-bottom me-1 mb-1 align-bottom me-1 label-icon"></i>
                                                {{ $orderIsShipped ? 'Already Confirmed' : 'Confirm Order' }}
                                            </span>
                                        </a> --}}

                                    @if (count((array) $order->tracking) > 0)
                                        <div class="py-0 mx-0 ps-0 fs-12 badge bg-danger">
                                            <a href="{{ $order->tracking->shipment_label_url ?? '---' }}"
                                                target="_blank" title="Shipment Label" class="mx-0 px-0">
                                                <i class=" ri-file-pdf-2-fill align-bottom mx-0 px-0 text-white"
                                                    style="font-size:28px"></i>
                                                <label class="text-white" style="cursor:pointer"> Shipment Label</label>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 text-end">
                            <a href="javascript:void(0);" onclick="window.history.back();"
                                class="btn bg-primary-subtle position-relative p-0 avatar-xs rounded-circle">
                                <span class="avatar-title bg-transparent text-reset">
                                    <i class="ri-close-line" style="font-size:25px;color:#f55a5e"></i>
                                    {{-- <i class="ri-arrow-right-circle-fill" style="font-size:20px"></i> --}}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex profile-wrapper">
                @php
                    $tabs = collect([
                        ['id' => 'project-overview', 'name' => 'Overview'],
                        ['id' => 'order-products', 'name' => 'Products'],
                        ['id' => 'order-accounts', 'name' => 'Account'],
                    ]);

                    if (count((array) $order->tracking) > 0) {
                        $tabs->push(['id' => 'order-tracking', 'name' => 'Tracking']);
                    }

                    if (count((array) $order->orderReturn) > 0) {
                        $tabs->push(['id' => 'order-return', 'name' => 'Pickup']);
                    }

                    $tabs->push(['id' => 'order-invoice', 'name' => 'Invoice']);
                @endphp

                <ul class="nav nav-tabs-custom border-bottom-0 flex-grow-1" role="tablist" id="order-tabs">
                    @foreach ($tabs as $tab)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-semibold mt-2 {{ $loop->first ? 'active' : '' }}"
                                data-bs-toggle="tab" href="#{{ $tab['id'] }}" role="tab"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                tabindex="{{ $loop->first ? '0' : '-1' }}">
                                {{ $tab['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                @php
                    $orderIsShipped = $order->is_shipped;
                @endphp

                {{-- @if ($orderIsConfirmed)
                    <form action="{{ route('pickup.store') }}" id="create-pickup-form" method="POST">
                        @csrf
                        <div class="d-flex flex-shrink-0 my-1">
                            <div class="d-flex align-items-center gap-2 me-2">
                                <span class="text-muted flex-shrink-0">Location: </span>
                                <select class="form-control mb-0" data-choices data-choices-search-false
                                    name="shipper_location" id="choices-order_status_filter">
                                    <option selected value="sharjah">Sharjah</option>
                                    <option value="abudhabi">Abudhabi</option>
                                </select>
                            </div>
                            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                            <button type="submit" id="btn-pickup" class="btn btn-success custom-toggle btn-label me-2">
                                <span class="icon-on">
                                    <i class="fas fa-upload align-bottom me-1 mb-1 align-bottom me-1 label-icon"></i>
                                    Create Pickup
                                </span>
                            </button>
                        </div>
                    </form>
                @else --}}

                {{-- export button --}}
                @if (auth()->user()->is_create_ship_allow || can('super-admin'))
                    <div class="flex-shrink-0 my-1">
                        <a href="{{ $orderIsShipped ? '#' : url('order/shipping/export-single-order', $order->order_id) }}"
                            id="btn-export"
                            class="btn btn-success custom-toggle btn-label {{ $orderIsShipped ? 'disabled' : '' }}"
                            data-bs-toggle="submit"
                            onclick="
                        {{ $orderIsShipped ? 'event.preventDefault();' : '' }}
                        console.log('Button clicked');
                        const button = this;
                        button.querySelector('i').classList.add('fa-spin');
                        document.querySelector('#render-loader').classList.remove('d-none');
                        // setTimeout(() => { window.location.href = '{{ url('order/shipping/export-single-order', $order->order_id) }}'; }, 500);">
                            <span class="icon-on">
                                <i class="fas fa-upload align-bottom me-1 mb-1 align-bottom me-1 label-icon"></i>
                                {{ $orderIsShipped ? 'Already Confirmed' : 'Confirm Order' }}
                            </span>
                        </a>
                    </div>
                @endif

                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $('#create-pickup-form').submit(function(e) {

            const exportLink = document.getElementById('btn-pickup');
            if (exportLink) {
                const originalContent = exportLink.innerHTML;

                exportLink.innerHTML = `
                    <span class="d-flex align-items-center loader-area">
                        <span class="spinner-border flex-shrink-0" role="status" style="width:1rem;height:1rem">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                        <span class="flex-grow-1 ms-2">
                            Loading...
                        </span>
                    </span>
                `;

                const url = exportLink.getAttribute('href');
            }
        });



        document.addEventListener('DOMContentLoaded', function() {
            const exportLink = document.getElementById('btn-export');
            if (exportLink) {
                // Store the original button HTML
                const originalContent = exportLink.innerHTML;

                exportLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    exportLink.innerHTML = `
                 <span class="d-flex align-items-center loader-area">
                                <span class="spinner-border flex-shrink-0" role="status"
                                    style="width:1rem;height:1rem">
                                    <span class="visually-hidden">Loading...</span>
                                </span>
                                <span class="flex-grow-1 ms-2">
                                    Loading...
                                </span>
                            </span>
                `;

                    const url = exportLink.getAttribute('href');
                    // setTimeout(function() {
                    window.location.href = url;
                    // }, 100);
                });

                // window.addEventListener('load', function() {
                //     exportLink.innerHTML = originalContent;
                // });
            }
        });
    </script>
@endpush


<style>
    .choices__list--dropdown {
        width: 100% !important;
    }

    .badge.disabled {
        pointer-events: none;
        background-color: rgb(247 184 75 / 55%) !important;
        border-color: rgb(247 184 75 / 55%) !important;
        opacity: var(--vz-btn-disabled-opacity);
    }
</style>
