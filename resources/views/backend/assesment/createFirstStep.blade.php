@extends('backend.master')

@section('header_css')
    <link href="{{url('select2Autocomplete')}}/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <form action="{{url('save/assesment/firststep')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- backend navigation start-->
        <section>
            <div class="backend_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navigation_title">
                                <h3>Create New Assesment (Step-1)</h3>
                                <b>Give a Title & Select Job Role</b>
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

                                <div class="row pb-5 pt-3">
                                    <div class="col-lg-3 text-center">
                                        <a class="btn text-white" style="background: #226679" style="cursor:default">Step 1 : Set Title & Role</a> <i class="fas fa-arrow-right" style="color: #226679"></i>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <button class="btn btn-dark text-white" type="submit" style="cursor: pointer;box-shadow: 5px 5px 10px gray">Step 2 : Select Test</button> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 3 : Add Question</a> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 4 : Review & Configure</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label><b>Name Your Assesment :</b></label>
                                                    <input name="title" placeholder="Assesment" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <label><b>Select Job Role :</b></label>
                                                    {{-- <select name="job_role" id="job_role" class="form-control select2">

                                                    </select> --}}
                                                    <input name="job_role" placeholder="Job Role" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
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
    <script src="{{url('select2Autocomplete')}}/select2.min.js"></script>

    <script type="text/javascript">
        $('#job_role').select2({
            placeholder: 'Write a Job Role',
            ajax: {
                url: '{{ url('/autocompleteSearchJobRole') }}',
                dataType: 'json',
                delay: 0,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
                },
                cache: true
            }
        });
    </script>
@endsection
