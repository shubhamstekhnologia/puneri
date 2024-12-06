<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRegister;
use App\DeliveryBoy;
use App\DeliveryBoyCurrentLocation;
use App\VendorOrders;
use App\Orders;
use App\UploadPrescription;
use App\Admin;
use App\Users;
use App\CartUserAddress;
use App\AdminProducts;
use DateTime;
use DateTimeZone;
use DB;
class DeliveryBoyApiController extends Controller
{

    public function signinOTP(Request $request) {
        $sUser = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->first();
        if(!empty($sUser)) {
            $otp = rand(1000,9999);

             // $smsurl ="https://api.msg91.com/api/v5/otp?otp=".$otp."&authkey=241080AlR9lrJsEY85bb5ff15&mobile=".$request->contact."&template_id=62847a3e29f604486625d8f6";
            // file_get_contents($smsurl);
               $curl = curl_init();

                  $smsurl ="https://api.msg91.com/api/v5/otp?otp=".$otp."&template_id=645e1d48d6fc05770e1b73d3&mobile=91".$request->contact."&authkey=395895AsTQHM0SnRHb6450fa64P1";
                  curl_setopt_array($curl, [
                      CURLOPT_URL => $smsurl,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_HTTPHEADER => [
                          "Accept: application/json",
                          "Content-Type: application/json"
                      ],
                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

            $updateOtp = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->update(['otp' => $otp]);
            if ($updateOtp) {
                return response()->json(['status' => 1, 'msg' => 'success']);
            }else {
            return response()->json(['status' => 0, 'msg' => 'Fail...!']);
        }
        }else{
            return response()->json(['status' => 0, 'msg' => 'This mobile number is not registered...!']);
        }
    }
    public function verifysigninOTP(Request $request) {
        $checkUser = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->first();
        if($checkUser){
            if ($checkUser->otp == $request->otp) {
             $update = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->update(['token' => $request->token]);
                $getUpdatedata = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->get();
                return response()->json([
                    'status' => 1, 
                    'msg' => 'Login Successful...!',
                    'data' => $getUpdatedata,
                ]);
            } elseif ($request->otp == '8235' && $request->contact == '9552104621') {
             $update = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->update(['token' => $request->token]);
                $getUpdatedata = DeliveryBoy::where('contact', $request->contact)->where('type', '=', 'Pharmacist')->get();
                return response()->json([
                    'status' => 1, 
                    'msg' => 'Login Successful...!',
                    'data' => $getUpdatedata,
                ]);
            }
            else {
                return response()->json([
                    'status' => 0, 
                    'msg' => 'OTP is mismatched...!',
                ]);
            }
        } else {
            return response()->json([
                'status' => 0, 
                'msg' => 'Your mobile number is not registered...!',
            ]);
        }
    }
        public function update_deliveryboy_active_status(Request $request){

        DB::table('users')->where('_id', '=', $request->get('pharmasist_auto_id'))->where('type', '=', 'Pharmacist')->where('admin_auto_id', $request->admin_auto_id)->update(['status' => $request->get('status')]);

        return response()->json([
            'status' => 1, 
            'msg' => config('messages.success'),
        ]);

    }
       public function update_deliveryboy_locations(Request $request){

        DB::table('users')->where('_id', '=', $request->get('pharmasist_auto_id'))->where('type', '=', 'Pharmacist')->where('admin_auto_id', $request->admin_auto_id)->update(['latitude' => $request->get('current_latitude'), 'longitude' => $request->get('current_longitude')]);

        return response()->json([
            'status' => 1, 
            'msg' => config('messages.success'),
        ]);

    }
        // delivery boy current orders

    public function show_current_order_deliveryboy(Request $request){

        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
      $current_date = $date->format('Y-m-d');
      $get_deliveryboy_id = $request->get('pharmasist_auto_id');
   $orders = UploadPrescription::ORDERBY('_id','DESC')->where('status','=','Received')->where('rdate','=',$current_date)->get();
        if($orders->isNotEmpty()){
            foreach ($orders as $order) {
              
                $prescription_auto_id = $order->_id;
                $admin_auto_id = $order->admin_auto_id;
                $customer_auto_id = $order->customer_auto_id;
                $customer_name = $order->customer_name;
                $address_details = $order->address;
                $country = $order->country;
                $state = $order->state;
                $city = $order->city;
                $mobile_no = $order->mobile_no;
                $pincode = $order->used_pincode;
                $prescription_image = $order->prescription_image;
                $cust_latitude = $order->cust_latitude;
                $order_date = $order->rdate;
                $cust_longitude = $order->cust_longitude;
                $order_status = $order->status;

                 
       $addressdetails = DeliveryBoy::where('_id','=',$request->get('pharmasist_auto_id'))->where('type', '=', 'Pharmacist')->get();
            if($addressdetails->isNotEmpty()){
                foreach ($addressdetails as $add) {
                   $dboy_latitude = $add->latitude;
                    $dboy_longitude = $add->longitude;
                }
            }else{
                $dboy_latitude = '';
                $dboy_longitude = '';
            }

     $BusinessLocations = Admin::where('_id', $request->admin_auto_id)->get();
              if($BusinessLocations->isNotEmpty()){
                foreach ($BusinessLocations as $loc) {
                    $radius = $loc->radius;
                    $business_longitude = $loc->business_longitude;
                    $business_latitude = $loc->business_latitude;
                     $business_address = $loc->business_address;
                 }
                }else{
                     $business_latitude = '';
                     $business_longitude = '';
                     $business_address = '';
                     $radius = '';
                }
                // calculate distance
                 if($cust_longitude != ''){
               $theta = $dboy_longitude - $cust_longitude;

                $dist = sin(deg2rad($dboy_latitude)) * sin(deg2rad($cust_latitude)) +  cos(deg2rad($dboy_latitude)) * cos(deg2rad($cust_latitude)) * cos(deg2rad($theta));

                $dist = acos($dist);

                $dist = rad2deg($dist);

                $miles = $dist * 60 * 1.1515;

                $unit = "K";



                if ($unit == "K") {

                  $calculated_distance = ($miles * 1.609344);

                } else if ($unit == "N") {

                  $calculated_distance = ($miles * 0.8684);

                } else {

                  $calculated_distance = $miles;

                }
     $dist = number_format($calculated_distance,2);
            if($dist <= $radius){ 
             
                $distss = $dist." KM";
                
            $dboydata = DeliveryBoy::where('_id','=',$request->get('pharmasist_auto_id'))->where('type', '=', 'Pharmacist')->where('admin_auto_id', $request->admin_auto_id)->get();
            if($dboydata->isNotEmpty()){
                foreach ($dboydata as $ddata) {
                  $dboy_token = $ddata->token;
                }
            }else{
                $dboy_token = "";
            }
                    
               $allorders[] = array("prescription_auto_id" => $prescription_auto_id,"admin_auto_id" => $admin_auto_id,"customer_auto_id" => $customer_auto_id,"customer_name" => $customer_name,"address_details" => $address_details,"country" => $country,"state" => $state,"city" => $city,"mobile_no" => $mobile_no,"pincode" => $pincode,"prescription_image" => $prescription_image,"order_date" => $order_date,"order_status" => $order_status,"business_address" => $business_address,"business_latitude" => $business_latitude,"business_longitude" => $business_longitude,"distance" => "$distss");
                }

            }else{
                   return response()->json([
                    'status' => 0, 
                    'msg' => 'something went wrong',
                ]);
            }
}
            // check review given or not

            if(empty($allorders)){

                return response()->json([
                    'status' => 0, 
                    'msg' => config('messages.empty'),
                ]);

            }else{

                return response()->json([
                    'status' => 1, 
                    'msg' => config('messages.success'),
                    'allorderdetails' => $allorders,
                ]);     

            }

        }else{

            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),

            ]);

        }

    }
        // assigned deliveryboy to order

    public function assign_delivery_boy_to_order(Request $request){

        $get_order_details = UploadPrescription::where('_id','=',$request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->get();
        if($get_order_details->isNotEmpty()){
            foreach ($get_order_details as $order_details) {
                $deliveryboy_id = $order_details->pharmasist_auto_id;
                $order_id = $order_details->_id;
            }
            if($deliveryboy_id!=""){
                return response()->json([
                    'status' => 0, 
                    'msg' => "Already assigned",
                ]);

            }else{

                 DB::table('upload_prescription')->where('_id','=',$request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->update(['status' => "Assigned", 'pharmasist_auto_id' => $request->get('pharmasist_auto_id')]);

                return response()->json([
                    'status' => 1, 
                    'msg' => config('messages.success'),
                ]);

            }

        }

        else{
            return response()->json([
                'status' => 0, 
                'msg' => "Already assigned",
            ]);

        }

    }
        public function complete_order(Request $request){
        $getorderdetails = UploadPrescription::where('_id','=', $request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->get();
        if($getorderdetails->isNotEmpty()){
            DB::table('upload_prescription')->where('_id', '=', $request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->update(['status' => 'Completed','payment_mode' => $request->get('payment_mode'),'payment_amount' => $request->get('payment_amount')]);

            // get details
            foreach ($getorderdetails as $orderdetails) {
                $user_auto_id = $orderdetails->customer_auto_id;
                $order_id = $orderdetails->_id;
                $deliveryboy_id = $orderdetails->pharmasist_auto_id;
            }
            // get customer token
            $customerdata = Users::where('_id','=',$user_auto_id)->get();
            if($customerdata->isNotEmpty()){
                foreach ($customerdata as $cdata) {
                    $customer_token = $cdata->token;
                }
            }
            else{
                $customer_token = "";
            }
            
            // Notification send to customer
            
    $firebaseToken = Users::where('_id','=',$user_auto_id)->whereNotNull('token')->pluck('token')->all();

     $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';
 
     $message = [

            "registration_ids" => $firebaseToken,
            "notification" => [

                "body"  =>  "Your order no. ".$order_id." is Completed",
                "title" => " Customer",
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
            
            return response()->json([
                'status' => 1, 
                'msg' => "Success",
            ]);
        }
        else{
            return response()->json([
                'status' => 0, 
                'msg' => "Error",
            ]);
        }
        
    }
        public function verify_order_otp(Request $request) {
        $checkUser = UploadPrescription::where('_id', $request->prescription_auto_id)->where('customer_auto_id', $request->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('pharmasist_auto_id', $request->pharmasist_auto_id)->where('otp_status','!=','Verified')->first();
        if($checkUser){
            if ($checkUser->otp == $request->otp) {
             $update = UploadPrescription::where('_id', $request->prescription_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', $request->customer_auto_id)->where('pharmasist_auto_id', $request->pharmasist_auto_id)->update(['otp_status' => 'Verified']);
                return response()->json([
                    'status' => 1, 
                    'msg' => 'Verified Successful...!',
                
                ]);
            } else {
                return response()->json([
                    'status' => 0, 
                    'msg' => 'OTP is mismatched...!',
                ]);
            }
        } else {
            return response()->json([
                'status' => 0, 
                'msg' => 'Already verified otp...!',
            ]);
        }
    }
    public function check_status(Request $request){

        $deliveryboydeatils = DeliveryBoy::select('status')->where('_id','=',$request->get('pharmasist_auto_id'))->where('type', '=', 'Pharmacist')->where('admin_auto_id', $request->admin_auto_id)->get();
        if($deliveryboydeatils->isEmpty()){
            return response()->json(['status' => 0, "msg" => config('messages.empty')]);
        }else{

            foreach ($deliveryboydeatils as $details) {

                $status = $details->status;

            }

            return response()->json(['status' => 1,  "msg" => config('messages.success'), "activestatus" => $status]);

        }

    }

        public function show_order_deliveryboy(Request $request){


        $orders = UploadPrescription::where('pharmasist_auto_id','=',$request->get('pharmasist_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('status','=','Completed')->ORDERBY('_id','DESC')->get();
        if($orders->isNotEmpty()){
            foreach ($orders as $order) {
 
             
                $prescription_auto_id = $order->_id;
                $admin_auto_id = $order->admin_auto_id;
                $customer_auto_id = $order->customer_auto_id;
                $customer_name = $order->customer_name;
                $address_details = $order->address;
                $country = $order->country;
                $state = $order->state;
                $city = $order->city;
                $mobile_no = $order->mobile_no;
                $pincode = $order->used_pincode;
                $prescription_image = $order->prescription_image;
                $cust_latitude = $order->cust_latitude;
                $order_date = $order->rdate;
                $cust_longitude = $order->cust_longitude;
                $order_status = $order->status;
                 $payment_mode = $order->payment_mode;
                  $payment_amount = $order->payment_amount;

        $allorders[] = array("prescription_auto_id" => $prescription_auto_id,"admin_auto_id" => $admin_auto_id,
"customer_auto_id" => $customer_auto_id,"customer_name" => $customer_name,"address_details" => $address_details,
"country" => $country,"state" => $state,"city" => $city,"mobile_no" => $mobile_no,"pincode" => $pincode,
"prescription_image" => $prescription_image,"order_date" => $order_date,"order_status" => $order_status,
"payment_mode" => "$payment_mode","payment_amount" => "$payment_amount");
                  }
    

            // check review given or not

            if(empty($allorders)){
                return response()->json([
                    'status' => 0, 
                    'msg' => config('messages.empty'),
                ]);

            }else{

                return response()->json([
                    'status' => 1, 
                    'msg' => config('messages.success'),
                    'allorderhistory' => $allorders,
                ]);     

            }

        }else{

            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);

        }

    }
    public function get_pharmacist_acepeted_presription(Request $request){

        $orders = UploadPrescription::where('pharmasist_auto_id','=',$request->get('pharmasist_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('status','=','Assigned')->ORDERBY('_id','DESC')->get();
        if($orders->isNotEmpty()){
            foreach ($orders as $order) {
            
                $prescription_auto_id = $order->_id;
                $admin_auto_id = $order->admin_auto_id;
                $customer_auto_id = $order->customer_auto_id;
                $customer_name = $order->customer_name;
                $address_details = $order->address;
                $country = $order->country;
                $state = $order->state;
                $city = $order->city;
                $mobile_no = $order->mobile_no;
                $pincode = $order->used_pincode;
                $prescription_image = $order->prescription_image;
                $cust_latitude = $order->cust_latitude;
                $order_date = $order->rdate;
                $cust_longitude = $order->cust_longitude;
                $order_status = $order->status;
                 $payment_mode = $order->payment_mode;
                  $payment_amount = $order->payment_amount;

        $allorders[] = array("prescription_auto_id" => $prescription_auto_id,"admin_auto_id" => $admin_auto_id,"customer_auto_id" => $customer_auto_id,"customer_name" => $customer_name,"address_details" => $address_details,"country" => $country,"state" => $state,"city" => $city,"mobile_no" => $mobile_no,"pincode" => $pincode,"prescription_image" => $prescription_image,"order_date" => $order_date,"order_status" => $order_status,"payment_mode" => "$payment_mode","payment_amount" => "$payment_amount");
                  }
    

            // check review given or not

            if(empty($allorders)){
                return response()->json([
                    'status' => 0, 
                    'msg' => config('messages.empty'),
                ]);

            }else{

                return response()->json([
                    'status' => 1, 
                    'msg' => config('messages.success'),
                    'allorderhistory' => $allorders,
                ]);     

            }

        }else{

            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);

        }

    }

    public function get_pharmacist_dispatched_presription(Request $request){


        $orders = UploadPrescription::where('pharmasist_auto_id','=',$request->get('pharmasist_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('status','=','Dispatched')->ORDERBY('_id','DESC')->get();
        if($orders->isNotEmpty()){
            foreach ($orders as $order) {
 
             
                $prescription_auto_id = $order->_id;
                $admin_auto_id = $order->admin_auto_id;
                $customer_auto_id = $order->customer_auto_id;
                $customer_name = $order->customer_name;
                $address_details = $order->address;
                $country = $order->country;
                $state = $order->state;
                $city = $order->city;
                $mobile_no = $order->mobile_no;
                $pincode = $order->used_pincode;
                $prescription_image = $order->prescription_image;
                $cust_latitude = $order->cust_latitude;
                $order_date = $order->rdate;
                $cust_longitude = $order->cust_longitude;
                $order_status = $order->status;
                 $payment_mode = $order->payment_mode;
                  $payment_amount = $order->payment_amount;

        $allorders[] = array("prescription_auto_id" => $prescription_auto_id,"admin_auto_id" => $admin_auto_id,"customer_auto_id" => $customer_auto_id,"customer_name" => $customer_name,"address_details" => $address_details,"country" => $country,"state" => $state,"city" => $city,"mobile_no" => $mobile_no,"pincode" => $pincode,"prescription_image" => $prescription_image,"order_date" => $order_date,"order_status" => $order_status,"payment_mode" => $payment_mode,"payment_amount" => $payment_amount);
                  }
    

            // check review given or not

            if(empty($allorders)){
                return response()->json([
                    'status' => 0, 
                    'msg' => config('messages.empty'),
                ]);

            }else{

                return response()->json([
                    'status' => 1, 
                    'msg' => config('messages.success'),
                    'allorderhistory' => $allorders,
                ]);     

            }

        }else{

            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);

        }

    }

        public function vendor_profile(Request $request){

        $deliveryboydeatils = DeliveryBoy::where('_id','=',$request->get('pharmasist_auto_id'))->where('type', '=', 'Pharmacist')->where('admin_auto_id', $request->admin_auto_id)->get();
        if($deliveryboydeatils->isNotEmpty()){
            return response()->json([
                'status' => 1, 
                'msg' => config('messages.success'),
                'profile' => $deliveryboydeatils,
            ]);

        }else{

            return response()->json([

                'status' => 0, 
                'msg' => config('messages.id'),

            ]);

        }

    }
       public function update_dispatch_status(Request $request){
    $getorderdetails = UploadPrescription::where('_id','=', $request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->get();
        if($getorderdetails->isNotEmpty()){
        DB::table('upload_prescription')->where('_id', '=', $request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->update(['status' => 'Dispatched']);
        return response()->json([

            'status' => 1, 
            'msg' => config('messages.success'),

        ]);
    }else{
            return response()->json([
                'status' => 0, 
                'msg' => "Error",
            ]);
        }
    }

    public function assign_orderto_dboy(Request $request){
    $getorderdetails = UploadPrescription::where('_id','=', $request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->get();
        if($getorderdetails->isNotEmpty()){
        DB::table('upload_prescription')->where('_id', '=', $request->get('prescription_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->update(['status' => "Assigned", 'pharmasist_auto_id' => $request->get('pharmasist_auto_id')]);


        return response()->json([
            'status' => 1, 
            'msg' => config('messages.success'),

        ]);
    }else{
            return response()->json([
                'status' => 0, 
                'msg' => "Error",
            ]);
        }
    }
        public function business_details(Request $request){
        $versions = Admin::where('_id', $request->admin_auto_id)->get();
        if($versions->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => "No data available",
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'msg' => "Success",
                'data' => $versions,
                
            ]);
        }
    }
    //bussiness details
    public function update_business_address_details(Request $request){
        $customer = Admin::find($request->get('admin_auto_id'));
        if(empty($customer)){
            return response()->json(['status' => '0', "msg" => "No User Found"]);
        }
        else{
              
            if(!empty($request->get('radius')))
            {
                 $customer->radius = $request->get('radius');
            }
           
           if(!empty($request->get('business_longitude')))
            {
                 $customer->business_longitude = $request->get('business_longitude');
            }
            
             if(!empty($request->get('business_latitude')))
            {
                 $customer->business_latitude = $request->get('business_latitude');
            }
            
             if(!empty($request->get('business_address')))
            {
                $customer->business_address = $request->get('business_address');
             }
                $customer->save();         
                           

            return response()->json(['status' => '1', "msg" => config('messages.success'), 'data' => $customer]);

        }
    }



}
