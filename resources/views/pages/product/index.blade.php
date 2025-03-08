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

                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Search for transactions..." id="custom-search-input">
                                    <i class="ri-search-line search-icon"> </i>
                                </div>
                                @canOrRole('product-create')
                                <x-btn.add-btn isAdd="true" routeName="products.create" title="Create User" />
                                @endcanOrRole
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
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

            function loadTable() {
                var table = $('#datatable-crud').DataTable({
                    processing: true,
                    serverSide: true,
                    "searching": true,
                    stateSave: true,
                    "scrollY": "50vh",
                    ajax: {
                        url: '{{ url('admin/products') }}',
                        data: function(d) {
                            d.role = $('#choices-roles').val() || '-1';
                        }
                    },

                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'slug',
                            name: 'slug'
                        },
                        {
                            data: 'is_available',
                            name: 'is_available',
                            render: function(value) {
                                return ActiveStatus(value)
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $('#custom-search-input').keyup(function(e) {
                    var searchTerm = $(this).val();
                    table.search(searchTerm).draw();
                });

                let searchValue = $('#datatable_filter label input').val();
                $('#custom-search-input').val(searchValue);
            }
        </script>
    @endpush
@endsection
