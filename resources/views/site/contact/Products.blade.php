@extends('layout.app-site')

@section('content')
    <section class="flat-spacing">
        <div class="container">

            <div class="tf-shop-control">
                <div class="tf-control-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter"><span
                            class="icon icon-filter"></span><span class="text">Filters</span></a>
                    <div class="d-none d-lg-flex shop-sale-text">
                        <i class="icon icon-checkCircle"></i>
                        <p class="text-caption-1">Shop sale items only</p>
                    </div>
                </div>
                <ul class="tf-control-layout">

                </ul>
                <div class="tf-control-sorting">
                    <p class="d-none d-lg-block text-caption-1">Sort by:</p>
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">Best selling</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item" data-sort-value="best-selling">
                                <span class="text-value-item">Best selling</span>
                            </div>
                            <div class="select-item" data-sort-value="a-z">
                                <span class="text-value-item">Alphabetically, A-Z</span>
                            </div>
                            <div class="select-item" data-sort-value="z-a">
                                <span class="text-value-item">Alphabetically, Z-A</span>
                            </div>
                            <div class="select-item" data-sort-value="price-low-high">
                                <span class="text-value-item">Price, low to high</span>
                            </div>
                            <div class="select-item" data-sort-value="price-high-low">
                                <span class="text-value-item">Price, high to low</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="wrapper-control-shop">
                <div class="meta-filter-shop">
                    <div id="product-count-grid" class="count-text"></div>
                    <div id="product-count-list" class="count-text"></div>
                    <div id="applied-filters"></div>
                    <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE
                        ALL <i class="icon icon-close"></i></button>
                </div>

                <div class="tf-grid-layout wrapper-shop tf-col-4" id="gridLayout">


                    @foreach ($products as $prodduct)
                        <x-site.compoent.product-card :products="$prodduct" />
                    @endforeach






                    {{-- <!-- card product 1 -->
                    <div class="card-product grid" data-availability="Out of stock" data-brand="adidas">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-19.jpg"
                                    src="images/products/womens/women-19.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-20.jpg"
                                    src="images/products/womens/women-20.jpg" alt="image-product">
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
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">V-neck cotton T-shirt</a>
                            <span class="price current-price">$59.99</span>
                        </div>
                    </div>
                    <!-- card product 2 -->
                    <div class="card-product grid" data-availability="In stock" data-brand="nike">
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
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="marquee-wrapper">
                                    <div class="initial-child-container">
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
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
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Polarized sunglasses</a>
                            <div class="price"><span class="old-price">$98.00</span> <span
                                    class="current-price">$79.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active line">
                                    <span class="d-none text-capitalize color-filter">Light Blue</span>
                                    <span class="swatch-value bg-light-blue"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-176.jpg"
                                        src="images/products/womens/women-176.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Light Blue</span>
                                    <span class="swatch-value bg-light-blue-2"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-177.jpg"
                                        src="images/products/womens/women-177.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 3 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="LV">
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
                                    <div class="js-countdown" data-timer="1007500" data-labels="D :,H :,M :,S"></div>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Ramie shirt with pockets </a>
                            <div class="price"><span class="old-price">$98.00</span> <span
                                    class="current-price">$89.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active line">
                                    <span class="d-none text-capitalize color-filter">Orange</span>
                                    <span class="swatch-value bg-light-orange"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-29.jpg"
                                        src="images/products/womens/women-29.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-light-grey"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-33.jpg"
                                        src="images/products/womens/women-33.jpg" alt="image-product">
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- card product 4 -->
                    <div class="card-product grid" data-availability="Out of stock" data-brand="gucci">
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
                                <a href="#quickView" data-bs-toggle="modal" class="box-icon quickview tf-btn-loading">
                                    <span class="icon icon-eye"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            <div class="list-btn-main">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">Add To cart</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Ribbed cotton-blend top</a>
                            <span class="price current-price">$69.99</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active line">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-dark-grey"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-1.jpg"
                                        src="images/products/womens/women-1.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Pink</span>
                                    <span class="swatch-value bg-light-pink"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-2.jpg"
                                        src="images/products/womens/women-2.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-dark-grey-2"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-3.jpg"
                                        src="images/products/womens/women-3.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 5 -->
                    <div class="card-product grid card-product-size" data-availability="Out of stock"
                        data-brand="hermes">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-8.jpg"
                                    src="images/products/womens/women-8.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-9.jpg"
                                    src="images/products/womens/women-9.jpg" alt="image-product">
                            </a>
                            <div class="variant-wrap size-list">
                                <ul class="variant-box">
                                    <li class="size-item">S</li>
                                    <li class="size-item">M</li>
                                    <li class="size-item">L</li>
                                    <li class="size-item">XL</li>
                                </ul>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Ribbed cotton-blend top</a>
                            <span class="price current-price">$39.99</span>
                        </div>
                    </div>
                    <!-- card product 6 -->
                    <div class="card-product grid" data-availability="In stock" data-brand="zalando">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-171.jpg"
                                    src="images/products/womens/women-171.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-172.jpg"
                                    src="images/products/womens/women-172.jpg" alt="image-product">
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Faux-leather trousers</a>
                            <span class="price current-price">$79.99</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Orange</span>
                                    <span class="swatch-value bg-orange"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-171.jpg"
                                        src="images/products/womens/women-171.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Pink</span>
                                    <span class="swatch-value bg-dark-pink"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-172.jpg"
                                        src="images/products/womens/women-172.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 7 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="nike">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-83.jpg"
                                    src="images/products/womens/women-83.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-84.jpg"
                                    src="images/products/womens/women-84.jpg" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
                            <div class="variant-wrap size-list">
                                <ul class="variant-box">
                                    <li class="size-item">S</li>
                                    <li class="size-item">M</li>
                                    <li class="size-item">L</li>
                                    <li class="size-item">XL</li>
                                </ul>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Belt wrap dress</a>
                            <div class="price"><span class="old-price">$98.00</span><span
                                    class="current-price">$129.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Green</span>
                                    <span class="swatch-value bg-light-green"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-83.jpg"
                                        src="images/products/womens/women-83.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-grey"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-94.jpg"
                                        src="images/products/womens/women-94.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-87.jpg"
                                        src="images/products/womens/women-87.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 8 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="LV">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-102.jpg"
                                    src="images/products/womens/women-102.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-103.jpg"
                                    src="images/products/womens/women-103.jpg" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
                            <div class="variant-wrap size-list">
                                <ul class="variant-box">
                                    <li class="size-item">S</li>
                                    <li class="size-item">M</li>
                                    <li class="size-item">L</li>
                                    <li class="size-item">XL</li>
                                </ul>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Double-button trench coat</a>
                            <div class="price"><span class="old-price">$98.00</span><span
                                    class="current-price">$219.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-grey-2"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-102.jpg"
                                        src="images/products/womens/women-102.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Orange</span>
                                    <span class="swatch-value bg-light-orange"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-111.jpg"
                                        src="images/products/womens/women-111.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-104.jpg"
                                        src="images/products/womens/women-104.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 9 -->
                    <div class="card-product grid" data-availability="In stock" data-brand="hermes">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/mens/men-11.jpg"
                                    src="images/products/mens/men-11.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/mens/men-12.jpg"
                                    src="images/products/mens/men-12.jpg" alt="image-product">
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
                            <span class="price current-price">$59.99</span>
                        </div>
                    </div>
                    <!-- card product 10 -->
                    <div class="card-product grid" data-availability="In stock" data-brand="gucci">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/mens/men-13.jpg"
                                    src="images/products/mens/men-13.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/mens/men-14.jpg"
                                    src="images/products/mens/men-14.jpg" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
                            <div class="marquee-product bg-main">
                                <div class="marquee-wrapper">
                                    <div class="initial-child-container">
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="marquee-wrapper">
                                    <div class="initial-child-container">
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
                                        </div>
                                        <div class="marquee-child-item">
                                            <span class="icon icon-lightning text-critical"></span>
                                        </div>
                                        <div class="marquee-child-item">
                                            <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale 25% OFF</p>
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
                            <a href="product-detail.html" class="title link">Polarized sunglasses</a>
                            <div class="price"><span class="old-price">$98.00</span> <span
                                    class="current-price">$79.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Beige</span>
                                    <span class="swatch-value bg-beige"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-13.jpg"
                                        src="images/products/mens/men-13.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Light Blue</span>
                                    <span class="swatch-value bg-light-blue-2"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-12.jpg"
                                        src="images/products/mens/men-12.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 11 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="zalando">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/mens/men-7.jpg"
                                    src="images/products/mens/men-7.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/mens/men-8.jpg"
                                    src="images/products/mens/men-8.jpg" alt="image-product">
                            </a>
                            <div class="on-sale-wrap"><span class="on-sale-item">-25%</span></div>
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
                                    <div class="js-countdown" data-timer="1007500" data-labels="D :,H :,M :,S"></div>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Ramie shirt with pockets </a>
                            <div class="price"><span class="old-price">$98.00</span> <span
                                    class="current-price">$89.99</span></div>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active line">
                                    <span class="d-none text-capitalize color-filter">Green</span>
                                    <span class="swatch-value bg-light-green"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-7.jpg"
                                        src="images/products/mens/men-7.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-light-grey"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-11.jpg"
                                        src="images/products/mens/men-11.jpg" alt="image-product">
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- card product 12 -->
                    <div class="card-product grid" data-availability="In stock" data-brand="adidas">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/mens/men-1.jpg"
                                    src="images/products/mens/men-1.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/mens/men-3.jpg"
                                    src="images/products/mens/men-3.jpg" alt="image-product">
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
                            <a href="product-detail.html" class="title link">Ribbed cotton-blend top</a>
                            <span class="price current-price">$69.99</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active line">
                                    <span class="d-none text-capitalize color-filter">Light Blue</span>
                                    <span class="swatch-value bg-light-blue"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-1.jpg"
                                        src="images/products/mens/men-1.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Pink</span>
                                    <span class="swatch-value bg-light-pink"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-13.jpg"
                                        src="images/products/mens/men-13.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Grey</span>
                                    <span class="swatch-value bg-dark-grey-2"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-9.jpg"
                                        src="images/products/mens/men-9.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 13 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="nike">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-37.jpg"
                                    src="images/products/womens/women-37.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-38.jpg"
                                    src="images/products/womens/women-38.jpg" alt="image-product">
                            </a>
                            <div class="variant-wrap size-list">
                                <ul class="variant-box">
                                    <li class="size-item">XS</li>
                                    <li class="size-item">L</li>
                                    <li class="size-item">XL</li>
                                    <li class="size-item">2XL</li>
                                    <li class="size-item">3XL</li>
                                </ul>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Buttoned cotton shirt</a>
                            <span class="price current-price">$89.99</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Light Blue</span>
                                    <span class="swatch-value bg-light-blue"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-37.jpg"
                                        src="images/products/womens/women-37.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch line">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-41.jpg"
                                        src="images/products/womens/women-41.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 14 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="LV">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/mens/men-15.jpg"
                                    src="images/products/mens/men-15.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/mens/men-16.jpg"
                                    src="images/products/mens/men-16.jpg" alt="image-product">
                            </a>
                            <div class="variant-wrap size-list">
                                <ul class="variant-box">
                                    <li class="size-item">XS</li>
                                    <li class="size-item">M</li>
                                    <li class="size-item">L</li>
                                    <li class="size-item">XL</li>
                                    <li class="size-item">2XL</li>
                                    <li class="size-item">3XL</li>
                                </ul>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Chest pocket cotton over shirt</a>
                            <span class="price current-price">$99.25</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active">
                                    <span class="d-none text-capitalize color-filter">Beige</span>
                                    <span class="swatch-value bg-beige"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-15.jpg"
                                        src="images/products/mens/men-15.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Black</span>
                                    <span class="swatch-value bg-main"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-18.jpg"
                                        src="images/products/mens/men-18.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Dark Blue</span>
                                    <span class="swatch-value bg-dark-blue"></span>
                                    <img class="lazyload" data-src="images/products/mens/men-17.jpg"
                                        src="images/products/mens/men-17.jpg" alt="image-product">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card product 15 -->
                    <div class="card-product grid" data-availability="In stock" data-brand="gucci">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/womens/women-167.jpg"
                                    src="images/products/womens/women-167.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/womens/women-168.jpg"
                                    src="images/products/womens/women-168.jpg" alt="image-product">
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
                            <a href="product-detail.html" class="title link">Cotton shopper bag</a>
                            <span class="price current-price">$199.25</span>
                            <ul class="list-color-product">
                                <li class="list-color-item color-swatch active line">
                                    <span class="d-none text-capitalize color-filter">White</span>
                                    <span class="swatch-value bg-white"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-167.jpg"
                                        src="images/products/womens/women-167.jpg" alt="image-product">
                                </li>
                                <li class="list-color-item color-swatch">
                                    <span class="d-none text-capitalize color-filter">Beige</span>
                                    <span class="swatch-value bg-beige"></span>
                                    <img class="lazyload" data-src="images/products/womens/women-162.jpg"
                                        src="images/products/womens/women-162.jpg" alt="image-product">
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- card product 16 -->
                    <div class="card-product grid card-product-size" data-availability="In stock" data-brand="adidas">
                        <div class="card-product-wrapper">
                            <a href="product-detail.html" class="product-img">
                                <img class="lazyload img-product" data-src="images/products/mens/men-19.jpg"
                                    src="images/products/mens/men-19.jpg" alt="image-product">
                                <img class="lazyload img-hover" data-src="images/products/mens/men-20.jpg"
                                    src="images/products/mens/men-20.jpg" alt="image-product">
                            </a>
                            <div class="variant-wrap size-list">
                                <ul class="variant-box">
                                    <li class="size-item">XS</li>
                                    <li class="size-item">M</li>
                                    <li class="size-item">L</li>
                                    <li class="size-item">XL</li>
                                    <li class="size-item">2XL</li>
                                    <li class="size-item">3XL</li>
                                </ul>
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
                                <a href="#quickAdd" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <a href="product-detail.html" class="title link">Chest pocket cotton over shirt</a>
                            <span class="price current-price">$250.00</span>

                        </div>
                    </div> --}}
                    <!-- pagination -->
                    <ul class="wg-pagination justify-content-center">
                        <li><a href="#" class="pagination-item text-button">1</a></li>
                        <li class="active">
                            <div class="pagination-item text-button">2</div>
                        </li>
                        <li><a href="#" class="pagination-item text-button">3</a></li>
                        <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </section>
@endsection
