@props(['record'])

<div class="row justify-content-center1">
    <div class="col-12">
        <div class="card border" style="border-color: #c3c8cd !important;">
            <div class="card-header py-2" style="border-bottom: 1px solid #c3c8cd">
                <span class="float-end">
                    Number of Stocks
                    <span class="badge bg-info align-middle fs-10">
                        {{ count($record->payload) }}
                    </span>
                </span>
                <h6 class="card-title mb-0">Updated Stocks</h6>
            </div>
            <div class="card-body" data-simplebar style="max-height: 500px;">
                <div class="row">

                    @foreach ($record->payload as $payload)
                        {{-- <div class="col-lg-2 col-md-3 col-sm-4 mt-1">
                            <div class="p-2 border border-dashe border-groove rounded text-center">
                                <span class="position-absolute top-1 translate-middle badge circle bg-primary"
                                    style="left: 90% !important;">
                                    {{ $loop->iteration }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                <div>
                                    <p class="text-muted fw-medium mb-1">{{ $payload['sku'] }}</p>
                                    <h5 class="fs-10 text-primary mb-0"><i class="mdi mdi-grid me-1"></i>
                                        {{ $payload['item_name'] }}
                                    </h5>
                                    <p class="text-muted fs-12 fw-medium mb-0">{{ $payload['unit'] }}</p>
                                    <p class="text-muted fs-12 fw-medium mb-0">{{ $payload['product_type'] }}</p>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 mb-1">
                            <div class="card border border-1 shadow-none rounded mb-1 h-100"
                                onclick="viewItemByModal({{ json_encode($payload) }})" style="cursor: pointer">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            {{-- <img src="https://object.virtualstacks.com/031/products/product.png"
                                                alt="" class="avatar-xs object-fit-cover rounded"> --}}

                                            <span class="bg-primary-subtle fs-16 rouded-1 p-2 my-4">
                                                <i class="ri-gift-2-line text-primary"></i>
                                            </span>

                                            <br>
                                            <h6 class="mt-3 mb-0 badge bg-primary">
                                                {{ $payload['qty'] }}
                                            </h6>
                                        </div>
                                        <div class="ms-2 flex-grow-1">
                                            <p class="mb-1 fs-12 text-muted fw-medium mb-1">{{ $payload['sku'] }}</p>
                                            {{-- <p class="text-muted1 text-primary mb-0 fs-12"
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 173px;">
                                                {{ $payload['item_name'] }}
                                            </p> --}}

                                            <p class="text-muted1 text-primary mb-0 fs-12 text-responsive">
                                                {{ $payload['item_name'] }}
                                            </p>


                                        </div>
                                        <div>
                                            <div class="dropdown float-end">
                                                <button class="btn btn-ghost-primary btn-icon dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{-- <i class="ri-more-fill align-middle fs-16"></i> --}}
                                                    {{ $loop->iteration }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-responsive {
        /* Default for extra small screens */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (min-width: 576px) {
        .text-responsive {
            width: 90px !important;
        }
    }

    @media (min-width: 768px) {
        .text-responsive {
            width: 90px;
        }
    }

    @media (min-width: 992px) {
        .text-responsive {
            width: 50px;
        }
    }

    @media (min-width: 1200px) {
        .text-responsive {
            width: 67px !important;
        }
    }

    @media (min-width: 1400px) {
        .text-responsive {
            width: 300px;
        }
    }
</style>
