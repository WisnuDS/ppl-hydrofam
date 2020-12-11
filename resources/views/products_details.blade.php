@extends('layouts.app')

@section('title')
    Products Details
@endsection
@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Product Name'])
    <section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="{{asset('img/product-1.jpg')}}" class="image-popup"><img src="{{asset('img/product-1.jpg')}}"
							class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <div class="row justify-content-end">
                    @if(!auth()->guest())
                        @if(auth()->user()->isA('admin') || auth()->user()->isA('super'))
                                @if(auth()->user()->isA('admin'))
                                <a href="{{url('admin/products/id-product/edit')}}" class="btn btn-info"><i class="far fa-edit"></i>Edit Product</a>
                                @else
                                <a href="{{url('super/products/id-product/edit')}}" class="btn btn-info"><i class="far fa-edit"></i>Edit Product</a>
                                @endif
                        @endif
                    @endif
                    </div>
					<h3>Bell Pepper</h3>
					<div class="rating d-flex">
						<p class="text-left">
							<span class="mr-2" style="color: #000;"><span id="stock">10</span> Kg <span
									style="color: #bbb;">Available</span></span>
						</p>
					</div>
					<p class="price"><span>Rp 15.000</span></p>
					<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
						is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should
						turn around and return to its own, safe country. But nothing the copy said could convince her
						and so it didn’t take long until.
					</p>
                    @if(!auth()->guest())
                        @if(!auth()->user()->isA('admin') && !auth()->user()->isA('super'))
                            <div class="">
                                <div class="row mt-4">
                                    <div class="w-100"></div>
                                    <div class="input-group col-md-6 d-flex mb-3">
                                        <span class="input-group-btn mr-2">
                                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                                <i class="ion-ios-remove"></i>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="200"
                                            min="200" max="100000">
                                        <span class="input-group-btn ml-2">
                                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                                <i class="ion-ios-add"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <span>
                                            <p>in grams</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <small class="text-danger">
                                    *Outside Jember a minimum purchase must be 10 kg
                                </small>
                            </p>
                            <p><a href="cart.html" class="btn btn-black py-3 px-5" data-toggle="modal" data-target="#cartVerifyModal">Add to Cart</a></p>
                        @else
                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="col-md-12 pt-3 text-center" style="color: #ffffff;background-color: #82AE46;">
                                <p>Product Available</p>
                            </div>
                        </div>
                        @endif
                    @endif
				</div>
			</div>
		</div>
	</section>

	<!-- MODAL CARTVERIFY CONFIRM -->
	<div class="modal fade" id="cartVerifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Caution</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">Add this product to cart?</div>
				<div class="modal-footer d-flex justify-content-around">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary">Yes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- END MODAL CARTVERIFY CONFIRM -->
@endsection
@push('scripts_addons')
    <script>
		$(document).ready(function () {
            var stock = (parseInt(($('#stock').text()),10))*1000;
			$('.quantity-right-plus').click(function (e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined
                if(quantity<stock){
                    $('#quantity').val(quantity + 200);
                }
				// Increment

			});

			$('.quantity-left-minus').click(function (e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 200);
				}
			});

		});
	</script>
@endpush
