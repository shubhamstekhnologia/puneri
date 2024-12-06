<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminProducts;
use App\AdminProductImages;
use App\AdminProductColors;
use App\ProductRatingReview;
use App\WishlistProducts;
use App\UserRegister;
use App\CartProducts;
use App\OfferComponent;
use App\DeliveryTime;
use App\CountryProductPrice;
use App\EcommRegistration;
use App\Orders;
use App\Search;
use App\SizeChart;
use App\Currency;
use App\SizeLists;
use App\Admin;
use DateTimeZone;
use DateTime;
use DB;

class AdminProductApiController extends Controller
{


    public function add_admin_Product(Request $request)
    {

        $product = new AdminProducts();
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $checkproduct = AdminProducts::where('product_name', $request->product_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
        } else {
            $checkproduct = AdminProducts::where('product_name', $request->product_name)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->first();
        }

        if ($checkproduct) {
            return response()->json([
                'status' => '0',
                'msg' => 'This product already exists..!',
            ]);
        } else {

            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');


            $product->user_auto_id = $request->get('user_auto_id');
            if ($request->get('admin_auto_id') != '') {
                $product->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $product->admin_auto_id = "";
            }
            if ($request->get('app_type_id') != '') {
                $product->app_type_id = $request->get('app_type_id');
            } else {
                $product->app_type_id = "";
            }
            $product->main_category_auto_id = $request->get('main_category_auto_id');

            $product->product_name = $request->get('product_name');

            if ($request->get('sub_category_auto_id') != '') {
                $product->sub_category_auto_id = $request->get('sub_category_auto_id');
            } else {
                $product->sub_category_auto_id = "";
            }

            $product->product_model_auto_id = uniqid();

            if ($request->get('brand_auto_id') != '') {
                $product->brand_auto_id = $request->get('brand_auto_id');
            } else {
                $product->brand_auto_id = "";
            }
            if ($request->get('unit') != '') {
                $product->unit = $request->get('unit');
            } else {
                $product->unit = "";
            }
            if ($request->get('product_sku') != '') {
                $product->product_sku = $request->get('product_sku');
            } else {
                $product->product_sku = "";
            }

            if ($request->get('quantity') != '') {
                $product->quantity = $request->get('quantity');
            } else {
                $product->quantity = "";
            }
            if ($request->get('gross_wt') != '') {
                $product->gross_wt = $request->get('gross_wt');
            } else {
                $product->gross_wt = "";
            }
            if ($request->get('net_wt') != '') {
                $product->net_wt = $request->get('net_wt');
            } else {
                $product->net_wt = "";
            }
            // if($request->get('offer_percentage')!='')
            //     {
            //                 $product->offer_percentage = $request->get('offer_percentage');
            //     }else
            //     {
            //         $product->offer_percentage ="";
            //     }
            if ($request->get('moq') != '') {
                $product->moq = $request->get('moq');
            } else {
                $product->moq = "";
            }

            if ($request->get('description') != '') {
                $product->description = $request->get('description');
            } else {
                $product->description = "";
            }
            if ($request->get('highlights') != '') {
                $product->highlights = $request->get('highlights');
            } else {
                $product->highlights = "";
            }
            if ($request->get('weight') != '') {
                $product->weight = $request->get('weight');
            } else {
                $product->weight = "";
            }
            if ($request->get('product_dimensions') != '') {
                $product->product_dimensions = $request->get('product_dimensions');
            } else {
                $product->product_dimensions = "";
            }
            if ($request->get('isReturn') != '') {
                $product->isReturn = $request->get('isReturn');
            } else {
                $product->isReturn = "";
            }
            if ($request->get('isExchange') != '') {
                $product->isExchange = $request->get('isExchange');
            } else {
                $product->isExchange = "";
            }
            if ($request->get('days') != '') {
                $product->days = $request->get('days');
            } else {
                $product->days = "";
            }

            if ($request->get('new_arrival') != '') {
                $product->new_arrival = $request->get('new_arrival');
            } else {
                $product->new_arrival = "";
            }
            if (!empty($request->file('color_image'))) {
                $file = $request->file('color_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/products');
                $file->move($path, $filename);
                $product->color_image = $filename;
            } else {
                $product->color_image = '';
            }
            if ($request->get('color_name') != '') {
                $product->color_name = $request->get('color_name');
            } else {
                $product->color_name = "";
            }
            if ($request->get('color_name_visible') != '') {
                $product->color_name_visible = $request->get('color_name_visible');
            } else {
                $product->color_name_visible = "Yes";
            }
            if ($request->get('size') != '') {
                $product->size = $request->get('size');
            } else {
                $product->size = "";
            }
            if ($request->get('time') != '') {
                $product->time = $request->get('time');
            } else {
                $product->time = "";
            }
            if ($request->get('time_unit') != '') {
                $product->time_unit = $request->get('time_unit');
            } else {
                $product->time_unit = "";
            }
            if ($request->get('use_by') != '') {
                $product->use_by = $request->get('use_by');
            } else {
                $product->use_by = "";
            }
            if ($request->get('closure_type ') != '') {
                $product->closure_type  = $request->get('closure_type');
            } else {
                $product->closure_type = "";
            }

            if ($request->get('fabric ') != '') {
                $product->fabric  = $request->get('fabric');
            } else {
                $product->fabric = "";
            }
            if ($request->get('sole') != '') {
                $product->sole = $request->get('sole');
            } else {
                $product->sole = "";
            }
            if ($request->get('specification_title') != '') {
                $product->specification_title = $request->get('specification_title');
            } else {
                $product->specification_title = "";
            }
            if ($request->get('specification_description') != '') {
                $product->specification_description = $request->get('specification_description');
            } else {
                $product->specification_description = "";
            }

            if ($request->get('Manufacturers') != '') {
                $product->Manufacturers = $request->get('Manufacturers');
            } else {
                $product->Manufacturers = "";
            }
            if ($request->get('Material') != '') {
                $product->Material = $request->get('Material');
            } else {
                $product->Material = "";
            }

            if ($request->get('Width') != '') {
                $product->Width = $request->get('Width');
            } else {
                $product->Width = "";
            }
            if ($request->get('height') != '') {
                $product->height = $request->get('height');
            } else {
                $product->height = "";
            }

            if ($request->get('depth') != '') {
                $product->depth = $request->get('depth');
            } else {
                $product->depth = "";
            }
            if ($request->get('Thickness') != '') {
                $product->Thickness = $request->get('Thickness');
            } else {
                $product->Thickness = "";
            }

            if ($request->get('Firmness') != '') {
                $product->Firmness = $request->get('Firmness');
            } else {
                $product->Firmness = "";
            }
            if ($request->get('Discount') != '') {
                $product->Discount = $request->get('Discount');
            } else {
                $product->Discount = "";
            }

            if ($request->get('Trial_Period') != '') {
                $product->Trial_Period = $request->get('Trial_Period');
            } else {
                $product->Trial_Period = "";
            }
            if ($request->get('stock') != '') {
                $product->stock = $request->get('stock');
            } else {
                $product->stock = "0";
            }

            if ($request->get('available_stock') != '') {
                $product->available_stock = $request->get('available_stock');
            } else {
                $product->available_stock = "0";
            }
            if ($request->get('Stock_alert_limit') != '') {
                $product->Stock_alert_limit = $request->get('Stock_alert_limit');
            } else {
                $product->Stock_alert_limit = "";
            }
            if ($request->get('veg_nonveg') != '') {
                $product->veg_nonveg = $request->get('veg_nonveg');
            } else {
                $product->veg_nonveg = "";
            }

            if ($request->get('egg_eggless') != '') {
                $product->egg_eggless = $request->get('egg_eggless');
            } else {
                $product->egg_eggless = "";
            }

            if ($request->get('Customizable') != '') {
                $product->Customizable = $request->get('Customizable');
            } else {
                $product->Customizable = "";
            }
            if ($request->get('cost_price') != '') {
                $product->cost_price = $request->get('cost_price');
            } else {
                $product->cost_price = "";
            }
            if ($request->get('misc_expenditure') != '') {
                $product->misc_expenditure = $request->get('misc_expenditure');
            } else {
                $product->misc_expenditure = "";
            }

            $product->added_by = $request->get('added_by');
            $product->save();
            if ($product) {
                return response()->json([
                    'status' => "1",
                    'msg' => 'success',
                    'product_auto_id' => $product->_id,
                    'product_model_auto_id' => $product->product_model_auto_id,
                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "Someting went wrng"

                ]);
            }
        }
    }
    //get product
    public function get_admin_products(Request $request)
    {

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
            if ($request->added_by == 'Vendor') {
                $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->where('user_auto_id', $request->user_auto_id)
                    ->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
            } else {
                $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
            }
        } else {
            if ($request->added_by == 'Vendor') {
              $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)
                    ->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")
                    ->whereNull('deleted_at')->count();
            } else {
               $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
            }
        }

        $total_page = (int) ceil($total_custs_count / $limits);

        if ($total_page < 1) {
            $total_pagess = 1;
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
            if ($request->added_by == 'Vendor') {
                $get_aplists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->where('user_auto_id', $request->user_auto_id)
                    ->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
            } else {
                $get_aplists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
            }
        } else {
            if ($request->added_by == 'Vendor') {
               $get_aplists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)
                    ->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")
                    ->offset($offsetss)
                    ->limit($limits)
                    ->whereNull('deleted_at')->get();

            } else {
                $get_aplists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)
                    ->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
            }
        }
        if ($get_aplists->isNotEmpty()) {
            foreach ($get_aplists as $urs) {
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
                            $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                    $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                    $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
                    $currency_price_details = CountryProductPrice::where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $currency_price_details = CountryProductPrice::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                    $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                } else {
                    $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $available_stock = $dtls->available_stock;
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
                        $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {

                    $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->orwhere('product_auto_id', '=', $product_auto_ids)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($pimage_details->isNotEmpty()) {
                    foreach ($pimage_details as $pidata) {
                        $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                    }
                } else {
                    $image_lists = array();
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
                    $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                            $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
                        }

                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }


                $get_final_lists[] = array(
                    "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                    "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                    "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                    "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                    "color_image" => $color_image, "color_name" => $color_name, "availabe_stock" => $available_stock,
                    "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists, "product_images" => $image_lists
                );
            }
            return response()->json(['status' => 1, "msg" => "success", "total_custs_count" => $total_custs_count, "total_pages" => $total_pages, "curent_page" => $curent_page, "next_page" => $next_page, "previous_page" => $previous_page, 'get_products_lists' => $get_final_lists]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //edit product
    public function edit_admin_product(Request $request)
    {

        $product = AdminProducts::find($request->get('product_auto_id'));

        if (empty($product)) {

            return response()->json(['status' => 0, "msg" => config('messages.empty')]);
        } else {

            return response()->json(['status' => 1, "product_details" => $product]);
        }
    }

    //update product

    public function update_admin_product(Request $request)
    {
        $main = AdminProducts::find($request->get('product_auto_id'));
        if (empty($main)) {
            return response()->json(['status' => 0, "msg" => "No product Found"]);
        } else {


            $main->main_category_auto_id = $request->get('main_category_auto_id');
            $main->product_name = $request->get('product_name');
            if ($request->get('sub_category_auto_id') != '') {
                $main->sub_category_auto_id = $request->get('sub_category_auto_id');
            } else {
                $main->sub_category_auto_id = "";
            }

            if ($request->get('brand_auto_id') != '') {
                $main->brand_auto_id = $request->get('brand_auto_id');
            } else {
                $main->brand_auto_id = "";
            }
            if ($request->get('unit') != '') {
                $main->unit = $request->get('unit');
            } else {
                $main->unit = "";
            }
            if ($request->get('quantity') != '') {
                $main->quantity = $request->get('quantity');
            } else {
                $main->quantity = "";
            }
            if ($request->get('product_sku') != '') {
                $main->product_sku = $request->get('product_sku');
            } else {
                $main->product_sku = "";
            }

            if ($request->get('gross_wt') != '') {
                $main->gross_wt = $request->get('gross_wt');
            } else {
                $main->gross_wt = "";
            }
            if ($request->get('net_wt') != '') {
                $main->net_wt = $request->get('net_wt');
            } else {
                $main->net_wt = "";
            }
            // if($request->get('offer_percentage')!='')
            //     {
            //                 $main->offer_percentage = $request->get('offer_percentage');
            //     }else
            //     {
            //         $main->offer_percentage ="";
            //     }
            if ($request->get('moq') != '') {
                $main->moq = $request->get('moq');
            } else {
                $main->moq = "";
            }

            if ($request->get('description') != '') {
                $main->description = $request->get('description');
            } else {
                $main->description = "";
            }
            if ($request->get('highlights') != '') {
                $main->highlights = $request->get('highlights');
            } else {
                $main->highlights = "";
            }
            if ($request->get('weight') != '') {
                $main->weight = $request->get('weight');
            } else {
                $main->weight = "";
            }
            if ($request->get('product_dimensions') != '') {
                $main->product_dimensions = $request->get('product_dimensions');
            } else {
                $main->product_dimensions = "";
            }
            if ($request->get('specification_title') != '') {
                $main->specification_title = $request->get('specification_title');
            } else {
                $main->specification_title = "";
            }
            if ($request->get('specification_description') != '') {
                $main->specification_description = $request->get('specification_description');
            } else {
                $main->specification_description = "";
            }

            if ($request->get('new_arrival') != '') {
                $main->new_arrival = $request->get('new_arrival');
            } else {
                $main->new_arrival = "";
            }
            if (!empty($request->file('color_image'))) {
                $file = $request->file('color_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/products');
                $file->move($path, $filename);
                $main->color_image = $filename;
            }
            if ($request->get('color_name') != '') {
                $main->color_name = $request->get('color_name');
            } else {
                $main->color_name = "";
            }
            if ($request->get('color_name_visible') != '') {
                $main->color_name_visible = $request->get('color_name_visible');
            }
            if ($request->get('size') != '') {
                $main->size = $request->get('size');
            } else {
                $main->size = "";
            }
            if ($request->get('time') != '') {
                $main->time = $request->get('time');
            } else {
                $main->time = "";
            }
            if ($request->get('time_unit') != '') {
                $main->time_unit = $request->get('time_unit');
            } else {
                $main->time_unit = "";
            }
            if ($request->get('use_by') != '') {
                $main->use_by = $request->get('use_by');
            } else {
                $main->use_by = "";
            }
            if ($request->get('closure_type ') != '') {
                $main->closure_type  = $request->get('closure_type');
            } else {
                $main->closure_type = "";
            }

            if ($request->get('fabric ') != '') {
                $main->fabric  = $request->get('fabric');
            } else {
                $main->fabric = "";
            }
            if ($request->get('sole') != '') {
                $main->sole = $request->get('sole');
            } else {
                $main->sole = "";
            }
            if ($request->get('veg_nonveg') != '') {
                $main->veg_nonveg = $request->get('veg_nonveg');
            } else {
                $main->veg_nonveg = "";
            }

            if ($request->get('egg_eggless') != '') {
                $main->egg_eggless = $request->get('egg_eggless');
            } else {
                $main->egg_eggless = "";
            }

            if ($request->get('Customizable') != '') {
                $main->Customizable = $request->get('Customizable');
            } else {
                $main->Customizable = "";
            }


            if ($request->get('isReturn') != '') {
                $main->isReturn = $request->get('isReturn');
            } else {
                $main->isReturn = "";
            }
            if ($request->get('isExchange') != '') {
                $main->isExchange = $request->get('isExchange');
            } else {
                $main->isExchange = "";
            }
            if ($request->get('days') != '') {
                $main->days = $request->get('days');
            } else {
                $main->days = "";
            }
            if ($request->get('Manufacturers') != '') {
                $main->Manufacturers = $request->get('Manufacturers');
            } else {
                $main->Manufacturers = "";
            }
            if ($request->get('Material') != '') {
                $main->Material = $request->get('Material');
            } else {
                $main->Material = "";
            }

            if ($request->get('Width') != '') {
                $main->Width = $request->get('Width');
            } else {
                $main->Width = "";
            }
            if ($request->get('height') != '') {
                $main->height = $request->get('height');
            } else {
                $main->height = "";
            }

            if ($request->get('depth') != '') {
                $main->depth = $request->get('depth');
            } else {
                $main->depth = "";
            }
            if ($request->get('Thickness') != '') {
                $main->Thickness = $request->get('Thickness');
            } else {
                $main->Thickness = "";
            }

            if ($request->get('Firmness') != '') {
                $main->Firmness = $request->get('Firmness');
            } else {
                $main->Firmness = "";
            }
            if ($request->get('Discount') != '') {
                $main->Discount = $request->get('Discount');
            } else {
                $main->Discount = "";
            }

            if ($request->get('Trial_Period') != '') {
                $main->Trial_Period = $request->get('Trial_Period');
            } else {
                $main->Trial_Period = "";
            }
            if ($request->get('stock') != '') {
                $main->stock = $request->get('stock');
            } else {
                $main->stock = "";
            }

            if ($request->get('available_stock') != '') {
                $main->available_stock = $request->get('available_stock');
            } else {
                $main->available_stock = "0";
            }
            if ($request->get('Stock_alert_limit') != '') {
                $main->Stock_alert_limit = $request->get('Stock_alert_limit');
            } else {
                $main->Stock_alert_limit = "0";
            }
            if ($request->get('cost_price') != '') {
                $main->cost_price = $request->get('cost_price');
            } else {
                $main->cost_price = "";
            }
            if ($request->get('misc_expenditure') != '') {
                $main->misc_expenditure = $request->get('misc_expenditure');
            } else {
                $main->misc_expenditure = "";
            }
            $main->added_by = $request->get('added_by');
            //     if($request->get('including_tax') == 'Yes'){
            //          $offer_price = ($request->product_price * $request->offer_percentage)/100;
            //   $final_price = $request->product_price - $offer_price;
            //   $main->final_price = strval($final_price);
            //     }else{
            //   $offer_price = ($request->product_price * $request->offer_percentage)/100;
            //   $final_price = $request->product_price - $offer_price;
            //   $tax_price = ($final_price * $request->tax_percentage)/100;
            //   $final_tax_price = $final_price + $tax_price;
            //   $main->final_price = strval($final_tax_price);
            //     }

            $main->save();
            if ($main) {
                return response()->json([
                    'status' => "1",
                    'msg' => "Sucessfully Updated"


                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "Someting went wrng"

                ]);
            }
        }
    }

    //Delete component content
    public function delete_admin_product(Request $request)
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
            if ($request->added_by == 'Vendor') {
                $tdetails = AdminProducts::where('_id', '=', $request->get('product_auto_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            } else {
                $tdetails = AdminProducts::where('_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            }
            $cdetails = CartProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
            $wdetails = WishlistProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
            $idetails = AdminProductImages::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            $cpdetails = CountryProductPrice::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        } else {
            if ($request->added_by == 'Vendor') {
                $tdetails = AdminProducts::where('_id', '=', $request->get('product_auto_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            } else {
                $tdetails = AdminProducts::where('_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            }
            $cdetails = CartProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
            $wdetails = WishlistProducts::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
            $idetails = AdminProductImages::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
            $cpdetails = CountryProductPrice::where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->delete();
        }
        if ($tdetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([

                'status' => 0,

                'msg' => "product Not found"

            ]);
        }
    }

    //product color
    public function add_admin_Product_color(Request $request)
    {
        $get_details = AdminProducts::where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '!=', '')->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        if ($get_details->isNotEmpty()) {
            foreach ($get_details as $dtls) {
                $main_category_auto_id = $dtls->main_category_auto_id;
                $sub_category_auto_id = $dtls->sub_category_auto_id;
                $added_by = $dtls->added_by;
                $product_dimensions = $dtls->product_dimensions;
                $product_name = $dtls->product_name;
                $highlights = $dtls->highlights;
                $description = $dtls->description;
                $specification_title = $dtls->specification_title;
                $specification_description = $dtls->specification_description;
                $isReturn = $dtls->isReturn;
                $isExchange = $dtls->isExchange;
                $days = $dtls->days;
                $brand_auto_id = $dtls->brand_auto_id;
                $new_arrival = $dtls->new_arrival;
                $moq = $dtls->moq;
                $gross_wt = $dtls->gross_wt;
                $net_wt = $dtls->net_wt;
                $unit = $dtls->unit;
                $quantity = $dtls->quantity;
                $weight = $dtls->weight;
                $time = $dtls->time;
                $time_unit = $dtls->time_unit;
                $use_by = $dtls->use_by;
                $closure_type = $dtls->closure_type;
                $fabric = $dtls->fabric;
                $sole = $dtls->sole;
                $veg_nonveg = $dtls->veg_nonveg;
                $egg_eggless = $dtls->egg_eggless;
                $Customizable = $dtls->Customizable;
                $product_sku = $dtls->product_sku;
                $Manufacturers = $dtls->Manufacturers;
                $Material = $dtls->Material;
                $Width = $dtls->Width;
                $height = $dtls->height;
                $depth = $dtls->depth;
                $Thickness = $dtls->Thickness;
                $Firmness = $dtls->Firmness;
                $Discount = $dtls->Discount;
                $Trial_Period = $dtls->Trial_Period;
                $stock = $dtls->stock;
                $available_stock = $dtls->available_stock;
                $Stock_alert_limit = $dtls->Stock_alert_limit;
            }
        } else {
            $main_category_auto_id = '';
            $sub_category_auto_id = '';
            $added_by = '';
            $product_dimensions = '';
            $product_name = '';
            $highlights = '';
            $description = '';
            $specification_title = '';
            $specification_description = '';
            $isReturn = '';
            $isExchange = '';
            $days = '';
            $brand_auto_id = '';
            $new_arrival = '';
            $moq = '';
            $gross_wt = '';
            $net_wt = '';
            $unit = '';
            $quantity = '';
            $weight = '';
            $time = '';
            $time_unit = '';
            $use_by = '';
            $closure_type = '';
            $fabric = '';
            $sole = '';
            $veg_nonveg = '';
            $egg_eggless = '';
            $Customizable = '';
            $product_sku = '';
            $Manufacturers = '';
            $Material = '';
            $Width = '';
            $height = '';
            $depth = '';
            $Thickness = '';
            $Firmness = '';
            $Discount = '';
            $Trial_Period = '';
            $stock = '';
            $available_stock = '';
            $Stock_alert_limit = '';
        }

        $cproduct = new AdminProducts();


        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');


        $cproduct->user_auto_id = $request->get('user_auto_id');

        if ($request->get('admin_auto_id') != '') {
            $cproduct->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $cproduct->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $cproduct->app_type_id = $request->get('app_type_id');
        } else {
            $cproduct->app_type_id = "";
        }
        $cproduct->product_model_auto_id = $request->get('product_model_auto_id');
        $cproduct->main_category_auto_id = $main_category_auto_id;
        $cproduct->sub_category_auto_id = $sub_category_auto_id;
        $cproduct->brand_auto_id = $brand_auto_id;
        $cproduct->product_name = $product_name;
        $cproduct->added_by = $added_by;
        $cproduct->product_dimensions = $product_dimensions;
        $cproduct->highlights = $highlights;
        $cproduct->description = $description;
        $cproduct->specification_title = $specification_title;
        $cproduct->specification_description = $specification_description;
        $cproduct->isReturn = $isReturn;
        $cproduct->isExchange = $isExchange;
        $cproduct->days = $days;
        $cproduct->new_arrival = $new_arrival;
        $cproduct->moq = $moq;
        $cproduct->gross_wt = $gross_wt;
        $cproduct->net_wt = $net_wt;
        $cproduct->unit = $unit;
        $cproduct->quantity = $quantity;
        $cproduct->weight = $weight;
        $cproduct->time = $time;
        $cproduct->time_unit = $time_unit;
        $cproduct->use_by = $use_by;
        $cproduct->closure_type = $closure_type;
        $cproduct->fabric = $fabric;
        $cproduct->sole = $sole;
        $cproduct->veg_nonveg = $veg_nonveg;
        $cproduct->egg_eggless = $egg_eggless;
        $cproduct->Customizable = $Customizable;
        $cproduct->product_sku = $product_sku;
        $cproduct->Manufacturers = $Manufacturers;
        $cproduct->Material = $Material;
        $cproduct->Width = $Width;
        $cproduct->height = $height;
        $cproduct->depth = $depth;
        $cproduct->Thickness = $Thickness;
        $cproduct->Firmness = $Firmness;
        $cproduct->Discount = $Discount;
        $cproduct->Trial_Period = $Trial_Period;
        $cproduct->stock = $stock;
        $cproduct->available_stock = $available_stock;
        $cproduct->Stock_alert_limit = $Stock_alert_limit;


        if (!empty($request->file('color_image'))) {
            $file = $request->file('color_image');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/products');
            $file->move($path, $filename);
            $cproduct->color_image = $filename;
        } else {
            $cproduct->color_image = '';
        }

        if ($request->get('color_name') != '') {
            $cproduct->color_name = $request->get('color_name');
        } else {
            $cproduct->color_name = "";
        }

        if ($request->get('size') != '') {
            $cproduct->size = $request->get('size');
        } else {
            $cproduct->size = "";
        }
        if ($request->get('color_name_visible') != '') {
            $cproduct->color_name_visible = $request->get('color_name_visible');
        } else {
            $cproduct->color_name_visible = "Yes";
        }
        $cproduct->register_date = date('Y-m-d');
        $cproduct->save();
        if ($cproduct) {
            return response()->json([
                'status' => "1",
                'data' => $cproduct

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "Someting went wrong"

            ]);
        }
    }
    public function update_admin_Product_color_setting(Request $request)
    {
        $uproduct = AdminProducts::where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        if ($uproduct->isEmpty()) {
            return response()->json(['status' => "0", "msg" => "No data Found"]);
        } else {

            $update = DB::table('admin_products')->where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->update(['color_name_visible' => $request->color_name_visible]);

            return response()->json([
                'status' => "1",
                'msg' => "Sucessfully Updated"


            ]);
        }
    }

    //get product colors
    public function get_admin_product_colors(Request $request)
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
            if ($request->added_by == 'Vendor') {
                $get_clists = AdminProducts::where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $get_clists = AdminProducts::where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
        } else {
            if ($request->added_by == 'Vendor') {
                $get_clists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $get_clists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $request->get('product_model_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
        }
        if ($get_clists->isNotEmpty()) {
            foreach ($get_clists as $curs) {
                $product_auto_id = $curs->_id;
                $product_auto_ids = $curs->product_auto_id;
                $product_model_auto_id = $curs->product_model_auto_id;
                $color_image = $curs->color_image;
                $color_name = $curs->color_name;
                $size = $curs->size;
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
                            $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                    $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                    $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
                }
                if ($currency_user->isNotEmpty()) {
                    foreach ($currency_user as $cuid) {
                        $country_code_id = $cuid->id;
                    }
                } else {
                    $country_code_id = '';
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

                    $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                    $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
                $get_cfinal_lists[] = array("product_auto_id" => $product_auto_id, "product_model_auto_id" => $product_model_auto_id, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices, "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "get_size_lists" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists, "product_image_lists" => $image_lists);
            }
            return response()->json(['status' => 1, "msg" => "success", 'get_products_lists' => $get_cfinal_lists]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }


    //get product colors
    public function get_product_details(Request $request)
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
            if ($request->added_by == 'Vendor') {
                $get_aplists = AdminProducts::where('_id', '=', $request->get('product_auto_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $get_aplists = AdminProducts::where('_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
        } else {
            if ($request->added_by == 'Vendor') {
                $get_aplists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('_id', '=', $request->get('product_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $get_aplists = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('product_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
        }
        if ($get_aplists->isNotEmpty()) {
            foreach ($get_aplists as $urs) {
                $product_auto_id = $urs->_id;
                $product_auto_ids = $urs->product_auto_id;
                $product_model_auto_id = $urs->product_model_auto_id;
                $color_image = $urs->color_image;
                $color_name = $urs->color_name;
                $cost_price = $urs->cost_price;
                $misc_expenditure = $urs->misc_expenditure;
                $size = $urs->size;
                $specification_title = $urs->specification_title;
                $specification_description = $urs->specification_description;
                $pids = array();
                $qids = array();
                $specification_title_ids = explode('|', $specification_title);
                $specification_description_ids = explode('|', $specification_description);
                foreach ($specification_title_ids as $data1) {
                    $pids[] = $data1;
                }
                foreach ($specification_description_ids as $data2) {
                    $qids[] = $data2;
                }
                $emailArray = $pids;
                $totaltitles = count($emailArray);
                $qArray = $qids;
                $totaldescription = count($qArray);
                if ($emailArray != "") {
                    for ($i = 0; $i < $totaltitles; $i++) {
                        $get_specification_details[] = array("title" => $emailArray[$i], "description" => $qArray[$i]);
                    }
                } else {
                    $get_specification_details = array();
                }
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
                            $sizelist = SizeLists::where('_id', '=', $sz)->get();
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
                    $currency_user = Currency::where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                    $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                    $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
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
                    $isReturn = $dtls->isReturn;
                    $isExchange = $dtls->isExchange;
                    $days = $dtls->days;
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
                    $product_sku = $dtls->product_sku;
                    $Manufacturers = $dtls->Manufacturers;
                    $Material = $dtls->Material;
                    $Width = $dtls->Width;
                    $height = $dtls->height;
                    $depth = $dtls->depth;
                    $Thickness = $dtls->Thickness;
                    $Firmness = $dtls->Firmness;
                    $Discount = $dtls->Discount;
                    $Trial_Period = $dtls->Trial_Period;
                    $stock = $dtls->stock;
                    $available_stock = $dtls->available_stock;
                    $Stock_alert_limit = $dtls->Stock_alert_limit;
                    $veg_nonveg = $dtls->veg_nonveg;
                    $egg_eggless = $dtls->egg_eggless;
                    $Customizable = $dtls->Customizable;
                    $color_name_visible = $dtls->color_name_visible;
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

                    $sizechart = SizeChart::where('subcategory_auto_id', 'LIKE', '%' . $sub_category_auto_id . '%')->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                } else {
                    $sizechart = SizeChart::where('subcategory_auto_id', 'LIKE', '%' . $sub_category_auto_id . '%')->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                }
                if ($sizechart->isNotEmpty()) {
                    foreach ($sizechart as $schart) {
                        $size_chart = $schart->chart_image;
                    }
                } else {
                    $size_chart = '';
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
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {

                    $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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


                $apdcats[] = array(
                    "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by, "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable, "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "isReturn" => $isReturn, "isExchange" => $isExchange, "days" => $days, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency, "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices, "color_image" => $color_image, "color_name" => $color_name, "size_chart" => $size_chart, "total_no_of_reviews" => $courseRatingReviewCount, "specification_details" => $get_specification_details, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists, "Manufacturers" => $Manufacturers, "Material" => $Material, "Width" => $Width, "height" => $height,
                    "depth" => $depth, "Thickness" => $Thickness, "Firmness" => $Firmness, "Discount" => $Discount, "Trial_Period" => $Trial_Period, "product_sku" => $product_sku, "stock" => $stock,"cost_price" =>$cost_price, "misc_expenditure"=> $misc_expenditure,
                    "available_stock" => $available_stock, "Stock_alert_limit" => $Stock_alert_limit, "color_name_visible" => $color_name_visible
                );
            }
            return response()->json(['status' => 1, "msg" => "success", 'get_products_details' => $apdcats]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    //product color
    public function add_product_image(Request $request)
    {


        $productimages = new AdminProductImages();


        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');


        $productimages->product_auto_id = $request->get('product_auto_id');
        if ($request->get('admin_auto_id') != '') {
            $productimages->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $productimages->admin_auto_id = "";
        }
        if ($request->get('app_type_id') != '') {
            $productimages->app_type_id = $request->get('app_type_id');
        } else {
            $productimages->app_type_id = "";
        }
        if (!empty($request->file('image_file'))) {
            $file = $request->file('image_file');
            $filename = $file->getClientOriginalName();

            $path = public_path('images/products_images');
            $file->move($path, $filename);
            $productimages->image_file = $filename;
        } else {
            $productimages->image_file = '';
        }
        $productimages->rdate = date('Y-m-d');

        $productimages->save();
        if ($productimages) {
            return response()->json([
                'status' => "1",
                'data' => $productimages

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "Someting went wrong"

            ]);
        }
    }
    //Delete component content
    public function delete_product_image(Request $request)
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

            $idetails = AdminProductImages::where('_id', '=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('product_auto_id', '=', $request->get('product_auto_id'))->delete();
        } else {
            $idetails = AdminProductImages::where('_id', '=', $request->get('image_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id', '=', $request->get('product_auto_id'))->where('app_type_id', $request->app_type_id)->delete();
        }
        if ($idetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([

                'status' => 0,

                'msg' => "product image Not found"

            ]);
        }
    }
    // brand products
    public function get_Admin_Brand_Product(Request $request)
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '6306fc8918573a0e5ba5a218')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {

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
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('brand_auto_id', '=', $request->get('brand_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('brand_auto_id', '=', $request->get('brand_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('brand_auto_id', '=', $request->get('brand_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('brand_auto_id', '=', $request->get('brand_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }
            }

            $total_page = (int) ceil($total_custs_count / $limits);

            if ($total_page < 1) {
                $total_pagess = 1;
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
                if ($request->added_by == 'Vendor') {
                    $pcat = AdminProducts::where('brand_auto_id', '=', $request->get('brand_id'))->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $pcat = AdminProducts::where('brand_auto_id', '=', $request->get('brand_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $pcat = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('brand_auto_id', '=', $request->get('brand_id'))->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $pcat = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('brand_auto_id', '=', $request->get('brand_id'))->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            }
            if ($pcat->isEmpty()) {

                return response()->json([
                    'status' => 0,
                    "msg" => "No Data Available"
                ]);
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
                                $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                        $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                        $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                    } else {
                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                        $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                    } else {
                        $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    if ($pimage_details->isNotEmpty()) {
                        foreach ($pimage_details as $pidata) {
                            $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                        }
                    } else {
                        $image_lists = array();
                    }
                    //rating review
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }

                    if ($erase_data_status == 'Yes') {

                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                    } else {
                        $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
                            }

                            $avg_rating = ($total_student * $total_rating / $total_student);
                        }
                    } else {
                        $courseRatingReview = array();
                    }
                    $pcats[] = array(
                        "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                        "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                        "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                        "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                        "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                    );
                }
            }

            return response()->json([
                'status' => 1,
                "total_custs_count" => $total_custs_count,
                "total_pages" => $total_pages,
                "curent_page" => $curent_page,
                "next_page" => $next_page,
                "previous_page" => $previous_page,
                'get_admin_brand_product_lists' => $pcats,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    // category products
    public function get_Admin_MainCategory_Product(Request $request)
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '6306fc8918573a0e5ba5a218')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {

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
                if ($request->added_by == 'Vendor') {

                    $total_custs_count = AdminProducts::where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }
            }


            $total_page = (int) ceil($total_custs_count / $limits);

            if ($total_page < 1) {
                $total_pagess = 1;
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
                if ($request->added_by == 'Vendor') {

                    $pcatss = AdminProducts::where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $pcatss = AdminProducts::where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $pcatss = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $pcatss = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('main_category_auto_id', '=', $request->get('main_cat_id'))->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            }
            if ($pcatss->isEmpty()) {

                return response()->json([
                    'status' => 0,
                    "msg" => "No Data Available"
                ]);
            } else {
                foreach ($pcatss as $urs) {
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
                                $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                        $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                        $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                    } else {
                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                        $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                    } else {
                        $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $available_stock = $dtls->available_stock;
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
                            $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                    } else {
                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
                            }

                            $avg_rating = ($total_student * $total_rating / $total_student);
                        }
                    } else {
                        $courseRatingReview = array();
                    }
                    $pcatsss[] = array(
                        "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                        "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                        "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                        "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                        "color_image" => $color_image, "color_name" => $color_name, "available_stock" => $available_stock,
                        "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                    );
                }
            }

            return response()->json([
                'status' => 1,
                "total_custs_count" => $total_custs_count,
                "total_pages" => $total_pages,
                "curent_page" => $curent_page,
                "next_page" => $next_page,
                "previous_page" => $previous_page,
                'get_admin_category_product_lists' => $pcatsss,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    // sub category products
    public function get_Admin_Subcategory_Product(Request $request)
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
        } else {
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            if ($request->added_by == 'Vendor') {

                $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
            } else {
                $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
            }
        } else {
            if ($request->added_by == 'Vendor') {

                $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '6306fc8918573a0e5ba5a218')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->where('user_auto_id', $request->user_auto_id)->whereNull('deleted_at')->get();
            } else {
                $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '6306fc8918573a0e5ba5a218')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
        }
        if ($currency_price_detailss->isNotEmpty()) {

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
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->whereNull('deleted_at')->count();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }
            }

            $total_page = (int) ceil($total_custs_count / $limits);

            if ($total_page < 1) {
                $total_pagess = 1;
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
                if ($request->added_by == 'Vendor') {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            }
            if ($scats->isEmpty()) {

                return response()->json([
                    'status' => 0,
                    "msg" => "No Data"
                ]);
            } else {
                foreach ($scats as $urs) {
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
                                $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                        $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                        $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                    } else {
                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                        $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                    } else {
                        $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $available_stock = $dtls->available_stock;
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
                            $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    if ($pimage_details->isNotEmpty()) {
                        foreach ($pimage_details as $pidata) {
                            $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                        }
                    } else {
                        $image_lists = array();
                    }
                    //rating review
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                    } else {
                        $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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
                        "color_image" => $color_image, "color_name" => $color_name, "available_stock" => $available_stock,
                        "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                    );
                }
            }

            return response()->json([
                'status' => 1,
                "total_custs_count" => $total_custs_count,
                "total_pages" => $total_pages,
                "curent_page" => $curent_page,
                "next_page" => $next_page,
                "previous_page" => $previous_page,
                'get_admin_subcategory_product_lists' => $sscats,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    // similar products
    public function get_simillar_products(Request $request)
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {

            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }


            if ($erase_data_status == 'Yes') {
                $scats = AdminProducts::ORDERBY('_id', 'DESC')->where('sub_category_auto_id', '=', $request->get('sub_category_auto_id'))->where('app_type_id', $request->app_type_id)->where('_id', '!=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->orwhere('main_category_auto_id', '=', $request->get('main_category_auto_id'))->limit(10)->whereNull('deleted_at')->get();
            } else {
                $scats = AdminProducts::ORDERBY('_id', 'DESC')->where('sub_category_auto_id', '=', $request->get('sub_category_auto_id'))->where('_id', '!=', $request->get('product_auto_id'))->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->orwhere('main_category_auto_id', '=', $request->get('main_category_auto_id'))->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->limit(10)->whereNull('deleted_at')->get();
            }
            if ($scats->isEmpty()) {

                return response()->json([
                    'status' => 0,
                    "msg" => "No Data Available"
                ]);
            } else {
                foreach ($scats as $urs) {
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
                                $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                        $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                        $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                    } else {
                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                        $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                    } else {
                        $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                    } else {
                        $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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
            return response()->json([
                'status' => 1,
                'get_similar_product_lists' => $sscats,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    // also buy products
    public function get_also_buy_products(Request $request)
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {
            foreach ($currency_price_detailss as $cuidss) {
                $product_auto_id = $cuidss->product_auto_id;
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $orders = CartProducts::where('user_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $orders = CartProducts::where('user_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($orders->isEmpty()) {
                    return response()->json([
                        'status' => 0,
                        "msg" => "No Data Available"
                    ]);
                } else {
                    foreach ($orders as $albuy) {
                        $product_auto_id = $albuy->product_auto_id;
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
                        $scats = AdminProducts::where('_id', '!=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('_id', '=', $cuidss->product_auto_id)->whereNull('deleted_at')->limit(10)->get();
                    } else {
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '!=', $product_auto_id)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->limit(4)->get();
                    }
                    if ($scats->isEmpty()) {
                        return response()->json([
                            'status' => 0,
                            "msg" => "No Data Available"
                        ]);
                    } else {
                        foreach ($scats as $urs) {
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
                                        $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                                $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                                $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                                $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                                $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                            } else {
                                $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                                    $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                                $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                            } else {
                                $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                        $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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
                }
            }
            return response()->json([
                'status' => 1,
                'get_also_buy_product_lists' => $sscats,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    // recommended products
    public function get_recommended_products(Request $request)
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {

            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
            if ($esatatus->isNotEmpty()) {
                foreach ($esatatus as $erase) {
                    $erase_data_status = $erase->erase_data_status;
                }
            } else {
                $erase_data_status = 'No';
            }
            if ($erase_data_status == 'Yes') {
                $searchlist = Search::ORDERBY('sid', 'DESC')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            } else {
                $searchlist = Search::ORDERBY('sid', 'DESC')->where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
            }
            if ($searchlist->isEmpty()) {

                return response()->json([
                    'status' => 0,
                    "msg" => "No Data Available"
                ]);
            } else {
                foreach ($searchlist->unique('sid') as $search) {


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
                        $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->orwhere('main_category_auto_id', '=', $search->sid)->orwhere('sub_category_auto_id', '=', $search->sid)->orwhere('brand_auto_id', '=', $search->sid)->orwhere('_id', '=', $search->sid)->whereNull('deleted_at')->count();
                    } else {
                        $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->orwhere('main_category_auto_id', '=', $search->sid)->orwhere('sub_category_auto_id', '=', $search->sid)->orwhere('_id', '=', $search->sid)->orwhere('brand_auto_id', '=', $search->sid)->whereNull('deleted_at')->count();
                    }

                    $total_page = $total_custs_count / $limits;
                    if ($total_page < 1) {
                        $total_pagess = 1;
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
                            $offset = ($limits * ($page_number - 1)) + 1;
                            $offsetss = (int)$offset;
                        }
                    }

                    if ($erase_data_status == 'Yes') {
                        $scatssss = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->orwhere('main_category_auto_id', '=', $search->sid)->orwhere('sub_category_auto_id', '=', $search->sid)->orwhere('brand_auto_id', '=', $search->sid)->orwhere('_id', '=', $search->sid)->whereNull('deleted_at')->limit(12)->get();
                    } else {
                        $scatssss = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->orwhere('main_category_auto_id', '=', $search->sid)->orwhere('sub_category_auto_id', '=', $search->sid)->orwhere('brand_auto_id', '=', $search->sid)->orwhere('_id', '=', $search->sid)->whereNull('deleted_at')->limit(12)->get();
                    }
                    if (empty($scatssss)) {

                        return response()->json([
                            'status' => 0,
                            "msg" => "No Data Available"
                        ]);
                    } else {
                        foreach ($scatssss as $urs) {
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
                                        $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                                $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                                $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                                $currency_price_details = CountryProductPrice::where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                                $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                            } else {
                                $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                                    $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                                $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                            } else {
                                $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                                $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                        $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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
                }
            }

            return response()->json([
                'status' => 1,
                'get_recommended_products_lists' => $sscats,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //offer products
    public function get_offer_products(Request $request)
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('offer_auto_id', '=', $request->get('offer_auto_id'))->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '6306fc8918573a0e5ba5a218')->where('offer_auto_id', '=', $request->get('offer_auto_id'))->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {
            foreach ($currency_price_detailss as $cuidss) {
                $product_auto_id = $cuidss->product_auto_id;
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
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }

                $total_page = (int) ceil($total_custs_count / $limits);

                if ($total_page < 1) {
                    $total_pagess = 1;
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
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->offset($offsetss)->limit($limits)->get();
                } else {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->offset($offsetss)->limit($limits)->get();
                }
                if ($scats->isEmpty()) {

                    return response()->json([
                        'status' => 0,
                        "msg" => "No Data Available"
                    ]);
                } else {
                    foreach ($scats as $urs) {
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
                                    $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                        } else {
                            $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                                $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                        } else {
                            $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                    $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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
            }
            return response()->json([
                'status' => 1,
                "total_custs_count" => $total_custs_count,
                "total_pages" => $total_pages,
                "curent_page" => $curent_page,
                "next_page" => $next_page,
                "previous_page" => $previous_page,
                'get_admin_offer_product_lists' => $sscats,
            ]);
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    //filter products
    public function get_filter_products(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        $conditions = array();

        $price_ids = [];
        $height_ids = [];
        $width_ids = [];
        $depth_ids = [];
        $discount_ids = [];
        $trial_ids = [];
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
            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        } else {
            $currency_price_detailss = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orwhere('admin_auto_id', '')->where('currency_auto_id', '=', $country_code_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
        }
        if ($currency_price_detailss->isNotEmpty()) {
            foreach ($currency_price_detailss as $cuidss) {
                $product_auto_id = $cuidss->product_auto_id;




                if ($request->min_price != "") {
                    $minPrice = $request->min_price;
                } else {
                    $minPrice = "";
                }
                if ($request->max_price != "") {
                    $maxPrice = $request->max_price;
                } else {
                    $maxPrice = "";
                }
                if ($minPrice != "") {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $cpps = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $cpps = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }


                    foreach ($cpps as $cp) {
                        if (intval($cp['final_price']) >= intval($minPrice) && intval($cp['final_price'] <= intval($maxPrice))) {
                            array_push($price_ids, $cp->product_auto_id);
                        }
                    }
                }

                if (!empty($price_ids)) {
                    array_push($conditions, array('field' => '_id', 'value' => $price_ids, 'condition' => 'whereIn'));
                }
                //height filter
                if ($request->min_height != "") {
                    $min_height = $request->min_height;
                } else {
                    $min_height = "";
                }
                if ($request->max_height != "") {
                    $max_height = $request->max_height;
                } else {
                    $max_height = "";
                }
                if ($min_height != "") {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($cpps as $cp) {
                        //   $scats= AdminProducts::where('_id','=',$cp->product_auto_id)->get();
                        //     if($scats->isEmpty()){
                        //       $scats =[];
                        //   }
                        if (intval($cp["height"]) >= intval($min_height) && intval($cp["height"]) <= intval($max_height)) {
                            array_push($height_ids, $cp->product_auto_id);
                        }
                    }
                }

                if (!empty($height_ids)) {
                    array_push($conditions, array('field' => '_id', 'value' => $height_ids, 'condition' => 'whereIn'));
                }
                //width filter
                if ($request->min_width != "") {
                    $min_width = $request->min_width;
                } else {
                    $min_width = "";
                }
                if ($request->max_width != "") {
                    $max_width = $request->max_width;
                } else {
                    $max_width = "";
                }
                if ($min_width != "") {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($cpps as $cp) {

                        if (intval($cp['Width']) >= intval($min_width) && intval($cp['Width']) <= intval($max_width)) {

                            //   $scats= AdminProducts::where('_id','=',$cp->product_auto_id)->whereNull('deleted_at')->get();
                            //     if($scats->isEmpty()){
                            //       $scats =[];
                            //   }

                            array_push($width_ids, $cp->product_auto_id);
                        }
                    }
                }
                if (!empty($width_ids)) {
                    array_push($conditions, array('field' => '_id', 'value' => $width_ids, 'condition' => 'whereIn'));
                }

                //depth filter
                if ($request->min_depth != "") {
                    $min_depth = $request->min_depth;
                } else {
                    $min_depth = "";
                }
                if ($request->max_depth != "") {
                    $max_depth = $request->max_depth;
                } else {
                    $max_depth = "";
                }
                if ($min_depth != "") {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($cpps as $cp) {

                        if (intval($cp["depth"]) >= intval($min_depth) && intval($cp["depth"]) <= intval($max_depth))
                        //   $scats= AdminProducts::where('_id','=',$cp->product_auto_id)->get();
                        //     if($scats->isEmpty()){
                        //       $scats =[];
                        //   }

                        {
                            array_push($depth_ids, $cp->product_auto_id);
                        }
                    }
                }

                if (!empty($depth_ids)) {
                    array_push($conditions, array('field' => '_id', 'value' => $depth_ids, 'condition' => 'whereIn'));
                }
                //discount filter
                if ($request->min_discount != "") {
                    $min_discount = $request->min_discount;
                } else {
                    $min_discount = "";
                }
                if ($request->max_discount != "") {
                    $max_discount = $request->max_discount;
                } else {
                    $max_discount = "";
                }
                if ($min_discount != "") {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $cpps = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $cpps = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($cpps as $cp) {
                        //   $scats= AdminProducts::where('_id','=',$cp->product_auto_id)->whereNull('deleted_at')->get();
                        //     if($scats->isEmpty()){
                        //       $scats =[];
                        //   }
                        if (intval($cp["offer_percentage"]) >= intval($min_discount) && intval($cp["offer_percentage"]) <= intval($max_discount))

                            array_push($discount_ids, $cp->product_auto_id);
                    }
                }

                if (!empty($discount_ids)) {
                    array_push($conditions, array('field' => '_id', 'value' => $discount_ids, 'condition' => 'whereIn'));
                }


                //trial period filter
                if ($request->min_trial_period != "") {
                    $min_trial_period = $request->min_trial_period;
                } else {
                    $min_trial_period = "";
                }
                if ($request->max_trial_period != "") {
                    $max_trial_period = $request->max_trial_period;
                } else {
                    $max_trial_period = "";
                }
                if ($min_trial_period != "") {
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        $cpps = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    foreach ($cpps as $cp) {
                        //   $scats= AdminProducts::where('_id','=',$cp->product_auto_id)->whereNull('deleted_at')->get();
                        //     if($scats->isEmpty()){
                        //       $scats =[];
                        //   }
                        if (intval($cp["Trial_Period"]) >= intval($min_trial_period) && intval($cp["Trial_Period"]) <= intval($max_trial_period)) {
                            array_push($trial_ids, $cp->product_auto_id);
                        }
                    }
                }

                if (!empty($trial_ids)) {
                    array_push($conditions, array('field' => '_id', 'value' => $trial_ids, 'condition' => 'whereIn'));
                }
                if ($request->get('moq') != "") {
                    $moq = $request->get('moq');
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        //   $scats = AdminProducts::where('moq','=',$moq)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();

                        array_push($conditions, array('field' => 'moq', 'value' => $moq, 'condition' => 'where'));
                    } else {
                        array_push($conditions, array('field' => 'moq', 'value' => $moq, 'condition' => 'orwhereIn'));
                        //   $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id',"6306fc8918573a0e5ba5a218")->where('moq','=',$moq)->where('_id','=',$cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    //   if($scats->isEmpty()){
                    //       $scats =[];
                    //   }

                }
                if ($request->get('brand_id') != "") {
                    $brand_ids = explode('|', $request->get('brand_id'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        array_push($conditions, array('field' => 'brand_auto_id', 'value' => $brand_ids, 'condition' => 'whereIn'));

                        //   $scats = AdminProducts::where('brand_auto_id','=',$data1)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        array_push($conditions, array('field' => 'brand_auto_id', 'value' => $brand_ids, 'condition' => 'orwhereIn'));

                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('brand_auto_id', '=', $data1)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    //   if($scats->isEmpty()){
                    //       $scats =[];
                    //   }

                }
                //manufacturer filter
                if ($request->get('manufacturer_name') != "") {
                    $manu_ids = explode('|', $request->get('manufacturer_name'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        // $scats = AdminProducts::where('Manufacturers','=',$data1)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'Manufacturers', 'value' => $manu_ids, 'condition' => 'whereIn'));
                    } else {
                        array_push($conditions, array('field' => 'Manufacturers', 'value' => $manu_ids, 'condition' => 'orwhereIn'));

                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('Manufacturers', '=', $data1)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    //   if($scats->isEmpty()){
                    //       $scats =[];
                    //   }

                }
                //material filter
                if ($request->get('material_name') != "") {
                    $material_names = explode('|', $request->get('material_name'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        //   $scats = AdminProducts::where('Material','=',$material_names)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'Material', 'value' => $material_names, 'condition' => 'whereIn'));
                    } else {
                        array_push($conditions, array('field' => 'Material', 'value' => $material_names, 'condition' => 'orwhereIn'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('Material', '=', $data1)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    //   if($scats->isEmpty()){
                    //       $scats =[];
                    //   }

                }
                //firmness type filter
                if ($request->get('firmness_type') != "") {
                    $firmness_types = explode('|', $request->get('firmness_type'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        array_push($conditions, array('field' => 'Firmness', 'value' => $firmness_types, 'condition' => 'whereIn'));
                        //   $scats = AdminProducts::where('Firmness','=',$data1)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    } else {
                        array_push($conditions, array('field' => 'Firmness', 'value' => $firmness_types, 'condition' => 'orwhereIn'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('Firmness', '=', $data1)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    // if($scats->isEmpty()){
                    //  $scats =[];
                    //}

                }
                //Color filter
                if ($request->get('color_name') != "") {
                    $colorname_ids = explode('|', $request->get('color_name'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        //   $scats = AdminProducts::where('color_name','=',$data2)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'color_name', 'value' => $colorname_ids, 'condition' => 'whereIn'));
                    } else {
                        array_push($conditions, array('field' => 'color_name', 'value' => $colorname_ids, 'condition' => 'orwhereIn'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('color_name', '=', $data2)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                }
                if ($request->get('size_id') != "") {
                    $size_ids = explode('|', $request->get('size_id'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        //   $scats = AdminProducts::where('size','=',$data3)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'size', 'value' => $size_ids, 'condition' => 'whereIn'));
                    } else {
                        array_push($conditions, array('field' => 'size', 'value' => $size_ids, 'condition' => 'orwhereIn'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('size', '=', $data3)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                }
                if ($request->get('main_category_id') != "") {
                    $maincat_ids = explode('|', $request->get('main_category_id'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {
                        //   $scats = AdminProducts::where('main_category_auto_id','=',$data4)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'main_category_auto_id', 'value' => $maincat_ids, 'condition' => 'whereIn'));
                    } else {
                        array_push($conditions, array('field' => 'main_category_auto_id', 'value' => $maincat_ids, 'condition' => 'orwhereIn'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('main_category_auto_id', '=', $data4)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                }
                if ($request->get('sub_category_id') != "") {
                    $subcat_ids = explode('|', $request->get('sub_category_id'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        //   $scats = AdminProducts::where('sub_category_auto_id','=',$data5)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'sub_category_auto_id', 'value' => $subcat_ids, 'condition' => 'whereIn'));
                    } else {
                        array_push($conditions, array('field' => 'sub_category_auto_id', 'value' => $subcat_ids, 'condition' => 'orwhereIn'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('sub_category_auto_id', '=', $data5)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                }
                if ($request->get('out_of_stock') != "") {
                    $outofstock_ids = explode('|', $request->get('out_of_stock'));

                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        //$scats = AdminProducts::where('available_stock','>=',"0")->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        array_push($conditions, array('field' => 'available_stock', 'value' => "0", 'condition' => '>where'));
                    } else {
                        array_push($conditions, array('field' => 'available_stock', 'value' => "0", 'condition' => '>orwhere'));
                        $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('sub_category_auto_id', '=', $data5)->where('_id', '=', $cuidss->product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                }
                $limits = (int)$request->get('limit');
                $page_number = (int)$request->get('page_number');
                $i = 0;
                $total_custs_count = AdminProducts::where(function ($q) use ($conditions) {
                    foreach ($conditions as $key) {
                        if ($key['condition'] == "whereIn") {
                            $q->whereIn($key['field'], $key['value']);
                        } else if ($key['condition'] == "orwhereIn") {
                            $i++;
                            if ($i == 1) {
                                $q->whereIn($key['field'], $key['value'])->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218");
                            } else {
                                $q->whereIn($key['field'], $key['value']);
                            }
                        } else if ($key['condition'] == ">where") {
                            $q->where($key['field'], ">=", strval($key['value']));
                        } else if ($key['condition'] == ">orwhere") {

                            $q->where($key['field'], ">=", strval($key['value']));
                        } else {
                            $q->where($key['field'], "=", $key['value']);
                        }
                    }
                })->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();

                $total_page = (int) ceil($total_custs_count / $limits);

                if ($total_page < 1) {
                    $total_pagess = 1;
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

                $i = 0;
                $scats = AdminProducts::where(function ($q) use ($conditions) {
                    foreach ($conditions as $key) {
                        if ($key['condition'] == "whereIn") {
                            $q->whereIn($key['field'], $key['value']);
                        } else if ($key['condition'] == "orwhereIn") {
                            $i++;
                            if ($i == 1) {
                                $q->whereIn($key['field'], $key['value'])->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218");
                            } else {
                                $q->whereIn($key['field'], $key['value']);
                            }
                        } else if ($key['condition'] == ">where") {
                            $q->where($key['field'], ">=", strval($key['value']));
                        } else if ($key['condition'] == ">orwhere") {

                            $q->where($key['field'], ">=", strval($key['value']));
                        } else {
                            $q->where($key['field'], "=", $key['value']);
                        }
                    }
                })->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                if ($scats->isEmpty()) {

                    return response()->json([
                        'status' => 0,
                        "msg" => "No Data Available"
                    ]);
                } else {
                    foreach ($scats as $urs) {
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
                                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
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
                                    $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                            $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                        } else {
                            $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                                $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                        } else {
                            $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                    $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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

                    return response()->json([
                        "status" => 1,
                        "total_custs_count" => $total_custs_count,
                        "total_pages" => $total_pages,
                        "curent_page" => $curent_page,
                        "next_page" => $next_page,
                        "previous_page" => $previous_page,
                        "get_admin_filter_product_lists" => $sscats,
                    ]);
                }
            }
        } else {

            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }
    // component products
    public function get_component_product(Request $request)
    {

        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        $sub_cat_id = $request->get('sub_cat_id');
        $sub_cat_auto_ids = explode('|', $sub_cat_id);
        unset($get_slists);
        foreach ($sub_cat_auto_ids as $subcatproduct) {


            $limits = (int)$request->get('limit');
            $page_number = (int)$request->get('page_number');
            if ($erase_data_status == 'Yes') {
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $subcatproduct)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $subcatproduct)->whereNull('deleted_at')->count();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('sub_category_auto_id', '=', $subcatproduct)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                } else {
                    $total_custs_count = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('sub_category_auto_id', '=', $subcatproduct)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                }
            }

            $total_page = (int) ceil($total_custs_count / $limits);

            if ($total_page < 1) {
                $total_pagess = 1;
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
                if ($request->added_by == 'Vendor') {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('user_auto_id', $request->user_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $subcatproduct)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('sub_category_auto_id', '=', $subcatproduct)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            } else {
                if ($request->added_by == 'Vendor') {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->where('sub_category_auto_id', '=', $subcatproduct)->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                } else {
                    $scats = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('sub_category_auto_id', '=', $subcatproduct)->where('app_type_id', $request->app_type_id)->offset($offsetss)->limit($limits)->whereNull('deleted_at')->get();
                }
            }


            if ($scats->isEmpty()) {

                return response()->json([
                    'status' => 0,
                    "msg" => "No Data"
                ]);
            } else {
                foreach ($scats as $urs) {
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
                                $sizelist = SizeLists::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                        $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('customer_auto_id'))->whereNull('deleted_at')->get();
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
                        $currency_user = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
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

                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                    } else {
                        $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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

                        $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('app_type_id', $request->app_type_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                    } else {
                        $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                            $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
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
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
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
                        $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                    }
                    if ($pimage_details->isNotEmpty()) {
                        foreach ($pimage_details as $pidata) {
                            $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                        }
                    } else {
                        $image_lists = array();
                    }
                    //rating review
                    $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                    if ($esatatus->isNotEmpty()) {
                        foreach ($esatatus as $erase) {
                            $erase_data_status = $erase->erase_data_status;
                        }
                    } else {
                        $erase_data_status = 'No';
                    }
                    if ($erase_data_status == 'Yes') {

                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
                    } else {
                        $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->where('app_type_id', $request->app_type_id)->whereNull('deleted_at')->count();
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
                                $total_student = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();
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
        }
        return response()->json([
            'status' => 1,
            "total_custs_count" => $total_custs_count,
            "total_pages" => $total_pages,
            "curent_page" => $curent_page,
            "next_page" => $next_page,
            "previous_page" => $previous_page,
            'get_admin_component_product_lists' => $sscats,
        ]);
    }
}