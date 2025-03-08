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

        {{-- https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css
https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css
https://cdn.datatables.net/searchbuilder/1.8.0/css/searchBuilder.bootstrap5.css
https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css --}}

        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.8.0/css/searchBuilder.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css" /> --}}
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
                    {{-- <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered" --}}
                    <table id="example" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-start">ItemCode</th>
                                <th>Item</th>
                                <th class="text-start">QTY</th>
                                <th>Unit</th>
                                <th class="text-start">Barcode</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($stocks as $item)
                                <tr>
                                    <td class="text-start">{{ $item->item_code ?? '' }}</td>
                                    <td class="text-start">{{ $item->item ?? '' }}</td>
                                    <td class="text-start">{{ $item->qty ?? '' }}</td>
                                    <td class="text-start">{{ $item->unit ?? '' }}</td>
                                    <td class="text-start">{{ $item->barcode ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th class="text-start">OrderID</th>
                                <th>CustomerName</th>
                                <th>Location</th>
                                <th>OrderValue</th>
                                <th class="text-start">OrderDate</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>


    <x-modal.dialog-modal titleName="Pickup Tracking Information" idName="trackingModal" size="modal-lg"
        style="width:700px">
        <x-card.grid-card titleName="Pickup Tracking" class="h-100">
            <div class="vstack gap-1" id="order-info">
            </div>
        </x-card.grid-card>
    </x-modal.dialog-modal>

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
            $(document).ready(function() {
                new DataTable('#example', {
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
