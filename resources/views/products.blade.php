@extends('layouts.app')

@section('title')
    Products
@endsection
@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Products'])
    <section class="ftco-section">
		<div class="container">
            @if(!auth()->guest())
                @if(auth()->user()->isA('admin') || auth()->user()->isA('super'))
                <div class="row justify-content-end">
                    <div class="col-md-3 mb-5 text-center">
                        <ul class="product-category">
                        @if(auth()->user()->isA('admin'))
                            <a href="{{url('admin/products/new')}}" class="btn btn-primary"><i class="fas fa-plus"></i>New Product</a>
                        @else
                            <a href="{{url('super/products/new')}}" class="btn btn-primary"><i class="fas fa-plus"></i>New Product</a>
                        </ul>
                        @endif
                    </div>
                </div>
                @endif
            @endif
			<div class="row">
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-1.jpg')}}"
								alt="Colorlib Template">

							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Bell Pepper</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('img/product-3.jpg')}}"
								alt="Colorlib Template">
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">Green Beans</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span>Rp 15.000</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="{{url('/products/id-product')}}"
										class="add-to-cart d-flex justify-content-center align-items-center text-center">
										<span><i class="ion-ios-menu"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- START PAGINATION -->
			<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
						<ul>
							<li><a href="#">&lt;</a></li>
							<li class="active"><span>1</span></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">&gt;</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END PAGINATION -->
		</div>
	</section>
	<!-- END SECTION PRODUCT -->
@endsection
