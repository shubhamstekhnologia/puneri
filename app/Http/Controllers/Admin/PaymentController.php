<?php

namespace App\Http\Controllers\Admin;

use DB;
use DateTime;
use Redirect;
use App\Admin;
use App\Brand;
use App\Users;
use App\Orders;
use App\Pincode;
use App\Currency;
use DateTimeZone;
use App\SizeLists;
use App\Categories;
use App\CouponCode;
use App\MainOrders;
use App\PriceRange;
use App\ColorsRange;
use App\DeliveryBoy;
use App\UserRegister;
use App\VendorOrders;
use Razorpay\Api\Api;
use App\AdminProducts;
use App\CategoryStyle;
use App\DiscountRange;
use App\HomeComponent;
use App\Subcategories;
use App\ContactDetails;
use App\OfferComponent;
use App\BusinessDetails;
use App\CartUserAddress;
use App\ComponentContent;
use App\WishlistProducts;
use App\AdminProductImages;
use App\UserMedicalDetails;
use App\CountryProductPrice;
use App\ProductRatingReview;
use App\UserPersonalDetails;
use Illuminate\Http\Request;
use App\HomeProductComponent;
use App\HomeComponentTopBrands;

include(app_path() . '/razorpay/Razorpay.php');

use App\HomeComponentSubCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
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

    public function payment($main)
    {
        if (Session::has('AccessTokens')) {


            $uid = Session::get('AccessTokens');

            $profile = Users::where('_id', "=", $uid)->get();
            foreach ($profile as $prof) {
                $user_name = $prof['name'];
                $user_email = $prof['email_id'];
                $user_no = $prof['mobile_number'];
            }
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

            $uaddress = CartUserAddress::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();

            return view('templates.frontend.payment')->with([
                'contact_details' => $get_contact_details,
                'business_details' => $get_business_details, 'main_category' => $get_main_categories,
                'main_cat_style' => $main_category_display_style, 'address' => $uaddress,
                'user_name' => $user_name, 'user_no' => $user_no, 'user_email' => $user_email
            ]);
        } else {
            return redirect(session('main'));
        }
    }



    public function success(Request $request)
    {
        if (Session::has('AccessTokens') && Session::has('cart')) {
            $products = Session::get('cart');
            $subtotal = $request->subtotal;
            $total = $request->total;
            $promo = $request->promocode;
            $payment = $request->payment_method;
            $address_id = $request->select_address;
            $payment_status = $request->payment_status;

            $uid = Session::get('AccessTokens');

            $prod_qty = 0;

            foreach ($products as $id => $prod) {
                $prod_qty += $prod['quantity'];
            }
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

            $uaddress = CartUserAddress::where('_id', '=', $address_id)->get();

            // $main_order = new MainOrders();

            if (!empty($uaddress)) {
                foreach ($uaddress as $detail) {
                    $address = $detail['address_details'];
                    $city = $detail->city;
                    $area = $detail->area;
                    $country = $detail->country;
                    $mobile_no = $detail->mobile_no;
                    $state = $detail->state;
                    $pincode = $detail->pincode;
                }
            }


            // $order_count = MainOrders::count();

            // $order_no = $order_count + 1;
            // $order_id = "ORD0" . $order_no;


            // if ($payment == 'online') {
            //     $payment_success = true;
            //     $api = new Api("rzp_test_VRjuJ0lp3kC47e", "n5egcGGXzuytnRY5NU0pC2yN");

            //     try {


            //         $attributes  = array('razorpay_signature'  => $request->razorpay_signature,  'razorpay_payment_id'  => $request->razorpay_pament_id,  'razorpay_order_id' => $request->razorpay_order_id);
            //         $order  = $api->utility->verifyPaymentSignature($attributes);
            //     } catch (SignatureVerificationError $e) {
            //         $success = false;
            //         $error = 'Payment Declined : ' . $e->getMessage();

            //         die($error);
            //     }
            // }

            // $main_order->address = $address . ", " . $area;
            // $main_order->city = $city;
            // $main_order->country = $country;
            // $main_order->customer_auto_id = $uid;
            // $main_order->admin_auto_id = $this->get_admin();
            // $main_order->mobile_no = $mobile_no;
            // $main_order->order_date = date('Y-m-d');
            // $main_order->order_id = $order_id;
            // $main_order->order_month = date('F');
            // $main_order->order_time = date("H:i:s");
            // $main_order->order_year = date('Y');
            // $main_order->payment_mode = $payment;
            // $main_order->payment_status = $payment_status;
            // $main_order->pincode_delivery_charge = 0;
            // $main_order->promocode_value_off = $promo;
            // $main_order->promocode_value_off_on_order = $promo;
            // $main_order->quantity =  $prod_qty;
            // $main_order->state = $state;
            // $main_order->status = "Received";
            // $main_order->total_paid_price = $total;
            // $main_order->total_price = $subtotal;
            // $main_order->used_pincode = $pincode;
            // $main_order->address_auto_id = $address_id;

            // if ($payment == 'online') {
            //     $main_order->razorpay_order_id = $request->razorpay_order_id;
            //     $main_order->razorpay_payment_id = $request->razorpay_pament_id;
            //     $main_order->razorpay_signature = $request->razorpay_signature;
            // }

            // $main_order->save();

            // $main_order_id = $main_order->id;

            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $order_date = $date->format('Y-m-d');
            $order_time = $date->format('H:i:s');
            $order_month = $date->format('F');
            $order_year = $date->format('Y');

            $new_oid = Orders::get();
            if ($new_oid->isNotEmpty()) {
                foreach ($new_oid as $data) {
                    $oid = $data->order_id;
                }
                if ($oid != '') {
                    $str = explode("ORD", $oid, 3);
                    $second = $str[1];
                    $naid = $second + 1;
                    $len = strlen($naid);
                    if ($len > 1) {
                        $order_id = "ORD" . $naid;
                    } else {
                        $order_id = "ORD0" . $naid;
                    }
                }
            } else {
                $order_id = "ORD01";
            }

            // $order_count = Orders::count();
            // $order_no = $order_count + 1;
            // $order_id = "ORD" . $order_no;


            foreach ($products as $id => $product) {
                $pd = AdminProducts::find($id);



                $tlist = new VendorOrders();
                $tlist->admin_auto_id = $this->get_admin();
                $tlist->order_id = $order_id;
                $tlist->added_by_id =  $pd->user_auto_id;
                $tlist->added_by  = $pd->added_by;
                $tlist->product_auto_id =  $id;
                $tlist->quantity  =  $product['quantity'];
                $tlist->product_price = $product['mrp'];
                $tlist->product_offer_percentage  = $product["offer"];
                $tlist->product_final_price = $product['price'];
                $tlist->product_image  = $product['image'];
                $tlist->size  = $product['size'];
                $tlist->order_date = date('Y-m-d');
                $tlist->customer_auto_id =  $uid;
                $tlist->order_status = "Received";
                $tlist->reason = '';
                $tlist->available_stock = '';
                $tlist->deliveryboy_id = '';
                $tlist->save();

                $added_by_id[] = $pd->user_auto_id;
                $added_by[] =  $pd->added_by;
                $product_auto_id[] =  $id;
                $quantity[] = $product['quantity'];
                $product_price[] = $product['mrp'];
                $product_offer_percentage[] = $product["offer"];
                $product_final_price[] =  $product['price'];
                $product_image[] = $product['image'];
                $size[] = $product['size'];
            }


            $abi_ids = implode('|', $added_by_id);
            $ab_ids = implode('|', $added_by);
            $pai_ids = implode('|', $product_auto_id);
            $q_ids = implode('|', $quantity);
            $pp_ids = implode('|', $product_price);
            $pop_ids = implode('|', $product_offer_percentage);
            $pfp_ids = implode('|', $product_final_price);
            $pi_ids = implode('|', $product_image);
            $s_ids = implode('|', $size);

            $uorder = new Orders();
            $uorder->customer_auto_id = $uid;
            $uorder->admin_auto_id = $this->get_admin();
            $uorder->added_by_id = $abi_ids;
            $uorder->added_by = $ab_ids;
            $uorder->order_id = $order_id;
            $uorder->product_auto_id = $pai_ids;
            $uorder->quantity = $q_ids;
            $uorder->product_price = $pp_ids;
            $uorder->product_offer_percentage = $pop_ids;
            $uorder->product_final_price = $pfp_ids;
            $uorder->product_image = $pi_ids;
            $uorder->size = $s_ids;
            $uorder->payment_mode = $payment;
            if ($payment == "online") {
                $uorder->tranaction_id = $request->razorpay_pament_id;
            } else {
                $uorder->tranaction_id = "";
            }
            $uorder->payment_status = $payment_status;
            $uorder->address = $address . ", " . $area;
            $uorder->state = $state;
            $uorder->city = $city;
            $uorder->country = $country;
            $uorder->status = "Received";

            $uorder->applied_promocode = $request->get('applied_promocode') ?? '';
            $uorder->promocode_value_off = $promo;
            $uorder->promocode_type = $request->get('promocode_type') ?? '';
            $uorder->promocode_value_off_on_order = $promo;
            $uorder->pincode_delivery_charge = $request->get('pincode_delivery_charge') ?? '';

            $uorder->delivery_time = $request->get('delivery_time') ?? '';
            $uorder->delivery_slot_price = $request->get('delivery_slot_price') ?? '';
            $uorder->delivery_type = $request->get('delivery_type') ?? '';
            $uorder->start_date = $request->get('start_date')  ?? '';
            $uorder->app_type_id = $request->get('app_type_id') ?? '';
            $uorder->days_count = $request->get('days_count') ?? '';
            $uorder->product_quantity = $request->get('product_quantity') ?? '';
            $uorder->days = $request->get('days') ?? '';
            $uorder->cutbalance = $request->get('cutbalance') ?? '';

            $uorder->total_paid_price = $total;
            $uorder->total_price = $subtotal;
            $uorder->used_pincode = $pincode;
            $uorder->address_auto_id = $address_id;
            $uorder->mobile_no = $mobile_no;
            $uorder->order_date = $order_date;
            $uorder->order_time = $order_time;
            $uorder->order_month = $order_month;
            $uorder->order_year = $order_year;
            $uorder->cust_image = '';

            $uorder->save();

            $firebaseToken = Admin::where('user_type', '=', 'Admin')->where('_id', '=', $this->get_admin())->whereNotNull('token')->pluck('token')->all();
            $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';
            $message = [
                "registration_ids" => $firebaseToken,
                "data" => [
                    "type" => "Order",
                    "status" => "Received",
                ],

                "notification" => [

                    "title" => "New Order Received",
                    "body"  =>  "order no." . $order_id . " is received successfully",
                    "sound" => "default",
                    "click_action" => "com.puneri.amrutullaya",

                ]

            ];

            $dataString = json_encode($message);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];


            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);

            //  Notification send to delivery boy


            $firebaseToken = DeliveryBoy::where('admin_auto_id', $this->get_admin())->whereNotNull('token')->pluck('token')->all();

            $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';

            $message = [

                "registration_ids" => $firebaseToken,
                "notification" => [

                    "body"  =>  "order no. " . $order_id . " is Received",
                    "title" => "Delivery Boy Order",
                    "sound" => "default",
                    "click_action" => "com.puneri.amrutullaya",

                ]

            ];

            $dataString = json_encode($message);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];


            $ch = curl_init();


            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);

            // Forget multiple keys...
            Session::forget(['cart', 'total', 'subtotal', 'coupon']);


            return view('templates.frontend.success')->with(['contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'main_cat_style' => $main_category_display_style, 'addresses' => $uaddress, 'products' => $products, 'subtotal' => $subtotal, 'total' => $total, 'promo' => $promo, 'payment' => $payment, "order_id" => $order_id]);
        } else {
            return redirect(session("main"));
        }
    }
}