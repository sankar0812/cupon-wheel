@extends('layouts.adminapp')
@section('title', 'DELIVERY DASHBOARD')
@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Order list</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Order list</div>
                <div class="breadcrumb-item">{{$ses}}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                @foreach($groupedOrders as $customerId => $orders)
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-warning">
                        <div class="card-header ">
                            <h4>Customer Name : <span class="text-danger"> {{ $orders->first()->cust_businessname }}</span></h4>
                            <div class="card-header-action">
                                <a href="{{ route('delivery.orderview', ['cust_id' => $orders->first()->cusregisterid, 'ses' => $ses]) }}" class="btn btn-warning">View</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Delivered To: <span class="text-danger">{{ $orders->first()->cust_personname }}</span></h6>
                                    <h6>Location: <span class="text-danger">{{ $orders->first()->cust_deliveryaddress }}</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <div style="font-size: 24px; font-weight:bold; text-align:right;">
                                        {{ isset($customerOrdersCount[$customerId]) ? $customerOrdersCount[$customerId] : 0 }}
                                    </div>
                                    <div style="font-size: 12px; font-weight:bold; text-align:right;">Total Orders</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="assumeorder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">!!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delivery.deliverystatus') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if(isset($orders))
                    @foreach ($orders as $order)
                    <input class="form-check-input" type="hidden" name="orderlistid[]" value="{{ $order->orderlist_mainid }}">
                    <input type="hidden" name="customer_id" value=" {{ $orders->first()->cusregisterid }}">
                    @endforeach
                    @else
                    <p>No orders have been assigned yet.</p>
                    @endif
                    <p>Are you sure to confirm!</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection