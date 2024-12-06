<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserRegister;use App\BulkEmail;
use DB;
use Session;
use App\Traits\Features;
class CustomerController extends Controller
{
    use Features;
    public function index(){
        
    	$customer = UserRegister::ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
    
        $features = $this->getfeatures();
       if(empty($features)){
           return redirect('MyDashboard')->with( 'error', "Something went wrong");
       }
       else{
    	return view('templates.SuperAdmin.user')->with(['customers' => $customer, 'allfeatures' => $features]);
    }
}
 
 	public function edit($id){
    	$customer = UserRegister::where('_id','=',$id)->whereNull('deleted_at')->get();
    	
       $features = $this->getfeatures();
       if(empty($features)){
           return redirect('MyDashboard')->with( 'error', "Something went wrong");
       }
       else{
    	return view('templates.SuperAdmin.edit_user')->with(['customers' => $customer,'allfeatures' => $features]);
    }
}

    public function update(Request $request){
          
    	$wholesaler = UserRegister::find($request->input('id'));
    	$wholesaler->status = $request->input('status');
    	$wholesaler->save();
    	return redirect('customers')->with('success','Updated Successfully');
    }   
    public function delete($id)
  {
       $cust = UserRegister::find($id);
       $cust->delete();
       return redirect('customers')->with('success', 'Deleted Successfully');
   }public function emailblk()  {    $customer = BulkEmail::latest()->take(5)
    ->whereNull('deleted_at')->get()->toArray();
    return $customer->email;   }
}
