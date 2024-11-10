<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function pay(){
        // $payLink = Auth::user()->charge(90.99, "Paddle Cource");

        // return view("billing",[
        //     'payLink'=> $payLink
        // ]);
            $shaString = '';
            $amount = 1*100;
            // $requestParams = array(
            //     'command' => 'AUTHORIZATION',
            //     'access_code' => 'kkCup7v8OTkCnYxCcdAf',
            //     'merchant_identifier' => 'fDDkIzNY',
            //     'merchant_reference' => 'test010',
            //     'amount' => $amount,
            //     'currency' => 'SAR',
            //     'language' => 'en',
            //     'customer_email' => 'test@payfort.com',
            //     'order_description' => 'iphone 6-S',
            // );
            
            $requestParams = array(
                'command' => 'AUTHORIZATION',
                'access_code' => 'kkCup7v8OTkCnYxCcdAf',
                'merchant_identifier' => 'fDDkIzNY',
                'merchant_reference' => 'XYZ9239-yu898',
                'amount' => 10000,
                'currency' => 'AED',
                'language' => 'en',
                'customer_email' => 'test@payfort.com',
                'signature' => '7cad05f0212ed933c9a5d5dffa31661acf2c827a',
                'order_description' => 'iPhone 6-S'
                );
                
    
    
            ksort($requestParams);
            foreach($requestParams as $key => $value){
                $shaString .= "$key=$value";
            }
    
            $shaString = '097YS5/VQl9X9ZyQqWb1OO#@' . $shaString . '45bAOjndhMiss6WeOcT8kH}{';
    
            $signature = hash('sha256',$shaString);
    
    
            $requestParams['signature'] = $signature;

            $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
            echo "<html xmlns='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
            echo "<form action='$redirectUrl' method='post' name='frm'>\n";
            foreach ($requestParams as $a => $b) {
                echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
            }
            echo "\t<script type='text/javascript'>\n";
            echo "\t\tdocument.frm.submit();\n";
            echo "\t</script>\n";
            echo "</form>\n</body>\n</html>";

            // $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
            //  echo "<html xmins='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
            //  echo "<h1>signature key --------->>>>>>>".$signature."</h1>";

            // echo "<form action='$redirectUrl'method='post' name='form1' id='form1'>\n";
            // // header("refresh:15;url=".$redirectUrl."");
            // // foreach ($requestParams as $a => $b){
            // //     echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
            // // }
            // // echo "\t<script type='text/javascript'>\n";
            // // echo "\t\tdocument.frm.submit();\n";
            // // echo "</script>\n";
            // echo "</form>\n";
            // echo "</body>\n";
            // echo"</html>";
            // // //$payLink = Auth::user()->charge(90.99, "Paddle Cource");
            // // $payLink = auth()->guard('client')->user()->charge(99.99, 'Test Product Title');
    
            // // return view("billing",[
            // //     'payLink'=> $payLink
            // // ]);
    }
}
