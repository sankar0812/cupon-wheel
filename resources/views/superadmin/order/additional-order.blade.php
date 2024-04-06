@extends('layouts.adminapp')
@section('title', 'Additional order')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Additional order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Additional Order</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a> Additional Order</h2>

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
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>

                                                        <th>Company Name</th>
                                                        <th>Contact</th>
                                                        <th>Address</th>
                                                        <th>Session</th>
                                                        <th>Orders List</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < 1; $i++)
                                                    @endfor
                                                    @foreach ($customerorder_morn as $customerorder_morns)
                                                        <tr>
                                                            <td>{{ $i }}</td>

                                                            <td>{{ $customerorder_morns->cust_businessname }}</td>
                                                            <td>{{ $customerorder_morns->cust_phone }}</td>
                                                            <td>{{ $customerorder_morns->cust_deliveryaddress }}</td>

                                                            <td>
                                                                @if ($customerorder_morns->session_morn == 'MOR')
                                                                    <p class="text-danger">Morning</p>
                                                                @endif
                                                            </td>
                                                            <td> <a class="btn btn-primary" data-toggle="collapse"
                                                                    href="#collapseExamplemorn{{ $customerorder_morns->customer_mainid }}"
                                                                    role="button" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                    details
                                                                </a>
                                                                <div class="collapse"
                                                                    id="collapseExamplemorn{{ $customerorder_morns->customer_mainid }}">
                                                                    <table class="table-bordered table-md">
                                                                        <tr>
                                                                            <th>Category</th>
                                                                            <th>Quantity</th>
                                                                            <th>Quantity.count</th>
                                                                            <th>Sugar</th>
                                                                        </tr>
                                                                        @foreach ($customerorder_morns->result as $orders)
                                                                            <tr>
                                                                                <td>{{ $orders->cat_name }}</td>
                                                                                <td>{{ $orders->capa_lit }}</td>
                                                                                <td>{{ $orders->quantitycount }}</td>
                                                                                <td>{{ $orders->sugartype }}</td>
                                                                            </tr>
                                                                        @endforeach

                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('admin.orderconfirm') }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="customerid"
                                                                        value="{{ $customerorder_morns->customer_mainid }}">
                                                                    <input type="hidden" name="customer_subcid"
                                                                        value="{{ $customerorder_morns->cust_subcplan }}">
                                                                    <input type="hidden" name="branchid"
                                                                        value="{{ $customerorder_morns->branch_id }}">
                                                                    {{-- <input type="hidden" name="dayname"
                                                                        value="{{ $customerorder_morns->day_name }}"> --}}
                                                                    <input type="hidden" name="ordertype"
                                                                        value="ADDITIONAL">
                                                                    @foreach ($customerorder_morns->result as $orders)
                                                                        <input type="hidden" name="categoryid[]"
                                                                            value="{{ $orders->category_mainid }}">
                                                                        <input type="hidden" name="capacityid[]"
                                                                            value="{{ $orders->capacities_mainid }}">
                                                                        <input type="hidden" name="quantitycount[]"
                                                                            value="{{ $orders->quantitycount }}">
                                                                        <input type="hidden" name="sugertype[]"
                                                                            value="{{ $orders->sugartype }}">
                                                                        <input type="hidden" name="amount[]"
                                                                            value="{{ $orders->menu_price }}">
                                                                    @endforeach

                                                                    <input type="hidden" name="session"
                                                                        value="{{ $customerorder_morns->session_morn }}">
                                                                    <button class="btn btn-warning"
                                                                        type="submit">Confirm</button>
                                                                </form>

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
                                            <table class="table table-striped" id="table-2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Company Name</th>
                                                        <th>Contact</th>
                                                        <th>Address</th>
                                                        <th>Session</th>
                                                        <th>Orders List</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < 1; $i++)
                                                    @endfor
                                                    @foreach ($customerorder_even as $customerorder_evens)
                                                        <tr>
                                                            <td>{{ $i }}</td>

                                                            <td>{{ $customerorder_evens->cust_businessname }}</td>
                                                            <td>{{ $customerorder_evens->cust_phone }}</td>
                                                            <td>{{ $customerorder_evens->cust_deliveryaddress }}</td>
                                                            <td>
                                                                @if ($customerorder_evens->session_even == 'EVN')
                                                                    <p class="text-danger">Evening</p>
                                                                @endif
                                                            </td>

                                                            <td> <a class="btn btn-primary" data-toggle="collapse"
                                                                    href="#collapseExampleeven{{ $customerorder_evens->customer_mainid }}"
                                                                    role="button" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                    details
                                                                </a>
                                                                <div class="collapse"
                                                                    id="collapseExampleeven{{ $customerorder_evens->customer_mainid }}">
                                                                    <table class="table-bordered table-md">
                                                                        <tr>
                                                                            <th>Category</th>
                                                                            <th>Quantity</th>
                                                                            <th>Quantity.count</th>
                                                                            <th>Sugar</th>
                                                                        </tr>
                                                                        @foreach ($customerorder_evens->result as $orders)
                                                                            <tr>
                                                                                <td>{{ $orders->cat_name }}</td>
                                                                                <td>{{ $orders->capa_lit }}</td>
                                                                                <td>{{ $orders->quantitycount }}</td>
                                                                                <td>{{ $orders->sugartype }}</td>
                                                                            </tr>
                                                                        @endforeach

                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('admin.orderconfirm') }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="customerid"
                                                                        value="{{ $customerorder_evens->customer_mainid }}">
                                                                    <input type="hidden" name="customer_subcid"
                                                                        value="{{ $customerorder_evens->cust_subcplan }}">
                                                                    <input type="hidden" name="branchid"
                                                                        value="{{ $customerorder_evens->branch_id }}">

                                                                    {{-- <input type="hidden" name="dayname" id=""
                                                                        value="{{ $customerorder_evens->day_name }}"> --}}
                                                                    <input type="hidden" name="ordertype"
                                                                        value="ADDITIONAL">
                                                                    @foreach ($customerorder_evens->result as $orders)
                                                                        <input type="hidden" name="categoryid[]"
                                                                            value="{{ $orders->category_mainid }}">

                                                                        <input type="hidden" name="capacityid[]"
                                                                            value="{{ $orders->capacities_mainid }}">

                                                                        <input type="hidden" name="quantitycount[]"
                                                                            value="{{ $orders->quantitycount }}">

                                                                        <input type="hidden" name="sugertype[]"
                                                                            value="{{ $orders->sugartype }}">

                                                                        <input type="hidden" name="amount[]"
                                                                            value="{{ $orders->menu_price }}">
                                                                    @endforeach

                                                                    <input type="hidden" name="session"
                                                                        value="{{ $customerorder_evens->session_even }}">

                                                                    <button class="btn btn-warning"
                                                                        type="submit">confirm</button>
                                                                </form>
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

                </div>
            </div>
        </section>
    </div>
@endsection
