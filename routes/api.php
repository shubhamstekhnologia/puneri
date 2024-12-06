<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotApiController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\BrandApiController;
use App\Http\Controllers\LegalApiController;
use App\Http\Controllers\OfferApiController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\FilterApiController;
use App\Http\Controllers\RatingApiController;
use App\Http\Controllers\SearchApiController;
use App\Http\Controllers\VendorApiController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\CartOrderApiController;
use App\Http\Controllers\CategoriesApiController;
use App\Http\Controllers\MultistoreApiController;
use App\Http\Controllers\NewChangesApiController;
use App\Http\Controllers\DeliveryBoyApiController;
use App\Http\Controllers\VendorOrderApiController;
use App\Http\Controllers\AdminProductApiController;
use App\Http\Controllers\SubscriptionApiController;
// use App\Http\Controllers\Admin\ProductApiController;
use App\Http\Controllers\HomeComponentApiController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\PaytmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Categories
Route::post('add_main_category', [CategoriesApiController::class, 'add_main_category']);
Route::post('edit_main_category', [CategoriesApiController::class, 'edit_main_category']);
Route::post('get_main_category_list', [CategoriesApiController::class, 'get_main_category_list']);
Route::post('delete_main_category', [CategoriesApiController::class, 'delete_main_category']);

// Product Form UI
Route::post('add_product_formui', [CategoriesApiController::class, 'add_product_formui']);
Route::post('update_product_formui', [CategoriesApiController::class, 'update_product_formui']);
Route::post('get_product_formui', [CategoriesApiController::class, 'get_product_formui']);

// Sub Categories
Route::post('add_sub_category', [CategoriesApiController::class, 'add_sub_category']);
Route::post('edit_sub_category', [CategoriesApiController::class, 'edit_sub_category']);
Route::post('get_sub_category_list', [CategoriesApiController::class, 'get_sub_category_list']);
Route::post('delete_sub_category', [CategoriesApiController::class, 'delete_sub_category']);

// Price Range
Route::post('add_price_range', [FilterApiController::class, 'add_price_range']);
Route::post('get_price_range', [FilterApiController::class, 'get_price_range']);
Route::post('delete_price_range', [FilterApiController::class, 'delete_price_range']);

// Colors Range
Route::post('add_color', [FilterApiController::class, 'add_color_range']);
Route::post('get_color_list', [FilterApiController::class, 'get_color_range']);
Route::post('delete_color', [FilterApiController::class, 'delete_color_range']);

// Discount Range
Route::post('add_discount_range', [FilterApiController::class, 'add_discount_range']);
Route::post('get_discount_range', [FilterApiController::class, 'get_discount_range']);
Route::post('delete_discount_range', [FilterApiController::class, 'delete_discount_range']);

// Brands
Route::post('add_brand', [BrandApiController::class, 'add_brand']);
Route::post('edit_brand', [BrandApiController::class, 'edit_brand']);
Route::post('get_brand_list', [BrandApiController::class, 'get_brand_list']);
Route::post('delete_brand', [BrandApiController::class, 'delete_brand']);
Route::post('get_main_category_brands', [BrandApiController::class, 'get_main_category_brands']);

// Category Style
Route::post('add_category_style', [CategoriesApiController::class, 'add_main_category_style']);
Route::post('edit_main_category_style', [CategoriesApiController::class, 'edit_main_category_style']);
Route::post('get_main_category_style', [CategoriesApiController::class, 'get_main_category_style_list']);

// Vendor
Route::post('add_vendor', [VendorApiController::class, 'add_vendor']);
// Product
// Route::post('add_new_product_admin', [ProductApiController::class, 'add_new_product_admin']);
// Route::post('edit_product', [ProductApiController::class, 'edit_product']);
// Route::post('update_product', [ProductApiController::class, 'update_product']);
// Route::post('get_products', [ProductApiController::class, 'get_products']);
// Route::post('delete_product', [ProductApiController::class, 'delete_product']);

// Home Component
Route::post('add_new_home_component', [HomeComponentApiController::class, 'add_new_home_component']);
Route::post('edit_home_component', [HomeComponentApiController::class, 'edit_home_component']);
Route::post('delete_home_component', [HomeComponentApiController::class, 'delete_home_component']);
Route::post('add_home_component_sub_categories', [HomeComponentApiController::class, 'add_home_component_sub_categories']);
Route::post('add_home_component_main_categories', [HomeComponentApiController::class, 'add_home_component_main_categories']);
Route::post('add_home_component_top_brands', [HomeComponentApiController::class, 'add_home_component_top_brands']);
Route::post('get_home_top_brands', [HomeComponentApiController::class, 'get_home_top_brands']);
Route::post('get_home_component_list', [HomeComponentApiController::class, 'get_home_component_list']);
Route::post('get_home_component_details', [HomeComponentApiController::class, 'get_home_component_details']);
Route::post('get_new_product_list', [HomeComponentApiController::class, 'get_new_product_list']);
Route::post('update_home_component_index', [HomeComponentApiController::class, 'update_home_component_index']);
Route::post('get_main_category_components', [HomeComponentApiController::class, 'get_main_category_components']);

// Slider
Route::post('add_home_slider_image', [HomeComponentApiController::class, 'add_component_image']);
Route::post('edit_home_slider_image', [HomeComponentApiController::class, 'edit_component_image']);
Route::post('delete_home_slider_image', [HomeComponentApiController::class, 'delete_component_image']);

// Banner
Route::post('add_banner_image', [HomeComponentApiController::class, 'add_component_image']);
Route::post('edit_banner_image', [HomeComponentApiController::class, 'edit_component_image']);

// Users
Route::post('user_registration', [UserApiController::class, 'register']);
Route::post('delete_admin_account', [UserApiController::class, 'delete_admin_account']);
Route::post('restore_all_data', [UserApiController::class, 'deleted_restore_all_data']);
Route::post('recent_dates_to_restore', [UserApiController::class, 'recent_dates_to_restore']);
Route::post('update_user_status', [UserApiController::class, 'update_user_status']);
Route::post('send_registration_otp', [UserApiController::class, 'send_registration_otp']);
Route::post('verify_registration_otp', [UserApiController::class, 'verify_registration_otp']);
Route::post('login', [UserApiController::class, 'login']);
Route::post('send_login_otp', [UserApiController::class, 'send_login_otp']);
Route::post('get_user_profile', [UserApiController::class, 'get_user_profile']);
Route::post('update_user_profile', [UserApiController::class, 'update_user_profile']);
Route::post('check_approval_status', [UserApiController::class, 'checkApprovalStatus']);

Route::post('upload_user_document', [UserApiController::class, 'uploadDocument']);
Route::post('edit_user_document', [UserApiController::class, 'editDocument']);
Route::post('get_user_document', [UserApiController::class, 'getDocument']);
Route::post('update_customer_status', [UserApiController::class, 'updateCustomerStatus']);

//admin document verification process

Route::post('getUnverifiedDocument', [UserApiController::class, 'getUnverifiedDocument']);
Route::post('getVerifiedDocument', [UserApiController::class, 'getVerifiedDocument']);
Route::post('update_user_document_status', [UserApiController::class, 'update_user_document_status']);
Route::post('customer_approval_list', [UserApiController::class, 'verifiedCustomerApprovalList']);
Route::post('rejected_customer_list', [UserApiController::class, 'rejectedCustomerApprovalList']);
Route::post('unverified_customer_list', [UserApiController::class, 'unverifiedCustomerApprovalList']);
Route::post('get_Customer_documents', [UserApiController::class, 'get_Customer_documents']);
Route::post('get_customer_search', [UserApiController::class, 'get_customer_search']);
// Vendor
Route::post('add_min_order_price', [VendorApiController::class, 'add_min_order_price']);

// Brands
Route::post('add_new_brand_vendor', [VendorApiController::class, 'add_new_brand_vendor']);
Route::post('edit_brand_vendor', [VendorApiController::class, 'edit_brand_vendor']);
Route::post('disapprove_vendor_brand', [VendorApiController::class, 'disapprove_vendor_brand']);
Route::post('get_vendor_brand_disapproval_list', [VendorApiController::class, 'get_vendor_brand_disapproval_list']);
Route::post('get_vendor_brands_approval_list', [VendorApiController::class, 'get_vendor_brands_approval_list']);
Route::post('get_vendor_lists', [VendorApiController::class, 'get_vendor_lists']);
Route::post('get_customer_lists', [VendorApiController::class, 'get_customer_lists']);
Route::post('update_vendor_brands_admin', [VendorApiController::class, 'update_vendor_brands_admin']);
Route::post('get_vendor_brand_list', [VendorApiController::class, 'get_vendor_brand_list']);
Route::post('select_vendor_brands', [VendorApiController::class, 'select_vendor_brands']);

// Category
Route::post('add_new_category_vendor', [VendorApiController::class, 'add_new_category_vendor']);

Route::post('edit_category_vendor', [VendorApiController::class, 'edit_category_vendor']);
Route::post('disapprove_vendor_category', [VendorApiController::class, 'disapprove_vendor_category']);
Route::post('get_vendor_category_disapproval_list', [VendorApiController::class, 'get_vendor_category_disapproval_list']);
Route::post('get_vendor_category_approval_list', [VendorApiController::class, 'get_vendor_category_approval_list']);
Route::post('update_vendor_category_admin', [VendorApiController::class, 'update_vendor_category_admin']);
Route::post('get_vendor_category_list', [VendorApiController::class, 'get_vendor_category_list']);
Route::post('select_vendor_categories', [VendorApiController::class, 'select_vendor_categories']);

// Deals in
Route::post('add_new_dealin_vendor', [VendorApiController::class, 'add_new_dealin_vendor']);
Route::post('get_vendor_dealin_list', [VendorApiController::class, 'get_vendor_dealin_list']);
Route::post('select_vendor_dealin', [VendorApiController::class, 'select_vendor_dealin']);

Route::post('get_vendor_info', [VendorApiController::class, 'get_vendor_info']);
Route::post('update_vendor_info', [VendorApiController::class, 'update_vendor_info']);

// Add product
Route::post('add_new_product', [VendorApiController::class, 'add_new_product']);
Route::post('edit_product_vendor', [VendorApiController::class, 'edit_product_vendor']);
Route::post('disapprove_vendor_product', [VendorApiController::class, 'disapprove_vendor_product']);
Route::post('get_vendor_product_disapproval_list', [VendorApiController::class, 'get_vendor_product_disapproval_list']);
Route::post('get_vendor_product_approval_list', [VendorApiController::class, 'get_vendor_product_approval_list']);
Route::post('update_vendor_product_admin', [VendorApiController::class, 'update_vendor_product_admin']);
Route::post('get_vendor_product_list', [VendorApiController::class, 'get_vendor_product_list']);
Route::post('select_vendor_product', [VendorApiController::class, 'select_vendor_product']);
Route::post('get_Vendor_Brand_Product', [VendorApiController::class, 'get_Vendor_Brand_Product']);
Route::post('get_Vendor_MainCat_Product', [VendorApiController::class, 'get_Vendor_MainCat_Product']);
Route::post('getsubcategories', [VendorApiController::class, 'getsubcategories']);
Route::post('add_vendor_Product_color', [VendorApiController::class, 'add_vendor_Product_color']);
Route::post('get_vendor_product_colors', [VendorApiController::class, 'get_vendor_product_colors']);
Route::post('delete_vendor_product', [VendorApiController::class, 'delete_vendor_product']);
Route::post('edit_vendor_product', [VendorApiController::class, 'edit_vendor_product']);
Route::post('update_vendor_product', [VendorApiController::class, 'update_vendor_product']);
Route::post('get_all_vendor_list', [VendorApiController::class, 'get_all_vendor_list']);
Route::post('show_vendor_details', [VendorApiController::class, 'show_vendor_details']);
Route::post('show_customer_details', [VendorApiController::class, 'show_customer_details']);

//add new admin products

Route::post('add_admin_Product', [AdminProductApiController::class, 'add_admin_Product']);
Route::post('add_admin_Product_color', [AdminProductApiController::class, 'add_admin_Product_color']);
Route::post('update_admin_Product_color_setting', [AdminProductApiController::class, 'update_admin_Product_color_setting']);
Route::post('get_admin_products', [AdminProductApiController::class, 'get_admin_products']);
Route::post('edit_admin_product', [AdminProductApiController::class, 'edit_admin_product']);
Route::post('update_admin_product', [AdminProductApiController::class, 'update_admin_product']);
Route::post('get_product_details', [AdminProductApiController::class, 'get_product_details']);
Route::post('get_admin_product_colors', [AdminProductApiController::class, 'get_admin_product_colors']);
Route::post('delete_admin_product', [AdminProductApiController::class, 'delete_admin_product']);
Route::post('add_product_image', [AdminProductApiController::class, 'add_product_image']);
Route::post('delete_product_image', [AdminProductApiController::class, 'delete_product_image']);
Route::post('get_Admin_Brand_Product', [AdminProductApiController::class, 'get_Admin_Brand_Product']);
Route::post('get_Admin_MainCategory_Product', [AdminProductApiController::class, 'get_Admin_MainCategory_Product']);
Route::post('get_Admin_Subcategory_Product', [AdminProductApiController::class, 'get_Admin_Subcategory_Product']);
Route::post('get_component_product', [AdminProductApiController::class, 'get_component_product']);
Route::post('get_simillar_products', [AdminProductApiController::class, 'get_simillar_products']);
Route::post('get_also_buy_products', [AdminProductApiController::class, 'get_also_buy_products']);
Route::post('get_recommended_products', [AdminProductApiController::class, 'get_recommended_products']);
Route::post('get_offer_products', [AdminProductApiController::class, 'get_offer_products']);
Route::post('get_filter_products', [AdminProductApiController::class, 'get_filter_products']);

// Coupon Codes
Route::post('add_new_coupen_code', [CategoriesApiController::class, 'add_new_coupen_code']);
Route::post('edit_coupen_code', [CategoriesApiController::class, 'edit_coupen_code']);
Route::post('get_all_coupen_code', [CategoriesApiController::class, 'get_all_coupen_code']);
Route::post('get_all_coupen_code_list', [CategoriesApiController::class, 'get_all_coupen_code_list']);
Route::post('delete_coupen_code', [CategoriesApiController::class, 'delete_coupen_code']);

// Cart
Route::post('add_to_cart', [CartOrderApiController::class, 'add_to_cart']);
Route::post('buy_now', [CartOrderApiController::class, 'buy_now']);
Route::post('update_buynow_quantity_product', [CartOrderApiController::class, 'update_buynow_quantity_product']);
Route::post('get_buy_now', [CartOrderApiController::class, 'get_buy_now']);
Route::post('delete_buy_now', [CartOrderApiController::class, 'delete_buy_now']);
Route::post('edit_cart_product', [CartOrderApiController::class, 'edit_cart_product']);
Route::post('delete_from_cart', [CartOrderApiController::class, 'delete_from_cart']);
Route::post('get_cart_list', [CartOrderApiController::class, 'get_cart_list']);
Route::post('get_cart_product_count', [CartOrderApiController::class, 'get_cart_product_count']);
Route::post('add_user_address', [CartOrderApiController::class, 'add_user_address']);
Route::post('get_user_address', [CartOrderApiController::class, 'get_user_address']);
Route::post('edit_user_address', [CartOrderApiController::class, 'edit_user_address']);
Route::post('delete_user_address', [CartOrderApiController::class, 'delete_user_address']);

// Size List
Route::post('add_size', [FilterApiController::class, 'add_size']);
Route::post('get_size_list', [FilterApiController::class, 'get_size_list']);
Route::post('delete_size', [FilterApiController::class, 'delete_size']);

// Product Unit
Route::post('add_product_unit', [FilterApiController::class, 'add_product_unit']);
Route::post('get_product_unit', [FilterApiController::class, 'get_product_unit']);
Route::post('delete_product_unit', [FilterApiController::class, 'delete_product_unit']);

// Manufacturer List
Route::post('add_manufacturer', [FilterApiController::class, 'add_manufacturer']);
Route::post('get_manufacturer', [FilterApiController::class, 'get_manufacturer']);
Route::post('delete_manufacturer', [FilterApiController::class, 'delete_manufacturer']);

// Material List
Route::post('add_material', [FilterApiController::class, 'add_material']);
Route::post('get_material', [FilterApiController::class, 'get_material']);
Route::post('delete_material', [FilterApiController::class, 'delete_material']);

// Firmness List
Route::post('add_firmness', [FilterApiController::class, 'add_firmness']);
Route::post('get_firmness', [FilterApiController::class, 'get_firmness']);
Route::post('delete_firmness', [FilterApiController::class, 'delete_firmness']);

// Country Product Price
Route::post('add_country_product_price', [FilterApiController::class, 'add_country_product_price']);
Route::post('get_country_product_price', [FilterApiController::class, 'get_country_product_price']);
Route::post('edit_country_product_price', [FilterApiController::class, 'edit_country_product_price']);
Route::post('delete_country_product_price', [FilterApiController::class, 'delete_country_product_price']);

// Price Range
Route::post('add_pincode', [FilterApiController::class, 'add_pincode']);
Route::post('get_pincode_list', [FilterApiController::class, 'get_pincode_list']);
Route::post('edit_pincode', [FilterApiController::class, 'edit_pincode']);
Route::post('delete_pincode', [FilterApiController::class, 'delete_pincode']);

// Currency
Route::post('add_currency', [FilterApiController::class, 'add_currency']);
Route::post('get_currecy_list', [FilterApiController::class, 'get_currecy_list']);
Route::post('delete_currency', [FilterApiController::class, 'delete_currency']);

// Delivery Boy
Route::post('add_delivery_boy', [FilterApiController::class, 'add_delivery_boy']);
Route::post('get_delivery_boy', [FilterApiController::class, 'get_delivery_boy']);
Route::post('edit_delivery_boy', [FilterApiController::class, 'edit_delivery_boy']);
Route::post('delete_delivery_boy', [FilterApiController::class, 'delete_delivery_boy']);

// Wishlist
Route::post('add_to_wishlist', [CartOrderApiController::class, 'add_to_wishlist']);
Route::post('delete_wishlist_item', [CartOrderApiController::class, 'delete_wishlist_item']);
Route::post('get_wishlist', [CartOrderApiController::class, 'get_wishlist']);
Route::post('get_wishlist_product_count', [CartOrderApiController::class, 'get_wishlist_product_count']);

// Place Order
Route::post('place_order', [CartOrderApiController::class, 'place_order']);
Route::post('edit_place_order', [CartOrderApiController::class, 'editPlaceOrder']);
Route::post('get_order_history', [CartOrderApiController::class, 'get_order_history']);
Route::post('get_customer_order_history', [CartOrderApiController::class, 'get_customer_order_history']);
Route::post('get_order_details', [CartOrderApiController::class, 'get_order_detailss']);
Route::post('get_order_details_admin', [CartOrderApiController::class, 'get_order_details_admin']);
Route::post('cancel_order', [CartOrderApiController::class, 'cancel_order']);
Route::post('return_order', [CartOrderApiController::class, 'return_order']);

// Business Details
Route::post('store_business_details', [LegalApiController::class, 'store_business_details']);
Route::post('show_business_details', [LegalApiController::class, 'show_business_details']);

// Product Layout Style
Route::post('add_product_layout_style', [LegalApiController::class, 'add_product_layout_style']);
Route::post('get_product_layout_style', [LegalApiController::class, 'get_product_layout_style']);

// App UI Style
Route::post('add_app_ui_style', [LegalApiController::class, 'add_app_ui_style']);
Route::post('get_app_ui_style', [LegalApiController::class, 'get_app_ui_style']);

// Common API for About
Route::post('add-aboutus', [LegalApiController::class, 'insert_about']);
Route::post('Show-About', [LegalApiController::class, 'about_index']);

// Common API for Terms
Route::post('add-Terms', [LegalApiController::class, 'insert_terms']);
Route::post('Show-Terms', [LegalApiController::class, 'terms_index']);

// Common API for Privacy
Route::post('add-Privacy', [LegalApiController::class, 'insert_privacy']);
Route::post('Show-Privacy', [LegalApiController::class, 'privacy_index']);

// Common API for Address
Route::post('add-contact-details', [LegalApiController::class, 'insert_contact']);
Route::post('Show-Contact-Details', [LegalApiController::class, 'contact_index']);

// Common API for FAQ's
Route::post('add-Faq', [LegalApiController::class, 'insert_faq']);
Route::post('Show-Faq', [LegalApiController::class, 'faq_index']);

// Vendor Order History List
Route::post('get_Vendor_NewOrders', [VendorOrderApiController::class, 'get_Vendor_NewOrders']);
Route::post('get_Vendor_Accept_orders', [VendorOrderApiController::class, 'get_Vender_AcceptOrder']);

Route::post('get_Vendor_PreparingOrders', [VendorOrderApiController::class, 'get_Vendor_PreparingOrders']);
Route::post('get_Vender_DiapatchedOrders', [VendorOrderApiController::class, 'get_Vender_DiapatchedOrders']);
Route::post('get_Vendor_Completed_Orders', [VendorOrderApiController::class, 'get_Vendor_Completed_Orders']);
Route::post('Change_Vendor_Order_Status', [VendorOrderApiController::class, 'Change_Vendor_Order_Status']);
Route::post('get_Vendor_Order_Details', [VendorOrderApiController::class, 'get_Vendor_Order_Details']);
Route::post('get_Vendor_Return_Orders', [VendorOrderApiController::class, 'get_Vendor_Return_Orders']);
Route::post('get_Vendor_Cancel_Orders', [VendorOrderApiController::class, 'get_Vendor_Cancel_Orders']);
Route::post('get_vendor_admin_order_details', [VendorOrderApiController::class, 'get_vendor_admin_order_details']);
Route::post('get_Vendor_Order_Reports', [VendorOrderApiController::class, 'get_Vendor_Order_Reports']);
Route::post('add_Vendor_Inventory', [VendorOrderApiController::class, 'add_Vendor_Inventory']);
Route::post('getVendor_Inventory_List', [VendorOrderApiController::class, 'getVendor_Inventory_List']);
Route::post('get_Vendor_Trending_products', [VendorOrderApiController::class, 'get_Vendor_Trending_products']);
Route::post('get_Vender_Market_List', [VendorOrderApiController::class, 'get_Vender_Market_List']);
Route::post('get_Vendor_Sale_Reports', [VendorOrderApiController::class, 'get_Vendor_Sale_Reports']);
Route::post('get_Vendor_finance_Reports', [VendorOrderApiController::class, 'get_Vendor_finance_Reports']);
Route::post('Change_vendor_all_order_status', [VendorOrderApiController::class, 'ChangeAllOrderStatus']);
Route::post('get_Vendor_todays_reports', [VendorOrderApiController::class, 'get_Vendor_todays_reports']);
Route::post('get_Customer_Sale_Reports', [VendorOrderApiController::class, 'get_Customer_Sale_Reports']);
Route::post('get_Customers_Sales_Reports', [VendorOrderApiController::class, 'get_Customers_Sales_Reports']);


// Rating & Review
Route::post('Store-Product-Rating-Review', [RatingApiController::class, 'store_product_rating_review']);
Route::post('Edit-Product-Rating-Review', [RatingApiController::class, 'edit_product_rating_review']);
Route::post('Show-Ratings', [RatingApiController::class, 'get_product_rating']);
Route::post('Show-vendor-Ratings', [RatingApiController::class, 'get_vendor_rating']);

// Size Chart
Route::post('add_size_chart', [RatingApiController::class, 'add_size_chart']);
Route::post('edit_size_chart', [RatingApiController::class, 'edit_size_chart']);
Route::post('get_size_chart_list', [RatingApiController::class, 'get_size_chart_list']);

// Search List APIs
Route::post('Get-Search-List', [SearchApiController::class, 'index']);
Route::post('add_filter_menu', [SearchApiController::class, 'add_filter_menu']);
Route::post('get_filter_menu', [SearchApiController::class, 'get_filter_menu']);
Route::post('search', [SearchApiController::class, 'insert_search']);
Route::post('get_return_repeat_like_details', [SearchApiController::class, 'get_return_repeat_like_details']);

// Price Range
Route::post('add_offer_image', [OfferApiController::class, 'add_offer_image']);
Route::post('edit_offer_image', [OfferApiController::class, 'edit_offer_image']);
Route::post('get_all_offers', [OfferApiController::class, 'get_all_offers']);
Route::post('delete_offer_image', [OfferApiController::class, 'delete_offer_image']);

// Other
Route::post('move_to_wishlist', [OfferApiController::class, 'move_to_wishlist']);
Route::post('update_express_delivery_details', [OfferApiController::class, 'update_express_delivery_details']);
Route::post('add_home_component_products', [OfferApiController::class, 'add_home_component_products']);
Route::post('get_home_products', [OfferApiController::class, 'get_home_products']);
Route::post('get_express_delivery_details', [OfferApiController::class, 'get_express_delivery_details']);

// Update Product New Keys
Route::post('Update_product_new_keys', [FilterApiController::class, 'Update_product_new_keys']);

// Bot Apis
Route::post('get_home_component_remaining_data', [BotApiController::class, 'get_home_component_remaining_data']);

// Subdomain for Ecommerce Web
Route::post('verify_subdomain', [UserApiController::class, 'verify_subdomain']);

// Pincode Delivery Time
Route::post('add_pincode_deliverytime', [NewChangesApiController::class, 'add_pincode_deliverytime']);
Route::post('edit_pincode_deliverytime', [NewChangesApiController::class, 'edit_pincode_deliverytime']);
Route::post('get_pincode_deliverytime', [NewChangesApiController::class, 'get_pincode_deliverytime']);
Route::post('delete_pincode_deliverytime', [NewChangesApiController::class, 'delete_pincode_deliverytime']);

// Pincode Delivery Setting
Route::post('add_pincode_delivery_setting', [NewChangesApiController::class, 'add_pincode_delivery_setting']);
Route::post('get_pincode_delivery_setting', [NewChangesApiController::class, 'get_pincode_delivery_setting']);
Route::post('get_new_filter_products', [NewChangesApiController::class, 'get_new_filter_products']);

// Delivery Boy Apis
Route::post('getSignupOTP', [DeliveryBoyApiController::class, 'signinOTP']);
Route::post('verifySignupOTP', [DeliveryBoyApiController::class, 'verifysigninOTP']);
Route::post('update_DeliveryBoyLocation', [DeliveryBoyApiController::class, 'update_deliveryboy_active_status']);
Route::post('update_DeliveryBoy_location_url', [DeliveryBoyApiController::class, 'update_deliveryboy_locations']);
Route::post('getDeliveryBoy_Order', [DeliveryBoyApiController::class, 'show_current_order_deliveryboy']);
Route::post('accept_new_order', [DeliveryBoyApiController::class, 'assign_delivery_boy_to_order']);
Route::post('Dispatch-Order', [DeliveryBoyApiController::class, 'update_dispatch_status']);
Route::post('Complete-Order', [DeliveryBoyApiController::class, 'complete_order']);
Route::post('VerifyOrderOtp', [DeliveryBoyApiController::class, 'verify_order_otp']);
Route::post('DeliveryBoy_Check_Status', [DeliveryBoyApiController::class, 'check_status']);
Route::post('DeliveryBoy_history', [DeliveryBoyApiController::class, 'show_order_deliveryboy']);
Route::post('DeliveryBoy_profile', [DeliveryBoyApiController::class, 'vendor_profile']);
Route::post('business-details', [DeliveryBoyApiController::class, 'business_details']);
Route::post('assign-order-delivery-boy', [DeliveryBoyApiController::class, 'assign_orderto_dboy']);
Route::post('update-business-address-details', [DeliveryBoyApiController::class, 'update_business_address_details']);
Route::post('admin-delivery-boy-status', [DeliveryBoyApiController::class, 'admin_delivery_boy_status']);

// Multistore APIs
// Route::post('select_admin_products', [MultistoreApiController::class, 'select_admin_products']);

// // Vacation
// Route::post('add_vacation', [VacationController::class, 'add_vacation']);
// Route::post('edit_vacation', [VacationController::class, 'edit_vacation']);
// Route::post('delete_vacation', [VacationController::class, 'delete_vacation']);
// Route::post('get_vacation', [VacationController::class, 'get_vacation']);

// // Subscription
// Route::post('get_subscription', [SubscriptionApiController::class, 'get_subscription']);
// Route::get('add_subscription/{cId}', [SubscriptionApiController::class, 'add_subscription']);
// Route::post('add_subscription_setting', [SubscriptionApiController::class, 'add_subscription_setting']);
// Route::post('get_subscription_setting', [SubscriptionApiController::class, 'get_subscription_setting']);

// // Wallet
// Route::post('add_my_wallet', [WalletController::class, 'addWalletEntry']);
// Route::post('get_my_wallet', [WalletController::class, 'getMyWallet']);
// Route::post('get_my_wallet_history', [WalletController::class, 'getMyWalletHistory']);

// Route::post('/paytm', [PaytmController::class, 'initiatePayment']);
// Route::post('/payment', [PaytmController::class, 'pay']);
// Route::post('/payment-status', [PaytmController::class, 'paymentCallback'])->name('status');

// Route::post('/add_delivery_up_to_charge_setting', [DeliveryChargeController::class, 'addCharge']);
// Route::post('/get_delivery_up_to_charge_setting', [DeliveryChargeController::class, 'getCharge']);
