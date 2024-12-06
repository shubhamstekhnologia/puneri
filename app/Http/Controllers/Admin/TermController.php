<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Terms;

use DB;

use Session;

use App\Traits\Features;

class TermController extends Controller

{

    use Features;

    public function index(){
      
        $terms = Terms::get();
    	

        $features = $this->getfeatures();

       if(empty($features)){

           return redirect('SuperAdmin')->with( 'error', "Something went wrong");

       }

       else{

    	return view('templates.SuperAdmin.term_condition')->with(['allterms'=>$terms,'allfeatures'=>$features]);

    }

}



    public function update(Request $request){
       
      $terms = Terms::get();
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

    		$terms = Terms::find($request->get('id'));

    		$terms->term = $request->term;

    		$terms->save();

    		return redirect('termCondition')->with('success','Updated Successfully');

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
    		$term = new Terms();
    		$term->term = $request->term;

    		$term->save();

    		return redirect('termCondition')->with('success','Added Successfully');

    	}

    }

  

   
}

