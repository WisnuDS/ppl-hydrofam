@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/message.css')}}">
@endpush
@section('content')
<!-- ADMIN MESSAGE -->
    <chat user="{{auth()->id()}}" avatar="{{auth()->user()->avatar}}"></chat>
    <!-- END ADMIN MESSAGE -->
@endsection

@push('scripts_addons')
<script>
        $(document).ready(function () {
            if (check680px()) {
                $('.chat_list.active_chat').removeClass('active_chat');
            }
        });
        $(document).on("click", ".chat_list", function () {
            if (check680px()) {
                $('.chat_list.active_chat').removeClass('active_chat');
                $(this).addClass('active_chat');
                $('.mesgs').css("display", "block");
                $('.inbox_people').css("display", "none");
                $('#btn-back-msg').removeClass('d-none');
            } else {
                $('.chat_list.active_chat').removeClass('active_chat');
                $(this).addClass('active_chat');
            }
        });
        $('#btn-back-msg').on("click", function () {
            $('#btn-back-msg').addClass('d-none');
            $('.mesgs').css("display", "none");
            $('.inbox_people').css("display", "block");
        });
        function check680px() {
            if ($(".mesgs").css("display") == "none") {
                return true;
            } else {
                return false
            }
        }
</script>
@endpush
