<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Privacy;

use DB;

use Session;

use App\Traits\Features;

class PrivacyController extends Controller

{

    use Features;

    public function index(){
        
        $privacy = Privacy::get();
    	

        $features = $this->getfeatures();

       if(empty($features)){

           return redirect('MyDashboard')->with( 'error', "Something went wrong");

       }

       else{

    	return view('templates.SuperAdmin.privacy_policy')->with(['allprivacy'=>$privacy,'allfeatures'=>$features]);

    }

}



    public function update(Request $request){
      
      $privacy = Privacy::get();
         $this->validate(
            $request,
             [  
               'privacy' =>'required',
          
             ],
             [  
               'privacy.required' =>'add privacy',
           
             ]
             );
    	if($privacy->isNotEmpty()){

    		$privacy = Privacy::find($request->get('id'));

    		$privacy->privacy = $request->privacy;

    		$privacy->save();

    		return redirect('privacyPolicy')->with('success','Updated Successfully');

    	}

    	else{
             $this->validate(
            $request,
             [  
               'privacy' =>'required',
          
             ],
             [  
               'privacy.required' =>'add privacy',
           
             ]
             );
    		$privacy = new Privacy();
            
    		$privacy->privacy = $request->privacy;

    		$privacy->save();

    		return redirect('privacyPolicy')->with('success','Added Successfully');

    	}

    }

  

   
}

