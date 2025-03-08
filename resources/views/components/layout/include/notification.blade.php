@php
    $todayOrders = getTodayOrdersForNotification();
    $cronFailedIssue = getLastCronFailedIssueFoNotification();

    $count = count($todayOrders->toArray()) + count($cronFailedIssue->toArray());

@endphp

<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
        aria-expanded="false">
        <i class="	far fa-bell fs-22"></i>
        <span
            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{ $count }}
            <span class="visually-hidden">unread messages</span></span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">

        <div class="dropdown-head bg-primary bg-pattern rounded-top">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                    </div>
                    <div class="col-auto dropdown-tabs">
                        <span class="badge bg-light-subtle text-body fs-13"> {{ $count }} New</span>
                    </div>
                </div>
            </div>

            <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                    id="notificationItemsTab" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                            aria-selected="true">
                            Today Orders
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab"
                            aria-selected="false">
                            Alert
                        </a>
                    </li>
                    {{-- <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab"
                            aria-selected="false">
                            Alerts
                        </a>
                    </li> --}}
                </ul>
            </div>

        </div>

        <div class="tab-content position-relative" id="notificationItemsTabContent">
            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">


                    {{-- <div id="admin-notification">
                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                            <div class="d-flex">
                                <div class="avatar-xs me-3 flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>

                                <div class="flex-grow-1">
                                    <a href="#!" class="stretched-link">
                                        <h6 class="mt-0 mb-2 lh-base">
                                            Your order <b>#1000000128</b> for
                                            <span class="text-secondary">Denys Vladyshevskyi</span>
                                            is now <b>Shipped to Warehouse</b>!
                                        </h6>
                                    </a>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i> Updated on 17 Feb 2025</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    @forelse ($todayOrders as $order)
                        <div id="admin-notification">
                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3 flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                            <i class="fas fa-truck"></i>
                                        </span>
                                    </div>

                                    <div class="flex-grow-1">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mt-0 mb-2 lh-base">
                                                Order <b>#{{ $order->order_id ?? '' }}</b> for
                                                <span
                                                    class="text-secondary">{{ $order->report_customer_name ?? '' }}</span>
                                                is now <b>{{ $order->order_status_title ?? '' }}</b>!
                                            </h6>
                                        </a>
                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                            <span>
                                                <i class="mdi mdi-clock-outline"></i>{{ $order->created_at ?? '' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>

            </div>

            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                <div data-simplebar style="max-height: 300px;" class="pe-2">

                    @forelse ($cronFailedIssue as $item)
                        <div class="text-reset notification-item d-block dropdown-item">
                            <div class="d-flex">
                                {{-- <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic"> --}}

                                <div class="avatar-xs me-3 flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                        <i class="ri-error-warning-line"></i>
                                    </span>
                                </div>

                                <div class="flex-grow-1">
                                    <a href="#!" class="stretched-link">
                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">
                                            {{ substr($item->job_name, 0, 25) ?? '' }} ...</h6>
                                    </a>
                                    <div class="fs-13 text-muted">
                                        <p class="mb-1"> {{ substr($item->job_name, 0, 25) ?? '' }}.</p>
                                    </div>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i>{{ $item->failed_at ?? '' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    <div class="my-3 text-center d-flex justify-content-center">
                        <a href="{{ url('development/cron-failed-fixed-list') }}"
                            class="btn btn-soft-success waves-effect waves-light">
                            View All Alert <i class="ri-arrow-right-line align-middle"></i></a>
                    </div>


                </div>
            </div>

            {{-- <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div> --}}

            <div class="notification-actions" id="notification-actions">
                <div class="d-flex text-muted justify-content-center">
                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button
                        type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal"
                        data-bs-target="#removeNotificationModal">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // loadNotificationTemplate()
        });

        function loadNotificationTemplate() {
            const adminNotificationContainer = document.getElementById("admin-notification");
            const todayOrders = @json($todayOrders);
            todayOrders.forEach(order => {
                const notificationHTML = `
                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                        <div class="d-flex">
                            <div class="avatar-xs me-3 flex-shrink-0">
                                <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                    <i class="bx bx-badge-check"></i>
                                </span>
                            </div>

                            <div class="flex-grow-1">
                                <a href="#!" class="stretched-link">
                                    <h6 class="mt-0 mb-2 lh-base">
                                        Order <b>#${order.order_id}</b> for
                                        <span class="text-secondary">${order.report_customer_name}</span>
                                        is now <b>${order.order_status_title}</b>!
                                    </h6>
                                </a>
                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                    <span><i class="mdi mdi-clock-outline"></i> Updated on ${formatDate(order.order_aramex_status.status_date)}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                `;
                adminNotificationContainer.innerHTML += notificationHTML;
            });
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString("en-US", {
                day: "2-digit",
                month: "short",
                year: "numeric"
            });
        }
    </script>
@endpush
