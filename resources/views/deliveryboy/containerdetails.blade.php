@extends('layouts.adminapp')
@section('title', 'DELIVERY DASHBOARD')
@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Container Transaction Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Container Transaction Details</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Delivered Date</th>
                                            <th style="text-align: center;">Capacity</th>
                                            <th style="text-align: center;">Customer ID</th>
                                            <th style="text-align: center;">Quantity Count</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($groupedrecord as $date => $groupedRecords)
                                        @foreach($groupedRecords as $record)
                                        @foreach($record as $rec)

                                        <tr>
                                            <td style="text-align: center;">{{ $rec->transaction_date }}</td>
                                            <td style="text-align: center;">{{ $rec->capa_lit }}</td>
                                            <td style="text-align: center;">{{ $rec->cust_businessname }}</td>
                                            <td style="text-align: center;">{{ $rec->quantity_count }}</td>
                                            <td style="text-align: center;">
                                                @if($rec->transaction_type == "DELIVERED")
                                                <form action="{{ route('delivery.containerupdate') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cont_id" value="{{ $rec->cap_id }}">
                                                    <input type="hidden" name="customer_id" value="{{ $rec->customer_id }}">
                                                    <input type="hidden" name="transaction_date" value="{{ $rec->transaction_date }}">
                                                    <button type="submit" class="btn btn-primary">Collected</button>
                                                </form>
                                                @else
                                                <button type="button" class="btn btn-success" disabled>{{ $rec->transaction_type }}</button>
                                                @endif
                                            </td>
                                        </tr>



                                        @endforeach
                                        @endforeach
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