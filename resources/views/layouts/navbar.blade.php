<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Mahameru Hydrofarm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent"
                aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{url('/')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{url('/blog')}}" class="nav-link">Blog</a></li>
<<<<<<< HEAD
                <li class="nav-item"><a href="{{url('/shop')}}" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">About</a></li>
=======
                <li class="nav-item"><a href="{{url('/products')}}" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
>>>>>>> a6ce60989fa73572f2fe4ac47343eb486d96a0de
                @if(\Illuminate\Support\Facades\Auth::guest())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="cbAccount" role="button" data-toggle="dropdown"
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
                            @if(auth()->user()->isA('user'))
                                <a class="dropdown-item" href="{{route('user.profile.index')}}">My Profile</a>
                            @elseif(auth()->user()->isA('admin'))
                                <a class="dropdown-item" href="{{route('admin.profile.index')}}">My Profile</a>
                                <a class="dropdown-item" href="{{url('admin/transaction')}}">Transaction Data</a>
                            @elseif(auth()->user()->isA('super'))
                                    <a class="dropdown-item" href="{{url('super/transaction')}}">Transaction Data</a>
                                    <a class="dropdown-item" href="{{route('super.user-management.index')}}">User Management</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               data-toggle="modal" data-target="#logoutModal">
                                Logout
                            </a>
                        </div>
                    </li>
                <li class="nav-item cta cta-colored"><a href="{{url('user/cart')}}" class="nav-link"><span
                            class="icon-shopping_cart"></span>[@{{ totalCart }}]</a></li>
                <!-- END Ditamplikan saat user sudah login -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endif
            </ul>
        </div>
    </div>
</nav>
