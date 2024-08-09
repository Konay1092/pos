@extends('layouts.app')
@section('title', 'Edit Product')
@section('css')
<style>
    .image-container,
    .video-container {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .delete-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        background: red;
        color: white;
        border-radius: 50%;
        padding: 5px;
        cursor: pointer;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .video-media-preview {
        width: 250px;
        height: 250px;
    }

    .image-media-preview {
        width: 100px;
        height: 100px;
    }

</style>
@endsection

@section('content')
@include('components.header')
@include('components.right_sidebar')
@include('components.left_sidebar')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h4>Product</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-info card-box">
                            <h5 class="mb-20 h4 text-blue text-center">Edit Product</h5>
                        </div>

                        <br>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="container">
                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Product Name</span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" placeholder="Enter Your Product Name" name="name" value="{{ $product->name }}" required>
                                            <div class="input-group-append custom">
                                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Brand --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Brand</span>
                                            </div>
                                            <select class="form-control form-control-lg" id="brand_id" name="brand_id" required>
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Category</span>
                                            </div>
                                            <select class="form-control form-control-lg" id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Sub Category --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Sub-Category</span>
                                            </div>
                                            <select class="form-control form-control-lg" id="subcategory_id" name="subcategory_id" required>
                                                <option value="">Select a category first</option>
                                                @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Short Description --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group html-editor custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Short Description</span>
                                            </div>
                                            <div class="html-editor pd-20 card-box col-md-9">
                                                <textarea class="textarea_editor form-control border-radius-0" placeholder="Enter Your Short Product Description" name="sh_description">{{ $product->short_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Product Description --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Description</span>
                                            </div>
                                            <div class="col-md-9 card-box">
                                                <textarea class="form-control pd-30" id="description" name="pd_description" rows="4">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Product Image --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Product Image</span>
                                            </div>
                                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 row">
                                        <div id="imagePreviewContainer" class="col-md-12">
                                            @foreach($product->images as $image)
                                            <div class="image-container">
                                                <img src="{{ asset($image->path) }}" class="image-media-preview" />
                                                <span class="delete-icon" data-id="{{ $image->id }}">&times;</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Product Video --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Product Video</span>
                                            </div>
                                            <input type="file" class="form-control" id="videos" name="videos[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 row">
                                        <div id="videoPreviewContainer">
                                            @foreach($product->videos as $video)
                                            <div class="video-container">
                                                <video src="{{ asset($video->path) }}" class="video-media-preview" controls></video>
                                                <span class="delete-icon" data-id="{{ $video->id }}">&times;</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-30"></div>
                                <div class="col-md-4 col-sm-12 mb-30">
                                    <button type="submit" class="btn btn-primary m0">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-wrap pd-20 mb-20 card-box">
    Developed By Nay Oo Lwin
</div>

@endsection

@section('js')
<script src="{{ asset('/assets/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script type="text/javascript">
    tinymce.init({
                selector: 'textarea#description',
                height: 300,
                menubar: false,
                statusbar: false,
    forced_root_block: '',

    plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });

    $(document).ready(function() {
    var imageFilesArray = [];
    var videoFilesArray = [];

    $('#images').change(function(e) {
    $('#imagePreviewContainer').empty();
    imageFilesArray = Array.from(e.target.files);
    previewFiles(imageFilesArray, '#imagePreviewContainer', 'image');
    });

    $('#videos').change(function(e) {
    $('#videoPreviewContainer').empty();
    videoFilesArray = Array.from(e.target.files);
    previewFiles(videoFilesArray, '#videoPreviewContainer', 'video');
    });

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('#category_id').change(function() {
    var categoryId = $(this).val();

    // Clear existing subcategory options
    $('#subcategory_id').empty().append(new Option('There is no sub category for this category', '', false, false)).prop('disabled', true);

    $.ajax({
    url: '{{ route('subcategories.fetch') }}',
    headers: {
    'X-CSRF-TOKEN': csrfToken
    },
    method: 'POST',
    data: {
    category_id: categoryId
    },
    success: function(response) {
    $('#subcategory_id').empty();

    if (response.subcategories.length > 0) {
    // Populate subcategory dropdown
    $.each(response.subcategories, function(index, subcategory) {
    $('#subcategory_id').append(new Option(subcategory.name, subcategory.id));
    });
    $('#subcategory_id').prop('disabled', false);
    } else {
    // Handle no subcategories
    $('#subcategory_id').append(new Option('No subcategories available', '', true, true)).prop('disabled', true);
    }
    }
    });
    });

    function previewFiles(files, container, type) {
    files.forEach((file, index) => {
    var reader = new FileReader();
    reader.onload = function(e) {
    var mediaContainer = $('<div>').attr('class', type + '-container image-container');
        var media;
        if (type === 'image') {
        media = $('<img>').attr('src', e.target.result).attr('class', 'image-media-preview');
        } else {
        media = $('<video>').attr('src', e.target.result).attr('class', 'video-media-preview').attr('controls', true);
            }
            var deleteIcon = $('<span>').attr('class', 'delete-icon').html('&times;');

                deleteIcon.click(function() {
                mediaContainer.remove();
                if (type === 'image') {
                imageFilesArray = imageFilesArray.filter(f => f !== file);
                updateInputField('#images', imageFilesArray);
                } else {
                videoFilesArray = videoFilesArray.filter(f => f !== file);
                updateInputField('#videos', videoFilesArray);
                }
                });

                mediaContainer.append(media).append(deleteIcon);
                $(container).append(mediaContainer);
                }
                reader.readAsDataURL(file);
                });
                }

                function updateInputField(selector, files) {
                var dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                $(selector)[0].files = dataTransfer.files;
                }
                });
</script>
@endsection
