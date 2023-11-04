@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/career.css">

<style>
    .career_banner {
        background-image: url('{{url('frontend_assets')}}/images/career2.jpg');
    }
</style>
@endsection

@section('content')

<section>
    <div class="career_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="career_banner_text">
                        <h2>Join Our Team</h2>
                        <b>Work to become, not to acquire.</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="career_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Position</th>
                                <th scope="col">Location</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="5" class="text-center">Sorry ! No vacancy available</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>



<!--Top Button Start-->
<div class="top_btn wow bounceInRight">
    <i class="fas fa-arrow-up"></i>
</div>
<!--Top button End-->

@endsection
