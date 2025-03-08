@props([
    'order' => $order,
])

<div>
    @php
        $orderStatuses = [
            // 'new' => 'New',
            'payment_completed' => 'Order Received',
            'confirmed' => 'Confirmed',
            'shipped_to_warehouse' => 'Created Shipment',
            'shipped' => 'Out for delivery',
            'delivered' => 'Delivered',
            'returned' => 'Returned',
        ];

        // Get the keys of the order statuses for easy access
        $statusKeys = array_keys($orderStatuses);
        // Get the index of the current order status
        $currentStatusIndex = array_search($order->order_status, $statusKeys);
    @endphp

    <div class="vertical-navs-step">
        <div class="nav d-flex justify-content-center custom-nav nav-pills" role="tablist" aria-orientation="vertical"
            style="align-items: center;">
            @foreach ($orderStatuses as $key => $status)
                <span style="z-index:10"
                    class="nav-link {{ $currentStatusIndex !== false && array_search($key, $statusKeys) <= $currentStatusIndex ? 'done bg-success-subtle text-success' : 'bg-white' }}">
                    <span class="step-title me-2">
                        <i class="ri-circle-fill step-icon me-2"></i>
                    </span>
                    <span class="fs-12">
                        {{ ucwords(str_replace('_', ' ', $status)) }}
                    </span>
                </span>

                @if ($currentStatusIndex !== false && array_search($key, $statusKeys) < $currentStatusIndex)
                    <i class="ri-arrow-right-s-fill timeline-arrow text-success"></i>
                @elseif ($currentStatusIndex !== false && array_search($key, $statusKeys) === $currentStatusIndex)
                    <i class="ri-arrow-right-s-fill timeline-arrow text-success current-status"></i>
                @else
                    <i class="ri-arrow-right-s-fill timeline-arrow text-muted"></i>
                @endif
            @endforeach
        </div>
    </div>
</div>
