@extends('layouts.adminapp')
@section('title', 'Deliver Boy')
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
            <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Profile</h2>


            <div class="card card-warning">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Profile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 0; $i++) @endfor @foreach($details as $detail) <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        {{$detail->name}}
                                    </td>
                                    <td>
                                        {{$detail->phone}}
                                    </td>
                                    <td>
                                        @if($detail->profile)
                                        <img alt="image" src="{{ url($detail->profile_path) }}" class="rounded-circle zoom" width="35" height="35" data-toggle="tooltip" title="{{ $detail->name }}">
                                        @else
                                        @endif
                                    </td>

                                    <td>
                                        @if ($detail->db_status == 1)
                                        <a href="{{ route('admin.deliveryboystatus', $detail->id) }}">
                                            <div class="badge badge-success">Active</div>
                                        </a>
                                        @else
                                        <a href="{{ route('admin.deliveryboystatus', $detail->id) }}">
                                            <div class="badge badge-danger">Deactive</div>
                                        </a>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="#" class="btn " data-toggle="modal" data-target="#categoryModal{{ $detail->id }}"><i class="ion-edit" data-pack="default" data-tags="change, update, write, type, pencil"></i></a>
                                        <a href="#" class="btn " data-toggle="modal" data-target="#categoryModaluser{{ $detail->id }}"><i class="ion-ios-personadd" style="font-size: 18px;" data-pack="default" data-tags="change, update, write, type, user"></i></a>
                                    </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@foreach($details as $detail)
<div class="modal fade" tabindex="-1" id="categoryModal{{ $detail->id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.deliveryprofilupdate',$detail->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-warning">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Profile Info</h6>
                        <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name" placeholder="Full Name" autocomplete="off" value="{{ $detail->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth" autocomplete="off" max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" value="{{ $detail->dob }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label><br>
                                <select id="gender" name="gender" class="form-control" autocomplete="off" required>
                                    <option value="" selected disabled hidden>Select Gender</option>
                                    <option value="male" {{ $detail->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $detail->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ $detail->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" value="{{ $detail->email }}" required>
                                <input type="hidden" name="d_id" value="{{ $detail->id }}">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="permanentaddress" class="form-label">Permanent Address <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="permanentaddress" placeholder="Enter Permanent Address" autocomplete="off" required>{{ $detail->permanent_address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="presentaddress" class="form-label">Present Address</label>
                                <textarea type="text" class="form-control" name="presentaddress" placeholder="Enter Present Address" autocomplete="off">{{ $detail->present_address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="phone" pattern="[0-9]{10}" maxlength="10" placeholder="Enter 10-digit Phone Number" autocomplete="off" title="Please enter a 10-digit number" value="{{ $detail->phone }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="bloodgroup" class="form-label">Blood Group</label>
                                <input type="text" class="form-control" name="bloodgroup" placeholder="Blood Group" autocomplete="off" value="{{ $detail->blood_group }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="fathername" class="form-label">Father Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fathername" placeholder="Father / Spouse Name" autocomplete="off" value="{{ $detail->father_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="mothername" class="form-label">Mother Name</label>
                                <input type="text" class="form-control" name="mothername" placeholder="Mother Name" autocomplete="off" value="{{ $detail->mother_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="profile" class="form-label">Profile</label>
                                <input type="hidden" name="profileold" value="{{ $detail->profile }}">
                                <input type="hidden" name="profile_pathold" value="{{ $detail->profile_path }}">
                                <input type="file" name="profile" accept="image/png, image/jpeg ,image/jpg" class="form-control" id="profile" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="licence" class="form-label">Licence (Pdf copy)</label>
                                <input type="hidden" name="licenceold" value="{{ $detail->licence }}">
                                <input type="hidden" name="licence_pathold" value="{{ $detail->licence_path }}">
                                <input type="file" class="form-control" name="licence" accept=".pdf" autocomplete="off" data-bs-backdrop="static">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-warning">
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Account Details</h5>
                        <small class="text-muted float-end"></small>
                        <small class="text-muted float-right" style="color: red !important;">If you Dont have Data to Enter leave that</small>
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="account_no" class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="account_no" value="{{ $detail->account_no }}" placeholder="Enter Account No" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                <input type="text" class="form-control" name="account_holder_name" value="{{ $detail->account_holder_name }}" placeholder="Enter Account Holder Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" value="{{ $detail->branch_name }}" placeholder="Branch Name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input type="text" class="form-control" name="branch_code" value="{{ $detail->branch_code }}" placeholder="Branch Code" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC Code" value="{{ $detail->ifsc_code }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="bank_address" class="form-label">Bank Address</label>
                                <textarea type="text" class="form-control" name="bank_address" placeholder="Enter Bank Address" autocomplete="off"> {{ $detail->bank_address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group ">
                        <button type="submit" class="btn btn-warning">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach($details as $detail)
<div class="modal fade" tabindex="-1" id="categoryModaluser{{ $detail->id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title">Login Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if($detail->user_id == null)
            <form action="{{ route('admin.deliverylogin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-warning">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Login Details</h5>
                        <small class="text-muted float-end"></small>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <div class="form-group ">
                                <label for="" class="form-label">User Email</label>
                                <input type="text" class="form-control" id="" name="useremail" placeholder="Enter Email" value="" autocomplete="off">
                                <input type="hidden" name="d_id" value="{{ $detail->id }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group ">
                                <label for="" class="form-label">Password</label>
                                <input type="text" class="form-control" id="" name="password" placeholder="password" value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col0"0>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-warning">Save <i class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @else
            <form action="{{ route('admin.deliveryloginupdate',$detail->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-warning">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Login Details</h5>
                        <small class="text-muted float-end"></small>
                    </div>
                    
                    <div class="card-body">
                        <div class="">
                            <div class="form-group ">
                                <label for="" class="form-label">User Email</label>
                                <input type="text" class="form-control" id="" name="useremail" placeholder="Enter Email" value="{{$detail->username}}" autocomplete="off">
                                <input type="hidden" name="d_id" value="{{ $detail->id }}">
                                <input type="hidden"  class="form-control" name="d_id" value="{{ $detail->id }}">
                                <input type="hidden"  class="form-control" name="user_id" value="{{ $detail->user_id }}">
                                <input type="hidden"  class="form-control" name="username" value="{{ $detail->name }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group ">
                                <label for="" class="form-label">Password</label>
                                <input type="text" class="form-control" id="" name="password" placeholder="password" value="{{$detail->password}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col0"0>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-warning">Update <i class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endforeach


@endsection