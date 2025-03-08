<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Mirnah Technology Systems" name="description" />
    <meta content="Mirnah" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | OMS</title>
    {{-- <title>{{ config('app.name', 'OMS') }}</title> --}}
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />

    @include('include.head')

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

        @include('include.foot')

        <x-notification.toastify />

        @stack('scripts')
    </div>

    <script src="{{ asset('sw.js') }}"></script>

    <script>
        $(document).ready(function() {
            // console.log(navigator);
            // console.log("serviceWorker" in navigator);
        });

        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/oms/public/sw.js").then(
                (registration) => {
                    // console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    // console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            // console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>
