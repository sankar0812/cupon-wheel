@extends('layouts.adminapp')
@section('title', 'Profile View')
@section('contentdashboard')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Profile Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Profile Details</div>
      </div>
    </div>

    <div class="section-body">


      <div class="row">
        <div class="col-md-8 ">

          <div class="card profile-widget ">
            <div class="profile-widget-header">
              <img alt="image" src="{{ url($profile->profile_path) }}" width="100px" height="100px" class="rounded-circle profile-widget-picture">
              <!-- <div class="profile-widget-items">
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label">Posts</div>
                  <div class="profile-widget-item-value">187</div>
                </div>
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label">Followers</div>
                  <div class="profile-widget-item-value">6,8K</div>
                </div>
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label">Following</div>
                  <div class="profile-widget-item-value">2,1K</div>
                </div>
              </div> -->
            </div>
            <div class="profile-widget-description">
              <div class="profile-widget-name">{{ $profile->name }}
                <div class="text-muted d-inline font-weight-normal">
                  <div class="slash"></div> Delivery Boy
                </div>
              </div>
              <h5 class="mt-5">Email : {{ $profile->email }}</h5>
              <h5  class="mt-3">Phone : {{ $profile->phone }}</h5>
              <h5  class="mt-3">Date of Birth : {{ $profile->dob }}</h5>
              <h5  class="mt-3">Address : {{ $profile->permanent_address }}</h5>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection