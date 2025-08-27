@extends('layouts.adminapp')
@section('title', 'All-list')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customer All list</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">All list</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a>&nbsp; All List</h2>

                <div class="row">

                    <div class="col-12">
                        <div class="card card-warning">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Business Name</th>
                                                <th>contact Number</th>

                                                <th>Reg Date</th>
                                                <th>Login Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor

                                            @foreach ($allview as $alllists)
                                                <tr>
                                                    <td>{{ ++$i }}
                                                    </td>
                                                    <td>{{ $alllists->cust_businessname }}
                                                    </td>
                                                    <td>{{ $alllists->cust_phone }}
                                                    </td>

                                                    <td>{{ $alllists->cust_regdate }}
                                                    </td>
                                                    <td>
                                                        @if ($alllists->cust_loginacs == 1)
                                                        <a href="#" class="badge badge-success">Approved</a>
                                                        {{-- <a href="#" onclick="confirmApprove('{{ route('admin.custblock', $alllists->id) }}')" class="badge badge-success">Approved</a> --}}
                                                    @else
                                                        <a href="#" onclick="confirmApprove('{{ route('admin.custappro', $alllists->id) }}')" class="badge badge-warning">Pending</a>
                                                    @endif

                                                    </td>
                                                    <td> <i class="fa fa-eye text-success" aria-hidden="true"
                                                            data-toggle="modal"
                                                            data-target="#exampleModal{{ $alllists->id }}"
                                                            style="width:10px; height:10px;"></i>
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>


    @foreach ($allview as $alllists)
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal{{ $alllists->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Business Details</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <ul>
                            {{-- <li>Customer Id : <span class="text-danger">{{ $alllists->cust_id }}<span> </li><br> --}}
                            <li>Customer Name : <span class="text-danger">{{ $alllists->cust_businessname }}<span> </li>
                            <br>
                            <li>Contact Person : <span class="text-danger">{{ $alllists->cust_personname }}<span> </li><br>
                            <li>Mobile No. : <span class="text-danger"> +91 - {{ $alllists->cust_phone }}<span> </li><br>
                            <li>Delivery Address : <span class="text-danger">{{ $alllists->cust_deliveryaddress }}<span>
                            </li><br>
                            <li>Billing Address : <span class="text-danger">{{ $alllists->cust_billingaddress }}<span>
                            </li><br>
                            <li>Email Id : <span class="text-danger">{{ $alllists->cust_emailaddress }}<span> </li><br>
                            <li>Register date : <span class="text-danger">{{ $alllists->cust_regdate }}<span> </li><br>
                            {{-- <li>Branch : <span class="text-danger">{{ $alllists->branch_id }} </li><br> --}}
                            <li>Subscription Plan : <span class="text-danger">
                                    {{-- {{ $alllists->cust_subcplan }} --}}
                                    @foreach ($sub as $subscription)
                                        @if ($subscription->id == $alllists->cust_subcplan)
                                            {{ $subscription->Sub_title }}
                                        @endif
                                    @endforeach
                                    <span> </li>
                            <br>
                            <li>GST Number: <span class="text-danger">{{ $alllists->cust_gstnumber }}<span> </li>
                        </ul>
                    </div>
                    {{-- <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach
@endsection
