@extends('layouts.app')

@section('title')
    Cart
@endsection

@section('content')
    @include('components.jumbotron',["title" => "My Cart"])
    <cart :cart="cart"></cart>
@endsection
