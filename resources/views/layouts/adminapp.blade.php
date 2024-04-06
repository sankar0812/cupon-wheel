<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <!-- <style>
    .print-only {
        display: none;
    }
</style> -->

    <!-- General CSS Files -->
    @include('assetslink.style')
    <!-- /END GA -->
    @if (session('failed'))
    <div id="popup-message" class="popup-message">
        {{ session('failed') }}
    </div>
    @endif

    @if (session('success'))
    <div id="popup-message" class="popup-mess">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div id="error-popup" class="error-popup">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @stack('style')
</head>

<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li> --}}
                    </ul>

                </form>

                <ul class="navbar-nav navbar-right">
                    @if (auth()->user()->type == 'branchadmin')
                    <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li> -->
                    @elseif (auth()->user()->type == 'delivery')
                    {{-- @elseif (auth()->user()->type == 'clerk')
                    @include('include.sidebar.clerksidebar')
                @elseif (auth()->user()->type == 'frontoffice')
                    @include('include.sidebar.frontofficesidebar')
                @elseif (auth()->user()->type == 'accountant')
                    @include('include.sidebar.accountantsidebar') --}}

                    @else
                    return redirect()->route('home');
                    @endif
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ url('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                            @if((auth()->user()->type == 'delivery'))
                            <a href="{{route('delivery.profile')}}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                            {{-- <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a> --}}
                        </div>
                    </li>
                </ul>
            </nav>

            @if (auth()->user()->type == 'branchadmin')
            @include('assetslink.navbar')
            @elseif (auth()->user()->type == 'delivery')
            @include('assetslink.deliverynavbar')
            <li>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </li>
            {{-- @elseif (auth()->user()->type == 'clerk')
                @include('include.sidebar.clerksidebar')
            @elseif (auth()->user()->type == 'frontoffice')
                @include('include.sidebar.frontofficesidebar')
            @elseif (auth()->user()->type == 'accountant')
                @include('include.sidebar.accountantsidebar') --}}
            @else
            return redirect()->route('home');
            @endif

            <!-- Main Content -->
            @section('contentdashboard')

            @show
            @stack('other-scripts')
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 <div class="bullet"></div> Design By <a href=""></a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    @include('assetslink.script')
    <script src="/html5-qrcode.min.js"></script>
    <script>
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete" ||
                document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function() {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                // if (decodedText !== lastResult) {
                //     ++countResults;
                //     lastResult = decodedText;
                //     // Handle on success condition with the decoded message.
                //     console.log(`Scan result ${decodedText}`, decodedResult);

                //     // var newTab = window.open();
                //     //     newTab.document.write(`<h1>Scan Result</h1><p>${decodedText}</p>`);
                //     //     newTab.document.close();
                //     var form = document.createElement('form');
                //     form.setAttribute('method', 'get');
                //     form.setAttribute('action', 'delivery.orderlist'); // Replace '/your-route' with your actual route

                //     var inputDecodedText = document.createElement('input');
                //     inputDecodedText.setAttribute('type', 'hidden');
                //     inputDecodedText.setAttribute('value', decodedText);
                //     // Create an input element for the session parameter
                //     var input = document.createElement('input');
                //     input.setAttribute('type', 'hidden');
                //     input.setAttribute('name', 'ses'); // This is the name of the parameter
                //     input.setAttribute('value', decodedText); // This is the value of the parameter

                //     // Append the input element to the form
                //     form.appendChild(input);

                //     // Append the form to the document body
                //     document.body.appendChild(form);

                //     // Submit the form
                //     form.submit();
                // }
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    console.log(`Scan result ${decodedText}`, decodedResult);

                    // Construct the URL with the decodedText and orderId
                    var url = "{{ route('delivery.orderview', ['cust_id' => ':customerId', 'ses' => ':sessionId']) }}";
                    url = url.replace(':customerId', decodedText);
                    url = url.replace(':sessionId', "ALL");

                    // Open the URL in a new tab/window
                    window.open(url, '_blank');
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>
</body>

</html>