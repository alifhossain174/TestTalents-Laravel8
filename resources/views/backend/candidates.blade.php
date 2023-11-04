@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="{{url('select2Tagging')}}/select2.min.css"/>
    <link rel="stylesheet" href="{{ url('frontend_assets') }}/css/toastr.min.css">
    <link rel="stylesheet" href="{{ url('jQueryDateTimePicker') }}/jquery.datetimepicker.min.css">
    <style>
        span.select2-selection {
            border-radius: 5px !important;
        }

        span.select2-dropdown--below {
            display: none !important;
        }
        table.assessment_list th {
            background: #1D4354;
            color: ghostwhite;
            border-left: 1px solid ghostwhite;
        }

        .modal-content {
            background: #376678
        }

        .modal-header {
            background: #376678;
            padding-left: 25px;
            padding-right: 25px
        }

        .modal-header h5 {
            color: white;
            font-size: 18px
        }

        .modal-body {
            background: white;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 30px
        }

        .modal-body button {
            color: white;
            background: #376678;
            font-size: 15px;
            font-weight: 600;
            padding-left: 18px;
            padding-right: 18px
        }

        .testimonial_left_part span {
            font-family: 'Roboto', sans-serif !important;
            font-weight: 400;
            font-size: 16px;
        }

        .testimonial_left_part label span {
            font-family: 'Roboto', sans-serif !important;
            font-weight: 400;
            font-size: 13px;
        }
        .testimonial_left_part label {
            font-family: 'Roboto', sans-serif !important;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: .2rem !important;
        }

        a.invite_evaluation{
            background-color: #1D4354;
            font-weight: 600;
            color: white;
            text-shadow: 1px 2px 2px black;
            box-shadow: 5px 5px 10px gray;
            transition: all .3s linear;
        }

        a.invite_evaluation:hover{
            box-shadow: none;
        }

    </style>

    {{-- for data table css --}}
    <link href="{{ url('dataTable') }}/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ url('dataTable') }}/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0px;
            border-radius: 4px;
        }
        div.dataTables_wrapper div.dataTables_filter input{
            margin-right: 10px;
        }
        table.dataTable tbody td:nth-child(1){
            text-align: center !important;
            font-weight: 600;
        }
        table.dataTable tbody td:nth-child(4){
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(5){
            text-align: center !important;
            font-weight: 600;
        }
        table.dataTable tbody td:nth-child(6){
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(7){
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(8){
            text-align: center !important;
        }
    </style>
@endsection

@section('content')

    <!-- backend navigation start-->
    <section>
        <div class="backend_navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="navigation_title">
                            <h3 class="mb-2">{{ $assesment_info->title }}</h3>
                            <b><i class="far fa-file-alt"></i>
                                {{ App\AssesmentTest::where('assesment_slug', $assesment_info->slug)->count() }}</b> Test
                            <b class="ml-2"><i class="far fa-question-circle"></i>
                                {{ App\QuestionBank::where('assesment_id', $assesment_info->id)->count() }}</b> Custom
                            Questions
                            <b class="ml-2"><i class="fas fa-marker"></i> {{ $assesment_info->total_marks }}</b>
                            marks
                            <b class="ml-2"><i class="far fa-clock"></i> {{ $assesment_info->total_mins }}</b>
                            mins
                            <b class="ml-2"><i class="fas fa-users"></i> {{$no_of_candiates}}</b> Candidates
                        </div>
                    </div>
                    <div class="col-lg-3 text-right">
                        @if($assessmentOwner)
                            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$assesment_info->slug}}" class="btn rounded mt-2 invite_evaluation"><i class="fas fa-chalkboard-teacher"></i>&nbsp; Invite for Evaluation</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- backend navigation end-->

    <!-- assesment content start-->
    <section style="min-height: 100vh">
        <div class="assesment_content mb-5">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 pt-5">

                        {{-- custom filter starts --}}
                        <label id="customFilter">
                            <select id="webcam_datatable_filter" class="form-control form-control-sm custom-cls" style="width: 80px; margin-right: 5px">
                                <option value="0" selected>Webcam</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </label>

                        <label id="customFilter2">
                            <select id="mic_datatable_filter" class="form-control form-control-sm custom-cls" style="width: 70px; margin-right: 5px">
                                <option value="0" selected>Mic</option>
                                <option value="1">Enable</option>
                                <option value="2">Disable</option>
                            </select>
                        </label>

                        <label id="customFilter3">
                            <select id="screen_datatable_filter" class="form-control form-control-sm custom-cls" style="width: 95px;">
                                <option value="0" selected>Full Screen</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </label>
                        {{-- custom filter end --}}


                        <table class="table table-striped mt-5 assessment_list data-table w-100">
                            <thead>
                                <tr>
                                    <th scope="col" style="border-radius: 5px 0px 0px 5px; width: 20px;" class="text-center">SL</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Candidate Email</th>
                                    <th scope="col" class="text-center" style="min-width: 135px;">Invited On</th>
                                    <th scope="col" class="text-center" style="min-width: 40px;">Score</th>
                                    <th scope="col" class="text-center" style="min-width: 70px;">Stage</th>
                                    <th scope="col" class="text-center" style="min-width: 32px;">Trial</th>
                                    <th scope="col" class="text-center" style="border-radius: 0px 5px 5px 0px; min-width: 170px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    @if(count($assessmentEvaluators) > 0 && $assessmentOwner)
                    <div class="col-lg-12 mt-4">
                        <div class="navigation_title">
                            <h5 class="mb-2 mt-3" style="font-weight: 600; color: #1D4354">View All Invitated Evaluators :</h5>
                        </div>
                        <table class="table table-striped mt-3 mb-5 assessment_list">
                            <thead>
                                <tr>
                                    <th scope="col" style="border-radius: 5px 0px 0px 5px;" class="text-center">SL</th>
                                    <th scope="col" class="text-center">Evaluator's Name</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Invited On</th>
                                    <th scope="col" class="text-center">Account Status</th>
                                    <th scope="col" class="text-center" style="border-radius: 0px 5px 5px 0px;">Remove </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assessmentEvaluators as $index => $evaluator)
                                    <tr>
                                        <td scope="row"><b>{{ $index + $assessmentEvaluators->firstItem() }}</b></td>
                                        <td scope="row" class="text-left">{{ $evaluator->name }}</td>
                                        <td scope="row" class="text-left">{{ $evaluator->email }}</td>
                                        <td scope="row" class="text-center">
                                            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $evaluator->created_at)->format('d M, Y h:i A') }}
                                        </td>
                                        <td scope="row" class="text-center">
                                            @if ($evaluator->account_type == 2)
                                                <span class="alert alert-warning p-1 font-weight-bold" style="font-size: 13px">Evaluation Account</span>
                                            @else
                                                <span class="alert alert-success p-1 font-weight-bold" style="font-size: 13px">General Account</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('remove/evaluator') }}/{{ $evaluator->slug }}" class="btn-sm btn-danger rounded"><i class="fas fa-user-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="...">
                            <ul class="pagination mt-3 mb-4">
                                <style>
                                    .page-item.active .page-link {
                                        background: #376678;
                                        border-color: #376678;
                                    }

                                </style>
                                {{ $assessmentEvaluators->links() }}
                            </ul>
                        </nav>
                    </div>
                    @endif


                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header" style="background: #1D4354; color:ghostwhite">
                                <h6 style="font-weight: 600;">Tests of this Assesment</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    @if (count($assesmentTests) > 0)
                                        <thead>
                                            <tr>
                                                <th scope="col">Test Name</th>
                                                <th scope="col">Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assesmentTests as $assesmentTest)
                                                <tr>
                                                    <td scope="row">{{ $assesmentTest->test_name }}</td>
                                                    <td scope="row">{{ $assesmentTest->total_marks }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td scope="row" colspan="2" class="alert alert-danger"><b>No Test is
                                                        included in this Assesment</b></td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header" style="background: #1D4354; color:ghostwhite">
                                <h6 style="font-weight: 600;">Custom Questions of this Assesment</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    @if (count($assesmentQuestions) > 0)
                                        <thead>
                                            <tr>
                                                <th scope="col">Question</th>
                                                <th scope="col">Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assesmentQuestions as $assesmentQuestion)
                                                <tr>
                                                    <td scope="row">{!! $assesmentQuestion->question !!}</td>
                                                    <td scope="row">{{ $assesmentQuestion->marks }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td scope="row" colspan="2" class="alert alert-danger"><b>No Question is
                                                        included in this Assesment</b></td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card pie-chart-example mt-4">
                            <div class="card-header" style="background: #1D4354; color:ghostwhite">
                                <h6 style="font-weight: 600;">Browser Used by the Candidates*</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="chart-container">
                                    <canvas id="pieChartExample"></canvas>
                                </div>
                                <small>*Who have attended the Assessment</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card pie-chart-example mt-4">
                            <div class="card-header" style="background: #1D4354; color:ghostwhite">
                                <h6 style="font-weight: 600;">OS Used by the Candidates*</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="chart-container">
                                    <canvas id="pieChartExample2"></canvas>
                                </div>
                                <small>*Who have attended the Assessment</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- assesment content end-->


    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"><i class="far fa-envelope"></i><b>Creating Zoom Meeting</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="candidate_slug" id="candidate_slug">
                        <input type="hidden" name="assessment_slug" id="assessment_slug">
                        <div class="form-group">
                            <label for="host_email" class="col-sm-12 control-label"><b
                                    style="color: #376678; font-family: 'Roboto', sans-serif;">Host Email</b></label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="host_email" name="host_email"
                                    placeholder="Host Email" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meeting_topic" class="col-sm-12 control-label"><b
                                    style="color: #376678; font-family: 'Roboto', sans-serif;">Meeting Topic</b></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meeting_topic" name="meeting_topic"
                                    placeholder="Meeting Topic" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_time" class="col-sm-12 control-label"><b
                                    style="color: #376678; font-family: 'Roboto', sans-serif;">Start Time</b></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="start_time" name="start_time"
                                    placeholder="Start Time" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration" class="col-sm-12 control-label"><b
                                    style="color: #376678; font-family: 'Roboto', sans-serif;">Duration (In
                                    Minute)</b></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="duration" name="duration"
                                    placeholder="Duration" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <small>*Meeting Link will Send to Candidate in Email</small>
                            </div>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-sm" id="saveBtn" value="create"><i
                                    class="far fa-paper-plane"></i> Create link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading2"><i class="far fa-envelope"></i><b>Zoom Meeting
                            Details</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group pb-3">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <img src="{{ url('frontend_assets') }}/images/Zoom-logo.png" class="img-fluid w-75">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row pl-3">
                            <div class="col-lg-12 pb-2">
                                <h5 class="d-inline"
                                    style="font-family: 'Roboto', sans-serif !important; font-weight: 500; font-size: 18px;">
                                    Joining URL : </h5>
                                <a id="zoom_meeting_joining_url" target="_blank" href=""
                                    class="alert alert-success pt-0 pb-0 font-weight-bold d-inline">Click Here to Join
                                    Now</a>
                            </div>
                            <div class="col-lg-12 pb-2">
                                <h5 class="d-inline"
                                    style="font-family: 'Roboto', sans-serif !important; font-weight: 500; font-size: 18px;">
                                    Host Email : </h5><span id="zoom_meeting_host_email"
                                    style="font-family: 'Roboto', sans-serif !important; font-size: 16px;"></span>
                            </div>
                            <div class="col-lg-12 pb-2">
                                <h5 class="d-inline"
                                    style="font-family: 'Roboto', sans-serif !important; font-weight: 500; font-size: 18px;">
                                    Meeting Topic : </h5><span id="zoom_meeting_topic"
                                    style="font-family: 'Roboto', sans-serif !important; font-size: 16px;"></span>
                            </div>
                            <div class="col-lg-12 pb-2">
                                <h5 class="d-inline"
                                    style="font-family: 'Roboto', sans-serif !important; font-weight: 500; font-size: 18px;">
                                    Meeting Start Time : </h5><a id="zoom_meeting_start_time"
                                    style="font-family: 'Roboto', sans-serif !important; font-size: 16px;"></a>
                            </div>
                            <div class="col-lg-12 pb-3">
                                <h5 class="d-inline"
                                    style="font-family: 'Roboto', sans-serif !important; font-weight: 500; font-size: 18px;">
                                    Meeting Duration : </h5><a id="zoom_meeting_duration"
                                    style="font-family: 'Roboto', sans-serif !important; font-size: 16px;"></a>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-sm" id="deleteMeeting" value="create"><i
                                        class="far fa-trash-alt"></i> Delete Meeting</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading3">
                        Add Testimonials for Candidate
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="testimonialForm" name="testimonialForm" class="form-horizontal">
                        <input type="hidden" name="candidate_slug" id="candidate_slug_testimonial">
                        <div class="row">
                            <div class="col-lg-12 testimonial_left_part">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 pb-3">
                                            <span class="d-block pt-3">
                                                Add your candidate's contact details. You will be able to contact them for testimonials.
                                            </span>
                                        </div>
                                        <div class="col-lg-6 pb-3">
                                            <label>Candidate's Name <b class="text-danger">*</b></label>
                                            <input type="text" name="candidate_name" id="candidate_name" class="form-control">
                                        </div>
                                        <div class="col-lg-6 pb-3">
                                            <label>Referee's Name <b class="text-danger">*</b></label>
                                            <input type="text" name="referee_name" id="referee_name" class="form-control">
                                        </div>
                                        <div class="col-lg-6 pb-3">
                                            <label>Referee's Business Email <b class="text-danger">*</b></label>
                                            <input type="email" name="referee_email" id="referee_email" class="form-control">
                                        </div>
                                        <div class="col-lg-6 pb-3">
                                            <label>Project Type <span class="text-muted">(Optional)</span></label>
                                            <input type="text" name="project_type" id="project_type" placeholder="Ex. Marketing Brand" class="form-control">
                                        </div>
                                        <div class="col-lg-12 pb-3">
                                            <label>Message to Referee</label>
                                            <textarea name="msg_for_referee" id="msg_for_referee" class="form-control" style="font-size: 14px" rows="5">
Hi Mr. “X”,

Hope you are doing great.

We are writing to request a letter of recommendation from you regarding the time you spent working with Mr. "Y".

If you can find the time to write a recommendation and can speak about his skills and expertise, we would greatly appreciate the recommendation.

Thank you again for all your help.

Regards
TestTalents Inc.
                                            </textarea>
                                        </div>

                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-sm" id="sendTestimonialRequest" value="Request Recommendation"><i class="fas fa-paper-plane"></i> Request Recommendation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ajaxModel4" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading2"><i class="far fa-envelope"></i> <b style="font-weight: 600">Send Invitation for Evaluation in Email</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm4" name="productForm4" class="form-horizontal">
                        <input type="hidden" name="assessment_slug" id="slug_of_assessment">
                        <div class="form-group">
                            <label for="email" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Evaluator's Email :</b></label>
                            <div class="col-sm-12">
                                <select class="form-control" style="width:100%; 1px solid #ced4da" name="email[]" id="multiple_email" multiple="multiple"></select>
                                <span style="font-size: 12px;color: gray">(Press Enter After Writing an Email, You Can Also Write Multiple) </span>
                            </div>
                        </div>
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-sm" id="sendInvite"><i class="far fa-paper-plane"></i> Send Invitation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('footer_js')
    <script src="{{ url('jQueryDateTimePicker') }}/jquery.datetimepicker.full.min.js"></script>
    <script>
        $('#start_time').datetimepicker({
            format: 'Y-m-d H:i:s',
            minDate: 0,
        });

        function SameIP() {
            toastr.error("Another Candidate has given Assessment From Same IP");
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // for zoom meeting
        $('body').on('click', '.zoomMeeting', function() {
            var slug = $(this).data('id');
            $.get("{{ url('get/candidate/data') }}" + '/' + slug, function(data) {
                $('#modelHeading').html("<b>Creating Zoom Meeting</b>");
                $('#ajaxModel').modal('show');
                $('#candidate_slug').val(data.data.slug);
                $('#assessment_slug').val(data.data.assesment_slug);
            })
        });

        $('body').on('click', '.zoomMeetingDetails', function() {
            var slug = $(this).data('id');
            $.get("{{ url('get/zoom/meeting/data') }}" + '/' + slug, function(data) {
                $('#modelHeading2').html("<b>Zoom Meeting Details</b>");
                $('#ajaxModel2').modal('show');
                $('#zoom_meeting_joining_url').attr("href", data.data.zoom_join_url);
                $('#zoom_meeting_host_email').html(data.data.zoom_host_email);
                $('#zoom_meeting_topic').html(data.data.zoom_topic);
                $('#zoom_meeting_start_time').html(data.data.zoom_start_time);
                $('#zoom_meeting_duration').html(data.data.zoom_duration + " Minutes");
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();

            if ($("#host_email").val() == '') {
                toastr.error("Please Provide Host Email");
                return false;
            }
            if ($("#meeting_topic").val() == '') {
                toastr.error("Please Provide Meeting Topic");
                return false;
            }
            if ($("#start_time").val() == '') {
                toastr.error("Please Provide Start Time");
                return false;
            }
            if ($("#duration").val() == '') {
                toastr.error("Please Provide Meeting Duration");
                return false;
            }

            $(this).html('<i class="far fa-paper-plane"></i> Creating and Sending Link..');
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ url('/create/meeting/send/email') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('#saveBtn').html('<i class="far fa-paper-plane"></i> Created & Sent');
                    toastr.success("Zoom Meeting Created");
                    location.reload(true);
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('<i class="far fa-paper-plane"></i> Create link');
                }
            });
        });

        // for testimonial
        $('body').on('click', '.testimonial', function() {
            var slug = $(this).data('id');
            $.get("{{ url('get/candidate/data') }}" + '/' + slug, function(data) {
                $('#modelHeading3').html("<b>Add Testimonials for Candidate</b>");
                $('#ajaxModel3').modal('show');
                $('#candidate_slug_testimonial').val(data.data.slug);
            })
        });

        $("#candidate_name").keyup(function() {

            if(this.value != ''){
                var candiateName = this.value;
            } else {
                var candiateName = 'Mr. X';
            }

            if($("#referee_name").val() != ''){
                var refreeName = $("#referee_name").val();
            } else {
                var refreeName = 'Mr. Y';
            }

            $("#msg_for_referee").text("Hi "+refreeName+",\n\nHope you are doing great. \n\nWe are writing to request a letter of recommendation from you regarding the time you spent working with "+candiateName+". \n\nIf you can find the time to write a recommendation and can speak about his skills and expertise, we would greatly appreciate the recommendation. \n\nThank you again for all your help. \n\nRegards TestTalents Inc.")

        });

        $("#referee_name").keyup(function() {

            if(this.value != ''){
                var refreeName = this.value;
            } else {
                var refreeName = 'Mr. Y';
            }

            if($("#candidate_name").val() != ''){
                var candiateName = $("#candidate_name").val();
            } else {
                var candiateName = 'Mr. X';
            }

            $("#msg_for_referee").text("Hi "+refreeName+",\n\nHope you are doing great. \n\nWe are writing to request a letter of recommendation from you regarding the time you spent working with "+candiateName+". \n\nIf you can find the time to write a recommendation and can speak about his skills and expertise, we would greatly appreciate the recommendation. \n\nThank you again for all your help. \n\nRegards TestTalents Inc.")

        });

        $('#sendTestimonialRequest').click(function(e) {
            e.preventDefault();

            if ($("#candidate_name").val() == '') {
                toastr.error("Please Provide Candidate's Name");
                return false;
            }
            if ($("#referee_name").val() == '') {
                toastr.error("Please Provide Referee's Name");
                return false;
            }
            if ($("#referee_email").val() == '') {
                toastr.error("Please Provide Referee's Email");
                return false;
            }

            $(this).html('<i class="far fa-paper-plane"></i> Sending Request...');
            $.ajax({
                data: $('#testimonialForm').serialize(),
                url: "{{ url('/send/email/requesting/testimonial') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#testimonialForm').trigger("reset");
                    $('#ajaxModel3').modal('hide');
                    $('#sendTestimonialRequest').html('<i class="far fa-paper-plane"></i> Request Recommendation');
                    toastr.success("Request Sent Successfully");
                    // location.reload(true);
                },
                error: function(data) {
                    console.log('Error:', data);
                    toastr.warning("Something Went Wrong");
                    $('#sendTestimonialRequest').html('<i class="far fa-paper-plane"></i> Request Recommendation');
                }
            });
        });


        $('body').on('click', '.invite_evaluation', function () {
            var slug = $(this).data('id');
            $('#slug_of_assessment').val(slug);
            $("#productForm4")[0].reset();
            $('#ajaxModel4').modal('show');
        });

        $('#sendInvite').click(function (e) {
            e.preventDefault();

            if($("#multiple_email").val() == null){
                toastr.error("Please Write an Email Address");
                return false;
            }

            $(this).html('Sending...');
            $("#sendInvite").attr("disabled", true);

            $.ajax({
                data: $('#productForm4').serialize(),
                url: "{{ url('/evaluator/invitation/send') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $("#sendInvite").attr('disabled', false);
                    $("#sendInvite").html("<i class='far fa-paper-plane'></i> Send Invitation");
                    $('#productForm4').trigger("reset");
                    $('#ajaxModel4').modal('hide');
                    $("#multiple_email").val('').trigger('change')
                    toastr.success("Invitation Sent Successfully")
                    location.reload(true);

                },
                error: function (data) {
                    $("#sendInvite").attr('disabled', false);
                    console.log('Error:', data);
                    $('#sendInvite').html('Try Again');
                }
            });
        });
    </script>


    <script src="{{ url('/') }}/backend_assets/vendor/chart.js/Chart.min.js"></script>

    <script>
        $(document).ready(function() {

            var brandPrimary = 'rgba(51, 179, 90, 1)';

            var LINECHARTEXMPLE = $('#lineChartExample'),
                PIECHARTEXMPLE = $('#pieChartExample'),
                PIECHARTEXMPLE2 = $('#pieChartExample2'),
                BARCHARTEXMPLE = $('#barChartExample'),
                RADARCHARTEXMPLE = $('#radarChartExample'),
                POLARCHARTEXMPLE = $('#polarChartExample');

            var pieChartExample = new Chart(PIECHARTEXMPLE, {
                type: 'doughnut',
                data: {
                    labels: [
                        "Chrome",
                        "Fiefox",
                        "Safari",
                        "Others"
                    ],
                    datasets: [{
                        data: [<?php echo $chrome_users; ?>, <?php echo $firefox_users; ?>, <?php echo $safari_users; ?>, <?php echo $others_users; ?>],
                        borderWidth: [2, 2, 2, 2],
                        backgroundColor: [
                            brandPrimary,
                            "rgba(75,192,192,1)",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            brandPrimary,
                            "rgba(75,192,192,1)",
                            "#FFCE56"
                        ]
                    }]
                }
            });

            var pieChartExample2 = new Chart(PIECHARTEXMPLE2, {
                type: 'doughnut',
                data: {
                    labels: [
                        "Windows",
                        "MAC",
                        "Others"
                    ],
                    datasets: [{
                        data: [<?php echo $windows_users; ?>, <?php echo $mac_users; ?>, <?php echo $other_os_users; ?>],
                        borderWidth: [1, 1, 1],
                        backgroundColor: [
                            brandPrimary,
                            "rgba(75,192,192,1)",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            brandPrimary,
                            "rgba(75,192,192,1)",
                            "#FFCE56"
                        ]
                    }]
                }
            });

            var pieChartExample = {
                responsive: true
            };

            var pieChartExample2 = {
                responsive: true
            };

        });
    </script>

    <script src="{{url('select2Tagging')}}/select2.min.js"></script>
    <script>
        $("#multiple_email").select2({
            tags: true,
            tokenSeparators: [',', ' '],
        })
    </script>



    <script src="{{ url('dataTable') }}/js/jquery.validate.js"></script>
    <script src="{{ url('dataTable') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('dataTable') }}/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">

        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('see/candidates') }}/<?= $assesment_info->slug ?>",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'}, //orderable: true, searchable: true
                {data: 'email', name: 'email'},
                {data: 'invited_on', name: 'invited_on'},
                {data: 'average_score', name: 'average_score'},
                {data: 'stage', name: 'stage'},
                {data: 'number_of_trial', name: 'number_of_trial'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#customFilter').on('change', function(){
            var webcam_filter_value = $("#webcam_datatable_filter").val();
            var mic_filter_value = $("#mic_datatable_filter").val();
            var screen_filter_value = $("#screen_datatable_filter").val();

            var liveurl = "{{ url('see/candidates') }}/<?= $assesment_info->slug ?>/"+webcam_filter_value + '/' + mic_filter_value + '/' + screen_filter_value;
            table.ajax.url(liveurl).load();
        });

        $('#customFilter2').on('change', function(){
            var webcam_filter_value = $("#webcam_datatable_filter").val();
            var mic_filter_value = $("#mic_datatable_filter").val();
            var screen_filter_value = $("#screen_datatable_filter").val();

            var liveurl = "{{ url('see/candidates') }}/<?= $assesment_info->slug ?>/"+webcam_filter_value + '/' + mic_filter_value + '/' + screen_filter_value;
            table.ajax.url(liveurl).load();
        });

        $('#customFilter3').on('change', function(){
            var webcam_filter_value = $("#webcam_datatable_filter").val();
            var mic_filter_value = $("#mic_datatable_filter").val();
            var screen_filter_value = $("#screen_datatable_filter").val();

            var liveurl = "{{ url('see/candidates') }}/<?= $assesment_info->slug ?>/"+webcam_filter_value + '/' + mic_filter_value + '/' + screen_filter_value;
            table.ajax.url(liveurl).load();
        });

        $(".dataTables_filter").append($("#customFilter"));
        $(".dataTables_filter").append($("#customFilter2"));
        $(".dataTables_filter").append($("#customFilter3"));
    </script>


    <script src="{{ url('frontend_assets') }}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}


@endsection
