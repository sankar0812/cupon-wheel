<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function home()
    {
        // $data = Category::where('cat_status', 1)->get();

        // if (!empty($data)) {
        //     foreach ($data as $key => $requested) {
        //         $result = Product::where(['pro_catid' => $requested->id, 'pro_status' => 1])->get();
        //         $data[$key]->result = $result;
        //     }
        // }, compact('data')
        return view('websitefile.home');
    }
    public function about()
    {
        return view('websitefile.about');
    }
    public function contact()
    {
        return view('websitefile.contact');
    }
    public function shop()
    {
        return view('websitefile.shop');
    }
    public function services()
    {
        return view('websitefile.services');
    }
    public function menu()
    {
        try {
            $data = Category::where('cat_status', 1)->get();

            if (!empty($data)) {
                foreach ($data as $key => $requested) {
                    $result = Product::where(['pro_catid' => $requested->id, 'pro_status' => 1])->get();
                    $data[$key]->result = $result;
                }
            }
            return view('websitefile.menu', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', "Serve is down");
        }
    }
}
