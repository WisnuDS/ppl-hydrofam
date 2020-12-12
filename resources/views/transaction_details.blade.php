@extends('layouts.app')

@section('title')
    Transaction Details
@endsection

@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Transaction Details'])
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5 ftco-animate">
                    <div class="row mt-4">
                        <div class="col-md-12 pt-3 text-center" style="color: #ffffff;background-color: gray;">
                            <p>Transfer Reciept</p>
                        </div>
                    </div>
                    <a href="{{asset('img/example_transfer.jpg')}}" class="image-popup"><img src="{{asset('img/example_transfer.jpg')}}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-md-8 product-details pl-md-5 ftco-animate">
                    <div class="col-lg-12 cart-wrap ftco-animate">
                        <div class="row mt-4">
                            <div class="col-md-12 pt-3 text-center" style="color: #ffffff;background-color: #82AE46;">
                                <p>Waiting to be verified</p>
                            </div>
                        </div>
                        <div class="cart-total mb-2">
                            <p class="d-flex">
                                <span>Invoice</span>
                                <span>202030100720DDD</span>
                            </p>
                            <hr>
                            <h3>Consumer Details</h3>
                            <p class="d-flex">
                                <span>Consumer</span>
                                <span>Tiger Nixon</span>
                            </p>
                            <p class="d-flex">
                                <span>Phone</span>
                                <span>081211111111</span>
                            </p>
                            <p class="d-flex">
                                <span>Address</span>
                                <span>Kampus Tegalboto, Jl. Kalimantan No.37, Krajan Timur, Sumbersari, Kec. Sumbersari,
                                    Kabupaten Jember, Jawa Timur 68121</span>
                            </p>
                            <hr>
                            <h3>Transaction Details</h3>
                            <p class="d-flex">
                                <span>Items Name</span>
                                <span>Quantity</span>
                            </p>
                            <p class="d-flex">
                                <span>
                                    <span>Bell Pepper</span>
                                    <span>Tomato</span>
                                </span>
                                <span>
                                    <span>10 Kg</span>
                                    <span>10 Kg</span>
                                </span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total Payment</span>
                                <span>Rp 156.000</span>
                            </p>
                        </div>
                        <p class="d-flex justify-content-end">
                            <a class="btn btn-primary py-3 px-4" data-toggle="modal" data-target="#confirm_payment"
                                style="color: white;">Confirm Payment</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MODAL CONFIRM PAYMENT -->
    <div class="modal fade" id="confirm_payment" tabindex="-1" role="dialog" aria-labelledby="confirm_payment"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to confirm this payment?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            Make sure you've checked the payment proof images
                        </div>
                        <div class="row">
                            Make sure you've checked the transaction details
                        </div>
                        <div class="row">
                            Make sure you've checked the suitability of the payment amount
                        </div>
                        <div class="w-100"></div>
                        <div class="row font-weight-bold">
                            Make sure you have recieved the money in your bank account
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL CONFIRM PAYMENT -->
@endsection