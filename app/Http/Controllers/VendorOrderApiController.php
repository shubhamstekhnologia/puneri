<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorMinPrice;
use App\Brand;
use App\Orders;
use App\VendorOrders;
use App\ProductRatingReview;
use App\VendorInventary;
use App\EcommRegistration;
use App\UserRegister;
use App\CountryProductPrice;
use App\AdminProducts;
use DateTimeZone;
use DateTime;
use DB;
use Razorpay\Api\Order;

class VendorOrderApiController extends Controller{

    public function get_Vendor_NewOrders(Request $request){

        // $lists = Orders::ORDERBY('_id', 'DESC')->where('added_by_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('status', '=', 'Received')->whereNull('deleted_at')->get();
        // $lists = Orders::orderBy('_id', 'DESC')
        // ->whereIn('added_by_id', explode('|', $request->get('user_auto_id')))
        // ->where('admin_auto_id', $request->admin_auto_id)
        // ->where('status', 'Received')
        // ->whereNull('deleted_at')
        // ->get();
        $lists = Orders::orderBy('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('admin_auto_id', $request->admin_auto_id)
            ->where('status', 'Received')
            ->whereNull('deleted_at')
            ->get();



        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }

                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();

                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }
    //preparing orders
    public function get_Vendor_PreparingOrders(Request $request)
    {

        $lists = Orders::ORDERBY('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('status', '=', 'Prepared')
            ->where('admin_auto_id', $request->admin_auto_id)
            ->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }

                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty')
            ]);
        }
    }
    //Returned orders
    public function get_Vendor_Return_Orders(Request $request){

        $lists = Orders::ORDERBY('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('status', '=', 'Returned')
            ->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }
                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "reason" => $lts->reason, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }
    //Cancelled orders
    public function get_Vendor_Cancel_Orders(Request $request){

        $clists = Orders::ORDERBY('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('status', '=', 'Cancelled')
            ->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($clists->isNotEmpty()) {
            foreach ($clists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }
                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "reason" => $lts->reason, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty')
            ]);
        }
    }
    //Diapatched orders
    public function get_Vender_DiapatchedOrders(Request $request){

        $lists = Orders::ORDERBY('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('status', '=', 'Dispatched')
            ->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }

                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty')
            ]);
        }
    }

    public function get_Vender_AcceptOrder(Request $request){

        $lists = Orders::ORDERBY('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('status', '=', 'Accept')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }

                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty')
            ]);
        }
    }

    //Completed orders
    public function get_Vendor_Completed_Orders(Request $request){

        $lists = Orders::ORDERBY('_id', 'DESC')
            ->where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('status', '=', 'Completed')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }
                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty')
            ]);
        }
    }

    public function ChangeAllOrderStatus(Request $request){
        try {
            // Fetch the vendor order
           $vendorOrder = Orders::where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
                ->where('order_id', $request->get('order_id'))
                ->where('admin_auto_id', $request->admin_auto_id)
                ->whereNull('deleted_at')
                ->first();

            if (!$vendorOrder) {
                return response()->json(['status' => 2, "msg" => "Sorry, data not found"]);
            } else {
                $filename = '';
                if ($request->hasFile('invoice')) {
                    $file = $request->file('invoice');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/invoice');
                    $file->move($path, $filename);
                }
                Orders::where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
                    ->where('admin_auto_id', $request->admin_auto_id)
                    ->where('order_id', $request->get('order_id'))
                    ->update([
                        'status' => $request->get('status'),
                        'payment_mode' => $request->get('payment_mode', ''),
                        'transaction_id' => $request->get('transaction_id', ''),
                        'invoice' => $filename,
                    ]);
                VendorOrders::where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
                    ->where('order_id', $request->get('order_id'))
                    ->where('admin_auto_id', $request->admin_auto_id)->update([
                        'order_status' => $request->get('status'),
                        'payment_mode' => $request->get('payment_mode', ''),
                        'transaction_id' => $request->get('transaction_id', ''),
                        'invoice' => $filename,
                    ]);

                return response()->json(['status' => 1, 'msg' => 'Status Updated Success']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'msg' => 'Failed to update status', 'error' => $e->getMessage()]);
        }
    }


    //update order status
    public function Change_Vendor_Order_Status(Request $request){

        $tasks = VendorOrders::where('added_by_id', 'LIKE', '%' . $request->get('user_auto_id') . '%')
            ->where('_id', '=', $request->get('order_auto_id'))
            ->where('admin_auto_id', $request->admin_auto_id)
            ->whereNull('deleted_at')
            ->get();
        if (!empty($request->file('invoice'))) {
            $file = $request->file('invoice');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/invoice');
            $file->move($path, $filename);
            $invoice_file = $filename;
        } else {
            $invoice_file = '';
        }
        if ($tasks->isEmpty()) {
            return response()->json(['status' => 2, "msg" => "Sorry, data not found"]);
        } else {
            $update = DB::table('vendor_orders')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $request->get('order_auto_id'))->update(['order_status' => $request->get('status'), 'payment_mode' => $request->get('payment_mode') ?? '', 'transaction_id' => $request->get('transaction_id') ?? '', 'invoice' => $invoice_file]);
            foreach ($tasks as $co) {
                $customer_auto_id = $co->customer_auto_id;
                $admin_auto_id = $co->admin_auto_id;
                $order_status = $co->status;
            }

            $admin_shiprocket_details = EcommRegistration::where('_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($admin_shiprocket_details->isNotEmpty()) {
                foreach ($admin_shiprocket_details as $asd) {
                    $shiprocket_auth_email = $asd->shiprocket_auth_email;
                    $shiprocket_auth_password = $asd->shiprocket_auth_password;
                }
            } else {
                $shiprocket_auth_email = "";
                $shiprocket_auth_password = "";
            }
            if ($order_status == "Prepared" && $shiprocket_auth_email != "" && $shiprocket_auth_password != "") {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
    		    "email": $shiprocket_auth_email,
    		    "password": $shiprocket_auth_password
		}',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                //send order to shiprocket

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
  "order_id": "224-447",
  "order_date": "2019-07-24 11:11",
  "pickup_location": "Jammu",
  "channel_id": "",
  "comment": "Reseller: M/s Goku",
  "billing_customer_name": "Naruto",
  "billing_last_name": "Uzumaki",
  "billing_address": "House 221B, Leaf Village",
  "billing_address_2": "Near Hokage House",
  "billing_city": "New Delhi",
  "billing_pincode": "110002",
  "billing_state": "Delhi",
  "billing_country": "India",
  "billing_email": "naruto@uzumaki.com",
  "billing_phone": "9876543210",
  "shipping_is_billing": true,
  "shipping_customer_name": "",
  "shipping_last_name": "",
  "shipping_address": "",
  "shipping_address_2": "",
  "shipping_city": "",
  "shipping_pincode": "",
  "shipping_country": "",
  "shipping_state": "",
  "shipping_email": "",
  "shipping_phone": "",
  "order_items": [
    {
      "name": "Kunai",
      "sku": "chakra123",
      "units": 10,
      "selling_price": "900",
      "discount": "",
      "tax": "",
      "hsn": 441122
    }
  ],
  "payment_method": "Prepaid",
  "shipping_charges": 0,
  "giftwrap_charges": 0,
  "transaction_charges": 0,
  "total_discount": 0,
  "sub_total": 9000,
  "length": 10,
  "breadth": 15,
  "height": 20,
  "weight": 2.5
}',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer {{$response->token}}'
                    ),
                ));

                $responses = curl_exec($curl);
                curl_close($curl);

                $update_shiprocket_details = DB::table('uorders')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $request->get('order_auto_id'))->update(['ship_rocket_order_id' => strval($responses->order_id), 'ship_rocket_shipment_id' => strval($responses->shipment_id)]);
            }
            //send notification to customer
            if ($request->get('status') == "Dispatched") {
                $firebaseToken = UserRegister::where('_id', '=', $customer_auto_id)->whereNotNull('token')->pluck('token')->all();

                $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';


                $message = [

                    "registration_ids" => $firebaseToken,
                    "data" => [
                        "type" => "Order",
                        "status" => $request->get('status'),
                    ],
                    "notification" => [
                        "title" => "Your Order Status",
                        "body"  =>  "Your order status is:" . $request->get('status') . "",
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
            }

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    //order details
    public function get_Vendor_Order_Details(Request $request){

        $lists = VendorOrders::where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('order_id', '=', $request->get('order_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }

                $admin_shiprocket_details = EcommRegistration::where('_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($admin_shiprocket_details->isNotEmpty()) {
                    foreach ($admin_shiprocket_details as $asd) {
                        $shiprocket_auth_email = $asd->shiprocket_auth_email;
                        $shiprocket_auth_password = $asd->shiprocket_auth_password;
                    }
                } else {
                    $shiprocket_auth_email = "";
                    $shiprocket_auth_password = "";
                }
                if ($shiprocket_auth_email != "" && $shiprocket_auth_password != "") {

                    if ($lts->ship_rocket_shipment_id != "") {
                        $ship_rocket_shipment_id = $lts->ship_rocket_shipment_id;
                        //generate new token
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
                            "email": $shiprocket_auth_email,
                            "password": $shiprocket_auth_password
                     }',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json'
                            ),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                        //shipemnt status
                        $curl = curl_init();
                        $response1 = '';
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$ship_rocket_shipment_id',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Authorization: Bearer {{$response->token}}'
                            ),
                        ));

                        $response1 = curl_exec($curl);
                        curl_close($curl);

                        $order_status = $response1->current_status;
                    } else {
                        $order_status = $lts->order_status;
                    }
                } else {
                    $order_status = $lts->order_status;
                }

                $offer_price = ($lts->product_price * $lts->product_offer_percentage) / 100;
                $final_price = $lts->product_price - $offer_price;
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $order_status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage, "product_offer_price" => strval(round($offer_price)),
                    "product_final_price" => strval(round($final_price))
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }
    //order details
    public function get_Vendor_Order_Reports(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->whereBetween('order_date', [$startDate, $endDate])->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        $tcount = Orders::where('status', '!=', 'Cancelled')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->whereBetween('order_date', [$startDate, $endDate])->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

        if ($lists->isNotEmpty()) {
            foreach ($lists->unique('order_date') as $lts) {
                $docount = Orders::where('status', '!=', 'Cancelled')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $qcount = Orders::where('quantity', '=', $lts->quantity)->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $reccount = Orders::where('status', '=', 'Received')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $rcount = Orders::where('status', '=', 'Cancelled')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $fcount = Orders::where('status', '=', 'Dispatched')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $scount = Orders::where('status', '=', 'Prepared')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $dcount = Orders::where('status', '=', 'Completed')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

                $get_lists[] = array(
                    "order_date" => $lts->order_date, "orders" => $docount, "avg_unit_ordered" => $qcount, "avg_order_value" => $qcount, "received_orders" => $reccount,
                    "cancelled_quantity" => $rcount, "fullfilled_order" => $fcount, "shipped_order" => $scount, "delivered_order" => $dcount
                );
            }
        } else {
            $get_lists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "Order_Count" => $tcount,
            "data" => $get_lists
        ]);
    }
    //add invntary data
    public function add_Vendor_Inventory(Request $request){
        $tasks = VendorInventary::where('product_auto_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($tasks->isNotEmpty()) {
            if ($request->available_product_stock == '0') {
                $status = "OutofStock";
            } else {
                $status = "InStock";
            }
            $rdate = date('Y-m-d');
            $update = DB::table('vendor_inventary')->where('user_auto_id', '=', $request->get('user_auto_id'))->where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->update(['product_name' => $request->get('product_name'), 'product_unit' => $request->get('product_unit'), 'total_product_stock' => $request->get('total_product_stock'), 'available_product_stock' => $request->get('available_product_stock'), 'product_stock_alert_limit' => $request->get('product_stock_alert_limit'), 'status' => $status, 'rdate' => $rdate]);


            return response()->json([
                'status' => 1,
                'msg' => "Updated Successfully",
            ]);
        } else {
            $vendorinventary = new VendorInventary();

            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            $vendorinventary->user_auto_id = $request->get('user_auto_id');
            if ($request->get('admin_auto_id') != '') {
                $vendorinventary->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $vendorinventary->admin_auto_id = "";
            }
            $vendorinventary->product_auto_id = $request->get('product_auto_id') ?? '';
            $vendorinventary->product_name = $request->get('product_name') ?? '';
            $vendorinventary->product_unit = $request->get('product_unit') ?? '';
            $vendorinventary->total_product_stock = $request->get('total_product_stock') ?? '';
            $vendorinventary->available_product_stock = $request->get('available_product_stock') ?? '';
            $vendorinventary->product_stock_alert_limit = $request->get('product_stock_alert_limit') ?? '';
            $vendorinventary->status = 'InStock';
            $vendorinventary->rdate = date('Y-m-d');
            $vendorinventary->save();


            return response()->json([
                'status' => 1,
                'msg' => "Added Successfully",
            ]);
        }
    }
    //get inventary data
    public function getVendor_Inventory_List(Request $request){
        $vilists = AdminProducts::ORDERBY('_id', 'DESC')->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($vilists->isNotEmpty()) {
            foreach ($vilists as $lts) {
                $product_auto_id = $lts->_id;
                $deduct23 = 0;
                $vorderlists = VendorOrders::where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                if ($vorderlists->isNotEmpty()) {
                    foreach ($vorderlists as $volts) {
                        $deduct23 += intval($volts->quantity);
                    }
                } else {
                    $deduct23 = 0;
                }
                $pstocks = AdminProducts::where('_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                if ($pstocks->isNotEmpty()) {
                    foreach ($pstocks as $lts) {
                        $available_stocks = intval($lts->available_stock);
                        $totalstock = intval($lts->stock);
                    }
                } else {
                    $available_stocks = 0;
                }
                if ($available_stocks <= 0 && $deduct23 >= 0) {
                    $required_stock = $deduct23 - $totalstock;
                    $new_available_stock = 0;
                } else if ($available_stocks <= 0) {
                    $required_stock =  $available_stocks - $deduct23;

                    $new_available_stock = 0;
                } else if ($available_stocks >= 0) {

                    $required_stock = 0;

                    $new_available_stock =  $available_stocks;
                }
                if ($available_stocks <= 0) {
                    $istatus = "Out Of Stock";
                } else {
                    $istatus = "In Stock";
                }

                $get_vilists[] = array(
                    "user_auto_id" => $lts->user_auto_id, "product_auto_id" => $lts->_id, "product_name" => $lts->product_name, "product_unit" => $lts->unit,
                    "total_product_stock" => strval($lts->stock), "available_product_stock" => strval($new_available_stock), "product_stock_alert_limit" => $lts->Stock_alert_limit, "status" => $istatus, "required_stock" => strval($required_stock)
                );
            }
        } else {
            $get_vilists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "data" => $get_vilists
        ]);
    }
    //get trainding products data
    public function get_Vendor_Trending_products(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $vtplists = AdminProducts::ORDERBY('_id', 'DESC')->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('available_stock', '<=', $request->get('product_stock_alert_limit'))->whereNull('deleted_at')->get();

        if ($vtplists->isNotEmpty()) {
            foreach ($vtplists as $lts) {
                $available_stocks = $lts->available_stock;

                if ($available_stocks <= $lts->Stock_alert_limit) {
                    $istatus = "Out Of Stock";
                } else {
                    $istatus = "In Stock";
                }


                $get_vtplists[] = array(
                    "user_auto_id" => $lts->user_auto_id, "product_auto_id" => $lts->_id, "product_name" => $lts->product_name, "product_unit" => $lts->unit,
                    "total_product_stock" => $lts->stock, "available_product_stock" => $lts->available_stock, "product_stock_alert_limit" => $lts->Stock_alert_limit, "status" => $istatus
                );
            }
        } else {
            $get_vtplists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "data" => $get_vtplists
        ]);
    }
    //market list
    public function get_Vender_Market_List(Request $request){

        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
            $deduct23 = 0;
            foreach ($lists as $lts) {
                $avail =  VendorInventary::where('product_auto_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                if ($avail->isEmpty()) {
                    $available_stock = '0';
                } else {
                    foreach ($avail as $avl) {
                        $available_stock = $avl->available_product_stock;
                    }
                }
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->orwhere('product_auto_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                foreach ($pname->unique('product_name') as $pn) {
                    $product_name = $pn->product_name;
                }
                $deduct23 += $lts->quantity;
                $get_lists[] = array("product_auto_id" => $lts->product_auto_id, "product_name" => $product_name, "available_stock" => $available_stock, "required_stock" => "$deduct23", "unit" => $lts->size);
            }
        } else {
            $get_lists = array();
        }

        return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
    }
    //sales report
    public function get_Vendor_Sale_Reports(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('order_status', '=', 'Completed')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        $tcount = Orders::where('status', '=', 'Completed')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->count();

        $totalSales = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', $request->user_auto_id)->get();
        if ($totalSales->isNotEmpty()) {
            foreach ($totalSales as $sales) {
                $cost_price = $sales->cost_price;
                $misc_expenditure = $sales->misc_expenditure;
            }
        } else {
            $cost_price = 0;
            $misc_expenditure = 0;
        }


        if ($lists->isNotEmpty()) {
            $product_price = 0;
            $offer_per = 0;
            $final_product_price = 0;
            foreach ($lists as $lts) {
                $product_price +=  intval($lts->product_price);
                $offer_per +=  intval($lts->product_offer_percentage);
                $final_product_price +=  intval($lts->product_final_price);
                $order_id =  $lts->order_id;
            }
            foreach ($lists->unique('order_date') as $lts) {
                $docount = Orders::where('status', '=', 'Completed')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $rcount = Orders::where('status', '=', 'Returned')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $completeorder = VendorOrders::where('order_status', '=', 'Completed')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($completeorder->isNotEmpty()) {
                    foreach ($completeorder as $rors) {
                        $return_product_final_price =  0;
                    }
                } else {
                    $return_product_final_price = 0;
                }

                $total_delivery_charge = Orders::where('status', '=', 'Completed')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('order_date', '=', $lts->order_date)->select('delivery_slot_price')->whereNull('deleted_at')->get();
                $total_delivery = 0;
                foreach ($total_delivery_charge as $key) {
                    $total_delivery += intval($key->delivery_slot_price);
                }

                $total_paid_price = Orders::where('status', '=', 'Completed')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('order_date', '=', $lts->order_date)->whereNull('deleted_at')->get();
                $total_paid_prices = 0;
                foreach ($total_paid_price as $pricep) {
                    $total_paid_prices += intval($pricep->total_paid_price);
                }

                $tpcount = VendorOrders::where('order_status', '=', 'Completed')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('order_date', '=', $lts->order_date)->whereNull('deleted_at')->select('product_price')->get();
                $totalProductPrice = 0;
                foreach ($tpcount as $count) {
                    $totalProductPrice += intval($count->product_price);
                }

                $productPercentage = VendorOrders::where('order_status', '=', 'Completed')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('order_date', '=', $lts->order_date)->whereNull('deleted_at')->select('product_offer_percentage')->get();
                $totalProductPercent = 0;
                foreach ($productPercentage as $percent) {
                    $totalProductPercent += intval($percent->product_offer_percentage);
                }

                $shipping  = 0;
                $ordss = Orders::where('status', '=', 'Completed')->where('order_id', '=', $order_id)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                foreach ($ordss as $ors) {
                    $shipping +=  $ors->pincode_delivery_charge;
                    $discount = intval($ors->promocode_value_off_on_order);
                }
                $gross_sale = intval($total_paid_prices);

                $net_sale = intval($gross_sale) - intval($discount) - (intval($return_product_final_price) * intval($rcount));

                $tax = 0;
                $shipping = intval($shipping);
                $totalProfit = intval($gross_sale) - intval($return_product_final_price) - $shipping - $tax;
                $Total_sale = $gross_sale + intval($tax) + $shipping;
                $offerAvailable = $lts->product_offer_percentage > 0;

                if (!$offerAvailable) {

                    $profit = intval($final_product_price) - intval($cost_price) - intval($tax) -intval( $misc_expenditure);
                } else {

                    $profit = intval($final_product_price) - intval($cost_price) - intval($tax) - intval($misc_expenditure);
                }
                $get_lists[] = array("date" => $lts->order_date, "orders_count" => $docount, "gross_sales" => $gross_sale, "promo_code_discounts" => intval($discount), "returns" => $rcount, "net_sale" => intval($net_sale), "shipping" => strval($shipping), "tax" => $tax, "total_sales" => ($Total_sale), "total_delivery_charges" => $total_delivery,"Total_profit" => $totalProfit);
            }
        } else {
            $get_lists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "total_order_count" => $tcount,
            "data" => $get_lists
        ]);
    }


    //one day order report
    // public function get_Vendor_todays_reports(Request $request)
    // {
    //     $startDate = $request->get('start_date');

    //     $lists = VendorOrders::where('added_by_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('order_date', $startDate)->whereNull('deleted_at')->get();
    //     $tcount = VendorOrders::where('added_by_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('order_date', $startDate)->whereNull('deleted_at')->count();
    //     if ($lists->isNotEmpty()) {
    //         $gross_sale = '0';
    //         $discounts = "0";
    //         $net_sale = "0";
    //         foreach ($lists as $lts) {
    //             $gross_sale +=  $lts->product_price;
    //             $discounts +=  $lts->product_offer_percentage;
    //             $net_sale +=  $lts->product_final_price;
    //             $order_id =  $lts->order_id;
    //             $product_auto_id = $lts->product_auto_id;
    //         }
    //         foreach ($lists->unique('order_date') as $lts) {
    //             $docount = VendorOrders::where('order_date', '=', $lts->order_date)->where('added_by_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
    //             $rcount = VendorOrders::where('order_status', '=', 'Returned')->where('order_date', '=', $lts->order_date)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

    //             $ordss = Orders::where('order_id', '=', $order_id)->whereNull('deleted_at')->get();
    //             foreach ($ordss as $ors) {
    //                 $shipping =  $ors->pincode_delivery_charge;
    //             }
    //             $ordss = Orders::where('order_date', '=', $lts->order_date)->where('added_by_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    //             if ($ordss->isNotEmpty()) {
    //                 $total_delivery_charge = 0;
    //                 foreach ($ordss as $ors) {
    //                     $total_delivery_charge  +=  $ors->pincode_delivery_charge;
    //                 }
    //             } else {
    //                 $total_delivery_charge = "0";
    //             }
    //             $ordss = Orders::where('order_date', '=', $lts->order_date)->where('added_by_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    //             if ($ordss->isNotEmpty()) {
    //                 $total_per_day_sale = 0;
    //                 foreach ($ordss as $ors) {
    //                     $total_per_day_sale +=  $ors->total_paid_price;
    //                 }
    //             } else {
    //                 $total_per_day_sale = "0";
    //             }
    //             $tax = "0";
    //             $total_sales = intval($gross_sale) + intval($shipping);
    //             $get_lists[] = array("date" => $lts->order_date, "sales_per_day_count" => $docount, "total_sales_per_day" => $total_per_day_sale, "total_delivery_charge" => $total_delivery_charge, "returns_orders_per_day" => $rcount, "tax" => $tax, "total_sales" => $total_sales);
    //         }
    //     } else {
    //         $get_lists = array();
    //     }

    //     return response()->json([
    //         'status' => 1,
    //         "msg" => config('messages.success'),
    //         "total_order_count" => $tcount,
    //         "data" => $get_lists
    //     ]);
    // }

    public function get_Vendor_todays_reports(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('order_status', '!=', 'Cancelled')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        $tcount = Orders::where('status', '!=', 'Cancelled')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->count();
        $total_saless_amount = Orders::where('status', '!=', 'Cancelled')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        if ($total_saless_amount->isNotEmpty()) {
           $to_sale = 0;
            foreach ($total_saless_amount as $amount) {
                $to_sale +=  $amount->total_paid_price;
            }
    	}else{
    		$to_sale = 0;
    	}

        if ($lists->isNotEmpty()) {
            $gross_sale = 0;
            $discounts = 0;
            $net_sale = 0;
            foreach ($lists as $lts) {
                $gross_sale +=  intval($lts->product_price);
                $discounts +=  intval($lts->product_offer_percentage);
                $net_sale +=  intval($lts->product_final_price);
                $order_id =  $lts->order_id;
                $product_auto_id = $lts->product_auto_id;
            }
            foreach ($lists->unique('order_date') as $lts) {
                $docount = VendorOrders::where('order_status', '!=', 'Cancelled')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $rcount = VendorOrders::where('order_status', '=', 'Returned')->where('order_status', '!=', 'Cancelled')->where('order_date', '=', $lts->order_date)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

                $ordss = Orders::where('status', '!=', 'Cancelled')->where('order_id', '=', $order_id)->whereNull('deleted_at')->get();
                foreach ($ordss as $ors) {
                    $shipping =  intval($ors->pincode_delivery_charge);
                }
                $ordss = Orders::where('status', '!=', 'Cancelled')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($ordss->isNotEmpty()) {
                    $total_delivery_charge = 0;
                    foreach ($ordss as $ors) {
                        $total_delivery_charge  +=  intval($ors->pincode_delivery_charge);
                    }
                } else {
                    $total_delivery_charge = 0;
                }

                $ordss = Orders::where('status', '!=', 'Cancelled')->where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($ordss->isNotEmpty()) {
                    $total_per_day_sale = 0;
                    foreach ($ordss as $ors) {
                        $total_per_day_sale +=  intval($ors->total_paid_price);
                    }
                } else {
                    $total_per_day_sale = 0;
                }
                $tax = "0";
                $total_sales = $gross_sale + $shipping;
                $get_lists[] = array("date" => $lts->order_date, "sales_per_day_count" => $docount, "total_sales_per_day" => $total_per_day_sale, "total_delivery_charge" => $total_delivery_charge, "returns_orders_per_day" => $rcount);
            }
        } else {
            $get_lists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "total_order_count" => $tcount,
            "total_sale_amount" => $to_sale,
            "data" => $get_lists
        ]);
    }

    //sales report
    public function get_Vendor_finance_Reports(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        $tcount = VendorOrders::where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->count();
        if ($lists->isNotEmpty()) {
            $gross_sale = 0;
            $discounts = 0;
            $net_sale = 0;
            foreach ($lists as $lts) {
                $gross_sale +=  $lts->product_price;
                $discounts +=  $lts->product_offer_percentage;
                $net_sale +=  $lts->product_final_price;
                $order_id =  $lts->order_id;
                $product_auto_id = $lts->product_auto_id;
            }
            foreach ($lists->unique('order_date') as $lts) {
                $docount = VendorOrders::where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $rcount = VendorOrders::where('order_status', '=', 'Returned')->where('order_date', '=', $lts->order_date)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

                $ordss = Orders::where('order_id', '=', $order_id)->whereNull('deleted_at')->get();
                foreach ($ordss as $ors) {
                    $shipping =  $ors->pincode_delivery_charge;
                }
                $ordss = Orders::where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($ordss->isNotEmpty()) {
                    $total_delivery_charge = 0;
                    foreach ($ordss as $ors) {
                        $total_delivery_charge  +=  $ors->pincode_delivery_charge;
                    }
                } else {
                    $total_delivery_charge = "0";
                }
                $ordss = Orders::where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($ordss->isNotEmpty()) {
                    $total_per_day_sale = 0;
                    foreach ($ordss as $ors) {
                        $total_per_day_sale +=  $ors->total_paid_price;
                    }
                } else {
                    $total_per_day_sale = "0";
                }
                $tax = "0";
                $total_sales = $gross_sale + $shipping;
                $get_lists[] = array("date" => $lts->order_date, "sales_per_day_count" => $docount, "total_sales_per_day" => $total_per_day_sale, "total_delivery_charge" => $total_delivery_charge, "returns_orders_per_day" => $rcount, "tax" => $tax, "total_sales" => $total_sales);
            }
        } else {
            $get_lists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "total_order_count" => $tcount,
            "data" => $get_lists
        ]);
    }
    //admin vendor order details
    public function get_vendor_admin_order_details(Request $request){

        unset($atldatewisedetails);

        $booking = Orders::where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('order_id', '=', $request->get('order_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

        if ($booking->isNotEmpty()) {
            foreach ($booking as $data) {

                $order_id = $data->order_id;
                $customer_auto_id = $data->customer_auto_id;

                $rlists = ProductRatingReview::where('customer_auto_id', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($rlists->isNotEmpty()) {
                    foreach ($rlists as $rlts) {

                        $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                        }
                        $get_rating_lists[] = array(
                            "rating_auto_id" => $rlts->_id, "product_auto_id" => $rlts->product_auto_id, "product_name" => $product_name, "customer_auto_id" => $rlts->customer_auto_id,
                            "customer_name" => $rlts->name, "email_id" => $rlts->email_id, "mobile_number" => $rlts->mobile_number, "rating" => $rlts->rating, "review" => $rlts->review, "review_image" => $rlts->review_image, "date" => $rlts->rdate
                        );
                    }
                } else {
                    $get_rating_lists = array();
                }


                $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                if ($lists->isNotEmpty()) {
                    foreach ($lists as $lts) {

                        $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                            $color_name = $pn->color_name;
                            $color_image = $pn->color_image;
                        }
                        $get_lists[] = array(
                            "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                            "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                            "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->order_status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                            "product_final_price" => $lts->product_final_price
                        );
                    }
                } else {
                    $get_lists = array();
                }



                $atldatewisedetails[] = array(
                    "order_auto_id" => $data->_id, "customer_auto_id" => $data->customer_auto_id, "order_id" => $data->order_id, "address" => $data->address, "country" => $data->country, "state" => $data->state,
                    "city" => $data->city, "mobile_no" => $data->mobile_no, "payment_mode" => $data->payment_mode, "transaction_id" => $data->transaction_id, "payment_status" => $data->payment_status, "applied_promocode" => $data->applied_promocode, "promocode_value_off" => $data->promocode_value_off,
                    "promocode_type" => $data->promocode_type, "promocode_value_off_on_order" => $data->promocode_value_off_on_order, "used_pincode" => $data->used_pincode, "pincode_delivery_charge" => $data->pincode_delivery_charge, "total_price" => $data->total_price, "total_paid_price" => $data->total_paid_price,
                    "status" => $data->status, "order_date" => $data->order_date, "order_time" => $data->order_time, "product_details" => $get_lists, "get_rating_lists" => $get_rating_lists
                );



                return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $atldatewisedetails]);
            }
        } else {

            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }

   public function get_Customer_Sale_Reports(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        $tcount = VendorOrders::where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->count();
        $total_saless_amount = VendorOrders::where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        if ($total_saless_amount->isNotEmpty()) {
           $to_sale = 0;
            foreach ($total_saless_amount as $amount) {
                $to_sale +=  $amount->product_final_price;
            }
    	}else{
    		$to_sale = 0;
    	}

        if ($lists->isNotEmpty()) {
            $gross_sale = 0;
            $discounts = 0;
            $net_sale = 0;
            foreach ($lists as $lts) {
                $gross_sale +=  $lts->product_price;
                $discounts +=  $lts->product_offer_percentage;
                $net_sale +=  $lts->product_final_price;
                $order_id =  $lts->order_id;
                $product_auto_id = $lts->product_auto_id;
            }
            foreach ($lists->unique('order_date') as $lts) {
                $docount = VendorOrders::where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                $rcount = VendorOrders::where('order_status', '=', 'Returned')->where('order_date', '=', $lts->order_date)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

                $ordss = Orders::where('order_id', '=', $order_id)->whereNull('deleted_at')->get();
                foreach ($ordss as $ors) {
                    $shipping =  $ors->pincode_delivery_charge;
                }
                $ordss = Orders::where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($ordss->isNotEmpty()) {
                    $total_delivery_charge = 0;
                    foreach ($ordss as $ors) {
                        $total_delivery_charge  +=  $ors->pincode_delivery_charge;
                    }
                } else {
                    $total_delivery_charge = "0";
                }
                $ordss = Orders::where('order_date', '=', $lts->order_date)->where('added_by_id', 'LIKE', '%'.$request->user_auto_id.'%')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($ordss->isNotEmpty()) {
                    $total_per_day_sale = 0;
                    foreach ($ordss as $ors) {
                        $total_per_day_sale +=  $ors->total_paid_price;
                    }
                } else {
                    $total_per_day_sale = "0";
                }
                $tax = "0";
                $total_sales = $gross_sale + $shipping;
                $get_lists[] = array("date" => $lts->order_date, "sales_per_day_count" => $docount, "total_sales_per_day" => $total_per_day_sale, "total_delivery_charge" => $total_delivery_charge, "returns_orders_per_day" => $rcount);
            }
        } else {
            $get_lists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "total_order_count" => $tcount,
        "total_sale_amount" => $to_sale,
            "data" => $get_lists
        ]);
    }
 //sales report
    public function get_Customers_Sales_Reports(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $lists = VendorOrders::ORDERBY('_id', 'DESC')->where('order_status', '=', 'Completed')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereBetween('order_date', [$startDate, $endDate])->whereNull('deleted_at')->get();
        if ($lists->isNotEmpty()) {
           foreach ($lists->unique('product_auto_id') as $lts) {
                unset($get_clists);
                $corders = VendorOrders::where('order_status', '=', 'Completed')->where('product_auto_id', '=', $lts->product_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($corders->isNotEmpty()) {
                               $final_product_pricess = 0;
                                $quanties = 0;
            foreach ($corders as $Clts) {
               $quanties += intval($Clts->quantity);
                $final_product_pricess =  intval($Clts->product_final_price);
             
                $pname = AdminProducts::where('_id', $Clts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                  
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                        
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                   
                }

                $username = UserRegister::where('_id', $Clts->customer_auto_id)->get();
                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_clists[] = array(
                    "product_order_auto_id" => $Clts->_id, "admin_auto_id" => $Clts->admin_auto_id,"order_id" => $Clts->order_id, "added_by_id" => $Clts->added_by_id, 
                    "added_by" => $Clts->added_by,"product_auto_id" => $Clts->product_auto_id,"product_image" => $Clts->product_image, "size" => $Clts->size,
                     "quantity" => $Clts->quantity,"order_date" => $Clts->order_date, "order_status" => $Clts->order_status, "product_price" => $Clts->product_price, 
                    "product_offer_percentage" => $Clts->product_offer_percentage,"product_final_price" => $Clts->product_final_price,"reason" => $Clts->reason,
                    "available_stock" => $Clts->available_stock,"customer_auto_id" => $Clts->customer_auto_id,"product_name" => $product_name,"color_name" => $color_name,
                    "color_image" => $color_image, "user_name" => $customerName
                );
            }

               $total_product_sales = $final_product_pricess * $quanties;
        } else {
            $get_clists[] = array();
        }
               
                
           
                $get_lists[] = array("product_name" => $product_name, "orders_count" => $quanties,  "total_product_sales" => $total_product_sales, "cust_orders" => $get_clists);
            }
        } else {
            $get_lists = array();
        }

        return response()->json([
            'status' => 1,
            "msg" => config('messages.success'),
            "data" => $get_lists
        ]);
    }


}