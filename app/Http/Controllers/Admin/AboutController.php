<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\About;

use DB;

use Session;

use App\Traits\Features;
use App\Admin;

class AboutController extends Controller

{
   
        public function index(){
            if(!session()->has("main"))
            {
                abort(404);
            }

            $admin = Admin::where("subdomain", "=", session("main"));
        $about = About::where("admin_auto_id", "=", $admin->id)->whereNull('deleted_at')->get();
    
    	return view('templates.SuperAdmin.about')->with(['abouts'=>$about]);

        }



    public function update(Request $request){
        $about = About::whereNull('deleted_at')->get();
        
            $this->validate(
          $request, 
            [   
                'about' => 'required',
            ],
            [   
                'about.required' => 'Add about us',
            ]
          );
     

    	if($about->isNotEmpty()){

    		$about = About::find($request->get('id'));

    		$about->about = $request->about;
          
    		$about->save();

    		return redirect('about')->with('success','Updated Successfully');

    	}

    	else{
        $this->validate(
         $request,
           [  
            'about' =>'required',
          
           ],
           [  
            'about.required' =>'add About',
         
             ]
             );
    		$about = new About();
    		$about->about = $request->about;

    		$about->save();

    		return redirect('about')->with('success','Added Successfully');

    	}

    }

  

   
}

