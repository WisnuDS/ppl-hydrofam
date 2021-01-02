@extends('auth.layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-3 offset-md-2 col-sm-3 offset-sm-3 col-4 offset-2 auth_menu disabled">
            <a href="{{route('login')}}">
                <h3>Login</h3>
            </a>
            <hr>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 auth_menu col-4 active">
            <a href="{{route('register')}}">
                <h3>Sign Up</h3>
            </a>
            <hr>
        </div>
        <div class="w-100 d-none d-md-block"></div>
        <div class="col-lg-6 col-md-8 offset-1 px-5 mt-3">
            <!-- Form Login -->
            <form method="POST" action="{{route('register')}}">
                @csrf
                <div class="form-group icon_input">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg"><img
                                        src="{{asset('img/email_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name" autofocus id="name">
                        @error('name')
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
                                        src="{{asset('img/mail_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" id="email" placeholder="Email">
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
                                        src="{{asset('img/date_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}"  autocomplete="birth_date" id="birthDate" placeholder="Birth Date">
                        @error('birth_date')
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
                                        src="{{asset('img/place_form_icon.png')}}" alt=""></span>
                        </div>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender"  autocomplete="gender" id="gender">
                            <option disabled selected>Choose Your Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gender')
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
                                        src="{{asset('img/telp_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}"  autocomplete="phone_number" id="phone_number" placeholder="Phone Number">
                        @error('phone_number')
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
                                        src="{{asset('img/place_form_icon.png')}}" alt=""></span>
                        </div>
                        <select class="form-control @error('province') is-invalid @enderror" name="province"  autocomplete="province" id="province">
                            <option disabled selected>Choose Your Province</option>
                            @foreach($indonesia as $province => $city)
                                <option value="{{$province}}">{{$province}}</option>
                            @endforeach
                        </select>
                        @error('province')
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
                                        src="{{asset('img/place_form_icon.png')}}" alt=""></span>
                        </div>
                        <select class="form-control @error('city') is-invalid @enderror" name="city"  autocomplete="city" id="city">
                            <option disabled selected>Choose Your City</option>
                        </select>
                        @error('city')
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
                                        src="{{asset('img/telp_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="text" class="form-control @error('sub_district') is-invalid @enderror" name="sub_district" value="{{ old('sub_district') }}"  autocomplete="sub_district" id="sub_district" placeholder="Sub District">
                        @error('sub_district')
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
                                        src="{{asset('img/telp_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}"  autocomplete="postal_code" id="postal_code" placeholder="Postal Code">
                        @error('postal_code')
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
                                        src="{{asset('img/telp_form_icon.png')}}" alt=""></span>
                        </div>
                        <input type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('detail') }}"  autocomplete="detail" id="detail" placeholder="Detail Address">
                        @error('detail')
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
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" id="password" placeholder="Password">

                        @error('password')
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
                        <input type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" id="password-confirm" placeholder="Confirm Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-md-3 offset-md-9 mt-2">Sign Up</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var indonesia = @json($indonesia, JSON_PRETTY_PRINT);
        $('#province').change(function () {
            $('#city')
                .find('option')
                .remove()
                .end()
                .append('<option disabled selected>Choose Your City</option>');
            var province = $("#province option:selected").val();
            var cities = indonesia[province];
            for (let i = 0; i < cities.length; i++) {
                $("#city").append('<option value="'+cities[i]+'">'+cities[i]+'</option>')
            }
        })
    </script>
@endpush
