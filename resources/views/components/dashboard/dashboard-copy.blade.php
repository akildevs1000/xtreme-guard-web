@props([
    'data' => $data,
    'orders' => $orders,
])

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-2 col-md-3">
                <div class="card card-height-100">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Order Summary</h4>
                        {{-- <div>
                            <div class="dropdown">
                                <button class="btn btn-soft-primary btn-sm" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="text-uppercase">Btc<i
                                            class="mdi mdi-chevron-down align-middle ms-1"></i></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">BTC</a>
                                    <a class="dropdown-item" href="#">USD</a>
                                    <a class="dropdown-item" href="#">Euro</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div id="order_summary_chart"
                            data-colors='["--vz-primary", "--vz-info", "--vz-warning", "--vz-success"]'
                            class="apex-charts" dir="ltr">
                        </div>

                        @php
                            $chartData = (array) $data;
                            $orderSummary = [
                                [
                                    'name' => 'Total Order',
                                    'symbol' => 'TO',
                                    'amount' => $data->total_count,
                                    'value' => $data->total_count,
                                    'icon' => 'btc.svg',
                                    'text_class' => 'text-successs',
                                ],
                                [
                                    'name' => 'Confirmed Orders',
                                    'symbol' => 'ETH',
                                    'amount' => $data->confirmed_count,
                                    'value' => $data->confirmed_count,
                                    'icon' => 'eth.svg',
                                    'text_class' => 'text-danger',
                                ],
                                [
                                    'name' => 'Delivery Orders',
                                    'symbol' => 'LTC',
                                    'amount' => 0,
                                    'value' => 0,
                                    'icon' => 'ltc.svg',
                                    'text_class' => 'text-success',
                                ],
                                [
                                    'name' => 'Cancelled Orders',
                                    'symbol' => 'DASH',
                                    'amount' => 0,
                                    'value' => 0,
                                    'icon' => 'dash.svg',
                                    'text_class' => 'text-success',
                                ],
                                [
                                    'name' => 'Return Orders',
                                    'symbol' => 'DASH',
                                    'amount' => 0,
                                    'value' => 0,
                                    'icon' => 'dash.svg',
                                    'text_class' => 'text-success',
                                ],
                            ];
                        @endphp
                        <ul class="list-group list-group-flush border-dashed mb-0 mt-3 pt-2">
                            @foreach ($orderSummary as $item)
                                <li class="list-group-item px-0">
                                    <div class="d-flex">
                                        {{-- <div class="flex-shrink-0 avatar-xs">
                                            <span class="avatar-title bg-light p-1 rounded-circle">
                                                <img src="{{ URL::asset('assets/images/svg/crypto-icons/' . $item['icon']) }}"
                                                    class="img-fluid" alt="{{ $item['name'] }}">
                                            </span>
                                        </div> --}}
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1">
                                                @if ($loop->first)
                                                    {{ $item['name'] }}
                                                @else
                                                    <i
                                                        class="mdi mdi-circle fs-10 align-middle {{ $item['text_class'] }} me-1"></i>
                                                    {{ $item['name'] }}
                                                @endif
                                            </h6>

                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">
                                                {{ $item['amount'] }}</h6>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xxl-10 col-md-9 order-xxl-0s order-firsts">
                <div class="d-flex flex-column h-100">
                    <div class="h-100 row">
                        <div class="col">
                            <div class="h-100 swiper">

                                @php
                                    $data = [
                                        [
                                            'title' => 'Total Orders',
                                            'value' => $data->total_count,
                                            'percentage' => '+100 %',
                                            'icon' => 'bx-dollar-circle',
                                            'bgClass' => 'bg-success-subtle',
                                            'link' => 'View net earnings',
                                            'trend' => 'success',
                                        ],
                                        [
                                            'title' => 'Confirmed Orders',
                                            'value' => $data->confirmed_count,
                                            'percentage' => '+100 %',
                                            'icon' => 'bx-shopping-bag',
                                            'bgClass' => 'bg-info-subtle',
                                            'link' => 'View all orders',
                                            'trend' => 'success',
                                        ],
                                        [
                                            'title' => 'Delivery Orders',
                                            'value' => '3',
                                            'percentage' => '+29.08 %',
                                            'icon' => 'bx-user-circle',
                                            'bgClass' => 'bg-warning-subtle',
                                            'link' => 'See details',
                                            'trend' => 'success',
                                        ],
                                        [
                                            'title' => 'Cancelled Orders',
                                            'value' => '3',
                                            'percentage' => '+0.00 %',
                                            'icon' => 'bx-wallet',
                                            'bgClass' => 'bg-primary-subtle',
                                            'link' => 'Withdraw money',
                                            'trend' => 'muted',
                                        ],
                                        [
                                            'title' => 'Return Orders',
                                            'value' => '3',
                                            'percentage' => '+0.00 %',
                                            'icon' => 'bx-wallet',
                                            'bgClass' => 'bg-primary-subtle',
                                            'link' => 'Withdraw money',
                                            'trend' => 'muted',
                                        ],
                                    ];
                                @endphp
                                <div class="swiper marketplace-swiper rounded gallery-light">
                                    {{-- <div class="d-flex pt-2 pb-4">
                                        <h5 class="card-title fs-15 mb-1">Featured NFTs Artworks</h5>
                                    </div> --}}
                                    <div class="swiper-wrapper mt-0">
                                        {{-- <div class="row"> --}}
                                        @foreach ($data as $item)
                                            {{-- <div class="col-xl-3 col-md-6"> --}}
                                            <div class="swiper-slide">
                                                <div class="card card-animate mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p
                                                                    class="text-uppercase fw-medium text-muted text-truncate mb-0 fs-11">
                                                                    {{ $item['title'] }}
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <h5
                                                                    class="{{ $item['trend'] === 'danger' ? 'text-danger' : 'text-success' }} fs-14 mb-0">
                                                                    <i
                                                                        class="{{ $item['trend'] === 'danger' ? 'ri-arrow-right-down-line' : 'ri-arrow-right-up-line' }} fs-13 align-middle"></i>
                                                                    {{ $item['percentage'] }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-end justify-content-between mt-4">
                                                            <div>
                                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $item['value'] }}">
                                                                        {{ 0 }}
                                                                    </span>
                                                                </h4>
                                                                {{-- <a href="#" class="text-decoration-underline">
                                                                        {{ $item['link'] }}
                                                                    </a> --}}
                                                            </div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title {{ $item['bgClass'] }} rounded fs-3">
                                                                    <i
                                                                        class="bx {{ $item['icon'] }} text-{{ $item['trend'] }}"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- </div> --}}
                                        @endforeach
                                        {{-- </div> --}}
                                    </div>
                                    {{-- <div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header my-1 border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">New Orders</h4>
                                    <div>
                                        <a href="{{ url('order/order') }}" class="btn btn-soft-secondary btn-sm">
                                            View All
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body p-0 pb-3">
                                    <div class="team-list list-view-filter">
                                        <div class="team-list list-view-filter">
                                            @foreach ($orders as $order)
                                                <div class="card team-box">
                                                    <div class="card-body px-4 py-1">
                                                        <div class="row align-items-center team-row">
                                                            <div class="col team-settings">
                                                                <div class="row align-items-center">
                                                                    <div class="col text-end dropdown">
                                                                        <a href="javascript:void(0);"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="ri-more-fill fs-17"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('order.show', ['order' => $order->id]) }}">
                                                                                    <i
                                                                                        class="ri-eye-fill text-muted me-2 align-bottom"></i>
                                                                                    View
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col">
                                                                <div class="team-profile-img">
                                                                    <div class="avatar-sm img-thumbnail rounded-circle">
                                                                        <div
                                                                            class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                                            {{ Str::upper(substr($order->customer->full_name, 0, 2)) }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="team-content">
                                                                        <a href="#" class="d-block">
                                                                            <h5 class="mb-1 fs-12">Order Id</h5>
                                                                        </a>
                                                                        <p class="text-muted mb-0 fs-12">
                                                                            {{ $order->order_id }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col">
                                                                <div class="row text-muted text-center">
                                                                    <div class="col-6 border-end border-end-dashed">
                                                                        <h5 class="mb-1 fs-12">Customer Name</h5>
                                                                        <p class="text-muted mb-0 fs-12">
                                                                            {{ $order->customer->full_name }}</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5 class="mb-1 fs-12">Location</h5>
                                                                        <p class="text-muted mb-0">
                                                                            {{ $order->shipping->address['city'] }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col">
                                                                <div class="row text-muted text-center">
                                                                    <div class="col-6 border-end border-end-dashed">
                                                                        <h5 class="mb-1 fs-12">Status</h5>
                                                                        <p class="badge bg-info py-1 fs-10">
                                                                            {{ ucwords(str_replace('_', ' ', $order->order_status)) }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h5 class="mb-1 fs-12">Type</h5>
                                                                        <p class="badge bg-success py-1 fs-10">
                                                                            {{ $order->order_type }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    {{-- <script src="{{ asset('assets/js/pages/dashboard-crypto.init.js') }}"></script> --}}

    <script src="{{ asset('assets/js/pages/dashboard-nft.init.js') }}"></script>


    <script>
        var swiper = new Swiper('.marketplace-swiper', {
            slidesPerView: 4, // Show 4 slides at a time
            spaceBetween: 10, // Adjust the space between slides
            // loop: true, // Enable looping
            loopFillGroupWithBlank: true, // Fill empty spaces with blank slides
            slidesPerGroup: 4, // Move 4 slides at a time (optional, depends on your needs)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
            },
            allowSlideNext: true,

            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 3,
                    spaceBetween: 40
                },
                // when window width is >= 992px
                992: {
                    slidesPerView: 4,
                    spaceBetween: 40
                }
            }
        });

        orderSummaryChart();

        function getChartColorsArray(e) {
            if (null !== document.getElementById(e)) {
                var t = document.getElementById(e).getAttribute("data-colors");
                if (t) return (t = JSON.parse(t)).map(function(e) {
                    var t = e.replace(" ", "");
                    return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(
                        t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document
                        .documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
                });
                console.warn("data-colors Attribute not found on:", e)
            }
        }

        function orderSummaryChart() {
            let arrValue = [
                // {{ $chartData['total_count'] }},
                {{ $chartData['confirmed_count'] }},
                3
            ]
            console.log(arrValue);


            var options = {
                series: arrValue,
                chart: {
                    width: 300,
                    type: 'pie',
                },
                labels: ['Confirmed Order', 'Delivery Order'],
                colors: [
                    '#F06548',
                    '#0AB39C'
                ],
                legend: {
                    show: false // Disable the legend
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200,
                        },
                        dataLabels: {
                            formatter(val, opts) {
                                const name = opts.w.globals.labels[opts.seriesIndex]
                                return [name, val.toFixed(1) + '%']
                            },
                        },
                        legend: {
                            show: false // Ensure the legend is hidden on smaller screens
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#order_summary_chart"), options);
            chart.render();



        }
    </script>
@endpush
