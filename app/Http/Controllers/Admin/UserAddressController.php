<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use DateTime;
use App\Admin;
use DateTimeZone;
use App\Categories;
use App\CategoryStyle;
use App\Subcategories;
use App\ContactDetails;
use App\BusinessDetails;
use App\CartUserAddress;
use App\Traits\Features;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UserAddressController extends Controller

{
    use Features;

    public function get_admin()
    {
        $subdomain = session("main");
        $admin =  Admin::where("subdomain", "=", $subdomain)->first();
        if (empty($admin)) {
            abort(404);
        }

        if (empty($admin)) {
            abort(404);
        }

        return $admin->id;
    }
    public function index_user_address($main)
    {
        $get_main_categories = Categories::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }
        $get_business_details = BusinessDetails::get();
        $get_contact_details = ContactDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $uid = Session::get('AccessTokens');
        $uaddress = CartUserAddress::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();


        return view('templates.frontend.user_address')->with(['user_address' => $uaddress, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
    }



    public function add_user_address($main)
    {
        $get_main_categories = Categories::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }
        $get_business_details = BusinessDetails::get();
        $get_contact_details = ContactDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $uaddress = CartUserAddress::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();


        return view('templates.frontend.add_user_address')->with(['user_address' => $uaddress, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
    }



    public function store_user_address(Request $request)
    {

        $this->validate(

            $request,

            [


                'name'   => 'required',
                'mobile_no'   => 'required',
                'area'   => 'required',
                'city'   => 'required',
                'address_details'   => 'required',
                'address_type'   => 'required',
                'pincode'   => 'required',
                'state'   => 'required',
                'country'   => 'required',


            ],

            [


                'name.required' => 'Enter full name',
                'mobile_no.required' => 'Enter mobile number',
                'area.required' => 'Enter area',
                'city.required' => 'Enter city',
                'address_details.required' => 'Enter address details',
                'address_type.required' => 'Enter address type',
                'pincode.required' => 'Enter pincode',
                'state.required' => 'Enter state',
                'country.required' => 'Enter country',


            ]

        );



        $uid = Session::get('AccessTokens');
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');

        $addresscart = new CartUserAddress();
        $addresscart->user_auto_id = $uid;
        if ($request->get('name') != '') {
            $addresscart->name = $request->get('name');
        } else {
            $addresscart->name = "";
        }
        if ($request->get('mobile_no') != '') {
            $addresscart->mobile_no = $request->get('mobile_no');
        } else {
            $addresscart->mobile_no = "";
        }
        if ($request->get('latitude') != '') {
            $addresscart->latitude = $request->get('latitude');
        } else {
            $addresscart->latitude = "";
        }
        if ($request->get('longitude') != '') {
            $addresscart->longitude = $request->get('longitude');
        } else {
            $addresscart->longitude = "";
        }
        if ($request->get('area') != '') {
            $addresscart->area = $request->get('area');
        } else {
            $addresscart->area = "";
        }
        if ($request->get('city') != '') {
            $addresscart->city = $request->get('city');
        } else {
            $addresscart->city = "";
        }
        if ($request->get('state') != '') {
            $addresscart->state = $request->get('state');
        } else {
            $addresscart->state = "";
        }
        if ($request->get('country') != '') {
            $addresscart->country = $request->get('country');
        } else {
            $addresscart->country = "";
        }
        if ($request->get('address_details') != '') {
            $addresscart->address_details = $request->get('address_details');
        } else {
            $addresscart->address_details = "";
        }
        if ($request->get('address_type') != '') {
            $addresscart->address_type = $request->get('address_type');
        } else {
            $addresscart->address_type = "";
        }
        if ($request->get('pincode') != '') {
            $addresscart->pincode = $request->get('pincode');
        } else {
            $addresscart->pincode = "";
        }
        $addresscart->rdate = date('Y-m-d');
        $addresscart->save();


        return redirect(session('main') . '/user-address')->with('success', 'Added Successfully');
    }

    public function edit_user_address($main, $id)
    {
        $get_main_categories = Categories::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }
        $get_business_details = BusinessDetails::get();
        $get_contact_details = ContactDetails::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();
        $uadd = CartUserAddress::where('_id', '=', $id)->whereNull('deleted_at')->get();



        return view('templates.frontend.edit_user_address')->with(['user_address' => $uadd, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
    }


    public function update_user_address(Request $request)
    {
        $this->validate(

            $request,

            [


                'name'   => 'required',
                'mobile_no'   => 'required',
                'area'   => 'required',
                'city'   => 'required',
                'address_details'   => 'required',
                'address_type'   => 'required',
                'pincode'   => 'required',
                'state'   => 'required',
                'country'   => 'required',


            ],

            [


                'name.required' => 'Enter full name',
                'mobile_no.required' => 'Enter mobile number',
                'area.required' => 'Enter area',
                'city.required' => 'Enter city',
                'address_details.required' => 'Enter address details',
                'address_type.required' => 'Enter address type',
                'pincode.required' => 'Enter pincode',
                'state.required' => 'Enter state',
                'country.required' => 'Enter country',


            ]

        );



        $cuamain = CartUserAddress::find($request->get('id'));
        if ($request->get('name') != '') {
            $cuamain->name = $request->get('name');
        } else {
            $cuamain->name = "";
        }
        if ($request->get('mobile_no') != '') {
            $cuamain->mobile_no = $request->get('mobile_no');
        } else {
            $cuamain->mobile_no = "";
        }
        if ($request->get('latitude') != '') {
            $cuamain->latitude = $request->get('latitude');
        } else {
            $cuamain->latitude = "";
        }
        if ($request->get('longitude') != '') {
            $cuamain->longitude = $request->get('longitude');
        } else {
            $cuamain->longitude = "";
        }
        if ($request->get('area') != '') {
            $cuamain->area = $request->get('area');
        } else {
            $cuamain->area = "";
        }
        if ($request->get('city') != '') {
            $cuamain->city = $request->get('city');
        } else {
            $cuamain->city = "";
        }
        if ($request->get('state') != '') {
            $cuamain->state = $request->get('state');
        } else {
            $cuamain->state = "";
        }
        if ($request->get('country') != '') {
            $cuamain->country = $request->get('country');
        } else {
            $cuamain->country = "";
        }
        if ($request->get('address_details') != '') {
            $cuamain->address_details = $request->get('address_details');
        } else {
            $cuamain->address_details = "";
        }
        if ($request->get('address_type') != '') {
            $cuamain->address_type = $request->get('address_type');
        } else {
            $cuamain->address_type = "";
        }
        if ($request->get('pincode') != '') {
            $cuamain->pincode = $request->get('pincode');
        } else {
            $cuamain->pincode = "";
        }
        $cuamain->save();



        return redirect(session('main') . '/user-address')->with('success', 'Updated Successfully');
    }

    public function delete_user_address($main, $id)

    {

        $promocode = CartUserAddress::find($id);

        $promocode->delete();

        return redirect($main . '/user-address')->with('success', 'Deleted Successfully');
    }
}