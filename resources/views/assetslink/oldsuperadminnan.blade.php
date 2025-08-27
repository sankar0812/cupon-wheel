<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('superadmin.home') }}" class="text-info">Cup On wheel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('superadmin.home') }}" class="text-info">C O W</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>

            {{-- <li>
                <a class="nav-link" href="{{ url('admin/dashboard') }}"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li> --}}
            <li class="{{ request()->routeIs('superadmin.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('superadmin.home') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Starter</li>

            <li class="{{ request()->routeIs('superadmin.subscriptionplan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('superadmin.subscriptionplan') }}">
                    <i class="fas fa-fire"></i>
                    <span>Subscription Plan</span>
                </a>
            </li>

            <li
                class="dropdown {{ request()->routeIs('superadmin.cus_alllist') || request()->routeIs('superadmin.cus_approvallist') || request()->routeIs('superadmin.cus_blockllist') || request()->routeIs('superadmin.cus_paymenthistory') || request()->routeIs('superadmin.cus_subschange') || request()->routeIs('superadmin.cus_subscancel') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                    <span>Customer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('superadmin.cus_subschange') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('superadmin.cus_subschange') }}">Subscription Change</a>
                    </li>
                    <li class="{{ request()->routeIs('superadmin.cus_subscancel') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('superadmin.cus_subscancel') }}">Subscription Cancel</a>
                    </li>
                    <li class="{{ request()->routeIs('superadmin.cus_alllist') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('superadmin.cus_alllist') }}">Customer View</a></li>
                    {{-- <li class="{{ request()->routeIs('superadmin.cus_approvallist') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('superadmin.cus_approvallist') }}">Approval List</a></li> --}}
                    <li class="{{ request()->routeIs('superadmin.cus_blockllist') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('superadmin.cus_blockllist') }}">Block Customer</a></li>
                    <li class="{{ request()->routeIs('superadmin.cus_paymenthistory') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('superadmin.cus_paymenthistory') }}">Payment history</a>
                    </li>

                </ul>
            </li>

            <li
                class="dropdown {{ request()->routeIs('superadmin.category') || request()->routeIs('superadmin.menu') || request()->routeIs('superadmin.product') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Product Maintains</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('superadmin.category') ? 'active' : '' }}"><a
                            href="{{ route('superadmin.category') }}">Category</a></li>

                    <li class="{{ request()->routeIs('superadmin.product') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('superadmin.product') }}">Product</a></li>
                    <li class="{{ request()->routeIs('superadmin.menu') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('superadmin.menu') }}">Menu</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('superadmin.stockcontainers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('superadmin.stockcontainers') }}">
                    <i class="far fa-file-alt"></i>
                    <span>Stock (Containers)</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('superadmin.deliveryprofileindex') || request()->routeIs('superadmin.deliveryprofilecreate') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i>
                    <span> Delivery</span></a>
                    <ul class="dropdown-menu">

                    <li class="{{ request()->routeIs('superadmin.deliveryprofilecreate') ? 'active' : '' }}"><a class="nav-link" href="{{ url('superadmin-deliveryboy-profileadd') }}">Profile Create</a></li>
                    <li class="{{ request()->routeIs('superadmin.deliveryprofileindex') ? 'active' : '' }}"><a class="nav-link" href="{{ url('superadmin-deliveryboy-profileindex') }}">Profile View</a></li>

                </ul>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('forgot-password') }}">Banner</a></li>
                    <li><a class="nav-link" href="{{ url('profile') }}">Profile</a></li>
                </ul>
            </li>
            <li class="dropdown  {{request()->routeIs('superadmin.confirmorder') ||  request()->routeIs('superadmin.todayorder') || request()->routeIs('superadmin.additionalorder')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('superadmin.confirmorder') ? 'active' : '' }}"><a href="{{ route('superadmin.confirmorder') }}">Confirmation Order</a></li>
                    <li class="{{ request()->routeIs('superadmin.todayorder') ? 'active' : '' }}"><a href="{{ route('superadmin.todayorder') }}">Today Order</a></li>
                    <li class="{{ request()->routeIs('superadmin.additionalorder') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.additionalorder') }}">Additional Order</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Reporting</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('forgot-password') }}">Banner</a></li>
                    <li><a class="nav-link" href="{{ url('profile') }}">Profile</a></li>
                </ul>
            </li>



            {{-- <li class="menu-header">Pages</li>
            <li class="dropdown {{ request()->routeIs('superadmin.profile') || request()->routeIs('superadmin.forgotpassword')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                    <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('superadmin.forgotpassword') ? 'active' : '' }}"><a href="{{ route('superadmin.forgotpassword') }}">Forgot Password</a></li>
                    <li class="{{ request()->routeIs('superadmin.profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('superadmin.profile') }}">Profile</a></li>
                </ul>
            </li> --}}

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            {{-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a> --}}

            <a class="btn btn-danger bgc btn-lg btn-block btn-icon-split" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </aside>
</div>
