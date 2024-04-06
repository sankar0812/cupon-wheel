<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('delivery.home') }}" class="text-info">Cup On wheel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('delivery.home') }}" class="text-info">C O W</a>
        </div>
        <ul class="sidebar-menu">

            {{-- <li class="menu-header">Dashboard</li> --}}

            {{-- <li>
                <a class="nav-link" href="{{ url('admin/dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li> --}}
            <li class="{{ request()->routeIs('delivery.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('delivery.home') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>



            <li class="dropdown {{ request()->routeIs('delivery.orderlist') || request()->routeIs('delivery.completedorder') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="ion-android-cart"></i>
                    <span>Order</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ request()->routeIs('delivery.orderlist') ? 'active' : '' }}"><a class="nav-link" href="{{ route('delivery.orderlist','All') }}">Today Order</a></li>
                    <li class="{{ request()->routeIs('delivery.completedorder') ? 'active' : '' }}"><a class="nav-link" href="{{ route('delivery.completedorder','All') }}">Delivered History</a></li>

                </ul>
            </li>


            <li class="{{ request()->routeIs('delivery.customerlist') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('delivery.customerlist', ['customerId' => "ALL"]) }}">
                    <i class="ion-android-checkbox-blank"></i>
                    <span>Container Detail</span>
                </a>
            </li>




            <li class="{{ request()->routeIs('delivery.profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('delivery.profile')}}">
                    <i class="ion-android-person"></i>
                    <span>Profile</span>
                </a>
            </li>

        </ul>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">

            <a class="btn btn-danger bgc btn-lg btn-block btn-icon-split" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

    </aside>
</div>