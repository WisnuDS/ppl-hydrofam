@extends('layouts.app')

@section('title')
    User Management
@endsection

@push('style')
    <!-- datatablesCSS -->
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">--}}
    <!-- ENDdatatablesCSS -->
@endpush

@section('content')
    @include('components.jumbotron',["title" => "User Management"])
    <section class="ftco-section ftco-degree-bg" style="background-color: white;">
        <div class="container">
            <div class="row">
                <div class="w-100"></div>
                <!-- SECTION LIST TRANSACTION DATA -->
                <div class="col-lg-12 ftco-animate">
                    <table id="user_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Origin</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->city}}</td>
                                <td>{{$user->roles[0]->title}}</td>
                                <td>
                                    <a href="{{route('super.user-management.show',["user_management"=>$user->id])}}" class="btn btn-info">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- END SECTION LIST TRANSACTION DATA -->
            </div>
{{--            <!-- START PAGINATION -->--}}
{{--            <div class="row mt-5">--}}
{{--                <div class="col text-center">--}}
{{--                    <div class="block-27">--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">&lt;</a></li>--}}
{{--                            <li class="active"><span>1</span></li>--}}
{{--                            <li><a href="#">2</a></li>--}}
{{--                            <li><a href="#">3</a></li>--}}
{{--                            <li><a href="#">4</a></li>--}}
{{--                            <li><a href="#">5</a></li>--}}
{{--                            <li><a href="#">&gt;</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- END PAGINATION -->--}}
        </div>
    </section> <!-- .section -->
@endsection

@push('scripts')
    <!-- datatablesDep -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_table').DataTable();
        });
    </script>
    <!-- ENDdatatablesDep -->
@endpush
