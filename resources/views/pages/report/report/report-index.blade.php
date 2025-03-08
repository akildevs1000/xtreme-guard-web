@extends('layout.app')
@section('title', $title)
@section('content')

    @push('styles')
    @endpush

    <div class="page-content">
        <div class="container-fluid ">
            <div class="card" id="contactList">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height:70vh">
                    <div class="row" style="width:600px">
                        <div class="col-xxl-12 col-md-12 col-lg-12">
                            <div class="card-height-100 border border-2 my-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Filter Date Range</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('report', ['reporttype' => $reportType]) }}" method="POST"
                                        autocomplete="off" target="_blank">
                                        @csrf
                                        <div class="mb-3">
                                            <x-input.date-group label="Start Date" name="start_date"
                                                placeholder="Select date" />
                                        </div>

                                        <div class="mb-3">
                                            <x-input.date-group label="End Date" name="end_date"
                                                placeholder="Select date" />
                                        </div>

                                        <button type="submit" class="btn btn-success w-100 mt-3" type="submit">
                                            Filter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    @endpush


@endsection
