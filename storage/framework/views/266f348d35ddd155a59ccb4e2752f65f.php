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

<section>
    <div class="container mt-4 mb-3">
        <div class="heading-section text-center wow fadeInUp">
            <h3 class="heading">Best Selling</h3>
            <p class="subheading text-secondary">Browse our Top Trending: the hottest picks loved by all.</p>
        </div>
        <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30"
            data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card-product wow fadeInUp" data-wow-delay="0s">
                        <div class="card-product-wrapper" style="background:#ECEFF2;">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="<?php echo e($products?->mainImage?->image); ?>"
                                    src="<?php echo e($products?->mainImage?->image); ?>" alt="image-product">
                                <img class="lazyload img-hover" data-src="<?php echo e($products?->mainImage?->image); ?>"
                                    src="<?php echo e($products?->mainImage?->image); ?>" alt="image-product">
                            </a>
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
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To
                                    cart</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">V-neck cotton T-shirt</a>
                            <span class="price">$59.99</span>

                        </div>
                    </div>
                </div>




                



            </div>
            <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/site/home/bestsale.blade.php ENDPATH**/ ?>