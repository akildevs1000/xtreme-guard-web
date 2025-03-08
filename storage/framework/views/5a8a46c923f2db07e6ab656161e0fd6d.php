<link rel="stylesheet" href="<?php echo e(asset('assets/libs/jsvectormap/css/jsvectormap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/swiper/swiper-bundle.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/icons.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/icons5.min.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/app.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-table.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="apple-touch-icon" href="<?php echo e(asset('logo.PNG')); ?>">

<?php
    $manifest = app()->environment('production') ? asset('manifest-production.json') : asset('manifest-local.json');
?>


<link rel="manifest" href="<?php echo e($manifest); ?>">

<?php echo $__env->yieldPushContent('styles'); ?>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/include/head.blade.php ENDPATH**/ ?>