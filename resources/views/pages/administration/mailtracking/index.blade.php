@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
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
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-muted flex-shrink-0">Filter by: </span>
                                    <select class="form-control mb-0" data-choices data-choices-search-false name="mailType"
                                        id="choices-mailType" onchange="renderTable(this.value)">
                                        <option value="-1" selected>All</option>
                                        <option value="1">Confirmed Status</option>
                                        <option value="2">Shipment Status</option>
                                        <option value="3">Out for Delivery</option>
                                        <option value="4">Delivered</option>
                                        <option value="5">Return Created</option>
                                        <option value="10">Low Stock</option>
                                    </select>
                                </div>
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
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="table-loader"
        style="display: none; position: absolute; width: 100%; height: 100%; background:white; z-index: 1000; top: 0; left: 0; text-align: center;">
        <div style="margin-top: 20%; font-size: 20px; color: #555;">Loading...</div>
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

            const renderTable = (value) => {
                const loaderId = '#table-loader';

                $(loaderId).show();
                if ($.fn.DataTable.isDataTable('#datatable-crud')) {
                    $('#datatable-crud').DataTable().destroy();
                }

                console.log(value);
                loadTable();

                setTimeout(() => {
                    $(loaderId).hide();
                }, 1000);
            }

            function orderView(value, data, row) {

                if (!value) {
                    return '';
                }

                return `<a href="${row.view_order}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" target="_blank">${value}</a>`;
            }

            function loadTable() {
                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    pageLength: 100,
                    serverSide: true,
                    searching: true,
                    stateSave: true,
                    scrollY: "50vh",
                    ajax: {
                        url: '{{ url('administration/mail-tracking') }}',
                        data: function(d) {
                            d.mailType = $('#choices-mailType').val() || '-1';
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id',
                            title: '#'
                        },
                        {
                            data: 'order_id',
                            name: 'order_id',
                            title: 'OrderID',
                            render: (value, data, row) => orderView(value, data, row)

                        },
                        {
                            data: 'subject',
                            name: 'subject',
                            title: 'Subject'
                        },
                        {
                            data: 'mail_type',
                            name: 'mail_type',
                            title: 'MailType',
                            render: value => typeBadge(value)
                        },
                        {
                            data: 'from',
                            name: 'from',
                            title: 'From'
                        },
                        {
                            data: 'to',
                            name: 'to',
                            title: 'To'
                        },
                        {
                            data: 'attachment_path',
                            name: 'attachment_path',
                            title: 'Attachment',
                            orderable: false,
                            searchable: false,
                            render: value => previewLink(value)

                        },
                        {
                            data: 'preview',
                            name: 'preview',
                            title: 'Preview',
                            orderable: false,
                            searchable: false,
                            render: value => previewLink(value)

                        },
                        {
                            data: 'description',
                            name: 'description',
                            title: 'Description'
                        },
                        {
                            data: 'is_sent',
                            name: 'is_sent',
                            title: 'MessageSent',
                            orderable: false,
                            searchable: false,
                            render: value => isSend(value)
                        },
                        {
                            data: 'sent_at',
                            name: 'sent_at',
                            title: 'SentAt',
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });

                $('#custom-search-input').keyup(function() {
                    var searchTerm = $(this).val();
                    table.search(searchTerm).draw();
                });

                let searchValue = $('#datatable_filter label input').val();
                $('#custom-search-input').val(searchValue);
            }

            const typeBadge = (type) => {
                const arrType = {
                    1: 'Confirmed Status Mail',
                    2: 'Shipment Status Mail',
                    3: 'Out for Delivery Status Mail',
                    4: 'Delivered Status Mail',
                    5: 'Return Created Status Mail',
                    10: 'Low Stock Alert',
                };
                return `<span class="badge bg-success my-2">${arrType[type] || 'Unknown'}</span>`;
            };

            const isSend = (sts) => {
                const arrType = {
                    1: '<i class="fas fa-check-square"></i> Sent',
                    2: '<i class="fab fa-times-circle text-danger"></i> Not Sent'
                }
                return `<span class="badge bg-${sts ? 'success' : 'danger'}">${arrType[sts] || ''}</span>`;
            }

            function previewLink(link) {
                if (!link) {
                    return '';
                }

                return `<a href="${link}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" target="_blank">Click to Preview</a>`
            }
        </script>
    @endpush

    <style>
        .choices__list--dropdown {
            width: 142% !important
        }
    </style>
@endsection
