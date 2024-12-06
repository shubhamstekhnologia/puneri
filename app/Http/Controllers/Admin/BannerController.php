<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Banner;

use DB;

use Session;

use App\Traits\Features;

class BannerController extends Controller

{

    use Features;

    public function index(){

    	$banner = Banner::whereNull('deleted_at')->whereNull('deleted_at')->get();

        $features = $this->getfeatures();

       if(empty($features)){

           return redirect('SuperAdmin')->with( 'error', "Something went wrong");

       }

       else{

    	return view('templates.SuperAdmin.banner')->with(['allbanners'=>$banner,'allfeatures'=>$features]);

    }

}



    public function update(Request $request){

    	$banner = Banner::whereNull('deleted_at')->get();

    	if($banner->isNotEmpty()){

    		

    		    if($request->file('offer_img')!='')
                {
       
                $name = uniqid().$request->file('offer_img')->getClientOriginalName();
                  $request->file('offer_img')->move('images/banner', $name);  
                  $data = $name;
                 }
                 $banner = Banner::find($request->get('id'));
                 if($request->file('offer_img')!='')
                    {
                      $banner->offer_img = $data;
                     }
    	       	$banner->save();

    		return redirect('banner')->with('success','Updated Successfully');

    	}

    	else{
            $newaid = uniqid();
    		$banner = new Banner();

    // 		$banner->offer_img = $request->offer_img;

           $name = uniqid().$request->file('offer_img')->getClientOriginalName();
            $request->file('offer_img')->move('images/banner/', $name);  
            $data = $name;
            $banner->offer_img = $data;

    		$banner->save();

    		return redirect('banner')->with('success','Added Successfully');

    	}

    }

}

