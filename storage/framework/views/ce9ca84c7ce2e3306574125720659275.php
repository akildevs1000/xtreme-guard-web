<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startPush('styles'); ?>
    <?php $__env->stopPush(); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row" id="role-card-area">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xxl-3 col-md-4">
                        <?php if (isset($component)) { $__componentOriginal8171cd96d47d2281c1a8a9a41f11cfb3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8171cd96d47d2281c1a8a9a41f11cfb3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card-category','data' => ['categoryName' => $category->name,'categoryId' => $category->id,'item' => $category,'color' => 'warning','per' => 'administration-role-edit','perDelete' => 'administration-role-delete']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card.card-category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['categoryName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->name),'categoryId' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->id),'item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category),'color' => 'warning','per' => 'administration-role-edit','perDelete' => 'administration-role-delete']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8171cd96d47d2281c1a8a9a41f11cfb3)): ?>
<?php $attributes = $__attributesOriginal8171cd96d47d2281c1a8a9a41f11cfb3; ?>
<?php unset($__attributesOriginal8171cd96d47d2281c1a8a9a41f11cfb3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8171cd96d47d2281c1a8a9a41f11cfb3)): ?>
<?php $component = $__componentOriginal8171cd96d47d2281c1a8a9a41f11cfb3; ?>
<?php unset($__componentOriginal8171cd96d47d2281c1a8a9a41f11cfb3); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xxl-3 col-md-4">
                    
                    <?php if (isset($component)) { $__componentOriginal1d1dcf32cbaabfd51da77aa531f4fa8b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d1dcf32cbaabfd51da77aa531f4fa8b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card-add-category','data' => ['color' => 'success','funName' => 'CategoryModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card.card-add-category'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'success','funName' => 'CategoryModal']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d1dcf32cbaabfd51da77aa531f4fa8b)): ?>
<?php $attributes = $__attributesOriginal1d1dcf32cbaabfd51da77aa531f4fa8b; ?>
<?php unset($__attributesOriginal1d1dcf32cbaabfd51da77aa531f4fa8b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d1dcf32cbaabfd51da77aa531f4fa8b)): ?>
<?php $component = $__componentOriginal1d1dcf32cbaabfd51da77aa531f4fa8b; ?>
<?php unset($__componentOriginal1d1dcf32cbaabfd51da77aa531f4fa8b); ?>
<?php endif; ?>
                    
                </div>
            </div>

            
            <?php if (isset($component)) { $__componentOriginalee9eb143e5f746bdda859990c2392dfb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee9eb143e5f746bdda859990c2392dfb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.common','data' => ['titleName' => 'Add Category','idName' => 'CategoryModal','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal.common'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['titleName' => 'Add Category','idName' => 'CategoryModal','size' => 'modal-lg']); ?>
                <form action="<?php echo e(route('category.store')); ?>" method="POST" id="category-form" class="tablelist-form"
                    autocomplete="off" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="is_edit" id="is_edit">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <?php if (isset($component)) { $__componentOriginalba4a6445a25c58945f3953b45fb960dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalba4a6445a25c58945f3953b45fb960dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txt-group','data' => ['label' => 'Category Name','name' => 'name','placeholder' => 'Enter your Category Name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txt-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Category Name','name' => 'name','placeholder' => 'Enter your Category Name']); ?>
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
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <?php if (isset($component)) { $__componentOriginalc970d43d2bebb73e23696e8ac5b1c946 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc970d43d2bebb73e23696e8ac5b1c946 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.select-group-js','data' => ['name' => 'is_active','label' => 'Status','itemText' => 'name','itemValue' => 'value','items' => [
                                        ['name' => 'Active', 'value' => '1'],
                                        ['name' => 'Inactive', 'value' => '0'],
                                    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.select-group-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Status','itemText' => 'name','itemValue' => 'value','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                        ['name' => 'Active', 'value' => '1'],
                                        ['name' => 'Inactive', 'value' => '0'],
                                    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc970d43d2bebb73e23696e8ac5b1c946)): ?>
<?php $attributes = $__attributesOriginalc970d43d2bebb73e23696e8ac5b1c946; ?>
<?php unset($__attributesOriginalc970d43d2bebb73e23696e8ac5b1c946); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc970d43d2bebb73e23696e8ac5b1c946)): ?>
<?php $component = $__componentOriginalc970d43d2bebb73e23696e8ac5b1c946; ?>
<?php unset($__componentOriginalc970d43d2bebb73e23696e8ac5b1c946); ?>
<?php endif; ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php if (isset($component)) { $__componentOriginal5b9bb5cf3aa0badc02f250a845376a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5b9bb5cf3aa0badc02f250a845376a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.img','data' => ['name' => 'img1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.img'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'img1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5b9bb5cf3aa0badc02f250a845376a3f)): ?>
<?php $attributes = $__attributesOriginal5b9bb5cf3aa0badc02f250a845376a3f; ?>
<?php unset($__attributesOriginal5b9bb5cf3aa0badc02f250a845376a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b9bb5cf3aa0badc02f250a845376a3f)): ?>
<?php $component = $__componentOriginal5b9bb5cf3aa0badc02f250a845376a3f; ?>
<?php unset($__componentOriginal5b9bb5cf3aa0badc02f250a845376a3f); ?>
<?php endif; ?>
                                
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php if (isset($component)) { $__componentOriginaledf30e07bfd0537f17af0268d0124efb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaledf30e07bfd0537f17af0268d0124efb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input.txtarea-group','data' => ['label' => 'Description','name' => 'description','placeholder' => 'Enter your description']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input.txtarea-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Description','name' => 'description','placeholder' => 'Enter your description']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaledf30e07bfd0537f17af0268d0124efb)): ?>
<?php $attributes = $__attributesOriginaledf30e07bfd0537f17af0268d0124efb; ?>
<?php unset($__attributesOriginaledf30e07bfd0537f17af0268d0124efb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaledf30e07bfd0537f17af0268d0124efb)): ?>
<?php $component = $__componentOriginaledf30e07bfd0537f17af0268d0124efb; ?>
<?php unset($__componentOriginaledf30e07bfd0537f17af0268d0124efb); ?>
<?php endif; ?>
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
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee9eb143e5f746bdda859990c2392dfb)): ?>
<?php $attributes = $__attributesOriginalee9eb143e5f746bdda859990c2392dfb; ?>
<?php unset($__attributesOriginalee9eb143e5f746bdda859990c2392dfb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee9eb143e5f746bdda859990c2392dfb)): ?>
<?php $component = $__componentOriginalee9eb143e5f746bdda859990c2392dfb; ?>
<?php unset($__componentOriginalee9eb143e5f746bdda859990c2392dfb); ?>
<?php endif; ?>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
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
                    // setFormActionAndMethod(`<?php echo e(url('roomease/apartment')); ?>/${data.id}`, 'PUT');
                    updateSubmitButtonText('Update category');
                    updateFormFields(data);
                } else {
                    setFormActionAndMethod('<?php echo e(route('category.store')); ?>');
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
                            // redirectTo('<?php echo e(route('user.index')); ?>');
                            // refreshContent('administration/role', 'role-card-area')
                            eLoading('sbtBtn')
                            refreshContent('<?php echo e(url('administration/role')); ?>', 'role-card-area');
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
                // var url = '<?php echo e(url('role')); ?>/' + roleId + '/edit';
                var url = '<?php echo e(url('administration/role')); ?>/' + roleId;
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
                            refreshContent('<?php echo e(url('administration/role')); ?>', 'role-card-area');
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
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Install\laragon\www\akil\resources\views/pages/category/index.blade.php ENDPATH**/ ?>