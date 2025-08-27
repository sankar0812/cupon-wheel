@extends('layouts.websiteapp')
@section('tilte','Contact')
@section('websitecontent')
@include('websitefile.assetslink.popmessage')
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url('{{ url('websiteasset/images/sna/ban1.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

          <div class="col-md-7 col-sm-12 text-center ftco-animate">
              <h1 class="mb-3 mt-5 bread">Contact Us</h1>
              <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span> <span>Contact</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
                  <div class="col-md-4 contact-info ftco-animate">
                      <div class="row">
                          <div class="col-md-12 mb-4">
                <h2 class="h4 colorchange" >Contact Information</h2>
              </div>
              <div class="col-md-12 mb-3">
                <p><span class="colorchange">Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
              </div>
              <div class="col-md-12 mb-3">
                <p><span class="colorchange">Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
              </div>
              <div class="col-md-12 mb-3">
                <p><span class="colorchange">Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
              </div>
              <div class="col-md-12 mb-3">
                <p><span class="colorchange">Website:</span> <a href="#">yoursite.com</a></p>
              </div>
                      </div>
                  </div>
                  <div class="col-md-1"></div>
        <div class="col-md-6 ftco-animate colorchange">
          <form action="#" class="contact-form">
              <div class="row">
                  <div class="col-md-6">
                  <div class="form-group ">
                    <input type="text" class="form-control" placeholder="Your Name" class="">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Your Email">
                  </div>
                  </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group">
              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31593.55077749857!2d77.44189859743652!3d8.18321819136189!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b04f180748734f9%3A0x5e1ae04e3f8e15c4!2sZi%20Cafe!5e0!3m2!1sen!2sin!4v1705139780694!5m2!1sen!2sin" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  @endsection
