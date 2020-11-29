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
                @if(!auth()->guest())
                    @if(auth()->user()->isA('admin') || auth()->user()->isA('super'))
                        <div class="col-lg-4 offset-8 ftco-animate">
                            <a href="{{url(auth()->user()->isA('admin')?url('admin/edit-blog',["id"=>$post->id]):url('super/edit-blog',["id"=>$post->id]))}}" class="btn btn-warning mb-3"><span><img src="{{asset('img/icons/edit-round.png')}}"
                                                                                                  alt="" class="admin_new_post_icon" width="20"></span> Edit this post</a>
                        </div>
                    @endif
                @endif
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

