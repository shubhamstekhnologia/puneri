<?php

namespace App\Http\Controllers\Admin;

use DB;
use DateTime;
use Redirect;
use App\Admin;
use Validator;
use App\Orders;
use DateTimeZone;
use App\Categories;
use App\MainOrders;
use App\VendorOrders;
use App\AdminProducts;
use App\CategoryStyle;
use App\Subcategories;
use App\ContactDetails;
use App\BusinessDetails;
use App\Traits\Features;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;


class PurchasedController extends Controller
{

    use Features;
    public function get_admin()
    {
        $subdomain = session("main");
        $admin =  Admin::where("subdomain", "=", $subdomain)->first();
        if (empty($admin)) {
            abort(404);
        }

        if (empty($admin)) {
            abort(404);
        }

        return $admin->id;
    }
    public function index()
    {
        $history = ClassifiedPurchasedOrders::get();
        $ads = ClassifiedAdd::get();
        $user = UserRegister::get();
        return view('templates.SuperAdmin.purchased_history')->with(['order_history' => $history, 'ad_details' => $ads, 'cust_details' => $user]);
    }


    public function delete(Request $request)
    {

        $id = $request->id;
        $ads = ClassifiedPurchasedOrders::find($id);
        $ads->delete();

        return redirect('purchased-history')->with('success', 'Deleted Successfully');
    }

    //order details
    //

    public function my_orders()
    {

        if (Session::has('AccessTokens')) {



            $cust_id = Session::get('AccessTokens');
            unset($atldatewisedetails);
            $get_main_categories = Categories::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
            $i = 0;
            foreach ($get_main_categories as $main) {
                $main_id = $main->id;
                $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->get();
                $get_main_categories[$i]['subcategories'] = $get_sub_categories;

                $i++;
            }
            $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
            if (!empty($get_maincategory_style)) {
                $main_category_display_style = $get_maincategory_style->web_icon_style;
            } else {
                $main_category_display_style = "0";
            }
            $get_business_details = BusinessDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
            $get_contact_details = ContactDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
            //  		$booking = Orders::where('customer_auto_id','=', $cust_id)->get();
            //         if($booking->isNotEmpty()){
            //  foreach($booking as $data){

            //         $order_id = $data->order_id;


            //           $lists = VendorOrders::where('order_id', $order_id)->get();
            //              if($lists->isNotEmpty()){
            //                     foreach($lists as $lts){
            //                         $pname = AdminProducts::where('_id', $lts->product_auto_id)->get();

            //                     foreach($pname as $pn){
            //                          $product_name = $pn->product_name;
            //                           $color_name = $pn->color_name;
            //                           $color_image = $pn->color_image;

            //                     }
            //           $get_lists[] = array("product_order_auto_id"=>$lts->_id,"order_id"=>$lts->order_id,"added_by_id"=>$lts->added_by_id,"added_by"=>$lts->added_by,"product_auto_id"=>$lts->product_auto_id,
            //           "product_name"=>$product_name,"product_image"=>$lts->product_image,"size"=>$lts->size,"quantity"=>$lts->quantity,"color_name"=>$color_name,
            //           "color_image"=>$color_image,"order_date"=>$lts->order_date,"order_status"=>$lts->order_status,"product_price"=>$lts->product_price,"product_offer_percentage"=>$lts->product_offer_percentage,
            //           "product_final_price"=>$lts->product_final_price);


            //                      }
            //              }else{
            //                  $get_lists =array();

            //              }






            //              }
            //           return view('templates.frontend.cust_order_history')->with(['data' => $get_lists,'contact_details'=>$get_contact_details,'main_cat_style'=>$main_category_display_style,'business_details'=>$get_business_details,'main_category'=>$get_main_categories]);


            //         }else{
            //   return view('templates.frontend.cust_order_history')->with(['main_cat_style'=>$main_category_display_style,'contact_details'=>$get_contact_details,'business_details'=>$get_business_details,'main_category'=>$get_main_categories]);
            //       }

            $main_orders = Orders::where('customer_auto_id', '=', $cust_id)
                ->whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();

            if ($main_orders->isNotEmpty()) {

                // foreach ($main_orders as $morder) {
                //     $single = Orders::where('order_id', '=', $morder->id)->get();
                // }

                return view('templates.frontend.cust_order_history')->with(['data' => $main_orders, 'contact_details' => $get_contact_details, 'main_cat_style' => $main_category_display_style, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
            } else {
                return view('templates.frontend.cust_order_history')->with(['main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
                //       }
            }
        } else {
            return redirect('/login');
        }
    }

    //order details
    public function my_orders_details($id)
    {

        $cust_id = Session::get('AccessTokens');
        unset($atldatewisedetails);
        $get_main_categories = Categories::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }
        $get_business_details = BusinessDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $get_contact_details = ContactDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $booking = Orders::where('customer_auto_id', '=', $cust_id)->where('_id', '=', $id)->get();
        // dd($booking);
        if ($booking->isNotEmpty()) {
            foreach ($booking as $data) {

                // $order_id = $data->id;
                $order_no = $data->order_id;
                // $customer_auto_id = $data->customer_auto_id;

                // $lists = Orders::where('order_id', $order_id)->get();
                $lists = VendorOrders::where('admin_auto_id', '=', $this->get_admin())->where('customer_auto_id', '=', $cust_id)->where('order_id', '=', $order_no)->get();
                // dd($lists);
                if ($lists->isNotEmpty()) {
                    foreach ($lists as $lts) {
                        $pname = AdminProducts::where('_id', $lts->product_auto_id)->get();

                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                            $color_name = $pn->color_name;
                            $color_image = $pn->color_image;
                        }
                        $get_lists[] = array(
                            "product_order_auto_id" => $lts->_id, "order_id" => $order_no, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                            "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                            "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->order_status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                            "product_final_price" => $lts->product_final_price, "address" => $data->address, "city" => $data->city, "state" => $data->state, "used_pincode" => $data->used_pincode, "country" => $data->country,
                            "payment_mode" => $data->payment_mode, "total_price" => $data->total_price, "promocode_value_off_on_order" => $data->promocode_value_off_on_order, "pincode_delivery_charge" => $data->pincode_delivery_charge, "total_paid_price" => $data->total_paid_price
                        );
                    }
                } else {
                    $get_lists = array();
                }



                return view('templates.frontend.cust_order_history_details')->with(['data' => $get_lists, 'contact_details' => $get_contact_details, 'main_cat_style' => $main_category_display_style, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
            }
        } else {

            return view('templates.frontend.cust_order_history_details')->with(['main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
        }
    }
    //cancel_order
    public function cancel_my_orders(Request $request)
    {
        $cust_id = Session::get('AccessTokens');
        // $cancelorder = VendorOrders::where('_id', '=', $request->get('product_order_auto_id'))->where('customer_auto_id', '=', $cust_id)->where('order_id', '=', $request->get('order_id'))->get();
        $cancelorder = Orders::where('customer_auto_id', '=', $cust_id)->where('order_id', '=', $request->get('order_id'))->get();

// dd($cancelorder);
        if ($cancelorder->isEmpty()) {


            return Redirect::back()->with('error', 'Sorry, Something went wrong.');
        } else {

            $update = DB::table('vendor_orders')->where('admin_auto_id', $this->get_admin())->where('customer_auto_id', '=', $cust_id)->where('order_id', '=', $request->get('order_id'))->update(['order_status' => 'Cancelled']);
            $update = DB::table('uorders')->where('admin_auto_id', $this->get_admin())->where('customer_auto_id', '=', $cust_id)->where('order_id', '=', $request->get('order_id'))->update(['status' => 'Cancelled',]);

            return Redirect::back()->with('success', 'Order Cancelled');
        }
    }
}
