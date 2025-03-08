<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
    'id' => null,
    'extraAttr' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
    'id' => null,
    'extraAttr' => '',
]); ?>
<?php foreach (array_filter(([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
    'id' => null,
    'extraAttr' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $className = 'form-control';
    $id = isset($id) ? $id : $name;
?>

<div class="form-group">

    <?php if(isset($label) && $label != ''): ?>
        <label for="<?php echo e($id); ?>" class="form-label">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-danger mt-2">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <input type="<?php echo e($type); ?>" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>"
        <?php echo e($attributes->merge(['class' => $className])); ?> placeholder="<?php echo e($placeholder); ?>"
        <?php if($required): ?> required <?php endif; ?> autocomplete="off" />
    <div class="invalid-feedback d-block invalid-msg"> </div>
</div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/input/txt-group.blade.php ENDPATH**/ ?>