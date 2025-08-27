<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('websitefile.assetslink.style')

</head>

<body>
    @include('websitefile.assetslink.customernav')
    <!-- END nav -->


    @section('websitecontent')

    @show


    @include('websitefile.assetslink.footer')
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    @include('websitefile.assetslink.script')
    @stack('other-scripts')
</body>

</html>




















{{--
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('websiteasset/css/customerstyle.css') }}">
</head>

<body>
    @include('websitefile.assetslink.customernav')

    @section('customercontent')
    @show
    @include('websitefile.assetslink.customerfooter')
    <script>
        const navEl = document.getElementById("nav-mobile-menu");
        const nav = document.getElementsByTagName("nav");

        navEl.addEventListener("click", () => {
            nav[1].classList.toggle("active");
        });

        const planBtn = document.getElementById("custom-checkbox");
        const plans = document.querySelectorAll(".pricing-body-plans > div");

        planBtn.addEventListener("click", function() {
            this.classList.toggle("anually");
            plans[0].classList.toggle("active");
            plans[1].classList.toggle("active");
        });
    </script>
</body>

</html> --}}
