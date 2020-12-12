@extends('layouts.app')

@section('content')
    @include('components.jumbotron', ['title' => $title])
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
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->name}}</span>
                                @else
                                    <span>{{auth()->user()->name}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="birth_date">Date of Birth</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->birth_date}}</span>
                                @else
                                    <span>{{auth()->user()->birth_date}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="gender">Gender</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    @if($user->gender == 1)
                                        <span>Men</span>
                                    @else
                                        <span>Women</span>
                                    @endif
                                @else
                                    @if(auth()->user()->gender == 1)
                                        <span>Men</span>
                                    @else
                                        <span>Women</span>
                                    @endif
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="phone">Phone number</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->phone_number}}</span>
                                @else
                                    <span>{{auth()->user()->phone_number}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->email}}</span>
                                @else
                                    <span>{{auth()->user()->email}}</span>
                                @endif
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
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->province}}</span>
                                @else
                                    <span>{{auth()->user()->province}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="city">City</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->city}}</span>
                                @else
                                    <span>{{auth()->user()->city}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="sub_district">Sub-District</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->sub_district}}</span>
                                @else
                                    <span>{{auth()->user()->sub_district}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="postal_code">Postal Code</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->postal_code}}</span>
                                @else
                                    <span>{{auth()->user()->postal_code}}</span>
                                @endif
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <label for="email">Detail</label>
                            </div>
                            <div class="col-md-6">
                                @if(auth()->user()->isA('super'))
                                    <span>{{$user->detail}}</span>
                                @else
                                    <span>{{auth()->user()->detail}}</span>
                                @endif
                            </div>
                        </div>
                    </div><!-- END -->
                </div>
                @if(auth()->user()->isA('super'))
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        @if($user->roles[0]->name != 'super')
                            <div class="col-md-12 d-flex mb-2">
                                <div class="col-md-6">
                                    <label for="name">Changes Roles</label>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{route('super.update.role',["id"=>$user->id])}}" method="POST" id="changeRoleOption">
                                        @csrf
                                        <select id="myselect" class="form-control"
                                                style="font-size: 13px;height: 40px!important;" name="role">
                                            <option selected disabled>Changes Roles</option>
                                            @if($user->roles[0]->name == 'admin')
                                                <option value="2" selected>Admin</option>
                                                <option value="3">Consumer</option>
                                            @elseif($user->roles[0]->name == 'user')
                                                <option value="2">Admin</option>
                                                <option value="3" selected>Consumer</option>
                                            @endif
                                        </select>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12 d-flex mb-1">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <div>
                                    <span>
                                        @if($user->avatar == null)
                                            <img src="{{asset('img/avatar_default.png')}}" alt="" class="user_profile_detail">
                                        @else
                                            <img src="/storage/{{$user->avatar}}" alt="" class="user_profile_detail">
                                        @endif
                                    </span>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-detail p-3 p-md-4">
                                <p>
                                    <a href="{{route('super.user-management.edit',["user_management" => $user->id])}}"
                                       class="btn btn-primary py-3 px-4">
                                        Edit this person's profile
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
                @else
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
                </div><!-- .col-md-8 -->
                @endif
            </div>
        </div>
    </section> <!-- .section -->
    <!-- END DETAIL PROFILE -->
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change this person's roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change this person's roles?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                document.getElementById('changeRoleOption').submit();">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () { //Make script DOM ready
            $('#myselect').change(function () { //jQuery Change Function
                var opval = $(this).val(); //Get value from select element
                if (opval == 2 || opval == 3) { //Compare it and if true
                    $('#myModal').show(); //Open Modal
                }
            });

        });

        @if(auth()->user()->isA('super'))
            function closeModal() {
                $('#myModal').hide();
                $('#myselect').val({{$user->roles[0]->name == 'admin'? 2: 3}})
            }
        @endif

    </script>
@endpush

@section('title', 'Profile')
