@props([
    'order' => $order,
])

{{-- @dd($order) --}}

<div>
    @php
        // Define the timeline statuses
        $timeline = [
            [
                'date' => $order->confirmed_date ?? '---',
                'status_text' => 'Order Received',
                'status' => 'payment_completed',
            ],
            [
                'date' => $order->confirmed_date ?? '---',
                'status_text' => 'Confirmed',
                'status' => 'confirmed',
            ],
            [
                'date' => $order->shipped_date ?? '---',
                'status_text' => 'Created Shipment',
                'status' => 'shipped_to_warehouse',
            ],
            [
                'date' => $order->out_for_delivery?->updated_at ?? false, // Safe navigation operator
                'status_text' => 'Out for delivery',
                'status' => 'shipped',
            ],
            [
                'date' => $order->delivered_date ?? '---',
                'status_text' => 'Delivered',
                'status' => 'delivered',
            ],
            [
                'date' => '---',
                'status_text' => 'Returned',
                'status' => 'returned',
            ],
        ];

        // Find the index of the current status in the timeline
        // $currentStatusIndex = null;
        // foreach ($timeline as $index => $item) {
        //     echo $item['date'] . '  ' . $item['status'] . '<br>';

        //     if ($item['date']) {
        //         if ($item['status'] === $order->order_status) {
        //             $currentStatusIndex = $index;
        //             break;
        //         }
        //     } else {
        //         $currentStatusIndex = $index;
        //         break;
        //     }
        // }

        $currentStatusIndex = null;
        foreach ($timeline as $index => $item) {
            // echo $item['date'] . '  ' . $item['status'] . '  ' . $order->order_status . '<br>';

            if ($item['date'] && $item['status'] === $order->order_status) {
                $currentStatusIndex = $index;
                break;
            }

            // Stop at "shipped_to_warehouse" if "out_for_delivery" is null
            if ($item['status'] === 'shipped_to_warehouse' && !$order->out_for_delivery?->updated_at) {
                $currentStatusIndex = $index;
                break;
            }
        }

        // dd($currentStatusIndex);

    @endphp

    <ul class="timeline ms-0 ps-0" id="timeline">
        @foreach ($timeline as $index => $item)
            <li class="li {{ $index <= $currentStatusIndex ? 'complete' : '' }}">
                <div class="timestamp">
                    {{-- <span class="author">{{ $item['status'] }}</span> --}}
                    <span class="date">{{ $index <= $currentStatusIndex ? $item['date'] : '---' }}</span>
                </div>
                <div class="status">
                    <h4>{{ $item['status_text'] }}</h4>
                </div>
            </li>
        @endforeach
    </ul>

</div>

<script>
    var completes = document.querySelectorAll(".complete");
    var toggleButton = document.getElementById("toggleButton");


    function toggleComplete() {
        var lastComplete = completes[completes.length - 1];
        lastComplete.classList.toggle('complete');
    }

    toggleButton.onclick = toggleComplete;
</script>


<style>
    .timeline {
        list-style-type: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .li {
        transition: all 200ms ease-in;
        width: 135px
    }

    .timestamp {
        margin-bottom: 20px;
        /* padding: 0px 40px; */
        display: flex;
        flex-direction: column;
        align-items: center;
        font-weight: 100;
        font-size: 11px;
        color: #6d7080;
    }

    .status {
        /* padding: 0px 40px; */
        display: flex;
        justify-content: center;
        border-top: 5px solid #D6DCE0;
        position: relative;
        transition: all 200ms ease-in;
    }

    .status h4 {
        font-weight: 600;
        font-size: 12px;
        margin-top: 12px;
        font-family: system-ui;

    }

    .status:before {
        content: "";
        width: 25px;
        height: 25px;
        background-color: white;
        border-radius: 25px;
        border: 1px solid #ddd;
        position: absolute;
        top: -15px;
        left: 42%;
        transition: all 200ms ease-in;

        /* f21c */
        /* f48b */
        /* f00c */
        content: "\f48b";
        /* Font Awesome check icon */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        /* Makes the icon bold */
        font-size: 14px;
        /* Adjust size as needed */
        color: #ffffff;
        /* Green color for success */
        display: flex;
        align-items: center;
        justify-content: center;

        /* animation: blink 1s infinite alternate; */
        /* animation: pulse 1.5s infinite ease-in-out; */

    }

    /* .timeline .li:not(.complete):last-child .status:before { */
    .timeline .li.complete:has(+ .li:not(.complete)) .status:before {
        animation: pulse 1.5s infinite ease-in-out;
    }


    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
            background-color: #0ab39c;
        }

        50% {
            transform: scale(1.2);
            opacity: 1;
            background-color: #0ab39c;
        }

        100% {
            transform: scale(1);
            opacity: 1;
            background-color: #0ab39c;
        }
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.2;
        }

        100% {
            opacity: 1;
        }
    }

    .li.complete .status {
        border-top: 5px solid #f76450;
    }

    .li.complete .status:before {
        background-color: #f76450;
        border: none;
        transition: all 200ms ease-in;
    }

    .li.complete .status h4 {
        color: #7f8385;
        font-family: system-ui;
    }

    @media (max-width: 576px) {
        .timeline {
            position: relative;
            width: 145%;
            max-width: 1400px;
            margin: 0 auto;
        }
    }

    @media (max-width: 443px) {
        .timeline {
            position: relative;
            width: 256%;
            max-width: 1400px;
            margin: 0 auto;
        }
    }

    @media (min-device-width: 320px) and (max-device-width: 700px) {
        /* .timeline {
            list-style-type: none;
            display: block;
        }

        .li {
            transition: all 200ms ease-in;
            display: flex;
            width: inherit;
        }

        .timestamp {
            width: 100px;
        }

        .status:before {
            left: -8%;
            top: 30%;
            transition: all 200ms ease-in;
        } */
    }

    #toggleButton {
        position: absolute;
        left: 50px;
        top: 20px;
        background-color: #75C7F6;
    }
</style>
