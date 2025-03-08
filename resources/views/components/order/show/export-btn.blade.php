@props([
    'order' => $order,
])

@php
    $orderIsShipped = $order->is_shipped;
@endphp

@if (auth()->user()->is_create_ship_allow || can('super-admin'))
    <div {{ $attributes->merge(['class' => 'flex-shrink-0 my-1']) }}>
        <a href="{{ $orderIsShipped ? '#' : url('order/shipping/export-single-order', $order->order_id) }}"
            id="btn-export" class="btn btn-success custom-toggle btn-label {{ $orderIsShipped ? 'disabled' : '' }}"
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
