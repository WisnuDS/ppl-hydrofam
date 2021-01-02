@extends('layouts.app')

@section('title')
    Products Management
@endsection
@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Product Management'])
    <section class="ftco-section">
        <div class="container">
            <form action="#" class="billing-form" id="product_form">
                <div class="row justify-content-center">
                    <!-- LEFT SIDE -->
                    <div class="col-xl-7 ftco-animate">
                        <h3 class="mb-4 billing-heading">New Product</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" placeholder="" id="product_name"
                                        name="product_name" value="Bell Pepper">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" placeholder="" id="product_price"
                                        name="product_price" value="15000">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price">Stock</label>
                                    <input type="text" class="form-control" placeholder="" id="product_stock"
                                        value="10">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">Details Product</label>
                                    <textarea name="product_details" id="product_details" cols="30" rows="10"
                                        class="form-control">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
                                    </textarea>
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
                                    <div class="col-md-12 d-flex mb-1">
                                        <div class="cart-detail cart-total p-3 p-md-4">
                                            <div>
                                                <span>
                                                    <img src="{{asset('img/product-1.jpg')}}" alt=""
                                                        class="user_profile_detail">
                                                </span>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
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
                        <a href="{Redirect::back()}" class="btn btn-outline-danger py-3 px-4">Cancel</a>
                        <button href="#" class="btn btn-outline-primary py-3 px-4" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('scripts_addons')
    <script>
        $('#product_form').submit(function (event) {
            var p_name = $('#product_name').val();
            var p_price = $('#product_price').val();
            var p_detais = $('#product_details').val();
            var p_thumb = $('#product_thumbnail').val();
            if (!p_name || !p_price || !p_detais || p_thumb) {
                alert('Please fulfill information about your product');
                event.preventDefault();
            } else {
                confirm('Are you sure?');
            }
        });
    </script>
@endpush