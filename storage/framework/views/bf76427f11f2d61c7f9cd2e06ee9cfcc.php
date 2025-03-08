   <?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
       'titleName' => '',
       'idName' => '',
       'size' => 'modal-lg',
   ]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
       'titleName' => '',
       'idName' => '',
       'size' => 'modal-lg',
   ]); ?>
<?php foreach (array_filter(([
       'titleName' => '',
       'idName' => '',
       'size' => 'modal-lg',
   ]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

   <div class="modal fade zoomIn" id="<?php echo e($idName); ?>" tabindex="-1" aria-labelledby="<?php echo e($idName); ?>Label"
       aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered <?php echo e($size); ?>" <?php echo e($attributes->merge()); ?>>
           <div class="modal-content border-0">
               <div class="modal-header p-3 bg-info-subtle">
                   <h5 class="modal-title" id="<?php echo e($idName); ?>Label"><?php echo e($titleName); ?></h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal">
                   </button>
               </div>
               <?php echo e($slot); ?>

           </div>
       </div>
   </div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/modal/common.blade.php ENDPATH**/ ?>