@extends('layouts.adminapp')
@section('title', 'DELIVERY DASHBOARD')
@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pending Order list</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Pending Order list</div>
                <div class="breadcrumb-item">{{$ses}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                @foreach($groupedOrders as $customerId => $orders)
               
                <div class="col-12 col-md-6 col-lg-6" >
                <div class="card" >
                        <div class="card-header ">
                            <h4>Customer Name : <span class="text-danger"> {{ $orders->first()->cust_businessname }}</span></h4>
                            <div class="card-header-action">

                                <a href="{{ route('delivery.pendingorderview', ['cust_id' => $orders->first()->cusregisterid]) }}" class="btn btn-warning">
                                    View
                                </a>






                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Delivered To: <span class="text-danger">{{ $orders->first()->cust_personname }}</span></h6>
                                    <h6>Location: <span class="text-danger">{{ $orders->first()->cust_deliveryaddress }}</span></h6>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div style="font-size: 24px; font-weight:bold; text-align:right;">{{ $totalOrderscount }}</div>
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
<!-- 
@foreach($groupedOrders as $customerId => $orders)
<div class="modal fade" data-backdrop="static" id="Modal{{ $orders->first()->cusregisterid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order List </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm table-dark">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Quantity.count</th>
                        <th>Sugar</th>
                    </tr>
                    @for ($i = 0; $i < 1; $i++) @endfor @foreach($orders as $order) 
                   <tr>
                        <td>
                      {{ $i++ }}    <input class="form-check-input" type="hidden" id="orderlistid_{{ $order->orderlist_mainid }}" name="orderlistid[]" value="{{ $order->orderlist_mainid }}">
                        </td>

                        <td>{{ $order->cat_name }}</td>
                        <td>{{ $order->capa_lit }}</td>
                        <td>{{ $order->ord_quantitycount }}</td>
                        <td>{{ $order->ord_sugartype }}</td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if($orders->first()->ord_deliverystatus != 'DELIVERED')
                <button class="btn btn-success" data-toggle="modal" data-target="#assumeorder">Delivered </button>
@else
<button class="btn btn-success" data-toggle="modal" data-target="#assumeorder" disabled>Delivered</button>

@endif
            </div>
        </div>
    </div>

    <!-- delivery status -->



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

                    @foreach ($orders as $order)
                    <input class="form-check-input" type="hidden" name="orderlistid[]" value="{{ $order->orderlist_mainid }}">

                    <input type="hidden" name="customer_id" value=" {{ $orders->first()->cusregisterid }}">
                    @endforeach

                    <p>Are you sure to confirm!</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>

        </div>
    </div>
</div> -->




<!-- <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('admin.deliveryprofilestore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="_table table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Quantity Count</th>
                                    <th width="50px">
                                        <div class="action_container">
                                            <a class="success" id="addRow"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                <tr>
                                    <td>
                                        <select class="form-control" name="categoryid[]" id="cat_id[]" required>
                                            <option selected hidden disabled>Please Select Category</option>
                                            @foreach ($data as $datas)
                                            <option value="{{ $datas->menu_catid }}">{{ $datas->cat_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="menuid[]" id="quantity[]" required>
                                            <option selected hidden disabled>Please Select Quantity</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" placeholder="Count" name="count[]" required autocomplete="off">
                                    </td>
                                    <td>
                                        <div class="action_container">
                                            <a class="danger removeRow"><i class="ion-close-round"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>-->
</div>


@endforeach
@endsection
@push('other-scripts')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add Row
        $("#addRow").click(function() {
            var newRow = $("#table_body").find("tr:first").clone();
            newRow.find('input, select').val('');
            $("#table_body").append(newRow);
        });

        // Remove Row
        $(document).on('click', '.removeRow', function() {
            if ($('#table_body tr').length === 1) {
                alert("You can't delete the only row.");
            } else {
                $(this).closest('tr').remove();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', 'select[id^="cat_id"]', function() {
            var cat_id = $(this).val();
            var quantitySelect = $(this).closest('tr').find('select[id^="quantity"]');
            quantitySelect.html('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ url('get-item-by-quantity') }}",
                type: "POST",
                data: {
                    cat_id: cat_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    quantitySelect.empty();
                    console.log(result, 'jyhtgrf');
                    quantitySelect.append('<option value="">Select Quantity</option>');
                    $.each(result.quantity, function(key, value) {
                        quantitySelect.append('<option value="' + value.id + '">' + value.capa_lit + ' (' + value.capa_per_cup + ')</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Ajax Error: ", error);
                }
            });
        });
    });
</script> -->



@endpush