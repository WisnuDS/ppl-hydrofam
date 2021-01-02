@extends('layouts.app')

@section('title')
    Transaction Data
@endsection
@push('data-tables-transaction')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endpush
@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Transaction Data'])
    @if(!auth()->guest())
        @if(auth()->user()->isA('admin') || auth()->user()->isA('super'))
        <section class="ftco-section ftco-degree-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 ftco-animate"></div>
                    <div class="table-responsive mx-5 my-5 py-2 px-2" style="background-color: white!important;">
                        <table id="transaction_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Consumer</th>
                                    <th>City</th>
                                    <th>Order date</th>
                                    <th>Payment Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->user->city}}</td>
                                        <td>{{$transaction->created_at}}</td>
                                        <td>Rp {{$transaction->total}}</td>
                                        @if($transaction->status == 1)
                                            <td class="table-warning">Waiting for payment</td>
                                        @elseif($transaction->status == 2)
                                            <td class="table-warning">Waiting for verification</td>
                                        @elseif($transaction->status == 3)
                                            <td class="table-warning">Process</td>
                                        @elseif($transaction->status == 4)
                                            <td class="table-warning">On the way</td>
                                        @elseif($transaction->status == 5)
                                            <td class="table-warning">Done</td>
                                        @endif
                                        @if(auth()->user()->isA('admin'))
                                        <td><a href="{{url('admin/transaction/'.$transaction->id)}}" class="btn btn-outline-primary"><span
                                                    class='fa fa-info-circle'></span></a>
                                        </td>
                                        @else
                                        <td><a href="{{url('super/transaction/'.$transaction->id)}}" class="btn btn-outline-primary"><span
                                                    class='fa fa-info-circle'></span></a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section> <!-- .section -->
        @endif
    @endif
@endsection
@push('scripts')
    <!-- DATATABLES -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <!-- END DATATABLES -->
    <script>
        $(document).ready(function () {
            $('#transaction_list').DataTable();
        });
    </script>
@endpush
