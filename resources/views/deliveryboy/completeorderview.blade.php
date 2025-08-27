@extends('layouts.adminapp')
@section('title', 'Delivery Boy')
@section('contentdashboard')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <!-- <h1>Order View</h1> -->
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Completed Order View </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    @foreach($groupedOrders as $customerId => $orders)
                    <div class="card-body">
                        <h5 class="card-title">{{ $orders->first()->cust_businessname }}</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mobile-col" style="font-weight: bold;">Category</div>
                                    <div class="col mobile-col" style="font-weight: bold;">Quantity</div>
                                    <div class="col mobile-col" style="font-weight: bold;">Quantity Count</div>
                                    <div class="col mobile-col" style="font-weight: bold;">Sugar</div>
                                </div>
                            </div>
                        </div>

                        @foreach($orders as $order)
                        @if($order->ord_deliverystatus == 'DELIVERED')
                        <div class="card" style="background-color: rgb(141, 204, 158);color:white;">

                            <div class="card-body">
                                <div class="col mobile-col" style="font-weight: bold;padding:12px;">Order id :#{{ $order->orderlist_mainid }}</div>
                                <div class="row">
                                    <div class="col mobile-col">{{ $order->cat_name }}</div>
                                    <div class="col mobile-col">{{ $order->capa_lit }}</div>
                                    <div class="col mobile-col">{{ $order->ord_quantitycount }}</div>
                                    <div class="col mobile-col">{{ $order->ord_sugartype }}</div>
                                    <div class="col mobile-col">

                                    </div>
                                </div>
                                <input type="hidden" id="orderlistid_{{ $order->orderlist_mainid }}" name="orderlistid[]" value="{{ $order->orderlist_mainid }}">
                            </div>

                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <button type="button" class="btn btn-danger" onclick="goBackOnce()">Close</button>
                </div>
            </div>
        </div>
    </div>


</div>
</div>

<!-- delivery status -->
<div class="modal fade" tabindex="-1" role="dialog" id="assumeorder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delivery.deliverystatus') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @foreach ($orders as $order)
                    <input class="form-check-input" type="hidden" name="orderlistid[]" value="{{ $order->orderlist_mainid }}">
                    <input type="hidden" name="customer_id" value="{{ $order->cusregisterid }}">
                    @endforeach
                    <p>Are you sure you want to confirm delivery?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('style')
<style>
    /* Custom styles for mobile */
    @media (max-width: 576px) {
        .mobile-col {
            font-size: 12px;
            /* Adjust font size for mobile */
            padding: 5px;
            /* Adjust padding for mobile */
        }
    }
</style>
@endpush
@push('other-scripts')
<script>
    function goBackOnce() {
        window.history.back();
        // Remove the event listener after one click
        document.querySelector('.btn-danger').removeEventListener('click', goBackOnce);
    }
</script>
@endpush