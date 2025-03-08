<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
    'row' => '3',
    'id' => '',
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
    'row' => '3',
    'id' => '',
]); ?>
<?php foreach (array_filter(([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
    'row' => '3',
    'id' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $id = isset($id) ? $id : $name;
?>

<div class="form-group">
    <label for="<?php echo e($id); ?>" class="form-label"><?php echo e($label); ?></label>
    <textarea class="form-control" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" placeholder="<?php echo e($placeholder); ?>"
        <?php if($required): ?> required <?php endif; ?> rows="<?php echo e($row); ?>"> </textarea>
</div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/input/txtarea-group.blade.php ENDPATH**/ ?>