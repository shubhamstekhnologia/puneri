<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use Redirect;
use Session;
use DB;

class CategoryController extends Controller
{
    public function index() {
        $allcat = Categories::whereNull('deleted_at')->get();
        if ($allcat) {
            return view('templates/SuperAdmin/categories', compact('allcat'));
        } else {
            return view('templates/SuperAdmin/categories');
        }
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

     $cat = Categories::where('_id','=',$id)->whereNull('deleted_at')->get();
      
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