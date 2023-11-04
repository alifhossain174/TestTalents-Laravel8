@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
@endsection

@section("header_js")
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@endsection

@section('content')

    <form action="{{url('create/new/test/first')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- backend navigation start-->
        <section>
            <div class="backend_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navigation_title">
                                <h3>Add New Test</h3>
                                <b>This Test will be used to create Assesment</b>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="navigation_item pt-2">
                                <ul>
                                    <li class="active">
                                        <button type="submit" style="cursor: pointer">Next Step <i class="fas fa-arrow-right"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- backend navigation end-->


        <!-- question content start-->
        <section>
            <div class="single_assesment_content mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="assesment_details">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label><b>Test Category :</b></label>
                                                    <select name="test_type" class="form-control" required>
                                                        <option value="">Select One</option>
                                                        @php
                                                            $test_types = App\TestType::orderBy('title','asc')->get();
                                                        @endphp
                                                        @foreach ($test_types as $item)
                                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label><b>Test Level :</b></label>
                                            <select name="test_level" class="form-control" required>
                                                <option value="">Select One</option>
                                                <option value="1">Beginner</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Expert</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label><b>Test Title :</b></label>
                                                    <input type="text" name="test_name" placeholder="Write the Test Title" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><b>Write the Test Summary here :</b></label>
                                            <textarea class="form-control" name="test_summary"  placeholder="Description of the Test / Covered Skills / Relevent Job Roles" required></textarea>
                                        </div>
                                    </div>

                                    {{--  <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><b>Write the Test Description here :</b></label>
                                            <textarea class="form-control" name="test_description" required></textarea>
                                        </div>
                                    </div>  --}}

                                </div>

                                <div class="row">



                                    @if(Auth::user()->type == 1)
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label><b>Test Type :</b></label>
                                            <select name="story_based" class="form-control" required>
                                                <option value="">Select One</option>
                                                <option value="0">Normal Test</option>
                                                <option value="1">Story Based (Like Creative Question)</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    {{--  <div class="col-lg-4">
                                        <div class="form-group">
                                            <label><b>Test Audiance :</b></label>
                                            <input type="text" name="test_audience" placeholder="Such as English Speaking" class="form-control">
                                        </div>
                                    </div>  --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- question content end-->

    </form>
@endsection


@section('footer_js')

    {{--  <script type="text/javascript">
        CKEDITOR.replace('test_description', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>  --}}

    {{--  <script type="text/javascript">
        CKEDITOR.replace('test_author_description', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>  --}}

    <script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

@endsection
