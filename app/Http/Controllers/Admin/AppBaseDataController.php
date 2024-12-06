<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AppBaseData;
use App\EcommPlans;
use App\Country;

class AppBaseDataController extends Controller
{
    public function index(){
    	$offer = AppBaseData::whereNull('deleted_at')->get();
    	return view('templates.SuperAdmin.app_base_data')->with('offers',$offer);
    }

    public function add(){
        return view('templates.SuperAdmin.add_app_base_data');
    }

    public function store(Request $request){
    	$this->validate(
          $request, 
            [   
                'app_image'   => 'required',
                 'app_name'   => 'required',
                  'keywords'   => 'required',
            ],
            [   
                'app_image.required' => 'Choose image.',
                'app_image.image'   => 'Choose image.',
                'app_image.mimes'   => 'Image should be jpeg,png,jpg,gif or svg format only',
                'app_name.required'   => 'Enter App name',
                'keywords.required'   => 'Enter keyword',

            ]
        );
       
    	// image
        $name = uniqid().$request->file('app_image')->getClientOriginalName();
       	$request->file('app_image')->move('images/app_data/', $name);  
       	$data = $name; 

        $offer = new AppBaseData();
        $offer->app_name = $request->input('app_name');
        $offer->keywords = $request->input('keywords');
        $offer->app_image = $data;
        $offer->save();

         return redirect('app-data')->with('success', 'Added Successfully');
    }

    public function edit($id){
        $offer = AppBaseData::where('_id','=',$id)->whereNull('deleted_at')->get();
        return view('templates.SuperAdmin.edit_app_base_data')->with(['offers' => $offer]);
    }

    public function update(Request $request){
        if($request->file('cimage')!=''){
                $this->validate(
          $request, 
            [   
                'app_image'   => 'required',
                 'app_name'   => 'required',
                  'keywords'   => 'required',
            ],
            [   
                'app_image.required' => 'Choose image.',
                'app_image.image'   => 'Choose image.',
                'app_image.mimes'   => 'Image should be jpeg,png,jpg,gif or svg format only',
                'app_name.required'   => 'Enter App name',
                'keywords.required'   => 'Enter keyword',

            ]
        );
            // image
       $name = uniqid().$request->file('app_image')->getClientOriginalName();
        $request->file('app_image')->move('images/app_data/', $name);  
        $data = $name; 

            $offer = AppBaseData::find($request->get('id'));
            $offer->app_name = $request->input('app_name');
            $offer->keywords = $request->input('keywords');
            $offer->app_image = $data;
            $offer->save();
        }
        return redirect('app-data')->with('success', 'Updated Successfully');
    }

    public function delete($id){
        $offer = AppBaseData::find($id);
        $offer->delete();
        return redirect('app-data')->with('success', 'Deleted Successfully');
    }
    
    //ecommerce plans
    public function index_eplans(){
    	$eplans = EcommPlans::whereNull('deleted_at')->get();
    	return view('templates.SuperAdmin.grobiz_eplans')->with('offers',$eplans);
    }

    public function add_eplans(){
        $country = Country::whereNull('deleted_at')->get();
        return view('templates.SuperAdmin.add_grobiz_eplans')->with('countries',$country);
    }

    public function store_eplans(Request $request){
    	$this->validate(
          $request, 
            [   
                 'name'   => 'required',
                  'price'   => 'required',
                   'offer_percentage'   => 'required',
                  'validity'   => 'required',
                  'validity_unit'   => 'required',
                   'description'   => 'required',
                  'features'   => 'required',
                  'country'   => 'required',
                   'user_limit'   => 'required',
            ],
            [   
               
                'name.required'   => 'Enter Plan Name',
                 'price.required'   => 'Enter Price',
                'offer_percentage.required'   => 'Enter Offer Percentage',
                'validity.required'   => 'Enter Validity',
                 'validity_unit.required'   => 'Select Validity Unit',
                'description.required'   => 'Enter Description',
                'features.required'   => 'Enter Features',
                'country.required'   => 'Select Country',
                'user_limit.required'   => 'Enter User Limit',

            ]
        );
          // get country details

        $countries = Country::where('_id','=',$request->get('country'))->whereNull('deleted_at')->get();
        if($countries->isNotEmpty()){
            foreach ($countries as $cnt) {
                $country_name = $cnt->country_name;
                $country_code = $cnt->country_code;
                $currency = $cnt->currency;
                $code = $cnt->code;
            }
         }else{
               $country_name = '';
                $country_code = '';
                $currency = '';
                 $code='';
         }
        $plans = new EcommPlans();
        $plans->name = $request->input('name');
        $plans->price = $request->input('price');
        $plans->offer_percentage = $request->input('offer_percentage');
        $offer_price = ($request->price * $request->offer_percentage)/100;
        $final_price = $request->price - $offer_price;
        $plans->final_price = strval($final_price);
        $plans->validity = $request->input('validity');
        $plans->validity_unit = $request->input('validity_unit');
        $plans->description = $request->input('description');
        $plans->features = $request->input('features');
        $plans->country_id = $request->input('country');
        $plans->user_limit = $request->input('user_limit');
        $plans->country_name = $country_name;
        $plans->country_code = $country_code;
        $plans->currency = $currency;
        $plans->code = $code;
        $plans->status = 'Active';
        $plans->save();

         return redirect('ecomm-plans')->with('success', 'Added Successfully');
    }

    public function edit_eplans($id){
        $offer = EcommPlans::where('_id','=',$id)->whereNull('deleted_at')->get();
          $country = Country::whereNull('deleted_at')->get();
        return view('templates.SuperAdmin.edit_grobiz_eplans')->with(['offers' => $offer,'countries'=> $country]);
    }

    public function update_eplans(Request $request){
       
    	$this->validate(
          $request, 
            [   
                 'name'   => 'required',
                  'price'   => 'required',
                   'offer_percentage'   => 'required',
                  'validity'   => 'required',
                  'validity_unit'   => 'required',
                   'description'   => 'required',
                  'features'   => 'required',
                  'country'   => 'required',
                   'user_limit'   => 'required',
            ],
            [   
               
                'name.required'   => 'Enter Plan Name',
                 'price.required'   => 'Enter Price',
                'offer_percentage.required'   => 'Enter Offer Percentage',
                'validity.required'   => 'Enter Validity',
                 'validity_unit.required'   => 'Select Validity Unit',
                'description.required'   => 'Enter Description',
                'features.required'   => 'Enter Features',
                'country.required'   => 'Select Country',
                'user_limit.required'   => 'Enter User Limit',

            ]
        );
    $countries = Country::where('_id','=',$request->get('country'))->whereNull('deleted_at')->get();
        if($countries->isNotEmpty()){
            foreach ($countries as $cnt) {
                $country_name = $cnt->country_name;
                $country_code = $cnt->country_code;
                $currency = $cnt->currency;
                $code = $cnt->code;
            }
         }else{
               $country_name = '';
                $country_code = '';
                $currency = '';
                 $code='';
         }
        $plans = EcommPlans::find($request->get('id'));
        $plans->name = $request->input('name');
        $plans->price = $request->input('price');
        $plans->offer_percentage = $request->input('offer_percentage');
        $offer_price = ($request->price * $request->offer_percentage)/100;
        $final_price = $request->price - $offer_price;
        $plans->final_price = strval($final_price);
        $plans->validity = $request->input('validity');
        $plans->validity_unit = $request->input('validity_unit');
        $plans->description = $request->input('description');
        $plans->features = $request->input('features');
        $plans->status = $request->input('status');
        $plans->country_id = $request->input('country');
         $plans->user_limit = $request->input('user_limit');
        $plans->country_name = $country_name;
        $plans->country_code = $country_code;
        $plans->currency = $currency;
        $plans->code = $code;
        $plans->save();
     
        return redirect('ecomm-plans')->with('success', 'Updated Successfully');
    }

    public function delete_eplans($id){
        $eplan = EcommPlans::find($id);
        $eplan->delete();
        return redirect('ecomm-plans')->with('success', 'Deleted Successfully');
    }
}