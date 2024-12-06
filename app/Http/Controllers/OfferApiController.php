<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfferComponent;
use App\WishlistProducts;
use App\CartProducts;
use App\ECharges;
use App\HomeProductComponent;
use App\AdminProducts;
use App\SizeLists;
use App\AdminProductImages;
use App\ProductRatingReview;
use App\UserRegister;
use App\Admin;
use DateTimeZone;
use DateTime;
use DB;

class OfferApiController extends Controller
{
       

    public function add_offer_image(Request $request) {
       
        $offer = new OfferComponent();
        // $checkBrand = OfferComponent::where('brand_name', $request->brand_name)->whereNull('deleted_at')->first();
  //            if ($checkBrand) {
  //           return response()->json([
  //               'status' => '0', 
  //               'msg' => 'This Brand already exists..!',
  //           ]);
        
        // }  else {
                
                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');
                        if($request->get('admin_auto_id')!='')
                        {
                                    $offer->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $offer->admin_auto_id ="";
                        }     
                         if($request->get('app_type_id')!='')
                        {
                                    $offer->app_type_id = $request->get('app_type_id');
                        }else
                        {
                            $offer->app_type_id ="";
                        }     
            
               if($request->get('homecomponent_auto_id')!='')
                {
                            $offer->homecomponent_auto_id = $request->get('homecomponent_auto_id');
                }else
                {
                    $offer->homecomponent_auto_id ="";
                }
                
               if (!empty($request->file('component_image'))) {
                    $file = $request->file('component_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/offers');
                    $file->move($path, $filename);
                    $offer->component_image = $filename;
                }
                else
                {
                     $offer->component_image = "";
                }
       
       
                   if($request->get('main_category')!='')
                   {
                        $offer->main_category= $request->get('main_category');
                        
                   }
                   else
                   {
                        $offer->main_category= "";
                   }
                     if($request->get('subcategory')!='')
                   {
                        $offer->subcategory= $request->get('subcategory');
                   }
                   else
                   {
                        $offer->subcategory= "";
                   }
                     if($request->get('brand')!='')
                   {
                        $offer->brand= $request->get('brand');
                   }
                   else
                   {
                        $offer->brand= "";
                   }
                     if($request->get('product_auto_id')!='')
                   {
                        $offer->product_auto_id= $request->get('product_auto_id');
                   }
                   else
                   {
                        $offer->product_auto_id= "";
                   }
                    if($request->get('price')!='')
                   {
                        $offer->price= $request->get('price');
                   }
                   else
                   {
                        $offer->price= "";
                   }
                    if($request->get('offer')!='')
                   {
                        $offer->offer= $request->get('offer');
                   }
                   else
                   {
                        $offer->offer= "";
                   }
       
                $offer->rdate = date('Y-m-d');
                if($offer->save())
                    {
                        $offer_auto_id = $offer->_id;
                              if($request->get('main_category')!='')
                                {
                          $main_category=$request->get('main_category');
                            $size_ids = explode('|',$main_category);
                             unset($get_slists);
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
              $checkproduct = AdminProducts::where('main_category_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                 if($checkproduct->isNotEmpty()){
                    foreach($checkproduct as $urs){

                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                    }
                }
        }else{

             $checkproduct = AdminProducts::where('main_category_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                 if($checkproduct->isNotEmpty()){
                    foreach($checkproduct as $urs){

                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                    }
                }

       }
                            }
                                }
                                if($request->get('subcategory')!='')
                                {
                                  $subcategory=$request->get('subcategory');
                                    $size_ids = explode('|',$subcategory);
                                     unset($get_slists);
                                    foreach($size_ids as $sz){
                                      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     if($esatatus->isNotEmpty()){
                                        foreach($esatatus as $erase){
                                             $erase_data_status=$erase->erase_data_status;
                                        }
                                     }else{
                                         $erase_data_status='No';
                                     }
                                if($erase_data_status =='Yes'){
                                       
                                $checkproduct = AdminProducts::where('sub_category_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
                                }else{
                                      
                                $checkproduct = AdminProducts::where('sub_category_auto_id','=', $sz)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
  
                                }
                                    }
                                }

                                 if($request->get('brand')!='')
                                {
                                  $brand=$request->get('brand');
                                    $size_ids = explode('|',$brand);
                                     unset($get_slists);
                                    foreach($size_ids as $sz){
                                        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->whereNull('deleted_at')->get();
                                 if($esatatus->isNotEmpty()){
                                                foreach($esatatus as $erase){
                                                      $erase_data_status=$erase->erase_data_status;
                                                }
                                 }else{
                                     $erase_data_status='No';
                                 }
                                 if($erase_data_status =='Yes'){
                                     

                                $checkproduct = AdminProducts::where('brand_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
                                 }else{
                                     
                                $checkproduct = AdminProducts::where('brand_auto_id','=', $sz)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
                                 }
                                    }
                                }
                                if($request->get('product_auto_id')!='')
                                {
                                  $product_auto_id=$request->get('product_auto_id');
                                    $size_ids = explode('|',$product_auto_id);
                                     unset($get_slists);
                                    foreach($size_ids as $sz){
                                         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                  if($esatatus->isNotEmpty()){
                                                   foreach($esatatus as $erase){
                                                       $erase_data_status=$erase->erase_data_status;
                                                   }
                                }else{
                                          $erase_data_status='No';
                                 }
                               if($erase_data_status =='Yes'){
                                        DB::table('country_product_price')->where('product_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                         }else{
                                         DB::table('country_product_price')->where('product_auto_id','=', $sz)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['offer_auto_id' => $offer_auto_id]);

                                         }
                                    }
                                }
                   }
               return response()->json([
                    'status' => "1", 
                    'data' => $offer
                    
                ]);

        
        // }
    }
    
    
    
        //Edit Brand
    
    public function edit_offer_image(Request $request){
        $main = OfferComponent::find($request->get('image_auto_id'));
        if(empty($main)){
            return response()->json(['status' => 0, "msg" => "No Offer Found"]);
        }
        else{
                if($request->get('homecomponent_auto_id')!='')
                {
                            $main->homecomponent_auto_id = $request->get('homecomponent_auto_id');
                }else
                {
                    $main->homecomponent_auto_id ="";
                }
                
     
                         if (!empty($request->file('component_image'))) {
                            $file = $request->file('component_image');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/offers');
                            $file->move($path, $filename);
                            $main->component_image = $filename;
                        }
                   if($request->get('main_category')!='')
                   {
                        $main->main_category= $request->get('main_category');
                   }
                   else
                   {
                        $main->main_category= "";
                   }
                     if($request->get('subcategory')!='')
                   {
                        $main->subcategory= $request->get('subcategory');
                   }
                   else
                   {
                        $main->subcategory= "";
                   }
                     if($request->get('brand')!='')
                   {
                        $main->brand= $request->get('brand');
                   }
                   else
                   {
                        $main->brand= "";
                   }
                     if($request->get('product_auto_id')!='')
                   {
                        $main->product_auto_id= $request->get('product_auto_id');
                   }
                   else
                   {
                        $main->product_auto_id= "";
                   }
                    if($request->get('price')!='')
                   {
                        $main->price= $request->get('price');
                   }
                   else
                   {
                        $main->price= "";
                   }
                    if($request->get('offer')!='')
                   {
                        $main->offer= $request->get('offer');
                   }
                   else
                   {
                        $main->offer= "";
                   }
                    if($main->save())
                    {
                        $offer_auto_id = $main->_id;
                              if($request->get('main_category')!='')
                                {
                          $main_category=$request->get('main_category');
                            $size_ids = explode('|',$main_category);
                             unset($get_slists);
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
              $checkproduct = AdminProducts::where('main_category_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                 if($checkproduct->isNotEmpty()){
                    foreach($checkproduct as $urs){
                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                    }
                }
        }else{

             $checkproduct = AdminProducts::where('main_category_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                 if($checkproduct->isNotEmpty()){
                    foreach($checkproduct as $urs){
                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                    }
                }

       }
                            }
                                }
                                if($request->get('subcategory')!='')
                                {
                                  $subcategory=$request->get('subcategory');
                                    $size_ids = explode('|',$subcategory);
                                     unset($get_slists);
                                    foreach($size_ids as $sz){
                                      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     if($esatatus->isNotEmpty()){
                                        foreach($esatatus as $erase){
                                             $erase_data_status=$erase->erase_data_status;
                                        }
                                     }else{
                                         $erase_data_status='No';
                                     }
                                if($erase_data_status =='Yes'){
                                       
                                $checkproduct = AdminProducts::where('sub_category_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
                                }else{
                                      
                                $checkproduct = AdminProducts::where('sub_category_auto_id','=', $sz)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
  
                                }
                                    }
                                }

                                 if($request->get('brand')!='')
                                {
                                  $brand=$request->get('brand');
                                    $size_ids = explode('|',$brand);
                                     unset($get_slists);
                                    foreach($size_ids as $sz){
                                        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->whereNull('deleted_at')->get();
                                 if($esatatus->isNotEmpty()){
                                                foreach($esatatus as $erase){
                                                      $erase_data_status=$erase->erase_data_status;
                                                }
                                 }else{
                                     $erase_data_status='No';
                                 }
                                 if($erase_data_status =='Yes'){
                                     

                                $checkproduct = AdminProducts::where('brand_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
                                 }else{
                                     
                                $checkproduct = AdminProducts::where('brand_auto_id','=', $sz)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                                 if($checkproduct->isNotEmpty()){
                                    foreach($checkproduct as $urs){
                                    DB::table('country_product_price')->where('product_auto_id','=', $urs->_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                    }
                                }
                                 }
                                    }
                                }
                                if($request->get('product_auto_id')!='')
                                {
                                  $product_auto_id=$request->get('product_auto_id');
                                    $size_ids = explode('|',$product_auto_id);
                                     unset($get_slists);
                                    foreach($size_ids as $sz){
                                    $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                     if($esatatus->isNotEmpty()){
                                        foreach($esatatus as $erase){
                                             $erase_data_status=$erase->erase_data_status;
                                        }
                                     }else{
                                         $erase_data_status='No';
                                     }
                                if($erase_data_status =='Yes'){
                                        DB::table('country_product_price')->where('product_auto_id','=', $sz)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);
                                         }else{
                                        DB::table('country_product_price')->where('app_type_id', $request->app_type_id)->where('product_auto_id','=', $sz)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->update(['offer_auto_id' => $offer_auto_id]);

                                         }
                                    }
                                }
                   }
            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    
  
    
    
        //Delete Offer
    public function delete_offer_image(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $tdetails = OfferComponent::where('_id','=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
      //  $cpdetails = CountryProductPrice::where('offer_auto_id','=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            DB::table('country_product_price')->where('offer_auto_id','=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['offer_auto_id' => '']);

        }else{
        $tdetails = OfferComponent::where('_id','=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
      //  $cpdetails = CountryProductPrice::where('offer_auto_id','=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
          DB::table('country_product_price')->where('offer_auto_id','=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['offer_auto_id' => '']);

        }
            if($tdetails){
            return response()->json([
                'status' => 1, 
                'msg' => "Sucessfully Deleted"
            ]);
           

        }

        else{
           
            return response()->json([

                'status' => 0, 

                'msg' => "Someting went wrong"

            ]);
        }
   }
   

       //Brand List
    public function get_all_offers(Request $request) {
 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
       $get_offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
 }else{
       $get_offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
 }
        if($get_offerlist->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'data' => $get_offerlist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
        public function move_to_wishlist(Request $request) {
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $checkcproduct = CartProducts::where('_id', $request->cart_product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id', $request->product_auto_id)->where('user_auto_id', $request->customer_auto_id)->whereNull('deleted_at')->get();
        }else{
            $checkcproduct = CartProducts::where('_id', $request->cart_product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('product_auto_id', $request->product_auto_id)->where('user_auto_id', $request->customer_auto_id)->whereNull('deleted_at')->get();

        }
            if($checkcproduct->isEmpty()) {
             return response()->json([
                 'status' => '0', 
                 'msg' => 'No Data Available',
             ]);
        
        }  else {

                foreach($checkcproduct as $urs){
                    $product_auto_id=$urs->product_auto_id;
                    $user_auto_id=$urs->user_auto_id;
                }
                $wishlist = new WishlistProducts();

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');
                    if($request->get('admin_auto_id')!='')
                        {
                                    $wishlist->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $wishlist->admin_auto_id ="";
                        }       
                $wishlist->product_auto_id = $product_auto_id;
                $wishlist->user_auto_id= $user_auto_id;
                 
                $wishlist->rdate = date('Y-m-d');
                $wishlist->save();
                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                    $tdetails = CartProducts::where('_id', $request->cart_product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('prouduct_auto_id', $request->prouduct_auto_id)->where('user_auto_id', $request->customer_auto_id)->delete();
}else{
                        $tdetails = CartProducts::where('_id', $request->cart_product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('prouduct_auto_id', $request->prouduct_auto_id)->where('user_auto_id', $request->customer_auto_id)->delete();

}
               return response()->json([
                    'status' => "1", 
                    'msg' => "success",
                    'data' => $wishlist
                    
                ]);

        
        }
    }
    //update express delivery charges
      public function update_express_delivery_details(Request $request){
       
           $tnc = ECharges::get();
            if($tnc->isNotEmpty()){

            $tnc = ECharges::find($request->get('id'));

            $tnc->express_delivery_charges = $request->express_delivery_charges;
       
            $tnc->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
         }else{
       
            $tnc = new ECharges();
          
            $tnc->express_delivery_charges = $request->express_delivery_charges;
                        if($request->get('admin_auto_id')!='')
                        {
                                    $tnc->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $tnc->admin_auto_id ="";
                        }       
            $tnc->save();

             return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

        }

    }
    
       //express details
    public function get_express_delivery_details(Request $request) {
               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
        }else{
             $erase_data_status='No';
        }
        if($erase_data_status =='Yes'){
       $get_elist = ECharges::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
      }else{
       $get_elist = ECharges::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
      }
        if($get_elist->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'data' => $get_elist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
        public function add_home_component_products(Request $request) {
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $checkBrand = HomeProductComponent::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
            }else{
                $checkBrand = HomeProductComponent::where('home_component_auto_id', $request->home_component_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();

            }
            if ($checkBrand) {
                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
            $tnc = HomeProductComponent::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
         }else{
                    $tnc = HomeProductComponent::where('home_component_auto_id', $request->home_component_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();

         }
                    
              if($request->get('home_component_auto_id')!='')
                {
                     $tnc->home_component_auto_id = $request->get('home_component_auto_id');
                }else
                {
                    $tnc->home_component_auto_id ="";
                }
                
                   if($request->get('product_auto_id')!='')
                   {
                        $tnc->product_auto_id= $request->get('product_auto_id');
                   }
                   else
                   {
                        $tnc->product_auto_id= "";
                   }          
            $tnc->save();

            return response()->json([
                'status' => "1", 
                'msg' => "Updated Successfully",
            ]);
        }  else {
        $hproduct = new HomeProductComponent();
                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');

              if($request->get('admin_auto_id')!='')
                        {
                                    $hproduct->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $hproduct->admin_auto_id ="";
                        }       
                        if($request->get('app_type_id')!='')
                        {
                                    $hproduct->app_type_id = $request->get('app_type_id');
                        }else
                        {
                            $hproduct->app_type_id ="";
                        }       
               if($request->get('home_component_auto_id')!='')
                {
                     $hproduct->home_component_auto_id = $request->get('home_component_auto_id');
                }else
                {
                    $hproduct->home_component_auto_id ="";
                }
                
                   if($request->get('product_auto_id')!='')
                   {
                        $hproduct->product_auto_id= $request->get('product_auto_id');
                   }
                   else
                   {
                        $hproduct->product_auto_id= "";
                   }
                    
                $hproduct->rdate = date('Y-m-d');
                $hproduct->save();

               return response()->json([
                    'status' => "1", 
                    'msg' => "success",
                    'data' => $hproduct
                    
                ]);

        
        }
    }
        
       // home component products
     public function get_home_products(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                     $searchlist = HomeProductComponent::where('home_component_auto_id','=',$request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
           }else{
                    $searchlist = HomeProductComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('home_component_auto_id','=',$request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
   
           }
        if($searchlist->isEmpty()){
            return response()->json(['status' => 0, "msg" => "No Data Available"]);

        }
        else{
             foreach($searchlist as $s){
             $product_auto_id=$s->product_auto_id;
                $size_ids = explode('|',$product_auto_id);
                 unset($get_slists);
                foreach($size_ids as $sz){
                  $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $scats = AdminProducts::where('_id','=',$sz)->orwhere('product_auto_id','=',$sz)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }else{
           $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('_id','=',$sz)->orwhere('product_auto_id','=',$sz)->whereNull('deleted_at')->get();

        }
        if($scats->isEmpty()){

            return response()->json([
                'status' => 0, 
                "msg" => "No Data Available"
            ]);
        }
        else{
            foreach($scats as $urs){
                                $product_auto_id=$urs->_id;
                                $product_model_auto_id=$urs->product_model_auto_id;
                                $color_image=$urs->color_image;
                                $color_name=$urs->color_name;
                                $size=$urs->size;
                                 $offer_auto_id=$urs->offer_auto_id;
                                      $size_ids = explode('|',$size);
                                         unset($get_slists);
                                      foreach($size_ids as $sz){
                                      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                                      }
                                    }else{
                                        $get_olists = array();
                                          
                                    }
                                }
                           
                           
                                $size_price=$urs->size_price;
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
                                $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('product_model_auto_id','=', $product_model_auto_id)->where('product_name','=', $product_name)->whereNull('deleted_at')->get();
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
                                $specification=$dtls->specification;
                                $brand_auto_id=$dtls->brand_auto_id;
                                $new_arrival=$dtls->new_arrival;
                                $moq=$dtls->moq;
                                $gross_wt=$dtls->gross_wt;
                                $net_wt=$dtls->net_wt;
                                $unit=$dtls->unit;
                                $quantity=$dtls->quantity;
                                $weight=$dtls->weight;
                                $product_price=$dtls->product_price;
                                $offer_percentage=$dtls->offer_percentage;
                                $final_pprices = $dtls->final_price;
                                $product_model_auto_id = $dtls->product_model_auto_id;
                                  $including_tax = $dtls->including_tax;
                                $tax_percentage = $dtls->tax_percentage;
                                
                                        }
                             
                                       
                            unset($get_plists);
                                 $prepration_ids = explode('|',$size_price);
                                         if(!empty($size_price)){
                            foreach($prepration_ids as $data1){

               
       
                                          $offer_price = ($data1 * $offer_percentage)/100;
                          $final_price = $data1 - $offer_price;
                        $get_plists[] = array("size_price"=>$data1,"offer_percentage"=>$offer_percentage,"final_size_price"=>strval($final_price));
                       
                            }
                            }else{
                                $get_plists = array();
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

                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('product_auto_id','=', $product_auto_id)->orwhere('product_auto_id','=', $product_auto_ids)->whereNull('deleted_at')->get();
                            }else{
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('product_auto_id','=', $product_auto_id)->orwhere('product_auto_id','=', $product_auto_ids)->whereNull('deleted_at')->get();
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

                             $courseRatingReview = ProductRatingReview::Where('product_auto_id',$product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                             $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                            }else{
                             $courseRatingReview = ProductRatingReview::Where('product_auto_id',$product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
                             $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->count();
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
                  "product_dimensions"=>$product_dimensions,"product_name"=>$product_name,"highlights"=>$highlights,"description"=>$description,"product_model_auto_id"=>$product_model_auto_id,
                  "specification"=>$specification,"brand_auto_id"=>$brand_auto_id,"new_arrival"=>$new_arrival,"moq"=>$moq,"gross_wt"=>$gross_wt,
                  "net_wt"=>$net_wt,"unit"=>$unit,"quantity"=>$quantity,"weight"=>$weight,"product_price"=>$product_price,"offer_percentage"=>$offer_percentage,"including_tax"=>$including_tax,"tax_percentage"=>$tax_percentage,"final_product_price"=>$final_pprices,
                  "color_image"=>$color_image,"color_name"=>$color_name,"total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating,"product_images"=>$image_lists,"size"=>$get_slists,"offer_data"=>$get_olists,"get_price_lists"=>$get_plists);
                                      
              }
                
          
        }
        }
             }
          return response()->json([
                'status' => 1, 
                'get_recommended_products_lists' => $sscats,
            ]);
    }
     }
}