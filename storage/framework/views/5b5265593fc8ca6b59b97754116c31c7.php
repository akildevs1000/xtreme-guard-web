<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
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
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
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
]); ?>
<?php foreach (array_filter(([
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
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $className = 'form-control select2 w-50 ' . $class;
    $idName = $id ?? $name;
    $isRequired = $required ? 'required' : '';
?>

<?php if(isset($label) && $label != ''): ?>
    <label for="<?php echo e($name); ?>" id="lbl-<?php echo e($name); ?>" class="form-label">
        <?php echo e($label); ?>

    </label>
<?php endif; ?>
<select id="<?php echo e($idName); ?>" name="<?php echo e($name); ?>" data-choices-search-false <?php echo e($attributes); ?>>
    <option value="">-- <?php echo e($placeholder); ?> --</option>
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($item[$itemValue]); ?>">
            <?php echo e($item[$itemText]); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function() {
            const idName = '<?php echo e($idName); ?>'; // Unique ID for this instance
            const searchEnabled = <?php echo e($search ? 'true' : 'false'); ?>; // Convert PHP boolean to JS boolean

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
<?php $__env->stopPush(); ?>


<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/input/select-group-js.blade.php ENDPATH**/ ?>