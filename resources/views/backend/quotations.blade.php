@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">

    {{-- for data table css --}}
    <link href="{{ url('dataTable') }}/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ url('dataTable') }}/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0px;
            border-radius: 4px;
        }
        table.dataTable tbody td:nth-child(1){
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(4){
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(5){
            text-align: center !important;
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
        table.dataTable tbody td:nth-child(9){
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(10){
            text-align: center !important;
        }
    </style>
    {{-- for data table css --}}

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

@endsection

@section('content')

<!-- backend navigation start-->
<section>
    <div class="backend_navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navigation_title">
                        <h3 class="mt-3">View All Quotations :</h3>
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

                <div class="col-lg-12 pt-4 table-responsive" style="background-color: #F7F1E3">

                    <table class="table table-striped mt-5 data-table w-100">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">SL</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">User Info</th>
                                <th scope="col" class="text-center">Attachment</th>
                                <th scope="col" class="text-center">Transaction ID</th>
                                <th scope="col" class="text-center">Payment & Limit</th>
                                <th scope="col" class="text-center">Approved</th>
                                <th scope="col" class="text-center">Expire Date</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                <h5 class="modal-title" id="modelHeading" style="font-weight: 600">Quotation Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="quotation_slug" id="quotation_slug">

                    <div class="form-group">
                        <label for="approved_limit" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Approved Limit :</b></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="approved_limit" name="approved_limit" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="approved_limit" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Expire Date :</b></label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="expire_date" name="expire_date" value="" required>
                        </div>
                    </div>

                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-sm" id="saveBtn" value="create"><i class="fas fa-check"></i> Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('footer_js')

    <script src="{{ url('dataTable') }}/js/jquery.validate.js"></script>
    <script src="{{ url('dataTable') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('dataTable') }}/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">

        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('view/custom/quotations') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'created_at', name: 'created_at'},
                {data: 'name', name: 'name'},
                {data: 'attachment', name: 'attachment'},
                {data: 'tran_id', name: 'tran_id'},
                {data: 'paid_amount', name: 'paid_amount'},
                {data: 'invitation_given', name: 'invitation_given'},
                {data: 'validity_given', name: 'validity_given'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    </script>


<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.approveQuotation', function () {
            var slug = $(this).data('id');
            $.get("{{ url('get/quotation/info') }}" +'/' + slug, function (data) {
                $('#ajaxModel').modal('show');
                $('#quotation_slug').val(slug);
            })
        });


        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Approving...');
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ url('update/quotation') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#saveBtn').html('<i class="fas fa-check"></i> Approve');
                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    toastr.success("Quotation Approved", "Updated Successfully");
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    toastr.warning("Something Went Wrong", "Failed to Update");
                    $('#saveBtn').html('Try Again');
                }
            });
        });

    });

</script>

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
