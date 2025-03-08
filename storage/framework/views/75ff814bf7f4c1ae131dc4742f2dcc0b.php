<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Mirnah Technology Systems" name="description" />
    <meta content="Mirnah" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | Akil</title>
    
    <link rel="shortcut icon" href="<?php echo e(asset('/assets/images/favicon.ico')); ?>" />

    <?php echo $__env->make('include.site.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</head>

<body class="preload-wrapper">

    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">

        <?php echo $__env->make('include.site.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('include.site.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('include.site.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <script src="<?php echo e(asset('sw.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            // console.log(navigator);
            // console.log("serviceWorker" in navigator);
        });

        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/oms/public/sw.js").then(
                (registration) => {
                    // console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    // console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            // console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/layout/app-site.blade.php ENDPATH**/ ?>