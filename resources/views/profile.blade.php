@extends('layouts.app')

@section('content')
    @include('components.jumbotron', ['title' => 'My Profile'])
    <!-- DETAIL PROFILE -->
    <section class="ftco-section" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <div class="billing-form">
                        <h3 class="mb-4 billing-heading">Biodata</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <label for="name">Full Name</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->name}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="birth_date">Date of Birth</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->birth_date}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="gender">Gender</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->gender == 1)
                                    <span>Men</span>
                                @else
                                    <span>Women</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="phone">Phone number</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->phone_number}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->email}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="billing-form">
                        <h3 class="mb-4 billing-heading">Address</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <label for="province">Province</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->province}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="city">City</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->city}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="sub_district">Sub-District</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->sub_district}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="postal_code">Postal Code</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->postal_code}}</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="email">Detail</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{auth()->user()->detail}}</span>
                            </div>
                        </div>
                    </div><!-- END -->
                </div>
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        <div class="col-md-12 d-flex mb-5">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <div>
                                    <span>
                                        @if(auth()->user()->avatar == null)
                                            <img src="{{asset('img/avatar_default.png')}}" alt="" class="user_profile_detail">
                                        @else
                                            <img src="/storage/{{auth()->user()->avatar}}" alt="" class="user_profile_detail">
                                        @endif
                                    </span>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-detail p-3 p-md-4">
                                <p><a href="{{route('user.profile.create')}}" class="btn btn-primary py-3 px-4">Edit Profile</a></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->
    <!-- END DETAIL PROFILE -->
@endsection

@section('title', 'Profile')
