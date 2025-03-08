@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush
    <div class="page-content">
        <div class="container-fluid">


            <div class="card" id="contactList">
                <div class="card-header py-2">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
                        </div>
                        <div class="col-md-auto ms-auto">
                            <div class="d-flex gap-2">
                                <div class="mt-3 mt-lg-0">
                                    <form action="{{ url('development/cron-failed-fixed-list') }}" method="GET">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control border-1 dash-filter-picker shadows flatpickr-input active"
                                                        name="filter_date" data-provider="flatpickr" data-range-date="true"
                                                        data-date-format="d M, Y" data-default-date="{{ setDefultDate() }}"
                                                        readonly="readonly">
                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-soft-success">
                                                    <i class="ri-search-line align-middle me-1"> </i>
                                                    Filter
                                                </button>
                                            </div>
                                            <div class="col-auto">
                                                @if (request()->get('filter_date'))
                                                    <a href="{{ url('development/cron-failed-fixed-list') }}"
                                                        class="btn btn-soft-danger btn-icon waves-effect waves-light layout-rightside-btn d-flex align-items-center justify-content-center"
                                                        title="Clear Filter">
                                                        <i class="ri-close-circle-line fs-19"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-xxl-5 col-xl-7 col-lg-9 col-md-10">
                            <div class="accordion lefticon-accordion custom-accordionwithicon accordion-border-box"
                                id="accordionlefticon">
                                @forelse($records as $record)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $record->id }}">
                                            <a href="{{ url('development/cron-failed/' . $record->id) }}"
                                                class="accordion-button collapsed d-flex justify-content-between w-100"
                                                type="button">
                                                <span>
                                                    Scheduler Failed Time: {{ $record->failed_at ?? '' }}
                                                    <small class="small text-muted">
                                                        ({{ \Carbon\Carbon::parse($record->failed_at)->diffForHumans() ?? '' }})
                                                    </small>
                                                </span>

                                                <span class="small text-muted">
                                                    @if ($record->is_fixed)
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                        <span style="color: green;">Fixed</span>
                                                    @else
                                                        <i class="fas fa-times-circle" style="color: red;"></i>
                                                        <span style="color: red;">Not Fixed</span>
                                                    @endif
                                                </span>
                                            </a>
                                        </h2>

                                    </div>

                                @empty
                                    <p class="text-center text-danger">Data Not Found</p>
                                @endforelse
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $records->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="flipModalLabel">View Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-16" id="stockSku"> </h5>
                    <p class="text-muted mb-1" id="stockName">.</p>
                    <p class="text-muted mb-1" id="stockUnit">.</p>
                    <p class="text-muted mb-1" id="stockQTY"> </p>
                    <p class="text-muted mb-1" id="stockType"> </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @php
        function setDefultDate()
        {
            $today = now();
            $endOfMonth = now()->endOfMonth();

            return request()->get('filter_date', $today->format('d M, Y') . ' to ' . $endOfMonth->format('d M, Y'));
        }
    @endphp

    @push('scripts')
        <script>
            function viewItemByModal(payload) {
                setHtml('stockSku', `<b>Stock SKU:</b> ${payload.sku}`);
                setHtml('stockName', `<b>Name:</b> ${payload.item_name}`);
                setHtml('stockUnit', `<b>Unit:</b> ${payload.unit}`);
                setHtml('stockType', `<b>Type:</b> ${payload.product_type}`);
                setHtml('stockQTY', `<b>QTY:</b> ${payload.qty}`);
                $('#flipModal').modal('show');
            }

            function toggleView(recordId) {
                var previewView = document.getElementById('previewView' + recordId);
                var gridView = document.getElementById('gridView' + recordId);
                var toggleBtn = document.querySelector('.toggle-view-btn');

                // Toggle visibility between preview and grid view
                if (previewView.style.display === "none") {
                    previewView.style.display = "block";
                    gridView.style.display = "none";
                    toggleBtn.textContent = "Switch to Grid View"; // Update button text
                } else {
                    previewView.style.display = "none";
                    gridView.style.display = "block";
                    toggleBtn.textContent = "Switch to Preview"; // Update button text
                }
            }
        </script>
    @endpush

    <style>
        .page-link {
            border-radius: 5px;
            margin: 0 5px;
        }

        .btn-icon {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            line-height: 1 !important;
        }

        .custom-accordionwithicon .accordion-button::after {
            background-image: none !important;
            font-family: "Material Design Icons";
            content: "" !important;
            font-size: 1.1rem;
            vertical-align: middle;
            line-height: .8;
        }
    </style>
@endsection
