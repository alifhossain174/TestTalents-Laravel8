@extends('layouts.app')

@section('header_css')
    <style>
        a.ghost {
            border-radius: 20px;
            border: 1px solid #FFFFFF;
            background-color: transparent;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="container" style="height: 550px !important">
        <div class="form-container sign-up-container">

            {{-- <form method="POST" action="{{ route('register') }}" onsubmit="validateForm()">
                @csrf
                <img src="{{ url('frontend_assets') }}/images/logo-green.png" width="100px">
                <h1 class="anotherh1">Create Account</h1>
                <span>to use your business email for registration</span>

                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="email" type="email" onkeyup="checkBusinessEmail(this.value)"
                    class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus placeholder="Business Email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password" type="password" class="@error('password') is-invalid @enderror register_password"
                    name="password" required autocomplete="current-password" placeholder="Password" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password-confirm" class="register_confirm_password" type="password"
                    placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password"
                    required>

                <a href="javascript:void(0)" onclick="validateForm()" class="register_form_validaion" class="mt-2">Sign
                    Up</a>
                <button type="submit" id="resgiter_submit_btn" class="mt-2 d-none">Sign Up</button>
            </form> --}}

        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <img src="{{ url('frontend_assets') }}/images/logo-green.png" width="100px">
                <h1 class="anotherh1">Sign In</h1>
                <span>to use your account</span>

                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus class="@error('email') is-invalid @enderror"
                    placeholder="Business Email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror"
                    placeholder="Password" required autocomplete="current-password" />
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
                    {{-- <button class="ghost" id="signUp">Sign Up</button> --}}
                    <a href="{{ url('register') }}" class="ghost">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_js')
    <script>
        function checkBusinessEmail(value) {
            let str = value;
            if (str.includes("gmail") == true || str.includes("yahoo") == true || str.includes("outlook") == true) {
                toastr.error("Only Business Email are Allowed");
                $("#email").val("");
            }
        }

        function validateForm() {
            var regConfirmPass = $(".register_confirm_password").val();
            var regPass = $(".register_password").val();

            if (regConfirmPass != regPass) {
                toastr.error("Password & Confirm Password is not matching");
                return false;
            } else {
                document.getElementById("resgiter_submit_btn").click();
            }
        }
    </script>
@endsection
