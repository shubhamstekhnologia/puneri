<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\AdminProducts;
use App\AdminProductImages;
use App\CountryProductPrice;
use App\Categories;
use App\Subcategories;
use App\CouponCode;
use App\CategoryStyle;
use App\BusinessDetails;
use App\Brand;
use App\ContactDetails;
use App\Pincode;
use App\CartUserAddress;
use App\DiscountRange;
use App\ProductRatingReview;
use App\UserRegister;
use App\Currency;
use App\PriceRange;
use App\ColorsRange;
use App\BuyNow;
use DateTimeZone;
use DateTime;
use Session;
use App\MainOrders;
use App\Orders;
use App\Admin;
use DB;
include(app_path() . '/razorpay/Razorpay.php');
use Razorpay\Api\Api;

class RazorpayController extends Controller{

  public function get_admin()
{
    $subdomain = session("main");
    $admin =  Admin::where("subdomain", "=", $subdomain)->first();
    if (empty($admin))
    {
        abort(404);
    }
   
   if(empty($admin))
{
abort(404);
}

return $admin->id;
}
    public function generate_order($main, Request $request)
    {

         if (Session::has('AccessTokens'))
        {
            $uid = Session::get('AccessTokens');
            $order_count = MainOrders::whereNull('deleted_at')->where("admin_auto_id", $this->get_admin())->count();
          
         $order_no = $order_count +1;
          $order_id = "ORD0".$order_no;
        $key_id = "rzp_test_VRjuJ0lp3kC47e";
        $secret = "n5egcGGXzuytnRY5NU0pC2yN";
        $api = new Api($key_id, $secret);
      $res = $api->order->create(array('receipt' => $order_id, 'amount' => $request->amount, 'currency' => 'INR', 'notes'=> array('cust_id'=> $uid)));
      echo $res->id;
        }
     
    }
}