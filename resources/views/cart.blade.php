@extends('layouts.app')

@section('title')
    Cart
@endsection

@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Cart'])
    <section class="ftco-section ftco-cart">
		<div class="container">
			<!-- SECTION PRODUCT LIST IN CART -->
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>Menu</th>
									<th>Product Image</th>
									<th>Product name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-center" id="item1">
									<td class="product-remove">
										<a href="#" data-toggle="modal" data-target="#editCart" class="mr-2"
											onclick="modal('item1')">
											<span class="ion-ios-create">Edit</span>
										</a>
										<a href="#" data-toggle="modal" data-target="#removeCart">
											<span class="ion-ios-trash">Remove</span>
										</a>
									</td>

									<td class="image-prod">
										<div class="img" style="background-image:url({{asset('img/product-1.jpg')}});">
										</div>
									</td>

									<td class="product-name">
										<h3>Bell Pepper</h3>
									</td>

									<td class="price" id="price">15000</td>

									<td class="quantity">
										<div class="input-group mb-3">
											<input type="text" id="quantity_item1" name="quantity_item1"
												class="form-control input-number" value="1000" disabled>
										</div>
									</td>

									<td class="price" id="total_price_item1">30000</td>
								</tr><!-- END TR-->

								<tr class="text-center" id="item2">
									<td class="product-remove">
										<a href="#" data-toggle="modal" data-target="#editCart" class="mr-2"
											onclick="modal('item2')">
											<span class="ion-ios-create">Edit</span>
										</a>
										<a href="#" data-toggle="modal" data-target="#removeCart">
											<span class="ion-ios-trash">Remove</span>
										</a>
									</td>

									<td class="image-prod">
										<div class="img" style="background-image:url({{asset('img/product-5.jpg')}});">
										</div>
									</td>

									<td class="product-name">
										<h3>Tomatos</h3>
									</td>
									<td class="price" id="price">13000</td>

									<td class="quantity">
										<div class="input-group mb-3">
											<input type="text" id="quantity_item2" name="quantity_item2"
												class="form-control input-number" value="1000" disabled>
										</div>
									</td>
									<td class="price" id="total_price_item2">13000</td>
								</tr><!-- END TR-->
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- END SECTION PRODUCT LIST IN CART -->


			<div class="row justify-content-end">
				<!-- ADDRESS/DESTINATION SHOW -->
				<div class="col-lg-8 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Destination</h3>
						<div action="#" class="info d-flex">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="province">Province</label>
									<input type="text" class="form-control text-left px-3" placeholder="Jawa Timur"
										readonly id="province" name="province">
								</div>
								<div class="form-group">
									<label for="city">City</label>
									<input type="text" class="form-control text-left px-3" placeholder="Kab.Jember"
										readonly id="city" name="city">
								</div>
								<div class="form-group">
									<label for="sub_district">Sub District</label>
									<input type="text" class="form-control text-left px-3" placeholder="Sumbersari"
										readonly id="sub-district" name="sub-district">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="postal_code">Postal Code</label>
									<input type="text" class="form-control text-left px-3" placeholder="68121" readonly
										id="postal_code" name="postal_code">
								</div>
								<div class="form-group">
									<label for="postal_code">Details Address</label>
									<textarea name="details_address" id="details_address" cols="30" rows="10"
										class="form-control text-left pl-3 pt-1"
										placeholder="Kampus Tegalboto, Jl. Kalimantan No.37, Krajan Timur, Sumbersari"
										readonly></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END ADDRESS/DESTINATION SHOW -->

				<!-- SIDE CART CALCULATION -->
				<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Cart Totals</h3>
						<p class="d-flex">
							<span>Subtotal</span>
							<span>Rp 120.000</span>
						</p>
						<p class="d-flex">
							<span>Delivery</span>
							<span>Rp 36.000</span>
						</p>
						<p class="d-flex">
							<span>Discount</span>
							<span>Rp 0</span>
						</p>
						<hr>
						<p class="d-flex total-price">
							<span>Total</span>
							<span>Rp 156.000</span>
						</p>
					</div>
					<p><a href="checkout.html" class="btn btn-primary py-3 px-4"
							onclick="return confirm('Are you sure want to checkout your cart?')">Proceed to Checkout</a>
					</p>
				</div>
				<!-- END SIDE CART CALCULATION -->
			</div>
		</div>
	</section>

	<!-- MODAL EDIT CONFIRM -->
	<div class="modal fade" id="editCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_edit_cart_title">Changes</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="editCartItem">
					<div class="modal-body" id="modal_edit_cart_body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-4">Product Name</div>
								<div class="col-md-4 ml-auto" id="modal_edit_cart_body_product_name">Tomatos
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">Quantity</div>
								<div class="col-md-4 ml-auto">
									<input type="text" id="modal_edit_cart_body_product_quantity"
										name="modal_edit_cart_body_product_quantity" class="form-control" value="1">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer d-flex justify-content-around">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END MODAL EDIT CONFIRM -->
    <!-- MODAL REMOVE CONFIRM -->
	<div class="modal fade" id="removeCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Caution</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">Are you sure to remove this item from your cart?</div>
				<div class="modal-footer d-flex justify-content-around">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary">Yes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- END MODAL REMVOE CONFIRM -->
@endsection
@push('scripts_addons')
    <!-- WELL AKU GK NGERTI CARA E NGGAE CART, hmm logic e salah -->
    <script>
		function modal(idSec) {
			var p_title = $('#' + idSec + ' .product-name h3').text();
			var p_quantity = $('#quantity_' + idSec).val();
			var p_price = $('#' + idSec + ' .price#price').text();
			$('#modal_edit_cart_body_product_name').text(p_title);
			$('#modal_edit_cart_body_product_quantity').val(p_quantity);
			$('#editCartItem').submit(function (event) {
				var m_quantity = $('#modal_edit_cart_body_product_quantity').val();
				$('#quantity_' + idSec).val(m_quantity);
				$('#total_price_' + idSec).text(m_quantity * p_price);
				$('#editCart').modal('toggle');
			});
		}
	</script>
@endpush