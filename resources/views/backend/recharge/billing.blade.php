@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">

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

        ul.pricing_package li{
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 18px;
            font-size: 16px;
        }

        .pricing_package_features a{
            padding: 5px 10px;
            background: #1D4354;
            border-radius: 4px;
            color: white !important;
            font-size: 13px;
            font-weight: 600;
        }
    </style>

@endsection

@section('content')
<!-- backend navigation start-->
<section>
    <div class="backend_navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="navigation_title">
                        <h3>Plan & Billing :</h3>
                    </div>
                </div>
                <div class="col-lg-8 text-right">
                    <a href="javascript:void(0)" style="background: #37A000; font-weight: 600; text-shadow: 1px 1px 2px black;" data-toggle="tooltip" data-original-title="Quotation" class="btn d-inline-block rounded text-white quotationBtn">
                        Get a Quotation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- backend navigation end-->

<!-- assesment content start-->
<section>
    <div class="assesment_content mb-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-3 pb-3" style="background-color: #F7F1E3">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            Lorem, ipsum dolor.
                        </div>
                        <div class="col-lg-3 text-center">
                            <h4 class="mt-5 mb-4" style="font-weight: 600; color: #1e1e1e;">Current Limit</h4>
                            <h2 class="mb-3" style="height: 100px; width: 100px; margin: auto; border: 3px dashed #1D4354; line-height: 90px; color: #1e1e1e;
                            border-radius: 50%; font-weight: 600;">{{Auth::user()->current_limit}}</h2>
                            <span class="mb-3" style="font-weight: 600; color: #1e1e1e;">You Can Send <span style="color: #1D4354; font-weight: 700">{{Auth::user()->current_limit}}</span> Invitations</span>
                            <span class="mb-3" style="font-weight: 600; color: #1e1e1e;">
                                Expired On : @if(Auth::user()->expire_date != '' || Auth::user()->expire_date != null) {{Carbon\Carbon::createFromFormat('Y-m-d', Auth::user()->expire_date)->format('jS F, Y')}} @endif
                            </span>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">

                                <div class="col-lg-4 text-center">
                                    <div class="card">
                                        <div class="card-body text-center pt-4 pb-4" style="background:white">
                                            <i class="fas fa-hourglass-start" style="font-size: 25px; color: #1D4354;"></i>
                                            <h5 class="card_head mt-1 mb-2"><b>Basic</b></h5>
                                            <h3 class="plan mb-3" style="font-size: 20px"><b>0 USD /Month</b></h3>
                                            <a href="javascript:void(0)" style="background: #37A000;color:white; padding: 3px 10px;border-radius:4px">Current Package</a>
                                            <hr>
                                            <div class="price_content">
                                                <div class="row">
                                                    <div class="col-lg-12 text-left">
                                                        <ul style="list-style: disc; padding-left: 20px" class="pricing_package">
                                                            <li>5 Assessment Invitations Per Month</li>
                                                            <li>$1 for an extra Invitation</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-12 text-center pt-3 pricing_package_features">
                                                        <a href="{{url('/pricing')}}" >View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-center">
                                    <div class="card">
                                        <div class="card-body text-center pt-4 pb-4" style="background:white">
                                            <i class="fas fa-money-bill-alt" style="font-size: 25px;color: #1D4354;"></i>

                                            <h5 class="card_head mt-1 mb-2"><b>Premium </b></h5>
                                            <h3 class="plan mb-3" style="font-size: 20px"><b>100 USD /Year</b></h3>
                                            <a href="{{url('/checkout/pricing/pakckage')}}/{{'premium'}}" style="background: #1D4354;color:white; padding: 3px 10px;border-radius:4px">Buy Now</a>
                                            <hr>
                                            <div class="price_content">
                                                <div class="row">
                                                    <div class="col-lg-12 text-left">
                                                        <ul style="list-style: disc; padding-left: 20px" class="pricing_package">
                                                            <li>100 Assessment Invitations Per Year</li>
                                                            <li>$1 for an extra Invitation</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-12 text-center pt-3 pricing_package_features">
                                                        <a href="{{url('/pricing')}}" >View More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-center">
                                    <div class="card">
                                        <div class="card-body text-center pt-4 pb-4" style="background:white">
                                            <i class="fas fa-coins" style="font-size: 25px;color: #1D4354;"></i>
                                            <h5 class="card_head mt-1 mb-2"><b>Business</b></h5>
                                            <h3 class="plan mb-3" style="font-size: 20px"><b>450 USD /Year</b></h3>
                                            <a href="{{url('/checkout/pricing/pakckage')}}/{{'business'}}" style="background: #1D4354;color:white; padding: 3px 10px;border-radius:4px">Buy Now</a>
                                            <hr>
                                            <div class="price_content">
                                                <div class="row">
                                                    <div class="col-lg-12 text-left">
                                                        <ul style="list-style: disc; padding-left: 20px" class="pricing_package">
                                                            <li>500 Assessment Invitations Per Year</li>
                                                            <li>$1 for an extra Invitation</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-12 text-center pt-3 pricing_package_features">
                                                        <a href="{{url('/pricing')}}" >View More</a>
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
    </div>
</section>
<!-- assesment content end-->


<!-- backend navigation start-->
<section>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="navigation_title">
                        <h3>Recharge History :</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- backend navigation end-->


<!-- assesment content start-->
<section>
    <div class="assesment_content mb-5 mt-3">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 pt-4" style="background-color: #F7F1E3">

                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">SL</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Amount</th>
                                <th scope="col" class="text-center">Limit</th>
                                <th scope="col" class="text-center">Payment Process</th>
                                <th scope="col" class="text-center">Payment Type</th>
                                <th scope="col" class="text-center">Transaction ID</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($histories) > 0)
                            @foreach ($histories as $index => $history)
                            <tr>
                                <th scope="row" class="text-center">{{ $index+$histories->firstItem() }}</th>
                                <td class="text-center">{{Carbon\Carbon::createFromFormat('Y-m-d', $history->recharge_date)->format('jS F, Y')}}</td>
                                <td class="text-center" style="color: #1D4354; font-weight: 600;">
                                    {{ number_format($history->recharge_amount, 2)}}
                                    @php
                                        $paymentInfo = App\PaymentInfo::where('id', $history->payment_id)->first();
                                        echo $paymentInfo ? $paymentInfo->currency : ''
                                    @endphp
                                </td>
                                <td class="text-center" style="color: #1D4354; font-weight: 600;">
                                    {{$history->invitation_limit}}
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control pt-0 pb-0 text-center" value="{{$history->agent_no}}"
                                        style="background-color: #CBD7CB;">
                                </td>
                                <td class="text-center">
                                    {{$history->user_no}}
                                </td>
                                <td class="text-center">
                                    {{$history->transaction_id}}
                                </td>
                                <td class="text-center">
                                    @if($history->status == 1)
                                    <a href="javascript:void(0)" class="d-inline-block mb-1 btn-sm btn-success rounded"><i class="fas fa-check"></i> <b>Approved</b></a>
                                    @elseif($history->status == 0)
                                    <a href="javascript:void(0)" class="d-inline-block mb-1 btn-sm btn-primary rounded text-white"><i class="fas fa-history"></i> <b>Pending</b></a>
                                    @else
                                    <a href="javascript:void(0)" class="d-inline-block mb-1 btn-sm btn-danger rounded"><i class="fas fa-times"></i> <b>Denied</b></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th colspan="8" class="text-center">No Payment has been done yet</th>
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
                            {{ $histories->links() }}
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- assesment content end-->


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading" style="font-weight: 600;">Get a Custom Quotation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Name :</b></label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" value="{{Auth::user()->name}}" id="name" class="form-control" placeholder="Full Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="company_name" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Company Name :</b></label>
                                <div class="col-sm-12">
                                    <input type="text" name="company_name" value="{{Auth::user()->company_name}}" id="company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Name :</b></label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" value="{{Auth::user()->email}}" id="email" class="form-control" placeholder="example@emil.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contact" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Contact :</b></label>
                                <div class="col-sm-12">
                                    <input type="text" name="contact" value="{{Auth::user()->contact}}" id="contact" class="form-control" placeholder="***********">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="attachment" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Attachment (Optional) :</b></label>
                                <div class="col-sm-12">
                                    <input type="file" name="attachment" id="attachment" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="paid_amount" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Paid Amount/Want to Pay (in USD) :</b></label>
                                <div class="col-sm-12">
                                    <input type="number" step=".01" name="paid_amount" value="0" id="paid_amount" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tran_id" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Transactional ID (Optional) :</b></label>
                                <div class="col-sm-12">
                                    <input type="text" name="tran_id" id="tran_id" class="form-control" placeholder="UYT876876UYUYT">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="invitation_wanted" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Invitation Limit You Want :</b></label>
                                <div class="col-sm-12">
                                    <input type="number" step=".01" name="invitation_wanted" value="0" id="invitation_wanted" class="form-control" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-sm" id="saveBtn" value="create"><i class="far fa-paper-plane"></i> Send Quotation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_js')


<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click', '.quotationBtn', function () {
            $('#ajaxModel').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending...');

            var formData = new FormData();
            var name = $("#name").val();
            var company_name = $("#company_name").val();
            var email = $("#email").val();
            var contact = $("#contact").val();
            var paid_amount = $("#paid_amount").val();
            var tran_id = $("#tran_id").val();
            var invitation_wanted = $("#invitation_wanted").val();

            formData.append("name", name);
            formData.append("company_name", company_name);
            formData.append("email", email);
            formData.append("contact", contact);
            formData.append("paid_amount", paid_amount);
            formData.append("tran_id", tran_id);
            formData.append("invitation_wanted", invitation_wanted);
            formData.append('attachment', $("#attachment")[0].files[0]);

            $.ajax({
                data: formData,
                url: "{{ url('submit/quotation') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#ajaxModel').modal('hide');
                    $('#saveBtn').html('Send Quotation');
                    $('#productForm').trigger("reset");
                    toastr.success("Quotation Send", "Send Successfully");
                    location.reload(true);
                },
                error: function (data) {
                    console.log('Error:', data);
                    toastr.error("Something Went Wrong", "Error Occured");
                    $('#saveBtn').html('Try Again');
                }
            });

        });

    });

</script>

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
