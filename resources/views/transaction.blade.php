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
                                <tr>
                                    <td>1</td>
                                    <td>Tiger Nixon</td>
                                    <td>Edinburgh</td>
                                    <td>2011/04/25</td>
                                    <td>Rp 580.000</td>
                                    <td class="table-warning">Waiting to be verified</td>
                                    @if(auth()->user()->isA('admin'))
                                    <td><a href="{{url('admin/transaction/id-transaction')}}" class="btn btn-outline-primary"><span
                                                class='fa fa-info-circle'></span></a>
                                    </td>
                                    @else
                                    <td><a href="{{url('super/transaction/id-transaction')}}" class="btn btn-outline-primary"><span
                                                class='fa fa-info-circle'></span></a>
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Garrett Winters</td>
                                    <td>Tokyo</td>
                                    <td>2011/07/25</td>
                                    <td>Rp 180900</td>
                                    <td class="table-danger">Aborted</td>
                                    <td><a href="" class="btn btn-outline-primary"><span
                                                class='fa fa-info-circle'></span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Ashton Cox</td>
                                    <td>San Francisco</td>
                                    <td>2009/01/12</td>
                                    <td>Rp 134.000</td>
                                    <td class="table-success">Done</td>
                                    <td><a href="" class="btn btn-outline-primary"><span
                                                class='fa fa-info-circle'></span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Cedric Kelly</td>
                                    <td>Edinburgh</td>
                                    <td>2012/03/29</td>
                                    <td>Rp 308.000</td>
                                    <td class="table-info">Waiting for payment</td>
                                    <td><a href="" class="btn btn-outline-primary"><span
                                                class='fa fa-info-circle'></span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Cedric Kelly</td>
                                    <td>Edinburgh</td>
                                    <td>2012/03/29</td>
                                    <td>Rp 298.000</td>
                                    <td class="bg-warning">in delivery</td>
                                    <td><a href="" class="btn btn-outline-primary"><span
                                                class='fa fa-info-circle'></span></a>
                                    </td>
                                </tr>
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