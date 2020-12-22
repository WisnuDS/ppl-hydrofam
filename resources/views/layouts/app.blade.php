<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <title>@yield('title') | Mahameru Hydrofarm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    @stack('data-tables')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @stack('data-tables-transaction')
    @toastr_css
    <link rel="stylesheet" href="{{asset('css/custom_style.css')}}">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
    @stack('styles')
</head>

<body class="goto-here">
<div id="app">
<!-- START NAV -->
@include('layouts.navbar')
<!-- END nav -->

<!-- MODAL LOGOUT CONFIRM -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Caution</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure to log out?</div>
            <div class="modal-footer d-flex justify-content-around">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL LOGOUT CONFIRM -->


<!-- CONTENT -->
@yield('content')

<!-- SECTION CHAT -->
@if(!auth()->guest())
    @if(auth()->user()->isA('user'))
        <!-- sticky chat button -->
        <button class="btn btn-success" id="fixed-consul-btn" onclick="openForm()">
            <i class="fas fa-comment"></i>
        </button>
        <!-- end sticky chat button -->
{{--        @include('components.consultation')--}}
        <consultation user="{{auth()->id()}}" avatar="{{auth()->user()->avatar}}" name="{{auth()->user()->name}}"></consultation>
    @endif
@endif
<!-- END SECTION CHAT -->

<!-- FOOTER -->
@include('layouts.footer')
<!-- END FOOTER -->
</div>
<!-- loader -->
<script>window.token = "{{csrf_token()}}";</script>
@if(!auth()->guest())
    <script>window.role = "{{auth()->user()->roles[0]->name}}";</script>
@else
    <script>window.role = "guest";</script>
@endif
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/></svg></div>
<script src="{{mix('js/app.js')}}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/scrollax.min.js') }}"></script>
<script src="{{ asset('js/google-map.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- CONSULTATION SCRIPT JS -->
<script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
            $('#fixed-consul-btn').addClass('d-none');
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
            $('#fixed-consul-btn').removeClass('d-none');
        }
</script>
<!-- END CONSULTATION SCRIPT JS -->
@stack('scripts_addons')
@jquery
@toastr_js
@toastr_render
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif
@stack('scripts')
</body>

</html>
