@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
    <link href="{{ url('select2Autocomplete') }}/select2.min.css" rel="stylesheet" />
    <style>
        span.select2-container {
            width: 100% !important;
        }
        .select2-container .select2-selection--single{
            height: 36px;
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
                            <h3>Checkout</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- backend navigation end-->


    <!-- assesment content start-->
    <section>
        <div class="container">
            <form action="{{ url('/payment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="amount" value="{{$packageInfo->price+(($packageInfo->price*15)/100)}}">
                <input type="hidden" name="limit" value="{{$packageInfo->limit}}">
                <input type="hidden" name="currency" value="USD">
                <div class="row mb-5">
                    <div class="col-lg-8">
                        <div class="card mt-3">
                            <div class="card-header" style="background: #1D4354; color: white;">
                                <h5 style="font-weight: 600; font-size: 16px;">Provide Billing Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Write Your Full Name Here" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Write Your Email Here" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Present Address</label>
                                            <textarea name="present_address" class="form-control" placeholder="Write Your Present Address Here" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Permenant Address</label>
                                            <textarea name="permenant_address" class="form-control" placeholder="Write Your Permenant Address Here" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="contact" class="form-control" placeholder="+8801" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" placeholder="Write Your City Name Here" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control" placeholder="Write Your State Name Here" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Post Code</label>
                                            <input type="text" name="post_code" class="form-control" placeholder="Write Your Post Code Name Here" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country" id="country_select2" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pt-3">
                                        <div class="form-group pt-3">
                                            <label for="terms" style="cursor: pointer">
                                            <input id="terms" type="checkbox" required> I Agree with All the Terms & Policies.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mt-3">
                            <div class="card-header" style="background: #1D4354; color: white;">
                                <h5 style="font-weight: 600; font-size: 16px;">Billing Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="row pb-1">
                                    <div class="col">
                                        <p style="font-weight: 600;">{{$packageInfo->title}} Package</p>
                                    </div>
                                    <div class="col text-right">
                                        <span style="color: #1D4354; font-weight: 600;">{{ number_format($packageInfo->price, 2) }}
                                            USD</span>
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <div class="col">
                                        <p style="font-weight: 600;">VAT & TAX (15%)</p>
                                    </div>
                                    <div class="col text-right">
                                        <span style="color: #1D4354; font-weight: 600;">{{ number_format((($packageInfo->price*15)/100), 2) }} USD</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p style="font-weight: 600;">Discount</p>
                                    </div>
                                    <div class="col text-right">
                                        <span style="color: #1D4354; font-weight: 600;">{{ number_format(0, 2) }} USD</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p style="font-weight: 600; font-size: 18px;">Total</p>
                                    </div>
                                    <div class="col text-right">
                                        <span style="color: #1D4354; font-weight: 600; font-size: 18px;">{{ number_format($packageInfo->price+(($packageInfo->price*15)/100), 2) }} USD</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" id="coupon_code" name="coupon" class="form-control mb-1" placeholder="Write Coupon Code Here">
                            <button type="button" onclick="applyCoupon()" class="btn btn-rounded w-100"><i class="fas fa-check"></i> Apply Coupon</button>
                        </div>

                        <button type="submit" class="btn btn-rounded w-100 mt-3"
                            style="background: #1D4354; color: white"><i class="fas fa-coins"></i> Pay Now</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- assesment content end-->
@endsection

@section('footer_js')
    <script src="{{ url('select2Autocomplete') }}/select2.min.js"></script>
    <script type="text/javascript">
        $('#country_select2').select2({
            placeholder: 'Search for Country',
            ajax: {
                url: '{{ url('/seach/countries') }}',
                dataType: 'json',
                delay: 0,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.name
                            }
                        })
                    };
                },
                cache: true
            }
        });

        function applyCoupon(){
            var coupon_code = $("#coupon_code").val();
            if(coupon_code == ''){
                toastr.error("Coupon Code is Missing");
            } else {
                toastr.error("Cupon Code Not Found");
            }
        }
    </script>

    <script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
@endsection
