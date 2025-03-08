<link rel="stylesheet" href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/icons5.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom-table.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">

@php
    $manifest = app()->environment('production') ? asset('manifest-production.json') : asset('manifest-local.json');
@endphp

{{-- <link rel="test" href="{{ env('APP_ENV') . '  ' . app()->environment('production') }}"> --}}
<link rel="manifest" href="{{ $manifest }}">

@stack('styles')
