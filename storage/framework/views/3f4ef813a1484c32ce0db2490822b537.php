<div>

    <?php if(session()->has('success')): ?>
        <?php $__env->startPush('scripts'); ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alertNotify('<?php echo e(session('success')); ?>', 'success')
                });
            </script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
        <?php $__env->startPush('scripts'); ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alertNotify('<?php echo e(session('error')); ?>', 'error')
                });
            </script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>

    <?php if(session()->has('debug')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alertNotify('Please scroll down for console', 'error')
            });
        </script>
    <?php endif; ?>

    <?php if($message = Session::get('debug')): ?>
        <div id="successalert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            <?php echo e($message); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/notification/toastify.blade.php ENDPATH**/ ?>