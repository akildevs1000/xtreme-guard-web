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
<div class="form-group">
    <?php if(isset($label) && $label != ''): ?>
        <label for="<?php echo e($name); ?>" id='<?php echo e("lbl-$name"); ?>' for="<?php echo e($name); ?>" class="form-label">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>

    <select class="form-select" id="<?php echo e($idName); ?>" name="<?php echo e($name); ?>" data-choices <?php echo e($attributes); ?>>
        <option value="">-- Select --</option>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($item[$itemValue]); ?>" <?php if($item[$itemValue] == $value): ?> selected <?php endif; ?>>
                <?php if(isset($item[$textJoin])): ?>
                    <?php echo e($item[$textJoin]); ?> -
                <?php endif; ?>
                <?php echo e($item[$itemText]); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <div class="invalid-feedback d-block invalid-msg"> </div>
</div>


<style>
    .choices {
        margin-bottom: 0px !important;
    }
</style>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/input/select-group.blade.php ENDPATH**/ ?>