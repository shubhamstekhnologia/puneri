<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\About;
use App\Terms;
use App\Privacy;
use App\ContactDetails;
use App\Faq;
use App\Categories;
use App\Subcategories;
use App\CategoryStyle;
use App\BusinessDetails;
use DB;

use Session;

use App\Traits\Features;

class LegalController extends Controller

{

    use Features;

    public function about_index(){
      
        $about = About::get();
    	$get_main_categories=Categories::all();
      $i=0;
      foreach($get_main_categories As $main)
      {
          $main_id=$main->id;
          $get_sub_categories=Subcategories::where('main_category_auto_id',$main_id)->get();
          $get_main_categories[$i]['subcategories']=$get_sub_categories;
          
          $i++;
      }
       $get_maincategory_style=CategoryStyle::ORDERBY('_id','DESC')->first();
       if(!empty($get_maincategory_style))
       {
           $main_category_display_style=$get_maincategory_style->web_icon_style;
       }
       else
       {
           $main_category_display_style="0";
       }
        $get_business_details = BusinessDetails::get();
$get_contact_details = ContactDetails::get();

    	return view('templates.frontend.about_us')->with(['allabouts'=>$about,'contact_details'=>$get_contact_details,'main_cat_style'=>$main_category_display_style,'business_details'=>$get_business_details,'main_category'=>$get_main_categories]);

  }
   public function term_index(){
      $get_main_categories=Categories::all();
      $i=0;
      foreach($get_main_categories As $main)
      {
          $main_id=$main->id;
          $get_sub_categories=Subcategories::where('main_category_auto_id',$main_id)->get();
          $get_main_categories[$i]['subcategories']=$get_sub_categories;
          
          $i++;
      }
       $get_maincategory_style=CategoryStyle::ORDERBY('_id','DESC')->first();
       if(!empty($get_maincategory_style))
       {
           $main_category_display_style=$get_maincategory_style->web_icon_style;
       }
       else
       {
           $main_category_display_style="0";
       }
        $get_business_details = BusinessDetails::get();
        $get_contact_details = ContactDetails::get();
        $tnc = Terms::get();
    	
    	return view('templates.frontend.term_condition')->with(['allterms'=>$tnc,'contact_details'=>$get_contact_details,'main_cat_style'=>$main_category_display_style,'business_details'=>$get_business_details,'main_category'=>$get_main_categories]);

  }
   public function privacy_index(){
      $get_main_categories=Categories::all();
      $i=0;
      foreach($get_main_categories As $main)
      {
          $main_id=$main->id;
          $get_sub_categories=Subcategories::where('main_category_auto_id',$main_id)->get();
          $get_main_categories[$i]['subcategories']=$get_sub_categories;
          
          $i++;
      }
       $get_maincategory_style=CategoryStyle::ORDERBY('_id','DESC')->first();
       if(!empty($get_maincategory_style))
       {
           $main_category_display_style=$get_maincategory_style->web_icon_style;
       }
       else
       {
           $main_category_display_style="0";
       }
        $get_business_details = BusinessDetails::get();
        $get_contact_details = ContactDetails::get();
        $pvcy = Privacy::get();
    	
    	return view('templates.frontend.privacy')->with(['allprivacy'=>$pvcy,'contact_details'=>$get_contact_details,'main_cat_style'=>$main_category_display_style,'business_details'=>$get_business_details,'main_category'=>$get_main_categories]);

  }
   public function faq_index(){
      $get_main_categories=Categories::all();
      $i=0;
      foreach($get_main_categories As $main)
      {
          $main_id=$main->id;
          $get_sub_categories=Subcategories::where('main_category_auto_id',$main_id)->get();
          $get_main_categories[$i]['subcategories']=$get_sub_categories;
          
          $i++;
      }
       $get_maincategory_style=CategoryStyle::ORDERBY('_id','DESC')->first();
       if(!empty($get_maincategory_style))
       {
           $main_category_display_style=$get_maincategory_style->web_icon_style;
       }
       else
       {
           $main_category_display_style="0";
       }
        $get_business_details = BusinessDetails::get();
        $get_contact_details = ContactDetails::get();
        $faqs = Faq::get();
    	
    	return view('templates.frontend.faqs')->with(['allfaqs'=>$faqs,'contact_details'=>$get_contact_details,'main_cat_style'=>$main_category_display_style,'business_details'=>$get_business_details,'main_category'=>$get_main_categories]);

  }




   
}

