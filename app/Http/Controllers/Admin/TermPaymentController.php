<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TermsPayment;

use DB;

use Session;

use App\Traits\Features;

class TermPaymentController extends Controller

{

    use Features;

    public function index(){
      
        $terms = TermsPayment::get();
    	

        $features = $this->getfeatures();

       if(empty($features)){

           return redirect('SuperAdmin')->with( 'error', "Something went wrong");

       }

       else{

    	return view('templates.SuperAdmin.term_payment')->with(['allterms'=>$terms,'allfeatures'=>$features]);

    }

}



    public function update(Request $request){
       
      $terms = TermsPayment::get();
    	 $this->validate(
            $request,
             [  
               'term' =>'required',
          
             ],
             [  
               'term.required' =>'add  term and condition',
           
             ]
             );

    	if($terms->isNotEmpty()){

    		$terms = TermsPayment::find($request->get('id'));

    		$terms->term = $request->term;

    		$terms->save();

    		return redirect('termConditionPayment')->with('success','Updated Successfully');

    	}

    	else{
             $this->validate(
            $request,
             [  
               'term' =>'required',
          
             ],
             [  
               'term.required' =>'add  term and condition',
           
             ]
             );
    		$term = new TermsPayment();
    		$term->term = $request->term;

    		$term->save();

    		return redirect('termConditionPayment')->with('success','Added Successfully');

    	}

    }

  

   
}

