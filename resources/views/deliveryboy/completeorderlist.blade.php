@extends('layouts.adminapp')
@section('title', 'DELIVERY DASHBOARD')
@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Completed Order list</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Completed Order list</div>
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
                                <a href="{{ route('delivery.orderview', ['cust_id' => $orders->first()->cusregisterid]) }}" class="btn btn-warning">View</a>
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
    </section>
</div>
</div>
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
