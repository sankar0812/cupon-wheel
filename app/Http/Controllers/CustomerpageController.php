<?php

namespace App\Http\Controllers;


use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CustomerRegister;
use App\Models\Subscriptionplan;
use App\Models\Subscriptioncancel;
use App\Models\Subscriptionchange;
use Illuminate\Support\Facades\DB;
use App\Models\Addsubscriptionplan;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\Customerdays;
use App\Models\Customerdays_atl;
use App\Models\Customerorder;
use App\Models\Customerorder_atl;
use App\Models\Customersession;
use App\Models\Customersession_atl;
use App\Models\Day;
use App\Models\InvoicePayment;
use App\Models\Orderslist;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;


class CustomerpageController extends Controller
{
    public function customersregisterpage()
    {

        return view('websitefile.customer.customer-register');
    }

    public function customersregister(Request $request)
    {

        // dd($request);
        try {


            $validator = Validator::make($request->all(), [
                'businessname' => 'required',
                'personname' => 'required',
                'deliveryaddress' => 'required',
                'billingaddress' => 'required',
                'emailaddress' => 'required|email',
                'phonenumber' => 'required|digits:10',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $businessname = $request->input('businessname');
            $personname = $request->input('personname');
            $branch_id = 1;
            $deliveryaddress = $request->input('deliveryaddress');
            $billingaddress = $request->input('billingaddress');
            $emailaddress = $request->input('emailaddress');
            $phonenumber = $request->input('phonenumber');
            $gstnumber = $request->input('gstnumber');
            $password = Hash::make($request->input('password'));

            $currentDate = Carbon::now();
            $formattedDate = $currentDate->format('Y-m-d');

            $checkcustomer =   CustomerRegister::where([
                'branch_id' => $branch_id,
                'cust_phone' => $phonenumber,
                'cust_businessname' => $businessname,
                'cust_deliveryaddress' => $deliveryaddress,
                'cust_billingaddress' => $billingaddress,
                'cust_emailaddress' => $emailaddress,
                'cust_gstnumber' => $gstnumber,
            ])->first();


            if ($checkcustomer) {
                return redirect()->back()->with('failed', 'You have Already Register');
            } else {
                CustomerRegister::insert([
                    'branch_id' => $branch_id,
                    'cust_phone' => $phonenumber,
                    'cust_businessname' => $businessname,
                    'cust_personname' => $personname,
                    'cust_deliveryaddress' => $deliveryaddress,
                    'cust_billingaddress' => $billingaddress,
                    'cust_emailaddress' => $emailaddress,
                    'cust_gstnumber' => $gstnumber,
                    'cust_password' => $password,
                    'cust_regdate' => $formattedDate,
                ]);
                return redirect()->back()->with('success', 'Registration was successful!,My Team is Contact Soon..');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Registration Failed! Please Try Again Later');
        }
    }
    public function customerloginpage()
    {
        return view('websitefile.customer.customer-login');
    }

    public function customerlogin(Request $request)
    {
        try {


            $validator = Validator::make($request->all(), [
                'phonenumber' => 'required|max:10',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $phonenumber = $request->input('phonenumber');
            $password = $request->input('password');

            $user = CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1])->first();

            if ($user) {
                // Use Hash::check to verify the password
                if (Hash::check($password, $user->cust_password)  && $user->cust_subcplan == null) {
                    session(['customerid' => $user->id, 'branch_id' => $user->branch_id, 'customername' => $user->cust_businessname]);
                    // return view('websitefile.customer.customer-pricing');
                    return redirect()->route('customer.pricing');
                } elseif (Hash::check($password, $user->cust_password)) {
                    session(['customerid' => $user->id, 'branch_id' => $user->branch_id, 'customername' => $user->cust_businessname]);
                    // return view('websitefile.customer.customer-shop');
                    return redirect()->route('customer.shop');
                } else {
                    return redirect()->back()->with('failed', 'Password does not match');
                }
            } else {
                return redirect()->back()->with('failed', 'You do not have login access! Please contact admin');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'serve is down! Please Try Again Later');
        }
    }

    public function customerotpvalue(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phonenumber' => 'required|max:10|',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $phonenumber = $request->input('phonenumber');

            $user = CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1])->first();
            if ($user) {
                $otp = rand(100000, 999999);
                CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1])->update(['cust_otp' => $otp]);
                if ($phonenumber == $user->cust_phone) {
                    $request->session()->put('checksubs', $user->cust_subcplan);
                    $request->session()->put('customerphone', $user->cust_phone);
                    return view('websitefile.customer.customer-otpvalue');
                } else {
                    return redirect()->back()->with('failed', ' not match');
                }
            } else {
                return redirect()->back()->with('failed', 'You do not have login access!  please contact  admin');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'serve is down! Please Try Again Later');
        }
    }

    public function cutomerotpvaluepage()
    {
        return view('websitefile.customer.customer-otpvalue');
    }


    public function customercheckotpvalue(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [

                'otpvalue' => 'required|numeric', // adjust as per your requirements
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $phonenumber = $request->input('phonenumber');
            $otpvalue = $request->input('otpvalue');

            $otpcheck = CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1, 'cust_otp' => $otpvalue])->first();

            if ($otpcheck) {
                session(['customerid' => $otpcheck->id, 'customerphone' => $otpcheck->cust_phone]);
                return view('websitefile.customer.customer-changepassword');
            } else {
                return redirect()->back()->with('failed', 'Invalid OTP! Please try again later.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Operation failed');
        }
    }

    // public function customerotpvaluesubs(Request $request)
    // {
    //     try {

    //         $validator = Validator::make($request->all(), [

    //             'otpvalue' => 'required|numeric', // adjust as per your requirements
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         $phonenumber = $request->input('phonenumber');
    //         $otpvalue = $request->input('otpvalue');

    //         $otpcheck = CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1, 'cust_otp' => $otpvalue])->first();

    //         if ($otpcheck) {

    //             session(['customerid' => $otpcheck->id, 'customername' => $otpcheck->cust_businessname]);
    //             return view('websitefile.customer.customer-pricing');
    //         } else {
    //             return redirect()->back()->with('failed', 'Invalid OTP! Please try again later.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('failed', 'Operation failed');
    //     }
    // }

    public function customerotpresend(Request $request)
    {
        try {
            $phonenumber = $request->input('phonenumber');

            $user = CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1])->first();
            if ($user) {
                $otp = rand(100000, 999999);
                CustomerRegister::where(['cust_phone' => $phonenumber, 'cust_loginacs' => 1, 'cust_delete' => 1])->update(['cust_otp' => $otp]);
                if ($phonenumber == $user->cust_phone) {

                    $request->session()->put('customerphone', $user->cust_phone);
                    return view('websitefile.customer.customer-otpvalue')->with('success', 'Otp Resend SuccessFul');
                } else {
                    return redirect()->back()->with('failed', ' not match');
                }
            } else {
                return redirect()->back()->with('failed', 'You do not have login access!  please contact  admin');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'serve is down! Please Try Again Later');
        }
    }
    public function customerforgotpassword()
    {
        return view('websitefile.customer.customer-forgotpassword');
    }

    public function customerchangepage()
    {
        return view('websitefile.customer.customer-changepassword');
    }

    public function customerchangepassword(Request $request)
    {
        // dd($request);
        try {
            // Extract inputs from the request
            $phonenumber = $request->input('phonenumber');
            $customerid = $request->input('customerid');
            $newpassword = Hash::make($request->input('newpassword'));

            // Update the password in the database
            $result = CustomerRegister::where([
                'id' => $customerid,
                'cust_phone' => $phonenumber,
                'cust_loginacs' => 1,
                'cust_delete' => 1
            ])->update(['cust_password' => $newpassword]);

            // Check if the update was successful
            if ($result) {
                // Password changed successfully, redirect to customer login
                // return redirect()->route('customer-login')->with('success', 'Password changed successfully!');
                return view('websitefile.customer.customer-login')->with('success', 'Password changed successfully!');
            } else {
                // No matching records found or update failed
                return redirect()->back()->with('failed', 'Password not changed. Please check your inputs and try again.');
            }
        } catch (\Exception $e) {
            // Log the exception message for debugging
            logger()->error($e->getMessage());

            // Redirect back with a failure message
            return redirect()->back()->with('failed', 'Failed to change password. Please try again later.');
        }
    }

    public function customershop()
    {
        try {

            $customerprimaryid = session('customerid');
            $branch_id = session('branch_id');

            $formattedDate = now()->format('Y-m-d');

            $checksubcription = CustomerRegister::where(['id' => $customerprimaryid, 'branch_id' => $branch_id, 'cust_subcplan' => null, 'cust_status' => 1, 'cust_loginacs' => 1])->first();


            // morning
            $order_moncustomerid = CustomerRegister::select('id')->where('id', $customerprimaryid)->first();

            if (!empty($order_moncustomerid)) {
                $result2 = DB::table('orderslists')
                    ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                    ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                    ->where([
                        'ord_session' => 'MOR',
                        'ord_date' => $formattedDate,
                        'ord_branchid' => $branch_id,
                        'orderslists.ord_customerid' => $order_moncustomerid->id
                    ])
                    ->select(
                        'orderslists.id as orderlist_mainid',
                        'orderslists.ord_customerid',
                        'capacities.capa_lit',
                        'capacities.capa_per_cup',
                        'categories.cat_name',
                        'orderslists.ord_quantitycount',
                        'orderslists.ord_sugartype',
                        'orderslists.ord_session',
                        'orderslists.ord_amount',
                        'orderslists.ord_ordertype',
                        'orderslists.ord_date',
                        'orderslists.ord_dayname',
                    )
                    ->orderByDesc('orderslists.ord_customerid')
                    ->get();

                // Assigning the result to a property of the object
                $order_moncustomerid->result2 = $result2;
            }


            // // evening
            $order_evencustomerid = CustomerRegister::select('id')->where('id', $customerprimaryid)->first();

            if (!empty($order_evencustomerid)) {
                $result2 = DB::table('orderslists')
                    ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                    ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                    ->where([
                        'ord_session' => 'EVN',
                        'ord_date' => $formattedDate,
                        'ord_branchid' => $branch_id,
                        'orderslists.ord_customerid' => $order_evencustomerid->id
                    ])
                    ->select(
                        'orderslists.id as orderlist_mainid',
                        'orderslists.ord_customerid',
                        'capacities.capa_lit',
                        'capacities.capa_per_cup',
                        'categories.cat_name',
                        'orderslists.ord_quantitycount',
                        'orderslists.ord_sugartype',
                        'orderslists.ord_session',
                        'orderslists.ord_amount',
                        'orderslists.ord_ordertype',
                        'orderslists.ord_date',
                        'orderslists.ord_dayname',
                    )
                    ->orderByDesc('orderslists.ord_customerid')
                    ->get();

                // Assigning the result to a property of the object
                $order_evencustomerid->result2 = $result2;
            }


            $data = DB::table('menus')
                ->join('categories', 'categories.id', 'menus.menu_catid')
                ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])->select('menu_catid', 'cat_name', 'cat_file')->distinct()->get();
            // dd($order_moncustomerid, $order_evencustomerid);
            $snackscountedit = DB::table('customerorders')
                // ->join('categories', 'categories.id', '=', 'customerorders.categoryid')
                ->join('menus', 'menus.id', '=', 'customerorders.menuid')
                ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                ->leftJoin('categories', 'categories.id', '=', 'menus.menu_catid')
                ->select(
                    'customerorders.customerid',
                    'customerorders.id as order_mainid',
                    'categories.id as category_mainid',
                    'customerorders.quantitycount',
                )
                ->where(['customerorders.customerid' => $customerprimaryid, 'capacities.id' => 4])
                ->first();
            // dd($snackscountedit);

            $previous_evencustomerid = CustomerRegister::select('id')->where('id', $customerprimaryid)->first();
            if (!empty($previous_evencustomerid)) {
                $lastSevenDates = DB::table('orderslists')
                    ->where([
                        'ord_branchid' => $branch_id,
                        'orderslists.ord_customerid' => $previous_evencustomerid->id,
                        'ord_deliverystatus' => 'DELIVERED',
                    ])
                    ->whereIn('ord_session', ['MOR', 'EVN'])
                    ->whereDate('ord_date', '!=',  $formattedDate)
                    ->orderBy('ord_date', 'desc')
                    ->distinct('ord_date')
                    ->limit(7)
                    ->pluck('ord_date')
                    ->toArray();

                $resultByDate = [];

                foreach ($lastSevenDates as $date) {
                    foreach (['MOR', 'EVN'] as $session) {
                        $result2 = DB::table('orderslists')
                            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                            ->where([
                                'ord_session' => $session,
                                'ord_date' => $date,
                                'ord_branchid' => $branch_id,
                                'orderslists.ord_customerid' => $previous_evencustomerid->id,
                                'ord_deliverystatus' => 'DELIVERED',
                            ])
                            ->select(
                                'orderslists.id as orderlist_mainid',
                                'orderslists.ord_customerid',
                                'capacities.capa_lit',
                                'capacities.capa_per_cup',
                                'categories.cat_name',
                                'orderslists.ord_quantitycount',
                                'orderslists.ord_sugartype',
                                'orderslists.ord_session',
                                'orderslists.ord_amount',
                                'orderslists.ord_ordertype',
                                'orderslists.ord_date',
                                'orderslists.ord_dayname',
                            )
                            ->orderByDesc('orderslists.ord_customerid')
                            ->get();

                        $resultByDate[$date][$session] = $result2;
                    }
                }

                // Assigning the result to a property of the object
                $previous_evencustomerid->resultByDate = $resultByDate;
            }


            // dd($previous_evencustomerid);


            return view('websitefile.customer.customer-shop', compact('data', 'order_moncustomerid', 'order_evencustomerid', 'snackscountedit', 'previous_evencustomerid', 'checksubcription'));
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', 'serve is down. Please try again later.');
        }
    }

    public function customerpricing()
    {
        try {


            $branch_id = session('branch_id');
            $customerprimaryid = session('customerid');

            $customerorder = DB::table('customer_registers')
                ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
                ->where([
                    'customer_registers.id' => $customerprimaryid,
                    'customer_registers.branch_id' => $branch_id,
                    'customer_registers.cust_loginacs' => 1,
                ])
                ->select(
                    'customer_registers.id as customer_mainid',
                    'customer_registers.branch_id',
                    'customer_registers.cust_businessname',
                    'customer_registers.cust_phone',
                    'customer_registers.cust_deliveryaddress'
                )->first();

            if (!empty($customerorder)) {
                // Initialize an empty array to hold results
                $customerorder->result = [];
                // Retrieve orders for the customer
                $result = DB::table('customerorders')
                    ->join('categories as cat', 'cat.id', '=', 'customerorders.categoryid')
                    ->join('menus', 'menus.id', '=', 'customerorders.menuid')
                    ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                    ->select(
                        'menus.id as menu_mainid',
                        'customerorders.menuid',
                        'menus.menu_capaid',
                        'capacities.id as capacities_mainid',
                        'menus.menu_catid',
                        'cat.id as category_mainid',
                        'cat.cat_name',
                        'capacities.capa_lit',
                        'capacities.capa_per_cup',
                        'menus.menu_price',
                        'customerorders.quantitycount',
                        'customerorders.sugartype'
                    )
                    ->where('customerorders.customerid', $customerorder->customer_mainid)
                    ->get();
                // Assign results to customerorder object
                $customerorder->result = $result;
            }

            if (!empty($customerorder)) {
                // Initialize an empty array to hold results
                $customerorder->result1 = [];
                // Retrieve orders for the customer
                $result1 = DB::table('customersessions')
                    ->select(
                        'customersessions.customerid',
                        'customersessions.session_morn',
                        'customersessions.session_even',
                    )
                    ->where('customersessions.customerid', $customerorder->customer_mainid)
                    ->get();
                // Assign results to customerorder object
                $customerorder->result1 = $result1;
            }

            if (!empty($customerorder)) {
                // Initialize an empty array to hold results
                $customerorder->result2 = [];
                // Retrieve orders for the customer
                $result2 = DB::table('customerdays')
                    ->join('days', 'days.day_name', '=', 'customerdays.day_name')
                    ->select(
                        'customerdays.customerid',
                        'customerdays.day_name',
                        'days.day_fullname',
                    )
                    ->where('customerdays.customerid', $customerorder->customer_mainid)
                    ->get();
                // Assign results to customerorder object
                $customerorder->result2 = $result2;
            }

            // Debugging: Dump the customer order data
            // dd($customerorder);

            // Return the view with the customer order data
            return view('websitefile.customer.customer-pricing', compact('customerorder'));
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', 'serve is down. Please try again later.');
        }
    }

    public function snackscountupdate(Request $request)
    {
        // dd($request);
        try {
            $order_no = $request->input('order_no');
            $quantitycount = $request->input('snackscount');
            $customer_id = $request->input('customer_id');

            // Use where clause with correct syntax
            Customerorder::where(['id' => $order_no, 'customerid' => $customer_id])->update(['quantitycount' => $quantitycount]);

            return redirect()->back()->with('success', 'Your Snacks count updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Your Snacks count not updated');
        }
    }




    public function customerpayment()
    {

        try {
            $customerprimaryid = session('customerid');
            $branch_id = session('branch_id');
            $MONTH = now()->format('Y-m');



            $customer_view = CustomerRegister::where([
                'id' => $customerprimaryid,
                'branch_id' => $branch_id,
                'cust_loginacs' => 1,
                'cust_status' => 1
            ])
                ->select('id', 'branch_id', 'cust_loginacs', 'cust_status', 'cust_phone', 'cust_businessname', 'cust_personname', 'cust_subcplan')
                ->first();

            $customer_viewpaid = CustomerRegister::where([
                'id' => $customerprimaryid,
                'branch_id' => $branch_id,
                'cust_loginacs' => 1,
                'cust_status' => 1
            ])
                ->select('id', 'branch_id', 'cust_loginacs', 'cust_status', 'cust_phone', 'cust_businessname', 'cust_personname', 'cust_subcplan')
                ->first();
            //  -------------------------------------------- Daily subscription check------------------------------------------------------
            if ($customer_view->cust_subcplan == 1 && $customer_viewpaid->cust_subcplan == 1) {
                $lastSevenDates = DB::table('orderslists')

                    ->where([
                        'ord_branchid' => $branch_id,
                        'orderslists.ord_customerid' => $customer_view->id,
                        'orderslists.ord_deliverystatus' => 'DELIVERED',
                        'orderslists.ord_customer_subcid' => $customer_view->cust_subcplan,
                        'orderslists.ord_paymentstatus' => 'PENDING',
                    ])
                    ->orderBy('ord_date', 'desc')
                    ->distinct('ord_date')
                    ->pluck('ord_date')
                    ->toArray();

                $resultByDate = [];

                foreach ($lastSevenDates as $date) {
                    $result2 = DB::table('orderslists')
                        ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                        ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                        ->where([
                            'ord_date' => $date,
                            'ord_branchid' => $branch_id,
                            'orderslists.ord_customerid' => $customer_view->id,
                            'orderslists.ord_deliverystatus' => 'DELIVERED',
                            'orderslists.ord_customer_subcid' => $customer_view->cust_subcplan,
                            'orderslists.ord_paymentstatus' => 'PENDING',
                        ])
                        ->select(
                            'orderslists.id as orderlist_mainid',
                            'orderslists.ord_customerid',
                            'capacities.capa_lit',
                            'capacities.capa_per_cup',
                            'categories.cat_name',
                            'orderslists.ord_quantitycount',
                            'orderslists.ord_sugartype',
                            'orderslists.ord_session',
                            'orderslists.ord_amount',
                            'orderslists.ord_ordertype',
                            'orderslists.ord_date',
                            'orderslists.ord_dayname',
                            'orderslists.ord_customer_subcid',
                            'orderslists.ord_paymentstatus',
                        )
                        ->orderByDesc('orderslists.ord_date')
                        ->orderByDesc('orderslists.ord_customerid')
                        ->get();

                    // Calculate the total sum of 'ord_amount' for each date
                    $totalAmount = $result2->sum('ord_amount');

                    // Extract distinct payment statuses
                    $paymentStatuses = $result2->pluck('ord_paymentstatus')->unique()->toArray();

                    // Add total amount and payment statuses to the result array
                    $resultByDate[$date] = [
                        'orders' => $result2,
                        'total_amount' => $totalAmount,
                        'payment_status' => $paymentStatuses,
                    ];
                }
                // Assigning the result to a property of the object
                $customer_view->resultByDate = $resultByDate;

                // paid
                $checkinvoice = InvoicePayment::where(['customer_id' => $customer_view->id, 'razorpay_status' => 'captured',])->select('id')->get();
                $resultByDatepaid = [];

                foreach ($checkinvoice as $invoice) {
                    $resultByDatepaid[$invoice->id] = [];

                    $lastSevenDatespaid = DB::table('orderslists')
                        ->join('invoice_payments', 'invoice_payments.id', '=', 'orderslists.ord_invoiceid')
                        ->where([
                            'ord_branchid' => $branch_id,
                            'orderslists.ord_customerid' => $customer_viewpaid->id,
                            'orderslists.ord_deliverystatus' => 'DELIVERED',
                            'orderslists.ord_customer_subcid' => $customer_viewpaid->cust_subcplan,
                            'orderslists.ord_paymentstatus' => 'RECEIVED',
                            'ord_invoiceid' => $invoice->id,
                            'invoice_payments.razorpay_status' => 'captured',

                        ])
                        ->orderBy('ord_date', 'desc')
                        ->distinct('ord_date')
                        ->pluck('ord_date')
                        ->toArray();

                    foreach ($lastSevenDatespaid as $date) {
                        $result2paid = DB::table('orderslists')
                            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                            ->join('invoice_payments', 'invoice_payments.id', '=', 'orderslists.ord_invoiceid')
                            ->where([
                                'ord_date' => $date,
                                'ord_branchid' => $branch_id,
                                'orderslists.ord_customerid' => $customer_viewpaid->id,
                                'orderslists.ord_deliverystatus' => 'DELIVERED',
                                'orderslists.ord_customer_subcid' => $customer_viewpaid->cust_subcplan,
                                'orderslists.ord_paymentstatus' => 'RECEIVED',
                                'ord_invoiceid' => $invoice->id,
                                'invoice_payments.razorpay_status' => 'captured',
                            ])
                            ->select(
                                'orderslists.id as orderlist_mainid',
                                'orderslists.ord_customerid',
                                'capacities.capa_lit',
                                'capacities.capa_per_cup',
                                'categories.cat_name',
                                'orderslists.ord_quantitycount',
                                'orderslists.ord_sugartype',
                                'orderslists.ord_session',
                                'orderslists.ord_amount',
                                'orderslists.ord_ordertype',
                                'orderslists.ord_date',
                                'orderslists.ord_dayname',
                                'orderslists.ord_customer_subcid',
                                'orderslists.ord_paymentstatus',

                            )
                            ->orderByDesc('orderslists.ord_date')
                            ->orderByDesc('orderslists.ord_customerid')
                            ->get();

                        // Calculate the total sum of 'ord_amount' for each date
                        $totalAmountpaid = $result2paid->sum('ord_amount');

                        // Extract distinct payment statuses
                        $paymentStatusespaid = $result2paid->pluck('ord_paymentstatus')->unique()->toArray();

                        // Add total amount and payment statuses to the result array
                        $resultByDatepaid[$invoice->id][$date] = [
                            'orders' => $result2paid,
                            'total_amount' => $totalAmountpaid,
                            'payment_status' => $paymentStatusespaid,
                        ];
                    }
                }

                // Assigning the result to a property of the object
                $customer_viewpaid->resultByDatepaid = $resultByDatepaid;



                //  -------------------------------------------- weekly subscription check------------------------------------------------------
            } elseif ($customer_view->cust_subcplan == 2 && $customer_viewpaid->cust_subcplan == 2) {
                $lastSevenDates = DB::table('orderslists')
                    ->where([
                        'ord_branchid' => $branch_id,
                        'orderslists.ord_customerid' => $customer_view->id,
                        'orderslists.ord_deliverystatus' => 'DELIVERED',
                        'orderslists.ord_customer_subcid' => $customer_view->cust_subcplan,
                        'orderslists.ord_paymentstatus' => 'PENDING',
                    ])
                    ->orderBy('ord_date', 'desc')
                    ->distinct('ord_date')
                    ->pluck('ord_date')
                    ->toArray();

                $resultByWeek = [];

                foreach ($lastSevenDates as $date) {
                    $weekStartDate = Carbon::parse($date)->startOfWeek();
                    $weekEndDate = Carbon::parse($date)->endOfWeek();

                    $ordersByWeek = DB::table('orderslists')
                        ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                        ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                        ->whereBetween('ord_date', [$weekStartDate, $weekEndDate])
                        ->where([
                            'ord_branchid' => $branch_id,
                            'orderslists.ord_customerid' => $customer_view->id,
                            'orderslists.ord_deliverystatus' => 'DELIVERED',
                            'orderslists.ord_customer_subcid' => $customer_view->cust_subcplan,
                            'orderslists.ord_paymentstatus' => 'PENDING',
                        ])
                        // ->whereNot('ord_paymentstatus','RECEIVED')
                        ->select(
                            'orderslists.id as orderlist_mainid',
                            'orderslists.ord_customerid',
                            'capacities.capa_lit',
                            'capacities.capa_per_cup',
                            'categories.cat_name',
                            'orderslists.ord_quantitycount',
                            'orderslists.ord_sugartype',
                            'orderslists.ord_session',
                            'orderslists.ord_amount',
                            'orderslists.ord_ordertype',
                            'orderslists.ord_date',
                            'orderslists.ord_dayname',
                            'orderslists.ord_customer_subcid',
                            'orderslists.ord_paymentstatus',
                        )
                        ->orderBy('orderslists.ord_date') // Order by date within the week
                        ->orderByDesc('orderslists.ord_customerid')
                        ->get();

                    // Group orders by their respective dates within the week
                    $ordersByDateWithinWeek = [];
                    foreach ($ordersByWeek as $order) {
                        $orderDate = Carbon::parse($order->ord_date)->format('Y-m-d');
                        $dayName = Carbon::parse($order->ord_date)->format('l'); // Get the day name
                        $ordersByDateWithinWeek[$orderDate][$dayName][] = $order;
                    }

                    // Calculate the sum of 'ord_amount' for each date within the week
                    $totalAmountByDateWithinWeek = [];
                    foreach ($ordersByDateWithinWeek as $orderDate => $orders) {
                        foreach ($orders as $dayName => $dayOrders) {
                            $totalAmountByDateWithinWeek[$orderDate][$dayName] = collect($dayOrders)->sum('ord_amount');
                        }
                    }

                    // Calculate the total sum of 'ord_amount' for the entire week
                    $totalAmount = collect($ordersByWeek)->sum('ord_amount');

                    // Format the week's start and end dates
                    $formattedWeekStartDate = $weekStartDate->format('Y-m-d');
                    $formattedWeekEndDate = $weekEndDate->format('Y-m-d');

                    $key = $formattedWeekStartDate . ' - ' . $formattedWeekEndDate;

                    $paymentStatuses = $ordersByWeek->pluck('ord_paymentstatus')->unique()->toArray();
                    // Add orders for each date within the week along with the total amount to the result array
                    $resultByWeek[$key] = [
                        'orders_by_date_within_week' => $ordersByDateWithinWeek,
                        'total_amount_by_date_within_week' => $totalAmountByDateWithinWeek,
                        'total_amount' => $totalAmount,
                        'payment_status' => $paymentStatuses,
                    ];
                }

                // Assigning the result to a property of the object
                $customer_view->resultByWeek = $resultByWeek;


                //----------------------------------------- paid----------------------------------------------------
                $checkinvoice = InvoicePayment::where(['customer_id' => $customer_view->id,'razorpay_status' => 'captured',])->select('id')->get();


                $resultByWeekpaid = [];

                foreach ($checkinvoice as $invoice) {
                    $resultByWeekpaid[$invoice->id] = [];

                    $lastSevenDatespaid = DB::table('orderslists')
                        ->join('invoice_payments', 'invoice_payments.id', '=', 'orderslists.ord_invoiceid')
                        ->where([
                            'ord_branchid' => $branch_id,
                            'orderslists.ord_customerid' => $customer_viewpaid->id,
                            'orderslists.ord_deliverystatus' => 'DELIVERED',
                            'orderslists.ord_customer_subcid' => $customer_viewpaid->cust_subcplan,
                            'orderslists.ord_paymentstatus' => 'RECEIVED',
                            'ord_invoiceid' => $invoice->id,
                            'invoice_payments.razorpay_status' => 'captured',
                        ])
                        ->orderBy('ord_date', 'desc')
                        ->distinct('ord_date')
                        ->pluck('ord_date')
                        ->toArray();



                    foreach ($lastSevenDatespaid as $date) {
                        $weekStartDate = Carbon::parse($date)->startOfWeek();
                        $weekEndDate = Carbon::parse($date)->endOfWeek();

                        $ordersByWeekpaid = DB::table('orderslists')
                            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                            ->join('invoice_payments', 'invoice_payments.id', '=', 'orderslists.ord_invoiceid')
                            ->whereBetween('ord_date', [$weekStartDate, $weekEndDate])
                            ->where([
                                'ord_branchid' => $branch_id,
                                'orderslists.ord_customerid' => $customer_viewpaid->id,
                                'orderslists.ord_deliverystatus' => 'DELIVERED',
                                'orderslists.ord_customer_subcid' => $customer_viewpaid->cust_subcplan,
                                'orderslists.ord_paymentstatus' => 'RECEIVED',
                                'ord_invoiceid' => $invoice->id,
                                'invoice_payments.razorpay_status' => 'captured',
                            ])
                            // ->whereNot('ord_paymentstatus','RECEIVED')
                            ->select(
                                'orderslists.id as orderlist_mainid',
                                'orderslists.ord_customerid',
                                'capacities.capa_lit',
                                'capacities.capa_per_cup',
                                'categories.cat_name',
                                'orderslists.ord_quantitycount',
                                'orderslists.ord_sugartype',
                                'orderslists.ord_session',
                                'orderslists.ord_amount',
                                'orderslists.ord_ordertype',
                                'orderslists.ord_date',
                                'orderslists.ord_dayname',
                                'orderslists.ord_customer_subcid',
                                'orderslists.ord_paymentstatus',
                            )
                            ->orderBy('orderslists.ord_date') // Order by date within the week
                            ->orderByDesc('orderslists.ord_customerid')
                            ->get();

                        // Group orders by their respective dates within the week
                        $ordersByDateWithinWeek = [];
                        foreach ($ordersByWeekpaid as $order) {
                            $orderDate = Carbon::parse($order->ord_date)->format('Y-m-d');
                            $dayName = Carbon::parse($order->ord_date)->format('l'); // Get the day name
                            $ordersByDateWithinWeek[$orderDate][$dayName][] = $order;
                        }

                        // Calculate the sum of 'ord_amount' for each date within the week
                        $totalAmountByDateWithinWeek = [];
                        foreach ($ordersByDateWithinWeek as $orderDate => $orders) {
                            foreach ($orders as $dayName => $dayOrders) {
                                $totalAmountByDateWithinWeek[$orderDate][$dayName] = collect($dayOrders)->sum('ord_amount');
                            }
                        }

                        // Calculate the total sum of 'ord_amount' for the entire week
                        $totalAmount = collect($ordersByWeekpaid)->sum('ord_amount');

                        // Format the week's start and end dates
                        $formattedWeekStartDate = $weekStartDate->format('Y-m-d');
                        $formattedWeekEndDate = $weekEndDate->format('Y-m-d');

                        $key = $formattedWeekStartDate . ' - ' . $formattedWeekEndDate;

                        $paymentStatuses = $ordersByWeekpaid->pluck('ord_paymentstatus')->unique()->toArray();
                        // Add orders for each date within the week along with the total amount to the result array
                        $resultByWeekpaid[$invoice->id][$key] = [
                            'orders_by_date_within_week' => $ordersByDateWithinWeek,
                            'total_amount_by_date_within_week' => $totalAmountByDateWithinWeek,
                            'total_amount' => $totalAmount,
                            'payment_status' => $paymentStatuses,
                        ];
                    }
                }
                // Assigning the result to a property of the object
                $customer_viewpaid->resultByWeekpaid = $resultByWeekpaid;

                //  -------------------------------------------- monthly subscription check------------------------------------------------------
            } elseif ($customer_view->cust_subcplan == 3 && $customer_viewpaid->cust_subcplan == 3) {
                $lastSevenDates = DB::table('orderslists')
                    ->where([
                        'ord_branchid' => $branch_id,
                        'orderslists.ord_customerid' => $customer_view->id,
                        'orderslists.ord_deliverystatus' => 'DELIVERED',
                        'orderslists.ord_customer_subcid' => $customer_view->cust_subcplan,
                        'orderslists.ord_paymentstatus' => 'PENDING',
                    ])
                    ->orderBy('ord_date', 'desc')
                    ->distinct('ord_date')
                    ->pluck('ord_date')
                    ->toArray();

                $resultByMonth = [];

                foreach ($lastSevenDates as $date) {
                    $monthStartDate = Carbon::parse($date)->startOfMonth();
                    $monthEndDate = Carbon::parse($date)->endOfMonth();

                    $weekNumbers = [];
                    $weekStartDate = $monthStartDate->copy()->startOfWeek();
                    $weekEndDate = $weekStartDate->copy()->endOfWeek();

                    while ($weekStartDate->lte($monthEndDate)) {
                        $weekNumbers[] = 'Week ' . $weekStartDate->weekOfMonth;
                        $weekStartDate->addWeek();
                        $weekEndDate->addWeek();
                    }

                    $ordersByMonth = DB::table('orderslists')
                        ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                        ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                        ->whereBetween('ord_date', [$monthStartDate, $monthEndDate])
                        ->where([
                            'ord_branchid' => $branch_id,
                            'orderslists.ord_customerid' => $customer_view->id,
                            'orderslists.ord_deliverystatus' => 'DELIVERED',
                            'orderslists.ord_customer_subcid' => $customer_view->cust_subcplan,
                            'orderslists.ord_paymentstatus' => 'PENDING',

                        ])
                        // ->whereNot('ord_paymentstatus','RECEIVED')
                        ->select(
                            'orderslists.id as orderlist_mainid',
                            'orderslists.ord_customerid',
                            'capacities.capa_lit',
                            'capacities.capa_per_cup',
                            'categories.cat_name',
                            'orderslists.ord_quantitycount',
                            'orderslists.ord_sugartype',
                            'orderslists.ord_session',
                            'orderslists.ord_amount',
                            'orderslists.ord_ordertype',
                            'orderslists.ord_date',
                            'orderslists.ord_dayname',
                            'orderslists.ord_customer_subcid',
                            'orderslists.ord_paymentstatus',
                        )
                        ->orderBy('orderslists.ord_date') // Order by date within the month
                        ->orderByDesc('orderslists.ord_customerid')
                        ->get();

                    // Group orders by their respective dates within the month
                    $ordersByDateWithinMonth = [];
                    foreach ($ordersByMonth as $order) {
                        $orderDate = Carbon::parse($order->ord_date)->format('Y-m-d');
                        $ordersByDateWithinMonth[$orderDate][] = $order;
                    }

                    // Group orders by day within each date
                    foreach ($ordersByDateWithinMonth as $orderDate => $orders) {
                        $ordersByDay = [];
                        foreach ($orders as $order) {
                            $dayName = Carbon::parse($order->ord_date)->format('l'); // Get the day name
                            $ordersByDay[$dayName][] = $order;
                        }
                        $ordersByDateWithinMonth[$orderDate] = $ordersByDay;
                    }

                    // Calculate the total amount for each date within the month
                    $totalAmountByDateWithinMonth = [];
                    foreach ($ordersByDateWithinMonth as $orderDate => $orders) {
                        $totalAmountByDateWithinMonth[$orderDate] = collect($orders)->flatten()->sum('ord_amount');
                    }

                    // Calculate the total sum of 'ord_amount' for the entire month
                    $totalAmount = collect($ordersByMonth)->sum('ord_amount');

                    // Format the month's start and end dates with month and year
                    $formattedMonthStartDate = $monthStartDate->format('F Y');

                    $key = $formattedMonthStartDate;

                    $paymentStatuses =  $ordersByMonth->pluck('ord_paymentstatus')->unique()->toArray();
                    // Add orders for each date within the month along with the total amount to the result array
                    $resultByMonth[$key] = [
                        'week_numbers' => $weekNumbers, // Add week numbers
                        'orders_by_date_within_month' => $ordersByDateWithinMonth,
                        'total_amount_by_date_within_month' => $totalAmountByDateWithinMonth,
                        'total_amount' => $totalAmount,
                        'payment_status' => $paymentStatuses,
                    ];
                }

                // Assigning the result to a property of the object
                $customer_view->resultByMonth = $resultByMonth;

                //-------------------------- paid--------------------------------------------------


                $resultByMonthpaid = [];

                $checkinvoice = InvoicePayment::where(['customer_id' => $customer_view->id,'razorpay_status' => 'captured',])->select('id')->get();

                foreach ($checkinvoice as $invoice) {
                    $resultByMonthpaid[$invoice->id] = [];

                    $lastSevenDatespaid = DB::table('orderslists')
                        ->join('invoice_payments', 'invoice_payments.id', '=', 'orderslists.ord_invoiceid')
                        ->where('orderslists.ord_branchid', $branch_id)
                        ->where('orderslists.ord_customerid', $customer_viewpaid->id)
                        ->where('orderslists.ord_deliverystatus', 'DELIVERED')
                        ->where('orderslists.ord_customer_subcid', $customer_viewpaid->cust_subcplan)
                        ->where('orderslists.ord_paymentstatus', 'RECEIVED')
                        ->where('ord_invoiceid', $invoice->id)
                        ->where('invoice_payments.razorpay_status', 'captured',)
                        ->orderBy('ord_date', 'desc')
                        ->distinct('ord_date')
                        ->pluck('ord_date')
                        ->toArray();

                    foreach ($lastSevenDatespaid as $date) {
                        $monthStartDate = Carbon::parse($date)->startOfMonth();
                        $monthEndDate = Carbon::parse($date)->endOfMonth();

                        $weekNumbers = [];
                        $weekStartDate = $monthStartDate->copy()->startOfWeek();
                        $weekEndDate = $weekStartDate->copy()->endOfWeek();

                        while ($weekStartDate->lte($monthEndDate)) {
                            $weekNumbers[] = 'Week ' . $weekStartDate->weekOfMonth;
                            $weekStartDate->addWeek();
                            $weekEndDate->addWeek();
                        }

                        $ordersByMonthpaid = DB::table('orderslists')
                            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                            ->join('invoice_payments', 'invoice_payments.id', '=', 'orderslists.ord_invoiceid')
                            ->whereBetween('ord_date', [$monthStartDate, $monthEndDate])
                            ->where([
                                'ord_branchid' => $branch_id,
                                'orderslists.ord_customerid' => $customer_viewpaid->id,
                                'orderslists.ord_deliverystatus' => 'DELIVERED',
                                'orderslists.ord_customer_subcid' => $customer_viewpaid->cust_subcplan,
                                'orderslists.ord_paymentstatus' => 'RECEIVED',
                                'ord_invoiceid' => $invoice->id,
                                'invoice_payments.razorpay_status' => 'captured',
                            ])
                            // ->whereNot('ord_paymentstatus','RECEIVED')
                            ->select(
                                'orderslists.id as orderlist_mainid',
                                'orderslists.ord_customerid',
                                'capacities.capa_lit',
                                'capacities.capa_per_cup',
                                'categories.cat_name',
                                'orderslists.ord_quantitycount',
                                'orderslists.ord_sugartype',
                                'orderslists.ord_session',
                                'orderslists.ord_amount',
                                'orderslists.ord_ordertype',
                                'orderslists.ord_date',
                                'orderslists.ord_dayname',
                                'orderslists.ord_customer_subcid',
                                'orderslists.ord_paymentstatus',
                            )
                            ->orderBy('orderslists.ord_date') // Order by date within the month
                            ->orderByDesc('orderslists.ord_customerid')
                            ->get();

                        // Group orders by their respective dates within the month
                        $ordersByDateWithinMonth = [];
                        foreach ($ordersByMonthpaid as $order) {
                            $orderDate = Carbon::parse($order->ord_date)->format('Y-m-d');
                            $ordersByDateWithinMonth[$orderDate][] = $order;
                        }

                        // Group orders by day within each date
                        foreach ($ordersByDateWithinMonth as $orderDate => $orders) {
                            $ordersByDay = [];
                            foreach ($orders as $order) {
                                $dayName = Carbon::parse($order->ord_date)->format('l'); // Get the day name
                                $ordersByDay[$dayName][] = $order;
                            }
                            $ordersByDateWithinMonth[$orderDate] = $ordersByDay;
                        }

                        // Calculate the total amount for each date within the month
                        $totalAmountByDateWithinMonth = [];
                        foreach ($ordersByDateWithinMonth as $orderDate => $orders) {
                            $totalAmountByDateWithinMonth[$orderDate] = collect($orders)->flatten()->sum('ord_amount');
                        }

                        // Calculate the total sum of 'ord_amount' for the entire month
                        $totalAmount = collect($ordersByMonthpaid)->sum('ord_amount');

                        // Format the month's start and end dates with month and year
                        $formattedMonthStartDate = $monthStartDate->format('F Y');

                        $key = $formattedMonthStartDate;

                        $paymentStatuses =  $ordersByMonthpaid->pluck('ord_paymentstatus')->unique()->toArray();
                        // Add orders for each date within the month along with the total amount to the result array
                        $resultByMonthpaid[$invoice->id][$key] = [
                            'week_numbers' => $weekNumbers, // Add week numbers
                            'orders_by_date_within_month' => $ordersByDateWithinMonth,
                            'total_amount_by_date_within_month' => $totalAmountByDateWithinMonth,
                            'total_amount' => $totalAmount,
                            'payment_status' => $paymentStatuses,
                        ];
                    }
                }
                // Assigning the result to a property of the object
                $customer_viewpaid->resultByMonthpaid = $resultByMonthpaid;
            }
            // dd($customer_view, $customer_viewpaid);
            return view('websitefile.customer.customer-payment', compact('customer_view', 'customer_viewpaid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Something went wrong! Please try again later.');
        }
    }



    public function customerprofile()
    {
        try {
            $customerprimaryid = session('customerid');
            $branch_id = session('branch_id');

            $profiledetails = CustomerRegister::where(['id' => $customerprimaryid, 'branch_id' => $branch_id])->first();

            $subname = Subscriptionplan::where(['sub_status' => 1, 'id' => $profiledetails->cust_subcplan])->select('Sub_title')->first();

            return view('websitefile.customer.customer-profile', compact('profiledetails', 'subname'));
        } catch (\Exception $e) {

            return redirect()->back()->with('failed', 'serve is down. Please try again later.');
        }
    }


    public function subscriptioncancel(Request $request)
    {
        try {
            $customerid = $request->input('customerid');
            $subscriptionid = $request->input('subscriptionid');
            $branch_id = $request->input('branch_id');

            $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
            $formattedDate = $currentDate->format('Y-m-d H:i:s');

            // Check if both customerid and subscriptionid are present
            if (!$customerid || !$subscriptionid) {
                // Redirect back with a message if any of the fields are missing
                return redirect()->back()->with('failed', 'Missing required fields');
            } else {
                $dbcheck = Subscriptioncancel::where([
                    'subcan_subsid' => $subscriptionid,
                    'subcan_customerid' => $customerid,
                    'branch_id' => $branch_id,
                    // 'subcan_datetime' => $formattedDate,
                ])->first();

                if (!empty($dbcheck)) {
                    return redirect()->back()->with('failed', 'You Already Send cancel Request');
                } else {
                    // Insert subscription cancel record into the database
                    Subscriptioncancel::insert([
                        'subcan_subsid' => $subscriptionid,
                        'subcan_customerid' => $customerid,
                        'subcan_datetime' => $formattedDate, // Use Laravel's helper function for current datetime
                        'subcan_reason' => 'I cancel the subscription because I no longer need it.',
                        'branch_id' => $branch_id,
                    ]);
                    // Redirect back with a success message
                    return redirect()->back()->with('success', 'Your Subscription Cancel Request has been sent');
                }
            }
        } catch (\Exception $e) {
            // Redirect back with a failure message if an exception occurs
            return redirect()->back()->with('failed', 'Your Subscription Cancel Request was not sent');
        }
    }


    public function subchange(Request $request)
    {
        // dd($request);
        try {
            $customerid = $request->input('customerid');
            $subscriptionid = $request->input('subscriptionid');

            $branch_id = $request->input('branch_id');

            $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
            $formattedDate = $currentDate->format('Y-m-d H:i:s');

            if (!$customerid || !$subscriptionid) {
                // Redirect back with a message if any of the fields are missing
                return redirect()->back()->with('failed', 'Missing required fields');
            } else {
                $dbcheck =  Subscriptionchange::where([
                    'subcha_subsid' => $subscriptionid,
                    'subcha_customerid' => $customerid,
                    'branch_id' => $branch_id,
                    // 'subcha_datetime' => $formattedDate,
                ])->first();

                if ($dbcheck) {
                    return redirect()->back()->with('failed', 'You Already Send change Request');
                } else {
                    // Insert subscription change record
                    Subscriptionchange::insert([
                        'subcha_subsid' => $subscriptionid,
                        'subcha_customerid' => $customerid,
                        'subcha_datetime' => $formattedDate,
                        'branch_id' => $branch_id,
                        'subcha_reason' => 'I changed my mind and want a different plan',
                    ]);
                }


                return redirect()->back()->with('success', 'Your Subscription Change Request has been sent.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Your Subscription Change Request was not sent.');
        }
    }


    // public function customersubcribeformpage(){
    //     return view('websitefile.customer.customer-subscribeform');
    // }


    public function customersubcribeform(Request $request)
    {
        try {
            // dd($request);
            // $subcid = $id;
            $subscribeid = $request->input("subsc_id");
            $branch_id = $request->input('branch_id');
            $customer_id = $request->input('customer_id');

            $checkcustomer = Customerorder::where(['customerid' => $customer_id, 'branch_id' => $branch_id])->first();

            if ($checkcustomer) {
                CustomerRegister::where(['id' => $customer_id, 'cust_loginacs' => 1, 'cust_status' => 1, 'cust_subcplan' => null, 'branch_id' => $branch_id])->update(['cust_subcplan' => $subscribeid]);
                return redirect()->route('customer.pricing')->with('success', 'subcription change success');
            } else {
                $data = DB::table('menus')
                    ->join('categories', 'categories.id', 'menus.menu_catid')
                    ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])->select('menu_catid', 'cat_name', 'cat_file')->distinct()->get();

                $days = Day::where('day_status', 1)->get();
                return view('websitefile.customer.customer-subscribeform', compact('data', 'days', 'subscribeid', 'branch_id'));
            }
        } catch (\Exception $e) {
            return redirect()->route('customer.pricing')->with('failed', 'please try later');
        }
    }

    public function customersubcribeinsert(Request $request)
    {

        // dd($request);
        try {
            $customerid = $request->input('customerid');
            $subscribeid = $request->input('subsc_id');
            $branch_id = $request->input('branch_id');

            $categoryid = $request->input('categoryid');
            $menu = $request->input('menuid');
            $count = $request->input('count');

            $sugartype = $request->input('sugartype');

            // $amount = $request->input('amount');
            $morn = $request->input('morn');
            $even = $request->input('even');
            $days = $request->input('days');


            if ((isset($morn) || isset($even)) && isset($days)) {
                // customer register
                CustomerRegister::where([
                    "id" => $customerid,
                    "cust_loginacs" => 1,
                    'cust_status' => 1,
                    'branch_id' => $branch_id
                ])->update(['cust_subcplan' => $subscribeid]);


                //customer order
                $orderinsert = [];

                for ($i = 0; $i < count($categoryid); $i++) {
                    $orderinsert[] = [
                        'ordr_catid' => $categoryid[$i],
                        'ordr_menu' => $menu[$i],
                        'ordr_count' => $count[$i],
                        // 'ordr_price' => $amount[$i],
                        'ordr_sugartype' => $sugartype[$i],
                    ];
                }

                foreach ($orderinsert as  $key => $value) {
                    Customerorder::insert([
                        'branch_id' => $branch_id,
                        'customerid' => $customerid,
                        'categoryid' => $value['ordr_catid'],
                        'menuid' => $value['ordr_menu'],
                        'quantitycount' => $value['ordr_count'],
                        // 'totalamount' => $value['ordr_price'],
                        'sugartype' => $value['ordr_sugartype'],
                    ]);
                }
                //customer session
                Customersession::insert([
                    'customerid' => $customerid,
                    'session_morn' => $morn,
                    'session_even' => $even,
                    'branch_id' => $branch_id
                ]);

                //customer days
                $dayinsert = [];

                for ($i = 0; $i < count($days); $i++) {
                    $dayinsert[] = [
                        'day' => $days[$i]
                    ];
                }

                foreach ($dayinsert as $key => $values) {
                    Customerdays::insert([
                        'customerid' => $customerid,
                        'day_name' => $values['day'],
                        'branch_id' => $branch_id
                    ]);
                }

                return redirect()->route('customer.pricing')->with('success', 'Your order is saved');
            } else {
                return redirect()->route('customer.pricing')->with('failed', 'please select session and days');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Your order not save');
        }
    }

    public function additionalorder(Request $request)
    {
        try {
            $branch_id = $request->input('branch_id');
            $customerprimaryid = session('customerid');

            $data = DB::table('menus')
                ->join('categories', 'categories.id', 'menus.menu_catid')
                ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])->select('menu_catid', 'cat_name', 'cat_file')->distinct()->get();




            $customerorder_morn = DB::table('customer_registers')
                ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
                ->join('customersession_atls', 'customersession_atls.customerid', '=', 'customer_registers.id')
                ->where([
                    'customer_registers.id' => $customerprimaryid,
                    'customer_registers.branch_id' => $branch_id,
                    'customer_registers.cust_loginacs' => 1,
                    // 'customersession_atls.session_date' =>  $formattedDate,
                ])
                ->select(
                    'customer_registers.id as customer_mainid',
                    'customer_registers.branch_id',
                    'customer_registers.cust_businessname',
                    'customer_registers.cust_phone',
                    'customer_registers.cust_deliveryaddress',
                    'customersession_atls.session_morn',
                    'customersession_atls.session_even',
                    'customersession_atls.session_date',
                )
                ->orderBy('session_date', 'desc')
                ->limit(10)
                ->get();



            if (!empty($customerorder_morn)) {
                foreach ($customerorder_morn as $key => $requested) {
                    $result = DB::table('customerorder_atls')
                        // ->join('categories', 'categories.id', '=', 'customerorder_atls.categoryid')
                        ->join('menus', 'menus.id', '=', 'customerorder_atls.menuid')
                        ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                        ->leftJoin('categories', 'categories.id', '=', 'menus.menu_catid')
                        ->select(
                            'menus.id as menu_mainid',
                            'customerorder_atls.menuid',
                            'menus.menu_capaid',
                            'capacities.id as capacities_mainid',
                            'menus.menu_catid',
                            'categories.id as category_mainid',
                            'categories.cat_name',
                            'capacities.capa_lit',
                            'capacities.capa_per_cup',
                            'menus.menu_price',
                            'customerorder_atls.quantitycount',
                            'customerorder_atls.sugartype',
                            'customerorder_atls.customerid',
                            'customerorder_atls.order_date',
                        )
                        ->where([
                            'customerorder_atls.customerid' => $customerprimaryid,
                            'customerorder_atls.order_date' => $requested->session_date,
                        ])
                        ->get();

                    $customerorder_morn[$key]->result = $result;
                }
            }
            // dd($customerorder_morn);

            return view('websitefile.customer.customer-additionalorder', compact('data', 'branch_id', 'customerorder_morn'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'serve is down !');
        }
    }

    public function additionalorderinsert(Request $request)
    {

        // dd($request);
        try {
            $customerid = $request->input('customerid');

            $branch_id = $request->input('branch_id');

            $categoryid = $request->input('categoryid');
            $menu = $request->input('menuid');
            $count = $request->input('count');

            $sugartype = $request->input('sugartype');

            // $amount = $request->input('amount');
            $morn = $request->input('morn');
            $even = $request->input('even');
            $date = $request->input('date');

            $checkdays = Customerorder_atl::where(['order_date' => $date, 'customerid' => $customerid])->first();

            if ($checkdays) {
                return redirect()->route('customer.shop')->with('failed', 'This date already save! Please check your data');
            } else {
                if ((isset($morn) || isset($even)) && isset($date)) {


                    //customer session
                    $sessionid = Customersession_atl::insertGetId([
                        'customerid' => $customerid,
                        'session_morn' => $morn,
                        'session_even' => $even,
                        'branch_id' => $branch_id,
                        'session_date' => $date,
                    ]);


                    //customer order
                    $orderinsert = [];

                    for ($i = 0; $i < count($categoryid); $i++) {
                        $orderinsert[] = [
                            'ordr_catid' => $categoryid[$i],
                            'ordr_menu' => $menu[$i],
                            'ordr_count' => $count[$i],
                            // 'ordr_price' => $amount[$i],
                            'ordr_sugartype' => $sugartype[$i],
                        ];
                    }

                    foreach ($orderinsert as  $key => $value) {
                        Customerorder_atl::insert([
                            'customersession_altsid' => $sessionid,
                            'branch_id' => $branch_id,
                            'customerid' => $customerid,
                            'categoryid' => $value['ordr_catid'],
                            'menuid' => $value['ordr_menu'],
                            'quantitycount' => $value['ordr_count'],
                            // 'totalamount' => $value['ordr_price'],
                            'sugartype' => $value['ordr_sugartype'],
                            'order_date' => $date,
                        ]);
                    }

                    //customer days
                    // $dayinsert = [];

                    // for ($i = 0; $i < count($days); $i++) {
                    //     $dayinsert[] = [
                    //         'day' => $days[$i]
                    //     ];
                    // }

                    // foreach ($dayinsert as $key => $values) {
                    //     Customerdays_atl::insert([
                    //         'customerid' => $customerid,
                    //         'day_name' => $values['day'],
                    //         'branch_id' => $branch_id
                    //     ]);
                    // }

                    return redirect()->route('customer.shop')->with('success', 'Your order is saved');
                } else {
                    return redirect()->route('customer.shop')->with('failed', 'please select session and days');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('customer.shop')->with('failed', 'Your order not save');
        }
    }

    // public function subcustomerupdate(Request $request){
    //     try{

    //     }catch(\Exception $e){

    //     }
    // }


    public function customerlogout()
    {
        try {
            if (Session::has('customerid')) {
                Session::pull('customerid');
                return redirect()->route('customer.login');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Server is down! Please Try Again Later');
        }
    }


    public function getitembyquantity(Request $request)
    {
        $data['quantity'] = DB::table('menus')
            ->join('capacities', 'capacities.id', 'menus.menu_capaid')
            ->where(['menu_status' => 1])
            ->where(['menus.menu_catid' => $request->cat_id])
            ->select('capa_lit', 'menu_capaid', 'capa_per_cup', 'menu_price', 'menus.id')
            ->get();
        return response()->json($data);
    }
}

// // Get the current date
// $date = Carbon::now();

// // Format current date into abbreviated day name
// $formattedDay = $date->format('D'); // Outputs the abbreviated day name, e.g., Mon, Tue

// dd($formattedDay);
