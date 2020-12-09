@extends('layouts.app')

@section('content')
    @include('components.jumbotron',["title" => "Product"])
    <!-- SECTION lIST PRODUCT -->
    <section class="ftco-section">
        <div class="container">
            <!-- BUTTON NEW PRODUCT -->
            @if((!auth()->guest()))
                @if(!auth()->user()->isA('user'))
                    <div class="row justify-content-end">
                        <div class="col-md-3 mb-5 text-center">
                            <ul class="product-category">
                                @if(auth()->user()->isA('admin'))
                                    <a href="{{route('admin.shop.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                        New Product</a>
                                @else
                                    <a href="{{route('super.shop.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                        New Product</a>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            @endif
            <!-- END BUTTON NEW PRODUCT -->
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{route('shop.show',[$item->id])}}" class="img-prod"><img class="img-fluid" src="/storage/product/{{$item->image}}"
                                                              alt="Colorlib Template">

                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{route('shop.show',[$item->id])}}">{{$item->item_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>Rp {{$item->price}}</span></p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{route('shop.show',[$item->id])}}"
                                           class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- START PAGINATION -->
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
{{--                        <ul>--}}
{{--                            <li><a href="#">&lt;</a></li>--}}
{{--                            <li class="active"><span>1</span></li>--}}
{{--                            <li><a href="#">2</a></li>--}}
{{--                            <li><a href="#">3</a></li>--}}
{{--                            <li><a href="#">4</a></li>--}}
{{--                            <li><a href="#">5</a></li>--}}
{{--                            <li><a href="#">&gt;</a></li>--}}
{{--                        </ul>--}}
                        {!! $items->links() !!}
                    </div>
                </div>
            </div>
            <!-- END PAGINATION -->
        </div>
    </section>
    <!-- END SECTION PRODUCT -->
@endsection
