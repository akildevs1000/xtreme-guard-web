@extends('layout.app')
@section('title', $title ?? '')
@section('content')
    @push('styles')

        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Create Pickup
                    </div>
                    <form action="{{ route('pickup.store') }}" id="create-pickup-form" method="POST">
                        @csrf
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <label class="col-auto col-form-label">
                                            Location:
                                        </label>
                                        <div class="col-lg-5">
                                            <div class="mb-3">
                                                <x-input.select-group label="" name="shipper_location" itemText="name"
                                                    itemValue="value" :items="[
                                                        ['name' => 'Sharjah', 'value' => 'sharjah'],
                                                        ['name' => 'Abudhabi', 'value' => 'abudhabi'],
                                                    ]" data-choices-search-false
                                                    value="abudhabi" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div style=" border: 1px solid #e2e3ea; padding: 20px 10px; border-radius: 5px; "
                                                class="mt-3">
                                                <legend class="fs-14"
                                                    style="position: relative;background: white;width: auto;top: -32px;padding: 0px 10px;border: 1px solid #f3f3f9;">
                                                    Order list
                                                </legend>
                                                <div class="row">

                                                    @foreach ($orders as $order)
                                                        {{-- {{ $order->is_pickuped }} --}}
                                                        <div class="col-md-3 col-lg-2 col-sm-6">
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="order-{{ $order->order_id }}" name="order_id[]"
                                                                    value="{{ $order->order_id }}">
                                                                {{-- value="{{ $order->order_id }}" @checked($order->is_pickuped)> --}}
                                                                <label class="form-check-label"
                                                                    for="order-{{ $order->order_id }}">
                                                                    {{ $order->order_id }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                    <button type="button" class="btn btn-soft-success">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(function() {});
            </script>
        @endpush

        <style>
            .choices__list--dropdown {
                width: 100% !important;
            }
        </style>

    @endsection
