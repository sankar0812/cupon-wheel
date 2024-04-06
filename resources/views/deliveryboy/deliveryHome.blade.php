@extends('layouts.adminapp')
@section('title', 'DELIVERY DASHBOARD')
@section('contentdashboard')
<div class="main-content">
    <section class="section">
        <br>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-stats">
                        <div class="card-stats-title">
                            <div class="card-stats" id="qr-reader"></div>
                        </div>
                    </div>
                
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">

                <div class="card card-statistic-2" style="padding: 0px; border: none;">
                <div class="custom-card" style="border: 1px solid silver;padding: 10px;margin: 25px 25px 10px 25px;">
                        <div class="card-stats">
                            <div class="card-stats-title"></div>
                               

                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"></div>
                                        <div class="card-stats-item-label"></div>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"> {{$morcount}}</div>
                                        <a href="{{ route('delivery.orderlist','Morning') }}">
                                            <div class="card-stats-item-label badge badge-warning">Morning</div>
                                        </a>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{$evgcount}}</div>
                                        <a href="{{ route('delivery.orderlist','Evening') }}">
                                            <div class="card-stats-item-label badge badge-warning">Evening</div>
                                        </a>
                                    </div>
                                </div>
                            
                        </div>

                        <a href="{{ route('delivery.orderlist','All') }}" style="text-decoration: none;">
                            <div class="card-icon badge-warning">
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
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">

                <div class="card card-statistic-2" style="padding: 0px; border: none;">
                <div class="custom-card" style="border: 1px solid silver;padding: 10px;margin: 25px 25px 10px 25px;">
                        <div class="card-stats">
                            <div class="card-stats-title">  </div>
                               
                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"></div>
                                        <div class="card-stats-item-label"></div>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"> {{$morpendingcount}}</div>
                                        <a href="{{ route('delivery.pendingorder','Morning') }}">
                                            <div class="card-stats-item-label badge badge-warning">Morning</div>
                                        </a>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"> {{$evgpendingcount}}</div>
                                        <a href="{{ route('delivery.pendingorder','Evening') }}">
                                            <div class="card-stats-item-label badge badge-warning">Evening</div>
                                        </a>
                                    </div>
                                </div>
                          
                        </div>

                        <a href="{{ route('delivery.pendingorder','All') }}" style="text-decoration: none;">
                            <div class="card-icon badge badge-warning ">
                                <i class="fas fa-shopping-bag"></i>
                            </div>


                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pending Orders</h4>
                                </div>
                                <div class="card-body">
                                    {{$pendingOrder}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">

                <div class="card card-statistic-2" style="padding: 0px; border: none;">
                <div class="custom-card" style="border: 1px solid silver;padding: 10px;margin: 25px 25px 10px 25px;">
                        <div class="card-stats">
                            <div class="card-stats-title"> </div>
                                
                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"></div>
                                        <div class="card-stats-item-label"></div>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count"> {{$morcompletedcount}}</div>
                                        <a href="{{ route('delivery.completedorder','Morning') }}">
                                            <div class="card-stats-item-label badge badge-warning">Morning</div>
                                        </a>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{$evgcompletedcount}}</div>
                                        <a href="{{ route('delivery.completedorder','Evening') }}">
                                            <div class="card-stats-item-label badge badge-warning">Evening</div>
                                        </a>
                                    </div>
                                </div>
                           
                        </div>

                        <a href="{{ route('delivery.completedorder','All') }}" style="text-decoration: none;">
                        <div class="card-icon badge badge-warning ">
                                <i class="fas fa-thumbs-up"></i>
                            </div>


                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Completed Orders</h4>
                                </div>
                                <div class="card-body">
                                    {{$completedOrder}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



        </div>
    </section>
</div>
@endsection

