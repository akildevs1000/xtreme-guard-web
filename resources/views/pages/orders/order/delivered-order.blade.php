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
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Search for transactions..." id="custom-search-input">
                                    <i class="ri-search-line search-icon"> </i>
                                </div>
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
                    serverSide: true,
                    "searching": true,
                    stateSave: false,
                    pageLength: 25,
                    "scrollY": "50vh",
                    ajax: {
                        url: '{{ url('order/delivered-order') }}',
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
