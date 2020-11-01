<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Mahameru Hydrofarm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{url('/blog')}}" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="shop.html" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">About</a></li>
                @if(\Illuminate\Support\Facades\Auth::guest())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="cbAccount" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Login/Register</a>
                    <div class="dropdown-menu" aria-labelledby="cbAccount">
                        <a class="dropdown-item" href="{{route('login')}}">Login</a>
                        <a class="dropdown-item" href="{{route('register')}}">Sign Up</a>
                    </div>
                </li>
                @endif
                @if(!\Illuminate\Support\Facades\Auth::guest())
                <!-- Ditamplikan saat user sudah login -->
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" id="cbAccount" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false">
                            @if(auth()->user()->avatar == null)
                                <span><img src="{{asset('img/avatar_default.png')}}" alt="Foto Profil" class="foto_profil_user"></span>
                            @else
                                <span><img src="/storage/{{auth()->user()->avatar}}" alt="Foto Profil" class="foto_profil_user"></span>
                            @endif
                            <span>{{explode(" ",auth()->user()->name)[0]}}</span>
                        </div>
                        <div class="dropdown-menu" aria-labelledby="cbAccount">
                            <a class="dropdown-item" href="{{route('user.profile.index')}}">My Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </div>
                    </li>
                <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span
                            class="icon-shopping_cart"></span>[0]</a></li>
                <!-- END Ditamplikan saat user sudah login -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endif
            </ul>
        </div>
    </div>
</nav>