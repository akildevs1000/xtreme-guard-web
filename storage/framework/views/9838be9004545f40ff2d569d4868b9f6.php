<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-content">
        <div class="container-fluid">

            <div class="error-container" style="display:none;">
                <div class="alert alert-danger">
                    <h4>There were some problems with your input:</h4>
                    <ul class="error-list"></ul>
                </div>
            </div>

            

            <form id="product-form" method="POST" action="<?php echo e(route('products.store')); ?>" autocomplete="off"
                class="needs-validation1" novalidate1 enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Original Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">$</span>
                                                <input type="text" class="form-control" id="product-price-input"
                                                    placeholder="Enter price" aria-label="Price"
                                                    aria-describedby="product-price-addon" name="original_price">
                                                <div class="invalid-feedback">Please Enter a Original price.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Sales Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">$</span>
                                                <input type="text" class="form-control" id="product-price-input"
                                                    placeholder="Enter price" aria-label="Price"
                                                    aria-describedby="product-price-addon" name="sale_price">
                                                <div class="invalid-feedback">Please Enter a Sales price.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['label' => 'Stocks','name' => 'quantity','placeholder' => 'Enter your Stocks']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Stocks','name' => 'quantity','placeholder' => 'Enter your Stocks']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Category</h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($component)) { $__componentOriginalc4db3777dfadc184078a3030cda241a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc4db3777dfadc184078a3030cda241a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.select-group','data' => ['label' => 'Categories','name' => 'category_id','itemText' => 'name','itemValue' => 'id','items' => $categories,'dataChoicesSearchTrue' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.select-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Categories','name' => 'category_id','itemText' => 'name','itemValue' => 'id','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories),'data-choices-search-true' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $attributes = $__attributesOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__attributesOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $component = $__componentOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__componentOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Brand</h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($component)) { $__componentOriginalc4db3777dfadc184078a3030cda241a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc4db3777dfadc184078a3030cda241a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.select-group','data' => ['label' => 'Categories','name' => 'brand_id','itemText' => 'name','itemValue' => 'id','items' => $categories,'dataChoicesSearchTrue' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.select-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Categories','name' => 'brand_id','itemText' => 'name','itemValue' => 'id','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories),'data-choices-search-true' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $attributes = $__attributesOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__attributesOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $component = $__componentOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__componentOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['label' => 'Product Name','name' => 'name','placeholder' => 'Enter your Product name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Product Name','name' => 'name','placeholder' => 'Enter your Product name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['label' => 'Warranty Info','name' => 'warranty_nfo','placeholder' => 'Enter your Warranty Info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Warranty Info','name' => 'warranty_nfo','placeholder' => 'Enter your Warranty Info']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                                        </div>
                                    </div>

                                    <div>
                                        <?php if (isset($component)) { $__componentOriginal62756889c56acb2b0c567c4707253072 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal62756889c56acb2b0c567c4707253072 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.ckeditor','data' => ['id' => 'new-content','name' => 'description']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.ckeditor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'new-content','name' => 'description']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal62756889c56acb2b0c567c4707253072)): ?>
<?php $attributes = $__attributesOriginal62756889c56acb2b0c567c4707253072; ?>
<?php unset($__attributesOriginal62756889c56acb2b0c567c4707253072); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal62756889c56acb2b0c567c4707253072)): ?>
<?php $component = $__componentOriginal62756889c56acb2b0c567c4707253072; ?>
<?php unset($__componentOriginal62756889c56acb2b0c567c4707253072); ?>
<?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="mt-3">
                                    <?php if (isset($component)) { $__componentOriginala4033d5e0f0df4bfae18d13486104b2b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala4033d5e0f0df4bfae18d13486104b2b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.img-multiple','data' => ['name' => 'images']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.img-multiple'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'images']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala4033d5e0f0df4bfae18d13486104b2b)): ?>
<?php $attributes = $__attributesOriginala4033d5e0f0df4bfae18d13486104b2b; ?>
<?php unset($__attributesOriginala4033d5e0f0df4bfae18d13486104b2b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala4033d5e0f0df4bfae18d13486104b2b)): ?>
<?php $component = $__componentOriginala4033d5e0f0df4bfae18d13486104b2b; ?>
<?php unset($__componentOriginala4033d5e0f0df4bfae18d13486104b2b); ?>
<?php endif; ?>
                                    <div class="invalid-feedbackd" id="img-valid"></div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="card mb-1">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                            role="tab" aria-selected="true">
                                            Product Attributes
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata"
                                            role="tab" aria-selected="false" tabindex="-1">
                                            Product Attachment
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="addproduct-general-info" role="tabpanel">
                                        <div class="table-responsivew">
                                            <p class="text-muted">
                                                <button type="button" id="newRow"
                                                    class="float-end add-row btn mb-2 fw-medium btn-soft-secondary">
                                                    <i class="ri-add-fill me-1 align-bottom"></i>
                                                    Add New
                                                </button>
                                            </p>
                                            <table class="invoice-table table table-borderless table-nowrap mb-0">
                                                <tbody id="newlink">
                                                    <tr id="1" class="product">
                                                        <td class="text-start py-0 w-50">
                                                            <div class="mb-0">
                                                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['name' => 'attribute[]','placeholder' => 'Enter attribute']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'attribute[]','placeholder' => 'Enter attribute']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <td class="py-0">
                                                            <div>
                                                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['name' => 'value[]','placeholder' => 'Enter your  attribute value']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'value[]','placeholder' => 'Enter your  attribute value']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <td class="product-removal py-0">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger remove-row">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                        <div class="table-responsivew">
                                            <p class="text-muted">
                                                <button type="button" id="attachednewRow"
                                                    class="float-end add-attachment-row btn mb-2 fw-medium btn-soft-secondary">
                                                    <i class="ri-add-fill me-1 align-bottom"></i>
                                                    Add New
                                                </button>
                                            </p>

                                            <table class="invoice-table table table-borderless table-nowrap mb-0">
                                                <tbody id="attached-area">
                                                    <tr id="1" class="product">
                                                        <td class="text-start py-0 w-50">
                                                            <div class="mb-0">
                                                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['name' => 'attachment_attribute[]','placeholder' => 'Enter attachement name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'attachment_attribute[]','placeholder' => 'Enter attachement name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <td class="py-0">
                                                            <div>
                                                                <input type="file" class="form-control"
                                                                    name="attachment_value[]">
                                                            </div>
                                                        </td>
                                                        <td class="product-removal py-0">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-danger remove-row">
                                                                <i class="ri-delete-bin-5-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="button" onclick="store()" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Publish</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php if (isset($component)) { $__componentOriginalc4db3777dfadc184078a3030cda241a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc4db3777dfadc184078a3030cda241a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.select-group','data' => ['label' => 'Status','name' => 'is_active','itemText' => 'name','itemValue' => 'value','items' => [
                                            ['name' => 'Active', 'value' => '1'],
                                            ['name' => 'Deactive', 'value' => '0'],
                                        ],'dataChoicesSearchFalse' => true,'value' => '1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.select-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Status','name' => 'is_active','itemText' => 'name','itemValue' => 'value','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                            ['name' => 'Active', 'value' => '1'],
                                            ['name' => 'Deactive', 'value' => '0'],
                                        ]),'data-choices-search-false' => true,'value' => '1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $attributes = $__attributesOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__attributesOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $component = $__componentOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__componentOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
                                </div>
                                <div>
                                    <?php if (isset($component)) { $__componentOriginalc4db3777dfadc184078a3030cda241a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc4db3777dfadc184078a3030cda241a6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.select-group','data' => ['label' => 'Condition','name' => 'condition','itemText' => 'name','itemValue' => 'value','items' => [
                                            ['name' => 'New', 'value' => 'good'],
                                            ['name' => 'Used', 'value' => 'average'],
                                        ],'dataChoicesSearchFalse' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.select-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Condition','name' => 'condition','itemText' => 'name','itemValue' => 'value','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                            ['name' => 'New', 'value' => 'good'],
                                            ['name' => 'Used', 'value' => 'average'],
                                        ]),'data-choices-search-false' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $attributes = $__attributesOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__attributesOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc4db3777dfadc184078a3030cda241a6)): ?>
<?php $component = $__componentOriginalc4db3777dfadc184078a3030cda241a6; ?>
<?php unset($__componentOriginalc4db3777dfadc184078a3030cda241a6); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Tags</h5>
                            </div>
                            <div class="card-body">
                                <div class="hstack gap-3 align-items-start">
                                    <div class="flex-grow-1">
                                        <input class="form-control" name="tags[]" data-choices
                                            data-choices-multiple-remove="true" placeholder="Enter tags"
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Short Description</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">Add short description for product</p>
                                <textarea class="form-control" name="short_desc" placeholder="Must enter minimum of a 100 characters"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            $('document').ready(function() {

                let i = 1;

                $(document).on('click', '.add-row', function() {
                    var newRow = `
                    <tr class="product">
                        <td class="text-start py-0 w-50">
                            <div class="mb-0">
                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['id' => 'attribute','name' => 'attribute[]','placeholder' => 'Enter attribute']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'attribute','name' => 'attribute[]','placeholder' => 'Enter attribute']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>

                            </div>
                        </td>
                        <td class="py-0">
                            <div>
                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['name' => 'value[]','placeholder' => 'Enter your attribute value']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'value[]','placeholder' => 'Enter your attribute value']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                            </div>
                        </td>
                        <td class="product-removal py-0">
                            <a href="javascript:void(0)" class="btn btn-danger remove-row">
                                <i class="ri-delete-bin-5-line"></i>
                            </a>
                        </td>
                    </tr>`;

                    $('#newlink').append(newRow);

                    i++;
                });

                $(document).on('click', '.add-attachment-row', function() {
                    var newRow = `
                    <tr class="product">
                        <td class="text-start py-0 w-50">
                            <div class="mb-0">
                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['id' => 'attribute','name' => 'attachment_attribute[]','placeholder' => 'Enter attribute']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'attribute','name' => 'attachment_attribute[]','placeholder' => 'Enter attribute']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $attributes = $__attributesOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__attributesOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalba4a6445a25c58945f3953b45fb960dc)): ?>
<?php $component = $__componentOriginalba4a6445a25c58945f3953b45fb960dc; ?>
<?php unset($__componentOriginalba4a6445a25c58945f3953b45fb960dc); ?>
<?php endif; ?>
                            </div>
                        </td>
                        <td class="py-0">
                            <div>
                                <input type="file" class="form-control" name="attachment_value[]">
                            </div>
                        </td>
                        <td class="product-removal py-0">
                            <a href="javascript:void(0)" class="btn btn-danger remove-row">
                                <i class="ri-delete-bin-5-line"></i>
                            </a>
                        </td>
                    </tr>`;

                    $('#attached-area').append(newRow);

                    i++;
                });

                $(document).on('click', '.remove-row', function() {
                    var rowCount = $('.invoice-table tr').length;
                    if (rowCount == 1) {
                        alertNotify('At least two rows are required. You cannot delete the last remaining row.',
                            'error');
                    } else {
                        $(this).closest('tr').remove();
                    }
                });

                var ckClassicEditor = document.querySelectorAll("#new-content")
                ckClassicEditor.forEach(function() {
                    ClassicEditor
                        .create(document.querySelector('#new-content'))
                        .then(function(editor) {
                            editor.ui.view.editable.element.style.height = '200px';
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                });

            });

            function store() {
                $('#new-content').html($('.ck-content').html());
                var form = document.getElementById('product-form');
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                // payload.append('img', document.getElementById('selectImage').files[0]);

                var profileImgInput = document.getElementById('selectImage');

                if (profileImgInput.files.length > 0) {
                    payload.append('img', profileImgInput.files[0]);
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
                        if (response.status) {
                            alertNotify(response.message, 'success')
                            // $("#product-form :input").val("");
                            associateErrors([], 'product-form');
                        } else {
                            associateErrors(response.errors, 'product-form');

                            // showErrorMsg(response);
                            console.log(response.errors['images']);
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function showErrorMsg(response) {
                // Clear previous errors
                $('.error-list').empty();

                // Loop through the errors and display them
                $.each(response.errors, function(key, messages) {
                    // Remove the trailing .0 from the key
                    let formattedKey = key.replace(/\.0$/, '');
                    formattedKey = formattedKey.replace('.', ' '); // Optional: Replace '.' with space

                    let errorHtml = `<li><strong>${formattedKey}:</strong><ul>`;
                    messages.forEach(function(message) {
                        errorHtml += `<li>${message}</li>`;
                    });
                    errorHtml += '</ul></li>';

                    $('.error-list').append(errorHtml);
                });

                // Show the error container (if hidden)
                $('.error-container').show();
            }
        </script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('styles'); ?>
        <style>
            table.dataTable tr {
                border: 2px solid #dbdade;
            }

            table.dataTable {
                border-top: 1px solid #dbdade;
                border-right: 1px solid #dbdade;
                border-left: 1px solid #dbdade;
            }

            /* Style for the file input container */
            .file-input-container {
                position: relative;
                width: 200px;
                height: 100px;
                overflow: hidden;
                background-color: white;
                color: black;
                border-radius: 5px;
                cursor: pointer;
            }

            /* Style for the actual file input (opacity set to 0 to make it invisible) */
            .file-input-container input {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                cursor: pointer;
            }

            /* Style for the text inside the file input container */
            .file-input-text {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
            }

            /* Style for the preview image */
            #preview {
                display: none;
                /* max-width: 100%; */
                /* height: auto; */
                border-radius: 5px;
                width: 100px;
                height: 50px;
            }

            .dropzone {
                min-height: 120px !important;
            }
        </style>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Install\laragon\www\akil\resources\views/pages/product/create.blade.php ENDPATH**/ ?>