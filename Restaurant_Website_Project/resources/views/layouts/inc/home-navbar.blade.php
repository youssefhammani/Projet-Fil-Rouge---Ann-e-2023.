<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ 'home' }}" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>Restaurantly<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li ><a href="{{ url('/home') }}">Home</a></li>
                <li><a class="{{ request()->is('home#about') ? 'active' : '' }}" href="{{ url('/home#about') }}">About</a></li>
                <li><a class="{{ request()->is('menu') ? 'active' : '' }}" href="{{ url('/menu') }}">Menu</a></li>
                {{-- <li><a href="/events">Events</a></li> --}}
                <li><a class="{{ request()->is('chefs') ? 'active' : '' }}" href="{{ url('/chefs') }}">Chefs</a></li>
                <li><a class="{{ request()->is('gallery') ? 'active' : '' }}" href="{{ url('/gallery') }}">Gallery</a></li>
                <li><a class="{{ request()->is('book-a-table') ? 'active' : '' }}" href="{{ url('/book-a-table') }}">Book a table</a></li>
                {{-- <li class="dropdown"><a href="#"><span>Sign In Or Sign Up</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="/login">Sign IN</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="#"></a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> --}}
                <li><a class="{{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a></li>
                <li><a class="text-primary" href="{{ url('cart') }}"><i class="bi bi-bag"></i></a></li>
                {{-- <li><button type="submit" class="btn btn-primary m-3" href="{{ url('cart') }}">buying <i class="bi bi-bag"></i></button></li> --}}
            </ul>
        </nav><!-- .navbar -->

        @if (Route::has('login'))
            @auth
                <div class="nav-item dropdown float-right mb-4" style="margin-top: 0.7cm">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2"
                            src="https://intranet.youcode.ma/storage/users/profile/361-1662647721.JPG" alt=""
                            style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="{{ url('Profile/'.Auth::user()->id) }}" class="dropdown-item">My Profile</a>
                        @auth
                            @if (auth()->user()->role == 'admin')
                                <a href="{{ url('admin/dashboard') }}" class="dropdown-item">dashboard</a>
                            @endif
                        @endauth
                        <a href="{{ url('/buying1') }}" class="dropdown-item">order tracking</a>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">Log
                            Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a class="btn-book-a-table" href="{{ route('login') }}">Sign In</a>
                <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            @endif
        @endauth
    </div>
    
</header>
