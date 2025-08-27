@extends('layouts.adminapp')
@section('title', 'Subscribers Report')
@section('contentdashboard')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Subscribers Report</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('delivery.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Subscribers Report</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="subscribersTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Month</th>
                                           
                                            <th class="text-center">Business Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Subscriber Plan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subscribersGroupedByMonth as $month => $subscribers)
                                        <tr>
                                            <td class="text-center" rowspan="{{ count($subscribers) }}">{{ $month }}</td>
                                            @foreach($subscribers as $key => $subscriber)
                                            @if($key > 0)
                                        <tr>
                                            @endif
                                          
                                            <td>{{ $subscriber->cust_businessname }}</td>
                                            <td>{{ $subscriber->cust_phone }}</td>
                                            <td>{{ $subscriber->Sub_title }}</td>
                                        </tr>
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