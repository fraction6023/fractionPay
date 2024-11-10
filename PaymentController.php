<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function pay(){
        // //$payLink = Auth::user()->charge(90.99, "Paddle Cource");
        // $payLink = auth()->guard('client')->user()->charge(99.99, 'Test Product Title');

        // return view("billing",[
        //     'payLink'=> $payLink
        // ]);
    }

    public function payFort(){
        $amount = 1*100;
        $requestParams = array(
            'command' => 'AUTHORIZATION',
            'access_code' => 'kkCup7v8OTkCnYxCcdAf',
            'merchant_identifier' => 'fDDkIzNY',
            'merchant_reference' => 'test010',
            'amount' => $amount,
            'currency' => 'AED',
            'language' => 'en',
            'customer_email' => 'test@payfort.com',
            'order_description' => 'iphone 6-S',
        );

        $shaString = '';

        ksort($requestParams);
        foreach($requestParams as $key => $value){
            $shaString .= "$key=$value";
        }

        $shaString = '2y$f10eg361a' . $shaString . '$2y$f10eg361a';

        $signature = hash('sha256',$shaString);

        echo "signature key --------->>>>>>>".$signature;

        $requestParams['signature'] = $signature;

        $redirectUrl = 'https://sbcheckout.payfort.com/fortAPI/paymentPage';
        echo "<html xmins='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        echo "<form action='$redirectUrl'method='post' name='frm'>\n";
        header("refresh:15;url=".$redirectUrl."");
        foreach ($requestParams as $a => $b){
            echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
        }
        echo "\t<script type='text/javascript'>\n";
        echo "\t\tdocument.frm.submit();\n";
        echo "</script>\n";
        echo "</form>\n</body>\n</html>";
        // //$payLink = Auth::user()->charge(90.99, "Paddle Cource");
        // $payLink = auth()->guard('client')->user()->charge(99.99, 'Test Product Title');

        // return view("billing",[
        //     'payLink'=> $payLink
        // ]);
    }
}
