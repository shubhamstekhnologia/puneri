<?php

namespace App\Http\Controllers\Admin;

use DB;
use DateTime;
use Redirect;
use App\Admin;
use App\Brand;
use App\Pincode;
use App\Currency;
use DateTimeZone;
use App\SizeLists;
use App\Categories;
use App\CouponCode;
use App\PriceRange;
use App\ColorsRange;
use App\UserRegister;
use App\AdminProducts;
use App\CategoryStyle;
use App\DiscountRange;
use App\HomeComponent;
use App\Subcategories;
use App\ContactDetails;
use App\OfferComponent;
use App\BusinessDetails;
use App\ComponentContent;
use App\WishlistProducts;
use App\AdminProductImages;
use App\CountryProductPrice;
use App\ProductRatingReview;
use Illuminate\Http\Request;
use App\HomeProductComponent;
use App\HomeComponentTopBrands;
use App\HomeComponentSubCategories;
use App\HomeComponentMainCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    //     public function search(Request $request){
    //     $search = $request->input('search');

    //     $posts = AdminProducts::query()
    //         ->where('product_name', 'LIKE', "%{$search}%")
    //         ->orWhere('body', 'LIKE', "%{$search}%")
    //         ->whereNull();

    //     return view('search', compact('posts'));
    // }
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
    public function wishlist(Request $request)
    {

        $uid = Session::get('AccessTokens');

        $checkproduct = WishlistProducts::where('product_auto_id', $request->product_auto_id)
        ->where('user_auto_id', $uid)
        ->whereNull('deleted_at')
        ->first();
        if (!empty($checkproduct)) {

            $checkproduct->delete();

           return redirect()->back()->with(['success', 'Removed from wishlist..!']);

        } else {
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');
            $productcart = new WishlistProducts();
            $productcart->product_auto_id = $request->get('product_auto_id');
            $productcart->user_auto_id = $uid;
            $productcart->rdate = date('Y-m-d');
            $productcart->save();

            return redirect()->back()->with(['success', 'Added to wishlist..!']);
        }
    }

    //product list
    public function search($main, Request $request)
    {
        $admin = Admin::where("subdomain", $main)->first();
        if (empty($admin)) {
            abort(404);
        }
        $search = $request->input('search');
        $get_main_categories = Categories::whereNull('deleted_at')->where("admin_auto_id", $admin->id)->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }

        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $product_details = AdminProducts::where('product_name', 'LIKE', "%{$search}%")
            ->whereNull('deleted_at')
            ->where("admin_auto_id", $admin->id)->get();
        $get_prod_ids = AdminProducts::where('product_name', 'LIKE', "%{$search}%")
            ->whereNull('deleted_at')
            ->where("admin_auto_id", $admin->id)->pluck("_id")->toArray();
        $pimages_lists = AdminProductImages::whereNull('deleted_at')->where("admin_auto_id", $admin->id)->get();
        $brand_lists = Brand::whereNull('deleted_at')->where("admin_auto_id", $admin->id)->get();
        $price_lists = PriceRange::whereNull('deleted_at')->where("admin_auto_id", $admin->id)->get();
        $color_lists = ColorsRange::whereNull('deleted_at')->where("admin_auto_id", $admin->id)->get();
        $discount_lists = DiscountRange::whereNull('deleted_at')->where("admin_auto_id", $admin->id)->get();

        $uid = Session::get('AccessTokens');

        if (isset($uid)) {
            $wproducts = WishlistProducts::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();
        } else {
            $wproducts = array();
        }

        $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $admin_country = $admin->country_code;
        $ip =  $request->getClientIp();

        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip
        ));

        $userCountry =  $ipdat->geoplugin_countryName ?? "India";

        $userCurrency = $ipdat->geoplugin_currencyCode ?? "INR";

        $currencies = Currency::where("admin_auto_id", "=", $admin->id)
            ->where("country_name", $userCountry)
            ->where("admin_auto_id", "=", $admin->id)->first();

        if (!empty($currencies)) {
            $pc = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                ->where("currency_auto_id", $currencies->id)
                ->whereIn("product_auto_id", $get_prod_ids)
                ->count();

            if ($pc < 1) {
                $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                    ->where("country_code", $admin_country)
                    ->where("admin_auto_id", "=", $admin->id)->first();
            }
        } else {
            $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                ->where("country_code", $admin_country)
                ->where("admin_auto_id", "=", $admin->id)->first();
        }


        $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
            ->where("currency_auto_id", $currencies->id)
            ->get();
        if ($price_lists->isNotEmpty()) {
            foreach ($price_lists as $pl) {
                $pl["currency"] = $currencies->currency;
            }
        }

        //rating review
        if ($product_details->isNotEmpty()) {
            foreach ($product_details as $main) {
                $product_auto_id = $main->_id;
                $product_auto_ids = $main->product_auto_id;

                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
            }
        } else {
            $avg_rating = 0;
            $courseRatingReviewCount = 0;
        }
        //    return $product_details;
        if (empty($product_details)) {
            return view('templates.frontend.product_list')->with("Not Available any data");
        } else {
            return view('templates.frontend.product_list')
                ->with([
                    'pimages_lists' => $pimages_lists, 'business_details' => $get_business_details, 'product_lists' => $product_details, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists,
                    'color_lists' => $color_lists, 'discount_lists' => $discount_lists, 'wproducts' => $wproducts,
                    'main_cat_style' => $main_category_display_style, 'main_category' => $get_main_categories, 'rating' => $avg_rating,
                    'total_rating_count' => $courseRatingReviewCount
                ]);
        }
    }

    public function index($id, Request $request)
    {
        $admin =  Admin::where("subdomain", "=", $id)->first();

        if (empty($admin)) {
            abort(404);
        }

        if ($admin->app_logo != "") {
            session()->put("logo", $admin->app_logo);
        }

        $get_main_categories = Categories::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $i = 0;

        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }

        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $get_contact_details = ContactDetails::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();

        session()->put("app_name", $admin->app_name);

        $get_home_component_details = HomeComponent::ORDERBY('component_index', 'ASC')->where("admin_auto_id", "=", $admin->id)->where("show_on_home", "true")->whereNull('deleted_at')->get();
        if ($get_home_component_details->isNotEmpty()) {
            foreach ($get_home_component_details as $comp) {
                $comp["component_index_int"] = intval($comp->component_index);
            }
        }

        $collect = collect($get_home_component_details);
        $get_home_component_details = $collect->sortBy('component_index_int')->values()->all();

        $i = 0;
        foreach ($get_home_component_details as $home) {
            unset($get_home_component_details[$i]['content']);
            $component_id = $home->_id;
            $component_type = $home->component_type;
            $component_content = ComponentContent::where('component_auto_id', $component_id)->whereNull('deleted_at')->get();

            if ($component_type == "Banner") {
                $component_content = ComponentContent::where('component_auto_id', $component_id)->whereNull('deleted_at')->get();
                $get_home_component_details[$i]['content'] = $component_content;
            }


            if ($component_type == "Slider") {
                $first_img = ComponentContent::select('component_image')->where('component_auto_id', $component_id)->where('slider_index', '0')->first();
                if ($first_img != "") {
                    $get_first_img = $first_img->component_image;
                } else {
                    $get_first_img = "";
                }

                $rest_imgs = ComponentContent::select('component_image')->where('component_auto_id', $component_id)->where('slider_index', '1')->whereNull('deleted_at')->get();
                $get_home_component_details[$i]['first_img'] = $get_first_img;
                $get_home_component_details[$i]['slider_images'] = $rest_imgs;
            }



            if ($component_type == "SubCategories") {
                $check_component_content = HomeComponentSubCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentSubCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($component_content as $cc) {
                        $subcategory_auto_ids = $cc->sub_category_auto_id;
                        $subcat_ids = explode('|', $subcategory_auto_ids);
                        unset($get_lists);
                        foreach ($subcat_ids as $sub) {
                            //unset($subcat_ids);
                            $first_subcat = Subcategories::ORDERBY('_id', 'ASC')->where('_id', $sub)->limit(1)->whereNull('deleted_at')->get();
                            if ($first_subcat->isEmpty()) {
                                $first_subcat = array();
                            }
                            $lists = Subcategories::ORDERBY('_id', 'DESC')->where('_id', $sub)->whereNull('deleted_at')->get();

                            if ($lists->isNotEmpty()) {

                                foreach ($lists as $lts) {

                                    // unset($lists);
                                    $get_spcount = AdminProducts::where('sub_category_auto_id', '=', $lts->_id)->whereNull('deleted_at')->count();


                                    $get_lists[] = array("subcategory_auto_id" => $lts->_id, "main_category_auto_id" => $lts->main_category_auto_id, "sub_category_name" => $lts->sub_category_name, "subcategory_image_app" => $lts->subcategory_image_app, "subcategory_image_web" => $lts->subcategory_image_web, "get_spcount" => $get_spcount);
                                }
                            } else {

                                $get_lists = array();
                            }
                        }
                        $get_home_component_details[$i]['first_subcat'] = $first_subcat;
                        $get_home_component_details[$i]['content'] = $get_lists;
                    }
                }
            }
            if ($component_type == "MainCategories") {
                $check_component_content = HomeComponentMainCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentMainCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($component_content as $cc) {
                        $subcategory_auto_ids = $cc->main_category_auto_id;
                        $subcat_ids = explode('|', $subcategory_auto_ids);
                        unset($get_lists);
                        foreach ($subcat_ids as $sub) {
                            //unset($subcat_ids);
                            $first_subcat = Categories::ORDERBY('_id', 'ASC')->where('_id', $sub)->limit(1)->whereNull('deleted_at')->get();
                            if ($first_subcat->isEmpty()) {
                                $first_subcat = array();
                            }
                            $lists = Categories::ORDERBY('_id', 'DESC')->where('_id', $sub)->whereNull('deleted_at')->get();

                            if ($lists->isNotEmpty()) {

                                foreach ($lists as $lts) {

                                    // unset($lists);
                                    $get_spcount = AdminProducts::where('main_category_id', '=', $lts->_id)->whereNull('deleted_at')->count();


                                    $get_lists[] = array(
                                        "subcategory_auto_id" => $lts->_id,
                                        "main_category_auto_id" => $lts->main_category_auto_id,
                                        "sub_category_name" => $lts->category_image_name,
                                        "subcategory_image_app" => $lts->category_image_app,
                                        "subcategory_image_web" => $lts->category_image_web,
                                        "get_spcount" => $get_spcount
                                    );
                                }
                            } else {

                                $get_lists = array();
                            }
                        }
                        $get_home_component_details[$i]['first_subcat'] = $first_subcat;
                        $get_home_component_details[$i]['content'] = $get_lists;
                    }
                }
            }
            if ($component_type == "Brand") {
                $check_component_content = HomeComponentTopBrands::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentTopBrands::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($check_component_content as $cc) {
                        $brand_auto_ids = $cc->brand_auto_id;
                        $brand_ids = explode('|', $brand_auto_ids);
                        unset($get_lists);
                        foreach ($brand_ids as $b) {



                            $lists = Brand::where('_id', $b)->whereNull('deleted_at')->get();

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
            if ($component_type == "Offers") {

                $check_component_content = OfferComponent::where('homecomponent_auto_id', $component_id)->whereNull('deleted_at')->get();

                if ($check_component_content->isEmpty()) {

                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = OfferComponent::where('homecomponent_auto_id', $component_id)->whereNull('deleted_at')->get();
                    unset($get_olists);
                    foreach ($check_component_content as $cc) {


                        $get_olists[] = array(
                            "offer_auto_id" => $cc->_id, "home_component_auto_id" => $cc->homecomponent_auto_id, "component_image" => $cc->component_image, "main_category" => $cc->main_category,
                            "subcategory" => $cc->subcategory, "brand" => $cc->brand, "price" => $cc->price, "offer" => $cc->offer, "rdate" => $cc->rdate
                        );
                    }
                    $get_home_component_details[$i]['content'] = $get_olists;
                }
            }


            if ($component_type == "Products") {
                // $check_component_content = HomeProductComponent::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                // if ($check_component_content->isEmpty()) {
                //     $get_home_component_details[$i]['content'] = $check_component_content;
                // } else {
                // $component_content = HomeProductComponent::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                // foreach ($component_content as $cc) {
                // $product_auto_id = $cc->product_auto_id;
                // $size_ids = explode('|', $product_auto_id);

                $get_prod_ids = $scats = AdminProducts::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->pluck("_id")->toArray();

                unset($get_slists);
                foreach ($get_prod_ids as $sz) {
                    $scats = AdminProducts::where('_id', '=', $sz)->orwhere('product_auto_id', '=', $sz)->whereNull('deleted_at')->get();

                    if ($scats->isEmpty()) {

                        $sscats = array();
                    } else {
                        foreach ($scats as $urs) {
                            $product_auto_id = $urs->_id;
                            $product_auto_ids = $urs->product_auto_id;
                            $product_model_auto_id = $urs->product_model_auto_id;
                            $color_image = $urs->color_image;
                            $color_name = $urs->color_name;
                            $size = $urs->size;
                            $offer_auto_id = $urs->offer_auto_id;

                            $size_price = $urs->size_price;
                            $product_name = $urs->product_name;
                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();

                            foreach ($get_details as $dtls) {
                                $main_category_auto_id = $dtls->main_category_auto_id;
                                $sub_category_auto_id = $dtls->sub_category_auto_id;
                                $user_auto_id = $dtls->user_auto_id;
                                $added_by = $dtls->added_by;
                                $product_dimensions = $dtls->product_dimensions;
                                $product_name = $dtls->product_name;
                                $highlights = $dtls->highlights;
                                $description = $dtls->description;
                                $specification = $dtls->specification;
                                $brand_auto_id = $dtls->brand_auto_id;
                                $new_arrival = $dtls->new_arrival;
                                $moq = $dtls->moq;
                                $gross_wt = $dtls->gross_wt;
                                $net_wt = $dtls->net_wt;
                                $unit = $dtls->unit;
                                $quantity = $dtls->quantity;
                                $weight = $dtls->weight;
                                $admin_country = $admin->country_code;
                                $ip =  $request->getClientIp();

                                $ipdat = @json_decode(file_get_contents(
                                    "http://www.geoplugin.net/json.gp?ip=" . $ip
                                ));

                                $userCountry =  $ipdat->geoplugin_countryName ?? "India";

                                $userCurrency = $ipdat->geoplugin_currencyCode ?? "INR";

                                $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                                    ->where("country_name", $userCountry)
                                    ->where("admin_auto_id", "=", $admin->id)->first();

                                if (!empty($currencies)) {
                                    $pc = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                                        ->where("currency_auto_id", $currencies->id)
                                        ->whereIn("product_auto_id", $get_prod_ids)
                                        ->count();

                                    if ($pc < 1) {
                                        $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                                            ->where("country_code", $admin_country)
                                            ->where("admin_auto_id", "=", $admin->id)->first();
                                    }
                                } else {
                                    $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                                        ->where("country_code", $admin_country)
                                        ->where("admin_auto_id", "=", $admin->id)->first();
                                }


                                if (!empty($currencies)) {
                                    $p = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                                        ->where("product_auto_id", $dtls->id)
                                        ->where("currency_auto_id", $currencies->id)
                                        ->orderBy('_id', 'DESC')
                                        ->first();

                                    if (!empty($p)) {
                                        $product_price = $p->product_price;
                                        $offer_percentage = $p->offer_percentage;
                                        $final_pprices = $p->final_price;
                                        $product_model_auto_id = $p->product_model_auto_id;
                                        $including_tax = $p->including_tax;
                                        $tax_percentage = $p->tax_percentage;
                                        $currency = $currencies->currency;
                                    } else {
                                        $product_price = 0;
                                        $offer_percentage = 0;
                                        $final_pprices = 0;
                                        $product_model_auto_id = "";
                                        $including_tax = "";
                                        $tax_percentage = "";
                                        $currency = "Rs. ";
                                    }
                                } else {
                                    $product_price = 0;
                                    $offer_percentage = 0;
                                    $final_pprices = 0;
                                    $product_model_auto_id = "";
                                    $including_tax = "";
                                    $tax_percentage = "";
                                    $currency = "Rs. ";
                                }
                            }


                            unset($image_lists);
                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->orwhere('product_auto_id', '=', $product_auto_ids)->whereNull('deleted_at')->get();
                            if ($pimage_details->isNotEmpty()) {
                                foreach ($pimage_details as $pidata) {
                                    $image_lists = $pidata->image_file;
                                }
                            } else {
                                $image_lists = array();
                            }
                            //rating review
                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->whereNull('deleted_at')->count();
                            $avg_rating = 0;
                            if ($courseRatingReview->isNotEmpty()) {
                                foreach ($courseRatingReview as  $data) {
                                    $total_rating = $data->rating;

                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();

                                    $avg_rating = ($total_student * $total_rating / $total_student);
                                }
                            } else {
                                $courseRatingReview = array();
                            }
                            $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();

                            $sscats[] = array(
                                "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                                "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                                "specification" => $specification, "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                                "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                                "color_image" => $color_image, "color_name" => $color_name,
                                "currency" => $currency,
                                "total_no_of_reviews" => $courseRatingReviewCount,
                                "avg_rating" => $avg_rating, "product_images" => $image_lists
                            );
                        }
                    }
                }

                $get_home_component_details[$i]['content'] = $sscats;

                // dd($sscats);
                // }
                // }
            }

            if ($component_type == "Recommneded Product") {
                $check_component_content = HomeComponent::where('_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {


                    $scats = AdminProducts::whereNull('deleted_at')->get();
                    if ($scats->isEmpty()) {

                        $sscats = array();
                    } else {
                        foreach ($scats as $urs) {
                            $product_auto_id = $urs->_id;
                            $product_auto_ids = $urs->product_auto_id;
                            $product_model_auto_id = $urs->product_model_auto_id;
                            $color_image = $urs->color_image;
                            $color_name = $urs->color_name;
                            $size = $urs->size;
                            $offer_auto_id = $urs->offer_auto_id;

                            $size_price = $urs->size_price;
                            $product_name = $urs->product_name;
                            $get_details = AdminProducts::where('product_model_auto_id', '=', $product_model_auto_id)->where('product_name', '=', $product_name)->whereNull('deleted_at')->get();
                            foreach ($get_details as $dtls) {
                                $main_category_auto_id = $dtls->main_category_auto_id;
                                $sub_category_auto_id = $dtls->sub_category_auto_id;
                                $user_auto_id = $dtls->user_auto_id;
                                $added_by = $dtls->added_by;
                                $product_dimensions = $dtls->product_dimensions;
                                $product_name = $dtls->product_name;
                                $highlights = $dtls->highlights;
                                $description = $dtls->description;
                                $specification = $dtls->specification;
                                $brand_auto_id = $dtls->brand_auto_id;
                                $new_arrival = $dtls->new_arrival;
                                $moq = $dtls->moq;
                                $gross_wt = $dtls->gross_wt;
                                $net_wt = $dtls->net_wt;
                                $unit = $dtls->unit;
                                $quantity = $dtls->quantity;
                                $weight = $dtls->weight;
                                $product_price = $dtls->product_price;
                                $offer_percentage = $dtls->offer_percentage;
                                $final_pprices = $dtls->final_price;
                                $product_model_auto_id = $dtls->product_model_auto_id;
                                $including_tax = $dtls->including_tax;
                                $tax_percentage = $dtls->tax_percentage;
                            }


                            unset($image_lists);
                            $pimage_details = AdminProductImages::where('product_auto_id', '=', $product_auto_id)->orwhere('product_auto_id', '=', $product_auto_ids)->whereNull('deleted_at')->get();
                            if ($pimage_details->isNotEmpty()) {
                                foreach ($pimage_details as $pidata) {
                                    $image_lists = $pidata->image_file;
                                }
                            } else {
                                $image_lists = array();
                            }
                            //rating review
                            $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->whereNull('deleted_at')->get();
                            $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->whereNull('deleted_at')->count();
                            $avg_rating = 0;
                            if ($courseRatingReview->isNotEmpty()) {
                                foreach ($courseRatingReview as  $data) {
                                    $total_rating = $data->rating;

                                    $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                                    $avg_rating = ($total_student * $total_rating / $total_student);
                                }
                            } else {
                                $courseRatingReview = array();
                            }

                            $sscats[] = array(
                                "product_auto_id" => $product_auto_id, "main_category_auto_id" => $main_category_auto_id, "sub_category_auto_id" => $sub_category_auto_id, "user_auto_id" => $user_auto_id, "added_by" => $added_by,
                                "product_dimensions" => $product_dimensions, "product_name" => $product_name, "highlights" => $highlights, "description" => $description, "product_model_auto_id" => $product_model_auto_id,
                                "specification" => $specification, "brand_auto_id" => $brand_auto_id, "new_arrival" => $new_arrival, "moq" => $moq, "gross_wt" => $gross_wt,
                                "net_wt" => $net_wt, "unit" => $unit, "quantity" => $quantity, "weight" => $weight, "product_price" => $product_price, "offer_percentage" => $offer_percentage, "including_tax" => $including_tax, "tax_percentage" => $tax_percentage, "final_product_price" => $final_pprices,
                                "color_image" => $color_image, "color_name" => $color_name, "total_no_of_reviews" => $courseRatingReviewCount, "avg_rating" => $avg_rating, "product_images" => $image_lists
                            );
                        }
                    }

                    $get_home_component_details[$i]['content'] = $sscats;
                }
            }
            $i++;
        }

        return view('templates.frontend.index')->with(['homecomponent' => $get_home_component_details, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'main_cat_style' => $main_category_display_style]);
    }

    public function category_page($main, $id, Request $request)
    {
        $admin =  Admin::where("subdomain", "=", $main)->first();
        if (empty($admin)) {
            abort(404);
        }
        $get_main_categories = Categories::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }
        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $get_contact_details = ContactDetails::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();

        $get_home_component_details = HomeComponent::where('show_in_category', 'LIKE', '%' . $id . '%')->whereNull('deleted_at')->get();
        $i = 0;
        foreach ($get_home_component_details as $home) {
            unset($get_home_component_details[$i]['content']);
            $component_id = $home->_id;
            $component_type = $home->component_type;
            if ($component_type == "Banner") {
                $component_content = ComponentContent::where('component_auto_id', $component_id)->whereNull('deleted_at')->get();
                $get_home_component_details[$i]['content'] = $component_content;
            }


            if ($component_type == "Slider") {
                $first_img = ComponentContent::select('component_image')->where('component_auto_id', $component_id)->where('slider_index', '0')->first();
                if ($first_img != "") {
                    $get_first_img = $first_img->component_image;
                } else {
                    $get_first_img = "";
                }

                $rest_imgs = ComponentContent::select('component_image')->where('component_auto_id', $component_id)->where('slider_index', '1')->whereNull('deleted_at')->get();
                $get_home_component_details[$i]['first_img'] = $get_first_img;
                $get_home_component_details[$i]['slider_images'] = $rest_imgs;
            }



            if ($component_type == "SubCategories") {
                $check_component_content = HomeComponentSubCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentSubCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($component_content as $cc) {
                        $subcategory_auto_ids = $cc->sub_category_auto_id;
                        $subcat_ids = explode('|', $subcategory_auto_ids);
                        unset($get_lists);
                        foreach ($subcat_ids as $sub) {
                            //unset($subcat_ids);
                            $first_subcat = Subcategories::ORDERBY('_id', 'ASC')->where('_id', $sub)->limit(1)->whereNull('deleted_at')->get();
                            if ($first_subcat->isEmpty()) {
                                $first_subcat = array();
                            }
                            $lists = Subcategories::ORDERBY('_id', 'DESC')->where('_id', $sub)->whereNull('deleted_at')->get();

                            if ($lists->isNotEmpty()) {

                                foreach ($lists as $lts) {

                                    // unset($lists);

                                    $get_lists[] = array("subcategory_auto_id" => $lts->_id, "main_category_auto_id" => $lts->main_category_auto_id, "sub_category_name" => $lts->sub_category_name, "subcategory_image_app" => $lts->subcategory_image_app, "subcategory_image_web" => $lts->subcategory_image_web);
                                }
                            } else {

                                $get_lists = array();
                            }
                        }
                        $get_home_component_details[$i]['first_subcat'] = $first_subcat;
                        $get_home_component_details[$i]['content'] = $get_lists;
                    }
                }
            }

            if ($component_type == "Brand") {
                $check_component_content = HomeComponentTopBrands::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentTopBrands::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($check_component_content as $cc) {
                        $brand_auto_ids = $cc->brand_auto_id;
                        $brand_ids = explode('|', $brand_auto_ids);
                        unset($get_lists);
                        foreach ($brand_ids as $b) {



                            $lists = Brand::where('_id', $b)->whereNull('deleted_at')->get();

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
            $i++;
        }

        //  return $get_lists;



        return view('templates.frontend.category_page')->with(['homecomponent' => $get_home_component_details, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'main_cat_style' => $main_category_display_style]);
    }

    public function get_subcategories()
    {
        $allcat = Categories::all();
        $i = 0;
        foreach ($allcat as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $allcat[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        //  return $allcat;
        $cat_style = CategoryStyle::first();
        return view('templates.SuperAdmin.admin_screen_subcategories_list')->with(['main_category' => $allcat, 'main_cat_style' => $cat_style]);
    }
    public function get_brands()
    {
        $brands = Brand::all();

        return view('templates.SuperAdmin.admin_screen_brands_list')->with(['brands' => $brands]);
    }
    public function add_products()
    {

        $brands = Brand::all();
        return view('templates.SuperAdmin.admin_add_product')->with(['brands' => $brands]);
    }

    public function admin_index()
    {


        $get_main_categories = Categories::all();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        $main_category_display_style = $get_maincategory_style->web_icon_style;


        $get_home_component_details = HomeComponent::ORDERBY('component_index', 'ASC')->whereNull('deleted_at')->get();
        $i = 0;
        foreach ($get_home_component_details as $home) {
            unset($get_home_component_details[$i]['content']);
            $component_id = $home->_id;
            $component_type = $home->component_type;
            if ($component_type == "Banner") {
                $component_content = ComponentContent::where('component_auto_id', $component_id)->whereNull('deleted_at')->get();
                $get_home_component_details[$i]['content'] = $component_content;
            }
            $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
            $get_contact_details = ContactDetails::whereNull('deleted_at')->get();

            if ($component_type == "Slider") {
                $first_img = ComponentContent::select('component_image')->where('component_auto_id', $component_id)->where('slider_index', '0')->first();
                //  $get_first_img=$first_img->component_image;
                if ($first_img != "") {
                    $get_first_img = $first_img->component_image;
                } else {
                    $get_first_img = "";
                }

                $rest_imgs = ComponentContent::select('component_image')->where('component_auto_id', $component_id)->where('slider_index', '1')->whereNull('deleted_at')->get();

                $get_home_component_details[$i]['first_img'] = $get_first_img;
                $get_home_component_details[$i]['slider_images'] = $rest_imgs;
            }



            if ($component_type == "SubCategories") {
                $check_component_content = HomeComponentSubCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentSubCategories::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($component_content as $cc) {
                        $subcategory_auto_ids = $cc->sub_category_auto_id;
                        $subcat_ids = explode('|', $subcategory_auto_ids);
                        unset($get_lists);
                        foreach ($subcat_ids as $sub) {
                            //unset($subcat_ids);
                            $first_subcat = Subcategories::ORDERBY('_id', 'ASC')->where('_id', $sub)->limit(1)->whereNull('deleted_at')->get();
                            if ($first_subcat->isEmpty()) {
                                $first_subcat = array();
                            }
                            $lists = Subcategories::ORDERBY('_id', 'DESC')->where('_id', $sub)->whereNull('deleted_at')->get();

                            if ($lists->isNotEmpty()) {

                                foreach ($lists as $lts) {

                                    // unset($lists);

                                    $get_lists[] = array("subcategory_auto_id" => $lts->_id, "main_category_auto_id" => $lts->main_category_auto_id, "sub_category_name" => $lts->sub_category_name, "subcategory_image_app" => $lts->subcategory_image_app, "subcategory_image_web" => $lts->subcategory_image_web);
                                }
                            } else {

                                $get_lists = array();
                            }
                        }
                        $get_home_component_details[$i]['first_subcat'] = $first_subcat;
                        $get_home_component_details[$i]['content'] = $get_lists;
                    }
                }
            }

            if ($component_type == "Brand") {
                $check_component_content = HomeComponentTopBrands::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                if ($check_component_content->isEmpty()) {
                    $get_home_component_details[$i]['content'] = $check_component_content;
                } else {
                    $component_content = HomeComponentTopBrands::where('home_component_auto_id', $component_id)->whereNull('deleted_at')->get();
                    foreach ($check_component_content as $cc) {
                        $brand_auto_ids = $cc->brand_auto_id;
                        $brand_ids = explode('|', $brand_auto_ids);
                        unset($get_lists);
                        foreach ($brand_ids as $b) {



                            $lists = Brand::where('_id', $b)->whereNull('deleted_at')->get();

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
            $i++;
        }

        //  return $get_lists;

        return view('templates.SuperAdmin.admin_screen')->with(['homecomponent' => $get_home_component_details, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'main_cat_style' => $main_category_display_style]);
    }
    //product list
    public function product_lists($main, $id, Request $request)
    {
        $admin = Admin::where("subdomain", "=", $main)->first();

        if (empty($admin)) {
            abort(404);
        } else {
            $admin_id = $admin->id;
        }
        $uid = Session::get('AccessTokens');
        $get_main_categories = Categories::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }

        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $get_contact_details = ContactDetails::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $product_details = AdminProducts::where('main_category_auto_id', '=', $id)->orwhere('sub_category_auto_id', '=', $id)->orwhere('brand_auto_id', '=', $id)->where("admin_auto_id", "=", $admin_id)->whereNull('deleted_at')->get();
        $get_prod_ids = AdminProducts::where('main_category_auto_id', '=', $id)->orwhere('sub_category_auto_id', '=', $id)->orwhere('brand_auto_id', '=', $id)->where("admin_auto_id", "=", $admin_id)->whereNull('deleted_at')->pluck("_id")->toArray();
        $pimages_lists = AdminProductImages::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $brand_lists = Brand::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();


        $admin_country = $admin->country_code;
        $ip =  $request->getClientIp();

        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip
        ));

        $userCountry =  $ipdat->geoplugin_countryName ?? "India";

        $userCurrency = $ipdat->geoplugin_currencyCode ?? "INR";

        $currencies = Currency::where("admin_auto_id", "=", $admin->id)->where("country_name", $userCountry)->first();

        if (!empty($currencies)) {
            $pc = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                ->where("currency_auto_id", $currencies->id)
                ->whereIn("product_auto_id", $get_prod_ids)
                ->count();

            if ($pc < 1) {
                $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                    ->where("country_code", $admin_country)
                    ->where("admin_auto_id", "=", $admin->id)->first();
            }
        } else {
            $currencies = Currency::where("admin_auto_id", "=", $admin->id)->where("country_code", $admin_country)->first();
        }
        if ($currencies) {

            $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
            ->where("currency_auto_id", $currencies->id)
            ->orderBy('_id', 'DESC')
            ->get();

            if ($price_lists->isNotEmpty()) {
                foreach ($price_lists as $pl) {
                    $pl["currency"] = $currencies->currency;
                }
            }
            // $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
            $color_lists = ColorsRange::whereNull('deleted_at')->get();
            $sizelists =  SizeLists::whereNull('deleted_at')->get();
            if (isset($uid)) {
                $wproducts = WishlistProducts::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();
            } else {
                $wproducts = array();
            }
            $discount_lists = DiscountRange::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();

            //rating review
            if ($product_details->isNotEmpty()) {
                foreach ($product_details as $main) {
                    $product_auto_id = $main->_id;
                    $product_auto_ids = $main->product_auto_id;

                    $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->get();
                    $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->count();
                    $avg_rating = 0;
                    if ($courseRatingReview->isNotEmpty()) {
                        foreach ($courseRatingReview as  $data) {
                            $total_rating = $data->rating;

                            $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                            $avg_rating = ($total_student * $total_rating / $total_student);
                        }
                    } else {
                        $courseRatingReview = array();
                    }
                }
            } else {
                $avg_rating = 0;
                $courseRatingReviewCount = 0;
            }
            $country_user = UserRegister::where('_id', '=', $uid)->whereNull('deleted_at')->get();
            if ($country_user->isNotEmpty()) {
                foreach ($country_user as $cuid) {
                    $country_code = $cuid->country_code;
                }
            } else {
                $country_code = 'IN-91';
            }
            $currency_user = Currency::where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
            if ($currency_user->isNotEmpty()) {
                foreach ($currency_user as $cuid) {
                    $country_code_id = $cuid->id;
                    $currency = $cuid->currency;
                }
            } else {
                $country_code_id = '';
                $currency = '';
            }
            $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', '630df93c1d849e4ebe3a0ec3')
            ->orderBy('_id', 'DESC')
            ->whereNull('deleted_at')
            ->get();


            //    return $product_details;
            if (empty($product_details)) {
                return view('templates.frontend.product_list')->with("Not Available any data");
            } else {
                return view('templates.frontend.product_list')->with([
                    'category_id' => $id, 'pimages_lists' => $pimages_lists,
                    'currency_price_details' => $currency_price_details, 'contact_details' => $get_contact_details,
                    'business_details' => $get_business_details, 'product_lists' => $product_details, 'brand_lists' => $brand_lists,
                    'price_lists' => $price_lists, 'wproducts' => $wproducts,
                    'color_lists' => $color_lists,
                    'discount_lists' => $discount_lists, 'main_cat_style' => $main_category_display_style,
                    'main_category' => $get_main_categories, 'rating' => $avg_rating,
                    'total_rating_count' => $courseRatingReviewCount, 'get_slists' => $sizelists
                ]);
            }
        } else {

            return redirect("product-list/$id")->with('error', 'No data available');
        }
    }
    public function pincode_availability(Request $request)
    {
        $usermedicaldetails = Pincode::where('pincode', '=', $request->input('pincode'))->whereNull('deleted_at')->get();
        $id = $request->id;
        if ($usermedicaldetails->isNotEmpty()) {
            return redirect("product-detail/$id")->with('success', 'Delivery Available');
        } else {
            return redirect("product-detail/$id")->with('error', 'Sorry, currently we do not deliver at this location.');
        }
    }
    public function product_details($id, Request $request)
    {
        $subdomain = session("main");
        $admin =  Admin::where("subdomain", "=", $subdomain)->first();
        if (empty($admin)) {
            abort(404);
        }

        if (empty($admin)) {
            abort(404);
        }

        $uid = Session::get('AccessTokens');
        if (isset($uid)) {
            $wproducts = WishlistProducts::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();
        } else {
            $wproducts = array();
        }
        $get_main_categories = Categories::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }
        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $get_contact_details = ContactDetails::whereNull('deleted_at')->get();
        $product_details = AdminProducts::where('_id', '=', $id)->orwhere('product_auto_id', '=', $id)->first();
        $pimages_lists = AdminProductImages::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $brand_lists = Brand::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $admin_country = $admin->country_code;
        $ip =  $request->getClientIp();

        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip
        ));

        $userCountry =  $ipdat->geoplugin_countryName ?? "India";

        $userCurrency = $ipdat->geoplugin_currencyCode ?? "INR";

        $currencies = Currency::where("admin_auto_id", "=", $admin->id)
            ->where("country_name", $userCountry)
            ->where("admin_auto_id", "=", $admin->id)->first();

        if (!empty($currencies)) {
            $pc = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                ->where("currency_auto_id", $currencies->id)
                ->where("product_auto_id", $product_details->id)
                ->count();

            if ($pc < 1) {
                $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                    ->where("country_code", $admin_country)
                    ->where("admin_auto_id", "=", $admin->id)->first();
            }
        } else {
            $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                ->where("country_code", $admin_country)
                ->where("admin_auto_id", "=", $admin->id)->first();
        }


        $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
            ->where("currency_auto_id", $currencies->id)
            ->orderBy('_id', 'DESC')
            ->whereNull('deleted_at')
            ->get();
            
        if ($price_lists->isNotEmpty()) {
            foreach ($price_lists as $pl) {
                $pl["currency"] = $currencies->currency;
            }
        }
        $color_lists = ColorsRange::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $discount_lists = DiscountRange::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        //rating review
        $product_detailss = AdminProducts::where('_id', '=', $id)->orwhere('product_auto_id', '=', $id)->whereNull('deleted_at')->get();


        if ($product_detailss) {
            foreach ($product_detailss as $urs) {
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
                unset($get_sponcerproducts);
                $similarproducts = AdminProducts::where('main_category_auto_id', '=', $urs->main_category_auto_id)->orwhere('sub_category_auto_id', '=', $urs->sub_category_auto_id)->where('_id', '!=', $urs->_id)->orwhere('product_auto_id', '!=', $urs->product_auto_id)->whereNull('deleted_at')->get();
                if ($similarproducts->isNotEmpty()) {
                    foreach ($similarproducts as $sprds) {
                        $ssplist = AdminProductImages::where('product_auto_id', '=', $sprds->_id)->orwhere('product_auto_id', '=', $sprds->product_auto_id)->whereNull('deleted_at')->get();
                        if ($ssplist->isNotEmpty()) {
                            foreach ($ssplist as $spubs) {
                                $sproduct_image = $spubs->image_file;
                            }
                        }
                        $product_auto_id = $sprds->_id;
                        $product_auto_ids = $sprds->product_auto_id;

                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->count();
                        $avg_rating = 0;
                        if ($courseRatingReview->isNotEmpty()) {
                            foreach ($courseRatingReview as  $data) {
                                $total_rating = $data->rating;

                                $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                                $avg_rating = ($total_student * $total_rating / $total_student);
                            }
                        } else {
                            $courseRatingReview = 0;
                        }
                        $get_sponcerproducts[] = array(
                            "product_auto_id" => $product_auto_id, "product_image" => $sproduct_image, "product_name" => $sprds->product_name,
                            "product_price" => $sprds->product_price, "offer_percentage" => $sprds->offer_percentage, "new_arrival" => $sprds->new_arrival,
                            "avg_rating" => $avg_rating, "total_rating_count" => $courseRatingReviewCount
                        );
                    }
                } else {
                    $get_sponcerproducts = array();
                }


                unset($get_cproducts);

                $colorproducts = AdminProducts::where('product_model_auto_id', '=', $urs->product_model_auto_id)->whereNull('deleted_at')->get();
                if ($colorproducts->isNotEmpty()) {
                    foreach ($colorproducts as $color) {
                        $cplist = AdminProductImages::where('product_auto_id', '=', $color->_id)->orwhere('product_auto_id', '=', $color->product_auto_id)->whereNull('deleted_at')->get();
                        if ($cplist->isNotEmpty()) {
                            foreach ($cplist as $subs) {
                                $color_image = $subs->image_file;
                            }
                        }
                        $get_cproducts[] = array("color_image" => $color_image, "color_name" => $color->color_name, "product_auto_id" => $color->_id);
                    }
                } else {
                    $get_cproducts = array();
                }



                $size_ids = explode('|', $urs->size);
                unset($get_slists);
                if ($size_ids != "") {
                    foreach ($size_ids as $sz) {
                        $sizelist = SizeLists::where('_id', '=', $sz)->whereNull('deleted_at')->get();
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
                $offer_percentage = $urs->offer_percentage;
                unset($get_plists);
                $prepration_ids = explode('|', $urs->size_price);
                if (!empty($urs->size_price)) {
                    foreach ($prepration_ids as $data1) {



                        $offer_price = ($data1 * $offer_percentage) / 100;
                        $final_price = $data1 - $offer_price;
                        $get_plists[] = array("size_price" => $data1, "offer_percentage" => $offer_percentage, "final_size_price" => strval($final_price));
                    }
                } else {
                    $get_plists = array();
                }
            }
        } else {
            $get_slists = array();
        }
        //rating review


        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $id)->whereNull('deleted_at')->get();
        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $id)->whereNull('deleted_at')->count();
        $avg_rating = 0;
        if ($courseRatingReview->isNotEmpty()) {
            foreach ($courseRatingReview as  $data) {
                $total_rating = $data->rating;
                $review = $data->review;
                $review_image = $data->review_image;

                $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                $avg_rating = ($total_student * $total_rating / $total_student);
                $get_lists[] = array("rating" => $data->rating, "review" => $data->review, "review_image" => $data->review_image, "rdate" => $data->rdate, "name" => $data->name);
            }
        } else {
            $courseRatingReview = 0;
            $get_lists = array();
        }
        $country_user = UserRegister::where('_id', '=', $uid)->whereNull('deleted_at')->get();
        if ($country_user->isNotEmpty()) {
            foreach ($country_user as $cuid) {
                $country_code = $cuid->country_code;
            }
        } else {
            $country_code = 'IN-91';
        }
        $currency_user = Currency::where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
        if ($currency_user->isNotEmpty()) {
            foreach ($currency_user as $cuid) {
                $country_code_id = $cuid->id;
                $currency = $cuid->currency;
            }
        } else {
            $country_code_id = '';
            $currency = '';
        }
        $currency_price_detailss = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)->whereNull('deleted_at')->get();
        $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)
        ->where('product_auto_id', '=', $id)
        ->orderBy('_id', 'DESC')
        ->whereNull('deleted_at')->get();

        if ($currency_price_details->isNotEmpty()) {
            foreach ($currency_price_details as $cuids) {
                $product_price = $cuids->product_price;
                $offer_percentage = $cuids->offer_percentage;
                $size_price = $cuids->size_price;
                $including_tax = $cuids->including_tax;
                $tax_percentage = $cuids->tax_percentage;
                $final_pprices = $cuids->final_price;
                $offer_auto_id = $cuids->offer_auto_id;
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
            $offerlist = OfferComponent::where('_id', '=', $offer)->whereNull('deleted_at')->get();
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

        //     return $product_details;
        if (empty($product_details)) {
            return view('templates.frontend.product_detail')->with("Not Available any data");
        } else {
            return view('templates.frontend.product_detail')->with(['product_details' => $product_details, 'contact_details' => $get_contact_details, "wproducts" => $wproducts, 'get_specification_details' => $get_specification_details, 'currency_price_details' => $currency_price_details, 'currency_price_detailss' => $currency_price_detailss, 'business_details' => $get_business_details, 'get_sponcerproducts' => $get_sponcerproducts, 'get_plists' => $get_plists, 'get_cproducts' => $get_cproducts, 'get_slists' => $get_slists, 'product_rating' => $get_lists, 'avg_rating' => $avg_rating, 'total_rating_count' => $courseRatingReviewCount, 'pimages_lists' => $pimages_lists, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists, 'color_lists' => $color_lists, 'discount_lists' => $discount_lists, 'main_cat_style' => $main_category_display_style, 'main_category' => $get_main_categories]);
        }
    }


    public function promocode_list($main, Request $request)
    {
        $get_main_categories = Categories::whereNull("deleted_at")->where("admin_auto_id", $this->get_admin())->get();
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
        $get_business_details = BusinessDetails::whereNull("deleted_at")->where("admin_auto_id", $this->get_admin())->get();
        $get_contact_details = ContactDetails::whereNull("deleted_at")->where("admin_auto_id", $this->get_admin())->get();
        $ccode = CouponCode::whereNull("deleted_at")->where("admin_auto_id", $this->get_admin())->get();
        if ($ccode->isNotEmpty()) {
            return view('templates.frontend.couponcode_list')->with(['promocode_lists' => $ccode, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_cat_style' => $main_category_display_style, 'main_category' => $get_main_categories]);
        } else {
            return Redirect::back()->with('error', 'Sorry, No Data Available.');
        }
    }


    public function promocode_apply($main, Request $request)
    {
        $coupen_code_value = '0';
        $valid_promo = false;
        $ccode = CouponCode::where("_id", $request->coupon_id)->whereNull("deleted_at")->where("admin_auto_id", $this->get_admin())->get();

        if ($ccode) {
            foreach ($ccode as $cuid) {
                if ($request->promocode == $cuid->coupen_code && strtotime(date('Y-m-d')) < strtotime($cuid->end_date)) {
                    $coupen_code_value = $cuid->coupen_code_value;
                    $valid_promo = true;
                    break;
                } else {
                    $valid_promo = false;
                }
            }
            if ($valid_promo) {
                return redirect(session('main') . '/cart')->with(['promocode' => $coupen_code_value, 'promo_success' => 1]);
            } else {
                return redirect(session('main') . '/cart')->with(['promocode' => $coupen_code_value, 'success' => 0, "promo_error" => 'Invalid or expired coupon']);
            }
        } else {

            $coupen_code_value = '0';
            return redirect(session('main') . '/cart')->with(['promocode' => $coupen_code_value, 'success' => 0]);
        }
    }
    //product list
    public function wishlist_products()
    {
        $get_main_categories = Categories::whereNull("deleted_at")->where("admin_auto_id", $this->get_admin())->get();
        $i = 0;
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }

        $data = array();

        $j = 0;
        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $checkproduct = WishlistProducts::where('user_auto_id', Session::get('AccessTokens'))->whereNull('deleted_at')->get();
        if ($checkproduct->isNotEmpty()) {
            foreach ($checkproduct as $wprds) {
                $product_details = AdminProducts::where('_id', '=', $wprds->product_auto_id)->orwhere('product_auto_id', '=', $wprds->product_auto_id)->whereNull('deleted_at')->get();
                $pimages_lists = AdminProductImages::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->get();

                $brand_lists = Brand::whereNull('deleted_at')->get();
                $price_lists = PriceRange::whereNull('deleted_at')->get();
                $color_lists = ColorsRange::whereNull('deleted_at')->get();
                $discount_lists = DiscountRange::whereNull('deleted_at')->get();

                //rating review
                if ($product_details->isNotEmpty()) {
                    foreach ($product_details as $main) {
                        $product_auto_id = $main->_id;
                        $product_auto_ids = $main->product_auto_id;

                        $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->get();
                        $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->count();
                        $avg_rating = 0;
                        if ($courseRatingReview->isNotEmpty()) {
                            foreach ($courseRatingReview as  $data) {
                                $total_rating = $data->rating;

                                $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                                $avg_rating = ($total_student * $total_rating / $total_student);
                            }
                        } else {
                            $courseRatingReview = array();
                        }
                    }
                } else {
                    $avg_rating = 0;
                    $courseRatingReviewCount = 0;
                }


                $data[$j]['product_lists'] = $product_details;
                $data[$j]['rating'] = $avg_rating;
                $data[$j]['total_rating_count'] = $courseRatingReviewCount;

                $j++;
            }

            $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', '630df93c1d849e4ebe3a0ec3')->whereNull('deleted_at')->get();
            //    return $product_details;
            if (empty($product_details)) {
                return view('templates.frontend.wishlist_product')->with(['main_cat_style' => $main_category_display_style, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'data' => $data,]);
            } else {
                return view('templates.frontend.wishlist_product')->with([
                    'data' => $data, 'pimages_lists' => $pimages_lists, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists, 'currency_price_details' => $currency_price_details,
                    'color_lists' => $color_lists, 'discount_lists' => $discount_lists, 'main_cat_style' => $main_category_display_style, 'business_details' => $get_business_details, 'main_category' => $get_main_categories,
                ]);
            }
        } else {
            return view('templates.frontend.wishlist_product')->with(['main_cat_style' => $main_category_display_style, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'data' => $data,]);
        }
    }
    public function filter_products($main, Request $request)
    {
        $admin =  Admin::where("subdomain", "=", session("main"))->first();

        $uid = Session::get('AccessTokens');
        $get_main_categories = Categories::where("admin_auto_id", $admin->id)->get();
        $i = 0;

        if (isset($uid)) {
            $wproducts = WishlistProducts::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();
        } else {
            $wproducts = array();
        }
        foreach ($get_main_categories as $main) {
            $main_id = $main->id;
            $get_sub_categories = Subcategories::where('main_category_auto_id', $main_id)->whereNull('deleted_at')->get();
            $get_main_categories[$i]['subcategories'] = $get_sub_categories;

            $i++;
        }
        $get_maincategory_style = CategoryStyle::ORDERBY('_id', 'DESC')->first();
        if (!empty($get_maincategory_style)) {
            $main_category_display_style = $get_maincategory_style->web_icon_style;
        } else {
            $main_category_display_style = "0";
        }

        $get_business_details = BusinessDetails::whereNull('deleted_at')->get();
        $get_contact_details = ContactDetails::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $within_price_range = array();
        $prods = array();
        $discounts = array();
        $admin_country = $admin->country_code;
        $ip =  $request->getClientIp();

        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip
        ));

        $userCountry =  $ipdat->geoplugin_countryName ?? "India";

        $userCurrency = $ipdat->geoplugin_currencyCode ?? "INR";

        $currencies = Currency::where("admin_auto_id", "=", $admin->id)
            ->where("country_name", $userCountry)
            ->where("admin_auto_id", "=", $admin->id)->first();

        if (!empty($currencies)) {
            $pc = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                ->where("currency_auto_id", $currencies->id)
                ->count();

            if ($pc < 1) {
                $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                    ->where("country_code", $admin_country)
                    ->where("admin_auto_id", "=", $admin->id)->first();
            }
        } else {
            $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                ->where("country_code", $admin_country)
                ->where("admin_auto_id", "=", $admin->id)->first();
        }


        $prices = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
            ->where("currency_auto_id", $currencies->id)
            ->get();
        if ($prices->isNotEmpty()) {
            foreach ($prices as $pl) {
                $pl["currency"] = $currencies->currency;
            }
        }
        // $prices = CountryProductPrice::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        if (isset($request->price)) {
            if ($request->price == 1) {


                $min = $request->min_price;
                $max = $request->max_price;

                foreach ($prices as $price) {
                    if ($price['final_price'] >= $min && $price['final_price'] <= $max) {
                        array_push($within_price_range, $price["product_auto_id"]);
                    }
                }
            } else {
                $within_price_range = array();
            }
        }


        if (count($within_price_range) > 0) {
            $ranged = AdminProducts::whereIn("_id", $within_price_range)->where('sub_category_auto_id', '=', "$request->category_id")->whereNull('deleted_at')->get();

            foreach ($ranged as $range) {
                array_push($prods, $range);
            }
        }

        if (isset($request->discount)) {


            foreach ($prices as $price) {
                foreach ($request->discount as $discount) {
                    if ($discount >=  $price['offer_percentage']) {
                        array_push($discounts, $price["product_auto_id"]);
                    }
                }
            }
        }

        if (count($discounts) > 0) {


            $discounted = AdminProducts::whereIn("_id", $discounts)->where('sub_category_auto_id', '=', "$request->category_id")->whereNull('deleted_at')->get();
            foreach ($discounted as $disc) {
                array_push($prods, $disc);
            }
        }


        if (isset($request->brand)) {
            $brands = AdminProducts::whereIn("brand_auto_id", $request->brand)->where('sub_category_auto_id', '=', "$request->category_id")->whereNull('deleted_at')->get();

            foreach ($brands as $brand) {
                array_push($prods, $brand);
            }
        }

        if (isset($request->color)) {
            $colors = AdminProducts::whereIn("color_name", $request->color)->where('sub_category_auto_id', '=', "$request->category_id")->whereNull('deleted_at')->get();

            foreach ($colors as $color) {
                array_push($prods, $color);
            }
        }

        $prods = array_unique($prods);
        $pimages_lists = AdminProductImages::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $brand_lists = Brand::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $price_lists = PriceRange::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $color_lists = ColorsRange::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $sizelists = SizeLists::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
        $discount_lists = DiscountRange::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();

        //rating review
        if (!empty($prods)) {
            foreach ($prods as $main) {
                $product_auto_id = $main->_id;
                $product_auto_ids = $main->product_auto_id;

                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->whereNull('deleted_at')->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->whereNull('deleted_at')->count();


                        $avg_rating = ($total_student * $total_rating / $total_student);
                    }
                } else {
                    $courseRatingReview = array();
                }
            }
        } else {
            $avg_rating = 0;
            $courseRatingReviewCount = 0;
        }
        $country_user = UserRegister::where('_id', '=', $uid)->whereNull('deleted_at')->get();
        if ($country_user->isNotEmpty()) {
            foreach ($country_user as $cuid) {
                $country_code = $cuid->country_code;
            }
        } else {

            $country_code = 'IN-91';
        }
        $currency_user = Currency::where('country_code', '=', $country_code)->whereNull('deleted_at')->get();
        if ($currency_user->isNotEmpty()) {
            foreach ($currency_user as $cuid) {
                $country_code_id = $cuid->id;
                $currency = $cuid->currency;
            }
        } else {
            $country_code_id = '';
            $currency = '';
        }
        $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', '630df93c1d849e4ebe3a0ec3')->whereNull('deleted_at')->get();


        if (empty($prods)) {

            return view('templates.frontend.filtered')->with([
                'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories,
                'product_lists' => $prods, 'error' => 'No product of that brand'
            ]);
        } else {
            //   return view('templates.frontend.filtered')->with([
            //       'product_lists'=> $prods
            //       ]);
            return view('templates.frontend.filtered')->with([
                'pimages_lists' => $pimages_lists, 'contact_details' => $get_contact_details,
                'currency_price_details' => $currency_price_details, 'product_lists' => $prods, 'brand_lists' => $brand_lists, 'price_lists' => $prices,
                'color_lists' => $color_lists, 'discount_lists' => $discount_lists,
                'main_cat_style' => $main_category_display_style, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'rating' => $avg_rating, 'total_rating_count' => $courseRatingReviewCount,
                'error' => 'Array not empty but products not showing', 'get_slists' => $sizelists, 'wproducts' => $wproducts
            ]);
        }
    }
    public function sort_products(Request $request)
    {
        $admin =  Admin::where("subdomain", "=", session("main"))->first();


        $uid = Session::get('AccessTokens');
        if (isset($uid)) {
            $wproducts = WishlistProducts::where('user_auto_id', '=', $uid)->whereNull('deleted_at')->get();
        } else {
            $wproducts = array();
        }
        $products = array();
        $collection = collect(
            $request->products
        );

        if ($request->sort == "low_price") {
            $sorted =  $collection->sortBy('final_price');
        } else if ($request->sort == "high_price") {
            $sorted = $collection->sortByDesc('final_price');
        } else if ($request->sort == "new") {
            $sorted =  $collection->sortBy('new_arrival');
        }
        $pimages_lists = AdminProductImages::whereNull('deleted_at')->get();
        $get_contact_details = ContactDetails::whereNull('deleted_at')->get();
        $brand_lists = Brand::whereNull('deleted_at')->get();
        $admin_country = $admin->country_code;
        $ip =  $request->getClientIp();

        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip
        ));

        $userCountry =  $ipdat->geoplugin_countryName ?? "India";

        $userCurrency = $ipdat->geoplugin_currencyCode ?? "INR";

        $currencies = Currency::where("admin_auto_id", "=", $admin->id)
            ->where("country_name", $userCountry)
            ->where("admin_auto_id", "=", $admin->id)->first();

        if (!empty($currencies)) {
            $pc = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
                ->where("currency_auto_id", $currencies->id)
                ->count();

            if ($pc < 1) {
                $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                    ->where("country_code", $admin_country)
                    ->where("admin_auto_id", "=", $admin->id)->first();
            }
        } else {
            $currencies = Currency::where("admin_auto_id", "=", $admin->id)
                ->where("country_code", $admin_country)
                ->where("admin_auto_id", "=", $admin->id)->first();
        }


        $price_lists = CountryProductPrice::where("admin_auto_id", "=", $admin->id)
            ->where("currency_auto_id", $currencies->id)
            ->get();
        if ($price_lists->isNotEmpty()) {
            foreach ($price_lists as $pl) {
                $pl["currency"] = $currencies->currency;
            }
        }
        $color_lists = ColorsRange::whereNull('deleted_at')->get();
        $sizelists = SizeLists::whereNull('deleted_at')->get();

        $discount_lists = DiscountRange::whereNull('deleted_at')->get();
        $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', '630df93c1d849e4ebe3a0ec3')->whereNull('deleted_at')->get();
        $products = $sorted->values()->all();

        return view("templates.frontend.sorted")->with([
            'pimages_lists' => $pimages_lists, 'contact_details' => $get_contact_details, 'currency_price_details' => $currency_price_details,
            'sorted' => $products, 'rating' => 0, 'total_rating_count' => 0, 'wproducts' => $wproducts, "price_lists" => $price_lists
        ]);
    }
}