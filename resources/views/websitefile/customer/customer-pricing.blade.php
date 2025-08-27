@extends('layouts.customerapp')
@section('title', 'Pricing')
@section('websitecontent')
@include('websitefile.assetslink.popmessage')
    @php

        $customerRecords = DB::table('customer_registers')->where('id', session('customerid'))->first();

        // dd($customerRecords->branch_id);

        $subscribe = DB::table('subscriptionplans')->where('sub_status', '1')->get();

        if (!empty($subscribe)) {
            foreach ($subscribe as $key => $requested) {
                $result = DB::table('addsubscriptionplans')
                    ->where(['addsub_subid' => $requested->id, 'branch_id' => $customerRecords->branch_id])
                    ->get();
                $subscribe[$key]->result = $result;
            }
        }

        $customerordercheck = DB::table('customerorders')
            ->where(['branch_id' => $customerRecords->branch_id])
            ->select('customerid')
            ->first();
        // $customerRecordss = DB::table('customer_registers')->where('id', session('customerid'))->first();
    @endphp



    <main>
        <section class="section-4 ">
            <div class="section-4-1">
                <div class="section-main py-5">
                    <h1>Flexible Plans for Everyone</h1>
                    <p>Our plans are made for eveyone. Whether you're just starting out on social media, or have been on
                        there for a long time, we have a plan that's right for you.</p>

                </div>
            </div>
            <div class="section-4-2">
                <div class="section-main">
                    <div class="pricing-body">

                        <div class="pricing-body-plans">

                            <div class="active" id="pricing__monthly__plan">
                                <div>

                                    @foreach ($subscribe as $subscribes)
                                        <form action="{{ route('customer.subscribefrom') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{ session('customerid') }}">

                                            <input type="hidden" name="branch_id"
                                                value="{{ $customerRecords->branch_id }}">
                                            <input type="hidden" name="subsc_id" value="{{ $subscribes->id }}" />
                                            @if ($customerRecords->cust_subcplan == $subscribes->id)
                                                <div class="card bg-primary">
                                                @else
                                                    <div class="card">
                                            @endif

                                            <div class="card-header">
                                                <h2 class="card-price ">{{ $subscribes->Sub_title }}</h2>
                                                <p>In order to subscribe, please select items for both Morning and
                                                    Evening
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    @foreach ($subscribes->result as $view)
                                                        <li><img src="https://rvs-product-pricing-page.vercel.app/assets/Checkmark.svg"
                                                                alt="">
                                                            <p>{{ $view->addsub_content }}</p>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                            <div class="card-footer">

                                                @if ($customerRecords->cust_subcplan == null)
                                                    <button type="submit" class="btn btn-primary">Subscribe
                                                        Now</button>
                                                    {{-- @elseif ($customerordercheck->customerid == session('customerid'))
                                                    <form action="{{ route('customer.subscribeupdate') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf

                                                        <input type="hidden" name="branch_id" id=""
                                                            value="{{ $customerRecords->branch_id }}">
                                                        <button type="submit" class="btn btn-primary">Subscribe
                                                            Now</button>
                                                    </form> --}}
                                                @else
                                                @endif


                                                {{-- <a href="">Subscribe
                                                    Now</a> --}}
                                            </div>
                                </div>
                                </form>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>






        @if (!empty($customerorder))
            <div class="boderline mt-3"></div>
            <section class="section-4 ">
                <div class="section-4-1">
                    <div class="section-main">
                        <h1>Your Subscribition Orders</h1>
                    </div>
                </div>
            </section>


            <div class="container">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Cups</th>
                                    {{-- <th>Amount</th> --}}
                                    <th>Quantity Count</th>
                                    <th>Sugar type</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                @foreach ($customerorder->result as $results)
                                    <tr>
                                        <td>
                                            {{ $results->cat_name }}
                                        </td>
                                        <td>
                                            {{ $results->capa_lit }}
                                        </td>
                                        <td>
                                            {{ $results->capa_per_cup }}
                                        </td>
                                        {{-- <td>
                                            {{ $results->menu_price }}
                                        </td> --}}
                                        <td>
                                            {{ $results->quantitycount }}
                                        </td>
                                        <td>
                                            {{ $results->sugartype }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <p class=""><span class="bgcreate">Select Delivery days and Session</span></p> --}}

                <div class="row py-5">
                    <div class="col-md-5">
                        <h6>Preffered Session</h6>

                        <tr class="mt-3">
                            @foreach ($customerorder->result1 as $results)
                                @if ($results->session_morn == 'MOR')
                                    <button class="btn btn-warning">
                                        <th>Morning</th>
                                    </button>
                                @endif

                                @if ($results->session_even == 'EVN')
                                    <button class="btn btn-warning">
                                        <th>Evening</th>
                                    </button>
                                @endif
                            @endforeach
                        </tr>
                    </div>
                    <div class="col-md-7">
                        <h6>Repeat Days</h6>

                        <tr class="mt-3">
                            @foreach ($customerorder->result2 as $results)
                                <button class="btn btn-warning">
                                    <th>{{ $results->day_fullname }}</th>
                                </button>
                            @endforeach
                        </tr>

                    </div>
                </div>
            </div>

        @endif
    </main>
@endsection
