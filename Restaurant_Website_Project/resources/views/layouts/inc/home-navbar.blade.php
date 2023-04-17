<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>Restaurantly<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="/home">Home</a></li>
                <li><a href="/home#about">About</a></li>
                <li><a href="/menu">Menu</a></li>
                <li><a href="/events">Events</a></li>
                <li><a href="/chefs">Chefs</a></li>
                <li><a href="/gallery">Gallery</a></li>
                <li class="dropdown"><a href="#"><span>Sign In Or Sign Up</span> <i
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
                </li>
                <li><a href="/contact">Contact</a></li>
                <li><a class="text-primary" href="{{ url('cart') }}"><i class="bi bi-bag"></i></a></li>
                {{-- <li><button type="submit" class="btn btn-primary m-3" href="{{ url('cart') }}">buying <i class="bi bi-bag"></i></button></li> --}}
            </ul>
        </nav><!-- .navbar -->

        <a class="btn-book-a-table" href="{{ route('login') }}">Sign In</a>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header><!-- End Header -->
