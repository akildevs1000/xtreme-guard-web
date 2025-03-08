@extends('layout.app-site')

@section('content')
    <section class="flat-spacing">
        <div class="container">
            <div class="tf-grid-layout tf-col-2 lg-col-4">
                @foreach ($categories as $category)
                    <div class="collection-position-2 radius-lg style-3 hover-img">
                        <a class="img-style">
                            <img class="lazyload" data-src="{{ $category->img }}" src="{{ $category->img }}" alt="banner-cls">
                        </a>
                        <div class="content">
                            <a href="#" class="cls-btn">
                                <b class="text">{{ $category->name }}</b>
                                {{-- <span class="count-item text-secondary"> 12 items</span> --}}
                                <i class="icon icon-arrowUpRight"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="flat-spacing">
        <div class="container">
            <div class="heading-section-2 wow fadeInUp">
                <h3 class="heading">Explore Categories</h3>
                {{-- <a href="shop-collection.html" class="btn-line">View All Collection</a> --}}
            </div>
        </div>
        <div class="container-full slider-layout-right wow fadeInUp" data-wow-delay="0.1s" style="margin-right: auto;">
            <div dir="ltr" class="swiper tf-sw-categories" data-preview="6.2" data-tablet="3.2" data-mobile="2.2"
                data-space-lg="20" data-space-md="20" data-space="15" data-pagination="1" data-pagination-md="1"
                data-pagination-lg="1">
                <div class="swiper-wrapper">
                    <!-- 1 -->

                    <div class="swiper-slide">
                        <div class="collection-position-2 hover-img">
                            <a class="img-style">
                                <img class="lazyload" data-src="{{ asset('site/images/collections/cls1.jpg') }}"
                                    src="{{ asset('site/images/collections/cls1.jpg') }}" alt="banner-cls">
                            </a>
                            <div class="content">
                                <a href="shop-collection.html" class="cls-btn">
                                    <h6 class="text">New in</h6><i class="icon icon-arrowUpRight"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    @foreach ($categories as $category)
                        {{-- <div class="swiper-slide">
                            <div class="collection-position-2 hover-img">
                                <a class="img-style">
                                    <img class="lazyload" data-src="{{ asset('site/images/collections/cls1.jpg') }}"
                                        src="{{ asset('site/images/collections/cls1.jpg') }}" alt="banner-cls">
                                </a>
                                <div class="content">
                                    <a href="shop-collection.html" class="cls-btn">
                                        <h6 class="text">New in</h6><i class="icon icon-arrowUpRight"></i>
                                    </a>
                                </div>
                            </div>
                        </div> --}}

                        <div class="swiper-slide">
                            <div class="collection-position-2 hover-img">
                                <a class="img-style">
                                    <img class="lazyload" data-src="{{ $category->img }}" src="{{ $category->img }}"
                                        alt="banner-cls">
                                </a>
                                <div class="content">
                                    <a href="shop-collection.html" class="cls-btn">
                                        <h6 class="text">{{ $category->name }}</h6><i class="icon icon-arrowUpRight"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </section>



    <style>
        .image-container {
            display: flex;
            gap: 10px;
        }

        .image-container img {
            width: 200px;
            /* Set fixed width */
            height: 200px;
            /* Set fixed height */
            object-fit: cover;
            /* Ensures the image fills the box */
            border: 2px solid black;
            /* Optional: Just for visualization */
        }
    </style>

    <div class="image-container">
        <img src="https://placehold.co/300x400" alt="Image 1">
        <img src="https://placehold.co/400x600" alt="Image 2">
    </div>
@endsection
