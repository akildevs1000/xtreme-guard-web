<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Mirnah Technology Systems" name="description" />
    <meta content="Mirnah" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | OMS</title>
    
    <link rel="shortcut icon" href="<?php echo e(asset('/assets/images/favicon.ico')); ?>" />

    <?php echo $__env->make('include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if (isset($component)) { $__componentOriginal9c37c71c38d0f8ff3ad81b3becb4883c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c37c71c38d0f8ff3ad81b3becb4883c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.loaders.page-preloader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('loaders.page-preloader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c37c71c38d0f8ff3ad81b3becb4883c)): ?>
<?php $attributes = $__attributesOriginal9c37c71c38d0f8ff3ad81b3becb4883c; ?>
<?php unset($__attributesOriginal9c37c71c38d0f8ff3ad81b3becb4883c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c37c71c38d0f8ff3ad81b3becb4883c)): ?>
<?php $component = $__componentOriginal9c37c71c38d0f8ff3ad81b3becb4883c; ?>
<?php unset($__componentOriginal9c37c71c38d0f8ff3ad81b3becb4883c); ?>
<?php endif; ?>

</head>

<body>

    <div id="layout-wrapper">

        <?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <?php echo $__env->make('include.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if (isset($component)) { $__componentOriginalbd37f864111b0049d3106d5f46b198de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbd37f864111b0049d3106d5f46b198de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notification.toastify','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notification.toastify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbd37f864111b0049d3106d5f46b198de)): ?>
<?php $attributes = $__attributesOriginalbd37f864111b0049d3106d5f46b198de; ?>
<?php unset($__attributesOriginalbd37f864111b0049d3106d5f46b198de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd37f864111b0049d3106d5f46b198de)): ?>
<?php $component = $__componentOriginalbd37f864111b0049d3106d5f46b198de; ?>
<?php unset($__componentOriginalbd37f864111b0049d3106d5f46b198de); ?>
<?php endif; ?>

        <?php echo $__env->yieldPushContent('scripts'); ?>
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
<?php /**PATH D:\Install\laragon\www\akil\resources\views/layout/app.blade.php ENDPATH**/ ?>