@extends('layouts.app')

@section('content')
    @include('components.jumbotron',['title'=>'Edit Blog'])
    <section class="ftco-section" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form action="{{auth()->user()->isA('admin')?url('admin/update-blog',["id"=>$posts->id]):url('super/update-blog',["id"=>$posts->id])   }}" method="post" class="billing-form" enctype="multipart/form-data">
                        @csrf
                        <h3 class="mb-4 billing-heading">Blog</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" placeholder="" name="title" value="{{$posts->title}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input type="text" class="form-control" placeholder="" name="slug" value="{{$posts->slug}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tag</label>
                                    <input type="text" class="form-control" placeholder="" name="tag" value="{{$posts->tags[0]->name}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Category</label>
                                    <input type="text" class="form-control" placeholder="" name="category" value="{{$posts->topic[0]->name}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Photo</label>
                                    <input type="file" class="form-control" placeholder="" name="photo" value="{{$posts->featured_image}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="editor" id="editor" rows="10" cols="80"></textarea>
                                    <script>
                                        var editor = CKEDITOR.replace( 'editor' );
                                        editor.setData( '{!! $posts->body !!}' );
                                    </script>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4 d-flex justify-content-around">
                                    <a href="{{back()}}" class="btn btn-outline-danger py-3 px-4">Cancel</a>
                                    <button class="btn btn-outline-primary py-3 px-4"
                                            type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>--}}
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
@endpush
