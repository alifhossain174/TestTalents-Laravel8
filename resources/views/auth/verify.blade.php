@extends('backend.master')

@section('content')

<style>
    .card {
        background: #376678
    }

    .card-header {
        background: #376678;
        padding-left: 25px;
        padding-right: 25px
    }

    .card-header {
        color: white;
        font-size: 18px
    }

    .card-body {
        background: white;
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 30px
    }
    .card-body button {
        color: white;
        background: #376678;
        font-size: 15px;
        font-weight: 600;
        display: inline-block;
        margin-top: 20px;
        padding: 7px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }
</style>

<div class="container" style="min-height: 100vh; padding-top: 100px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="align-baseline">{{ __('click here to request another') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
