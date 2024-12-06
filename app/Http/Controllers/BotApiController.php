<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HomeComponent;
use App\ComponentContent;
use App\HomeComponentSubCategories;
use App\HomeComponentTopBrands;
use App\Categories;
use App\Subcategories;
use App\OfferComponent;
use App\HomeProductComponent;
use App\AdminProducts;
use App\SizeLists;
use App\AdminProductImages;
use App\EcommRegistration;
use App\ProductRatingReview;
use App\HomeComponentMainCategories;
use App\Currency;
use App\CountryProductPrice;
use App\Admin;
use App\UserRegister;
use App\Brand;
use DateTimeZone;
use DateTime;
use DB;

class BotApiController extends Controller
{

    public function get_home_component_list(Request $request)
    {
        //      $getmain_categorylist = Categories::where('user_auto_id','=',$request->get('user_auto_id'))->where('status','=','Purchased')->ORDERBY('_id','DESC')->get();
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $get_home_component_list = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('show_on_home', 'true')
                ->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $get_home_component_list = HomeComponent::where('admin_auto_id', $request->admin_auto_id)
                ->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")
                ->where('show_on_home', 'true')
                ->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }

        if ($get_home_component_list->isNotEmpty()) {
            foreach ($get_home_component_list as $comp) {
                $comp["component_index_int"] = intval($comp->component_index);
            }
        }

        $collect = collect($get_home_component_list);
        $get_home_component_lists = $collect->sortBy('component_index_int')->values()->all();

        if (!empty($get_home_component_lists)) {
            return response()->json(['status' => 1, "msg" => "success", 'get_home_component_list' => $get_home_component_lists]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
        public function get_home_component_remaining_data(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {

            if ($request->component_type == "Slider")
            {
                $get_home_component_details = HomeComponent::select('title','background_color','icon_type',
                'icon_type','layout_type','title_font','title_color','label_font','label_color','web_background_color',
                'web_icon_type','web_layout_type','web_title_color',
                'web_title_font','web_code','show_in_category','show_on_home','height')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)
                ->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->whereNull('deleted_at')->get();
            }else if($request->component_type == "Banner")
            {
                $get_home_component_details = HomeComponent::select('title','background_color','icon_type',
                'icon_type','layout_type','title_font','title_color','label_font','label_color','web_background_color',
                'web_icon_type','web_layout_type','web_title_color',
                'web_title_font','web_code','show_in_category','show_on_home', 'height')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)
                ->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->whereNull('deleted_at')->get();
            }else 
            {
                $get_home_component_details = HomeComponent::select('title','background_color','icon_type',
                'icon_type','layout_type','title_font','title_color','label_font','label_color','web_background_color',
                'web_icon_type','web_layout_type','web_title_color',
                'web_title_font','web_code','show_in_category','show_on_home')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)
                ->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->whereNull('deleted_at')->get();
            }
          
   $table_columns = array_keys(json_decode($get_home_component_details, true));
    
        } else {
          $get_home_component_details = HomeComponent::select('title','background_color','icon_type','icon_type','layout_type','title_font','title_color','label_font','label_color','web_background_color','web_icon_type','web_layout_type','web_title_color','web_title_font','web_code','show_in_category','show_on_home')->where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
 $table_columns = array_keys(json_decode($get_home_component_details, true));
        }
             $kcount=[];
            if (!empty($table_columns)) {
                foreach($get_home_component_details as $value)
        {
            $table_columns = array_keys(json_decode($value, true));

            $colCount = [];

            foreach($table_columns as $cl)
            {
                if($cl != "_id")
                {
                    $colCount[] =  $cl;

                }
                

            }
            $kcount[] = array("id"=> $value->id, "cols"=>$colCount);

                                   return response()->json(['status' => 1, "msg" => "success", 'data' => $kcount]);
            } 
        }else {
                return response()->json(['status' => 0, "msg" => "No Data Available"]);
            }
         
    }

 //    public function get_home_component_remaining_data(Request $request)
 //    {
 //        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
 //        if ($esatatus->isNotEmpty()) {
 //            foreach ($esatatus as $erase) {
 //                $erase_data_status = $erase->erase_data_status;
 //            }
 //        } else {
 //            $erase_data_status = 'No';
 //        }
 //        if ($erase_data_status == 'Yes') {
 //            $get_home_component_details = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->get();
 //   $table_columns = array_keys(json_decode($get_home_component_details, true));
    
 //        } else {
 //          $get_home_component_details = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->where('app_type_id', $request->app_type_id)->get();
 // $table_columns = array_keys(json_decode($get_home_component_details, true));
 //        }
 //             $kcount=[];
 //            if (!empty($table_columns)) {
 //                foreach($get_home_component_details as $value)
 //        {
 //            $table_columns = array_keys(json_decode($value, true));

 //            $colCount = [];

 //            foreach($table_columns as $cl)
 //            {
 //                if ($value->$cl == '')
 //                {
 //                    $colCount[] =  $cl;

 //                }
 //            }
 //            $kcount[] = array("id"=>$value->id, "cols"=>$colCount);

 //                                   return response()->json(['status' => 1, "msg" => "success", 'data' => $kcount]);
 //            } 
 //        }else {
 //                return response()->json(['status' => 0, "msg" => "No Data Available"]);
 //            }
         
 //    }




    public function add_new_home_component(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $check = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $check = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }
        if ($check->isEmpty()) {
            $component = new HomeComponent();


            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');
            if ($request->get('admin_auto_id') != '') {
                $component->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $component->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $component->app_type_id = $request->get('app_type_id');
            } else {
                $component->app_type_id = "";
            }
            //Component Type
            if ($request->get('component_type') != '') {
                $component->component_type = $request->get('component_type');
            } else {
                $component->component_type = "";
            }

            //title
            if ($request->get('title') != '') {
                $component->title = $request->get('title');
            } else {
                $component->title = "";
            }

            //Background Color
            if ($request->get('background_color') != '') {
                $component->background_color = $request->get('background_color');
            } else {
                $component->background_color = "";
            }

            //Height
            if ($request->get('height') != '') {
                $component->height = $request->get('height');
            } else {
                $component->height = "";
            }


            //icon_type
            if ($request->get('icon_type') != '') {
                $component->icon_type = $request->get('icon_type');
            } else {
                $component->icon_type = "";
            }



            //layout_type
            if ($request->get('layout_type') != '') {
                $component->layout_type = $request->get('layout_type');
            } else {
                $component->layout_type = "";
            }


            //title_font
            if ($request->get('title_font') != '') {
                $component->title_font = $request->get('title_font');
            } else {
                $component->title_font = "";
            }


            //title_color
            if ($request->get('title_color') != '') {
                $component->title_color = $request->get('title_color');
            } else {
                $component->title_color = "";
            }

            //title_size
            if ($request->get('title_size') != '') {
                $component->title_size = $request->get('title_size');
            } else {
                $component->title_size = "";
            }



            //label_font
            if ($request->get('label_font') != '') {
                $component->label_font = $request->get('label_font');
            } else {
                $component->label_font = "";
            }


            //label_color
            if ($request->get('label_color') != '') {
                $component->label_color = $request->get('label_color');
            } else {
                $component->label_color = "";
            }


            //web_background_color
            if ($request->get('web_background_color') != '') {
                $component->web_background_color = $request->get('web_background_color');
            } else {
                $component->web_background_color = "";
            }



            //web_height
            if ($request->get('web_height') != '') {
                $component->web_height = $request->get('web_height');
            } else {
                $component->web_height = "";
            }


            //web_icon_type
            if ($request->get('web_icon_type') != '') {
                $component->web_icon_type = $request->get('web_icon_type');
            } else {
                $component->web_icon_type = "";
            }


            //web_layout_type
            if ($request->get('web_layout_type') != '') {
                $component->web_layout_type = $request->get('web_layout_type');
            } else {
                $component->web_layout_type = "";
            }


            //web_title_color
            if ($request->get('web_title_color') != '') {
                $component->web_title_color = $request->get('web_title_color');
            } else {
                $component->web_title_color = "";
            }


            //web_title_font
            if ($request->get('web_title_font') != '') {
                $component->web_title_font = $request->get('web_title_font');
            } else {
                $component->web_title_font = "";
            }


            //web_code
            if ($request->get('web_code') != '') {
                $component->web_code = $request->get('web_code');
            } else {
                $component->web_code = "";
            }

            //show_in_category
            if ($request->get('show_in_category') != '') {
                $component->show_in_category = $request->get('show_in_category');
            } else {
                $component->show_in_category = "";
            }

            //show_on_home
            if ($request->get('show_on_home') != '') {
                $component->show_on_home = $request->get('show_on_home');
            } else {
                $component->show_on_home = "";
            }

            if ($request->get('title_background') != '') {
                $component->title_background = $request->get('title_background');
            } else {
                $component->title_background = "";
            }


            if ($request->get('title_alignment') != '') {
                $component->title_alignment = $request->get('title_alignment');
            } else {
                $component->title_alignment = "";
            }



            $component->register_date = date('Y-m-d');
            $default_index = 0;
            $component->component_index = strval($default_index);

            //   strval($integer)
            //  $component->index=$component->increment('index');

            $component->save();



            $inserted_id = $component->_id;
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $components = HomeComponent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->get();
            } else {
                $components = HomeComponent::where('_id', $inserted_id)
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            }
        } else {
            $component = new HomeComponent();


            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');
            if ($request->get('admin_auto_id') != '') {
                $component->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $component->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $component->app_type_id = $request->get('app_type_id');
            } else {
                $component->app_type_id = "";
            }
            //Component Type
            if ($request->get('component_type') != '') {
                $component->component_type = $request->get('component_type');
            } else {
                $component->component_type = "";
            }

            //title
            if ($request->get('title') != '') {
                $component->title = $request->get('title');
            } else {
                $component->title = "";
            }

            //Background Color
            if ($request->get('background_color') != '') {
                $component->background_color = $request->get('background_color');
            } else {
                $component->background_color = "";
            }

            //Height
            if ($request->get('height') != '') {
                $component->height = $request->get('height');
            } else {
                $component->height = "";
            }


            //icon_type
            if ($request->get('icon_type') != '') {
                $component->icon_type = $request->get('icon_type');
            } else {
                $component->icon_type = "";
            }



            //layout_type
            if ($request->get('layout_type') != '') {
                $component->layout_type = $request->get('layout_type');
            } else {
                $component->layout_type = "";
            }


            //title_font
            if ($request->get('title_font') != '') {
                $component->title_font = $request->get('title_font');
            } else {
                $component->title_font = "";
            }


            //title_color
            if ($request->get('title_color') != '') {
                $component->title_color = $request->get('title_color');
            } else {
                $component->title_color = "";
            }

            //title_size
            if ($request->get('title_size') != '') {
                $component->title_size = $request->get('title_size');
            } else {
                $component->title_size = "";
            }



            //label_font
            if ($request->get('label_font') != '') {
                $component->label_font = $request->get('label_font');
            } else {
                $component->label_font = "";
            }


            //label_color
            if ($request->get('label_color') != '') {
                $component->label_color = $request->get('label_color');
            } else {
                $component->label_color = "";
            }


            //web_background_color
            if ($request->get('web_background_color') != '') {
                $component->web_background_color = $request->get('web_background_color');
            } else {
                $component->web_background_color = "";
            }



            //web_height
            if ($request->get('web_height') != '') {
                $component->web_height = $request->get('web_height');
            } else {
                $component->web_height = "";
            }


            //web_icon_type
            if ($request->get('web_icon_type') != '') {
                $component->web_icon_type = $request->get('web_icon_type');
            } else {
                $component->web_icon_type = "";
            }


            //web_layout_type
            if ($request->get('web_layout_type') != '') {
                $component->web_layout_type = $request->get('web_layout_type');
            } else {
                $component->web_layout_type = "";
            }


            //web_title_color
            if ($request->get('web_title_color') != '') {
                $component->web_title_color = $request->get('web_title_color');
            } else {
                $component->web_title_color = "";
            }


            //web_title_font
            if ($request->get('web_title_font') != '') {
                $component->web_title_font = $request->get('web_title_font');
            } else {
                $component->web_title_font = "";
            }


            //web_code
            if ($request->get('web_code') != '') {
                $component->web_code = $request->get('web_code');
            } else {
                $component->web_code = "";
            }
            if ($request->get('show_in_category') != '') {
                $component->show_in_category = $request->get('show_in_category');
            } else {
                $component->show_in_category = "";
            }

            //show_on_home
            if ($request->get('show_on_home') != '') {
                $component->show_on_home = $request->get('show_on_home');
            } else {
                $component->show_on_home = "";
            }
            if ($request->get('title_background') != '') {
                $component->title_background = $request->get('title_background');
            } else {
                $component->title_background = "";
            }


            if ($request->get('title_alignment') != '') {
                $component->title_alignment = $request->get('title_alignment');
            } else {
                $component->title_alignment = "";
            }


            $component->register_date = date('Y-m-d');
            // $component->hm_index = strval($request->increment('hm_index'));

            //   strval($integer)
            //  $component->component_index=$component->increment('component_index');

            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $last_id = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            } else {
                $last_id = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            }
            $last_index = 0;

            foreach ($last_id as $lts) {
                if ($last_index < intval($lts->component_index)) {
                    $last_index = intval($lts->component_index);
                }
            }
            $new_index = $last_index + 1;
            $component->component_index = strval($new_index);

            $component->save();

            $inserted_id = $component->_id;
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $components = HomeComponent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            } else {
                $components = HomeComponent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            }
        }







        if (!empty($components)) {
            return response()->json([
                'status' => "1",
                'data' => $component

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "No Data Available"

            ]);
        }
    }



    // Edit Home Component
    public function edit_home_component(Request $request)
    {


        $component = HomeComponent::find($request->get('homecomponent_auto_id'));
        if (empty($component)) {
            return response()->json(['status' => 0, "msg" => "No Home Component Found"]);
        } else {

            //Component Type
            if ($request->get('component_type') != "") {
                $component->component_type = $request->get('component_type');
            } else {
                $component->component_type = "";
            }

            //title
            if ($request->get('title') != "") {
                $component->title = $request->get('title');
            } else {
                $component->title = "";
            }

            //Background Color
            if ($request->get('background_color') != "") {
                $component->background_color = $request->get('background_color');
            } else {
                $component->background_color = "";
            }

            //Height
            if ($request->get('height') != "") {
                $component->height = $request->get('height');
            } else {
                $component->height = "";
            }


            //icon_type
            if ($request->get('icon_type') != "") {
                $component->icon_type = $request->get('icon_type');
            } else {
                $component->icon_type = "";
            }



            //layout_type
            if ($request->get('layout_type') != "") {
                $component->layout_type = $request->get('layout_type');
            } else {
                $component->layout_type = "";
            }


            //title_font
            if ($request->get('title_font') != "") {
                $component->title_font = $request->get('title_font');
            } else {
                $component->title_font = "";
            }


            //title_color
            if ($request->get('title_color') != "") {
                $component->title_color = $request->get('title_color');
            } else {
                $component->title_color = "";
            }

            //title_size
            if ($request->get('title_size') != "") {
                $component->title_size = $request->get('title_size');
            } else {
                $component->title_size = "";
            }



            //label_font
            if ($request->get('label_font') != "") {
                $component->label_font = $request->get('label_font');
            } else {
                $component->label_font = "";
            }


            //label_color
            if ($request->get('label_color') != "") {
                $component->label_color = $request->get('label_color');
            } else {
                $component->label_color = "";
            }


            //web_background_color
            if ($request->get('web_background_color') != "") {
                $component->web_background_color = $request->get('web_background_color');
            } else {
                $component->web_background_color = "";
            }



            //web_height
            if ($request->get('web_height') != "") {
                $component->web_height = $request->get('web_height');
            } else {
                $component->web_height = "";
            }


            //web_icon_type
            if ($request->get('web_icon_type') != "") {
                $component->web_icon_type = $request->get('web_icon_type');
            } else {
                $component->web_icon_type = "";
            }


            //web_layout_type
            if ($request->get('web_layout_type') != "") {
                $component->web_layout_type = $request->get('web_layout_type');
            } else {
                $component->web_layout_type = "";
            }


            //web_title_color
            if ($request->get('web_title_color') != "") {
                $component->web_title_color = $request->get('web_title_color');
            } else {
                $component->web_title_color = "";
            }


            //web_title_font
            if ($request->get('web_title_font') != "") {
                $component->web_title_font = $request->get('web_title_font');
            } else {
                $component->web_title_font = "";
            }

            // web_code
            if ($request->get('web_code') != "") {
                $component->web_code = $request->get('web_code');
            } else {
                $component->web_code = "";
            }

            //show_in_category
            if ($request->get('show_in_category') != "") {
                $component->show_in_category = $request->get('show_in_category');
            } else {
                $component->show_in_category = "";
            }

            //show_on_home
            if ($request->get('show_on_home') != "") {
                $component->show_on_home = $request->get('show_on_home');
            } else {
                $component->show_on_home = "";
            }

            if ($request->get('title_background') != '') {
                $component->title_background = $request->get('title_background');
            } else {
                $component->title_background = "";
            }


            if ($request->get('title_alignment') != '') {
                $component->title_alignment = $request->get('title_alignment');
            } else {
                $component->title_alignment = "";
            }



            $component->save();
            //             $esatatus = Admin::where('_id','=', $request->admin_auto_id)->get();
            //           if($esatatus->isNotEmpty()){
            //                 foreach($esatatus as $erase){
            //                      $erase_data_status=$erase->erase_data_status;
            //                 }
            //           }else{
            //               $erase_data_status='No';
            //           }
            //         if($erase_data_status =='Yes'){
            //                          $cat = HomeComponent::where('_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->get();
            //              }else{
            //                          $cat = HomeComponent::where('_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->get();
            //              }
            // if(!empty($cat))
            // {
            return response()->json([
                'status' => "1",
                'data' => $component

            ]);
            // }
            // else
            // {
            //      return response()->json([
            //                     'status' => "0", 
            //                     'data' => "No Data Available"

            //                 ]);
            // }

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }


    //Delete Home Component 
    public function delete_home_component(Request $request)
    {
        $get_current_id = HomeComponent::find($request->get('homecomponent_auto_id'));
        $component_id = $get_current_id->_id;
        $component_index = $get_current_id->component_index;
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $next = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $next = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }
        //Update component index for remaining components
        if ($next != "") {
            foreach ($next as $charge) {
                if (intval($charge->component_index)  > intval($component_index)) {
                    $next_id = $charge->id;
                    $components_index = intval($charge->component_index) - 1;

                    $home = HomeComponent::find($next_id);
                    $home->component_index = strval($components_index);
                    $home->save();
                }
            }
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $tdetails = HomeComponent::where('_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)->delete();

                $component_content = ComponentContent::where('component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)->delete();

                $ptdetails = HomeComponentSubCategories::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)->delete();

                $pccomponent_content = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
                $pttdetails = OfferComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pcomponent_content = HomeProductComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)->delete();

            } else {
                $tdetails = HomeComponent::where('_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $component_content = ComponentContent::where('component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $ptdetails = HomeComponentSubCategories::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pccomponent_content = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pttdetails = OfferComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pcomponent_content = HomeProductComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            }
        } else {
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $tdetails = HomeComponent::where('_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $component_content = ComponentContent::where('component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $ptdetails = HomeComponentSubCategories::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pccomponent_content = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pttdetails = OfferComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pcomponent_content = HomeProductComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

            } else {
                $tdetails = HomeComponent::where('_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $component_content = ComponentContent::where('component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $ptdetails = HomeComponentSubCategories::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pccomponent_content = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();

                $pttdetails = OfferComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
                
                $pcomponent_content = HomeProductComponent::where('home_component_auto_id', '=', $request->get('homecomponent_auto_id'))
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            }
        }



        return response()->json([
            'status' => '1',
            'msg' => "Sucessfully Deleted"
        ]);
    }




    // Add Component Image
    public function add_component_image(Request $request)
    {

        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $checkcomponent = HomeComponent::where('_id', $request->homecomponent_auto_id)
            ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->first();
        } else {
            $checkcomponent = HomeComponent::where('_id', $request->homecomponent_auto_id)
            ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->first();
        }
        if (empty($checkcomponent)) {
            return response()->json([
                'status' => 0,
                'msg' => 'This Component  does not exists..!',
            ]);
        } else {

            $type = $checkcomponent->component_type;


            $content = new ComponentContent();
            if ($type == "Slider") {

                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_slider = ComponentContent::where('title', 'Slider')->where('component_auto_id', $request->homecomponent_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
                } else {
                    $check_slider = ComponentContent::where('title', 'Slider')->where('component_auto_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
                }
                if ($check_slider->isEmpty()) {
                    if (!empty($request->file('component_image'))) {
                        $file = $request->file('component_image');
                        $filename = $file->getClientOriginalName();
                        $path = public_path('images/slider');

                        $file->move($path, $filename);
                        $content->component_image = $filename;
                    } else {
                        $content->component_image = "";
                    }

                    $default_index = 0;
                    $content->slider_index = strval($default_index);
                } else {
                    if (!empty($request->file('component_image'))) {
                        $file = $request->file('component_image');
                        $filename = $file->getClientOriginalName();
                        $path = public_path('images/slider');
                        $file->move($path, $filename);
                        $content->component_image = $filename;
                    } else {
                        $content->component_image = "";
                    }


                    $new_index = 1;
                    $content->slider_index = strval($new_index);
                }
            }


            if ($type == "Banner") {

                if (!empty($request->file('component_image'))) {
                    $file = $request->file('component_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/slider');
                    $file->move($path, $filename);
                    $content->component_image = $filename;
                } else {
                    $content->component_image = "";
                }
            }



            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            $content->title = $type;
            $content->component_auto_id = $request->homecomponent_auto_id;
            $content->register_date = date('Y-m-d');
            if ($request->get('admin_auto_id') != '') {
                $content->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $content->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $content->app_type_id = $request->get('app_type_id');
            } else {
                $content->app_type_id = "";
            }
            $content->save();
        }
        $inserted_id = $content->id;

        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $component = ComponentContent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $component = ComponentContent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }
        if (!empty($component)) {
            return response()->json([
                'status' => "1",
                'data' => [$component]

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "No Data Available"

            ]);
        }
    }


    // Update Component content
    public function edit_component_image(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $main = ComponentContent::where('component_auto_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('_id', $request->image_auto_id)->get();
        } else {
            $main = ComponentContent::where('component_auto_id', $request->homecomponent_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('_id', $request->image_auto_id)->get();
        }
        // $main = ComponentContent::find($request->get('homecomponent_auto_id'));
        if (empty($main)) {
            return response()->json(['status' => 0, "msg" => "No Home Component Found"]);
        } else {


            if (!empty($request->file('component_image'))) {
                $file = $request->file('component_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/slider');
                $file->move($path, $filename);
                // $main->component_image = $filename;
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $update = ComponentContent::where('_id', $request->image_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(["component_image" => $filename]);
                } else {
                    $update = ComponentContent::where('_id', $request->image_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(["component_image" => $filename]);
                }
            }






            // $main->save();         
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $cat = ComponentContent::where('_id', $request->image_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            } else {
                $cat = ComponentContent::where('_id', $request->image_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            }
            if (!empty($cat)) {
                return response()->json([
                    'status' => "1",
                    'data' => [$cat]

                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "No Data Available"

                ]);
            }

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }


    //Delete component content
    public function delete_component_image(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $tdetails = ComponentContent::where('_id', '=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        } else {
            $tdetails = ComponentContent::where('_id', '=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        }
        if ($tdetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([

                'status' => 0,

                'msg' => "Component Not registered"

            ]);
        }
    }

    //Home Component Top Brands

    public function add_home_component_top_brands(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $check = HomeComponentTopBrands::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $check = HomeComponentTopBrands::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }
        if ($check->isNotEmpty()) {
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $update = HomeComponentTopBrands::Where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['brand_auto_id' => $request->get('brand_auto_id')]);
                $component = HomeComponentTopBrands::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            } else {
                $update = HomeComponentTopBrands::Where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['brand_auto_id' => $request->get('brand_auto_id')]);
                $component = HomeComponentTopBrands::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            }
        } else {

            $component = new HomeComponentTopBrands();


            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');
            if ($request->get('admin_auto_id') != '') {
                $component->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $component->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $component->app_type_id = $request->get('app_type_id');
            } else {
                $component->app_type_id = "";
            }
            $component->home_component_auto_id = $request->get('home_component_auto_id');
            $component->brand_auto_id = $request->get('brand_auto_id');


            $component->register_date = date('Y-m-d');



            $component->save();




            $inserted_id = $component->id;
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $component = HomeComponentTopBrands::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            } else {
                $component = HomeComponentTopBrands::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
            }
        }







        if (!empty($component)) {
            return response()->json([
                'status' => "1",
                'data' => $component

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "No Data Available"

            ]);
        }
    }


    // Get Home Top Brands
    public function get_home_top_brands(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $get_home_top_brands = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->ORDERBY('_id', 'ASC')->get();
        } else {
            $get_home_top_brands = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->ORDERBY('_id', 'ASC')->get();
        }
        if ($get_home_top_brands->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_home_component_list' => $get_home_top_brands]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    //Home Component Main category

    public function add_home_component_main_categories(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $chk = HomeComponentMainCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
        } else {
            $chk = HomeComponentMainCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }
        if ($chk->isEmpty()) {
            $component = new HomeComponentMainCategories();


            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            if ($request->get('admin_auto_id') != '') {
                $component->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $component->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $component->app_type_id = $request->get('app_type_id');
            } else {
                $component->app_type_id = "";
            }
            $component->home_component_auto_id = $request->get('home_component_auto_id');
            $component->main_category_auto_id = $request->get('main_category_auto_id');

            $component->register_date = date('Y-m-d');



            $component->save();




            //      $inserted_id=$component->id;

        } else {



            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {

                $update = HomeComponentMainCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(["main_category_auto_id" => $request->main_category_auto_id]);
            } else {
                $update = HomeComponentMainCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(["main_category_auto_id" => $request->main_category_auto_id]);
            }
        }
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $component = HomeComponentMainCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $component = HomeComponentMainCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->get();
        }





        if (!empty($component)) {
            return response()->json([
                'status' => "1",
                'data' => $component

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "No Data Available"

            ]);
        }
    }

    //Home Component Sub Categories

    public function add_home_component_sub_categories(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $chk = HomeComponentSubCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $chk = HomeComponentSubCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }
        if ($chk->isEmpty()) {
            $component = new HomeComponentSubCategories();


            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            if ($request->get('admin_auto_id') != '') {
                $component->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $component->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $component->app_type_id = $request->get('app_type_id');
            } else {
                $component->app_type_id = "";
            }
            $component->home_component_auto_id = $request->get('home_component_auto_id');
            $component->sub_category_auto_id = $request->get('sub_category_auto_id');

            $component->register_date = date('Y-m-d');



            $component->save();




            //      $inserted_id=$component->id;

        } else {



            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {

                $update = HomeComponentSubCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(["sub_category_auto_id" => $request->sub_category_auto_id]);
            } else {
                $update = HomeComponentSubCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->update(["sub_category_auto_id" => $request->sub_category_auto_id]);
            }
        }
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $component = HomeComponentSubCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        } else {
            $component = HomeComponentSubCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }




        if (!empty($component)) {
            return response()->json([
                'status' => "1",
                'data' => $component

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "No Data Available"

            ]);
        }
    }



    public function update_home_component_index(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $nexts = HomeComponent::where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)
                ->get();

            $temp = [];
            if ($nexts->isNotEmpty()) {

                foreach ($nexts as $nxts) {
                    if ($request->previous_index < $request->new_index) {
                        if (intval($nxts->component_index) > $request->previous_index && intval($nxts->component_index) <= $request->new_index) {
                            $temp[] = $nxts;
                        }
                    } else {
                        if (intval($nxts->component_index) < $request->previous_index && intval($nxts->component_index) >= $request->new_index) {
                            $temp[] = $nxts;
                        } {
                        }
                    }
                }
                $nexts = $temp;
            }
        } else {
            $nexts = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)
                ->get();

            $temp = [];
            if ($nexts->isNotEmpty()) {

                foreach ($nexts as $nxts) {
                    if ($request->previous_index < $request->new_index) {
                        if (intval($nxts->component_index) > $request->previous_index && intval($nxts->component_index) <= intval($request->new_index)) {
                            $temp[] = $nxts;
                        }
                    } else {
                        if (intval($nxts->component_index) < $request->previous_index && intval($nxts->component_index) >= intval($request->new_index)) {
                            $temp[] = $nxts;
                        }
                    }
                }
                $nexts = $temp;
            }
        }

        if (!empty($nexts)) {
            foreach ($nexts as $nxt) {
                $nxt["index_int"] = intval($nxt->component_index);
            }
        }
        $collect = collect($nexts);

        $nexts =  $collect->sortBy("index_int")->values()->all();

        //When we are moving from bottom to top

        if ($request->previous_index > $request->new_index) {


            if (!empty($nexts)) {
                foreach ($nexts as $charges) {
                    $next_id = $charges->id;
                    $components_index = intval($charges->component_index) + 1;
                    $home = HomeComponent::where("_id", $next_id)->update([
                        "component_index" => strval($components_index)
                    ]);
                }
            }
        }

        //When moving from top to bottom

        if ($request->previous_index < $request->new_index) {

            if (!empty($nexts)) {
                foreach ($nexts as $charges) {
                    $next_id = $charges->id;
                    $components_index = intval($charges->component_index) - 1;
                    $home = HomeComponent::where("_id", $next_id)->update([
                        "component_index" => strval($components_index)
                    ]);
                }
            }
        }




        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $nextsto = HomeComponent::where('app_type_id', $request->app_type_id)
                ->where('admin_auto_id', $request->admin_auto_id)
                ->get();

            $temp = [];
            if ($nextsto->isNotEmpty()) {

                foreach ($nextsto as $nxts) {
                    if (intval($nxts->component_index) >= $request->new_index) {
                        $temp[] = $nxts;
                    }
                }
                $nextsto = $temp;
            }
        } else {
        }
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $update = HomeComponent::where('_id', $request->homecomponent_auto_id)
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)

                ->update(["component_index" => strval($request->new_index)]);


            $cat = HomeComponent::where('_id', $request->homecomponent_auto_id)
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)->get();
        } else {
            $update = HomeComponent::where('_id', $request->homecomponent_auto_id)
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)

                ->update(["component_index" => strval($request->new_index)]);

            $cat = HomeComponent::where('_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->get();
        }

        if (!empty($cat)) {
            return response()->json([
                'status' => "1",
                'data' => [$cat]

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "No Data Available"

            ]);
        }

        return response()->json(['status' => 1, "msg" => config('messages.success')]);
    }


    public function get_main_category_components(Request $request)
    {

        $main_category_auto_id = $request->main_category_auto_id;
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $get = HomeComponent::where('show_in_category', 'LIKE', '%' . $main_category_auto_id . '%')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $get = HomeComponent::where('show_in_category', 'LIKE', '%' . $main_category_auto_id . '%')->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
        }




        if ($get->isNotEmpty()) {
            return response()->json(['status' => '1', "msg" => "success", 'get_main_category_components' => $get]);
        } else {
            return response()->json(['status' => '0', "msg" => "No Data Available"]);
        }
    }
}
