<?php

namespace App\Http\Controllers\Admin;

use DB;
use DateTime;
use App\Admin;
use App\Brand;
use App\BuyNow;
use App\Pincode;
use App\Currency;
use App\Products;
use DateTimeZone;
use App\Categories;
use App\CouponCode;
use App\PriceRange;
use App\ColorsRange;
use App\UserRegister;
use App\AdminProducts;
use App\CategoryStyle;
use App\DiscountRange;
use App\Subcategories;
use App\ContactDetails;
use App\BusinessDetails;
use App\CartUserAddress;
use App\AdminProductImages;
use App\CountryProductPrice;
use App\ProductRatingReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = AdminProducts::all();
        return view('product_list', compact('products'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart($main)
    {
        $admin = Admin::where("subdomain", $main)->first();
        if (empty($admin)) {
            abort(404);
        }
        $uid = Session::get('AccessTokens');

        $get_main_categories = Categories::where("admin_auto_id", $admin->id)->get();
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

        $get_business_details = BusinessDetails::where("admin_auto_id", "=", $admin->id)->get();
        $get_contact_details = ContactDetails::where("admin_auto_id", "=", $admin->id)->get();
        $product_details = AdminProducts::get()->random(4);
        $pimages_lists = AdminProductImages::where("admin_auto_id", "=", $admin->id)->get();
        $brand_lists = Brand::where("admin_auto_id", "=", $admin->id)->get();
        $price_lists = PriceRange::where("admin_auto_id", "=", $admin->id)->get();
        $color_lists = ColorsRange::where("admin_auto_id", "=", $admin->id)->get();
        $discount_lists = DiscountRange::where("admin_auto_id", "=", $admin->id)->get();
        $user_address = CartUserAddress::where("admin_auto_id", "=", $admin->id)->get();
        $ccodes = CouponCode::where("admin_auto_id", "=", $admin->id)->get();
        //rating review
        if ($product_details->isNotEmpty()) {
            foreach ($product_details as $main) {
                $product_auto_id = $main->_id;
                $product_auto_ids = $main->product_auto_id;

                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->count();


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
        $country_user = UserRegister::where('_id', '=', $uid)->get();
        if ($country_user->isNotEmpty()) {
            foreach ($country_user as $cuid) {
                $country_code = $cuid->country_code;
                $user_auto_id = $cuid->_id;
            }
        } else {
            $country_code = 'IN-91';
            $user_auto_id = '';
        }
        $currency_user = Currency::where('country_code', '=', $country_code)->get();
        if ($currency_user->isNotEmpty()) {
            foreach ($currency_user as $cuid) {
                $country_code_id = $cuid->id;
                $currency = $cuid->currency;
            }
        } else {
            $country_code_id = '';
            $currency = '';
        }
        $address_user = CartUserAddress::where('user_auto_id', '=', $user_auto_id)->get();
        if ($address_user->isNotEmpty()) {
            foreach ($address_user as $address) {
                $pcode = $address->pincode;
            }
        } else {
            $pcode = '';
        }
        $pincode = Pincode::where('pincode', '=', $pcode)->limit(1)->get();
        $ccode = CouponCode::get();
        if ($ccode->isNotEmpty()) {
            foreach ($ccode as $cuid) {
                $coupen_code_value = $cuid->coupen_code_value;
            }
        } else {
            $coupen_code_value = "0";
        }
        $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)->get();
        return view('templates.frontend.cart_details')->with([
            'pimages_lists' => $pimages_lists, 'promocodes' => $coupen_code_value, 'pincodes' => $pincode, 'user_address' => $user_address, 'currency_price_details' => $currency_price_details, 'product_lists' => $product_details, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists,
            'color_lists' => $color_lists, 'discount_lists' => $discount_lists,
            'main_cat_style' => $main_category_display_style,
            'contact_details' => $get_contact_details, 'contact_details' => $get_contact_details,
            'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'rating' => $avg_rating,
            'total_rating_count' => $courseRatingReviewCount, 'coupons' => $ccodes
        ]);
    }

    /**
     * Write code on Method
     *
    //  * @return response()
     */
    public function addToCart($size)
    {
        if (str_contains($size, "&")) {
            $received = explode("&", $size);
            $id = $received[0];
            $size = $received[1];
        } else {
            $id = $size;
            $size = "";
        }

        $product = AdminProducts::findOrFail($id);
        $productimage = AdminProductImages::where('product_auto_id', $id)->limit(1)->get();
        if ($productimage->isNotEmpty()) {
            foreach ($productimage as $img) {
                $image_file = $img->image_file;
            }
        } else {
            $image_file = '';
        }
        $productprice = CountryProductPrice::where('product_auto_id', $id)->get();
        if ($productprice->isNotEmpty()) {
            foreach ($productprice as $price) {
                $final_price = $price->final_price;
                $mrp = $price->product_price;
                $offer = $price->offer_percentage;
            }
        } else {
            $final_price = 0;
            $mrp = 0;
            $offer  = 0;
        }
        $cart = Session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['size'] != $size) {
                $cart[$id]['quantity']++;
                $cart[$id]['size'] .= "," . $size;
            } else {
                $cart[$id]['quantity']++;
            }
        } else {
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $final_price,
                "image" => $image_file,
                "size" => $size,
                "mrp" => $mrp,
                "offer" => $offer
            ];
        }

        Session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function addToCart_buynow($size)
    {
       if (str_contains($size, "&")) {
            $received = explode("&", $size);
            $id = $received[0];
            $size = $received[1];
        } else {
            $id = $size;
            $size = "";
        }

        $product = AdminProducts::findOrFail($id);
        $productimage = AdminProductImages::where('product_auto_id', $id)->limit(1)->get();
        if ($productimage->isNotEmpty()) {
            foreach ($productimage as $img) {
                $image_file = $img->image_file;
            }
        } else {
            $image_file = '';
        }
        $productprice = CountryProductPrice::where('product_auto_id', $id)->get();
        if ($productprice->isNotEmpty()) {
            foreach ($productprice as $price) {
                $final_price = $price->final_price;
                $mrp = $price->product_price;
                $offer = $price->offer_percentage;
            }
        } else {
            $final_price = 0;
            $mrp = 0;
            $offer  = 0;
        }
        $cart = Session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['size'] != $size) {
                $cart[$id]['quantity']++;
                $cart[$id]['size'] .= "," . $size;
            } else {
                $cart[$id]['quantity']++;
            }
        } else {
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $final_price,
                "image" => $image_file,
                "size" => $size,
                "mrp" => $mrp,
                "offer" => $offer
            ];
        }

        Session()->put('cart', $cart);

        return redirect(Session::get('main'). '/cart');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity !== null) {
            $cart = Session()->get('cart');

            if ($request->quantity == '0') {
                if (isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    Session()->put('cart', $cart);
                }
                Session()->flash('remove_sucess', 'Product removed successfully');
            } else {
                $cart[$request->id]["quantity"] = $request->quantity;
                Session()->put('cart', $cart);
                Session()->flash('success', 'Cart updated successfully');
            }

            return response()->json(['status' => 'success']); // Return a response to ensure the frontend gets a success message
        }
        return response()->json(['status' => 'error'], 400); // Return an error response if necessary
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = Session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session()->put('cart', $cart);
            }
            Session()->flash('remove_sucess', 'Product removed successfully');
        }
    }
    public function admin_addproduct(Request $request)
    {
        // echo 'hai';die;

        $product = new Products();
        $checkproduct = Products::where('product_name', $request->product_name)->first();
        if ($checkproduct) {
            echo '<script>alert("Product Already Exists!");</script>';
        } else {

            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');





            // $product->product_color = $request->get('product_color');


            //                          $this->validate(
            //      $request,
            //       [
            //          'cimage'   => 'required',
            //           'product_name' => 'required',
            //             'brand_name' => 'required',
            //             'product_unit' => 'required',
            //             'product_gross_weight' => 'required',
            //             'product_net_weight' => 'required',
            //             'product_gross_weight' => 'required',
            //             'product_net_weight' => 'required',

            //       ],
            //       [
            //          'cimage.required' => 'Choose Product image.',
            //          'cimage.image'   => 'Choose Product image.',
            //         'cimage.mimes'   => 'Image should be jpeg,png,jpg,gif or svg format only',
            //         'product_name.required' => 'Please enter plan name',
            //             'brand_name.required' => 'Please enter plan price',
            //             'offer_percentage.required' => 'Please enter offer percentage',
            //             'plan_duration.required' => 'Please enter plan duraton',
            //             'extra_duration.required' => 'Please enter extra duraton',
            //   ]


            //   );

            $input = $request->all();
            $images = array();
            if ($files = $request->file('cimage')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('images/products/', $name);
                    $images[] = $name;
                }
            }

            $imagesArray = $images;
            $saveimages = implode(",", $imagesArray);

            $colors = array();
            if ($files = $request->file('colourimage')) {
                foreach ($files as $file) {
                    $color_name = $file->getClientOriginalName();
                    $file->move('images/colors/', $color_name);
                    $colors[] = $color_name;
                }
            }
            $colorsArray = $colors;
            $savecolors = implode(",", $colorsArray);


            if (!empty($request->file('product_video'))) {
                $file = $request->file('product_video');
                $filename = $file->getClientOriginalName();
                $path = 'images/videos/';
                $file->move($path, $filename);
                $product->product_video = $filename;
            } else {
                $product->product_video = '';
            }

            // Save Product images as comma separated values



            // Save Product images as in different rows
            //      $emailArray = $images;
            //     $totalEmails = count($emailArray);
            //         for($i=0; $i<$totalEmails; $i++) {
            //         // $slider= new Slider();
            //           $product = new Products();
            //          $data = $emailArray[$i];
            //         $product->product_img=$data;

            //
            //
            // }





            $product->brand_name = $request->get('product_name');

            $product->brand_name = $request->get('brand_name');
            $product->product_unit = $request->get('product_unit');
            $product->gross_weight = $request->get('product_gross_weight');
            $product->net_weight = $request->get('product_net_weight');
            $product->product_quantity = $request->get('product_quantity');
            $product->price = $request->get('product_actual_price');
            $product->offer_price = $request->get('product_offer_price');
            $product->minimum_order_quantity = $request->get('product_moq');
            $product->maximum_order_quantity = $request->get('product_maxop');






            $product->product_size = $request->get('product_size');



            $product->product_description = $request->get('product_description');
            $product->product_colors = $savecolors;
            $product->product_img = $saveimages;

            $product->filters = $request->get('filter_name');
            $product->filters_options = $request->get('filter_name');

            $product->highlights_col1 = $request->get('highlight_col1');
            $product->highlight_col2 = $request->get('highlight_col2');




            $product->product_description == $request->get('pdesc');
            $product->register_date = date('Y-m-d');
            $product->added_by = "Admin";

            $offer_price = ($request->price * $request->offer_price) / 100;
            $final_price = $request->price - $offer_price;
            $product->final_price = strval($final_price);
            $product->save();
        }
    }


    //get product
    public function get_products()
    {
        $get_list = Products::get();

        if ($get_list->isNotEmpty()) {
            return response()->json(['status' => 1, "msg" => "success", 'get_products_lists' => $get_list]);
        } else {
            return response()->json(['status' => 0, "msg" => "No Data Available"]);
        }
    }

    //Delete component content
    public function delete_product(Request $request)
    {
        $tdetails = Products::where('_id', '=', $request->get('product_auto_id'))->delete();
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
    // Profile

    public function edit_product(Request $request)
    {

        $product = Products::find($request->get('product_auto_id'));

        if (empty($product)) {

            return response()->json(['status' => 0, "msg" => config('messages.empty')]);
        } else {

            return response()->json(['status' => 1, "product_details" => $product]);
        }
    }

    //update product

    public function update_product(Request $request)
    {
        $main = Products::find($request->get('product_auto_id'));
        if (empty($main)) {
            return response()->json(['status' => 0, "msg" => "No product Found"]);
        } else {
            $main->user_auto_id = $request->get('user_auto_id');

            $main->main_category_auto_id = $request->get('main_category_auto_id');

            $main->product_name = $request->get('product_name');
            if ($request->get('price') != '') {
                $main->price = $request->get('price');
            } else {
                $main->price = "";
            }
            if ($request->get('sub_category_auto_id') != '') {
                $main->sub_category_auto_id = $request->get('sub_category_auto_id');
            } else {
                $main->sub_category_auto_id = "";
            }
            if ($request->get('brand_name') != '') {
                $main->brand_name = $request->get('brand_name');
            } else {
                $main->brand_name = "";
            }
            if ($request->get('brand_auto_id') != '') {
                $main->brand_auto_id = $request->get('brand_auto_id');
            } else {
                $main->brand_auto_id = "";
            }
            if ($request->get('product_unit') != '') {
                $main->product_unit = $request->get('product_unit');
            } else {
                $main->product_unit = "";
            }
            if ($request->get('product_quantity') != '') {
                $main->product_quantity = $request->get('product_quantity');
            } else {
                $main->product_quantity = "";
            }
            if ($request->get('gross_weight') != '') {
                $main->gross_weight = $request->get('gross_weight');
            } else {
                $main->gross_weight = "";
            }
            if ($request->get('net_weight') != '') {
                $main->net_weight = $request->get('net_weight');
            } else {
                $main->net_weight = "";
            }
            if ($request->get('offer_price') != '') {
                $main->offer_price = $request->get('offer_price');
            } else {
                $main->offer_price = "";
            }
            if ($request->get('minimum_order_quantity') != '') {
                $main->minimum_order_quantity = $request->get('minimum_order_quantity');
            } else {
                $main->minimum_order_quantity = "";
            }
            if ($request->get('product_colors') != '') {
                $main->product_colors = $request->get('product_colors');
            } else {
                $main->product_colors = "";
            }
            if ($request->get('product_size') != '') {
                $main->product_size = $request->get('product_size');
            } else {
                $main->product_size = "";
            }
            if ($request->get('product_description') != '') {
                $main->product_description = $request->get('product_description');
            } else {
                $main->product_description = "";
            }
            if ($request->get('product_weight') != '') {
                $main->product_weight = $request->get('product_weight');
            } else {
                $main->product_weight = "";
            }
            if ($request->get('product_dimensions') != '') {
                $main->product_dimensions = $request->get('product_dimensions');
            } else {
                $main->product_dimensions = "";
            }
            if ($request->get('product_specification') != '') {
                $main->product_specification = $request->get('product_specification');
            } else {
                $main->product_specification = "";
            }

            if ($request->get('new_arrival') != '') {
                $main->new_arrival = $request->get('new_arrival');
            } else {
                $main->new_arrival = "";
            }
            if (!empty($request->file('product_img'))) {
                $file = $request->file('product_img');
                $filename = $file->getClientOriginalName();
                $path = 'images/products/';
                $file->move($path, $filename);
                $main->product_img = $filename;
            } else {
                $main->product_img = '';
            }
            $main->added_by = $request->get('added_by');
            $offer_price = ($request->price * $request->offer_price) / 100;
            $final_price = $request->price - $offer_price;
            $main->final_price = strval($final_price);

            $main->save();
            if ($main) {
                return response()->json([
                    'status' => "1",
                    'data' => $main

                ]);
            } else {
                return response()->json([
                    'status' => "0",
                    'data' => "No Data Available"

                ]);
            }
        }
    }
    // brand products
    public function get_Admin_Brand_Product(Request $request)
    {
        $pcat = Products::where('brand_auto_id', '=', $request->get('brand_id'))->get();
        if ($pcat->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {


            return response()->json([
                'status' => 1,
                'get_admin_brand_product_lists' => $pcat,
            ]);
        }
    }
    // category products
    public function get_Admin_MainCategory_Product(Request $request)
    {
        $pcatss = Products::where('main_category_auto_id', '=', $request->get('main_cat_id'))->get();
        if ($pcatss->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {


            return response()->json([
                'status' => 1,
                'get_admin_category_product_lists' => $pcatss,
            ]);
        }
    }
    // sub category products
    public function get_Admin_Subcategory_Product(Request $request)
    {
        $scats = Products::where('sub_category_auto_id', '=', $request->get('sub_cat_id'))->get();
        if ($scats->isEmpty()) {

            return response()->json([
                'status' => 0,
                "msg" => "No Data Available"
            ]);
        } else {


            return response()->json([
                'status' => 1,
                'get_admin_subcategory_product_lists' => $scats,
            ]);
        }
    }
    public function buy_now(Request $request)
    {

        $bnow = BuyNow::where('user_auto_id', '=', $request->get('user_auto_id'))->delete();


        $cprds = BuyNow::where('user_auto_id', $request->user_auto_id)->first();
        if ($cprds) {
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            $cprds->product_auto_id = $request->get('product_auto_id');
            $cprds->user_auto_id = $request->get('user_auto_id');
            if ($cprds->get('cart_quantity') != '') {
                $cprds->cart_quantity = $request->get('cart_quantity');
            } else {
                $cprds->cart_quantity = "";
            }
            if ($request->get('size') != '') {
                $cprds->size = $request->get('size');
            } else {
                $cprds->size = "";
            }
            $cprds->rdate = date('Y-m-d');
            $cprds->save();
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
            $product_details = AdminProducts::Where('product_auto_id', $request->get('product_auto_id'))->get();
            $pimages_lists = AdminProductImages::get();
            $brand_lists = Brand::get();
            $price_lists = PriceRange::get();
            $color_lists = ColorsRange::get();
            $discount_lists = DiscountRange::get();
            $user_address = CartUserAddress::get();

            //rating review
            if ($product_details->isNotEmpty()) {
                foreach ($product_details as $main) {
                    $product_auto_id = $main->_id;
                    $product_auto_ids = $main->product_auto_id;

                    $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->get();
                    $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->count();
                    $avg_rating = 0;
                    if ($courseRatingReview->isNotEmpty()) {
                        foreach ($courseRatingReview as  $data) {
                            $total_rating = $data->rating;

                            $total_student = UserRegister::Where('_id', $data->customer_auto_id)->count();


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
            $country_user = UserRegister::where('_id', '=', $request->get('user_auto_id'))->get();
            if ($country_user->isNotEmpty()) {
                foreach ($country_user as $cuid) {
                    $country_code = $cuid->country_code;
                    $user_auto_id = $cuid->_id;
                }
            } else {
                $country_code = 'IN-91';
                $user_auto_id = '';
            }
            $currency_user = Currency::where('country_code', '=', $country_code)->get();
            if ($currency_user->isNotEmpty()) {
                foreach ($currency_user as $cuid) {
                    $country_code_id = $cuid->id;
                    $currency = $cuid->currency;
                }
            } else {
                $country_code_id = '';
                $currency = '';
            }
            $address_user = CartUserAddress::where('user_auto_id', '=', $user_auto_id)->get();
            if ($address_user->isNotEmpty()) {
                foreach ($address_user as $address) {
                    $pcode = $address->pincode;
                }
            } else {
                $pcode = '';
            }
            $pincode = Pincode::where('pincode', '=', $pcode)->limit(1)->get();
            $ccode = CouponCode::where('coupen_code', '=', '1354')->get();
            if ($ccode->isNotEmpty()) {
                foreach ($ccode as $cuid) {
                    $coupen_code_value = $cuid->coupen_code_value;
                }
            } else {
                $coupen_code_value = "0";
            }
            $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)->get();
            return view('templates.frontend.shipping')->with([
                'pimages_lists' => $pimages_lists, 'promocodes' => $coupen_code_value, 'pincodes' => $pincode, 'user_address' => $user_address, 'currency_price_details' => $currency_price_details, 'product_lists' => $product_details, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists,
                'color_lists' => $color_lists, 'discount_lists' => $discount_lists, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'rating' => $avg_rating, 'total_rating_count' => $courseRatingReviewCount
            ]);
        } else {

            $buynow = new BuyNow();
            $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
            $rdate =  $date->format('Y-m-d');

            $buynow->product_auto_id = $request->get('product_auto_id');
            $buynow->user_auto_id = $request->get('user_auto_id');
            if ($request->get('cart_quantity') != '') {
                $buynow->cart_quantity = $request->get('cart_quantity');
            } else {
                $buynow->cart_quantity = "";
            }
            if ($request->get('size') != '') {
                $buynow->size = $request->get('size');
            } else {
                $buynow->size = "";
            }
            $buynow->rdate = date('Y-m-d');
            $buynow->save();
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
            $product_details = AdminProducts::Where('product_auto_id', $request->get('product_auto_id'))->get();
            $pimages_lists = AdminProductImages::get();
            $brand_lists = Brand::get();
            $price_lists = PriceRange::get();
            $color_lists = ColorsRange::get();
            $discount_lists = DiscountRange::get();
            $user_address = CartUserAddress::get();

            //rating review
            if ($product_details->isNotEmpty()) {
                foreach ($product_details as $main) {
                    $product_auto_id = $main->_id;
                    $product_auto_ids = $main->product_auto_id;

                    $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->get();
                    $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->count();
                    $avg_rating = 0;
                    if ($courseRatingReview->isNotEmpty()) {
                        foreach ($courseRatingReview as  $data) {
                            $total_rating = $data->rating;

                            $total_student = UserRegister::Where('_id', $data->customer_auto_id)->count();


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
            $country_user = UserRegister::where('_id', '=', $request->get('user_auto_id'))->get();
            if ($country_user->isNotEmpty()) {
                foreach ($country_user as $cuid) {
                    $country_code = $cuid->country_code;
                    $user_auto_id = $cuid->_id;
                }
            } else {
                $country_code = 'IN-91';
                $user_auto_id = '';
            }
            $currency_user = Currency::where('country_code', '=', $country_code)->get();
            if ($currency_user->isNotEmpty()) {
                foreach ($currency_user as $cuid) {
                    $country_code_id = $cuid->id;
                    $currency = $cuid->currency;
                }
            } else {
                $country_code_id = '';
                $currency = '';
            }
            $address_user = CartUserAddress::where('user_auto_id', '=', $user_auto_id)->get();
            if ($address_user->isNotEmpty()) {
                foreach ($address_user as $address) {
                    $pcode = $address->pincode;
                }
            } else {
                $pcode = '';
            }
            $pincode = Pincode::where('pincode', '=', $pcode)->limit(1)->get();
            $ccode = CouponCode::where('coupen_code', '=', '1354')->get();
            if ($ccode->isNotEmpty()) {
                foreach ($ccode as $cuid) {
                    $coupen_code_value = $cuid->coupen_code_value;
                }
            } else {
                $coupen_code_value = "0";
            }
            $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)->get();
            return view('templates.frontend.shipping')->with([
                'pimages_lists' => $pimages_lists, 'promocodes' => $coupen_code_value, 'pincodes' => $pincode, 'user_address' => $user_address, 'currency_price_details' => $currency_price_details, 'product_lists' => $product_details, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists,
                'color_lists' => $color_lists, 'discount_lists' => $discount_lists, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'rating' => $avg_rating, 'total_rating_count' => $courseRatingReviewCount
            ]);

            //  return redirect('shipping_details')->with('success', 'Successfully Added');

        }
    }
    public function delete_buy_now(Request $request)
    {
        $bnow = BuyNow::where('user_auto_id', '=', $request->get('user_auto_id'))->delete();
        if ($bnow) {
            return redirect('ecommerce');
        } else {

            return redirect('ecommerce');
        }
    }

    public function products()
    {
        $uid = Session::get('AccessTokens');
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



        return view('templates.frontend.products')->with(['main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories]);
    }
    public function buynow()
    {
        $uid = Session::get('AccessTokens');
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
        $product_details = AdminProducts::get()->random(4);
        $pimages_lists = AdminProductImages::get();
        $brand_lists = Brand::get();
        $price_lists = PriceRange::get();
        $color_lists = ColorsRange::get();
        $discount_lists = DiscountRange::get();
        $user_address = CartUserAddress::get();

        //rating review
        if ($product_details->isNotEmpty()) {
            foreach ($product_details as $main) {
                $product_auto_id = $main->_id;
                $product_auto_ids = $main->product_auto_id;

                $courseRatingReview = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->get();
                $courseRatingReviewCount = ProductRatingReview::Where('product_auto_id', $product_auto_id)->orwhere('product_auto_id', $product_auto_ids)->count();
                $avg_rating = 0;
                if ($courseRatingReview->isNotEmpty()) {
                    foreach ($courseRatingReview as  $data) {
                        $total_rating = $data->rating;

                        $total_student = UserRegister::Where('_id', $data->customer_auto_id)->count();


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
        $country_user = UserRegister::where('_id', '=', $uid)->get();
        if ($country_user->isNotEmpty()) {
            foreach ($country_user as $cuid) {
                $country_code = $cuid->country_code;
                $user_auto_id = $cuid->_id;
            }
        } else {
            $country_code = 'IN-91';
            $user_auto_id = '';
        }
        $currency_user = Currency::where('country_code', '=', $country_code)->get();
        if ($currency_user->isNotEmpty()) {
            foreach ($currency_user as $cuid) {
                $country_code_id = $cuid->id;
                $currency = $cuid->currency;
            }
        } else {
            $country_code_id = '';
            $currency = '';
        }
        $address_user = CartUserAddress::where('user_auto_id', '=', $user_auto_id)->get();
        if ($address_user->isNotEmpty()) {
            foreach ($address_user as $address) {
                $pcode = $address->pincode;
            }
        } else {
            $pcode = '';
        }
        $pincode = Pincode::where('pincode', '=', $pcode)->limit(1)->get();
        $ccode = CouponCode::where('coupen_code', '=', '1354')->get();
        if ($ccode->isNotEmpty()) {
            foreach ($ccode as $cuid) {
                $coupen_code_value = $cuid->coupen_code_value;
            }
        } else {
            $coupen_code_value = "0";
        }
        $currency_price_details = CountryProductPrice::where('currency_auto_id', '=', $country_code_id)->get();
        return view('templates.frontend.shipping')->with([
            'pimages_lists' => $pimages_lists, 'promocodes' => $coupen_code_value, 'pincodes' => $pincode, 'user_address' => $user_address, 'currency_price_details' => $currency_price_details, 'product_lists' => $product_details, 'brand_lists' => $brand_lists, 'price_lists' => $price_lists,
            'color_lists' => $color_lists, 'discount_lists' => $discount_lists, 'main_cat_style' => $main_category_display_style, 'contact_details' => $get_contact_details, 'contact_details' => $get_contact_details, 'business_details' => $get_business_details, 'main_category' => $get_main_categories, 'rating' => $avg_rating, 'total_rating_count' => $courseRatingReviewCount
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function addToCart_buynow($id)
    // {
    //     $product = AdminProducts::findOrFail($id);
    //     $productimage = AdminProductImages::where('product_auto_id', $id)->limit(1)->get();
    //     if ($productimage->isNotEmpty()) {
    //         foreach ($productimage as $img) {
    //             $image_file = $img->image_file;
    //         }
    //     } else {
    //         $image_file = '';
    //     }
    //     $productprice = CountryProductPrice::where('product_auto_id', $id)->get();
    //     if ($productprice->isNotEmpty()) {
    //         foreach ($productprice as $price) {
    //             $final_price = $price->final_price;
    //         }
    //     } else {
    //         $final_price = 0;
    //     }
    //     $buynow = Session()->get('buynow', []);

    //     if (isset($buynow[$id])) {
    //         $buynow[$id]['quantity']++;
    //     } else {
    //         $buynow[$id] = [
    //             "name" => $product->product_name,
    //             "quantity" => 1,
    //             "price" => $final_price,
    //             "image" => $image_file,
    //             "size" => $product->size
    //         ];
    //     }

    //     Session()->put('buynow', $buynow);
    //     return redirect('buynow');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update_buynow(Request $request)
    {
        if ($request->id && $request->quantity) {
            $buynow = Session()->get('buynow');
            $buynow[$request->id]["quantity"] = $request->quantity;
            Session()->put('buynow', $buynow);
            Session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove_buynow(Request $request)
    {
        if ($request->id) {
            $buynow = Session()->get('buynow');
            if (isset($buynow[$request->id])) {
                unset($buynow[$request->id]);
                Session()->put('buynow', $buynow);
            }
            Session()->flash('success', 'Product removed successfully');
        }
    }

    // public function update_data_temp(){
    //     $products = new AdminProducts();
    //     $products->updateOrInsert(["Manufacturers" =>"",
    //     "Material"=> "", "Width" =>"", "height"=> "", "depth" =>"", "Thickness" => "", "Firmness" => "", "Discount" => "", "Trial_Period" => "",
    //     "stock" => "", "available_stock" => "", "Stock_alert_limit" => ""]);

    //     echo "done";
    // }

    public function rate_product(Request $request)
    {
        if (Session::has("AccessTokens")) {
            if (!empty($request->review_image)) {

                Validator::validate($request, [
                    'review_image' => [
                        File::image(),
                    ],
                ]);
                $fileName = time() . '_' . $request->review_image->getClientOriginalName();
                $filePath = $request->review_image('file')->storeAs('uploads', $fileName, 'public');
            }
        } else {
            return redirect()->back()->with('login_error', 'You need to be logged in to access this feature');
        }
    }
}