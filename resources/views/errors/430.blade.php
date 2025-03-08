@extends('layout.app')
@section('title', __('Unauthorized'))
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="auth-page-wrapper py-0 d-flex justify-content-center align-items-center"
                style="min-height: 70vh !important;">

                <!-- auth-page content -->
                <div class="auth-page-content overflow-hidden p-0">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-8">
                                <div class="text-center">
                                    {{-- <img src="{{ asset('assets/images/error400-cover.png') }}" alt="error img"
                                        class="img-fluid"> --}}
                                    <div class="mt-3">
                                        <h3 class="text-uppercase text-danger">Range Exceeds Limit</h3>
                                        <p class="text-muted mb-4">
                                            The selected date range results in too much data to display, exceeding the
                                            allowed limit of <strong>20,000</strong> rows. For better performance, please
                                            adjust the date
                                            range.
                                        </p>
                                        <a href="{{ url()->previous() }}" class="btn btn-success">
                                            <i class="mdi mdi-home me-1"></i> Back to report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
