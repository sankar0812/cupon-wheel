@extends('layouts.websiteapp')
@section('title', 'Menu')
@section('websitecontent')
@include('websitefile.assetslink.popmessage')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image:  url('{{ url('websiteasset/images/sna/ban1.jpg') }}');"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Our Menu</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                            <span>Menu</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro">
        <div class="container-wrap">
            <div class="wrap d-md-flex align-items-xl-end">
                <div class="info">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-phone"></span></div>
                            <div class="text">
                                <h3>000 (123) 456 7890</h3>
                                <p>A small river named Duden flows by their place and supplies.</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-my_location"></span></div>
                            <div class="text">
                                <h3>198 West 21th Street</h3>
                                <p> 203 Fake St. Mountain View, San Francisco, California, USA</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-clock-o"></span></div>
                            <div class="text">
                                <h3>Open Monday-Friday</h3>
                                <p>8:00am - 9:00pm</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @foreach ($data as $datas)
                    <div class="col-md-6 mb-5 pb-3">
                        <h3 class="mb-5 heading-pricing ftco-animate colorchange">{{ $datas->cat_name }}</h3>
                        @foreach ($datas->result as $datass)
                            <div class="pricing-entry d-flex ftco-animate">
                                <div class="img"
                                    style="background-image: url({{ url('/uploads/product/', $datass->pro_file) }});"></div>
                                <div class="desc pl-3">
                                    <div class="d-flex text align-items-center">
                                        <h3><span>{{ $datass->pro_name }}</span></h3>
                                        {{-- <span class="price">$20.00</span> --}}
                                    </div>
                                    <div class="d-block">
                                        <p>{{ $datass->pro_description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    <section class="ftco-menu mb-5 pb-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Our Products</h2>
                </div>
            </div>
            <div class="row d-md-flex">
                <div class="col-lg-12 ftco-animate p-md-5">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap mb-5">
                            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($data as $index => $datas)
                                    <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="v-pills-1-tab{{ $datas->id }}" data-toggle="pill" href="#v-pills-1{{ $datas->id }}" role="tab" aria-controls="v-pills-1{{ $datas->id }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">{{ $datas->cat_name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="tab-content ftco-animate" id="v-pills-tabContent">
                                @foreach ($data as $index => $datas)
                                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="v-pills-1{{ $datas->id }}" role="tabpanel" aria-labelledby="v-pills-1-tab{{ $datas->id }}">
                                        <div class="row">
                                            @foreach ($datas->result as $datass)
                                                <div class="col-md-4 text-center">
                                                    <div class="menu-wrap">
                                                        {{-- <img src="{{ url('/uploads/product/', $datass->pro_file) }}" alt="" class="menu-img img mb-4"> --}}
                                                        <a href="#" class="menu-img img mb-4" style="background-image: url({{ url('/uploads/product/', $datass->pro_file) }});"></a>
                                                        <div class="">
                                                            <h3><a href="#" class="">{{ $datass->pro_name }}</a></h3>
                                                            <p>{{ $datass->pro_description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
