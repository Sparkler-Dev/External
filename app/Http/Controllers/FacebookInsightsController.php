<?php

namespace App\Http\Controllers;

use App\Models\StoreFacebookPageAccessToken;
use Illuminate\Http\Request;

class FacebookInsightsController extends Controller
{
    public function get_single_facebook_page_impressions(){
        if(auth('sanctum')->check()){

         $user_id = auth('sanctum')->user();
        $php_curl = curl_init();

         $get_page_access_token = StoreFacebookPageAccessToken::where('client_id', $user_id->client_id)->first();
        //  return response()->json([
        //        $get_page_access_token
        //        ]);

        $page_id = $get_page_access_token->page_id;      
        $access_token = $get_page_access_token->access_token;       

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/$page_id/insights/page_impressions_unique?access_token=$access_token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 1000,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Laravel curl Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $final_results = curl_exec($php_curl);
        $err = curl_error($php_curl);
        $err = curl_error($php_curl);
        curl_close($php_curl);

        if ($err) {
            echo "Laravel cURL Error #:" . $err;
        } else {
              $final_data = json_decode($final_results);
              return response()->json([
                   'single_facebook_page_impressions' => $final_data->data
               ]);
        }
    }
}

}