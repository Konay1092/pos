@extends('layouts.app')
@section('title','POS')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/cropperjs/dist/cropper.css')}}">
<style type="text/css">
    .image-preview {
        /* width: ; */
        /* Set the desired width */
        height: 200px !important;
        /* Set the desired height */
        /* object-fit: cover; */
        /* To maintain aspect ratio and cover the given dimensions */
        border-radius: 20%;
        /* Optional: To make the image circular */
        /* margin-top: 10px;
        margin-left: 10px; */
        margin: 0 auto;
    }

</style>


@endsection
@section('content')
<!--  Body Wrapper -->

<!-- Sidebar Start -->
<!--  Sidebar End -->
<!--  Header Start -->
@include('components.header')
<!--  Header End -->
@include('components.right_sidebar')
@include('components.left_sidebar')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>User Detials </h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.user')}}">User</a></li>


                                <li class="breadcrumb-item active" aria-current="page">User Details {{$user->name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            {{-- <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a> --}}
                            {{-- <img src="{{asset('vendors/images/profile/default.avif')}}" alt="" class="avatar-photo"> --}}
                            <img src="{{ $user->profile ? asset($user->profile) : asset('vendors/images/profile/default.avif') }}" alt="{{ $user->name }}" class="avatar-photo">

                            {{-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.profile.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <h4 class="text-center">Change Your Profile</h4>
                                <br>
                                <div class="form-group">
                                    <input type="file" name="profile" class="form-control" required>
                                </div>
                                <img id="imagePreview" src="{{ $user->profile ? asset($user->profile) : asset('vendors/images/profile/default.avif') }}" alt="Profile Picture Preview" class="image-preview">


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton">Cancel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
            <h5 class="text-center h5 mb-0">{{ $user->name }}</h5>

            <p class="text-center text-muted font-14">{{ $user->role }}</p>

            <div class="profile-info card-box">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-30">

                    </div>


                    <div class="col-md-4 col-sm-12 mb-30">
                        <h5 class="mb-20 h4 text-blue text-center">Contact Information</h5>

                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">

                        <h2 class="card-title text-primary text-right text-decoration">
                            <a href="{{route('admin.user.delete',$user->id)}}" class="badge badge-danger"> Delete <i class="fas fa-trash"></i></a>

                        </h2>


                    </div>



                </div>

                <div class="row ">

                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">

                            <div class="card-header text-dark text-center">Email Address </div>
                            <div class="card-body">
                                <h5 class="card-title text-dark"> {{isset($user->email) ? $user->email : 'Null'}}</h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">

                            <div class="card-header text-dark  text-center">Phone Number </div>

                            <div class="card-body">
                                <h5 class="card-title text-dark  text-center">{{isset($user->phone) ? $user->phone : 'No Phone Number'}}</h5>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">

                            <div class="card-header text-dark  text-center">Birthday </div>

                            <div class="card-body">
                                <h5 class="card-title text-dark text-center">{{isset($user->dob) ? $user->dob : 'Null'}}</h5>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">

                            <div class="card-header text-dark  text-center">Gender </div>

                            <div class="card-body">
                                <h5 class="card-title text-dark text-uppercase text-center "> {{isset($user->gender) ? $user->gender : 'No Gender'}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">
                            <div class="card-header text-dark text-center">Country </div>

                            <div class="card-body">
                                <h5 class="card-title text-dark text-center">{{isset($user->Country) ? $user->Country : 'No Country'}}</h5>



                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-dark bg-light card-box">
                            <div class="card-header text-center">Postal Code </div>
                            <div class="card-body">
                                <p class="card-title  text-center">{{isset($user->postal_code) ? $user->postal_code : 'No Postal Code'}}</p>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row ">
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">

                            <div class="card-header text-dark  text-center">Address </div>

                            <div class="card-body">
                                <h5 class="card-title text-dark "> {{isset($user->address) ? $user->address : 'No Adress'}}</h5>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">
                            <div class="card-header text-dark text-center">Register Date </div>

                            <div class="card-body">
                                <h5 class="card-title text-dark text-center">{{isset($user->created_at) ? $user->created_at: 'No Register Date'}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-dark bg-light card-box">
                            <div class="card-header text-center">Last Update </div>
                            <div class="card-body">
                                <p class="card-title  text-center">{{isset($user->updated_at) ? $user->updated_at	: 'No Postal Code'}}</p>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">
                            <div class="card-header text-dark  text-center">Facebook <i class="fa-brands fa-facebook"></i> </div>
                            <div class="card-body">
                                <h5 class="card-title text-primary">
                                    <a href="{{ $user->facebook_url ?? '#' }}">
                                        {{ $user->facebook_url ?? 'No facebook url' }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">
                            <div class="card-header text-dark  text-center">Viber <i class="fa-brands fa-viber"></i> </div>

                            <div class="card-body">
                                <h5 class="card-title text-primary text-center">
                                    <a href="{{ $user->viber ?? '#' }}">
                                        {{ $user->viber ?? 'No viber url' }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card text-white bg-light card-box">
                            <div class="card-header text-dark  text-center">Telegram <i class="fa-brands fa-telegram"></i> </div>
                            <div class="card-body">
                                <h5 class="card-title text-primary text-center">
                                    <a href="{{ $user->telegram ?? '#' }}">
                                        {{ $user->telegram ?? 'No telegram url' }}
                                    </a>
                                </h5>
                            </div>
                        </div>

                    </div>
                </div>








            </div>

        </div>

    </div>
</div>

</div>
</div>
</div>
</div>
<div class="footer-wrap pd-20 mb-20 card-box text-center">
    Developed By Nay Oo Lwin
</div>
</div>
</div>
@endsection
@section('js')
<script src="{{asset('src/plugins/cropperjs/dist/cropper.js')}}"></script>


<script>
    window.addEventListener('DOMContentLoaded', function() {
        var image = document.getElementById('image');
        var cropBoxData;
        var canvasData;
        var cropper;

        $('#modal').on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                autoCropArea: 0.5
                , dragMode: 'move'
                , aspectRatio: 3 / 3
                , restore: false
                , guides: false
                , center: false
                , highlight: false
                , cropBoxMovable: false
                , cropBoxResizable: false
                , toggleDragModeOnDblclick: false
                , ready: function() {
                    cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                }
            });
        }).on('hidden.bs.modal', function() {
            cropBoxData = cropper.getCropBoxData();
            canvasData = cropper.getCanvasData();
            cropper.destroy();
        });
    });

</script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var initialImageSrc = "{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('vendors/images/profile/default.avif') }}";
var imagePreview = document.getElementById('imagePreview');
var fileInput = document.querySelector('input[name="profile_picture"]');
var cancelButton = document.getElementById('cancelButton');

fileInput.addEventListener('change', function(event) {
var reader = new FileReader();
reader.onload = function(e) {
imagePreview.src = e.target.result;
};
reader.readAsDataURL(event.target.files[0]);
});

cancelButton.addEventListener('click', function() {
imagePreview.src = initialImageSrc;
fileInput.value = '';
});
});

</script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var initialImageSrc = "{{ $user->profile ? asset($user->profile) : asset('vendors/images/profile/default.avif') }}";

        var imagePreview = document.getElementById('imagePreview');
        var fileInput = document.querySelector('input[name="profile_picture"]');
        var cancelButton = document.getElementById('cancelButton');

        if (fileInput && imagePreview) {
            fileInput.addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        }

        if (cancelButton) {
            cancelButton.addEventListener('click', function() {
                imagePreview.src = initialImageSrc;
                fileInput.value = '';
            });
        }
    });

</script>





@endsection
