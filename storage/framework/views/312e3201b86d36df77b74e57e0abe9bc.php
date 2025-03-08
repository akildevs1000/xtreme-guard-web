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
    <div class="container">
        <div class="flat-img-with-text">
            <div class="banner banner-left wow fadeInLeft">
                <img src="images/banner/banner-w-text1.jpg" alt="banner">
            </div>
            <div class="banner-content">
                <div class="content-text wow fadeInUp">
                    <h3 class="title text-center fw-5">Special Offer! <br> This Week Only</h3>
                    <p class="desc">Reserved for special occasions</p>
                </div>
                <a href="shop-default-grid.html" class="tf-btn btn-fill wow fadeInUp"><span class="text">Explore
                        Collection</span><i class="icon icon-arrowUpRight"></i></a>
            </div>
            <div class="banner banner-right wow fadeInRight">
                <img src="images/banner/banner-w-text2.jpg" alt="banner">
            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/site/home/special-banner.blade.php ENDPATH**/ ?>