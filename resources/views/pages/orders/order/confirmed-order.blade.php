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

            <!-- start page title -->
            {{-- <x-breadcrumb title="Users" parent="Administration" /> --}}
            <!-- end page title -->

            <div class="card" id="contactList">
                <div class="card-header py-2">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
                        </div>

                        <div class="col-md-auto ms-auto">
                            <div class="d-flex gap-2">
                                {{-- <div class="d-flex align-items-center gap-2 grid-filter">
                                    <span class="text-muted flex-shrink-0">Sort by: </span>
                                    <select class="form-control mb-0" data-choices data-choices-search-false
                                        name="order_status_filter" id="choices-order_status_filter"
                                        onchange="filterByOrderStatus(this.value)">
                                        <option value="-1" selected>All</option>
                                        <option value="payment_completed">Payment Completed</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="new">New</option>
                                    </select>
                                </div> --}}
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Search for transactions..." id="custom-search-input">
                                    <i class="ri-search-line search-icon"> </i>
                                </div>
                                {{-- <a class="btn btn-primary buttons-excel buttons-html5 bg-primary text-white border-primary add-btn waves-effect waves-light"
                                    style="margin: 0 2.9px 0px 4px;" href="{{ route('import-order.index') }}"
                                    title="Render New Orders" onclick="this.querySelector('i').classList.add('fa-spin');">
                                    <i class="fas fa-sync-alt fa-lg" style="font-size: 12px;"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>TrackingID</th>
                                <th>Customer</th>
                                <th>Location</th>
                                <th>OrderValue</th>
                                <th>Type</th>
                                <th>OrderDate</th>
                                <th>ImportedDate</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script>
            $(function() {
                loadTable();
                const element = document.querySelector('.dataTables_length label select');
                const choices = new Choices(element, {
                    searchEnabled: false
                });

            });

            function filterByOrderStatus(filter) {}

            function loadTable(filter = null) {
                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    language: {
                        processing: '<i class="fas fa-spinner fa-spin"></i>',
                    },
                    serverSide: true,
                    "searching": true,
                    stateSave: false,
                    pageLength: 25,
                    "scrollY": "50vh",
                    ajax: {
                        url: '{{ url('order/confirmed-order') }}',
                        data: function(d) {
                            d.order_status_filter = filter || '-1';
                        },
                    },

                    columns: [{
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            data: 'tracking.shiping_reference_number',
                            name: 'tracking.shiping_reference_number',
                            orderable: false
                        },
                        {
                            data: 'customer.full_name',
                            name: 'customer.first_name',
                        },
                        {
                            data: 'shipping.address.city',
                            name: 'shipping.address',
                            // orderable: false
                        },
                        {
                            data: 'total',
                            name: 'total',
                            className: 'text-end'
                        },
                        {
                            data: 'order_type',
                            name: 'order_type'
                        },
                        // {
                        //     data: 'order_status',
                        //     name: 'order_status',
                        //     // className: 'text-center',
                        //     render: function(data, type, row) {
                        //         return orderStatus(data);
                        //     }
                        // },
                        {
                            data: 'order_date',
                            name: 'order_date',
                            render: function(data, type, row) {
                                return getDateFromDateAndTime(data);
                            }
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, row) {
                                return data;
                                // return getDateFromDateAndTime(data);
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    order: [
                        [6, 'desc']
                    ]
                }); //end datatable

                // Your custom search logic
                $('#custom-search-input').keyup(function(e) {
                    var searchTerm = $(this).val();
                    table.search(searchTerm).draw(); // Use global search instead of column-specific search
                    // table.columns(1).search(searchTerm).draw(); // Assuming 'name' column index is 1
                });

                let searchValue = $('#datatable_filter label input').val();
                $('#custom-search-input').val(searchValue);
                var filterItem = "";
                $('#choices-order_status_filter').change(function(e) {
                    filterItem = $(this).val();
                    table.search(filterItem == -1 ? ' ' : filterItem).draw();
                });

            }
        </script>
    @endpush

    <style>
        #datatable-crud_processing {
            font-size: 40px !important;
            padding: 15px 0 !important;
            color: #244067 !important;
        }

        .fresh-loader {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120px;
            height: 120px;
            margin: -60px 0 0 -60px;
            -webkit-animation: spin 4s linear infinite;
            -moz-animation: spin 4s linear infinite;
            animation: spin 4s linear infinite;
        }

        @-moz-keyframes spin {
            100% {
                -moz-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
