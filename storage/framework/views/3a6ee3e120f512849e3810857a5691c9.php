<?php $__env->startSection('content'); ?>
    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap">
                <div class="tf-breadcrumb-list">
                    <a href="index.html" class="text text-caption-1">Homepage</a>
                    <i class="icon icon-arrRight"></i>
                    <a href="#" class="text text-caption-1">Women</a>
                    <i class="icon icon-arrRight"></i>
                    <span class="text text-caption-1">Leather boots with tall leg</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- tf-add-cart-success -->
    <div class="tf-add-cart-success">
        <div class="tf-add-cart-heading">
            <h5>Shopping Cart</h5>
            <i class="icon icon-close tf-add-cart-close"></i>
        </div>
        <div class="tf-add-cart-product">
            <div class="image">
                <img class=" ls-is-cached lazyloaded" data-src="<?php echo e(asset('site/images/products/womens/women-3.jpg')); ?>"
                    alt="" src="<?php echo e(asset('site/images/products/womens/women-3.jpg')); ?>">
            </div>
            <div class="content">
                <div class="text-title">
                    <a class="link" href="product-detail.html">Biker-style leggings</a>
                </div>
                <div class="text-caption-1 text-secondary-2">Green, XS, Cotton</div>
                <div class="text-title">$68.00</div>
            </div>
        </div>
        <a href="shopping-cart.html" class="tf-btn w-100 btn-fill radius-4"><span class="text text-btn-uppercase">View
                cart</span></a>
    </div>
    <!-- /tf-add-cart-success -->

    <!-- Product_Main -->
    <section class="flat-spacing">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <!-- Product default -->
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                    data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">

                                        <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img class="lazyload" data-src="<?php echo e($img->image); ?>"
                                                        src="<?php echo e($img->image); ?>" alt="">
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        

                                    </div>
                                </div>
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started"
                                    style="background:#FAFAFA;border-radius: 10px;">
                                    <div class="swiper-wrapper">

                                        <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="<?php echo e($img->image); ?>" target="_blank" class="item"
                                                    data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom lazyload" data-zoom="<?php echo e($img->image); ?>"
                                                        data-src="<?php echo e($img->image); ?>" src="<?php echo e($img->image); ?>"
                                                        alt="">
                                                </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        

                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /Product default -->
                    <!-- tf-product-info-list -->
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-heading">
                                    <div class="tf-product-info-name">
                                        <div class="text text-btn-uppercase"><?php echo e($product->category->name ?? ''); ?></div>
                                        <h3 class="name"><?php echo e($product->name ?? ''); ?></h3>
                                        <div class="sub">
                                            <div class="tf-product-info-rate">
                                                <div class="list-star">
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                    <i class="icon icon-star"></i>
                                                </div>
                                                <div class="text text-caption-1">(134 reviews)</div>
                                            </div>
                                            <div class="tf-product-info-sold">
                                                <i class="icon icon-lightning"></i>
                                                <div class="text text-caption-1">18 sold in last 32 hours</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tf-product-info-desc">
                                        <div class="tf-product-info-price">
                                            <h5 class="price-on-sale font-2">$79.99</h5>
                                            <div class="compare-at-price font-2">$98.99</div>
                                            <div class="badges-on-sale text-btn-uppercase">
                                                -25%
                                            </div>
                                        </div>
                                        <p>The garments labelled as Committed are products that have been produced
                                            using sustainable fibres or processes, reducing their environmental
                                            impact.</p>
                                        <div class="tf-product-info-liveview">
                                            <i class="icon icon-eye"></i>
                                            <p class="text-caption-1"><span class="liveview-count">28</span> people
                                                are viewing this right now</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-product-info-choose-option">
                                    <div class="variant-picker-item">
                                        <div class="variant-picker-label mb_12">
                                            Colors:<span
                                                class="text-title variant-picker-label-value value-currentColor">Gray</span>
                                        </div>
                                        <div class="variant-picker-values">
                                            <input id="values-beige" type="radio" name="color1">
                                            <label class="hover-tooltip tooltip-bot radius-60 color-btn"
                                                for="values-beige" data-value="Beige" data-color="beige">
                                                <span class="btn-checkbox bg-color-beige1"></span>
                                                <span class="tooltip">Beige</span>
                                            </label>
                                            <input id="values-gray" type="radio" name="color1" checked>
                                            <label class="hover-tooltip tooltip-bot radius-60 color-btn"
                                                data-price="79.99" for="values-gray" data-value="Gray"
                                                data-color="gray">
                                                <span class="btn-checkbox bg-color-gray"></span>
                                                <span class="tooltip">Gray</span>
                                            </label>
                                            <input id="values-grey" type="radio" name="color1">
                                            <label class="hover-tooltip tooltip-bot radius-60 color-btn"
                                                data-price="89.99" for="values-grey" data-value="Grey"
                                                data-color="grey">
                                                <span class="btn-checkbox bg-color-grey"></span>
                                                <span class="tooltip">Grey</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="variant-picker-item">
                                        <div class="d-flex justify-content-between mb_12">
                                            <div class="variant-picker-label">
                                                Size:<span class="text-title variant-picker-label-value">L</span>
                                            </div>
                                            <a href="#size-guide" data-bs-toggle="modal"
                                                class="size-guide text-title link">Size Guide</a>
                                        </div>
                                        <div class="variant-picker-values gap12">
                                            <input type="radio" name="size1" id="values-s">
                                            <label class="style-text size-btn" for="values-s" data-value="S"
                                                data-price="79.99">
                                                <span class="text-title">S</span>
                                            </label>
                                            <input type="radio" name="size1" id="values-m">
                                            <label class="style-text size-btn" for="values-m" data-value="M"
                                                data-price="79.99">
                                                <span class="text-title">M</span>
                                            </label>
                                            <input type="radio" name="size1" id="values-l" checked>
                                            <label class="style-text size-btn" for="values-l" data-value="L"
                                                data-price="89.99">
                                                <span class="text-title">L</span>
                                            </label>
                                            <input type="radio" name="size1" id="values-xl">
                                            <label class="style-text size-btn" for="values-xl" data-value="XL"
                                                data-price="89.99">
                                                <span class="text-title">XL</span>
                                            </label>
                                            <input type="radio" name="size1" id="values-xxl">
                                            <label class="style-text size-btn type-disable" for="values-xxl"
                                                data-value="XXL" data-price="89.99">
                                                <span class="text-title">XXL</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="tf-product-info-quantity">
                                        <div class="title mb_12">Quantity:</div>
                                        <div class="wg-quantity">
                                            <span class="btn-quantity btn-decrease">-</span>
                                            <input class="quantity-product" type="text" name="number"
                                                value="1">
                                            <span class="btn-quantity btn-increase">+</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="tf-product-info-by-btn mb_10">
                                            <a href="#shoppingCart" data-bs-toggle="modal"
                                                class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart"><span>Add
                                                    to cart -&nbsp;</span><span
                                                    class="tf-qty-price total-price">$79.99</span></a>
                                            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare"
                                                class="box-icon hover-tooltip compare btn-icon-action">
                                                <span class="icon icon-gitDiff"></span>
                                                <span class="tooltip text-caption-2">Compare</span>
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="box-icon hover-tooltip text-caption-2 wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip text-caption-2">Wishlist</span>
                                            </a>
                                        </div>
                                        <a href="#" class="btn-style-3 text-btn-uppercase">Buy it now</a>
                                    </div>
                                    <div class="tf-product-info-help">
                                        <div class="tf-product-info-extra-link">
                                            <a href="#delivery_return" data-bs-toggle="modal"
                                                class="tf-product-extra-icon">
                                                <div class="icon">
                                                    <i class="icon-shipping"></i>
                                                </div>
                                                <p class="text-caption-1">Delivery & Return</p>
                                            </a>
                                            <a href="#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                                <div class="icon">
                                                    <i class="icon-question"></i>
                                                </div>
                                                <p class="text-caption-1">Ask A Question</p>
                                            </a>
                                            <a href="#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                                <div class="icon">
                                                    <i class="icon-share"></i>
                                                </div>
                                                <p class="text-caption-1">Share</p>
                                            </a>
                                        </div>
                                        <div class="tf-product-info-time">
                                            <div class="icon">
                                                <i class="icon-timer"></i>
                                            </div>
                                            <p class="text-caption-1">Estimated Delivery:&nbsp;&nbsp;<span>12-26
                                                    days</span> (International), <span>3-6 days</span> (United
                                                States)</p>
                                        </div>
                                        <div class="tf-product-info-return">
                                            <div class="icon">
                                                <i class="icon-arrowClockwise"></i>
                                            </div>
                                            <p class="text-caption-1">Return within <span>45 days</span> of
                                                purchase. Duties & taxes are non-refundable.</p>
                                        </div>
                                        <div class="dropdown dropdown-store-location">
                                            <div class="dropdown-title dropdown-backdrop" data-bs-toggle="dropdown"
                                                aria-haspopup="true">
                                                <div class="tf-product-info-view link">
                                                    <div class="icon">
                                                        <i class="icon-map-pin"></i>
                                                    </div>
                                                    <span>View Store Information</span>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <div class="dropdown-content">
                                                    <div class="dropdown-content-heading">
                                                        <h5>Store Location</h5>
                                                        <i class="icon icon-close"></i>
                                                    </div>
                                                    <div class="line-bt"></div>
                                                    <div>
                                                        <h6>Fashion Modave</h6>
                                                        <p>Pickup available. Usually ready in 24 hours</p>
                                                    </div>
                                                    <div>
                                                        <p>766 Rosalinda Forges Suite 044,</p>
                                                        <p>Gracielahaven, Oregon</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="tf-product-info-sku">
                                        <li>
                                            <p class="text-caption-1">SKU:</p>
                                            <p class="text-caption-1 text-1">53453412</p>
                                        </li>
                                        <li>
                                            <p class="text-caption-1">Vendor:</p>
                                            <p class="text-caption-1 text-1">Modave</p>
                                        </li>
                                        <li>
                                            <p class="text-caption-1">Available:</p>
                                            <p class="text-caption-1 text-1">Instock</p>
                                        </li>
                                        <li>
                                            <p class="text-caption-1">Categories:</p>
                                            <p class="text-caption-1"><a href="#" class="text-1 link">Clothes</a>,
                                                <a href="#" class="text-1 link">women</a>, <a href="#"
                                                    class="text-1 link">T-shirt</a>
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="tf-product-info-guranteed">
                                        <div class="text-title">
                                            Guranteed safe checkout:
                                        </div>
                                        <div class="tf-payment">


                                            <?php for($i = 1; $i < 7; $i++): ?>
                                                <a href="#">
                                                    <img src='<?php echo e(asset("site/images/payment/img-$i.png")); ?>'
                                                        alt="">
                                                </a>
                                            <?php endfor; ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /tf-product-info-list -->
                </div>
            </div>
        </div>
        <div class="tf-sticky-btn-atc">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form class="form-sticky-atc">
                            <div class="tf-sticky-atc-product">
                                <div class="image">
                                    <img class="lazyload"
                                        data-src="<?php echo e(asset('site/images/products/womens/women-3.jpg')); ?>" alt=""
                                        src="<?php echo e(asset('site/images/products/womens/women-3.jpg')); ?>">
                                </div>
                                <div class="content">
                                    <div class="text-title">
                                        Biker-style leggings
                                    </div>
                                    <div class="text-caption-1 text-secondary-2">Green, XS, Cotton</div>
                                    <div class="text-title">$68.00</div>
                                </div>
                            </div>
                            <div class="tf-sticky-atc-infos">
                                <div class="tf-sticky-atc-size d-flex gap-12 align-items-center">
                                    <div class="tf-sticky-atc-infos-title text-title">Size:</div>
                                    <div class="tf-dropdown-sort style-2" data-bs-toggle="dropdown">
                                        <div class="btn-select">
                                            <span class="text-sort-value font-2">M</span>
                                            <span class="icon icon-arrow-down"></span>
                                        </div>
                                        <div class="dropdown-menu">
                                            <div class="select-item">
                                                <span class="text-value-item">S</span>
                                            </div>
                                            <div class="select-item active">
                                                <span class="text-value-item">M</span>
                                            </div>
                                            <div class="select-item">
                                                <span class="text-value-item">L</span>
                                            </div>
                                            <div class="select-item">
                                                <span class="text-value-item">XL</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-sticky-atc-quantity d-flex gap-12 align-items-center">
                                    <div class="tf-sticky-atc-infos-title text-title">Quantity:</div>
                                    <div class="wg-quantity style-1">
                                        <span class="btn-quantity minus-btn">-</span>
                                        <input type="text" name="number" value="1">
                                        <span class="btn-quantity plus-btn">+</span>
                                    </div>
                                </div>
                                <div class="tf-sticky-atc-btns">
                                    <a href="#shoppingCart" data-bs-toggle="modal"
                                        class="tf-btn w-100 btn-reset radius-4 btn-add-to-cart"><span
                                            class="text text-btn-uppercase">Add To Cart</span></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Product_Main -->


    <!-- Product_Description_Tabs -->
    <section class="mb-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-tabs style-1">
                        <ul class="widget-menu-tab">
                            <li class="item-title active">
                                <span class="inner">Description</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Specifications</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Shipping & Returns</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Return Policies</span>
                            </li>
                        </ul>
                        <div class="widget-content-tab">
                            <div class="widget-content-inner active">
                                <div class="tab-description">

                                    <?php echo $product->description ?? ''; ?>


                                    
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="tab-reviews write-cancel-review-wrap">
                                    <div class="widwget-content-inner">
                                        <table class="tab-sizeguide-table">
                                            <thead>
                                                <tr>
                                                    <th>Attribute</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $__currentLoopData = $product->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($item->key); ?></td>
                                                        <td><?php echo e($item->value); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="tab-shipping">
                                    <div class="w-100">
                                        <div class="text-btn-uppercase mb_12">We've got your back</div>
                                        <p class="mb_12">One delivery fee to most locations (check our Orders &
                                            Delivery page)</p>
                                        <p class="">Free returns within 14 days (excludes final sale and
                                            made-to-order items, face masks and certain products containing
                                            hazardous or flammable materials, such as fragrances and aerosols)</p>
                                    </div>
                                    <div class="w-100">
                                        <div class="text-btn-uppercase mb_12">Import duties information</div>
                                        <p>Let us handle the legwork. Delivery duties are included in the item price
                                            when shipping to all EU countries (excluding the Canary Islands), plus
                                            The United Kingdom, USA, Canada, China Mainland, Australia, New Zealand,
                                            Puerto Rico, Switzerland, Singapore, Republic Of Korea, Kuwait, Mexico,
                                            Qatar, India, Norway, Saudi Arabia, Taiwan Region, Thailand, U.A.E.,
                                            Japan, Brazil, Isle of Man, San Marino, Colombia, Chile, Argentina,
                                            Egypt, Lebanon, Hong Kong SAR, Bahrain and Turkey. All import duties are
                                            included in your order – the price you see is the price you pay.</p>
                                    </div>
                                    <div class="w-100">
                                        <div class="text-btn-uppercase mb_12">Estimated delivery</div>
                                        <p class="mb_6 font-2">Express: May 10 - May 17</p>
                                        <p class="font-2">Sending from USA</p>
                                    </div>
                                    <div class="w-100">
                                        <div class="text-btn-uppercase mb_12">Need more information?</div>
                                        <div>
                                            <a href="#"
                                                class="link text-secondary text-decoration-underline mb_6 font-2">Orders
                                                & delivery</a>
                                        </div>
                                        <div>
                                            <a href="#"
                                                class="link text-secondary text-decoration-underline mb_6 font-2">Returns
                                                & refunds</a>
                                        </div>
                                        <div>
                                            <a href="#"
                                                class="link text-secondary text-decoration-underline font-2">Duties
                                                & taxes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-inner">
                                <div class="tab-policies">
                                    <div class="text-btn-uppercase mb_12">Return Policies</div>
                                    <p class="mb_12 text-secondary">At Modave, we stand behind the quality of our
                                        products. If you're not completely satisfied with your purchase, we offer
                                        hassle-free returns within 30 days of delivery.</p>
                                    <div class="text-btn-uppercase mb_12">Easy Exchanges or Refunds</div>
                                    <ul class="list-text type-disc mb_12 gap-6">
                                        <li class="text-secondary font-2">Exchange your item for a different size,
                                            color, or style, or receive a full refund.</li>
                                        <li class="text-secondary font-2">All returned items must be unworn, in
                                            their original packaging, and with tags attached.</li>
                                    </ul>
                                    <div class="text-btn-uppercase mb_12">Simple Process</div>
                                    <ul class="list-text type-number">
                                        <li class="text-secondary font-2">Initiate your return online or contact our
                                            customer service team for assistance.</li>
                                        <li class="text-secondary font-2">Pack your item securely and include the
                                            original packing slip.</li>
                                        <li class="text-secondary font-2">Ship your return back to us using our
                                            prepaid shipping label.</li>
                                        <li class="text-secondary font-2">Once received, your refund will be
                                            processed promptly.</li>
                                    </ul>
                                    <p class="text-secondary font-2">For any questions or concerns regarding
                                        returns, don't hesitate to reach out to our dedicated customer service team.
                                        Your satisfaction is our priority.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Product_Description_Tabs -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app-site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Install\laragon\www\akil\resources\views/site/product/show.blade.php ENDPATH**/ ?>