<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'funName' => 'CategoryModal',
    'color' => 'warning',
    'users' => [
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-1.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-2.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-3.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-4.jpg'],
    ],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'funName' => 'CategoryModal',
    'color' => 'warning',
    'users' => [
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-1.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-2.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-3.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-4.jpg'],
    ],
]); ?>
<?php foreach (array_filter(([
    'funName' => 'CategoryModal',
    'color' => 'warning',
    'users' => [
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-1.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-2.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-3.jpg'],
        ['name' => 'fahath', 'img' => 'assets/images/users/avatar-4.jpg'],
    ],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<div class="card profile-project-card shadow-none profile-project-<?php echo e($color ?? ''); ?>">
    <div class="card-body p-4">
        <div class="d-flex">
            <div class="flex-grow-1 text-muted overflow-hidden">
                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Whats yours next Category!</a>
                </h5>
                <p class="text-muted text-truncate mb-0">Add Category, if it doesn't exist. </p>
            </div>

        </div>

        <div class="d-flex mt-2">
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 justify-content-end">
                    
                    <div class="avatar-group text-end">
                        <div class="flex-shrink-0 ms-2">
                            

                            

                            <button class="btn btn-primary add-btn"
                                onclick="<?php echo e($funName); ?>(<?php echo e(false); ?>)"><i
                                    class="ri-add-line align-bottom me-1"></i>
                                Add Apartment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card body -->
</div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/card/card-add-category.blade.php ENDPATH**/ ?>