@extends('layout.app')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <x-breadcrumb title="Users" parent="Page" />

            <!-- end page title -->

            <x-modal.common title="my title" idName="showUserModal" size="modal-md">
                <form action="{{ route('register') }}" method="POST" class="tablelist-form" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="tasksId" />
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <x-input.txt-group label="Name" name="name" />
                            </div>
                            <div class="col-lg-12">
                                <x-input.txt-group label="Email" type="email" name="email" />
                            </div>
                            <div class="col-lg-12">
                                <x-input.txt-group label="Password" type="password" name="password" />
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="tasksTitle-field" class="form-label">Role</label>
                                    <select name="role_id" class="form-control" data-choices name="choices-single-default"
                                        id="choices-single-default">
                                        <option value="">choose...</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <x-input.status-select-group label="Status" name="is_active" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" id="close-modal"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Add User</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update Task</button> -->
                        </div>
                    </div>
                </form>
            </x-modal.common>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="tasksList">

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                                id="create-btn" data-bs-target="#showUserModal"><i
                                                    class="ri-add-line align-bottom me-1"></i> Add</button>
                                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                                    class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div>
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="customer_name">Customer</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="phone">Phone</th>
                                                <th class="sort" data-sort="date">Joining Date</th>
                                                <th class="sort" data-sort="status">Delivery Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child"
                                                            value="option1">
                                                    </div>
                                                </th>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                        class="fw-medium link-primary">#VZ2101</a></td>
                                                <td class="customer_name">Mary Cousar</td>
                                                <td class="email">marycousar@velzon.com</td>
                                                <td class="phone">580-464-4694</td>
                                                <td class="date">06 Apr, 2021</td>
                                                <td class="status"><span
                                                        class="badge bg-success-subtle text-success text-uppercase">Active</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-success edit-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#showModal">Edit</button>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteRecordModal">Remove</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find
                                                any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </div>
                                </div>
                              </div> --}}
                                {{-- ------------------------ --}}
                                <table id="my-table" class="display table table-bordered dt-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Extn.</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i < 100; $i++)
                                            <tr>
                                                <td>fahath{{ $i }}</td>
                                                <td>software developer</td>
                                                <td>mirnah</td>
                                                <td>111</td>
                                                <td>2023</td>
                                                <td>6000</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Extn.</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                </table>

                                {{-- ------------------------ --}}
                            </div>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @push('scripts')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

        {{-- <script src="assets/js/pages/datatables.init.js"></script> --}}

        @vite(['resources/assets/js/pages/datatables.init.js'])


        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     let table = new DataTable('#my-table', {
            //         "scrollY": "400px",
            //         "scrollCollapse": true,
            //         "pagingType": "full_numbers",
            //         "paging": true,
            //         lengthMenu: [10, 25, 50, 75, 100], // Customize the options for "buttons per page"
            //         pageLength: 10, // Set the default page length
            //         dom: 'Bfrtip',

            //         buttons: ['copy', 'csv', 'excel', 'print', 'pdf']
            //     });
            // });

            document.addEventListener('DOMContentLoaded', function() {
                let table = $('#my-table').DataTable({
                    "scrollY": "210px",
                    "scrollCollapse": true,
                    "pagingType": "full_numbers",
                    "paging": true,
                    lengthMenu: [10, 25, 50, 75, 100],
                    pageLength: 10,
                });

                new $.fn.dataTable.Buttons(table, {
                    buttons: ['copy', 'csv', 'excel', 'print', 'pdf']
                });
                table.buttons().container().appendTo($('#buttons-container'));
            });

            // document.addEventListener('DOMContentLoaded', function() {
            //     let table = new DataTable('#buttons-datatables', {
            //         dom: 'Bfrtip',
            //         buttons: [
            //             'copy', 'csv', 'excel', 'print', 'pdf'
            //         ]
            //     });
            // });



            $('#showUserModal').submit(function(e) {
                var $form = $(this);
                console.log($form);
                e.preventDefault(); // keeps the form from behaving like a normal (non-ajax) HTML form
                var url = $form.attr('action');
                var formData = {};

                // submit a POST request with the form data
                $form.find('input, select').each(function() {
                    formData[$(this).attr('name')] = $(this).val();
                });

                // submits an array of key-value pairs to the form's action URL
                $.post(url, formData, function(response) {
                    // handle successful validation
                    console.log('success');


                }).fail(function(response) {
                    // handle failed validation
                    associate_errors(response.responseJSON.errors, $form);
                });
            });

            function associate_errors(errors, $form) {
                // remove existing error classes and error messages from form groups
                $form.find('.form-group').find('.invalid-msg').text('');
                $form.find('.form-group').find('.form-control').removeClass('is-invalid');

                // iterate over the keys of the error object
                Object.keys(errors).forEach(function(fieldName) {
                    // find each form group, which is given a unique id based on the form field's name
                    var $group = $form.find('[name="' + fieldName + '"]');

                    // add the error class and set the error text
                    $group.addClass('is-invalid');
                    $group.closest('.form-group').find('.invalid-msg').text(errors[fieldName][0]);
                });
            }
        </script>
    @endpush
@endsection
