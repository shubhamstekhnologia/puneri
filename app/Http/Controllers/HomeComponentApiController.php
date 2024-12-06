<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use App\Admin;
use App\Brand;
use App\Currency;
use DateTimeZone;
use App\SizeLists;
use App\Categories;
use App\UserRegister;
use App\AdminProducts;
use App\HomeComponent;
use App\Subcategories;
use App\OfferComponent;
use App\BusinessDetails;
use App\ComponentContent;
use App\EcommRegistration;
use App\AdminProductImages;
use App\CountryProductPrice;
use App\ProductRatingReview;
use Illuminate\Http\Request;
use App\HomeProductComponent;
use App\HomeComponentTopBrands;
use App\HomeComponentSubCategories;
use App\HomeComponentMainCategories;
use App\Http\Controllers\Controller;

class HomeComponentApiController extends Controller
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

    public function get_home_component_details(Request $request)
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
            $get_home_component_details = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->whereNull('deleted_at')->get();
        } else {
            $get_home_component_details = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', $request->get('component_type'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        $i = 0;
        foreach ($get_home_component_details as $list) {
            $id = $list->_id;
            if ($list->component_type == "Slider") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $component_content = ComponentContent::where('component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $component_content = ComponentContent::where('component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                $get_home_component_details[$i]['content'] = $component_content;
            }

            if ($list->component_type == "Banner") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $component_content = ComponentContent::where('component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $component_content = ComponentContent::where('component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                $get_home_component_details[$i]['content'] = $component_content;
            }
            if ($list->component_type == "Offers") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $component_content = OfferComponent::where('homecomponent_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $component_content = OfferComponent::where('homecomponent_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                $get_home_component_details[$i]['content'] = $component_content;
            }

            if ($list->component_type == "Recommneded Product") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $component_content = HomeComponent::where('_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $component_content = HomeComponent::where('_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                $get_home_component_details[$i]['content'] = $component_content;
            }

            if ($list->component_type == "Products") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $check_component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($component_content as $cc) {
                        $product_auto_id = $cc->product_auto_id;
                        $product_auto_ids = explode('|', $product_auto_id);
                        unset($get_slists);
                        foreach ($product_auto_ids as $product) {

                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {

                                $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                if ($country_user->isNotEmpty()) {
                                    foreach ($country_user as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                    if ($country_users->isNotEmpty()) {
                                        foreach ($country_users as $cuid) {
                                            $country_code = $cuid->country_code;
                                        }
                                    } else {
                                        $country_code = '';
                                    }
                                }
                            } else {
                                $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                if ($country_user->isNotEmpty()) {
                                    foreach ($country_user as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                    if ($country_users->isNotEmpty()) {
                                        foreach ($country_users as $cuid) {
                                            $country_code = $cuid->country_code;
                                        }
                                    } else {
                                        $country_code = '';
                                    }
                                }
                            }
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $currency_user = Currency::where('country_code', '=', $country_code)
                                    ->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $currency_user = Currency::where('country_code', '=', $country_code)->where('admin_auto_id', '=', "6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
                            }
                            if ($currency_user->isNotEmpty()) {
                                foreach ($currency_user as $cuid) {
                                    $country_code_id = $cuid->id;
                                    $currency = $cuid->currency;
                                }
                            } else {
                                $country_code_id = '';
                                $currency = '';
                            }
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)
                                    ->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            } else {
                                $currency_price_detailss = CountryProductPrice::Where('admin_auto_id', "6306fc8918573a0e5ba5a218")
                                    ->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }
                            if ($currency_price_detailss->isNotEmpty()) {
                                // foreach($currency_price_detailss as $cuidss)
                                //       {
                                //   $product_auto_id=$cuidss->product_auto_id;
                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                if ($esatatus->isNotEmpty()) {
                                    foreach ($esatatus as $erase) {
                                        $erase_data_status = $erase->erase_data_status;
                                    }
                                } else {
                                    $erase_data_status = 'No';
                                }

                                if ($erase_data_status == 'Yes') {
                                    $pcat = AdminProducts::where('_id', '=', $product)
                                        ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                } else {
                                    $pcat = AdminProducts::where('_id', '=', $product)->Where('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                }
                                if (empty($pcat)) {

                                    $sscats = array();
                                } else {
                                    foreach ($pcat as $urs) {
                                        $product_auto_id = $urs->_id;
                                        $product_auto_ids = $urs->product_auto_id;
                                        $product_model_auto_id = $urs->product_model_auto_id;
                                        $color_image = $urs->color_image;
                                        $color_name = $urs->color_name;
                                        $size = $urs->size;
                                        $size_ids = explode('|', $size);
                                        unset($get_slists);
                                        if ($size != "") {
                                            foreach ($size_ids as $sz) {
                                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                                if ($esatatus->isNotEmpty()) {
                                                    foreach ($esatatus as $erase) {
                                                        $erase_data_status = $erase->erase_data_status;
                                                    }
                                                } else {
                                                    $erase_data_status = 'No';
                                                }
                                                if ($erase_data_status == 'Yes') {

                                                    $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                                } else {
                                                    $sizelist = SizeLists::where('_id', '=', $sz)->whereNull('deleted_at')->get();
                                                }
                                                if ($sizelist->isNotEmpty()) {
                                                    foreach ($sizelist as $sub) {
                                                        $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                                                    }
                                                } else {
                                                    $get_slists = array();
                                                }
                                            }
                                        } else {
                                            $get_slists = array();
                                        }


                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                            if ($country_user->isNotEmpty()) {
                                                foreach ($country_user as $cuid) {
                                                    $country_code = $cuid->country_code;
                                                }
                                            } else {
                                                $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                                if ($country_users->isNotEmpty()) {
                                                    foreach ($country_users as $cuid) {
                                                        $country_code = $cuid->country_code;
                                                    }
                                                } else {
                                                    $country_code = '';
                                                }
                                            }
                                        } else {
                                            $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                            if ($country_user->isNotEmpty()) {
                                                foreach ($country_user as $cuid) {
                                                    $country_code = $cuid->country_code;
                                                }
                                            } else {
                                                $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                                if ($country_users->isNotEmpty()) {
                                                    foreach ($country_users as $cuid) {
                                                        $country_code = $cuid->country_code;
                                                    }
                                                } else {
                                                    $country_code = '';
                                                }
                                            }
                                        }
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $currency_user = Currency::where('country_code', '=', $country_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $currency_user = Currency::where('country_code', '=', $country_code)->Where('admin_auto_id', "6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
                                        }
                                        if ($currency_user->isNotEmpty()) {
                                            foreach ($currency_user as $cuid) {
                                                $country_code_id = $cuid->id;
                                                $currency = $cuid->currency;
                                            }
                                        } else {
                                            $country_code_id = '';
                                            $currency = '';
                                        }
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)
                                                ->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)
                                                ->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $currency_price_details = CountryProductPrice::Where('admin_auto_id', "6306fc8918573a0e5ba5a218")
                                                ->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)
                                                ->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                                        }
                                        if ($currency_price_details->isNotEmpty()) {
                                            foreach ($currency_price_details as $cuid) {
                                                $product_price = $cuid->product_price;
                                                $offer_percentage = $cuid->offer_percentage;
                                                $size_price = $cuid->size_price;
                                                $including_tax = $cuid->including_tax;
                                                $tax_percentage = $cuid->tax_percentage;
                                                $final_pprices = $cuid->final_price;
                                                $offer_auto_id = $cuid->offer_auto_id;
                                            }
                                        } else {
                                            $product_price = '';
                                            $offer_percentage = '';
                                            $size_price = '';
                                            $including_tax = '';
                                            $tax_percentage = '';
                                            $final_pprices = '';
                                            $offer_auto_id = '';
                                        }

                                        $product_name = $urs->product_name;
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        }
                                        foreach ($get_details as $dtls) {
                                            $main_category_auto_id = $dtls->main_category_auto_id;
                                            $sub_category_auto_id = $dtls->sub_category_auto_id;
                                            $user_auto_id = $dtls->user_auto_id;
                                            $added_by = $dtls->added_by;
                                            $product_dimensions = $dtls->product_dimensions;
                                            $product_name = $dtls->product_name;
                                            $highlights = $dtls->highlights;
                                            $description = $dtls->description;
                                            $brand_auto_id = $dtls->brand_auto_id;
                                            $new_arrival = $dtls->new_arrival;
                                            $moq = $dtls->moq;
                                            $gross_wt = $dtls->gross_wt;
                                            $net_wt = $dtls->net_wt;
                                            $unit = $dtls->unit;
                                            $quantity = $dtls->quantity;
                                            $weight = $dtls->weight;
                                            $product_model_auto_id = $dtls->product_model_auto_id;
                                            $time = $dtls->time;
                                            $time_unit = $dtls->time_unit;
                                            $use_by = $dtls->use_by;
                                            $closure_type = $dtls->closure_type;
                                            $fabric = $dtls->fabric;
                                            $sole = $dtls->sole;
                                            $veg_nonveg = $dtls->veg_nonveg;
                                            $egg_eggless = $dtls->egg_eggless;
                                            $Customizable = $dtls->Customizable;
                                        }

                                        $offer_ids = explode('|', $offer_auto_id);
                                        unset($get_olists);
                                        foreach ($offer_ids as $offer) {
                                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                            if ($esatatus->isNotEmpty()) {
                                                foreach ($esatatus as $erase) {
                                                    $erase_data_status = $erase->erase_data_status;
                                                }
                                            } else {
                                                $erase_data_status = 'No';
                                            }
                                            if ($erase_data_status == 'Yes') {

                                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            } else {
                                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            }
                                            if ($offerlist->isNotEmpty()) {
                                                foreach ($offerlist as $off) {
                                                    $get_olists[] = array(
                                                        "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                                        "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                                                    );
                                                    $offercompprice = $off->price;
                                                    $offercompper = $off->offer;
                                                }
                                            } else {
                                                $get_olists = array();
                                                $offercompprice = 0;
                                                $offercompper = 0;
                                            }
                                        }

                                        unset($get_plists);
                                        $prepration_ids = explode('|', $size_price);

                                        if ($offercompper != '') {
                                            if ($size_price != '') {
                                                foreach ($prepration_ids as $data1) {
                                                    $offer_price = ($data1 * $offercompper) / 100;
                                                    $final_price = $data1 - $offer_price;
                                                    $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offercompper, "final_size_price" => strval($final_price));
                                                }
                                            } else {
                                                $get_plists = array();
                                            }
                                        } elseif ($offercompprice != '') {
                                            if ($size_price != '') {
                                                foreach ($prepration_ids as $data1) {
                                                    $final_price = $data1 - $offercompprice;
                                                    $get_plists[] = array("size_price" => $data1, "offer_price_off" => $offercompprice, "final_size_price" => strval($final_price));
                                                }
                                            } else {
                                                $get_plists = array();
                                            }
                                        } else {
                                            if ($size_price != '') {
                                                foreach ($prepration_ids as $data1) {
                                                    $offer_price = ($data1 * $offer_percentage) / 100;
                                                    $final_price = $data1 - $offer_price;
                                                    $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                                                }
                                            } else {
                                                $get_plists = array();
                                            }
                                        }
                                        unset($image_lists);
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        }
                                        if ($pimage_details->isNotEmpty()) {
                                            foreach ($pimage_details as $pidata) {
                                                $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                                            }
                                        } else {
                                            $image_lists = array();
                                        }
                                        //rating review
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }

                                        if ($erase_data_status == 'Yes') {

                                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                                        } else {
                                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                                        }
                                        $avg_rating = 0;
                                        if ($courseRatingReview->isNotEmpty()) {
                                            foreach ($courseRatingReview as  $data) {
                                                $total_rating = $data->rating;
                                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                                if ($esatatus->isNotEmpty()) {
                                                    foreach ($esatatus as $erase) {
                                                        $erase_data_status = $erase->erase_data_status;
                                                    }
                                                } else {
                                                    $erase_data_status = 'No';
                                                }
                                                if ($erase_data_status == 'Yes') {

                                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                                                } else {
                                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
                                                }

                                                $avg_rating = ($total_student * $total_rating / $total_student);
                                            }
                                        } else {
                                            $courseRatingReview = array();
                                        }
                                        $sscats[] = array(
                                            "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                                            "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                                            "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                                            "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                                            "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                                        );
                                    }
                                }
                                //   }
                                $get_home_component_details[$i]['content'] = $sscats;
                            } else {

                                $sscats = array();
                            }
                        }

                        $get_home_component_details[$i]['content'] = $sscats;
                    }
                }
            }
            if ($list->component_type == "MainCategories") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_component_content = HomeComponentMainCategories::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $check_component_content = HomeComponentMainCategories::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $component_content = HomeComponentMainCategories::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $component_content = HomeComponentMainCategories::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($component_content as $cc) {
                        $maincategory_auto_ids = $cc->main_category_auto_id;
                        $maincat_ids = explode('|', $maincategory_auto_ids);
                        foreach ($maincat_ids as $main) {
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $mlists = Categories::where('_id', $main)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            } else {
                                $mlists = Categories::where('_id', $main)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }

                            if ($mlists->isNotEmpty()) {

                                foreach ($mlists as $lts) {



                                    $get_mclists[] = array("maincategory_auto_id" => $lts->_id, "main_category_name" => $lts->category_name, "category_image_app" => $lts->category_image_app, "category_image_web" => $lts->category_image_web);
                                }
                            } else {

                                $get_mclists = array();
                            }
                        }

                        $get_home_component_details[$i]['content'] = $get_mclists;
                    }
                }
            }
            if ($list->component_type == "SubCategories") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_component_content = HomeComponentSubCategories::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $check_component_content = HomeComponentSubCategories::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $component_content = HomeComponentSubCategories::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $component_content = HomeComponentSubCategories::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($component_content as $cc) {
                        $subcategory_auto_ids = $cc->sub_category_auto_id;
                        $subcat_ids = explode('|', $subcategory_auto_ids);
                        foreach ($subcat_ids as $sub) {
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $lists = Subcategories::where('_id', $sub)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            } else {
                                $lists = Subcategories::where('_id', $sub)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }
                            if ($lists->isNotEmpty()) {

                                foreach ($lists as $lts) {



                                    $get_lists[] = array("subcategory_auto_id" => $lts->_id, "main_category_auto_id" => $lts->main_category_auto_id, "sub_category_name" => $lts->sub_category_name, "subcategory_image_app" => $lts->subcategory_image_app, "subcategory_image_web" => $lts->subcategory_image_web);
                                }
                            } else {

                                $get_lists = array();
                            }
                        }

                        $get_home_component_details[$i]['content'] = $get_lists;
                    }
                }
            }
            if ($list->component_type == "Brand") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_component_content = HomeComponentTopBrands::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $check_component_content = HomeComponentTopBrands::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $component_content = HomeComponentTopBrands::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $component_content = HomeComponentTopBrands::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($check_component_content as $cc) {
                        $brand_auto_ids = $cc->brand_auto_id;
                        $brand_ids = explode('|', $brand_auto_ids);
                        foreach ($brand_ids as $b) {


                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $lists = Brand::where('_id', $b)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            } else {
                                $lists = Brand::where('_id', $b)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }
                            if ($lists->isNotEmpty()) {

                                foreach ($lists as $lts) {



                                    $get_lists[] = array("brand_auto_id" => $lts->_id, "brand_name" => $lts->brand_name, "brand_image_app" => $lts->brand_image_app, "brand_image_web" => $lts->brand_image_web);
                                }
                            } else {

                                $get_lists = array();
                            }
                        }

                        $get_home_component_details[$i]['content'] = $get_lists;
                    }
                }
            }



            if ($get_home_component_details->isNotEmpty()) {
                return response()->json(['status' => 1, "msg" => "success", 'get_home_component_list' => $get_home_component_details]);
            } else {
                return response()->json(['status' => 0, "msg" => "No Data Available"]);
            }
            $i++;
        }
    }




    public function add_new_home_component(Request $request)
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
            $check = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $check = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
            if (!empty($request->file('background_image'))) {
                $file = $request->file('background_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/slider');
                $file->move($path, $filename);
                $component->background_image = $filename;
            } else {
                $component->background_image = "";
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
                $component->web_icon_type = "3";
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
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $components = HomeComponent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
            } else {
                $components = HomeComponent::where('_id', $inserted_id)
                    ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
            if (!empty($request->file('background_image'))) {
                $file = $request->file('background_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/slider');
                $file->move($path, $filename);
                $component->background_image = $filename;
            } else {
                $component->background_image = "";
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
                $last_id = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $last_id = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $components = HomeComponent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $components = HomeComponent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {

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
                if (!empty($request->file('background_image'))) {
                    $file = $request->file('background_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/slider');
                    $file->move($path, $filename);
                    $component->background_image = $filename;
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

                return response()->json([
                    'status' => "1",
                    'data' => $component

                ]);


                return response()->json(['status' => 1, "msg" => config('messages.success')]);
            }
        } else {
            return response()->json(['status' => 0, "msg" => "You can't edit super admin added component"]);
        }
    }


    //Delete Home Component
    public function delete_home_component(Request $request)
    {
        $get_current_id = HomeComponent::find($request->get('homecomponent_auto_id'));
        $component_id = $get_current_id->_id;
        $component_index = $get_current_id->component_index;
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $next = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $next = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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



        return response()->json([
            'status' => '1',
            'msg' => "Sucessfully Deleted"
        ]);
    }




    // Add Component Image
    public function add_component_image(Request $request)
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
            $checkcomponent = HomeComponent::where('_id', $request->homecomponent_auto_id)
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
        } else {
            $checkcomponent = HomeComponent::where('_id', $request->homecomponent_auto_id)
                ->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
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

                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_slider = ComponentContent::where('title', 'Slider')->where('component_auto_id', $request->homecomponent_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $check_slider = ComponentContent::where('title', 'Slider')->where('component_auto_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
            if ($request->get('redirect_to') != '') {
                $content->redirect_to = $request->get('redirect_to');
            } else {
                $content->redirect_to = "";
            }
            $content->save();
        }
        $inserted_id = $content->id;

        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $component = ComponentContent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $component = ComponentContent::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $main = ComponentContent::where('component_auto_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('_id', $request->image_auto_id)->whereNull('deleted_at')->get();
        } else {
            $main = ComponentContent::where('component_auto_id', $request->homecomponent_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('_id', $request->image_auto_id)->whereNull('deleted_at')->get();
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
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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

            if ($request->get('redirect_to') != '') {
                $update = ComponentContent::where('_id', $request->image_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('subadmin_auto_id', $request->subadmin_auto_id)->where('app_type_id', $request->app_type_id)->update(["redirect_to" => $request->get('redirect_to')]);
            }

            // $main->save();
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $cat = ComponentContent::where('_id', $request->image_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $cat = ComponentContent::where('_id', $request->image_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $tdetails = ComponentContent::where('_id', '=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->delete();
        } else {
            $tdetails = ComponentContent::where('_id', '=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->delete();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $check = HomeComponentTopBrands::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $check = HomeComponentTopBrands::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($check->isNotEmpty()) {
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $update = HomeComponentTopBrands::Where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['brand_auto_id' => $request->get('brand_auto_id')]);
                $component = HomeComponentTopBrands::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $update = HomeComponentTopBrands::Where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['brand_auto_id' => $request->get('brand_auto_id')]);
                $component = HomeComponentTopBrands::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $component = HomeComponentTopBrands::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $component = HomeComponentTopBrands::where('_id', $inserted_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $get_home_top_brands = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->ORDERBY('_id', 'ASC')->whereNull('deleted_at')->get();
        } else {
            $get_home_top_brands = HomeComponentTopBrands::where('home_component_auto_id', '=', $request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->ORDERBY('_id', 'ASC')->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $chk = HomeComponentMainCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $chk = HomeComponentMainCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $component = HomeComponentMainCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $component = HomeComponentMainCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $chk = HomeComponentSubCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $chk = HomeComponentSubCategories::where('home_component_auto_id', $request->get('home_component_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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



            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $component = HomeComponentSubCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $component = HomeComponentSubCategories::where('home_component_auto_id', $request->home_component_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $nexts = HomeComponent::where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)
                ->whereNull('deleted_at')->get();

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
                ->whereNull('deleted_at')->get();

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




        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                ->whereNull('deleted_at')->get();

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
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                ->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        } else {
            $update = HomeComponent::where('_id', $request->homecomponent_auto_id)
                ->where('admin_auto_id', $request->admin_auto_id)
                ->where('app_type_id', $request->app_type_id)

                ->update(["component_index" => strval($request->new_index)]);

            $cat = HomeComponent::where('_id', $request->homecomponent_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
            $get = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->where('show_in_category', 'LIKE', '%' . $main_category_auto_id . '%')->whereNull('deleted_at')->get();
        }


        if ($get->isNotEmpty()) {
            return response()->json(['status' => '1', "msg" => "success", 'get_main_category_components' => $get]);
        } else {
            return response()->json(['status' => '0', "msg" => "No Data Available"]);
        }
    }
    public function get_new_product_list(Request $request)
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
            $get_home_component_details = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', 'Products')->whereNull('deleted_at')->get();
        } else {
            $get_home_component_details = HomeComponent::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('component_auto_id'))->where('component_type', '=', 'Products')->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        $i = 0;
        foreach ($get_home_component_details as $list) {
            $id = $list->_id;


            if ($list->component_type == "Products") {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $check_component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $check_component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $component_content = HomeProductComponent::where('home_component_auto_id', $id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($component_content as $cc) {
                        $product_auto_id = $cc->product_auto_id;
                       $product_auto_ids = explode('|', $product_auto_id);
			$a = count($product_auto_ids);
                        unset($get_slists);
                        foreach ($product_auto_ids as $product) {
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {

                                $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                if ($country_user->isNotEmpty()) {
                                    foreach ($country_user as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                    if ($country_users->isNotEmpty()) {
                                        foreach ($country_users as $cuid) {
                                            $country_code = $cuid->country_code;
                                        }
                                    } else {
                                        $country_code = '';
                                    }
                                }
                            } else {
                                $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                if ($country_user->isNotEmpty()) {
                                    foreach ($country_user as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                    if ($country_users->isNotEmpty()) {
                                        foreach ($country_users as $cuid) {
                                            $country_code = $cuid->country_code;
                                        }
                                    } else {
                                        $country_code = '';
                                    }
                                }
                            }
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $currency_user = Currency::where('country_code', '=', $country_code)
                                    ->where('admin_auto_id', $request->admin_auto_id)->get();
                            } else {
                                $currency_user = Currency::where('country_code', '=', $country_code)->where('admin_auto_id', '=', "6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
                            }
                            if ($currency_user->isNotEmpty()) {
                                foreach ($currency_user as $cuid) {
                                    $country_code_id = $cuid->id;
                                    $currency = $cuid->currency;
                                }
                            } else {
                                $country_code_id = '';
                                $currency = '';
                            }
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)
                                    ->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            } else {
                                $currency_price_detailss = CountryProductPrice::Where('admin_auto_id', "6306fc8918573a0e5ba5a218")
                                    ->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            }
                            if ($currency_price_detailss->isNotEmpty()) {
                                // foreach($currency_price_detailss as $cuidss)
                                //       {
                                //   $product_auto_id=$cuidss->product_auto_id;
                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                if ($esatatus->isNotEmpty()) {
                                    foreach ($esatatus as $erase) {
                                        $erase_data_status = $erase->erase_data_status;
                                    }
                                } else {
                                    $erase_data_status = 'No';
                                }
                                $limits = (int)$request->get('limit');
                                $page_number = (int)$request->get('page_number');
                                if ($erase_data_status == 'Yes') {
                                  $total_custs_count = $a;
                                } else {
                                    $total_custs_count = $a;
                                }
                                $total_page = $total_custs_count / $limits;
                                if ($total_page < 1) {
                                    $total_pagess = 1;
                                } elseif ($total_page) {
                                    $total_pagess = $total_page + 1;
                                } else {
                                    $total_pagess = $total_page;
                                }

                                $total_pages = round($total_pagess);
                                $curent_page = $page_number;
                                if ($total_page < 1) {
                                    $next_page = 0;
                                } else {
                                    $next_page = $page_number + 1;
                                }
                                $previous_page = $page_number - 1;

                                if ($total_page < 1) {
                                    $offsetss = 0;
                                } else {
                                    if ($curent_page <= 1) {
                                        $offsetss = 0;
                                    } else {
                                        $offset = ($page_number - 1) * $limits;
                                        $offsetss = (int)$offset;
                                    }
                                }
                                 if ($erase_data_status == 'Yes') {
                                $pcat = AdminProducts::where('_id', '=', $product)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                } else {
                                    $pcat = AdminProducts::where('_id', '=', $product)->Where('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                }
                                if (empty($pcat)) {
                                    $sscats = array();
                                } else {
                                    foreach ($pcat as $urs) {
                                        $product_auto_id = $urs->_id;
                                        $product_auto_ids = $urs->product_auto_id;
                                        $product_model_auto_id = $urs->product_model_auto_id;
                                        $color_image = $urs->color_image;
                                        $color_name = $urs->color_name;
                                        $size = $urs->size;
                                        $size_ids = explode('|', $size);
                                        unset($get_slists);
                                        if ($size != "") {
                                            foreach ($size_ids as $sz) {
                                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                                if ($esatatus->isNotEmpty()) {
                                                    foreach ($esatatus as $erase) {
                                                        $erase_data_status = $erase->erase_data_status;
                                                    }
                                                } else {
                                                    $erase_data_status = 'No';
                                                }
                                                if ($erase_data_status == 'Yes') {
                                                    $sizelist = SizeLists::where('_id', '=', $sz)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                                } else {
                                                    $sizelist = SizeLists::where('_id', '=', $sz)->whereNull('deleted_at')->get();
                                                }
                                                if ($sizelist->isNotEmpty()) {
                                                    foreach ($sizelist as $sub) {
                                                        $get_slists[] = array("size_auto_id" => $sub->_id, "size_name" => $sub->size);
                                                    }
                                                } else {
                                                    $get_slists = array();
                                                }
                                            }
                                        } else {
                                            $get_slists = array();
                                        }


                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                            if ($country_user->isNotEmpty()) {
                                                foreach ($country_user as $cuid) {
                                                    $country_code = $cuid->country_code;
                                                }
                                            } else {
                                                $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                                if ($country_users->isNotEmpty()) {
                                                    foreach ($country_users as $cuid) {
                                                        $country_code = $cuid->country_code;
                                                    }
                                                } else {
                                                    $country_code = '';
                                                }
                                            }
                                        } else {
                                            $country_user = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                            if ($country_user->isNotEmpty()) {
                                                foreach ($country_user as $cuid) {
                                                    $country_code = $cuid->country_code;
                                                }
                                            } else {
                                                $country_users = EcommRegistration::where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
                                                if ($country_users->isNotEmpty()) {
                                                    foreach ($country_users as $cuid) {
                                                        $country_code = $cuid->country_code;
                                                    }
                                                } else {
                                                    $country_code = '';
                                                }
                                            }
                                        }
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $currency_user = Currency::where('country_code', '=', $country_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $currency_user = Currency::where('country_code', '=', $country_code)->Where('admin_auto_id', "6306fc8918573a0e5ba5a218")->whereNull('deleted_at')->get();
                                        }
                                        if ($currency_user->isNotEmpty()) {
                                            foreach ($currency_user as $cuid) {
                                                $country_code_id = $cuid->id;
                                                $currency = $cuid->currency;
                                            }
                                        } else {
                                            $country_code_id = '';
                                            $currency = '';
                                        }
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)
                                                ->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)
                                                ->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $currency_price_details = CountryProductPrice::Where('admin_auto_id', "6306fc8918573a0e5ba5a218")
                                                ->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)
                                                ->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                                        }
                                        if ($currency_price_details->isNotEmpty()) {
                                            foreach ($currency_price_details as $cuid) {
                                                $product_price = $cuid->product_price;
                                                $offer_percentage = $cuid->offer_percentage;
                                                $size_price = $cuid->size_price;
                                                $including_tax = $cuid->including_tax;
                                                $tax_percentage = $cuid->tax_percentage;
                                                $final_pprices = $cuid->final_price;
                                                $offer_auto_id = $cuid->offer_auto_id;
                                            }
                                        } else {
                                            $product_price = '';
                                            $offer_percentage = '';
                                            $size_price = '';
                                            $including_tax = '';
                                            $tax_percentage = '';
                                            $final_pprices = '';
                                            $offer_auto_id = '';
                                        }

                                        $product_name = $urs->product_name;
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        }
                                        foreach ($get_details as $dtls) {
                                            $main_category_auto_id = $dtls->main_category_auto_id;
                                            $sub_category_auto_id = $dtls->sub_category_auto_id;
                                            $user_auto_id = $dtls->user_auto_id;
                                            $added_by = $dtls->added_by;
                                            $product_dimensions = $dtls->product_dimensions;
                                            $product_name = $dtls->product_name;
                                            $highlights = $dtls->highlights;
                                            $description = $dtls->description;
                                            $brand_auto_id = $dtls->brand_auto_id;
                                            $new_arrival = $dtls->new_arrival;
                                            $moq = $dtls->moq;
                                            $gross_wt = $dtls->gross_wt;
                                            $net_wt = $dtls->net_wt;
                                            $unit = $dtls->unit;
                                            $quantity = $dtls->quantity;
                                            $weight = $dtls->weight;
                                            $product_model_auto_id = $dtls->product_model_auto_id;
                                            $time = $dtls->time;
                                            $time_unit = $dtls->time_unit;
                                            $use_by = $dtls->use_by;
                                            $closure_type = $dtls->closure_type;
                                            $fabric = $dtls->fabric;
                                            $sole = $dtls->sole;
                                            $veg_nonveg = $dtls->veg_nonveg;
                                            $egg_eggless = $dtls->egg_eggless;
                                            $Customizable = $dtls->Customizable;
                                        }

                                        $offer_ids = explode('|', $offer_auto_id);
                                        unset($get_olists);
                                        foreach ($offer_ids as $offer) {
                                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                            if ($esatatus->isNotEmpty()) {
                                                foreach ($esatatus as $erase) {
                                                    $erase_data_status = $erase->erase_data_status;
                                                }
                                            } else {
                                                $erase_data_status = 'No';
                                            }
                                            if ($erase_data_status == 'Yes') {

                                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            } else {
                                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            }
                                            if ($offerlist->isNotEmpty()) {
                                                foreach ($offerlist as $off) {
                                                    $get_olists[] = array(
                                                        "offer_auto_id" => $off->_id, "homecomponent_auto_id" => $off->homecomponent_auto_id, "component_image" => $off->component_image, "main_category" => $off->main_category,
                                                        "subcategory" => $off->subcategory, "brand" => $off->brand, "price" => $off->price, "offer" => $off->offer, "rdate" => $off->rdate
                                                    );
                                                    $offercompprice = $off->price;
                                                    $offercompper = $off->offer;
                                                }
                                            } else {
                                                $get_olists = array();
                                                $offercompprice = 0;
                                                $offercompper = 0;
                                            }
                                        }

                                        unset($get_plists);
                                        $prepration_ids = explode('|', $size_price);

                                        if ($offercompper != '') {
                                            if ($size_price != '') {
                                                foreach ($prepration_ids as $data1) {
                                                    $offer_price = ($data1 * $offercompper) / 100;
                                                    $final_price = $data1 - $offer_price;
                                                    $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offercompper, "final_size_price" => strval($final_price));
                                                }
                                            } else {
                                                $get_plists = array();
                                            }
                                        } elseif ($offercompprice != '') {
                                            if ($size_price != '') {
                                                foreach ($prepration_ids as $data1) {
                                                    $final_price = $data1 - $offercompprice;
                                                    $get_plists[] = array("size_price" => $data1, "offer_price_off" => $offercompprice, "final_size_price" => strval($final_price));
                                                }
                                            } else {
                                                $get_plists = array();
                                            }
                                        } else {
                                            if ($size_price != '') {
                                                foreach ($prepration_ids as $data1) {
                                                    $offer_price = ($data1 * $offer_percentage) / 100;
                                                    $final_price = $data1 - $offer_price;
                                                    $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                                                }
                                            } else {
                                                $get_plists = array();
                                            }
                                        }
                                        unset($image_lists);
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }
                                        if ($erase_data_status == 'Yes') {

                                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        } else {
                                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                        }
                                        if ($pimage_details->isNotEmpty()) {
                                            foreach ($pimage_details as $pidata) {
                                                $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                                            }
                                        } else {
                                            $image_lists = array();
                                        }
                                        //rating review
                                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                        if ($esatatus->isNotEmpty()) {
                                            foreach ($esatatus as $erase) {
                                                $erase_data_status = $erase->erase_data_status;
                                            }
                                        } else {
                                            $erase_data_status = 'No';
                                        }

                                        if ($erase_data_status == 'Yes') {

                                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                                        } else {
                                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                                        }
                                        $avg_rating = 0;
                                        if ($courseRatingReview->isNotEmpty()) {
                                            foreach ($courseRatingReview as  $data) {
                                                $total_rating = $data->rating;
                                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                                                if ($esatatus->isNotEmpty()) {
                                                    foreach ($esatatus as $erase) {
                                                        $erase_data_status = $erase->erase_data_status;
                                                    }
                                                } else {
                                                    $erase_data_status = 'No';
                                                }
                                                if ($erase_data_status == 'Yes') {

                                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                                                } else {
                                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
                                                }

                                                $avg_rating = ($total_student * $total_rating / $total_student);
                                            }
                                        } else {
                                            $courseRatingReview = array();
                                        }
                                      $sscats[] = array(
                                            "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                                            "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                                            "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                                            "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                                            "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                                        );
                                    }
                                }
                                //   }
                                $get_home_component_details[$i]['content'] = $sscats;
                            } else {

                                $sscats = array();
                            }
                        }

                        $get_home_component_details[$i]['content'] = $sscats;
                    }
                }
            }



            if ($get_home_component_details->isNotEmpty()) {
                return response()->json([
                    'status' => 1, "msg" => "success",
                    "total_custs_count" => $total_custs_count,
                    "total_pages" => $total_pages,
                    "curent_page" => $curent_page,
                    "next_page" => $next_page,
                    "previous_page" => $previous_page,
                    'get_products_lists' => $sscats
                ]);
            } else {
                return response()->json(['status' => 0, "msg" => "No Data Available"]);
            }
            $i++;
        }
    }
}