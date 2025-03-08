@extends('layout.app-site')

@section('content')
    <section class="flat-spacing">
        <div class="container">
            <div class="tf-grid-layout tf-col-2 lg-col-5">
                @foreach ($categories as $category)
                    <div class="collection-position-2 radius-lg style-3 hover-img">
                        <a class="img-style" style=" background: #ECEFF2;">
                            <img class="lazyload" data-src="{{ $category->img }}" src="{{ $category->img }}" alt="banner-cls">
                        </a>
                        <div class="content">
                            <a href="#" class="cls-btn cls-btn d-flex justify-content-center">
                                <b class="text fs-13">{{ $category->name }}</b>
                                {{-- <i class="icon icon-arrowUpRight"></i> --}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

    <x-site.home.testimonial />

    @foreach ($products as $prodduct)
        <x-site.home.bestsale :products="$prodduct" />
    @endforeach

    <x-site.home.iconbox />

    <x-site.home.special-banner />
@endsection
