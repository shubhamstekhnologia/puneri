<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClassifiedAdd;
use App\UserRegister;
use DB;
use Session;
use App\Traits\Features;
class ClassifiedAddController extends Controller
{
    use Features;
//     public function index(){
        
//     	$add = ClassifiedAdd::ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
    
//         $features = $this->getfeatures();
//       if(empty($features)){
//           return redirect('MyDashboard')->with( 'error', "Something went wrong");
//       }
//       else{
//     	return view('templates.SuperAdmin.cls_ad')->with(['classified_ads' => $add, 'allfeatures' => $features]);
//     }
// }
    public function waiting_classified_ad(){
       $add = ClassifiedAdd::where('status','=','InReview')->ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
     
       $features = $this->getfeatures();
       if(empty($features)){
           return redirect('SuperAdmin')->with( 'error', "Something went wrong");
       }
       else{
      return view('templates.SuperAdmin.cls_ad')->with(['classified_ads' => $add,'allfeatures' => $features]);
      }
    }
    public function approved_classified_ad(){
       $add = ClassifiedAdd::where('status','=','Approved')->ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
     
       $features = $this->getfeatures();
       if(empty($features)){
           return redirect('SuperAdmin')->with( 'error', "Something went wrong");
       }
       else{
      return view('templates.SuperAdmin.cls_ad')->with(['classified_ads' => $add,'allfeatures' => $features]);
      }
    }
    public function disapproved_classified_ad(){
       $add = ClassifiedAdd::where('status','=','Disapproved')->ORDERBY('_id','DESC')->whereNull('deleted_at')->get();
     
       $features = $this->getfeatures();
       if(empty($features)){
           return redirect('SuperAdmin')->with( 'error', "Something went wrong");
       }
       else{
      return view('templates.SuperAdmin.cls_ad')->with(['classified_ads' => $add,'allfeatures' => $features]);
      }
    }
 
 	public function edit($id){
    	$add = ClassifiedAdd::where('_id','=',$id)->whereNull('deleted_at')->get();
    	
       $features = $this->getfeatures();
       if(empty($features)){
           return redirect('MyDashboard')->with( 'error', "Something went wrong");
       }
       else{
    	return view('templates.SuperAdmin.edit_cls_ad')->with(['classified_ads' => $add,'allfeatures' => $features]);
    }
}

    public function update(Request $request){
          
    	$cls= ClassifiedAdd::find($request->input('id'));
    	$cls->status = $request->input('status');
      if($request->get('reason')!=''){
            $cls->reason = $request->get('reason');
        }else{
            $cls->reason = "";
        }
    	$cls->save();
    // 	return redirect('classified_ad')->with('success','Updated Successfully');
    	 if($request->input('status') == "InReview"){
            return redirect('waiting-classified-ad')->with('success','Updated Successfully');
        }elseif($request->input('status') == "Approved"){
        $getapprovedlist = ClassifiedAdd::where('_id','=',$request->input('id'))->where('status','=','Approved')->whereNull('deleted_at')->get();
		if($getapprovedlist->isNotEmpty()){
	
        foreach($getapprovedlist as $data){
                    
                     $user_auto_id = $data->user_auto_id;
                   
                }
            $gettoken = UserRegister::select('token')->where('_id','=', $user_auto_id)->whereNull('deleted_at')->get();
                        if($gettoken->isNotEmpty()){
                            foreach ($gettoken as $gtoken) {
                                $token = $gtoken->token;
                                $classified_id = $gtoken->classified_id;
                            }
                        }else{
                            $token = "";
                            $classified_id = "";
                        }
                
                       // Notification send to user
                        $apikey = "AAAAU6pvJIA:APA91bHJnyhg1CxcYqF1F_fwckL4kyor4fntkYB8_ltzKHlrkt-0llosNHMlTc4DCgAjAyDPt8jsWpJMDDXS0S3ssWpg5uKu-3-YDuAmL994D6Jm9MHPSYEN0QQMnP_p2JZ8vY1_TiVU";
                
                        $msg = array
                        (
                            "body"  =>  "Your Ad no ".$classified_id." has been approved by admin.",
                            "title" => "Approved Ad",
                            "sound" => "default",
                            "click_action" => "com.geobull.classifiedmatrimony",
                        );
                        
                        $fields = array
                        (
                            'to'    => $token,
                            'data'  => $msg
                        );
                        
                        $headers = array
                        (
                            'Authorization: key=' . $apikey,
                            'Content-Type: application/json'
                        );
                         
                        $ch = curl_init();
                
                        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                        curl_setopt( $ch,CURLOPT_POST, true );
                        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                        $result = curl_exec($ch );
                        // print_r($result);
                        if($result === FALSE){
                            die('Curl failed: ' . curl_error($ch));
                        }
                        curl_close( $ch );
		    
		}
            return redirect('approved-classified-ad')->with('success','Updated Successfully');
        }elseif($request->input('status') == "Disapproved"){
            $getapprovedlists = ClassifiedAdd::where('_id','=',$request->input('id'))->where('status','=','Disapproved')->whereNull('deleted_at')->get();
		if($getapprovedlists->isNotEmpty()){
	
        foreach($getapprovedlists as $datas){
                    
                     $user_auto_id = $datas->user_auto_id;
                   
                }
            $gettoken = UserRegister::select('token')->where('_id','=', $user_auto_id)->whereNull('deleted_at')->get();
                        if($gettoken->isNotEmpty()){
                            foreach ($gettoken as $gtoken) {
                                $token = $gtoken->token;
                                $classified_id = $gtoken->classified_id;
                            }
                        }else{
                            $token = "";
                            $classified_id = "";
                        }
                
                       // Notification send to user
                        $apikey = "AAAAU6pvJIA:APA91bHJnyhg1CxcYqF1F_fwckL4kyor4fntkYB8_ltzKHlrkt-0llosNHMlTc4DCgAjAyDPt8jsWpJMDDXS0S3ssWpg5uKu-3-YDuAmL994D6Jm9MHPSYEN0QQMnP_p2JZ8vY1_TiVU";
                
                        $msg = array
                        (
                            "body"  =>  "Your Ad no ".$classified_id." has been disapproved by admin.",
                            "title" => "Disapproved Ad",
                            "sound" => "default",
                            "click_action" => "com.geobull.classifiedmatrimony",
                        );
                        
                        $fields = array
                        (
                            'to'    => $token,
                            'data'  => $msg
                        );
                        
                        $headers = array
                        (
                            'Authorization: key=' . $apikey,
                            'Content-Type: application/json'
                        );
                         
                        $ch = curl_init();
                
                        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                        curl_setopt( $ch,CURLOPT_POST, true );
                        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                        $result = curl_exec($ch );
                        // print_r($result);
                        if($result === FALSE){
                            die('Curl failed: ' . curl_error($ch));
                        }
                        curl_close( $ch );
		    
		}
            return redirect('disapproved-classified-ad')->with('success','Updated Successfully');
        }
    }   
    public function delete($id)
  {
       $cust = ClassifiedAdd::find($id);
       $cust->delete();
       return redirect('classified_ad')->with('success', 'Deleted Successfully');
   }
}
