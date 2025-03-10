@props([
    'Name' => 'Fahath',
    'designation' => 'Team Leader & HR',
    'data' => '[]',
    'img' => 'assets/images/users/avatar-2.jpg',
])


<div class="card team-box">
    <div class="team-cover"> <img src="assets/images/small/img-9.jpg" alt="" class="img-fluid"> </div>
    <div class="card-body p-4">
        <div class="row align-items-center team-row">
            <div class="col team-settings">
                <div class="row">
                    <div class="col">
                        <div class="flex-shrink-0 me-2">
                            <button type="button" class="btn btn-light btn-icon rounded-circle btn-sm favourite-btn ">
                                <i class="ri-star-fill fs-14"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col text-end dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill fs-17"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal"
                                    data-edit-id="12">
                                    <i class="ri-pencil-line me-2 align-bottom text-muted">
                                    </i>Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal"
                                    data-remove-id="12">
                                    <i class="ri-delete-bin-5-line me-2 align-bottom text-muted">
                                    </i>Remove
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col">
                <div class="team-profile-img">
                    <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                        <img src='{{ $data->img ? asset('/storage/' . $data->img) : $img }}' alt=""
                            class="member-img img-fluid d-block rounded-circle" style="width:100px; height:85px">
                    </div>
                    <div class="team-content"> <a class="member-name" data-bs-toggle="offcanvas" href="#member-overview"
                            aria-controls="member-overview">
                            <h5 class="fs-16 mb-1">{{ $data['first_name'] . ' ' . $data['last_name'] ?? '' }}</h5>
                        </a>

                        <p class="text-muted member-designation mb-0">{{ $data['designation'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col">
                <div class="row text-muted text-center">
                    <div class="col-6 border-end border-end-dashed">
                        <h6 class="mb-1 projects-num">{{ $data['employee_id'] ?? '' }}</h6>
                        <p class="text-muted mb-0">Employee ID</p>
                    </div>
                    <div class="col-6">
                        <h6 class="mb-1 tasks-num">{{ $data['department'] ?? '' }}</h6>
                        <p class="text-muted mb-0">Department</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col">
                <div class="text-end"> <a href="{{ route('employee.show', ['employee' => $data['id']]) }}"
                        class="btn btn-light view-btn">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
