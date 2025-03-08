@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
    'defualt' => date('Y-m-d'),
])

{{-- <div class="form-group">
    <label for="tasksTitle-field" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control"
        placeholder="{{ $placeholder }}" @if ($required) required @endif />
    <div class="invalid-feedback d-block invalid-msg"> </div>
</div> --}}

{{-- {{ dd($defualt) }} --}}

{{-- <input type="text" class="form-control" data-provider="flatpickr" id="{{ $name }}" data-date-format="d M, Y" --}}


<label for="JoiningdatInput" class="form-label">{{ $label }}</label>
<input type="text" class="form-control" data-provider="flatpickr" id="{{ $name }}" data-date-format="Y-m-d"
    name="{{ $name }}" data-deafult-date="{{ $defualt }}" placeholder="{{ $placeholder }}"
    @if ($required) required @endif />
