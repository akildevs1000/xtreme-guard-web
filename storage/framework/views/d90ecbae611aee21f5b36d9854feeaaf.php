<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">

            <?php if (isset($component)) { $__componentOriginal255c768b4b0ae3b5f14018677b0b2909 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal255c768b4b0ae3b5f14018677b0b2909 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.include.app-icon','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.include.app-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal255c768b4b0ae3b5f14018677b0b2909)): ?>
<?php $attributes = $__attributesOriginal255c768b4b0ae3b5f14018677b0b2909; ?>
<?php unset($__attributesOriginal255c768b4b0ae3b5f14018677b0b2909); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal255c768b4b0ae3b5f14018677b0b2909)): ?>
<?php $component = $__componentOriginal255c768b4b0ae3b5f14018677b0b2909; ?>
<?php unset($__componentOriginal255c768b4b0ae3b5f14018677b0b2909); ?>
<?php endif; ?>

            <div class="d-flex align-items-center">
                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username" />
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                


                
                <?php if (isset($component)) { $__componentOriginal49740c84f338f22c4163dab0fc429c0b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49740c84f338f22c4163dab0fc429c0b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.include.user-profile','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.include.user-profile'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49740c84f338f22c4163dab0fc429c0b)): ?>
<?php $attributes = $__attributesOriginal49740c84f338f22c4163dab0fc429c0b; ?>
<?php unset($__attributesOriginal49740c84f338f22c4163dab0fc429c0b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49740c84f338f22c4163dab0fc429c0b)): ?>
<?php $component = $__componentOriginal49740c84f338f22c4163dab0fc429c0b; ?>
<?php unset($__componentOriginal49740c84f338f22c4163dab0fc429c0b); ?>
<?php endif; ?>


            </div>
        </div>
    </div>
</header>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/layout/header.blade.php ENDPATH**/ ?>