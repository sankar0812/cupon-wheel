<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Orderslist;
use Illuminate\Http\Request;
use App\Models\InvoicePayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{


    public function downloadInvoice($invoiceId)
    {
        // try {
            $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
            $formattedDate = $currentDate->format('Y-m-d H:i:s');

            $customerprimaryid = session('customerid');
            // Generate the HTML for the invoice
            $invoiceget = DB::table('invoice_payments')
                ->join('customer_registers', 'customer_registers.id', '=', 'invoice_payments.customer_id')
                ->select(
                    'invoice_payments.id as invoicepaymentid',
                    'invoice_payments.customer_id',
                    'invoice_payments.amount',
                    'invoice_payments.paid_at',
                    'customer_registers.id as customer_registersid',
                    'customer_registers.cust_billingaddress',
                    'customer_registers.cust_businessname',
                    'customer_registers.cust_phone',
                    'customer_registers.cust_emailaddress',
                    'customer_registers.cust_subcplan',
                    'customer_registers.cust_loginacs',
                )
                ->where('invoice_payments.id', $invoiceId)
                ->where('invoice_payments.customer_id', $customerprimaryid)
                ->first();

            if (!empty($invoiceget)) {
                // Fetch associated orders
                $invoicedetails = DB::table('orderslists')
                    ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                    ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')->where([
                        'ord_invoiceid' => $invoiceget->invoicepaymentid,
                        'ord_customerid' => $invoiceget->customer_registersid,
                        'ord_customer_subcid' => $invoiceget->cust_subcplan,
                        'ord_paymentstatus' => 'RECEIVED', // You might want to reconsider using two conditions for the same field
                        'ord_deliverystatus' => 'DELIVERED', // Redundant line removed
                    ])
                    ->orderBy('ord_date', 'desc')->get();
            }

            $html = '
        <html>
        <head>
            <title>Invoice</title>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    text-align: center;
                    padding: 8px 0; /* Adjust vertical padding */
                    border-bottom: 1px solid #ddd; /* Add border bottom to separate rows */
                }
                th {
                    background-color: #f2f2f2; /* Add background color for table header */
                }
                .invoice-box {
                    max-width: 800px;
                    margin: auto;
                    padding: 30px;
                    border: 1px solid #eee;
                    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                    font-size: 16px;
                    line-height: 24px;
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    color: #555;
                }
                .invoice-box table {
                    width: 100%;
                    line-height: inherit;
                    text-align: left;
                }
                .invoice-box td {
                    padding: 5px;
                    vertical-align: top;
                }
                .invoice-box .title {
                    padding-bottom: 20px;
                    font-size: 45px;
                    line-height: 45px;
                    color: #333;
                }
                .invoice-box .information {
                    padding-bottom: 40px;
                }
                .invoice-box .heading {
                    background: #eee;
                    border-bottom: 1px solid #ddd;
                    font-weight: bold;
                }
                .invoice-box .details {
                    padding-bottom: 20px;
                }
                .invoice-box .item {
                    border-bottom: 1px solid #eee;
                }
                .invoice-box .item.last {
                    border-bottom: none;
                }
                .invoice-box .total td {
                    border-top: 2px solid #eee;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>

        <div class="invoice-box">
        <center><h1>CUP ON WHEEEL</h1></center>
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="6">
                        <table>
                            <tr>
                                <td style="text-align: right;">
                                    Invoice #: ' .  $invoiceget->invoicepaymentid . '<br>
                                    Bill Date: ' .  $formattedDate . '<br>
                                    Payment Date: ' .  $invoiceget->paid_at . '<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="6">
                        <table>
                            <tr>';

            // Split the billing address into individual components
            $addressParts = explode(',', $invoiceget->cust_billingaddress);

            // Output each address component with step-by-step styling
            $html .= '<td style="text-align: left;">';
            foreach ($addressParts as $part) {
                $html .= '<p style="margin: 0;">' . trim($part) . '</p>';
            }
            $html .= '</td>';

            $html .= '<td style="text-align: right;">
                        ' . $invoiceget->cust_businessname . '<br>
                        ' . $invoiceget->cust_phone . '<br>
                        ' . $invoiceget->cust_emailaddress . '
                    </td>
                </tr>
            </table>
        </td>
        </tr>
        <tr class="heading">
            <td>Order Date</td>
            <td>Category</td>
            <td>Quantity</td>
            <td>Quantity count</td>
            <td>Session</td>
            <td>Price</td>
        </tr>';

            // Populate the invoice items
            foreach ($invoicedetails as $item) {
                $html .= '
            <tr class="item">
                <td>' . $item->ord_date  . '</td>
                <td>' . $item->cat_name . '</td>
                <td>' . $item->capa_lit  . '</td>
                <td>' . $item->ord_quantitycount  . ' nos</td>
                <td>' . $item->ord_session . '</td>
                <td>' . $item->ord_amount . ' INR</td>
            </tr>';
            }

            $html .= '
            <tr class="total">
                <td colspan="5"></td>
                <td style="text-align: right;">Total: ' . $invoiceget->amount . ' INR</td>
            </tr>
        </table>
        </div>
        </body>
        </html>';

            // Load Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // (Optional) Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF (inline or as download)
            return $dompdf->stream('Cup on wheel_' . $invoiceget->invoicepaymentid . '.pdf');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('failed', 'Please try again later.');
        // }
    }
}
