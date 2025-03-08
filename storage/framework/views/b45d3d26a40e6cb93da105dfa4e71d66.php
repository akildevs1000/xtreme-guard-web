<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'categoryId' => '',
    'categoryName' => 'Administrator',

    // 'roleId' => '',
    // 'categoryName' => 'Administrator',

    'numberOfUsers' => '4',
    'color' => 'warning',
    'btnTarget' => 'editRoleModal',
    'funName' => 'editRoleModal',
    'per' => 'editRoleModal',
    'perDelete' => 'editRoleModal',
    'item' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'categoryId' => '',
    'categoryName' => 'Administrator',

    // 'roleId' => '',
    // 'categoryName' => 'Administrator',

    'numberOfUsers' => '4',
    'color' => 'warning',
    'btnTarget' => 'editRoleModal',
    'funName' => 'editRoleModal',
    'per' => 'editRoleModal',
    'perDelete' => 'editRoleModal',
    'item' => [],
]); ?>
<?php foreach (array_filter(([
    'categoryId' => '',
    'categoryName' => 'Administrator',

    // 'roleId' => '',
    // 'categoryName' => 'Administrator',

    'numberOfUsers' => '4',
    'color' => 'warning',
    'btnTarget' => 'editRoleModal',
    'funName' => 'editRoleModal',
    'per' => 'editRoleModal',
    'perDelete' => 'editRoleModal',
    'item' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $totalUsers = count($item?->users ?? []);
    $moreUsers = $totalUsers > 4 ? $totalUsers - 4 : 0;
?>
<div class="card  my-1 profile-project-card shadow-none profile-project-<?php echo e($color ?? ''); ?>">
    <div class="card-body p-4">
        <div class="d-flex">
            <div class="flex-grow-1 text-muted overflow-hidden">
                <h5 class="fs-14 text-truncate"><a href="#" class="text-body"><?php echo e($categoryName ?? ''); ?></a>
                </h5>
                <p class="text-muted text-truncate mb-0">Total <?php echo e($totalUsers ?? ''); ?> user(s) </p>
            </div>
            <div class="flex-shrink-0 ms-2">
                <?php if (\Illuminate\Support\Facades\Blade::check('canOrRole', $per)): ?>
                <a href="#" data-bs-toggle="modal" data-bs-target="#<?php echo e($btnTarget); ?>" type="button"
                    onclick="<?php echo e($funName); ?>('<?php echo e($categoryId); ?>', <?php echo e(Js::from($item)); ?>)" class="me-2">
                    <i class="ri-pencil-line"></i>
                </a>
                <?php endif; ?>

                
                <a href="#" delete-url="<?php echo e(url('category')); ?>" delete-item="<?php echo e($categoryName); ?>"
                    class="delete link-danger" id="<?php echo e($categoryId); ?>" title="Delete">
                    <i class="ri-delete-bin-5-line"></i>
                </a>
                
            </div>
        </div>

        <div class="d-flex mt-2">
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 justify-content-end">
                    <div>
                        
                    </div>
                    <div class="avatar-group text-end">
                        <?php $__currentLoopData = [1, 2, 4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="avatar-group-item">
                                <div class="avatar-xs" title="<?php echo e($user['first_name'] ?? ''); ?>">
                                    
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="avatar-group-item">
                            <div class="avatar-xs">
                                <div class="avatar-title rounded-circle bg-light text-primary">
                                    +<?php echo e(abs($moreUsers) ?? ''); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card body -->
</div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/card/card-category.blade.php ENDPATH**/ ?>