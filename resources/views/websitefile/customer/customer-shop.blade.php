@extends('layouts.customerapp')
@section('title', 'Customer Order')
@section('websitecontent')
@include('websitefile.assetslink.popmessage')
    <section class="ftco-section">
        <div class="container">
            @if ($checksubcription)
                <h4 class="text-center">Please subscribe . . . . </h4>
            @else
                <main>
                    <section class="section-4">
                        <div class="section-4-1">
                            <div class="section-main">
                                <h1>Your Orders List</h1>
                            </div>
                        </div>
                    </section>
                </main>
                <div class="text-right">
                    <div class="btn-group" role="group" aria-label="Button group">
                        @if (!empty($snackscountedit))
                            <button id="countEditButton" class="btn btn-light bigbutton rounded mx-1" data-bs-toggle="modal"
                                data-bs-target="#snackscountedit{{ $snackscountedit->order_mainid }}">Count Edit</button>
                        @endif
                        <form action="{{ route('customer.additionalfrom') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="branch_id" value="{{ session('branch_id') }}">
                            <button class="btn btn-light bigbutton rounded mx-1" type="submit">Additional Order</button>
                        </form>
                    </div>
                </div>


                @if (
                    (!empty($order_moncustomerid) && $order_moncustomerid !== '') ||
                        (!empty($order_evencustomerid) && $order_evencustomerid !== ''))
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card shadow-bg">
                                <div class="card-header"><b>Today Order List</b>
                                    <center>
                                        @if (!empty($order_moncustomerid))
                                            <button class="btn btn-light bigbutton" type="button" data-bs-toggle="modal"
                                                data-bs-target="#todaymorning{{ $order_moncustomerid->id }}">Morning
                                            </button>
                                        @endif
                                        @if (!empty($order_evencustomerid))
                                            <button class="btn btn-light bigbutton" type="button" data-bs-toggle="modal"
                                                data-bs-target="#todayevening{{ $order_evencustomerid->id }}">Evening
                                            </button>
                                        @endif
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="image-width">
                                            @foreach ($data as $datas)
                                                <div>
                                                    <img src="{{ url('/uploads/categories/', $datas->cat_file) }}"
                                                        alt="">
                                                    <h5>{{ $datas->cat_name }}</h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body mt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($previous_evencustomerid) && $previous_evencustomerid !== '')
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card   shadow-bg">
                                <div class="card-header"><b>Previous Delivered Order List</b></div>
                                @foreach ($previous_evencustomerid->resultByDate as $date => $orders)
                                    <div class="row">
                                        <div class="col-md-3 text-center">{{ $date }}</div>
                                        <div class="col-md-6">
                                            <div class="image-width">
                                                @foreach ($data as $datas)
                                                    <div>
                                                        <img src="{{ url('/uploads/categories/', $datas->cat_file) }}"
                                                            alt="">
                                                        <h5>{{ $datas->cat_name }}</h5>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-body mt-3">
                                                <button class="btn btn-light mt-2 bigbutton" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#morningOrder{{ $previous_evencustomerid->id }}_{{ $date }}">Morning</button><br>
                                                <button class="btn btn-light mt-2 bigbutton" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#eveningOrder{{ $previous_evencustomerid->id }}_{{ $date }}">Evening</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Morning Orders Modal --}}
                                    <div class="modal fade"
                                        id="morningOrder{{ $previous_evencustomerid->id }}_{{ $date }}"
                                        tabindex="-1"
                                        aria-labelledby="morningOrderLabel{{ $previous_evencustomerid->id }}_{{ $date }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Morning Orders - {{ $date }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order Id</th>
                                                                    <th>Category</th>
                                                                    <th>Quantity</th>
                                                                    <th>Quantity Count</th>
                                                                    <th>Sugar Type</th>
                                                                    <th>Order Type</th>
                                                                    <th>Total Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orders['MOR'] as $order)
                                                                    <tr>
                                                                        <td>{{ $order->orderlist_mainid }}</td>
                                                                        <td>{{ $order->cat_name }}</td>
                                                                        <td>{{ $order->capa_lit }}</td>
                                                                        <td>{{ $order->ord_quantitycount }}</td>
                                                                        <td>{{ $order->ord_sugartype }}</td>
                                                                        <td>
                                                                            @if ($order->ord_ordertype == 'DAILY')
                                                                                <p class="text-success">Normal</p>
                                                                            @elseif ($order->ord_ordertype == 'ADDITIONAL')
                                                                                <p class="text-danger">Additional</p>
                                                                            @endif

                                                                        </td>
                                                                        {{-- <td>{{ $order->ord_ordertype }}</td> --}}
                                                                        <td>{{ $order->ord_amount }} INR</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Evening Orders Modal --}}
                                    <div class="modal fade"
                                        id="eveningOrder{{ $previous_evencustomerid->id }}_{{ $date }}"
                                        tabindex="-1"
                                        aria-labelledby="eveningOrderLabel{{ $previous_evencustomerid->id }}_{{ $date }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Evening Orders - {{ $date }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order Id</th>
                                                                    <th>Category</th>
                                                                    <th>Quantity</th>
                                                                    <th>Quantity Count</th>
                                                                    <th>Sugar Type</th>
                                                                    <th>Order Type</th>
                                                                    <th>Total Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orders['EVN'] as $order)
                                                                    <tr>
                                                                        <td>{{ $order->orderlist_mainid }}</td>
                                                                        <td>{{ $order->cat_name }}</td>
                                                                        <td>{{ $order->capa_lit }}</td>
                                                                        <td>{{ $order->ord_quantitycount }}</td>
                                                                        <td>{{ $order->ord_sugartype }}</td>
                                                                        <td>
                                                                            @if ($order->ord_ordertype == 'DAILY')
                                                                                <p class="text-success">Normal</p>
                                                                            @elseif ($order->ord_ordertype == 'ADDITIONAL')
                                                                                <p class="text-danger">Additional</p>
                                                                            @endif

                                                                        </td>
                                                                        {{-- <td>{{ $order->ord_ordertype }}</td> --}}
                                                                        <td>{{ $order->ord_amount }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                        </div>
                    </div>
                @else
                @endif
            @endif
        </div>
    </section>


    <!-- Modal todayevening-->

    @if ($order_evencustomerid)
        <div class="modal fade" id="todayevening{{ $order_evencustomerid->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="table-responsive">
                            <table class="_table">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Quantity Count</th>
                                        <th>Sugar Type</th>
                                        <th>order Type</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    @foreach ($order_evencustomerid->result2 as $result2s)
                                        <tr>
                                            <td>
                                                {{ $result2s->orderlist_mainid }}
                                            </td>
                                            <td>
                                                {{ $result2s->cat_name }}
                                            </td>
                                            <td>
                                                {{ $result2s->capa_lit }}
                                            </td>
                                            <td>
                                                {{ $result2s->ord_quantitycount }}
                                            </td>
                                            <td>
                                                {{ $result2s->ord_sugartype }}
                                            </td>
                                            <td>
                                                @if ($result2s->ord_ordertype == 'DAILY')
                                                    <p class="text-success">Normal</p>
                                                @elseif ($result2s->ord_ordertype == 'ADDITIONAL')
                                                    <p class="text-danger">Additional</p>
                                                @endif

                                            </td>
                                            <td>
                                                {{ $result2s->ord_amount }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal todaymorning-->
    @if ($order_moncustomerid)
        <div class="modal fade" id="todaymorning{{ $order_moncustomerid->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="table-responsive">
                            <table class="_table">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Quantity Count</th>
                                        <th>Sugar Type</th>
                                        <th>order Type</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    @foreach ($order_moncustomerid->result2 as $result2s)
                                        <tr>
                                            <td>
                                                {{ $result2s->orderlist_mainid }}
                                            </td>
                                            <td>
                                                {{ $result2s->cat_name }}
                                            </td>
                                            <td>
                                                {{ $result2s->capa_lit }}
                                            </td>
                                            <td>
                                                {{ $result2s->ord_quantitycount }}
                                            </td>
                                            <td>
                                                {{ $result2s->ord_sugartype }}
                                            </td>
                                            <td>
                                                @if ($result2s->ord_ordertype == 'DAILY')
                                                    <p class="text-success">Normal</p>
                                                @elseif ($result2s->ord_ordertype == 'ADDITIONAL')
                                                    <p class="text-danger">Additional</p>
                                                @endif

                                            </td>
                                            <td>
                                                {{ $result2s->ord_amount }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- snackscountedit --}}
    @if ($snackscountedit)
        <form action="{{ url('customer-snackscountupdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="snackscountedit{{ $snackscountedit->order_mainid }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="customer_id" value="{{ $snackscountedit->customerid }}">
                            <input type="hidden" value="{{ $snackscountedit->order_mainid }}" name="order_no">
                            <input type="number" class="form_control" name="snackscount"
                                value="{{ $snackscountedit->quantitycount }}">

                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button> --}}
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif

    {{-- pervious date --}}


@endsection
