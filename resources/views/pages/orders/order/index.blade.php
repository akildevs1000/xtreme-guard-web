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
                                @canOrRole('orders-import-orders-view')
                                <a class="btn btn-primary buttons-excel buttons-html5 bg-primary text-white border-primary add-btn waves-effect waves-light"
                                    style="margin: 0 2.9px 0px 4px;" href="{{ route('import-order.index') }}"
                                    title="Render Stocks"
                                    onclick="event.preventDefault();
                                     console.log('Button clicked');
                                     const button = this;
                                     button.querySelector('i').classList.add('fa-spin');
                                     document.querySelector('#render-loader').classList.remove('d-none');
                                     setTimeout(() => { window.location.href = '{{ route('import-order.index') }}'; }, 500);">
                                    <i class="fas fa-sync-alt fa-lg" style="font-size: 12px;"></i>
                                </a>
                                @endcanOrRole

                                {{--
                                <button class="buttonload">
                                    <i class="fa fa-spinner fa-spin"></i>Loading
                                </button>

                                <button class="buttonload">
                                    <i class="fa fa-circle-o-notch fa-spin"></i>Loading
                                </button>

                                <button class="buttonload">
                                    <i class="fa fa-refresh fa-spin"></i>Loading
                                </button> --}}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>OrderID</th>
                                <th>Customer</th>
                                <th>Location</th>
                                <th>OrderValue</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>OrderDate</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <x-loaders.render-loader />

        </div>
    </div>

    @push('scripts')
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

            // function filterByOrderStatus(filter) {}

            function loadTable(filter = null) {
                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    serverSide: true,
                    "searching": true,
                    stateSave: false,
                    pageLength: 25,
                    "scrollY": "50vh",
                    ajax: {
                        url: '{{ route('order.index') }}',
                        data: function(d) {
                            d.order_status_filter = filter || '-1';
                        },
                    },
                    // "sDom": 'Rfrtlip',
                    columns: [{
                            data: 'order_id',
                            name: 'order_id'
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
                        {
                            data: 'is_shipped',
                            name: 'is_shipped',
                            // className: 'text-center',
                            render: function(data, type, row) {
                                // return data;
                                return confirmedOrderStatus(data);
                            }
                        },
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
                });

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


@endsection
