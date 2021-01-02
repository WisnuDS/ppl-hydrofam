@extends('layouts.app')

@section('title')
    {{$item->item_name}}
@endsection

@section('content')
    @include('components.jumbotron',["title" => "Single Product"])
    @if(auth()->guest())
        <product product="{{$item->id}}" role="guest"></product>
    @else
        <product product="{{$item->id}}" role="{{auth()->user()->roles[0]->name}}"></product>
    @endif
@endsection
