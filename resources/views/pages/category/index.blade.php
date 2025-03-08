@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div class="row" id="role-card-area">
                @foreach ($categories as $category)
                    <div class="col-xxl-3 col-md-4">
                        <x-card.card-category :categoryName="$category->name" :categoryId="$category->id" :item="$category" color="warning"
                            per="administration-role-edit" perDelete="administration-role-delete" />
                    </div>
                @endforeach
                <div class="col-xxl-3 col-md-4">
                    {{-- @can('administration-role-create') --}}
                    <x-card.card-add-category color="success" funName="CategoryModal" />
                    {{-- @endcan --}}
                </div>
            </div>

            {{-- add Category  modal --}}
            <x-modal.common titleName="Add Category" idName="CategoryModal" size="modal-lg">
                <form action="{{ route('category.store') }}" method="POST" id="category-form" class="tablelist-form"
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="is_edit" id="is_edit">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <x-input.txt-group label="Category Name" name="name"
                                    placeholder="Enter your Category Name" />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <x-input.select-group-js name="is_active" label="Status" itemText="name" itemValue="value"
                                    :items="[
                                        ['name' => 'Active', 'value' => '1'],
                                        ['name' => 'Inactive', 'value' => '0'],
                                    ]" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <x-input.img name="img1" />
                                {{-- <x-input.img-size name="img1" /> --}}
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <x-input.txtarea-group label="Description" name="description"
                                    placeholder="Enter your description" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-success sbtBtn1" onclick="submitBtn()" id="submit-btn">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </x-modal.common>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {
                const element = document.querySelector('.dataTables_length label select');
                if (element) {
                    const choices = new Choices(element, {
                        searchEnabled: false
                    });
                }
            });

            let formIdName = 'category-form';

            function CategoryModal(isEdit, data = null) {
                const form = $(`#${formIdName}`);
                const submitButton = $('#submit-btn');

                // Helper function to set the form action and method
                const setFormActionAndMethod = (actionUrl, method) => {
                    form.attr('action', actionUrl);
                    if (method) {
                        form.append(`<input type="hidden" name="_method" value="${method}">`);
                    } else {
                        form.find('input[name="_method"]').remove();
                    }
                };

                // Helper function to update button text
                const updateSubmitButtonText = (text) => {
                    submitButton.text(text);
                };

                // Update the form fields
                const updateFormFields = (data) => {
                    setValueByName('is_edit', isEdit ? 1 : 0);
                    setValueByName('name', data?.name || '');
                    setValueByName('address', data?.address || '');
                    setValueByName('floors', data?.floors || '');
                    setValueByName('description', data?.description || '');
                    updateSelectedValue('is_active', data.has_parking)

                };

                if (isEdit && data) {
                    // setFormActionAndMethod(`{{ url('roomease/apartment') }}/${data.id}`, 'PUT');
                    updateSubmitButtonText('Update category');
                    updateFormFields(data);
                } else {
                    setFormActionAndMethod('{{ route('category.store') }}');
                    updateSubmitButtonText('Add category');
                    clearForm(formIdName); // Clear form fields for a fresh entry
                    updateSelectedValue('is_active', 1)
                }

                // Show the modal
                $('#CategoryModal').modal('show');
            }

            function submitBtn() {
                if (getValue('is_edit')) {
                    update();
                } else {
                    store();
                }
            }

            function store() {
                sLoading('sbtBtn')
                var form = document.getElementById(formIdName);
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                var profileImgInput = document.getElementById('selectImage');

                // if (profileImgInput.files.length > 0) {
                //     payload.append('img1', profileImgInput.files[0]);
                // }

                const options = {
                    // contentType: 'application/json',
                    contentType: 'multipart/form-data',

                    // 'Content-Type': 'multipart/form-data',
                    method: method || 'POST',
                    headers: {
                        dataType: "json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };

                console.log(payload);
                console.log(profileImgInput);
                console.log(profileImgInput.files[0]);

                // return;

                sendData(
                    url,
                    payload,
                    options,
                    (response) => {
                        console.log('Success:', response.status);
                        if (response.status) {
                            $("#role-form :input").val("");
                            // redirectTo('{{ route('user.index') }}');
                            // refreshContent('administration/role', 'role-card-area')
                            eLoading('sbtBtn')
                            refreshContent('{{ url('administration/role') }}', 'role-card-area');
                            closeModal('addRoleModal');
                            alertNotify(response.message, 'success')
                        } else {
                            associateErrors(response.errors, formIdName);
                            eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function update() {
                sLoading('sbtBtn')
                let roleId = getValue('edit-role-id');
                var form = document.getElementById('role-edit-form');
                // var url = '{{ url('role') }}/' + roleId + '/edit';
                var url = '{{ url('administration/role') }}/' + roleId;
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                const options = {
                    contentType: 'multipart/form-data',
                    method: 'POST',
                    headers: {
                        dataType: "json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };
                sendData(
                    url,
                    payload,
                    options,
                    (response) => {
                        if (response.status) {
                            refreshContent('{{ url('administration/role') }}', 'role-card-area');
                            closeModal('editRoleModal');
                            alertNotify(response.message, 'success')
                            eLoading('sbtBtn')
                        } else {
                            associateErrors(response.errors, 'role-edit-form');
                            eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function closeModal(modalId) {
                $(`#${modalId}`).modal('hide');
            }

            // ========form submit============
        </script>
    @endpush
@endsection
