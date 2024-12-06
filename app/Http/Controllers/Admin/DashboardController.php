<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\UserRegister;
use App\ClassifiedPurchasedOrders;
use App\Categories;
use App\ClassifiedAdd;
use App\Traits\Features;

class DashboardController extends Controller
{
    use Features;
    public function index()
    {
   		  $odate = date('Y-m-d');
            $query1 = UserRegister::wherenull('deleted_at')->count('id');
            $query2 = Categories::wherenull('deleted_at')->count('id');
            $query3 = ClassifiedAdd::where('status','=','InReview')->wherenull('deleted_at')->count('id');
            $query4 = ClassifiedAdd::where('status','=','Approved')->wherenull('deleted_at')->count('id');
            $query5 = ClassifiedAdd::where('status','=','Disapproved')->wherenull('deleted_at')->count('id');
            $query6 = ClassifiedPurchasedOrders::where('status','=','Purchased')->wherenull('deleted_at')->count('id');
        
        $features = $this->getfeatures();
        if(empty($features)){
          return redirect('SuperAdmin')->with( 'error', "Something went wrong");
        }
        else{
          return view('templates.SuperAdmin.dashboard',['users' => $query1,'medical_departments' => $query2,'waiting_list' => $query3,'approved_list' => $query4,'disapproved_list' => $query5,'order_history' => $query6,'allfeatures' => $features]);
        }
   }
}
