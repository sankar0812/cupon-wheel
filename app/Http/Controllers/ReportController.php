<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CustomerRegister;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //

    public function subscribersPerMonth()
    {
        // Fetch subscribers count along with business name, phone, and plan for each month
        $subscribersPerMonth = CustomerRegister::join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
            ->selectRaw('COUNT(*) as total_subscribers, MONTH(customer_registers.cust_regdate) as month')
            ->select('customer_registers.cust_businessname', 'customer_registers.cust_phone', 'customer_registers.cust_subcplan', 'subscriptionplans.Sub_title')
            ->get();


        $subscribersGroupedByMonth = [];
        foreach ($subscribersPerMonth as $subscriber) {
            $month = date('F', mktime(0, 0, 0, $subscriber->month, 1));
            if (!isset($subscribersGroupedByMonth[$month])) {
                $subscribersGroupedByMonth[$month] = [];
            }
            $subscribersGroupedByMonth[$month][] = $subscriber;
        }
        // dd($subscribersPerMonth);
        return view('report.subscriberreport', compact('subscribersGroupedByMonth'));

        // return $subscribersPerMonth;
    }


    public function deliveryreport(Request $request, $detail)
    {
        // dd($request);
        if ($detail == 'ALL') {
            $deliveriesByDeliveryBoy = DB::table('orderslists')
                ->join('deliveryboy_details', 'deliveryboy_details.id', '=', 'orderslists.ord_ass_deliveryboy')
                ->select('deliveryboy_details.name', DB::raw('COUNT(*) as total_deliveries'))
                ->groupBy('deliveryboy_details.name')
                ->get();
        } else {
            $dateParts = explode('-', $request->month);
            $currentMonth = intval($dateParts[1]); // Convert to integer

            // dd($currentMonth);
            // Query to get the number of deliveries made by each delivery person in the current month
            $deliveriesByDeliveryBoy = DB::table('orderslists')
                ->join('deliveryboy_details', 'deliveryboy_details.id', '=', 'orderslists.ord_ass_deliveryboy')
                ->select('deliveryboy_details.name', DB::raw('COUNT(*) as total_deliveries'))
                ->whereMonth('ord_date', $currentMonth)
                ->groupBy('deliveryboy_details.name')
                ->get();
        }
        // dd($deliveriesByDeliveryBoy);

        return view('report.deliveryreport', compact('deliveriesByDeliveryBoy'));
    }

    public function paymentreport(Request $request, $detail)
    {

        if ($detail == 'ALL') {
            $currentDateTime = Carbon::now();
            $formattedDate = $currentDateTime->format('Y-m');

            // Get the month from the parsed date
            $currentMonth = $currentDateTime->format('n');

            // dd($currentDateTime , $formattedDate , $currentMonth );

            $paidReport = DB::table('customer_registers')
            // ->join('orderslists', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->join('invoice_payments', 'customer_registers.id', '=', 'invoice_payments.customer_id')
                ->whereMonth('invoice_payments.paid_at', $currentMonth)
                ->select(
                    'customer_registers.id as customer_id',
                    'customer_registers.cust_businessname as customer_name',
                    DB::raw('MONTH(invoice_payments.paid_at) as month'),
                    DB::raw('COALESCE(SUM(invoice_payments.amount), 0) as total_paid')
                )
                ->groupBy('customer_registers.id', 'customer_registers.cust_businessname', DB::raw('MONTH(invoice_payments.paid_at)'))
                // ->where('orderslists.ord_paymentstatus', '!=', 'PENDING')
                ->get();

            $pendingReport = DB::table('customer_registers')
                ->join('orderslists', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->where('orderslists.ord_month', $formattedDate)
                ->select(
                    'customer_registers.id as customer_id',
                    'customer_registers.cust_businessname as customer_name',
                    DB::raw('(orderslists.ord_month) as month'),
                    DB::raw('COALESCE(SUM(orderslists.ord_amount), 0) as total_pending')
                )
                ->groupBy('customer_registers.id', 'customer_registers.cust_businessname', DB::raw('(orderslists.ord_month)'))
                ->where('orderslists.ord_paymentstatus', '=', 'PENDING')
                ->get();
        } else {
            // dd($request->month);
            $dateParts = explode('-', $request->month);
            $currentMonth = intval($dateParts[1]);

            $paidReport = DB::table('customer_registers')
                ->join('invoice_payments', 'customer_registers.id', '=', 'invoice_payments.customer_id')
                ->whereMonth('invoice_payments.paid_at', $currentMonth)
                ->select(
                    'customer_registers.id as customer_id',
                    'customer_registers.cust_businessname as customer_name',
                    DB::raw('MONTH(invoice_payments.paid_at) as month'),
                    DB::raw('COALESCE(SUM(invoice_payments.amount), 0) as total_paid')
                )
                ->groupBy('customer_registers.id', 'customer_registers.cust_businessname', DB::raw('MONTH(invoice_payments.paid_at)'))
                ->get();

            $pendingReport = DB::table('customer_registers')
                ->join('orderslists', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->where('orderslists.ord_month', $request->month)
                ->select(
                    'customer_registers.id as customer_id',
                    'customer_registers.cust_businessname as customer_name',
                    DB::raw('(orderslists.ord_month) as month'),
                    DB::raw('COALESCE(SUM(orderslists.ord_amount), 0) as total_pending')
                )
                ->groupBy('customer_registers.id', 'customer_registers.cust_businessname', DB::raw('(orderslists.ord_month)'))
                ->get();
        }

        // dd( $paidReport , $pendingReport );
        return view('report.paymentreport', compact('paidReport', 'pendingReport'));
    }


    public function ContainerReport(Request $request, $detail)
    {
        // If $selectedMonth is null, default to the current month
        // $selectedMonth = $request->month;

        if ($detail == 'ALL') {
            $selectedMonth = Carbon::now()->format('Y-m');
        } else {
            $selectedMonth = $request->month;
        }

        // Retrieve data from the database
        $reportData = DB::table('container_transactions')
        ->select(
            'customer_registers.cust_businessname',
            // 'container_id',
            'capacities.capa_lit',
            DB::raw('SUM(CASE WHEN transaction_type IN ("DELIVERED", "COLLECTED") THEN quantity_count ELSE 0 END) AS containers_delivered')            ,   
             DB::raw('SUM(CASE WHEN transaction_type = "COLLECTED" THEN quantity_count ELSE 0 END) AS containers_collected')
            )
            ->leftJoin('capacities', 'capacities.id', '=', 'container_transactions.container_id')
            ->Join('customer_registers', 'customer_registers.id', '=', 'container_transactions.customer_id')
            ->where('container_transactions.container_id', '!=', '4')
            ->where('transaction_month', $selectedMonth)
            ->groupBy('customer_registers.cust_businessname', 'capacities.capa_lit')
            ->get();
// dd($reportData);
        // Pass the report data to the view
        return view('report.containerreport', compact('reportData', 'selectedMonth'));
    }


    public function InvoiceReport(Request $request, $detail)
    {
        if ($detail == 'ALL') {
            $selectedMonth = Carbon::now()->format('Y-m');
        } else {
            $selectedMonth = $request->month;
        }


    // $todaydate = Carbon::now()->toDateString();
    $invoices = DB::table('invoice_payments')
        ->join('customer_registers', 'customer_registers.id', '=', 'invoice_payments.customer_id')
        ->join('subscriptionplans', 'subscriptionplans.id', '=', 'invoice_payments.subsc_id')
        ->where('invoice_payments.month_year', $selectedMonth)
        ->orderBy('invoice_payments.id', 'desc')
        // ->limit(10)
        ->get();
        return view('report.invoicereport', compact('invoices', 'selectedMonth'));
    }
}
