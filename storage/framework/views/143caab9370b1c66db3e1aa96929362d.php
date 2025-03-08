<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['isAdd' => false, 'routeName', 'title']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['isAdd' => false, 'routeName', 'title']); ?>
<?php foreach (array_filter((['isAdd' => false, 'routeName', 'title']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $className =
        'btn btn-primary buttons-excel buttons-html5 bg-primary text-white border-primary add-btn waves-effect waves-light';
    $style = session('lang') == 'ar' ? '' : 'margin: 0 2.9px 0px 4px;';

?>
<?php if($isAdd): ?>
    <a <?php echo e($attributes->merge(['class' => $className])); ?> style="<?php echo e($style); ?>" href="<?php echo e(route($routeName)); ?>"
        title="Add <?php echo e($title); ?>">
        <i class="fas fa-plus-circle fa-lg" style="font-size: 12px;"></i>
    </a>
<?php endif; ?>




<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/btn/add-btn.blade.php ENDPATH**/ ?>