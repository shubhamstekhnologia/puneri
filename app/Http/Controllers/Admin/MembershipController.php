<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Membership;
use App\Categories;
class MembershipController extends Controller
{
   
public function index()
   {
     $member = Membership::get();

     return view('templates.SuperAdmin.membership')->with(['memberships' => $member]);
  }
    public function show(){
       $cat = Categories::get();
        return view('templates.SuperAdmin.add_membership')->with(['categories' => $cat]);
    }

    public function store(Request $request)
  {
     
            $this->validate(
          $request, 
            [   
                'price' => 'required',
                'validity' => 'required',
                'category' => 'required',
                'session' => 'required',
            ],
            [   
                'price.required' => 'Please enter price',
                'validity.required' => 'Please enter price',
                'category.required' => 'Please enter category',
                'session.required' => 'Please enter sessions',
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
     $member = new  Membership();
     $member->price = $request->input('price');
     $member->validity = $request->input('validity');
     $member->session = $request->input('session');
     $member->category_id = $request->input('category');
     $member->category = $cat_name;
     $member->status = 'Active';
     $member->save();

     return redirect('membership')->with('success', 'Added Successfully');
     }




 public function edit($id)
   {

     $member = Membership::where('_id','=',$id)->get();
      $cat = Categories::get();
     return view('templates.SuperAdmin.edit_membership')->with(['memberships' => $member,'categories' => $cat]);
    
   }

   public function update(Request $request)
     {
     
           $this->validate(
          $request, 
            [   
                'price' => 'required',
                'validity' => 'required',
                'category' => 'required',
                'session' => 'required',
            ],
            [   
                'price.required' => 'Please enter price',
                'validity.required' => 'Please enter price',
                'category.required' => 'Please enter category',
                'session.required' => 'Please enter sessions',
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
        $membership = Membership::find($request->get('id'));
        $membership->price = $request->input('price');
        $membership->validity = $request->input('validity');
        $membership->session = $request->input('session');
        $membership->status = $request->input('status');
        $membership->category_id = $request->input('category');
        $membership->category = $cat_name;
        $membership->save();
       return redirect('membership')->with('success','Updated Successfully');
     }
  public function delete($id)
  {
       $mem = Membership::find($id);
       $mem->delete();
       return redirect('membership')->with('success', 'Deleted Successfully');
   }
  }      