<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

require base_path("vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

use App\ClassifiedPurchasedOrders;
use App\BulkEmail;
use App\ClassifiedAdd;
use App\UserRegister;
use Carbon\Carbon;
use DB;

use Mail;

use Session;



use App\Traits\Features;



class TestController extends Controller



{



    public function index_email()
    {
      
          
$emails=BulkEmail::select('email')->latest()->take(5)->get();

foreach($emails As $mail)
{
 $emailss= $mail->email;

  $emailArray = array($emailss);

//$arrsingleresult = str_replace("'\'", '', $emailArray);

$string=$emailArray[0];

$str_arr = preg_split ("/\,/", $string); 
print_r($str_arr);
 $emailArray = trim($string, '\"');
$eemail=array($emailArray);
$arrsingleresult = str_replace("'\'", '', $eemail);
//return $arrsingleresult;

 $emailArray=array("manjushapraveen31@gmail.com","manjusha772019@gmail.com","manjusha.geobull@gmail.com","vaibhav.geobull@gmail.com");
   $mail = new PHPMailer();// Passing `true` enables exceptions

 $mail->SMTPDebug = 0;

 $mail->isSMTP();

 $mail->Host = 'smtp.gmail.com'; 


 $mail->SMTPAuth = true;


$mail->Username = 'manjusha.geobull@gmail.com';   //  sender username

 $mail->Password = 'manjusha@2021';       // sender password

 $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls


  $mail->Port = 587;                          // port - 587/465

        $totalEmails = count($emailArray);

        for($i=0; $i<$totalEmails; $i++) {

         

            $mail->From = "manjusha.geobull@gmail.com";

            $from = "Manjusha";

            $mail->FromName = $from;   

             

            $Email = $emailArray[$i];       

            $mail->AddReplyTo($Email, $from);        

             

            $to = $Email;

            $mail->AddAddress($to, "");      

             

            $mail->IsHTML(true);

            $mail->Subject =  'multiple email';      

             

            $mail->Body  =view("emails.welcome");

            $send=$mail->Send();

             if($send ) {

                echo  "Email Sent Successfully!!.";

            }


            $mail->ClearAddresses();

}
}

  
   

}

public function test_mail()
{ 
        $getorderlist = ClassifiedPurchasedOrders::where('status','=','Purchased')->ORDERBY('_id','DESC')->get();
        foreach($getorderlist As $order)
     {
         echo  $user_id=$order->user_auto_id;
        //  $get_ad=ClassifiedAdd::where('user_auto_id','=',$user_id)->ORDERBY('_id','DESC')->get();
        //  foreach($get_ad As $g)
        //  {
        //      return $ad=$g->classified_ad;
        //  }
         
     };
 die;
  
//     $emails=ClassifiedAdd::all();
//   print_r($emails)."<br>";
    //return $ads=ClassifiedAdd::all();
    //one day (today)
 //$today = Carbon::now();

//one month / 30 days
 //$date_before_30days = Carbon::now()->subDays(30);
//
//diel;
////$emails=BulkEmail::all()->random(5);

$emails=BulkEmail::all();
$mail = new PHPMailer(true);
  
try {
    $mail->SMTPDebug = 2;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com;';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'manjusha772019@gmail.com';                 
    $mail->Password   = 'anvi@772019';                        
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 587;  
  
    
    $mail->setFrom('manjusha772019@gmail.com', 'Ma5sha'); //can be changed 
    
    foreach ($emails as $sender) 
    {
       $to=$sender['email'];
       $mail->addAddress($to);
    }
       
    $mail->isHTML(true);                                  
    $mail->Subject = 'Bulk Mail Test';
    $mail->Body    = view("emails.welcome");
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
       
    
}

}

