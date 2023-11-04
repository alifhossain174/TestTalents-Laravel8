@extends('layouts.app')

@section('content')

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <img src="{{url('frontend_assets')}}/images/logo.png" width="50%">
            <h1 class="anotherh1">Create Account</h1>

            <span>to use your business email for registration</span>

            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="email" type="email" onkeyup="checkBusinessEmail(this.value)" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Business Email" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" />
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" required>

            <button type="submit" class="mt-2">Sign Up</button>
        </form>

    </div>
    <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img src="{{url('frontend_assets')}}/images/logo.png" width="50%">
            <h1 class="anotherh1">Sign In</h1>
            <span>to use your account</span>

            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="@error('email') is-invalid @enderror" placeholder="Business Email" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            @endif

            <button type="submit">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your business info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Welcome to TestTalents!</h1>
                <p>Enter your business details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>


@endsection


@section("footer_js")
    <script>
        function checkBusinessEmail(value){
            let str = value;
            if(str.includes("gmail") == true || str.includes("yahoo") == true || str.includes("outlook") == true || str.includes("hotmail") == true){
                toastr.error("Only Business Email are Allowed");
                $("#email").val("");
            }
        }

        var button = document.getElementById("signUp");
        button.click();
    </script>
@endsection
