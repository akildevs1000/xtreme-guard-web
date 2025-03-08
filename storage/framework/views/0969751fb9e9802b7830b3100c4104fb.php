 <?php if (isset($component)) { $__componentOriginal43484d39dc4b0e2e04161294f1acc16d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43484d39dc4b0e2e04161294f1acc16d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.nav-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.nav-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43484d39dc4b0e2e04161294f1acc16d)): ?>
<?php $attributes = $__attributesOriginal43484d39dc4b0e2e04161294f1acc16d; ?>
<?php unset($__attributesOriginal43484d39dc4b0e2e04161294f1acc16d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43484d39dc4b0e2e04161294f1acc16d)): ?>
<?php $component = $__componentOriginal43484d39dc4b0e2e04161294f1acc16d; ?>
<?php unset($__componentOriginal43484d39dc4b0e2e04161294f1acc16d); ?>
<?php endif; ?>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/include/sidebar.blade.php ENDPATH**/ ?>