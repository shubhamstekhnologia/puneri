<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\Subcategories;
use App\AdminProducts;
use App\CategoryStyle;
use App\CartProducts;
use App\CountryProductPrice;
use App\WishlistProducts;
use App\AdminProductImages;
use App\ProductFormUI;
use App\Admin;
use App\CouponCode;
use DateTimeZone;
use DateTime;
use DB;

class CategoriesApiController extends Controller
{


    public function add_main_category(Request $request) {

        $Categories = new Categories();
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $checkCategory = Categories::where('category_name', $request->category_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
         }else{
         $checkCategory = Categories::where('category_name', $request->category_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();

         }
            if ($checkCategory) {
            return response()->json([
                'status' => "0",
                'msg' => 'This Category Name already exists..!',
            ]);

        }  else {

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');

             if ($request->get('category_name')!=""){
                $Categories->category_name = $request->get('category_name');
             }
             else
             {
                 $Categories->category_name = "";
             }
              if($request->get('admin_auto_id')!='')
                        {
                                    $Categories->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $Categories->admin_auto_id ="";
                        }
                if($request->get('app_type_id')!='')
                            {
                                $Categories->app_type_id = $request->get('app_type_id');
                            }else
                            {
                                $Categories->app_type_id ="";
                            }
                   if (!empty($request->file('category_image_app'))) {
            $file = $request->file('category_image_app');
            $filename = $file->getClientOriginalName();
            
       $path = public_path('images/categories');
            $file->move($path, $filename);
            $Categories->category_image_app = $filename;
        }
        else
        {
             $Categories->category_image_app = "";
        }


        if (!empty($request->file('category_image_web'))) {
            $file1 = $request->file('category_image_web');
            $filename1 = $file1->getClientOriginalName();
             $path = public_path('images/categories');

            $file1->move($path, $filename1);
             $Categories->category_image_web = $filename1;
        }
        else
        {
            $Categories->category_image_web = "";
        }


                $Categories->register_date = date('Y-m-d');
                $Categories->save();

              return response()->json([
                    'status' => "1",
                    'data' => $Categories

                ]);

        }
    }



       // Update Profile
    public function edit_main_category(Request $request){
        $main = Categories::find($request->get('main_category_auto_id'));
        if(empty($main)){
            return response()->json(['status' => 0, "msg" => "No Main Category Found"]);
        }
        else{
            $main->category_name = $request->get('category_name');
   
        if (!empty($request->file('category_image_app'))) {
            $file = $request->file('category_image_app');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/categories');
            $file->move($path, $filename);
            $main->category_image_app = $filename;
        }
            if (!empty($request->file('category_image_web'))) {
            $file1 = $request->file('category_image_web');
            $filename1 = $file1->getClientOriginalName();
            $path = public_path('images/categories');
            $file1->move($path, $filename1);
            $main->category_image_web = $filename1;
        }


            $main->save();

     return response()->json([
                    'status' => "1",
                    'data' => $main

                ]);


            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }


public function get_main_category_list(Request $request) {
//      $getmain_categorylist = Categories::where('user_auto_id','=',$request->get('user_auto_id'))->where('status','=','Purchased')->ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
  $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
 $getmain_categorylist = Categories::ORDERBY('_id','ASC')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
  }else{
 $getmain_categorylist = Categories::ORDERBY('_id','ASC')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
  }
        if($getmain_categorylist->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'getmain_categorylist' => $getmain_categorylist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

        public function delete_main_category(Request $request){
            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $tdetails = Categories::where('_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
              }else{
        $tdetails = Categories::where('_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
              }
            if($tdetails){
                 $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
            $sub_categories_delete=Subcategories::where('main_category_auto_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
      
            $aproductsdetails = AdminProducts::where('main_category_auto_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            if($aproductsdetails->isNotEmpty()){
                foreach($aproductsdetails as $prderase){
                     $product_id=$prderase->_id;
                }
             }else{
                 $product_id='';
             }
        $cdetails = CartProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $wdetails = WishlistProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $idetails = AdminProductImages::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $cpdetails = CountryProductPrice::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $tdetails = AdminProducts::where('main_category_auto_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        }else{
                    $sub_categories_delete=Subcategories::where('main_category_auto_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
                    
            $aproductsdetails = AdminProducts::where('main_category_auto_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            if($aproductsdetails->isNotEmpty()){
                foreach($aproductsdetails as $prderase){
                     $product_id=$prderase->_id;
                }
             }else{
                 $product_id='';
             }
        $cdetails = CartProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $wdetails = WishlistProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $idetails = AdminProductImages::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $cpdetails = CountryProductPrice::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
       $tdetails = AdminProducts::where('main_category_auto_id','=', $request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
                  }
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);

        }

        else{

            return response()->json([

                'status' => 0,

                'msg' => "Category Not registered"

            ]);
        }
   }

    public function add_main_category_style(Request $request) {

                $cat_style = new CategoryStyle();

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');
                        if($request->get('admin_auto_id')!='')
                        {
                                    $cat_style->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $cat_style->admin_auto_id ="";
                        }
                         if($request->get('app_type_id')!='')
                        {
                                    $cat_style->app_type_id = $request->get('app_type_id');
                        }else
                        {
                            $cat_style->app_type_id ="";
                        }
            if($request->get('app_icon_style')!="")
            {
                $cat_style->app_icon_style = $request->get('app_icon_style');
            }
            else
            {
                $cat_style->app_icon_style = 0;
            }
            if($request->get('app_label_font')!="")
            {
                $cat_style->app_label_font = $request->get('app_label_font');
            }
            else
            {
                $cat_style->app_label_font = '';
            }
            if($request->get('app_label_color')!="")
            {
                $cat_style->app_label_color = $request->get('app_label_color');
            }
            else
            {
                $cat_style->app_label_color = '';
            }
            if($request->get('web_icon_style')!="")
            {
                $cat_style->web_icon_style = $request->get('web_icon_style');
            }
            else
            {
                $cat_style->web_icon_style = '';
            }
            if($request->get('web_label_font')!="")
            {
                $cat_style->web_label_font = $request->get('web_label_font');
            }
            else
            {
                $cat_style->web_label_font = '';
            }
            if($request->get('web_label_color')!="")
            {
                $cat_style->web_label_color = $request->get('web_label_color');
            }
            else
            {
                $cat_style->web_label_color = '';
            }



                $cat_style->register_date = date('Y-m-d');
                $cat_style->save();

                return response()->json([

                'status' => 1,

                'msg' => "Added Successfully"

            ]);


    }


     // Update Profile
    public function edit_main_category_style(Request $request){
        // $cat_style = CategoryStyle::find($request->get('category_style_auto_id'));
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
       $cat_style=CategoryStyle::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
          }else{
                     $cat_style=CategoryStyle::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();

          }

                $cat_style->app_icon_style = $request->app_icon_style;
                $cat_style->app_label_font = $request->app_label_font;
                $cat_style->app_label_color = $request->app_label_color;
                $cat_style->web_icon_style = $request->web_icon_style;
                $cat_style->web_label_font = $request->web_label_font;
                $cat_style->web_label_color = $request->web_label_color;
                $cat_style->save();

              $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
                         $cat = CategoryStyle::where('app_type_id', $request->app_type_id)->where('app_icon_style',$request->app_icon_style)->where('admin_auto_id', $request->admin_auto_id)->where('app_label_font',$request->app_label_font)->where('app_label_color',$request->app_label_color)->where('web_icon_style',$request->web_icon_style)->where('web_label_font',$request->web_label_font)->where('web_label_color',$request->web_label_color)->whereNull('deleted_at')->get();
              }else{
                         $cat = CategoryStyle::where('app_type_id', $request->app_type_id)->where('app_icon_style',$request->app_icon_style)->where('admin_auto_id', $request->admin_auto_id)->where('app_label_font',$request->app_label_font)->where('app_label_color',$request->app_label_color)->where('web_icon_style',$request->web_icon_style)->where('app_type_id', $request->app_type_id)->where('web_label_font',$request->web_label_font)->where('web_label_color',$request->web_label_color)->whereNull('deleted_at')->get();
              }
if(!empty($cat))
{
     return response()->json([
                    'status' => "1",
                    'data' => $cat

                ]);
}
else
{
     return response()->json([
                    'status' => "0",
                    'data' => "No Data Available"

                ]);
}

            return response()->json(['status' => "1", "msg" => config('messages.success')]);

    }


    public function get_main_category_style_list(Request $request) {
//      $getmain_categorylist = Categories::where('user_auto_id','=',$request->get('user_auto_id'))->where('status','=','Purchased')->ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
   $esatatus = Admin::where('_id','=', $request->admin_auto_id)->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
 $getmain_category_style_list = CategoryStyle::ORDERBY('_id','DESC')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
  }else{
 $getmain_category_style_list = CategoryStyle::ORDERBY('_id','DESC')->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
  }
        if($getmain_category_style_list->isNotEmpty()){
            return response()->json(['status' => "1", "msg" => "success", 'getmain_category_style_list' => $getmain_category_style_list]);
        } else {
            return response()->json(['status' => "0", "msg" => "No Data Available"]);
        }
    }


    //Subcategories

    public function add_sub_category(Request $request) {

        $Categories = new Categories();
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
            $checkCategory = Categories::where('_id', $request->main_category_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
        }else{
         $checkCategory = Categories::where('_id', $request->main_category_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();

        }
        if (empty($checkCategory)) {
            return response()->json([
                'status' => "0",
                'msg' => 'Main Category Does not exist!'
            ]);

        }  else {


              $Subcategories = new Subcategories();
            $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $checkSubcategories = Subcategories::where('_id', $request->sub_category_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
               }else{
        $checkSubcategories = Subcategories::where('_id', $request->sub_category_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
               }
            if ($checkSubcategories) {
            return response()->json([
                'status' => "0",
                'msg' => 'Sub Category Already Exists!!'
            ]);

        }
        else
        {


                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');
                     if($request->get('admin_auto_id')!='')
                        {
                                    $Subcategories->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $Subcategories->admin_auto_id ="";
                        }
                        if($request->get('app_type_id')!='')
                            {
                                $Subcategories->app_type_id = $request->get('app_type_id');
                            }else
                            {
                                $Subcategories->app_type_id ="";
                            }
            $Subcategories->main_category_auto_id = $request->main_category_auto_id;
                $Subcategories->sub_category_name = $request->get('sub_category_name');

                   if (!empty($request->file('subcategory_image_app'))) {
            $file = $request->file('subcategory_image_app');
            $filename = $file->getClientOriginalName();
            
        $path = public_path('images/subcategories');
            $file->move($path, $filename);
            $Subcategories->subcategory_image_app = $filename;
        }
        else
        {
             $Subcategories->subcategory_image_app = "";
        }


        if (!empty($request->file('subcategory_image_web'))) {
            $file1 = $request->file('subcategory_image_web');
            $filename1 = $file1->getClientOriginalName();
            $path = public_path('images/subcategories');
            $file1->move($path, $filename1);
             $Subcategories->subcategory_image_web = $filename1;
        }
        else
        {
            $Subcategories->subcategory_image_web = "";
        }


                $Subcategories->register_date = date('Y-m-d');
                $Subcategories->save();

        }

     return response()->json([
                    'status' => "1",
                    'data' => $Subcategories

                ]);



        }
    }


    //Edit Sub Category

    public function edit_sub_category(Request $request){
        $main = Subcategories::find($request->get('sub_category_auto_id'));
        if(empty($main)){
            return response()->json(['status' => 0, "msg" => "No Sub Category Found"]);
        }
        else{
             if(!empty($request->get('sub_category_name')))
             {
                $main->sub_category_name = $request->get('sub_category_name');
            }
            else
            {
                $main->sub_category_name = "";
            }

        if (!empty($request->file('subcategory_image_app'))) {
            $file = $request->file('subcategory_image_app');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/subcategories');

            $file->move($path, $filename);
            $main->subcategory_image_app = $filename;
        }
            if (!empty($request->file('subcategory_image_web'))) {
            $file1 = $request->file('subcategory_image_web');
            $filename1 = $file1->getClientOriginalName();
            $path = public_path('images/subcategories');
            $file1->move($path, $filename1);
            $main->subcategory_image_web = $filename1;
        }


            $main->save();

                return response()->json([
                    'status' => "1",
                    'data' => $main

                ]);


            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }


    //Get Sub Category List
    public function get_sub_category_list(Request $request) {
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
    $getmain_subcategorylist = Subcategories::where('main_category_auto_id','=',$request->get('main_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
          }else{
    $getmain_subcategorylist = Subcategories::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('main_category_auto_id','=',$request->get('main_category_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
          }
//  $getmain_categorylist = Categories::ORDERBY('_id','DESC')->get();
        if($getmain_subcategorylist->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'getmain_subcategorylist' => $getmain_subcategorylist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }


    //Delete Sub Category
    public function delete_sub_category(Request $request){
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $tdetails = Subcategories::where('_id','=', $request->get('sub_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
      
            $aproductsdetails = AdminProducts::where('sub_category_auto_id','=', $request->get('sub_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            if($aproductsdetails->isNotEmpty()){
                foreach($aproductsdetails as $prderase){
                     $product_id=$prderase->_id;
                }
             }else{
                 $product_id='';
             }
        $cdetails = CartProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $wdetails = WishlistProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $idetails = AdminProductImages::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $cpdetails = CountryProductPrice::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $pdetails = AdminProducts::where('sub_category_auto_id','=', $request->get('sub_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
         }else{
        $tdetails = Subcategories::where('_id','=', $request->get('sub_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            $aproductsdetails = AdminProducts::where('sub_category_auto_id','=', $request->get('sub_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            if($aproductsdetails->isNotEmpty()){
                foreach($aproductsdetails as $prderase){
                     $product_id=$prderase->_id;
                }
             }else{
                 $product_id='';
             }
        $cdetails = CartProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $wdetails = WishlistProducts::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->delete();
        $idetails = AdminProductImages::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $cpdetails = CountryProductPrice::where('product_auto_id','=', $product_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        $pdetails = AdminProducts::where('sub_category_auto_id','=', $request->get('sub_category_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

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

                'msg' => "Category Not registered"

            ]);
        }
   }

    //Coupon code

    public function add_new_coupen_code(Request $request) {

         $couponcode = new CouponCode();
         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $chkcouponcode = CouponCode::where('coupen_code', $request->coupen_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
          }else{
        $chkcouponcode = CouponCode::where('coupen_code', $request->coupen_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
          }
            if ($chkcouponcode) {
            return response()->json([
                'status' => "0",
                'msg' => 'This coupon code Already Exists!!'
            ]);

        }
        else
        {


                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');

            $couponcode->user_auto_id = $request->user_auto_id;
                  if($request->get('admin_auto_id')!='')
                        {
                                    $couponcode->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $couponcode->admin_auto_id ="";
                        }
            if (!empty($request->get('type'))) {
                $couponcode->type = $request->get('type');
            }
             else
            {
             $couponcode->type = "";
            }
            if (!empty($request->get('coupen_code'))) {
                          $couponcode->coupen_code = $request->get('coupen_code');
            }
            else
            {
            $couponcode->coupen_code = "";
            }
             if (!empty($request->get('coupen_code_value'))) {
                          $couponcode->coupen_code_value = $request->get('coupen_code_value');
            }
            else
            {
            $couponcode->coupen_code_value = "";
            }
             if (!empty($request->get('coupen_code_desc'))) {
                          $couponcode->coupen_code_desc = $request->get('coupen_code_desc');
            }
            else
            {
            $couponcode->start_date = "";
            }
             if (!empty($request->get('start_date'))) {
                          $couponcode->start_date = $request->get('start_date');
            }
            else
            {
            $couponcode->start_date = "";
            }
             if (!empty($request->get('end_date'))) {
                          $couponcode->end_date = $request->get('end_date');
            }
            else
            {
            $couponcode->end_date = "";
            }


                $couponcode->register_date = date('Y-m-d');
                $couponcode->save();

        }

if($couponcode)
{
     return response()->json([
                    'status' => "1",
                    'data' => $couponcode

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


    //Edit Sub Category

    public function edit_coupen_code(Request $request){
        $mains = CouponCode::find($request->get('coupon_auto_id'));
        if(empty($mains)){
            return response()->json(['status' => 0, "msg" => "No data Found"]);
        }
        else{
            $mains->user_auto_id = $request->user_auto_id;
            if (!empty($request->get('type'))) {
                $mains->type = $request->get('type');
            }
             else
            {
             $mains->type = "";
            }
            if (!empty($request->get('coupen_code'))) {
                          $mains->coupen_code = $request->get('coupen_code');
            }
            else
            {
            $mains->coupen_code = "";
            }
             if (!empty($request->get('coupen_code_value'))) {
                          $mains->coupen_code_value = $request->get('coupen_code_value');
            }
            else
            {
            $mains->coupen_code_value = "";
            }
             if (!empty($request->get('coupen_code_desc'))) {
                          $mains->coupen_code_desc = $request->get('coupen_code_desc');
            }
            else
            {
            $mains->start_date = "";
            }
             if (!empty($request->get('start_date'))) {
                          $mains->start_date = $request->get('start_date');
            }
            else
            {
            $mains->start_date = "";
            }
             if (!empty($request->get('end_date'))) {
                          $mains->end_date = $request->get('end_date');
            }
            else
            {
            $mains->end_date = "";
            }
             $mains->save();

if($mains)
{
     return response()->json([
                    'status' => "1",
                    'data' => $mains

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


    //Get Sub Category List
    public function get_all_coupen_code(Request $request) {
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
    $getcouponlist = CouponCode::where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
    $getcouponlist = CouponCode::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id','=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if($getcouponlist->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'cuponcode_list' => $getcouponlist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
       //Get Sub Category List
    public function get_all_coupen_code_list(Request $request) {
        $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
    $getcouponlists = CouponCode::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }else{
    $getcouponlists = CouponCode::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
        }
        if($getcouponlists->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'all_cuponcode_list' => $getcouponlists]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    //Delete Sub Category
    public function delete_coupen_code(Request $request){
         $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
        $cc = CouponCode::where('_id','=', $request->get('coupon_auto_id'))->where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
          }else{
        $cc = CouponCode::where('_id','=', $request->get('coupon_auto_id'))->where('user_auto_id','=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
          }
            if($cc){
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

   //product form ui
     public function add_product_formui(Request $request) {

        $Categories = new ProductFormUI();
       

                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');

                        if($request->get('admin_auto_id')!='')
                        {
                                    $Categories->admin_auto_id = $request->get('admin_auto_id');
                        }else
                        {
                            $Categories->admin_auto_id ="";
                        }
                        if($request->get('app_type_id')!='')
                            {
                                $Categories->app_type_id = $request->get('app_type_id');
                            }else
                            {
                                $Categories->app_type_id ="";
                            }
                        if($request->get('size')!='')
                        {
                                    $Categories->size = $request->get('size');
                        }else
                        {
                            $Categories->size ="";
                        }
                        if($request->get('color')!='')
                            {
                                $Categories->color = $request->get('color');
                            }else
                            {
                                $Categories->color ="";
                            }
                            if($request->get('highlights')!='')
                        {
                                    $Categories->highlights = $request->get('highlights');
                        }else
                        {
                            $Categories->highlights ="";
                        }
                        if($request->get('specification')!='')
                            {
                                $Categories->specification = $request->get('specification');
                            }else
                            {
                                $Categories->specification ="";
                            }
                            if($request->get('brand')!='')
                        {
                                    $Categories->brand = $request->get('brand');
                        }else
                        {
                            $Categories->brand ="";
                        }
                        if($request->get('new_arrival')!='')
                            {
                                $Categories->new_arrival = $request->get('new_arrival');
                            }else
                            {
                                $Categories->new_arrival ="";
                            }
                            if($request->get('moq')!='')
                        {
                                    $Categories->moq = $request->get('moq');
                        }else
                        {
                            $Categories->moq ="";
                        }
                        if($request->get('gross_wt')!='')
                            {
                                $Categories->gross_wt = $request->get('gross_wt');
                            }else
                            {
                                $Categories->gross_wt ="";
                            }
                        if($request->get('net_wt')!=''){
                            $Categories->net_wt = $request->get('net_wt');
                        }else{
                            $Categories->net_wt ="";
                        }
                        if($request->get('unit')!=''){
                                $Categories->unit = $request->get('unit');
                        }else{
                                $Categories->unit ="";
                         }
                        if($request->get('quantity')!=''){
                                    $Categories->quantity = $request->get('quantity');
                        }else{
                            $Categories->quantity ="";
                        }
                        if($request->get('use_by')!='')
                            {
                                $Categories->use_by = $request->get('use_by');
                            }else
                            {
                                $Categories->use_by ="";
                            }
                            if($request->get('expected_delivery')!='')
                        {
                                    $Categories->expected_delivery = $request->get('expected_delivery');
                        }else
                        {
                            $Categories->expected_delivery ="";
                        }
                        if($request->get('return_exchange')!='')
                            {
                                $Categories->return_exchange = $request->get('return_exchange');
                            }else
                            {
                                $Categories->return_exchange ="";
                            }
                            if($request->get('dimension')!='')
                        {
                                    $Categories->dimension = $request->get('dimension');
                        }else
                        {
                            $Categories->dimension ="";
                        }
                        if($request->get('manufacturers')!='')
                            {
                                $Categories->manufacturers = $request->get('manufacturers');
                            }else
                            {
                                $Categories->manufacturers ="";
                            }
                            if($request->get('material')!='')
                        {
                                    $Categories->material = $request->get('material');
                        }else
                        {
                            $Categories->material ="";
                        }
                        if($request->get('firmness')!='')
                            {
                                $Categories->firmness = $request->get('firmness');
                            }else
                            {
                                $Categories->firmness ="";
                            }
                            if($request->get('thickness')!='')
                        {
                                    $Categories->thickness = $request->get('thickness');
                        }else
                        {
                            $Categories->thickness ="";
                        }
                        if($request->get('trial_period')!='')
                            {
                                $Categories->trial_period = $request->get('trial_period');
                            }else
                            {
                                $Categories->trial_period ="";
                            }
                        if($request->get('inventory')!=''){
                            $Categories->inventory = $request->get('inventory');
                        }else{
                            $Categories->inventory ="";
                        }
                        if($request->get('iscustomizable')!=''){
                            $Categories->iscustomizable = $request->get('iscustomizable');
                        }else{
                            $Categories->iscustomizable ="";
                        }
                        if($request->get('isegg')!=''){
                            $Categories->isegg = $request->get('isegg');
                        }else{
                            $Categories->isegg ="";
                        }
                        if($request->get('isveg')!=''){
                            $Categories->isveg= $request->get('isveg');
                        }else{
                            $Categories->isveg="";
                        }

                $Categories->register_date = date('Y-m-d');
                $Categories->save();

                return response()->json([
                    'status' => "1",
		     "msg" => "success",
                    'data' => $Categories

                ]);

    }



       // Update Profile
    public function update_product_formui(Request $request){
        $main = ProductFormUI::find($request->get('form_auto_id'));
        if(empty($main)){
            return response()->json(['status' => 0, "msg" => "No data Found"]);
        }
        else{
                  
                        if($request->get('size')!='')
                        {
                                    $main->size = $request->get('size');
                        }
                        if($request->get('color')!='')
                            {
                                $main->color = $request->get('color');
                            }
                        if($request->get('highlights')!='')
                        {
                                    $main->highlights = $request->get('highlights');
                        }
                        if($request->get('specification')!='')
                        {
                                $main->specification = $request->get('specification');
                        }
                        if($request->get('brand')!='')
                        {
                                    $main->brand = $request->get('brand');
                        }
                        if($request->get('new_arrival')!='')
                        {
                                $main->new_arrival = $request->get('new_arrival');
                        }
                        if($request->get('moq')!='')
                        {
                                    $main->moq = $request->get('moq');
                        }
                        if($request->get('gross_wt')!='')
                        {
                                $main->gross_wt = $request->get('gross_wt');
                        }
                        if($request->get('net_wt')!='')
                        {
                                    $main->net_wt = $request->get('net_wt');
                        }
                        if($request->get('unit')!='')
                        {
                                $main->unit = $request->get('unit');
                        }
                        if($request->get('quantity')!='')
                        {
                                    $main->quantity = $request->get('quantity');
                        }
                        if($request->get('use_by')!='')
                        {
                                $main->use_by = $request->get('use_by');
                        }
                        if($request->get('expected_delivery')!='')
                        {
                                    $main->expected_delivery = $request->get('expected_delivery');
                        }
                        if($request->get('return_exchange')!='')
                        {
                                $main->return_exchange = $request->get('return_exchange');
                        }
                        if($request->get('dimension')!='')
                        {
                                    $main->dimension = $request->get('dimension');
                        }
                        if($request->get('manufacturers')!='')
                        {
                                $main->manufacturers = $request->get('manufacturers');
                        }
                        if($request->get('material')!='')
                        {
                                    $main->material = $request->get('material');
                        }
                        if($request->get('firmness')!='')
                        {
                                $main->firmness = $request->get('firmness');
                        }
                        if($request->get('thickness')!='')
                        {
                                    $main->thickness = $request->get('thickness');
                        }
                        if($request->get('trial_period')!='')
                        {
                                $main->trial_period = $request->get('trial_period');
                        }
                        if($request->get('inventory')!='')
                        {
                                    $main->inventory = $request->get('inventory');
                        }
                        if($request->get('iscustomizable')!=''){
                            $main->iscustomizable = $request->get('iscustomizable');
                        }
                        if($request->get('isegg')!=''){
                            $main->isegg = $request->get('isegg');
                        }
                        if($request->get('isveg')!=''){
                            $main->isveg= $request->get('isveg');
                        }
                      $main->save();

     		return response()->json([
                    'status' => "1",
		    "msg" => "success",
                    'data' => $main

                ]);


            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }


public function get_product_formui(Request $request) {
          $esatatus = Admin::where('_id','=', $request->admin_auto_id)->whereNull('deleted_at')->get();
             if($esatatus->isNotEmpty()){
                foreach($esatatus as $erase){
                     $erase_data_status=$erase->erase_data_status;
                }
             }else{
                 $erase_data_status='No';
             }
        if($erase_data_status =='Yes'){
           $getprduilist = ProductFormUI::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }else{
           $getprduilist = ProductFormUI::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if($getprduilist->isNotEmpty()){
            return response()->json(['status' => 1, "msg" => "success", 'getdatalist' => $getprduilist]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

}