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
                                <li class="breadcrumb-item active" aria-current="page">Show Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-info card-box">
                            {{-- <h5 class="mb-20 h4 text-blue text-center">Show Product</h5> --}}
                            <div class="row">
                                <div class="col-md-4 col-sm-12">

                                </div>


                                <div class="col-md-4 col-sm-12 ">
                                    <h5 class=" h3 text-dark text-center">Product Details</h5>

                                </div>
                                <div class="col-md-4 col-sm-12 ">

                                    <h2 class="card-title text-primary text-right text-decoration">
                                        <a href="{{ route('products.edit', $product->id) }}" class="badge badge-primary"> Edit <i class="fas fa-edit"></i></a>

                                    </h2>


                                </div>



                            </div>

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
                                            <input type="text" class="form-control form-control-lg" placeholder="Enter Your Product Name" name="name" value="{{ $product->name }}" readonly >
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
<input type="text" class="form-control form-control-lg" placeholder="Enter Your Product Name" name="name" value="{{ $product['brand']['name'] }}" readonly >
                                            <div class="input-group-append custom">
                                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Category</span>
                                            </div>
                                           <input type="text" class="form-control form-control-lg" placeholder="Enter Your Product Name" name="name" value="{{ $product['category']['name'] }}" readonly >
                                        </div>
                                    </div>

                                    {{-- Sub Category --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Sub-Category</span>
                                            </div>
                                           <input type="text" class="form-control form-control-lg" placeholder="Enter Your Product Name" name="name" value="{{ $product['subcategory']['name'] }}" readonly >
                                        </div>
                                    </div>

                                    {{-- Short Description --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group html-editor custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Short Description</span>
                                            </div>
                                           <input type="text" class="form-control form-control-lg" placeholder="Null" name="name" value="{{ $product->short_description }}" readonly >
                                        </div>
                                    </div>

                                    {{-- Product Description --}}
                                    <div class="col-md-12 col-12">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Description</span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" placeholder="Enter Your Product Name" name="name" value="{{ $product->description}}" readonly >
                                        </div>
                                    </div>

                                    {{-- Product Image --}}
                                    <div class="col-md-12 col-12 card card-box mb-2">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Product Image</span>
                                            </div>
                                            {{-- <input type="file" class="form-control" id="images" name="images[]" multiple> --}}
                                             <div class="col-md-9 row">
                                        <div id="imagePreviewContainer" class="col-md-12">
                                            @foreach($product->images as $image)
                                            <div class="image-container">
                                                <img src="{{ asset($image->path) }}" class="image-media-preview" />
                                                {{-- <span class="delete-icon" data-id="{{ $image->id }}">&times;</span> --}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                        </div>
                                    </div>


                                    {{-- Product Video --}}
                                    <div class="col-md-12 col-12 card card-box">
                                        <div class="input-group custom">
                                            <div class="input-group-prepend col-md-3">
                                                <span class="input-group-text">Product Video</span>
                                            </div>
                                             <div class="col-md-9 row">
                                        <div id="videoPreviewContainer">
                                            @foreach($product->videos as $video)
                                            <div class="video-container">
                                                <video src="{{ asset($video->path) }}" class="video-media-preview" controls></video>
                                                {{-- <span class="delete-icon" data-id="{{ $video->id }}">&times;</span> --}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                            {{-- <input type="file" class="form-control" id="videos" name="videos[]" multiple> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-4 col-sm-12 mb-30"></div>
                                <div class="col-md-4 col-sm-12 mb-30">
                                    <button type="submit" class="btn btn-primary m0">Update</button>
                                </div>
                            </div> --}}
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
