<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CustomerRegister;
use App\Models\Subscriptionplan;
use App\Models\Subscriptioncancel;
use App\Models\Subscriptionchange;
use Illuminate\Support\Facades\DB;
use App\Models\Addsubscriptionplan;
use App\Models\Orderslist;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use nguyenary\QRCodeMonkey\Request\Request as QRCodeRequest;
use Ramsey\Uuid\Type\Integer;

class CUstomerapprovalController extends Controller
{
    public function subscriptionplan()
    {
        $branch_id = Auth::user()->branch_id;
        $subscribe = Subscriptionplan::where('sub_status', '1')->get();

        if (!empty($subscribe)) {
            foreach ($subscribe as $key => $requested) {
                $result = Addsubscriptionplan::where(['addsub_subid' => $requested->id, 'branch_id' => $branch_id])->get();
                $subscribe[$key]->result = $result;
            }
        }
        // dd($subscribe);

        return view('superadmin.subscription-plan', compact('subscribe'));
    }


    public function cusalllist()
    {
        $branch_id = Auth::user()->branch_id;

        $allview = CustomerRegister::where(['cust_delete' => 1, 'branch_id' => $branch_id])->orderbyDESC('id')->get();

        // Pluck all 'cust_subcplan' values from $allview and convert it to an array
        $custSubcPlans = $allview->pluck('cust_subcplan')->toArray();

        // Fetch subscription plans based on the IDs
        $sub = Subscriptionplan::whereIn('id', $custSubcPlans)->select('id', 'Sub_title')->get();
        return view('superadmin.customer.alllist', compact('allview', 'sub'));
    }

    private $data = '123'; // Ensure $data is of type string
    private $size = 1000;
    private $type = 'png';
    private $config = [];
    private $logo = null;
    private $logo_mode = 'default';

    public function cusappro($id)
    {
        try {
            $branch_id = Auth::user()->branch_id;
            // Update the customer's login access status to approved

            $this->setData($id);

            $profile_store = uniqid() . '.png';
            $path = $this->create(public_path('qrcodes/' . $profile_store));
            //    dd($path);

            if ($path) {


            CustomerRegister::where(['cust_status' => 1, 'cust_delete' => 1, 'id' => $id, 'branch_id' => $branch_id])->update(['cust_loginacs' => 1,'qrcode_path' => $path,'qrcode' => $profile_store]);

            } else {
                // QR code generation failed
                return redirect()->back()->with('failed', 'something went wrong');
            }



            // Retrieve the business name of the approved customer
            $getname = CustomerRegister::where(['id' => $id, 'branch_id' => $branch_id])->value('cust_businessname');




            // Redirect back with success message
            return redirect()->back()->with('success', $getname . ' Business is approved');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('failed', 'Something went wrong! Please try again later.');
        }
    }



    private function setData(int $data): void
    {
        $this->data = $data;
    }


    private function create(?string $path = null): ?string
    {
        QRCodeRequest::setConfig($this->config);
        QRCodeRequest::setContent($this->data);
        QRCodeRequest::setSize($this->size);
        QRCodeRequest::setFile($this->type);
        QRCodeRequest::setLogo($this->logo, $this->logo_mode);

        try {
            $result = QRCodeRequest::qrCodeCreate();
            $image = $result['imageUrl'] ?? null;

            if ($image && $path) {
                $imageContent = file_get_contents('https:' . $image);
                if ($imageContent !== false) {
                    $path_folder = dirname($path);

                    if (!file_exists($path_folder)) {
                        mkdir($path_folder, 0777, true);
                    }

                    file_put_contents($path, $imageContent);
                    return $path;
                }
                return $image;
            }
        } catch (\Exception $e) {
            // Handle QR code generation errors
            return null;
        }

        return null;
    }


    public function cusblock($id)
    {
        try {
            $branch_id = Auth::user()->branch_id;
            // Update the customer's login access status to approved
            CustomerRegister::where(['id' => $id, 'branch_id' => $branch_id])->update(['cust_status' => 2, 'cust_loginacs' => 2]);

            // Retrieve the business name of the approved customer
            $getname = CustomerRegister::where(['id' => $id, 'branch_id' => $branch_id])->value('cust_businessname');

            // Redirect back with success message
            return redirect()->back()->with('success', $getname . ' Business is Block');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('failed', 'Something went wrong! Please try again later.');
        }
    }

    public function cusblockappro($id)
    {
        try {
            $branch_id = Auth::user()->branch_id;
            // Update the customer's login access status to approved
            CustomerRegister::where(['id' => $id, 'branch_id' => $branch_id])->update(['cust_status' => 1, 'cust_loginacs' => 1]);

            // Retrieve the business name of the approved customer
            $getname = CustomerRegister::where(['id' => $id, 'branch_id' => $branch_id])->value('cust_businessname');

            // Redirect back with success message
            return redirect()->back()->with('success', $getname . ' Business is Block cancel');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('failed', 'Something went wrong! Please try again later.');
        }
    }


    // public function cusapprovallist()
    // {
    //     return view('superadmin.customer.approvallist');
    // }
    public function cusblocklist()
    {
        $branch_id = Auth::user()->branch_id;
        $allview = CustomerRegister::where(['cust_status' => 2, 'cust_delete' => 1, 'branch_id' => $branch_id])->orderbyDESC('id')->get();

        // Pluck all 'cust_subcplan' values from $allview and convert it to an array
        $custSubcPlans = $allview->pluck('cust_subcplan')->toArray();

        // Fetch subscription plans based on the IDs
        $sub = Subscriptionplan::whereIn('id', $custSubcPlans)->select('id', 'Sub_title')->get();
        return view('superadmin.customer.blocklist', compact('allview', 'sub'));
    }

    public function cuspaymenthistory()
    {
        $branch_id = Auth::user()->branch_id;
        $customerview = DB::table('customer_registers')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'customer_registers.cust_subcplan')
            ->where([
                'customer_registers.branch_id' => $branch_id,
                'customer_registers.cust_loginacs' => 1,
                // 'customer_registers.cust_status' => 1
            ])
            ->select(
                'customer_registers.id  as custid',
                'customer_registers.cust_phone',
                'customer_registers.branch_id',
                'customer_registers.cust_businessname',
                'customer_registers.cust_loginacs',
                'customer_registers.cust_status',
                'customer_registers.cust_subcplan',
                'subscriptionplans.id as subid',
                'subscriptionplans.Sub_title',
            )
            ->get();

        // if (!$customerview->isEmpty()) {
        //     foreach ($customerview as $key => $requested) {
        //         $subid = DB::table('subscriptionplans')->where(['id' => $requested->cust_subcplan])->select('id', 'Sub_title')->first();
        //         $customerview[$key]->subid = $subid;
        //     }
        // }
        if (!empty($customerview)) {
            foreach ($customerview as $key => $requested) {
                $date = Orderslist::where([
                    'ord_customerid' => $requested->custid,
                    'ord_customer_subcid' => $requested->cust_subcplan,
                    'ord_paymentstatus' => 'RECEIVED',
                    'ord_deliverystatus' => 'DELIVERED',
                    'ord_branchid' => $branch_id,
                ])->latest('ord_payment_recvdate')->value('ord_payment_recvdate');
                $customerview[$key]->date = $date;
                // Now $date contains the last payment received date for the current $requested object
                // You can use $date here as per your requirement
            }
        }

        if (!empty($customerview)) {
            foreach ($customerview as $key => $requested) {
                $totalamount = Orderslist::where([
                    'ord_customerid' => $requested->custid,
                    'ord_customer_subcid' => $requested->cust_subcplan,
                    'ord_paymentstatus' => 'PENDING',
                    'ord_deliverystatus' => 'DELIVERED',
                    'ord_branchid' => $branch_id,
                ])->sum('ord_amount');
                $customerview[$key]->totalamount = $totalamount;
            }
        }

        // dd($customerview);
        return view('superadmin.customer.paymenthistory', compact('customerview'));
    }

  public function custpaymentapproval($custid)
{
    $branch_id = Auth::user()->branch_id;

    $loginstatus = CustomerRegister::where(['id' => $custid, 'branch_id' => $branch_id])->select('cust_status')->first();

    // Check if $loginstatus is not null before accessing its property
    if ($loginstatus) {
        // Switch the value of cust_status
        switch ($loginstatus->cust_status) {
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

        // Update the cust_status field
        CustomerRegister::where(['id' => $custid, 'branch_id' => $branch_id])->update(['cust_status' => $newStatus]);
    }

    return redirect()->back();
}




    public function cussubschange()
    {
        $branch_id = Auth::user()->branch_id;
        $subschange = DB::table('subscriptionchanges')
            ->join('customer_registers', 'customer_registers.id', '=', 'subscriptionchanges.subcha_customerid')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'subscriptionchanges.subcha_subsid')
            ->orderByDesc('subscriptionchanges.subcha_datetime')
            ->select(
                'customer_registers.id as mainid', // Alias changed to use column name
                'customer_registers.cust_businessname',
                'customer_registers.cust_phone',
                'subscriptionplans.Sub_title',
                'subscriptionplans.id as subid',
                'subscriptionchanges.subcha_datetime',
                'subscriptionchanges.subcha_apprdatetime',
                'subscriptionchanges.subcha_status',
                'subscriptionchanges.id as change_id',
                'customer_registers.branch_id',
                'subscriptionchanges.subcha_delete',
                'subscriptionplans.sub_status',
                'subscriptionplans.sub_delete',
            )
            ->where(['subcha_delete' => 1, 'sub_status' => 1, 'customer_registers.branch_id' => $branch_id])
            ->get();

        if (!empty($subschange)) {
            foreach ($subschange as $key => $requested) {
                $totalamount = Orderslist::where([
                    'ord_customerid' => $requested->mainid,
                    'ord_customer_subcid' => $requested->subid,
                    'ord_paymentstatus' => 'PENDING',
                    'ord_deliverystatus' => 'DELIVERED',
                    'ord_branchid' => $branch_id,
                ])->sum('ord_amount');
                $subschange[$key]->totalamount = $totalamount;
            }
        }

        // dd($subschange);
        return view('superadmin.customer.subschange', compact('subschange'));
    }



    public function cussubscancel()
    {

        $branch_id = Auth::user()->branch_id;

        // Query to fetch subscription cancel records along with related data
        $subscancel = DB::table('subscriptioncancels')
            ->join('customer_registers', 'customer_registers.id', '=', 'subscriptioncancels.subcan_customerid')
            ->join('subscriptionplans', 'subscriptionplans.id', '=', 'subscriptioncancels.subcan_subsid')
            ->orderByDesc('subscriptioncancels.subcan_datetime')
            ->select(
                'customer_registers.id as mainid', // Alias changed to use column name
                'customer_registers.cust_businessname',
                'customer_registers.cust_phone',
                'subscriptionplans.id as subid',
                'subscriptionplans.Sub_title',
                'subscriptioncancels.subcan_datetime',
                'subscriptioncancels.subcan_apprdatetime',
                'subscriptioncancels.subcan_status',
                'subscriptioncancels.id as cancel_id',
                'customer_registers.branch_id',
                'subscriptioncancels.subcan_delete',
                'subscriptionplans.sub_status',
                'subscriptionplans.sub_delete',
            )
            ->where([
                'subscriptioncancels.subcan_delete' => 1,
                'subscriptionplans.sub_status' => 1,
                'subscriptionplans.sub_delete' => 1,
                'customer_registers.branch_id' => $branch_id
            ])
            ->get();

        if (!empty($subscancel)) {
            foreach ($subscancel as $key => $requested) {
                $totalamount = Orderslist::where([
                    'ord_customerid' => $requested->mainid,
                    'ord_customer_subcid' => $requested->subid,
                    'ord_paymentstatus' => 'PENDING',
                    'ord_deliverystatus' => 'DELIVERED',
                    'ord_branchid' => $branch_id,
                ])->sum('ord_amount');
                $subscancel[$key]->totalamount = $totalamount;
            }
        }

        // dd($subscancel);
        // Pass data to the view
        return view('superadmin.customer.subscancel', compact('subscancel'));
    }


    public function cussubschangeappro($id)
    {
        // dd($id);
        try {
            $branch_id = Auth::user()->branch_id;

            $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
            $formattedDate = $currentDate->format('Y-m-d H:i:s');

            $subcustid = Subscriptionchange::where(['id' => $id, 'branch_id' => $branch_id])->select('subcha_customerid')->first();

            // dd($subcustid);
            Subscriptionchange::where(['id' => $id, 'branch_id' => $branch_id])->update(['subcha_status' => 1, 'subcha_apprdatetime' =>  $formattedDate]);

            CustomerRegister::where(['id' => $subcustid->subcha_customerid, 'cust_status' => 1, 'cust_delete' => 1, 'branch_id' => $branch_id])->update(['cust_subcplan' => null]);

            return redirect()->back()->with('success', 'Approved is successfully completed');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Operation failed!');
        }
    }



    public function cussubscancelappro($id)
    {
        try {
            $branch_id = Auth::user()->branch_id;
            $currentDate = Carbon::now('Asia/Kolkata'); // Set the timezone to Indian Standard Time (IST)
            $formattedDate = $currentDate->format('Y-m-d H:i:s');

            $subcustid = Subscriptioncancel::where(['id' => $id, 'branch_id' => $branch_id])->select('subcan_customerid')->first();

            Subscriptioncancel::where(['id' => $id, 'branch_id' => $branch_id])->update(['subcan_status' => 1, 'subcan_apprdatetime' =>  $formattedDate,]);

            CustomerRegister::where(['id' => $subcustid['subcan_customerid'], 'branch_id' => $branch_id])->update(['cust_loginacs' => 2, 'cust_status' => 2, 'cust_delete' => 2]);


            return redirect()->back()->with('success', 'Approved is successfully completed');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', "operation failed!");
        }
    }
}
