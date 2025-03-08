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
            <div class="row">
                <div class="col-lg-12">
                    <x-order.show.nav :order="$order" />
                </div>
            </div>
            <div class="row show-content">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">

                        <div class="tab-pane fade1 active show" id="project-overview" role="tabpanel">
                            <x-order.show.overview :order="$order" />
                        </div>

                        <div class="tab-pane fade1" id="order-products" role="tabpanel">
                            <x-order.show.products :order="$order" />
                        </div>

                        <div class="tab-pane fade1" id="order-accounts" role="tabpanel">
                            <x-order.show.account :order="$order" />
                        </div>

                        @if (count((array) $order->tracking) > 0)
                            <div class="tab-pane fade1" id="order-tracking" role="tabpanel">
                                <x-order.show.tracking :order="$order" :orderTrackingHistory="$orderTrackingHistory" />

                            </div>
                        @endif

                        @if (count((array) $order->orderReturn) > 0)
                            <div class="tab-pane fade1" id="order-return" role="tabpanel">
                                <x-order.show.return :order="$order" :returnOrderTrackingHistory="$returnOrderTrackingHistory" />
                            </div>
                        @endif

                        <div class="tab-pane fade1" id="order-invoice" role="tabpanel">
                            <x-order.show.invoice :order="$order" />
                        </div>

                    </div>
                    <x-loaders.render-loader type="export" />
                    <x-loaders.pickup-loader type="export" />
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script src="https://cdn.lordicon.com/lordicon.js"></script>.


        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const orderTabs = document.querySelectorAll('#order-tabs .nav-link');
                const activeTabId = localStorage.getItem('activeTab');
                console.log(orderTabs);
                console.log(activeTabId);

                if (activeTabId) {
                    // Deactivate any active tabs
                    document.querySelectorAll('#order-tabs .nav-link').forEach(tab => {
                        tab.classList.remove('active');
                    });
                    document.querySelectorAll('.show-content .tab-pane').forEach(pane => {
                        pane.classList.remove('active', 'show');
                    });

                    // Activate the stored tab
                    const activeTab = document.querySelector(`#order-tabs .nav-link[href="${activeTabId}"]`);
                    if (activeTab) {
                        activeTab.classList.add('active');
                        document.querySelector(activeTabId).classList.add('active', 'show');
                    }
                }

                // Store the active tab on click
                orderTabs.forEach(tab => {

                    tab.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default anchor behavior
                        console.log(tab);

                        const selectedTabId = event.currentTarget.getAttribute('href');
                        console.log(selectedTabId);

                        // Remove the 'active' class from all tabs and tab panes
                        orderTabs.forEach(tab => tab.classList.remove('active'));
                        document.querySelectorAll('.show-content .tab-pane').forEach(pane => pane
                            .classList.remove(
                                'active', 'show'));

                        // Add the 'active' class to the clicked tab and the corresponding tab pane
                        event.currentTarget.classList.add('active');
                        document.querySelector(selectedTabId).classList.add('active', 'show');

                        // Store the active tab in localStorage
                        localStorage.setItem('activeTab', selectedTabId);
                    });
                });
            });
        </script> --}}
    @endpush
@endsection
