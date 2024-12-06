<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TermsSubmitAd;

use DB;

use Session;

use App\Traits\Features;

class TermSubmitController extends Controller

{

    use Features;

    public function index(){
      
        $terms = TermsSubmitAd::get();
    	

        $features = $this->getfeatures();

       if(empty($features)){

           return redirect('SuperAdmin')->with( 'error', "Something went wrong");

       }

       else{

    	return view('templates.SuperAdmin.term_submit_ad')->with(['allterms'=>$terms,'allfeatures'=>$features]);

    }

}



    public function update(Request $request){
       
      $terms = TermsSubmitAd::get();
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

    		$terms = TermsSubmitAd::find($request->get('id'));

    		$terms->term = $request->term;

    		$terms->save();

    		return redirect('termConditionSubmitAd')->with('success','Updated Successfully');

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
    		$term = new TermsSubmitAd();
    		$term->term = $request->term;

    		$term->save();

    		return redirect('termConditionSubmitAd')->with('success','Added Successfully');

    	}

    }

  

   
}

