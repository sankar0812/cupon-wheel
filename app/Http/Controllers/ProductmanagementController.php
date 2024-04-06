<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use App\Models\Capacity;
use App\Models\Category;
use Mockery\Expectation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductmanagementController extends Controller
{


    public function admincategory()
    {
        $branch_id = Auth::user()->branch_id;

        $categories = Category::where('branch_id', $branch_id)->get();
        return view('superadmin.category', compact('categories'));
    }
    public function admincategoryadd(Request $request)
    {
        try {
            $catname = $request->catname;
            $catslug = Str::slug($catname);
            $branch_id = Auth::user()->branch_id;

            $fileName = null;
            if (request()->hasFile('catfile')) {
                $file = request()->file('catfile');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/categories/', $fileName);
            }

            Category::insert(['cat_name' => $catname, 'branch_id' => $branch_id, 'cat_slugname' => $catslug, 'cat_file' => $fileName]);

            return redirect()->back()->with('success', 'save');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not save');
        }
    }

    public function admincategoryupdate(Request $request, $id)
    {
        try {
            $branch_id = Auth::user()->branch_id;

            $catname = $request->catname;
            $catslug = Str::slug($catname);
            $fileName = null; // Set a default value for the new file name

            // Check if a new file is uploaded
            if (request()->hasFile('catfile')) {
                $file = request()->file('catfile');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/categories/', $fileName);

                // Delete the old image if it exists
                $oldFileName = Category::where(['id' => $id, 'branch_id' => $branch_id,])->value('cat_file');
                if ($oldFileName && File::exists('./uploads/categories/' . $oldFileName)) {
                    File::delete('./uploads/categories/' . $oldFileName);
                }
            }

            // Check if a new file is uploaded or if the file input is empty (no file selected)
            if (request()->hasFile('catfile') || empty(request()->file('catfile'))) {
                // Ensure $fileName is defined even if no new file is uploaded
                $fileName = $fileName ?? Category::where(['id' => $id, 'branch_id' => $branch_id,])->value('cat_file');

                Category::where(['id' => $id, 'branch_id' => $branch_id,])->update(['cat_name' => $catname, 'cat_slugname' => $catslug, 'cat_file' => $fileName]);
            } else {
                // If no new file is uploaded, update only the non-file fields
                Category::where(['id' => $id, 'branch_id' => $branch_id,])->update(['cat_name' => $catname, 'cat_slugname' => $catslug]);
            }

            return redirect()->back()->with('success', 'save');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not save');
        }
    }

    public function admincategorystatus($id)
    {
        $branch_id = Auth::user()->branch_id;

        $categorystatus = Category::where(['id' => $id, 'branch_id' => $branch_id,])->select('cat_status')->first();
        switch ($categorystatus->cat_status) {
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
        Category::where(['id' => $id, 'branch_id' => $branch_id,])->update(['cat_status' => $newStatus]);
        return redirect()->back();
    }

    public function adminproduct()
    {
        $branch_id = Auth::user()->branch_id;

        $category = Category::all();
        $product = DB::table('products')
            ->join('categories', 'categories.id', 'products.pro_catid')
            ->select('categories.cat_name', 'products.pro_name', 'products.id', 'products.pro_description', 'products.pro_file', 'products.pro_status', 'products.pro_catid', 'products.branch_id')
            ->where(['products.branch_id' => $branch_id])->get();

        return view('superadmin.product', compact('product', 'category'));
    }

    public function adminproductadd(Request $request)
    {
        try {
            $catid = $request->catid;
            $proname = $request->proname;
            $proslug = str::slug($proname);
            $prodescription = $request->prodescription;
            $proprice = $request->proprice;

            $branch_id = Auth::user()->branch_id;

            $fileName = null;
            if (request()->hasFile('profile')) {
                $file = request()->file('profile');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/product/', $fileName);
            }

            Product::insert(['pro_catid' => $catid, 'branch_id' => $branch_id, 'pro_name' => $proname, 'pro_slugname' => $proslug, 'pro_description' => $prodescription, 'pro_price' => $proprice, 'pro_file' => $fileName]);

            return redirect()->back()->with('success', 'save');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not save');
        }
    }

    public function adminproductupdate(Request $request, $id)
    {
        try {
            $branch_id = Auth::user()->branch_id;

            $catid = $request->catid;
            $proname = $request->proname;
            $proslug = str::slug($proname);
            $prodescription = $request->prodescription;
            $proprice = $request->proprice;

            $fileName = null; // Set a default value for the new file name

            // Check if a new file is uploaded
            if (request()->hasFile('profile')) {
                $file = request()->file('profile');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('./uploads/product/', $fileName);

                // Delete the old image if it exists
                $oldFileName = Product::where(['id' => $id, 'branch_id' => $branch_id,])->value('pro_file');
                if ($oldFileName && File::exists('./uploads/product/' . $oldFileName)) {
                    File::delete('./uploads/product/' . $oldFileName);
                }
            }
            // Check if a new file is uploaded or if the file input is empty (no file selected)
            if (request()->hasFile('profile') || empty(request()->file('profile'))) {
                // Ensure $fileName is defined even if no new file is uploaded
                $fileName = $fileName ?? Product::where(['id' => $id, 'branch_id' => $branch_id,])->value('pro_file');

                Product::where(['id' => $id, 'branch_id' => $branch_id,])->update(['pro_catid' => $catid, 'pro_name' => $proname, 'pro_slugname' => $proslug, 'pro_description' => $prodescription, 'pro_price' => $proprice, 'pro_file' => $fileName]);
            } else {
                // If no new file is uploaded, update only the non-file fields
                Product::where(['id' => $id, 'branch_id' => $branch_id,])->update(['pro_catid' => $catid, 'pro_name' => $proname, 'pro_slugname' => $proslug, 'pro_description' => $prodescription, 'pro_price' => $proprice,]);
            }
            return redirect()->back()->with('success', 'save');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not save');
        }
    }

    public function adminproductstatus($id)
    {
        $branch_id = Auth::user()->branch_id;

        $productstatus = Product::where(['id' => $id, 'branch_id' => $branch_id,])->select('pro_status')->first();
        switch ($productstatus->pro_status) {
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
        Product::where(['id' => $id, 'branch_id' => $branch_id,])->update(['pro_status' => $newStatus]);
        return redirect()->back();
    }

    public function adminmenu()
    {
        $branch_id = Auth::user()->branch_id;

        $capacity = Capacity::where(['capa_status' => 1])->get();
        $category = Category::get();


        $menu = DB::table('menus')
            ->join('categories', 'categories.id', '=', 'menus.menu_catid')
            ->join('capacities', 'capacities.id', '=', 'menus.menu_capaid')
            ->select('menus.branch_id', 'menus.menu_capaid', 'menus.menu_catid', 'menus.menu_status', 'menus.id', 'menus.menu_price', 'capacities.capa_lit', 'capacities.capa_per_cup', 'categories.cat_name')
            ->where(['menus.branch_id' => $branch_id])->get();

        return view('superadmin.menu', compact('capacity', 'category', 'menu'));
    }
    public function  adminmenuadd(Request $request)
    {

        try {
            $branch_id = Auth::user()->branch_id;
            $capacityid = $request->input('capacityid');
            $categoryid = $request->input('categoryid');
            $price = $request->input('price');

            $checkmenu = Menu::where([
                'menu_capaid' => $capacityid,
                'menu_catid' => $categoryid,
                'branch_id' => $branch_id,
            ])->first();

            if (isset($checkmenu)) {
                return redirect()->back()->with('failed', 'Menu already exists in this category and capacity!');
            } else {
                Menu::insert([
                    'menu_capaid' => $capacityid,
                    'menu_catid' => $categoryid,
                    'menu_price' => $price,
                    'branch_id' => $branch_id,
                ]);

                // $menuadd = [];

                // for ($i = 0; $i < count($productname); $i++) {
                //     $menuadd[] = [
                //         'productname' => $productname[$i],
                //         'price' => $price[$i],
                //         'capacityid' => $capacityid[$i],
                //         'categoryid' => $categoryid[$i],
                //     ];

                //     foreach ($menuadd as $menuitem) {
                //         Menu::insert([
                //             'menu_proname' => $menuitem['productname'],
                //             'menu_price' => $menuitem['price'],
                //             'menu_capaid' => $menuitem['capacityid'],
                //             'menu_catid' => $menuitem['categoryid'],
                //         ]);
                //     }
                // }
                return redirect()->back()->with('success', 'Successfull');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'error');
        }
    }

    public function adminmenustatus($id)
    {
        $branch_id = Auth::user()->branch_id;

        $menustatus = Menu::where(['id' => $id, 'branch_id' => $branch_id,])->select('menu_status')->first();
        switch ($menustatus->menu_status) {
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
        Menu::where(['id' => $id, 'branch_id' => $branch_id,])->update(['menu_status' => $newStatus]);
        return redirect()->back();
    }


    public function  adminmenuupdate(Request $request, $id)
    {

        try {
            $branch_id = Auth::user()->branch_id;
            $capacityid = $request->input('capacityid');
            $categoryid = $request->input('categoryid');
            $price = $request->input('price');


            Menu::where(['id' => $id, 'branch_id' => $branch_id,])->update([
                'menu_capaid' => $capacityid,
                'menu_catid' => $categoryid,
                'menu_price' => $price,

            ]);

            return redirect()->back()->with('success', 'Successfull');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'error');
        }
    }
}
