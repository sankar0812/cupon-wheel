@extends('layouts.adminapp')
@section('title', 'DELIVERY DASHBOARD')
@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Container Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Customer list</div>
                <div class="breadcrumb-item">Container</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                @foreach($groupedOrders as $customerId => $orders)
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h4>Customer Name: <span class="text-danger">{{ $orders->first()->cust_businessname }}</span></h4>
                            <div class="card-header-action">
                            <a href="{{ route('delivery.containerdetail', ['customerId' => $orders->first()->id]) }}" class="btn btn-warning">
    View
</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Customer Name: <span class="text-danger">{{ $orders->first()->cust_personname }}</span></h6>
                                    <h6>Delivery Address: <span class="text-danger">{{ $orders->first()->cust_deliveryaddress }}</span></h6>
                                </div>
                                <div class="col-md-6">
                                  
                                    <div style="font-size: 12px; font-weight:bold; text-align:right;">
                                        <!-- Pending Containers: {{ $customerPendingContainerCount[$customerId] }} -->
                                    </div>
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

@endsection
