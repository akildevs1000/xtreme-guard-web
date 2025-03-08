@props([
    'title' => 'Products',
    'order' => $order,
])

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <h5 class="card-title flex-grow-1">{{ $title ?? '' }}</h5>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table-card">
                    <table class="table table-borderless align-middle mb-0" id="product-table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="padding-left:25px !important;">ID</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-end">Price</th>
                                <th scope="col" class="text-end">Tax Amount</th>
                                <th scope="col">QTY</th>
                                <th scope="col" class="text-end">Price (inc Tax)</th>
                                <th scope="col" class="text-end">Discount</th>
                                <th scope="col">Discount(%)</th>
                                <th scope="col">Type</th>
                                <th scope="col" class="text-center" stsyle="width: 120px;">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->products as $product)
                                <tr>
                                    <td style="padding-left:25px !important;">{{ $product->product_id ?? '' }}</td>
                                    <td>{{ $product->sku ?? '' }}</td>
                                    <td>{{ $product->name ?? '' }}</td>
                                    <td class="text-end">{{ $product->price ?? '' }}</td>
                                    <td class="text-end">{{ $product->tax_amount ?? '' }}</td>
                                    <td>{{ $product->qty_ordered ?? '' }}</td>
                                    <td class="text-end">{{ $product->price_incl_tax ?? '' }}</td>
                                    <td class="text-end">{{ $product->discount_amount ?? '' }}</td>
                                    <td>{{ $product->discount_percent ?? '' }}%</td>
                                    <td>{{ $product->product_type ?? '' }}</td>
                                    <td>


                                        <div class="hstack gap-3 fs-15 d-flex justify-content-center">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#itemsModal-{{ $product->id }}" class="link-info"
                                                title="View">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </div>

                                        {{-- <div class="dropdown">
                                        <a href="javascript:void(0);" class="btn btn-soft-secondary btn-sm btn-icon"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ri-more-fill"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li data-bs-toggle="modal" data-bs-target="#itemsModal-{{ $product->id }}">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="ri-eye-fill me-2 align-bottom text-muted"></i>
                                                    View
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">
                                                    <i
                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                        </ul>
                                    </div> --}}

                                        <x-modal.common titleName="Items for Product {{ $product->name }}"
                                            idName="itemsModal-{{ $product->id }}" size="modal-lg"
                                            style="width:700px">
                                            <div class="modal-body">
                                                @if (count($product->items) > 0)
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>SKU</th>
                                                                <th>Item Name</th>
                                                                <th>QTY</th>
                                                                <th class="text-end pe-1">Original Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product->items as $item)
                                                                <tr>
                                                                    <td>{{ $loop->iteration ?? '' }}</td>
                                                                    <td>{{ $item->sku ?? '' }}</td>
                                                                    <td>{{ $item->name ?? '' }}</td>
                                                                    <td>{{ $item->qty ?? '' }}</td>
                                                                    <td class="text-end">
                                                                        {{ $item->original_price ?? '' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <x-notification.not-found msg="No items found" />
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" id="close-modal"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </x-modal.common>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
@endpush

<style>
    #product-table tbody td {
        padding: 10px 5px !important;
    }

    #product-table thead th {
        padding-left: 5px !important;
    }
</style>
