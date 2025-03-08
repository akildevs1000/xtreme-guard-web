<?php $__env->startSection('content'); ?>
    <section class="flat-spacing">
        <div class="container">
            <div class="tf-grid-layout tf-col-2 lg-col-5">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="collection-position-2 radius-lg style-3 hover-img">
                        <a class="img-style" style=" background: #ECEFF2;">
                            <img class="lazyload" data-src="<?php echo e($category->img); ?>" src="<?php echo e($category->img); ?>" alt="banner-cls">
                        </a>
                        <div class="content">
                            <a href="#" class="cls-btn cls-btn d-flex justify-content-center">
                                <b class="text fs-13"><?php echo e($category->name); ?></b>
                                
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
    </section>

    <?php if (isset($component)) { $__componentOriginale417b45ce5771e7f2548cac654b46222 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale417b45ce5771e7f2548cac654b46222 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.home.testimonial','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('site.home.testimonial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale417b45ce5771e7f2548cac654b46222)): ?>
<?php $attributes = $__attributesOriginale417b45ce5771e7f2548cac654b46222; ?>
<?php unset($__attributesOriginale417b45ce5771e7f2548cac654b46222); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale417b45ce5771e7f2548cac654b46222)): ?>
<?php $component = $__componentOriginale417b45ce5771e7f2548cac654b46222; ?>
<?php unset($__componentOriginale417b45ce5771e7f2548cac654b46222); ?>
<?php endif; ?>

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal2ba869a25aab54adf1e62b0d37f1b62b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ba869a25aab54adf1e62b0d37f1b62b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.home.bestsale','data' => ['products' => $prodduct]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('site.home.bestsale'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prodduct)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ba869a25aab54adf1e62b0d37f1b62b)): ?>
<?php $attributes = $__attributesOriginal2ba869a25aab54adf1e62b0d37f1b62b; ?>
<?php unset($__attributesOriginal2ba869a25aab54adf1e62b0d37f1b62b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ba869a25aab54adf1e62b0d37f1b62b)): ?>
<?php $component = $__componentOriginal2ba869a25aab54adf1e62b0d37f1b62b; ?>
<?php unset($__componentOriginal2ba869a25aab54adf1e62b0d37f1b62b); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if (isset($component)) { $__componentOriginal3cd52376d451a370533f8738e50d842c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3cd52376d451a370533f8738e50d842c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.home.iconbox','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('site.home.iconbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3cd52376d451a370533f8738e50d842c)): ?>
<?php $attributes = $__attributesOriginal3cd52376d451a370533f8738e50d842c; ?>
<?php unset($__attributesOriginal3cd52376d451a370533f8738e50d842c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3cd52376d451a370533f8738e50d842c)): ?>
<?php $component = $__componentOriginal3cd52376d451a370533f8738e50d842c; ?>
<?php unset($__componentOriginal3cd52376d451a370533f8738e50d842c); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalce0946e0196faecc122be139eddde9a8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0946e0196faecc122be139eddde9a8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.home.special-banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('site.home.special-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce0946e0196faecc122be139eddde9a8)): ?>
<?php $attributes = $__attributesOriginalce0946e0196faecc122be139eddde9a8; ?>
<?php unset($__attributesOriginalce0946e0196faecc122be139eddde9a8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce0946e0196faecc122be139eddde9a8)): ?>
<?php $component = $__componentOriginalce0946e0196faecc122be139eddde9a8; ?>
<?php unset($__componentOriginalce0946e0196faecc122be139eddde9a8); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app-site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Install\laragon\www\akil\resources\views/site/home/index.blade.php ENDPATH**/ ?>