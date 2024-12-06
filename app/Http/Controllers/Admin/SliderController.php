<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Categories;
class SliderController extends Controller
{
   
public function index()
   {
     $slider = Slider::get();

     return view('templates.SuperAdmin.slider')->with(['sliders' => $slider]);
  }
    public function show(){
       $cat = Categories::get();
        return view('templates.SuperAdmin.add_slider')->with(['categories' => $cat]);
    }

    public function store(Request $request)
  {
     $this->validate(
         $request,
           [  
             'cimage'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'category' => 'required',
           ],
           [  
             'cimage.required' => 'Choose category image.',
             'cimage.image'   => 'Choose category image.',
            'cimage.mimes'   => 'Category image should be jpeg,png,jpg,gif or svg format only',
            'category.required' => 'Please enter category',
      ]
       );

 
         
         $cats = Categories::where('_id','=',$request->input('category'))->get();
           if($cats->isNotEmpty()){
              foreach($cats as $ch){
            $cat_name = $ch->name;
            }
        }else{
        $cat_name = "";
        }

     $slider = new  Slider();

     $name = uniqid().$request->file('cimage')->getClientOriginalName();
     $request->file('cimage')->move('images/slider/', $name);  
     $data = $name;
     $slider->logo = $data;
     $slider->category_id = $request->input('category');
     $slider->category = $cat_name;
     $slider->save();

     return redirect('slider')->with('success', 'Added Successfully');
     }




 public function edit($id)
   {

     $slider = Slider::where('_id','=',$id)->get();
      $cat = Categories::get(); 
     return view('templates.SuperAdmin.edit_slider')->with(['sliders' => $slider,'categories' => $cat]);
    
   }

   public function update(Request $request)
     {
       if($request->file('cimg')!='')
       {
         
         $this->validate(
           $request,
           [  
             'cimg'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'category' => 'required',
           ],
           [  
             'cimg.required' => 'Choose product image.',
             'cimg.image'   => 'Choose product image.',
             'cimg.mimes'   => 'Category image should be jpeg,png,jpg,gif or svg format only',
             'category.required' => 'Please enter category',
           ]
         );
         
       $name = uniqid().$request->file('cimg')->getClientOriginalName();
         $request->file('cimg')->move('images/slider', $name);  
         $data = $name;
       }
       $cats = Categories::where('_id','=',$request->input('category'))->get();
           if($cats->isNotEmpty()){
              foreach($cats as $ch){
            $cat_name = $ch->name;
            }
        }else{
        $cat_name = "";
        }
     $Slider = Slider::find($request->get('id'));
       if($request->file('cimg')!='')
       {
         $Slider->logo = $data;
       }
       $Slider->category_id = $request->input('category');
        $Slider->category = $cat_name;
        $Slider->save();
       return redirect('slider')->with('success','Updated Successfully');
     }
  public function delete($id)
  {
       $slider = Slider::find($id);
       $slider->delete();
       return redirect('slider')->with('success', 'Deleted Successfully');
   }
  }      