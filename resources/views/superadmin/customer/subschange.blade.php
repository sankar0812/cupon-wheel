@extends('layouts.adminapp')
@section('title', 'Subscription change')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customer subscription change</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">subscription change</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a>&nbsp; subscription change</h2>
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
                                            @foreach ($subschange as $subschanges)
                                                <tr>
                                                    <td>{{ ++$i }}
                                                    </td>
                                                    <td>{{ $subschanges->cust_businessname }}
                                                    </td>
                                                    <td>{{ $subschanges->cust_phone }}
                                                    </td>
                                                    <td class="text-danger">
                                                        {{ $subschanges->Sub_title }}
                                                    </td>
                                                    <td>{{ $subschanges->totalamount }} INR
                                                    </td>
                                                    <td>{{ $subschanges->subcha_datetime }}
                                                    </td>
                                                    <td>{{ $subschanges->subcha_apprdatetime }}
                                                    </td>
                                                    <td>
                                                        @if ($subschanges->subcha_status == 1)
                                                        <div class="badge badge-success">Approved</div>
                                                    @else
                                                        <a href="#" onclick="confirmApprovalch('{{ route('admin.cus_subschangeappro', $subschanges->change_id) }}')" class="badge badge-warning">Approval</a>
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
