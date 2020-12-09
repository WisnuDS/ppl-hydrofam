@extends('layouts.app')

@section('content')
    @include('components.jumbotron',["title" => "Add New Product"])
    <section class="ftco-section">
        <div class="container">
            @if(auth()->user()->isA('admin'))
                <form action="{{route('admin.shop.store')}}" method="POST" class="billing-form" id="product_form" enctype="multipart/form-data">
            @elseif(auth()->user()->isA('super'))
                <form action="{{route('super.shop.store')}}" method="POST" class="billing-form" id="product_form" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="row justify-content-center">
                    <!-- LEFT SIDE -->
                    <div class="col-xl-7 ftco-animate">
                        <h3 class="mb-4 billing-heading">New Product</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" placeholder="" id="product_name"
                                           name="product_name">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" placeholder="" id="product_price"
                                           name="product_price">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Stock</label>
                                    <input type="text" class="form-control" placeholder="" id="product_stock" name="product_stock">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">Details Product</label>
                                    <textarea name="product_details" id="product_details" cols="30" rows="10"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END LEFT SIDE-->
                    <div class="col-xl-5">
                        <div class="row mt-5 pt-3">
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Product Picture</h3>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="file" id="product_thumbnail" name="product_thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .col-md-8 -->
                </div>
                <div class=" w-100"></div>
                <div class="col-md-12">
                    <div class="cart-detail p-3 p-md-4 d-flex justify-content-around">
                        <a href="{{url()->previous()}}" class="btn btn-outline-danger py-3 px-4">Cancel</a>
                        <button class="btn btn-outline-primary py-3 px-4" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section> <!-- .section -->
@endsection
