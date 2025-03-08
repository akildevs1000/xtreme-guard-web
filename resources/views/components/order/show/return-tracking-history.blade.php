@props([
    'returnOrderTrackingHistory' => $returnOrderTrackingHistory,
])

{{-- template link --}}
{{-- https://bootsnipp.com/snippets/4Mzzm --}}

<div class="container">
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div id="tracking-pre"></div>
            <div id="tracking">
                <div class="tracking-list">

                    @foreach ($returnOrderTrackingHistory as $item)
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
