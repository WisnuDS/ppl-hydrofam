@extends('layouts.app')

@section('title')
    Blog
@endsection

@push('styles')
    <script src="https://kit.fontawesome.com/3aa0ba3511.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    @include('components.jumbotron',['title' => 'Blog'])
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                @if(!auth()->guest())
                    @if(auth()->user()->isA('admin') || auth()->user()->isA('super'))
                        <div class="col-lg-2 offset-10 ftco-animate">
                            <a href="{{url('admin/create-blog')}}" class="btn btn-outline-dark mb-3" style="width: 100%;"><span><img
                                        src="{{asset('img/icons/edit-round.png')}}" alt="" class="admin_new_post_icon" width="20"></span> New Post</a>
                        </div>
                    @endif
                @endif
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-md-12 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch d-md-flex">
                                <a href="{{url('/blog/'.$post->slug)}}" class="block-20" style="background-image: url('{{$post->featured_image}}');">
                                </a>
                                <div class="text d-block pl-md-4">
                                    <div class="meta mb-3">
                                        <div><span>{{date_format($post->published_at,'d M, Y')}}</span></div>
                                        <div><span>{{$post->user->username}}</span></div>
                                        <div><span class="icon-chat"></span>3</div>
                                    </div>
                                    <h3 class="heading"><a href="{{url('/blog/'.$post->slug)}}">{{$post->title}}</a></h3>
                                    <p>{{$post->summary}}</p>
                                    <p><a href="{{url('/blog/'.$post->slug)}}" class="btn btn-primary py-2 px-3">Read more</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!--End-->
                    </div>
                </div> <!-- .col-md-8 -->
                @include('components.sidebar', ["data" => $sidebar])
            </div>
        </div>
    </section> <!-- .section -->
@endsection

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        window.CanvasUI = @json($config);--}}
{{--    </script>--}}

{{--    <script src="{{ mix('js/app.js') }}"></script>--}}
{{--@endpush--}}
