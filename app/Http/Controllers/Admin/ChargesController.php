<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Charges;

use DB;

use Session;

use App\Traits\Features;

class ChargesController extends Controller

{

    use Features;

    public function index(){

    	$charges = Charges::whereNull('deleted_at')->get();

        $features = $this->getfeatures();

       if(empty($features)){

           return redirect('SuperAdmin')->with( 'error', "Something went wrong");

       }

       else{

    	return view('templates.SuperAdmin.charges')->with(['allcharges'=>$charges,'allfeatures'=>$features]);

    }

}



    public function update(Request $request){

    	$charges = Charges::whereNull('deleted_at')->get();

    	if($charges->isNotEmpty()){

    		$charges = Charges::find($request->get('id'));

    		$charges->total_letter_count = $request->total_letter_count;

            $charges->per_letter_cost = $request->per_letter_cost;

    		$charges->save();

    		return redirect('charges')->with('success','Updated Successfully');

    	}

    	else{

    		$charges = new Charges();

    		$charges->total_letter_count = $request->total_letter_count;

            $charges->per_letter_cost = $request->per_letter_cost;

           	$charges->save();

    		return redirect('charges')->with('success','Added Successfully');

    	}

    }

}

