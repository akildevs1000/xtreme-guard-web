@extends('layout.app')
@section('title', $title)
@section('content')
    @push('styles')
        <link rel="stylesheet"
            href="https://www.jqueryscript.net/demo/validate-password-requirements/css/jquery.passwordRequirements.css">
        <style>
            table.dataTable tr {
                border: 2px solid #dbdade;
            }

            table.dataTable {
                border-top: 1px solid #dbdade;
                border-right: 1px solid #dbdade;
                border-left: 1px solid #dbdade;
            }
        </style>
    @endpush

    <div class="page-content">
        <div class="container-fluid">
            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img src="{{ asset('/assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="" />
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <input id="profile-foreground-img-file-input" type="file"
                                    class="profile-foreground-img-file-input" />
                                {{-- <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                    <i class="ri-image-edit-line align-bottom me-1"></i>
                                    Change Cover
                                </label> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3 col-md-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                    <img src="{{ $user->img }}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image" />
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" name="img" type="file"
                                            class="profile-img-file-input" />
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                            {{-- <i class="ri-close-line text-danger"></i> --}}
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ $user->full_name }}</h5>
                                <p class="text-muted mb-0">{{ $user->designation ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-body p-0">
                            <div class="px-3 py-2  align-items-center d-flex">
                                <h6 class="text-muted mb-0 text-uppercase fw-semibold flex-grow-1">
                                    Recent Activity
                                </h6>
                                <div>
                                    <a href="{{ url('administration/user-activity') }}"
                                        class="btn btn-soft-secondary btn-sm">
                                        View All
                                    </a>
                                </div>
                            </div>

                            <div data-simplebar style="max-height: 320px;" class="p-3 pt-0">
                                <div class="acitivity-timeline acitivity-main">
                                    @foreach ($userLogs as $log)
                                        <div class="acitivity-item d-flex mt-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $log->img ?? '' }}" alt=""
                                                    class="avatar-xs rounded-circle acitivity-avatar" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0 lh-base">
                                                    {{ ucwords($log->user_name) ?? '' }}
                                                </h6>
                                                <p class="text-muted mb-0 fst-italsic">
                                                    -- {{ $log->form_record_id ?? '' }}
                                                    {!! logAction($log->log_action) ?? '' !!}
                                                    By
                                                    {{ ucwords($log->user_name) ?? '' }} --
                                                </p>

                                                {{-- <h5 class="fs-14 my-1 fw-normal"> <span class="badge  badge bg-danger"> Delete </span> </h5> --}}

                                                @php
                                                    $logDate = date('d-m-Y', strtotime($log->created_at));
                                                    $currentDate = date('d-m-Y');
                                                @endphp

                                                @if ($logDate == $currentDate)
                                                    <span>Today</span>
                                                @else
                                                    {{ $logDate }}
                                                @endif
                                                <small class="mb-0 text-muted">
                                                    {{ date('H:i', strtotime($log->created_at)) }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-md-9">
                    <div class="card mt-xxl-n5 mt-md-n5 h-100">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-user"></i> Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="fas fa-lock"></i> Security
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('user.update', ['user' => $user->id]) }}" id="user-form" method="POST"
                            class="tablelist-form" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.txt-group label="First Name" name="first_name"
                                                        placeholder="Enter your first name" :value="$user->first_name" required />
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.txt-group label="Last Name" name="last_name"
                                                        placeholder="Enter your last name" :value="$user->last_name" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.txt-group label="User ID" name="id"
                                                        placeholder="Enter User ID" readonly :value="$user->id" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.txt-group label="Designation" name="designation"
                                                        placeholder="Enter your designation" :value="$user->designation" required />
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.txt-group label="Phone Number" name="contact"
                                                        placeholder="Enter your phone number" :value="$user->contact" />
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.txt-group type="email" label="Email Address"
                                                        name="email" placeholder="Enter your email" :value="$user->email"
                                                        required />
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.date-group label="Joining Date" name="joining_date"
                                                        placeholder="Select date" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <x-input.select-group label="Status" name="is_active" itemText="name"
                                                        itemValue="value" :items="[
                                                            ['name' => 'Active', 'value' => '1'],
                                                            ['name' => 'Inactive', 'value' => '0'],
                                                        ]" data-choices-search-false
                                                        :value="$user->is_active" />
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3 pb-2">
                                                    <x-input.txtarea-group label="Description" name="description"
                                                        placeholder="Enter your description" :value="$user->description" />
                                                </div>
                                            </div>

                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <div>
                                                    <x-input.select-group label="Role" name="role_id" itemText="name"
                                                        itemValue="id" :items="$roles" data-choices-search-false
                                                        :value="$user->role_id" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <x-input.txt-group label="Enter Username" type="text"
                                                        name="username" placeholder="Enter your username"
                                                        :value="$user->username" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <x-input.txt-group label="Enter new password" type="password"
                                                        name="password" placeholder="Enter your new password"
                                                        class="pr-password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <x-input.txt-group label="Confirm password" type="password"
                                                        name="password_confirmation" placeholder="Confirm password" />
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row-->
                                        @can('administration-user-control-panel-edit')
                                            <div class="mt-4 mb-3 border-bottom pb-2">
                                                <div class="float-end">
                                                    {{-- <a href="javascript:void(0);" class="link-primary">All Logout</a> --}}
                                                </div>
                                                <h5 class="card-title">Control Panel</h5>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                        <i class="ri-smartphone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <label for="createShipment"><strong>Confirmation Mode</strong></label>
                                                    <p class="text-muted mb-0">
                                                        Manual Orders Review and Confirmation Mode
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="form-check form-switch form-switch-md" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="createShipment"
                                                            value="1" name="is_create_ship_allow"
                                                            @checked($user->is_create_ship_allow)>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="flex-shrink-0 avatar-sm">
                                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">
                                                        <i class="ri-smartphone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <label for="createShipment"><strong>Create Return Mode</strong></label>
                                                    <p class="text-muted mb-0">
                                                        Manual Orders Review and Create Return Mode
                                                    </p>
                                                </div>
                                                <div>
                                                    <div class="form-check form-switch form-switch-md" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="createShipment"
                                                            value="1" name="is_create_return_allow"
                                                            @checked($user->is_create_return_allow)>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan

                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" onclick="store()" id="sbtBtn" class="btn btn-primary">
                                            Submit
                                        </button>
                                        <a href="{{ url()->previous() }}" class="btn btn-soft-success">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('/assets/js/pages/profile-setting.init.js') }}"></script>
        <script src="https://www.jqueryscript.net/demo/validate-password-requirements/js/jquery.passwordRequirements.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $(".pr-password").passwordRequirements({});
            });

            function store() {
                sLoading('sbtBtn')
                var form = document.getElementById('user-form');
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                var profileImgInput = document.getElementById('profile-img-file-input');
                var coverImgInput = document.getElementById('profile-foreground-img-file-input');

                if (profileImgInput.files.length > 0) {
                    payload.append('img', profileImgInput.files[0]);
                }

                if (coverImgInput.files.length > 0) {
                    payload.append('cover_img', coverImgInput.files[0]);
                }

                const options = {
                    // contentType: 'application/json',
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
                        console.log('Success:', response.status);
                        if (response.status) {
                            alertNotify(response.message, 'success')
                            eLoading('sbtBtn')
                            // redirectTo('{{ route('user.index') }}');
                        } else {
                            associateErrors(response.errors, 'user-form');
                            eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );


            }

            function redirectTo(url) {
                window.location.href = url;
            }

            function associateErrors(errors, formId) {
                console.log(formId);
                let $form = $(`#${formId}`);
                console.log($form);
                $form.find('.form-group .invalid-msg').text('');
                $form.find('.form-group .form-control').removeClass('is-invalid');

                Object.keys(errors).forEach(function(fieldName) {
                    let $group = $form.find('[name="' + fieldName + '"]');
                    // console.log('$group', $group);
                    console.log('fieldName', fieldName);
                    $group.addClass('is-invalid');
                    $group.closest('.form-group').find('.invalid-msg').text(errors[fieldName][0]);
                });
            }
        </script>
    @endpush
@endsection
