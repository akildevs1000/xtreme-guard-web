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
                                <x-btn.add-btn isAdd="true" routeName="pickup.create" title="Create Pickup" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>PickupID</th>
                                <th>GUID</th>
                                <th>OderIDs</th>
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

    <x-modal.dialog-modal titleName="Pickup Tracking Information" idName="trackingModal" size="modal-lg"
        style="width:700px">
        <x-card.grid-card titleName="Pickup Tracking" class="h-100">
            <div class="vstack gap-1" id="order-info">
            </div>
        </x-card.grid-card>
    </x-modal.dialog-modal>

    @push('scripts')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script>
            $('body').on('click', '.tracking', function() {
                startSpinLoader('dlg-loader-spin');

                var id = $(this).attr('id');
                var TrackingId = $(this).attr('tracking-item');

                let tUrl = '{{ url('shipment/pickup/get-pickup-tracking-info-by-trackId') }}/' + TrackingId;

                $.ajax({
                    type: "GET",
                    url: tUrl,
                    contentType: 'application/json',
                    data: {
                        TrackingId: TrackingId
                    },
                    dataType: 'json',

                    success: function(res) {
                        console.log(res);
                        Object.entries(res).forEach(([key, value]) => {
                            $('#order-info').append(`
                        <div class="d-flex align-items-center border-bottom">
                            <div class="flex-grow-1 w-50">
                                <h5 class="fs-13 mb-0">
                                    <label class="text-body d-block mb-1">
                                        ${key.replace(/([A-Z])/g, ' $1')}
                                        <!-- Format camelCase to readable format -->
                                    </label>
                                </h5>
                            </div>
                            <div class="flex-shrink-0 text-start">
                                <div class="d-flex align-items-center gap-1">
                                    <label class="mb-1 fw-normal">${value}</label>
                                </div>
                            </div>
                        </div>
                        `);
                        });
                        endSpinLoader('dlg-loader-spin');
                    },

                    error: function(err) {
                        console.error('Error:', err);
                    }
                });
                $('#order-info').empty();

                $('#trackingModal').modal("show");

            });




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
                        url: '{{ route('pickup.index') }}',
                        data: function(d) {
                            d.order_status_filter = filter || '-1';
                        },
                    },

                    columns: [{
                            data: 'pickup_id',
                            name: 'pickup_id'
                        },
                        {
                            data: 'guid',
                            name: 'guid',
                        },
                        {
                            data: 'reference2',
                            name: 'reference2',
                            render: function(val) {
                                const arr = val.split(',');

                                return arr.map(e => {
                                    return `<span class="badge bg-success fs-11 py-1">${e}</span>`
                                })
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
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
@endsection
