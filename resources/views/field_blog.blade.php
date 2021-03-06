@extends('layouts.app')

@section('content')
    @include('components.jumbotron',['title'=>'New Blog'])
    <section class="ftco-section" style="background-color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form action="{{auth()->user()->isA('admin')?url('admin/create-new-blog'):url('super/create-new-blog')}}" method="POST" class="billing-form" enctype="multipart/form-data">
                        @csrf
                        <h3 class="mb-4 billing-heading">Blog</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" placeholder="" name="title">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input type="text" class="form-control" placeholder="" name="slug">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tag</label>
                                    <input type="text" class="form-control" placeholder="" name="tag">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Category</label>
                                    <input type="text" class="form-control" placeholder="" name="category">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Photo</label>
                                    <input type="file" class="form-control" placeholder="" name="photo">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="content" id="editor" rows="20"></textarea>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4 d-flex justify-content-around">
                                    <a href="{{url('/blog')}}" class="btn btn-outline-danger py-3 px-4">Cancel</a>
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

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                height: '600px'
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
