<?php

namespace App\Http\Controllers;

use App\Models\containersDetails;
use App\Models\User;
use App\Models\Orderslist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\deliveryboyDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DeliveryboyController extends Controller
{
    public function orderlist($ses)
    {
        $user_id = Auth::user()->id;
        $branch_id = Auth::user()->branch_id;
        $todayDate = Carbon::now()->format('Y-m-d');
        
        $details = deliveryboyDetails::where('user_id', $user_id)->first();
        
        $totalOrdersQuery = DB::table('orderslists')
            ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
            ->select(
                'orderslists.id as orderlist_mainid',
                'customer_registers.id as cusregisterid',
                'customer_registers.cust_businessname',
                'customer_registers.cust_personname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
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
                'orderslists.ord_date',
                'orderslists.ord_month',
                'orderslists.ord_dayname',
            )
            ->orderBy('customer_registers.id');
        
        if ($ses == 'Morning' || $ses == 'Evening') {
            $session = $ses == 'Morning' ? 'MOR' : 'EVN';
        
            $totalOrders = $totalOrdersQuery->where([
                    'orderslists.ord_date' => $todayDate,
                    'orderslists.ord_branchid' => $branch_id,
                    'orderslists.ord_session' => $session,
                    'orderslists.ord_ass_deliveryboy' => $details->id,
                ])->get();
        } elseif ($ses == 'All') {
            $totalOrders = $totalOrdersQuery->where([
                    'orderslists.ord_date' => $todayDate,
                    'orderslists.ord_branchid' => $branch_id,
                    'orderslists.ord_ass_deliveryboy' => $details->id,
                ])->get();
        }else{
            $totalOrders = $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'customer_registers.id' => $ses
            ])->get();
        }
        
        // Group orders by customer ID
        $groupedOrders = $totalOrders->groupBy('cusregisterid');
        
        // Count the number of orders for each customer
        $customerOrdersCount = [];
        foreach ($groupedOrders as $customerId => $orders) {
            $customerOrdersCount[$customerId] = $orders->count();
        }
    
        $data = DB::table('menus')
            ->join('categories', 'categories.id', 'menus.menu_catid')
            ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])->select('menu_catid', 'cat_name', 'cat_file')->distinct()->get();
    
        return view('deliveryboy.orderlist', compact('totalOrders', 'groupedOrders', 'data', 'ses', 'customerOrdersCount'));
    }
    

    public function pendingorder($ses)
    {
        // dd($ses);
        $user_id = Auth::user()->id;
        $branch_id = Auth::user()->branch_id;
        $todayDate = Carbon::now()->format('Y-m-d');

        $details = deliveryboyDetails::where('user_id', $user_id)->first();



        $totalOrdersQuery = DB::table('orderslists')
            ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
            ->select(
                'orderslists.id as orderlist_mainid',
                'customer_registers.id as cusregisterid',
                'customer_registers.cust_businessname',
                'customer_registers.cust_personname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
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
                'orderslists.ord_date',
                'orderslists.ord_month',
                'orderslists.ord_dayname',
            )
            ->orderBy('customer_registers.id');

        if ($ses == 'Morning') {
            $session = "MOR";
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_session' => $session,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'orderslists.ord_deliverystatus' => 'RUNNING'

            ]);
        } elseif ($ses == 'Evening') {
            $session = "EVN";
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_session' => $session,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'orderslists.ord_deliverystatus' => 'RUNNING'

            ]);
        } elseif ($ses == 'All') {
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'orderslists.ord_deliverystatus' => 'RUNNING'

            ]);
        }
        // else {
        //     $totalOrdersQuery->where([
        //         'orderslists.ord_date' => $todayDate,
        //         'orderslists.ord_branchid' => $branch_id,
        //         'orderslists.ord_ass_deliveryboy' => $details->id,
        //         'orderslists.ord_customerid' => $ses
        //     ]);
        // }

        $totalOrders = $totalOrdersQuery->get();
        $totalOrderscount = $totalOrdersQuery->count();
        $groupedOrders = $totalOrders->groupBy('cusregisterid');
        // dd($groupedOrders);

        $data = DB::table('menus')
            ->join('categories', 'categories.id', 'menus.menu_catid')
            ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])->select('menu_catid', 'cat_name', 'cat_file')->distinct()->get();


        return view('deliveryboy.pendingorderlist', compact('totalOrders', 'groupedOrders', 'data', 'ses','totalOrderscount'));
        // return view('deliveryboy.orderlist');

    }
    public function completedorder($ses)
    {
        // dd($ses);
        $user_id = Auth::user()->id;
        $branch_id = Auth::user()->branch_id;
        $todayDate = Carbon::now()->format('Y-m-d');

        $details = deliveryboyDetails::where('user_id', $user_id)->first();



        $totalOrdersQuery = DB::table('orderslists')
            ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
            ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
            ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
            ->select(
                'orderslists.id as orderlist_mainid',
                'customer_registers.id as cusregisterid',
                'customer_registers.cust_businessname',
                'customer_registers.cust_personname',
                'customer_registers.cust_phone',
                'customer_registers.cust_deliveryaddress',
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
                'orderslists.ord_date',
                'orderslists.ord_month',
                'orderslists.ord_dayname',
            )
            ->orderBy('customer_registers.id');
            if ($ses == 'Morning' || $ses == 'Evening') {
                $session = $ses == 'Morning' ? 'MOR' : 'EVN';
            
                $totalOrders = $totalOrdersQuery->where([
                        'orderslists.ord_date' => $todayDate,
                        'orderslists.ord_branchid' => $branch_id,
                        'orderslists.ord_session' => $session,
                        'orderslists.ord_ass_deliveryboy' => $details->id,
                        'orderslists.ord_deliverystatus' => 'DELIVERED'
                    ])->get();
            } elseif ($ses == 'All') {
                $totalOrders = $totalOrdersQuery->where([
                        'orderslists.ord_date' => $todayDate,
                        'orderslists.ord_branchid' => $branch_id,
                        'orderslists.ord_ass_deliveryboy' => $details->id,
                        'orderslists.ord_deliverystatus' => 'DELIVERED'
                    ])->get();
            }
            
            // Group orders by customer ID
            $groupedOrders = $totalOrders->groupBy('cusregisterid');
            
            // Count the number of orders for each customer
            $customerOrdersCount = [];
            foreach ($groupedOrders as $customerId => $orders) {
                $customerOrdersCount[$customerId] = $orders->count();
            }


     

        $data = DB::table('menus')
            ->join('categories', 'categories.id', 'menus.menu_catid')
            ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])->select('menu_catid', 'cat_name', 'cat_file')->distinct()->get();


        return view('deliveryboy.completeorderlist', compact('totalOrders', 'groupedOrders', 'data', 'ses','customerOrdersCount'));
        // return view('deliveryboy.orderlist');

    }
    public function profilecreate()
    {
        return view('deliveryboy.detailsadd');
    }

    public function profileindex()
    {
        $branch_id = Auth::user()->branch_id;
        $details = deliveryboyDetails::where('branch_id', $branch_id)->get();
        return view('deliveryboy.detailsindex', compact('details'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'phone' => [
                'required',
                Rule::unique('deliveryboy_details', 'phone')
            ],

        ], [
            'phone.unique' => 'The phone number has already been taken.',
            // Customize messages for other validation rules as needed...
        ]);
        // return response($request);
        //   $date =   date('d-m-Y', strtotime($request->dob));


        $post = new deliveryboyDetails;


        $post->name = $request->full_name;
        $post->dob = $request->dob;
        $post->gender = $request->gender;
        $post->email = $request->email;
        $post->blood_group = $request->bloodgroup;
        $post->permanent_address = $request->permanentaddress;
        $post->present_address = $request->presentaddress;
        $post->father_name = $request->fathername;
        $post->mother_name = $request->mothername;
        $post->phone = $request->phone;

        //profile
        if (!empty($request->profile)) {
            $profile = time() . '.' . $request->profile->getClientOriginalName();
            $profile_store = uniqid() . '.' . $profile; // Generate a unique filename

            // dd($profile_store);
            $profile_path1 = $request->profile->move('deliveryboy/profile/', $profile);
            $profile_path = "deliveryboy/profile/$profile";
            // dd($profile_store);
            // dd($profile,$profile_store,$profile_path1);
        } else {
            $profile = null;
            $profile_path = null;
        }

        $post->profile = $profile;
        $post->profile_path = $profile_path;

        if (!empty($request->licence)) {
            $licence = time() . '.' . $request->licence->getClientOriginalName();
            $licence_store = uniqid() . '.' . $licence; // Generate a unique filename
            $licence_path1 = $request->licence->move('deliveryboy/licence', $licence);
            $licence_path = "deliveryboy/licence/$licence";
        } else {
            $licence = null;
            $licence_path = null;
        }
        $post->licence = $licence;
        $post->licence_path = $licence_path;
        $post->account_no = $request->account_no;
        $post->account_holder_name = $request->account_holder_name;
        $post->branch_name = $request->branch_name;
        $post->branch_code = $request->branch_code;
        $post->ifsc_code = $request->ifsc_code;
        $post->bank_address = $request->bank_address;
        // $post->username = $request->useremail;
        // $post->password = $request->password;

        $post->branch_id = 1;
        $post->save();

        // $lastInsertedId = deliveryboyDetails::latest()->first()->id;

        // User::insert([
        //             'name' =>$request->full_name,
        //             'email' => $request->useremail,
        //             'password' => Hash::make($request->password),
        //             'type' => 2,
        //             'role' => 2,
        //             'status' => 1,
        // ]);
        // $UserId = User::orderby('id','DESC')->first();

        // $post = deliveryboyDetails::find($lastInsertedId);
        // $post->user_id = $UserId->id;
        // $post->save();


        return redirect()->back()->with('success', 'Delivery Boy save successfully');
    }

    public function update(Request $request)
    {

        $id = $request->d_id;

        $post = deliveryboyDetails::find($id);

        $profile = $request->profile;

        $profile_old = $request->profileold;


        $image_pathold = $request->profile_pathold;


        if ($profile == '') {
            $profile = $profile_old;
            $profile_path = $image_pathold;
            //  response($profile_old);
            //  return response($profile);
        } else {
            $profile = time() . '.' . $request->profile->getClientOriginalName();
            $profile_store = uniqid() . '.' . $profile;
            $profile_path1 = $request->profile->move('deliveryboy/profile/', $profile);
            $profile_path = "deliveryboy/profile/$profile";
            // dd($profile_store);
            // dd($profile,$profile_store,$profile_path1);    
        }
        $licence_old = $request->licenceold;
        $licence = $request->licence;
        $licence_pathold = $request->licence_pathold;

        if ($licence == '') {
            # code...
            $licence = $licence_old;
            $licence_path = $licence_pathold;
        } else {
            $licence = time() . '.' . $request->licence->getClientOriginalName();
            $licence_store = uniqid() . '.' . $licence; // Generate a unique filename
            $licence_path1 = $request->licence->move('deliveryboy/licence', $licence);
            $licence_path = "deliveryboy/licence/$licence";
        }

        $post->name = $request->full_name;
        $post->dob = $request->dob;
        $post->gender = $request->gender;
        $post->email = $request->email;
        $post->blood_group = $request->bloodgroup;
        $post->permanent_address = $request->permanentaddress;
        $post->present_address = $request->presentaddress;
        $post->father_name = $request->fathername;
        $post->mother_name = $request->mothername;
        $post->phone = $request->phone;
        $post->profile = $profile;
        $post->profile_path = $profile_path;
        $post->licence = $licence;
        $post->licence_path = $licence_path;
        $post->account_no = $request->account_no;
        $post->account_holder_name = $request->account_holder_name;
        $post->branch_name = $request->branch_name;
        $post->branch_code = $request->branch_code;
        $post->ifsc_code = $request->ifsc_code;
        $post->bank_address = $request->bank_address;

        // $post->password = $request->password;
        $post->save();




        return redirect()->back()->with('success', 'Delivery Boy Details Updated successfully');
    }
    public function deliverylogin(Request $request)
    {

        $id = $request->d_id;

        $post = deliveryboyDetails::find($id);


        if ($request->useremail) {
            User::insert([
                'name' => $post->name,
                'email' => $request->useremail,
                'password' => Hash::make($request->password),
                'type' => 3,
                'role' => 2,
                'status' => 2,
                'branch_id' => 1,
            ]);


            $UserId = User::orderby('id', 'DESC')->first();


            $post->user_id = $UserId->id;
            $post->username = $request->useremail;
            $post->password = $request->password;
            $post->save();

            return redirect()->back()->with('success', 'Delivery Login Details Added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add');
        }
    }
    public function deliveryloginupdate(Request $request)
    {

        $id = $request->d_id;
        $user_id = $request->user_id;


        // dd($user_id);
        $post = deliveryboyDetails::find($id);
        $user = User::find($user_id);


        $user->name = $post->name;
        $user->email = $request->useremail;
        $user->password = Hash::make($request->password);
        $user->save();

        $post->username = $request->useremail;
        $post->password = $request->password;
        $post->save();

        return redirect()->back()->with('success', 'Delivery Login Details Updated successfully');
    }
    public function profilestatus($id)
    {

        $categorystatus = deliveryboyDetails::where('id', $id)->select('db_status', 'user_id')->first();
        switch ($categorystatus->db_status) {
            case 1:
                $newStatus = 2;
                break;
            case 2:
                $newStatus = 1;
                break;
            default:
                // Handle the default case if needed
                break;
        }
        deliveryboyDetails::where('id', $id)->update(['db_status' => $newStatus]);
        User::where('id', $categorystatus->user_id)->update(['status' => $newStatus]);
        return redirect()->back();
    }



    public function deliverystatus(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $branch_id = Auth::user()->branch_id;
            $todayDate = Carbon::now()->format('Y-m-d');

            // Retrieve details of the delivery boy associated with the authenticated user
            $details = deliveryboyDetails::where('user_id', $user_id)->first();
            // dd($request);
            // $validator = Validator::make($request->all(), [
            //     'orderlistid' => 'required',

            // ]);

            // if ($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }

            // $selectedOrderIds = $request->input('orderlistid', []);

            // if (!is_array($selectedOrderIds) || count($selectedOrderIds) === 0 || in_array(null, $selectedOrderIds)) {
            //     return redirect()->back()->with('failed', 'Please Select Order List');
            // } else {
            //     foreach ($selectedOrderIds as $key => $value) {
            //         Orderslist::where('id', $value)->update(['ord_deliverystatus' => "DELIVERED"]);
            //         $container_countfrom_order = intval(Orderslist::where('id', $value)
            //             ->where('ord_categoryid', '!=', 3)
            //             ->sum('ord_quantitycount'));


            //         $container = containersDetails::where('date', date('Y-m-d'))
            //             ->where('customer_id', $request->customer_id)
            //             ->exists();
            //             // dd($container_countfrom_order,"wegeetj",$container);
            //         if ($container == false) {

            //             DB::table('containers_details')->insert([
            //                 'customer_id' => $request->customer_id,
            //                 'container_given' => $container_countfrom_order,
            //                 'date' => date('Y-m-d'),
            //                 'remaing_container' => $container_countfrom_order
            //             ]);

            //         } else {

            //             DB::table('containers_details')
            //                 ->where('date', date('Y-m-d'))
            //                 ->where('customer_id', $request->customer_id)
            //                 ->update([
            //                     'container_given' => DB::raw('container_given + ' . $container_countfrom_order),
            //                     'remaing_container'=> DB::raw('remaing_container + ' . $container_countfrom_order)
            //                 ]);
            //         }
            //     }
            // $todayDate = Carbon::now()->format('Y-m-d');
            $Month = Carbon::now()->format('Y-m');
            Orderslist::where('ord_customerid', $request->customer_id)->where('ord_date', $todayDate)->where('ord_ass_deliveryboy', $details->id)->update(['ord_deliverystatus' => "DELIVERED"]);

            $orders =   Orderslist::where('ord_customerid', $request->customer_id)->where('ord_date', $todayDate)->get();
            // dd($orders);
            foreach ($orders as $order) {
                $existingRecord = DB::table('container_transactions')
                    ->where('container_id', $order->ord_quantityid)
                    ->where('customer_id', $request->customer_id)
                    ->where('transaction_date', $todayDate)
                    ->first();

                // If the record exists, update it; otherwise, insert a new record
                if ($existingRecord) {
                    DB::table('container_transactions')
                        ->where('container_id', $order->ord_quantityid)
                        ->where('customer_id', $request->customer_id)
                        ->where('transaction_date', $todayDate)
                        ->update([
                            'quantity_count' => DB::raw('quantity_count + ' . $order->ord_quantitycount),
                            'transaction_type' => "DELIVERED",
                            'transaction_date' => $todayDate,
                            'transaction_month' => $Month
                        ]);
                        DB::table('stocks')
                        ->where('sto_contid', $order->ord_quantityid)
                        ->update([
                            'sto_out' => DB::raw('sto_out + ' . $order->ord_quantitycount),
                            'sto_balance' => DB::raw('sto_balance - ' . $order->ord_quantitycount)
                        ]);
                } else {
                    DB::table('container_transactions')->insert([
                        'customer_id' => $request->customer_id,
                        'container_id' => $order->ord_quantityid,
                        'quantity_count' => $order->ord_quantitycount,
                        'transaction_type' => "DELIVERED",
                        'transaction_date' => $todayDate,
                        'transaction_month' => $Month
                    ]);
                    DB::table('stocks')
                    ->where('sto_contid', $order->ord_quantityid)
                    ->update([
                        'sto_out' => DB::raw('sto_out + ' . $order->ord_quantitycount),
                        'sto_balance' => DB::raw('sto_balance - ' . $order->ord_quantitycount)
                    ]);
                }


               
            }
            // DB::table('stocks')
            // ->where('sto_contid', $order->ord_quantityid)
            // ->update([
            //     'sto_out' => DB::raw('sto_out + ' . $order->ord_quantitycount),
            //     'sto_balance' => DB::raw('sto_balance - ' . $order->ord_quantitycount)
            // ]);
            // return redirect()->back()->with('success', 'Delivered Successfully!');
            return redirect()->route('delivery.customerlist', ['customerId' => $request->customer_id])->with('success', 'Delivered Successfully!');

            // }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('failed', 'Delivery Failed: ' . $e->getMessage());
        }
    }

    public function orderview(Request $request, $cust_id)
    {
        try {
            // Get authenticated user's ID and branch ID
            $user_id = Auth::user()->id;
            $branch_id = Auth::user()->branch_id;
            $todayDate = Carbon::now()->format('Y-m-d');

            // Retrieve details of the delivery boy associated with the authenticated user
            $details = deliveryboyDetails::where('user_id', $user_id)->first();

            // Query to fetch orders
            $totalOrdersQuery = DB::table('orderslists')
                ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                ->select(
                    'orderslists.id as orderlist_mainid',
                    'customer_registers.cust_businessname',
                    'customer_registers.id as cusregisterid',
                    'customer_registers.cust_personname',
                    'customer_registers.cust_phone',
                    'customer_registers.cust_deliveryaddress',
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
                    'orderslists.ord_date',
                    'orderslists.ord_month',
                    'orderslists.ord_dayname',
                    'orderslists.ord_session'
                )
                ->orderBy('customer_registers.id');

            // Apply conditions to the query
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'orderslists.ord_customerid' => $cust_id,
                'ord_packingstatus' => "COMPLETE"
            ]);

            // Get total orders
            $totalOrders = $totalOrdersQuery->get();

            // Group orders by customer
            $groupedOrders = $totalOrders->groupBy('ord_session');

        

            return view('deliveryboy.orderview', compact('totalOrders', 'groupedOrders'));
        } catch (\Exception $e) {

            return response()->view('errors.500', [], 500);
        }
    }
    public function pendingorderview(Request $request, $cust_id)
    {
        try {
            // Get authenticated user's ID and branch ID
            $user_id = Auth::user()->id;
            $branch_id = Auth::user()->branch_id;
            $todayDate = Carbon::now()->format('Y-m-d');

            // Retrieve details of the delivery boy associated with the authenticated user
            $details = deliveryboyDetails::where('user_id', $user_id)->first();

            // Query to fetch orders
            $totalOrdersQuery = DB::table('orderslists')
                ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                ->select(
                    'orderslists.id as orderlist_mainid',
                    'customer_registers.cust_businessname',
                    'customer_registers.id as cusregisterid',
                    'customer_registers.cust_personname',
                    'customer_registers.cust_phone',
                    'customer_registers.cust_deliveryaddress',
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
                    'orderslists.ord_date',
                    'orderslists.ord_month',
                    'orderslists.ord_dayname',
                )
                ->orderBy('customer_registers.id');

            // Apply conditions to the query
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'orderslists.ord_customerid' => $cust_id,
                'ord_packingstatus' => "COMPLETE"
            ]);

            // Get total orders
            $totalOrders = $totalOrdersQuery->get();

            // Group orders by customer
            $groupedOrders = $totalOrders->groupBy('cusregisterid');

            // Fetch menu data for the branch
            $data = DB::table('menus')
                ->join('categories', 'categories.id', 'menus.menu_catid')
                ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])
                ->select('menu_catid', 'cat_name', 'cat_file')
                ->distinct()
                ->get();


            return view('deliveryboy.pendingorderview', compact('totalOrders', 'groupedOrders', 'data'));
        } catch (\Exception $e) {

            return response()->view('errors.500', [], 500);
        }
    }
    public function completeorderview(Request $request, $cust_id)
    {
        try {
            // Get authenticated user's ID and branch ID
            $user_id = Auth::user()->id;
            $branch_id = Auth::user()->branch_id;
            $todayDate = Carbon::now()->format('Y-m-d');

            // Retrieve details of the delivery boy associated with the authenticated user
            $details = deliveryboyDetails::where('user_id', $user_id)->first();

            // Query to fetch orders
            $totalOrdersQuery = DB::table('orderslists')
                ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                ->select(
                    'orderslists.id as orderlist_mainid',
                    'customer_registers.cust_businessname',
                    'customer_registers.id as cusregisterid',
                    'customer_registers.cust_personname',
                    'customer_registers.cust_phone',
                    'customer_registers.cust_deliveryaddress',
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
                    'orderslists.ord_date',
                    'orderslists.ord_month',
                    'orderslists.ord_dayname',
                )
                ->orderBy('customer_registers.id');

            // Apply conditions to the query
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_ass_deliveryboy' => $details->id,
                'orderslists.ord_customerid' => $cust_id,
                'ord_packingstatus' => "COMPLETE"
            ]);

            // Get total orders
            $totalOrders = $totalOrdersQuery->get();

            // Group orders by customer
            
            $totalOrderscount = $totalOrdersQuery->get();
            $groupedOrders = $totalOrders->groupBy('cusregisterid');

            // Fetch menu data for the branch
            $data = DB::table('menus')
                ->join('categories', 'categories.id', 'menus.menu_catid')
                ->where(['menus.menu_status' => 1, 'menus.branch_id' => $branch_id])
                ->select('menu_catid', 'cat_name', 'cat_file')
                ->distinct()
                ->get();


            return view('deliveryboy.completeorderview', compact('totalOrders', 'groupedOrders', 'data','totalOrderscount'));
        } catch (\Exception $e) {

            return response()->view('errors.500', [], 500);
        }
    }


    public function profile(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $profile = deliveryboyDetails::where('user_id', $user_id)->first();

            return view('deliveryboy.profile', compact('profile'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'no Profile');
        }
    }

    public function customerlist(Request $request, $customerId)
    {
        try {
            // Get authenticated user's ID and branch ID
            $user_id = Auth::user()->id;
            $branch_id = Auth::user()->branch_id;
            $todayDate = Carbon::now()->format('Y-m-d');
        
            // Retrieve details of the delivery boy associated with the authenticated user
            $details = deliveryboyDetails::where('user_id', $user_id)->first();
        
            // Query to fetch orders
            $totalOrdersQuery = DB::table('orderslists')
                ->join('customer_registers', 'customer_registers.id', '=', 'orderslists.ord_customerid')
                ->join('capacities', 'capacities.id', '=', 'orderslists.ord_quantityid')
                ->join('categories', 'categories.id', '=', 'orderslists.ord_categoryid')
                ->select(
                    'orderslists.id as orderlist_mainid',
                    'customer_registers.*',
                    'capacities.id as capacityid',
                    'capacities.capa_lit',
                    'capacities.capa_per_cup',
                    'categories.id as categoryid',
                    'categories.cat_name'
                )
                ->orderBy('customer_registers.id');
        
            // Apply conditions to the query
            $totalOrdersQuery->where([
                'orderslists.ord_date' => $todayDate,
                'orderslists.ord_branchid' => $branch_id,
                'orderslists.ord_ass_deliveryboy' => $details->id,
            ])->where('orderslists.ord_quantityid', '!=', '4');
        
            // Get total orders
            $totalOrders = $totalOrdersQuery->get();
        
            // Group orders by customer
            $groupedOrders = $totalOrders->groupBy('cusregisterid');
            $customerOrdersCount = [];
            $customerPendingContainerCount = [];
        
            foreach ($groupedOrders as $customerId => $orders) {
                $customerOrdersCount[$customerId] = $orders->count();
        
                // Fetch pending container count for the particular customer
                $pendingContainerCount = DB::table('container_transactions')->where([
                    'customer_id' => $customerId,
                    'transaction_type' => 'DELIVERED'
                ])->count();
        
                $customerPendingContainerCount[$customerId] = $pendingContainerCount;
            }
        
            return view('deliveryboy.customerlist', compact('groupedOrders', 'customerOrdersCount', 'customerPendingContainerCount'));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
        
    }
    

    public function containerdetail(Request $request, $customerId)
    {
        $existingRecord = DB::table('container_transactions')
            ->join('customer_registers', 'customer_registers.id', '=', 'container_transactions.customer_id')
            ->join('capacities', 'capacities.id', '=', 'container_transactions.container_id')
            ->where('container_transactions.customer_id', $customerId)
            ->where('container_transactions.container_id', '!=', '4')
            // ->where('container_transactions.transaction_type', 'DELIVERED')
            ->whereDate('container_transactions.transaction_date', '<', now()->format('Y-m-d'))
            ->whereDate('container_transactions.transaction_date', '>=', now()->subDays(2)->format('Y-m-d'))
            
            ->select(
                'customer_registers.cust_businessname',
                'container_transactions.transaction_type',
                'container_transactions.id as cap_id',
                'capacities.capa_lit as capa_lit',
                DB::raw("DATE_FORMAT(container_transactions.transaction_date, '%d-%m-%Y') as transaction_date"),
                'container_transactions.customer_id',
                'container_transactions.quantity_count'
            )
            ->get();

        $groupedrecord = $existingRecord->groupBy(['container_transactions.customer_id', 'transaction_date']);



        // dd($groupedrecord);
        return view('deliveryboy.containerdetails', compact('groupedrecord'));
    }

    public function containerupdate(Request $request)
    {

        $todayDate = Carbon::now()->format('Y-m-d');


        $old_date = Carbon::parse($request->transaction_date)->format('Y-m-d');
        DB::table('container_transactions')
            ->where('id', $request->cont_id)
            ->where('customer_id', $request->customer_id)
            ->where('transaction_date', $old_date)
            ->update([
                'transaction_type' => 'COLLECTED',
                'collected_date' => $todayDate
            ]);

        // Get the order details from the container_transactions table
        $order = DB::table('container_transactions')
            ->where('id', $request->cont_id)
            ->where('transaction_type', "COLLECTED")
            ->first();

        // Update stocks table
        if ($order) {
            DB::table('stocks')
                ->where('sto_contid', $order->container_id)
                ->update([
                    'sto_out' => DB::raw('sto_out - ' . $order->quantity_count),
                    'sto_balance' => DB::raw('sto_balance + ' . $order->quantity_count)
                ]);
        }

        return redirect()->back()->with('success', 'Container collected successfully!');

        // return redirect()->route('delivery.customerlist', ['customerId' => $request->customer_id])->with('success', 'Container collected successfully!');
    }
}
