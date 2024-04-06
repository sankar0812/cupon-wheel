<?php

namespace App\Http\Controllers;

use App\Models\Orderslist;
use Illuminate\Http\Request;
use App\Models\InvoicePayment;
use Illuminate\Support\Carbon;
use App\Models\CustomerRegister;
use App\Models\deliveryboyDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function superadminHome()
    // {
    //     return view('adminHome');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deliveryHome()
    {
        $user_id = Auth::user()->id;
        $branch_id = Auth::user()->branch_id;
        $todayDate = Carbon::now()->format('Y-m-d');

        $details = deliveryboyDetails::where('user_id', $user_id)->first();
        $totalOrders = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();

        $totalOrder = $totalOrders->count();
        $mor = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'MOR')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $morcount = $mor->count();
        $evg = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'EVN')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $evgcount = $evg->count();

        $pendingOrders = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_deliverystatus', 'RUNNING')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();

        $pendingOrder = $pendingOrders->count();

        $morpending = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_deliverystatus', 'RUNNING')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'MOR')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $morpendingcount = $morpending->count();
        $evgpending = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_deliverystatus', 'RUNNING')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'EVN')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $evgpendingcount = $evgpending->count();

        $completedOrders = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_deliverystatus', 'DELIVERED')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();

        $completedOrder = $completedOrders->count();

        $morcompleted = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_deliverystatus', 'DELIVERED')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'MOR')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $morcompletedcount = $morcompleted->count();
        $evgcompleted = Orderslist::where('ord_ass_deliveryboy', $details->id)
            ->where('ord_deliverystatus', 'DELIVERED')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'EVN')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $evgcompletedcount = $evgcompleted->count();

        return view('deliveryboy.deliveryHome', compact('totalOrder', 'pendingOrder', 'completedOrder', 'evgcount', 'morcount', 'morpendingcount', 'evgpendingcount', 'morcompletedcount', 'evgcompletedcount'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {

        $branch_id = Auth::user()->branch_id;
        $todayDate = Carbon::now()->format('Y-m-d');


        $totalOrders = Orderslist::where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();

        $totalOrder = $totalOrders->count();
        $mor = Orderslist::where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'MOR')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $morcount = $mor->count();
        $evg = Orderslist::where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'EVN')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $evgcount = $evg->count();

        $pendingOrders = Orderslist::where('ord_deliverystatus', 'RUNNING')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();

        $pendingOrder = $pendingOrders->count();

        $morpending = Orderslist::where('ord_deliverystatus', 'RUNNING')
            ->where('ord_date', $todayDate)
            // ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'MOR')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $morpendingcount = $morpending->count();
        $evgpending = Orderslist::where('ord_deliverystatus', 'RUNNING')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'EVN')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $evgpendingcount = $evgpending->count();

        $completedOrders = Orderslist::where('ord_deliverystatus', 'DELIVERED')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();

        $completedOrder = $completedOrders->count();

        $morcompleted = Orderslist::where('ord_deliverystatus', 'DELIVERED')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'MOR')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $morcompletedcount = $morcompleted->count();
        $evgcompleted = Orderslist::where('ord_deliverystatus', 'DELIVERED')
            ->where('ord_date', $todayDate)
            ->where('ord_branchid', $branch_id)
            ->where('ord_session', 'EVN')
            ->select('ord_customerid')
            // ->groupBy('ord_customerid')
            ->get();
        $evgcompletedcount = $evgcompleted->count();

        $customers = CustomerRegister::where(['customer_registers.cust_loginacs' => 2, 'customer_registers.cust_delete' => 1, 'customer_registers.branch_id' => $branch_id])
            ->orderByDesc('customer_registers.id')
            ->limit(5)
            ->get();

        $paymentsData = collect([]);

        // Loop through the last 10 days
        for ($i = 0; $i < 10; $i++) {
            // Calculate the date for the current iteration
            $date = Carbon::now()->subDays($i)->toDateString();

            // Fetch payments for the current date where the status is "PENDING"
            $payments = DB::table('invoice_payments')
                ->whereDate('paid_at', $date)
                ->select(DB::raw('SUM(amount) as total_amount'))
                ->first();
// dd( $payments );
            // Add the date and total amount to the payments data collection
            $paymentsData->put(Carbon::parse($date)->format('M d'), $payments->total_amount ?? 0);
        }
        //    dd($paymentsData);

        $todaydate = Carbon::now()->toDateString();
        $invoices = DB::table('invoice_payments')
            ->join('customer_registers', 'customer_registers.id', '=', 'invoice_payments.customer_id')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'invoice_payments.subsc_id')
            ->whereDate('invoice_payments.paid_at', $todaydate)
            ->orderBy('invoice_payments.id', 'desc')
            ->limit(10)
            ->get();

        // $currentDateTime = Carbon::now();
        // $formattedDate = $currentDateTime->format('Y-m');

        $pendingReports = DB::table('customer_registers')
            ->join('orderslists', 'customer_registers.id', '=', 'orderslists.ord_customerid')
            ->select(
                'customer_registers.id as customer_id',
                'customer_registers.cust_businessname as customer_name',
                DB::raw('(orderslists.ord_month) as month'),
                DB::raw('COALESCE(SUM(orderslists.ord_amount), 0) as total_pending')
            )
            ->groupBy('customer_registers.id', 'customer_registers.cust_businessname', 'orderslists.ord_month')
            ->where('orderslists.ord_paymentstatus', '=', 'PENDING')
            ->get();

        // Group the results by month and then by company
        // Group the results by customer
        $pendingReportsByCustomer = $pendingReports->groupBy('customer_name');




        // dd($pendingReportsByCustomer);

        // dd($pendingReport);
        // dd($paymentsData);
        return view('adminHome', compact('totalOrder', 'pendingOrder', 'completedOrder', 'evgcount', 'morcount', 'morpendingcount', 'evgpendingcount', 'morcompletedcount', 'evgcompletedcount', 'customers', 'paymentsData', 'invoices', 'pendingReportsByCustomer'));
        // return view('adminHome');
    }
}
