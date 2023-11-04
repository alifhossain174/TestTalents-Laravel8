@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/career.css">

<style>
    .career_banner {
        background-image: url('{{url('frontend_assets')}}/images/career2.jpg');
    }
    .candidate_profile h5{
        color: #1D4354;
        font-family: Helvetica, sans-serif;
        font-size: 16px;
        font-weight: 600;
        margin-top: 10px;
    }
    .candidate_profile span{
        color: #008332;
        font-family: Helvetica, sans-serif;
        font-size: 15px;
        font-weight: 500;
    }

    .candidate_testimonial{
        padding-top: 20px;
    }

    .candidate_testimonial p{
        color: #1D4354;
        font-family: Helvetica, sans-serif;
        font-size: 17px;
        font-weight: 500;
        margin-bottom: 5px
    }

    .candidate_testimonial p span{
        font-size: 14px;
        color: gray;
    }

    .submit_button{
        display: inline-block;
        margin-top: 20px;
        background: #226679;
        color: white !important;
        padding: 5px 20px;
        border-radius: 4px;
        font-family: Helvetica, sans-serif;
        font-size: 15px;
        font-weight: 600;
        text-shadow: 5px 5px 5px rgb(58, 58, 58);
        transition: all .2s linear;
        cursor: pointer;
        border: none;
    }

    .submit_button:hover{
        text-shadow: none;
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
                        <h2>Submit A Testimonial</h2>
                        <b>help your client by writing about the envolvements</b>
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
                    <div class="card" style="box-shadow: 10px 10px 15px rgb(208, 208, 208)">
                        <div class="card-body">
                            <div class="candidate_profile">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <img src="{{url('frontend_assets/images/t1.png')}}" alt="Testimonial" class="img-fluid">
                                    </div>
                                    <div class="col-lg-11">
                                        <h5>{{$candidateInfo->email}}</h5>
                                        <span>Candidate at TestTalents</span>
                                    </div>
                                </div>
                            </div>
                            <div class="candidate_testimonial">
                                <?php
                                    if($testimonialInfo->status == 0){
                                ?>


                                <p>Enter your testimonial <span>(Tip: Showcase their expertise, project results or soft skills)</span></p>
                                <form action="{{url('submit/testimonial')}}" method="POST" class="text-right">
                                    @csrf
                                    <input type="hidden" id="slug1" name="slug1" value="{{$testimonialInfo->slug}}">
                                    <input type="hidden" id="slug2" name="slug2" value="{{$candidateInfo->slug}}">
                                    <textarea rows="5" class="form-control" name="testimonial" id="testimonial" placeholder="EXAMPLE: I hired him/her to help with our company's rebranding effort. They were reliable, flexible, and very responsive. Highly recommend!"></textarea>
                                    <button type="submit" class="submit_button" id="submit"><i class="fas fa-paper-plane"></i> Submit Testimonial</button>
                                </form>

                                <?php
                                    }else{
                                ?>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="alert alert-success text-center font-weight-bold">Testimonial has been submited.</p>
                                    </div>
                                </div>

                                <?php
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
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
