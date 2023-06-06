<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class TestController extends Controller
{
      public function sendmail(){


         // $user_id = auth('sanctum')->user();
         // $stripe_orders = StripeOrder::where('email', $user_id->email)->where('status', 'paid')->latest("id")->first();
         // $user_info = UserInfo::where('user_id', $user_id->id)->latest("id")->first();

        $data['email'] = "naveen.k@sparklerpro.com";
        $data['name'] = "Naveen Kumar";
      //   $data['total'] = $stripe_orders->total_price;
      //   $data['status'] = $stripe_orders->status;
      //   $data['educationpackage'] = $stripe_orders->education_package_id;
      //    $data['mobileno'] = $user_info->mobileno;
      //    $data['address'] = $user_info->address;
      //    $data['postalcode'] = $user_info->postalcode;
        $data['title'] = "Test email sent via spanalyst api";
        $data['body'] = "Please find the attached invoice below";

    //   return response()->json([
    //    $data
    //   ]);

      $pdf =  PDF::loadView("mail", $data);
      Mail::send('mail', $data, function($message) use ($data, $pdf){
         $message->to($data['email'])
         ->subject($data['title'])
         ->attachData($pdf->output(), 'test.pdf');
      });

       return response()->json([
         $data
       ]);

    }
}
