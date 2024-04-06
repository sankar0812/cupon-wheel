@extends('layouts.adminapp')
@section('title', 'Container Report')

@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Container Report</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Container Report</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>


                            <form action="{{ route('admin.containerreport', ['detail' =>"month"]) }}" method="get">
                                <!-- @csrf -->


                                <div class="form-group row mb-1">
                                    <label for="input" class="col-sm-2 col-form-label">Select Month :</label>
                                    <div class="col-md-5">
                                        <input type="month" class="form-control" id="startDate" name="month"><br>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                        
                                <!-- <div class="form-group">
                                    <label for="startDate" style="font-size: 18px;"> Month:</label>
                                    <input type="month" class="form-control" id="startDate" name="month">
                                </div> -->

                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Report</h5>
                            <div id="deliveryReport">
                                <table id="subscribersTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Container Capacity</th>
                                            <th>Containers Delivered</th>
                                            <th>Containers Collected</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reportData as $data)
                                        <tr>
                                            <td>{{ $data->cust_businessname }}</td>
                                            <td>{{ $data->capa_lit }}</td>
                                            <td>{{ $data->containers_delivered }}</td>
                                            <td>{{ $data->containers_collected }}</td>
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

@push('other-scripts')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.2/css/buttons.dataTables.min.css">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#subscribersTable').DataTable({
            dom: 'Blfrtip',
            buttons: [{
                extend: 'csv',
                className: 'btn btn-warning ml-2',
                text: 'CSV',
            }]
        });
    });
</script>
@endpush