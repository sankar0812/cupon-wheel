@extends('layouts.customerapp')
@section('title', 'Customer Profile')
@section('websitecontent')
@include('websitefile.assetslink.popmessage')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 ftco-animate">
                    <div class="billing-form ftco-bg-dark p-3 p-md-5">
                        <h3 class="mb-4 billing-heading">Profile</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Business Name</label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->cust_businessname }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contact person name</label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->cust_personname }}</h6>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Delivery Address</label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->cust_deliveryaddress }}</h6>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Billing Address</label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->cust_billingaddress }}</h6>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="towncity">Email </label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->cust_emailaddress }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Contact Number</label>
                                    <h6>&nbsp;&nbsp;&nbsp;+91 {{ $profiledetails->cust_phone }}</h6>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">GST Number</label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->cust_gstnumber }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">subscribe Plan</label>
                                    <h6>&nbsp;&nbsp;&nbsp;
                                        @if ($subname && $subname->Sub_title)
                                        {{ $subname->Sub_title }}
                                    @endif

                                    </h6>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Branch</label>
                                    <h6>&nbsp;&nbsp;&nbsp;{{ $profiledetails->branch_id }}</h6>
                                </div>
                            </div> --}}
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        <label class="mr-3">
                                            <form action="{{ route('customer.subchange') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="customerid" value="{{ $profiledetails->id }}" />
                                                <input type="hidden" name="subscriptionid"
                                                    value="{{ $profiledetails->cust_subcplan }}" />
                                                <input type="hidden" name="branch_id" id=""
                                                    value="{{ $profiledetails->branch_id }}">
                                                {{-- <button type="submit" class="btn btn-primary">&nbsp;Change Subscribe Plan</button> --}}
                                                <button type="submit" class="btncus"></button> &nbsp;Change Subscribe Plan
                                            </form>

                                        </label>

                                        <label>
                                            <form action="{{ route('customer.subcriptioncancel') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="customerid"
                                                    value="{{ $profiledetails->id }}" />
                                                <input type="hidden"
                                                    name="subscriptionid"value="{{ $profiledetails->cust_subcplan }}" />
                                                <input type="hidden" name="branch_id" id=""
                                                    value="{{ $profiledetails->branch_id }}">
                                                <button type="submit" class="btncus"></button> &nbsp;Cancel Subscribe
                                            </form>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- END -->

                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->


@endsection
