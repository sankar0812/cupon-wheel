@extends('layouts.adminapp')
@section('title', 'Payment history')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customer payment</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">payment list</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"> <i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a> payment List</h2>

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
                                                <th>Contact Number</th>
                                                <th>Subscription plan</th>
                                                <th>Last Payment Date</th>
                                                <th>Total amount</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor
                                            @foreach ($customerview as $details)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $details->cust_businessname }}</td>
                                                    <td>{{ $details->cust_phone }}</td>
                                                    <td class="text-warning"> {{ $details->Sub_title }}
                                                    </td>
                                                    <td>{{ $details->date }}</td>
                                                    <td>{{ $details->totalamount }} INR</td>
                                                    <td>
                                                        @if ($details->cust_status == 1)
                                                            <a href="#"
                                                                onclick="confirmApprove('{{ route('admin.custloginblock', $details->custid) }}')"
                                                                class="badge badge-success">Approved</a>
                                                        @else
                                                            <a href="#"
                                                                onclick="confirmApprove('{{ route('admin.custloginblock', $details->custid) }}')"
                                                                class="badge badge-danger">Block</a>
                                                        @endif
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


@endsection
