<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'products' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'products' => [],
]); ?>
<?php foreach (array_filter(([
    'products' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>




<div class="card-product grid" data-availability="In stock" data-brand="nike">
    <div class="card-product-wrapper" style="background: #ECEFF2;">
        <a href="<?php echo e(url('product', ['id' => $products?->id])); ?>" class="product-img">
            <img class="lazyload img-product" data-src="<?php echo e($products?->mainImage?->image); ?>"
                src="<?php echo e($products?->mainImage?->image); ?>" alt="image-product">
            <img class="lazyload img-hover" data-src="<?php echo e($products?->mainImage?->image); ?>"
                src="<?php echo e($products?->mainImage?->image); ?>" alt="image-product">
        </a>
        <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
        <div class="marquee-product bg-main">
            <div class="marquee-wrapper">
                <div class="initial-child-container">
                    <div class="marquee-child-item">
                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                    </div>
                </div>
            </div>
            <div class="marquee-wrapper">
                <div class="initial-child-container">
                    <div class="marquee-child-item">
                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-product-btn">
            <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">Wishlist</span>
            </a>
            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                class="box-icon compare btn-icon-action">
                <span class="icon icon-gitDiff"></span>
                <span class="tooltip">Compare</span>
            </a>
            <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading">
                <span class="icon icon-eye"></span>
                <span class="tooltip">Quick View</span>
            </a>
        </div>
        <div class="list-btn-main">
            
            <a href="<?php echo e(url('product', ['id' => $products?->id])); ?>" class="btn-main-product">
                View Product
            </a>
        </div>
    </div>
    <div class="card-product-info">
        <a href="" class="title link"><?php echo e($products?->name ?? ''); ?></a>
        <div class="price">
            <span class="old-price">$<?php echo e($products?->original_price ?? ''); ?></span>
            <span class="current-price">$<?php echo e($products?->sale_price ?? ''); ?></span>
        </div>
    </div>
</div>




<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/site/compoent/product-card.blade.php ENDPATH**/ ?>