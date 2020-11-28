<div class="col-lg-4 sidebar ftco-animate">
    <div class="sidebar-box">
        <form action="#" class="search-form">
            <div class="form-group">
                <span class="icon ion-ios-search"></span>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
        </form>
    </div>
    <div class="sidebar-box ftco-animate">
        <h3 class="heading">Categories</h3>
        <ul class="categories">
            @foreach($data["topics"] as $topic)
            <li><a href="#">{{$topic->name}} <span>(12)</span></a></li>
            @endforeach
        </ul>
    </div>

    <div class="sidebar-box ftco-animate">
        <h3 class="heading">Recent Blog</h3>
        @foreach($data["recent"] as $recent)
        <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url('{{$recent->featured_image}}');"></a>
            <div class="text">
                <h3 class="heading-1"><a href="{{url('/blog/'.$recent->slug)}}">{{$recent->title}}</a></h3>
                <div class="meta">
                    <div><span class="icon-calendar"></span>{{$recent->publiched_at}}</div>
                    <div><span class="icon-person"></span>{{explode($recent->user->name)[0]}}</div>
                    <div><span class="icon-chat"></span>19</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="sidebar-box ftco-animate">
        <h3 class="heading">Tag Cloud</h3>
        <div class="tagcloud">
            @foreach($data["tags"] as $tag)
                <a href="#" class="tag-cloud-link">{{$tag->name}}</a>
            @endforeach
        </div>
    </div>

</div>
