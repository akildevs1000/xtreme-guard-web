@extends('layout.app')
@section('title', $title)
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <div class="error-container" style="display:none;">
                <div class="alert alert-danger">
                    <h4>There were some problems with your input:</h4>
                    <ul class="error-list"></ul>
                </div>
            </div>

            {{-- <x-breadcrumb title="products" parent="Page" /> --}}

            <form id="product-form" method="POST" action="{{ route('products.store') }}" autocomplete="off"
                class="needs-validation1" novalidate1 enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="row">

                                    {{-- 'title',
                                    'slug',
                                    'content',
                                    'author',
                                    'category',
                                    'image',
                                    'status' --}}

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input.txt-group label="Title" name="title"
                                                placeholder="Enter your title name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input.txt-group label="Warranty Info" name="warranty_nfo"
                                                placeholder="Enter your Warranty Info" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <x-input.txt-group label="Author Info" name="author"
                                                placeholder="Enter your author Info" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input.ckeditor id="new-content" name="content" />
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
                                    <x-input.img name="image" />
                                    <div class="invalid-feedbackd" id="img-valid"></div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="button" onclick="store()" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card mb-1">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Publish</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-input.select-group label="Status" name="is_active" itemText="name" itemValue="value"
                                        :items="[
                                            ['name' => 'Active', 'value' => '1'],
                                            ['name' => 'Deactive', 'value' => '0'],
                                        ]" data-choices-search-false value="1" />
                                </div>
                                <div>
                                    <x-input.select-group label="Categories" name="category_id" itemText="name"
                                        itemValue="id" :items="$categories" data-choices-search-true />
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
                                            data-choices-multiple-remove="true" placeholder="Enter tags" type="text" />
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
                                <textarea class="form-control" name="short_desc" placeholder="Must enter minimum of a 100 characters" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            $('document').ready(function() {

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
    @endpush

    @push('styles')
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
    @endpush
@endsection
