@extends('backend.master')

@section("header_css")
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
<link href="{{url('select2Tagging')}}/select2.min.css" rel="stylesheet" />
{{--  style for select2 tagging  --}}
<style>
    span.select2-selection {
        border-radius: 5px !important;
    }

    span.select2-dropdown--below {
        display: none !important;
    }
</style>
@endsection

@section('content')

<!-- backend navigation start-->
<section>
    <div class="backend_navigation">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    @php
                        $prevUrl = url()->previous();
                        $urlArray = explode("/", $prevUrl);
                    @endphp
                    @if ($urlArray[3] == 'email' && $urlArray[4] == 'verify')
                        <span class="alert alert-success d-block">Congratulations ! Your Email Verification is Successfully Completed.</span>
                    @endif
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-6">
                    <div class="card bar-chart-example">
                        <div class="card-header" style="background: #1D4354; color:ghostwhite">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="font-weight: 600;">Assessments & Candidates Summary</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="barChartExample"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card line-chart-example">
                        <div class="card-header" style="background: #1D4354; color:ghostwhite">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="font-weight: 600;">Recharge History</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChartExample"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="navigation_title">
                        <h3>My Assessments</h3>
                    </div>
                </div>
                <div class="col-lg-8 text-right">
                    <div class="navigation_item pt-1">
                        <ul>
                            @if(Auth::user()->type == 1)
                            <li class="active">
                                <a href="{{url('add/question/page')}}"><i class="fas fa-plus-circle"></i> Add New Question</a>
                            </li>
                            @endif
                            {{-- <li class="active">
                                <a href="{{url('add/test/page')}}"><i class="fas fa-plus-circle"></i> Create New Test</a>
                            </li> --}}
                            <li class="active">
                                <a href="{{url('create/assesment/firststep')}}"><i class="fas fa-plus-circle"></i> Create New Assesment</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- backend navigation end-->

<!-- assesment content start-->
<section>
    <div class="assesment_content mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Candidates</th>
                                <th scope="col" class="text-center">Progress</th>
                                <th scope="col" class="text-center">Last Activity</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($assesments) > 0)
                            @foreach ($assesments as $index => $assesment)
                            <tr>
                                <th scope="row">{{ $index+$assesments->firstItem() }}</th>
                                <th scope="row">
                                    {{$assesment->title}}

                                    @if($assesment->status == 2)
                                        <small class="btn btn-sm rounded text-white" style="background-color: #1D4354; padding: 0px 5px; font-weight: 600; font-size: 12px;">Invited</small>
                                    @endif
                                </th>
                                <td class="text-center">
                                    {{App\Candidate::where('assesment_slug',$assesment->slug)->count()}}</td>
                                <td style="vertical-align: middle" class="text-center">
                                    @php
                                    $totalCandidate = App\Candidate::where('assesment_slug',$assesment->slug)->count();
                                    $totalEvaluatedCandidate =
                                    App\Candidate::where('assesment_slug',$assesment->slug)->where('stage',1)->count();
                                    $progress = 0;
                                    if($totalCandidate > 0){
                                    $progress = ceil(($totalEvaluatedCandidate*100)/$totalCandidate);
                                    }
                                    @endphp
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                            aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100"
                                            style="width:{{$progress}}%"></div>
                                    </div>
                                    <span style="font-size: 12px">{{$progress}}% Evaluated</span>
                                </td>
                                <td class="text-center">
                                    @php
                                    if($assesment->updated_at != null){
                                        echo Carbon\Carbon::parse($assesment->updated_at)->diffForHumans();
                                    }
                                    @endphp
                                </td>
                                <td class="text-center">
                                    <a href="{{url('see/candidates')}}/{{$assesment->slug}}" class="d-inline-block mb-1 btn-sm btn-success rounded">
                                        <i class="fas fa-users"></i>
                                        {{-- <b>View</b> --}}
                                    </a>

                                    @if($assesment->status != 2)
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$assesment->slug}}" data-original-title="Edit" class="d-inline-block mb-1 btn-sm btn-primary rounded text-white editQuestion">
                                        <i class="far fa-envelope"></i>
                                        {{-- <b>Send Link</b> --}}
                                    </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$assesment->slug}}" class="d-inline-block mb-1 btn-sm btn-secondary rounded generateLink">
                                        <i class="far fa-copy"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$assesment->slug}}" class="d-inline-block mb-1 btn-sm btn-danger rounded deleteAssessment">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th colspan="6" class="text-center">No Assessment Available !</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <nav aria-label="...">
                        <ul class="pagination mt-5">
                            <style>
                                .page-item.active .page-link {
                                    background: #376678;
                                    border-color: #376678;
                                }
                            </style>
                            {{ $assesments->links() }}
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- assesment content end-->

<style>
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
</style>


<div class="modal fade" id="ajaxModel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading2"><i class="far fa-envelope"></i> <b>Send Assessment Link in Email</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="link" id="link">
                    {{--  <div class="form-group">
                        <label for="name" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Full Name</b></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" value="" required="">
                        </div>
                    </div>  --}}
                    <div class="form-group">
                        <label for="email" class="col-sm-12 control-label"><b
                                style="color: #376678; font-family: 'Roboto', sans-serif;">Candidate's Email
                                :</b></label>
                        <div class="col-sm-12">
                            {{--  <input type="email" class="form-control" id="email" name="email" value="" required="" placeholder="You can write multiple email here">  --}}
                            <select class="form-control" style="width:100%; 1px solid #ced4da" name="email[]"
                                id="multiple_email" multiple="multiple"></select>
                            <span style="font-size: 12px;color: gray">(Press Enter After Writing an Email, You Can Also
                                Write Multiple) </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-12 control-label"><b
                                style="color: #376678; font-family: 'Roboto', sans-serif;">Custom Message
                                (Optional) :</b></label>
                        <div class="col-sm-12">
                            <textarea name="message" class="col-sm-12 form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-sm" id="saveBtn" value="create"><i class="far fa-paper-plane"></i> Send Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ajaxModel3" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading3"><i class="fas fa-paperclip"></i> <b>Create Assessment Link
                        for User</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm3" name="productForm3" class="form-horizontal">
                    <input type="hidden" name="link" id="link3">
                    <div class="form-group">
                        <label for="name3" class="col-sm-12 control-label"><b
                                style="color: #376678; font-family: 'Roboto', sans-serif;">Full Name</b></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name3" name="name" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email3" class="col-sm-12 control-label"><b
                                style="color: #376678; font-family: 'Roboto', sans-serif;">Email</b></label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email3" name="email" value="" required="">
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-sm" id="saveBtn3" value="create"><i
                                class="far fa-clone"></i> Create Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_js')

<script src="{{url('/')}}/backend_assets/vendor/chart.js/Chart.min.js"></script>

<script>
    $(document).ready(function () {

        var brandPrimary = 'rgb(227, 180, 72, 1)';
        var brandSecondary = 'rgb(58, 107, 53, 1)';

        var LINECHARTEXMPLE   = $('#lineChartExample'),
        PIECHARTEXMPLE    = $('#pieChartExample'),
        BARCHARTEXMPLE    = $('#barChartExample'),
        RADARCHARTEXMPLE  = $('#radarChartExample'),
        POLARCHARTEXMPLE  = $('#polarChartExample');

        var jDateArray = <?php echo json_encode($dataRange); ?>;


        var jRechargeHistoryArray = <?php echo json_encode($rechargeHistory); ?>;
        var lineChartExample = new Chart(LINECHARTEXMPLE, {
            type: 'line',
            data: {
                labels: jDateArray,
                datasets: [
                    {
                        label: "Amount Paid",
                        fill: true,
                        lineTension: 0.3,
                        backgroundColor: "rgb(227, 180, 72, .4)",
                        borderColor: brandPrimary,
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        borderWidth: 1,
                        pointBorderColor: brandPrimary,
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: brandPrimary,
                        pointHoverBorderColor: "brandPrimary",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: jRechargeHistoryArray,
                        spanGaps: false
                    },
                    // {
                    //     label: "Candidate Invitations",
                    //     fill: true,
                    //     lineTension: 0.3,
                    //     backgroundColor: "rgb(58, 107, 53, .4)",
                    //     borderColor: brandSecondary,
                    //     borderCapStyle: 'butt',
                    //     borderDash: [],
                    //     borderDashOffset: 0.0,
                    //     borderJoinStyle: 'miter',
                    //     borderWidth: 1,
                    //     pointBorderColor: brandSecondary,
                    //     pointBackgroundColor: "#fff",
                    //     pointBorderWidth: 1,
                    //     pointHoverRadius: 5,
                    //     pointHoverBackgroundColor: brandSecondary,
                    //     pointHoverBorderColor: brandSecondary,
                    //     pointHoverBorderWidth: 2,
                    //     pointRadius: 1,
                    //     pointHitRadius: 10,
                    //     data: [{{12}}, {{31}}, {{21}}, {{12}}, {{14}}, {{21}}, {{32}}, {{22}}],
                    //     spanGaps: false
                    // }
                ]
            }
        });


        var jsAssessmentsArray = <?php echo json_encode($no_of_invitations); ?>;
        var attended_test = <?php echo json_encode($attended_test); ?>;
        var qualified = <?php echo json_encode($qualified); ?>;
        var barChartExample = new Chart(BARCHARTEXMPLE, {
            type: 'bar',
            data: {
                labels: jDateArray,
                datasets: [
                    {
                        label: "Send Invites",
                        backgroundColor: [
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                        ],
                        borderColor: [
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                            'rgba(29, 67, 84, 0.6)',
                        ],
                        borderWidth: 1,
                        data: jsAssessmentsArray,
                    },
                    {
                        label: "Attended Test",
                        backgroundColor: [
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                        ],
                        borderColor: [
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                            'rgba(0, 105, 217, 0.6)',
                        ],
                        borderWidth: 1,
                        data: attended_test,
                    },
                    {
                        label: "Qualified",
                        backgroundColor: [
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                            'rgb(0, 148, 50, 0.6)',
                        ],
                        borderColor: [
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                            'rgb(0, 148, 50, 0.8)',
                        ],
                        borderWidth: 1,
                        data: qualified,
                    }
                ]
            }
        });

    });
</script>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.editQuestion', function () {
            var slug = $(this).data('id');
            $('#saveBtn').val("edit-user");
            $('#ajaxModel2').modal('show');
            $('#link').val(slug);
            $("#productForm")[0].reset();
            $("#saveBtn").html("<i class='far fa-paper-plane'></i> Send Link");
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            if($("#multiple_email").val() == null){
                toastr.error("Please Write an Email Address");
                return false;
            }

            $(this).html('Sending...');
            $("#saveBtn").attr("disabled", true);

            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ url('/send/link/via/email') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $("#saveBtn").attr('disabled', false);
                    $('#productForm').trigger("reset");
                    $('#ajaxModel2').modal('hide');
                    $("#multiple_email").val('').trigger('change')
                    if(data.data == 1){
                        toastr.success("Assesment Link Sent Successfully")
                    }
                    else{
                        toastr.error("Don't have enough balance")
                    }

                },
                error: function (data) {
                    $("#saveBtn").attr('disabled', false);
                    console.log('Error:', data);
                    $('#saveBtn').html('Try Again');
                }
            });
        });

        $('body').on('click', '.generateLink', function () {
            var slug = $(this).data('id');
            $('#saveBtn3').val("edit-user");
            $('#ajaxModel3').modal('show');
            $('#link3').val(slug);
            $("#productForm3")[0].reset();
            $("#saveBtn3").html("<i class='far fa-clone'></i> Create Link");
        });

        $('#saveBtn3').click(function (e) {
            e.preventDefault();
            $(this).html('Creating...');
            $.ajax({
                data: $('#productForm3').serialize(),
                url: "{{ url('/create/assesment/link') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#productForm3').trigger("reset");
                    $('#ajaxModel3').modal('hide');
                    toastr.success("Copied to the Clipboard");

                    var copyText = data.link;
                    document.addEventListener('copy', function(e) {
                        e.clipboardData.setData('text/plain', copyText);
                        e.preventDefault();
                    }, true);
                    document.execCommand('copy');

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Error Occured');
                }
            });
        });

        // Start Delete Data
        $('body').on('click', '.deleteAssessment', function() {
            var data_id = $(this).data("id");
            if (confirm("Do You really want to delete !")) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('softDelete/assessment') }}" + '/' + data_id,
                    success: function(data) {
                        toastr.error("Deleted Successfully");
                        location.reload(true);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
        // End Delete Data
    });

</script>

<script src="{{url('select2Tagging')}}/select2.min.js"></script>
<script>
    $("#multiple_email").select2({
        tags: true,
        tokenSeparators: [',', ' '],
    })
</script>

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
