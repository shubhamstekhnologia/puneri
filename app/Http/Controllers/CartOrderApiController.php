<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use App\Admin;
use App\BuyNow;
use App\Orders;
use App\Wallet;
use App\Pincode;
use App\Currency;
use App\ECharges;
use DateInterval;
use DateTimeZone;
use App\SizeLists;
use App\CouponCode;
use App\DeliveryBoy;
use App\CartProducts;
use App\Subscription;
use App\UserRegister;
use App\VendorOrders;
use App\AdminProducts;
use App\OfferComponent;
use App\CartUserAddress;
use App\WishlistProducts;
use App\EcommRegistration;
use App\AdminProductColors;
use App\AdminProductImages;
use App\CountryProductPrice;
use App\ProductRatingReview;
use Illuminate\Http\Request;
use App\PincodeDeliverySetting;
use App\WalletTransactionHistory;
use App\Http\Controllers\Controller;
use App\Vacation;

class CartOrderApiController extends Controller
{
    //product cart
    public function add_to_cart(Request $request)
    {
        $productcart = new CartProducts();
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $checkproduct = CartProducts::where('product_auto_id', $request->product_auto_id)->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
        } else {
            $checkproduct = CartProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', $request->product_auto_id)->where('user_auto_id', $request->user_auto_id)->whereNull('deleted_at')->first();
        }
        if ($checkproduct) {
            return response()->json([
                'status' => '0',
                'msg' => 'Product already added in cart',
            ]);
        } else {
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');


            $productcart->product_auto_id = $request->get('product_auto_id');
            $productcart->admin_auto_id = $request->get('admin_auto_id');
            $productcart->user_auto_id = $request->get('user_auto_id');
            $productcart->cart_quantity = $request->get('cart_quantity');
            $productcart->size = $request->get('size', '');
            $productcart->start_date = $request->get('start_date');
            $productcart->subscription_type = $request->get('subscription_type');
            $productcart->product_quantity = $request->get('product_quantity');
            $productcart->days = $request->get('days');
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $order_date = $date->format('Y-m-d');
            $order_time = $date->format('H:i:s');
            $order_month = $date->format('F');
            $order_year = $date->format('Y');
            $productcart->product_quantity = $request->get('product_quantity') ?? '';
            $productcart->order_date = $order_date;
            $productcart->order_time = $order_time;
            $productcart->order_month = $order_month;
            $productcart->order_year = $order_year;
            if ($request->file('cust_image') != '') {
                $file = $request->file('cust_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/products');
                $file->move($path, $filename);
                $productcart->cust_image = $filename;
            } else {
                $productcart->cust_image = "";
            }

            $productcart->rdate = date('Y-m-d');
            $productcart->save();
            if ($productcart) {
                return response()->json([
                    'status' => "1",
                    'data' => $productcart

                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "Someting went wrong"

                ]);
            }
        }
    }
    //buy now
    public function buy_now(Request $request)
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
            $bnow = BuyNow::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();


            $cprds = BuyNow::where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
        } else {
            $bnow = BuyNow::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->delete();


            $cprds = BuyNow::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', $request->user_auto_id)->whereNull('deleted_at')->first();
        }
        if ($cprds) {

            if ($request->input('subscription_type') == 'custom') {
                $inputDays = $request->input('days');
                $inputQuantities = $request->input('product_quantity');
                $days = explode('|', $inputDays);
                $quantities = explode('|', $inputQuantities);
                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');
                foreach (array_combine($days, $quantities) as $day => $quantity) {
                    $cprds->cart_quantity = $request->has('cart_quantity') ? $request->get('cart_quantity') : '';

                    $cprds->product_auto_id = $request->get('product_auto_id');
                    $cprds->admin_auto_id = $request->has('admin_auto_id') ? $request->get('admin_auto_id') : '';
                    $cprds->user_auto_id = $request->get('user_auto_id');
                    $cprds->size = $request->has('size') ? $request->get('size') : '';

                    $cprds->subscription_type = $request->get('subscription_type') ?? '';
                    $cprds->start_date = $request->get('start_date') ?? '';
                    $cprds->product_quantity = $quantity ?? '';
                    $cprds->days = $day ?? '';

                    if ($request->file('cust_image') != '') {
                        $file = $request->file('cust_image');
                        $filename = $file->getClientOriginalName();
                        $path = public_path('images/products');
                        $file->move($path, $filename);
                        $cprds->cust_image = $filename;
                    } else {
                        $cprds->cust_image = '';
                    }
                    $cprds->rdate = date('Y-m-d');
                    $cprds->save();

                    return response()->json([
                        'status' => "1",
                        "msg" => "success",
                        'data' => $cprds

                    ]);
                }
            } else {

                $cprds->cart_quantity = $request->has('cart_quantity') ? $request->get('cart_quantity') : '';
                $cprds->product_auto_id = $request->get('product_auto_id');
                $cprds->admin_auto_id = $request->has('admin_auto_id') ? $request->get('admin_auto_id') : '';
                $cprds->user_auto_id = $request->get('user_auto_id');
                $cprds->size = $request->has('size') ? $request->get('size') : '';
                $cprds->product_quantity = $request->get('product_quantity') ?? '';
                $cprds->subscription_type = $request->get('subscription_type') ?? '';
                $cprds->start_date = $request->get('start_date') ?? '';
                $cprds->days = $request->get('days') ?? '';


                if ($request->file('cust_image') != '') {
                    $file = $request->file('cust_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/products');
                    $file->move($path, $filename);
                    $cprds->cust_image = $filename;
                } else {
                    $cprds->cust_image = '';
                }
                $cprds->rdate = date('Y-m-d');
                $cprds->save();

                return response()->json([
                    'status' => "1",
                    "msg" => "success",
                    'data' => $cprds

                ]);
            }
        } else {
            if ($request->input('subscription_type') == 'custom') {
                $inputDays = $request->input('days');
                $inputQuantities = $request->input('product_quantity');
                // $days = explode('|', $inputDays);
                // $quantities = explode('|', $inputQuantities);
                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');
                $buynow = new BuyNow();
                // $quantity= array_combine($days, $quantities);
                // foreach($quantity as $day => $qnt){
                //     $buynow->$day = $qnt;
                // }

                $buynow->product_auto_id = $request->get('product_auto_id');
                $buynow->admin_auto_id = $request->get('admin_auto_id') ?? "";
                $buynow->user_auto_id = $request->get('user_auto_id');
                $buynow->cart_quantity = $request->get('cart_quantity') ?? "";
                $buynow->size = $request->get('size') ?? "";
                $buynow->quantity = $inputQuantities ?? '';
                $buynow->subscription_type = $request->get('subscription_type') ?? '';
                $buynow->start_date = $request->get('start_date') ?? '';

                $buynow->days = $inputDays ?? '';
                if ($request->get('cust_image') != '') {
                    $file = $request->file('cust_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/products');
                    $file->move($path, $filename);
                    $buynow->cust_image = $filename;
                } else {
                    $buynow->cust_image = "";
                }
                $buynow->rdate = date('Y-m-d');
                $buynow->save();
                return response()->json([
                    'status' => "1",
                    "msg" => "success",
                    'data' => $buynow

                ]);
            } else {
                $buynow = new BuyNow();
                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $rdate =  $date->format('Y-m-d');

                $buynow->product_auto_id = $request->get('product_auto_id');
                $buynow->admin_auto_id = $request->get('admin_auto_id') ?? "";
                $buynow->user_auto_id = $request->get('user_auto_id');
                $buynow->cart_quantity = $request->get('cart_quantity') ?? "";
                $buynow->size = $request->get('size') ?? "";
                $buynow->product_quantity = $request->get('product_quantity') ?? '';
                $buynow->subscription_type = $request->get('subscription_type') ?? '';
                $buynow->start_date = $request->get('start_date') ?? '';

                $buynow->days = $request->get('days') ?? '';
                if ($request->get('cust_image') != '') {
                    $file = $request->file('cust_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/products');
                    $file->move($path, $filename);
                    $buynow->cust_image = $filename;
                } else {
                    $buynow->cust_image = "";
                }
                $buynow->rdate = date('Y-m-d');
                $buynow->save();

                return response()->json([
                    'status' => "1",
                    "msg" => "success",
                    'data' => $buynow

                ]);
            }
        }
    }

    public function delete_buy_now(Request $request)
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
            $bnow = BuyNow::where('_id', '=', $request->get('buynow_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->delete();
        } else {
            $bnow = BuyNow::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('buynow_auto_id'))->where('product_auto_id', '=', $request->get('product_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->delete();
        }
        if ($bnow) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([

                'status' => 0,

                'msg' => "Something went wrong"

            ]);
        }
    }
    //update buynow quantity  product

    public function update_buynow_quantity_product(Request $request)
    {
        $buynowmain = BuyNow::find($request->get('cart_product_auto_id'));
        if (empty($buynowmain)) {
            return response()->json(['status' => "0", "msg" => "No product Found"]);
        } else {


            if ($request->get('cart_quantity') != '') {
                $buynowmain->cart_quantity = $request->get('cart_quantity');
            } else {
                $buynowmain->cart_quantity = "";
            }
            if ($request->get('size') != '') {
                $buynowmain->size = $request->get('size');
            } else {
                $buynowmain->size = "";
            }
            if ($request->get('cust_image') != '') {
                $file = $request->file('cust_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/products');
                $file->move($path, $filename);
                $buynowmain->cust_image = $filename;
            }
            $buynowmain->save();

            return response()->json([
                'status' => "1",
                'msg' => "Sucessfully Updated"


            ]);
        }
    }

    public function get_buy_now(Request $request)
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
            $cprds = BuyNow::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $cprds = BuyNow::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($cprds->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($cprds as $curs) {
                $cust_image = $curs->cust_image;
                $quantity = $curs->product_quantity;
                $subscription_type = $curs->subscription_type;
                $start_date = $curs->start_date;
                $cart_days =  $curs->days;

                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $pcat = AdminProducts::where('_id', '=', $curs->product_auto_id)->orwhere('product_auto_id', '=', $curs->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $pcat = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $curs->product_auto_id)->whereNull('deleted_at')->get();
                }
                if ($pcat->isEmpty()) {

                    $pcats = array();
                } else {
                    foreach ($pcat as $urs) {
                        $product_auto_id = $urs->_id;
                        $product_color_auto_id = $urs->product_auto_id;
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
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {

                            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                            if ($country_user->isNotEmpty()) {
                                foreach ($country_user as $cuid) {
                                    $country_code = $cuid->country_code;
                                }
                            } else {
                                $country_users = EcommRegistration::where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                                if ($country_users->isNotEmpty()) {
                                    foreach ($country_users as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_code = '';
                                }
                            }
                        } else {
                            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                            if ($country_user->isNotEmpty()) {
                                foreach ($country_user as $cuid) {
                                    $country_code = $cuid->country_code;
                                }
                            } else {
                                $country_users = EcommRegistration::where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                                if ($country_users->isNotEmpty()) {
                                    foreach ($country_users as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_code = '';
                                }
                            }
                        }

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
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {

                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
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
                            $product_price = '0';
                            $offer_percentage = '';
                            $size_price = '0';
                            $including_tax = '';
                            $tax_percentage = '';
                            $final_pprices = '';
                            $offer_auto_id = '';
                        }

                        $product_name = $urs->product_name;
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {

                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                        } else {
                            $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
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
                            $product_quantity = $dtls->product_quantity;
                            $weight = $dtls->weight;
                            $isReturn = $dtls->isReturn;
                            $isExchange = $dtls->isExchange;
                            $days = $dtls->days;
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
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->whereNull('deleted_at')->get();
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
                                $offercompprice = '0';
                                $offercompper = '';
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
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->orwhere('product_auto_id', '=', $product_color_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        }
                        if ($pimage_details->isNotEmpty()) {
                            foreach ($pimage_details as $pidata) {
                                $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                            }
                        } else {
                            $image_lists = array();
                        }


                        if ($offercompper != '') {
                            $new_product_price = $cuid->final_price * $curs->cart_quantity;
                            $offer_price = ($new_product_price * $offercompper) / 100;
                            $final_price = $new_product_price - $offer_price;
                        } elseif ($offercompprice != '') {
                            $new_product_price = $cuid->final_price * $curs->cart_quantity;
                            $final_price = $new_product_price - $offercompprice;
                        } else {
                            $new_product_price = $cuid->final_price * $curs->cart_quantity;
                            $offer_price = ($new_product_price * $offer_percentage) / 100;
                            $final_price = $new_product_price - $offer_price;
                        }

                        $pcats[] = array(
                            "cart_product_auto_id" => $curs->_id, "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                            "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                            "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "isReturn" => $isReturn, "isExchange" => $isExchange, "days" => $days, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                            "cart_quantity" => $curs->cart_quantity, "cust_image" => $curs->cust_image, "weight" => $weight, "original_product_price" => $product_price, "product_price" => strval(round($new_product_price)), "product_offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "offer_comp_price_off" => $offercompprice, "offer_comp_percentage" => $offercompper,
                            "tax_percentage" => $tax_percentage, "final_product_price" => strval(round($final_price)), "product_final_price" => strval(round($final_pprices)), "color_image" => $color_image, "color_name" => $color_name, "product_images" => $pimage_details, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists, "subscription_type" => $subscription_type, "start_date" => $start_date, "product_quantity" => $product_quantity, "cart_days" => $cart_days
                        );
                    }

                    $total = $final_price;
                    // get pincode charges
                    $pincode_setting = PincodeDeliverySetting::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($pincode_setting->isNotEmpty()) {
                        foreach ($pincode_setting as $pinset) {
                            $pindsetting = $pinset->delivery_type;
                        }
                    } else {
                        $pindsetting = "";
                    }
                    if ($pindsetting != 'delivery_time') {
                        if ($request->get('pincode') != '') {
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $pincode = Pincode::where('pincode', '=', $request->get('pincode'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $pincode = Pincode::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('pincode', '=', $request->get('pincode'))->whereNull('deleted_at')->get();
                            }
                            if ($pincode->isNotEmpty()) {
                                foreach ($pincode as $pin) {
                                    $delivery_charge = $pin->price;
                                    $pincode = $pin->pincode;
                                }
                            } else {
                                // return response()->json(["status" => 0,"msg"=>"Currently not avaibale on entered pincode..!"]);
                                $delivery_charge = "00";
                                $pincode = $request->get('pincode');
                            }
                        } else {
                            $delivery_charge = "0";
                            $pincode = "";
                        }
                    } else {
                        $delivery_charge = "0";
                        $pincode = "";
                    }

                    // get Express delivery charges
                    if ($request->get('delivery_type') == 'Express') {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $echarges = Currency::where('country_code', '=', $country_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $echarges = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
                        }
                        if ($echarges->isNotEmpty()) {
                            foreach ($echarges as $echarge) {
                                $express_delivery_charge = $echarge->express_delivery_charges;
                            }
                        } else {
                            $express_delivery_charge = "0";
                        }
                    } else {
                        $express_delivery_charge = "0";
                    }

                    // apply promocode
                    if ($request->coupon_code != '') {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $get_promocode = CouponCode::Where('coupen_code', $request->coupon_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $get_promocode = CouponCode::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('coupen_code', $request->coupon_code)->whereNull('deleted_at')->get();
                        }

                        if ($get_promocode->isNotEmpty()) {

                            foreach ($get_promocode as $data_promocode) {
                                $pcode = $data_promocode->coupen_code;
                                $pdiscount = $data_promocode->coupen_code_value;
                                $ptype = $data_promocode->type;
                            }
                            if ($ptype == 'percentage_off') {
                                $promocode_discount_amount = ((strval($total) * $pdiscount) / 100);
                            } else {
                                $promocode_discount_amount = $pdiscount;
                            }
                        } else {
                            $pdiscount = "00";
                            $pcode = "";
                            $ptype = "";
                            $promocode_discount_amount = "00";
                        }
                    } else {
                        $pdiscount = "0";
                        $pcode = "";
                        $ptype = "";
                        $promocode_discount_amount = "0";
                    }
                    $payprice = ((strval($total) - $promocode_discount_amount) + $delivery_charge + $express_delivery_charge);
                }
            }
            return response()->json([
                'status' => 1,
                'applied_promocode' => $pcode,
                'promocode_value_off' => $pdiscount,
                'promocode_type' => $ptype,
                'promocode_value_off_on_order' => strval($promocode_discount_amount),
                'used_pincode' => $pincode,
                'pincode_delivery_charge' => $delivery_charge,
                'express_delivery_charge' => $express_delivery_charge,
                'total_price' => strval(round($total)),
                'total_paid_price' => strval(round($payprice)),
                'get_admin_cart_product_lists' => $pcats,
            ]);
        }
    }
    //update cart product

    public function edit_cart_product(Request $request)
    {
        $cmain = CartProducts::find($request->get('cart_product_auto_id'));
        if (empty($cmain)) {
            return response()->json(['status' => "0", "msg" => "No product Found"]);
        } else {


            if ($request->get('cart_quantity') != '') {
                $cmain->cart_quantity = $request->get('cart_quantity');
            } else {
                $cmain->cart_quantity = "";
            }
            if ($request->get('size') != '') {
                $cmain->size = $request->get('size');
            } else {
                $cmain->size = "";
            }
            // if($request->get('size_price')!='')
            // {
            //             $cmain->size_price = $request->get('size_price');
            // }else
            // {
            //     $cmain->size_price ="";
            // }

            $cmain->save();

            return response()->json([
                'status' => "1",
                'msg' => "Sucessfully Updated"


            ]);
        }
    }
    //Delete cart product
    public function delete_from_cart(Request $request)
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
            $idetails = CartProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('product_auto_id', '=', $request->get('product_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
        } else {
            $idetails = CartProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->where('product_auto_id', '=', $request->get('product_auto_id'))->delete();
        }
        if ($idetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([
                'status' => 0,
                'msg' => "Product not found"
            ]);
        }
    }
    //cart added products
    public function get_cart_list(Request $request)
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
            $cprds = CartProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $cprds = CartProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($cprds->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($cprds as $curs) {
                $cust_image = $curs->cust_image;
                $cust_subscription_type = $curs->subscription_type;
                $cust_start_date = $curs->start_date;
                $cust_quantity = $curs->product_quantity;
                $cust_days = $curs->days;


                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $pcat = AdminProducts::where('_id', '=', $curs->product_auto_id)->orwhere('product_auto_id', '=', $curs->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $pcat = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $curs->product_auto_id)->orwhere('product_auto_id', '=', $curs->product_auto_id)->whereNull('deleted_at')->get();
                }
                if ($pcat->isEmpty()) {

                    $pcats = array();
                } else {
                    foreach ($pcat as $urs) {
                        $product_auto_id = $urs->_id;
                        $product_color_auto_id = $urs->product_auto_id;
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

                            $country_user = UserRegister::where('_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($country_user->isNotEmpty()) {
                                foreach ($country_user as $cuid) {
                                    $country_code = $cuid->country_code;
                                }
                            } else {
                                $country_users = EcommRegistration::where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                                if ($country_users->isNotEmpty()) {
                                    foreach ($country_users as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_code = '';
                                }
                            }
                        } else {
                            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                            if ($country_user->isNotEmpty()) {
                                foreach ($country_user as $cuid) {
                                    $country_code = $cuid->country_code;
                                }
                            } else {
                                $country_users = EcommRegistration::where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
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
                                $express_delivery_charges = $cuid->express_delivery_charges;
                            }
                        } else {
                            $country_code_id = '';
                            $currency = '';
                            $express_delivery_charges = '0';
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

                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
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
                            $product_price = '0';
                            $offer_percentage = '';
                            $size_price = '0';
                            $including_tax = '';
                            $tax_percentage = '';
                            $final_pprices = '0';
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

                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                        } else {
                            $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
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
                            $isReturn = $dtls->isReturn;
                            $isExchange = $dtls->isExchange;
                            $days = $dtls->days;
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
                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->whereNull('deleted_at')->get();
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
                                $offercompprice = '0';
                                $offercompper = '';
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
                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->orwhere('product_auto_id', '=', $product_color_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->orwhere('product_auto_id', '=', $product_color_auto_id)->whereNull('deleted_at')->get();
                        }
                        if ($pimage_details->isNotEmpty()) {
                            foreach ($pimage_details as $pidata) {
                                $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                            }
                        } else {
                            $image_lists = array();
                        }

                        if ($offercompper != '') {
                            $new_product_price = $cuid->final_price * $curs->cart_quantity;
                            $offer_price = ($new_product_price * $offercompper) / 100;
                            $final_price = $new_product_price - $offer_price;
                        } elseif ($offercompprice != '') {
                            $new_product_price = $cuid->final_price * $curs->cart_quantity;
                            $final_price = $new_product_price - $offercompprice;
                        } else {
                            $new_product_price = $cuid->final_price * $curs->cart_quantity;
                            $offer_price = ($new_product_price * $offer_percentage) / 100;
                            $final_price = $new_product_price - $offer_price;
                        }

                        $pcats[] = array(
                            "cart_product_auto_id" => $curs->_id, "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                            "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id, "veg_nonveg" => $veg_nonveg, "egg_eggless" => $egg_eggless, "Customizable" => $Customizable,
                            "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "isReturn" => $isReturn, "isExchange" => $isExchange, "days" => $days, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                            "cart_quantity" => $curs->cart_quantity, "cust_image" => $curs->cust_image, "weight" => $weight, "original_product_price" => $product_price, "product_price" => strval(round($new_product_price)), "product_offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "offer_comp_price_off" => $offercompprice, "offer_comp_percentage" => $offercompper,
                            "tax_percentage" => $tax_percentage, "final_product_price" => strval(round($final_price)), "product_final_price" => strval(round($final_pprices)), "color_image" => $color_image, "color_name" => $color_name, "product_images" => $pimage_details, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists, "days" => $cust_days, "quantity" => $cust_quantity, "start_date" => $cust_start_date, "subscription_type" => $cust_subscription_type
                        );
                    }

                    $total = 0;
                    foreach ($pcats as $val) {
                        $total += $val['final_product_price'];
                    }
                    // get pincode charges
                    $pincode_setting = PincodeDeliverySetting::where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                    if ($pincode_setting->isNotEmpty()) {
                        foreach ($pincode_setting as $pinset) {
                            $pindsetting = $pinset->delivery_type;
                        }
                    } else {
                        $pindsetting = "";
                    }
                    if ($pindsetting != 'delivery_time') {
                        if ($request->get('pincode') != '') {
                            $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($esatatus->isNotEmpty()) {
                                foreach ($esatatus as $erase) {
                                    $erase_data_status = $erase->erase_data_status;
                                }
                            } else {
                                $erase_data_status = 'No';
                            }
                            if ($erase_data_status == 'Yes') {
                                $pincode = Pincode::where('pincode', '=', $request->get('pincode'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $pincode = Pincode::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('pincode', '=', $request->get('pincode'))->whereNull('deleted_at')->get();
                            }
                            if ($pincode->isNotEmpty()) {
                                foreach ($pincode as $pin) {
                                    $delivery_charge = $pin->price;
                                    $pincode = $pin->pincode;
                                }
                            } else {
                                // return response()->json(["status" => 0,"msg"=>"Currently not avaibale on entered pincode..!"]);
                                $delivery_charge = "00";
                                $pincode = $request->get('pincode');
                            }
                        } else {
                            $delivery_charge = "0";
                            $pincode = "";
                        }
                    } else {
                        $delivery_charge = "0";
                        $pincode = "";
                    }

                    // get Express delivery charges
                    if ($request->get('delivery_type') == 'Express') {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $echarges = Currency::where('country_code', '=', $country_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $echarges = Currency::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
                        }
                        if ($echarges->isNotEmpty()) {
                            foreach ($echarges as $echarge) {
                                $express_delivery_charge = $echarge->express_delivery_charges;
                            }
                        } else {
                            $express_delivery_charge = "0";
                        }
                    } else {
                        $express_delivery_charge = "0";
                    }

                    // apply promocode
                    if ($request->coupon_code != '') {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $get_promocode = CouponCode::Where('coupen_code', $request->coupon_code)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $get_promocode = CouponCode::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('coupen_code', $request->coupon_code)->whereNull('deleted_at')->get();
                        }
                        if ($get_promocode->isNotEmpty()) {

                            foreach ($get_promocode as $data_promocode) {
                                $pcode = $data_promocode->coupen_code;
                                $pdiscount = $data_promocode->coupen_code_value;
                                $ptype = $data_promocode->type;
                            }
                            if ($ptype == 'percentage_off') {
                                $promocode_discount_amount = ((strval($total) * $pdiscount) / 100);
                            } else {
                                $promocode_discount_amount = $pdiscount;
                            }
                        } else {
                            //  return response()->json(["status" => 0,"msg"=>"Invalid Promocode"]);
                            $pdiscount = "00";
                            $pcode = "";
                            $ptype = "";
                            $promocode_discount_amount = "00";
                        }
                    } else {
                        $pdiscount = "0";
                        $pcode = "";
                        $ptype = "";
                        $promocode_discount_amount = "0";
                    }
                    $payprice = ((strval($total) - $promocode_discount_amount) + $delivery_charge + $express_delivery_charge);
                }
            }
            return response()->json([
                'status' => 1,
                'applied_promocode' => $pcode,
                'promocode_value_off' => $pdiscount,
                'promocode_type' => $ptype,
                'promocode_value_off_on_order' => strval($promocode_discount_amount),
                'used_pincode' => $pincode,
                'pincode_delivery_charge' => $delivery_charge,
                'express_delivery_charge' => $express_delivery_charge,
                'total_price' => strval(round($total)),
                'total_paid_price' => strval(round($payprice)),
                'get_admin_cart_product_lists' => $pcats,
            ]);
        }
    }

    //cart added products
    public function get_cart_product_count(Request $request)
    {
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        $tcp = 0;
        if ($erase_data_status == 'Yes') {
            $cprds = CartProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $cprds = CartProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($cprds->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($cprds as $curs) {

                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $count_cart_products = CartProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                } else {
                    $count_cart_products = CartProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->count();
                }

                $total_cart_price = CountryProductPrice::where('product_auto_id', '=', $curs->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($total_cart_price->isNotEmpty()) {
                    foreach ($total_cart_price as $erase) {
                        $currency_auto_id = $erase->currency_auto_id;
                        $tcp += ($curs->cart_quantity * $erase->final_price);
                    }
                } else {
                    $tcp = 0;
                }
                $pcats[] = array("cart_product_auto_id" => $curs->_id, "product_auto_id" => $curs->product_auto_id, "cart_quantity" => $curs->cart_quantity);

                $currencies = Currency::where('_id', '=', $currency_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($currencies->isNotEmpty()) {
                    foreach ($currencies as $crn) {
                        $currency = $crn->currency;
                    }
                } else {
                    $currency = '';
                }
            }

            return response()->json([
                'status' => 1,
                'product_count_data' => $count_cart_products,
                'currency' => $currency,
                'total_cart_price' => $tcp,
                'get_admin_cart_product_lists' => $pcats,
            ]);
        }
    }
    //product wishlist
    public function add_to_wishlist(Request $request)
    {


        $productcart = new WishlistProducts();
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $checkproduct = WishlistProducts::where('product_auto_id', $request->product_auto_id)->where('user_auto_id', $request->user_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
        } else {
            $checkproduct = WishlistProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', $request->product_auto_id)->where('user_auto_id', $request->user_auto_id)->whereNull('deleted_at')->first();
        }
        if ($checkproduct) {
            return response()->json([
                'status' => '0',
                'msg' => 'Product already added in wishlist',
            ]);
        } else {
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            if ($request->get('admin_auto_id') != '') {
                $productcart->admin_auto_id = $request->get('admin_auto_id');
            } else {
                $productcart->admin_auto_id = "";
            }
            $productcart->product_auto_id = $request->get('product_auto_id');
            $productcart->user_auto_id = $request->get('user_auto_id');


            $productcart->rdate = date('Y-m-d');

            $productcart->save();
            if ($productcart) {
                return response()->json([
                    'status' => "1",
                    'data' => $productcart

                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "Someting went wrong"

                ]);
            }
        }
    }
    //Delete wishlist product
    public function delete_wishlist_item(Request $request)
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
            $idetails = WishlistProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('product_auto_id', '=', $request->get('product_auto_id'))->delete();
        } else {
            $idetails = WishlistProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->where('product_auto_id', '=', $request->get('product_auto_id'))->delete();
        }
        if ($idetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([
                'status' => 0,
                'msg' => "Wishlist Product not found"
            ]);
        }
    }
    //cart added products
    public function get_wishlist(Request $request)
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
            $cprds = WishlistProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $cprds = WishlistProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($cprds->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($cprds as $curs) {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $pcat = AdminProducts::where('_id', '=', $curs->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $pcat = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $curs->product_auto_id)->whereNull('deleted_at')->get();
                }
                if ($pcat->isEmpty()) {

                    $pcats = array();
                } else {
                    foreach ($pcat as $urs) {
                        $product_auto_id = $urs->_id;
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

                            $country_user = UserRegister::where('_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            if ($country_user->isNotEmpty()) {
                                foreach ($country_user as $cuid) {
                                    $country_code = $cuid->country_code;
                                }
                            } else {
                                $country_users = EcommRegistration::where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                                if ($country_users->isNotEmpty()) {
                                    foreach ($country_users as $cuid) {
                                        $country_code = $cuid->country_code;
                                    }
                                } else {
                                    $country_code = '';
                                }
                            }
                        } else {
                            $country_user = UserRegister::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
                            if ($country_user->isNotEmpty()) {
                                foreach ($country_user as $cuid) {
                                    $country_code = $cuid->country_code;
                                }
                            } else {
                                $country_users = EcommRegistration::where('_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
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

                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $currency_price_details = CountryProductPrice::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('currency_auto_id', '=', $country_code_id)->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
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

                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('admin_auto_id', $request->admin_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                        } else {
                            $get_details = AdminProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
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
                            $isReturn = $dtls->isReturn;
                            $isExchange = $dtls->isExchange;
                            $days = $dtls->days;
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

                                $offerlist = OfferComponent::where('_id', '=', $offer)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            } else {
                                $offerlist = OfferComponent::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('_id', '=', $offer)->whereNull('deleted_at')->get();
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

                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pimage_details = AdminProductImages::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('product_auto_id', '=', $product_auto_id)->whereNull('deleted_at')->get();
                        }
                        if ($pimage_details->isNotEmpty()) {
                            foreach ($pimage_details as $pidata) {
                                $image_lists[] = array("image_auto_id" => $pidata->_id, "product_image" => $pidata->image_file);
                            }
                        } else {
                            $image_lists = array();
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
                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->count();
                        } else {
                            $courseRatingReview = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->Where('product_auto_id', $product_auto_id)->count();
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
                            "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt, "isReturn" => $isReturn, "isExchange" => $isExchange, "days" => $days, "time" => $time, "time_unit" => $time_unit, "use_by" => $use_by, "closure_type" => $closure_type, "fabric" => $fabric, "sole" => $sole, "currency" => $currency,
                            "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                            "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists, "size" => $get_slists, "offer_data" => $get_olists, "get_price_lists" => $get_plists
                        );
                    }
                }
            }
            return response()->json([
                'status' => 1,
                'get_admin_wishlist_product_lists' => $pcats,
            ]);
        }
    }
    //cart added products
    public function get_wishlist_product_count(Request $request)
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
            $cprds = WishlistProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $cprds = WishlistProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($cprds->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {
            foreach ($cprds as $curs) {
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $count_cart_products = WishlistProducts::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->count();
                } else {
                    $count_cart_products = WishlistProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->count();
                }

                $pcats[] = array("product_auto_id" => $curs->product_auto_id);
            }
            return response()->json([
                'status' => 1,
                'product_count_data' => $count_cart_products,
                'get_admin_wishlist_product_lists' => $pcats,
            ]);
        }
    }
    //product cart
    public function add_user_address(Request $request)
    {


        $addresscart = new CartUserAddress();

        //       $acheckproduct = CartUserAddress::where('user_auto_id', $request->user_auto_id)->whereNull('deleted_at')->first();
        //              if ($acheckproduct) {
        //             return response()->json([
        //                 'status' => '0',
        //                 'msg' => 'Address already added in cart',
        //             ]);

        //      }  else {
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $rdate =  $date->format('Y-m-d');

        if ($request->get('admin_auto_id') != '') {
            $addresscart->admin_auto_id = $request->get('admin_auto_id');
        } else {
            $addresscart->admin_auto_id = "";
        }
        $addresscart->user_auto_id = $request->get('user_auto_id');
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
        if ($addresscart) {
            return response()->json([
                'status' => "1",
                'data' => $addresscart

            ]);
        } else {
            return response()->json([
                'status' => "0",
                'data' => "Someting went wrong"

            ]);
        }

        //      }

    }
    //get address details
    public function get_user_address(Request $request)
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
            $adetls = CartUserAddress::where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $adetls = CartUserAddress::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('user_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($adetls->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {

            return response()->json([
                'status' => 1,
                'user_address_details' => $adetls,
            ]);
        }
    }
    //update cart user address

    public function edit_user_address(Request $request)
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
            $cuamain = CartUserAddress::where('_id', '=', $request->get('address_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
        } else {
            $cuamain = CartUserAddress::where('_id', '=', $request->get('address_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->first();
        }
        if (empty($cuamain)) {
            return response()->json(['status' => "0", "msg" => "No address Found"]);
        } else {


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
            if ($cuamain) {
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
    //Delete user address
    public function delete_user_address(Request $request)
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
            $cuadetails = CartUserAddress::where('_id', '=', $request->get('address_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
        } else {
            $cuadetails = CartUserAddress::where('_id', '=', $request->get('address_auto_id'))->where('user_auto_id', '=', $request->get('user_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
        }
        if ($cuadetails) {
            return response()->json([
                'status' => 1,
                'msg' => "Sucessfully Deleted"
            ]);
        } else {

            return response()->json([

                'status' => 0,

                'msg' => "address not found"

            ]);
        }
    }

    public function editPlaceOrder(Request $request)
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $order_date = $date->format('Y-m-d');
        $order_time = $date->format('H:i:s');
        $order_month = $date->format('F');
        $order_year = $date->format('Y');
        $order_id = Orders::get();
        if ($order_id->isNotEmpty()) {
            foreach ($order_id as $data) {
                $oid = $data->order_id;
            }
            if ($oid != '') {
                $str = explode("ORD", $oid, 3);
                $second = $str[1];
                $naid = $second + 1;
                $len = strlen($naid);
                if ($len > 1) {
                    $new_oid = "ORD" . $naid;
                } else {
                    $new_oid = "ORD0" . $naid;
                }
            }
        } else {
            $new_oid = "ORD01";
        }
        $placeorder = Orders::where('_id', '=', $request->order_auto_id)->whereNull('deleted_at')->first();
        if ($placeorder) {
            // Order exists, update it
            $placeorder->customer_auto_id = $request->get('customer_auto_id') ?? '';
            $placeorder->order_id = $request->get('order_id') ?? '';
            $placeorder->added_by_id  = $request->get('added_by_id') ?? '';
            $placeorder->admin_auto_id  = $request->get('admin_auto_id') ?? '';
            $placeorder->added_by = $request->get('added_by') ?? '';
            $placeorder->product_auto_id = $request->get('product_auto_id') ?? '';
            $placeorder->product_name = $request->get('product_name') ?? '';
            $placeorder->quantity = $request->get('quantity');
            $placeorder->product_price = $request->get('product_price') ?? '';
            $placeorder->product_offer_percentage = $request->get('product_offer_percentage') ?? '';
            $placeorder->product_final_price = $request->get('product_final_price') ?? '';
            $placeorder->product_image = $request->get('product_image') ?? '';
            $placeorder->size = $request->get('size') ?? '';
            $placeorder->address = $request->get('address') ?? '';
            $placeorder->state = $request->get('state') ?? '';
            $placeorder->country = $request->get('country') ?? '';
            $placeorder->state = $request->get('state') ?? '';
            $placeorder->city = $request->get('city') ?? '';
            $placeorder->mobile_no = $request->get('mobile_no') ?? '';
            $placeorder->transaction_id = $request->get('transaction_id') ?? '';
            $placeorder->payment_status = $request->get('payment_status') ?? '';
            $placeorder->applied_promocode = $request->get('applied_promocode') ?? '';
            $placeorder->promocode_value_off = $request->get('promocode_value_off') ?? '';
            $placeorder->promocode_type = $request->get('promocode_type') ?? '';
            $placeorder->promocode_value_off_on_order = $request->get('promocode_value_off_on_order') ?? '';
            $placeorder->used_pincode = $request->get('used_pincode') ?? '';
            $placeorder->pincode_delivery_charge = $request->get('pincode_delivery_charge') ?? '';
            $placeorder->delivery_time = $request->get('delivery_time') ?? '';
            $placeorder->delivery_slot_price = $request->get('delivery_slot_price') ?? '';
            $placeorder->delivery_type = $request->get('delivery_type') ?? '';
            $placeorder->start_date = $request->get('start_date')  ?? '';
            $placeorder->app_type_id = $request->get('app_type_id') ?? '';
            $placeorder->total_price = $request->get('total_price') ?? '';
            $placeorder->total_paid_price = $request->get('total_paid_price') ?? '';
            $placeorder->cutbalance = $request->get('cutbalance') ?? '';
            $placeorder->deliveryboy_id = '';
            $placeorder->order_date = $order_date;
            $placeorder->order_time = $order_time;
            $placeorder->order_month = $order_month;
            $placeorder->order_year = $order_year;
            $placeorder->save();
            $added_by_id  = $request->get('added_by_id');
            $customer_auto_id  = $request->get('customer_auto_id');
            $admin_auto_id  = $request->get('admin_auto_id');
            $added_by = $request->get('added_by');
            $product_auto_id = $request->get('product_auto_id');
            $quantity = $request->get('quantity');
            $product_price = $request->get('product_price');
            $product_offer_percentage = $request->get('product_offer_percentage');
            $product_final_price = $request->get('product_final_price');
            $product_image = $request->get('product_image');
            if ($request->get('size') != '') {
                $size = $request->get('size');
            } else {
                $size = '';
            }
            $input = $request->all();
            $abiids = array();
            $abids = array();
            $paiids = array();
            $qids = array();
            $ppids = array();
            $popids = array();
            $pfpids = array();
            $piids = array();
            $sids = array();
            $abi_ids = explode('|', $added_by_id);
            $ab_ids = explode('|', $added_by);
            $pai_ids = explode('|', $product_auto_id);
            $q_ids = explode('|', $quantity);
            $pp_ids = explode('|', $product_price);
            $pop_ids = explode('|', $product_offer_percentage);
            $pfp_ids = explode('|', $product_final_price);
            $pi_ids = explode('|', $product_image);
            $s_ids = explode('|', $size);
            foreach ($abi_ids as $data1) {
                $abiids[] = $data1;
            }
            foreach ($ab_ids as $data2) {
                $abids[] = $data2;
            }
            foreach ($pai_ids as $data3) {
                $paiids[] = $data3;
            }
            foreach ($q_ids as $data4) {
                $qids[] = $data4;
            }
            foreach ($pp_ids as $data5) {
                $ppids[] = $data5;
            }
            foreach ($pop_ids as $data6) {
                $popids[] = $data6;
            }
            foreach ($pfp_ids as $data7) {
                $pfpids[] = $data7;
            }
            foreach ($pi_ids as $data8) {
                $piids[] = $data8;
            }
            foreach ($s_ids as $data9) {
                $sids[] = $data9;
            }

            $aArray = $abiids;
            $first_list = count($aArray);
            $bArray = $abids;
            $second_list = count($bArray);
            $cArray = $paiids;
            $third_list = count($cArray);
            $dArray = $qids;
            $fourth_list = count($dArray);
            $eArray = $ppids;
            $fifth_list = count($eArray);
            $fArray = $popids;
            $sixth_list = count($fArray);
            $gArray = $pfpids;
            $seven_list = count($gArray);
            $hArray = $piids;
            $eight_list = count($hArray);
            $iArray = $sids;
            $ninth_list = count($iArray);

            for ($i = 0; $i < $first_list; $i++) {
                $placeorders = VendorOrders::where('product_auto_id', '=', $cArray[$i])->where('order_id', '=', $request->order_id)->whereNull('deleted_at')->first();
                if ($placeorders) {
                    $placeorders->quantity  = $dArray[$i];
                    $placeorders->product_price = $eArray[$i];
                    $placeorders->product_offer_percentage  = $fArray[$i];
                    $placeorders->product_final_price = $gArray[$i];
                    $placeorders->product_image  = $hArray[$i];
                    $placeorders->size  = $iArray[$i];
                    $placeorders->save();
                }
            }

            return response()->json(['Status' => 1, 'message' => 'Order updated successfully', 'order' => $placeorder]);
        } else {
            return response()->json(['Status' => 0, 'message' => 'Order Not Found', 'order' => Null]);
        }
    }
    // place order
    public function place_order(Request $request)
    {
        // Get order id
        $order_id = Orders::get();
        if ($order_id->isNotEmpty()) {
            foreach ($order_id as $data) {
                $oid = $data->order_id;
            }
            if ($oid != '') {
                $str = explode("ORD", $oid, 3);
                $second = $str[1];
                $naid = $second + 1;
                $len = strlen($naid);
                if ($len > 1) {
                    $new_oid = "ORD" . $naid;
                } else {
                    $new_oid = "ORD0" . $naid;
                }
            }
        } else {
            $new_oid = "ORD01";
        }


        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $order_date = $date->format('Y-m-d');
        $order_time = $date->format('H:i:s');
        $order_month = $date->format('F');
        $order_year = $date->format('Y');
        if ($request->input('subscription_type') == 'custom') {
            $inputDays  = $request->input('days');
            $inputQuantities  = $request->input('product_quantity');
            $days = explode('|', $inputDays);
            $quantities = explode('|', $inputQuantities);

            foreach (array_combine($days, $quantities) as $day => $quantity) {
                $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                $order_date = $date->format('Y-m-d');
                $order_time = $date->format('H:i:s');
                $order_month = $date->format('F');
                $order_year = $date->format('Y');
                $uorders = new Orders();
                $uorders->admin_auto_id = $request->get('admin_auto_id') ?? '';
                $uorders->customer_auto_id = $request->get('customer_auto_id') ?? '';
                $uorders->order_id = $new_oid  ?? '';
                $uorders->added_by_id  = $request->get('added_by_id') ?? '';
                $uorders->added_by = $request->get('added_by') ?? '';
                $uorders->product_auto_id = $request->get('product_auto_id') ?? '';
                $uorders->product_name = $request->get('product_name') ?? '';
                $uorders->quantity = $request->get('quantity') ?? '';
                $uorders->product_price = $request->get('product_price') ?? '';
                $uorders->product_offer_percentage = $request->get('product_offer_percentage') ?? '';
                $uorders->product_final_price = $request->get('product_final_price') ?? '';
                $uorders->product_image = $request->get('product_image') ?? '';
                $uorders->size = $request->get('size') ?? '';
                $uorders->address = $request->get('address') ?? '';
                $uorders->state = $request->get('state') ?? '';
                $uorders->country = $request->get('country') ?? '';
                $uorders->state = $request->get('state') ?? '';
                $uorders->city = $request->get('city') ?? '';
                $uorders->mobile_no = $request->get('mobile_no') ?? '';
                $uorders->transaction_id = $request->get('transaction_id') ?? '';
                $uorders->payment_status = $request->get('payment_status') ?? '';
                $uorders->applied_promocode = $request->get('applied_promocode') ?? '';
                $uorders->promocode_value_off = $request->get('promocode_value_off') ?? '';
                $uorders->promocode_type = $request->get('promocode_type') ?? '';
                $uorders->promocode_value_off_on_order = $request->get('promocode_value_off_on_order') ?? '';
                $uorders->used_pincode = $request->get('used_pincode') ?? '';
                $uorders->pincode_delivery_charge = $request->get('pincode_delivery_charge') ?? '';
                $uorders->delivery_time = $request->get('delivery_time') ?? '';
                $uorders->delivery_slot_price = $request->get('delivery_slot_price') ?? '';
                $uorders->delivery_type = $request->get('delivery_type') ?? '';
                $uorders->start_date = $request->get('start_date')  ?? '';
                $uorders->app_type_id = $request->get('app_type_id') ?? '';
                $uorders->days_count = $request->get('days_count') ?? '';
                $uorders->product_quantity = $request->get('product_quantity') ?? '';
                $uorders->days = $request->get('days') ?? '';
                $uorders->total_price = $request->get('total_price') ?? '';
                $uorders->total_paid_price = $request->get('total_paid_price') ?? '';
                $uorders->cutbalance = $request->get('cutbalance') ?? '';
                $uorders->subscription_type = $request->get('subscription_type') ?? '';
                $uorders->status = "Received";
                $uorders->deliveryboy_id = '';
                $uorders->order_date = $order_date;
                $uorders->order_time = $order_time;
                $uorders->order_month = $order_month;
                $uorders->order_year = $order_year;
                $uorders->product_quantity = $quantity;
                $uorders->days = $day;

                if (!empty($request->file('cust_image'))) {
                    $file = $request->file('cust_image');
                    $filename = $file->getClientOriginalName();
                    $path = public_path('images/products');
                    $file->move($path, $filename);
                    $uorders->cust_image = $filename;
                } else {
                    $uorders->cust_image = '';
                }

                $uorders->payment_mode = $request->get('payment_mode') ?? '';

                $uorders->save();
            }
        } else {
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $order_date = $date->format('Y-m-d');
            $order_time = $date->format('H:i:s');
            $order_month = $date->format('F');
            $order_year = $date->format('Y');
            $uorders = new Orders();
            $uorders->admin_auto_id = $request->get('admin_auto_id') ?? '';
            $uorders->customer_auto_id = $request->get('customer_auto_id') ?? '';
            $uorders->order_id = $new_oid  ?? '';
            $uorders->added_by_id  = $request->get('added_by_id') ?? '';
            $uorders->added_by = $request->get('added_by') ?? '';
            $uorders->product_auto_id = $request->get('product_auto_id') ?? '';
            $uorders->product_name = $request->get('product_name') ?? '';
            $uorders->quantity = $request->get('quantity') ?? '';
            $uorders->product_price = $request->get('product_price') ?? '';
            $uorders->product_offer_percentage = $request->get('product_offer_percentage') ?? '';
            $uorders->product_final_price = $request->get('product_final_price') ?? '';
            $uorders->product_image = $request->get('product_image') ?? '';
            $uorders->size = $request->get('size') ?? '';
            $uorders->address = $request->get('address') ?? '';
            $uorders->state = $request->get('state') ?? '';
            $uorders->country = $request->get('country') ?? '';
            $uorders->state = $request->get('state') ?? '';
            $uorders->city = $request->get('city') ?? '';
            $uorders->mobile_no = $request->get('mobile_no') ?? '';
            $uorders->transaction_id = $request->get('transaction_id') ?? '';
            $uorders->payment_status = $request->get('payment_status') ?? '';
            $uorders->applied_promocode = $request->get('applied_promocode') ?? '';
            $uorders->promocode_value_off = $request->get('promocode_value_off') ?? '';
            $uorders->promocode_type = $request->get('promocode_type') ?? '';
            $uorders->promocode_value_off_on_order = $request->get('promocode_value_off_on_order') ?? '';
            $uorders->used_pincode = $request->get('used_pincode') ?? '';
            $uorders->pincode_delivery_charge = $request->get('pincode_delivery_charge') ?? '';
            $uorders->delivery_time = $request->get('delivery_time') ?? '';
            $uorders->delivery_slot_price = $request->get('delivery_slot_price') ?? '';
            $uorders->delivery_type = $request->get('delivery_type') ?? '';
            $uorders->start_date = $request->get('start_date')  ?? '';
            $uorders->app_type_id = $request->get('app_type_id') ?? '';
            $uorders->days_count = $request->get('days_count') ?? '';
            $uorders->product_quantity = $request->get('product_quantity') ?? '';
            $uorders->days = $request->get('days') ?? '';
            $uorders->total_price = $request->get('total_price') ?? '';
            $uorders->total_paid_price = $request->get('total_paid_price') ?? '';
            $uorders->cutbalance = $request->get('cutbalance') ?? '';
            $uorders->status = "Received";
            $uorders->subscription_type = $request->get('subscription_type') ?? '';
            $uorders->deliveryboy_id = '';
            $uorders->order_date = $order_date;
            $uorders->order_time = $order_time;
            $uorders->order_month = $order_month;
            $uorders->order_year = $order_year;
            $product_final_price = $request->get('product_final_price');

            if (!empty($request->file('cust_image'))) {
                $file = $request->file('cust_image');
                $filename = $file->getClientOriginalName();
                $path = public_path('images/products');
                $file->move($path, $filename);
                $uorders->cust_image = $filename;
            } else {
                $uorders->cust_image = '';
            }
            $uorders->payment_mode = $request->get('payment_mode') ?? '';

            $uorders->save();
        }

        //delete cart products
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $cuadetails = CartProducts::where('user_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->delete();
        } else {
            $cuadetails = CartProducts::where('admin_auto_id', $request->admin_auto_id)->orWhere('admin_auto_id', "6306fc8918573a0e5ba5a218")->where('user_auto_id', '=', $request->get('customer_auto_id'))->delete();
        }
        $added_by_id  = $request->get('added_by_id');
        $customer_auto_id  = $request->get('customer_auto_id');
        $admin_auto_id  = $request->get('admin_auto_id');
        $added_by = $request->get('added_by');
        $product_auto_id = $request->get('product_auto_id');
        $quantity = $request->get('quantity');
        $product_price = $request->get('product_price');
        $product_offer_percentage = $request->get('product_offer_percentage');
        $product_final_price = $request->get('product_final_price');
        $product_image = $request->get('product_image');
        if ($request->get('size') != '') {
            $size = $request->get('size');
        } else {
            $size = '';
        }
        $input = $request->all();
        $abiids = array();
        $abids = array();
        $paiids = array();
        $qids = array();
        $ppids = array();
        $popids = array();
        $pfpids = array();
        $piids = array();
        $sids = array();
        $abi_ids = explode('|', $added_by_id);
        $ab_ids = explode('|', $added_by);
        $pai_ids = explode('|', $product_auto_id);
        $q_ids = explode('|', $quantity);
        $pp_ids = explode('|', $product_price);
        $pop_ids = explode('|', $product_offer_percentage);
        $pfp_ids = explode('|', $product_final_price);
        $pi_ids = explode('|', $product_image);
        $s_ids = explode('|', $size);
        foreach ($abi_ids as $data1) {
            $abiids[] = $data1;
        }
        foreach ($ab_ids as $data2) {
            $abids[] = $data2;
        }
        foreach ($pai_ids as $data3) {
            $paiids[] = $data3;
        }
        foreach ($q_ids as $data4) {
            $qids[] = $data4;
        }
        foreach ($pp_ids as $data5) {
            $ppids[] = $data5;
        }
        foreach ($pop_ids as $data6) {
            $popids[] = $data6;
        }
        foreach ($pfp_ids as $data7) {
            $pfpids[] = $data7;
        }
        foreach ($pi_ids as $data8) {
            $piids[] = $data8;
        }
        foreach ($s_ids as $data9) {
            $sids[] = $data9;
        }

        $aArray = $abiids;
        $first_list = count($aArray);
        $bArray = $abids;
        $second_list = count($bArray);
        $cArray = $paiids;
        $third_list = count($cArray);
        $dArray = $qids;
        $fourth_list = count($dArray);
        $eArray = $ppids;
        $fifth_list = count($eArray);
        $fArray = $popids;
        $sixth_list = count($fArray);
        $gArray = $pfpids;
        $seven_list = count($gArray);
        $hArray = $piids;
        $eight_list = count($hArray);
        $iArray = $sids;
        $ninth_list = count($iArray);

        for ($i = 0; $i < $first_list; $i++) {

            $tlist = new VendorOrders();
            if ($admin_auto_id != '') {
                $tlist->admin_auto_id = $admin_auto_id;
            } else {
                $tlist->admin_auto_id = "";
            }
            $tlist->order_id = $new_oid;
            $data = $aArray[$i];
            $tlist->added_by_id = $data;
            $tlist->added_by  = $bArray[$i];
            $tlist->product_auto_id = $cArray[$i];
            $tlist->quantity  = $dArray[$i];
            $tlist->product_price = $eArray[$i];
            $tlist->product_offer_percentage  = $fArray[$i];
            $tlist->product_final_price = $gArray[$i];
            $tlist->product_image  = $hArray[$i];
            $tlist->size  = $iArray[$i];
            $tlist->order_date = $order_date;
            $tlist->customer_auto_id = $customer_auto_id;
            $tlist->order_status = "Received";
            $tlist->reason = '';
            $tlist->available_stock = '';
            $tlist->deliveryboy_id = '';
            $tlist->save();
        }
        for ($i = 0; $i < $third_list; $i++) {
            $prd_id = $cArray[$i];
            $quantity  = $dArray[$i];
            $checkproduct = AdminProducts::where('_id', $prd_id)->whereNull('deleted_at')->get();
            if ($checkproduct->isNotEmpty()) {
                foreach ($checkproduct as $stock) {
                    $product_name = $stock->product_name;
                    $available_stock = $stock->available_stock;
                    $Stock_alert_limit = $stock->Stock_alert_limit;

                    if ($available_stock != "") {
                        $new_quantity = 1 * $quantity;
                        $new_stock_list = $available_stock - $new_quantity;

                        $update = DB::table('admin_products')->where('_id', $prd_id)->update(['available_stock' => strval($new_stock_list)]);

                        //send notification to admin of out of stock
                        if ($available_stock == "0") {
                            $firebaseToken = Admin::where('user_type','=', 'Admin')->where('_id', '=', $request->admin_auto_id)->whereNotNull('token')->pluck('token')->all();

                            $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';

                            $message = [

                                "registration_ids" => $firebaseToken,
                                "data" => [
                                    "type" => "Inventory",
                                ],

                                "notification" => [

                                    "title" => "Out Of Stock",
                                    "body"  =>  "Your Product " . $product_name . " is in out of stock.",
                                    "sound" => "default",
                                    "click_action" => "com.puneri.amrutullaya",

                                ]

                            ];

                            $dataString = json_encode($message);

                            $headers = [

                                'Authorization: key=' . $SERVER_API_KEY,

                                'Content-Type: application/json',

                            ];


                            $ch = curl_init();


                            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

                            curl_setopt($ch, CURLOPT_POST, true);

                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                            $response = curl_exec($ch);
                        }

                        //send notification to admin of stock alert limit
                        if ($Stock_alert_limit >= $new_stock_list) {

                            $firebaseToken = Admin::where('user_type','=', 'Admin')->where('_id', '=', $request->admin_auto_id)->whereNotNull('token')->pluck('token')->all();

                            $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';

                            $message = [
                                "registration_ids" => $firebaseToken,
                                "data" => [
                                    "type" => "Inventory",
                                ],
                                "notification" => [
                                    "title" => "Stock Alert",
                                    "body"  =>  "Your Product " . $product_name . " is below stock alert limit",
                                    "sound" => "default",
                                    "click_action" => "com.puneri.amrutullaya",

                                ]

                            ];

                            $dataString = json_encode($message);

                            $headers = [

                                'Authorization: key=' . $SERVER_API_KEY,

                                'Content-Type: application/json',

                            ];


                            $ch = curl_init();


                            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

                            curl_setopt($ch, CURLOPT_POST, true);

                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

                            $response = curl_exec($ch);
                        }
                    }
                }
            }
        }

        //send notification to admin

        $firebaseToken = Admin::where('user_type','=', 'Admin')->where('_id', '=', $request->admin_auto_id)->whereNotNull('token')->pluck('token')->all();
        $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';
        $message = [
            "registration_ids" => $firebaseToken,
            "data" => [
                "type" => "Order",
                "status" => "Received",
            ],

            "notification" => [

                "title" => "New Order Received",
                "body"  =>  "order no." . $new_oid . " is received successfully",
                "sound" => "default",
                "click_action" => "com.puneri.amrutullaya",

            ]

        ];

        $dataString = json_encode($message);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        //  Notification send to delivery boy


        $firebaseToken = DeliveryBoy::where('admin_auto_id', $request->admin_auto_id)->whereNotNull('token')->pluck('token')->all();

        $SERVER_API_KEY = 'AAAAbXgdJIg:APA91bGnMZOq2C9Ng8Y9Ahw7MTBSaeRTh3WfHOlxkFlU2c_AltoAmFcaIIEVefWP-ci9_O2KP6kfmCdGtN9OCaFGAMYbafF9diTiE2E09NY_pk31RjcLJ_KD0qgKU6_ndX_1vurYdwxQ';

        $message = [

            "registration_ids" => $firebaseToken,
            "notification" => [

                "body"  =>  "order no. " . $new_oid . " is Received",
                "title" => "Delivery Boy Order",
                "sound" => "default",
                "click_action" => "com.puneri.amrutullaya",

            ]

        ];

        $dataString = json_encode($message);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);


        return response()->json([
            'status' => 1,
            'msg' => "Success",

        ]);
    }

    public function get_order_history(Request $request)
    {
        unset($atldatewisedetails);
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $booking = Orders::ORDERBY('_id', 'DESC')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $booking = Orders::ORDERBY('_id', 'DESC')->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }
        if ($booking->isNotEmpty()) {
            foreach ($booking as $data) {

                $order_id = $data->order_id;
                $customer_auto_id = $data->customer_auto_id;
                unset($get_rating_lists);
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $rlists = ProductRatingReview::where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $rlists = ProductRatingReview::where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($rlists->isNotEmpty()) {
                    foreach ($rlists as $rlts) {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        }
                        if ($pname->isNotEmpty()) {
                            foreach ($pname as $pn) {
                                $product_name = $pn->product_name;
                            }
                        } else {
                            $product_name = '';
                        }
                        $get_rating_lists[] = array(
                            "rating_auto_id" => $rlts->_id, "product_auto_id" => $rlts->product_auto_id, "product_name" => $product_name, "customer_auto_id" => $rlts->customer_auto_id,
                            "customer_name" => $rlts->name, "email_id" => $rlts->email_id, "mobile_number" => $rlts->mobile_number, "rating" => $rlts->rating, "finishing" => $rlts->finishing, "product_quality" => $rlts->product_quality, "pricing" => $rlts->pricing, "size_fitting" => $rlts->size_fitting, "review" => $rlts->review, "review_image" => $rlts->review_image, "date" => $rlts->rdate
                        );
                    }
                } else {
                    $get_rating_lists = array();
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
                    $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($lists->isNotEmpty()) {
                    foreach ($lists as $lts) {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        }
                        if ($pname->isNotEmpty()) {
                            foreach ($pname as $pn) {
                                $product_name = $pn->product_name;
                                $color_name = $pn->color_name;
                                $color_image = $pn->color_image;
                            }
                        } else {
                            $product_name = '';
                            $color_name = '';
                            $color_image = '';
                        }
                        $get_listsss[] = array(
                            "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                            "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "cust_image" => $lts->cust_image, "quantity" => $lts->quantity, "color_name" => $color_name,
                            "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->order_status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                            "product_final_price" => $lts->product_final_price, "invoice" => $lts->invoice, "payment_mode" => $lts->payment_mode, "transaction_id" => $lts->transaction_id, "get_rating_lists" => $get_rating_lists
                        );
                    }
                } else {
                    $get_listsss = array();
                }
                //   $atldatewisedetails[] = array("order_auto_id"=>$data->_id,"customer_auto_id"=>$data->customer_auto_id,"order_id"=>$data->order_id,"address"=>$data->address,"country"=>$data->country,"state"=>$data->state,"city"=>$data->city,"mobile_no"=>$data->mobile_no,"payment_mode"=>$data->payment_mode,"transaction_id"=>$data->transaction_id,"payment_status"=>$data->payment_status,"applied_promocode"=>$data->applied_promocode,"promocode_value_off"=>$data->promocode_value_off,"promocode_type"=>$data->promocode_type,"promocode_value_off_on_order"=>$data->promocode_value_off_on_order,"used_pincode"=>$data->used_pincode,"pincode_delivery_charge"=>$data->pincode_delivery_charge,"total_price"=>$data->total_price,"total_paid_price"=>$data->total_paid_price,"status"=>$data->status,"order_date"=>$data->order_date,"order_time"=>$data->order_time,"cust_image"=>$data->cust_image,"delivery_time"=>$data->delivery_time,"delivery_slot_price"=>$data->delivery_slot_price,"delivery_type"=>$data->delivery_type,"product_details"=>$get_lists);
                return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_listsss]);
            }
            //  return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_listsss]);


        } else {

            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }
        public function get_customer_order_history(Request $request){
  
 
        $lists = Orders::ORDERBY('_id', 'DESC')
        ->where('customer_auto_id', '=', $request->get('customer_auto_id'))
        ->where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')
            ->where('admin_auto_id', $request->admin_auto_id)
            ->whereNull('deleted_at')
            ->get();
  
        if ($lists->isNotEmpty()) {
            foreach ($lists as $lts) {
                $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($pname->isNotEmpty()) {
                    foreach ($pname as $pn) {
                        $product_name = $pn->product_name;
                        $color_name = $pn->color_name;
                        $color_image = $pn->color_image;
                    }
                } else {
                    $product_name = '';
                    $color_name = '';
                    $color_image = '';
                }

                $username = UserRegister::where('_id', $lts->customer_auto_id)->get();

                if ($username->isNotEmpty()) {
                    foreach ($username as $name) {
                        $customerName = $name->name;
                    }
                } else {
                    $customerName = '';
                }
                $get_lists[] = array(
                    "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                    "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "quantity" => $lts->quantity, "color_name" => $color_name,
                    "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                    "product_final_price" => $lts->product_final_price, "user_name" => $customerName
                );
            }
            return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $get_lists]);
        } else {
            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }
    //order details
    public function get_order_detailss(Request $request)
    {



        unset($atldatewisedetails);
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {

            $booking = Orders::where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')->where('order_id', '=', $request->get('order_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $booking = Orders::where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')->where('order_id', '=', $request->get('order_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }
        if ($booking->isNotEmpty()) {
            foreach ($booking as $data) {

                $order_id = $data->order_id;
                $customer_auto_id = $data->customer_auto_id;
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $rlists = ProductRatingReview::where('customer_auto_id', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $rlists = ProductRatingReview::where('customer_auto_id', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($rlists->isNotEmpty()) {
                    foreach ($rlists as $rlts) {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        }
                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                        }
                        $get_rating_lists[] = array(
                            "rating_auto_id" => $rlts->_id, "product_auto_id" => $rlts->product_auto_id, "product_name" => $product_name, "customer_auto_id" => $rlts->customer_auto_id,
                            "customer_name" => $rlts->name, "email_id" => $rlts->email_id, "mobile_number" => $rlts->mobile_number, "rating" => $rlts->rating, "review" => $rlts->review, "review_image" => $rlts->review_image, "date" => $rlts->rdate
                        );
                    }
                } else {
                    $get_rating_lists = array();
                }
                if ($erase_data_status == 'Yes') {
                    $userDetails = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $userDetails = UserRegister::where('_id', '=', $request->get('customer_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($userDetails->isNotEmpty()) {
                    foreach ($userDetails as $user) {
                        $customer_name = $user->name;
                        $mobile_no = $user->mobile_number;
                        $address_customer = $user->address;
                        $email = $user->email;
                    }
                    $get_user_list[] = array("customer_name" => $customer_name, "customer_no" => $mobile_no, "customer_address" => $address_customer, "customer_email" => $email);
                } else {
                    // $customer_name = '';
                    // $mobile_no = '';
                    // $address_customer = '';
                    // $email = '';
                    $get_user_list = array();
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
                    $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($lists->isNotEmpty()) {
                    foreach ($lists as $lts) {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        }
                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                            $color_name = $pn->color_name;
                            $color_image = $pn->color_image;
                        }
                        $get_lists[] = array(
                            "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                            "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "cust_image" => $lts->cust_image, "quantity" => $lts->quantity, "color_name" => $color_name,
                            "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->order_status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                            "product_final_price" => $lts->product_final_price, "invoice" => $lts->invoice, "payment_mode" => $lts->payment_mode, "transaction_id" => $lts->transaction_id
                        );
                    }
                } else {
                    $get_lists = array();
                }


                $atldatewisedetails[] = array("order_auto_id" => $data->_id, "customer_auto_id" => $data->customer_auto_id, "order_id" => $data->order_id, "address" => $data->address, "country" => $data->country, "state" => $data->state, "city" => $data->city, "mobile_no" => $data->mobile_no, "payment_mode" => $data->payment_mode, "transaction_id" => $data->transaction_id, "payment_status" => $data->payment_status, "applied_promocode" => $data->applied_promocode, "promocode_value_off" => $data->promocode_value_off, "promocode_type" => $data->promocode_type, "promocode_value_off_on_order" => $data->promocode_value_off_on_order, "used_pincode" => $data->used_pincode, "pincode_delivery_charge" => $data->pincode_delivery_charge, "total_price" => $data->total_price, "total_paid_price" => $data->total_paid_price, "status" => $data->status, "order_date" => $data->order_date, "order_time" => $data->order_time, "cust_image" => $data->cust_image, "delivery_time" => $data->delivery_time, "delivery_slot_price" => $data->delivery_slot_price, "delivery_type" => $data->delivery_type, "product_details" => $get_lists, "get_rating_lists" => $get_rating_lists, "get_customer_list" => $get_user_list);



                return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $atldatewisedetails]);
            }
        } else {

            return response()->json([

                'status' => 0,

                'msg' => config('messages.empty')

            ]);
        }
    }
    //cancel_order
    public function cancel_order(Request $request)
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
            $cancelorder = VendorOrders::where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_id'))->whereNull('deleted_at')->get();
        } else {
            $cancelorder = VendorOrders::where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_id'))->whereNull('deleted_at')->get();
        }
        if ($cancelorder->isEmpty()) {
            return response()->json(['status' => 2, "msg" => "Sorry, data not found"]);
        } else {
           foreach ($cancelorder as $cencel) {
                $product_auto_id = $cencel->product_auto_id;
		$quantity = $cencel->quantity;
                $update_cancel_details = AdminProducts::where('_id', '=', $cencel->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
 		if ($update_cancel_details) {
 		foreach ($update_cancel_details as $stock) {
                $available_stock = $stock->available_stock;
		}
		$new_stock = $available_stock + $quantity;
                $update_product_quantity = DB::table('admin_products')->where('admin_auto_id', $request->admin_auto_id)->where('_id', '=', $cencel->product_auto_id)->update(['available_stock' => $new_stock]);
		}
            }

                $update = DB::table('vendor_orders')->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_id'))->update(['order_status' => 'Cancelled', 'reason' => $request->get('reason')]);
                $update = DB::table('uorders')->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_id'))->update(['status' => 'Cancelled', 'reason' => $request->get('reason')]);

        


            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    //return order
    public function return_order(Request $request)
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
            $returnorder = VendorOrders::where('_id', '=', $request->get('product_order_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_auto_id'))->whereNull('deleted_at')->get();
        } else {
            $returnorder = VendorOrders::where('_id', '=', $request->get('product_order_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_auto_id'))->whereNull('deleted_at')->get();
        }
        if ($returnorder->isEmpty()) {

            return response()->json(['status' => 2, "msg" => "Sorry, data not found"]);
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
                $update = DB::table('vendor_orders')->where('_id', '=', $request->get('product_order_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_auto_id'))->update(['order_status' => 'Returned', 'reason' => $request->get('reason')]);
            } else {
                $update = DB::table('vendor_orders')->where('_id', '=', $request->get('product_order_auto_id'))->where('admin_auto_id', $request->admin_auto_id)->where('customer_auto_id', '=', $request->get('customer_auto_id'))->where('order_id', '=', $request->get('order_auto_id'))->update(['order_status' => 'Returned', 'reason' => $request->get('reason')]);
            }

            return response()->json(['status' => 1, "msg" => config('messages.success')]);
        }
    }
    //order details
    public function get_order_details_admin(Request $request)
    {

        unset($atldatewisedetails);
        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
        if ($esatatus->isNotEmpty()) {
            foreach ($esatatus as $erase) {
                $erase_data_status = $erase->erase_data_status;
            }
        } else {
            $erase_data_status = 'No';
        }
        if ($erase_data_status == 'Yes') {
            $booking = Orders::where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')->where('order_id', '=', $request->get('order_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        } else {
            $booking = Orders::where('added_by_id', 'LIKE', '%' . $request->user_auto_id . '%')->where('order_id', '=', $request->get('order_id'))->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
        }
        if ($booking->isNotEmpty()) {
            foreach ($booking as $data) {
                $order_id = $data->order_id;
                $customer_auto_id = $data->customer_auto_id;
                $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                if ($esatatus->isNotEmpty()) {
                    foreach ($esatatus as $erase) {
                        $erase_data_status = $erase->erase_data_status;
                    }
                } else {
                    $erase_data_status = 'No';
                }
                if ($erase_data_status == 'Yes') {
                    $rlists = ProductRatingReview::where('customer_auto_id', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $rlists = ProductRatingReview::where('customer_auto_id', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($rlists->isNotEmpty()) {
                    foreach ($rlists as $rlts) {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pname = AdminProducts::where('_id', $rlts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        }
                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                        }
                        $get_rating_lists[] = array(
                            "rating_auto_id" => $rlts->_id, "product_auto_id" => $rlts->product_auto_id, "product_name" => $product_name, "customer_auto_id" => $rlts->customer_auto_id,
                            "customer_name" => $rlts->name, "email_id" => $rlts->email_id, "mobile_number" => $rlts->mobile_number, "rating" => $rlts->rating, "review" => $rlts->review, "review_image" => $rlts->review_image, "date" => $rlts->rdate
                        );
                    }
                } else {
                    $get_rating_lists = array();
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

                    $userDetails = UserRegister::where('_id', '=', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {

                    $userDetails = UserRegister::where('_id', '=', $customer_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($userDetails->isNotEmpty()) {
                    foreach ($userDetails as $user) {
                        $customer_name = $user->name;
                        $mobile_no = $user->mobile_number;
                        $address_customer = $user->address;
                        $email = $user->email;
                    }
                    $get_user_list[] = array("customer_name" => $customer_name, "customer_no" => $mobile_no, "customer_address" => $address_customer, "customer_email" => $email);
                } else {

                    $get_user_list = array();
                }
                if ($erase_data_status == 'Yes') {
                    $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                } else {
                    $lists = VendorOrders::where('order_id', $order_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                }
                if ($lists->isNotEmpty()) {
                    foreach ($lists as $lts) {
                        $esatatus = Admin::where('_id', '=', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        if ($esatatus->isNotEmpty()) {
                            foreach ($esatatus as $erase) {
                                $erase_data_status = $erase->erase_data_status;
                            }
                        } else {
                            $erase_data_status = 'No';
                        }
                        if ($erase_data_status == 'Yes') {
                            $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        } else {
                            $pname = AdminProducts::where('_id', $lts->product_auto_id)->where('admin_auto_id', $request->admin_auto_id)->whereNull('deleted_at')->get();
                        }
                        $product_name = '';
                        $color_name = '';
                        $color_image = '';
                        foreach ($pname as $pn) {
                            $product_name = $pn->product_name;
                            $color_name = $pn->color_name;
                            $color_image = $pn->color_image;
                        }
                        $get_lists[] = array(
                            "product_order_auto_id" => $lts->_id, "order_id" => $lts->order_id, "added_by_id" => $lts->added_by_id, "added_by" => $lts->added_by, "product_auto_id" => $lts->product_auto_id,
                            "product_name" => $product_name, "product_image" => $lts->product_image, "size" => $lts->size, "food_type" => $lts->food_type, "cust_image" => $lts->cust_image, "quantity" => $lts->quantity, "color_name" => $color_name,
                            "color_image" => $color_image, "order_date" => $lts->order_date, "order_status" => $lts->order_status, "product_price" => $lts->product_price, "product_offer_percentage" => $lts->product_offer_percentage,
                            "product_final_price" => $lts->product_final_price, "invoice" => $lts->invoice, "payment_mode" => $lts->payment_mode, "transaction_id" => $lts->transaction_id
                        );
                    }
                } else {
                    $get_lists = array();
                }

                $atldatewisedetails[] = array(
                    "order_auto_id" => $data->_id, "customer_auto_id" => $data->customer_auto_id, "order_id" => $data->order_id, "address" => $data->address,
                    "country" => $data->country, "state" => $data->state, "city" => $data->city, "mobile_no" => $data->mobile_no, "payment_mode" => $data->payment_mode, "transaction_id" => $data->transaction_id,
                    "payment_status" => $data->payment_status, "applied_promocode" => $data->applied_promocode, "promocode_value_off" => $data->promocode_value_off, "promocode_type" => $data->promocode_type,
                    "promocode_value_off_on_order" => $data->promocode_value_off_on_order, "used_pincode" => $data->used_pincode, "pincode_delivery_charge" => $data->pincode_delivery_charge,
                    "total_price" => $data->total_price, "total_paid_price" => $data->total_paid_price, "status" => $data->status, "order_date" => $data->order_date, "order_time" => $data->order_time,
                    "delivery_time" => $data->delivery_time, "delivery_slot_price" => $data->delivery_slot_price, "delivery_type" => $data->delivery_type, "product_details" => $get_lists, "get_rating_lists" => $get_rating_lists, "get_customer_list" => $get_user_list
                );

                return response()->json(['status' => 1, "msg" => config('messages.success'), "data" => $atldatewisedetails]);
            }
        } else {

            return response()->json([
                'status' => 0,
                'msg' => config('messages.empty')
            ]);
        }
    }
}