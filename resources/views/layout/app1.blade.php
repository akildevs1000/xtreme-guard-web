<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('include.head')
    @vite(['resources/css/app.css'])

    <x-loaders.page-preloader />
</head>

<body>

    <div id="layout-wrapper">

        @include('include.header')

        @include('include.sidebar')

        <div class="main-content">
            @yield('content')
            @include('include.footer')
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        @stack('scripts')
    </div>
    <script src="{{ url('/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ url('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/assets/js/app.js') }}"></script>
    @vite(['resources/js/app.js'])

</body>

</html>
