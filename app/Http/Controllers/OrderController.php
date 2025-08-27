<?php

namespace App\Http\Controllers;

use App\Models\Orderslist;
use Illuminate\Http\Request;
use App\Models\Customerorder;
use Illuminate\Support\Carbon;
use App\Models\CustomerRegister;
use App\Models\deliveryboyDetails;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use nguyenary\QRCodeMonkey\Request\Request as QRCodeRequest;
use Ramsey\Uuid\Type\Integer;

class OrderController extends Controller
{
    public function confirmorderview()
    {

        // Get the current time in the Indian time zone
        $currentTime = Carbon::now()->timezone('Asia/Kolkata');
        // Determine if it's AM or PM
        $ampm = $currentTime->format('A');

        $branch_id = Auth::user()->branch_id;
        // Get the current date
        $date = Carbon::now();

        // Format current date into abbreviated day name
        $formattedDay = $date->format('D'); // Outputs the abbreviated day name, e.g., Mon, Tue

        // dd($formattedDay);

        //morning
        // Date
        $formattedDate = now()->format('Y-m-d');
        $order_mon_check = Orderslist::where(['ord_session' => 'MOR', 'ord_date' => $formattedDate, 'ord_ordertype' => 'DAILY'])->select('ord_customerid')->distinct()->get();

        // dd($ordercheck);

        $customerorder_morn = DB::table('customer_registers')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
            ->join('customersessions', 'customersessions.customerid', '=', 'customer_registers.id')
            ->join('customerdays', 'customerdays.customerid', '=', 'customer_registers.id')
            ->whereNotIn('customer_registers.id', $order_mon_check)
            ->where(['customer_registers.branch_id' => $branch_id, 'customer_registers.cust_loginacs' => 1, 'customersessions.session_morn' => 'MOR', 'day_name' => $formattedDay])
            ->select('customer_registers.id as customer_mainid',   'customer_registers.cust_subcplan',  'customer_registers.branch_id', 'customer_registers.cust_businessname', 'customer_registers.cust_phone', 'customer_registers.cust_deliveryaddress', 'customersessions.session_morn', 'customerdays.day_name')->get();

        if (!empty($customerorder_morn)) {
            foreach ($customerorder_morn as $key => $requested) {
                $result = DB::table('customerorders')
                    // ->join('categories', 'categories.id', '=', 'customerorders.categoryid')
                    ->join('menus', 'menus.id', '=', 'customerorders.menuid')
                    ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                    ->leftJoin('categories', 'categories.id', '=', 'menus.menu_catid')
                    ->select('menus.id as menu_mainid', 'customerorders.menuid', 'menus.menu_capaid', 'capacities.id as capacities_mainid', 'menus.menu_catid', 'categories.id as category_mainid', 'categories.cat_name', 'capacities.capa_lit', 'capacities.capa_per_cup', 'menus.menu_price', 'customerorders.quantitycount', 'customerorders.sugartype')
                    ->where(['customerorders.customerid' => $requested->customer_mainid])
                    ->get();

                $customerorder_morn[$key]->result = $result;
            }
        }



        //evening

        $order_eve_check = Orderslist::where(['ord_session' => 'EVN', 'ord_date' => $formattedDate, 'ord_ordertype' => 'DAILY'])->select('ord_customerid')->distinct()->get();

        $customerorder_even = DB::table('customer_registers')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
            ->join('customersessions', 'customersessions.customerid', '=', 'customer_registers.id')
            ->join('customerdays', 'customerdays.customerid', '=', 'customer_registers.id')
            ->whereNotIn('customer_registers.id', $order_eve_check)
            ->where(['customer_registers.branch_id' => $branch_id, 'customer_registers.cust_loginacs' => 1, 'customersessions.session_even' => 'EVN', 'day_name' => $formattedDay])
            ->select('customer_registers.id as customer_mainid',  'customer_registers.cust_subcplan', 'customer_registers.branch_id', 'customer_registers.cust_businessname', 'customer_registers.cust_phone', 'customer_registers.cust_deliveryaddress', 'customersessions.session_even', 'customerdays.day_name')->get();

        if (!empty($customerorder_even)) {
            foreach ($customerorder_even as $key => $requested) {
                $result = DB::table('customerorders')
                    // ->join('categories', 'categories.id', '=', 'customerorders.categoryid')
                    ->join('menus', 'menus.id', '=', 'customerorders.menuid')
                    ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                    ->leftJoin('categories', 'categories.id', '=', 'menus.menu_catid')
                    ->select('menus.id as menu_mainid', 'customerorders.menuid', 'menus.menu_capaid', 'capacities.id as capacities_mainid', 'menus.menu_catid', 'categories.id as category_mainid', 'categories.cat_name', 'capacities.capa_lit', 'capacities.capa_per_cup', 'menus.menu_price', 'customerorders.quantitycount', 'customerorders.sugartype')
                    ->where(['customerorders.customerid' => $requested->customer_mainid])
                    ->get();

                $customerorder_even[$key]->result = $result;
            }
        }

        // dd($customerorder_morn, $customerorder_even);

        return view('superadmin.order.confirm-order', compact('customerorder_morn', 'customerorder_even', 'ampm'));
    }
    public function orderConfirm(Request $request)
    {
        // dd($request);
        try {
            $customerid = $request->input('customerid');
            $customer_subcid = $request->input('customer_subcid');
            $branchid = $request->input('branchid');
            $dayname = $request->input('dayname');
            $categoryid = $request->input('categoryid');
            $capacityid = $request->input('capacityid');
            $quantitycount = $request->input('quantitycount');
            $sugertype = $request->input('sugertype');
            $amount = $request->input('amount');
            $session = $request->input('session');
            $ordertype = $request->input("ordertype");

            // dd($customerid,$branchid,$categoryid,$capacityid,$quantitycount,$sugertype, $amount, $session, $dayname);
            // Date
            $formattedDate = now()->format('Y-m-d');

            // Month
            $MONTH = now()->format('Y-m');

            $idallsave = [];

            // Prepare data for insertion
            for ($i = 0; $i < count($categoryid); $i++) {
                $idallsave[] = [
                    'list_category' => $categoryid[$i],
                    'list_capacity' => $capacityid[$i],
                    'list_qty' => $quantitycount[$i],
                    'list_type' => $sugertype[$i],
                    'list_price' => $amount[$i] * $quantitycount[$i],
                ];
            }

            foreach ($idallsave as $key => $values) {
                $check =  Orderslist::insert([
                    'ord_customerid' => $customerid,
                    'ord_customer_subcid' => $customer_subcid,
                    'ord_branchid' => $branchid,
                    'ord_categoryid' => $values['list_category'],
                    'ord_quantityid' => $values['list_capacity'],
                    'ord_quantitycount' => $values['list_qty'],
                    'ord_sugartype' => $values['list_type'],
                    'ord_amount' => $values['list_price'],
                    'ord_session' => $session,
                    'ord_dayname' => $dayname,
                    'ord_paymentstatus' => 'PENDING',
                    'ord_deliverystatus' => 'PENDING',
                    'ord_packingstatus' => 'PENDING',
                    'ord_ordertype' => $ordertype,
                    'ord_date' => $formattedDate,
                    'ord_month' => $MONTH,
                ]);
            }

            return redirect()->back()->with('success', 'Order is confirmed');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Order is not confirmed');
        }
    }


    public function todayorder()
    {
        $branch_id = Auth::user()->branch_id;

        // Get the current time in the Indian time zone
        $currentTime = Carbon::now()->timezone('Asia/Kolkata');
        // Determine if it's AM or PM
        $ampm = $currentTime->format('A');


        $formattedDate = now()->format('Y-m-d');


        $deliveryboy = DB::table('deliveryboy_details')
            ->join('users', 'users.id', '=', 'deliveryboy_details.user_id')
            ->where(['deliveryboy_details.branch_id' => $branch_id, 'users.status' => 1])->select('deliveryboy_details.id', 'deliveryboy_details.name')->get();


        $order_mon = DB::table('orderslists')
            ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
            ->where(['ord_session' => 'MOR', 'ord_date' => $formattedDate, 'ord_branchid' => $branch_id,])
            ->select(
                'orderslists.id as orderlist_mainid',
                'customer_registers.id as cusregisterid',
                'customer_registers.cust_businessname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
                'customer_registers.qrcode',
                'capacities.id as capacityid',
                'capacities.capa_lit',
                'capacities.capa_per_cup',
                'categories.id as categoryid',
                'categories.cat_name',
                'orderslists.ord_quantitycount',
                'orderslists.ord_sugartype',
                'orderslists.ord_session',
                'orderslists.ord_amount',
                'orderslists.ord_ass_deliveryboy',
                'orderslists.ord_paymentstatus',
                'orderslists.ord_deliverystatus',
                'orderslists.ord_packingstatus',
                'orderslists.ord_ordertype',
                'orderslists.ord_date',
                'orderslists.ord_month',
                'orderslists.ord_dayname',
            )
            ->orderByDesc('cusregisterid')
            ->get();
        if (!empty($order_mon)) {
            foreach ($order_mon as $key => $requested) {
                $result = deliveryboyDetails::where(['id' => $requested->ord_ass_deliveryboy, 'branch_id' => $branch_id])->select('name')->get();
                $order_mon[$key]->result = $result;
            }
        }



        $order_eve = DB::table('orderslists')
            ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
            ->where(['ord_session' => 'EVN', 'ord_date' => $formattedDate, 'ord_branchid' => $branch_id])
            ->select(
                'orderslists.id as orderlist_mainid',
                'customer_registers.id as cusregisterid',
                'customer_registers.cust_businessname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
                'customer_registers.qrcode',
                'capacities.id as capacityid',
                'capacities.capa_lit',
                'capacities.capa_per_cup',
                'categories.id as categoryid',
                'categories.cat_name',
                'orderslists.ord_quantitycount',
                'orderslists.ord_sugartype',
                'orderslists.ord_session',
                'orderslists.ord_amount',
                'orderslists.ord_ass_deliveryboy',
                'orderslists.ord_paymentstatus',
                'orderslists.ord_deliverystatus',
                'orderslists.ord_packingstatus',
                'orderslists.ord_ordertype',
                'orderslists.ord_date',
                'orderslists.ord_month',
                'orderslists.ord_dayname',
            )
            ->orderByDesc('cusregisterid')
            ->get();
        if (!empty($order_eve)) {
            foreach ($order_eve as $key => $requested) {
                $result = deliveryboyDetails::where(['id' => $requested->ord_ass_deliveryboy, 'branch_id' => $branch_id])->select('name')->get();
                $order_eve[$key]->result = $result;
            }
        }

        // dd($order_mon, $order_eve);

        return view('superadmin.order.today-order', compact('order_mon', 'order_eve', 'ampm', 'deliveryboy'));
    }

    //qrcode generate
    public function Packingrun(Request $request, $id)
    {
        try {
            // $custid = $request->cust_id;
            // $data = $request->input('data', $custid);

            // $this->setData($data);

            // Generate the QR code image and get the path
            // $profile_store = uniqid() . '.png';
            // $path = $this->create(public_path('qrcodes/' . $profile_store));
            // dd($data,$profile_store,$path);
            // if ($path) {
            // QR code generated successfully, you can update the order status here if needed
            Orderslist::where('id', $id)->update(['ord_packingstatus' => 'RUNNING']);

            return redirect()->back()->with('success', 'Status Changed');
            // } else {
            // QR code generation failed
            // return redirect()->back()->with('failed', 'Status not Change');
            // }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Status not Change');
        }
    }

    // private $data = ''; // Ensure $data is of type string
    // private $size = 1000;
    // private $type = 'png';
    // private $config = [];
    // private $logo = null;
    // private $logo_mode = 'default';

    // private function setData(string $data): void
    // {
    //     $this->data = $data;
    // }


    // private function create(?string $path = null): ?string
    // {
    //     QRCodeRequest::setConfig($this->config);
    //     QRCodeRequest::setContent($this->data);
    //     QRCodeRequest::setSize($this->size);
    //     QRCodeRequest::setFile($this->type);
    //     QRCodeRequest::setLogo($this->logo, $this->logo_mode);

    //     try {
    //         $result = QRCodeRequest::qrCodeCreate();
    //         $image = $result['imageUrl'] ?? null;

    //         if ($image && $path) {
    //             $imageContent = file_get_contents('https:' . $image);
    //             if ($imageContent !== false) {
    //                 $path_folder = dirname($path);

    //                 if (!file_exists($path_folder)) {
    //                     mkdir($path_folder, 0777, true);
    //                 }

    //                 file_put_contents($path, $imageContent);
    //                 return $path;
    //             }
    //             return $image;
    //         }
    //     } catch (\Exception $e) {
    //         // Handle QR code generation errors
    //         return null;
    //     }

    //     return null;
    // }


    //     public function Packingrun(Request $request, $id)
    //     {
    //         try {
    //             $custid = $request->cust_id;
    //             $data = $request->input('data', $custid);

    //             $this->setData($data);

    //             // Generate the QR code image and get the path
    //             $profile_store = uniqid() . $data . '.png';
    //             $path = $this->create(public_path('qrcodes/' . $profile_store));
    // dd($path);
    // die();
    //             if ($path) {
    //                 Orderslist::where('id', $id)->update(['ord_packingstatus' => 'RUNNING']);

    //                 CustomerRegister::where('id', $custid)->update(['qrcode_path' => $path]);

    //                 return redirect()->back()->with('success', 'Status Changed');
    //             } else {
    //                 // QR code generation failed
    //                 return redirect()->back()->with('failed', 'Status not Change');
    //             }
    //         } catch (\Exception $e) {
    //             // Log or handle the exception appropriately
    //             return redirect()->back()->with('failed', 'Status not Change');
    //         }
    //     }

    // public function Packingcomplete($id)
    // {

    //     try {
    //         $orders =   Orderslist::where('id', $id)->first();

    //         $stock = DB::table('stocks')->where('sto_contid', $orders->ord_quantityid)->first();


    //         if ($stock->sto_balance >= $orders->ord_quantitycount) {
    //             Orderslist::where('id', $id)->update(['ord_packingstatus' => 'COMPLETE']);
    //         } else {
    //             return redirect()->back()->with('failed', 'No remaing containers');
    //         }


    //         return redirect()->back()->with('success', 'Status Changed');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('failed', 'Status not Change');
    //     }
    // }
    public function Packingcomplete($id)
    {
        try {
            Orderslist::where('id', $id)->update(['ord_packingstatus' => 'COMPLETE']);

            return redirect()->back()->with('success', 'Status Changed');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Status not changed');
        }
    }


    public function  assumedelivery(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'orderlistids' => 'required',
                'delivery_boy' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $selectedOrderIds = explode(',', $request->input('orderlistids')[0]);
            // $orderlistid = $request->input('orderlistid');
            $delivery_id = $request->input('delivery_boy');


            if (!is_array($selectedOrderIds) || count($selectedOrderIds) === 0 || in_array(null, $selectedOrderIds)) {
                return redirect()->back()->with('failed', 'Please Select Order List');
            } else {
                foreach ($selectedOrderIds as $key => $value) {
                    Orderslist::where(['id' => $value])->update(['ord_ass_deliveryboy' => $delivery_id, 'ord_deliverystatus' => "RUNNING"]);
                }
                return redirect()->back()->with('success', 'Assumed Delivery Boy Successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Delivery Boy Not Assume');
        }
    }

    public function  rejectorder(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'orderlistids' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $selectedOrderIds = explode(',', $request->input('orderlistids')[0]);

            if (!is_array($selectedOrderIds) || count($selectedOrderIds) === 0 || in_array(null, $selectedOrderIds)) {
                return redirect()->back()->with('failed', 'Please Select Order List');
            } else {
                foreach ($selectedOrderIds as $value) {
                    Orderslist::where(['id' => $value])->update(['ord_paymentstatus' => 'REJECTED', 'ord_deliverystatus' => 'REJECTED', 'ord_packingstatus' => 'REJECTED', 'ord_ass_deliveryboy' => null]);
                }

                return redirect()->back()->with('success', 'order Rejected Successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Order is not Reject');
        }
    }

    public function  reconfirmorder(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'orderlistids' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $selectedOrderIds = explode(',', $request->input('orderlistids')[0]);

            if (!is_array($selectedOrderIds) || count($selectedOrderIds) === 0 || in_array(null, $selectedOrderIds)) {
                return redirect()->back()->with('failed', 'Please Select Order List');
            } else {
                foreach ($selectedOrderIds as $value) {
                    Orderslist::where(['id' => $value])->update(['ord_paymentstatus' => 'PENDING', 'ord_deliverystatus' => 'PENDING', 'ord_packingstatus' => 'PENDING']);
                }

                return redirect()->back()->with('success', 'Re-confirm order  Successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Order is not Re-Confirm');
        }
    }

    public function additionalorder()
    {

        // Get the current time in the Indian time zone
        $currentTime = Carbon::now()->timezone('Asia/Kolkata');
        // Determine if it's AM or PM
        $ampm = $currentTime->format('A');


        $branch_id = Auth::user()->branch_id;
        // Get the current date
        $date = Carbon::now();

        // Format current date into abbreviated day name
        $formattedDay = $date->format('D'); // Outputs the abbreviated day name, e.g., Mon, Tue

        // dd($formattedDay);

        //morning
        // Date
        $formattedDate = now()->format('Y-m-d');
        $order_mon_check = Orderslist::where(['ord_session' => 'MOR', 'ord_date' => $formattedDate, 'ord_ordertype' => 'ADDITIONAL'])->select('ord_customerid')->distinct()->get();

        // dd($ordercheck);

        $customerorder_morn = DB::table('customer_registers')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
            ->join('customersession_atls', 'customersession_atls.customerid', '=', 'customer_registers.id')
            // ->join('customerdays_atls', 'customerdays_atls.customerid', '=', 'customer_registers.id')
            ->whereNotIn('customer_registers.id', $order_mon_check)
            ->where([
                'customer_registers.branch_id' => $branch_id,
                'customer_registers.cust_loginacs' => 1,
                'customersession_atls.session_morn' => 'MOR',
                // 'customerdays_atls.day_name' =>
                'customersession_atls.session_date' => $formattedDate,
            ])
            ->select(
                'customer_registers.id as customer_mainid',
                'customer_registers.cust_subcplan',
                'customer_registers.branch_id',
                'customer_registers.cust_businessname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
                'customersession_atls.session_morn',
                // 'customerdays_atls.day_name'
                'customersession_atls.session_date'
            )
            ->distinct()
            ->get();

        if (!empty($customerorder_morn)) {
            foreach ($customerorder_morn as $key => $requested) {
                $result = DB::table('customerorder_atls')
                    // ->join('categories', 'categories.id', '=', 'customerorder_atls.categoryid')
                    ->join('menus', 'menus.id', '=', 'customerorder_atls.menuid')
                    ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                    ->leftJoin('categories', 'categories.id', '=', 'menus.menu_catid')
                    ->select('menus.id as menu_mainid', 'customerorder_atls.menuid', 'menus.menu_capaid', 'capacities.id as capacities_mainid', 'menus.menu_catid', 'categories.id as category_mainid', 'categories.cat_name', 'capacities.capa_lit', 'capacities.capa_per_cup', 'menus.menu_price', 'customerorder_atls.quantitycount', 'customerorder_atls.sugartype')
                    ->where(['customerorder_atls.customerid' => $requested->customer_mainid])
                    ->get();

                $customerorder_morn[$key]->result = $result;
            }
        }



        //evening

        $order_eve_check = Orderslist::where(['ord_session' => 'EVN', 'ord_date' => $formattedDate, 'ord_ordertype' => 'ADDITIONAL'])->select('ord_customerid')->distinct()->get();

        $customerorder_even = DB::table('customer_registers')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
            ->join('customersession_atls', 'customersession_atls.customerid', '=', 'customer_registers.id')
            // ->join('customerdays_atls', 'customerdays_atls.customerid', '=', 'customer_registers.id')
            ->whereNotIn('customer_registers.id', $order_eve_check)
            ->where(['customer_registers.branch_id' => $branch_id, 'customer_registers.cust_loginacs' => 1, 'customersession_atls.session_even' => 'EVN', 'customersession_atls.session_date' => $formattedDate,])
            ->select(
                'customer_registers.id as customer_mainid',
                'customer_registers.cust_subcplan',
                'customer_registers.branch_id',
                'customer_registers.cust_businessname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
                'customersession_atls.session_even',
                'customersession_atls.session_date'
            )
            ->distinct()
            ->get();

        if (!empty($customerorder_even)) {
            foreach ($customerorder_even as $key => $requested) {
                $result = DB::table('customerorder_atls')
                    // ->join('categories', 'categories.id', '=', 'customerorder_atls.categoryid')
                    ->join('menus', 'menus.id', '=', 'customerorder_atls.menuid')
                    ->leftJoin('capacities', 'capacities.id', '=', 'menus.menu_capaid')
                    ->leftJoin('categories', 'categories.id', '=', 'menus.menu_catid')
                    ->select('menus.id as menu_mainid', 'customerorder_atls.menuid', 'menus.menu_capaid', 'capacities.id as capacities_mainid', 'menus.menu_catid', 'categories.id as category_mainid', 'categories.cat_name', 'capacities.capa_lit', 'capacities.capa_per_cup', 'menus.menu_price', 'customerorder_atls.quantitycount', 'customerorder_atls.sugartype')
                    ->where(['customerorder_atls.customerid' => $requested->customer_mainid])
                    ->get();

                $customerorder_even[$key]->result = $result;
            }
        }

        // dd($customerorder_morn, $customerorder_even);

        return view('superadmin.order.additional-order', compact('customerorder_morn', 'customerorder_even', 'ampm'));
    }
}
