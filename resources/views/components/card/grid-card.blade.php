@props([
    'titleName' => '',
    'height' => '235px',
    // 'class' => '',
    'bodyClass' => '',
])

<div {{ $attributes->merge(['class' => 'card']) }}>
    {{-- <div {{ $attributes->merge(['class' => 'card ' . $class]) }}> --}}
    @if ($titleName)
        <div class="card-header align-items-center d-flex border-bottom-dashed">
            <h4 class="card-title mb-0 flex-grow-1">{{ $titleName ?? '' }}</h4>
        </div>
    @endif


    <div class="card-body {{ $bodyClass }}">
        <div data-simplebar style="{{ $height }}">
            {{ $slot }}
        </div>
    </div>
</div>
