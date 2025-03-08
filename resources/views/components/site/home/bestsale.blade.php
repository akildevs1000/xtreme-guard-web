@props([
    'products' => [],
])

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
                                <img class="lazyload img-product" data-src="{{ $products?->mainImage?->image }}"
                                    src="{{ $products?->mainImage?->image }}" alt="image-product">
                                <img class="lazyload img-hover" data-src="{{ $products?->mainImage?->image }}"
                                    src="{{ $products?->mainImage?->image }}" alt="image-product">
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




                {{-- <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product" data-src="images/products/womens/women-176.jpg"
                                        src="images/products/womens/women-176.jpg" alt="image-product">
                                    <img class="lazyload img-hover" data-src="images/products/womens/women-179.jpg"
                                        src="images/products/womens/women-179.jpg" alt="image-product">
                                </a>
                                <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
                                <div class="marquee-product bg-main">
                                    <div class="marquee-wrapper">
                                        <div class="initial-child-container">
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="marquee-wrapper">
                                        <div class="initial-child-container">
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
                                            </div>
                                            <div class="marquee-child-item">
                                                <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF
                                                </p>
                                            </div>
                                            <div class="marquee-child-item">
                                                <span class="icon icon-lightning text-critical"></span>
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
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
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
                                <a href="product-detail.html" class="title link">Polarized sunglasses</a>
                                <span class="price"><span class="old-price">$98.00</span> $79.99</span>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch active line">
                                        <span class="swatch-value bg-light-blue"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-176.jpg"
                                            src="images/products/womens/women-176.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch">
                                        <span class="swatch-value bg-light-blue-2"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-177.jpg"
                                            src="images/products/womens/women-177.jpg" alt="image-product">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0.2s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product" data-src="images/products/womens/women-29.jpg"
                                        src="images/products/womens/women-29.jpg" alt="image-product">
                                    <img class="lazyload img-hover" data-src="images/products/womens/women-30.jpg"
                                        src="images/products/womens/women-30.jpg" alt="image-product">
                                </a>
                                <div class="variant-wrap size-list">
                                    <ul class="variant-box">
                                        <li class="size-item">S</li>
                                        <li class="size-item">M</li>
                                        <li class="size-item">L</li>
                                        <li class="size-item">XL</li>
                                    </ul>
                                </div>
                                <div class="variant-wrap countdown-wrap">
                                    <div class="variant-box">
                                        <div class="js-countdown" data-timer="1007500" data-labels="D :,H :,M :,S">
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
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link">Ramie shirt with pockets </a>
                                <span class="price"><span class="old-price">$98.00</span> $89.99</span>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch active line">
                                        <span class="swatch-value bg-light-orange"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-29.jpg"
                                            src="images/products/womens/women-29.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch">
                                        <span class="swatch-value bg-light-grey"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-33.jpg"
                                            src="images/products/womens/women-33.jpg" alt="image-product">
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.3s">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product" data-src="images/products/womens/women-1.jpg"
                                        src="images/products/womens/women-1.jpg" alt="image-product">
                                    <img class="lazyload img-hover" data-src="images/products/womens/women-2.jpg"
                                        src="images/products/womens/women-2.jpg" alt="image-product">
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
                                    <a href="#quickView" data-bs-toggle="modal"
                                        class="box-icon quickview tf-btn-loading">
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
                                <a href="product-detail.html" class="title link">Ribbed cotton-blend top</a>
                                <span class="price">$69.99</span>
                                <ul class="list-color-product">
                                    <li class="list-color-item color-swatch active line">
                                        <span class="swatch-value bg-dark-grey"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-1.jpg"
                                            src="images/products/womens/women-1.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch">
                                        <span class="swatch-value bg-light-pink"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-2.jpg"
                                            src="images/products/womens/women-2.jpg" alt="image-product">
                                    </li>
                                    <li class="list-color-item color-swatch">
                                        <span class="swatch-value bg-dark-grey-2"></span>
                                        <img class="lazyload" data-src="images/products/womens/women-3.jpg"
                                            src="images/products/womens/women-3.jpg" alt="image-product">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}



            </div>
            <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
