<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Course;
use App\UserRegister;
use App\AdminProducts;
use App\ProductRatingReview;
use App\VendorProducts;
use App\SizeChart;
use App\Promocode;
use Session;

class RatingApiController extends Controller
{

    public function store_product_rating_review(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
         $customer_details = UserRegister::where('_id','=',$request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }else{
         $customer_details = UserRegister::where('_id','=',$request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

         }
        if($customer_details->isNotEmpty()){
            foreach ($customer_details as $cdetails) {
               $name = $cdetails->name;
               $email = $cdetails->email_id;
               $contact = $cdetails->mobile_number;
            }
            
             $store_reviews = new ProductRatingReview();
              if($request->get('admin_auto_id')!='')
                        {
                                    $store_reviews->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $store_reviews->admin_auto_id ="";
                        }       
                         if($request->get('app_type_id')!='')
                        {
                                    $store_reviews->app_type_id = $request->get('app_type_id');
                        }else
                        {
                            $store_reviews->app_type_id ="";
                        }       
               $store_reviews->product_auto_id = $request->get('product_auto_id');
               $store_reviews->product_order_auto_id = $request->get('product_order_auto_id');
               $store_reviews->customer_auto_id = $request->get('customer_auto_id');
               $store_reviews->name = $name;
               $store_reviews->email_id = $email;
               $store_reviews->mobile_number = $contact;
                if($request->get('rating')!='')
                {
                            $store_reviews->rating = $request->get('rating');
                }else
                {
                    $store_reviews->rating ="";
                }
                
     			if($request->get('review')!='')
     			{
     			    		$store_reviews->review = $request->get('review');
     			}else
     			{
     			    $store_reviews->review ="";
     			}
               if (!empty($request->file('review_image'))) {
                            $file = $request->file('review_image');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/RatingReview');

                            $file->move($path, $filename);
                            $store_reviews->review_image = $filename;
                }else{
                            $store_reviews->review_image ='';
                }
                if($request->get('finishing')!='')
                {
                            $store_reviews->finishing = $request->get('finishing');
                }else
                {
                    $store_reviews->finishing ="";
                }
                
     			if($request->get('product_quality')!='')
     			{
     			    		$store_reviews->product_quality = $request->get('product_quality');
     			}else
     			{
     			    $store_reviews->product_quality ="";
     			}
     			      if($request->get('pricing')!='')
                {
                            $store_reviews->pricing = $request->get('pricing');
                }else
                {
                    $store_reviews->pricing ="";
                }
                      if($request->get('size_fitting ')!='')
                {
                            $store_reviews->size_fitting  = $request->get('size_fitting ');
                }else
                {
                    $store_reviews->size_fitting  ="";
                }
                
     		   $store_reviews->rdate = date('Y-m-d');
               $store_reviews->save();

         return response()->json([
            'status' => 1, 
            'msg' => 'Thank you for your review',
        ]);
                  

        }else{
            return response()->json([
                'status' => 0, 
                'msg' => 'In-Valid User',
            ]);
        }

        
      

    }
	//update rating review
	
    public function edit_product_rating_review(Request $request){
        $main = ProductRatingReview::find($request->get('review_auto_id'));
        if(empty($main)){
            return response()->json(['status' => 0, "msg" => "No review and rating Found"]);
        }
        else{
                   $main->customer_auto_id = $request->get('customer_auto_id');
            
                   $main->product_auto_id = $request->get('product_auto_id');
                   $main->product_order_auto_id = $request->get('product_order_auto_id');
      
                if($request->get('rating')!='')
                {
                            $main->rating = $request->get('rating');
                }else
                {
                    $main->rating ="";
                }
                
     			if($request->get('review')!='')
     			{
     			    		$main->review = $request->get('review');
     			}else
     			{
     			    $main->review ="";
     			}
               if (!empty($request->file('review_image'))) {
                            $file = $request->file('review_image');
                            $filename = $file->getClientOriginalName();
                             $path = public_path('images/RatingReview');

                            $file->move($path, $filename);
                            $main->review_image = $filename;
                }
                if($request->get('finishing')!='')
                {
                    $main->finishing = $request->get('finishing');
                }else
                {
                    $main->finishing ="";
                }
                
     			if($request->get('product_quality')!='')
     			{
     			    		$main->product_quality = $request->get('product_quality');
     			}else
     			{
     			    $main->product_quality ="";
     			}
     			      if($request->get('pricing')!='')
                {
                            $main->pricing = $request->get('pricing');
                }else
                {
                    $main->pricing ="";
                }
                      if($request->get('size_fitting ')!='')
                {
                            $main->size_fitting  = $request->get('size_fitting ');
                }else
                {
                    $main->size_fitting  ="";
                }    
                $main->save();
                if($main)
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
    }
    
         public function get_product_rating(Request $request){
           
                    unset($allRatingReview);
                  $rlists = ProductRatingReview::whereNull('deleted_at')->get();
                     if($rlists->isNotEmpty()){
                            foreach($rlists as $rlts){
                              $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
                          $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                 }else{
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
                                   }
                            foreach($pname as $pn){
                                 $product_name = $pn->product_name;
                                 
                            }
                  $allRatingReview[] = array("rating_auto_id"=>$rlts->_id,"product_auto_id"=>$rlts->product_auto_id,"product_name"=>$product_name,"customer_auto_id"=>$rlts->customer_auto_id,
                  "customer_name"=>$rlts->name,"email_id"=>$rlts->email_id,"mobile_number"=>$rlts->mobile_number,"rating"=>$rlts->rating,"finishing"=>$rlts->finishing,"product_quality"=>$rlts->product_quality,"pricing"=>$rlts->pricing,"size_fitting"=>$rlts->size_fitting,"review"=>$rlts->review,"review_image"=>$rlts->review_image,"date"=>$rlts->rdate);

            
                             } 
                     }else{
                         $allRatingReview =array();

                     }
                      unset($courseRatingReviews);
                     $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
                  $rlists = ProductRatingReview::Where('product_auto_id',$request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        }else{
                        $rlists = ProductRatingReview::Where('product_auto_id',$request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

                        }
                     if($rlists->isNotEmpty()){
                            foreach($rlists as $rlts){
                                $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
                          $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                   }else{
                           $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

                                   }
                            foreach($pname as $pn){
                                 $product_name = $pn->product_name;
                                 
                            }
                  $courseRatingReviews[] = array("rating_auto_id"=>$rlts->_id,"product_auto_id"=>$rlts->product_auto_id,"product_name"=>$product_name,"customer_auto_id"=>$rlts->customer_auto_id,
                  "customer_name"=>$rlts->name,"email_id"=>$rlts->email_id,"mobile_number"=>$rlts->mobile_number,"rating"=>$rlts->rating,"finishing"=>$rlts->finishing,"product_quality"=>$rlts->product_quality,"pricing"=>$rlts->pricing,"size_fitting"=>$rlts->size_fitting,"review"=>$rlts->review,"review_image"=>$rlts->review_image,"date"=>$rlts->rdate);

            
                             } 
                     }else{
                         $courseRatingReviews =array();

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
         $courseRatingReview = ProductRatingReview::Where('product_auto_id',$request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
         $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                        }else{
                            $courseRatingReview = ProductRatingReview::Where('product_auto_id',$request->get('product_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$request->get('product_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                        }
         $avg_rating=0;
              $avg_finishing = 0;
	          $avg_product_quality = 0;
	          $avg_pricing = 0;
	          $avg_size_fitting = 0;
         	if($courseRatingReview->isNotEmpty()){
	        foreach($courseRatingReview as  $data){
	            $total_rating = $data->rating;
	            $total_finishing = $data->finishing;
	            $total_product_quality = $data->product_quality;
	            $total_pricing = $data->pricing;
	            $total_size_fitting = $data->size_fitting;
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
	                     	           $total_student = UserRegister::Where('_id',$data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();

	                 }
	       if($total_rating !=''){
	            $avg_rating = ($total_student*$total_rating/$total_student);
	             } if($total_finishing !=''){
	            $avg_finishing = ($total_student*$total_finishing/$total_student);
	             } if($total_product_quality !=''){
	            $avg_product_quality = ($total_student*$total_product_quality/$total_student);
	             } if($total_pricing !=''){
	            $avg_pricing = ($total_student*$total_pricing/$total_student);
	             }if($total_size_fitting !=''){
	            $avg_size_fitting = ($total_student*$total_size_fitting/$total_student);
	            }
	       }
	    }else{
	        $courseRatingReview = array();
	    }
	
	  
		return response()->json(["status" => 1, "getalldata" => $allRatingReview,"getcstomerdata" => $courseRatingReviews,"total_no_of_reviews" => $courseRatingReviewCount,
		"avg_rating" => $avg_rating,"avg_finishing" => $avg_finishing,"avg_product_quality" => $avg_product_quality,"avg_pricing" => $avg_pricing,"avg_size_fitting" => $avg_size_fitting]);
    }
    // vendor rating
        public function get_vendor_rating(Request $request){
           $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
                $pcat = VendorProducts::where('user_auto_id','=',$request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
                $pcat = VendorProducts::where('user_auto_id','=',$request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();

        }
        if($pcat->isEmpty()){

            return response()->json([
                'status' => 0, 
                'msg' => "No Data Available",
            ]);
        }
        else{
             foreach($pcat as $datas){
      $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
         $courseRatingReview = ProductRatingReview::Where('product_auto_id',$datas->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$datas->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
         }else{
               $courseRatingReview = ProductRatingReview::Where('product_auto_id',$datas->product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id',$datas->product_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
         }
         $avg_rating=0;
              $avg_finishing = 0;
	          $avg_product_quality = 0;
	          $avg_pricing = 0;
	          $avg_size_fitting = 0;
	          $vendor_rating = 0;
         	if($courseRatingReview->isNotEmpty()){
	        foreach($courseRatingReview as  $data){
	            $total_rating = $data->rating;
	            $total_finishing = $data->finishing;
	            $total_product_quality = $data->product_quality;
	            $total_pricing = $data->pricing;
	            $total_size_fitting = $data->size_fitting;
	            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->get();
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
	           $total_student = UserRegister::Where('_id',$data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
         
	           }
	      
	            $avg_rating = ($total_student*$total_rating/$total_student);
	            $avg_finishing = ($total_student*$total_finishing/$total_student);
	            $avg_product_quality = ($total_student*$total_product_quality/$total_student);
	            $avg_pricing = ($total_student*$total_pricing/$total_student);
	            $avg_size_fitting = ($total_student*$total_size_fitting/$total_student);
	            
	            $vendor_rating = ($avg_rating + $avg_finishing + $avg_product_quality + $avg_pricing + $avg_size_fitting)/5;
	       }
	    }else{
	        $courseRatingReview = array();
	    }
	
	  
		return response()->json(["status" => 1,"vendor_rating" => $vendor_rating,"avg_rating" => $avg_rating,"avg_finishing" => $avg_finishing,"avg_product_quality" => $avg_product_quality,"avg_pricing" => $avg_pricing,"avg_size_fitting" => $avg_size_fitting]);
             }
            return response()->json([
                'status' => 1, 
                'get_vendor_product_lists' => $get_vendor_product_lists,
            ]);
        }
    }
    //add size chart
   public function add_size_chart(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
         $customer_details = SizeChart::where('subcategory_auto_id','=',$request->get('subcategory_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
         }else{
         $customer_details = SizeChart::where('subcategory_auto_id','=',$request->get('subcategory_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

         }
        if($customer_details->isEmpty()){
          
              $sizechart = new SizeChart();
               $sizechart->user_auto_id = $request->get('user_auto_id');
                if($request->get('admin_auto_id')!='')
                        {
                                    $sizechart->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $sizechart->admin_auto_id ="";
                        }       
                        if($request->get('app_type_id')!='')
                        {
                                    $sizechart->app_type_id = $request->get('app_type_id');
                        }else
                        {
                            $sizechart->app_type_id ="";
                        }       
               $sizechart->added_by = $request->get('added_by');
                // if($request->get('main_category_auto_id')!='')
                // {
                //             $sizechart->main_category_auto_id = $request->get('main_category_auto_id');
                // }else
                // {
                //     $sizechart->main_category_auto_id ="";
                // }
                
     			if($request->get('subcategory_auto_id')!='')
     			{
     			    		$sizechart->subcategory_auto_id = $request->get('subcategory_auto_id');
     			}else
     			{
     			    $sizechart->subcategory_auto_id ="";
     			}
               if (!empty($request->file('chart_image'))) {
                            $file = $request->file('chart_image');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/SizeChart');

                            $file->move($path, $filename);
                            $sizechart->chart_image = $filename;
                }else{
                            $sizechart->chart_image ='';
                }
               $sizechart->rdate = date('Y-m-d');
               $sizechart->save();

         return response()->json([
            'status' => 1, 
            'msg' => 'Size Chart added successfully',
        ]);
            
            
            

        }else{
            return response()->json([
                'status' => 0, 
                'msg' => 'Already added size chart',
            ]);
        }

        
      

    }
	//update size list
	
    public function edit_size_chart(Request $request){
        $mains = SizeChart::find($request->get('chart_auto_id'));
        if(empty($mains)){
            return response()->json(['status' => 0, "msg" => "No Data Found"]);
        }
        else{
      
               $mains->user_auto_id = $request->get('user_auto_id');
               $mains->added_by = $request->get('added_by');
                // if($request->get('main_category_auto_id')!='')
                // {
                //     $mains->main_category_auto_id = $request->get('main_category_auto_id');
                // }else
                // {
                //     $mains->main_category_auto_id ="";
                // }
                
     			if($request->get('subcategory_auto_id')!='')
     			{
     			   $mains->subcategory_auto_id = $request->get('subcategory_auto_id');
     			}else
     			{
     			    $mains->subcategory_auto_id ="";
     			}
               if(!empty($request->file('chart_image'))) {
                            $file = $request->file('chart_image');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/SizeChart');

                            $file->move($path, $filename);
                            $mains->chart_image = $filename;
                }
                           
                $mains->save();
                if($mains)
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
    }
    
         public function get_size_chart_list(Request $request){
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
            $allsizel = SizeChart::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }else{
           $allsizel = SizeChart::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
    
        }
            if($allsizel->isNotEmpty())
                {
		            return response()->json([
		                "status" => "1",
		                "msg" => "success",
		                "getalldata" => $allsizel
		                ]);
                }
                else
                {
                     return response()->json([
                                    'status' => "0", 
                                    "msg" => "No Data Available"
                                    
                                ]);
                }
    }
	
}