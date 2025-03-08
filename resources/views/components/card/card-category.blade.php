@props([
    'categoryId' => '',
    'categoryName' => 'Administrator',

    // 'roleId' => '',
    // 'categoryName' => 'Administrator',

    'numberOfUsers' => '4',
    'color' => 'warning',
    'btnTarget' => 'editRoleModal',
    'funName' => 'editRoleModal',
    'per' => 'editRoleModal',
    'perDelete' => 'editRoleModal',
    'item' => [],
])

@php
    $totalUsers = count($item?->users ?? []);
    $moreUsers = $totalUsers > 4 ? $totalUsers - 4 : 0;
@endphp
<div class="card  my-1 profile-project-card shadow-none profile-project-{{ $color ?? '' }}">
    <div class="card-body p-4">
        <div class="d-flex">
            <div class="flex-grow-1 text-muted overflow-hidden">
                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">{{ $categoryName ?? '' }}</a>
                </h5>
                <p class="text-muted text-truncate mb-0">Total {{ $totalUsers ?? '' }} user(s) </p>
            </div>
            <div class="flex-shrink-0 ms-2">
                @canOrRole($per)
                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $btnTarget }}" type="button"
                    onclick="{{ $funName }}('{{ $categoryId }}', {{ Js::from($item) }})" class="me-2">
                    <i class="ri-pencil-line"></i>
                </a>
                @endcanOrRole

                {{-- @canOrRole($perDelete) --}}
                <a href="#" delete-url="{{ url('category') }}" delete-item="{{ $categoryName }}"
                    class="delete link-danger" id="{{ $categoryId }}" title="Delete">
                    <i class="ri-delete-bin-5-line"></i>
                </a>
                {{-- @endcanOrRole --}}
            </div>
        </div>

        <div class="d-flex mt-2">
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 justify-content-end">
                    <div>
                        {{-- <h5 class="fs-12 text-muted mb-0">
                            Members :</h5> --}}
                    </div>
                    <div class="avatar-group text-end">
                        @foreach ([1, 2, 4] as $key => $user)
                            <div class="avatar-group-item">
                                <div class="avatar-xs" title="{{ $user['first_name'] ?? '' }}">
                                    {{-- <img src="{{ $user['img'] ?? '' }}" alt=""
                                        class="rounded-circle header-profile-user" /> --}}
                                </div>
                            </div>
                        @endforeach
                        <div class="avatar-group-item">
                            <div class="avatar-xs">
                                <div class="avatar-title rounded-circle bg-light text-primary">
                                    +{{ abs($moreUsers) ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card body -->
</div>
