<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\RefundPolicy;

use DB;

use Session;

use App\Traits\Features;

class RefundController extends Controller

{
        public function index_refund(){
       
        $refund = RefundPolicy::get();
    	
       return view('templates.SuperAdmin.refundpolicy')->with(['refunds'=>$refund]);

}



    public function update_refund(Request $request){
        
        $rfnd = RefundPolicy::get();
         $this->validate(
            $request,
             [  
               'refund_policy' =>'required',
          
             ],
             [  
               'refund_policy.required' =>'add refund policy',
           
             ]
             );
    	if($rfnd->isNotEmpty()){

    		$rfnd = RefundPolicy::find($request->get('id'));

    		$rfnd->refund_policy = $request->refund_policy;

    		$rfnd->save();

    		return redirect('refund')->with('success','Updated Successfully');

    	}

    	else{
             $this->validate(
            $request,
             [  
               'refund_policy' =>'required',
          
             ],
             [  
               'refund_policy.required' =>'add refund policy',
           
             ]
             );
    		$rfnd = new RefundPolicy();
    		$rfnd->refund_policy = $request->refund_policy;

    		$rfnd->save();

    		return redirect('refund')->with('success','Added Successfully');

    	}

    }

  

   
}

