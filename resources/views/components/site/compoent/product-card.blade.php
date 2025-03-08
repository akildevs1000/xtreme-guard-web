@props([
    'products' => [],
])

{{-- @dd($products) --}}

{{-- {{ $products?->mainImage?->image }} --}}
<div class="card-product grid" data-availability="In stock" data-brand="nike">
    <div class="card-product-wrapper" style="background: #ECEFF2;">
        <a href="{{ url('product', ['id' => $products?->id]) }}" class="product-img">
            <img class="lazyload img-product" data-src="{{ $products?->mainImage?->image }}"
                src="{{ $products?->mainImage?->image }}" alt="image-product">
            <img class="lazyload img-hover" data-src="{{ $products?->mainImage?->image }}"
                src="{{ $products?->mainImage?->image }}" alt="image-product">
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
            {{-- <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">View Product</a> --}}
            <a href="{{ url('product', ['id' => $products?->id]) }}" class="btn-main-product">
                View Product
            </a>
        </div>
    </div>
    <div class="card-product-info">
        <a href="" class="title link">{{ $products?->name ?? '' }}</a>
        <div class="price">
            <span class="old-price">${{ $products?->original_price ?? '' }}</span>
            <span class="current-price">${{ $products?->sale_price ?? '' }}</span>
        </div>
    </div>
</div>



{{-- <div class="card-product grid" data-availability="In stock" data-brand="nike">
    <div class="card-product-wrapper">
        <a href="product-detail.html" class="product-img">
            <img class="lazyload img-product" data-src="{{ asset('site/images/products/womens/women-176.jpg') }}"
                src="{{ asset('site/images/products/womens/women-176.jpg') }}" alt="image-product">
            <img class="lazyload img-hover" data-src="{{ asset('site/images/products/womens/women-176.jpg') }}"
                src="{{ asset('site/images/products/womens/women-176.jpg') }}" alt="image-product">
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
            <a href="#shoppingCart" data-bs-toggle="modal" class="btn-main-product">View Product</a>
        </div>
    </div>
    <div class="card-product-info">
        <a href="product-detail.html" class="title link">Polarized sunglasses</a>
        <div class="price"><span class="old-price">$98.00</span> <span class="current-price">$79.99</span></div>
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
</div> --}}
