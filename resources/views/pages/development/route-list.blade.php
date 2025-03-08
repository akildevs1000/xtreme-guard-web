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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable-crud" class="display table-sm table stripe dt-responsive table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>URI</th>
                                <th>Name</th>
                                <th>Controller</th>
                                <th>Method Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routes as $route)
                                <tr>
                                    <td>{!! renderActionForm($route->methods()[0]) !!}</td>
                                    <td>{{ $route->uri() }}</td>
                                    <td>{{ $route->getName() }}</td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip" data-bs-title="{{ $route->getActionName() }}">
                                        @php
                                            $actionName = $route->getActionName();
                                            $controllerName = class_basename(explode('@', $actionName)[0]);
                                            echo $controllerName;
                                        @endphp
                                    </td>
                                    <td>{{ $route->getActionMethod() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @php
        function renderActionForm($value)
        {
            $arr = [
                'GET' => 'bg-success',
                'POST' => 'bg-primary',
                'PUT' => 'bg-warning',
                'DELETE' => 'bg-danger',
            ];

            return '<p class="p-0 my-1 rounded text-center ' .
                ($arr[$value] ?? 'bg-secondary') .
                '" style="widtdh:30%; margind: 0 auto !important;"> <span class="text-white py-0"> ' .
                $value .
                ' </span> </p>';
        }
    @endphp

    @push('scripts')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script>
            // Initialize the DataTable with custom settings
            function initializeDataTable() {
                const table = $('#datatable-crud').DataTable({
                    processing: true,
                    stateSave: true,
                    scrollY: "50vh",
                    pageLength: 100,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All']
                    ],
                });

                // Attach custom search input event
                attachSearchInput(table);

                return table;
            }

            // Attach custom search functionality
            function attachSearchInput(table) {
                const customSearchInput = $('#custom-search-input');

                customSearchInput.on('keyup', function() {
                    const searchTerm = $(this).val();
                    table.search(searchTerm).draw();
                });

                // Sync custom search input with the default search input value
                const defaultSearchValue = $('#datatable_filter label input').val();
                customSearchInput.val(defaultSearchValue);
            }

            // Initialize the Choices.js plugin for the length menu dropdown
            function initializeChoices() {
                const lengthMenuSelect = document.querySelector('.dataTables_length label select');
                if (lengthMenuSelect) {
                    new Choices(lengthMenuSelect, {
                        searchEnabled: false
                    });
                }
            }

            // Document ready function
            $(function() {
                const dataTable = initializeDataTable();
                initializeChoices();
            });
        </script>
    @endpush

@endsection
