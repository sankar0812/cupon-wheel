@extends('layouts.websiteapp')
@section('title', 'Home')
@section('websitecontent')
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url('{{ url('websiteasset/images/bg_1.jpg') }}');">

            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <span class="subheading">Welcome</span>
                        <h1 class="mb-4">The Best Coffee Testing Experience</h1>
                        <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the
                            necessary regelialia.</p>

                        <p>
                            @if (session()->has('customerid'))
                                <a href="{{ url('customer-shop') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order
                                    Now</a>
                            @else
                                <a href="{{ url('/customer-register') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order
                                    Now</a>
                            @endif

                            <a href="{{ url('/menu') }}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View
                                Menu</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image: url('{{ url('websiteasset/images/bg_2.jpg') }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <span class="subheading">Welcome</span>
                        <h1 class="mb-4">Amazing Taste &amp; Beautiful Place</h1>
                        <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the
                            necessary regelialia.</p>
                            <p>
                                @if (session()->has('customerid'))
                                    <a href="{{ url('customer-shop') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order
                                        Now</a>
                                @else
                                    <a href="{{ url('/customer-register') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order
                                        Now</a>
                                @endif

                                <a href="{{ url('/menu') }}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View
                                    Menu</a>
                            </p>
                    </div>

                </div>
            </div>
        </div>


        <div class="slider-item" style="background-image: url('{{ url('websiteasset/images/bg_3.jpg') }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <span class="subheading">Welcome</span>
                        <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
                        <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the
                            necessary regelialia.</p>
                            <p>
                                @if (session()->has('customerid'))
                                    <a href="{{ url('customer-shop') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order
                                        Now</a>
                                @else
                                    <a href="{{ url('/customer-register') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order
                                        Now</a>
                                @endif

                                <a href="{{ url('/menu') }}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View
                                    Menu</a>
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

    <section class="ftco-about d-md-flex">
        <div class="one-half img" style="background-image: url('{{ url('websiteasset/images/about.jpg') }}');"></div>
        <div class="one-half ftco-animate">
            <div class="overlap">
                <div class="heading-section ftco-animate ">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Our Story</h2>
                </div>
                <div>
                    <p class="text-white">On her way she met a copy. The copy warned the Little Blind Text, that where
                        it came from it
                        would have been rewritten a thousand times and everything that was left from its origin would be
                        the word "and" and the Little Blind Text should turn around and return to its own, safe country.
                        But nothing the copy said could convince her and so it didn’t take long until a few insidious
                        Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their
                        agency, where they abused her for their.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter ftco-bg-dark img" id="section-counter"
        style="background-image: url('{{ url('websiteasset/images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="100">0</strong>
                                    <span>Coffee Branches</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="85">0</strong>
                                    <span>Number of Awards</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="10567">0</strong>
                                    <span>Happy Customer</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                    <strong class="number" data-number="900">0</strong>
                                    <span>Staff</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4" class="colorchange">Best Coffee Sellers</h2>

                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img"
                            style="background-image: url('{{ url('websiteasset/images/menu-1.jpg') }}');"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#" class="colorchange">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            {{-- <p class="price"><span class="colorchange" class="colorchange">$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img"
                            style="background-image: url('{{ url('websiteasset/images/menu-2.jpg') }}');"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#" class="colorchange">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            {{-- <p class="price"><span class="colorchange" class="colorchange">$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img"
                            style="background-image: url('{{ url('websiteasset/images/menu-3.jpg') }}');"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#"class="colorchange">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            {{-- <p class="price"><span class="colorchange" class="colorchange">$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img"
                            style="background-image: url('{{ url('websiteasset/images/menu-4.jpg') }}');"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#" class="colorchange">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            {{-- <p class="price"><span class="colorchange" class="colorchange">$5.90</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- 
    <section class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 ftco-animate">
                    <a href="gallery.html" class="gallery img d-flex align-items-center"
                        style="background-image: url('{{ url('websiteasset/images/gallery-1.jpg') }}')">

                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="gallery.html" class="gallery img d-flex align-items-center"
                        style="background-image: url('{{ url('websiteasset/images/gallery-2.jpg') }}');">

                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="gallery.html" class="gallery img d-flex align-items-center"
                        style="background-image: url('{{ url('websiteasset/images/gallery-3.jpg') }}');">

                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="gallery.html" class="gallery img d-flex align-items-center"
                        style="background-image: url('{{ url('websiteasset/images/gallery-4.jpg') }}');">

                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section class="ftco-menu mb-5 pb-5">
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
                            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical">
                                @foreach ($data as $index => $datas)
                                    <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                        id="v-pills-1-tab{{ $datas->id }}" data-toggle="pill"
                                        href="#v-pills-1{{ $datas->id }}" role="tab"
                                        aria-controls="v-pills-1{{ $datas->id }}"
                                        aria-selected="{{ $index == 0 ? 'true' : 'false' }}">{{ $datas->cat_name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="tab-content ftco-animate" id="v-pills-tabContent">
                                @foreach ($data as $index => $datas)
                                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                        id="v-pills-1{{ $datas->id }}" role="tabpanel"
                                        aria-labelledby="v-pills-1-tab{{ $datas->id }}">
                                        <div class="row">
                                            @foreach ($datas->result as $datass)
                                                <div class="col-md-4 text-center">
                                                    <div class="menu-wrap">
                                                        <a href="#" class="menu-img img mb-4"
                                                            style="background-image: url({{ url('/uploads/product/', $datass->pro_file) }});"></a>
                                                        <div class="text">
                                                            <h3><a href="#"
                                                                    class="colorchange">{{ $datass->pro_name }}</a></h3>
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
    </section> --}}

    <section class="ftco-section img" id="ftco-testimony"
        style="background-image: url('{{ url('websiteasset/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Testimony</span>
                    <h2 class="mb-4">Customers Says</h2>

                </div>
            </div>
        </div>
        <div class="container-wrap">
            <div class="row d-flex no-gutters">
                <div class="col-lg align-self-sm-end ftco-animate">
                    <div class="testimony">
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an
                                almost unorthographic life One day however a small.&rdquo;</p>
                        </blockquote>
                        <div class="author d-flex mt-4">
                            <div class="image mr-3 align-self-center">
                                <img src="images/person_1.jpg" alt="">
                            </div>
                            <div class="name align-self-center">Louise Kelly <span class="position">Illustrator
                                    Designer</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg align-self-sm-end">
                    <div class="testimony overlay">
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an
                                almost unorthographic life One day however a small line of blind text by the name of
                                Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                        </blockquote>
                        <div class="author d-flex mt-4">
                            <div class="image mr-3 align-self-center">
                                <img src="images/person_2.jpg" alt="">
                            </div>
                            <div class="name align-self-center">Louise Kelly <span class="position">Illustrator
                                    Designer</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg align-self-sm-end ftco-animate">
                    <div class="testimony">
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an
                                almost unorthographic life One day however a small line of blind text by the name.
                                &rdquo;</p>
                        </blockquote>
                        <div class="author d-flex mt-4">
                            <div class="image mr-3 align-self-center">
                                <img src="images/person_3.jpg" alt="">
                            </div>
                            <div class="name align-self-center">Louise Kelly <span class="position">Illustrator
                                    Designer</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg align-self-sm-end">
                    <div class="testimony overlay">
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an
                                almost unorthographic life One day however.&rdquo;</p>
                        </blockquote>
                        <div class="author d-flex mt-4">
                            <div class="image mr-3 align-self-center">
                                <img src="images/person_2.jpg" alt="">
                            </div>
                            <div class="name align-self-center">Louise Kelly <span class="position">Illustrator
                                    Designer</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg align-self-sm-end ftco-animate">
                    <div class="testimony">
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an
                                almost unorthographic life One day however a small line of blind text by the name.
                                &rdquo;</p>
                        </blockquote>
                        <div class="author d-flex mt-4">
                            <div class="image mr-3 align-self-center">
                                <img src="images/person_3.jpg" alt="">
                            </div>
                            <div class="name align-self-center">Louise Kelly <span class="position">Illustrator
                                    Designer</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4">Recent from blog</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live the blind texts.</p>
                </div>
            </div>
            <div class="row d-flex">
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20"
                            style="background-image: url('{{ url('websiteasset/images/image_1.jpg') }}');">
                        </a>
                        <div class="text py-4 d-block">
                            <div class="meta">
                                <div><a href="#">Sept 10, 2018</a></div>
                                <div><a href="#">Admin</a></div>
                                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                            </div>
                            <h3 class="heading mt-2"><a href="#" class="colorchange">The Delicious Pizza</a>
                            </h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20"
                            style="background-image: url('{{ url('websiteasset/images/image_2.jpg') }}');">
                        </a>
                        <div class="text py-4 d-block">
                            <div class="meta">
                                <div><a href="#">Sept 10, 2018</a></div>
                                <div><a href="#">Admin</a></div>
                                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                            </div>
                            <h3 class="heading mt-2"><a href="#" class="colorchange">The Delicious Pizza</a>
                            </h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry align-self-stretch">
                        <a href="blog-single.html" class="block-20"
                            style="background-image: url('{{ url('websiteasset/images/image_3.jpg') }}');">
                        </a>
                        <div class="text py-4 d-block">
                            <div class="meta">
                                <div><a href="#">Sept 10, 2018</a></div>
                                <div><a href="#">Admin</a></div>
                                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                            </div>
                            <h3 class="heading mt-2"><a href="#" class="colorchange">The Delicious Pizza</a>
                            </h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
