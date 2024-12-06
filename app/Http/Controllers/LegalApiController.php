<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Terms;
use App\Privacy;
use App\ContactDetails;
use App\BusinessDetails;
use App\ProductLayoutStyle;

use App\Admin;
use App\AppUIStyle;
use App\Faq;
class LegalApiController extends Controller
{
     
    //busniess details
         public function store_business_details(Request $request){
       
           $babout = BusinessDetails::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    
         	if($babout->isNotEmpty()){

    		$babout = BusinessDetails::find($request->get('id'));

                 if (!empty($request->file('business_logo'))) {
                            $file = $request->file('business_logo');
                            $filename = $file->getClientOriginalName();
                          $path = public_path('images/business_details');
                            $file->move($path, $filename);
                            $babout->business_logo = $filename;
                        }else{
                            $babout->business_logo ='';
                        }
                if($request->get('business_name')!='')
                {
                            $babout->business_name = $request->get('business_name');
                }else
                {
                    $babout->business_name ="";
                }   
            
    		$babout->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
    
    		$babout = new BusinessDetails();
          
                  if (!empty($request->file('business_logo'))) {
                            $file = $request->file('business_logo');
                            $filename = $file->getClientOriginalName();
                            $path = public_path('images/business_details');
                            $file->move($path, $filename);
                            $babout->business_logo = $filename;
                        }else{
                            $babout->business_logo ='';
                        }
                if($request->get('business_name')!='')
                {
                            $babout->business_name = $request->get('business_name');
                }else
                {
                    $babout->business_name ="";
                }    
  			if($request->get('admin_auto_id')!='')
                        {
                                    $babout->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $babout->admin_auto_id ="";
                        }       
    		$babout->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
    public function show_business_details(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $bdetails = BusinessDetails::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }else{
        $bdetails = BusinessDetails::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }
        if($bdetails->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'busniess_details' => $bdetails,
            ]);
        }
    }
    //about
     public function insert_about(Request $request){
       
           $about = About::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    
       
            $this->validate(
          $request, 
            [   
                'about' => 'required',
            ],
            [   
                'about.required' => 'Add about us',
            ]
          );
       
                
            

    	if($about->isNotEmpty()){

    		$about = About::find($request->get('id'));

    		$about->about = $request->about;
          
    		$about->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
        $this->validate(
         $request,
           [  
            'about' =>'required',
            
           ],
           [  
            'about.required' =>'add About',
          
             ]
             );
    		$about = new About();
          
    		$about->about = $request->about;
                 if($request->get('admin_auto_id')!='')
                        {
                                    $about->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $about->admin_auto_id ="";
                        }    
    		$about->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
    public function about_index(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $about = About::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }else{
        $about = About::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }
        if($about->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'allabouts' => $about,
            ]);
        }
    }
     public function insert_terms(Request $request){
       
           $tnc = Terms::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        	if($tnc->isNotEmpty()){

    		$tnc = Terms::find($request->get('id'));
                   
                $tnc->termncondition = $request->termncondition;          
    		$tnc->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
       
    		$tnc = new Terms();
          
    		$tnc->termncondition = $request->termncondition;
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
    public function terms_index(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $term = Terms::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
        $term = Terms::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }
        if($term->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'allterms' => $term,
            ]);
        }
    }
       public function insert_privacy(Request $request){
       
        $privacy = Privacy::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

    	if($privacy->isNotEmpty()){

    		$privacy = Privacy::find($request->get('id'));

    		$privacy->privacy = $request->privacy;
    
    		$privacy->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
       
    		$privacy = new Privacy();
          
    		$privacy->privacy = $request->privacy;
                 if($request->get('admin_auto_id')!='')
                        {
                                    $privacy->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $privacy->admin_auto_id ="";
                        }    
    		$privacy->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
     public function privacy_index(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $privacy = Privacy::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
	}else{
        $privacy = Privacy::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
	}
        if($privacy->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'allprivacy' => $privacy,
            ]);
        }
    }
      public function insert_contact(Request $request){
       
        $contact = ContactDetails::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

    	if($contact->isNotEmpty()){

    		$contact = ContactDetails::find($request->get('id'));
                  
    		$contact->contact = $request->contact;
    		$contact->email = $request->email;
    		$contact->address = $request->address;
    		
      		$contact->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
       
    		$contact = new ContactDetails();
          	$contact->contact = $request->contact;
        	$contact->email = $request->email;
    		$contact->address = $request->address;
    		 if($request->get('admin_auto_id')!='')
                        {
                           $contact->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $contact->admin_auto_id ="";
                        } 
                      
    		$contact->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
    public function contact_index(Request $request){
       $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $contact = ContactDetails::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }else{
         $contact = ContactDetails::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
         }
        if($contact->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'allcontact_details' => $contact,
            ]);
        }
    }
     public function insert_faq(Request $request){
       
        $faqs = Faq::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();

    	if($faqs->isNotEmpty()){

    		$faqs = Faq::find($request->get('id'));

    		$faqs->faq = $request->faq;
    		$faqs->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
       
    		$faqs = new Faq();
          
    		$faqs->faq = $request->faq;
                        if($request->get('admin_auto_id')!='')
                        {
                           $faqs->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $faqs->admin_auto_id ="";
                        } 
    		$faqs->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
        public function faq_index(Request $request){
            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
        $faq = Faq::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
               }else{
        $faq = Faq::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
               }
        if($faq->isEmpty()){
            return response()->json([
                'status' => 0, 
                'msg' => config('messages.empty'),
            ]);
        }
        else{
            return response()->json([
                'status' => 1, 
                'allfaqs' => $faq,
            ]);
        }
    }
    
      //product layout style
         public function add_product_layout_style(Request $request){
       
           $times = ProductLayoutStyle::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    
         	if($times->isNotEmpty()){

    		$times = ProductLayoutStyle::find($request->get('id'));

                if($request->get('layout_type')!='')
                {
                    $times->layout_type = $request->get('layout_type');
                }else
                {
                    $times->layout_type ="";
                }    
               
    		$times->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
    
    		$times = new ProductLayoutStyle();
          
                
                if($request->get('layout_type')!='')
                {
                   $times->layout_type = $request->get('layout_type');
                }else
                {
                    $times->layout_type ="";
                }    
                 if($request->get('admin_auto_id')!='')
                        {
                           $times->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $times->admin_auto_id ="";
                        } 
    		$times->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
    // get product layout style
	public function get_product_layout_style(Request $request){
	   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
			 if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
			 }else{
			     $erase_data_status='No';
			 }
        if($erase_data_status =='Yes'){
	    $playoutstyle = ProductLayoutStyle::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
	     }else{
	    $playoutstyle = ProductLayoutStyle::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
	     }
	    if($playoutstyle->isNotEmpty()){
	    	foreach ($playoutstyle as $mdetails) {
	    	      $layout_type=$mdetails->layout_type;
                           
                    $size_ids = explode('|',$layout_type);
                      foreach($size_ids as $sz){
	    		$playut[] = array("layout_type" => $sz);
                      }
	    	}
	    }
	    
	    if(empty($playut)){
	    	return response()->json([
	            'status' => 0, 
	            'msg' => config('messages.empty'),
	        ]);
	    }
	    else{
	    	return response()->json([
	            'status' => 1, 
	            'msg' => "Success",
	            'all_product_layout_style' => $playut,
	        ]);
	    }
	}
	  //app ui style
         public function add_app_ui_style(Request $request){
       
           $appuistyle = AppUIStyle::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
    
         	if($appuistyle->isNotEmpty()){

    		$appuistyle = AppUIStyle::find($request->get('id'));
                   
             if($request->get('appbar_color')!='')
                {
                   $appuistyle->appbar_color = $request->get('appbar_color');
                }else
                {
                    $appuistyle->appbar_color ="";
                }    
                 if($request->get('appbar_icon_color')!='')
                {
                   $appuistyle->appbar_icon_color = $request->get('appbar_icon_color');
                }else
                {
                    $appuistyle->appbar_icon_color ="";
                }    
                  if($request->get('bottom_bar_color')!='')
                {
                   $appuistyle->bottom_bar_color = $request->get('bottom_bar_color');
                }else
                {
                    $appuistyle->bottom_bar_color ="";
                }    
                  
                if($request->get('bottom_bar_icon_color')!='')
                {
                   $appuistyle->bottom_bar_icon_color = $request->get('bottom_bar_icon_color');
                }else
                {
                    $appuistyle->bottom_bar_icon_color ="";
                }    
                 if($request->get('add_to_cart_button_color')!='')
                {
                   $appuistyle->add_to_cart_button_color = $request->get('add_to_cart_button_color');
                }else
                {
                    $appuistyle->add_to_cart_button_color ="";
                }    
                  if($request->get('login_register_button_color')!='')
                {
                   $appuistyle->login_register_button_color = $request->get('login_register_button_color');
                }else
                {
                    $appuistyle->login_register_button_color ="";
                }    
                  
                if($request->get('buy_now_botton_color')!='')
                {
                   $appuistyle->buy_now_botton_color = $request->get('buy_now_botton_color');
                }else
                {
                    $appuistyle->buy_now_botton_color ="";
                }    
                 if($request->get('app_font')!='')
                {
                   $appuistyle->app_font = $request->get('app_font');
                }else
                {
                    $appuistyle->app_font ="";
                }    
                  if($request->get('show_location_on_homescreen')!='')
                {
                   $appuistyle->show_location_on_homescreen = $request->get('show_location_on_homescreen');
                }else
                {
                    $appuistyle->show_location_on_homescreen ="";
                }  
                  if($request->get('product_layout_type')!='')
                {
                   $appuistyle->product_layout_type = $request->get('product_layout_type');
                }else
                {
                    $appuistyle->product_layout_type ="";
                }  
    		$appuistyle->save();

            return response()->json([
                'status' => 1, 
                'msg' => "Updated Successfully",
            ]);
    	}

    	else{
    
    		$appuistyle = new AppUIStyle();
           if($request->get('admin_auto_id')!='')
                        {
                           $appuistyle->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $appuistyle->admin_auto_id ="";
                        } 
                
                 if($request->get('appbar_color')!='')
                {
                   $appuistyle->appbar_color = $request->get('appbar_color');
                }else
                {
                    $appuistyle->appbar_color ="";
                }    
                 if($request->get('appbar_icon_color')!='')
                {
                   $appuistyle->appbar_icon_color = $request->get('appbar_icon_color');
                }else
                {
                    $appuistyle->appbar_icon_color ="";
                }    
                  if($request->get('bottom_bar_color')!='')
                {
                   $appuistyle->bottom_bar_color = $request->get('bottom_bar_color');
                }else
                {
                    $appuistyle->bottom_bar_color ="";
                }    
                  
                if($request->get('bottom_bar_icon_color')!='')
                {
                   $appuistyle->bottom_bar_icon_color = $request->get('bottom_bar_icon_color');
                }else
                {
                    $appuistyle->bottom_bar_icon_color ="";
                }    
                 if($request->get('add_to_cart_button_color')!='')
                {
                   $appuistyle->add_to_cart_button_color = $request->get('add_to_cart_button_color');
                }else
                {
                    $appuistyle->add_to_cart_button_color ="";
                }    
                  if($request->get('login_register_button_color')!='')
                {
                   $appuistyle->login_register_button_color = $request->get('login_register_button_color');
                }else
                {
                    $appuistyle->login_register_button_color ="";
                }    
                  
                if($request->get('buy_now_botton_color')!='')
                {
                   $appuistyle->buy_now_botton_color = $request->get('buy_now_botton_color');
                }else
                {
                    $appuistyle->buy_now_botton_color ="";
                }    
                 if($request->get('app_font')!='')
                {
                   $appuistyle->app_font = $request->get('app_font');
                }else
                {
                    $appuistyle->app_font ="";
                }    
                  if($request->get('show_location_on_homescreen')!='')
                {
                   $appuistyle->show_location_on_homescreen = $request->get('show_location_on_homescreen');
                }else
                {
                    $appuistyle->show_location_on_homescreen ="";
                }  
                if($request->get('product_layout_type')!='')
                {
                   $appuistyle->product_layout_type = $request->get('product_layout_type');
                }else
                {
                    $appuistyle->product_layout_type ="";
                }  
    		$appuistyle->save();

    		 return response()->json([
                'status' => 1, 
                'msg' => "Added Successfully",
            ]);

    	}

    }
    // get product layout style
	public function get_app_ui_style(Request $request){
               $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
	       if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
		}else{
		    $erase_data_status='No';
	        }
        if($erase_data_status =='Yes'){
	    $appui = AppUIStyle::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
	 }else{
	    $appui = AppUIStyle::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
	            'all_app_ui_style' => $appui,
	        ]);
	    }
	}
}
