@extends('layouts.customerapp')
@section('title', 'Payment')
@section('websitecontent')
    @include('websitefile.assetslink.popmessage')
    <section class="ftco-section">
        <div class="container">

            {{-- --------------------------------------------- unpaid list ------------------------------------------------------------------ --}}
            {{-- -------------------------------------------- Daily subscription check------------------------------------------------------ --}}
            @if ($customer_view->cust_subcplan == 1 || $customer_view->cust_subcplanpaid == 1)
                @foreach ($customer_view->resultByDate as $date => $details)
                    <details class="pr-5 pl-5">
                        <summary>{{ $date }}
                            <form action="{{ url('customer-orderpayment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer_view->id }}">
                                <input type="hidden" name="subsc_id" value="{{ $customer_view->cust_subcplan }}">
                                <input type="hidden" name="branch_id" value="{{ $customer_view->branch_id }}">
                                <input type="hidden" name="date[]" value="{{ $date }}" />
                                @foreach ($details['orders'] as $order)
                                    <input type="hidden" name="order_id[]" value="{{ $order->orderlist_mainid }}">
                                @endforeach
                                <input type="hidden" name="totalamount" value="{{ $details['total_amount'] }}">

                                {{-- <button type="submit" class="btn btn-success rounder mr-5">pay</button> --}}
                                @if ($details['payment_status'][0] == 'PENDING')

                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_test_UY1SGsrCIRVz7n"
                                data-amount="{{ $details['total_amount']  * 100 }} "
                                data-currency="INR"
                                data-buttontext="Pay Now"
                                data-name="cup on wheel"
                                data-button_theme="black"
                                data-description="Rozerpay"
                                data-image="{{ url('websiteasset/images/final.png') }}"
                                data-prefill.name="{{ $customer_view->cust_businessname }}"
                                data-prefill.email="{{ $customer_view->cust_emailaddress }}"
                                data-theme.color="#ffc400"></script>
{{--
                                    <button class="buttonown" type="submit">
                                        <div class="badge  roundersuccess mr-5">Pay</div>
                                    </button> --}}
                                @endif
                            </form>
                        </summary>
                        <h6 class="text-right">Total : {{ $details['total_amount'] }} INR</h6>
                        <div class="row">
                            {{-- <div class="table-responsive"> --}}
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Quantity</th>
                                        <th>Session</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details['orders'] as $order)
                                        <tr class="text-dark">
                                            <td>{{ $order->cat_name }} - {{ $order->capa_lit }}</td>
                                            <td>{{ $order->ord_quantitycount }} Nos</td>
                                            <td>
                                                @if ($order->ord_session == 'MOR')
                                                    Morning
                                                @elseif ($order->ord_session == 'EVN')
                                                    Evening
                                                @endif
                                            </td>
                                            <td>{{ $order->ord_amount }} INR</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="border"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- </div> --}}
                        </div>
                    </details>
                @endforeach


                {{-- paid --}}
                @foreach ($customer_viewpaid->resultByDatepaid as $invoiceId => $details)
                    @foreach ($details as $date => $detail)
                        <details class="pr-5 pl-5">
                            <summary>{{ $date }}

                                <form action="{{ url('customer-orderpayment') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ $customer_view->id }}">
                                    <input type="hidden" name="subsc_id" value="{{ $customer_view->cust_subcplan }}">
                                    <input type="hidden" name="branch_id" value="{{ $customer_view->branch_id }}">
                                    <input type="hidden" name="date[]" value="{{ $date }}" />
                                    @foreach ($detail['orders'] as $order)
                                        <input type="hidden" name="order_id[]" value="{{ $order->orderlist_mainid }}">
                                    @endforeach
                                    <input type="hidden" name="totalamount" value="{{ $detail['total_amount'] }}">

                                    @if ($detail['payment_status'][0] == 'RECEIVED')
                                        <a href="{{ route('download.invoice', $invoiceId) }}" class="mr-2"><img
                                                src="{{ url('websiteasset/images/pdf-red.png') }}" alt=""
                                                height="25" width="20"></a>

                                        <div class="badge rounderdanger mr-4">Paid</div>
                                    {{-- @else
                                        <button type="submit" class="btn btn-success rounder mr-4">Pay</button> --}}
                                    @endif
                                </form>
                            </summary>
                            <h6 class="text-right">Total : {{ $detail['total_amount'] }} INR</h6>
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Quantity</th>
                                            <th>Session</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail['orders'] as $order)
                                            <tr class="text-dark">
                                                <td>{{ $order->cat_name }} - {{ $order->capa_lit }}</td>
                                                <td>{{ $order->ord_quantitycount }} Nos</td>
                                                <td>
                                                    @if ($order->ord_session == 'MOR')
                                                        Morning
                                                    @elseif ($order->ord_session == 'EVN')
                                                        Evening
                                                    @endif
                                                </td>
                                                <td>{{ $order->ord_amount }} INR</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="border"></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </details>
                    @endforeach
                @endforeach

                {{-- -------------------------------------------- weekly subscription check------------------------------------------------------ --}}
            @elseif ($customer_view->cust_subcplan == 2 || $customer_viewpaid->cust_subcplan == 2)
                @foreach ($customer_view->resultByWeek as $weekKey => $weekDetails)
                    <details class="pr-5 pl-5">
                        <summary>{{ $weekKey }}
                            <form action="{{ url('customer-orderpayment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer_view->id }}">
                                <input type="hidden" name="subsc_id" value="{{ $customer_view->cust_subcplan }}">
                                <input type="hidden" name="branch_id" value="{{ $customer_view->branch_id }}">
                                @foreach ($weekDetails['orders_by_date_within_week'] as $dateKey => $dateOrders)
                                    <input type="hidden" name="date[]" value="{{ $dateKey }}" />
                                    @foreach ($dateOrders as $dayName => $orders)
                                        @foreach ($orders as $order)
                                            <input type="hidden" name="order_id[]" value="{{ $order->orderlist_mainid }}">
                                        @endforeach
                                    @endforeach
                                @endforeach
                                <input type="hidden" name="totalamount" value="{{ $weekDetails['total_amount'] }}">
                                @if ($weekDetails['payment_status'][0] == 'PENDING')
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_test_UY1SGsrCIRVz7n"
                                data-amount="{{ $weekDetails['total_amount']  * 100 }} "
                                data-currency="INR"
                                data-buttontext="Pay Now"
                                data-name="cup on wheel"
                                data-description="Rozerpay"
                                data-image="{{ url('websiteasset/images/final.png') }}"
                                data-prefill.name="{{ $customer_view->cust_businessname }}"
                                data-prefill.email="{{ $customer_view->cust_emailaddress }}"
                                data-theme.color="#ffc400"></script>
                                {{-- @elseif ($weekDetails['payment_status'][0] == 'RECEIVED')
                                    <div class="badge  rounderdanger mr-5">Paid</div> --}}
                                @endif
                            </form>
                        </summary>
                        <h6 class="text-right">Total : {{ $weekDetails['total_amount'] }} INR</h6>
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Days</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($weekDetails['orders_by_date_within_week'] as $dateKey => $dateOrders)
                                        @foreach ($weekDetails['total_amount_by_date_within_week'][$dateKey] as $daykey => $totalAmount)
                                            <tr>
                                                <td>{{ $dateKey }}</td>
                                                <td>{{ $daykey }}</td>
                                                <td>{{ $totalAmount }} INR</td>
                                                <td>
                                                    <div class="badge  rounderdanger" data-bs-toggle="modal"
                                                        data-bs-target="#weeklydayorder{{ $dateKey }}">view</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="border"></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </details>

                    <!-- Modal -->
                    @foreach ($weekDetails['orders_by_date_within_week'] as $dateKey => $dateOrders)
                        @foreach ($dateOrders as $dayName => $orders)
                            <div class="modal fade" id="weeklydayorder{{ $dateKey }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="border-radius: 20px;">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border-bottom:none;">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Quantity</th>
                                                                <th>Session</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $order->cat_name }} - {{ $order->capa_lit }}
                                                                    </td>
                                                                    <td>{{ $order->ord_quantitycount }} Nos</td>
                                                                    <td>
                                                                        @if ($order->ord_session == 'MOR')
                                                                            Morning
                                                                        @elseif ($order->ord_session == 'EVN')
                                                                            Evening
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->ord_amount }} INR</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <div class="border"></div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="4">
                                                                    <h6 class="text-right">Total :
                                                                        {{ $weekDetails['total_amount_by_date_within_week'][$dateKey][$dayName] }}
                                                                        INR</h6>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach

                {{-- paid --}}
                @foreach ($customer_viewpaid->resultByWeekpaid as $invoiceId => $Details)
                    @foreach ($Details as $weekKey => $weekDetails)
                        <details class="pr-5 pl-5">
                            <summary>{{ $weekKey }}
                                <form action="{{ url('customer-orderpayment') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ $customer_view->id }}">
                                    <input type="hidden" name="subsc_id" value="{{ $customer_view->cust_subcplan }}">
                                    <input type="hidden" name="branch_id" value="{{ $customer_view->branch_id }}">
                                    {{-- Loop through orders to collect data --}}
                                    @foreach ($weekDetails['orders_by_date_within_week'] as $dateKey => $dateOrders)
                                        @foreach ($dateOrders as $dayName => $orders)
                                            <input type="hidden" name="date[]" value="{{ $dateKey }}" />
                                            @foreach ($orders as $order)
                                                <input type="hidden" name="order_id[]"
                                                    value="{{ $order->orderlist_mainid }}">
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    <input type="hidden" name="totalamount" value="{{ $weekDetails['total_amount'] }}">
                                    {{-- Payment button --}}

                                    {{-- ($weekDetails['payment_status'][0] == 'PENDING')
                                        <button class="buttonown" type="submit">
                                            <div class="badge  roundersuccess mr-5">Pay</div>
                                        </button>
                                    @elseif --}}
                                      @if($weekDetails['payment_status'][0] == 'RECEIVED')
                                        <a href="{{ route('download.invoice', $invoiceId) }}" class="mr-2"><img
                                                src="{{ url('websiteasset/images/pdf-red.png') }}" alt=""
                                                height="25" width="20"></a>
                                        <div class="badge  rounderdanger mr-5">Paid</div>
                                    @endif
                                </form>
                            </summary>
                            <h6 class="text-right">Total : {{ $weekDetails['total_amount'] }} INR</h6>
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Days</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Loop through orders to display data --}}
                                        @foreach ($weekDetails['orders_by_date_within_week'] as $dateKey => $dateOrders)
                                            @foreach ($weekDetails['total_amount_by_date_within_week'][$dateKey] as $daykey => $totalAmount)
                                                <tr>
                                                    <td>{{ $dateKey }}</td>
                                                    <td>{{ $daykey }}</td>
                                                    <td>{{ $totalAmount }} INR</td>
                                                    <td>
                                                        <div class="badge  rounderdanger" data-bs-toggle="modal"
                                                            data-bs-target="#weeklydayorderpaid{{ $invoiceId }}">view
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="border"></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </details>
                    @endforeach
                @endforeach


                <!-- Modal -->
                @foreach ($customer_viewpaid->resultByWeekpaid as $invoiceId => $Details)
                    @foreach ($Details as $weekKey => $weekDetails)
                        @foreach ($weekDetails['orders_by_date_within_week'] as $dateKey => $dateOrders)
                            {{-- Modal for each day's orders --}}
                            <div class="modal fade" id="weeklydayorderpaid{{ $invoiceId }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="border-radius: 20px;">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border-bottom:none;">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $dateKey }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Quantity</th>
                                                                <th>Session</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- Loop through orders for the current day --}}
                                                            @foreach ($dateOrders as $dayName => $orders)
                                                                @foreach ($orders as $order)
                                                                    <tr>
                                                                        <td>{{ $order->cat_name }} -
                                                                            {{ $order->capa_lit }}</td>
                                                                        <td>{{ $order->ord_quantitycount }} Nos</td>
                                                                        <td>
                                                                            @if ($order->ord_session == 'MOR')
                                                                                Morning
                                                                            @elseif ($order->ord_session == 'EVN')
                                                                                Evening
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $order->ord_amount }} INR</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <div class="border"></div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                            {{-- Display total amount for the day --}}
                                                            <tr>
                                                                <td colspan="4">
                                                                    <h6 class="text-right">Total :
                                                                        {{ $weekDetails['total_amount_by_date_within_week'][$dateKey][$dayName] }}
                                                                        INR</h6>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach



                {{-- -------------------------------------------- monthly subscription check------------------------------------------------------ --}}
            @elseif ($customer_view->cust_subcplan == 3)
                @foreach ($customer_view->resultByMonth as $month => $details)
                    <details class="pr-5 pl-5">
                        <summary>{{ $month }}
                            <form action="{{ url('customer-orderpayment') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $customer_view->id }}">
                                <input type="hidden" name="subsc_id" value="{{ $customer_view->cust_subcplan }}">
                                <input type="hidden" name="branch_id" value="{{ $customer_view->branch_id }}">
                                {{-- <input type="hidden" name="date[]" value="{{ $date }}" /> --}}
                                @foreach ($details['orders_by_date_within_month'] as $dateKey => $dateOrders)
                                    @foreach ($dateOrders as $dayName => $orders)
                                        <input type="hidden" name="date[]" value="{{ $dateKey }}" />
                                        @foreach ($dateOrders as $dayName => $orders)
                                            @foreach ($orders as $order)
                                                <input type="hidden" name="order_id[]"
                                                    value="{{ $order->orderlist_mainid }}">
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                                <input type="hidden" name="totalamount" value="{{ $details['total_amount'] }}">
                                {{-- <button type="submit" class="btn btn-success rounder mr-5">pay</button> --}}
                                @if ($details['payment_status'][0] == 'PENDING')
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_test_UY1SGsrCIRVz7n"
                                data-amount="{{ $details['total_amount']  * 100 }}"
                                data-currency="INR"
                                data-buttontext="Pay Now"
                                data-name="cup on wheel"
                                data-description="Rozerpay"
                                data-image="{{ url('websiteasset/images/final.png') }}"
                                data-prefill.name="{{ $customer_view->cust_businessname }}"
                                data-prefill.email="{{ $customer_view->cust_emailaddress }}"
                                data-theme.color="#ffc400"></script>
                                    {{-- <button class="buttonown" type="submit">
                                        <div class="badge  roundersuccess mr-5">Pay</div>
                                    </button> --}}
                                {{-- @elseif ($details['payment_status'][0] == 'RECEIVED')
                                    <div class="badge  rounderdanger mr-5">Paid</div> --}}
                                @endif



                            </form>
                        </summary>
                        <h6 class="text-right">Total : {{ $details['total_amount'] }} INR</h6>
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Days</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details['orders_by_date_within_month'] as $dateKey => $dateOrders)
                                        @foreach ($dateOrders as $daykey => $orders)
                                            <tr>
                                                <td>{{ $dateKey }}</td>
                                                <td>{{ $daykey }}</td>
                                                <td>
                                                    {{ $details['total_amount_by_date_within_month'][$dateKey] }}
                                                    INR</td>
                                                <td>
                                                    <div class="badge  rounderdanger" data-bs-toggle="modal"
                                                        data-bs-target="#monthlydayorder{{ $dateKey }}">view</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="border"></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </details>

                    <!-- Modal -->
                    @foreach ($details['orders_by_date_within_month'] as $dateKey => $dateOrders)
                        @foreach ($dateOrders as $dayName => $orders)
                            <div class="modal fade" id="monthlydayorder{{ $dateKey }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="border-radius: 20px;">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border-bottom:none;">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Quantity</th>
                                                                <th>Session</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $order->cat_name }} - {{ $order->capa_lit }}
                                                                    </td>
                                                                    <td>{{ $order->ord_quantitycount }} Nos</td>
                                                                    <td>
                                                                        @if ($order->ord_session == 'MOR')
                                                                            Morning
                                                                        @elseif ($order->ord_session == 'EVN')
                                                                            Evening
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order->ord_amount }} INR</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <div class="border"></div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="4">
                                                                    <h6 class="text-right">Total :
                                                                        {{ $details['total_amount_by_date_within_month'][$dateKey] }}
                                                                        INR</h6>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach


                {{-- paid --}}
                @foreach ($customer_viewpaid->resultByMonthpaid as $invoiceId => $monthdetails)
                    @foreach ($monthdetails as $month => $details)
                        <details class="pr-5 pl-5">
                            <summary>{{ $month }}
                                <form action="{{ url('customer-orderpayment') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ $customer_view->id }}">
                                    <input type="hidden" name="subsc_id" value="{{ $customer_view->cust_subcplan }}">
                                    <input type="hidden" name="branch_id" value="{{ $customer_view->branch_id }}">
                                    {{-- <input type="hidden" name="date[]" value="{{ $date }}" /> --}}
                                    @foreach ($details['orders_by_date_within_month'] as $dateKey => $dateOrders)
                                        @foreach ($dateOrders as $dayName => $orders)
                                            <input type="hidden" name="date[]" value="{{ $dateKey }}" />
                                             @foreach ($dateOrders as $dayName => $orders)
                                                @foreach ($orders as $order)
                                                    <input type="hidden" name="order_id[]"
                                                        value="{{ $order->orderlist_mainid }}">
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    <input type="hidden" name="totalamount" value="{{ $details['total_amount'] }}">
                                    {{-- <button type="submit" class="btn btn-success rounder mr-5">pay</button> --}}
                                    @if ($details['payment_status'][0] == 'RECEIVED')
                                    <a href="{{ route('download.invoice', $invoiceId) }}" class="mr-2"><img
                                        src="{{ url('websiteasset/images/pdf-red.png') }}" alt=""
                                        height="25" width="20"></a>
                                        <div class="badge  rounderdanger mr-5">Paid</div>
                                    @endif



                                </form>
                            </summary>
                            <h6 class="text-right">Total : {{ $details['total_amount'] }} INR</h6>
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Days</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details['orders_by_date_within_month'] as $dateKey => $dateOrders)
                                            @foreach ($dateOrders as $daykey => $orders)
                                                <tr>
                                                    <td>{{ $dateKey }}</td>
                                                    <td>{{ $daykey }}</td>
                                                    <td>
                                                        {{ $details['total_amount_by_date_within_month'][$dateKey] }}
                                                        INR</td>
                                                    <td>
                                                        <div class="badge  rounderdanger" data-bs-toggle="modal"
                                                            data-bs-target="#monthlydayorderpaid{{ $invoiceId }}">view
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="border"></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </details>

                        <!-- Modal -->
                        @foreach ($details['orders_by_date_within_month'] as $dateKey => $dateOrders)
                            @foreach ($dateOrders as $dayName => $orders)
                                <div class="modal fade" id="monthlydayorderpaid{{ $invoiceId }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="border-radius: 20px;">
                                        <div class="modal-content">
                                            <div class="modal-header" style="border-bottom:none;">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Quantity</th>
                                                                    <th>Session</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orders as $order)
                                                                    <tr>
                                                                        <td>{{ $order->cat_name }} -
                                                                            {{ $order->capa_lit }}
                                                                        </td>
                                                                        <td>{{ $order->ord_quantitycount }} Nos</td>
                                                                        <td>
                                                                            @if ($order->ord_session == 'MOR')
                                                                                Morning
                                                                            @elseif ($order->ord_session == 'EVN')
                                                                                Evening
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $order->ord_amount }} INR</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <div class="border"></div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <h6 class="text-right">Total :
                                                                            {{ $details['total_amount_by_date_within_month'][$dateKey] }}
                                                                            INR</h6>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @else
                <h4 class="text-center">Please subscribe . . . . </h4>
            @endif


        </div>
    </section>
@endsection
