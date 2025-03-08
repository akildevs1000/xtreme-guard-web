@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css" />
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


        <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.8.0/css/searchBuilder.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css" />
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div class="card" id="contactList">
                <div class="card-header py-2">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="report-table" class="display table-sm table stripe dt-responsive table-bordered"
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
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/searchbuilder/1.8.0/js/dataTables.searchBuilder.js"></script>
        <script src="https://cdn.datatables.net/searchbuilder/1.8.0/js/searchBuilder.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.bootstrap5.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>


        <script>
            // $(document).ready(function() {
            //                 var columns = {!! json_encode($cols) !!};
            //                 console.log(columns);

            //                 $('#report-table').DataTable({
            //                     processing: true,
            //                     serverSide: true,
            //                     ajax: {
            //                         url: '{{ url('report/received-order') }}', // Replace with your route
            //                     },

            //                     columns: columns,
            //                     dom: 'QBlfrtip', // Enables SearchBuilder with buttons
            //                     buttons: [
            //                         'copy', 'csv', 'excel', 'pdf', 'print'
            //                     ],
            //                     searchBuilder: {
            //                         columns: columns.map((col, index) => index) // Enables all columns for search builder
            //                     }
            //                 });
            //             });


            $(document).ready(function() {

                var columns = {!! json_encode($cols) !!};

                var table = $('#report-table').DataTable({

                    processing: true,
                    serverSide: true,
                    "searching": true,
                    stateSave: false,
                    "scrollY": "50vh",
                    ajax: {
                        url: '{{ url('report/received-order') }}', // Replace with your route
                        data: function(d) {
                            console.log(d);

                            // Additional data you want to send to the server
                            d.role = $('#choices-roles').val() || '-1';
                        }
                    },

                    columns: columns,

                    layout: {
                        top1: 'searchBuilder',
                        topStart: {
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
                            ]
                        }
                    }
                });
            });
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
