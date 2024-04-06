<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('websiteasset/images/final.png') }}"
                alt="" height="70"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}"
                        class="nav-link">Home</a></li>
                <li class="nav-item {{ request()->is('menu') ? 'active' : '' }}"><a href="{{ url('/menu') }}"
                        class="nav-link">Menu</a></li>
                <li class="nav-item {{ request()->is('services') ? 'active' : '' }}"><a href="{{ url('/services') }}"
                        class="nav-link">Services</a></li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="{{ url('/about') }}"
                        class="nav-link">About</a></li>
                {{-- <li class="nav-item {{ request()->is('shop') ? 'active' : '' }}"><a href="{{ url('/shop') }}" class="nav-link">Shop</a></li> --}}
                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}"
                        class="nav-link">Contact</a></li>
                @if (session()->has('customerid'))
                    <li class="nav-item"><a href="{{ url('customer-shop') }}" class="nav-link">Shop</a></li>
                @else
                    <li class="nav-item"><a href="{{ url('/customer-register') }}" class="nav-link">Register</a></li>
                @endif
                
                {{-- <li class="nav-item {{ request()->is('sign-up') ? 'active' : '' }}"><a href="{{ url('/sign-up') }}" class="nav-link">Register</a></li> --}}

                {{-- <li class="nav-item cart"><a href="cart.html" class="nav-link"><span
                            class="icon icon-shopping_cart"></span><span
                            class="bag d-flex justify-content-center align-items-center"><small>1</small></span></a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
