<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.home') }}" class="text-warning">Cup On wheel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.home') }}" class="text-warning">C O W</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>

            {{-- <li>
                <a class="nav-link" href="{{ url('admin/dashboard') }}"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li> --}}
            <li class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Starter</li>

            <li class="{{ request()->routeIs('admin.subscriptionplan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.subscriptionplan') }}">
                    <i class="fas fa-fire"></i>
                    <span>Subscription Plan</span>
                </a>
            </li>

            <li
                class="dropdown {{ request()->routeIs('admin.cus_alllist') || request()->routeIs('admin.cus_approvallist') || request()->routeIs('admin.cus_blockllist') || request()->routeIs('admin.cus_paymenthistory') || request()->routeIs('admin.cus_subschange') || request()->routeIs('admin.cus_subscancel') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i>
                    <span>Customer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.cus_subschange') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.cus_subschange') }}">Subscription Change</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.cus_subscancel') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.cus_subscancel') }}">Subscription Cancel</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.cus_alllist') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.cus_alllist') }}">Customer View</a></li>
                    {{-- <li class="{{ request()->routeIs('admin.cus_approvallist') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.cus_approvallist') }}">Approval List</a></li> --}}
                    <li class="{{ request()->routeIs('admin.cus_blockllist') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.cus_blockllist') }}">Block Customer</a></li>
                    <li class="{{ request()->routeIs('admin.cus_paymenthistory') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.cus_paymenthistory') }}">Payment history</a>
                    </li>

                </ul>
            </li>

            <li
                class="dropdown {{ request()->routeIs('admin.category') || request()->routeIs('admin.menu') || request()->routeIs('admin.product') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Product Maintains</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.category') ? 'active' : '' }}"><a
                            href="{{ route('admin.category') }}">Category</a></li>

                    <li class="{{ request()->routeIs('admin.product') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.product') }}">Product</a></li>
                    <li class="{{ request()->routeIs('admin.menu') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.menu') }}">Menu</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.stockcontainers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.stockcontainers') }}">
                    <i class="far fa-file-alt"></i>
                    <span>Stock (Containers)</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.deliveryprofileindex') || request()->routeIs('admin.deliveryprofilecreate') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i>
                    <span> Delivery</span></a>
                    <ul class="dropdown-menu">

                    <li class="{{ request()->routeIs('admin.deliveryprofilecreate') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.deliveryprofilecreate') }}">Profile Create</a></li>
                    <li class="{{ request()->routeIs('admin.deliveryprofileindex') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.deliveryprofileindex') }}">Profile View</a></li>

                </ul>
                {{-- <ul class="dropdown-menu">
                    <li><a href="{{ url('forgot-password') }}">Banner</a></li>
                    <li><a class="nav-link" href="{{ url('profile') }}">Profile</a></li>
                </ul> --}}
            </li>
            <li class="dropdown  {{request()->routeIs('admin.confirmorder') ||  request()->routeIs('admin.todayorder') || request()->routeIs('admin.additionalorder')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.confirmorder') ? 'active' : '' }}"><a href="{{ route('admin.confirmorder') }}">Confirmation Order</a></li>
                    <li class="{{ request()->routeIs('admin.todayorder') ? 'active' : '' }}"><a href="{{ route('admin.todayorder') }}">Today Order</a></li>
                    <li class="{{ request()->routeIs('admin.additionalorder') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.additionalorder') }}">Additional Order</a></li>
                </ul>
            </li>
            <li class="dropdown  {{request()->routeIs('admin.subscribersPerMonth') ||  request()->routeIs('admin.paymentreport') || request()->routeIs('admin.deliveryreport') || request()->routeIs('admin.invoicereport') || request()->routeIs('admin.containerreport')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Reporting</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.deliveryreport') ? 'active' : '' }}"><a href="{{ route('admin.deliveryreport', ['detail' =>"ALL"]) }}">Delivery Boy Report</a></li>
                    <li class="{{ request()->routeIs('admin.subscribersPerMonth') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscribersPerMonth') }}">Subscribe</a></li>
                    <li class="{{ request()->routeIs('admin.paymentreport') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.paymentreport', ['detail' =>"ALL"]) }}">Payment</a></li>
                    <li class="{{ request()->routeIs('admin.containerreport') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.containerreport', ['detail' =>"ALL"]) }}">Container Report</a></li>
                    <li class="{{ request()->routeIs('admin.invoicereport') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.invoicereport', ['detail' =>"ALL"]) }}">Invoice Report</a></li>
                </ul>
            </li>



            {{-- <li class="menu-header">Pages</li>
            <li class="dropdown {{ request()->routeIs('admin.profile') || request()->routeIs('admin.forgotpassword')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                    <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.forgotpassword') ? 'active' : '' }}"><a href="{{ route('admin.forgotpassword') }}">Forgot Password</a></li>
                    <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.profile') }}">Profile</a></li>
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
