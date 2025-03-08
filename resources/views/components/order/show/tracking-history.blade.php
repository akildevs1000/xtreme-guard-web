@props([
    'orderTrackingHistory' => $orderTrackingHistory,
])

{{-- @dd($orderTrackingHistory) --}}

{{-- "id" => 181
"order_id" => 1000000109
"tracking_id" => 50363000575
"waybill_number" => "50363000575"
"update_code" => "SH239"
"update_description" => "Shipment charges paid"
"update_date_time" => "/Date(1738346760000+0200)/"
"update_date_time_converted" => "2025-01-31 20:06:00"
"update_location" => "Dubai, United Arab Emirates"
"comments" => ""
"problem_code" => ""
"gross_weight" => "0.10"
"chargeable_weight" => "0.10"
"weight_unit" => "KG"
"created_at" => "2025-02-12 10:13:33"
"updated_at" => "2025-02-12 11:52:56" --}}

{{-- template link --}}
{{-- https://bootsnipp.com/snippets/4Mzzm --}}

<div class="container">
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div id="tracking-pre"></div>
            <div id="tracking">
                <div class="tracking-list">

                    @foreach ($orderTrackingHistory as $item)
                        @php
                            $isLast = $loop->last;
                            $isFirst = $loop->first;
                        @endphp

                        <div class="tracking-item {{ $isLast ? 'last-item' : '' }}" {{--  --}}
                            {{-- style="{{ $loop->last ? $style : '' }}" --}}>
                            <div class="tracking-icon status-intransit">
                                <i class="fas {{ $isLast || $isFirst ? 'fa-truck' : 'fa-check' }}"></i>
                                {{-- <i class="fas fa-circle"></i> --}}
                            </div>
                            <div class="tracking-date">
                                {{ date('M d, Y', strtotime($item['update_date_time_converted'])) }}
                                <span>
                                    {{ date('H:i', strtotime($item['update_date_time_converted'])) }}
                                </span>
                            </div>
                            <div class="tracking-content">
                                {{ $item['update_location'] ?? '' }}
                                <span>
                                    {{ $item['update_description'] ?? '' }}
                                </span>
                                <br>
                                <span style="margin-top: -15px;">
                                    {{ $item['comments'] ?? '' }}
                                </span>
                            </div>
                        </div>
                    @endforeach


                    {{-- <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Aug 10, 2018<span>11:19 AM</span></div>
                        <div class="tracking-content">SHIPMENT DELAYSHIPPER INSTRUCTION TO DESTROY<span>SHENZHEN, CHINA,
                                PEOPLE'S REPUBLIC</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 27, 2018<span>04:08 PM</span></div>
                        <div class="tracking-content">DELIVERY ADVICERequest Instruction from ORIGIN<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 20, 2018<span>05:25 PM</span></div>
                        <div class="tracking-content">Delivery InfoCLOSED-OFFICE/HOUSE CLOSED<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-outfordelivery">
                            <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas"
                                data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
                                </path>
                            </svg>
                            <!-- <i class="fas fa-shipping-fast"></i> -->
                        </div>
                        <div class="tracking-date">Jul 20, 2018<span>08:58 AM</span></div>
                        <div class="tracking-content">Shipment is out for despatch by KLHB023.<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 19, 2018<span>05:42 PM</span></div>
                        <div class="tracking-content">Delivery InfoUNABLE TO ACCESS<span>KUALA LUMPUR (LOGISTICS HUB),
                                MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-outfordelivery">
                            <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas"
                                data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
                                </path>
                            </svg>
                            <!-- <i class="fas fa-shipping-fast"></i> -->
                        </div>
                        <div class="tracking-date">Jul 19, 2018<span>07:36 AM</span></div>
                        <div class="tracking-content">Shipment is out for despatch by KLHB023.<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 17, 2018<span>10:54 AM</span></div>
                        <div class="tracking-content">Delivery InfoCLOSED-OFFICE/HOUSE CLOSED<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-outfordelivery">
                            <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas"
                                data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
                                </path>
                            </svg>
                            <!-- <i class="fas fa-shipping-fast"></i> -->
                        </div>
                        <div class="tracking-date">Jul 17, 2018<span>08:08 AM</span></div>
                        <div class="tracking-content">Shipment is out for despatch by KLHB023.<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 16, 2018<span>12:30 PM</span></div>
                        <div class="tracking-content">SHIPMENT DELAYCONSIGNEE NOT AVAILABLE<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 16, 2018<span>12:06 PM</span></div>
                        <div class="tracking-content">Delivery InfoCLOSED-OFFICE/HOUSE CLOSED<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-outfordelivery">
                            <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas"
                                data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
                                </path>
                            </svg>
                            <!-- <i class="fas fa-shipping-fast"></i> -->
                        </div>
                        <div class="tracking-date">Jul 16, 2018<span>08:32 AM</span></div>
                        <div class="tracking-content">Shipment is out for despatch by KLHB023.<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 14, 2018<span>01:57 PM</span></div>
                        <div class="tracking-content">Delivery InfoMISSED DELIVERY<span>KUALA LUMPUR (LOGISTICS HUB),
                                MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-outfordelivery">
                            <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas"
                                data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z">
                                </path>
                            </svg>
                            <!-- <i class="fas fa-shipping-fast"></i> -->
                        </div>
                        <div class="tracking-date">Jul 14, 2018<span>08:41 AM</span></div>
                        <div class="tracking-content">Shipment is out for despatch by KLHB023.<span>KUALA LUMPUR
                                (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 11, 2018<span>05:22 PM</span></div>
                        <div class="tracking-content">Shipment designated to .<span>KUALA LUMPUR (LOGISTICS HUB),
                                MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 11, 2018<span>10:32 AM</span></div>
                        <div class="tracking-content">Shipment arrived at KUALA LUMPUR (LOGISTICS HUB), MALAYSIA
                            station.<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 10, 2018<span>02:30 PM</span></div>
                        <div class="tracking-content">Custom cleared and arrived at KUALA LUMPUR (LOGISTICS HUB),
                            MALAYSIA station.<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 10, 2018<span>07:30 AM</span></div>
                        <div class="tracking-content">Shipment arrived at airport.<span>KUALA LUMPUR (LOGISTICS HUB),
                                MALAYSIA, MALAYSIA</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 10, 2018<span>03:59 AM</span></div>
                        <div class="tracking-content">Shipment departed to MALAYSIA.<span>HONG KONG, HONGKONG</span>
                        </div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 09, 2018<span>04:03 PM</span></div>
                        <div class="tracking-content">Shipment designated to MALAYSIA.<span>SHENZHEN, CHINA, PEOPLE'S
                                REPUBLIC</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 09, 2018<span>11:04 AM</span></div>
                        <div class="tracking-content">Pickup shipment checked in at SHENZHEN.<span>SHENZHEN, CHINA,
                                PEOPLE'S REPUBLIC</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-intransit">
                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                            </svg>
                            <!-- <i class="fas fa-circle"></i> -->
                        </div>
                        <div class="tracking-date">Jul 09, 2018<span>10:09 AM</span></div>
                        <div class="tracking-content">Shipment info registered at SHENZHEN.<span>SHENZHEN, CHINA,
                                PEOPLE'S REPUBLIC</span></div>
                    </div>
                    <div class="tracking-item">
                        <div class="tracking-icon status-inforeceived">
                            <svg class="svg-inline--fa fa-clipboard-list fa-w-12" aria-hidden="true"
                                data-prefix="fas" data-icon="clipboard-list" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z">
                                </path>
                            </svg>
                            <!-- <i class="fas fa-clipboard-list"></i> -->
                        </div>
                        <div class="tracking-date">Jul 06, 2018<span>02:02 PM</span></div>
                        <div class="tracking-content">Shipment designated to MALAYSIA.<span>HONG KONG, HONGKONG</span>
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tracking-detail {
        padding: 3rem 0
    }

    #tracking {
        margin-bottom: 1rem
    }

    [class*=tracking-status-] p {
        margin: 0;
        font-size: 1.1rem;
        color: #fff;
        text-transform: uppercase;
        text-align: center
    }

    [class*=tracking-status-] {
        padding: 1.6rem 0
    }

    .tracking-status-intransit {
        background-color: #65aee0
    }

    .tracking-status-outfordelivery {
        background-color: #f5a551
    }

    .tracking-status-deliveryoffice {
        background-color: #f7dc6f
    }

    .tracking-status-delivered {
        background-color: #4cbb87
    }

    .tracking-status-attemptfail {
        background-color: #b789c7
    }

    .tracking-status-error,
    .tracking-status-exception {
        background-color: #d26759
    }

    .tracking-status-expired {
        background-color: #616e7d
    }

    .tracking-status-pending {
        background-color: #ccc
    }

    .tracking-status-inforeceived {
        background-color: #214977
    }

    .tracking-list {
        border: 1px solid #e5e5e5;
        border-radius: 17px
    }

    .tracking-item {
        border-left: 0px solid #E3262A;
        /* border-left: 1px solid #e5e5e5; */
        position: relative;
        padding: 1rem 1.5rem .5rem 2.5rem;
        font-size: 12px;
        margin-left: 3rem;
        min-height: 4rem;
    }

    .tracking-item:last-child {
        padding-bottom: 4rem
    }

    .tracking-item .tracking-date {
        margin-bottom: .5rem
    }

    .tracking-item .tracking-date span {
        color: #888;
        font-size: 85%;
        padding-left: .4rem
    }

    .tracking-item .tracking-content {
        padding: .5rem .8rem;
        background-color: #f4f4f4;
        border-radius: .5rem
    }

    .tracking-item .tracking-content span {
        display: block;
        color: #888;
        font-size: 85%
    }

    .tracking-item .tracking-icon {
        /* line-height: 2.6rem;
        position: absolute;
        left: -1.3rem;
        width: 2.6rem;
        height: 2.6rem;
        text-align: center;
        border-radius: 50%;
        font-size: 1.1rem;
        background-color: #fff;
        color: #fff */

        line-height: 2rem;
        position: absolute;
        left: -17px;
        width: 2rem;
        height: 2rem;
        text-align: center;
        border-radius: 50%;
        font-size: 1.1rem;
        background-color: #fff;
        color: #fff;
    }

    .tracking-item .tracking-icon::before {
        content: " ";
        z-index: -1;
        position: absolute;
        height: 300%;
        width: 3px;
        left: 14px;
        background-color: #dc291e;
    }

    /* Skip the style for the last item */
    .tracking-item.last-item .tracking-icon::before {
        content: none;
    }

    .tracking-item .tracking-icon.status-sponsored {
        background-color: #f68
    }

    .tracking-item .tracking-icon.status-delivered {
        background-color: #4cbb87
    }

    .tracking-item .tracking-icon.status-outfordelivery {
        background-color: #f5a551
    }

    .tracking-item .tracking-icon.status-deliveryoffice {
        background-color: #f7dc6f
    }

    .tracking-item .tracking-icon.status-attemptfail {
        background-color: #b789c7
    }

    .tracking-item .tracking-icon.status-exception {
        background-color: #d26759
    }

    .tracking-item .tracking-icon.status-inforeceived {
        background-color: #214977
    }

    .tracking-item .tracking-icon.status-intransit {
        color: #e5e5e5;
        border: 1px solid #E3262A;
        font-size: 0.8rem;
        background: #E3262A;
    }

    @media(max-width:992px) {
        .tracking-item .tracking-icon::before {
            height: 442%;
        }
    }

    @media(min-width:992px) {
        .tracking-item {
            margin-left: 10rem
        }

        .tracking-item .tracking-date {
            position: absolute;
            left: -10rem;
            width: 7.5rem;
            text-align: right
        }

        .tracking-item .tracking-date span {
            display: block
        }

        .tracking-item .tracking-content {
            padding: 0;
            background-color: transparent
        }
    }

    .courier-van {
        font-family: "Font Awesome 5 Free";
        /* Ensure Font Awesome is used */
        font-weight: 900;
        /* Solid weight for the icon */
        font-size: 100px;
        /* Adjust icon size */
        color: #FF6F00;
        /* Orange color for the van */
    }
</style>
