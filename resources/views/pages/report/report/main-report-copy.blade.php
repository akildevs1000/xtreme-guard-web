@extends('layout.app')
@section('title', $title)
@section('content')

    @push('styles')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> --}}


        <!-- SearchBuilder CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.4.0/css/searchBuilder.dataTables.min.css">
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
                                @foreach ($cols as $header)
                                    <th class="text-start">{{ $header['title'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                {{-- @dd($item) --}}
                                <tr>
                                    @foreach ($cols as $attr)
                                        <td>
                                            @php
                                                $value = data_get($item, $attr['name']);
                                            @endphp
                                            @if (is_array($value))
                                                {{ json_encode($value) }}
                                            @else
                                                {{ $value ?? 'N/A' }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

        <!-- SearchBuilder JS -->
        <script src="https://cdn.datatables.net/searchbuilder/1.4.0/js/dataTables.searchBuilder.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>


        <script>
            $(function() {
                loadTable();

                const element = document.querySelector('.dataTables_length label select');
                const choices = new Choices(element, {
                    searchEnabled: false
                });

            });


            function loadTable(filter = null) {
                // var columns = {!! json_encode($cols) !!};

                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    searching: true,
                    stateSave: false,
                    pageLength: 100,
                    scrollY: "50vh",
                    // columns: columns,
                    // order: [
                    //     [7, 'desc']
                    // ],
                    dom: 'QBlfrtip', // Q: Custom elements or custom functionality (like custom filters or components) B - buttons, f - filter, r - processing, t - table, i - info, p - pagination
                    buttons: [{
                            extend: 'copy',
                            className: 'custom-btn',
                            text: '<i class="fas fa-copy"></i>',
                            titleAttr: 'Copy'
                        },
                        {
                            extend: 'csv',
                            className: 'custom-btn',
                            text: '<i class="fas fa-file-csv"></i>',
                            titleAttr: 'CSV'
                        },
                        {
                            extend: 'excel',
                            className: 'custom-btn',
                            text: '<i class="fas fa-file-excel"></i>',
                            titleAttr: 'Excel'
                        },
                        {
                            extend: 'pdf',
                            className: 'custom-btn',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'PDF',
                            orientation: 'landscape',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            className: 'custom-btn',
                            text: '<i class="fas fa-print"></i>',
                            titleAttr: 'Print'
                        }
                    ],
                    searchBuilder: true,



                    searchBuilder: {
                        // columns: [8], // Specify the columns that have date values
                    },

                    // columnDefs: [{
                    //     targets: 7, // Column index with date data
                    //     render: function(data, type, row) {
                    //         console.log(type);

                    //         return type === 'date' ? new Date(data) : data;
                    //     }
                    // }]

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
        </script>
    @endpush

    <style>
        .dtsb-titleRow {
            display: none !important
        }

        .custom-btn {
            margin-right: 10px;
            background: #f0f0f7;
            border: 1px solid #dcdcdf;
            color: black;
        }

        .dataTables_length {
            float: right;
        }

        .dtsb-add {
            background: #f0f0f7 !important;
            border: 1px solid #dcdcdf !important;
            color: #3a3535;
        }

        .dtsb-add:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3 !important;
            color: white !important
        }

        div.dtsb-searchBuilder button.dtsb-button:hover {
            background-color: #0056b3 !important;
            cursor: pointer;
        }
    </style>
@endsection
