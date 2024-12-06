<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PriceRange;
use App\ColorsRange;
use App\DiscountRange;
use App\SizeLists;
use App\Pincode;
use App\Currency;
use App\CountryProductPrice;
use App\DeliveryBoy;
use App\DeliveryBoyCurrentLocation;
use App\ProductUnitList;
use App\OfferComponent;
use App\Admin;
use App\AdminProducts;
use App\Manufacturer;
use App\Material;
use App\Firmness;
use DateTimeZone;
use DateTime;
use DB;

class FilterApiController extends Controller
{
     
       //currency
  public function add_currency(Request $request) {
     
      $currency = new Currency();
       if($request->get('admin_auto_id')!='')
                        {
                           $currency->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $currency->admin_auto_id ="";
                        }    
      $currency->country_name = $request->get('country_name');           
      $currency->country_code = $request->get('country_code');
      if($request->get('express_delivery_charges')!='')
        {
            $currency->express_delivery_charges = $request->get('express_delivery_charges');
        }else{
            $currency->express_delivery_charges ="0";
        }    
      $currency->currency = $request->get('currency');
            if (!empty($request->file('flag_image'))) {
                            $file = $request->file('flag_image');
                            $filename = $file->getClientOriginalName();
                         
               $path = public_path('images/currency');
                            $file->move($path, $filename);
                            $currency->flag_image = $filename;
                }else{
                            $currency->flag_image ='';
                }
      $currency->save();

     return response()->json([
                    'status' => "1", 
                    'msg' => "success"
                    
    ]);
         
    
    
  }
      public function delete_currency(Request $request){
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $pdetails = Currency::where('_id','=', $request->get('currency_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
           }else{
        $pdetails = Currency::where('_id','=', $request->get('currency_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
           }
            if($pdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }

    public function get_currecy_list(Request $request) {
  $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
    $get_currency_list = Currency::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
 }else{
    $get_currency_list = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
 }
    if($get_currency_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'get_currency_list' => $get_currency_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
//price range
  public function add_price_range(Request $request) {
     
      $price = new PriceRange();
      $price->user_auto_id = $request->get('user_auto_id');  
       if($request->get('admin_auto_id')!='')
                        {
                                    $price->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $price->admin_auto_id ="";
                        }       
      $price->min_price = $request->get('min_price');
      $price->max_price = $request->get('max_price');
      $price->save();

     return response()->json([
                    'status' => "1", 
                    'msg' => "success"
                    
                ]);
         
    
    
  }
    

    public function get_price_range(Request $request) {
  $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
 $get_price_list = PriceRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
 }else{
 $get_price_list = PriceRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
 }
    if($get_price_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'get_price_list' => $get_price_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_price_range(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $pdetails = PriceRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('_id','=', $request->get('price_auto_id'))->delete();
      }else{
        $pdetails = PriceRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('_id','=', $request->get('price_auto_id'))->delete();
      }
            if($pdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
public function add_color_range(Request $request) {
     
    
        $pid = $request->get('color_name');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $color= new ColorsRange();
        $data = $emailArray[$i];  
        $color->color_name=$data;
                if($request->get('admin_auto_id')!='')
                        {
                                    $color->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $color->admin_auto_id ="";
                        }       
                if (!empty($request->file('color_img'))) {
                            $file = $request->file('color_img');
                            $filename = $file->getClientOriginalName();
                           
                       $path = public_path('images/colors');
                            $file->move($path, $filename);
                            $color->color_img = $filename;
                        }else{
                            $color->color_img ='';
                        }
     
        $color->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
    
    
  }    

    public function get_color_range(Request $request) {
 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
             $get_color_list = ColorsRange::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
          $get_color_list = ColorsRange::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
        }
    if($get_color_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'get_color_list' => $get_color_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_color_range(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $cdetails = ColorsRange::where('_id','=', $request->get('color_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $cdetails = ColorsRange::where('_id','=', $request->get('color_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }
            if($cdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
         
//discount range
  public function add_discount_range(Request $request) {
     
      $discount = new DiscountRange();
       if($request->get('admin_auto_id')!='')
                        {
                            $discount->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $discount->admin_auto_id ="";
                        }      
      $discount->user_auto_id = $request->get('user_auto_id');           
      $discount->discount_percent = $request->get('discount_percent');
      $discount->save();

     return response()->json([
                    'status' => "1", 
                    'msg' => "success"
                    
                ]);
         
    
    
  }
    

    public function get_discount_range(Request $request) {
 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
if($erase_data_status =='Yes'){
 $get_discount_list = DiscountRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
}else{
 $get_discount_list = DiscountRange::where('user_auto_id','=', $request->get('user_auto_id'))->whereNull('deleted_at')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->get();
}
    if($get_discount_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'get_discount_list' => $get_discount_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_discount_range(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $ddetails = DiscountRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('_id','=', $request->get('discount_auto_id'))->delete();
      }else{
        $ddetails = DiscountRange::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('_id','=', $request->get('discount_auto_id'))->delete();
      }
            if($ddetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
  //size list
  public function add_size(Request $request) {
     
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
       $unitss = SizeLists::where('size', $request->size)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
       }else{
        $unitss = SizeLists::where('size', $request->size)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();

       }
            if($unitss) {
            return response()->json([
                'status' => '0', 
                'msg' => 'This size already exist',
            ]);
        
        }  else {
            

      $pid = $request->get('size');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $sizes= new SizeLists();
        $data = $emailArray[$i];  
        $sizes->size=$data;
        if($request->get('admin_auto_id')!='')
        {
            $sizes->admin_auto_id = $request->get('admin_auto_id');
        }else{
            $sizes->admin_auto_id ="";
        }       
      $sizes->title = $request->get('title');

        $sizes->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
        }
    
  }    

    public function get_size_list(Request $request) {
  $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
    $get_size_list = SizeLists::select('size')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
 }else{
    $get_size_list = SizeLists::select('size')->whereNull('deleted_at')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->get();
 }
    if($get_size_list->isNotEmpty()){
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
            $get_size_title = SizeLists::ORDERBY('_id','=','DESC')->where('admin_auto_id', $request->admin_auto_id)->limit(1)->whereNull('deleted_at')->get();
         }else{
            $get_size_title = SizeLists::ORDERBY('_id','=','DESC')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->limit(1)->whereNull('deleted_at')->get();
         }
           if($get_size_title->isNotEmpty()){
               foreach($get_size_title as $urs){
                 $title = $urs->title;
               }
               
           }else{
               $title = '';
           }
      return response()->json(['status' => 1, "msg" => "success", 'title' => $title,'get_size_list' => $get_size_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_size(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $szdetails = SizeLists::where('_id','=', $request->get('size_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
        }else{
        $szdetails = SizeLists::where('_id','=', $request->get('size_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
        }
            if($szdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }

    //add pincode
  public function add_pincode(Request $request) {
     
    
        $pid = $request->get('pincode');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $pincode= new Pincode();
        $data = $emailArray[$i];  
        $pincode->pincode=$data;
        if($request->get('admin_auto_id')!='')
                        {
                            $pincode->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $pincode->admin_auto_id ="";
                        }       
        $pincode->user_auto_id = $request->get('user_auto_id');         
        $pincode->price = $request->get('price');
        $pincode->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
    
    
  }
     public function get_pincode_list(Request $request) {
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
    $get_pincode_list = Pincode::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
 }else{
    $get_pincode_list = Pincode::where('user_auto_id','=', $request->get('user_auto_id'))->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
 }
    if($get_pincode_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'get_pincode_list' => $get_pincode_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_pincode(Request $request){
      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $pdetails = Pincode::where('_id','=', $request->get('pincode_auto_id'))->where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $pdetails = Pincode::where('_id','=', $request->get('pincode_auto_id'))->where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }
            if($pdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
    //update pincode
    
    public function edit_pincode(Request $request){
        $pid = $request->get('pincode_auto_id');
        $pincode_ids = explode(',',$pid);
               foreach($pincode_ids as $data){
                        $pids[]=$data;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
             $data = $emailArray[$i];  
           $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $pincode = Pincode::where('_id','=', $data)->where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
             }else{
        $pincode = Pincode::where('_id','=', $data)->where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
             }
        if(empty($pincode)){
            return response()->json(['status' => 0, "msg" => "No pincode Found"]);
        }
        else{
               
            
                // if($request->get('pincode')!='')
                // {
                //             $pincode->pincode = $request->get('pincode');
                // }else
                // {
                //     $pincode->pincode ="";
                // }
       
                if($request->get('price')!='')
                {
                            $pincode->price = $request->get('price');
                }else
                {
                    $pincode->price ="";
                }
              
           
                $pincode->save();
        }
        }
                if($pincode)
                {
                     return response()->json([
                                    'status' => "1", 
                                    'msg' => "Sucessfully Updated"
                
                                    
                                ]);
                }
                else
                {
                     return response()->json([
                                    'status' => "0", 
                                    'data' => "Someting went wrng"
                                    
                                ]);
                }
                     
                        
    }
    
    //country product price 
  public function add_country_product_price(Request $request) {
     
              $cprice = new CountryProductPrice();
              $cprice->user_auto_id = $request->get('user_auto_id');
              $cprice->product_auto_id = $request->get('product_auto_id'); 
              $cprice->currency_auto_id = $request->get('currency_auto_id'); 
                if($request->get('admin_auto_id')!='')
                        {
                            $cprice->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $cprice->admin_auto_id ="";
                        }   
                        if($request->get('app_type_id')!='')
                            {
                                $cprice->app_type_id = $request->get('app_type_id');
                            }else
                            {
                                $cprice->app_type_id ="";
                            }
               if($request->get('product_price')!='')
                {
                            $cprice->product_price = $request->get('product_price');
                }else
                {
                    $cprice->product_price ="";
                }
                 if($request->get('offer_percentage')!='')
                {
                            $cprice->offer_percentage = $request->get('offer_percentage');
                }else
                {
                    $cprice->offer_percentage ="";
                }
               if($request->get('size_price')!='')
                {
                            $cprice->size_price = $request->get('size_price');
                }else
                {
                    $cprice->size_price ="";
                }
                if($request->get('including_tax')!='')
                {
                            $cprice->including_tax = $request->get('including_tax');
                }else
                {
                    $cprice->including_tax ="";
                }
                 if($request->get('tax_percentage')!='')
                {
                            $cprice->tax_percentage = $request->get('tax_percentage');
                }else
                {
                    $cprice->tax_percentage ="";
                }
                 if($request->get('offer_auto_id')!='')
                {
                            $cprice->offer_auto_id = $request->get('offer_auto_id');
                }else
                {
                    $cprice->offer_auto_id ="";
                }
                $offer_auto_id = $request->get('offer_auto_id');
                $offer_percentage=$request->get('offer_percentage');
               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                 $productlist = AdminProducts::where('_id','=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }else{
                 $productlist = AdminProducts::where('_id','=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                  if($productlist->isNotEmpty())
                    {
                        foreach($productlist as $plist)
                        {
                            $main_category_auto_id = $plist->main_category_auto_id;
                            $sub_category_auto_id = $plist->sub_category_auto_id;
                            $brand_auto_id = $plist->brand_auto_id;
                            $product_auto_id = $plist->_id;
                        }
                                            
                    }else{
                            $main_category_auto_id = '';
                            $sub_category_auto_id = '';
                            $brand_auto_id = '';
                            $product_auto_id = '';
                    }

                                $offer_ids = explode('|',$offer_auto_id);
                                         unset($get_olists);
                                         if($offer_ids){
                                      foreach($offer_ids as $offer){
                                         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                                      $offerlist = OfferComponent::where('_id','=', $offer)->orwhere('product_auto_id', 'LIKE', '%'.$product_auto_id.'%')->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orwhere('brand', 'LIKE', '%'.$brand_auto_id.'%')->orwhere('subcategory', 'LIKE', '%'.$sub_category_auto_id.'%')->orwhere('main_category', 'LIKE', '%'.$main_category_auto_id.'%')->whereNull('deleted_at')->get();
                                           }else{
                                      $offerlist = OfferComponent::where('_id','=', $offer)->orwhere('product_auto_id', 'LIKE', '%'.$product_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->orwhere('brand', 'LIKE', '%'.$brand_auto_id.'%')->orwhere('subcategory', 'LIKE', '%'.$sub_category_auto_id.'%')->orwhere('main_category', 'LIKE', '%'.$main_category_auto_id.'%')->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                           }
                                        if($offerlist->isNotEmpty())
                                        {
                                      foreach($offerlist as $off)
                                      {
                                          $offerprice = $plist->price;
                                          $offerper = $plist->offer;
                                      }
                                    }else{
                                        $offerprice ='';
                                        $offerper = '';
                                          
                                    }
                                }
                            }
                          if($offerper != ''){
                          if($request->get('including_tax') == 'Yes'){
                                $offer_price = ($request->product_price * $offerper)/100;
                                $final_price = $request->product_price - $offer_price;
                                $cprice->final_price = strval(round($final_price));
                            }else{
                               $offer_price = ($request->product_price * $offerper)/100;
                               $final_price = $request->product_price - $offer_price;
                               $tax_price = ($final_price * $request->tax_percentage)/100;
                               $final_tax_price = $final_price + $tax_price;
                               $cprice->final_price = strval(round($final_tax_price));
                            }
                          }elseif($offerprice !=''){
                                if($request->get('including_tax') == 'Yes'){
                                $final_price = $request->product_price - $offerprice;
                                $cprice->final_price = strval(round($final_price));
                            }else{
                               $final_price = $request->product_price - $offerprice;
                               $tax_price = ($final_price * $request->tax_percentage)/100;
                               $final_tax_price = $final_price + $tax_price;
                               $cprice->final_price = strval(round($final_tax_price));
                            }
                          }
                          else{
                             if($request->get('including_tax') == 'Yes'){
                               $offer_price = ($request->product_price * $request->get('offer_percentage'))/100;
                                $final_price = $request->product_price - $offer_price;
                                $cprice->final_price = strval(round($final_price));
                            }else{
                               $offer_price = ($request->product_price * $request->get('offer_percentage'))/100;
                               $final_price = $request->product_price - $offer_price;
                               $tax_price = ($final_price * $request->tax_percentage)/100;
                               $final_tax_price = $final_price + $tax_price;
                               $cprice->final_price = strval(round($final_tax_price));
                            }
                          }
      $cprice->save();

     return response()->json([
                    'status' => "1", 
                    'msg' => "success"
                    
                ]);
         
    
    
  }
    
 public function get_country_product_price(Request $request) {
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
if($erase_data_status =='Yes'){
    $get_country_product_price_list = CountryProductPrice::where('user_auto_id','=', $request->get('user_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id','=', $request->get('product_auto_id'))->whereNull('deleted_at')->get();
}else{
    $get_country_product_price_list = CountryProductPrice::where('app_type_id', $request->app_type_id)->where('user_auto_id','=', $request->get('user_auto_id'))->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id','=', $request->get('product_auto_id'))->whereNull('deleted_at')->get();
}
    if($get_country_product_price_list->isNotEmpty()){
         foreach($get_country_product_price_list as $sz){
             $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
            $currency = Currency::where('_id','=', $sz->currency_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
             }else{
   $currency = Currency::where('_id','=', $sz->currency_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();     
   }
                if($currency->isNotEmpty())
                {
                    foreach($currency as $sub)
                         {
                             $offer_auto_id = $sz->offer_auto_id;
                                $offer_ids = explode('|',$offer_auto_id);
                                         unset($get_olists);
                                      foreach($offer_ids as $offer){
                                            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                                      $offerlist = OfferComponent::where('_id','=', $offer)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            }else{
                                      $offerlist = OfferComponent::where('_id','=', $offer)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            }
                                        if($offerlist->isNotEmpty())
                                        {
                                      foreach($offerlist as $off)
                                      {
                                          $get_olists[] = array("offer_auto_id"=>$off->_id,"homecomponent_auto_id"=>$off->homecomponent_auto_id,"component_image"=>$off->component_image,"main_category"=>$off->main_category,
                                          "subcategory"=>$off->subcategory,"brand"=>$off->brand,"price"=>$off->price,"offer"=>$off->offer,"rdate"=>$off->rdate);
                                      }
                                    }else{
                                        $get_olists = array();
                                          
                                    }
                                }
                            $get_cpriceslists[] = array("country_price_auto_id"=>$sz->_id,"user_auto_id"=>$sz->user_auto_id,"product_auto_id"=>$sz->product_auto_id,"currency_auto_id"=>$sz->currency_auto_id,"product_price"=>$sz->product_price,
                            "offer_percentage"=>$sz->offer_percentage,"size_price"=>$sz->size_price,"including_tax"=>$sz->including_tax,"tax_percentage"=>$sz->tax_percentage,"offer_data"=>$get_olists,
                            "final_price"=>$sz->final_price,"country_name"=>$sub->country_name,"country_code"=>$sub->country_code,"currency"=>$sub->currency,"flag_image"=>$sub->flag_image);
                        }
                }else{
                        $get_cpriceslists = array();
                                          
                }
         }
      return response()->json(['status' => 1, "msg" => "success", 'get_country_product_price_list' => $get_cpriceslists]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
    public function edit_country_product_price(Request $request) {

     $mains = CountryProductPrice::find($request->get('country_price_auto_id'));
        if(empty($mains)){
            return response()->json(['status' => 0, "msg" => "No data Found"]);
        }
        else{
               $mains->currency_auto_id = $request->get('currency_auto_id'); 
               $mains->user_auto_id = $request->get('user_auto_id');
               $mains->product_auto_id = $request->get('product_auto_id'); 
               if($request->get('product_price')!='')
                {
                            $mains->product_price = $request->get('product_price');
                }else
                {
                    $mains->product_price ="";
                }
                 if($request->get('offer_percentage')!='')
                {
                            $mains->offer_percentage = $request->get('offer_percentage');
                }else
                {
                    $mains->offer_percentage ="";
                }
               if($request->get('size_price')!='')
                {
                            $mains->size_price = $request->get('size_price');
                }else
                {
                    $mains->size_price ="";
                }
                if($request->get('including_tax')!='')
                {
                            $mains->including_tax = $request->get('including_tax');
                }else
                {
                    $mains->including_tax ="";
                }
                 if($request->get('tax_percentage')!='')
                {
                            $mains->tax_percentage = $request->get('tax_percentage');
                }else
                {
                    $mains->tax_percentage ="";
                }
                  if($request->get('offer_auto_id')!='')
                {
                            $mains->offer_auto_id = $request->get('offer_auto_id');
                }else
                {
                    $mains->offer_auto_id ="";
                }
                                $offer_auto_id = $request->get('offer_auto_id');
                               $offer_percentage=$request->get('offer_percentage');
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                 $productlist = AdminProducts::where('_id','=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
   }else{
                        $productlist = AdminProducts::where('_id','=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

   }
                  if($productlist->isNotEmpty())
                    {
                        foreach($productlist as $plist)
                        {
                            $main_category_auto_id = $plist->main_category_auto_id;
                            $sub_category_auto_id = $plist->sub_category_auto_id;
                            $brand_auto_id = $plist->brand_auto_id;
                            $product_auto_id = $plist->_id;
                        }
                                            
                    }else{
                            $main_category_auto_id = '';
                            $sub_category_auto_id = '';
                            $brand_auto_id = '';
                            $product_auto_id = '';
                    }

                                $offer_ids = explode('|',$offer_auto_id);
                                         unset($get_olists);
                                           if($offer_ids){
                                      foreach($offer_ids as $offer){
                                         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                                      $offerlist = OfferComponent::where('_id','=', $offer)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->orwhere('product_auto_id', 'LIKE', '%'.$product_auto_id.'%')->orwhere('brand', 'LIKE', '%'.$brand_auto_id.'%')->orwhere('subcategory', 'LIKE', '%'.$sub_category_auto_id.'%')->orwhere('main_category', 'LIKE', '%'.$main_category_auto_id.'%')->whereNull('deleted_at')->get();
                                          }else{
                                      $offerlist = OfferComponent::where('_id','=', $offer)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orwhere('product_auto_id', 'LIKE', '%'.$product_auto_id.'%')->orwhere('brand', 'LIKE', '%'.$brand_auto_id.'%')->orwhere('subcategory', 'LIKE', '%'.$sub_category_auto_id.'%')->orwhere('main_category', 'LIKE', '%'.$main_category_auto_id.'%')->whereNull('deleted_at')->get();
                                          }
                                        if($offerlist->isNotEmpty())
                                        {
                                      foreach($offerlist as $off)
                                      {
                                          $offerprice = $plist->price;
                                          $offerper = $plist->offer;
                                      }
                                    }else{
                                        $offerprice = '';
                                        $offerper = '';
                                          
                                    }
                                }
                            }
                        if($offerper != ''){
                          if($request->get('including_tax') == 'Yes'){
                                $offer_price = ($request->product_price * $offerper)/100;
                                $final_price = $request->product_price - $offer_price;
                                $mains->final_price = strval(round($final_price));
                            }else{
                               $offer_price = ($request->product_price * $offerper)/100;
                               $final_price = $request->product_price - $offer_price;
                               $tax_price = ($final_price * $request->tax_percentage)/100;
                               $final_tax_price = $final_price + $tax_price;
                               $mains->final_price = strval(round($final_tax_price));
                            }
                          }elseif($offerprice !=''){
                                if($request->get('including_tax') == 'Yes'){
                                $final_price = $request->product_price - $offerprice;
                                $mains->final_price = strval(round($final_price));
                            }else{
                               $final_price = $request->product_price - $offerprice;
                               $tax_price = ($final_price * $request->tax_percentage)/100;
                               $final_tax_price = $final_price + $tax_price;
                               $mains->final_price = strval(round($final_tax_price));
                            }
                          }
                          else{
                             if($request->get('including_tax') == 'Yes'){
                               $offer_price = ($request->product_price * $request->get('offer_percentage'))/100;
                                $final_price = $request->product_price - $offer_price;
                                $mains->final_price = strval(round($final_price));
                            }else{
                               $offer_price = ($request->product_price * $request->get('offer_percentage'))/100;
                               $final_price = $request->product_price - $offer_price;
                               $tax_price = ($final_price * $request->tax_percentage)/100;
                               $final_tax_price = $final_price + $tax_price;
                               $mains->final_price = strval(round($final_tax_price));
                            }
                          }
                $mains->save();
                
                return response()->json([
                'status' => "1", 
                'msg' => "Sucessfully Updated"
                ]);
                     
        }
  }
  
  
  
  public function delete_country_product_price(Request $request){
         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $pdetails = CountryProductPrice::where('_id','=', $request->get('country_price_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('user_auto_id','=', $request->get('user_auto_id'))->where('product_auto_id','=', $request->get('product_auto_id'))->where('currency_auto_id','=', $request->get('currency_auto_id'))->delete();
         }else{
        $pdetails = CountryProductPrice::where('_id','=', $request->get('country_price_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('user_auto_id','=', $request->get('user_auto_id'))->where('product_auto_id','=', $request->get('product_auto_id'))->where('currency_auto_id','=', $request->get('currency_auto_id'))->delete();
         }
            if($pdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
         }

        else{
           
            return response()->json([
                'status' => 0, 
                'msg' => "something went wrong"
            ]);
        }
   }
  //product unit list
  public function add_product_unit(Request $request) {
     
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
      $units = ProductUnitList::where('unit', $request->unit)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
       }else{
       $units = ProductUnitList::where('unit', $request->unit)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();

       }
            if($units) {
            return response()->json([
                'status' => '0', 
                'msg' => 'This unit already exist',
            ]);
        
        }  else {
            

      $pid = $request->get('unit');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $unit= new ProductUnitList();
        $data = $emailArray[$i];  
        $unit->unit=$data;
     if($request->get('admin_auto_id')!=''){
             $unit->admin_auto_id = $request->get('admin_auto_id');
     }else{
             $unit->admin_auto_id ="";
     }  


        $unit->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
        }
    
  }
    

    public function get_product_unit(Request $request) {
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
     $get_unit_list = ProductUnitList::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
  }else{
 $get_unit_list = ProductUnitList::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
 }
        if($get_unit_list->isNotEmpty()){
          return response()->json(['status' => 1, "msg" => "success", 'get_unit_list' => $get_unit_list]);
        } else {
          return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
      }
  
  
  
  public function delete_product_unit(Request $request){
     $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $unitdetails = ProductUnitList::where('_id','=', $request->get('unit_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $unitdetails = ProductUnitList::where('_id','=', $request->get('unit_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }
            if($unitdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
 //manufacturer list
  public function add_manufacturer(Request $request) {
     
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
      $manus = Manufacturer::where('manufacturer_name', $request->manufacturer_name)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
       }else{
        $manus = Manufacturer::where('manufacturer_name', $request->manufacturer_name)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();

       }
            if($manus) {
            return response()->json([
                'status' => '0', 
                'msg' => 'This manufacturer name already exist',
            ]);
        
        }  else {
          
     $pid = $request->get('manufacturer_name');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $manu= new Manufacturer();
        $data = $emailArray[$i];  
        $manu->manufacturer_name=$data;
                if($request->get('admin_auto_id')!='')
                        {
                                    $manu->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $manu->admin_auto_id ="";
                        }       
               
        $manu->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
        }
    
  }
    

    public function get_manufacturer(Request $request) {
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
     $get_manu_list = Manufacturer::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
  }else{
 $get_manu_list = Manufacturer::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
 }
        if($get_manu_list->isNotEmpty()){
          return response()->json(['status' => 1, "msg" => "success", 'data' => $get_manu_list]);
        } else {
          return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
      }
  
  
  
  public function delete_manufacturer(Request $request){
     $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $mandetails = Manufacturer::where('_id','=', $request->get('manufacturer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $mandetails = Manufacturer::where('_id','=', $request->get('manufacturer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }
            if($mandetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
//material list
  public function add_material(Request $request) {
     
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
      $units = Material::where('material_name', $request->material_name)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
       }else{
        $units = Material::where('material_name', $request->material_name)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();

       }
            if($units) {
            return response()->json([
                'status' => '0', 
                'msg' => 'This material name already exist',
            ]);
        
        }  else {
         
          $pid = $request->get('material_name');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $material= new Material();
        $data = $emailArray[$i];  
        $material->material_name=$data;
                if($request->get('admin_auto_id')!='')
                {
                            $material->admin_auto_id = $request->get('admin_auto_id');
                }else{
                            $material->admin_auto_id ="";
                }       
               
        $material->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
        }
    
  }
    

    public function get_material(Request $request) {
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
     $get_mat_list = Material::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
  }else{
 $get_mat_list = Material::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
 }
        if($get_mat_list->isNotEmpty()){
          return response()->json(['status' => 1, "msg" => "success", 'data' => $get_mat_list]);
        } else {
          return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
      }
  
  
  
  public function delete_material(Request $request){
     $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $get_mat_list = Material::where('_id','=', $request->get('material_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $get_mat_list = Material::where('_id','=', $request->get('material_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }
            if($get_mat_list){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
   //Firmness list
  public function add_firmness(Request $request) {
     
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
      $units = Firmness::where('firmness_type', $request->firmness_type)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
       }else{
        $units = Firmness::where('firmness_type', $request->firmness_type)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();

       }
            if($units) {
            return response()->json([
                'status' => '0', 
                'msg' => 'This firmness  already exist',
            ]);
        
        }  else {


        $pid = $request->get('firmness_type');
         $input=$request->all();
            $pids=array();
              $product_ids = explode(',',$pid);
               foreach($product_ids as $data1){
                        $pids[]=$data1;
                   }
                    $emailArray = $pids;
            $totalEmails = count($emailArray);
        for($i=0; $i<$totalEmails; $i++) {
        $Firmness= new Firmness();
        $data = $emailArray[$i];  
        $Firmness->firmness_type=$data;
        if($request->get('admin_auto_id')!='')
        {
            $Firmness->admin_auto_id = $request->get('admin_auto_id');
        }else{
            $Firmness->admin_auto_id ="";
        }       
               
        $Firmness->save();
       }
     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
        }
    
  }
    

    public function get_firmness(Request $request) {
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
     $get_firm_list = Firmness::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
  }else{
 $get_firm_list = Firmness::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
 }
        if($get_firm_list->isNotEmpty()){
          return response()->json(['status' => 1, "msg" => "success", 'data' => $get_firm_list]);
        } else {
          return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
      }
  
  
  
  public function delete_firmness(Request $request){
     $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $get_firm_list = Firmness::where('_id','=', $request->get('firmness_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $get_firm_list = Firmness::where('_id','=', $request->get('firmness_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }
            if($get_firm_list){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "something went wrong"

            ]);
        }
   }
 public function add_delivery_boy(Request $request) {
     
    
        $dbid = DeliveryBoy::select('deliveryboy_id')->get();
        if($dbid->isNotEmpty())
        {
            foreach ($dbid as $data) 
            {
                $maid = $data->deliveryboy_id;
            }
            $str = explode('DBOY',$maid,3);
            $second = $str[1];
            $nmaid = $second+1;
            $len = strlen($nmaid);
            if($len > 1){
                $newmaid = "DBOY".$nmaid;
            }else{
                $newmaid = "DBOY0".$nmaid;
            }
        }
        else{
            $newmaid = "DBOY01";
        }
      
  
        $dboyy = new DeliveryBoy();
     
        $dboyy->deliveryboy_id  =  $newmaid;
        $dboyy->admin_auto_id= $request->input('admin_auto_id');
    	$dboyy->app_type_id= $request->input('app_type_id');
        $dboyy->name = $request->input('name');
        $dboyy->email = $request->input('email');
        $dboyy->contact = $request->input('contact');
        
            if (!empty($request->file('pimage'))) {
                            $file = $request->file('pimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $dboyy->profile_img = $filename;
                    }else{
                            $dboyy->profile_img ='';
                    }
       
        $dboyy->city = $request->input('city');
        $dboyy->area = $request->input('area');
        $dboyy->address = $request->input('address');
        $dboyy->pincode = $request->input('pincode');
        $dboyy->adhar_no = $request->input('adhar_no');
        
            if (!empty($request->file('aimage'))) {
                            $file = $request->file('aimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $dboyy->adhar_img = $filename;
                    }else{
                            $dboyy->adhar_img ='';
                    }

                        
                        $dboyy->driving_lic_no = $request->input('driving_no');
            	    if (!empty($request->file('dimage'))) {
                            $file = $request->file('dimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $dboyy->driving_img = $filename;
                    }else{
                            $dboyy->driving_img ='';
                    }
        

       if ($request->get('vehicle_no') != '') {
                $dboyy->vehicle_no = $request->get('vehicle_no');
            } else {
                $dboyy->vehicle_no = "";
            }
             if (!empty($request->file('fimage'))) {
                            $file = $request->file('fimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $dboyy->vehicle_img = $filename;
                    }else{
                            $dboyy->vehicle_img ='';
                    }
      
         $dboyy->status =$request->input('status');
         $dboyy->save();
                $lastInsertedId = $dboyy->id;
                $customerwallet = new DeliveryBoyCurrentLocation();
        	$customerwallet->admin_auto_id= $request->input('admin_auto_id');
        	$customerwallet->app_type_id= $request->input('app_type_id');
                $customerwallet->deliveryboy_id = $newmaid;
                $customerwallet->status = "OFF";
                $customerwallet->save();

     return response()->json([
        'status' => "1", 
        'msg' => "success"
                    
     ]);
         
    
    
  }
      public function edit_delivery_boy(Request $request){

        $vendor = DeliveryBoy::where('_id','=', $request->delivery_boy_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
            if(empty($vendor)){
                return response()->json(['status' => 0, "msg" => "No data Found"]);
            }
            else{
                                
                        $vendor->name = $request->input('name');
            if ($request->get('email') != '') {
                           $vendor->email= $request->input('email');
            }

                        $vendor->contact = $request->input('contact');
            if (!empty($request->file('pimage'))) {
                            $file = $request->file('pimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $vendor->profile_img = $filename;
                    }

                        $vendor->city = $request->input('city');
            if ($request->get('area') != '') {
                           $vendor->area = $request->input('area');
            }
                        $vendor->address = $request->input('address');
            if ($request->get('pincode') != '') {
                           $vendor->pincode= $request->input('pincode');
            }

                        $vendor->adhar_no = $request->input('adhar_no');
                        

                     if (!empty($request->file('aimage'))) {
                            $file = $request->file('aimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $vendor->adhar_img = $filename;
                    }
            if ($request->get('driving_no') != '') {
                            $vendor->driving_lic_no = $request->input('driving_no');
            }
            if (!empty($request->file('dimage'))) {
                            $file = $request->file('dimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $vendor->driving_img = $filename;
                    }

                        
                       if ($request->get('vehicle_no') != '') {
                         $vendor->vehicle_no = $request->get('vehicle_no');
                    } 
            if (!empty($request->file('fimage'))) {
                            $file = $request->file('fimage');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/delivery_boy_documents');
                            $file->move($path, $filename);
                            $vendor->vehicle_img = $filename;
                    }

                         $vendor->status =$request->input('status');

                         $vendor->save();
            }
   

                     return response()->json([
                        'status' => "1", 
                        'msg' => "Sucessfully Updated"
                                            
                    ]);

                     
                        
    }
     public function get_delivery_boy(Request $request) {

    $get_dboy_list = DeliveryBoy::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
    if($get_dboy_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'data' => $get_dboy_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_delivery_boy(Request $request){

        $pdetails = DeliveryBoy::where('_id','=', $request->get('delivery_boy_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        if($pdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
        }else{
           
            return response()->json([
                'status' => 0, 
                'msg' => "something went wrong"
            ]);
        }
   }

    //update product new keys
    public function Update_product_new_keys(Request $request) {

        // $update = DB::table('product_form_ui')->update(["isveg"  => '',"isegg"  => '',"iscustomizable"  => '']);
       // $update = DB::table('HomeComponent')->update(["background_image"  => '']);
    }
}