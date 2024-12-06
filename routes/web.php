<?php

use App\Http\Controllers\Admin\Admin_loginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LegalController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchasedController;
use App\Http\Controllers\Admin\RazorpayController;
use App\Http\Controllers\Admin\UserAddressController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;





//E-Commerce User Screen
Route::get('/',function(){
	 return view('templates.frontend.login');
});
Route::get('privacy-playstore',function(){
	 return view('templates.frontend.privacy');
});

Route::get('/verify_number',function(){
    return view('templates.frontend.send_registration_otp');
});

Route::post('send_registration_otp', [UserController::class, 'send_registration_otp']);
Route::post('verify_registration_otp', [UserController::class, 'verify_registration_otp']);
Route::post('send_login_otp', [UserController::class, 'send_login_otp']);

Route::get('login', [UserController::class, 'login']);
Route::post('storelogin', [UserController::class, 'store_login']);
Route::get('registration', [UserController::class, 'register_user']);
Route::post('store-user', [UserController::class, 'store_user']);
Route::get('logout_user', [UserController::class, 'logout_user']);
Route::get('upload_documents', [UserController::class, 'upload_documents']);
Route::post('store_document', [UserController::class, 'store_document']);
Route::get('/home_user', [UserController::class, 'home_user']);
Route::get('/profile-user', [UserController::class, 'profile_user']);
Route::post('update-profile', [UserController::class, 'update_profile']);
Route::get('/forgot-password', [UserController::class, 'forgot_password']);
Route::post('update-forgot-password', [UserController::class, 'update_forgot_password']);


Route::get('my_orders', [PurchasedController::class, 'my_orders']);
Route::get('my_orders_details/{id}', [PurchasedController::class, 'my_orders_details']);
Route::post('cancel_my_orders', [PurchasedController::class, 'cancel_my_orders']);

Route::post('wishlist', [HomeController::class, 'wishlist']);
Route::get('wishlist_products', [HomeController::class, 'wishlist_products']);
Route::get('/{id}/ecommerce', [HomeController::class, 'index']);
Route::get('/{id}', [HomeController::class, 'index']);
Route::post('{main}/buy_now', [ProductController::class, 'buy_now']);
Route::get('products', [ProductController::class, 'products']);

Route::post('delete_buy_now', [ProductController::class, 'delete_buy_now']);
Route::get('/{main}/product-lists/{id}', [HomeController::class, 'product_lists']);
Route::post('/{main}/sort_product', [HomeController::class, 'sort_products']);
Route::post('/{main}/filter_products', [HomeController::class, 'filter_products'])->name('filter_products');
Route::get('product-detail/{id}', [HomeController::class, 'product_details']);

Route::get('/{main}/categorypage/{id}', [HomeController::class, 'category_page']);

// Check pincode delivery availability
Route::post('pincode_availability', [HomeController::class, 'pincode_availability']);
Route::get('{main}/promocode_list', [HomeController::class, 'promocode_list']);
Route::post('{main}/promocode_apply', [HomeController::class, 'promocode_apply']);

//search
// Route::get("search", 'HomeController@search');

Route::get("/{main}/search/", [HomeController::class, 'search']);

// Add to cart
Route::get('/{main}/cart', [ProductController::class, 'cart']);

// Add to cart and buy now
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::get('add-to-buynow/{id}', [ProductController::class, 'addToCart_buynow'])->name('add.to.buynow');

// Update and remove from cart
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

//buy now
Route::get('buynow', [ProductController::class, 'buynow'])->name('buynow');

// Update and remove from buynow
Route::patch('update-buynow', [ProductController::class, 'update_buynow'])->name('update.buynow');
Route::delete('remove-from-buynow', [ProductController::class, 'remove_buynow'])->name('remove.from.buynow');

// User address
Route::get('/{main}/user-address', [UserAddressController::class, 'index_user_address']);
Route::get('/{main}/add-user-address', [UserAddressController::class, 'add_user_address']);
Route::post('{main}/user-address-save', [UserAddressController::class, 'store_user_address']);
Route::get('{main}/edit-user-address/{id}', [UserAddressController::class, 'edit_user_address']);
Route::post('update-user-address', [UserAddressController::class, 'update_user_address']);
Route::get('{main}/delete-user-address/{id}', [UserAddressController::class, 'delete_user_address']);

// Footer fields
Route::get('/{main}/about-us', [LegalController::class, 'about_index']);
Route::get('/{main}/term-condition', [LegalController::class, 'term_index']);
Route::get('/{main}/privacy-policy', [LegalController::class, 'privacy_index']);
Route::get('/{main}/faqs', [LegalController::class, 'faq_index']);
//Checkout process
Route::get('{main}/payment', [PaymentController::class, 'payment']);
Route::post('success', [PaymentController::class, 'success']);
// Route::post('{main}/generate_order', [RazorpayController::class, 'generate_order']);

// Admin
Route::get('ecommerce_admin', [HomeController::class, 'admin_index']);
Route::get('ecommerce_admin_products', [HomeController::class, 'add_products']);
Route::get('ecommerce_admin_subcat', [HomeController::class, 'get_subcategories']);
Route::get('ecommerce_admin_brands', [HomeController::class, 'get_brands']);

Route::get('admin_edit_slider',function(){
	 return view('templates.SuperAdmin.edit_slider');
});



//Admin Product
Route::post('ecommerce_admin_add_product', [ProductController::class, 'admin_addproduct']);

//Admin Dashboard

// Customers Menu
Route::get('allcustomer',function(){
	 return view('templates.SuperAdmin.admin_allcustomer');
});

Route::get('emailsubscribers',function(){
	 return view('templates.SuperAdmin.admin_emailsubscribers');
});

Route::get('abandonedcustomers',function(){
	 return view('templates.SuperAdmin.admin_abandonedcustomers');
});


Route::get('purchase_more_than_once_customers',function(){
	 return view('templates.SuperAdmin.admin_purchasemorethanoncecustomers');
});


Route::get('no_purchase_customers',function(){
	 return view('templates.SuperAdmin.admin_nopurchasecustomers');
});


// Orders Menu
Route::get('billing_address',function(){
	 return view('templates.SuperAdmin.admin_billingaddress');
});

Route::get('poslocation',function(){
	 return view('templates.SuperAdmin.admin_poslocation');
});


Route::get('admin_product',function(){
	 return view('templates.SuperAdmin.admin_product');
});

Route::get('shipping_address',function(){
	 return view('templates.SuperAdmin.admin_shippingaddress');
});


Route::get('staff',function(){
	 return view('templates.SuperAdmin.admin_staff');
});


// Product Menu

Route::get('allproducts',function(){
	 return view('templates.SuperAdmin.admin_allproducts');
});

Route::get('inventory',function(){
	 return view('templates.SuperAdmin.admin_inventory');
});


Route::get('collections',function(){
	 return view('templates.SuperAdmin.admin_collections');
});


Route::get('giftcards',function(){
	 return view('templates.SuperAdmin.admin_giftcards');
});

Route::get('transfers',function(){
	 return view('templates.SuperAdmin.transfers');
});

// ====================

//Analytics Menu
Route::get('totalsales',function(){
	 return view('templates.SuperAdmin.admin_totalsales');
});


Route::get('onlinestoreconversionrate',function(){
	 return view('templates.SuperAdmin.admin_onlinestoreconversionrate');
});

Route::get('topproductsbyunits',function(){
	 return view('templates.SuperAdmin.admin_topproductsbyunits');
});

Route::get('onlinestoresessions',function(){
	 return view('templates.SuperAdmin.admin_onlinestoresessions');
});


Route::get('onlinestoresessionsbylocation',function(){
	 return view('templates.SuperAdmin.admin_onlinestoresessionsbylocation');
});

Route::get('averageordervalue',function(){
	 return view('templates.SuperAdmin.admin_averageordervalue');
});


Route::get('salesbyPOSLocation',function(){
	 return view('templates.SuperAdmin.admin_salesbyPOSLocation');
});


Route::get('returningcustomerrate',function(){
	 return view('templates.SuperAdmin.admin_returningcustomerrate');
});


Route::get('totalorders',function(){
	 return view('templates.SuperAdmin.admin_totalorders');
});

Route::get('retailsalesbystaff',function(){
	 return view('templates.SuperAdmin.admin_retailsalesbystaff');
});


// ======================

Route::get('/SuperAdmin', function () {
    return view('templates.SuperAdmin.login');
});
// Route::get('privacy',function(){
// 	 return view('templates.frontend.privacy');
// });
// Route::get('product-lists',function(){
// 	 return view('templates.frontend.product_list');
// });
// Route::get('product-detail',function(){
// 	 return view('templates.frontend.product_detail');
// });
// Route::get('refund',function(){
// 	 return view('templates.frontend.refund');
// });
Route::get('Home',function(){
	 return view('templates.frontend.index');
});
// Route::get('term-conditions',function(){
//     return view('templates.frontend.term-conditions');
// });

Route::get('cart-details',function(){
    return view('templates.frontend.cart_details');
});
Route::get('add-category-subcategoy',function(){
    return view('templates.frontend.cat_subcats');
});

// Route::get('payment',function(){
//     return view('templates.frontend.payment');
// });

Route::get('shipping_details',function(){
    return view('templates.frontend.shipping');
});

// industry buying and jeanscart
Route::get('layout', function () {
    return view('templates.frontend.jeanscart_industry');
});



// industry buying
Route::get('fiablehydraulics', function () {
    return view('templates.frontend.industry_buying');
});


// E-Commerce Admin Panel

// Route::get('ecommadmin', function () {
//     return view('templates.frontend.ecomm_admin');

// });

// Admin routes
Route::get('ecommadmin', [MainCategoryController::class, 'admin_index']);

// Header with Dropdown
Route::get('header1', [MainCategoryController::class, 'index']);
Route::post('add_main_category', [MainCategoryController::class, 'add_main_category'])->name('add_main_category');
Route::post('imagesUploadPost', [MainCategoryController::class, 'imagesUploadPost'])->name('imagesUploadPost');

Route::get('header_cat_img_round', [MainCategoryController::class, 'index_catimg']);
Route::get('header_cat_img_cat_name_square', [MainCategoryController::class, 'index_catimg_catname_sqaure']);
Route::get('header_cat_img_square', [MainCategoryController::class, 'index_cat_img_square']);

// Header without Dropdown
Route::get('header_search_cat_img_cat_name_circle', [MainCategoryController::class, 'index_search_cat_img_cat_name_circle']);
Route::get('header_search_cat_img_cat_name_sqaure', [MainCategoryController::class, 'index_search_cat_img_cat_name_sqaure']);
Route::get('header_search_cat_img_circle', [MainCategoryController::class, 'index_search_cat_img_circle']);
Route::get('header_search_cat_img_square', [MainCategoryController::class, 'index_search_cat_img_square']);



Route::get('header2', function () {
    return view('templates.frontend.header_drop_catname');
});


// Route::get('header3', function () {
//     return view('templates.frontend.header_search_catimg_catname_circle');
// });

Route::get('header4', function () {
    return view('templates.frontend.header_search_catname');
});

// Add Category
Route::post('addCategory', [MainCategoryController::class, 'addCategory'])->name('addCategory');

// // Admin Login
Route::get('/admin', [Admin_loginController::class, 'index']);
Route::post('/check_login', [Admin_loginController::class, 'store']);
Route::get('/settings', [Admin_loginController::class, 'show_admininfo']);







Route::get('/admin/loginpage', [Admin_loginController::class, 'showLogin']);



Route::get('/mongodb-test', function () {
    try {
        $connection = DB::connection('mongodb');
        $result = $connection->getCollection('Categories')->count();
        return "MongoDB connection successful. Collection count: " . $result;
    } catch (\Exception $e) {
        return "MongoDB connection failed: " . $e->getMessage();
    }
});
