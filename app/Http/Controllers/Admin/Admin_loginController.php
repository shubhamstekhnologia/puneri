<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\admin_login;
use Redirect;
use Session;
use Validator;
use App\Traits\Features;
use DB;

class Admin_loginController extends Controller
{
    use Features;
    public function index()
    {
        dd('h');
        $admin = admin_login::where('_id','=',Session::get('AccessToken'))->whereNull('deleted_at')->get();
        $features = $this->getfeatures();
        if(empty($features)){
          return redirect('SuperAdmin')->with( 'error', "Something went wrong");
        }
        else{
            return view('templates.myadmin.profile')->with(['profiles' => $admin, 'allfeatures' => $features]);
        }
    }



    public function showLogin(){

        return view('templates.SuperAdmin.login');
    }

    //  public function store(Request $request)
    // {
    //     $this->validate($request,[
    //       'username' => 'required|min:6|regex:/^([A-Za-z0-9]+)$/',
    //       'password' => 'required|min:6|regex:/^([A-Za-z0-9]+)$/'
    //     ]);

    //     $uname = $request->get ( 'username' );
    //     $pwd =  $request->get ( 'password' );

    //     $checkuname = admin_login::where('admin_username', '=', $uname)->whereNull('deleted_at')->get();

    //     if ($checkuname->isEmpty()) {
    //       return redirect('SuperAdmin')->with( 'message', "Username not exists, Please try again." );
    //     }
    //     else{
    //         $datapwd = admin_login::select('admin_password','id')->where('admin_username', $uname)->get();
    //         foreach ($datapwd as $dpwd) {
    //             $dbpwd = $dpwd->admin_password;
    //             $id = $dpwd->id;
    //         }

    //         if(password_verify($pwd,$dbpwd)){
    //             Session::put('AccessToken', $id);
    //             $features = $this->getfeatures();
    //             if(empty($features)){

    //              return redirect('SuperAdmin')->with( 'error', "Something went wrong");
    //             }
    //             else{
    //                 //echo "else";
    //                 return redirect('dashboard')->with(['allfeatures' => $features]);
    //             }
    //         }
    //         else{
    //               return redirect('SuperAdmin')->with( 'message', "Invalid Credentials , Please try again." );
    //         }
    //     }
    // }
public function store(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|min:6|regex:/^([A-Za-z0-9]+)$/',
            'password' => 'required|min:6|regex:/^([A-Za-z0-9]+)$/'
        ]);

        $uname = $request->get ( 'username' );
        $pwd =  $request->get ( 'password' );

              $checkuname = admin_login::where('admin_username', '=', $uname)->whereNull('deleted_at')->get();

       if ($checkuname === null) {
            return redirect('SuperAdmin')->with( 'error', "Username not exists , Please try again." );
       }
       else{
           $datapwd = admin_login::where('admin_username', $uname)->whereNull('deleted_at')->get();

              if($datapwd->isNotEmpty()){
                  foreach ($datapwd as $dpwd) {
                    $dbpwd = $dpwd->admin_password;
                    $id = $dpwd->id;
                 }

            }else{

                return redirect('SuperAdmin')->with( 'error', " Invalid Credentials , Please try again." );
            }

           if(password_verify($pwd,$dbpwd))
           {
               Session::put('AccessToken', $id);

               // check app builder feature
                $features = $this->getfeatures();
               if(empty($features)){
                   return redirect('SuperAdmin')->with( 'error', "Something went wrong");
               }
               else{

                 if(empty($features)){
                       return redirect('SuperAdmin')->with( 'error', "Something went wrong");
                   }
                   else{

                    return redirect('dashboard')->with(['allfeatures' => $features]);

                   }
               }
           }else{
                 return redirect('SuperAdmin')->with( 'error', "Invalid Credentials , Please try again." );
           }
       }
   }
    public function show_profile()
    {
        $said =  Session::get('AccessToken');
        $profile = admin_login::where('_id','=',Session::get('AccessToken'))->whereNull('deleted_at')->get();
        if(count($profile) == 0){
            $profile = array();
        }
        $features = $this->getfeatures();
        if(empty($features)){
          return redirect('SuperAdmin')->with( 'error', "Something went wrong");
        }
        else{
          return view('templates.SuperAdmin.profile')->with(['profile' => $profile,'allfeatures' => $features]);
        }
    }

    public function show_account()
    {
        $features = $this->getfeatures();
        if(empty($features)){
          return redirect('SuperAdmin')->with( 'error', "Something went wrong");
        }
        else{
          return view('templates.SuperAdmin.account')->with(['allfeatures' => $features]);
        }
    }

    public function changepwd(Request $request)
    {
        $said =  Session::get('AccessToken');

        $this->validate($request,[
            'oldp' => 'required|min:6|regex:/^([A-Za-z0-9]+)$/',
            'newp' => 'required|min:6|regex:/^([A-Za-z0-9]+)$/'
        ]);

        $oldp =  $request->get ( 'oldp' );
        $newp =  $request->get ( 'newp' );
        $npassword = password_hash($newp, PASSWORD_BCRYPT);

        $datapwd = admin_login::select('*')->whereNull('deleted_at')->get();
        foreach ($datapwd as $dpwd) {
            $dbpwd = $dpwd->admin_password;
        }

        if(password_verify($oldp,$dbpwd)){
            DB::table('admin_login')
            ->where('_id', $said)
            ->update(['admin_password' => $npassword]);
            Session::flash ( 'success', "Password Changed Successfully" );
            return redirect('account');
        }
        else{
           Session::flash ( 'error', "Old Password does not match , Please try again." );
            return redirect('account');
        }
    }


    public function logout(Request $request)
    {
        Session::forget(Session::get('AccessToken'));
        Session::flush();
        $request->session()->flush();
        return redirect('SuperAdmin')->with('success', 'Successfully Logged Out');
    }
}
