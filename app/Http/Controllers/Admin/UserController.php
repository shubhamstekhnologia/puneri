<?php

namespace App\Http\Controllers\Admin;

use DB;
use DateTime;
use App\Admin;
use App\Users;
use App\Country;
use App\Bookings;
use DateTimeZone;
use App\Categories;
use App\MainOrders;
use App\UserDocument;
use App\UserRegister;
use App\CategoryStyle;
use App\Subcategories;
use App\ContactDetails;
use App\DoctorCategory;
use App\BusinessDetails;
use App\Traits\Features;
use App\UserMedicalDetails;
use App\VerifyUserRegister;
use App\UserPersonalDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    use Features;

    public function get_admin()
    {
        // $subdomain = session("main");
        $admin =  Admin::where("subdomain", "=", "puneri")->first();

        // dd($admin);
        if (empty($admin)) {
            abort(404);
        }

        return $admin->id;
    }

    public function send_registration_otp(Request $request)
    {

        $this->validate(
            $request,
            [
                'mobile_number' => 'required',
            ]
        );

        $vusers = VerifyUserRegister::Where('mobile_number', $request->get('mobile_number'))
            ->where('admin_auto_id', $this->get_admin())
            ->whereNull('deleted_at')
            ->first();

        if (!empty($vusers)) {


            if ($vusers->otp_status == 'verified') {

                $user = UserRegister::Where('mobile_number', $request->mobile_number)->where('country_code', 'IN-91')->whereNull('deleted_at')->first();

                if (!empty($user)) {
                    return view('templates.frontend.login')->with(['success' => 'Mobile number verified successfully..!', 'mobile_number' => $request->mobile_number]);
                }

                return view('templates.frontend.register')->with(['success' => 'Mobile number verified successfully..!', 'mobile_number' => $request->mobile_number]);
            }


            $otp = rand(1000, 9999);
            $vusers->otp = $otp;
            $vusers->otp_status = "unverified";

            $smsurl = "https://api.msg91.com/api/v5/otp?otp=" . $otp . "&authkey=241080AlR9lrJsEY85bb5ff15&mobile=" . $request->mobile_number . "&template_id=62847a3e29f604486625d8f6";
            file_get_contents($smsurl);

            if ($vusers->save()) {
                // dd($request->mobile_number);
                return view('templates.frontend.verify_registration_otp')->with('success',  'Otp sent successfully..!')->with(['mobile_number' => $request->mobile_number]);
            }

            return view('templates.frontend.send_registration_otp')->with('error',  'Something went wrong..!');
        }

        $otp = rand(1000, 9999);

        $otps = new  VerifyUserRegister();
        $otps->admin_auto_id = $this->get_admin();
        $otps->mobile_number = $request->get('mobile_number');
        $otps->otp = $otp;
        $otps->otp_status = "unverified";

        $smsurl = "https://api.msg91.com/api/v5/otp?otp=" . $otp . "&authkey=241080AlR9lrJsEY85bb5ff15&mobile=" . $request->mobile_number . "&template_id=62847a3e29f604486625d8f6";
        file_get_contents($smsurl);

        if ($otps->save()) {
            return view('templates.frontend.verify_registration_otp')->with('success',  'Otp sent successfully..!')->with(['mobile_number' => $request->mobile_number]);
        }

        return view('templates.frontend.send_registration_otp')->with('error',  'Something went wrong..!');
    }


    public function verify_registration_otp(Request $request)
    {

        $this->validate(
            $request,
            [
                'mobile_number' => 'required',
                'otp' => 'required',

            ]
        );
        $checkUsers = VerifyUserRegister::where('mobile_number', $request->mobile_number)->where('admin_auto_id', $this->get_admin())->where('otp_status', 'unverified')->orderBy('_id', 'DESC')->whereNull('deleted_at')->first();

        if (!empty($checkUsers)) {
            if ($checkUsers->otp == $request->otp) {

                $checkUsers->otp_status = 'verified';
                $checkUsers->save();

                $user = UserRegister::Where('mobile_number', $request->mobile_number)->where('country_code', 'IN-91')->where('admin_auto_id', $this->get_admin())->whereNull('deleted_at')->first();

                if (!empty($user)) {
                    return view('templates.frontend.login')->with(['success' => 'Mobile number verified successfully..!', 'mobile_number' => $request->mobile_number]);
                }

                return view('templates.frontend.register')->with(['success' => 'Mobile number verified successfully..!', 'mobile_number' => $request->mobile_number]);
            }

            return view('templates.frontend.verify_registration_otp')->with(['error', 'OTP mismatched..!', 'mobile_number' => $request->mobile_number]);
        }

        return view('templates.frontend.verify_registration_otp')->with(['error', 'Something went wrong..!', 'mobile_number' => $request->mobile_number]);

    }

    public function send_login_otp(Request $request)
    {

        $this->validate(
            $request,
            [
                'mobile_number' => 'required',

            ]
        );

        $reg = VerifyUserRegister::Where('mobile_number', $request->mobile_number)->Where('otp_status', "=", 'verified')->where('admin_auto_id', $this->get_admin())->whereNull('deleted_at')->get();

        if ($reg->isNotEmpty()) {

            $vusers = UserRegister::Where('mobile_number', $request->mobile_number)->where('country_code', 'IN-91')->whereNull('deleted_at')->get();

            if ($vusers->isNotEmpty()) {
                $otp = rand(1000, 9999);

                $otps = UserRegister::Where('mobile_number', $request->mobile_number)->where('country_code', 'IN-91')->update(['login_otp' => strval($otp)]);
                // $otps->save();
                $smsurl = "https://api.msg91.com/api/v5/otp?otp=" . $otp . "&authkey=241080AlR9lrJsEY85bb5ff15&mobile=" . $request->mobile_number . "&template_id=62847a3e29f604486625d8f6";
                file_get_contents($smsurl);

                if ($otps) {

                    return view('templates.frontend.store_login')->with(['success' => 'Otp sent successfully..!', 'mobile_number' => $request->mobile_number]);
                }

                return view('templates.frontend.login')->with('error', 'Something went wrong, Please try again..!');
            }
            return view('templates.frontend.login')->with('error', 'Something went wrong, Please try again..!');

        }
        return view('templates.frontend.send_registration_otp')->with('error',  'You don\'t have verified your contact, Please verify first..!');

    }


    public function login()
    {
        return view('templates.frontend.login');
    }

    public function profile_user()
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
        $get_contact_details = ContactDetails::get();
        $user = Users::where('_id', '=', Session::get('AccessTokens'))->get();

        $features = $this->getfeatures();
        if (empty($features)) {
            return redirect('')->with('error', "Something went wrong");
        } else {
            return view('templates.frontend.user_profile')->with(['profiles' => $user, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'allfeatures' => $features]);
        }
    }


    public function store_login(Request $request)
    {

        $this->validate(
            $request,
            [
                'mobile_number' => 'required',
                'otp' => 'required',

            ]
        );

        $checkuser = UserRegister::where('mobile_number', $request->mobile_number)
            ->where('admin_auto_id', $this->get_admin())->where('country_code', 'IN-91')->whereNull('deleted_at')->first();

        if ($checkuser) {
            if ($checkuser->status ==  "Block") {

                return Redirect::back()->with('error', 'Sorry, Your account is blocked..!');
            } else {

                // $checkotp = UserRegister::where('mobile_number', $request->mobile_number)->where('admin_auto_id', $request->admin_auto_id)->where('country_code', $request->country_code)->whereNull('deleted_at')->first();

                if ($checkuser->login_otp == $request->otp) {

                    Session::put('AccessTokens', $checkuser->id);
                    Session::put('user_name', $checkuser->name);
                    Session::put('user_no', $checkuser->mobile_number);
                    // check app builder feature

                    $features = $this->getfeatures();

                    if (empty($features)) {
                        return Redirect::back()->with(['error', "Something went wrong", "show_login" => 1]);
                    } else {
                        // return Redirect::back()->with('login_success', 'You have been succesfully logged in, enjoy shopping!!');

                        if ($checkuser->status == 'verified') {

                            $subdomain = 'puneri';

                            session()->put("main", $subdomain);

                            return redirect($subdomain . '/ecommerce');
                        }else{
                            return redirect('upload_documents');
                        }
                    }
                } else {

                    return view('templates.frontend.store_login')->with(['error' => 'OTP mismatched..!', 'mobile_number' => $request->mobile_number]);
                }
            }
        }
        return view('templates.frontend.send_registration_otp')->with('error',  'You don\'t have verified your contact, Please verify first..!');
    }

    public function register_user()
    {

        $country = Country::get();

        return view('templates.frontend.register')->with(['country' => $country]);
    }
    public function store_user(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required',
                'contact' => 'required',
                // 'password' => 'required',
                // 'country_code' => 'required',
            ],
            [
                'name.required' => 'Enter name',
                'email.required' => 'Enter email id',
                'contact.required' => 'Enter contact',
                // 'password.required' => 'Enter Password',
                // 'country_code.required' => 'Select Country',

            ]
        );

        // get current time

        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

        // $rdate =  $date->format('Y-m-d H:i:s');

        $rtime = $date->format('H:i:s');



        $getcustomeremail = UserRegister::where('email_id', '=', $request->get('email'))->get();

        $getcustomercontact = UserRegister::where('mobile_number', '=', $request->get('contact'))->get();



        // Check email exist or not

        if ($getcustomeremail->isNotEmpty()) {


            return Redirect::back()->with(['error' => 'an account already exist with this email', "show_register" => 1]);
        }

        // Check contact exist or not

        else if ($getcustomercontact->isNotEmpty()) {


            return Redirect::back()->with(["error" => 'an account already exist with this contact', "show_register" => 1]);
        }

        // Save data

        else {

            $customer = new UserRegister();

            if (!empty($request->file('profile_photo'))) {
                $file = $request->file('profile_photo');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/profile');

                $file->move($path, $filename);
                $customer->profile_photo = $filename;
            } else {
                $customer->profile_photo = "";
            }
            // name, mobile_number, email_id, have_retail_shop, address ,update_on_whastapp, user_type, country_code, country, token, admin_auto_id

            $a_id = $this->get_admin();

            $customer->admin_auto_id = $a_id;

            $customer->name = $request->get('name');

            $customer->email_id = $request->get('email');

            $customer->mobile_number = $request->get('contact');

            $customer->password = password_hash($request->get('password'), PASSWORD_BCRYPT);

            // $customer->status = 'Unblock';

            $customer->status = 'unverified';

            if ($request->get('token') != '') {
                $customer->token = $request->get('token');
            } else {
                $customer->token = "";
            }
            if ($request->get('have_retail_shop') != '') {
                $customer->have_retail_shop = $request->get('have_retail_shop');
            } else {
                $customer->have_retail_shop = "";
            }
            if ($request->get('update_on_whatsapp') != '') {
                $customer->update_on_whatsapp = $request->get('update_on_whatsapp');
            } else {
                $customer->update_on_whatsapp = "";
            }

            if ($request->get('user_type') != '') {
                $customer->user_type = $request->get('user_type');
            } else {
                $customer->user_type = "customer";
            }
            if ($request->get('country_code') != '') {
                $customer->country_code = "IN-91";
            } else {
                $customer->country_code = "IN-91";
            }
            if ($request->get('country') != '') {
                $customer->country = "India";
            } else {
                $customer->country = "India";
            }

            // if (!empty($request->file('gst_docs'))) {
            //     $file1 = $request->file('gst_docs');
            //     $filename1 = $file1->getClientOriginalName();
            //     $path1 = 'images/documents/';
            //     $file1->move($path1, $filename1);
            //     $customer->gst_docs = $filename1;
            // } else {
            //     $customer->gst_docs = '';
            // }


            // if (!empty($request->file('shop_act_docs'))) {
            //     $file2 = $request->file('shop_act_docs');
            //     $filename2 = $file2->getClientOriginalName();
            //     $path2 = 'images/documents/';
            //     $file2->move($path2, $filename2);
            //     $customer->shop_act_docs = $filename2;
            // } else {
            //     $customer->shop_act_docs = '';
            // }

            // if (!empty($request->file('company_reg_cetificate'))) {
            //     $file3 = $request->file('company_reg_cetificate');
            //     $filename3 = $file3->getClientOriginalName();
            //     $path3 = 'images/documents/';
            //     $file3->move($path3, $filename3);
            //     $customer->company_reg_cetificate = $filename3;
            // } else {
            //     $customer->company_reg_cetificate = '';
            // }

            $customer->city = "";
            $customer->address = "";
            $customer->min_order_value = "";
            $customer->price_range = "";
            $customer->login_otp = "";
            $customer->register_date = date('Y-m-d');
            $customer->save();

            $id = $customer->id;
            Session::put('AccessTokens', $id);
            Session::put('user_name', $request->get('name'));
            Session::put('user_no', $request->get('contact'));

            return redirect('login')->with(["success" => "You have been registered successfully"]);
        }
    }

    public function change_password()
    {
        $features = $this->getfeatures();
        if (empty($features)) {
            return redirect('')->with('error', "Something went wrong");
        } else {

            return view('templates.frontend.change_pass')->with(['allfeatures' => $features]);
        }
    }


    public function update_change_password(Request $request)
    {

        $sid =  Session::get('AccessTokens');

        $this->validate($request, [
            'oldp' => 'required',
            'newp' => 'required'
        ], [
            'oldp.required' => 'Please enter old password',
            'newp.required' => 'Please enter new password',
        ]);

        $oldp =  $request->get('oldp');
        $newp =  $request->get('newp');
        $npassword = password_hash($newp, PASSWORD_BCRYPT);

        $datapwd = UserRegister::select('password')->where('_id', $sid)->get();
        foreach ($datapwd as $dpwd) {
            $dbpwd = $dpwd->password;
        }

        if (password_verify($oldp, $dbpwd)) {
            DB::table('UserRegister')
                ->where('_id', $sid)
                ->update(['password' => $npassword]);


            $features = $this->getfeatures();
            if (empty($features)) {
                return redirect('')->with('error', "Something went wrong");
            } else {
                return redirect('change-password')->with('Success', "Password Changed Successfully.");;
            }
        } else {
            return redirect('change-password')->with('error', "Old Password does not match , Please try again.");;
        }
    }

    public function update_profile(Request $request)
    {

        $sid =  Session::get('AccessTokens');

        // $this->validate($request,[
        //   'name' => 'required',
        //   'admin_username' => 'required',
        //   'contact' => 'required',
        //   'email' => 'required'
        // ],[
        //   'name.required' => 'Please enter admin name',
        //   'admin_username.required' => 'Please enter username',
        //   'contact.required' => 'Please enter contact number',
        //   'email.required' => 'Please enter email-id'
        // ]);

        $get_data = UserRegister::where('_id', $sid)->get();

        if ($get_data->isNotEmpty()) {

            DB::table('UserRegister')->where('_id', $sid)->update(['name' => $request->input('name'), 'mobile_number' => $request->input('contact'), 'email_id' => $request->input('email'), 'address' => $request->input('address'), 'city' => $request->input('city'), 'pincode' => $request->input('pincode')]);

            return redirect('profile-user')->with('Success', "Profile has been updated successfully");
        } else {
            return redirect('profile-user')->with('error', "Something went wrong, Please try again.");
        }
    }

    public function logout_user(Request $request)
    {
        Session::forget(Session::get('AccessTokens'));
        Session::flush();
        $request->session()->flush();
        return redirect('login')->with('Success', 'Successfully Logged Out');
    }

    public function upload_documents(Request $request)
    {

        $cust_auto_id = Session::get('AccessTokens');
        $admin_auto_id = $this->get_admin();
        $submit = 'false';

        $adhar = UserDocument::where('type_of_image', 'aadhar_docs')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

        // dd($adhar);
        $adhar_status =  $adhar->status ?? '';
        if ($adhar_status == 'reupload' || $adhar_status == '') {
            $submit = 'true';
        }

        $pan = UserDocument::where('type_of_image', 'pan_card_doc')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

        $pan_status =  $pan->status ?? '';
        if ($pan_status == 'reupload' || $pan_status == '') {
            $submit = 'true';
        }

        $act = UserDocument::where('type_of_image', 'shop_act_docs')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

        $act_status =  $act->status ?? '';
        if ($act_status == 'reupload' || $act_status == '') {
            $submit = 'true';
        }

        $fssai = UserDocument::where('type_of_image', 'fssai_docs_certificate')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

        $fssai_status =  $fssai->status ?? '';
        if ($fssai_status == 'reupload' || $fssai_status == '') {
            $submit = 'true';
        }

        return view('templates.frontend.documents')->with([
            'adhar_status' => $adhar_status, 'pan_status' => $pan_status, 'act_status' => $act_status,
            'fssai_status' => $fssai_status, 'submit' => $submit
        ]);
    }



    public function store_document(Request $request)
    {

        $cust_auto_id = Session::get('AccessTokens');
        $admin_auto_id = $this->get_admin();

        if (!empty($request->file('aadhar_docs'))) {

            $uploadImage = UserDocument::where('type_of_image', 'aadhar_docs')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

            if (!empty($uploadImage)) {
                $file = $request->file('aadhar_docs');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;
                $uploadImage->status = 'unverified';

                $uploadImage->save();
            } else {
                $uploadImage = new UserDocument();
                $uploadImage->cust_auto_id = $cust_auto_id;
                $uploadImage->admin_auto_id = $admin_auto_id;
                $uploadImage->type_of_image = 'aadhar_docs';
                $uploadImage->status = 'unverified';
                $uploadImage->reason = '';

                $file = $request->file('aadhar_docs');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;

                $uploadImage->save();
            }
        }



        if (!empty($request->file('pan_card_doc'))) {

            $uploadImage = UserDocument::where('type_of_image', 'pan_card_doc')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

            if (!empty($uploadImage)) {
                $file = $request->file('pan_card_doc');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;
                $uploadImage->status = 'unverified';

                $uploadImage->save();
            } else {
                $uploadImage = new UserDocument();
                $uploadImage->cust_auto_id = $cust_auto_id;
                $uploadImage->admin_auto_id = $admin_auto_id;
                $uploadImage->type_of_image = 'pan_card_doc';
                $uploadImage->status = 'unverified';
                $uploadImage->reason = '';

                $file = $request->file('pan_card_doc');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;

                $uploadImage->save();
            }
        }

        if (!empty($request->file('shop_act_docs'))) {

            $uploadImage = UserDocument::where('type_of_image', 'shop_act_docs')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

            if (!empty($uploadImage)) {
                $file = $request->file('shop_act_docs');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;
                $uploadImage->status = 'unverified';

                $uploadImage->save();
            } else {
                $uploadImage = new UserDocument();
                $uploadImage->cust_auto_id = $cust_auto_id;
                $uploadImage->admin_auto_id = $admin_auto_id;
                $uploadImage->type_of_image = 'shop_act_docs';
                $uploadImage->status = 'unverified';
                $uploadImage->reason = '';

                $file = $request->file('shop_act_docs');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;

                $uploadImage->save();
            }
        }


        if (!empty($request->file('fssai_docs_certificate'))) {

            $uploadImage = UserDocument::where('type_of_image', 'fssai_docs_certificate')->where('admin_auto_id', $admin_auto_id)->where('cust_auto_id', $cust_auto_id)->first();

            if (!empty($uploadImage)) {
                $file = $request->file('fssai_docs_certificate');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;
                $uploadImage->status = 'unverified';

                $uploadImage->save();
            } else {
                $uploadImage = new UserDocument();
                $uploadImage->cust_auto_id = $cust_auto_id;
                $uploadImage->admin_auto_id = $admin_auto_id;
                $uploadImage->type_of_image = 'fssai_docs_certificate';
                $uploadImage->status = 'unverified';
                $uploadImage->reason = '';

                $file = $request->file('fssai_docs_certificate');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/documents');
                $file->move($path, $filename);
                $uploadImage->document_image = $filename;

                $uploadImage->save();
            }
        }

        return redirect('login')->with('success', "Documents uploaded successfully, please wait for admin approval..!");
    }


    public function forgot_password()
    {
        $get_main_categories = Categories::all();
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
        $get_contact_details = ContactDetails::get();
        $features = $this->getfeatures();
        if (empty($features)) {
            return redirect('')->with('error', "Something went wrong");
        } else {

            return view('templates.frontend.forgot')->with(['main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'allfeatures' => $features]);
        }
    }
    public function update_forgot_password(Request $request)
    {

        if ((!filter_var(($request->get('email')), FILTER_VALIDATE_EMAIL)) || ($request->get('email')) == '') {


            return redirect('forgot-password')->with('error', 'Invalid email format');
        } else {

            $ruser = UserRegister::where('email_id', '=', $request->get('email'))->get();

            if (empty($ruser)) {

                return redirect('forgot-password')->with('error', 'an account not exist with this email');
            } else {

                $characters = '123456789abcdefghijklmnpqrstuvwxyz';

                $charactersLength = strlen($characters);

                $randomString = '';

                for ($i = 0; $i < 6; $i++) {

                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $password = password_hash($randomString, PASSWORD_BCRYPT);

                DB::table('UserRegister')->where('email_id', '=', $request->get('email'))
                    ->update(['password' => $password]);

                $subject = "Your New Password";

                $header = "From: vaibhav.efunhub@gmail.com";

                $content = "This is to inform you that your password has been reset to : " . $randomString . "\n\n\nThanks & Regards";



                mail($request->get('email'), $subject, $content, $header);

                return redirect('forgot-password')->with('Success', 'Sent Mail Successfully, Please check');
            }
        }
    }
}
