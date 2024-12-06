<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminProducts;
use App\Categories;
use App\Subcategories;
use App\Brand;
use App\UserRegister;
use App\Search;
use App\WishlistProducts;
use App\UserDocument;
use App\VendorOrders;
use App\Admin;
use App\ColorsRange;
use App\FilterMenu;
use App\SizeLists;
use DB;


class SearchApiController extends Controller
{
   

	// get list of search
	public function index(Request $request){
	 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
	    $maincategory_details = Categories::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
	 }else{
	   	    $maincategory_details = Categories::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
  
	 }
	    if($maincategory_details->isNotEmpty()){
	    	foreach ($maincategory_details as $mdetails) {
	    		$searchlist[] = array("title" => $mdetails->category_name, "id" => $mdetails->id, "type" => "category");
	    	}
	    }
	    
	   // sub catrgories
	    $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
	    $subcategory_details = Subcategories::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
	    }else{
	        	    $subcategory_details = Subcategories::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

	    }
		if($subcategory_details->isNotEmpty()){
	    	foreach ($subcategory_details as $sdetails) {
	    		$searchlist[] = array("title" => $sdetails->sub_category_name, "id" => $sdetails->id, "type" => "Subcategory");
	    	}
	    }
	   
	   
	   
	  //brands list
		 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
	    $brands = Brand::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
		  }else{
		      	    $brands = Brand::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

		  }
	    if($brands->isNotEmpty()){
	    	foreach ($brands as $cdetails) {
	    		$searchlist[] = array("title" => $cdetails->brand_name, "id" => $cdetails->id, "type" => "Brand");
	    	}
	    }
	    
	    

	    // get product details
			 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
	         $product_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
			  }else{
			      	         $product_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

			  }
	    if($product_details->isNotEmpty()){
	    	foreach ($product_details as $pdetails) {
	    		$searchlist[] = array("title" => $pdetails->product_name,  "id" => $pdetails->id, "type" => "Product");
	    	}
	    }
	    if(empty($searchlist)){
	    	return response()->json([
	            'status' => 0, 
	            'msg' => config('messages.empty'),
	        ]);
	    }
	    else{
	    	return response()->json([
	            'status' => 1, 
	            'msg' => "Success",
	            'allsearchlist' => $searchlist,
	        ]);
	    }
	}
	//insert search
	   public function insert_search(Request $request) {
       
                $search = new Search();
                $search->customer_auto_id = $request->get('customer_auto_id');
                   if($request->get('admin_auto_id')!='')
                        {
                                    $search->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $search->admin_auto_id ="";
                        }  
                        if($request->get('app_type_id')!='')
                            {
                                $search->app_type_id = $request->get('app_type_id');
                            }else
                            {
                                $search->app_type_id ="";
                            }
                 $search->sid = $request->get('id');
                 $search->title = $request->get('title');
                 $search->type = $request->get('type');
                 $search->save();
           

                return response()->json([
                    'status' => 1, 
                    'msg' => config('messages.success'),
                   
                    
                ]);
        
        }
        //repeat like return 
	public function get_return_repeat_like_details(Request $request){
	      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                    $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }

        if($erase_data_status =='Yes'){
	    $wishlist_count = WishlistProducts::where('product_auto_id', $request->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
	    $return_count = VendorOrders::where('order_status', '=','Returned')->where('product_auto_id', $request->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
	    $repeat_count = VendorOrders::where('product_auto_id', $request->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
	}else{
      	    $wishlist_count = WishlistProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('product_auto_id', $request->product_auto_id)->whereNull('deleted_at')->count();
	    $return_count = VendorOrders::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('order_status', '=','Returned')->where('product_auto_id', $request->product_auto_id)->whereNull('deleted_at')->count();
	    $repeat_count = VendorOrders::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('product_auto_id', $request->product_auto_id)->whereNull('deleted_at')->count();
	}
	    	return response()->json([
	            'status' => 1, 
	            'msg' => "Success",
	            'wishlist_count' => $wishlist_count,
	            'return_count' => $return_count,
	            'repeat_count' => $repeat_count,
	        ]);
	}
	       public function add_filter_menu(Request $request){
         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
           $babout = FilterMenu::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
          $babout = FilterMenu::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

        }
         	if($babout->isNotEmpty()){

    		$babout = FilterMenu::find($request->get('id'));
                    if($request->get('admin_auto_id')!='')
                        {
                                    $babout->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $babout->admin_auto_id ="";
                        }       
             
                if($request->get('filter_menu')!='')
                {
                            $babout->filter_menu = $request->get('filter_menu');
                }else
                {
                    $babout->filter_menu ="";
                }          
    		$babout->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
    
    		$babout = new FilterMenu();
           if($request->get('admin_auto_id')!='')
                        {
                                    $babout->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $babout->admin_auto_id ="";
                        }       
             
                if($request->get('filter_menu')!='')
                {
                            $babout->filter_menu = $request->get('filter_menu');
                }else
                {
                    $babout->filter_menu ="";
                }    

    		$babout->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
	
		// get list of search
	public function get_filter_menu(Request $request){
	   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
	    $maincategory_details = FilterMenu::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
	   }else{
	       	    $maincategory_details = FilterMenu::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();

	   }
	    if($maincategory_details->isNotEmpty()){
	    	foreach ($maincategory_details as $mdetails) {
	    	      $filter_menu=$mdetails->filter_menu;
	    	       $filter_auto_id=$mdetails->_id;
                           
                    $size_ids = explode('|',$filter_menu);
                      foreach($size_ids as $sz){
	    		$searchlist[] = array("filter_menu_name" => $sz);
                      }
	    	}
	    }
	    
	    if(empty($searchlist)){
	    	return response()->json([
	            'status' => 0, 
	            'msg' => config('messages.empty'),
	        ]);
	    }
	    else{
	    	return response()->json([
	            'status' => 1, 
	            'msg' => "Success",
	            'filter_auto_id' => $filter_auto_id,
	            'allfiltermenus' => $searchlist,
	        ]);
	    }
	}
       public function get_customer_search(Request $request){

	   $adminAutoIds = UserRegister::where('name', 'LIKE', '%'.$request->search.'%')->orwhere('mobile_number', 'LIKE', '%'.$request->search.'%')->where('user_type', 'customer')->where('admin_auto_id', $request->admin_auto_id)->get();

        $documentList = [];

        foreach ($adminAutoIds as $adminAutoId) {
            $customerData = $adminAutoId;
            $id = $adminAutoId['_id'];
            $documents = UserDocument::where('cust_auto_id', 'LIKE', $id)->get();
            // dd( $documents);
            $documentList[] = [
                'customer_data' => $customerData,
                'documents' => $documents,
            ];
        }

	    if($documentList){
	    	return response()->json([
	            'status' => 1, 
	            'msg' => "Success",
	            'data' => $documentList,
	        ]);
	    }else{
	    	return response()->json([
	            'status' => 0, 
	            'msg' => config('messages.empty'),
	        ]);
	    }

	}

}