<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Capacity;
use App\Models\Containers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuperadminacessController extends Controller
{
    public function stockcontainers()
    {
        $branch_id = Auth::user()->branch_id;

        $capacity = Capacity::where(['capa_type' => 1, 'capa_status' => 1])->get();

        $stock = DB::table('stocks')
            ->join('capacities', 'capacities.id', '=', 'stocks.sto_contid')
            ->where(['stocks.branch_id' => $branch_id])
            ->get();
        return view('superadmin.stock-container', compact('capacity', 'stock'));
    }

    public function stockadd(Request $request)
    {
        try {
            $capacity = $request->input('capacity');
            $count = $request->input('count');
            $branch_id = Auth::user()->branch_id;


            $checkstock = Stock::where(['sto_contid' => $capacity, 'branch_id' => $branch_id])->first();

            if ($checkstock) {
                // $updatecount = $count + $checkstock['sto_total'];

                // Stock::where(['sto_contid' => $capacity, 'branch_id' => $branch_id])->update(['sto_total' => $updatecount, 'sto_balance' => $updatecount]);
                $checkstock->sto_total += $count;
                $checkstock->sto_balance += $count;
                $checkstock->save();
                
                return redirect()->back()->with('success', 'update');
            } else {
                Stock::insert(['sto_contid' =>  $capacity, 'sto_total' => $count, 'sto_balance' => $count, 'branch_id' => $branch_id]);
                return redirect()->back()->with('success', 'save');
            }
            // // Redirect back with success message
            // return redirect()->back()->with('success', 'Success');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('failed', 'failed! Please try again later.');
        }
    }

    public function stockupdate(Request $request, $id)
    {
        try {
            $branch_id = Auth::user()->branch_id;

            $count = $request->input('count');

            $checkstock = Stock::where(['id' => $id, 'branch_id' => $branch_id])->first();

            if ($checkstock) {
                $checkstock->sto_total += $count;
                $checkstock->sto_balance += $count;
                
                $checkstock->save();
            }
            // // Redirect back with success message
            return redirect()->back()->with('success', 'Success');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('failed', 'failed! Please try again later.');
        }
    }

    public function profile()
    {
        return view('superadmin.profile');
    }

    public function forgotpassword()
    {
        return view('superadmin.profile');
    }
}
