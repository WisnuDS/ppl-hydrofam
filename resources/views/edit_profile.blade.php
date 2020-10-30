@extends('layouts.app')

@section('content')
    @include('components.jumbotron', ['title' => 'Edit Profile'])
    <!-- DETAIL PROFILE -->
    <section class="ftco-section" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form action="{{route('user.profile.update',["profile"=>auth()->id()])}}" class="billing-form" enctype="multipart/form-data" method="POST">
                        {{method_field('PATCH')}}
                        @csrf
                        <h3 class="mb-4 billing-heading">Biodata</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12 d-flex mb-5">
                                <div class="cart-detail cart-total p-3 p-md-4">
                                    <div>
                                        @if(auth()->user()->avatar == null)
                                            <img src="{{asset('img/avatar_default.png')}}" alt="avatar" class="user_profile_detail">
                                        @else
                                            <img src="/storage/{{auth()->user()->avatar}}" alt="avatar" class="user_profile_detail">
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="photo_profil">Change Photo Profile</label>
                                        <input type="file" name="avatar" id="avatar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{auth()->user()->name}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="birth_date" class="form-control" value="{{auth()->user()->birth_date}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <label for="gender">Gender</label>
                                    @if(auth()->user()->gender == 1)
                                        <div class="radio">
                                            <label class="mr-3">
                                                <input type="radio" name="gender" value="1" checked> Men
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="2"> Women
                                            </label>
                                        </div>
                                    @else
                                        <div class="radio">
                                            <label class="mr-3">
                                                <input type="radio" name="gender" value="1"> Men
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="2" checked> Women
                                            </label>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="" value="{{auth()->user()->phone_number}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="text" name="email" class="form-control" placeholder="" value="{{auth()->user()->email}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <h3 class="mb-4 billing-heading">Address</h3>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="province" id="province" class="form-control">
                                            @foreach($indonesia as $province => $city)
                                                @if($province == auth()->user()->province)
                                                    <option value="{{$province}}" selected>{{$province}}</option>
                                                @else
                                                    <option value="{{$province}}">{{$province}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="city" id="city" class="form-control">
                                            @foreach($indonesia[auth()->user()->province] as $city)
                                                @if($city == auth()->user()->city)
                                                    <option value="{{$city}}" selected>{{$city}}</option>
                                                @else
                                                    <option value="{{$city}}">{{$city}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_disctrict">Sub-Disctrict</label>
                                    <div class="select-wrap">
                                        <input type="text" class="form-control" name="sub_district" id="sub_disctrict" value="{{auth()->user()->sub_district}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" placeholder="" value="{{auth()->user()->postal_code}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail_address">Detail Address</label>
                                    <input type="text" name="detail" class="form-control" placeholder="Detail Address" value="{{auth()->user()->detail}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4 d-flex justify-content-around">
                                    <button href="" class="btn btn-outline-danger py-3 px-4">Cancel</button>
                                    <button href="#" class="btn btn-outline-primary py-3 px-4"
                                            type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->
                </div>
            </div>
        </div>
    </section> <!-- .section -->
    <!-- END DETAIL PROFILE -->
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

@section('title')
    Edit Profile
@endsection

