@extends('layouts.adminapp')
@section('title','DASHBOARD')
@section('contentdashboard')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-warning card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title"></div>

                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"></div>
                                <div class="card-stats-item-label"></div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$morcount}}</div>
                                <div class="card-stats-item-label">Morning</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$evgcount}}</div>
                                <div class="card-stats-item-label">Evening</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon badge badge-warning ">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            {{$totalOrder}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-warning card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title"></div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"></div>
                                <div class="card-stats-item-label"></div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$morpendingcount}}</div>
                                <div class="card-stats-item-label">Morning</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$evgpendingcount}}</div>
                                <div class="card-stats-item-label">Evening</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon badge badge-warning ">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pending</h4>
                        </div>
                        <div class="card-body">
                            {{$pendingOrder}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-warning card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title"></div>

                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"></div>
                                <div class="card-stats-item-label"></div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$morcompletedcount}}</div>
                                <div class="card-stats-item-label">Morning</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{$evgcompletedcount}}</div>
                                <div class="card-stats-item-label">Evening</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon badge badge-warning ">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Completed</h4>
                        </div>
                        <div class="card-body">
                            {{$completedOrder}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4>Payment</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChartv" height="158"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-warning gradient-bottom">
                    <div class="card-header">
                        <h4>Waiting For Approval</h4>
                        <div class="card-header-action dropdown">
                            <!-- <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Select Period</li>
                                <li><a href="#" class="dropdown-item">Today</a></li>
                                <li><a href="#" class="dropdown-item">Week</a></li>
                                <li><a href="#" class="dropdown-item active">Month</a></li>
                                <li><a href="#" class="dropdown-item">This Year</a></li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($customers as $customer)
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <div class="media-body">

                                    <!-- <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">{{$customer->cust_businessname}}</div>
                                    </div> -->
                                    <div class="card  card-warning">

                                        <div style="padding: 5px; font-weight: bold;">{{ strtoupper($customer->cust_businessname) }}</div>

                                    </div>




                                </div>
                            </li>



                        </ul>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4>Total Pending Amounts by Customers </h4>
                    </div>
                    <div class="card-body">
                        <canvas id="pendingChart"></canvas> <!-- Canvas element for the chart -->
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4>Invoices</h4>
                        <!-- <div class="card-header-action">
                            <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                        </div> -->
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Customer</th>
                                        <th>subscription</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Transaction id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>
                                        <td>INV# :{{$invoice->invoice_id}}</td>
                                        <td class="font-weight-600">{{$invoice->cust_businessname}}</td>
                                        <td>
                                            <div class="badge badge-danger">{{ $invoice->Sub_title }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $invoice->amount}} INR</div>
                                        </td>
                                        <td>
                                            <div class="badge badge-success">Paid</div>
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($invoice->paid_at)->format('F j, Y') }}</td>
                                        <td>
                                            {{ $invoice->razorpay_payment_id	 }}
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
    </section>
</div>
@endsection
@push('other-scripts')
@if ($paymentsData->values()->contains(function ($value, $key) {
    return $value != 0;
}))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dates = {!! json_encode($paymentsData->keys()) !!};
        const amounts = {!! json_encode($paymentsData->values()) !!};

        var ctx = document.getElementById("myChartv").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Payments',
                    data: amounts,
                    borderWidth: 2,
                    backgroundColor: '#fcc604',
                    borderColor: 'transparent',
                    pointRadius: 3.5,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return '₹' + value;
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
            }
        });
    });
</script>
@else
@endif



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Convert the collection to a plain PHP array
    var pendingReportsByCustomer = <?php echo json_encode($pendingReportsByCustomer); ?>;

    // Extract customer names and pending amounts
    var customers = Object.keys(pendingReportsByCustomer);
    var pendingAmounts = Object.values(pendingReportsByCustomer).map(function(item) {
        return item.reduce(function(sum, report) {
            return sum + parseFloat(report.total_pending);
        }, 0);
    });

    // Create a bar chart
    var ctx = document.getElementById('pendingChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: customers, // Use customer names as labels
            datasets: [{
                label: 'Total Pending Amount',
                backgroundColor: 'rgba(252,198,4)', // Blue color
                borderColor: 'rgba(255,255,255)',
                borderWidth: 1,
                data: pendingAmounts,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>




@endpush
