@extends('layout.app')
@section('title', $title)
@section('content')

    @push('styles')
        <!--datatable css-->
        <link rel="stylesheet" href="{{ asset('assets/report/css/dataTables.bootstrap5.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/report/css/buttons.dataTables.min.css') }}" />

        <!--datatable responsive css-->
        <link rel="stylesheet" href="{{ asset('assets/report/css/responsive.bootstrap.min.css') }}" />

        <!-- SearchBuilder CSS -->
        <link rel="stylesheet" href="{{ asset('assets/report/css/searchBuilder.dataTables.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/report/css/dataTables.dateTime.min.css') }}" />
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
                    <table id="datatable-crud" class="display nowrap table-sm table stripe dt-responsive table-bordered"
                        style="width:100%; {{ count($cols) > 11 ? 'table-layout:fixed' : '' }} ">
                        <thead>
                            <tr>
                                @foreach ($cols as $header)
                                    <th class="{{ $header['className'] ?? '' }}"
                                        stylea="{{ $header['style'] ?? 'width:auto' }}">
                                        {{ $header['title'] }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                {{-- @dd($item) --}}
                                <tr>
                                    @foreach ($cols as $attr)
                                        <td class="{{ $attr['className'] ?? 'text-start' }}"
                                            stylea="{{ $attr['style'] ?? 'width:auto' }}">
                                            @php
                                                $value = data_get($item, $attr['name']);
                                            @endphp
                                            @if (is_array($value))
                                                {{ json_encode($value) }}
                                            @else
                                                {{ $value ?? '' }}
                                                {{-- {{ $value ?? 'N/A' }} --}}
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
        {{-- <script src="{{ asset('assets/report/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/report/js/jszip.min.js') }}"></script>

        <!-- SearchBuilder JS -->
        <script src="{{ asset('assets/report/js/dataTables.searchBuilder.min.js') }}"></script>
        <script src="{{ asset('assets/report/js/dataTables.dateTime.min.js') }}"></script> --}}

        @php
            $scripts = [
                'assets/report/js/jquery.dataTables.min.js',
                'assets/report/js/dataTables.bootstrap5.min.js',
                'assets/report/js/dataTables.responsive.min.js',
                'assets/report/js/dataTables.buttons.min.js',
                'assets/report/js/buttons.bootstrap5.min.js',
                'assets/report/js/buttons.html5.min.js',
                'assets/report/js/buttons.print.min.js',
                'assets/report/js/pdfmake.min.js',
                'assets/report/js/vfs_fonts.js',
                'assets/report/js/jszip.min.js',
                'assets/report/js/dataTables.searchBuilder.min.js',
                'assets/report/js/dataTables.dateTime.min.js',
            ];
        @endphp

        @foreach ($scripts as $script)
            <script src="{{ asset($script) }}"></script>
        @endforeach

        <script>
            $(function() {
                loadTable();
                appendDateRange();
                const element = document.querySelector('.dataTables_length label select');
                const choices = new Choices(element, {
                    searchEnabled: false
                });
            });

            function appendDateRange() {
                let dateRange = '{{ $dateRange }}';
                tempBtn =
                    `<span title="Selected Date Range" class="fs-14 fw-bold text-danger btn btn-secondary range-btn" style="align-self: center;">${ dateRange }</span>`;

                tempAlert =
                    ` <div class="alert alert-success text-success1 alert-top-border mb-0 py-1 d-flex align-items-center" role="alert"> <i class=" ri-calendar-todo-fill me-3 align-middle fs-16 text-success"></i>
                    <strong>Selected Date Range</strong> :  ${dateRange} </div>`;

                // $('.dt-buttons').append(temp)
                $('.dt-buttons').append(tempAlert)
            }

            function loadTable(filter = null) {
                var columns = {!! json_encode($cols) !!};
                var orderBy = {!! json_encode($orderBy) !!};
                var btnClass = "alert alert-success alert-top-border mb-0 py-1 d-flex align-items-center me-1";
                var btnIClass = "fs-16 text-success align-middle";
                // var orderBy = {{ Js::from($orderBy) }};

                let orientation;
                let pageSize;

                if (columns.length >= 16) {
                    orientation = 'landscape';
                    pageSize = 'A2';
                } else if (columns.length >= 9) {
                    orientation = 'landscape';
                    pageSize = 'A3';
                } else if (columns.length > 8) {
                    orientation = 'landscape';
                    pageSize = 'A4';
                } else if (columns.length >= 5) {
                    orientation = 'portrait';
                    pageSize = 'A5';
                } else {
                    orientation = 'portrait';
                    pageSize = 'A6';
                }

                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    searching: true,
                    stateSave: false,
                    // pageLength: 100,
                    pageLength: 100, // Default rows per page
                    lengthMenu: [5, 10, 25, 50, 100, 500], // Options for users to select
                    scrollY: "50vh",
                    order: orderBy,
                    dom: 'QBlfrtip', // Q: Custom elements or custom functionality (like custom filters or components) B - buttons, f - filter, r - processing, t - table, i - info, p - pagination
                    buttons: [{
                            extend: 'copy',
                            className: btnClass,
                            text: `<i class="fas fa-copy ${btnIClass}"></i>`,
                            // titleAttr: 'Copy',
                            init: function(api, node, config) {
                                $(node).attr('data-title', 'Copy'); // Add data-title to the button
                            }
                        },
                        {
                            extend: 'csv',
                            className: btnClass,
                            text: `<i class="fas fa-file-csv ${btnIClass}"></i>`,
                            // titleAttr: 'CSV'
                            init: function(api, node, config) {
                                $(node).attr('data-title', 'CSV'); // Add data-title to the button
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: btnClass,
                            text: `<i class="fas fa-file-excel ${btnIClass}"></i>`,
                            // titleAttr: 'Excel',
                            init: function(api, node, config) {
                                $(node).attr('data-title', 'Excel'); // Add data-title to the button
                            },
                            exportOptions: {
                                columns: ':visible', // Export only visible columns
                                modifier: {
                                    page: 'all' // Export all data from all pages
                                },
                                header: false // Removes the header row
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                                // $('row c[r^="A1"]', sheet).each(function() { // Find header row and remove it
                                //     $(this).remove();
                                //     // console.log(this);
                                // });

                                $('row c[r="A1"]', sheet).each(function() {
                                    $(this).remove(); // Remove only A1
                                });


                                // Additional customization can be done here if needed
                            }
                        },
                        {
                            extend: 'pdf',
                            className: btnClass,
                            text: `<i class="fas fa-file-pdf ${btnIClass}"></i>`,
                            // titleAttr: 'PDF',
                            init: function(api, node, config) {
                                $(node).attr('data-title', 'PDF'); // Add data-title to the button
                            },
                            orientation: orientation, // or 'landscape'
                            pageSize: pageSize, // 'A3', 'A5', etc.
                            exportOptions: {
                                columns: ':visible' // Only export visible columns
                            },
                            customize: function(doc) {

                                doc.pageMargins = 40;

                                // Customize PDF formatting (e.g., header, footer, styles)
                                doc.styles.title = {
                                    color: '#"#2d4154"',
                                    fontSize: '20',
                                    alignment: 'center'
                                };
                                doc.content[0];
                                // doc.content[1].table.width = ['20%', '20%', '20%', '20%', '20%', '20%'];

                                // Remove the first item from the doc.content array (which is the header)
                                doc.content.splice(0, 1);

                            }
                        },
                        {
                            extend: 'print',
                            className: btnClass,
                            text: `<i class="fas fa-print ${btnIClass}"></i>`,
                            // titleAttr: 'Print',
                            init: function(api, node, config) {
                                $(node).attr('data-title', 'PDF'); // Add data-title to the button
                            },
                            customize: function(win) {
                                $(win.document.body).find('h1').remove(); // Remove default title
                                // $(win.document.body).find('table thead').remove();
                                // Remove header row from the table
                            }
                        }
                    ],
                    searchBuilder: true,

                    responsive: false,
                    scrollX: true,

                    // searchBuilder: {
                    // columns: [8], // Specify the columns that have date values
                    // },

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
        #datatable-crud_wrapper .btn:hover,
        #datatable-crud_wrapper .btn:active {
            background-color: #0ab39c !important;
            border: 1px solid #0ab39c !important;
        }

        .btn:hover span i,
        .btn:active span i {
            color: white !important;
        }

        .dtsb-titleRow {
            display: none !important
        }

        .custom-btn {
            margin-right: 10px;
            background: #f0f0f7;
            border: 1px solid #dcdcdf;
            color: black;
        }

        .range-btn {
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

        div.dtsb-searchBuilder button.dtsb-button:hover {
            background-color: #0ab39c !important;
            cursor: pointer !important;
            color: white !important
        }

        .dtsb-add.dtsb-button {
            all: unset !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: #6c757d !important;
            color: #0ab39c !important;
            border: 1px solid #edededf5 !important;
            border-top: 2px solid #0ab39c !important;
            margin-bottom: 0 !important;
            padding: 0.25rem 0.5rem !important;
            text-align: center !important;
            background-color: white !important;
            border-radius: 3px !important;
        }

        /* Tooltip */
        .btn-group button:hover::after {
            content: attr(data-title);
            position: absolute;
            top: -35px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease-in-out, visibility 0.4s ease-in-out;
        }

        .btn-group button:hover::after {
            opacity: 1;
            visibility: visible;
        }
    </style>


@endsection
