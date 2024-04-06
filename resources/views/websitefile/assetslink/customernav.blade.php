<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light " id="ftco-navbar">
    <div class="container ">
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
                <li class="nav-item {{ request()->is('customer-shop') ? 'active' : '' }}"><a
                        href="{{ url('customer-shop') }}" class="nav-link">Shop</a></li>
                <li class="nav-item {{ request()->is('customer-payment') ? 'active' : '' }}"><a
                        href="{{ url('customer-payment') }}" class="nav-link">Payment</a></li>
                <li class="nav-item {{ request()->is('customer-pricing') ? 'active' : '' }}"><a
                        href="{{ url('customer-pricing') }}" class="nav-link">pricing</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><img src="{{ url('websiteasset/images/avatar-4.png') }}" alt="" class="rounded-circle mr-1" width="25" height="25"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href=""><i class="fa-solid fa-building"></i>&nbsp;
                            {{ session('customername') }}</a>
                        <a class="dropdown-item" href="{{ url('customer-profile') }}"><i class="fa-solid fa-user"></i>&nbsp; Profile</a>
                        @if (session()->has('customerid'))
                        <form action="{{ route('customer.logout') }}" method="POST">
                            @csrf <!-- Add CSRF token for security -->
                            <button type="submit" class="dropdown-item">
                                <i class="fa-solid fa-right-from-bracket"></i>&nbsp; logout
                            </button>
                        </form>

                        @else
                            <a href="{{ url('/customer-login') }}" class="dropdown-item"><i
                                    class="fa-solid fa-right-from-bracket"></i>&nbsp; login</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{--


<nav>
    <div class="nav-1">
        <div class="nav-main">
            <div class="nav-logo">
                <a href="{{ url('/') }}" class="nav-logo-img"><img
                        src="{{ url('websiteasset/images/final.png') }}" alt="" height="70"></a>
            </div>
            <ul>
                <li class="{{ request()->is('customerhome') ? 'active' : '' }}"><a
                        href="{{ url('/customerhome') }}">Home</a></li>
                <li class="{{ request()->is('order') ? 'active' : '' }}"><a href="{{ url('/order') }}">Order</a></li>
                <li class="{{ request()->is('payment') ? 'active' : '' }}"><a href="{{ url('/payment') }}">payment</a>
                </li>
                <li class="{{ request()->is('pricing') ? 'active' : '' }}"><a
                        href="{{ url('/pricing') }}">Subscription</a></li>
                <li class="{{ request()->is('signout') ? 'active' : '' }}"><a href="{{ url('/signout') }}">Signout</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="nav-2">
        <div class="nav-main">
            <ul>
                <li><a href="#">Start Scheduling</a></li>
            </ul>
            <div class="nav-mobile-menu" id="nav-mobile-menu">
                <img src="https://rvs-product-pricing-page.vercel.app/assets/Hamburger-Menu.svg" alt="">
            </div>
        </div>
    </div>
</nav>

<nav class="mobile-menu">
    <ul>
        <li><a href="{{ url('/customerhome') }}">Home</a></li>
        <li><a href="{{ url('/order') }}">Order</a></li>
        <li><a href="{{ url('/pricing') }}">Subscription</a></li>
        <li><a href="{{ url('/signout') }}">Signout</a></li>
    </ul>
</nav> --}}
