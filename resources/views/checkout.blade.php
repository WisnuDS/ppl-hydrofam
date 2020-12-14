@extends('layouts.app')

@section('title')
    Checkout
@endsection

@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Checkout'])
    <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">

				<!-- LEFT SIDE DETAIL CHECKOUT TRANSACTION-->
				<div class="col-xl-7 ftco-animate">
					<div class="billing-form">
						<h3 class="mb-4 billing-heading">Detail Transaction</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<label for="name">Invoice</label>
							</div>
							<div class="col-md-6">
								<span>{{$transaction->invoice}}</span>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<label for="birth_date">Status</label>
							</div>
                            @if($transaction->status === 1)
                                <div class="col-md-6">
                                    <span>Waiting for payment</span>
                                </div>
                            @elseif($transaction->status === 2)
                                <div class="col-md-6">
                                    <span>Payment is successful, your order is being sent</span>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <span>Payment Failed</span>
                                </div>
                            @endif
							<div class="w-100"></div>
						</div>
					</div>
					<hr>
					<div class="billing-form">
						<h3 class="mb-4 billing-heading">List Product</h3>
						<div class="row align-items-end">
							<div class="col-md-4">
								<label>
									<span class="font-weight-bold">Product Name</span>
								</label>
							</div>
							<div class="col-md-4">
								<label>
									<span class="font-weight-bold">Quantity</span>
								</label>
							</div>
							<div class="col-md-4">
								<label>
									<span class="font-weight-bold">Price</span>
								</label>
							</div>
                            @foreach($carts as $cart)
                                <div class="w-100"></div>
                                <div class="col-md-4">
                                    <label for="product_name">{{$cart->item->item_name}}</label>
                                </div>
                                <div class="col-md-4">
                                    <span>{{$cart->quantity}} <span>Unit</span> </span>
                                </div>
                                <div class="col-md-4">
                                    <span>Rp {{$cart->quantity*$cart->item->price}}</span>
                                </div>
                            @endforeach
						</div>
					</div>
					<hr>
					<div class="billing-form">
						<h3 class="mb-4 billing-heading">Sent to</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<label for="reciever">Reciever</label>
							</div>
							<div class="col-md-6">
								<span>{{auth()->user()->name}}</span>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<label for="phone">Phone</label>
							</div>
							<div class="col-md-6">
								<span>{{auth()->user()->phone_number}}</span>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<label for="address">Destination</label>
							</div>
							<div class="col-md-6">
								<span>{{auth()->user()->detail}}</span>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6 offset-md-6">
								<span>{{auth()->user()->sub_district.' '.auth()->user()->postal_code.', '.auth()->user()->city }}</span>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6 offset-md-6">
								<span>{{auth()->user()->province}}</span>
							</div>
						</div>
					</div><!-- END -->
					<hr>
				</div>
				<!-- END LEFT SIDE DETAIL CHECKOUT TRANSACTION-->

				<div class="col-xl-5">
					<div class="row mt-5 pt-3">
						<div class="col-md-12 d-flex mb-2">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Cart Total</h3>
								<p class="d-flex">
									<span>Subtotal</span>
									<span>Rp {{$total}}</span>
								</p>
								<p class="d-flex">
									<span>Delivery</span>
									<span>Rp 15000</span>
								</p>
								<hr>
								<p class="d-flex total-price">
									<span>Total</span>
									<span>Rp {{$total+15000}}</span>
								</p>
							</div>
						</div>
						<div class="col-md-12 d-flex mb-2">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">You can transfer to</h3>
								<hr>
								<p class="d-flex total-price">
									<span>Bank</span>
									<span>Mandiri</span>
								</p>
								<p class="d-flex total-price">
									<span>Holder</span>
									<span>Suwandi</span>
								</p>
								<p class="d-flex total-price">
									<span>Account Number</span>
									<span>120-1111-1111</span>
								</p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="cart-detail p-3 p-md-4">
								<h3 class="billing-heading mb-4">Upload Payment Proof</h3>
								<div class="form-group">
									<div class="col-md-12">
										<input type="file">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label><input type="checkbox" value="" class="mr-2"> I have read and accept
												the terms and conditions</label>
										</div>
									</div>
								</div>
								<p><a href="#" class="btn btn-primary py-3 px-4">Upload</a></p>
							</div>
						</div>
					</div>
				</div> <!-- .col-md-8 -->
			</div>
		</div>
	</section> <!-- .section -->
@endsection
