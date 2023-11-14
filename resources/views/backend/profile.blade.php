@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="{{ url('frontend_assets') }}/css/toastr.min.css">
@endsection

@section('content')
    <!-- backend navigation start-->
    <section>
        <div class="backend_navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="navigation_title">
                            <h3>My Profile</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- backend navigation end-->

    <!-- assesment content start-->
    <section style="min-height: 100vh">
        <div class="assesment_content mb-5 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="background-color: #F7F1E3">
                        <form action="{{ url('save/profile') }}" method="POST" enctype="multipart/form-data"
                            class="p-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label><b>Upload Image :</b></label>
                                        <input type="file" name="image" onclick="hideCurrentImage()"
                                            onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                            class="form-control" accept=".png, .jpg, .jpeg">
                                        <img id="blah2" alt="" class="img-fluid mt-1">
                                        <div class="row" id="currentImage">
                                            <div class="col-lg-12 text-center">
                                                @php
                                                    $profileImage = $user_info->image;
                                                @endphp
                                                @if ($profileImage != null && file_exists(public_path($profileImage)))
                                                    <img src="{{ url($profileImage) }}" class="img-fluid">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label><b>Full Name :</b></label>
                                        <input type="text" name="name" value="{{ $user_info->name }}"
                                            placeholder="Full Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Contact No :</b></label>
                                        <input type="text" name="contact" value="{{ $user_info->contact }}"
                                            placeholder="Contact No" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Company Name :</b></label>
                                        <input type="text" name="company_name" value="{{ $user_info->company_name }}"
                                            placeholder="Company Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Business Email :</b></label>
                                        <input type="text" name="email" value="{{ $user_info->email }}"
                                            placeholder="Business Email" readonly class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><b>New Password :</b></label>
                                        <input type="password" name="password" placeholder="New Password"
                                            class="form-control">
                                        <span style="font-size: 13px">( Type New Password to change your password )</span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn rounded text-white"
                                            style="background-color: #1D4354">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- assesment content end-->
@endsection


@section('footer_js')
    <script>
        function hideCurrentImage() {
            $("#currentImage").hide();
        }
    </script>

    <script src="{{ url('frontend_assets') }}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
@endsection
