<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'label' => 'Drop files here or click to upload',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'label' => 'Drop files here or click to upload',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
]); ?>
<?php foreach (array_filter(([
    'label' => 'Drop files here or click to upload',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="dropzone">
    <div class="file-input-container dz-message needsclick text-center">
        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
        <h5 class=""><?php echo e($label); ?></h5>
        <input type="file" name="<?php echo e($name); ?>" multiple id="selectImage">
    </div>
</div>

<ul class="list-unstyled mb-0 mt-4" id="dropzone-preview" style="display:none">
    <li class="mt-2" id="dropzone-preview-list">
        <div class="border rounded">
            <div class="d-flex p-2">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar-sm bg-light rounded">
                        <img data-dz-thumbnail class="img-fluid rounded d-block" id="preview" src="#"
                            alt="Product-Image" />
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="pt-1">
                        <h5 class="fs-14 mb-1" id="img-name">&nbsp;</h5>
                        <p class="fs-13 text-muted mb-0" id="img-size"></p>
                        
                    </div>
                </div>
                <div class="flex-shrink-0 ms-3">
                    <button type="button" id="removeImg" class="btn btn-sm btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </li>
</ul>


<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('/assets/libs/dropzone/dropzone-min.js')); ?>"></script>

    <script>
        selectImage.onchange = evt => {
            dropzonePreview = document.getElementById('dropzone-preview');
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            dropzonePreview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                const fileSizeFormatted = convertBytesToSize(file.size);
                $('#img-name').html(file.name);
                $('#img-size').html(fileSizeFormatted);
                preview.src = URL.createObjectURL(file)
            }
        }

        removeImg.onclick = () => {
            const removePreviewBtn = document.getElementById('removeImg');
            preview.style.display = 'none';
            dropzonePreview.style.display = 'none';
            selectImage.value = '';
            $('#img-name').html('');
            $('#img-size').html('');
        };




        function convertBytesToSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

            if (bytes === 0) return '0 Byte';

            const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));

            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }

        var ckClassicEditor = document.querySelectorAll("#content")
        ckClassicEditor.forEach(function() {
            ClassicEditor
                .create(document.querySelector('#content'))
                .then(function(editor) {
                    editor.ui.view.editable.element.style.height = '200px';
                })
                .catch(function(error) {
                    console.error(error);
                });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/input/img.blade.php ENDPATH**/ ?>