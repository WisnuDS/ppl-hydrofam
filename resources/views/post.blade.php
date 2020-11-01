@extends('layouts.app')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    @include('components.jumbotron', ['title'=>$post->title])
    <div id="blog">
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">

                <!-- BLOG SECTION -->
                <div class="col-lg-8 ftco-animate">
                    {!! $post->body !!}
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            @foreach($post->tags as $tag)
                            <a href="#" class="tag-cloud-link">{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>

                    <!-- COMMENT SECTION -->
                    <div class="pt-5 mt-5">
                        <comment post-id="{{$post->id}}" guest="{{auth()->guest()}}"></comment>
                        <!-- END comment-list -->

                    </div>
                    <!-- END COMMENT SECTION -->
                </div>
                <!-- END BLOG SECTION -->
                @include('components.sidebar',["data" => $sidebar])
            </div>
        </div>
    </section>
    </div>
@endsection
@push('scripts')
    <script>window.token = "{{csrf_token()}}";</script>
    <script src="{{asset('js/app.js')}}"></script>
@endpush
