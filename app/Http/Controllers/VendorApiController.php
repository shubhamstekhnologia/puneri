<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorMinPrice;
use App\Brand;
use App\VendorApprovalBrands;
use App\VendorBrands;
use App\UserRegister;
use App\ProductRatingReview;
use App\VendorApprovalCategory;
use App\VendorCategory;
use App\Categories;
use App\Subcategories;
use App\VendorDealsIn;
use App\Admin;
use App\AdminProducts;
use App\DeliveryTime;
use App\VendorProducts;
use App\SizeLists;
use App\VendorApprovalProducts;
use App\AdminProductImages;
use App\AdminProductColors;
use App\OfferComponent;
use DateTimeZone;
use DateTime;
use DB;

class VendorApiController extends Controller
{


    public function add_min_order_price(Request $request)
    {

        $vendor = new VendorMinPrice();

        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');
        if ($request->get('admin_auto_id') != '') {
            $vendor->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $vendor->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $vendor->app_type_id = $request->get('app_type_id');
        } else {
            $vendor->app_type_id = "";
        }

        $vendor->user_auto_id = $request->get('user_auto_id');
        $vendor->price = $request->get('price');
        $vendor->rdate = date('Y-m-d');
        $vendor->save();


        return response()->json([
            'status' => 1,
            'msg' => config('messages.success'),


        ]);
    }
    public function add_new_brand_vendor(Request $request)
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');

        $add = new VendorApprovalBrands();
        if ($request->get('admin_auto_id') != '') {
            $add->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $add->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $add->app_type_id = $request->get('app_type_id');
        } else {
            $add->app_type_id = "";
        }
        $add->user_auto_id = $request->get('user_auto_id');
        $add->brand_name = $request->get('brand_name');
        if ($request->file('brand_image_web') != '') {
            $name = uniqid() . $request->file('brand_image_web')->getClientOriginalName();
            $path = public_path('images/brands');
            $request->file('brand_image_web')->move($path, $name);
            $data = $name;
            $add->brand_image_web = $data;
        } else {
            $add->brand_image_web = "";
        }
        if ($request->file('brand_image_app') != '') {
            $name = uniqid() . $request->file('brand_image_app')->getClientOriginalName();
            $path = public_path('images/brands');

            $request->file('brand_image_app')->move($path, $name);
            $data = $name;
            $add->brand_image_app = $data;
        } else {
            $add->brand_image_app = "";
        }
        if ($request->get('main_category_auto_id') != '') {
            $add->main_category_auto_id = $request->get('main_category_auto_id');
        } else {
            $add->main_category_auto_id = "";
        }

        $add->rdate = date('Y-m-d');
        $add->admin_approval = 'No';
        $add->save();


        return response()->json([
            'status' => 1,
            'msg' => config('messages.success'),


        ]);
    }
    // edit brand vendor
    public function edit_brand_vendor(Request $request)
    {
        $mainbrand = VendorApprovalBrands::find($request->get('brand_auto_id'));
        if (empty($mainbrand)) {
            return response()->json(['status' => 0, "msg" => "No brand Found"]);
        } else {

            $mainbrand->user_auto_id = $request->get('user_auto_id');
            $mainbrand->brand_name = $request->get('brand_name');
            if ($request->file('brand_image_web') != '') {
                $name = uniqid() . $request->file('brand_image_web')->getClientOriginalName();
                $path = public_path('images/brands');

                $request->file('brand_image_web')->move($path, $name);
                $data = $name;
                $mainbrand->brand_image_web = $data;
            } else {
                $mainbrand->brand_image_web = "";
            }
            if ($request->file('brand_image_app') != '') {
                $path = public_path('images/brands');

                $name = uniqid() . $request->file('brand_image_app')->getClientOriginalName();
                $request->file('brand_image_app')->move($path, $name);
                $data = $name;
                $mainbrand->brand_image_app = $data;
            } else {
                $mainbrand->brand_image_app = "";
            }
            if ($request->get('main_category_auto_id') != '') {
                $mainbrand->main_category_auto_id = $request->get('main_category_auto_id');
            } else {
                $mainbrand->main_category_auto_id = "";
            }

            $mainbrand->save();

            return response()->json([
                'status' => "1",
                "msg" => config('messages.success'),
                "data" => $mainbrand

            ]);
        }
    }
    public function disapprove_vendor_brand(Request $request)
    {

        $brands = VendorApprovalBrands::where('_id', '=', $request->get('brand_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        if ($brands->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, brand not found"]);
        } else {

            $updates = DB::table('vendor_approval_categories')->where('_id', '=', $request->get('brand_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->update(['admin_approval' => 'Disapproved']);

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    public function get_vendor_brands_approval_list(Request $request)
    {
        $get_vlist = VendorApprovalBrands::where('admin_approval', '=', 'No')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_approval', '!=', 'Disapproved')->whereNull('deleted_at')->get();

        if ($get_vlist->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_brand_approval_lists' => $get_vlist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    public function get_vendor_brand_disapproval_list(Request $request)
    {
        $get_disbrandslist = VendorApprovalBrands::where('admin_approval', '=', 'Disapproved')->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

        if ($get_disbrandslist->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_brands_disapproval_lists' => $get_disbrandslist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //update admin approval brands
    public function update_vendor_brands_admin(Request $request)
    {



        $tasks = VendorApprovalBrands::where('_id', '=', $request->get('brand_auto_id'))->where('app_type_id', $request->app_type_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();



        if ($tasks->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, brand not found"]);
        } else {

            $update = DB::table('vendor_approval_brands')->where('_id', '=', $request->get('brand_auto_id'))->where('app_type_id', $request->app_type_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->update(['admin_approval' => 'Yes']);

            if ($update) {
                $vbs = new VendorBrands();
                if ($request->get('admin_auto_id') != '') {
                    $vbs->admin_auto_id = $request->get('admin_auto_id');
                } else {
                    $vbs->admin_auto_id = "";
                }
                if ($request->get('app_type_id') != '') {
                    $vbs->app_type_id = $request->get('app_type_id');
                } else {
                    $vbs->app_type_id = "";
                }
                $vbs->user_auto_id = $request->user_auto_id;
                $vbs->brands_auto_id = $request->brands_auto_id;
                $vbs->save();

                foreach ($tasks as $urs) {
                    $brand_auto_id = $urs->_id;
                    $user_auto_id = $urs->user_auto_id;
                    $brand_name = $urs->brand_name;
                    $brand_image_web = $urs->brand_image_web;
                    $brand_image_app = $urs->brand_image_app;


                    $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                    $rdate =  $date->format('Y-m-d');

                    $vabs = new Brand();
                    if ($request->get('admin_auto_id') != '') {
                        $vabs->admin_auto_id = $request->get('admin_auto_id');
                    } else {
                        $vabs->admin_auto_id = "";
                    }
                    if ($request->get('app_type_id') != '') {
                        $vabs->app_type_id = $request->get('app_type_id');
                    } else {
                        $vabs->app_type_id = "";
                    }
                    $vabs->brand_auto_id = $brand_auto_id;
                    $vabs->user_auto_id = $user_auto_id;
                    $vabs->brand_name = $brand_name;
                    $vabs->brand_image_web = $brand_image_web;
                    $vabs->brand_image_app = $brand_image_app;
                    $vabs->main_category_auto_id = '';
                    $vabs->rdate = date('Y-m-d');
                    $vabs->save();
                }
            }



            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    public function get_vendor_brand_list(Request $request)
    {
        $cat = VendorBrands::where('user_auto_id', '=', $request->get('user_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($cat->isEmpty()) {

            return response()->json([
                'status' => 0,
                'msg' => "No Data Available",
            ]);
        } else {
            foreach ($cat as $data) {



                $prepration_ids = explode('|', $data->brands_auto_id);
                foreach ($prepration_ids as $data1) {


                    $lists = Brand::where('_id', $data1)->orwhere('brand_auto_id', $data1)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                    if ($lists->isNotEmpty()) {

                        foreach ($lists as $lts) {

                            $get_selected_brands_lists[] = array("brand_auto_id" => $lts->_id, "brand_name" => $lts->brand_name, "brand_image_app" => $lts->brand_image_app, "brand_image_web" => $lts->brand_image_web);
                        }
                    } else {

                        $get_selected_brands_lists = array();
                    }
                }
            }
            return response()->json([
                'status' => 1,
                'get_vendor_brand_lists' => $get_selected_brands_lists,
            ]);
        }
    }
    public function select_vendor_brands(Request $request)
    {
        $adds = new VendorBrands();
        if ($request->get('admin_auto_id') != '') {
            $adds->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $adds->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $adds->app_type_id = $request->get('app_type_id');
        } else {
            $adds->app_type_id = "";
        }
        $adds->user_auto_id = $request->user_auto_id;
        $adds->brands_auto_id = $request->brands_auto_id;
        $adds->save();

        return response()->json(['status' => '1', "msg" => config('messages.success')]);
    }

    //categories

    public function add_new_category_vendor(Request $request)
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');

        $adds = new VendorApprovalCategory();
        if ($request->get('admin_auto_id') != '') {
            $adds->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $adds->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $adds->app_type_id = $request->get('app_type_id');
        } else {
            $adds->app_type_id = "";
        }
        $adds->user_auto_id = $request->get('user_auto_id');
        $adds->category_name = $request->get('category_name');
        if ($request->file('category_image_app') != '') {
            $name = uniqid() . $request->file('category_image_app')->getClientOriginalName();
            $path = public_path('images/categories');

            $request->file('category_image_app')->move($path, $name);
            $data = $name;
            $adds->category_image_app = $data;
        } else {
            $adds->category_image_app = "";
        }
        if ($request->file('category_image_web') != '') {
            $path = public_path('images/categories');

            $name = uniqid() . $request->file('category_image_web')->getClientOriginalName();
            $request->file('category_image_web')->move($path, $name);
            $data = $name;
            $adds->category_image_web = $data;
        } else {
            $adds->category_image_web = "";
        }
        $adds->admin_approval = 'No';
        $adds->rdate = date('Y-m-d');
        $adds->save();


        return response()->json([
            'status' => 1,
            'msg' => config('messages.success'),


        ]);
    }

    // edit category vendor
    public function edit_category_vendor(Request $request)
    {
        $maincategory = VendorApprovalCategory::find($request->get('main_category_auto_id'));
        if (empty($maincategory)) {
            return response()->json(['status' => 0, "msg" => "No Main Category Found"]);
        } else {

            $maincategory->user_auto_id = $request->get('user_auto_id');
            $maincategory->category_name = $request->get('category_name');
            if ($request->file('category_image_app') != '') {
                $name = uniqid() . $request->file('category_image_app')->getClientOriginalName();
                $path = public_path('images/categories');

                $request->file('category_image_app')->move($path, $name);
                $data = $name;
                $maincategory->category_image_app = $data;
            } else {
                $maincategory->category_image_app = "";
            }
            if ($request->file('category_image_web') != '') {
                $name = uniqid() . $request->file('category_image_web')->getClientOriginalName();
                $path = public_path('images/categories');

                $request->file('category_image_web')->move($path, $name);
                $data = $name;
                $maincategory->category_image_web = $data;
            } else {
                $maincategory->category_image_web = "";
            }
            $maincategory->save();

            return response()->json([
                'status' => "1",
                "msg" => config('messages.success'),
                "data" => $maincategory

            ]);
        }
    }
    public function disapprove_vendor_category(Request $request)
    {

        $cats = VendorApprovalCategory::where('_id', '=', $request->get('category_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        if ($cats->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, category not found"]);
        } else {

            $updates = DB::table('vendor_approval_categories')->where('_id', '=', $request->get('category_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->update(['admin_approval' => 'Disapproved']);

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    public function get_vendor_category_approval_list(Request $request)
    {
        $get_clist = VendorApprovalCategory::where('admin_approval', '=', 'No')->where('admin_approval', '!=', 'Disapproved')->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

        if ($get_clist->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_category_approval_lists' => $get_clist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    public function get_vendor_category_disapproval_list(Request $request)
    {
        $get_dislist = VendorApprovalCategory::where('admin_approval', '=', 'Disapproved')->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

        if ($get_dislist->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_category_disapproval_lists' => $get_dislist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //update admin approval brands
    public function update_vendor_category_admin(Request $request)
    {

        $cats = VendorApprovalCategory::where('_id', '=', $request->get('category_auto_id'))->where('app_type_id', $request->app_type_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($cats->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, category not found"]);
        } else {

            $updates = DB::table('vendor_approval_categories')->where('_id', '=', $request->get('category_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->update(['admin_approval' => 'Yes']);

            if ($updates) {
                $vbs = new VendorCategory();
                $vbs->user_auto_id = $request->user_auto_id;

                if ($request->get('admin_auto_id') != '') {
                    $vbs->admin_auto_id = $request->get('admin_auto_id');
                } else {
                    $vbs->admin_auto_id = "";
                }
                if ($request->get('app_type_id') != '') {
                    $vbs->app_type_id = $request->get('app_type_id');
                } else {
                    $vbs->app_type_id = "";
                }
                $vbs->category_auto_id = $request->category_auto_id;
                $vbs->save();

                foreach ($cats as $urs) {
                    $category_auto_id = $urs->_id;
                    $user_auto_id = $urs->user_auto_id;
                    $category_name = $urs->category_name;
                    $category_image_app = $urs->category_image_app;
                    $category_image_web = $urs->category_image_web;


                    $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                    $rdate =  $date->format('Y-m-d');

                    $vabs = new Categories();
                    if ($request->get('admin_auto_id') != '') {
                        $vabs->admin_auto_id = $request->get('admin_auto_id');
                    } else {
                        $vabs->admin_auto_id = "";
                    }
                    if ($request->get('app_type_id') != '') {
                        $vabs->app_type_id = $request->get('app_type_id');
                    } else {
                        $vabs->app_type_id = "";
                    }
                    $vabs->category_auto_id = $category_auto_id;
                    $vabs->user_auto_id = $user_auto_id;
                    $vabs->category_name = $category_name;
                    $vabs->category_image_app = $category_image_app;
                    $vabs->category_image_web = $category_image_web;
                    $vabs->rdate = date('Y-m-d');
                    $vabs->save();
                }
            }



            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }

    public function get_vendor_category_list(Request $request)
    {
        $cat = VendorCategory::where('user_auto_id', '=', $request->get('user_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($cat->isEmpty()) {

            return response()->json([
                'status' => 0,
                'msg' => "No Data Available",
            ]);
        } else {
            foreach ($cat as $data) {


                $prepration_ids = explode('|', $data->category_auto_id);
                foreach ($prepration_ids as $data1) {


                    $lists = Categories::where('_id', $data1)->orwhere('category_auto_id', $data1)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                    if ($lists->isNotEmpty()) {

                        foreach ($lists as $lts) {


                            $get_selected_category_lists[] = array("category_auto_id" => $lts->_id, "category_name" => $lts->category_name, "category_image_app" => $lts->category_image_app, "category_image_web" => $lts->category_image_web);
                        }
                    } else {

                        $get_selected_category_lists = array();
                    }
                }
            }
            return response()->json([
                'status' => 1,
                'get_vendor_category_lists' => $get_selected_category_lists,
            ]);
        }
    }

    public function select_vendor_categories(Request $request)
    {
        $addss = new VendorCategory();
        $addss->user_auto_id = $request->get('user_auto_id');
        if ($request->get('admin_auto_id') != '') {
            $addss->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $addss->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $addss->app_type_id = $request->get('app_type_id');
        } else {
            $addss->app_type_id = "";
        }
        $addss->category_auto_id = $request->get('category_auto_id');
        $addss->save();

        return response()->json(['status' => '1', "msg" => config('messages.success')]);
    }
    //deals in
    public function add_new_dealin_vendor(Request $request)
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');

        $addsss = new VendorDealsIn();
        if ($request->get('admin_auto_id') != '') {
            $addsss->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $addsss->admin_auto_id = "";
        }
        $addsss->user_auto_id = $request->get('user_auto_id');
        $addsss->dealin_name = $request->get('dealin_name');
        if ($request->file('dealin_image_app') != '') {
            $name = uniqid() . $request->file('dealin_image_app')->getClientOriginalName();
            $request->file('dealin_image_app')->move('images/dealsin/', $name);
            $data = $name;
            $addsss->dealin_image_app = $data;
        } else {
            $addsss->dealin_image_app = "";
        }
        if ($request->file('dealin_image_web') != '') {
            $name = uniqid() . $request->file('dealin_image_web')->getClientOriginalName();
            $request->file('dealin_image_web')->move('images/dealsin/', $name);
            $data = $name;
            $addsss->dealin_image_web = $data;
        } else {
            $addsss->dealin_image_web = "";
        }
        $addsss->rdate = date('Y-m-d');
        $addsss->save();


        return response()->json([
            'status' => 1,
            'msg' => config('messages.success'),


        ]);
    }
    public function get_vendor_dealin_list(Request $request)
    {
        $catsss = VendorDealsIn::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->ORDERBY('_id', 'DESC')->whereNull('deleted_at')->get();
        if ($catsss->isEmpty()) {
            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty'),
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'get_vendor_dealin_lists' => $catsss,
            ]);
        }
    }
    public function select_vendor_dealin(Request $request)
    {
        $addsss = new VendorDealsIn();
        if ($request->get('admin_auto_id') != '') {
            $addsss->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $addsss->admin_auto_id = "";
        }
        $addsss->user_auto_id = $request->get('user_auto_id');
        $addsss->dealin_auto_id = $request->get('dealin_auto_id');
        $addsss->save();

        return response()->json(['status' => '1', "msg" => config('messages.success')]);
    }

    //vendor profile

    public function get_vendor_info(Request $request)
    {

        $wholesaler = UserRegister::find($request->get('user_auto_id'));

        if (empty($wholesaler)) {

            return response()->json(['status' => 0, "msg" => config('messages.empty')]);
        } else {

            return response()->json(['status' => 1, "profile" => $wholesaler]);
        }
    }



    // Update Profile

    public function update_vendor_info(Request $request)
    {

        $wholesaler = UserRegister::find($request->get('user_auto_id'));

        if (empty($wholesaler)) {

            return response()->json(['status' => 0, "msg" => config('messages.id')]);
        } else {
            if ($request->get('admin_auto_id') != '') {
                $wholesaler->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $wholesaler->admin_auto_id = "";
            }


            $wholesaler->shop_name = $request->get('shop_name');

            $wholesaler->city = $request->get('city');

            $wholesaler->address = $request->get('address');

            $wholesaler->min_order_value = $request->get('min_order_value');

            $wholesaler->price_range = $request->get('price_range');

            $wholesaler->save();



            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    //add product
    public function add_new_product(Request $request)
    {


        $product = new VendorApprovalProducts();

        $checkproduct = VendorApprovalProducts::where('product_name', $request->product_name)->whereNull('deleted_at')->first();
        if ($checkproduct) {
            return response()->json([
                'status' => '0',
                'msg' => 'This product already exists..!',
            ]);
        } else {

            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            if ($request->get('admin_auto_id') != '') {
                $product->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $product->admin_auto_id = "";
            }
            $product->user_auto_id = $request->get('user_auto_id');

            $product->main_category_auto_id = $request->get('main_category_auto_id');

            $product->product_name = $request->get('product_name');
            if ($request->get('product_price') != '') {
                $product->product_price = $request->get('product_price');
            } else {
                $product->product_price = "";
            }
            if ($request->get('sub_category_auto_id') != '') {
                $product->sub_category_auto_id = $request->get('sub_category_auto_id');
            } else {
                $product->product_model_auto_id = "";
            }
            $product->product_model_auto_id = uniqid();
            if ($request->get('brand_auto_id') != '') {
                $product->brand_auto_id = $request->get('brand_auto_id');
            } else {
                $product->brand_auto_id = "";
            }
            if ($request->get('unit') != '') {
                $product->unit = $request->get('unit');
            } else {
                $product->unit = "";
            }
            if ($request->get('quantity') != '') {
                $product->quantity = $request->get('quantity');
            } else {
                $product->quantity = "";
            }
            if ($request->get('gross_wt') != '') {
                $product->gross_wt = $request->get('gross_wt');
            } else {
                $product->gross_wt = "";
            }
            if ($request->get('net_wt') != '') {
                $product->net_wt = $request->get('net_wt');
            } else {
                $product->net_wt = "";
            }
            if ($request->get('offer_percentage') != '') {
                $product->offer_percentage = $request->get('offer_percentage');
            } else {
                $product->offer_percentage = "";
            }
            if ($request->get('moq') != '') {
                $product->moq = $request->get('moq');
            } else {
                $product->moq = "";
            }

            if ($request->get('description') != '') {
                $product->description = $request->get('description');
            } else {
                $product->description = "";
            }
            if ($request->get('highlights') != '') {
                $product->highlights = $request->get('highlights');
            } else {
                $product->highlights = "";
            }
            if ($request->get('weight') != '') {
                $product->weight = $request->get('weight');
            } else {
                $product->weight = "";
            }
            if ($request->get('product_dimensions') != '') {
                $product->product_dimensions = $request->get('product_dimensions');
            } else {
                $product->product_dimensions = "";
            }
            if ($request->get('specification_title') != '') {
                $product->specification_title = $request->get('specification_title');
            } else {
                $product->specification_title = "";
            }
            if ($request->get('specification_description') != '') {
                $product->specification_description = $request->get('specification_description');
            } else {
                $product->specification_description = "";
            }

            if ($request->get('new_arrival') != '') {
                $product->new_arrival = $request->get('new_arrival');
            } else {
                $product->new_arrival = "";
            }
            if ($request->get('isReturn') != '') {
                $product->isReturn = $request->get('isReturn');
            } else {
                $product->isReturn = "";
            }
            if ($request->get('isExchange') != '') {
                $product->isExchange = $request->get('isExchange');
            } else {
                $product->isExchange = "";
            }
            if ($request->get('days') != '') {
                $product->days = $request->get('days');
            } else {
                $product->days = "";
            }
            if (!empty($request->file('color_image'))) {
                $file = $request->file('color_image');
                $filename = $file->getClientOriginalName();
                $path = 'images/products/';
                $file->move($path, $filename);
                $product->color_image = $filename;
            } else {
                $product->color_image = '';
            }
            if ($request->get('color_name') != '') {
                $product->color_name = $request->get('color_name');
            } else {
                $product->color_name = "";
            }
            if ($request->get('size') != '') {
                $product->size = $request->get('size');
            } else {
                $product->size = "";
            }
            if ($request->get('size_price') != '') {
                $product->size_price = $request->get('size_price');
            } else {
                $product->size_price = "";
            }


            if ($request->get('including_tax') != '') {
                $product->including_tax = $request->get('including_tax');
            } else {
                $product->including_tax = "";
            }
            if ($request->get('tax_percentage') != '') {
                $product->tax_percentage = $request->get('tax_percentage');
            } else {
                $product->tax_percentage = "";
            }
            if ($request->get('including_tax') == 'Yes') {
                $offer_price = ($request->product_price * $request->offer_percentage) / 100;
                $final_price = $request->product_price - $offer_price;
                $product->final_price = strval($final_price);
            } else {
                $offer_price = ($request->product_price * $request->offer_percentage) / 100;
                $final_price = $request->product_price - $offer_price;
                $tax_price = ($final_price * $request->tax_percentage) / 100;
                $final_tax_price = $final_price + $tax_price;
                $product->final_price = strval($final_tax_price);
            }
            $product->admin_approval = 'No';

            $product->register_date = date('Y-m-d');
            $product->added_by = $request->get('added_by');
            $product->save();
            if ($product) {
                return response()->json([
                    'status' => "1",
                    'msg' => 'success',
                    'product_auto_id' => $product->_id,
                    'product_model_auto_id' => $product->product_model_auto_id,
                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "Someting went wrng"

                ]);
            }
        }
    }

    // edit brand vendor
    public function edit_product_vendor(Request $request)
    {
        $product = VendorApprovalProducts::find($request->get('product_auto_id'));
        if (empty($product)) {
            return response()->json(['status' => 0, "msg" => "No product Found"]);
        } else {
            $product->user_auto_id = $request->get('user_auto_id');

            $product->main_category_auto_id = $request->get('main_category_auto_id');

            $product->product_name = $request->get('product_name');
            if ($request->get('product_price') != '') {
                $product->product_price = $request->get('product_price');
            } else {
                $product->product_price = "";
            }
            if ($request->get('sub_category_auto_id') != '') {
                $product->sub_category_auto_id = $request->get('sub_category_auto_id');
            } else {
                $product->product_model_auto_id = "";
            }
            $product->product_model_auto_id = uniqid();
            if ($request->get('brand_auto_id') != '') {
                $product->brand_auto_id = $request->get('brand_auto_id');
            } else {
                $product->brand_auto_id = "";
            }
            if ($request->get('unit') != '') {
                $product->unit = $request->get('unit');
            } else {
                $product->unit = "";
            }
            if ($request->get('quantity') != '') {
                $product->quantity = $request->get('quantity');
            } else {
                $product->quantity = "";
            }
            if ($request->get('gross_wt') != '') {
                $product->gross_wt = $request->get('gross_wt');
            } else {
                $product->gross_wt = "";
            }
            if ($request->get('net_wt') != '') {
                $product->net_wt = $request->get('net_wt');
            } else {
                $product->net_wt = "";
            }
            if ($request->get('offer_percentage') != '') {
                $product->offer_percentage = $request->get('offer_percentage');
            } else {
                $product->offer_percentage = "";
            }
            if ($request->get('moq') != '') {
                $product->moq = $request->get('moq');
            } else {
                $product->moq = "";
            }

            if ($request->get('description') != '') {
                $product->description = $request->get('description');
            } else {
                $product->description = "";
            }
            if ($request->get('highlights') != '') {
                $product->highlights = $request->get('highlights');
            } else {
                $product->highlights = "";
            }
            if ($request->get('weight') != '') {
                $product->weight = $request->get('weight');
            } else {
                $product->weight = "";
            }
            if ($request->get('product_dimensions') != '') {
                $product->product_dimensions = $request->get('product_dimensions');
            } else {
                $product->product_dimensions = "";
            }
            if ($request->get('specification_title') != '') {
                $product->specification_title = $request->get('specification_title');
            } else {
                $product->specification_title = "";
            }
            if ($request->get('specification_description') != '') {
                $product->specification_description = $request->get('specification_description');
            } else {
                $product->specification_description = "";
            }

            if ($request->get('new_arrival') != '') {
                $product->new_arrival = $request->get('new_arrival');
            } else {
                $product->new_arrival = "";
            }
            if (!empty($request->file('color_image'))) {
                $file = $request->file('color_image');
                $filename = $file->getClientOriginalName();
                $path = 'images/products/';
                $file->move($path, $filename);
                $product->color_image = $filename;
            } else {
                $product->color_image = '';
            }
            if ($request->get('color_name') != '') {
                $product->color_name = $request->get('color_name');
            } else {
                $product->color_name = "";
            }
            if ($request->get('size') != '') {
                $product->size = $request->get('size');
            } else {
                $product->size = "";
            }
            if ($request->get('size_price') != '') {
                $product->size_price = $request->get('size_price');
            } else {
                $product->size_price = "";
            }


            if ($request->get('including_tax') != '') {
                $product->including_tax = $request->get('including_tax');
            } else {
                $product->including_tax = "";
            }
            if ($request->get('tax_percentage') != '') {
                $product->tax_percentage = $request->get('tax_percentage');
            } else {
                $product->tax_percentage = "";
            }
            if ($request->get('isReturn') != '') {
                $product->isReturn = $request->get('isReturn');
            } else {
                $product->isReturn = "";
            }
            if ($request->get('isExchange') != '') {
                $product->isExchange = $request->get('isExchange');
            } else {
                $product->isExchange = "";
            }
            if ($request->get('days') != '') {
                $product->days = $request->get('days');
            } else {
                $product->days = "";
            }
            if ($request->get('including_tax') == 'Yes') {
                $offer_price = ($request->product_price * $request->offer_percentage) / 100;
                $final_price = $request->product_price - $offer_price;
                $product->final_price = strval($final_price);
            } else {
                $offer_price = ($request->product_price * $request->offer_percentage) / 100;
                $final_price = $request->product_price - $offer_price;
                $tax_price = ($final_price * $request->tax_percentage) / 100;
                $final_tax_price = $final_price + $tax_price;
                $product->final_price = strval($final_tax_price);
            }
            $product->admin_approval = 'No';

            $product->register_date = date('Y-m-d');
            $product->added_by = $request->get('added_by');
            $product->save();

            return response()->json([
                'status' => "1",
                "msg" => config('messages.success'),
                "data" => $product

            ]);
        }
    }
    public function disapprove_vendor_product(Request $request)
    {

        $brands = VendorApprovalProducts::where('_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
        if ($brands->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, product not found"]);
        } else {

            $updates = DB::table('vendor_approval_categories')->where('_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->update(['admin_approval' => 'Disapproved']);

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }

    public function get_vendor_product_disapproval_list(Request $request)
    {
        $get_productlist = VendorApprovalProducts::where('admin_approval', '=', 'Disapproved')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();

        if ($get_productlist->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_product_disapproval_lists' => $get_productlist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    public function get_vendor_product_approval_list(Request $request)
    {
        $get_list = VendorApprovalProducts::where('admin_approval', '=', 'No')->where('admin_approval', '!=', 'Disapproved')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
        if ($get_list->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($get_list as $urs) {
                $product_auto_id = $urs->_id;
                $product_model_auto_id = $urs->product_model_auto_id;
                $color_image = $urs->color_image;
                $color_name = $urs->color_name;
                $size = $urs->size;
                $offer_auto_id = $urs->offer_auto_id;
                $size_ids = explode('|', $size);
                unset($get_slists);
                if ($size != "") {
                    foreach ($size_ids as $sz) {
                        $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        if ($sizelist->isNotEmpty()) {
                            foreach ($sizelist as $sub) {
                                $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                            }
                        } else {
                            $get_slists = array();
                        }
                    }
                } else {
                    $get_slists = array();
                }

                $offer_ids = explode('|', $offer_auto_id);
                unset($get_olists);
                foreach ($offer_ids as $offer) {
                    $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                    if ($offerlist->isNotEmpty()) {
                        foreach ($offerlist as $off) {
                            $get_olists[] = array(
                                "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                            );
                        }
                    } else {
                        $get_olists = array();
                    }
                }
                $size_price = $urs->size_price;
                $product_name = $urs->product_name;
                $get_details = VendorApprovalProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                foreach ($get_details as $dtls) {
                    $main_category_auto_id = $dtls->main_category_auto_id;
                    $sub_category_auto_id = $dtls->sub_category_auto_id;
                    $user_auto_id = $dtls->user_auto_id;
                    $added_by = $dtls->added_by;
                    $product_dimensions = $dtls->product_dimensions;
                    $product_name = $dtls->product_name;
                    $highlights = $dtls->highlights;
                    $description = $dtls->description;
                    $brand_auto_id = $dtls->brand_auto_id;
                    $new_arrival = $dtls->new_arrival;
                    $moq = $dtls->moq;
                    $gross_wt = $dtls->gross_wt;
                    $net_wt = $dtls->net_wt;
                    $unit = $dtls->unit;
                    $quantity = $dtls->quantity;
                    $weight = $dtls->weight;
                    $product_price = $dtls->product_price;
                    $offer_percentage = $dtls->offer_percentage;
                    $final_pprices = $dtls->final_price;
                    $product_model_auto_id = $dtls->product_model_auto_id;
                    $including_tax = $dtls->including_tax;
                    $tax_percentage = $dtls->tax_percentage;
                }

                unset($get_plists);
                $prepration_ids = explode('|', $size_price);
                if (!empty($size_price)) {
                    foreach ($prepration_ids as $data1) {



                        $offer_price = ($data1 * $offer_percentage) / 100;
                        $final_price = $data1 - $offer_price;
                        $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                    }
                } else {
                    $get_plists = array();
                }
                unset($image_lists);
                $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($pimage_details->isNotEmpty()) {
                    foreach ($pimage_details as $pidata) {
                        $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                    }
                } else {
                    $image_lists = array();
                }
                //rating review
                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }

                $sscats[] = array(
                    "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                    "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                    "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                    "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                    "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                );
            }

            return response()->json([
                'status' => 1,
                'get_vendor_product_approval_lists' => $sscats,
            ]);
        }
    }
    //update admin approval products
    public function update_vendor_product_admin(Request $request)
    {



        $cats = VendorApprovalProducts::where('_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();



        if ($cats->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, product not found"]);
        } else {

            $updates = DB::table('Vendor_approval_products')->where('_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->where('user_auto_id', '=', $request->get('user_auto_id'))->update(['admin_approval' => 'Yes']);

            if ($updates) {
                $prds = new VendorProducts();
                if ($request->get('admin_auto_id') != '') {
                    $prds->admin_auto_id = $request->get('admin_auto_id');
                } else {
                    $prds->admin_auto_id = "";
                }
                $prds->user_auto_id = $request->user_auto_id;
                $prds->product_auto_id = $request->product_auto_id;
                $prds->save();

                foreach ($cats as $urs) {
                    $product_auto_id = $urs->_id;
                    $user_auto_id = $urs->user_auto_id;
                    $main_category_auto_id = $urs->main_category_auto_id;
                    $product_name = $urs->product_name;
                    $price = $urs->product_price;
                    $sub_category_auto_id = $urs->sub_category_auto_id;
                    $product_model_auto_id = $urs->product_model_auto_id;
                    $brand_auto_id = $urs->brand_auto_id;
                    $unit = $urs->unit;
                    $quantity = $urs->quantity;
                    $gross_wt = $urs->gross_wt;
                    $net_wt = $urs->net_wt;
                    $offer_percentage = $urs->offer_percentage;
                    $moq = $urs->moq;
                    $color_image = $urs->color_image;
                    $color_name = $urs->color_name;
                    $size = $urs->size;
                    $size_price = $urs->size_price;
                    $description = $urs->description;
                    $weight = $urs->weight;
                    $product_dimensions = $urs->product_dimensions;
                    $specification_title = $urs->specification_title;
                    $specification_description = $urs->specification_description;
                    $isReturn = $urs->isReturn;
                    $isExchange = $urs->isExchange;
                    $days = $urs->days;
                    $added_by = $urs->added_by;
                    $final_price = $urs->final_price;
                    $new_arrival = $urs->new_arrival;
                    $highlights = $urs->highlights;
                    $including_tax = $urs->including_tax;
                    $tax_percentage = $urs->tax_percentage;


                    $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                    $rdate =  $date->format('Y-m-d');

                    $product = new AdminProducts();
                    if ($request->get('admin_auto_id') != '') {
                        $product->admin_auto_id = $request->get('admin_auto_id');
                    } else {
                        $product->admin_auto_id = "";
                    }
                    $product->product_auto_id = $product_auto_id;
                    $product->user_auto_id = $user_auto_id;
                    $product->main_category_auto_id = $main_category_auto_id;

                    $product->product_name = $product_name;

                    $product->product_price = $price;

                    $product->sub_category_auto_id = $sub_category_auto_id;

                    $product->product_model_auto_id = $product_model_auto_id;
                    $product->added_by = $added_by;

                    $product->brand_auto_id = $brand_auto_id;

                    $product->unit = $unit;

                    $product->quantity = $quantity;

                    $product->gross_wt = $gross_wt;

                    $product->net_wt = $net_wt;

                    $product->offer_percentage = $offer_percentage;

                    $product->moq = $moq;

                    $product->color_image = $color_image;

                    $product->color_name = $color_name;
                    $product->size = $size;

                    $product->size_price = $size_price;

                    $product->description = $description;
                    $product->highlights = $highlights;

                    $product->weight = $weight;


                    $product->product_dimensions = $product_dimensions;


                    $product->specification_title = $specification_title;
                    $product->specification_description = $specification_description;
                    $product->isReturn = $isReturn;
                    $product->isExchange = $isExchange;
                    $product->days = $days;
                    $product->final_price = $final_price;

                    $product->new_arrival = $new_arrival;
                    $product->including_tax = $including_tax;

                    $product->tax_percentage = $tax_percentage;


                    $product->save();
                }
            }



            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }

    public function get_vendor_product_list(Request $request)
    {


        // $pcat = VendorProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();

        $pcat =  AdminProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)
            ->whereNull('deleted_at')->get();

        if ($pcat->isEmpty()) {

            return response()->json([
                'status' => 0,
                'msg' => "No Data Available",
            ]);
        } else {

            foreach ($pcat as $data) {
                $prepration_ids = explode('|', $data->product_auto_id);
                foreach ($prepration_ids as $data1) {

                    unset($get_vendor_product_lists);

                    $get_aplists = AdminProducts::where('_id', $data1)->orwhere('_id', $data->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->orwhere('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();



                    if ($get_aplists->isNotEmpty()) {
                        foreach ($get_aplists as $urs) {
                            $product_auto_id = $urs->_id;
                            $product_model_auto_id = $urs->product_model_auto_id;
                            $color_image = $urs->color_image;
                            $color_name = $urs->color_name;
                            $size = $urs->size;
                            $offer_auto_id = $urs->offer_auto_id;

                            $size_ids = explode('|', $size);
                            unset($get_slists);
                            if ($size != "") {
                                foreach ($size_ids as $sz) {
                                    $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                                    if ($sizelist->isNotEmpty()) {
                                        foreach ($sizelist as $sub) {
                                            $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                                        }
                                    } else {
                                        $get_slists = array();
                                    }
                                }
                            } else {
                                $get_slists = array();
                            }

                            $offer_ids = explode('|', $offer_auto_id);
                            unset($get_olists);
                            foreach ($offer_ids as $offer) {
                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                                if ($offerlist->isNotEmpty()) {
                                    foreach ($offerlist as $off) {
                                        $get_olists[] = array(
                                            "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                            "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                                        );
                                    }
                                } else {
                                    $get_olists = array();
                                }
                            }
                            $size_price = $urs->size_price;
                            $product_name = $urs->product_name;
                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            foreach ($get_details as $dtls) {
                                $main_category_auto_id = $dtls->main_category_auto_id;
                                $sub_category_auto_id = $dtls->sub_category_auto_id;
                                $user_auto_id = $dtls->user_auto_id;
                                $added_by = $dtls->added_by;
                                $product_dimensions = $dtls->product_dimensions;
                                $product_name = $dtls->product_name;
                                $highlights = $dtls->highlights;
                                $description = $dtls->description;
                                $brand_auto_id = $dtls->brand_auto_id;
                                $new_arrival = $dtls->new_arrival;
                                $moq = $dtls->moq;
                                $gross_wt = $dtls->gross_wt;
                                $net_wt = $dtls->net_wt;
                                $unit = $dtls->unit;
                                $quantity = $dtls->quantity;
                                $weight = $dtls->weight;
                                $product_price = $dtls->product_price;
                                $offer_percentage = $dtls->offer_percentage;
                                $final_pprices = $dtls->final_price;
                                $product_model_auto_id = $dtls->product_model_auto_id;
                                $including_tax = $dtls->including_tax;
                                $tax_percentage = $dtls->tax_percentage;
                                $veg_nonveg = $dtls->veg_nonveg;
                                $egg_eggless = $dtls->egg_eggless;
                                $Customizable = $dtls->Customizable;
                                $product_sku = $dtls->product_sku;
                                $Manufacturers = $dtls->Manufacturers;
                                $Material = $dtls->Material;
                                $Width = $dtls->Width;
                                $height = $dtls->height;
                                $depth = $dtls->depth;
                                $Thickness = $dtls->Thickness;
                                $Firmness = $dtls->Firmness;
                                $Discount = $dtls->Discount;
                                $Trial_Period = $dtls->Trial_Period;
                                $stock = $dtls->stock;
                                $available_stock = $dtls->available_stock;
                                $Stock_alert_limit = $dtls->Stock_alert_limit;
                                $specification_title = $dtls->specification_title;
                                $specification_description = $dtls->specification_description;
                                $isReturn = $dtls->isReturn;
                                $isExchange = $dtls->isExchange;
                            }

                            unset($get_plists);
                            $prepration_ids = explode('|', $size_price);
                            if (!empty($size_price)) {
                                foreach ($prepration_ids as $data1) {
                                    $offer_price = ($data1 * $offer_percentage) / 100;
                                    $final_price = $data1 - $offer_price;
                                    $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                                }
                            } else {
                                $get_plists = array();
                            }

                            unset($image_lists);

                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                            if ($pimage_details->isNotEmpty()) {
                                foreach ($pimage_details as $pidata) {
                                    $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                                }

                            } else {
                                $image_lists = array();
                            }
                            //rating review
                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                            $avg_rating = 0;
                            if ($courseRatingReview->isNotEmpty()) {
                                foreach ($courseRatingReview as  $data) {
                                    $total_rating = $data->rating;

                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                                    $avg_rating = ($total_student * $total_rating / $total_student);
                                }
                            } else {
                                $courseRatingReview = array();
                            }
                            $get_vendor_product_lists[] = array(
                                "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                                "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                                "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                                "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                                "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_image_lists" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists, "veg_nonveg" => $veg_nonveg,
                                "egg_eggless" => $egg_eggless, "Customizable" => $Customizable, "product_sku" => $product_sku, "Manufacturers" => $Manufacturers, "Material" => $Material,
                                "Width" => $Width, "height" => $height, "depth" => $depth, "Thickness" => $Thickness, "Firmness" => $Firmness, "Discount" => $Discount, "Trial_Period" => $Trial_Period, "stock" => $stock, "available_stock" => $available_stock, "Stock_alert_limit" => $Stock_alert_limit, "specification_title" => $specification_title, "specification_description" => $specification_description, "isReturn" => $isReturn, "isExchange" => $isExchange

                            );
                        }
                    } else {

                        $get_vendor_product_lists = array();
                    }
                }
            }
            return response()->json([
                'status' => 1,
                'get_vendor_product_lists' => $get_vendor_product_lists,
            ]);
        }
    }

    public function select_vendor_product(Request $request)
    {
        $prds = new VendorProducts();
        if ($request->get('admin_auto_id') != '') {
            $prds->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $prds->admin_auto_id = "";
        }
        $prds->user_auto_id = $request->get('user_auto_id');
        $prds->product_auto_id = $request->get('product_auto_id');
        $prds->save();

        return response()->json(['status' => '1', "msg" => config('messages.success')]);
    }
    // brand products
    public function get_Vendor_Brand_Product(Request $request)
    {
        $pcat = AdminProducts::where('brand_auto_id', '=', $request->get('brand_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
        if ($pcat->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($pcat as $urs) {
                $product_auto_id = $urs->product_auto_id;
                $product_model_auto_id = $urs->product_model_auto_id;
                $color_image = $urs->color_image;
                $color_name = $urs->color_name;
                $size = $urs->size;
                $offer_auto_id = $urs->offer_auto_id;
                $size_ids = explode('|', $size);
                unset($get_slists);
                if ($size != "") {
                    foreach ($size_ids as $sz) {
                        $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        if ($sizelist->isNotEmpty()) {
                            foreach ($sizelist as $sub) {
                                $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                            }
                        } else {
                            $get_slists = array();
                        }
                    }
                } else {
                    $get_slists = array();
                }

                $offer_ids = explode('|', $offer_auto_id);
                unset($get_olists);
                foreach ($offer_ids as $offer) {
                    $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                    if ($offerlist->isNotEmpty()) {
                        foreach ($offerlist as $off) {
                            $get_olists[] = array(
                                "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                            );
                        }
                    } else {
                        $get_olists = array();
                    }
                }
                $size_price = $urs->size_price;
                $product_name = $urs->product_name;
                $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                foreach ($get_details as $dtls) {
                    $main_category_auto_id = $dtls->main_category_auto_id;
                    $sub_category_auto_id = $dtls->sub_category_auto_id;
                    $user_auto_id = $dtls->user_auto_id;
                    $added_by = $dtls->added_by;
                    $product_dimensions = $dtls->product_dimensions;
                    $product_name = $dtls->product_name;
                    $highlights = $dtls->highlights;
                    $description = $dtls->description;
                    $brand_auto_id = $dtls->brand_auto_id;
                    $new_arrival = $dtls->new_arrival;
                    $moq = $dtls->moq;
                    $gross_wt = $dtls->gross_wt;
                    $net_wt = $dtls->net_wt;
                    $unit = $dtls->unit;
                    $quantity = $dtls->quantity;
                    $weight = $dtls->weight;
                    $product_price = $dtls->product_price;
                    $offer_percentage = $dtls->offer_percentage;
                    $final_pprices = $dtls->final_price;
                    $product_model_auto_id = $dtls->product_model_auto_id;
                    $including_tax = $dtls->including_tax;
                    $tax_percentage = $dtls->tax_percentage;
                }


                unset($get_plists);
                $prepration_ids = explode('|', $size_price);
                if (!empty($size_price)) {
                    foreach ($prepration_ids as $data1) {
                        $offer_price = ($data1 * $offer_percentage) / 100;
                        $final_price = $data1 - $offer_price;
                        $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                    }
                } else {
                    $get_plists = array();
                }
                unset($image_lists);

                $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($pimage_details->isNotEmpty()) {
                    foreach ($pimage_details as $pidata) {
                        $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                    }
                } else {
                    $image_lists = array();
                }
                //rating review
                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
                $pcats[] = array(
                    "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                    "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                    "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                    "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                    "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $pimage_details, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                );
            }

            return response()->json([
                'status' => 1,
                'get_vendor_brand_product_lists' => $pcats,
            ]);
        }
    }
    // category products
    public function get_Vendor_MainCat_Product(Request $request)
    {
        $pcatss = AdminProducts::where('main_category_auto_id', '=', $request->get('cat_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
        if ($pcatss->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($pcatss as $urs) {
                $product_auto_id = $urs->product_auto_id;
                $product_model_auto_id = $urs->product_model_auto_id;
                $color_image = $urs->color_image;
                $color_name = $urs->color_name;
                $size = $urs->size;
                $offer_auto_id = $urs->offer_auto_id;
                $size_ids = explode('|', $size);
                unset($get_slists);
                if ($size != "") {
                    foreach ($size_ids as $sz) {
                        $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        if ($sizelist->isNotEmpty()) {
                            foreach ($sizelist as $sub) {
                                $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                            }
                        } else {
                            $get_slists = array();
                        }
                    }
                } else {
                    $get_slists = array();
                }

                $offer_ids = explode('|', $offer_auto_id);
                unset($get_olists);
                foreach ($offer_ids as $offer) {
                    $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                    if ($offerlist->isNotEmpty()) {
                        foreach ($offerlist as $off) {
                            $get_olists[] = array(
                                "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                            );
                        }
                    } else {
                        $get_olists = array();
                    }
                }
                $size_price = $urs->size_price;
                $product_name = $urs->product_name;
                $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                foreach ($get_details as $dtls) {
                    $main_category_auto_id = $dtls->main_category_auto_id;
                    $sub_category_auto_id = $dtls->sub_category_auto_id;
                    $user_auto_id = $dtls->user_auto_id;
                    $added_by = $dtls->added_by;
                    $product_dimensions = $dtls->product_dimensions;
                    $product_name = $dtls->product_name;
                    $highlights = $dtls->highlights;
                    $description = $dtls->description;
                    $brand_auto_id = $dtls->brand_auto_id;
                    $new_arrival = $dtls->new_arrival;
                    $moq = $dtls->moq;
                    $gross_wt = $dtls->gross_wt;
                    $net_wt = $dtls->net_wt;
                    $unit = $dtls->unit;
                    $quantity = $dtls->quantity;
                    $weight = $dtls->weight;
                    $product_price = $dtls->product_price;
                    $offer_percentage = $dtls->offer_percentage;
                    $final_pprices = $dtls->final_price;
                    $product_model_auto_id = $dtls->product_model_auto_id;
                    $including_tax = $dtls->including_tax;
                    $tax_percentage = $dtls->tax_percentage;
                }

                unset($get_plists);
                $prepration_ids = explode('|', $size_price);
                if (!empty($size_price)) {
                    foreach ($prepration_ids as $data1) {



                        $offer_price = ($data1 * $offer_percentage) / 100;
                        $final_price = $data1 - $offer_price;
                        $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                    }
                } else {
                    $get_plists = array();
                }
                unset($image_lists);
                $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($pimage_details->isNotEmpty()) {
                    foreach ($pimage_details as $pidata) {
                        $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                    }
                } else {
                    $image_lists = array();
                }
                //rating review
                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
                $pcatsss[] = array(
                    "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                    "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                    "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                    "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                    "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                );
            }

            return response()->json([
                'status' => 1,
                'get_vendor_category_product_lists' => $pcatsss,
            ]);
        }
    }
    public function getsubcategories(Request $request)
    {

        $get_sub_cats = Subcategories::Where('main_category_auto_id', $request->get('main_cat_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();

        if ($get_sub_cats->isNotEmpty()) {
            foreach ($get_sub_cats as $data) {
                $subcatid = $data->_id;
                unset($sscats);
                $get_products = AdminProducts::where('sub_category_auto_id', '=', $subcatid)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($get_products->isNotEmpty()) {
                    foreach ($get_products as $urs) {
                        $product_auto_id = $urs->product_auto_id;
                        $product_model_auto_id = $urs->product_model_auto_id;
                        $color_image = $urs->color_image;
                        $color_name = $urs->color_name;
                        $size = $urs->size;
                        $offer_auto_id = $urs->offer_auto_id;
                        $size_ids = explode('|', $size);
                        unset($get_slists);
                        if ($size != "") {
                            foreach ($size_ids as $sz) {
                                $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                                if ($sizelist->isNotEmpty()) {
                                    foreach ($sizelist as $sub) {
                                        $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                                    }
                                } else {
                                    $get_slists = array();
                                }
                            }
                        } else {
                            $get_slists = array();
                        }

                        $offer_ids = explode('|', $offer_auto_id);
                        unset($get_olists);
                        foreach ($offer_ids as $offer) {
                            $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                            if ($offerlist->isNotEmpty()) {
                                foreach ($offerlist as $off) {
                                    $get_olists[] = array(
                                        "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                        "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                                    );
                                }
                            } else {
                                $get_olists = array();
                            }
                        }
                        $size_price = $urs->size_price;
                        $product_name = $urs->product_name;
                        $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        foreach ($get_details as $dtls) {
                            $main_category_auto_id = $dtls->main_category_auto_id;
                            $sub_category_auto_id = $dtls->sub_category_auto_id;
                            $user_auto_id = $dtls->user_auto_id;
                            $added_by = $dtls->added_by;
                            $product_dimensions = $dtls->product_dimensions;
                            $product_name = $dtls->product_name;
                            $highlights = $dtls->highlights;
                            $description = $dtls->description;
                            $brand_auto_id = $dtls->brand_auto_id;
                            $new_arrival = $dtls->new_arrival;
                            $moq = $dtls->moq;
                            $gross_wt = $dtls->gross_wt;
                            $net_wt = $dtls->net_wt;
                            $unit = $dtls->unit;
                            $quantity = $dtls->quantity;
                            $weight = $dtls->weight;
                            $product_price = $dtls->product_price;
                            $offer_percentage = $dtls->offer_percentage;
                            $final_pprices = $dtls->final_price;
                            $product_model_auto_id = $dtls->product_model_auto_id;
                            $including_tax = $dtls->including_tax;
                            $tax_percentage = $dtls->tax_percentage;
                        }

                        unset($get_plists);
                        $prepration_ids = explode('|', $size_price);
                        if (!empty($size_price)) {
                            foreach ($prepration_ids as $data1) {



                                $offer_price = ($data1 * $offer_percentage) / 100;
                                $final_price = $data1 - $offer_price;
                                $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                            }
                        } else {
                            $get_plists = array();
                        }
                        unset($image_lists);
                        $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        if ($pimage_details->isNotEmpty()) {
                            foreach ($pimage_details as $pidata) {
                                $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                            }
                        } else {
                            $image_lists = array();
                        }

                        //rating review
                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                        $avg_rating = 0;
                        if ($courseRatingReview->isNotEmpty()) {
                            foreach ($courseRatingReview as  $data) {
                                $total_rating = $data->rating;

                                $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                                $avg_rating = ($total_student * $total_rating / $total_student);
                            }
                        } else {
                            $courseRatingReview = array();
                        }
                        $sscats[] = array(
                            "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                            "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                            "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                            "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                            "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                        );
                    }
                } else {
                    $sscats = array();
                }
                $getData[] = array('sub_category_auto_id' => $data->_id, 'sub_category_name' => $data->sub_category_name, 'subcategory_image_app' => $data->subcategory_image_app, 'subcategory_image_web' => $data->subcategory_image_web);
            }
        } else {
            $getData = array();
        }

        return response()->json(["status" => 1, "all_products_under_subcategories" => $getData]);
    }
    public function get_vendor_lists(Request $request)
    {
        $get_vendors = UserRegister::where('user_type', '=', 'Seller')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();

        if ($get_vendors->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_lists' => $get_vendors]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    public function get_customer_lists(Request $request)
    {
        $get_clist = UserRegister::where('user_type', '=', 'customer')
        ->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->where('status','=','verified')->get();

        if ($get_clist->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_customer_lists' => $get_clist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //product color
    public function add_vendor_Product_color(Request $request)
    {
        $get_details = VendorApprovalProducts::where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('product_name', '!=', '')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
        foreach ($get_details as $dtls) {
            $main_category_auto_id = $dtls->main_category_auto_id;
            $sub_category_auto_id = $dtls->sub_category_auto_id;
            $added_by = $dtls->added_by;
            $product_dimensions = $dtls->product_dimensions;
            $product_name = $dtls->product_name;
            $highlights = $dtls->highlights;
            $description = $dtls->description;
            $specification_title = $dtls->specification_title;
            $specification_description = $dtls->specification_description;
            $isReturn = $dtls->isReturn;
            $isExchange = $dtls->isExchange;
            $days = $dtls->days;
            $brand_auto_id = $dtls->brand_auto_id;
            $new_arrival = $dtls->new_arrival;
            $moq = $dtls->moq;
            $gross_wt = $dtls->gross_wt;
            $net_wt = $dtls->net_wt;
            $unit = $dtls->unit;
            $quantity = $dtls->quantity;
            $weight = $dtls->weight;
        }

        $cproduct = new VendorApprovalProducts();


        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');

        if ($request->get('admin_auto_id') != '') {
            $cproduct->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $cproduct->admin_auto_id = "";
        }
        $cproduct->user_auto_id = $request->get('user_auto_id');
        $cproduct->product_model_auto_id = $request->get('product_model_auto_id');
        $cproduct->main_category_auto_id = $main_category_auto_id;
        $cproduct->sub_category_auto_id = $sub_category_auto_id;
        $cproduct->brand_auto_id = $brand_auto_id;
        $cproduct->product_name = $product_name;
        $cproduct->added_by = $added_by;
        $cproduct->product_dimensions = $product_dimensions;
        $cproduct->highlights = $highlights;
        $cproduct->description = $description;
        $cproduct->specification_title = $specification_title;
        $cproduct->specification_description = $specification_description;
        $cproduct->new_arrival = $new_arrival;
        $cproduct->isReturn = $isReturn;
        $cproduct->isExchange = $isExchange;
        $cproduct->days = $days;
        $cproduct->moq = $moq;
        $cproduct->gross_wt = $gross_wt;
        $cproduct->net_wt = $net_wt;
        $cproduct->unit = $unit;
        $cproduct->quantity = $quantity;
        $cproduct->weight = $weight;




        if (!empty($request->file('color_image'))) {
            $file = $request->file('color_image');
            $filename = $file->getClientOriginalName();
            $path = 'images/products/';
            $file->move($path, $filename);
            $cproduct->color_image = $filename;
        } else {
            $cproduct->color_image = '';
        }

        if ($request->get('color_name') != '') {
            $cproduct->color_name = $request->get('color_name');
        } else {
            $cproduct->color_name = "";
        }
        if ($request->get('product_price') != '') {
            $cproduct->product_price = $request->get('product_price');
        } else {
            $cproduct->product_price = "";
        }
        if ($request->get('offer_percentage') != '') {
            $cproduct->offer_percentage = $request->get('offer_percentage');
        } else {
            $cproduct->offer_percentage = "";
        }

        if ($request->get('size') != '') {
            $cproduct->size = $request->get('size');
        } else {
            $cproduct->size = "";
        }
        if ($request->get('size_price') != '') {
            $cproduct->size_price = $request->get('size_price');
        } else {
            $cproduct->size_price = "";
        }
        if ($request->get('including_tax') != '') {
            $cproduct->including_tax = $request->get('including_tax');
        } else {
            $cproduct->including_tax = "";
        }
        if ($request->get('tax_percentage') != '') {
            $cproduct->tax_percentage = $request->get('tax_percentage');
        } else {
            $cproduct->tax_percentage = "";
        }
        if ($request->get('including_tax') == 'Yes') {
            $offer_price = ($request->product_price * $request->offer_percentage) / 100;
            $final_price = $request->product_price - $offer_price;
            $cproduct->final_price = strval($final_price);
        } else {
            $offer_price = ($request->product_price * $request->offer_percentage) / 100;
            $final_price = $request->product_price - $offer_price;
            $tax_price = ($final_price * $request->tax_percentage) / 100;
            $final_tax_price = $final_price + $tax_price;
            $cproduct->final_price = strval($final_tax_price);
        }
        $cproduct->register_date = date('Y-m-d');
        $cproduct->admin_approval = 'No';
        $cproduct->save();
        if ($cproduct) {
            return response()->json([
                'status' => "1",
                'data' => $cproduct

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "Someting went wrong"

            ]);
        }
    }

    //get product colors
    public function get_vendor_product_colors(Request $request)
    {
        $get_clists = VendorApprovalProducts::where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();

        if ($get_clists->isNotEmpty()) {
            foreach ($get_clists as $curs) {
                $product_auto_id = $curs->_id;
                $product_model_auto_id = $curs->product_model_auto_id;
                $color_image = $curs->color_image;
                $color_name = $curs->color_name;
                $size = $curs->size;
                $offer_auto_id = $urs->offer_auto_id;
                $size_ids = explode('|', $size);
                unset($get_slists);
                if ($size != "") {
                    foreach ($size_ids as $sz) {
                        $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        if ($sizelist->isNotEmpty()) {
                            foreach ($sizelist as $sub) {
                                $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                            }
                        } else {
                            $get_slists = array();
                        }
                    }
                } else {
                    $get_slists = array();
                }

                $offer_ids = explode('|', $offer_auto_id);
                unset($get_olists);
                foreach ($offer_ids as $offer) {
                    $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                    if ($offerlist->isNotEmpty()) {
                        foreach ($offerlist as $off) {
                            $get_olists[] = array(
                                "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                            );
                        }
                    } else {
                        $get_olists = array();
                    }
                }
                $size_price = $curs->size_price;
                $offer_percentage = $curs->offer_percentage;


                unset($get_cplists);
                $prepration_ids = explode('|', $size_price);
                if (!empty($size_price)) {
                    foreach ($prepration_ids as $data1) {



                        $offer_price = ($data1 * $offer_percentage) / 100;
                        $final_price = $data1 - $offer_price;
                        $get_cplists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                    }
                } else {
                    $get_cplists = array();
                }
                unset($image_lists);
                $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($pimage_details->isNotEmpty()) {
                    foreach ($pimage_details as $pidata) {
                        $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                    }
                } else {
                    $image_lists = array();
                }
                //rating review
                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
                $get_cfinal_lists[] = array("product_auto_id" => $product_auto_id, "product_model_auto_id" => $product_model_auto_id, "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "get_size_lists" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_cplists, "product_image_lists" => $image_lists);
            }
            return response()->json(['status' => 1, "msg" => "success", 'get_products_lists' => $get_cfinal_lists]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //Delete component content
    public function delete_vendor_product(Request $request)
    {
        $tdetails = VendorApprovalProducts::where('_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->delete();
        $vtdetailsss = VendorProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->delete();
        $tdetailsss = AdminProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->delete();

        if ($tdetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([

                'status' => 0,

                'msg' => "product Not found"

            ]);
        }
    }
    //edit product

    public function edit_vendor_product(Request $request)
    {
        $get_aplists = AdminProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();

        if ($get_aplists->isNotEmpty()) {
            foreach ($get_aplists as $urs) {
                $product_auto_id = $urs->product_auto_id;
                $product_model_auto_id = $urs->product_model_auto_id;
                $color_image = $urs->color_image;
                $color_name = $urs->color_name;
                $size = $urs->size;
                $offer_auto_id = $urs->offer_auto_id;
                $specification_title = $urs->specification_title;
                $specification_description = $urs->specification_description;
                $pids = array();
                $qids = array();
                $specification_title_ids = explode('|', $specification_title);
                $specification_description_ids = explode('|', $specification_description);
                foreach ($specification_title_ids as $data1) {
                    $pids[] = $data1;
                }
                foreach ($specification_description_ids as $data2) {
                    $qids[] = $data2;
                }
                $emailArray = $pids;
                $totaltitles = count($emailArray);
                $qArray = $qids;
                $totaldescription = count($qArray);
                if ($emailArray != "") {
                    for ($i = 0; $i < $totaltitles; $i++) {
                        $get_specification_details[] = array("title" => $emailArray[$i], "description" => $qArray[$i]);
                    }
                } else {
                    $get_specification_details = array();
                }
                $size_ids = explode('|', $size);
                unset($get_slists);
                if ($size != "") {
                    foreach ($size_ids as $sz) {
                        $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                        if ($sizelist->isNotEmpty()) {
                            foreach ($sizelist as $sub) {
                                $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                            }
                        } else {
                            $get_slists = array();
                        }
                    }
                } else {
                    $get_slists = array();
                }

                $offer_ids = explode('|', $offer_auto_id);
                unset($get_olists);
                foreach ($offer_ids as $offer) {
                    $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                    if ($offerlist->isNotEmpty()) {
                        foreach ($offerlist as $off) {
                            $get_olists[] = array(
                                "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                            );
                        }
                    } else {
                        $get_olists = array();
                    }
                }
                $size_price = $urs->size_price;
                $product_name = $urs->product_name;
                $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                foreach ($get_details as $dtls) {
                    $main_category_auto_id = $dtls->main_category_auto_id;
                    $sub_category_auto_id = $dtls->sub_category_auto_id;
                    $user_auto_id = $dtls->user_auto_id;
                    $added_by = $dtls->added_by;
                    $product_dimensions = $dtls->product_dimensions;
                    $product_name = $dtls->product_name;
                    $highlights = $dtls->highlights;
                    $description = $dtls->description;
                    $brand_auto_id = $dtls->brand_auto_id;
                    $new_arrival = $dtls->new_arrival;
                    $moq = $dtls->moq;
                    $gross_wt = $dtls->gross_wt;
                    $net_wt = $dtls->net_wt;
                    $unit = $dtls->unit;
                    $quantity = $dtls->quantity;
                    $weight = $dtls->weight;
                    $product_price = $dtls->product_price;
                    $offer_percentage = $dtls->offer_percentage;
                    $final_pprices = $dtls->final_price;
                    $product_model_auto_id = $dtls->product_model_auto_id;
                    $including_tax = $dtls->including_tax;
                    $tax_percentage = $dtls->tax_percentage;
                    $isReturn = $dtls->isReturn;
                    $isExchange = $dtls->isExchange;
                    $days = $dtls->days;
                }

                unset($get_plists);
                $prepration_ids = explode('|', $size_price);
                if (!empty($size_price)) {
                    foreach ($prepration_ids as $data1) {



                        $offer_price = ($data1 * $offer_percentage) / 100;
                        $final_price = $data1 - $offer_price;
                        $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                    }
                } else {
                    $get_plists = array();
                }
                unset($image_lists);
                $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($pimage_details->isNotEmpty()) {
                    foreach ($pimage_details as $pidata) {
                        $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                    }
                } else {
                    $image_lists = array();
                }
                //expected delivery time
                $deliverytime = DeliveryTime::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                if ($deliverytime->isNotEmpty()) {
                    foreach ($deliverytime as $dtime) {
                        $dtime_lists[] = array("dtime_auto_id" => $dtime->_id, "time" => $dtime->time, "unit" => $dtime->unit);
                    }
                } else {
                    $dtime_lists = array();
                }
                //rating review
                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
                $apdcats[] = array(
                    "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                    "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                    "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "isReturn" => $isReturn, "isExchange" => $isExchange, "days" => $days,
                    "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                    "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "dtime_details" => $dtime_lists, "avg_rating" => $avg_rating, "specification_details" => $get_specification_details, "product_image_lists" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                );
            }
            return response()->json(['status' => 1, "msg" => "success", 'get_products_details' => $apdcats]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    //update product

    public function update_vendor_product(Request $request)
    {
        $main = AdminProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "")->whereNull('deleted_at')->first();
        if (empty($main)) {
            return response()->json(['status' => 0, "msg" => "No product Found"]);
        } else {
            $main->user_auto_id = $request->get('user_auto_id');
            $main->main_category_auto_id = $request->get('main_category_auto_id');
            $main->product_name = $request->get('product_name');
            if ($request->get('product_price') != '') {
                $main->product_price = $request->get('product_price');
            } else {
                $main->product_price = "";
            }
            if ($request->get('sub_category_auto_id') != '') {
                $main->sub_category_auto_id = $request->get('sub_category_auto_id');
            } else {
                $main->product_model_auto_id = "";
            }
            if ($request->get('brand_auto_id') != '') {
                $main->brand_auto_id = $request->get('brand_auto_id');
            } else {
                $main->brand_auto_id = "";
            }
            if ($request->get('unit') != '') {
                $main->unit = $request->get('unit');
            } else {
                $main->unit = "";
            }
            if ($request->get('quantity') != '') {
                $main->quantity = $request->get('quantity');
            } else {
                $main->quantity = "";
            }
            if ($request->get('gross_wt') != '') {
                $main->gross_wt = $request->get('gross_wt');
            } else {
                $main->gross_wt = "";
            }
            if ($request->get('net_wt') != '') {
                $main->net_wt = $request->get('net_wt');
            } else {
                $main->net_wt = "";
            }
            if ($request->get('offer_percentage') != '') {
                $main->offer_percentage = $request->get('offer_percentage');
            } else {
                $main->offer_percentage = "";
            }
            if ($request->get('moq') != '') {
                $main->moq = $request->get('moq');
            } else {
                $main->moq = "";
            }

            if ($request->get('description') != '') {
                $main->description = $request->get('description');
            } else {
                $main->description = "";
            }
            if ($request->get('highlights') != '') {
                $main->highlights = $request->get('highlights');
            } else {
                $main->highlights = "";
            }
            if ($request->get('weight') != '') {
                $main->weight = $request->get('weight');
            } else {
                $main->weight = "";
            }
            if ($request->get('product_dimensions') != '') {
                $main->product_dimensions = $request->get('product_dimensions');
            } else {
                $main->product_dimensions = "";
            }
            if ($request->get('specification_title') != '') {
                $main->specification_title = $request->get('specification_title');
            } else {
                $main->specification_title = "";
            }
            if ($request->get('specification_description') != '') {
                $main->specification_description = $request->get('specification_description');
            } else {
                $main->specification_description = "";
            }
            if ($request->get('new_arrival') != '') {
                $main->new_arrival = $request->get('new_arrival');
            } else {
                $main->new_arrival = "";
            }
            if ($request->get('isReturn') != '') {
                $main->isReturn = $request->get('isReturn');
            } else {
                $main->isReturn = "";
            }
            if ($request->get('isExchange') != '') {
                $main->isExchange = $request->get('isExchange');
            } else {
                $main->isExchange = "";
            }
            if ($request->get('days') != '') {
                $main->days = $request->get('days');
            } else {
                $main->days = "";
            }
            if (!empty($request->file('color_image'))) {
                $file = $request->file('color_image');
                $filename = $file->getClientOriginalName();
                $path = 'images/products/';
                $file->move($path, $filename);
                $main->color_image = $filename;
            }
            if ($request->get('color_name') != '') {
                $main->color_name = $request->get('color_name');
            } else {
                $main->color_name = "";
            }
            if ($request->get('size') != '') {
                $main->size = $request->get('size');
            } else {
                $main->size = "";
            }
            if ($request->get('size_price') != '') {
                $main->size_price = $request->get('size_price');
            } else {
                $main->size_price = "";
            }
            $main->added_by = $request->get('added_by');
            if ($request->get('including_tax') != '') {
                $main->including_tax = $request->get('including_tax');
            } else {
                $main->including_tax = "";
            }
            if ($request->get('tax_percentage') != '') {
                $main->tax_percentage = $request->get('tax_percentage');
            } else {
                $main->tax_percentage = "";
            }
            if ($request->get('including_tax') == 'Yes') {
                $offer_price = ($request->product_price * $request->offer_percentage) / 100;
                $final_price = $request->product_price - $offer_price;
                $main->final_price = strval($final_price);
            } else {
                $offer_price = ($request->product_price * $request->offer_percentage) / 100;
                $final_price = $request->product_price - $offer_price;
                $tax_price = ($final_price * $request->tax_percentage) / 100;
                $final_tax_price = $final_price + $tax_price;
                $main->final_price = strval($final_tax_price);
            }
            $main->save();

            return response()->json([
                'status' => "1",
                'msg' => "Sucessfully Updated"


            ]);
        }
    }
    //get vendor lists
    public function get_all_vendor_list(Request $request)
    {
        $get_vlists = UserRegister::where('user_type', '=', 'Vendor')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

        if ($get_vlists->isNotEmpty()) {

            return response()->json(['status' => 1, "msg" => "success", 'get_vendor_lists' => $get_vlists]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //show vendor details
    public function show_vendor_details(Request $request)
    {

        $vdetails = UserRegister::find($request->get('vendor_auto_id'));

        if (empty($vdetails)) {

            return response()->json(['status' => 0, "msg" => config('messages.empty')]);
        } else {

            return response()->json(['status' => 1, "vendor_details" => $vdetails]);
        }
    }
    public function show_customer_details(Request $request)
    {

        $cdetails = UserRegister::find($request->get('customer_auto_id'));

        if (empty($cdetails)) {

            return response()->json(['status' => 0, "msg" => config('messages.empty')]);
        } else {

            return response()->json(['status' => 1, "customer_details" => $cdetails]);
        }
    }
}