@props([
    'label' => 'Drop files here or click to upload',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'size' => '',
])

<div class="dropzone">
    <div class="file-input-container dz-message needsclick text-center">
        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
        <h5 class="">{{ $label }}</h5>
        <input type="file" name="{{ $name }}[]" multiple id="selectImage">
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


@push('scripts')
    <script src="{{ asset('/assets/libs/dropzone/dropzone-min.js') }}"></script>

    {{-- <script>
        selectImage.onchange = evt => {
            dropzonePreview = document.getElementById('dropzone-preview');
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            dropzonePreview.style.display = 'block';
            const [file] = selectImage.files

            console.log(file);


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
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectImage = document.getElementById("selectImage");
            let dropzonePreview = document.getElementById("dropzone-preview");
            let previewList = document.getElementById("dropzone-preview-list");

            selectImage.onchange = function(event) {
                previewList.innerHTML = ""; // Clear previous previews
                dropzonePreview.style.display = "block";

                const files = event.target.files;
                if (files.length > 0) {
                    Array.from(files).forEach((file, index) => {
                        const fileSizeFormatted = convertBytesToSize(file.size);

                        // Create list item for each file
                        let listItem = document.createElement("li");
                        listItem.className = "mt-2";
                        listItem.innerHTML = `
                            <div class="border rounded">
                                <div class="d-flex p-2">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm bg-light rounded">
                                            <img class="img-fluid rounded d-block preview-img" src="${URL.createObjectURL(file)}" alt="Preview Image" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="pt-1">
                                            <h5 class="fs-14 mb-1">${file.name}</h5>
                                            <p class="fs-13 text-muted mb-0">${fileSizeFormatted}</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <button type="button" class="btn btn-sm btn-danger remove-img">Delete</button>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Remove button functionality
                        listItem.querySelector(".remove-img").addEventListener("click", function() {
                            listItem.remove();
                            if (previewList.children.length === 0) {
                                dropzonePreview.style.display = "none"; // Hide preview if empty
                            }
                        });

                        previewList.appendChild(listItem);
                    });
                }
            };

            function convertBytesToSize(bytes) {
                const sizes = ["Bytes", "KB", "MB", "GB", "TB"];
                if (bytes === 0) return "0 Byte";
                const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
            }

            // Remove all images
            document.getElementById("removeImg").onclick = function() {
                previewList.innerHTML = "";
                dropzonePreview.style.display = "none";
                selectImage.value = "";
            };
        });
    </script>




    {{-- <script>
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
    </script> --}}
@endpush
