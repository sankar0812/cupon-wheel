<?php

namespace App\Http\Controllers;

use Exception;
use Razorpay\Api\Api;
use App\Models\Orderslist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InvoicePayment;
use Illuminate\Support\Carbon;
use Razorpay\Api\Invoice;

// use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    public function orderpayment(Request $request)
    {
        $api = new Api("rzp_test_UY1SGsrCIRVz7n", "4o8oEJOnvbPvx3htrYoSu2eP");

        $payment = $api->payment->fetch($request['razorpay_payment_id']);

        if (count($request->all()) && !empty($request['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($request['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

                // dd($response);

                $customer_id = $request->input('customer_id');
                $order_ids = $request->input('order_id');
                $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
                $formattedDate = $currentDate->format('Y-m-d H:i:s');
                // Extract the payment amount from the payment object
                $totalamount = $request->input('totalamount');
                $branch_id = $request->input('branch_id');
                $subsc_id = $request->input('subsc_id');
                $currentYear = date('y');
                $currentmonth_year = now()->format('Y-m');



                // Insert payment details into the database
                $getinvoiceid = InvoicePayment::insertGetId([
                    // 'invoice_id' => 1,
                    'customer_id' => $customer_id,
                    'branch_id' => $branch_id,
                    'subsc_id' => $subsc_id,
                    'amount' => $totalamount,
                    'paid_at' => $formattedDate,
                    'year' => $currentYear,
                    'month_year' => $currentmonth_year,

                    'razorpay_payment_id' => $request['razorpay_payment_id'],
                    'razorpay_entity' => $response->entity,
                    'razorpay_amount' => $response->amount,
                    'razorpay_currency' => $response->currency,
                    'razorpay_status' => $response->status,
                    'razorpay_method' => $response->method,
                    'razorpay_contact' => $response->contact,
                    'razorpay_email' => $response->email,
                    'razorpay_created_at' => $response->created_at,
                ]);


                // $currentYear = date('y'); // Get the current year (last two digits)

                InvoicePayment::where([
                    "id" => $getinvoiceid,
                    'customer_id' => $customer_id
                ])->update(['invoice_id' => $getinvoiceid]);

                foreach ($order_ids as $order_id) {
                    Orderslist::where('id', $order_id)->update([
                        'ord_invoiceid' => $getinvoiceid,
                        'ord_payment_recvdate' => $formattedDate,
                        'ord_paymentstatus' => 'RECEIVED'
                    ]);
                }
            } catch (Exception $e) {
                return $e->getMessage();
                // Session::put('error', $e->getMessage());
                return redirect()->route('customer.payment')->with('success', 'Payment failed! please try again later');
            }
        }

        // Session::put('success', 'Payment successful');
        return redirect()->route('customer.payment')->with('success', 'Payment successful!');
    }

    // public function orderpayment(Request $request)
    // {


    //     $api = new Api("rzp_test_9O8hkmIdQsBgbo", "FxEJqy0dQY0GMDaAVSrTsuZf");

    //     $payment = $api->payment->fetch($request['razorpay_payment_id']);

    //     if (count($request->all())  && !empty($request['razorpay_payment_id'])) {
    //         try {
    //             $response = $api->payment->fetch($request['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));


    //             $customer_id = $request->input('customer_id');
    //             // $date = $request->input('date');
    //             $order_ids = $request->input('order_id');
    //             // $totalamount = $request->input('totalamount');
    //             $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
    //             $formattedDate = $currentDate->format('Y-m-d H:i:s');

    //             $getinvoiceid = InvoicePayment::insertGetId([
    //                 'invoice_id' => '1',
    //                 'customer_id' => $customer_id,
    //                 'amount' =>  $payment,
    //                 'paid_at' => $formattedDate
    //             ]);

    //             foreach ($order_ids as $order_id) {
    //                 Orderslist::where([
    //                     'id' => $order_id,
    //                     // 'ord_date' => $date,
    //                 ])->update([
    //                     'ord_invoiceid' => $getinvoiceid,
    //                     'ord_payment_recvdate' => $formattedDate,
    //                     'ord_paymentstatus' => 'RECEIVED'
    //                 ]);
    //             }
    //         } catch (Exception $e) {
    //             return  $e->getMessage();
    //             Session::put('error', $e->getMessage());
    //             return redirect()->back();
    //         }
    //     }

    //     Session::put('success', 'Payment successful');
    //     return redirect()->back();
    // }
    // dd($request);
    //try {
    //     $customer_id = $request->input('customer_id');
    //     $date = $request->input('date');
    //     $order_ids = $request->input('order_id');
    //     $totalamount = $request->input('totalamount');
    //     $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
    //     $formattedDate = $currentDate->format('Y-m-d H:i:s');



    //     $getinvoiceid = InvoicePayment::insertGetId([
    //         'invoice_id' => '1',
    //         'customer_id' => $customer_id,
    //         'amount' => $totalamount,
    //         'paid_at'=> $formattedDate
    //     ]);




    //     foreach ($order_ids as $order_id) {
    //         Orderslist::where([
    //             'id' => $order_id,
    //             // 'ord_date' => $date,
    //         ])->update([
    //             'ord_invoiceid' => $getinvoiceid,
    //             'ord_payment_recvdate' => $formattedDate,
    //             'ord_paymentstatus' => 'RECEIVED'
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Payment received successfully');
    // } catch (\Exception $e) {
    //     return redirect()->back()->with('failed', 'Payment received failed');
    // }
    //}

}
