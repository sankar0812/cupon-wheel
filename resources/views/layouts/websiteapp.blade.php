<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('websitefile.assetslink.style')
    @include('websitefile.assetslink.popmessage')
    <style>
        .bgcolor {
            background: #1131b2 !important;
        }
    </style>

</head>

<body>



    @include('websitefile.assetslink.navbar')
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

</body>


</html>
