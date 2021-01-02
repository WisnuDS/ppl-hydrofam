<!-- Navigation -->
<nav class="navbar navbar-expand-sm navbar-light p-5">
    <a class="navbar-brand" href="#"><span><img src="{{asset('img/Logo.png')}}" alt="logo"></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link active" href="{{url('/')}}">Home</a>
            <a class="nav-link" href="{{url('/blog')}}">Blog</a>
            <a class="nav-link" href="#">Products</a>
            <a class="nav-link" href="#">About</a>
        </div>
    </div>
</nav>

