@extends('layouts.adminapp')
@section('title', 'Subscripton cancel')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customer Subscription cancel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">subscription cancel</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a>&nbsp; subscription cancel</h2>

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
                                                <th>Current Subscribe Plan</th>
                                                <th>Pending Amount</th>
                                                <th>Request Date</th>
                                                <th>Approved Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor
                                            @foreach ($subscancel as $subscancels)
                                                <tr>
                                                    <td>{{ ++$i }}
                                                    </td>
                                                    <td>{{ $subscancels->cust_businessname }}
                                                    </td>
                                                    <td>{{ $subscancels->cust_phone }}
                                                    </td>
                                                    <td class="text-danger">
                                                        {{ $subscancels->Sub_title }}
                                                    </td>
                                                    <td>{{ $subscancels->totalamount }} INR
                                                    </td>
                                                    <td>{{ $subscancels->subcan_datetime }}
                                                    </td>
                                                    <td>{{ $subscancels->subcan_apprdatetime }}
                                                    </td>
                                                    <td>
                                                        @if ($subscancels->subcan_status == 1)
                                                            <div class="badge badge-success">Approved</div>
                                                        @else
                                                            <a href="#"
                                                                onclick="confirmApprovalcan('{{ route('admin.cus_subscancelappro', $subscancels->cancel_id) }}')"
                                                                class="badge badge-warning">Approval</a>
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
