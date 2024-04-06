@extends('layouts.adminapp')
@section('title', 'Today Order')
@section('contentdashboard')
    <div class="main-content">
        {{-- <p id="time"></p>
<p id="ampm"></p> --}}
        <section class="section">
            <div class="section-header">
                <h1>Today order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Today Order</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a> Today Order</h2>

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card card-warning">

                            <div class="card-body ">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ $ampm == 'AM' ? 'active' : '' }}" id="home-tab"
                                            data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                            aria-selected="{{ $ampm == 'AM' ? 'true' : 'false' }}">Morning</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $ampm == 'PM' ? 'active' : '' }}" id="profile-tab"
                                            data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                            aria-selected="{{ $ampm == 'PM' ? 'true' : 'false' }}">Evening</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade {{ $ampm == 'AM' ? 'show active' : '' }}" id="home"
                                        role="tabpanel" aria-labelledby="home-tab">

                                        <div class="table-responsive">
                                            <table class="table  table-bordered table-md border-warning">
                                                {{-- id="table-2" --}}
                                                <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Company Name</th>
                                                        <th>Phone</th>
                                                        <th>Category</th>
                                                        <th>Quantity</th>
                                                        <th>Quantity count</th>
                                                        <th>Sugar Type</th>
                                                        <th>Amount</th>
                                                        <th>Session</th>
                                                        <th>Order Type</th>
                                                        <th>Delivery Man</th>
                                                        <th>Packing Status</th>
                                                        <th>Delivery Status</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < 1; $i++)
                                                    @endfor
                                                    @foreach ($order_mon as $order_mons)
                                                        <tr>

                                                            @if ($order_mons->ord_deliverystatus == 'DELIVERED')
                                                                <td></td>
                                                            @else
                                                                <td>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="inlineCheckbox1" name="orderlistid[]"
                                                                        value="{{ $order_mons->orderlist_mainid }}">
                                                                </td>
                                                            @endif


                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $order_mons->cust_businessname }}</td>
                                                            <td>{{ $order_mons->cust_phone }}</td>
                                                            <td>{{ $order_mons->cat_name }}</td>
                                                            <td>{{ $order_mons->capa_lit }}</td>
                                                            <td>{{ $order_mons->ord_quantitycount }}</td>
                                                            <td>{{ $order_mons->ord_sugartype }}</td>
                                                            <td>{{ $order_mons->ord_amount }}</td>
                                                            <td>
                                                                @if ($order_mons->ord_session == 'MOR')
                                                                    <p class="text-danger">Morning</p>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($order_mons->ord_ordertype == 'DAILY')
                                                                    <p class="badge badge-success">DLY</p>
                                                                @elseif ($order_mons->ord_ordertype == 'ADDITIONAL')
                                                                    <div class="badge badge-danger">ADL</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @foreach ($order_mons->result as $results)
                                                                    {{ $results->name }}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @if ($order_mons->ord_packingstatus == 'PENDING')
                                                                    <a
                                                                        href="{{ route('admin.packingstatus_run', $order_mons->orderlist_mainid) }}">
                                                                        <div class="badge badge-warning">Pending</div>
                                                                    </a>
                                                                @elseif ($order_mons->ord_packingstatus == 'RUNNING')
                                                                    <a
                                                                        href="{{ route('admin.packingstatus_complete', $order_mons->orderlist_mainid) }}">
                                                                        <div class="badge badge-info">running</div>
                                                                    </a>
                                                                @elseif ($order_mons->ord_packingstatus == 'COMPLETE')
                                                                    <div class="badge badge-success">Completed</div>
                                                                @elseif ($order_mons->ord_packingstatus == 'REJECTED')
                                                                    <div class="badge badge-danger">Rejected</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($order_mons->ord_deliverystatus == 'PENDING')
                                                                    <div class="badge badge-warning">Pending</div>
                                                                @elseif ($order_mons->ord_deliverystatus == 'RUNNING')
                                                                    <div class="badge badge-info">Running</div>
                                                                @elseif ($order_mons->ord_deliverystatus == 'DELIVERED')
                                                                    <div class="badge badge-success">Delivered</div>
                                                                @elseif ($order_mons->ord_deliverystatus == 'REJECTED')
                                                                    <div class="badge badge-danger">Rejected</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($order_mons->ord_packingstatus == 'RUNNING' || $order_mons->ord_packingstatus == 'COMPLETE')
                                                                    <li onclick="printDiv()"
                                                                        class="ion-android-print iconsize"
                                                                        data-pack="android" data-tags=""></li>
                                                                @endif
                                                                <div class="row1" style="display: none;">
                                                                    <div class="row print-only" style="display: flex;">
                                                                        <div class="col-md-6"><img
                                                                                src="{{ url('qrcodes/' . $order_mons->qrcode) }}"
                                                                                height="20" width="20"
                                                                                alt="">
                                                                            <h6
                                                                                style="margin: 0; padding: 0; font-size: 3px;">
                                                                                {{ $order_mons->cust_deliveryaddress }}
                                                                            </h6>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <h6
                                                                                style="margin: 0; padding: 0; font-size: 3px;">
                                                                                Order
                                                                                id:{{ $order_mons->orderlist_mainid }}
                                                                            </h6>
                                                                            <h6
                                                                                style="margin: 0; padding: 0; font-size: 3px;">
                                                                                {{ $order_mons->cat_name }}
                                                                                {{ $order_mons->ord_sugartype }}</h6>
                                                                            <h6
                                                                                style="margin: 0; padding: 0; font-size: 3px;">
                                                                                {{ $order_mons->cust_businessname }}
                                                                            </h6>
                                                                            <h6
                                                                                style="margin: 0; padding: 0; font-size: 3px;">
                                                                                {{ $order_mons->capa_lit }}</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ $ampm == 'PM' ? 'show active' : '' }}" id="profile"
                                        role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="table-responsive">
                                            <table class="table  table-bordered table-md"> {{-- id="table-1" --}}
                                                <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Company Name</th>
                                                        <th>Phone</th>
                                                        <th>Category</th>
                                                        <th>Quantity</th>
                                                        <th>Quantity count</th>
                                                        <th>Sugar Type</th>
                                                        <th>Amount</th>
                                                        <th>Session</th>
                                                        <th>Order Type</th>
                                                        <th>Delivery Man</th>
                                                        <th>Packing Status</th>
                                                        <th>Delivery Status</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @for ($i = 0; $i < 1; $i++)
                                                            @endfor @foreach ($order_eve as $order_eves)
                                                    <tr>
                                                        @if ($order_eves->ord_deliverystatus == 'DELIVERED')
                                                            <td></td>
                                                        @else
                                                            <td>
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="inlineCheckbox1" name="orderlistid[]"
                                                                    value="{{ $order_eves->orderlist_mainid }}">

                                                            </td>
                                                        @endif

                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $order_eves->cust_businessname }}</td>
                                                        <td>{{ $order_eves->cust_phone }}</td>
                                                        <td>{{ $order_eves->cat_name }}</td>
                                                        <td>{{ $order_eves->capa_lit }}</td>
                                                        <td>{{ $order_eves->ord_quantitycount }}</td>
                                                        <td>{{ $order_eves->ord_sugartype }}</td>
                                                        <td>{{ $order_eves->ord_amount }}</td>

                                                        <td>
                                                            @if ($order_eves->ord_session == 'EVN')
                                                                <p class="text-danger">Evening</p>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($order_eves->ord_ordertype == 'DAILY')
                                                                <p class="badge badge-success">DLY</p>
                                                            @elseif ($order_eves->ord_ordertype == 'ADDITIONAL')
                                                                <div class="badge badge-danger">ADL</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @foreach ($order_eves->result as $results)
                                                                {{ $results->name }}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if ($order_eves->ord_packingstatus == 'PENDING')
                                                                <a
                                                                    href="{{ route('admin.packingstatus_run', $order_eves->orderlist_mainid) }}">
                                                                    <div class="badge badge-warning">Pending</div>
                                                                </a>
                                                            @elseif ($order_eves->ord_packingstatus == 'RUNNING')
                                                                <a
                                                                    href="{{ route('admin.packingstatus_complete', $order_eves->orderlist_mainid) }}">
                                                                    <div class="badge badge-info">running</div>
                                                                </a>
                                                            @elseif ($order_eves->ord_packingstatus == 'COMPLETE')
                                                                <div class="badge badge-success">Completed</div>
                                                            @elseif ($order_eves->ord_packingstatus == 'REJECTED')
                                                                <div class="badge badge-danger">Rejected</div>
                                                            @endif
                                                        <td>
                                                            @if ($order_eves->ord_deliverystatus == 'PENDING')
                                                                <div class="badge badge-warning">Pending</div>
                                                            @elseif ($order_eves->ord_deliverystatus == 'RUNNING')
                                                                <div class="badge badge-info">Running</div>
                                                            @elseif ($order_eves->ord_deliverystatus == 'DELIVERED')
                                                                <div class="badge badge-success">Delivered</div>
                                                            @elseif ($order_eves->ord_deliverystatus == 'REJECTED')
                                                                <div class="badge badge-danger">Rejected</div>
                                                            @endif

                                                        <td>

                                                            @if ($order_eves->ord_packingstatus == 'RUNNING' || $order_eves->ord_packingstatus == 'COMPLETE')
                                                                <li onclick="printDiv()"
                                                                    class="ion-android-print iconsize" data-pack="android"
                                                                    data-tags=""></li>
                                                            @endif
                                                            <div class="row1" style="display: none;">
                                                                <div class="row print-only" style="display: flex;">
                                                                    <div class="col-md-6"><img
                                                                            src="{{ url('qrcodes/' . $order_eves->qrcode) }}"
                                                                            height="20" width="20" alt="">
                                                                        <h6 style="margin: 0; padding: 0; font-size: 3px;">
                                                                            {{ $order_eves->cust_deliveryaddress }}</h6>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h6 style="margin: 0; padding: 0; font-size: 3px;">
                                                                            Order id:{{ $order_eves->orderlist_mainid }}
                                                                        </h6>
                                                                        <h6 style="margin: 0; padding: 0; font-size: 3px;">
                                                                            {{ $order_eves->cat_name }}
                                                                            {{ $order_eves->ord_sugartype }}</h6>
                                                                        <h6 style="margin: 0; padding: 0; font-size: 3px;">
                                                                            {{ $order_eves->cust_businessname }}</h6>
                                                                        <h6 style="margin: 0; padding: 0; font-size: 3px;">
                                                                            {{ $order_eves->capa_lit }}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" data-toggle="modal" data-target="#assumeorder">Assume
                                    delivery
                                </button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#rejectorder"
                                    id="rejectButton">Order Reject</button>
                                <button class="btn btn-info" data-toggle="modal" data-target="#orderre-confirm"
                                    id="orderreconfirm">Order Re-confirm</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    {{-- assume order --}}
    <form action="{{ route('admin.deliveryboyassume') }}" method="post" id="deliveryForm"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="orderlistids[]" id="orderlistids">
        <div class="modal fade" tabindex="-1" role="dialog" id="assumeorder">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title">Modal title</h5> --}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Delivery Boy</label>
                            <select class="form-control" name="delivery_boy" required>
                                <option selected hidden disabled>
                                    Please Select
                                    DeliveryBoy</option>
                                @foreach ($deliveryboy as $deliveryboys)
                                    <option value="{{ $deliveryboys->id }}">
                                        {{ $deliveryboys->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Delivery Boy?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    {{-- reject order --}}
    <form action="{{ route('admin.rejectorder') }}" method="post" class="rejectForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="orderlistids[]" class="orderlistids">
        <!-- Modal HTML -->
        <div class="modal fade" tabindex="-1" role="dialog" id="rejectorder">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure want to Reject this Order ?</h5>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary confirmReject">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    {{-- re confirm --}}
    <form action="{{ route('admin.orderreconfirm') }}" method="post" class="reconfirmForm"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="orderlistids[]" class="orderlistids">
        <!-- Modal HTML -->
        <div class="modal fade" tabindex="-1" role="dialog" id="orderre-confirm">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure want to Re-confirm this Order ?</h5>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary confirmorder">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('style')
    <style>
        .print-only {
            display: none;
        }
    </style>
@endpush

@push('other-scripts')
    <script>
        function printDiv() {
            var contentToPrint = document.querySelector('.print-only').outerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(contentToPrint);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.focus(); // Focus the print window
                printWindow.print(); // Print the content
            };
        }
    </script>
@endpush
