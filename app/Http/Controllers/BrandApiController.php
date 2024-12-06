<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Admin;
use DateTimeZone;
use DateTime;
use DB;

class BrandApiController extends Controller
{
      

	public function add_brand(Request $request) {
	   
	    $Brand = new Brand();
	      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
		$checkBrand = Brand::where('brand_name', $request->brand_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
	     }else{
		$checkBrand = Brand::where('brand_name', $request->brand_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
	     }
     		if ($checkBrand) {
            return response()->json([
                'status' => '0', 
                'msg' => 'This Brand already exists..!',
            ]);
		
		}  else {
		    	
            	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
     			$rdate =  $date->format('Y-m-d');
                    if($request->get('admin_auto_id')!='')
                        {
                                    $Brand->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $Brand->admin_auto_id ="";
                        }
                        if($request->get('app_type_id')!='')
                            {
                                $Brand->app_type_id = $request->get('app_type_id');
                            }else
                            {
                                $Brand->app_type_id ="";
                            }
     		
                $Brand->brand_name = $request->get('brand_name');
                
                   if (!empty($request->file('brand_image_app'))) {
            $file = $request->file('brand_image_app');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/brands');
            $file->move($path, $filename);
            $Brand->brand_image_app = $filename;
        }
        else
        {
             $Brand->brand_image_app = "";
        }
        
       
        if (!empty($request->file('brand_image_web'))) {
            $file1 = $request->file('brand_image_web');
            $filename1 = $file1->getClientOriginalName();
            $path = public_path('images/brands');
            $file1->move($path, $filename1);
             $Brand->brand_image_web = $filename1;
        }
        else
        {
            $Brand->brand_image_web = "";
        }
       
       if($request->get('main_category_auto_id')!='')
       {
            $Brand->main_category_auto_id= $request->get('main_category_auto_id');
       }
       else
       {
            $Brand->main_category_auto_id= "";
       }
       
                $Brand->register_date = date('Y-m-d');
                $Brand->save();
                   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
              $cat = $Brand::where('brand_name', $request->brand_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                   }else{
                         $cat = $Brand::where('brand_name', $request->brand_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                   }
if(!empty($cat))
{
     return response()->json([
                    'status' => "1", 
                    'data' => [$cat]
                    
                ]);
}
else
{
     return response()->json([
                    'status' => "0", 
                    'data' => "No Data Available"
                    
                ]);
}
               
		
		}
	}
    
    
    
    	//Edit Brand
	
    public function edit_brand(Request $request){
        $main = Brand::find($request->get('brand_auto_id'));
        if(empty($main)){
            return response()->json(['status' => 0, "msg" => "No Brand Found"]);
        }
        else{
            $main->brand_name = $request->get('brand_name');
           
        if (!empty($request->file('brand_image_app'))) {
            $file = $request->file('brand_image_app');
            $filename = $file->getClientOriginalName();
           $path = public_path('images/brands');
            $file->move($path, $filename);
            $main->brand_image_app = $filename;
        }
            if (!empty($request->file('brand_image_web'))) {
            $file1 = $request->file('brand_image_web');
            $filename1 = $file1->getClientOriginalName();
            $path = public_path('images/brands');
            $file1->move($path, $filename1);
            $main->brand_image_web = $filename1;
        }
          
           if($request->get('main_category_auto_id')!='')
       {
            $main->main_category_auto_id= $request->get('main_category_auto_id');
       }
       else
       {
            $main->main_category_auto_id= "";
       }
          
            $main->save();         
               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
                         $cat = Brand::where('_id', $request->brand_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
              }else{
                         $cat = Brand::where('_id', $request->brand_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

              }
if(!empty($cat))
{
     return response()->json([
                    'status' => "1", 
                    'data' => [$cat]
                    
                ]);
}
else
{
     return response()->json([
                    'status' => "0", 
                    'data' => "No Data Available"
                    
                ]);
}
     
            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    
    //Brand List
    public function get_brand_list(Request $request) {
  $esatatus = Admin::where('_id','=', $request->admin_auto_id)->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
 $get_brandslist = Brand::ORDERBY('_id','ASC')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
 }else{
      $get_brandslist = Brand::ORDERBY('_id','ASC')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

 }
		if($get_brandslist->isNotEmpty()){
			return response()->json(['status' => 1, "msg" => "success", 'get_brandslist' => $get_brandslist]);
		} else {
			return response()->json(['status' => 0, "msg" => "No Data Available"]);
		}
	}
	
	
	
		//Delete Brand
	public function delete_brand(Request $request){
	   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $tdetails = Brand::where('_id','=', $request->get('brand_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
	    }else{
        $tdetails = Brand::where('_id','=', $request->get('brand_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
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

                'msg' => "Something went wrong"

            ]);
        }
   }
   
   
   public function get_main_category_brands(Request $request) {
        	    
        	  $main_category_auto_id=$request->main_category_auto_id;   
        	   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
              $get = Brand::where('main_category_auto_id', 'LIKE', '%'.$main_category_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();


            }else{
              $get = Brand::where('main_category_auto_id', 'LIKE', '%'.$main_category_auto_id.'%')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
                

          
  if($get->isNotEmpty()){
 			return response()->json(['status' => '1', "msg" => "success", 'get_main_category_components' => $get]);
 		} else {
 			return response()->json(['status' => '0', "msg" => "No Data Available"]);
 		}
    

}
   
    
    
    
    
}