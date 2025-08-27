@extends('layouts.adminapp')
@section('title', 'Delivery Boy')
@section('contentdashboard')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile Add</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile Add</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Profile </h2>

            <form class="row g-3" action="{{route('admin.deliveryprofilestore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-warning">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Profile Info</h6>
                        <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body row g-3">

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name" id="" placeholder="Full Name" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="dob" id="" placeholder="Full Name" autocomplete="off" max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select id="" name="gender" class="form-control select2" autocomplete="off" required>
                                    <option value="" selected disabled hidden>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="" placeholder="Email" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">permanent address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="permanentaddress" id="" placeholder="Enter Permanent Address" autocomplete="off" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">present address</label>
                                <textarea type="text" class="form-control" name="presentaddress" id="" placeholder="Enter Present Address" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" pattern="[0-9]{10}" maxlength="10" placeholder="Enter 10-digit Phone Number" autocomplete="off" title="Please enter a 10-digit number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">blood group</label>
                            <div class="form-group ">
                                <input type="text" class="form-control" name="bloodgroup" id="" placeholder="Blood Group" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Father Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fathername" id="" placeholder="Father / Spouse Name" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Mother name </label>
                                <input type="text" class="form-control" name="mothername" id="" placeholder="Mother Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">profile</label>
                                <input type="file" name="profile" accept="image/png, image/jpeg ,image/jpg" class="form-control" id="profile" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Licence (Pdf copy)</label>
                                <input type="file" class="form-control" id="" name="licence" accept=".pdf" autocomplete="off" data-bs-backdrop="static">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-warning">
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Account Details</h5>
                        <small class="text-muted float-end"></small>
                        <small class="text-muted float-right" style="color: red !important;">If you Don't have Data to Enter
                            leave that</small>
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="account_no" placeholder="Enter Account No" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Account Holder Name</label>
                                <input type="text" class="form-control" id="" name="account_holder_name" placeholder="Enter Account Holder Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="" name="branch_name" placeholder="Branch Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Branch Code</label>
                                <input type="text" class="form-control" id="" name="branch_code" placeholder="Branch Code" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control" id="" name="ifsc_code" placeholder="IFSC Code" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class="form-label">Bank Address</label>
                                <textarea type="text" class="form-control" name="bank_address" id="" placeholder="Enter Bank Address" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group ">
                                <button type="submit" class="btn btn-warning">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                    </div>


                </div>

            </form>
        </div>
    </section>
</div>
@endsection