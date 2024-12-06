<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Faq;

use DB;

use Session;

use App\Traits\Features;

class FaqController extends Controller

{
        public function index(){
       
        $fq = Faq::wherenull('deleted_at')->get();
    	
       return view('templates.SuperAdmin.faq')->with(['faqs'=>$fq]);

}



    public function update(Request $request){
        
        $fq = Faq::wherenull('deleted_at')->get();
         $this->validate(
            $request,
             [  
               'faq' =>'required',
          
             ],
             [  
               'faq.required' =>'add faq',
           
             ]
             );
    	if($fq->isNotEmpty()){

    		$fq = Faq::find($request->get('id'));

    		$fq->faq = $request->faq;

    		$fq->save();

    		return redirect('faq')->with('success','Updated Successfully');

    	}

    	else{
             $this->validate(
            $request,
             [  
               'faq' =>'required',
          
             ],
             [  
               'faq.required' =>'add faq',
           
             ]
             );
    		$fq = new Faq();
    		$fq->faq = $request->faq;

    		$fq->save();

    		return redirect('faq')->with('success','Added Successfully');

    	}

    }

  

   
}

