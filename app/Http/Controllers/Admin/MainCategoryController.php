<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\CategoryStyle;
use Redirect;
use Session;
use DB;

class MainCategoryController extends Controller
{
    public function index() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_drop_catimg_catname_circle')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
    public function add_main_category(Request $request) {
	 return $request->category_name;
	  return $request->category_image;
	  
	    $Categories = new Categories();
		$checkCategory = Categories::where('category_name', $request->category_name)->first();
     		if ($checkCategory) {
          alert('Category Already Exists!!');
		
		}  else {
		    	
            	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
     			$rdate =  $date->format('Y-m-d');

     		
                $Categories->category_name = $request->get('category_name');
                
        
       
        if (!empty($request->category_image)) {
            return $file1 = $request->category_image;
             $filename1 = $file1->getClientOriginalName();
            $path = 'images/categories/';
            $file1->move($path, $filename1);
             $Categories->category_image_web = $filename1;
        }
        else
        {
            $Categories->category_image_web = "";
        }
       
        
                $Categories->register_date = date('Y-m-d');
                $Categories->save();
              $cat = Categories::where('category_name', $request->category_name)->get();
if(!empty($cat))
{
     return response()->json([
                    'status' => "1", 
                    'data' => [$cat]
                    
                ]);
}
else
{
     return response()->json([
                    'status' => "0", 
                    'data' => "No Data Available"
                    
                ]);
}
               
		
		}
	}
	
	
     public function index_catimg_catname_sqaure() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_drop_catimg_catname_square')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
    
     public function index_catimg() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_drop_catimg_circle')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
public function index_cat_img_square() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_drop_catimg_square')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
    
    
    
    public function index_search_cat_img_cat_name_circle() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_search_catimg_catname_circle')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
    
    public function index_search_cat_img_circle() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_search_catimg_circle')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
      public function index_search_cat_img_cat_name_sqaure() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_search_catimg_catname_square')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
    
    public function index_search_cat_img_square() {
         $allcat = Categories::all();
         $cat_style= CategoryStyle::first();
          return view('templates.frontend.header_search_catimg_square')->with(['allcat' => $allcat,'style' => $cat_style]);
        // return view('templates.frontend.header_drop_catimg_catname', compact('allcat'));
        // if ($allcat) {
            
            
        //     // return view('templates/SuperAdmin/categories', compact('allcat'));
        // } else {
        //     return view('templates/SuperAdmin/categories');
        // }
    }
    
    
    public function store(Request $request) {
        $ccreate = new Categories();
        $ccreate->name = $request->cname;
        // if ($request->file('cimg')) {
        //     $file = $request->file('cimg');
        //     $filename = $file->getClientOriginalName();
        //     $path = 'images/categories/';
        //     $file->move($path, $filename);
        //     $ccreate->cimg = $filename;
        // }
        if ($ccreate->save()) {
            return Redirect()->back();
        }
    }
    
    public function edit($id)
   {

     $cat = Categories::where('_id','=',$id)->get();
      
     return view('templates.SuperAdmin.edit_category')->with(['categories' => $cat]);
    
   }

   public function update(Request $request)
     {
      
         $this->validate(
          $request, 
            [   
                'cname' => 'required',
            ],
            [   
                'cname.required' => 'Enter name',
            ]
        );
        
         
    $category = Categories::find($request->get('id'));
    $category->name = $request->input('cname');
    $category->save();
       return redirect('categories')->with('success','Updated Successfully');
     }
    public function delete($id)
    {
       $cat = Categories::find($id);
       $cat->delete();
       return redirect('categories')->with('success', 'Deleted Successfully');
     }
    
}

?>