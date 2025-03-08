@extends('layout.app')
@section('title', $title)
@section('content')

    @push('styles')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


        <!-- SearchBuilder CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.4.0/css/searchBuilder.dataTables.min.css">
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
                                {{-- <td>OrderID</td> --}}
                                @foreach ($cols as $header)
                                    <th class="text-start">{{ $header['title'] }}</th>
                                @endforeach
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
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>



        <!-- SearchBuilder JS -->
        <script src="https://cdn.datatables.net/searchbuilder/1.4.0/js/dataTables.searchBuilder.min.js"></script>


        <script>
            $(function() {
                loadTable();

                const element = document.querySelector('.dataTables_length label select');
                const choices = new Choices(element, {
                    searchEnabled: false
                });

            });


            function loadTable(filter = null) {
                var columns = {!! json_encode($cols) !!};
                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    stateSave: false,
                    pageLength: 100,
                    scrollY: "50vh",
                    ajax: {
                        url: '{{ url('report/received-order') }}', // Replace with your route
                        data: function(d) {
                            // Append SearchBuilder parameters
                            // d.searchBuilder = $('#datatable-crud').DataTable().searchBuilder().getDetails();
                            console.log(d);

                        }
                    },
                    columns: columns,
                    order: [
                        [1, 'desc']
                    ],
                    dom: 'QBlfrtip', // Q: Custom elements or custom functionality (like custom filters or components) B - buttons, f - filter, r - processing, t - table, i - info, p - pagination
                    buttons: [{
                            extend: 'copy',
                            className: 'custom-btn'
                        },
                        {
                            extend: 'csv',
                            className: 'custom-btn'
                        },
                        {
                            extend: 'excel',
                            className: 'custom-btn'
                        },
                        {
                            extend: 'pdf',
                            className: 'custom-btn'
                        },
                        {
                            extend: 'print',
                            className: 'custom-btn'
                        }
                    ],
                    searchBuilder: true
                });

                $('#custom-search-input').keyup(function(e) {
                    var searchTerm = $(this).val();
                    table.search(searchTerm).draw();
                });

                let searchValue = $('#datatable_filter label input').val();
                $('#custom-search-input').val(searchValue);
                var filterItem = "";
                $('#choices-order_status_filter').change(function(e) {
                    filterItem = $(this).val();
                    table.search(filterItem == -1 ? ' ' : filterItem).draw();
                });
            }




            // $(document).ready(function() {
            //     var columns = {!! json_encode($cols) !!};
            //     console.log(columns);

            //     $('#report-table').DataTable({
            //         processing: true,
            //         serverSide: true,
            //         ajax: {
            //             url: '{{ url('report/received-order') }}', // Replace with your route
            //         },

            //         columns: columns,
            //         dom: 'QBlfrtip', // Enables SearchBuilder with buttons
            //         // dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"><ip>',

            //         buttons: [
            //             'copy', 'csv', 'excel', 'pdf', 'print'
            //         ],
            //         // searchBuilder: {
            //         //     columns: columns.map((col, index) => index) // Enables all columns for search builder
            //         // }
            //     });
            // });


            // $(document).ready(function() {

            //     var columns = {!! json_encode($cols) !!};

            //     var table = $('#report-table').DataTable({

            //         processing: true,
            //         serverSide: true,
            //         "searching": true,
            //         stateSave: false,
            //         "scrollY": "50vh",
            //         ajax: {
            //             url: '{{ url('report/received-order') }}', // Replace with your route
            //             data: function(d) {
            //                 // Additional data you want to send to the server
            //                 d.role = $('#choices-roles').val() || '-1';
            //             }
            //         },

            //         columns: columns,

            //         layout: {
            //             top1: 'searchBuilder',
            //             topStart: {
            //                 buttons: [{
            //                         extend: 'copy',
            //                         className: 'custom-btn'
            //                     },
            //                     {
            //                         extend: 'csv',
            //                         className: 'custom-btn'
            //                     },
            //                     {
            //                         extend: 'excel',
            //                         className: 'custom-btn'
            //                     },
            //                     {
            //                         extend: 'pdf',
            //                         className: 'custom-btn'
            //                     },
            //                     {
            //                         extend: 'print',
            //                         className: 'custom-btn'
            //                     }
            //                 ]
            //             }
            //         }
            //     });
            // });
        </script>
    @endpush

    <style>
        .dtsb-titleRow {
            display: none !important
        }

        .custom-btn {
            margin-right: 10px;
            /* Adjust the value to control the gap */
        }

        .dataTables_length {
            float: right;
        }

        .dtsb-add {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: #fff !important;
        }

        .dtsb-add:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3 !important;
        }
    </style>
@endsection
