<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PincodeDeliveryTime;
use App\PincodeLocations;
use App\PincodeDeliverySetting;
use App\AdminProducts;
use App\AdminProductImages;
use App\AdminProductColors;
use App\ProductRatingReview;
use App\WishlistProducts;
use App\UserRegister;
use App\CartProducts;
use App\OfferComponent;
use App\DeliveryTime;
use App\CountryProductPrice;
use App\EcommRegistration;
use App\Orders;
use App\Search;
use App\SizeChart;
use App\Currency;
use App\SizeLists;
use App\Admin;
use DateTimeZone;
use DateTime;
use DB;

class NewChangesApiController extends Controller
{
     
   
public function add_pincode_deliverytime(Request $request) {
     
    
                $pincode = $request->get('pincode');
                 $pincodes = explode(',',$pincode);
                 foreach($pincodes as $pin){

                $normal_or_express = $request->get('normal_or_express');
                $pqid = $request->get('from_time');
                $wid = $request->get('to_time');
                $mid = $request->get('delivery_price');
                 $eid = $request->get('express_time');

                     $input=$request->all();
                     $pqids=array();
                     $wids=array();
                     $mids=array();
                     $eids=array();
      if($pqid != '' && $wid != '' && $mid != ''){

                  $product_quantity_ids = explode(',',$pqid);
                  $unit_ids = explode(',',$wid);
                  $mark_ids = explode(',',$mid);
                  foreach($product_quantity_ids as $data4){
                        $pqids[]=$data4;
                  }
                  foreach($unit_ids as $data3){
                        $wids[]=$data3;
                  }
                  foreach($mark_ids as $data5){
                        $mids[]=$data5;
                  }
              
          

                                      $pqArray = $pqids;
                $totalproductquantities = count($pqArray);
                             $wArray = $wids;
                $totalwights = count($wArray);
                            $mArray = $mids;
                $totalmarks = count($mArray);
                for($i=0; $i<$totalproductquantities; $i++) {
                   
                    $tlist= new PincodeDeliveryTime();
                    $tlist->admin_auto_id = $request->get('admin_auto_id');
                    $tlist->pincode = $pin;
                    $tlist->normal_or_express = $normal_or_express;
                    $data = $pqArray[$i];  
                    $tlist->from_time=$data;
                    $tlist->to_time = $wArray[$i];
                    $tlist->delivery_price = $mArray[$i];
                    $tlist->express_time = '';
                    $tlist->save();
                            
         
                }
            }else{

                  $mark_ids = explode(',',$mid);
                  $express_time_ids = explode(',',$eid);

                  foreach($mark_ids as $data5){
                        $mids[]=$data5;
                  }
                  foreach($express_time_ids as $data6){
                        $eids[]=$data6;
                  }
          
                            $mArray = $mids;
                $totalmarks = count($mArray);
                                $eArray = $eids;
                $totalexpresstime = count($eArray);
                for($i=0; $i<$totalmarks; $i++) {
                   
                    $tlist= new PincodeDeliveryTime();
                    $tlist->admin_auto_id = $request->get('admin_auto_id');
                    $tlist->pincode = $pin;
                    $tlist->normal_or_express = $normal_or_express;
                    $data = $mArray[$i];  
                    $tlist->from_time='';
                    $tlist->to_time = '';
                    $tlist->delivery_price = $data;
                    $tlist->express_time = $eArray[$i];
                    $tlist->save();
                            
         
                }
            }
        }
                       return response()->json([
                                    'status' => "1", 
                                    'msg' => "Sucessfully Added"
                       ]);
         
    
    
  }    
    public function edit_pincode_deliverytime(Request $request){
 
           $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $pincodes_dtime = PincodeDeliveryTime::where('_id','=', $request->get('pincode_dtime_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
             }else{
        $pincodes_dtime = PincodeDeliveryTime::where('_id','=', $request->get('pincode_dtime_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
             }
        if(empty($pincodes_dtime)){
            return response()->json(['status' => 0, "msg" => "No pincode Found"]);
        }
        else{
               
              $pincodes = PincodeDeliveryTime::find($request->get('pincode_dtime_auto_id'));
                if($request->get('pincode')!=''){
                            $pincodes->pincode = $request->get('pincode');
                }
    
                if($request->get('normal_or_express')!=''){
                            $pincodes->normal_or_express = $request->get('normal_or_express');
                }

                  if($request->get('from_time')!=''){
                            $pincodes->from_time = $request->get('from_time');
                }

                if($request->get('to_time')!=''){
                    $pincodes->to_time = $request->get('to_time');
                }

                if($request->get('delivery_price')!=''){
                   $pincodes->delivery_price = $request->get('delivery_price');
                }
                 if($request->get('express_time')!=''){
                   $pincodes->express_time = $request->get('express_time');
                }
              
           
                $pincodes->save();
                   return response()->json([
                        'status' => "1", 
                        'msg' => "Sucessfully Updated"
                                        
                    ]);
        }
}

    public function get_pincode_deliverytime(Request $request) {
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
             $get_pincode_list = PincodeDeliveryTime::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
          $get_pincode_list = PincodeDeliveryTime::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
        }
    if($get_pincode_list->isNotEmpty()){
      return response()->json(['status' => 1, "msg" => "success", 'get_pincode_list' => $get_pincode_list]);
    } else {
      return response()->json(['status' => 0, "msg" => "No Data Available"]);
    }
  }
  
  
  
  public function delete_pincode_deliverytime(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $cdetails = PincodeDeliveryTime::where('_id','=', $request->get('pincode_dtime_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
      }else{
        $cdetails = PincodeDeliveryTime::where('_id','=', $request->get('pincode_dtime_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
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
         
      //add_pincode_delivery_setting
         public function add_pincode_delivery_setting(Request $request){
       
           $appuistyle = PincodeDeliverySetting::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    
            if($appuistyle->isNotEmpty()){

            $pincode = PincodeDeliverySetting::find($request->get('id'));
              if($request->get('admin_auto_id')!=''){
                           $pincode->admin_auto_id = $request->get('admin_auto_id');
                }else{
                            $pincode->admin_auto_id ="";
                } 
                
                if($request->get('delivery_type')!=''){
                   $pincode->delivery_type = $request->get('delivery_type');
                }else{
                    $pincode->delivery_type ="";
                }     
 
            $pincode->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
        }else{
    
            $pinsetting = new PincodeDeliverySetting();
                if($request->get('admin_auto_id')!=''){
                           $pinsetting->admin_auto_id = $request->get('admin_auto_id');
                }else{
                            $pinsetting->admin_auto_id ="";
                } 
                
                if($request->get('delivery_type')!=''){
                   $pinsetting->delivery_type = $request->get('delivery_type');
                }else{
                    $pinsetting->delivery_type ="";
                }    

            $pinsetting->save();

             return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

        }

    }
    // get pincode delivery setting
    public function get_pincode_delivery_setting(Request $request){
               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
           if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
        }else{
            $erase_data_status='No';
            }
        if($erase_data_status =='Yes'){
        $appui = PincodeDeliverySetting::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
     }else{
        $appui = PincodeDeliverySetting::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
     }
        if($appui->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'msg' => "Success",
                'data' => $appui,
            ]);
        }
    }
     //filter products
     public function get_new_filter_products(Request $request){
             $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        $conditions = array();
                                           


                             if($esatatus->isNotEmpty()){
                                foreach($esatatus as $erase){
                                     $erase_data_status=$erase->erase_data_status;
                                }
                             }else{
                                 $erase_data_status='No';
                             }
                        if($erase_data_status =='Yes'){

                               $country_user = UserRegister::where('_id','=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                   if($country_user->isNotEmpty()){
                               foreach($country_user as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                 $country_users = EcommRegistration::where('_id','=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                  if($country_users->isNotEmpty()){
                               foreach($country_users as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                           $country_code = '';
                                      }
                             
                                }
                                }else{
                                 $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('_id','=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                 if($country_user->isNotEmpty()){
                               foreach($country_user as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                 $country_users = EcommRegistration::where('_id','=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                  if($country_users->isNotEmpty()){
                               foreach($country_users as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                           $country_code = '';
                                      }
                             
                                }
                                }
                                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                         if($esatatus->isNotEmpty()){
                                            foreach($esatatus as $erase){
                                                 $erase_data_status=$erase->erase_data_status;
                                            }
                                         }else{
                                             $erase_data_status='No';
                                         }
                                    if($erase_data_status =='Yes'){
                                        $currency_user = Currency::where('country_code','=', $country_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                  }else{
                                       $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('country_code','=', $country_code)->whereNull('deleted_at')->get();

                                  }
                                if($currency_user->isNotEmpty()){
                                foreach($currency_user as $cuid)
                                      {
                                              $country_code_id = $cuid->id;
                                              $currency = $cuid->currency;
                                      }
                                }else{
                                    $country_code_id = '';
                                    $currency = '';
                                }
                                               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     if($esatatus->isNotEmpty()){
                                        foreach($esatatus as $erase){
                                              $erase_data_status=$erase->erase_data_status;
                                        }
                                     }else{
                                         $erase_data_status='No';
                                     }
                                if($erase_data_status =='Yes'){
                               $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id','=', $country_code_id)->whereNull('deleted_at')->get();
                                 }else{
                                 $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '')->where('currency_auto_id','=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                 }
                                if($currency_price_detailss->isNotEmpty()){
                                foreach($currency_price_detailss as $cuidss)
                                      {
                                           $product_auto_id=$cuidss->product_auto_id;

         if($request->get('egg_eggless') != "")
         {
           $egg_eggless = $request->get('egg_eggless');
            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
     
            array_push($conditions, array('field'=>'egg_eggless', 'value'=>$egg_eggless, 'condition'=>'where'));
       
        }else{
            array_push($conditions, array('field'=>'egg_eggless', 'value'=>$egg_eggless, 'condition'=>'orwhereIn'));

         }
     }
         if($request->get('veg_nonveg') != "")
         {
           $veg_nonveg = $request->get('veg_nonveg');
            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
 
       
            array_push($conditions, array('field'=>'veg_nonveg', 'value'=>$veg_nonveg, 'condition'=>'where'));

       
                }else{
            array_push($conditions, array('field'=>'veg_nonveg', 'value'=>$veg_nonveg, 'condition'=>'orwhereIn'));


         }
     }


               $limits = (int)$request->get('limit');
               $page_number = (int)$request->get('page_number');
     $i=0;
$total_custs_count = AdminProducts::where(function($q) use ($conditions){
    foreach($conditions as $key){
         if ($key['condition'] == "whereIn")
         {
             $q->whereIn($key['field'], $key['value']);

         }else if ($key['condition'] == "orwhereIn")
         {
             $i++;
              if ($i ==1 )
              {
            $q->whereIn($key['field'], $key['value'])->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218");

              }else
              {
                    $q->whereIn($key['field'], $key['value']);

              }
             
         }
    else if ($key['condition'] == ">where")
         {
                   $q->where($key['field'], ">=", strval($key['value']));
              
             
         }else if ($key['condition'] == ">orwhere")
         {
           
                    $q->where($key['field'],">=", strval($key['value']));
    
             
         }
     else
         {
                $q->where($key['field'], "=", $key['value']);
         }
    }
})->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();

           $total_page = $total_custs_count / $limits;
                        if ($total_page < 1) {
                            $total_pagess = 1;
                        }elseif(is_float($total_page)){
                            $total_pagess = $total_page+1;
                        } else {
                            $total_pagess = $total_page;
                        }

                        $total_pages = round($total_pagess);
                        $curent_page = $page_number;
                        if ($total_page < 1) {
                            $next_page = 0;
                        } else {
                            $next_page = $page_number + 1;
                        }
                        $previous_page = $page_number - 1;

                        if ($total_page < 1) {
                            $offsetss = 0;
                        } else {
                            if ($curent_page <= 1) {
                                $offsetss = 0;
                            } else {
                                $offset = ($page_number - 1) * $limits;
                                $offsetss = (int)$offset;
                            }
                        }

         $i=0;
$scats = AdminProducts::where(function($q) use ($conditions){
    foreach($conditions as $key){
         if ($key['condition'] == "whereIn")
         {
             $q->whereIn($key['field'], $key['value']);

         }else if ($key['condition'] == "orwhereIn")
         {
             $i++;
              if ($i ==1 )
              {
            $q->whereIn($key['field'], $key['value'])->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218");

              }else
              {
                    $q->whereIn($key['field'], $key['value']);

              }
             
         }
    else if ($key['condition'] == ">where")
         {
                   $q->where($key['field'], ">=", strval($key['value']));
              
             
         }else if ($key['condition'] == ">orwhere")
         {
           
                    $q->where($key['field'],">=", strval($key['value']));
    
             
         }
     else
         {
                $q->where($key['field'], "=", $key['value']);
         }
    }
})->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
        if($scats->isEmpty()){

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        }
        else{
            foreach($scats as $urs){
                                $product_auto_id=$urs->_id;
                                $product_auto_ids=$urs->product_auto_id;
                                $product_model_auto_id=$urs->product_model_auto_id;
                                $color_image=$urs->color_image;
                                $color_name=$urs->color_name;
                                          $size=$urs->size;
                                     $size_ids = explode('|',$size);
                                         unset($get_slists);
                                         if($size != ""){
                                      foreach($size_ids as $sz){
                                    $esatatus = Admin::where('_id','=', $request->admin_auto_id)->get();
                                 if($esatatus->isNotEmpty()){
                                    foreach($esatatus as $erase){
                                         $erase_data_status=$erase->erase_data_status;
                                    }
                                 }else{
                                     $erase_data_status='No';
                                 }
                                    if($erase_data_status =='Yes'){
 
                                      $sizelist = SizeLists::where('_id','=', $sz)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     }else{
                                     $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('_id','=', $sz)->whereNull('deleted_at')->get();

                                     }
                                        if($sizelist->isNotEmpty())
                                        {
                                      foreach($sizelist as $sub)
                                      {
                                          $get_slists[] = array("size_auto_id"=>$sub->_id,"size_name"=>$sub->size);
                                      }
                                    }else{
                                        $get_slists = array();
                                         
                                    }
                                }
                                         }else{
                                        $get_slists = array();
                                         
                                    }
                               
                               
                               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                 if($esatatus->isNotEmpty()){
                                    foreach($esatatus as $erase){
                                         $erase_data_status=$erase->erase_data_status;
                                    }
                                 }else{
                                     $erase_data_status='No';
                                 }
                            if($erase_data_status =='Yes'){

                               $country_user = UserRegister::where('_id','=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                   if($country_user->isNotEmpty()){
                               foreach($country_user as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                 $country_users = EcommRegistration::where('_id','=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                  if($country_users->isNotEmpty()){
                               foreach($country_users as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                           $country_code = '';
                                      }
                             
                                }
                                }else{
                                 $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('_id','=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                 if($country_user->isNotEmpty()){
                               foreach($country_user as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                 $country_users = EcommRegistration::where('_id','=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                  if($country_users->isNotEmpty()){
                               foreach($country_users as $cuid)
                                      {
                                              $country_code = $cuid->country_code;
                                      }
                                }else{
                                           $country_code = '';
                                      }
                             
                                }
                                }
                                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                 if($esatatus->isNotEmpty()){
                                    foreach($esatatus as $erase){
                                         $erase_data_status=$erase->erase_data_status;
                                    }
                                 }else{
                                     $erase_data_status='No';
                                 }
                            if($erase_data_status =='Yes'){

                                $currency_user = Currency::where('country_code','=', $country_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                }else{
                                $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('country_code','=', $country_code)->whereNull('deleted_at')->get();
                                }
                                if($currency_user->isNotEmpty()){
                                foreach($currency_user as $cuid)
                                      {
                                              $country_code_id = $cuid->id;
                                              $currency = $cuid->currency;
                                      }
                                }else{
                                    $country_code_id = '';
                                    $currency = '';
                                }
                                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     if($esatatus->isNotEmpty()){
                                        foreach($esatatus as $erase){
                                             $erase_data_status=$erase->erase_data_status;
                                        }
                                     }else{
                                         $erase_data_status='No';
                                     }
                                if($erase_data_status =='Yes'){

                                     $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id','=', $country_code_id)->where('product_auto_id','=', $product_auto_id)->whereNull('deleted_at')->get();
                                    }else{
                                     $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('currency_auto_id','=', $country_code_id)->where('product_auto_id','=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                    }
                                if($currency_price_details->isNotEmpty()){
                                foreach($currency_price_details as $cuid)
                                      {
                                        $product_price = $cuid->product_price;
                                        $offer_percentage = $cuid->offer_percentage;
                                        $size_price = $cuid->size_price;
                                        $including_tax = $cuid->including_tax;
                                        $tax_percentage = $cuid->tax_percentage;
                                        $final_pprices = $cuid->final_price;
                                        $offer_auto_id=$cuid->offer_auto_id;
                                             
                                             
                                      }
                                }else{
                                       $product_price = '';
                                        $offer_percentage = '';
                                        $size_price = '';
                                        $including_tax = '';
                                        $tax_percentage = '';
                                        $final_pprices = '';
                                        $offer_auto_id = '';
                                }
                             
                                 $product_name=$urs->product_name;
                                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     if($esatatus->isNotEmpty()){
                                        foreach($esatatus as $erase){
                                             $erase_data_status=$erase->erase_data_status;
                                        }
                                     }else{
                                         $erase_data_status='No';
                                     }
                                if($erase_data_status =='Yes'){

                                $get_details = AdminProducts::where('product_model_auto_id','=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name','=', $product_name)->whereNull('deleted_at')->get();
                                                                     }else{
                                $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('product_model_auto_id','=', $product_model_auto_id)->where('product_name','=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                                                     }
                                foreach($get_details as $dtls){
                                $main_category_auto_id=$dtls->main_category_auto_id;
                                $sub_category_auto_id=$dtls->sub_category_auto_id;
                                $user_auto_id=$dtls->user_auto_id;
                                $added_by=$dtls->added_by;
                                $product_dimensions=$dtls->product_dimensions;
                                $product_name=$dtls->product_name;
                                $highlights=$dtls->highlights;
                                $description=$dtls->description;
                                $brand_auto_id=$dtls->brand_auto_id;
                                $new_arrival=$dtls->new_arrival;
                                $moq=$dtls->moq;
                                $gross_wt=$dtls->gross_wt;
                                $net_wt=$dtls->net_wt;
                                $unit=$dtls->unit;
                                $quantity=$dtls->quantity;
                                $weight=$dtls->weight;
                                $product_model_auto_id = $dtls->product_model_auto_id;
                                $time=$dtls->time;
                                $time_unit=$dtls->time_unit;
                                $use_by=$dtls->use_by;
                                $closure_type =$dtls->closure_type;
                                $fabric =$dtls->fabric;
                                $sole = $dtls->sole;
                                $veg_nonveg=$dtls->veg_nonveg;
                                $egg_eggless =$dtls->egg_eggless;
                                $Customizable =$dtls->Customizable;


                                        }
                             
                                       
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
                                      $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('_id','=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                      }
                                        if($offerlist->isNotEmpty())
                                        {
                                      foreach($offerlist as $off)
                                      {
                                          $get_olists[] = array("offer_auto_id"=>$off->_id,"homecomponent_auto_id"=>$off->homecomponent_auto_id,"component_image"=>$off->component_image,"main_category"=>$off->main_category,
                                          "subcategory"=>$off->subcategory,"brand"=>$off->brand,"price"=>$off->price,"offer"=>$off->offer,"rdate"=>$off->rdate);
                                          $offercompprice=$off->price;
                                          $offercompper=$off->offer;
                                      }
                                    }else{
                                        $get_olists = array();
                                         $offercompprice=0;
                                         $offercompper=0;
                                         
                                    }
                                }
                                       
                            unset($get_plists);
                            $prepration_ids = explode('|',$size_price);
                           
                            if($offercompper != ''){
                            if($size_price != ''){
                            foreach($prepration_ids as $data1){
                             $offer_price = ($data1 * $offercompper)/100;
                             $final_price = $data1 - $offer_price;
                             $get_plists[] = array("size_price"=>$data1,"offer_percentage"=>$offercompper,"final_size_price"=>strval($final_price));
                       
                            }
                            }else{
                                $get_plists = array();
                            }  
                            }
                            elseif($offercompprice !=''){
                            if($size_price != ''){
                            foreach($prepration_ids as $data1){
                             $final_price = $data1 - $offercompprice;
                             $get_plists[] = array("size_price"=>$data1,"offer_price_off"=>$offercompprice,"final_size_price"=>strval($final_price));
                       
                            }
                            }else{
                                $get_plists = array();
                            }  
                            }else{
                            if($size_price != ''){
                            foreach($prepration_ids as $data1){
                             $offer_price = ($data1 * $offer_percentage)/100;
                             $final_price = $data1 - $offer_price;
                             $get_plists[] = array("size_price"=>$data1,"offer_percentage"=>$offer_percentage,"final_size_price"=>strval($final_price));
                       
                            }
                            }else{
                                $get_plists = array();
                            }
                            }
                            unset($image_lists);
                            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                             if($esatatus->isNotEmpty()){
                                foreach($esatatus as $erase){
                                     $erase_data_status=$erase->erase_data_status;
                                }
                             }else{
                                 $erase_data_status='No';
                             }
                        if($erase_data_status =='Yes'){

                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id','=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }else{
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('product_auto_id','=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }
                            if($pimage_details->isNotEmpty()){
                            foreach($pimage_details as $pidata){
                                $image_lists[] = array("image_auto_id"=>$pidata->_id,"product_image"=>$pidata->image_file);

                            }
                            }else{
                                $image_lists = array();
                            }
                            //rating review
                           $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                             if($esatatus->isNotEmpty()){
                                foreach($esatatus as $erase){
                                     $erase_data_status=$erase->erase_data_status;
                                }
                             }else{
                                 $erase_data_status='No';
                             }
                        if($erase_data_status =='Yes'){

                             $courseRatingReview = ProductRatingReview::Where('product_auto_id',$product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                             $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                            }else{
                             $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->Where('product_auto_id',$product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                             $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->Where('product_auto_id',$product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                            }
                             $avg_rating=0;
                                if($courseRatingReview->isNotEmpty()){
                                foreach($courseRatingReview as  $data){
                                    $total_rating = $data->rating;
                                $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                 if($esatatus->isNotEmpty()){
                                    foreach($esatatus as $erase){
                                         $erase_data_status=$erase->erase_data_status;
                                    }
                                 }else{
                                     $erase_data_status='No';
                                 }
                            if($erase_data_status =='Yes'){

                                   $total_student = UserRegister::Where('_id',$data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                                   }else{
                                   $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->Where('_id',$data->customer_auto_id)->whereNull('deleted_at')->count();
                                   }
                             
                                    $avg_rating = ($total_student*$total_rating/$total_student);
                               }
                            }else{
                                $courseRatingReview = array();
                            }

                   $sscats[] = array("product_auto_id"=>$product_auto_id,"main_category_auto_id"=>$main_category_auto_id,"sub_category_auto_id"=>$sub_category_auto_id,"user_auto_id"=>$user_auto_id,"added_by"=>$added_by,
                  "product_dimensions"=>$product_dimensions,"product_name"=>$product_name,"highlights"=>$highlights,"description"=>$description,"product_model_auto_id"=>$product_model_auto_id,"veg_nonveg"=>$veg_nonveg,"egg_eggless"=>$egg_eggless,"Customizable"=>$Customizable,
          "brand_auto_id"=>$brand_auto_id,"new_arrival"=>$new_arrival,"moq"=>$moq,"gross_wt"=>$gross_wt,"time"=>$time,"time_unit"=>$time_unit,"use_by"=>$use_by,"closure_type"=>$closure_type,"fabric"=>$fabric,"sole"=>$sole,"currency"=>$currency,
                  "net_wt"=>$net_wt,"unit"=>$unit,"quantity"=>$quantity,"weight"=>$weight,"product_price"=>$product_price,"offer_percentage"=>$offer_percentage,"including_tax"=>$including_tax,"tax_percentage"=>$tax_percentage,"final_product_price"=>$final_pprices,
                  "color_image"=>$color_image,"color_name"=>$color_name,"total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating,"product_images"=>$image_lists,"size"=>$get_slists,"offer_data"=>$get_olists,"get_price_lists"=>$get_plists);
                                    
              }
               

             return response()->json([
                "status" => 1,
                "total_custs_count" => $total_custs_count,
                "total_pages" => $total_pages,
                "curent_page" => $curent_page,
                "next_page" => $next_page,
                "previous_page" => $previous_page,
                "get_admin_filter_product_lists" => $sscats,
            ]);    
        }
      }
                                 
        }else {
       
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
       
        }
    }


}