@extends('auth.layouts.app')

@section('content')
<div class="container mb-10">
    <div class="row">
        <div class="col-lg-2 col-md-3 offset-md-2 col-sm-3 offset-sm-3 col-4 offset-2 auth_menu active">
            <a href="#">
                <h3>Login</h3>
            </a>
            <hr>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 auth_menu col-4 disabled">
            <a href="{{route('register')}}">
                <h3>Sign Up</h3>
            </a>
            <hr>
        </div>
        <div class="w-100 d-none d-md-block"></div>
        <div class="col-lg-6 col-md-8 offset-1 px-5 mt-3">
            <!-- Form Login -->
            <form method="POST" action="{{route('login')}}" id="login-form">
                @csrf
                <div class="form-group icon_input">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg"><img
                                        src="{{asset('img/email_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autocomplete="email" value="{{ old('email') }}">
{{--                        <div class="invalid-feedback">--}}
{{--                            Email can not be empty--}}
{{--                        </div>--}}
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group icon_input">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg"><img
                                        src="{{asset('img/password_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" autocomplete="current-password">
{{--                        <div class="invalid-feedback">--}}
{{--                            Password can not be empty--}}
{{--                        </div>--}}
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                @if (Route::has('password.request'))
                    <div class="col-md-9"><a class="forget_pass" href="{{ route('password.request') }}">Forgot your password?</a></div>
                @endif
                <button type="submit" class="btn btn-primary col-md-3 offset-md-9 mt-2">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.invalid-feedback').addClass("d-none");
            $('#login_form').submit(function (event) {
                var form_data = $(this).serializeArray();
                var validate = true;
                for (var input in form_data) {
                    var element = $("#" + form_data[input]['name']);
                    if (element.attr('id') == 'email') {
                        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                        var is_email = re.test(element.val());
                        if (is_email) {
                            element.removeClass("is-invalid");
                        }
                        else {
                            element.removeClass("is-valid").addClass("is-invalid");
                            $('.invalid-feedback').removeClass("d-none");
                            validate = false;
                        }
                    } else {
                        var not_null = element.val();
                        if (not_null) {
                            element.removeClass("is-invalid");
                        }
                        else {
                            element.removeClass("is-valid").addClass("is-invalid");
                            $('.invalid-feedback').removeClass("d-none");
                            validate = false;
                        }
                    }
                }
                if (!validate) {
                    event.preventDefault();
                } else {
                    alert('No errors: Form will be submitted');
                }
            });
        });
    </script>
@endpush
