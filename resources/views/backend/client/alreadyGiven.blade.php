@extends('backend.client.master')

@section('header_css')
    <style>
        .container-fluid{
            width: 90%
        }
    </style>
@endsection

@section('content')
    <!-- question content start-->
    <section class="mt-5">
        <div class="single_assesment_content mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="assesment_details bg-white" style="margin-top: 100px">
                            <div class="row">
                                <div class="col-lg-12 pt-5 text-center">

                                    <h3><b>You have already Given the Assesment / This Assesment has been Deactivated / Your maximum trial limit exceed</b></h3>
                                    <br>
                                    <h3>You can close this window now.</h3>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- question content end-->
@endsection


@section('footer_js')
    <script>
        $(document).ready(function() {
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };
            document.addEventListener('contextmenu', event => event.preventDefault());
        });
    </script>
@endsection
