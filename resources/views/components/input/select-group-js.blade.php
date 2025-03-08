@props([
    'name',
    'id',
    'label' => '',
    'class' => '',
    'value' => '',
    'required' => false,
    'items' => [],
    'itemText' => '',
    'itemValue' => '',
    'textJoin' => '',
    'placeholder' => 'Select',
    'search' => false,
])

@php
    $className = 'form-control select2 w-50 ' . $class;
    $idName = $id ?? $name;
    $isRequired = $required ? 'required' : '';
@endphp

@if (isset($label) && $label != '')
    <label for="{{ $name }}" id="lbl-{{ $name }}" class="form-label">
        {{ $label }}
    </label>
@endif
<select id="{{ $idName }}" name="{{ $name }}" data-choices-search-false {{ $attributes }}>
    <option value="">-- {{ $placeholder }} --</option>
    @foreach ($items as $item)
        <option value="{{ $item[$itemValue] }}">
            {{ $item[$itemText] }}
        </option>
    @endforeach
</select>

@push('scripts')
    <script>
        (function() {
            const idName = '{{ $idName }}'; // Unique ID for this instance
            const searchEnabled = {{ $search ? 'true' : 'false' }}; // Convert PHP boolean to JS boolean

            // Initialize Choices instance for this select
            const selectElement = document.getElementById(idName);
            const choicesInstance = new Choices(selectElement, {
                searchEnabled: searchEnabled
            });

            // Optionally, expose a function to update selected value
            window[`updateSelectedValue_${idName}`] = function(value) {
                choicesInstance.setChoiceByValue(value.toString());
            };
        })();
    </script>
@endpush


@push('styles')
    <style>
        table.dataTable tr {
            border: 2px solid #dbdade;
        }

        table.dataTable {
            border-top: 1px solid #dbdade;
            border-right: 1px solid #dbdade;
            border-left: 1px solid #dbdade;
        }

        /* Style for the file input container */
        .file-input-container {
            position: relative;
            width: 200px;
            height: 100px;
            overflow: hidden;
            background-color: white;
            color: black;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the actual file input (opacity set to 0 to make it invisible) */
        .file-input-container input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        /* Style for the text inside the file input container */
        .file-input-text {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        /* Style for the preview image */
        #preview {
            display: none;
            /* max-width: 100%; */
            /* height: auto; */
            border-radius: 5px;
            width: 100px;
            height: 50px;
        }

        .dropzone {
            min-height: 120px !important;
        }
    </style>
@endpush
